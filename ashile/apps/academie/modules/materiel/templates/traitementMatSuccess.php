<?php use_stylesheet('data_table.css') ?>
<?php use_stylesheet('datatable_jui.css') ?>
<?php use_javascript('jquery.dataTables.min.js') ?>
<?php use_helper('Date') ?>
<?php use_helper('jQuery') ?>


<script type="text/javascript">
   $j(document).ready(function() {
       oTable = $j('#maTable').dataTable({
           "bJQueryUI": true,
           "sPaginationType": "full_numbers",
           "oLanguage" : {
               "sProcessing":     "Traitement en cours...",
               "sLengthMenu":     "Afficher _MENU_ materiels",
               "sZeroRecords":    "Aucun materiel &agrave; afficher",
               "sInfo":           "Affichage du materiel _START_ &agrave; _END_ sur _TOTAL_ materiels",
               "sInfoEmpty":      "Affichage du materiel 0 sur 0 materiels",
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
<div id="materiel_eleve"> 
<?php //echo 'variable :&nbsp;'.$sf_request->getParameter('lesMats').'<br>' ?>
    <?php
    $str=explode(",",$sf_request->getParameter('lesMats') );
 	$str= array_chunk($str, 2) ; //redimesionne la variable en tabelau à 2 dimension
    $dd=count($str)- 1;
 // echo 'total'.$dd.'<br>';
 
for($ligne = 0; $ligne<= $dd; $ligne++) { // boucle sur les meubles
    // for($colonne = 0; $colonne <= 2; $colonne++) {// boucle sur les disques
         // echo $str[$ligne][$colonne] ."<br>"; // écriture à l'écran du contenu
		//  echo 'materile_id&nbsp;'.$str[$ligne][0].'&nbsp;-&nbsp;numéro&nbsp;'. $str[$ligne][1] ;
   //  } // fin boucle sur les meubles
} // fin boucle sur les disques
?>


<h3>Liste des matériels en Stock à numéroter</h3>    

<?php foreach($_POST['lesMats']as  $element){echo '[' .  '] vaut ' . $element . '';}?>
<?php //echo 'test&nbsp' .date('Y-m-d',strtotime($_POST['maj'])) ?> 
<form action="javascript:saisieNUM()">
		<table cellpadding="0" cellspacing="0" border="0" class="display" id="maTable">
  <thead>
    <tr>
      <th>Marque</th>
	  <th>Catégorie</th>
      <th>Type du Matériel</th>
      <th>Référence(s)</th>
      <th>N° du materiel</th>
      <th>Etat  </th>
	  <th>Date du mouvement </th>
	  <th>Prêt</th>
  
  </thead>
  
  		<?php
		 
			//Liste des demandes de matériel en cours à la date du jour 
			//-------------------------------------------------------------
			$demande_materiel = Doctrine_Core::getTable('DemandeMateriel')->getListDemandeMat();
			$existdemande_materiel = count($demande_materiel);
		
		?>
  <tbody>
   <?php foreach ($materiels as $materiel): ?>
   
   
    <?php
	
     //recherche du dernier mouvement créé pour le matériel selectionné
	 //-----------------------------------------------------------------
   		$dernierMouvs = Doctrine_Query::create()
					->select('mouv.id as mouvement_id, m.id as materiel_id,f.id as mouvId,f.nommouvement as nommouvement,mouv.datedebut as datedebut')
					->from('MouvementMateriel mouv')
					->leftJoin('mouv.Materiel m ON mouv.materiel_id = m.id')
					->leftJoin('mouv.Mouvement f ON f.id = mouv.mouvement_id')
					->where('m.id = ?', $materiel['id'])
					->orderBy('mouv.id DESC LIMIT 1')
					->fetchArray();
			
	?>




      <td><?php echo $materiel['marque'] ?></td>
	  <td><?php echo $materiel['libellecatmateriel'] ?></td>
      <td><?php echo $materiel['libelletypemateriel'] ?></td>
      <td><a href="<?php echo url_for('materiel/edit?id='.$materiel['id']) ?>"><?php echo $materiel['libellemateriel'].'</a><br><small>- Type MDPH :&nbsp;'.$materiel['libelletypemateriel'].'</small>' ?></td>
      <td><input type="text" name='numero_mat' value="<?php echo $materiel['numeromateriel']?>" style="width:200px" ><input type="hidden" name='mat_id' value="<?php echo $materiel['id']?>" style="width:10px" >
	  <?php //echo $materiel['numeromateriel'] ?></td>


	   <!-- dernier mouvement -->	
	         
			<?php foreach ($dernierMouvs as $dernierMouv): ?>
				<?php echo '<td><small>'.$dernierMouv['nommouvement'].'</td>'?>
				<?php echo '<td>'.format_date($dernierMouv['datedebut'],'dd/MM/yyyy'.'</small>').'</td>'?>
			<?php endforeach; ?>
	
       <!-- prêt -->		
		<td>

		<!-- création d'un prêt si des demandes de matériels en cours existent -->
					<?php  if( $existdemande_materiel > 0 ) {?>
				     <br><a href="<?php echo url_for('eleve_materiel/new?materiel_id='.$materiel['id']) ?>"><?php echo 'Créer' ?></a>
				   <?php } ?>	
		</td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
</form>

<div>

     <br> <input type="submit" value="Traiter" onClick="saisieNUM()" />&nbsp;<br>; 
<script>
	
	/* ---- fonction qui envoie les materiel attribué selectionés pour edition du bon de livraison */
	
function saisieNUM() {

		var lesMats = [];
		
			    var REMOTE_ADDR = '<?php echo($_SERVER['REMOTE_ADDR']); ?>';
				var HTTP_HOST = '<?php echo($_SERVER['HTTP_HOST']); ?>';
	    
				if (HTTP_HOST == 'ashile2.ac-reunion.fr' && REMOTE_ADDR == '192.168.220.3' ) //portail.ac-reunion.fr
				  {
						 var url_dest = 'https://portail.ac-reunion.fr/ashile/academie.php/materiel/traitementMat?lesMats=' ;
				
				} else if (HTTP_HOST  == 'ashile.ac-reunion.fr' && REMOTE_ADDR == '192.168.220.3' ) { 
						 var url_dest = 'https://portail.ac-reunion.fr/ashilep/academie.php/materiel/traitementMat?lesMats=' ;
				  } 
				
				 if ( HTTP_HOST  == 'ashile2.ac-reunion.fr' && REMOTE_ADDR == '172.31.176.121' ) // accueil.in.ac-reunion.fr
				  {
						 var url_dest = 'https://accueil.in.ac-reunion.fr/ashile/academie.php/materiel/traitementMat?lesMats=';
				 
				 } else if( HTTP_HOST  == 'ashile.ac-reunion.fr' && REMOTE_ADDR == '172.31.176.121' ){
						 var url_dest = 'https://accueil.in.ac-reunion.fr/ashilep/academie.php/materiel/traitementMat?lesMats=' ;
				  }    
	             else{ var url_dest ='toto';}
		

		
			for (i=0;i<document.getElementsByName("mat_id").length;i++)
			{
			
				if(document.getElementsByName("numero_mat")[i].value != "")
				{
				    a=[document.getElementsByName("mat_id")[i].value,document.getElementsByName("numero_mat")[i].value]
					lesMats.push(a)
				   /*	lesMats[i] = new Array ();
					lesMats[i][0] =document.getElementsByName("mat_id")[i].value;
					lesMats[i][1] = document.getElementsByName("numero_mat")[i].value;*/
					
				}
		
			}
		
	  var url_dest =  url_dest+lesMats+"";
	  document.location.replace(url_dest);
    // window.location="https://accueil.in.ac-reunion.fr/ashilep/academie.php/materiel/traitementMat?lesMats="+lesMats+"";
	}
</script>