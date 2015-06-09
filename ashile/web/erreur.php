
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
    <title>Application ashile</title> 
    </head>



<body onbeforeunload="refreshAndClose();"  width='80%' onLoad='doLoad()''>
<div width='100px'>
<br><br><fieldset><legend>Application Ashile </legend>
<?php if (!$_GET['secteur']) { ?>
<?php   echo '<br><br><br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Utilisateur &nbsp;:&nbsp'.$_GET['user'].' non reconnu par l\'application  !! ,<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;contacter l\'adminstrateur' ?>
<?php } ?>

<?php if ($_GET['secteur']==1){ ?>
<?php   echo '<br><br><br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Utilisateur &nbsp;:&nbsp'.$_GET['user'].' n\'a pas de secteur attribué !! ,<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;contacter l\'adminstrateur' ?>
<?php } ?>

<br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo $_SERVER['HTTP_REFERER']; ?>"><button>Retour</button></a>
</fieldset>


</div>
</body>


<script language='javascript'>
var t;
function doLoad() {
t = setTimeout("window.close()",1500);
}

</script>

<script type="text/javascript">
function refreshAndClose() {
   // window.opener.location.reload(true);
   header("location:".  $_SERVER['HTTP_REFERER']);
}
</script>
