<?php use_stylesheet('data_table.css') ?>
<?php use_helper('Date') ?>
<?php use_helper('jQuery') ?>
<?php $i = 1 ?>


 <div class= 'aide' onClick="aide_eleveavs()"></div> 
 <fieldset>
	<legend>Historique des accompagnements</legend>

	<?php $i = 1 ?>

		<table cellpadding="0" cellspacing="10" border="0" class="display" id="maTable" width="100%">
	  <thead>
		<tr>
		  <th>Identité de <br> l'Accompagnant&nbsp;&nbsp;&nbsp;&nbsp;<br></th>
		  <th>Quotite horaire<br> de prise en charge&nbsp;&nbsp;</th>	
		  <th>&nbsp;&nbsp;&nbsp;Période <br>&nbsp;&nbsp;de prise en charge</th>
		  <th> contrat en cours</th>

		</tr>
	  </thead>
	  <tbody>
		<?php foreach ($eleve_avss as $eleve_avs): ?>
		
		<?php
			
         $contrat_avs = Doctrine_Query::Create()
		->select ('ca.id as contrat_id,ty.id as typecontrat_id,ca.date_fin_contrat as date_fin_contrat,ca.date_debut_contrat as date_debut_contrat,ty.typecontrat as typecontrat,et.id as etabsco_id,et.nometabsco as nometabsco,t.nomtypeetablissement as typeetab,et.rne as rne')
		->from('ContratAvs ca ')
		->innerJoin('ca.TypeContratAvs ty ON ty.id = ca.typecontratavs_id')
		->innerJoin('ca.Etabsco et ON et.id = ca.etabsco_id')
		->innerJoin('et.Typeetablissement t on t.id = et.typeetablissement_id ')
        ->where('ca.avs_id =?',$eleve_avs['avs_id'])
   //   ->andwhere('ca.date_fin_contrat > ?',$anneeScolaire->getDatedebutanneescolaire())
		->andwhere('ca.date_fin_contrat > ?',date('Y-m-d', time()))
		->fetcharray();
		$count_contrat_avs =count($contrat_avs );
		
        ?>
		<?php //echo $eleve_avs->getEleveId().$eleve_avs->getAvsId(); ?>
        <?php if(date('Y-m-d', time()) < $eleve_avs['datefin'] || !$eleve_avs['datefin']) {?>
		<tr onclick="<?php echo jq_remote_function(array('url' => 'eleveavs/show?eleve_id=' .  $eleve_avs['eleve_id'].'&avs_id ='. $eleve_avs['avs_id'] , 'update' => 'div_avs', 'method' => 'get')) ?>" class="<?php echo fmod($i, 2) ? 'even' : 'odd' ?>" style="cursor: pointer; color: #000; background:#C0DCC0">
		<?php }else{ ?>
		 <tr onclick="<?php echo jq_remote_function(array('url' => 'eleveavs/show?eleve_id=' .  $eleve_avs['eleve_id'].'&avs_id ='. $eleve_avs['avs_id'] , 'update' => 'div_avs', 'method' => 'get')) ?>" class="<?php echo fmod($i, 2) ? 'even' : 'odd' ?>" style="cursor: pointer; color: #000; background:#e0e0e0">
        <?php } ?>		
		<td><center><?php echo  $eleve_avs['avsnom'] . '-'.$eleve_avs['avsprenom']  ?></center></td>
		  <td><center><?php echo ''.$eleve_avs['quotitehorraireavs'].'&nbsp;Heure(s)' ?></center></td>
		  
		  <td><center><?php echo ''. format_date($eleve_avs['datedebut'],'dd/MM/yyyy').'&nbsp;au&nbsp'. format_date($eleve_avs['datefin'],'dd/MM/yyyy')  ?></center></td>
          <td>
		  <?php if((date('Y-m-d', time()) < $eleve_avs['datefin'] || !$eleve_avs['datefin']) && $count_contrat_avs > 0 ) {?>
		   <?php echo '&nbsp;'.$contrat_avs[0]['typecontrat'].'&nbsp;:du&nbsp;'. format_date($contrat_avs[0]['date_debut_contrat'],'dd/MM/yyyy').'&nbsp;au&nbsp'. format_date($contrat_avs[0]['date_fin_contrat'],'dd/MM/yyyy').'<br><small>&nbsp;Employeur :&nbsp'. $contrat_avs[0]['typeetab'].'&nbsp;'.$contrat_avs[0]['nometabsco'].'&nbsp;-&nbsp;'.$contrat_avs[0]['rne'].'</small>'  ?>
		   <?php } ?>	
		  </td>
		</tr>
		
	<?php $i++ ?>
			<?php endforeach; ?>
			<?php if ($i == 1): ?>
				<tr><center><td colspan="4" style="font-style: italic">Cet(te) élève n'a pas d'accompagnement</center></td></tr>
			<?php endif; ?>
		</tbody>
	</table>
</fieldset>	
<script>

function aide_eleveavs() {
	var src = "<?php echo url_for('eleveavs/aide') ?>";
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
	}


</script>