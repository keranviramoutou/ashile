<?php use_helper('jQuery') ?>
<?php use_stylesheet('data_table.css') ?>
<?php use_stylesheet('datatable_jui.css') ?>
<?php use_javascript('jquery.dataTables.min.js') ?>
<?php use_helper('Date') ?>
<?php use_helper('Date') ?>
<?php //$eleves = $form->getObject(); ?>







<div id="recherche_avs">
		
		<div class='aide' onClick="<?php echo url_for('avs/aide') ?>"> </div> 
		<h3> Gestion des Accompagnants > Recherche ou Création Acc. </h3>	
		<fieldset> 
		<form action="<?php echo url_for('avs/recherche'); ?>" method="POST" >
        <table>
		<tfoot>
				      <tr>
				      <td>
						Saisir le nom de l'Accompagnant&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type = "text" name = "nom_avs" value="<?php echo $_POST['nom_avs'] ?>" size="60px"><a class="info" href="#"><bold><big>&nbsp;&nbsp;<img  src="../../../images/mini_aide.png"></big></bold><span>Votre texte de l'info bulle</span></a><br />
						<br>Saisir le nom de jeune fille de l'Accompagnant&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type = "text" name = "avs_nomjf" value="<?php echo $_POST['avs_nomjf'] ?>" size="60px"><a class="info" href="#"><bold><big>&nbsp;&nbsp;<img  src="../../../images/mini_aide.png"></big></bold><span>Votre texte de l'info bulle</span></a><br />
										
						<br>Saisir le prénom de l'Accompagnant&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type = "text" name = "prenom_avs" value="<?php echo $_POST['prenom_avs'] ?>" size="60px"><br />
					     <br> <input type="submit" value="Rechercher"  onclick="document.body.style.cursor='wait'" />&nbsp;  <input type="button" value="Retour" onclick="history.go(-1)">
						<?php  echo button_to('Créer un Accompagnant', 'avs/new' )  ?></br>
						
					  </td>
				      </tr>
					 
	   </tfoot>

      </table>
      </form>
    <tr> Vous pouvez rechercher tout ou partie d'une chaine de caractère ex DU pour rechercher tout les noms contenant "DU"</tr> 
	<br> Vous devez saisir au moins  une chaine dans le Nom ou le prénom</br> 
  </div>
   </fieldset>
    <?php  if($resultat){ ?>
	<div>
	<?php  include_partial('resultat', array('resultat' => $resultat,'contratavss' => $contratavss,'existcontratavs'=>$existcontratavs)); ?>
	</div>
	<?php } ?>
	
	<script>
var src = "<?php echo url_for('avs/aide') ?>";

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
