/**
 *  @fileoverview
 *  Ajax Javascript Library<br/>
 *  (c)2006 LAMATEK, Inc.<br/>
 *   @author Tom Cole tcole@lamatek.com
 *  @version 2.0
 */
 
/**
 * Factory class for handling multiple Ajax Requests. Allows you to create and
 * identify AjaxRequests via a user defined string.
 */
var AjaxFactory = function () {
	
	/**Array that stores all AjaxRequest objects */
	var requests = {};
	
	/**
	 * Creates a new request and adds it to the queue. 
	 */
	this.createRequest = function (id) {
		var request = new AjaxRequest();
		requests[id] = request;
		return request;
	}
	
	/**
	 * Attempts to return the value from the specified request id, if
	 * it exists.
	 */
	this.getRequest = function (id) {
		var request = requests[id];
		if (request) {
			return request;
		}
		else {
			return null;
		}
	}
	
	/**
	 * Removes a request from the queue.
	 */
	this.deleteRequest = function (id) {
		requests[id] = null;
	}
}

/**
 *  Cross-browser implementation to obtain and process a XMLHttpRequest instance.
 *  It removes the need to worry about cross-browser implementation issues and provides
 *  a simple, consistent interface to XMLHttpRequests. It also provides a simple API
 *  that automatically converts the response to the expected data type (text, xml
 *  or JSON) and gives a simple way to parse values from XML responses.
 */
