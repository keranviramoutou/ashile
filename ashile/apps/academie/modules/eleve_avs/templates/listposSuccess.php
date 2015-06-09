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
               "sLengthMenu":     "Afficher _MENU_ positions",
               "sZeroRecords":    "Aucun positions; afficher",
               "sInfo":           "Affichage de la position _START_ &agrave; _END_ sur _TOTAL_ positions",
               "sInfoEmpty":      "Affichage du contrat 0 &agrave; 0 sur 0 positions",
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
<div align="center" >
<?php if ($count_PosAvs > 0) { ?>

<br><h4>Historique des position des contrats </h4> <br>

<table cellpadding="0" cellspacing="0" border="0" class="display" id="aTable">
  <thead>
    <tr>
 

	 <th>Type contrat</th>
     <th>Début Contrat </th>
     <th>Fin Contrat </th>
	 <th>Temps Hebdo. </th>
	 <th>Type position</th>
	 <th>Début position</th>
	  <th>Fin position</th>

   </tr>
  </thead>

<?php foreach($PosAvs as $PosAvss): ?>
    <tr>
		<?php
		//type position 
		//---------------
		$Typepos = Doctrine_Core::getTable('TypePositionAvs')->findOneById($PosAvss['typepositionavs_id']);
	   ?>
		 	<td><?php echo $PosAvss['typecontrat'] ?></td>
             <td><?php echo format_date($PosAvss['date_debut_contrat'],'dd/MM/yyyy') ?></td>
             <td><?php echo format_date($PosAvss['date_fin_contrat'],'dd/MM/yyyy') ?></td>
			 <td><?php echo $PosAvss['temps_hebdo'].'&nbsp;heure(s)' ?></td>
		     <td><?php echo $Typepos['libelletypepositionavs'] ?></td>
             <td><?php echo format_date($PosAvss['datedebut_pos'],'dd/MM/yyyy') ?></td>
             <td><?php echo format_date($PosAvss['datefin_pos'],'dd/MM/yyyy') ?></td>
      </tr>	
<?php endforeach; ?>

</table>
<?php }else{ ?>
<?php echo '<br>Pas de position pour ces contrats'; }?>
</div>

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

