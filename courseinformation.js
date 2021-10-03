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

		if(document.getElementById("code").value==''){
		alert('Course code can not left empty');
		 document.getElementById("code").focus();
	     return false;
		 
	    }
		if(document.getElementById("name12").value==''){
		alert('Course name can not left empty');
		 document.getElementById("name12").focus();
	     return false;
		 
	    }
		if(document.getElementById("department").value<1){
		alert('Department can not left empty');
		 document.getElementById("department").focus();
	     return false;
		 
	    }
		if(document.getElementById("credit").value==''){
		alert('Credit can not left empty');
		 document.getElementById("credit").focus();
	     return false;
		 
	    }
		if(document.getElementById("theory").value==''){
		alert('Theory can not left empty');
		 document.getElementById("theory").focus();
	     return false;
		 
	    }
		if(document.getElementById("parctical").value==''){
		alert('Parctical can not left empty');
		 document.getElementById("parctical").focus();
	     return false;
		 
	    }

    // Xhr per Mozilla/Safari/Ie7
	
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
    document.MyForm.reset();
    document.getElementById("code").focus();
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

