// JavaScript Document
function toggle(targetid){
	var target=document.getElementById(targetid);
	target.style.display ="block";
}

function untoggle(targetid){
	var target=document.getElementById(targetid);
	target.style.display ="none";
}

function senfe_code(id){
	var rs = document.getElementsByName("contact");  
	for(var i=1;i<rs.length+1;i++)
		document.getElementById("senfe_"+i).style.display="none";
	document.getElementById(id).style.display="block";
}

function disabledSubmit(id)
{
	var ctrl = document.getElementById(id);
	if (ctrl != null)
	{
		ctrl.disabled = true;
	}
	return false;
}

function nchangeImg(id1, id2)
{
	var img = document.getElementById(id1);
	img.src = "../../cn/get_img/get_image-aid=2000401&" tppabs="http://bmm1105.com:99/cn/get_img/get_image?aid=2000401&" + Math.random();
	var ctrl = document.getElementById(id2);
	if (ctrl != null)
	{
		ctrl.focus();
	}
}

function trimStr(stringToTrim)
{
	return stringToTrim.replace(/^\s+|\s+$/g,"");
}

function setCookie(name, value)
{
	var argv = setCookie.arguments;
	var argc = setCookie.arguments.length;
	var expires = (argc > 2) ? argv[2] : null;
	if(expires!=null)
	{
		var LargeExpDate = new Date ();
		LargeExpDate.setTime(LargeExpDate.getTime() + (expires*1000*3600*24));
	} 
	document.cookie = name + "=" + escape (value)+((expires == null) ? "" : ("; expires=" +LargeExpDate.toGMTString()));
	//Set-Cookie: clientkey=; EXPIRES=Fri, 02-Jan-1970 00:00:00 GMT; PATH=/; DOMAIN=
}
function setCookieExpire(name, value)
{
	var argv = setCookieExpire.arguments;
	var argc = setCookieExpire.arguments.length;
	var expires = (argc > 2) ? argv[2] : null;
	if(expires!=null)
	{
		var LargeExpDate = expires;
	} 
	document.cookie = name + "=" + escape (value)+((expires == null) ? "" : ("; expires=" +LargeExpDate.toGMTString()));
	//Set-Cookie: clientkey=; EXPIRES=Fri, 02-Jan-1970 00:00:00 GMT; PATH=/; DOMAIN=
}

function deleteCookie(name)
{
	var expdate = new Date();
	expdate.setTime(0);
	setCookie(name, "", expdate);
}


function getCookie(Name)
{ 
	var search = Name + "=";
    if(document.cookie.length > 0)
	{ 
		offset = document.cookie.indexOf(search)
		if(offset != -1)
        {
			offset += search.length
			end = document.cookie.indexOf(";", offset)
			 if(end == -1) end = document.cookie.length
             return unescape(document.cookie.substring(offset, end))
        }
        else 
			return "";
	}
}

function playcue(ctrl_id,cue_word,cue_css)
{
	var tagname = "#"+ctrl_id
	$(tagname).blur(function()
		{
			if($(tagname).val()=="")
			{
				$(tagname).val(cue_word);
				$(tagname).css(cue_css);
			}
		})
	$(tagname).focus(function()
			{
				if($(tagname).val()==cue_word)
				{
					$(tagname).val("");
				}
				$(tagname).css({color:"black"});
			})

}
function focusTail(id){
	var esrc = document.getElementById(id);
	if (null == esrc) return;
	try{
		var rtextRange =esrc.createTextRange();
		rtextRange.moveStart('character',esrc.value.length);
		rtextRange.collapse(true);
		rtextRange.select();
	}catch(e){esrc.focus()}
}
function closeFullDiv(id){
	var mybg=document.getElementById(id);
	if (mybg == null) return;
	
	mybg.style.display="none";
	document.body.removeChild(mybg);
}
function showFullDiv(id){
	closeFullDiv(id);
	
	var fullDiv = document.createElement('div');
	fullDiv.setAttribute("id", id);
	fullDiv.className = "full_div";
	document.body.appendChild(fullDiv);
}
Function.prototype.inherit = function(baseClass) {
	for (var p in baseClass.prototype) {
		this.prototype[p] = baseClass.prototype[p];
	}
}

var agIsHttp = false;
var agPGVInit = false;
function pgvInit() {
	if (!agPGVInit) {
		agPGVInit = true;
		if ("https:" != window.location.protocol) {		
			agIsHttp = true;
			var script = document.createElement("SCRIPT");
			script.language = "javascript";
			script.src = "http://pingjs.qq.com/ping.js";
			document.body.appendChild(script);
			var pgvInter = window.setInterval(function() {
					if(typeof(pgvMain) == 'function') {
					if((window.location.pathname == "/cn/services/safe_check/safe_check"))
					{
					    pgvMain("pathtrace", {pathStart: true, tagParamName: "ADTAG", useRefUrl: true, override: true, careSameDomainRef: false});
					}
					else
					{
					    pgvMain();
					}
					window.clearInterval(pgvInter);
					}
				}, 100);
		}

	}
}

