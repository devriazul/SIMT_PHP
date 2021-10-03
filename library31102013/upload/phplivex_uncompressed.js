/*
PHPLiveX, PHP / AJAX Library & Framework
Version 2.6, Released In 05.02.2010
Copyright (C) 2006-2010 Arda Beyazoglu
http://www.phplivex.com, arda@beyazoglu.com

This library is free software; you can redistribute it and/or
modify it under the terms of the GNU Lesser General Public
License as published by the Free Software Foundation; either
version 3 of the License, or any later version. See the GNU
Lesser General Public License for more details.
*/

// Creates the main configuration
function PHPLiveX(){
	this.Options = {
		type: "asynchronous",
		mode: "rw",
		target: null,
		preloader: null,
		method: "post",
		onCreate: function(){},
		onUninitialized: function(){},
		onLoading: function(){},
		onRequest: function(){},
		onInteraction: function(){},
		onFinish: function(){}, 
		onUpdate: function(){},
		onFailure: function(){},
		onTimeout: function(){},
		onPreload: {"start": function(){}, "complete": function(){}},
		interval: 0,
		id: null,
		clear_content: false,
		preloader_style: "visibility",
		target_attr: "innerContent",
		url: "",
		eval_scripts: true,
		content_type: "text",
		headers: {},
		params: null,
		caching: false,
		history: false,
		timeout: 30000
	};
	
	this.Timeout = null;
	this.CallType = "internal";
	
	if(navigator.appName == "Opera") this.Browser = "opera";
	else if(navigator.appName == "Microsoft Internet Explorer") this.Browser = "ie";
	else this.Browser = "gecko";
	
	this.XML_HTTP = this.GetXmlHttp();
};

// Validates user defined parameters
PHPLiveX.prototype.HandleParams = function(user_options){
	var errors = [];
	
	for(param in user_options){
		if(this.Options[param] == undefined && typeof(this.Options[param]) != "object"){
			errors.push("* Undefined parameter: " + param);
			continue;
		}
		this.Options[param] = user_options[param];
	}
	
	if(typeof(this.Options.target) == "string"){
		if(document.getElementById(this.Options.target)){
			this.Options.target = document.getElementById(this.Options.target);
		}else{
			errors.push("* Target not found with id=" + this.Options.target  + "!");
			this.Options.preloader = null;
		}
		if(this.Options.target_attr == "innerContent"){
			if(this.Options.target.type == "select-one" || this.Options.target.type == "select-multiple") this.Options.target_attr = "options";
			else if(this.Options.target == "[object HTMLInputElement]" || this.Options.target.type != undefined) this.Options.target_attr = "value";
			else this.Options.target_attr = "innerHTML";
		}
	}

	if(typeof(this.Options.preloader) == "string"){
		if(document.getElementById(this.Options.preloader)){
			this.Options.preloader = document.getElementById(this.Options.preloader);
		}else{
			errors.push("* Preloader not found with id=" + this.Options.preloader  + "!");
			this.Options.preloader = null;
		}
	}
	
	if(this.Options.url == "") this.Options.url = window.location.href;
	
	if(errors.length > 0){
		var warning = errors.join("\r\n");
		alert("PHPLiveX Error:\r\n" + warning);
	}
};

// Converts an xml string to xmldoc
PHPLiveX.prototype.CreateXML = function(txt){
	if(this.Browser == "ie"){
		try{
			xmlDoc = new ActiveXObject("Microsoft.XMLDOM");
			xmlDoc.async = false;
			xmlDoc.loadXML(txt);
			return xmlDoc; 
		}catch(e){}
	}else{
		try{
			parser = new DOMParser();
			xmlDoc = parser.parseFromString(txt, "text/xml");
			return xmlDoc;
		}catch(e){}
	}
	return false;
};

