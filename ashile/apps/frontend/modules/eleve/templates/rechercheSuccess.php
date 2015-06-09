<?php use_helper('jQuery') ?>
<?php use_stylesheet('data_table.css') ?>
<?php use_stylesheet('datatable_jui.css') ?>
<?php use_javascript('jquery.dataTables.min.js') ?>
<?php use_helper('Date') ?>

<div>

<?php //echo phpinfo() ?>

<div id="recherche_eleve_frontend">


<table width='95%'>
<tr height='20px'>
<td width="40%" >
 <h1> Recherche et création d'un élève</h1>	
</td>
<td width='60%' align="right">
		<div class='aide' onClick="<?php echo url_for('eleve/aide') ?>"> </div> 
</td>

</tr>
</table> 

		<fieldset>  

		<form action="<?php echo url_for('eleve/recherche'); ?>" method="POST">
		
        <table>
		<tfoot>
				      <tr> 
					
				      <td>
						 Saisir le nom de l'élève&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type = "text" name = "nom_eleve" value="<?php echo $_POST['nom_eleve'] ?>"><br />
						 <br>Saisir le prénom de l'élève&nbsp;&nbsp;<input type = "text" name = "prenom_eleve"  value="<?php echo $_POST['prenom_eleve'] ?>"><br />
						 <!-- -->
					     <br> <input type="submit" value="Rechercher" onclick="document.body.style.cursor='wait'" />&nbsp;
						<?php echo button_to('Créer un eleve','eleve/new'.'#div_eleve') ?>&nbsp;
						<a href="<? $_SERVER['HTTP_REFERER']?>"> 
							<input type="button" value="Retour" onclick="document.body.style.cursor='wait'" />
						</a>
						 
						 </br>
					  </td>
				      </tr>
					 
	   </tfoot>

      </table>
      </form>
	 
     <small>Vous pouvez rechercher tout ou partie d'une chaine de caractère 
	ex DU pour rechercher tout les noms contenant "DU"</small></br> 

    </fieldset>

	<div>
	<?php // include_partial('resultat', array('resultat' => $resultat,'eleves' => $eleves,'secteur'=>$secteur)); 
?>
	</div>

</div>

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
