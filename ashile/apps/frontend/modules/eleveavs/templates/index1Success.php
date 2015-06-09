<?php use_stylesheet('data_table.css') ?>
<?php use_stylesheet('datatable_jui.css') ?>
<?php use_javascript('jquery.dataTables.min.js') ?>
<?php use_helper('Date') ?>
<?php use_helper('jQuery') ?>

<script>
 function excel() {
document.body.style.cursor = 'wait';
window.location.href='<?php echo url_for(array('module' => 'eleveavs', 'action' => 'excel?secteur_id='.$eleve_avss[0]['secteur_id'],'titi' => 'ok')) ?>';
//location.reload() ; 
} 
</script>

<script type="text/javascript">
   $j(document).ready(function() {
       oTable = $j('#maTable').dataTable({
	          "iDisplayLength": 50,
           "bJQueryUI": true,
           "sPaginationType": "full_numbers",
			"bScrollInfinite": true,
			"bScrollCollapse": true,
             "sScrollY": "380px",
           "oLanguage" : {
               "sProcessing":     "Traitement en cours...",
               "sLengthMenu":     "Afficher _MENU_ &eacute;l&egrave;ves",
               "sZeroRecords":    "Aucun &eacute;l&eagrave;ve &agrave; afficher",
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

    	  <div id="eleveavs_index1">  

<table width='95%'>
<tr height='20px'>
<td width='70%' valign ="center" >
<h1>Elèves scolarisés et accompagnés secteur de <?php echo $eleve_avss[0]['libellesecteur']?>&nbsp;</h1>
</td>
<td width='30%' align="right" valign ="center">
<button name="export" onClick="excel()"><small>export Excel </small></button>
</td>

<td width='15%' align="right" valign ="center">
<div class= 'aide' onClick="<?php echo url_for('eleveavs/aide') ?>"></div>
</td>
</tr>
</table>

 <?php // echo print_r($eleve_avss); ?>
 


	


		<table cellpadding="0" cellspacing="0" border="0" class="display" id="maTable">

		<thead>
			<tr>   
				<th>Eleve</th>
                <th>Scolarisartion </th>
             	<th>Accompagnants</th>
				<th>Q.H. affectée</th>
				<th>Affect. du</th>
				<th>Notification en cours</th>
				<th>Demande en attente de décision</th>
				<th> Alerte contrat</th>
			</tr>
		</thead>
		<tbody>
			
			<?php foreach ($eleve_avss as $eleve_avs): ?>
			    <!--derniere demande Acc. valide à la date du jour -->
				<?php $demande_avss =Doctrine_Core::getTable('DemandeAvs')->getListDerDemandeAcc($eleve_avs['eleve_id']); ?>
				<?php $contrat_avs = Doctrine_Query::Create()
					->select ('ca.id as contrat_id,ty.id as typecontrat_id,ca.date_fin_contrat as date_fin_contrat,ca.date_debut_contrat as date_debut_contrat,ty.typecontrat as typecontrat,ca.temps_hebdo as temps_hebdo,
					DATE_ADD( ca.date_fin_contrat, INTERVAL -1 MONTH ) as date_fin_contrat1,DATE_ADD( ca.date_fin_contrat, INTERVAL -2 MONTH ) as date_fin_contrat2,DATE_ADD( ca.date_fin_contrat, INTERVAL -3 MONTH ) as date_fin_contrat3,
					DATE_ADD( ca.date_fin_projete, INTERVAL -1 MONTH ) as date_fin_projete1,DATE_ADD( ca.date_fin_projete, INTERVAL -2 MONTH ) as date_fin_projete2')
					->from('ContratAvs ca ')
					->innerJoin('ca.TypeContratAvs ty ON ty.id = ca.typecontratavs_id')
					->where('ca.avs_id =?',$eleve_avs['avs_id'])
					->andwhere('ca.date_fin_contrat > ?',date('Y-m-d', time()))
					->limit(1)
					->fetcharray();
					$count_contrat_avs =count($contrat_avs );
				?>
				<!--  demande d'acc. en attente de décision de la CDA -->
				<?php $demande_acc_attente = Doctrine_core::getTable('DemandeAvs')->getDemandeAVSencour($eleve_avs['eleve_id']); ?>
				
				<tr onClick="window.location.href='<?php echo url_for(array('module' => 'eleve', 'action' => 'edit', 'id' => $eleve_avs['eleve_id']))  ?>'"  class="<?php echo fmod($i, 2) ? 'even' : 'odd'   ?>" style="cursor: pointer">
				
					<td><small> <?php echo $eleve_avs['nomeleve'].'  '.$eleve_avs['prenomeleve'].'<br>né(e) le&nbsp;'.format_date($eleve_avs['datenaissance'],'dd/MM/yyyy')?>	</small></td>
					<td><small><?php echo '</br>'.$eleve_avs['nomtypeetab'].'  '.$eleve_avs['nometabsco'].'<br>'.$eleve_avs['rne']?>	</small></td>
                        
					<td><small><?php echo $eleve_avs['nomavs'].'&nbsp'.$eleve_avs['prenomavs'].'<br>'?>
					
					<?php echo 'Type contrat :&nbsp'.$contrat_avs[0]['typecontrat'].'<br>Tps Hebdo. :&nbsp;'.$contrat_avs[0]['temps_hebdo'].'&nbsp;Heure(s)'.'<br>'.format_date($contrat_avs[0]['date_debut_contrat'],'dd/MM/yyyy').'&nbsp;au&nbsp;'.format_date($contrat_avs[0]['date_fin_contrat'],'dd/MM/yyyy') ?> 	</small>
					
					</small></td>
					<td><small><?php echo $eleve_avs['quotite'].'&nbsp;Heure(s)' ?>	</small></td>
					<td><small><?php echo format_date($eleve_avs['datedebut'],'dd/MM/yyyy').'<br>au&nbsp;'.format_date($eleve_avs['datefin'],'dd/MM/yyyy') ?>	</small></td>
			
					<td>
					<?php if( count($demande_avss) > 0) { ?>
						<small>
						<?php foreach ($demande_avss as $demande_avs): ?>
						<?php echo 'du&nbsp;'.format_date($demande_avs['datedebutnotif'],'dd/MM/yyyy').'&nbsp;au&nbsp;'.format_date($demande_avs['datefinnotif'],'dd/MM/yyyy').'<br>Quotité hor. :&nbsp;'.$demande_avs['quotitehorrairenotifie'].'Heure(s)'?>
						<?php endforeach; ?>
						</small>
					<?php } ?>
					</td>
					<td>
					<?php if( count($demande_acc_attente) > 0) { ?>
					        <small>
							<?php foreach ($demande_acc_attente as $demande_acc_attentes): ?>
							 <?php echo 'dossier MDPH transmis le &nbsp;'.format_date($demande_acc_attentes['dateenvoiedossier'],'dd/MM/yyyy')?>
							<?php endforeach; ?>
							</small>
					<?php } ?>
						
						
				     </td>
					 <td>
					 <?php 
						
								   if(($contrat_avs[0]['date_fin_contrat3'] <= date('Y-m-d', time())  && $contrat_avs[0]['date_fin_contrat2']  >= date('Y-m-d', time() ))&&  $contrat_avs[0]['date_fin_contrat']){
									echo '<small><br><FONT COLOR="red" >- contrat terminé dans moins de 3 mois</FONT>' ;
									}
									
									if($contrat_avs[0]['date_fin_contrat2']  <= date('Y-m-d', time()) && $contrat_avs[0]['date_fin_contrat1']  >= date('Y-m-d', time()) &&  $contrat_avs[0]['date_fin_contrat']){
									echo '<small><br><FONT COLOR="red" >- contrat terminé dans moins de 2 mois</FONT>' ;
									}
									
								    if($contrat_avs[0]['date_fin_projete2']  <= date('Y-m-d', time()) && $contrat_avs[0]['date_fin_projete1']  >= date('Y-m-d', time()) &&  $contrat_avs[0]['date_fin_projete']){
									echo '<small><br><FONT COLOR="red" >- recrutement à effectuer terminé dans moins de 2 mois</FONT>' ;
									}
						?>
					 </td>
				
				</tr>
			<?php endforeach; ?>
		</tbody>

	</table>
	
		</div>

<?php
function link_to_frontend($name, $parameters)
{
    return sfProjectConfiguration::getActive()->generateFrontendUrl($name, $parameters);
}
?>

<script>
var src = "<?php echo url_for('eleveavs/aide') ?>";

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