// Creates xmlhttp object
PHPLiveX.prototype.GetXmlHttp = function(){
	objXmlHttp = false;
	if(window.XMLHttpRequest){
		objXmlHttp = new XMLHttpRequest();
		if (objXmlHttp.overrideMimeType){
			objXmlHttp.overrideMimeType("text/xml");
		}
	}else if(window.ActiveXObject){
		try{
			objXmlHttp = new ActiveXObject("Msxml2.XMLHTTP");
		}catch(e){
			try{ objXmlHttp = new ActiveXObject("Microsoft.XMLHTTP"); }
			catch(e){}
		}
	}

	if (!objXmlHttp) {
		alert("Cannot create an XMLHTTP instance");
		return false;
	}

	return objXmlHttp;
};

// Initializes preloading
PHPLiveX.prototype.CreatePreloading = function(){
	if(this.Options.preloader != null){
		if(this.Options.preloader_style == "display") this.Options.preloader.style.display = "block";
		this.Options.preloader.style.visibility = "visible";
	}
	this.Options.onPreload.start();
	if(this.Options.clear_content) eval("this.Options.target." + this.Options.target_attr + " = '';");
};

// Ends preloading
PHPLiveX.prototype.CompletePreloading = function(){
	if(this.Options.preloader != null){
		if(this.Options.preloader_style == "display") this.Options.preloader.style.display = "none";
		this.Options.preloader.style.visibility = "hidden";
	}
	this.Options.onPreload.complete();
};

PHPLiveX.prototype.HandleResponse = function(response){
	if(this.Options.content_type == "json" && response != "") eval("response = " + response + ";");
	else if(this.Options.content_type == "xml" && response != "") response = this.CreateXML(response);
	
	if(this.Options.content_type == "text"){
		if(this.Options.eval_scripts) response = PLX.EvalScripts(response);
		response = PLX.EvalStyles(response);
		
		var test_integer = /^[\+\-]?\d*$/;
		if(response != "" && test_integer.test(response)) response = parseInt(response);
	}
	
	var go = this.Options.onFinish(response, this);
	
	if(this.Options.target != null && this.Options.content_type != "xml" && go != false){
		var item = this.Options.target;
		if((item.type == "select-one" || item.type == "select-multiple") &&  this.Options.target_attr == "options"){
			if(this.Options.mode == "rw"){
				lng = item.options.length;
				for(k=0; k<lng; k++) item.remove(0);
			}
			
			for(var i=0; i<response.length; i++){
				option = response[i];
				var opt = document.createElement("option");
				for(key in option){
					val = option[key];
					eval("opt." + key + " = val;");
				}
				
				if(this.Options.mode == "aw" || this.Options.mode == "rw"){
					if(this.Browser == "ie") item.add(opt);
					else item.add(opt, null);
				}else if(options.mode == "asw"){
					if(this.Browser == "ie") item.add(opt, 0);
					else item.add(opt, item.options[0]);
				}
			}
		}else{
			switch(this.Options.mode){
				case "aw": eval("item." +  this.Options.target_attr + " += response;"); break;
				case "rw": eval("item." +  this.Options.target_attr + " = response;"); break;
				case "asw": eval("item." +  this.Options.target_attr + " = response + item." +  this.Options.target_attr + ";"); break;
			}
		}
	}

	if(go != false) this.Options.onUpdate(response, this);
	this.CompletePreloading();
	
	if(this.Options.history && window.dhtmlHistory){
		this.AddToHistory();
	}
};

