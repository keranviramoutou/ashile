<?php use_helper('jQuery') ?>
<?php use_stylesheet('data_table.css') ?>
<?php use_stylesheet('datatable_jui.css') ?>
<?php use_javascript('jquery.dataTables.min.js') ?>
<?php use_helper('Date') ?>

<script type="text/javascript">

   $j(document).ready(function() {
       oTable = $j('#maTable').dataTable({
           "bJQueryUI": true,
           "sPaginationType": "full_numbers",
           "oLanguage" : {
               "sProcessing":     "Traitement en cours...",
               "sLengthMenu":     "Afficher _MENU_ &eacute;l&egrave;ves",
               "sZeroRecords":    "Aucun &eacute;l&egrave;ve &agrave; afficher",
               "sInfo":           "Affichage de l'&eacute;l&egrave;ve _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&egrave;ves",
               "sInfoEmpty":      "Affichage de l'&eacute;lement 0 &agrave; 0 sur 0 &eacute;l&eacute;ments",
               "sInfoFiltered":   "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
               "sInfoPostFix":    "",
               "sSearch":         "Rechercher&nbsp;:",
               "sLoadingRecords": "Téléchargement...",
               "sUrl":            "",
               "oPaginate": {
                   "sFirst":    "Premier",
                   "sPrevious": "Pr&eacute;c&eacute;dent",
                   "sNext":     "Suivant",
                   "sLast":     "Dernier"
               }
           }
       });
   } );
</script>


<div>


<!-- Formulaire de selection des demandes à traiter --->
<!-- ---------------------------------------------- --->
	<div id="traitement_demande_materiel">
		<fieldset> 
		
	     <div class='aide' onClick="<?php echo url_for('eleve_materiel/aide') ?>"> </div> 
		 <h3> Dossiers MDPH > Demande matériel > saisie décision CDA</h3>	

		<form action="javascript:saisieCDA()">
        <table>
		<tfoot>
				      <br>Décision&nbsp;&nbsp;&nbsp;:
						<select name='decisioncda' id='decisioncda'onChange="notif()" >
						    <option value="1">Acceptée</option>
						    <option value="" >refusée</option>
						</select> 
						
						&nbsp;&nbsp;Décision CDA du : <input type="text" name="datedecisioncda" id="calendrier"></br>
						<br><br>Notifiée du : <input type="text" name="datedebutnotif" id="calendrier1">
						&nbsp;&nbsp;Au  : <input type="text" name="datefinnotif" id="calendrier2"></br>
					     <br> <input type="submit" value="Traiter" onClick="saisieCDA()" />&nbsp;  <input type="button" value="Retour" onclick="history.go(-1)"> </br>
					 
	   </tfoot>

      </table>

    </fieldset>





<?php 
	$eleve_id = "";
 ?>


<table cellpadding="0" cellspacing="0" border="0" class="display" id="maTable">
  <thead>
    <tr>
	  <th> selection </th>
      <th>Eleve</th>
      <th>Type Matériel<br> demandé</th>
      <th>N° Doss. MDPH</th>
      <th>Date CERFA</th>		
      <th>Date ESS</th>
      <th>Date envoi MDPH </th>
      <th>Secteur</th>
      <th>Etablissement</th>
    </tr>
  </thead>

<?php
	foreach ($demande_materiel1s as $demande_materiel): 
?>
              </tr>
			  <td><?php echo "&nbsp;<input type='checkbox' name='groupDemande' value='".$demande_materiel['demandemateriel_id']."'>".'&nbsp;'.$demande_materiel['demandemateriel_id'] ?></td>
		      <td><a href="<?php echo url_for('demandemateriel/edit?id='. $demande_materiel['demandemateriel_id'].'&eleve_id='. $demande_materiel['eleve_id']) ?>"><?php echo $demande_materiel['nomeleve'].'&nbsp-&nbsp'. $demande_materiel['prenomeleve'] ?></a>
		  <?php echo '<br>né(e) le &nbsp;'.format_date($demande_materiel['datenaissanceeleve'],'dd/MM/yyyy') ?></td>
              <td><?php echo $demande_materiel['typemateriel'] ?></td>
              <td><?php echo '<strong>'.$demande_materiel['numeromdph'].'</strong>&nbsp&nbsp(&nbsp'.$demande_materiel['mdph_id'].'&nbsp)' ?></td>
              <td><?php echo format_date($demande_materiel['datecreationpps'],'dd/MM/yyyy') ?></td>
              <td><?php echo format_date($demande_materiel['dateess'], 'dd/MM/yyyy') ?></td>
              <td><?php echo format_date($demande_materiel['dateenvoiedossier'],'dd/MM/yyyy') ?></td>
              <td><?php echo $demande_materiel['libellesecteur'] ?></td>
              <td><?php echo '<small>'.$demande_materiel['typetab'].'&nbsp;'.$demande_materiel['nometabsco'].'<br>'.$demande_materiel['rne'].'</small>' ?></td>     
    </tr>	
        <?php endforeach; ?>
