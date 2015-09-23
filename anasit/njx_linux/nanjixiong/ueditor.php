<?php


define('BASEDIR',__DIR__);
require(BASEDIR.'/Cores/Loader.php');

?>


<!DOCTYPE HTML>
<html>
<head>

    <meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
    <title>UMEDITOR 完整demo</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link href="<?php echo DOMAIN; ?>/Cores/widgets/themes/default/css/umeditor.css" type="text/css" rel="stylesheet">
    <script type="text/javascript" src="<?php echo DOMAIN; ?>/Cores/widgets/third-party/jquery.min.js"></script>
    <script type="text/javascript" charset="utf-8" src="<?php echo DOMAIN; ?>/Cores/widgets/umeditor.config.js"></script>
    <script type="text/javascript" charset="utf-8" src="<?php echo DOMAIN; ?>/Cores/widgets/umeditor.min.js"></script>
    <script type="text/javascript" src="<?php echo DOMAIN; ?>/Cores/widgets/lang/zh-cn/zh-cn.js"></script>
</head>
<body>
<h1>UMEDITOR 完整demo</h1>

<script type="text/plain" id="myEditor" style="width:100%;height:240px;">
    <p>这里我可以写一些输入提示</p>
</script>


<div class="clear"></div>
<div id="btns">
    <table>
        <tr>
            <td>
                <button class="btn" unselected="on" onclick="getAllHtml()">获得整个html的内容</button>&nbsp;
                <button class="btn" onclick="getContent()">获得内容</button>&nbsp;
                <button class="btn" onclick="setContent()">写入内容</button>&nbsp;
                <button class="btn" onclick="setContent(true)">追加内容</button>&nbsp;
                <button class="btn" onclick="getContentTxt()">获得纯文本</button>&nbsp;
                <button class="btn" onclick="getPlainTxt()">获得带格式的纯文本</button>&nbsp;
                <button class="btn" onclick="hasContent()">判断是否有内容</button>
            </td>
        </tr>
        <tr>
            <td>
                <button class="btn" onclick="setFocus()">编辑器获得焦点</button>&nbsp;
                <button class="btn" onmousedown="isFocus();return false;">编辑器是否获得焦点</button>&nbsp;
                <button class="btn" onclick="doBlur()">编辑器取消焦点</button>&nbsp;
                <button class="btn" onclick="insertHtml()">插入给定的内容</button>&nbsp;
                <button class="btn" onclick="getContentTxt()">获得纯文本</button>&nbsp;
                <button class="btn" id="enable" onclick="setEnabled()">可以编辑</button>&nbsp;
                <button class="btn" onclick="setDisabled()">不可编辑</button>
            </td>
        </tr>
        <tr>
            <td>
                <button class="btn" onclick="UM.getEditor('myEditor').setHide()">隐藏编辑器</button>&nbsp;
                <button class="btn" onclick="UM.getEditor('myEditor').setShow()">显示编辑器</button>&nbsp;
                <button class="btn" onclick="UM.getEditor('myEditor').setHeight(300)">设置编辑器的高度为300</button>&nbsp;
                <button class="btn" onclick="UM.getEditor('myEditor').setWidth(1200)">设置编辑器的宽度为1200</button>
            </td>
        </tr>

    </table>
</div>
<table>
    <tr>
        <td>
            <button class="btn" onclick="createEditor()"/>创建编辑器</button>
            <button class="btn" onclick="deleteEditor()"/>删除编辑器</button>
        </td>
    </tr>
</table>

<div>
    <h3 id="focush2"></h3>
</div>
<script type="text/javascript">
    //实例化编辑器
    var um = UM.getEditor('myEditor');
    um.addListener('blur',function(){
        $('#focush2').html('编辑器失去焦点了')
    });
    um.addListener('focus',function(){
        $('#focush2').html('')
    });
    //按钮的操作
    function insertHtml() {
        var value = prompt('插入html代码', '');
        um.execCommand('insertHtml', value)
    }
    function isFocus(){
        alert(um.isFocus())
    }
    function doBlur(){
        um.blur()
    }
    function createEditor() {
        enableBtn();
        um = UM.getEditor('myEditor');
    }
    function getAllHtml() {
        alert(UM.getEditor('myEditor').getAllHtml())
    }
    function getContent() {
        var arr = [];
        arr.push("使用editor.getContent()方法可以获得编辑器的内容");
        arr.push("内容为：");
        arr.push(UM.getEditor('myEditor').getContent());
        alert(arr.join("\n"));
    }
    function getPlainTxt() {
        var arr = [];
        arr.push("使用editor.getPlainTxt()方法可以获得编辑器的带格式的纯文本内容");
        arr.push("内容为：");
        arr.push(UM.getEditor('myEditor').getPlainTxt());
        alert(arr.join('\n'))
    }
    function setContent(isAppendTo) {
        var arr = [];
        arr.push("使用editor.setContent('欢迎使用umeditor')方法可以设置编辑器的内容");
        UM.getEditor('myEditor').setContent('欢迎使用umeditor', isAppendTo);
        alert(arr.join("\n"));
    }
    function setDisabled() {
        UM.getEditor('myEditor').setDisabled('fullscreen');
        disableBtn("enable");
    }

    function setEnabled() {
        UM.getEditor('myEditor').setEnabled();
        enableBtn();
    }

    function getText() {
        //当你点击按钮时编辑区域已经失去了焦点，如果直接用getText将不会得到内容，所以要在选回来，然后取得内容
        var range = UM.getEditor('myEditor').selection.getRange();
        range.select();
        var txt = UM.getEditor('myEditor').selection.getText();
        alert(txt)
    }

    function getContentTxt() {
        var arr = [];
        arr.push("使用editor.getContentTxt()方法可以获得编辑器的纯文本内容");
        arr.push("编辑器的纯文本内容为：");
        arr.push(UM.getEditor('myEditor').getContentTxt());
        alert(arr.join("\n"));
    }
    function hasContent() {
        var arr = [];
        arr.push("使用editor.hasContents()方法判断编辑器里是否有内容");
        arr.push("判断结果为：");
        arr.push(UM.getEditor('myEditor').hasContents());
        alert(arr.join("\n"));
    }
    function setFocus() {
        UM.getEditor('myEditor').focus();
    }
    function deleteEditor() {
        disableBtn();
        UM.getEditor('myEditor').destroy();
    }
    function disableBtn(str) {
        var div = document.getElementById('btns');
        var btns = domUtils.getElementsByTagName(div, "button");
        for (var i = 0, btn; btn = btns[i++];) {
            if (btn.id == str) {
                domUtils.removeAttributes(btn, ["disabled"]);
            } else {
                btn.setAttribute("disabled", "true");
            }
        }
    }
    function enableBtn() {
        var div = document.getElementById('btns');
        var btns = domUtils.getElementsByTagName(div, "button");
        for (var i = 0, btn; btn = btns[i++];) {
            domUtils.removeAttributes(btn, ["disabled"]);
        }
    }
</script>

</body>
</html>