// Initiliazes the ajax request and handle the response
PHPLiveX.prototype.UtilizeResponse = function(funcName, funcArgs, funcUrl){
	if(typeof(funcName) == "object"){
		if(funcName.cls) funcName = funcName.cls + "::" + funcName.method;
		else if(funcName.obj) funcName = funcName.obj + "->" + funcName.method;
	}
	var data = (funcName) ? "plxf=" + escape(funcName) : "";
	var args = new Array();
	
	if(funcArgs.length > 0){
		if(funcName){
			for (i=0;i<funcArgs.length;i++) data += "&plxa[]=" + PLX.UTF8_Encode(funcArgs[i]);
		}else{
			for (i=0;i<funcArgs.length;i++){
				key = PLX.UTF8_Encode(funcArgs[i].split("~=~")[0]);
				val = PLX.UTF8_Encode(funcArgs[i].split("~=~")[1]);
				data += "&" + key + "=" + val;
			}
			data = data.substring(1);
		}
	}
	
	var asynchronous = (this.Options.type == "asynchronous") ? true : false;

	if(funcUrl.match("#")) funcUrl = funcUrl.split("#")[0];
	if(this.Options.method.toUpperCase() == "GET"){
		if(!this.Options.caching) data += "&RequestId=" + new Date().getTime();
		if(funcUrl.indexOf("?") != -1){
			data = (funcUrl.indexOf("&")) ? "&" + data : data;
			this.XML_HTTP.open("GET", funcUrl + "&" + data, asynchronous);
		}else{
			this.XML_HTTP.open("GET", funcUrl + "?" + data, asynchronous);
		}
	}else{
		this.XML_HTTP.open("POST", funcUrl, asynchronous);
	}
	
	if(this.Options.method.toUpperCase() == "POST"){
		this.XML_HTTP.setRequestHeader("Method", "POST " + funcUrl + " HTTP/1.1");
		this.XML_HTTP.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		this.XML_HTTP.setRequestHeader("Accept", "text/javascript, text/html, text/xml, application/xml, application/json, */*");
	}
	
	for(key in this.Options.headers){
		if(key == "toJSONString") continue;
		this.XML_HTTP.setRequestHeader(key, this.Options.headers[key]);
	}

	if(asynchronous){
		this.CreatePreloading();
		this.Options.onCreate(this.XML_HTTP);
		var _root = this;
		
		this.XML_HTTP.onreadystatechange = function(){
			if(this.readyState == 0){
				_root.Options.onUninitialized(_root);
			}else if(this.readyState == 1){
				_root.Options.onLoading(_root);
			}else if(this.readyState == 2){
				_root.Options.onRequest(_root);
			}else if(this.readyState == 3){
				_root.Options.onInteraction(_root);
			}else if(this.readyState == 4){
				clearTimeout(_root.Timeout);
				
				var response = this.responseText;
				if(_root.CallType == "internal"){
					if(response.indexOf("<phplivex>") != -1){
						var parts = response.split("<phplivex>");
						response = parts[parts.length-1].split("</phplivex>")[0];
					}else{
						response = "";
					}
				}
				
				_root.HandleResponse(response);
			}
		};
		
		(this.Options.method.toUpperCase() == "GET") ? this.XML_HTTP.send(null) : this.XML_HTTP.send(data);
		this.Timeout = setTimeout(function(){
			_root.XML_HTTP.abort();
			_root.Options.onTimeout();
			},
			this.Options.timeout
		);
		
	}else{
		(this.Options.method.toUpperCase() == "GET") ? this.XML_HTTP.send(null) : this.XML_HTTP.send(data);

		var response = this.XML_HTTP.responseText;
		if(response.indexOf("<phplivex>") != -1){
			var parts = response.split("<phplivex>");
			response = parts[parts.length-1].split("</phplivex>")[0];
		}

		if(this.Options.eval_scripts) response = PLX.EvalScripts(response);
		response = PLX.EvalStyles(response);
		
		var test_integer = /^[\+\-]?\d*$/;
		if(response != "" && test_integer.test(response)) response = parseInt(response);
		
		if(_root.Options.content_type == "json" && response != "") eval("response = " + response + ";");
		if(_root.Options.content_type == "xml" && response != "") response = _root.CreateXML(response);
		
		return response;
	}
};

