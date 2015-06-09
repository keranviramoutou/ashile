
<?php use_stylesheet('data_table.css') ?>
<?php use_stylesheet('datatable_jui.css') ?>
<?php use_javascript('jquery.dataTables.min.js') ?>
<?php use_helper('Date') ?>
<?php use_helper('jQuery') ?>
<br>
<br>
<br>
<fieldset>

<?php echo '<center>Position de type :&nbsp;<b> '.$info_position[0]['libelletypepositionavs'].'&nbsp;<br>du&nbsp;'. format_date($info_position[0]['datedebut'],'dd/MM/yyyy').'</b>&nbsp;au&nbsp;<b>'.format_date($info_position[0]['datefin'],'dd/MM/yyyy').'&nbsp;</b>enregistrée avec Succès</center>' ?>
</fieldset>

<script language='javascript'>
var t;
function doLoad() {
t = setTimeout("window.close()",2000);
}

</script>
<script type="text/javascript">
function refreshAndClose() {
    window.opener.location.reload(true);
    window.close();
}
</script>
<body onbeforeunload="refreshAndClose();" onLoad='doLoad()''>