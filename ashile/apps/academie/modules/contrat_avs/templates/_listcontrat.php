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

<h4>Historique des contrats </h4> 
<?php echo '<p>Pour info : Seul un contrat avec une date de fin supérieure à la date du jour peut être modifié' ?>
<?php echo ' ,Seul un contrat sans mouvement (ex congés) peut être supprimé</p> ' ?>
<table cellpadding="0" cellspacing="0" border="0" class="display" id="aTable">
  <thead>
    <tr>
 
     <th>Contrat</th>
	 <th>Type contrat</th>
     <th>Début Contrat </th>
     <th>Fin  Contrat </th>
	 <th>Temps Hebdo. </th>
	 <th>Etab. Employeur</th> 
   </tr>
  </thead>

<?php foreach($ContratEnCour as $ContratEncours): ?>
    <tr>
			<td><?php if(format_date($ContratEncours['date_fin_contrat'],'yyyy/MM/dd') >= format_date(time(),'yyyy/MM/dd') || !$ContratEncours['date_fin_contrat'] ) { ?>
			<a href="<?php echo url_for('contrat_avs/edit?id='.$ContratEncours['contratId'].'&avs_id='.$ContratEncours['avsid'] ) ?>"  onclick="document.body.style.cursor='wait'"> <?php echo  $ContratEncours['typecontrat'] .'&nbsp;('.$ContratEncours['contratId'].')&nbsp;'?></a>
			 
			</td>
			<?php }else{ ?>
								<?php echo link_to(  $ContratEncours['typecontrat'] .'&nbsp;('.$ContratEncours['contratId'].')&nbsp;' , 'contrat_avs/show?id='.$ContratEncours['contratId'], 
          array('popup' => array('popupWindow', 'width=600,height=500,left=350,top=60','scrollbars=yes')) )  ?></td>
			<?php } ?>
		 	<td><?php echo $ContratEncours['typecontrat'] ?></td>
             <td><?php echo format_date($ContratEncours['date_debut_contrat'],'dd/MM/yyyy') ?></td>
             <td><?php echo format_date($ContratEncours['date_fin_contrat'],'dd/MM/yyyy') ?></td>
			 <td><?php echo $ContratEncours['temps_hebdo'].'&nbsp;heure(s)' ?></td>
			 <td><?php echo $ContratEncours['typetab'].'&nbsp'.$ContratEncours['etab'].'&nbsp-&nbsp'.$ContratEncours['rne'] ?></td>
      </tr>	
<?php endforeach; ?>

</table>



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
