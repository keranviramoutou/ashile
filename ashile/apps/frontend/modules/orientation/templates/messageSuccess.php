<?php use_helper('jQuery') ?>
<?php use_stylesheet('data_table.css') ?>
<?php use_stylesheet('datatable_jui.css') ?>
<?php use_helper('Date') ?>
<?php use_helper('Text') ?>


<?php echo '<center>Changement de secteur enregistré avec Succès</center>' ?>


<script language='javascript'>
var t;
function doLoad() {
t = setTimeout("window.close()",1500);
}

</script>

<script type="text/javascript">
function refreshAndClose() {
    window.opener.location.reload(true);
    window.close();
}
</script>
<body onbeforeunload="refreshAndClose();" onLoad='doLoad()''>