// Client side callback for ajax requests
PHPLiveX.prototype.Callback = function(funcName, funcArgs){
	var params, realArgs = funcArgs;
	if(funcArgs.length != undefined){
		params = funcArgs[funcArgs.length - 1];
		if(!params.id) params.id = PLX.RandomString();
		realArgs[realArgs.length - 1] = params;
	}else{
		if(!funcArgs.id) realArgs.id = PLX.RandomString();
		params = realArgs;
	}
	this.HandleParams(params);
	
	if(this.Options.params && !funcName){
		var newArgs = [];
		for(pairKey in this.Options.params){
			value = this.Options.params[pairKey];
			if(typeof(value) == "object") value = PLX.Json2String(value);
			newArgs.push(pairKey + "~=~" + value);
		}
		funcArgs = newArgs.concat(funcArgs);
	}
	
	if(this.Options.history && window.dhtmlHistory) this.CreateMainHistory();
	
	var args = [];
	for(i=0;i<funcArgs.length-1;i++){
		if(typeof(funcArgs[i]) == "object"){
			args.push("<plxobj>" + PLX.Json2String(funcArgs[i]) + "</plxobj>");
		}else if(typeof(funcArgs[i]) == "boolean"){
			if(funcArgs[i] == false) args.push(0);
			else args.push(1);
		}else{
			if(String(funcArgs[i]).indexOf("+")) args.push(String(funcArgs[i]).replace("+", encodeURIComponent("+"), "g"));
			else args.push(funcArgs[i]);
		}
	}
	
	try{
		if(this.Options.type == "synchronous") return this.UtilizeResponse(funcName, args, this.Options.url);
		else this.UtilizeResponse(funcName, args, this.Options.url);
	}catch(ex){
		this.Options.onFailure(ex);
		return;
	};
	
	if(this.Options.interval > 0 && !PLX.Intervals[this.Options.id] && funcName){
		var initialArgs = []; // To convert js array to json array
		for(i=0; i<realArgs.length; i++) initialArgs[i] = realArgs[i];
		initialArgs = PLX.Json2String(initialArgs);
		
		if(typeof(funcName) == "object") funcName = PLX.Json2String(funcName);
		else if(typeof(funcName) == "string") funcName = "'" + funcName + "'";
		
		PLX.Intervals[this.Options.id] = setInterval("new PHPLiveX().Callback(" + funcName + ", " + initialArgs + ");", this.Options.interval);
	}
	return;
};

// Sends ajax request to an url
PHPLiveX.prototype.ExternalRequest = function(options){
	this.CallType = "external";
	
	if(!options.id) options.id = PLX.RandomString();
	var r = this.Callback(false, options);
	if(this.Options.interval > 0 && !PLX.Intervals[this.Options.id]){
		PLX.Intervals[this.Options.id] = setInterval("new PHPLiveX().Callback(false, " + PLX.Json2String(options) + ");", this.Options.interval);
	}
	return r;
};

// Submits an html form via ajax
PHPLiveX.prototype.SubmitForm = function(form, options){
	this.CallType = "external";
	
	if(typeof(form) == "string") form = document.getElementById(form) || document.forms[form];
	if(!form.id) form.id = PLX.RandomString();
	
	if(options == null) options = {};
	if(!options.id) options.id = PLX.RandomString();
	
	if(!options.url && form.action != ""){
		options.url = form.action;
	}else if(!options.url && form.action == ""){
		alert("Please define an action for form");
		return false;
	}
	
	if(!options.method){
		options.method = (form.method != "") ? form.method : "post";
	}
	
	var file_upload = false;
	var args = [];
	var fields = form.elements;
	for(i=0; i<fields.length; i++){
		if(fields[i].name == "" || fields[i].type == "submit" || fields[i].type == "button" || fields[i].type == "reset") continue;
		if((fields[i].type == "checkbox" || fields[i].type == "radio") && !fields[i].checked) continue;
		
		if(fields[i].type == "file"){
			file_upload = true;
			break;
		}else if(fields[i].type == "select-multiple"){
			opts = fields[i].options;
			lim = opts.length;
			for(k=0; k<lim; k++){
				if(opts[k].selected) args.push(fields[i].name + "~=~" + opts[k].text);
			}
		}else{
			args.push(fields[i].name + "~=~" + fields[i].value);
		}
	}
	
	if(file_upload){
		this.HandleParams(options);
		this.CreatePreloading();
		
		var iframe = document.getElementById("plx_iframe_" + form.id);
		if(!iframe){
			PLX.FormIframes[form.id] = this;
			var iframe = "<iframe onload=\"PLX.FormIframeLoaded(this, '" + form.id + "')\" id=\"plx_iframe_" + form.id + "\" name=\"plx_iframe_" + form.id + "\" style=\"border:0px;padding:0px;margin:0px;width:0px;height:0px;\"></iframe>";
			var div = document.createElement("div");
			div.setAttribute((this.Browser == "ie") ? "cssText" : "style", "border:0px;padding:0px;margin:0px;width:0px;height:0px;visibility:hidden;position:absolute;");
			div.innerHTML = iframe;
			document.body.appendChild(div);
			
			form.method = "post";
			form.target = "plx_iframe_" + form.id;
		}
		
		return true;
	}else{
		args.push(options);
		this.Callback(false, args);
		
		if(this.Options.interval > 0 && !PLX.Intervals[this.Options.id]){
			PLX.Intervals[this.Options.id] = setInterval("new PHPLiveX().SubmitForm('" + form.id + "', " + PLX.Json2String(options) + ");", this.Options.interval);
		}
		
		return false;
	}
};

