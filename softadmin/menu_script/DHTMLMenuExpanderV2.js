//--------------------------------------------------------------------------------------------------
// All material contained within this document and associated downloaded pages 
// is the property of 4thorder(TM) unless otherwise noted
// Copyright © 2005.  All rights reserved.
//
// Author: Michael Falatine || Authors email: 4thorder@4thorder.us
//
// USAGE: You may use this script for commercial or personal use, however, the copyright is retained-
// by 4thorder (TM).
//
// For other free Scripts visit: http://www.4thorder.us/Scripts/
//---------------------------------------------------------------------------------------------------

//-----------------begin insertAdjacent code-----------------------------------------------------
// This portion written by Thor Larholm thor@jscript.dk
// Allows for insertAdjacentHTML(), insertAdjacentText() and insertAdjacentElement()
// functionality in Netscape / Mozilla /Opera
if(typeof HTMLElement!="undefined" && !HTMLElement.prototype.insertAdjacentElement){
	HTMLElement.prototype.insertAdjacentElement = function(where,parsedNode)
	{
		switch (where){
		case 'beforeBegin':
			this.parentNode.insertBefore(parsedNode,this)
			break;
		case 'afterBegin':
			this.insertBefore(parsedNode,this.firstChild);
			break;
		case 'beforeEnd':
			this.appendChild(parsedNode);
			break;
		case 'afterEnd':
			if (this.nextSibling) this.parentNode.insertBefore(parsedNode,this.nextSibling);
			else this.parentNode.appendChild(parsedNode);
			break;
		}
	}

	HTMLElement.prototype.insertAdjacentHTML = function(where,htmlStr)
	{
		var r = this.ownerDocument.createRange();
		r.setStartBefore(this);
		var parsedHTML = r.createContextualFragment(htmlStr);
		this.insertAdjacentElement(where,parsedHTML)
	}


	HTMLElement.prototype.insertAdjacentText = function(where,txtStr)
	{
		var parsedText = document.createTextNode(txtStr)
		this.insertAdjacentElement(where,parsedText)
	}
}
//----------------------end insertAdjacent code-------------------------------------------------------

// ::::::::::::::::
// :::: Styles :::
// ::::::::::::::::
function setSTYLES()
{
mainTABLEElement=document.getElementById("mainTable");
TDCol=mainTABLEElement.getElementsByTagName("TD");
for (s=0; s<TDCol.length; s++)
	{TDCol.item(s).style.verticalAlign='top';}
	
// Set Transparency level
if(navigator.appName == 'Microsoft Internet Explorer')
	{document.getElementById('menuSystem').style.filter="progid:DXImageTransform.Microsoft.Alpha(opacity="+TValue+")";}
else
	{document.getElementById('menuSystem').style.MozOpacity=1;
	 TValue=parseFloat(TValue/100-.001); // .001 is fix for moz opacity/image bug
	 document.getElementById('menuSystem').style.MozOpacity=TValue;}
	
// Collection used to determine if section has children
SUBTABLECol=mainTABLEElement.getElementsByTagName("TABLE");
for (s=0; s<SUBTABLECol.length; s++)
	{
	TDChildrenCol=SUBTABLECol.item(s).getElementsByTagName("TD");
	// If children then insert image depending on ECState
	if(TDChildrenCol.length>0)
		{
		THCol=SUBTABLECol.item(s).getElementsByTagName("TH");
		if(ImagePlacement=='before')
			{
			var str='<IMG border="0" src="menu_script\/'+imagePLUS+'" alt="Expand ALL">&nbsp;';
			THCol.item(0).insertAdjacentHTML("afterBegin", str);
			}
		else if(ImagePlacement=='after')
			{
			var str='&nbsp;<IMG border="0" src="menu_script\/'+imagePLUS+'" alt="Expand ALL">';
			THCol.item(0).insertAdjacentHTML("beforeEnd", str);
			}
		else {}
		THCol.item(0).style.cursor="pointer";
		}
	}
}

// :::::::::::::::::::::::::::
// :::: Global Functions :::
// :::::::::::::::::::::::::::
window.onload=InitializePage;

function InitializePage()
{hideALL(); setSTYLES(); attachEventhandlers();}

