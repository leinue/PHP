function remove_loading() {
	var targelem = document.getElementById('loader_container');
	targelem.style.display='none';
	targelem.style.visibility='hidden';
}

function GetRequest(){
           var url = location.search; //获取url中"?"符后的字
           var theRequest = new Object();
           if (url.indexOf("?") != -1) {
              var str = url.substr(1);
              strs = str.split("&");
              for(var i = 0; i < strs.length; i ++) {
                 theRequest[strs[i].split("=")[0]]=unescape(strs[i].split("=")[1]);
              }
           }
           return theRequest;
        }
 var hiddobj;
    function ShowTr(hid,t){
            if(hid == "" && hid == null)
                return;
            if(document.getElementById(hid) == null)
             return;
             
            if(document.getElementById(hid).style.display != "none"){
                document.getElementById(hid).style.display = "none";
                t.src = "images/+.gif"/*tpa=http://bmm1105.com:99/images/+.gif*/
            }
            else{
                document.getElementById(hid).style.display = "";
                document.getElementById(hid+"td").innerHTML = "其他来源：<font color=red>loading...</font>";          
               t.src = "images/-.gif"/*tpa=http://bmm1105.com:99/images/-.gif*/;
               hiddobj = setInterval("FillDivData("+ hid +")",20);
            }
        }
        function FillDivData(hid){
             url="hidlist.asp?hid=" + hid;
              var http = createXMLHttpRequest();
                http.open("get",url,false);
                http.onreadystatechange=function(){
                    if(http.readyState==4&&http.status==200){
                        document.getElementById(hid+"td").innerHTML = http.responseText;                   
                    }//end if readyState
                }//eixt function
                http.send(null);
                document.getElementById(hid+"td").innerHTML = http.responseText;
                clearInterval(hiddobj);
        }
        function createXMLHttpRequest(){
            var xmlHttp = false;
            try{
                xmlHttp = new XMLHttpRequest();
            }
            catch(trymicrosoft){
                try{
                    xmlHttp = new ActiveXObject("Msxml2.XMLHTTP");
                }
                catch(othermicrosoft){
                   try{
                        xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
                   }
                   catch(failed){}
                }
           }
           return xmlHttp;
        }
        <!--
        String.prototype.len=function(){
        return this.replace(/[^\x00-\xff]/g,"**").length; 
        } 
        function setMaxLength(object,length) 
        {
            var result = true; 
            var controlid = document.selection.createRange().parentElement().id; 
            var controlValue = document.selection.createRange().text; 
            var tempString=object.value; 
            var tt=""; 
            for(var i=0;i<length;i++) 
                { 
                    if(tt.len()<length) 
                        tt=tempString.substr(0,i+1); 
                    else 
                        break; 
                } 
            if(tt.len()>length) 
                tt=tt.substr(0,tt.length-1); 
            object.value=tt;     
        } 
        function QVODP(M,U,H)
        {
	        var A=500,B=150;
	        var C=(screen.width-A)/2;
	        var D=(screen.height-B)/2;
	        window.open ("qvodplay.asp?"+escape(M)+"&hid="+H+"&Url="+escape(U), "newwindow", "height="+B+",width="+A+",top="+D+",left="+C+",toolbar=no, menubar=no, scrollbars=no, resizable=no,location=no, status=no") 
        }
        function QVODP (M,U,H,T,Y,S)
        {
         window.open ("play.asp?name="+M+"&id="+H+".html") 

        }
        -->  