</table>
 </form>

<script>
	
	/* ---- fonction qui envoie les materiel attribué selectionés pour edition du bon de livraison */
	
function saisieCDA() {

		var lesMats = [];
		var decisioncda = [];	
		var datedecisioncda = [];	
		var datedebutnotif = [];
		var datefinnotif = [];
		
	    		var REMOTE_ADDR = '<?php echo($_SERVER['REMOTE_ADDR']); ?>';
				var HTTP_HOST = '<?php echo($_SERVER['HTTP_HOST']); ?>';
	    
				if (HTTP_HOST == 'ashile2.ac-reunion.fr' && REMOTE_ADDR == '192.168.220.3' ) //portail.ac-reunion.fr
				  {
						 var url_dest = 'https://portail.ac-reunion.fr/ashile/academie.php/demandemateriel/traitementcda?lesMats=' ;
				
				} else if (HTTP_HOST  == 'ashile.ac-reunion.fr' && REMOTE_ADDR == '192.168.220.3' ) { 
						 var url_dest = 'https://portail.ac-reunion.fr/ashilep/academie.php/demandemateriel/traitementcda?lesMats=' ;
				  } 
				
				 if ( HTTP_HOST  == 'ashile2.ac-reunion.fr' && REMOTE_ADDR == '172.31.176.121' ) // accueil.in.ac-reunion.fr
				  {
						 var url_dest = 'https://accueil.in.ac-reunion.fr/ashile/academie.php/demandemateriel/traitementcda?lesMats=';
				 
				 } else if( HTTP_HOST  == 'ashile.ac-reunion.fr' && REMOTE_ADDR == '172.31.176.121' ){
						 var url_dest = 'https://accueil.in.ac-reunion.fr/ashilep/academie.php/demandemateriel/traitementcda?lesMats=' ;
				  }    
	             else{ var url_dest ='toto';}
				 
				 
			for (i=0;i<document.getElementsByName("groupDemande").length;i++)
			{
				if(document.getElementsByName("groupDemande")[i].checked)
				{
					lesMats[i] =document.getElementsByName("groupDemande")[i].value;
				}
				
				
			}
		decisioncda[0] =document.getElementsByName("decisioncda")[0].value;
		datedecisioncda[0] =document.getElementsByName("datedecisioncda")[0].value;
		datedebutnotif[0] =document.getElementsByName("datedebutnotif")[0].value;
		datefinnotif[0] =document.getElementsByName("datefinnotif")[0].value;
		
		
	    var url_dest =  url_dest+lesMats+"&decisioncda="+decisioncda+"&datedecisioncda="+datedecisioncda+"&datedebutnotif="+datedebutnotif+"&datefinnotif="+datefinnotif+"";
    // window.location="http://accueil.in.ac-reunion.fr/ashilep/academie.php/demandemateriel/traitementcda?lesMats="+lesMats+"&decisioncda="+decisioncda+"&datedecisioncda="+datedecisioncda+"&datedebutnotif="+datedebutnotif+"&datefinnotif="+datefinnotif+"";
	  document.location.replace(url_dest);
	}
</script>
	

	
	
	<!-- Script pour DatePicker -->
	<script>
		$j(function() {
		$j( "#calendrier" ).datepicker({ dateFormat: 'dd-mm-yy'}); //'format_date' => ''  dd/mm/yy
		$j( "#calendrier1" ).datepicker({ dateFormat: 'dd-mm-yy'}); //'format_date' => ''  dd/mm/yy
		$j( "#calendrier2" ).datepicker({ dateFormat: 'dd-mm-yy'}); //'format_date' => ''  dd/mm/yy
		});
	</script>
	<!---------------------------->

<script language="javascript">
function notif() {


 if ( document.getElementById("decisioncda").value !== "1" ){
//alert('changement de secteur pris en compte '+ document.getElementsByName("decisioncda").value );
var1 = document.getElementById("calendrier1");

document.getElementById("calendrier1").value = "ne pas renseigner";
document.getElementById("calendrier1").disabled = true;
document.getElementById("calendrier2").value = "ne pas renseigner";
document.getElementById("calendrier2").disabled = true;

}else{
$param =  document.getElementsByName("decisioncda").value;
//alert('different ' + $param );
document.getElementById("calendrier1").disabled = false;
document.getElementById("calendrier1").value = date;
document.getElementById("calendrier2").disabled = false;
document.getElementById("calendrier2").value = "";
}
return 1; }
</script>

