<%@ Page Language="C#" AutoEventWireup="true" validateRequest="false" %>

<script runat="server">
protected void Page_Load(object sender, EventArgs e)
{
    this.Label1.Text = Request.Form["content1"];
}

</script>

<!doctype html>

<html>
<head runat="server">
    <meta charset="utf-8" />
    <title>KindEditor ASP.NET</title>
    <script type="text/javascript" charset="utf-8" src="../kindeditor.js"></script>
    <script type="text/javascript">
        KE.show({
            id : 'content1',
            imageUploadJson : '../../asp.net/upload_json.ashx',
            fileManagerJson : '../../asp.net/file_manager_json.ashx',
            allowFileManager : true,
		    afterCreate : function(id) {
			    KE.event.ctrl(document, 13, function() {
				    KE.util.setData(id);
				    document.forms['form1'].submit();
			    });
			    KE.event.ctrl(KE.g[id].iframeDoc, 13, function() {
				    KE.util.setData(id);
				    document.forms['form1'].submit();
			    });
		    }
        });
    </script>
</head>
<body>
    <asp:Label ID="Label1" runat="server" Text=""></asp:Label>
    <form id="form1" runat="server">
        <textarea id="content1" cols="100" rows="8" style="width:700px;height:200px;visibility:hidden;" runat="server"></textarea>
        <br />
        <asp:Button ID="Button1" runat="server" Text="提交内容" /> (提交快捷键: Ctrl + Enter)
    </form>
<!-- zixi.org.cn Baidu tongji analytics -->
<script type="text/javascript">
var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3F373a5160f96b2e16d6ffc7ced7340f47' type='text/javascript'%3E%3C/script%3E"));
</script>
</body>
</html>