// A shorthand for PHPLiveX class in some cases and contains some helper methods
var PLX = {	
	// Converts from json to string
	Json2String: function(obj){
		var type = (obj.length == undefined) ? "object" : "array";
		var values = [];
		for(key in obj){
			if(key == "toJSONString") continue;
			if(typeof(obj[key]) == "string"){
				if(type == "object") val = "\"" + key + "\": " + "\"" + obj[key] + "\"";
				else val = "\"" + obj[key] + "\"";
			}else if(typeof(obj[key]) == "object" && obj[key] != null){
				if(type == "object") val = "\"" + key + "\": " + PLX.Json2String(obj[key]);
				else val = PLX.Json2String(obj[key]);
			}else if(typeof(obj[key]) == undefined || obj[key] == null){
				if(type == "object") val = "\"" + key + "\": " + null;
				else val = null;
			}else{
				if(type == "object") val = "\"" + key + "\": " + obj[key];
				else val = obj[key];
			}
			values.push(val);
		}
		
		values = values.join(",");
		return (type == "object") ? "{" + values + "}" : "[" + values + "]";
	},
	
	// Array equivalent of indexOf method
	InArray: function(value, arr){
        for (i=0; i<arr.length; i++){
            if(arr[i] === value) return true;
        }
        return false;
    },
    
    // Copies a json object to another
    JoinObjects: function(obj1, obj2){
		var joint = obj1;
    	if(typeof(obj1) == "object" && typeof(obj2) == "object"){
			for(var key in obj2) joint[key] = obj2[key];
		}
		return joint;
    },
	
	// Returns a random code
	RandomString: function(len){
		if(len == null) len = 6;
		var chars = "ABCDEFGHIJKLMNOPQRSTUVWXTZabcdefghiklmnopqrstuvwxyz";
		var code = "";
		for (i=0; i<len; i++) {
			var rnum = Math.floor(Math.random() * chars.length);
			code += chars.substring(rnum, rnum + 1);
		}
		return code;
	},
	
	// Encodes the text as utf8
	UTF8_Encode: function(text){
		if(typeof(text) != "string") return escape(text);
		text = text.replace(/\r\n/g,"\n");
		var utftext = "";
		for (var n = 0; n < text.length; n++){
			var c = text.charCodeAt(n);
			if (c < 128) {
				utftext += String.fromCharCode(c);
			}else if((c > 127) && (c < 2048)){
				utftext += String.fromCharCode((c >> 6) | 192);
				utftext += String.fromCharCode((c & 63) | 128);
			}else{
				utftext += String.fromCharCode((c >> 12) | 224);
				utftext += String.fromCharCode(((c >> 6) & 63) | 128);
				utftext += String.fromCharCode((c & 63) | 128);
			}
		}
		return escape(utftext);
	},
	
	// Searchs for javascript codes in the text and appends them to the page
	EvalScripts: function(text){
		var jscode = "";
		var jsparts = text.match(/<script[^>]*>(.|\n|\t|\r)*?<\/script>/gi);
		if(jsparts){
			lng = jsparts.length;
			for(i=0;i<lng;i++){
				jscode += jsparts[i].replace(/<script[^>]*>|<\/script>/gi, "");
				text = text.replace(jsparts[i], "");
			}
			var script = document.createElement("script");
			script.type = "text/javascript";
			script.lang = "javascript";
			script.text = jscode;
			document.getElementsByTagName("head")[0].appendChild(script);
		}
		
		return text;
	},
	
	// Searchs for css codes in the text and appends them to the page
	EvalStyles: function(text){
		var styles = text.match(/<style[^>]*>(.|\n|\t|\r)*?<\/style>/gi);
		if(styles){
			var csscode = "";
			lng = styles.length;
			for(i=0;i<lng;i++){
				csscode += styles[i].replace(/<style[^>]*>|<\/style>/gi, "");
				text = text.replace(styles[i], "");
			}
			var stl = document.createElement("style");
			stl.type = "text/css";
			if(this.Browser == "ie") stl.styleSheet.cssText = csscode;
			else stl.innerHTML = csscode;
			document.getElementsByTagName("head")[0].appendChild(stl);
		}
		
		return text;
	},
	
	// Shorthand for PHPLiveX::ExternalRequest. Sends an ajax request to an url
	Request: function(options){
		new PHPLiveX().ExternalRequest(options);
	},
	
	// Shorthand for PHPLiveX::SubmitForm. Submits a form via ajax
	Submit: function(frm, options){
		return new PHPLiveX().SubmitForm(frm, options);
	},
	
	// Loads a javascript file to the page
	LoadJS: function(path, options){
		if(!options) options = {};
		var onFinish = (options.onFinish) ? options.onFinish : function(){};
		var params = PLX.JoinObjects(options, {
			url: path,
			onFinish: function(response){
				PLX.EvalScripts("<script type='text/javascript'>" + response + "</script>");
				onFinish(response);
			}
		});
	},
	
	// Loads a css file to the page
	LoadCSS: function(path, options){
		if(!options) options = {};
		var onFinish = (options.onFinish) ? options.onFinish : function(){};
		var params = PLX.JoinObjects(options, {
			url: path,
			onFinish: function(response){
				PLX.EvalStyles("<style type='text/css'>" + response + "</style>");
				onFinish(response);
			}
		});
		PLX.Request(params);
	},
	
	// Timeout variables used for repeated requests
	Intervals: {},
	
	// Clear the timeout and stop the request repetition
	Stop: function(id){
		if(PLX.Intervals[id] != undefined) clearInterval(PLX.Intervals[id]);
	},
	
	// Registered file uploads
	Uploads: {},
	
	// Error codes for file uploads
	SIZE_ERROR: "SIZE_ERROR",
	TYPE_ERROR: "TYPE_ERROR",
	TEMP_FILE_ERROR: "TEMP_FILE_ERROR",
	
	// Starts ajax file upload
	InitializeUpload: function(id){
		var value = PLX.Uploads[id].el.value.split(".");
		var ftype = value[value.length - 1];
		if((PLX.Uploads[id].allowed_types.length > 0 && !PLX.InArray(ftype, PLX.Uploads[id].allowed_types)) || PLX.InArray(ftype, PLX.Uploads[id].disallowed_types)){
			PLX.Uploads[id].onError(PLX.TYPE_ERROR);
			return;
		}
		
		document.getElementById("plx_form_" + PLX.Uploads[id].uid).submit();
		if(!PLX.Uploads[id].click_el) PLX.Uploads[id].el.disabled = true;
		
		PLX.Uploads[id].BeginUpload = function(){
			PLX.ProgressUpload(id, PLX.Uploads[id].uid, PLX.Uploads[id].tmp_dir, {
				id: PLX.Uploads[id].uid,
				interval: PLX.Uploads[id].interval,
				content_type: "json",
				onFinish: function(response, root){
					var id = response.id;
					if(response.error){
						PLX.StopUpload(id);
						PLX.Uploads[id].onError(response.error);
						return;
					}
					
					if(PLX.Uploads[id].uploaded.length == 2) PLX.Uploads[id].uploaded.shift();
					PLX.Uploads[id].uploaded.push(response.uploaded);
					var bytes_appended = PLX.Uploads[id].uploaded[1] - PLX.Uploads[id].uploaded[0];
					var speed = parseFloat(bytes_appended / (PLX.Uploads[id].interval / 1000));
					
					var progress = {
						total: response.total,
						uploaded: response.uploaded,
						percent: response.percent,
						speed: speed,
						id: id,
						completed: false
					};
					
					if(response.percent == 100){
						PLX.StopUpload(id);
						progress = PLX.JoinObjects(progress, {completed:true, file_tmp_name:response.file_tmp_name, file_name:response.file_name});
					}
					
					PLX.Uploads[id].onProgress(progress);
				}
			});
		};
		setTimeout("PLX.Uploads['" + id + "'].BeginUpload();", PLX.Uploads[id].interval);
	},
	
	// Callback for PHPLiveX::ProgressUpload method tracking the upload progress
	ProgressUpload: function(id, options){
		return new PHPLiveX().Callback({instance:"PLX", cls:"PHPLiveX", method:"ProgressUpload"}, PLX.ProgressUpload.arguments);
	},
	
	// Stops the upload process with specified id
	StopUpload: function(id){
		PLX.Stop(PLX.Uploads[id].uid);
		if(!PLX.Uploads[id].click_el) PLX.Uploads[id].el.disabled = false;
	},
	
	// Adjusts the elements for ajax upload
	AjaxifyUpload: function(elements, cfg){
		var config = {
			cgi_path: "upload.cgi", // the upload cgi script path (upload.cgi)
			tmp_dir: "tmp", // a temporary directory for upload operations (relative to upload.cgi)
			onProgress: function(){}, // a custom function to generate progress bars, upload speed etc. and upload the files
			onError: function(){}, // a custom function to handle possible errors
			interval: 2000, // a interval in milliseconds to control the upload process
			insensitivity: 0.10, // a sleep interval in seconds to read bytes in order !IMPORTANT
			max_size: 5242880, // allowed max file size
			allowed_types: [], // allowed file types
			disallowed_types: [], // disallowed file types
			click_el: false // true to use another element like button to begin upload. By default, it starts just after selecting a file
		};
		config = PLX.JoinObjects(config, cfg);
		
		if(typeof(elements) == "string" || (typeof(elements) == "object" && elements.length == undefined)) elements = [elements];
		for(var i=0; i<elements.length; i++){
			var el = (typeof(elements[i]) == "string") ? document.getElementById(elements[i]) : elements[i];
			var uid = new Date().getTime() + PLX.RandomString();
			PLX.Uploads[el.id] = PLX.JoinObjects({uploaded:[0], el:el, uid:uid}, config);
			
			try{
				var frm = document.createElement("<form enctype=\"multipart/form-data\">");
				var iframe = document.createElement("<iframe name=\"plx_iframe_" + uid + "\">");
			}catch(ex){
				var frm = document.createElement("form");
				frm.enctype = "multipart/form-data";
				var iframe = document.createElement("iframe");
				iframe.name = "plx_iframe_" + uid;
			};
			
			frm.id = "plx_form_" + uid;
			frm.name = frm.id;
			frm.style.background = "none";
			frm.style.padding = "0px";
			frm.style.margin = "0px";
			frm.style.border = "0px";
			frm.method = "POST";
			frm.target = "plx_iframe_" + uid;
			frm.action = config.cgi_path + "?uid=" + uid + "&max_size=" + config.max_size + "&insensitivity=" + config.insensitivity;
			
			iframe.style.border = "0px";
			iframe.style.padding = "0px";
			iframe.style.margin = "0px";
			iframe.style.visibility = "hidden";
			iframe.style.position = "absolute";
			iframe.style.height = "0px";
			iframe.style.width = "0px";
			
			el.parentNode.insertBefore(frm, el);
			frm.appendChild(el);
			frm.parentNode.insertBefore(iframe, frm.nextSibling);
			
			if(config.click_el) continue;
			el.onchange = function(){
				if(this.value == "") return;
				PLX.InitializeUpload(this.id);
			};
		}
	},
	
	// PHPLiveX object for each form including file upload
	FormIframes: {},
	
	// Get form response
	FormIframeLoaded: function(iframe, form_id){
		var response = iframe.contentWindow.document.body.innerHTML;
		PLX.FormIframes[form_id].HandleResponse(response, PLX.FormIframes[form_id]);
	}
};