var AjaxRequest  = function () {
	
	/**Current debugging status. */
	var debug = false;
	
	/**Handle to a loading display div.*/
	var async = true;
	
	/**The resulting value (either a String or DOM object based on request type.*/
	var value = null; 

	/**The resulting value as a String, regardless of request type.*/
	var valueString = null; 
	
	/**The XMLHttpRequest used to send & receive data.*/
	var xmlhttp = null; 
	
	/**The method that will get called on a successful request.*/
	var handler = null;
	
	/**Secondary handler used in autoSubmitAndLoad___Request methods. */
	var handler2 = null;
	
	/**Attempts to hold browser type. Only works after an AjaxRequest has been created.*/
	var browser = (navigator.appName.indexOf('Microsoft') >= 0);
	
	/**The text to display while requests are processing.*/
	var message = "Please wait...";
	
	/**Holds the last request type.*/
	var type = "text";	
	
	/**Holds the active parnt form element. Used in the submit___Request methods.*/
	var form;
	
	/**Denotes whether the user is providing style elements him/herself*/
	var isStyled = false;
	
	/**Denotes whether or not unique id generated is desired.*/
	var uniqueID = false;
	
	/**Denotes the timeout limit for requests.*/
	var timeout = null;
	
	/**Denotes the method to call if a timeout occurs.*/
	var timeouthandler = null;
	
	/**The timeout object. Kept as a reference so we can clear it if not needed.*/
	var timer = null;
	
	/**Denotes whether a request has been completed. Used by timeoutRequest.*/
	var completed = false;
	
	/**Denotes that the request was aborted.*/
	var aborted = false;
	
	/**Array of set request header values.*/
	var headers = new Array();
	
	/**Denotes that this request is cross domain.*/
	var crossDomain = false;
	
	/**Provides DOM based drag capabilities for the log window.
	 *  
	 * This script found at http://boring.youngpup.net/2001/domdrag.
	 */
	var Drag = {

		obj : null,
	
		init : function(o, oRoot, minX, maxX, minY, maxY, bSwapHorzRef, bSwapVertRef, fXMapper, fYMapper) {
			o.onmousedown	= Drag.start;
	
			o.hmode			= bSwapHorzRef ? true : false ;
			o.vmode			= bSwapVertRef ? false : true ;
	
			o.root = oRoot && oRoot != null ? oRoot : o ;
	
			if (o.hmode  && isNaN(parseInt(o.root.style.left  ))) o.root.style.left   = "0px";
			if (o.vmode  && isNaN(parseInt(o.root.style.top   ))) o.root.style.top    = "0px";
			if (!o.hmode && isNaN(parseInt(o.root.style.right ))) o.root.style.right  = "0px";
			if (!o.vmode && isNaN(parseInt(o.root.style.bottom))) o.root.style.bottom = "0px";
	
			o.minX	= typeof minX != 'undefined' ? minX : null;
			o.minY	= typeof minY != 'undefined' ? minY : null;
			o.maxX	= typeof maxX != 'undefined' ? maxX : null;
			o.maxY	= typeof maxY != 'undefined' ? maxY : null;
	
			o.xMapper = fXMapper ? fXMapper : null;
			o.yMapper = fYMapper ? fYMapper : null;
	
			o.root.onDragStart	= new Function();
			o.root.onDragEnd	= new Function();
			o.root.onDrag		= new Function();
		},
	
		start : function(e) {
			var o = Drag.obj = this;
			e = Drag.fixE(e);
			var y = parseInt(o.vmode ? o.root.style.top  : o.root.style.bottom);
			var x = parseInt(o.hmode ? o.root.style.left : o.root.style.right );
			o.root.onDragStart(x, y);
	
			o.lastMouseX	= e.clientX;
			o.lastMouseY	= e.clientY;
			
			if (o.hmode) {
				if (o.minX != null)	o.minMouseX	= e.clientX - x + o.minX;
				if (o.maxX != null)	o.maxMouseX	= o.minMouseX + o.maxX - o.minX;
			} else {
				if (o.minX != null) o.maxMouseX = -o.minX + e.clientX + x;
				if (o.maxX != null) o.minMouseX = -o.maxX + e.clientX + x;
			}
	
			if (o.vmode) {
				if (o.minY != null)	o.minMouseY	= e.clientY - y + o.minY;
				if (o.maxY != null)	o.maxMouseY	= o.minMouseY + o.maxY - o.minY;
			} else {
				if (o.minY != null) o.maxMouseY = -o.minY + e.clientY + y;
				if (o.maxY != null) o.minMouseY = -o.maxY + e.clientY + y;
			}
			
			document.onmousemove	= Drag.drag;
			document.onmouseup		= Drag.end;
	
			return false;
		},
	
		drag : function(e) {
			e = Drag.fixE(e);
			var o = Drag.obj;
	
			var ey	= e.clientY;
			var ex	= e.clientX;
			var y = parseInt(o.vmode ? o.root.style.top  : o.root.style.bottom);
			var x = parseInt(o.hmode ? o.root.style.left : o.root.style.right );
			var nx, ny;
	
			if (o.minX != null) ex = o.hmode ? Math.max(ex, o.minMouseX) : Math.min(ex, o.maxMouseX);
			if (o.maxX != null) ex = o.hmode ? Math.min(ex, o.maxMouseX) : Math.max(ex, o.minMouseX);
			if (o.minY != null) ey = o.vmode ? Math.max(ey, o.minMouseY) : Math.min(ey, o.maxMouseY);
			if (o.maxY != null) ey = o.vmode ? Math.min(ey, o.maxMouseY) : Math.max(ey, o.minMouseY);
	
			nx = x + ((ex - o.lastMouseX) * (o.hmode ? 1 : -1));
			ny = y + ((ey - o.lastMouseY) * (o.vmode ? 1 : -1));
	
			if (o.xMapper)		nx = o.xMapper(y)
			else if (o.yMapper)	ny = o.yMapper(x)
	
			Drag.obj.root.style[o.hmode ? "left" : "right"] = nx + "px";
			Drag.obj.root.style[o.vmode ? "top" : "bottom"] = ny + "px";
			Drag.obj.lastMouseX	= ex;
			Drag.obj.lastMouseY	= ey;
	
			Drag.obj.root.onDrag(nx, ny);
			return false;
		},
	
		end : function() {
			document.onmousemove = null;
			document.onmouseup   = null;
			Drag.obj.root.onDragEnd(	parseInt(Drag.obj.root.style[Drag.obj.hmode ? "left" : "right"]), 
										parseInt(Drag.obj.root.style[Drag.obj.vmode ? "top" : "bottom"]));
			Drag.obj = null;
		},
	
		fixE : function(e){
			if (typeof e == 'undefined') e = window.event;
			if (typeof e.layerX == 'undefined') e.layerX = e.offsetX;
			if (typeof e.layerY == 'undefined') e.layerY = e.offsetY;
			return e;
		}
	};
	
	/**
	 * This internal method resets the completed and aborted status for the next request
	 * and setups the client callback handler.
	 * @param {Function} method The end-user defined method that will be called upon successful completion of the request.
	 */
	var generateRequest = function (method) {
		complete = false;
		aborted = false;
		log("----Registering client callback method...",0);
		handler = method;
		xmlhttp = getRequest();
		if (xmlhttp) {
	  		xmlhttp.onreadystatechange = parseResponse;
	  	}
	}
	
	/**
	 * This internal method is a cross-browser implementation to obtain an 
	 * XMLHttpRequest object.
	 * @type XMLHttpRequest
	 */
	var getRequest = function () {
	    var xml;
	    /*@cc_on
	    @if (@_jscript_version >= 5) 
	        try {
	          xml = new ActiveXObject("Msxml2.XMLHTTP");
	          browser = true;
	        } 
	        catch (e) {
	          try {
	            xml = new ActiveXObject("Microsoft.XMLHTTP");
	            browser = true;
	          } 
	          catch (E) {
	            xml = false;
	          }
	        }
	    @else
	        xml = false;
	    @end @*/
	    if (!xml && typeof XMLHttpRequest != 'undefined') {
	        try {
	          xml = new XMLHttpRequest();
	          browser = false;
	        } 
	        catch (e) {
	          xml = false;
	          browser = false;
	        }
	    }
	    if (! xml) {
	    	this.log("------Unable to create XmlHTTPRequest.", 3);
	    }
	    return xml;
	}
	
	/**
	 * This internal method reads the text response from the xmlhttp request, attempts to create 
	 * the appropriate data type out of it (based on the type) and calls the registered handler method.
	 */
	var parseResponse = function () {
		headers = new Array(); //reset headers so they aren't used on subsequent calls.
		if (xmlhttp && !aborted) {
			if (xmlhttp.readyState == 4) {
				clearTimeout(timer);
				completed = true;
				log("------XmlHTTPRequest readystate is OK...");
		       	if (xmlhttp.status == 200) {
		       		valueString = xmlhttp.responseText;
		       		log("------XmlHTTPRequest status is OK...");
		       		log("");
		       		log("------Response received:<br/><blockquote><pre>" + valueString.replace(/</g, "&lt;").replace(/>/g, "&gt;") + "</pre></blockquote>",1);
		       		try {
		       			switch (type) {
		       				case 'json':
		       					value = eval('(' + xmlhttp.responseText + ')');
		       					break;
		       				case 'xml':
		       					value = xmlhttp.responseXML;
		       					break;
		       				default:
		       					value = xmlhttp.responseText;
		       			}
				    }
				    catch(e) {
				    	log("------Error occurred assigning response to value: " + e.message + "...", 3);
				    	value = null
				    }
				    if (handler) {
				    	if (! form && ! handler2)
							log("Forwarding control to client handler:<br/><blockquote><pre>" + handler.toString().replace(/</g, "&lt;").replace(/>/g, "&gt;") + "</pre></blockquote>", 1);
				    	handler.call(this);  	
				    }
		       	}
		       	else {
		       		log("------XmlHTTPRequest status returned " + xmlhttp.status + "...", 3);
		       		value = null;
		       	}
		       	if (document.getElementById('loadingDiv')) {
					document.body.removeChild(document.getElementById('loadingDiv'));
				}
				delete xmlhttp.onreadystatechange;
		    }
		    else {
		    	log("------XmlHTTPRequest readystate is " + xmlhttp.readyState + "...", 2);
		    }
		}
	}
	
	/**
	 * This internal method generates and sends the XMLHttpRequest.
	 * @param url The relative or absolute url of the server side resource receiving the request
	 * @param method The request method to use (GET, POST or HEAD)
	 * @param parameters The parameter list to send to the server (name=value&name2=value...)
	 * @param callback The javascript method to call upon a successful response
	 * @param asynchronous True or false
	 * @param responseType The expected server response data-type "text", "xml" or "json"
	 */
	var initiateRequest = function (url, method, parameters, callback, asynchronous, responseType) {
		type = responseType;
		if (url) {
			var defMethod = "GET";
			if (method) {
				defMethod = method;
			}
			defMethod = defMethod.toUpperCase();
			if (uniqueID) {
				var uid = (new Date()).getTime();
				if (parameters) {
					parameters += "&uniqueid=" + uid;
				}
				else {
					parameters = "uniqueid=" + uid;
				}
			}
			if (defMethod == "GET") {
				url += "?" + parameters;
				parameters = null;
			}
			log("--Request method set to " + defMethod + "...");
			async = true;
			if (! asynchronous) {
				async = asynchronous;
			}
			log("--Request set to asynchronous: " + async + "...");
			showLoadingDiv();
			generateRequest(callback);
			xmlhttp.open(defMethod, url, async);
			if (parameters) {
				xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
				for (var i = 0; i < headers.length; i++) {
					xmlhttp.setRequestHeader(headers[i].name, headers[i].value);
					alert("Set " + headers[i].name + " to " + headers[i].value);
				}
			}
			else {
				parameters = null;
			}
			for (var i = 0; i < headers.length; i++) {
				xmlhttp.setRequestHeader(headers[i].name, headers[i].value);
			}
			log("--Sending request...");
			if (timeout) {
				timer = setTimeout(doTimeout, timeout);
			}
			completed = false;
			xmlhttp.send(parameters);
		}
		else {
			log("--Request URL is not set. Unable to process request.", 3);
		}
	}
	
	/**
	 * This internal method is called once the user set timeout limit is hit.
	 * If the request has not completed, it attempts to abort the request.
	 */
	var doTimeout = function () {
		if (xmlhttp && (! completed)) {
			log("--Request has hit timeout limit. Aborting request.", 2);
			aborted = true;
			xmlhttp.abort();
			if (timeouthandler) {
				log("--Calling client timeout handler.");
				timeouthandler.call(this);
			}
			completed = true;
			if (document.getElementById('loadingDiv')) {
				document.body.removeChild(document.getElementById('loadingDiv'));
			}
			xmlhttp = null;
		}
	}
	
	/**
	 * This internal method creates a floating window (if necessary) and adds a 
	 * message ine to the log.
	 * @param message A message to add to the log window.
	 */
	var log = function (message, severity) {
		if (debug) {
			var bg = "#ffffff";
			if (severity) {
				switch (severity) {
					case 3:
						bg = "#ff0000";
						break;
					case 2:
						bg = "#ffb500";
						break;
					case 1:
						bg = "#ffff00";
						break;
					default:
						bg = "#ffffff";
				}
			}
			if (! document.getElementById("loggerDiv")) {
				var logger = document.createElement("div");
				logger.id = "loggerDiv";
				if (browser) {
					logger.style.position = "absolute";
				}
				else {
					logger.style.position = "fixed";
				}
				logger.style.top = "25px";
				logger.style.right = "25px";
				logger.style.display = "inline";
				logger.style.width = "400";
				logger.style.height = "400";
				logger.style.border = "1px solid #000000";
				logger.style.background = "#cccccc";
				var loggerBar = document.createElement("div");
				loggerBar.id = "loggerBar";
				loggerBar.style.height = 22;
				loggerBar.style.textAlign = "right";
				loggerBar.innerHTML = "<span width=\"100%\"><input type=\"button\" value=\"Clear\" onclick=\"document.getElementById('loggerStatusDetails').removeChild(document.getElementById('loggingDetailLines'));\"/><input type=\"button\" value=\"X\" onclick=\"document.body.removeChild(document.getElementById('loggerDiv'));\"/></span>";
				logger.appendChild(loggerBar);
				var loggerStatus = document.createElement("div");
				loggerStatus.style.overflow = "auto";
				loggerStatus.id = "loggerStatusDetails";
				loggerStatus.style.background = "#ffffff";
				loggerStatus.style.width = "100%";
				loggerStatus.style.height = 378;
				logger.appendChild(loggerStatus);
				document.body.insertBefore(logger, document.body.firstChild);
			}
			if (! document.getElementById('loggingDetailLines')) {
				var loggerDiv = document.getElementById("loggerStatusDetails");
				var loggingDiv = document.createElement("div");
				loggingDiv.id = "loggingDetailLines";
				loggerDiv.appendChild(loggingDiv);
			}
			var loggingDiv = document.getElementById('loggingDetailLines');
			var logLine = document.createElement("div");
			logLine.style.borderTop = "1px solid #cccccc";
			logLine.innerHTML = message;
			logLine.style.background = bg;
		    loggingDiv.appendChild(logLine);
		    Drag.init(document.getElementById('loggerBar'), document.getElementById('loggerDiv'));
		}
	}
	
	/**
	 * This internal method displays a "loading" div message for asynchronous requests.
	 */
	var showLoadingDiv = function () {
		if (message) {
			if (! document.getElementById('loadingDiv')) {
				var loading = document.createElement("div");
				loading.id = 'loadingDiv';
				loading.innerHTML = message;
				if (browser) {
					loading.style.position = 'absolute';
				}
				else {
					loading.style.position = 'fixed';
				}
				if (! isStyled) {
					loading.style.background = '#cc0000';
					loading.style.color = '#ffffff';
					loading.style.top = 2;
					loading.style.right = 2;
					loading.style.paddingLeft = 5;
					loading.style.paddingRight = 5;
					loading.style.fontFamily = "Arial";
					loading.style.fontSize = "12";
				}
				loading.className = 'loading';
				document.body.appendChild(loading);
			}
		}
	}
	
	/**
	 * This internal method automatically builds the parameter list from any form elements inside the given
	 * form node as if submitted by the given submitBy element. This method does not work for multipart/form-data enctypes.
	 * @param {String} form The id of the form node to submit.
	 * @param {Object} submitBy The element that is submitting the form.
	 * @type {String} returns a parameter list for the specified form submitted by the specified submittor.
	 */
	var getFormData = function (form, submitBy) {
		try {
			var parameters = "";
			for (var i = 0; i < form.getElementsByTagName('input').length; i++) {
				var element = form.getElementsByTagName('input')[i];
				var name = null;
				if (element.name)
					name = element.name;
				else if (element.id) 
					name = element.id;
				if (name) {
					switch (element.type) {
						case 'check':
							if (element.checked) 
								parameters += name + "=" + element.value + "&";
							else
								parameters += name + "=&";
							break;
						case 'radio':
							if (element.checked)
								parameters += name + "=" + element.value + "&";
							break;
						case 'submit': //ignore these, handled by submitBy
							break;
						case 'button': //ignore these, handled by submitBy
							break;
						default:
							parameters += name + "=" + element.value + "&";
					}
				}
			}
			for (var i = 0; i < form.getElementsByTagName('select').length; i++) {
				var element = form.getElementsByTagName('select')[i];
				var name = null;
				if (element.name)
					name = element.name;
				else if (element.id) 
					name = element.id;
				if (name) {
					if (element.type == 'select-one') {
						parameters += name + "=" + element.options[element.selectedIndex].value + "&";
					}
					else if (element.type == 'select-multiple') {
						for (var j = 0; j < element.options.length; j++) {
							if (element.options[j].selected) 
								parameters += name + "=" + element.options[j].value + "&";
						}
					}
				}
			}
			for (var i = 0; i < form.getElementsByTagName('textarea').length; i++) {
				var element = form.getElementsByTagName('textarea')[i];
				var name = null;
				if (element.name)
					name = element.name;
				else if (element.id) 
					name = element.id;
				if (name) {
					parameters += name + "=" + element.value + "&";
				}
			}
			if (submitBy) {
				var name = null;
				if (submitBy.name)
					name = submitBy.name;
				else if (submitBy.id) 
					name = submitBy.id;
				if (name) {
					parameters += name + "=" + submitBy.value;	
				}
			}
			return parameters;
		}
		catch(e) {
			return null;
		}
	}
	
	var setElement = function (element, rValue) {
		switch(element.tagName) {
			case 'INPUT':
				switch(element.typeName) {
					case 'check': case 'radio':
						if (element.value == rValue) {
							element.checked = true;
						}
						break;
					default:
						try {
							element.value = rValue;
						}
						catch(e) {
							log("Error attempting to assign value to element " + rName + ". Skipping it.", 1);
						}
				}
				break;
			case 'TEXTAREA':
				element.innerHTML = rValue;
				break;
			case 'SELECT':
				for (var j = 0; j < element.options.length; j++) {
					if (element.options[j].value == rValue) {
						element.options[j].selected = true;
						break;
					}
				}
				break;
			default:
				try {
					element.innerHTML = rValue;
				}
				catch(e) {
					log("Error assigning value to unidentified element " + rName + ". Skipping it.", 1);
				}
		}
	}
	
	/**
	 * This internal method takes the current value object as a CSV string and parses 
	 * through it for all names. It attempts to find screen elements with id's that 
	 * match each name, and if it finds one, sets it's value to that name's value.
	 */
	var populateFormFromText = function () {
		try {
			if (form) {
				for (var i = 0; i < value.split(',').length; i++) {
					var child = value.split(',')[i];
					try {
						var rName = child.split("=")[0];
						var rValue = child.split("=")[1] || '';
						var element = document.getElementById(rName);
						if (element) {
							setElement(element, rValue);
						}
						else {
							element = document.getElementsByName(rName);
							if (element) {
								for (var j = 0; j < element.length; j++) {
									setElement(element[j], rValue);
								}
							}
						}
					}
					catch(e) {
						
					}
				}
			}
			else {
				log("Error attempting to populate form. The current form is null.", 3);
			}
		}
		catch(e) {
			log("An error occured attempting to populate the form.<blockquote><pre>" + e.message + "</pre></blockquote>", 3);
		}
		if (handler2) {
			log("Forwarding control to client handler:<br/><blockquote><pre>" + handler2.toString().replace(/</g, "&lt;").replace(/>/g, "&gt;") + "</pre></blockquote>", 1);
			handler2.call();
		}
	}
	
	/**
	 * This internal method takes the current value object as JSON and parses through 
	 * the values array..
	 * It attempts to find screen elements with id's that match each "name", and if
	 * it finds one, sets it's value to "value".
	 */
	var populateFormFromJSON = function () {
		try {
			if (form) {
				var root = value;
				for (var i = 0; i < root.values.length; i++) {
					var rName = root.values[i].name;
					var rValue = root.values[i].value;
					var element = document.getElementById(rName);
					if (element) {
						setElement(element, rValue);
					}
					else {
						element = document.getElementsByName(rName);
						if (element) {
							for (var j = 0; j < element.length; j++) {
								setElement(element[j], rValue);
							}
						}
					}
				}
			}
			else {
				log("Error attempting to populate form. The current form is null.", 3);
			}
		}
		catch(e) {
			log("An error occured attempting to populate the form.<blockquote><pre>" + e.message + "</pre></blockquote>", 3);
		}
		if (handler2) {
			log("Forwarding control to client handler:<br/><blockquote><pre>" + handler2.toString().replace(/</g, "&lt;").replace(/>/g, "&gt;") + "</pre></blockquote>", 1);
			handler2.call();
		}
	}
	
	/**
	 * This internal method takes the current value object as XML and parses through 
	 * it for all nodes. It attempts to find screen elements with id's that match 
	 * each nodeName, and if it finds one, sets it's value to that node's value.
	 */
	var populateFormFromXML = function () {
		try {
			if (form) {
				var root = value.documentElement;
				for (var i = 0; i < root.childNodes.length; i++) {
					var child = root.childNodes[i];
					var rName = child.nodeName;
					var rValue = child.firstChild.data;
					var element = document.getElementById(rName);
					if (element) {
						setElement(element, rValue);
					}
					else {
						element = document.getElementsByName(rName);
						if (element) {
							for (var j = 0; j < element.length; j++) {
								setElement(element[j], rValue);
							}
						}
					}
				}
			}
			else {
				log("Error attempting to populate form. The current form is null.", 3);
			}
		}
		catch(e) {
			log("An error occured attempting to populate the form.<blockquote><pre>" + e.message + "</pre></blockquote>", 3);
		}
		if (handler2) {
			log("Forwarding control to client handler:<br/><blockquote><pre>" + handler2.toString().replace(/</g, "&lt;").replace(/>/g, "&gt;") + "</pre></blockquote>", 1);
			handler2.call();
		}
	}
	
	/**
	 *This public method makes a JSON request, reads the response and attempts
	 * to load any document elements with the given values. It assumes that the
	 * response will be a valid JSON string in the given format:
	 * 
	 * { values [
	 * 		{"name": "name1", "value": "value1},
	 * 		{"name": "name1", "value": "value1}
	 * ] }
	 * 
	 * Where any element with an id or name of 'name1' will be assigned the value (or innerHTML)
	 * of 'value1'.
	 */
	this.autoSubmitAndLoadJSONRequest = function (element, callback) {
		handler2 = callback;
		this.submitJSONRequest(element, populateFormFromJSON, true);
	}
	
	/**
	 * This public method initiates a request that is expected to return
	 * a JSON text string that is to be converted into a JSON object. Parameter data,
	 * url and call method are retrieved from the given form object.
	 * The resulting object will be stored in the value variable and
	 * can be retrieved using getValue();
	 * @param {String} form The form DOM object fro which to pull form data. (REQUIRED)
	 * @param {Object} submitBy The element that is initiating the form submission. (OPTIONAL)
	 * @param {Function} callback The end-user defined method that will be called upon successful completion of the request. Default is null. (OPTIONAL)
	 * @param {Boolean} asynchronous. Set to true if the request is to be asynchronous, false if not. Default is true. (OPTIONAL)
	 */
	this.submitJSONRequest = function (element, callback, asynchronous) {
		try {
			form = element;
			while (! (form.tagName == 'FORM')) {
				form = form.parentNode;
			}
			if (form) {
				this.doJSONRequest(form.action, form.method || "GET", getFormData(form, element), callback, asynchronous);
			}
			else {
				log("Error processing Ajax form submission. Form " + form + " is not valid");
			}
		}
		catch(e) {
			log("Error generating Ajax request in submitJSONRequest. " + e.message);
		}
	}
	
	/**
	 * This public method initiates a request that is expected to return
	 * a JSON text string that is to be converted into a JSON object. 
	 * The resulting object will be stored in the value variable and
	 * can be retrieved using getValue();
	 * @param {String} url The url to the server resource that will handle the request. (REQUIRED)
	 * @param {String} method The HTTP method to send the request. Must be "GET" or "POST". Default is "GET" (OPTIONAL)
	 * @param {String} parameters A url formatted list of parameter names and values. Parameters are specified as name=value&name=value.... Default is null. (OPTIONAL)
	 * @param {Function} callback The end-user defined method that will be called upon successful completion of the request. Default is null. (OPTIONAL)
	 * @param {Boolean} asynchronous. Set to true if the request is to be asynchronous, false if not. Default is true. (OPTIONAL)
	 */
	this.doJSONRequest = function (url, method, parameters, callback, asynchronous) {
		log("Beginning new JSON request...");
		initiateRequest(url, method, parameters, callback, asynchronous, "json");
	}
	
	/**
	 *This public method makes an XML request, reads the response and attempts
	 * to load any document elements with the given values. It assumes that the
	 * response will be a valid XML document in the given format:
	 * 
	 * <?xml version="1.0" encoding="UTF-8" ?>
	 *	<documentElement>
	 * 		<name>value<name>
	 * 		<name2>value2</name2>
	 * 		...
	 *	</documentElement>
	 * 
	 * Where any element with an id or name of 'name' will be assigned the value (or innerHTML)
	 * of 'value'.
	 */
	this.autoSubmitAndLoadXMLRequest = function (element, callback) {
		handler2 = callback;
		this.submitXMLRequest(element, populateFormFromXML, true);
	}
	
	/**
	 * This public method initiates a request that is expected to return
	 * an XML text string that is to be converted into a XML DOM object. Parameter data,
	 * url and call method are retrieved from the given form object.
	 * The resulting object will be stored in the value variable and
	 * can be retrieved using getValue();
	 * @param {Object} form The form DOM object fro which to pull form data. (REQUIRED)
	 * @param {Object} submitBy The element that is initiating the form submission. (OPTIONAL)
	 * @param {Function} callback The end-user defined method that will be called upon successful completion of the request. Default is null. (OPTIONAL)
	 * @param {Boolean} asynchronous. Set to true if the request is to be asynchronous, false if not. Default is true. (OPTIONAL)
	 */
	this.submitXMLRequest = function (element, callback, asynchronous) {
		try {
			form = element;
			while (! (form.tagName == 'FORM')) {
				form = form.parentNode;
			}
			if (form) {
				this.doXMLRequest(form.action, form.method || "GET", getFormData(form, element), callback, asynchronous);
			}
			else {
				log("Error processing Ajax form submission. Form " + form + " is not valid");
			}
		}
		catch(e) {
			log("Error generating Ajax request in submitXMLRequest. " + e.message);
		}
	}
	
	/**
	 * This public method initiates a request that is expected to return
	 * an XML document. The resulting DOM object will be stored in the value variable and
	 * can be retrieved using getValue();
	 * @param {String} url The url to the server resource that will handle the request. (REQUIRED)
	 * @param {String} method The HTTP method to send the request. Must be "GET" or "POST". Default is "GET" (OPTIONAL)
	 * @param {String} parameters A url formatted list of parameter names and values. Parameters are specified as name=value&name=value.... Default is null. (OPTIONAL)
	 * @param {Function} callback The end-user defined method that will be called upon successful completion of the request. Default is null. (OPTIONAL)
	 * @param {Boolean} asynchronous. Set to true if the request is to be asynchronous, false if not. Default is true. (OPTIONAL)
	 */
	this.doXMLRequest = function (url, method, parameters, callback, asynchronous) {
		log("Beginning new XML request...");
		initiateRequest(url, method, parameters, callback, asynchronous, "xml");
	}
	
	/**
	 *This public method makes a text request, reads the response and attempts
	 * to load any document elements with the given values. It assumes that the
	 * response will be a valid CSV string in the given format:
	 * 
	 * name=value,name1=value1,name2=value2,name3=value3...
	 * 
	 * Where any element with an id or name of 'name' will be assigned the value (or innerHTML)
	 * of 'value'.
	 */
	this.autoSubmitAndLoadTextRequest = function (element, callback) {
		handler2 = callback;
		this.submitTextRequest(element, populateFormFromText, true);
	}
	
	/**
	 * This public method initiates a request that is expected to return
	 * a text string or an XML/JSON request where the response should not be converted
	 * into an object. Parameter data,
	 * url and call method are retrieved from the given form object.
	 * The resulting object will be stored in the value variable and
	 * can be retrieved using getValue();
	 * @param {Object} form The form DOM object fro which to pull form data. (REQUIRED)
	 * @param {Object} submitBy The element that is initiating the form submission. (OPTIONAL)
	 * @param {Function} callback The end-user defined method that will be called upon successful completion of the request. Default is null. (OPTIONAL)
	 * @param {Boolean} asynchronous. Set to true if the request is to be asynchronous, false if not. Default is true. (OPTIONAL)
	 */
	this.submitTextRequest = function (element, callback, asynchronous) {
		try {
			form = element;
			while (! (form.tagName == 'FORM')) {
				form = form.parentNode;
			}
			if (form) {
				this.doTextRequest(form.action, form.method || "GET", getFormData(form, element), callback, asynchronous);
			}
			else {
				log("Error processing Ajax form submission. Form " + form + " is not valid");
			}
		}
		catch(e) {
			log("Error generating Ajax request in submitTextRequest. " + e.message);
		}
	}
	
	/**
	 * This public method initiates a request that is expected to return
	 * a text string OR a request that returns an XML document that is desired as a string, 
	 * rather than a DOM object. The resulting string will be stored in the value variable and
	 * can be retrieved using getValue();
	 * @param {String} url The url to the server resource that will handle the request. (REQUIRED)
	 * @param {String} method The HTTP method to send the request. Must be "GET" or "POST". Default is "GET" (OPTIONAL)
	 * @param {String} parameters A url formatted list of parameter names and values. Parameters are specified as name=value&name=value.... Default is null. (OPTIONAL)
	 * @param {Function} callback The end-user defined method that will be called upon successful completion of the request. Default is null. (OPTIONAL)
	 * @param {Boolean} asynchronous. Set to true if the request is to be asynchronous, false if not. Default is true. (OPTIONAL)
	 */
	this.doTextRequest = function (url, method, parameters, callback, asynchronous) {
		log("Beginning new Text request...");
		initiateRequest(url, method, parameters, callback, asynchronous, "text");
	}
	
	/**
	 * Public method that returns the value returned by the request.
	 * Returns - a String or XML DOM Object or Javascript Object 
	 * based on the type of request made.
	 * @type Variant
	 */
	this.getValue = function () {
		return value;
	}
	
	/**
	 * Public function that returns the value returned by the request as
	 * a String, regardless of the type of request made.
	 * Returns - a String that contains the server response.
	 * @type String
	 */
	this.getValueAsString = function () {
		return valueString;
	}
	
	/**
	 * Public function that transforms the current XML DOM value
	 * based on the XSL file specified in the url, and places it's contents in
	 * the suggested DOM element.
	 * Returns - a transformed XML string or null if the XSL could not be found.
	 * @param {String} url The url of the XSL document to use for transformation.
	 * @type XML DOM Object
	 */
	this.transformValueInto = function (url, element) {
		if (type == "xml") {
			if (value && url && element) {
				if (typeof XSLTProcessor != 'undefined') {
					var processor = new XSLTProcessor();
					var request = getRequest();
					if (request) {
						request.open("GET", url, false);
						request.send(null);
						var xsl = request.responseXML;
						processor.importStylesheet(xsl);
						var fragment = processor.transformToFragment(value, document);
						if (element)
							element.appendChild(fragment);
					}
					else {
						return;
					}
				}
				else {
					var stylesheet = new ActiveXObject("Msxml2.DOMDocument.3.0");
					if (stylesheet) {
						stylesheet.async = false;
						stylesheet.load(url);
						var results = new ActiveXObject("Msxml2.DOMDocument.3.0");
						results.async = false;
						results.validateOnParse = true;
						value.transformNodeToObject(stylesheet, results);
						if (element) 
							element.innerHTML = results.documentElement.xml;
					}
					else {
						return;
					}	
				}
			}
		}
		else if (type == "text") {
			if (element && value) {
				element.innerHTML = value;
			}
		}
		else if (type == "json") {
			if (element && value) {
				element.append(value);
			}
		}
		else {
			return;
		}
	}
	
	/**
	 * Public function that attempts to retrieve the number of XML elements 
	 * with the given name that exist in the current value object. This assumes that
	 * the value is an XML DOM object
	 * Returns - the number of nodes with the given name or 0 if none exist.
	 * @param {String} nodeName The node name to search for.
	 * @type int
	 */
	this.getNodeCount = function (nodeName) {
		try {
			var root = value.documentElement;
			return root.getElementsByTagName(nodeName).length;
		}
		catch (e) {
			return 0;
		}
	}
	
	/**
	 * Public function that attempts to retrieve an XML DOMNode from the value
	 * variable if:
	 * 1. It is an XML DOM object
	 * 2. It has at least one tag with the given name.
	 * Otherwise, results are inconsistent.
	 * Returns - The DOMNode of the 'index' instance of 'nodeName' or null if it doesn't exist.
	 * @param {String} nodeName The name of the node.
	 * @param {int} index The index. i.e. If there are expected to be 3 nodes with the name
	 *         'item', then you would enter 0 for the first instance, 1 for the
	 *         second instance and 2 for the third instance. If no index is provided
	 *         then 0 is assumed.
	 * @type DOMNode 
	 */
	this.getNode = function (nodeName, index) {
		if (! index)
			index = 0;
		try {
			var root = value.documentElement;
			var node = root.getElementsByTagName(nodeName)[index];
			return node;
		}
		catch (e) {
			return null;
		}
	}
	
	/**
	 * Public function that attempts to retrieve an XML value from the value
	 * variable if:
	 * 1. It is an XML DOM object
	 * 2. It has at least one tag with the given name.
	 * Otherwise, results are inconsistent. 
	 * Returns - The value of the 'index' instance of 'nodeName' or null if it doesn't exist.
	 * @param {String} nodeName The name of the node 
	 * @param {int} index The index. i.e. If there are expected to be 3 nodes with the name
	 *         'item', then you would enter 0 for the first instance, 1 for the
	 *         second instance and 2 for the third instance. If no index is provided
	 *         then 0 is assumed.
	 * @type String 
	 */
	this.getValueForNode = function (nodeName, index) {
		if (! index)
			index = 0;
		try {
			var root = value.documentElement;
			var nodeValue = root.getElementsByTagName(nodeName)[index].firstChild.data;	
			return nodeValue;
		}
		catch (e) {
			return null;
		}
	}
	
	/**
	 * Public function that attempts to retrieve the number of XML elements 
	 * with the given name that exist under the parent node. This assumes that
	 * the value is an XML DOM object
	 * Returns - the number of nodes with the given name or 0 if none exist.
	 * @param {String} nodeName The node name to search for.
	 * @type int
	 */
	this.getNodeCountByParent = function (parentNode, nodeName) {
		try {
			return parentNode.getElementsByTagName(nodeName).length;
		}
		catch (e) {
			return 0;
		}
	}
	
	/**
	 * Public function that attempts to retrieve an XML value from the value
	 * variable if:
	 * 1. It is an XML DOM object
	 * 2. It has at least one tag with the given name.
	 * Otherwise, results are inconsistent. 
	 * Returns - DOMNode of the 'index' instance of 'nodeName' with 'parentNode' as it's parent, or null if it doesn't exist.
	 * @param {DomNode} parentNode The parent DOMNode under which the child node should be found.
	 *              See #getNode
	 * @param {String} nodeName The name of the node 
	 * @param {int} index The index. i.e. If there are expected to be 3 nodes with the name
	 *         'item', then you would enter 0 for the first instance, 1 for the
	 *         second instance and 2 for the third instance. If no index is provided
	 *         then 0 is assumed.
	 * @type DOMNode
	 */
	this.getNodeByParent = function (parentNode, nodeName, index) {
		if (! index) {
			index = 0;
		}
		try {
			var node = parentNode.getElementsByTagName(nodeName)[index];
			return node;
		}
		catch (e) {
			return null;
		}
	}
	
	/**
	 * Public function that attempts to retrieve an XML value from the value
	 * variable if:
	 * 1. It is an XML DOM object
	 * 2. It has at least one tag with the given name.
	 * Otherwise, results are inconsistent. 
	 * Returns - The value of the 'index' instance of 'nodeName' or null if it doesn't exist.
	 * @param {DomNode} parentNode The parent DOMNode under which the child node should be found.
	 *              See #getNode
	 * @param {String} nodeName The name of the node 
	 * @param {int} index The index. i.e. If there are expected to be 3 nodes with the name
	 *         'item', then you would enter 0 for the first instance, 1 for the
	 *         second instance and 2 for the third instance. If no index is provided
	 *         then 0 is assumed.
	 * @type String 
	 */
	this.getValueForNodeByParent = function (parentNode, nodeName, index) {
		if (! index) {
			index = 0;
		}
		try {
			var nodeValue = parentNode.getElementsByTagName(nodeName)[index].firstChild.data;
			return nodeValue;
		}
		catch (e) {
			return null;
		}
	}
	
	/**
	 * Public method that creates a floating window (if necessary) and adds a message to the log.
	 * Provides public access to the private method log(message).
	 * @param message A message to add to the log window.
	 */
	this.log = function (message, severity) {
		log(message, severity);
	}
	
	/**
	 * Public method that sets the display message that is presented while an 
	 * AjaxRequest is processing.
	 * @param text The message to display.
	 */
	 this.setDisplayMessage = function (text) {
	 	message = text;
	 }
	 
	 /**
	  * Public method that lets the user specify whether or not they are controlling
	  * the display message using CSS. Prevents the internal code from trying to 
	  * set the style programmatically.
	  * @param styled True if the client is using CSS to style the message. False otherwise.
	  */
	 this.setIsStyled = function (styled) {
	 	isStyled = styled;
	 }
	 
	 /**
	  * Public method that turns the debugging window on or off.
	  * @param show True shows the log window, false hides it.
	  */
	  this.setDebugging = function (show) {
	  	debug = show;
	  }
	 /**
	  * Public method that turns unique request ID generation on or off. 
	  * UniqueID generation will append a parameter value with the name 
	  * uniqueid to the end of your request. This helps to ensure that 
	  * IE doesn't cache the request.
	  * @param generate True to append uniqueid to the url, false to not.
	  */
	  this.generateUniqueID = function (generate) {
	  	uniqueID = generate;
	  }
	  
	  /**
	   * Public method that sets a timeout limit for requests and the method 
	   * to call if a timeout occurs.
	   * @param milliseconds Milliseconds to wait for a request to complete before aborting.
	   * @param callback The method to call if a timeout occurs.
	   */
	  this.setTimeoutInterval = function(milliseconds, callback) {
	  	timeout = milliseconds;
	  	if (callback)
		  	timeouthandler = callback;
		else
			timeouthandler = null;
	  }
	  
	  /**
	   * Public method that sets an HTTP request header value for the next
	   * Ajax request.
	   * @param headerName The HTTP header name to set.
	   * @param headerValue The value to set the HTTP header to.
	   */
	  this.setHeader = function (headerName, headerValue) {
	  	headers.push({"name": headerName, "value": headerValue});
	  }
	  
	  /**
	   * Public method that sets the request as a cross domain request. If your
	   * Ajax request is set to cross domain (true), it uses an invisible iframe to
	   * send the data and read the response.
	   * @param cross True if the next Ajax request will be cross domain, false if not. Default is false.
	   */
	  this.setCrossDomain = function (cross) {
	  	crossDomain = cross;
	  }
}