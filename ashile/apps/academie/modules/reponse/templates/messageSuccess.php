<br>
<br>
<fieldset>
<?php echo '<center>Réponse intitulée :&nbsp;<b>'.$info_reponse[0]['libellereponse'].' </b>enregistrée avec Succès <br> pour la Question n°<b>'.$info_question[0]['num_question'].'</b> intitulée :&nbsp;<b>'.$info_question[0]['libellequestion'].'</b></center>' ?>
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