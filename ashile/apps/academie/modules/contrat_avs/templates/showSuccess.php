<?php use_helper('Date') ?>
<?php use_helper('jQuery') ?>

<h4><?php echo 'Gestion des personnels > Consultation Contrat ' ; ?></h4>

<?php // print_r($contrat_avs) ?>
<fieldset>
    <legend>Détails</legend>
    <table class="show">
  <tbody>
    <tr>
      <th>Contrat de :</th>
      <td><?php echo $contrat_avs[0]['avsnom'].' '.$contrat_avs[0]['avsprenom'] ?></td>
    </tr>
	    <tr>
     <th>Etablissement employeur :</th>
     <td><?php echo $contrat_avs[0]['etab'].' - '.$contrat_avs[0]['rne']  ?></td>
    </tr>
    <tr>
      <th>Nature du contrat :</th>
      <td><?php echo $contrat_avs[0]['typecontrat'] ?></td>
    </tr>	
	<tr>
      <th>Temps hébdomadaire :</th>
      <td><?php echo $contrat_avs[0]['temps_hebdo'].' heure(s)'?></td>
    </tr>
	
	<tr>
      <th>Dates du contrat : </th>
      <td><?php echo 'du ' .format_date($contrat_avs[0]['date_debut_contrat'],'dd/MM/yyyy').' au '.format_date($contrat_avs[0]['date_fin_contrat'],'dd/MM/yyyy')?></td>
    </tr>
	
  </tbody>
</table>
</fieldset>
<a href="<?php echo url_for('contrat_avs/list/action?avs_id='.$contrat_avs[0]['id']) ?>">Revenir à la liste des contrats pour cet AVS</a> 
<div id="position_avs">
<?php
 if ($existposition){
 include_partial('infoPosition', array('position'=>$position));
}else { echo '<p>pas de positions pour ce contrat</p>'; }
?>

 </div>      
       


		
		
