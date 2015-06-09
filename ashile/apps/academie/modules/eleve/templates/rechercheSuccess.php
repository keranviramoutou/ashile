<?php use_helper('jQuery') ?>
<?php use_stylesheet('data_table.css') ?>
<?php use_stylesheet('datatable_jui.css') ?>
<?php use_javascript('jquery.dataTables.min.js') ?>

<?php use_helper('Date') ?>
<?php //$eleves = $form->getObject(); ?>


<div>

<?php //echo phpinfo() ?>
  

	<div id="recherche_eleve">
		 
<table width='95%'>
<tr height='20px'>
<td width='70%' >
   <h3>  Elèves > Recherche élèves</h3>	
</td>
<td width='30%' align="right">
  <div class= 'aide' onClick="aide()">
</td>

</tr>
</table>    
		
      
		<fieldset> 		 
		<form action="<?php echo url_for('eleve/recherche'); ?>" method="POST">
        <table>
		<tfoot>
				      <tr> 
					
				      <td>
						 Saisir le nom de l'élève&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type = "text" name = "nom_eleve" value="<?php echo $_POST['nom_eleve'] ?>"size="60px"></br>
						 <br>Saisir le prénom de l'élève&nbsp;&nbsp;<input type = "text" name = "prenom_eleve" value="<?php echo $_POST['prenom_eleve']?>" size="60px"><br /><br>
						<?php echo "Recherche détaillée&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type='checkbox' name='flag_recherche' value='1'>" ?>
					     <br> <input type="submit" value="Rechercher" onclick="document.body.style.cursor='wait'" />&nbsp; 
						 <button type="button" onclick="document.body.style.cursor='wait';location.href='<?php echo link_to_frontend('', array('module' => 'eleve', 'action' => 'new', 'id' => $eleve['eleve_id'],  'academie' => 'true'))."#div_eleve" ?>'">Création fiche élève</button>

						 </td>
				      </tr>
					 
	   </tfoot>
      </table>
      </form>
	<!--  <a href="<?=$_SERVER['HTTP_REFERER']?>">Retour</a> -->
    
    </fieldset>
		</div>

	
	<?php if($sf_request->getParameter('flag_recherche') == 2 || $sf_request->getParameter('flag_recherche') == 1 ){  ?>
	<!-- affichage détail de la recherche -->
	<?php  include_partial('resultat', array('resultat' => $resultat,'eleves' => $eleves,'flag_recherche'=>'1')); ?>  <!-- rechercher détaillée -->
	<?php } else { ?>
	<?php  include_partial('resultat1', array('resultat' => $resultat,'eleves' => $eleves)); ?>
	<?php } ?>



<?php
function link_to_frontend($name, $parameters)
{
    return sfProjectConfiguration::getActive()->generateFrontendUrl($name, $parameters);
}
?>


<script>
var src = "<?php echo url_for('eleve/aide') ?>";

$j(document).ready(function(){
        $j('.aide').click(function (){
                $j.modal('<iframe src="' + src + '" height="450" width="830" style="border:0">', {
                        closeHTML:"",
                        containerCss:{
                                backgroundColor:"#fff",
                                borderColor:"#fff",
                                height:450,
                                padding:0,
                                width:830
                        },
                        overlayClose:true
                });
        });
});

</script>
