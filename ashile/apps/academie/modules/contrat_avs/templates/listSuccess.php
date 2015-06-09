<?php use_helper('jQuery') ?>
<?php use_stylesheet('data_table.css') ?>
<?php use_stylesheet('datatable_jui.css') ?>
<?php use_javascript('jquery.dataTables.min.js') ?>
<?php use_helper('Date') ?>

<script type="text/javascript">
   $j(document).ready(function() {
       oTable = $j('#aTable').dataTable({
           "bJQueryUI": true,
           "sPaginationType": "full_numbers",
           "oLanguage" : {
               "sProcessing":     "Traitement en cours...",
               "sLengthMenu":     "Afficher _MENU_ contrats",
               "sZeroRecords":    "Aucun contrats; afficher",
               "sInfo":           "Affichage du contrat _START_ &agrave; _END_ sur _TOTAL_ contrats",
               "sInfoEmpty":      "Affichage du contrat 0 &agrave; 0 sur 0 contrats",
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
<div id="contrat_avs" >
<?php
      //controle de la quotité horaire disponible pour l'avs
	 //------------------------------------------------------------
	    $affichageavs='';
	    if($existTotalquotiteavs && $existtotalquotitécontratAvs  ){
		$diffavs = $totalquotitécontratAvs[0]['temps_hebdo'] - $totalquotiteavs[0]['quotiteavs']  ;
		if ($diffavs >= 0){
		$affichageavs=  '<FONT COLOR="green" ><strong> &nbsp<-------&nbsp'.'<blink><strong> il reste&nbsp'.abs($diffavs).' heures à affecter</FONT></strong></blink> ';
		}else{
		$affichageavs = '<FONT COLOR="red" ><strong> &nbsp<-------&nbsp'.'<blink><s<FONT COLOR="red" >'.abs($diffavs).'&nbsp&nbspheure(s) effectuée(s) en trop ! </FONT></strong></blink> ';
		}
		}
?>

<?php 
echo '<fieldset><legend><h3>Synthèse </h3></legend>';
  echo '<p><i> Avs :&nbsp<strong> '.$avschoisi['nom'].' '.$avschoisi['prenom'].'</strong>&nbsp né(e) le :<strong>&nbsp'.format_date($avschoisi['date_naissance'],'dd/MM/yyyy').'</strong></i></p>';
  echo '<p><i>Téléphone(s) :&nbsp;<strong>'. $avschoisi['tel1'].' '.$avschoisi['tel2'].'</strong>&nbspemail:&nbsp; <strong>'.$avschoisi['email'].'</strong></i></p>';
  	 if($existTotalquotiteavs )
	 {
		echo '<p>- Quotité Total réalisée &nbsp;'.'  au  &nbsp;<strong>'.format_date(time(),'dd/MM/yyyy').'</strong>&nbsp:&nbsp&nbsp&nbsp<strong>'.$totalquotiteavs[0]['quotiteavs'].'</strong>&nbspHeure(s)</p>';
	 }	
	   	 if($existtotalquotitécontratAvs )
	 {
		echo '<p>- Quotité du contrat en cours &nbsp;'.'  au  &nbsp<strong>'.format_date(time(),'dd/MM/yyyy').'</strong>&nbsp;:&nbsp;&nbsp;&nbsp;<strong>'.$totalquotitécontratAvs[0]['temps_hebdo'].'</strong>&nbspHeure(s)'.$affichageavs.'</strong></p>';
	 }	
	 
  echo'</fieldset>';	
?>


 <br>&nbsp;<button type="button" onclick="location.href='<?php echo url_for('contrat_avs/new?avs_id=' . $avschoisi['id'] ) ?>'">Nouveau contrat</button>&nbsp;
 <button type="button" onclick="location.href='<?php echo url_for('avs/recherche?avs_nom='.$sf_request->getParameter('avs_nom').'&avs_prenom='.$sf_request->getParameter('avs_prenom')  ) ?>'">Retour</button>

<h4>Historique des contrats </h4> 
<?php echo '<p>Pour info : Seul un contrat avec une date de fin supérieure à la date du jour peut être modifié' ?>
<?php echo ' ,Seul un contrat sans mouvement (ex congés) peut être supprimé</p> ' ?>
<table cellpadding="0" cellspacing="0" border="0" class="display" id="aTable">
  <thead>
    <tr>
 
	 <th>Type contrat</th>
     <th>Date deb. Contrat </th>
     <th>Date Fin  Contrat </th>
	 <th>Temps Hebdo. </th>
	 <th>Etab. Employeur </th> 
   </tr>
  </thead>

<?php foreach($ContratEnCour as $ContratEncours): ?>
    <tr>
			<td><?php if(format_date($ContratEncours['date_fin_contrat'],'yyyy/MM/dd') >= format_date(time(),'yyyy/MM/dd') || !$ContratEncours['date_fin_contrat'] ) { ?>
			<a href="<?php echo url_for('contrat_avs/edit?id='.$ContratEncours['contratId']) ?>"> <?php echo $ContratEncours['typecontrat'] .'&nbsp;('.$ContratEncours['contratId'].')&nbsp;'?></a>
			 &nbsp;<br><?php  echo '&nbsp;'.link_to('Supprimer', 'contrat_avs/delete?id='.$ContratEncours['contratId'].'&avs_id=' . $ContratEncours['avsid'], array('method' => 'delete', 'confirm' => 'Etes vous sur ?')) ?>
			</td>
			<?php }else{ ?>
			<a href="<?php echo url_for('contrat_avs/show?id='.$ContratEncours['contratId']) ?>"> <?php echo $ContratEncours['typecontrat'] .'&nbsp;('.$ContratEncours['contratId'].')&nbsp;' ?></a></td>
			<?php } ?>
             <td><?php echo format_date($ContratEncours['date_debut_contrat'],'dd/MM/yyyy') ?></td>
             <td><?php echo format_date($ContratEncours['date_fin_contrat'],'dd/MM/yyyy') ?></td>
			 <td><?php echo $ContratEncours['temps_hebdo'].'&nbsp;heure(s)' ?></td>
			 <td><?php echo $ContratEncours['typetab'].'&nbsp'.$ContratEncours['etab'].'&nbsp-&nbsp'.$ContratEncours['rne'] ?></td>
      </tr>	
<?php endforeach; ?>

</table>



<?php
	// inclusion du partial 'des élèves suivi par l'avs	
	//------------------------------------------------------
	if($existeleveEnCharge){		
		
			include_partial('InfoAvs', array('eleveEnCharge' => $eleveEnCharge)); 
			
	}else {
	
	echo '<br><div class="flash_error">Pas d\'élève(s) suivi(s) par cet accompagnant&nbsp'.'&nbspsituation&nbspau&nbsp'.format_date(time(),'dd/MM/yyyy').'</div>';

	}
	
?>

<?php //print_r($eleveEnCharge); ?>

<script>
var src = "<?php echo url_for('contrat_avs/aide') ?>";

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
</div>