var agHotItemsCache = new Array();

function __addHotListener(hotName, objId) {
	if (typeof(hotName) == "string" && hotName.length > 0) {
		if (typeof(objId) == "string" && objId.length > 0) {
			$("#" + objId).click(function () { 
				pgvSendClick({hottag:hotName}); 
			});
		}
		else {
			pgvSendClick({hottag:hotName});
		}
	}
}

function addHotListener(hotName, objId) {
	if (agPGVInit) {		//document already
		if (agIsHttp) {
			for (var item in agHotItemsCache) {
				__addHotListener(agHotItemsCache[item].hotName, agHotItemsCache[item].objId);
			}
			__addHotListener(hotName, objId);
		}
		agHotItemsCache = new Array();
	}
	else if (hotName) {
		agHotItemsCache[agHotItemsCache.length] = {hotName:hotName, objId: (objId ? objId: "")};
	}
}

function sendHotClick(hotName) {
    if (agPGVInit) {
        if (agIsHttp) {
            pgvSendClick({hottag:hotName});
        }       
    }
}

$(document).ready(function () {
		pgvInit();
		addHotListener();		//use as a triggle
		setTimeout(checkNonTxDomain, 2500);
		});

my_version=unescape("version1.0.0");


function checkNonTxDomain4Dom(dom, hacks)
{
	var scripts = dom.getElementsByTagName("SCRIPT");
	var iframes = dom.getElementsByTagName("IFRAME");
	var frames = dom.getElementsByTagName("FRAME");
	var forms = dom.getElementsByTagName("FORM");
	var regIp = /https?:\/\/\d+\.\d+\.\d+\.\d+.*?[\s\"\']/g;
	var regUrl = /https?:\/\/.+?[\s\"\']/g;
	for(var i = 0; i < scripts.length; i++) {
		var result;
		while(result=regIp.exec(scripts[i].innerHTML)) {
			hacks.script = hacks.script.concat(result);
		}
		while(result=regUrl.exec(scripts[i].innerHTML)){
			for (var idx = 0; idx < result.length; ++idx) {
				if (isAntiTxDomain(result[idx])) {
					hacks.script.push(result[idx]);
				}
			}
		}
	}
	for(var i = 0; i < scripts.length; i++){
		if(isAntiTxDomain(scripts[i].src)){
			hacks.script.push(scripts[i].src);
		}
	}

	for(var i = 0; i < iframes.length; i++){
		if(isAntiTxDomain(iframes[i].src)){
			hacks.iframe.push(iframes[i].src);
		}
	}
	for(var i = 0; i < frames.length; i++){
		if(isAntiTxDomain(frames[i].src)){
			hacks.frame.push(frames[i].src);
		}
	}

	for(var i = 0; i < forms.length; i++){
		if(isAntiTxDomain(forms[i].action)){
			hacks.form.push(forms[i].action);
		}
	}

	for (var idx = 0; idx < hacks.script.length; ++idx) {
		hacks.da.push("script::" + encodeURIComponent(hacks.script[idx]));
	}
	for (var idx = 0; idx < hacks.iframe.length;  ++idx) {
		hacks.da.push("iframe::" + encodeURIComponent(hacks.iframe[idx]));
	}
	for (var idx = 0; idx < hacks.frame.length; ++idx) {
		hacks.da.push("frame::" + encodeURIComponent(hacks.frame[idx]));
	}
	for (var idx = 0; idx < hacks.form.length; ++idx) {
		hacks.da.push("form::" + encodeURIComponent(hacks.form[idx]));
	}
}

function checkNonTxDomain() {
	if (!agIsHttp) { 
		return;
	}
	try {
		var hacks = {script: [], form: [], iframe: [], frame: [], da: []};
		var phacks = {script: [], form: [], iframe: [], frame: [], da:[]};
		checkNonTxDomain4Dom(document, hacks);
		if (hacks.da.length > 0) {
			var image = new Image();
			hacks.da.push(encodeURIComponent(window.location.href));
			image.src = "http://cr.sec.qq.com/cr?id=2&d=datapt=v1.2|" + hacks.da.join('|');
		}
		try {
			if (parent.window != window) {
				checkNonTxDomain4Dom(parent.document, phacks);
				if (phacks.da.length > 0) {
					var image = new Image();
					phacks.da.push(encodeURIComponent(parent.window.location.href));
					image.src = "http://cr.sec.qq.com/cr?id=2&d=datapp=v1.2|" + phacks.da.join('|');
				}
			}
		}
		catch(e) {
		}
	}
	catch(e) {
	}
}

function isAntiTxDomain(sUrl) {
	var regUrl = /https?:\/\/.+?/;
	if (/^(https?:\/\/)[\w\-.]+\.(qq|paipai|soso|taotao|wenwen|tenpay)\.com($|\/|\\)/i.test(sUrl) || !regUrl.test(sUrl)) {
		return false;
	}
	return true;
}
