/*
 * Eventer 1.0 - http://gsgd.co.uk/sandbox/jquery/easing/
 *
 * Is part of Eventer - PHP jQuery Interactive Events Calendar
 * adds a lot of interactivity to Eventer app
 *
 * TERMS OF USE - Eventer
*/

function EventerEventsCalendar(tDIV) {
	
	//the div holding the holding the whole calendar interface
	this.cal = tDIV;
	
	
	/**
	 * stores reference to itself, useful for resolving scoping issues
	 */
	var self = this;
	
	//these values will be replaced from those which you set via the options page in the Eventer Admin panel
	this.dateBoxWidth = 136;
	this.dateBoxHeight = 91;
	this.dateBoxHSpace = 1;
	this.dateBoxVSpace = 1;
	this.dateBoxCornerRadius = 5;
	this.calendarPadding = 10;
	this.calendarBackgroundWidth = '100%';
	
	/**
	 * the actual calendarWidth and calendarHeight values are calculated using the values of
	 * dateBoxWidth, dateBoxHeight, dateBoxHSpace, dateBoxVSpace and margins
	 */
	this.calendarWidth = 980;
	this.calendarHeight = 675;
	
	/**
	 * position of row's date boxes from the top of the calendar
	 * this helps position the expanded date box at top of the calendar
	 */
	this.dateBoxTopOffset = 0;
	
	/**
	 * list of methods
	 */
	this.init = init;
	this.displayEventsData = displayEventsData;
	this.enlargeDateBox = enlargeDateBox;
	this.showEventsList = showEventsList;
	this.showEvent = showEvent;
	this.switchEvent = switchEvent;
	this.closeDateBox = closeDateBox;
	this.updateEventsNavStatus = updateEventsNavStatus;
	
	this.tempDiv;
	this.dateBoxDivOptions;
	this.clickedEventID;
	this.viewMode = 'close';
	
	function init(options) {
		if (options != null) {
			self.dateBoxWidth = options.dateBoxWidth != null ? options.dateBoxWidth : self.dateBoxWidth;
			self.dateBoxHeight = options.dateBoxHeight != null ? options.dateBoxHeight : self.dateBoxHeight;
			self.dateBoxHSpace = options.dateBoxHSpace != null ? options.dateBoxHSpace : self.dateBoxHSpace;
			self.dateBoxVSpace = options.dateBoxVSpace != null ? options.dateBoxVSpace : self.dateBoxVSpace;
			self.dateBoxCornerRadius = options.dateBoxCornerRadius != null ? options.dateBoxCornerRadius : self.dateBoxCornerRadius;
			self.calendarPadding = options.calendarPadding != null ? options.calendarPadding : self.calendarPadding;
			self.calendarBackgroundWidth = options.calendarBackgroundWidth != null ? options.calendarBackgroundWidth : self.calendarBackgroundWidth;
		}
		
		self.dateBoxTopOffset = $(self.cal + ' #month-dates-container').position().top + parseInt($(self.cal + ' #month-dates-container').css('margin-top'));
		self.displayEventsData();
	}
	
	function displayEventsData() {
		var row = 0;
		var col = 0;
		var totalHeight = 0;
		
		$(self.cal + ' ul#week-day-names-container > li').each(function(index, element) {
			
			if (index < ($(self.cal + ' ul#week-day-names-container > li').length - 1)) {
				$(this).css({
					'width'			:	self.dateBoxWidth,
					'marginRight'	:	self.dateBoxHSpace
					
				});
			}
			else {
				$(this).css({
					'width'			:	self.dateBoxWidth
					
				});
			}
		});
		
		$(self.cal + ' ul#month-dates-container > li').each(function(index, element) {
			
			$(this).css({
				'width'			:	self.dateBoxWidth,
				'height'		:	self.dateBoxHeight,
				'border-radius'	:	self.dateBoxCornerRadius,
				'top'			:	(self.dateBoxHeight + self.dateBoxVSpace) * row + 'px',
				'left'			:	(self.dateBoxWidth + self.dateBoxHSpace) * col + 'px',
				'z-index'		:	index
			});
			
			col++;
			if (col == 7) {
				row++;
				col = 0;	
			}
			
			$('.date-labels-wrapper', this).height($('.date-label', this).height());
			
            if ($(this).children('.date-box-events-wrapper').size() != 0) {
				
				$(this).bind('click', function(e){
					e.preventDefault();
					
					self.viewMode = "open";
					enlargeDateBox(this);
				});
				
				$('.date-box-close-btn a', this).click( function(e) {
					e.preventDefault();
					closeDateBox($(this).parent().parent());
				});
				
				$('.date-box-back-btn a', this).click( function(e) {
					e.preventDefault();
					showEventsList($(this).parent().parent().parent());
				});
				
				$('.date-box-next-event-btn a', this).click( function(e) {
					e.preventDefault();
					var parts = self.clickedEventID.split('-');
					var indexID = $('#' + self.clickedEventID).index();
					
					//siblings().length will return 1 less than the total number of event list items
					if ($('#' + self.clickedEventID).index() == $('#' + self.clickedEventID).siblings().length) {
						return false;
					}
					
					$('#' + $('#' + self.clickedEventID).parent().parent().parent().attr('id') + ' .event-details-items li:eq(' + indexID + ')').css({'display':'none'});
					
					self.clickedEventID = $('#' + self.clickedEventID).next().attr('id');
					switchEvent($('#' + self.clickedEventID).parent().parent().parent());
				});
				
				$('.date-box-prev-event-btn a', this).click( function(e) {
					e.preventDefault();
					var parts = self.clickedEventID.split('-');
					var indexID = $('#' + self.clickedEventID).index();
					
					if ($('#' + self.clickedEventID).index() == 0) {
						return false;
					}
					
					$('#' + $('#' + self.clickedEventID).parent().parent().parent().attr('id') + ' .event-details-items li:eq(' + indexID + ')').css({'display':'none'});
					
					self.clickedEventID = $('#' + self.clickedEventID).prev().attr('id');
					switchEvent($('#' + self.clickedEventID).parent().parent().parent());
				});
				
				//click event handler for event items
				$('.events-list-item a', this).click( function(e) {
					e.preventDefault();
					self.clickedEventID = $(this).parent().attr('id');
					
					if (self.viewMode == "open") {
						//if the date box is already enlarged then show the event's details
						showEvent($(this).parent().parent().parent().parent());
					}
					else {
						//if date box is not enlarged then trigger the click event on the date box to enlarge it first
						self.viewMode = "open";
						$(this).parent().parent().parent().parent().click();
					}
				});
			}
        });
		
		$(self.cal + ' ul#month-dates-container > li').each(function(index, element) {
			
			var numberOfEvents = $(this).find('.date-box-events').children().length;
			
			var newTotalHeight = 0;
			$(this).find('.date-box-events .events-list-item').each(function(index, element) {
				newTotalHeight += $(this).height() + 2;
			});
			
			newTotalHeight += parseInt($(this).find('.date-labels-wrapper').height()) + 5 - 1;
			
			if (newTotalHeight > totalHeight && numberOfEvents) {
				totalHeight = newTotalHeight;
			}
			
			if ((index + 1) % 7 == 0) {
				var rowID = Math.ceil((index + 1) / 7);
				
				if (totalHeight > self.dateBoxHeight) {
					$('li.date-box-row-' + rowID).css('height', totalHeight);
					
					$('li.date-box-row-' + rowID).each(function(index, element) {
						$(this).attr('data-date-box-height', totalHeight);
					});
					
					$('li.date-box:gt(' + (rowID * 7 - 1) + ')').each(function(index, element) {
						$(this).css('top', parseInt($(this).css('top')) + (totalHeight - self.dateBoxHeight));
					});
				}
				else {
					$('li.date-box-row-' + rowID).each(function(index, element) {
						$(this).attr('data-date-box-height', self.dateBoxHeight);
					});
				}
				
				totalHeight = 0;
			}
				
		});
		
		$(self.cal + ' .date-box-disabled').css('opacity', .5);
		
		$(self.cal + ' #calendar-nav').css('width', ((self.dateBoxWidth + self.dateBoxHSpace) * 7 - self.dateBoxHSpace) + 'px');
		$(self.cal + ' #week-day-names-container').css('width', ((self.dateBoxWidth + self.dateBoxHSpace) * 7 - self.dateBoxHSpace) + 'px');
		
		self.tempDiv = $(self.cal + ' #month-dates-container').css({
																				'width'			:	(self.dateBoxWidth + self.dateBoxHSpace) * 7 - self.dateBoxHSpace + 'px',
																				'height'		:	(self.dateBoxHeight + self.dateBoxVSpace) * 6 - self.dateBoxVSpace + 'px',
																			});
		
		calendarWidth = parseInt($(self.cal + ' #month-dates-container').css('width'));
		calendarHeight = parseInt($(self.cal + ' #month-dates-container').css('height'));
		
		if (self.calendarBackgroundWidth == '100%') {
			$(self.cal).css({
								'width'	:	'100%',
							});
		}
		else {
			$(self.cal).css({
								'width'	:	calendarWidth + (self.calendarPadding * 2),
							});
		}
		
		$(self.cal + ' .event-details-items-wrapper').css({
			'left'	:	calendarWidth
		});
		
		$(self.cal + ' .date-box-events').css({
			'width'			:	'100%'
		});
		
		var calHeight = 0;
		for (m = 0; m <7; m++) {
			calHeight += $(self.cal + ' li.date-box-row-' + m).height();
		}
		
		$(self.cal + ' #month-dates-container').animate({height:calHeight + 5}, 0, "easeOutExpo");
		$(self.cal).stop().animate({height:42 + 64 + calHeight + 20 + 5}, 1000, "easeOutExpo");
	}
	
	function enlargeDateBox($targetDateBox) {
		$('#' + $($targetDateBox).attr('id') + ' ul.date-box-events').addClass('date-box-events-expanded-view');
		
		self.dateBoxDivOptions = {top:$($targetDateBox).css('top'), left:$($targetDateBox).css('left'), zIndex:$($targetDateBox).css('z-index')};
		
		$($targetDateBox).unbind('click');
		
		/**
		 * When a date box containing events is clicked
		 * then we adda a temp date box to disable the clicking of other date boxes
		 */
		$(self.cal + ' #month-dates-container').append('<li id="date-box-100" class="date-box temp-date-box"></li>');
		self.tempDiv = $(self.cal + ' #date-box-100');
		
		calendarWidth = parseInt($(self.cal + ' #month-dates-container').css('width'));
		calendarHeight = parseInt($(self.cal + ' #month-dates-container').css('height'));
		
		$('#' + $($targetDateBox).attr('id') + ' ul.date-box-events-expanded-view').css('width', calendarWidth - 40);
		
		$(self.cal + ' #date-box-100').css({
													'width'			:	calendarWidth,
													'height'		:	calendarHeight,
													'left'			:	10,
													'top'			:	10,
													'opacity'		:	0,
													'z-index'		:	99
												});
		
		$(self.cal + ' #date-box-100').animate({opacity:0}, 500, "easeInQuint");
		
		$($targetDateBox).css({'z-index':100});
		
		$($targetDateBox).animate(
								{
									width			:		calendarWidth,
									height			:		calendarHeight + self.dateBoxTopOffset,
									left			:		0,
									top				:		-self.dateBoxTopOffset
								},
								{
									duration		:		500,
									easing			:		"easeInQuint",
									complete		:		function() {
															if (self.clickedEventID) {
																showEvent($targetDateBox);
															}
														}
								}
							);
		
		$('#' + $($targetDateBox).attr('id') + ' .date-box-events-wrapper').animate(
													{
														width:calendarWidth - 20,
														height:calendarHeight - $('#' + $($targetDateBox).attr('id') + ' .date-labels-wrapper').height() - $('#' + $($targetDateBox).attr('id') + ' .date-box-close-btn').height() - 30 + self.dateBoxTopOffset,
														marginLeft: 20,
														marginRight: 0,
														marginTop:10
													}, 500, "easeInQuint");
		
		$('#' + $($targetDateBox).attr('id') + ' .date-labels-wrapper').animate({
			marginLeft:20,
			marginTop:20,
		}, 500, "easeInQuint");
		
		$('#' + $($targetDateBox).attr('id') + ' .date-box-close-btn').fadeIn(500, "easeInQuint");
	}
	
	function showEventsList($targetDateBox) {
		var parts = self.clickedEventID.split('-');
		var indexID = $('#' + self.clickedEventID).index();
		
		$('#' + $($targetDateBox).attr('id') + ' .date-box-events').animate({left: 0}, 500, "easeInQuint");
		$('#' + $($targetDateBox).attr('id') + ' .event-details-items-wrapper').animate({left:calendarWidth + 'px'},
			{
				duration	:		500,
				easing		:		"easeInQuint",
				complete	:		function() {
										$('#' + $($targetDateBox).attr('id') + ' .event-details-items li:eq(' + indexID + ')').css('display', 'none');
									}
			}
		);
		
		$('#' + $($targetDateBox).attr('id') + ' .date-labels-wrapper').removeClass('date-labels-wrapper-border');
		$('#' + $($targetDateBox).attr('id') + ' .date-labels-wrapper').animate({paddingBottom:0}, 500, "easeInQuint");
		$('#' + $($targetDateBox).attr('id') + ' .date-labels').animate({top: 0}, 500, "easeInQuint");
		$('#' + $($targetDateBox).attr('id') + ' .event-items-nav').slideUp(500, "easeInQuint");
	}
	
	function showEvent($targetDateBox) {
		updateEventsNavStatus($targetDateBox);
		
		var eventContentHeight = calendarHeight - $('#' + $($targetDateBox).attr('id') + ' .date-labels-wrapper').height() - $('#' + $($targetDateBox).attr('id') + ' .date-box-close-btn').height() - 30 + self.dateBoxTopOffset;
		
		var parts = self.clickedEventID.split('-');
		var indexID = $('#' + self.clickedEventID).index();
		
		$('#' + $($targetDateBox).attr('id') + ' .date-labels-wrapper').addClass('date-labels-wrapper-border');
		$('#' + $($targetDateBox).attr('id') + ' .date-labels-wrapper').animate({
			marginLeft:20,
			marginTop:20,
			paddingBottom:15
		}, 500, "easeInQuint");
		
		$('#' + $($targetDateBox).attr('id') + ' .event-details-items li:eq(' + indexID + ')').css({'display':'block', width:calendarWidth - 25, height:eventContentHeight});
		
		$('#' + $($targetDateBox).attr('id') + ' ul.event-details-items li:eq(' + indexID + ') .event-item-details-scrollbar').css({'width':calendarWidth - 25, 'height':eventContentHeight});
		$('#' + $($targetDateBox).attr('id') + ' ul.event-details-items li:eq(' + indexID + ') .viewport').css('width', calendarWidth - 45);
		$('#' + $('#' + $($targetDateBox).attr('id') + ' ul.event-details-items li:eq(' + indexID + ') .event-item-details-scrollbar').attr('id')).tinyscrollbar();
		
		$('#' + $($targetDateBox).attr('id') + ' .date-box-events').animate({left: '-' + calendarWidth + 'px'}, 500, "easeInQuint");
		
		$('#' + $($targetDateBox).attr('id') + ' .event-details-items-wrapper').animate({
																			left: 0,
																			width:calendarWidth - 25
																		}, 500, "easeInQuint");
		
		$('#' + $($targetDateBox).attr('id') + ' .date-labels').animate({top: -$('#' + $($targetDateBox).attr('id') + ' .date-label').height()}, 500, "easeInQuint");
		$('#' + $($targetDateBox).attr('id') + ' .event-items-nav').slideDown(500, "easeInQuint");
	}
	
	
	function switchEvent($targetDateBox) {
		var parts = self.clickedEventID.split('-');
		var indexID = $('#' + self.clickedEventID).index();
		
		updateEventsNavStatus($targetDateBox);
		
		var eventContentHeight = calendarHeight - $('#' + $($targetDateBox).attr('id') + ' .date-labels-wrapper').height() - $('#' + $($targetDateBox).attr('id') + ' .date-box-close-btn').height() - 30 + self.dateBoxTopOffset;
		
		$('#' + $($targetDateBox).attr('id') + ' .event-details-items li:eq(' + indexID + ')').css({'display':'block', width:calendarWidth - 25, height:eventContentHeight});
		
		$('#' + $($targetDateBox).attr('id') + ' ul.event-details-items li:eq(' + indexID + ') .event-item-details-scrollbar').css({'width':calendarWidth - 25, 'height':eventContentHeight});
		$('#' + $($targetDateBox).attr('id') + ' ul.event-details-items li:eq(' + indexID + ') .viewport').css('width', calendarWidth - 45);
		$('#' + $('#' + $($targetDateBox).attr('id') + ' ul.event-details-items li:eq(' + indexID + ') .event-item-details-scrollbar').attr('id')).tinyscrollbar();
	}
	
	function updateEventsNavStatus($targetDateBox) {
		if ($('#' + self.clickedEventID).index() == $('#' + self.clickedEventID).siblings().length) {
			$('.date-box-next-event-btn a').css('opacity', .5);
			$('.date-box-next-event-btn a').addClass('disabled');
		}
		else if ($('#' + $($targetDateBox).attr('id') + ' .date-box-next-event-btn a').hasClass('disabled')) {
			$('#' + $($targetDateBox).attr('id') + ' .date-box-next-event-btn a').css('opacity', 1);
			$('#' + $($targetDateBox).attr('id') + ' .date-box-next-event-btn a').removeClass('disabled');
		}
		
		if ($('#' + self.clickedEventID).index() == 0) {
			$('#' + $($targetDateBox).attr('id') + ' .date-box-prev-event-btn a').css('opacity', .5);
			$('#' + $($targetDateBox).attr('id') + ' .date-box-prev-event-btn a').addClass('disabled');
		}
		else if ($('#' + $($targetDateBox).attr('id') + ' .date-box-prev-event-btn a').hasClass('disabled')) {
			$('#' + $($targetDateBox).attr('id') + ' .date-box-prev-event-btn a').css('opacity', 1);
			$('#' + $($targetDateBox).attr('id') + ' .date-box-prev-event-btn a').removeClass('disabled');
		}
	}
	
	function closeDateBox($targetDateBox) {
		delete self.clickedEventID;
		self.viewMode = "close";
		
		$($targetDateBox).unbind('click');
		$($targetDateBox).animate(
			{
				width		:		self.dateBoxWidth,
				height		:		$($targetDateBox).attr('data-date-box-height'),
				top			:		self.dateBoxDivOptions.top,
				left		:		self.dateBoxDivOptions.left
			},
			{
				duration	:		500,
				easing		:		"easeInQuint",
				complete	:		function() {
										$('#' + $($targetDateBox).attr('id') + ' ul.date-box-events').removeClass('date-box-events-expanded-view');
										
										$('#' + $($targetDateBox).attr('id') + ' ul.date-box-events').css('width', '100%');
										
										$('#' + $($targetDateBox).attr('id') + ' .event-details-items li').each(function(index, element) {
											$(this).css('display', 'none');
										});
										
										$($targetDateBox).css({'z-index':self.dateBoxDivOptions.zIndex});
										$($targetDateBox).bind('click', function(e){
											e.preventDefault();
											
											self.viewMode = "open";
											enlargeDateBox(this);
										});
									}
			}
		);
						
		$(self.tempDiv).animate({opacity:0}, 500, "easeInQuint", function() {
			$(self.tempDiv).remove();
		});
		
		$('#' + $($targetDateBox).attr('id') + ' .date-box-events-wrapper').css('width', 'auto');
		$('#' + $($targetDateBox).attr('id') + ' .date-box-events-wrapper').animate(
													{
														marginLeft:5,
														marginRight:5,
														marginTop:0
													}, 500, "easeInQuint");
													
		$('#' + $($targetDateBox).attr('id') + ' .date-box-events').animate(
													{
														left:0
													}, 500, "easeInQuint");
													
		$('#' + $($targetDateBox).attr('id') + ' .event-details-items-wrapper').animate(
													{
														left:(self.calendarWidth - 20) + 'px'
													}, 500, "easeInQuint");
													
		$('#' + $($targetDateBox).attr('id') + ' .date-box-close-btn').fadeOut(500, "easeInQuint");
		
		$('#' + $($targetDateBox).attr('id') + ' .date-labels-wrapper').removeClass('date-labels-wrapper-border');
		$('#' + $($targetDateBox).attr('id') + ' .date-labels-wrapper').animate({
			marginLeft:5,
			marginTop:5,
			paddingBottom:0
		}, 500, "easeInQuint");
		
		$('#' + $($targetDateBox).attr('id') + ' .date-labels').animate({top: 0}, 500, "easeInQuint");
		
		$('#' + $($targetDateBox).attr('id') + ' .event-items-nav').slideUp(500, "easeInQuint");
	}
	
}