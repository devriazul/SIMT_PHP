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

		if(document.getElementById("dtype").value=='Select Type'){
		alert('Marks Distribution Type can not left empty');
		 document.getElementById("dtype").focus();
	     return false;
		 
	    }

		if(document.getElementById("totalmarks").value==''){
		alert('Total Marks can not left empty');
		 document.getElementById("totalmarks").focus();
	     return false;
		 
	    }		


		/*if(document.getElementById("classtest").value==''){
		alert('Percentage of Class Test can not be left empty.');
		 document.getElementById("classtest").focus();
	     return false;
		 
	    }
		
		if(document.getElementById("homework").value==''){
		alert('Percentage of homework can not be left empty.');
		 document.getElementById("homework").focus();
	     return false;
		 
	    }

		if(document.getElementById("quiz").value==''){
		alert('Percentage of Quiz Test can not be left empty.');
		 document.getElementById("quiz").focus();
	     return false;
		 
	    }

		if(document.getElementById("behavior").value==''){
		alert('Percentage of Behavior can not be left empty.');
		 document.getElementById("behavior").focus();
	     return false;
		 
	    }

		if(document.getElementById("attendance").value==''){
		alert('Percentage of Attendance can not be left empty.');
		 document.getElementById("attendance").focus();
	     return false;
		 
	    }

		if(document.getElementById("je").value==''){
		alert('Percentage of job/experiment can not be left empty.');
		 document.getElementById("je").focus();
	     return false;
		 
	    }

		if(document.getElementById("jer").value==''){
		alert('Percentage of job/experiment report can not be left empty.');
		 document.getElementById("jer").focus();
	     return false;
		 
	    }

		if(document.getElementById("jev").value==''){
		alert('Percentage of job/experiment viva can not be left empty.');
		 document.getElementById("jev").focus();
	     return false;
		 
	    }
*/

	
		
		
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
    //document.MyForm.reset();
    document.getElementById("deptid").focus()
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