// Attach event handlers to all images within container
function attachEventhandlers()
{
mainTABLEElement=document.getElementById("mainTable");
TABLECol=mainTABLEElement.getElementsByTagName("TABLE");

if (TABLECol!=null)
	{for (l=0; l<TABLECol.length; l++)
		{
		THCol=TABLECol.item(l).getElementsByTagName("TH");
		THCol.item(0).setAttribute('id',l);
		if(handlerTYPE=='mouseover')
			{THCol.item(0).onmouseover=eHandler;
			 document.getElementsByTagName("BODY").item(0).onclick=eHandler;}
		else if(handlerTYPE=='click')
			{document.getElementsByTagName("BODY").item(0).onclick=eHandler;}
		}
	}
}

function hideALL()
{
mainTABLEElement=document.getElementById("mainTable");
TABLECol=mainTABLEElement.getElementsByTagName("TABLE");
for (a=0; a<TABLECol.length; a++)
	{
	IMGCol=TABLECol.item(a).getElementsByTagName("IMG");
	if (IMGCol.item(0)!=null){IMGCol.item(0).setAttribute('src','menu_script/'+imagePLUS);}
	
	THCol=TABLECol.item(a).getElementsByTagName("TH");
	for (b=0; b<THCol.length; b++)
		{THCol.item(b).setAttribute("ECState",0);}
		
	TRCol=TABLECol.item(a).getElementsByTagName("TR");
	for (c=1; c<TRCol.length; c++)
		{
		TRCol.item(c).style.display='none';
		}
	}
}

function showSingle()
{
mainTABLEElement=document.getElementById("mainTable");
TABLECol=mainTABLEElement.getElementsByTagName("TABLE");

if (TABLECol!=null)
	{
	for (z=0; z<TABLECol.length; z++)
		{
		TRCol=TABLECol.item(z).getElementsByTagName("TR");
		THCol=TABLECol.item(z).getElementsByTagName("TH");
		IMGCol=TABLECol.item(z).getElementsByTagName("IMG");

		// Grab ECState and expand or collapse branch
		State=THCol.item(0).getAttribute("ECState");
		if(State==0)
			{
			// ECState is COLLAPSED (+) (0)
			if (IMGCol.item(0)!=null){IMGCol.item(0).setAttribute('src','menu_script/'+imagePLUS);}
			for (l=1; l<TRCol.length;l++)
				{
				TRCol.item(l).style.display='none';
				}
			}
		else	 if(State==1)
			{
			// ECState is EXPANDED (-) (1)
			if (IMGCol.item(0)!=null){IMGCol.item(0).setAttribute('src','menu_script/'+imageMINUS);}
				for (m=0; m<TRCol.length; m++)
				{// Browser compatibility code
				if(navigator.appName == 'Microsoft Internet Explorer')
					{
					if(navigator.userAgent.indexOf('Opera') != -1)
						{TRCol.item(m).style.display='table-row';}
					else	{TRCol.item(m).style.display='block'; }
					}
				else	{TRCol.item(m).style.display='table-row';}
				}
			}
		}
	}
}

// ::::::::::::::::::::::::::
// :::: Event Handlers ::::
// ::::::::::::::::::::::::::
var targ;
var previousTargID

function eHandler(e)
{
// Browser compatibility code
if (!e) var e = window.event;
if (e.target) targ = e.target;
else if (e.srcElement) targ = e.srcElement;
if (targ.nodeType == 3) // defeat Safari bug
	targ=targ.parentNode;

THElement=findTH(targ);

if(THElement!=null)
	{
	if(THElement.id!=previousTargID && oneBranch=='yes' )
		{hideALL();}
	if(handlerTYPE=='mouseover')
		{hideALL();}		
	previousTargID=THElement.id
	// Toggle ECState
	State=THElement.getAttribute("ECState");
		if(State==0){THElement.setAttribute("ECState",1);}
		else{THElement.setAttribute("ECState",0);}
	showSingle();
	}
else{hideALL();}
}

function findTH(t)
{
  if (t.tagName == "TH")
  	{return t;}
  else if
  	(t.tagName == "BODY")
  	{return null;}
  else
  {return findTH(t.parentNode);}
}