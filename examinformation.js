// JavaScript Document
// JavaScript Document
// JavaScript Document
// JavaScript Document
//##################################################################################

//## FORM SUBMIT WITH AJAX                                                        ##

//## @Author: Simone Rodriguez aka Pukos <http://www.SimoneRodriguez.com>         ##

//## @Version: 1.2                                                                ##

//## @Released: 28/08/2007                                                        ##

//## @License: GNU/GPL v. 2 <http://www.gnu.org/copyleft/gpl.html>                ##

//##################################################################################





function xmlhttpPost(strURL,formname,responsediv,responsemsg) {

    var xmlHttpReq = false;

    var self = this;

    // Xhr per Mozilla/Safari/Ie7
	
		
		
		if(document.getElementById("deptid").value=='Select Department'){
		alert('Department can not left empty');
		 document.getElementById("deptid").focus();
	     return false;
		 
	    }

		if(document.getElementById("courseid").value=='Select Subject'){
		alert('Subject can not left empty');
		 document.getElementById("courseid").focus();
	     return false;
		 
	    }

		if(document.getElementById("semester").value=='Select Semester'){
		alert('Semester can not left empty');
		 document.getElementById("semester").focus();
	     return false;
		 
	    }

		if(document.getElementById("session").value=='Select Session'){
		alert('Session can not left empty');
		 document.getElementById("session").focus();
	     return false;
		 
	    }

		if(document.getElementById("examtype").value=='Select Examinition Type'){
		alert('Examinition Type can not left empty');
		 document.getElementById("examtype").focus();
	     return false;
		 
	    }

		if(document.getElementById("exammarksper").value==''){
		alert('Examinition Marks can not left empty');
		 document.getElementById("exammarksper").focus();
	     return false;
		 
	    }	

		if(document.getElementById("examname").value==''){
		alert('Examinition Name can not left empty');
		 document.getElementById("examname").focus();
	     return false;
		 
	    }
		
    if (window.XMLHttpRequest) {

        self.xmlHttpReq = new XMLHttpRequest();

    }

    // per tutte le altre versioni di IE

    else if (window.ActiveXObject) {

        self.xmlHttpReq = new ActiveXObject("Microsoft.XMLHTTP");

    }

    self.xmlHttpReq.open('POST', strURL, true);

    self.xmlHttpReq.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    self.xmlHttpReq.onreadystatechange = function() {

        if (self.xmlHttpReq.readyState == 4) {

			// Quando pronta, visualizzo la risposta del form

            updatepage(self.xmlHttpReq.responseText,responsediv);

        }

		else{

			// In attesa della risposta del form visualizzo il msg di attesa

			updatepage(responsemsg,responsediv);



		}

    }

    self.xmlHttpReq.send(getquerystring(formname));
    //window.location.reload();
	//document.MyForm.reset();

    document.getElementById("deptid").focus();
	}



function getquerystring(formname) {

    var form = document.forms[formname];

	var qstr = "";




    function GetElemValue(name, value) {

        qstr += (qstr.length > 0 ? "&" : "")

            + escape(name).replace(/\+/g, "%2B") + "="

            + escape(value ? value : "").replace(/\+/g, "%2B");

			//+ escape(value ? value : "").replace(/\n/g, "%0D");

    }

	

	var elemArray = form.elements;

    for (var i = 0; i < elemArray.length; i++) {

        var element = elemArray[i];

        var elemType = element.type.toUpperCase();

        var elemName = element.name;

        if (elemName) {

            if (elemType == "TEXT"

                    || elemType == "TEXTAREA"

                    || elemType == "PASSWORD"

					|| elemType == "BUTTON"

					|| elemType == "RESET"

					|| elemType == "SUBMIT"

					|| elemType == "FILE"

					|| elemType == "IMAGE"

                    || elemType == "HIDDEN")

                GetElemValue(elemName, element.value);

            else if (elemType == "CHECKBOX" && element.checked)

                GetElemValue(elemName, 

                    element.value ? element.value : "On");

            else if (elemType == "RADIO" && element.checked)

                GetElemValue(elemName, element.value);

            else if (elemType.indexOf("SELECT") != -1)

                for (var j = 0; j < element.options.length; j++) {

                    var option = element.options[j];

                    if (option.selected)

                        GetElemValue(elemName,

                            option.value ? option.value : option.text);

                }

        }

    }

    return qstr;

}

function updatepage(str,responsediv){

    document.getElementById(responsediv).innerHTML = str;


}

