<?php
/*********************************反黑客验证****************************************/
if(!defined('INNI_ZIXISHI_LOCK'))die('Hacking attempt');
/***********************************************************************************/
require 'common_action.php';
?>
<!DOCTYPE >
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!--<link href="css/com.css" rel="stylesheet" type="text/css" />
-->
<!--
<script src="<?=$web_site?>/mathjax/MathJax.js?config=TeX-AMS-MML_HTMLorMML" ></script>
<script type="text/x-mathjax-config"> MathJax.Hub.Config({extensions: ["tex2jax.js"],jax: ["input/TeX","output/HTML-CSS"],tex2jax: {inlineMath: [["$","$"],["\\(","\\)"]]}});</script>
-->
<!--
<script type="text/x-mathjax-config">
                    MathJax.Hub.Config({"HTML-CSS": { preferredFont: "TeX", availableFonts: ["STIX","TeX"], linebreaks: { automatic:true }, EqnChunk: (MathJax.Hub.Browser.isMobile ? 10 : 50) },
                                        tex2jax: { inlineMath: [ ["$", "$"], ["\\\\(","\\\\)"] ], displayMath: [ ["$$","$$"], ["\\[", "\\]"] ], processEscapes: true, ignoreClass: "tex2jax_ignore|dno" },
                                        TeX: {  noUndefined: { attributes: { mathcolor: "red", mathbackground: "#FFEEEE", mathsize: "90%" } }, Macros: { href: "{}" } },
                                        messageStyle: "none"
                });
</script>-->


<script type="text/javascript" src="http://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS_HTML" > </script>
<script type="text/x-mathjax-config"> MathJax.Hub.Config({extensions: ["tex2jax.js"],jax: ["input/TeX","output/HTML-CSS"],tex2jax: {inlineMath: [["$","$"],["\\(","\\)"]]}});</script>

</head>
<body>
<p><?=str_replace('\\\\','\\',$_REQUEST['m_content'])?></p>

<!-- zixi.org.cn Baidu tongji analytics 
<script type="text/javascript">
var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3F373a5160f96b2e16d6ffc7ced7340f47' type='text/javascript'%3E%3C/script%3E"));
</script>-->
</body>
</html>