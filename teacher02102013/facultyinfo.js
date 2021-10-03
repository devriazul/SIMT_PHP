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
	
		if(document.getElementById("fid").value==''){
		alert('Faculty Id can not be left empty.');
		 document.getElementById("fid").focus();
	     return false;
		 
	    }

		if(document.getElementById("pass").value==''){
		alert('Password can not be left empty.');
		 document.getElementById("pass").focus();
	     return false;
		 
	    }
		
		if(document.getElementById("name").value==''){
		alert('Name can not left empty');
		 document.getElementById("name").focus();
	     return false;
		 
	    }

		

		if(document.getElementById("sex").value==''){
		alert('Sex can not be left empty.');
		 document.getElementById("sex").focus();
	     return false;
		 
	    }

		if(document.getElementById("deptid").value=='Select Department'){
		alert('Department can not be left empty');
		 document.getElementById("deptid").focus();
	     return false;
		 
	    }

		if(document.getElementById("desigid").value=='Select Designation'){
		alert('Designation Name can not be left empty');
		 document.getElementById("desigid").focus();
	     return false;
		 
	    }

		if(document.getElementById("DPC_jdate_YYYY-MM-DD").value==''){
		alert('Joining Date can not be left empty');
		 document.getElementById("DPC_jdate_YYYY-MM-DD").focus();
	     return false;
		 
	    }

		if(document.getElementById("eduq").value==''){
		alert('Education Qualification can not be left empty');
		 document.getElementById("eduq").focus();
	     return false;
		 
	    }

		if(document.getElementById("eyear").value=='Select Year'){
		alert('Please select year.');
		 document.getElementById("eyear").focus();
	     return false;
		 
	    }

		if(document.getElementById("emonth").value=='Select Month'){
		alert('Please select month.');
		 document.getElementById("emonth").focus();
	     return false;
		 
	    }

		if(document.getElementById("contactno").value==''){
		alert('Contact No can not be left empty.');
		 document.getElementById("contactno").focus();
	     return false;
		 
	    }

		if(document.getElementById("payscaleid").value=='Select Payscale'){
		alert('Payscale can not be left empty.');
		 document.getElementById("payscaleid").focus();
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
    document.MyForm.reset();
    document.getElementById("fid").focus()
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

