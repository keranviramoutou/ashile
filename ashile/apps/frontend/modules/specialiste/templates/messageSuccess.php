<?php echo '<center>Partenaire enregistré avec Succès</center>' ?>

<script language='javascript'>
var t;
function doLoad() {
t = setTimeout("window.close()",1500);
}

</script>

<script type="text/javascript">
function refreshAndClose() {
   // window.opener.location.reload(true);
    window.close();
}
</script>
<body onbeforeunload="refreshAndClose();" onLoad='doLoad()''>