<?php use_helper('Date') ?>
<?php use_helper('jQuery'); ?>
<?php  use_stylesheet('data_table.css') ?>
<?php  use_stylesheet('datatable_jui.css') ?>
<?php use_javascript('jquery.dataTables.min.js') ?>
<?php use_helper('Date') ?>

<?php $i = 1 ?>




<?php if ($sf_user->hasFlash('error')): ?>
  <div class="flash_error"><?php echo $sf_user->getFlash('error') ?></div>
 <?php endif ?>

<div class= 'aide' onClick="aide_mdph()"></div> 
 <fieldset >
	<legend>Dossiers ASH</legend>
		<table  cellpadding="0" cellspacing="5" border="0" class="display" id="maTable">
			<thead>
				           <tr>
                                       <th>N°  </th>
									    <th>Droits<br>ouverts</th>
									   <th>Demandes <br>en cours</th>
									   <th>Demandes <br>refusées</th>
									   <th>Droits <br>Terminés</th>
                                        <th>Pièces jointes<br> obligatoires </th>
										<th>Pièces <br>complémentaires</th> 
										<th>Etat <br>&nbsp;&nbsp;&nbsp;&nbsp;  Dossier &nbsp;&nbsp;&nbsp;&nbsp; </th>
									    
                        	</tr>
			</thead>
			<tbody>
				<?php foreach ($mdphs as $mdph): ?>
				
				 <!-- contenu du dossier -->
				 <!-- recheche des demandes d'orientation droit ouvert -->
				 <?php
				   	 $demandeorient = Doctrine_Query::Create()
					->select('d.id as DemandeorientationId,m.id as MdphId,d.datedebutnotif as datedebutnotif,d.datefinnotif as datefinnotif,d.datedecisioncda as datedecisioncda,
			     , d.decisioncda as decisioncda,c.libelle_classe_ext as libelleclasseext,c.id as classe_ext_id')
					->from('DemandeOrientation d')
			       	->innerJoin('d.Mdph m ON d.mdph_id = m.id')
                    ->innerJoin('m.Eleve e ON m.eleve_id = e.id')
				    ->leftjoin('d.Classeext c ON d.classeext_id = c.id')
					->where('m.id =?',$mdph->getId())
				//	 ->andwhere('d.datedebutnotif <=?',date('Y-m-d', time()))
					->andWhere('d.datefinnotif >=?', date('Y-m-d', time()))
					->fetchArray();
                   $count_demandeorient = count($demandeorient);
		          ?>
				  <!-- recheche des demandes d'orientation droit terminé -->
				 <?php
				   	 $demandeorienttermine = Doctrine_Query::Create()
					->select('d.id as DemandeorientationId,m.id as MdphId,d.datedebutnotif as datedebutnotif,d.datefinnotif as datefinnotif,d.datedecisioncda as datedecisioncda,
			, d.decisioncda as decisioncda,c.libelle_classe_ext as libelleclasseext')
					->from('DemandeOrientation d')
					->innerJoin('d.Mdph m ON d.mdph_id = m.id')
                    ->innerJoin('m.Eleve e ON m.eleve_id = e.id')
				   ->leftjoin('d.Classeext c ON d.classeext_id = c.id')
					->where('m.id =?',$mdph->getId())
					->andWhere('d.datefinnotif <?', date('Y-m-d', time()))
					->fetchArray();
                   $count_demandeorienttermine = count($demandeorienttermine);
		          ?>
				 
				 <!-- recheche des demandes avs droit ouvert -->
				 <?php
				   	 $demandeavs = Doctrine_Query::Create()
					->select ('*')
					->from('DemandeAvs d')
			        ->innerJoin('d.Mdph m ON m.id = d.mdph_id')
					->where('m.id =?',$mdph->getId())
					->andwhere('d.datedebutnotif <=?',date('Y-m-d', time()))
					->andWhere('d.datefinnotif >=?', date('Y-m-d', time()))
					->fetchArray();
                   $count_demandeavs = count($demandeavs);
		          ?>
				   <!-- demande avs refusé -->
				  	<?php
				   	 $demandeavsrefuse = Doctrine_Query::Create()
					->select ('*')
					->from('DemandeAvs d')
			        ->innerJoin('d.Mdph m ON m.id = d.mdph_id')
					->where('m.id =?',$mdph->getId())
					->andwhere('d.datedecisioncda is not null')
					->andWhere('d.decisioncda =?',0)
					->fetchArray();
                   $count_demandeavsrefuse = count($demandeavsrefuse);
		          ?>
				   <!-- recheche des demandes avs droit terminé -->
				  	<?php
				   	 $demandeavstermine = Doctrine_Query::Create()
					->select ('*')
					->from('DemandeAvs d')
			        ->innerJoin('d.Mdph m ON m.id = d.mdph_id')
					->where('m.id =?',$mdph->getId())
					->andWhere('d.datefinnotif <?', date('Y-m-d', time()))
					->fetchArray();
                   $count_demandeavstermine = count($demandeavstermine);
		          ?>
				  
				  
				 <!-- recheche des demandes matériel droit ouvert -->
				 <?php
				   	 $demandemat = Doctrine_Query::Create()
					->select ('*')
					->from('DemandeMateriel d')
			        ->innerJoin('d.Mdph m ON m.id = d.mdph_id')
					->where('m.id =?',$mdph->getId())
					//->andwhere('d.datedebutnotif <=?',date('Y-m-d', time()))
					->andWhere('d.datefinnotif >=?', date('Y-m-d', time()))
					->fetchArray();
                   $count_demandemat = count($demandemat);
		          ?>
				  	<!-- recheche des demandes matériel droit refusé -->
				 <?php
				   	 $demandematrefuse = Doctrine_Query::Create()
					->select ('*')
					->from('DemandeMateriel d')
			        ->innerJoin('d.Mdph m ON m.id = d.mdph_id')
					->where('m.id =?',$mdph->getId())
					->andwhere('d.datedecisioncda is not null')
					->andWhere('d.decisioncda =?',0)
					->fetchArray();
                   $count_demandematrefuse = count($demandematrefuse);
		          ?>
				  <!-- recheche des demandes matériel droit terminé -->
				 <?php
				   	 $demandemattermine = Doctrine_Query::Create()
					->select ('*')
					->from('DemandeMateriel d')
			        ->innerJoin('d.Mdph m ON m.id = d.mdph_id')
					->where('m.id =?',$mdph->getId())
					->andWhere('d.datefinnotif <?', date('Y-m-d', time()))
					->fetchArray();
                   $count_demandemattermine = count($demandemattermine);
		          ?>
				  
	           <!-- recheche des demandes transportdroit ouvert -->
				 <?php
				   	 $demandetrans = Doctrine_Query::Create()
					->select ('*')
					->from('DemandeTransport d')
			        ->innerJoin('d.Mdph m ON m.id = d.mdph_id')
					->where('m.id =?',$mdph->getId())
					//->andwhere('d.datedebutnotif <=?',date('Y-m-d', time()))
					->andWhere('d.datefinnotif >=?', date('Y-m-d', time()))
					->fetchArray();
                   $count_demandetrans = count($demandetrans);
		          ?>
				  
				 <!-- recheche des demandes transportdroit termine-->
				 <?php
				   	 $demandetranstermine = Doctrine_Query::Create()
					->select ('*')
					->from('DemandeTransport d')
			        ->innerJoin('d.Mdph m ON m.id = d.mdph_id')
					->where('m.id =?',$mdph->getId())
					->andWhere('d.datefinnotif <?', date('Y-m-d', time()))
					->fetchArray();
                   $count_demandetranstermine = count($demandetranstermine);
		          ?>
				  
				 <!-- recheche des demandes sessad droit ouvert -->
				 <?php
				   	 $demandesessad = Doctrine_Query::Create()
					->select ('*')
					->from('DemandeSessad d')
			        ->innerJoin('d.Mdph m ON m.id = d.mdph_id')
					->where('m.id =?',$mdph->getId())
					//->andwhere('d.datedebutnotif <=?',date('Y-m-d', time()))
					->andWhere('d.datefinnotif >=?', date('Y-m-d', time()))
					->fetchArray();
                    $count_demandesessad = count($demandesessad);
		          ?>
				  
				  
				  <!-- recheche des demandes sessad droit termine -->
				 <?php
				   	 $demandesessadtermine = Doctrine_Query::Create()
					->select ('*')
					->from('DemandeSessad d')
			        ->innerJoin('d.Mdph m ON m.id = d.mdph_id')
					->where('m.id =?',$mdph->getId())
					->andWhere('d.datefinnotif <?', date('Y-m-d', time()))
					->fetchArray();
                    $count_demandesessadtermine = count($demandesessadtermine);
		          ?>
					<!-- DEMANDES EN COURs -->
				 <!-- recheche des demandes d'orientation en cours -->
				 <?php
				   	 $demandeorient_cour = Doctrine_Query::Create()
					->select('d.id as DemandeorientationId,m.id as MdphId,d.datedebutnotif as datedebutnotif,d.datefinnotif as datefinnotif,d.datedecisioncda as datedecisioncda,
			, d.decisioncda as decisioncda,c.libelle_classe_ext as libelleclasseext')
					->from('DemandeOrientation d')
    				->innerJoin('d.Mdph m ON d.mdph_id = m.id')
                  ->innerJoin('m.Eleve e ON m.eleve_id = e.id')
				   ->leftjoin('d.Classeext c ON d.classeext_id = c.id')
					->where('m.id =?',$mdph->getId())
			    	->andwhere ('d.datedecisioncda is null')
					->fetchArray();

                   $count_demandeorient_cour = count($demandeorient_cour);
		          ?>
				  
				  	<!-- recheche des demandes d'orientation refusé -->
				 <?php
				   	 $demandeorient_refuse = Doctrine_Query::Create()
					->select('d.id as DemandeorientationId,m.id as MdphId,d.datedebutnotif as datedebutnotif,d.datefinnotif as datefinnotif,d.datedecisioncda as datedecisioncda,
					, d.decisioncda as decisioncda,c.libelle_classe_ext as libelleclasseext')
					->from('DemandeOrientation d')
    				->innerJoin('d.Mdph m ON d.mdph_id = m.id')
                  ->innerJoin('m.Eleve e ON m.eleve_id = e.id')
				   ->leftjoin('d.Classeext c ON d.classeext_id = c.id')
					->where('m.id =?',$mdph->getId())
					->andwhere('d.datedecisioncda is not null')
					->andWhere('d.decisioncda =?',0)
					->fetchArray();
                    $count_demandeorient_refuse = count($demandeorient_refuse);
		          ?>
				 
				 <!-- recheche des demandes avs  en cours		 -->
				 <?php
				   	 $demandeavs_cour = Doctrine_Query::Create()
					->select ('*')
					->from('DemandeAvs d')
			        ->innerJoin('d.Mdph m ON m.id = d.mdph_id')
					->where('m.id =?',$mdph->getId())
			    	->andwhere ('d.datedecisioncda is null')
					->fetchArray();
                   $count_demandeavs_cour = count($demandeavs_cour);
		          ?>
				 <!-- recheche des demandes matériel  en cours -->
				 <?php
				   	 $demandemat_cour = Doctrine_Query::Create()
					->select ('*')
					->from('DemandeMateriel d')
			        ->innerJoin('d.Mdph m ON m.id = d.mdph_id')
					->where('m.id =?',$mdph->getId())
			    	->andwhere ('d.datedecisioncda is null')
					->fetchArray();
                   $count_demandemat_cour = count($demandemat_cour);
		          ?>
				  
	           <!-- recheche des demandes transport  en cours -->
				 <?php
				   	 $demandetrans_cour = Doctrine_Query::Create()
					->select ('*')
					->from('DemandeTransport d')
			        ->innerJoin('d.Mdph m ON m.id = d.mdph_id')
					->where('m.id =?',$mdph->getId())
		    		->andwhere ('d.datedecisioncda is null')
					->fetchArray();
                    $count_demandetrans_cour = count($demandetrans_cour);
		          ?>
				  
				  	<!-- recheche des demandes transport  refusées -->
				 <?php
				   	 $demandetrans_refuse = Doctrine_Query::Create()
					->select ('*')
					->from('DemandeTransport d')
			        ->innerJoin('d.Mdph m ON m.id = d.mdph_id')
					->where('m.id =?',$mdph->getId())
		    		->andwhere('d.datedecisioncda is not null')
					->andWhere('d.decisioncda =?',0)
					->fetchArray();
                    $count_demandetrans_refuse = count($demandetrans_refuse);
		          ?>
				  
				 <!-- recheche des demandes sessad en cours -->
				 <?php
				   	 $demandesessad_cour = Doctrine_Query::Create()
					->select ('*')
					->from('DemandeSessad d')
			        ->innerJoin('d.Mdph m ON m.id = d.mdph_id')
					->where('m.id =?',$mdph->getId())
		    		->andwhere ('d.datedecisioncda is null')
					->fetchArray();
                    $count_demandesessad_cour = count($demandesessad_cour);
		          ?>  
				  
				 <!-- recheche des demandes sessad refusées-->
				 <?php
				   	 $demandesessad_refuse = Doctrine_Query::Create()
					->select ('*')
					->from('DemandeSessad d')
			        ->innerJoin('d.Mdph m ON m.id = d.mdph_id')
					->where('m.id =?',$mdph->getId())
		    		  ->andwhere('d.datedecisioncda is not null')
					->andWhere('d.decisioncda =?',0)
					->fetchArray();
                    $count_demandesessad_refuse = count($demandesessad_refuse);
		          ?>  
				  
				  
				<!-- vérification que le dossier MPDH contient au moins une demande -->
                 <?php $demandes =  $count_demandesessad + $count_demandetrans +$count_demandemat + $count_demandeavs +  $count_demandeorient ; ?>
         				
				<!-- recheche des bilans sans date concernant le dossier mdph selectionné --> 
				<?php
				 $bilanko = Doctrine_Core::getTable('Bilan')->getBilanSansDate($mdph->getId());
				 $count_bilanko = count($bilanko);
				?>

				<!-- recheche des bilans avec date concernant le dossier mdph selectionné --> 
				<?php
				 $bilanok = Doctrine_Core::getTable('Bilan')->getBilanAvecDate($mdph->getId());
				 $count_bilanok = count($bilanok);
				?>					
			    <!-- recheche du nombre de bilans  concernant le dossier mdph selectionné --> 
				<?php
				 $bilan = Doctrine_Core::getTable('Bilan')->getBilan($mdph->getId());
				 $count_bilan = count($bilan);
				?>	  
				<!--	<tr onclick="<?php //echo jq_remote_function(array('url' => 'mdph/show?id=' . $mdph->getId(), 'update' => 'div_mdph')) ?>"  style="cursor: pointer; color: #000; background:#e0e0e0"> -->
                 <tr onclick="<?php echo jq_remote_function(array('url' => 'mdph/edit?id=' . $mdph->getId(), 'update' => 'div_mdph')) ?>"  style="cursor: pointer; color: #000; background:#e0e0e0">                        
                                              <td width=4%> <?php echo $mdph->getID() ?> </td>
												<td width=12%>
												<?php if ($count_demandeavs > 0): ?>
												 <input type="checkbox" name="avs" value="Avs" checked="checked" disabled="disabled"  >Accompagn.&nbsp;<br> <?php echo  '<small>'.format_date( $demandeavs[0]['datedebutnotif'],'dd/MM/yy').'&nbsp;au&nbsp;'.format_date( $demandeavs[0]['datefinnotif'],'dd/MM/yy').'</small><br>' ?>
												<?php endif; ?>
												<?php if ($count_demandemat > 0): ?>
												 <input type="checkbox" name="mat" value="Mat" checked="checked" disabled="disabled"  >Matériel<br><?php echo  '<small>'.format_date( $demandemat[0]['datedebutnotif'],'dd/MM/yy').'&nbsp;au&nbsp;'.format_date( $demandemat[0]['datefinnotif'],'dd/MM/yy').'</small><br>' ?>
												<?php endif; ?>
												<?php if ($count_demandeorient > 0): ?>
												
												
 									         
											   <?php  foreach ($demandeorient as $demande_orientations): ?>
											   <input type="checkbox" name="orient" value="Orient" checked="checked" disabled="disabled"  >
														<?php echo ''. $demande_orientations['libelleclasseext'] .'<small><br>'. format_date( $demande_orientations['datedebutnotif'],'dd/MM/yy').'&nbsp;au&nbsp;'.format_date( $demande_orientations['datefinnotif'],'dd/MM/yy').'<br></small>'?>
												<?php endforeach; ?> 
												   
												<?php endif; ?>
												<?php if ($count_demandetrans > 0): ?>
												 <input type="checkbox" name="trans" value="Trans" checked="checked" disabled="disabled"  >&nbsp;Transport<br><?php echo  '<small>'.format_date( $demandetrans[0]['datedebutnotif'],'dd/MM/yy').'&nbsp;au&nbsp;'.format_date( $demandetrans[0]['datefinnotif'],'dd/MM/yy').'</small><br>' ?>
												<?php endif; ?>												
												<?php if ($count_demandesessad > 0): ?>
												 <input type="checkbox" name="sessad" value="Sessad" checked="checked" disabled="disabled"  >&nbsp;Sessad<br><?php echo  '<small>'.format_date( $demandesessad[0]['datedebutnotif'],'dd/MM/yy').'&nbsp;au&nbsp;'.format_date( $demandesessad[0]['datefinnotif'],'dd/MM/yy').'</small><br>' ?>
												<?php endif; ?>	
												
												</td>
												<td width=11%>
												<?php if ($count_demandeavs_cour > 0): ?>
												 <input type="checkbox" name="avs" value="Avs" checked="checked" disabled="disabled"  >Accomp.&nbsp;<br>
												<?php endif; ?>
												<?php if ($count_demandemat_cour > 0): ?>
												 <input type="checkbox" name="mat" value="Mat" checked="checked" disabled="disabled"  >Matériel<br>
												<?php endif; ?>
												<?php if ($count_demandeorient_cour > 0): ?>
												 
										    
												<?php  foreach ( $demandeorient_cour as  $demandeorient_cours): ?>
												<input type="checkbox" name="orient" value="Orient" checked="checked" disabled="disabled" >  
														<?php echo ''. $demandeorient_cours['libelleclasseext'].'<br>'  ?>
												<?php endforeach; ?> 
										     
												<?php endif; ?>
												<?php if ($count_demandetrans_cour > 0): ?>
												 <input type="checkbox" name="trans" value="Trans" checked="checked" disabled="disabled"  >&nbsp;Transport<br>
												<?php endif; ?>												
												<?php if ($count_demandesessad_cour > 0): ?>
												 <input type="checkbox" name="sessad" value="Sessad" checked="checked" disabled="disabled"  >&nbsp;Sessad<br>
												<?php endif; ?>	
												
												</td>
												
												<td width=12%>
												<?php if ($count_demandeavsrefuse > 0): ?>
												 <input type="checkbox" name="avs" value="Avs" checked="checked" disabled="disabled"  >&nbsp;Accomp.&nbsp;<br><?php echo  '<small>'.format_date( $demandeavsrefuse[0]['datededecisioncda'],'dd/MM/yy').'</small><br>' ?>
												<?php endif; ?>
												<?php if ($count_demandematrefuse> 0): ?>
												 <input type="checkbox" name="mat" value="Mat" checked="checked" disabled="disabled"  >&nbsp;Matériel<br><?php echo  '<small>'.format_date( $demandematrefuse[0]['datededecisioncda'],'dd/MM/yy').'</small><br>' ?>
												<?php endif; ?>
												<?php if ($count_demandeorient_refuse > 0): ?>
												 <input type="checkbox" name="orient" value="Orient" checked="checked" disabled="disabled"  >
										      
												<?php  foreach ( $demandeorient_refuse as  $demandeorient_refuses): ?>
														<?php echo ''.  $demandeorient_refuses['libelleclasseext'].'<br>'  ?><?php echo  '<small>'.format_date( $demandeorient_refuses['datededecisioncda'],'dd/MM/yy').'</small><br>' ?>
												<?php endforeach; ?> 
										    
												<?php endif; ?>
												<?php if ($count_demandetrans_refuse > 0): ?>
												 <input type="checkbox" name="trans" value="Trans" checked="checked" disabled="disabled"  >&nbsp;Transport<br><?php echo  '<small>'.format_date( $demandetrans_refuse [0]['datededecisioncda'],'dd/MM/yy').'</small><br>' ?>
												<?php endif; ?>												
												<?php if ($count_demandesessad_refuse > 0): ?>
												 <input type="checkbox" name="sessad" value="Sessad" checked="checked" disabled="disabled"  >&nbsp;Sessad<br><?php echo  '<small>'.format_date( $demandesessad_refuse [0]['datededecisioncda'],'dd/MM/yy').'</small><br>' ?>
												<?php endif; ?>	
												
												</td>
												
												</td>
												<td width=12%>
												<?php if ($count_demandeavstermine > 0): ?>
												 <input type="checkbox" name="avs" value="Avs" checked="checked" disabled="disabled"  >&nbsp;Accomp.&nbsp;<br><?php echo  '<small>'.format_date( $demandeavstermine[0]['datedebutnotif'],'dd/MM/yy').'&nbsp;au&nbsp;'.format_date( $demandeavstermine[0]['datefinnotif'],'dd/MM/yy').'</small><br>' ?>
												<?php endif; ?>
												<?php if ($count_demandemattermine > 0): ?>
												 <input type="checkbox" name="mat" value="Mat" checked="checked" disabled="disabled"  >&nbsp;Matériel<br><?php echo  '<small>'.format_date( $demandemattermine[0]['datedebutnotif'],'dd/MM/yy').'&nbsp;au&nbsp;'.format_date( $demandemattermine[0]['datefinnotif'],'dd/MM/yy').'</small><br>' ?>
												<?php endif; ?>
												<?php if ($count_demandeorienttermine > 0): ?>
												 <input type="checkbox" name="orient" value="Orient" checked="checked" disabled="disabled"  > 
												 
												 <?php  foreach ( $demandeorienttermine as  $demandeorienttermines): ?>
														<?php echo  $demandeorienttermines['libelleclasseext'].'<br>' ?><?php echo  '<small>'.format_date( $demandeorienttermines['datedebutnotif'],'dd/MM/yy').'&nbsp;au&nbsp;'.format_date( $demandeorienttermines['datefinnotif'],'dd/MM/yy').'</small><br>' ?>
												<?php endforeach; ?> 
											
												<?php endif; ?>
												<?php if ($count_demandetranstermine > 0): ?>
												 <input type="checkbox" name="trans" value="Trans" checked="checked" disabled="disabled"  >&nbsp;Transport<br><?php echo  '<small>'.format_date( $demandetranstermine[0]['datedebutnotif'],'dd/MM/yy').'&nbsp;au&nbsp;'.format_date( $demandetranstermine[0]['datefinnotif'],'dd/MM/yy').'</small><br>' ?>
												<?php endif; ?>												
												<?php if ($count_demandesessadtermine > 0): ?>
												 <input type="checkbox" name="sessad" value="Sessad" checked="checked" disabled="disabled"  >&nbsp;Sessad<br><?php echo  '<small>'.format_date( $demandesessadtermine[0]['datedebutnotif'],'dd/MM/yy').'&nbsp;au&nbsp;'.format_date( $demandesessadtermine[0]['datefinnotif'],'dd/MM/yy').'</small><br>' ?>
												<?php endif; ?>	
												
												</td>
												<!--Pièces jointes obligatoires !-->
                                                <td width=15%>
												<?php $dossierok = 0 ?>
												<?php if ($mdph->getDatepjdom() ){  //justificatif de dom?>
											    <?php echo '- Dom :&nbsp;<small><small>'.format_date( $mdph->getDatepjdom(),'dd/MM/yy').'</small></small><br>' ?>
												<?php }else{?>
												- Dom.&nbsp;:&nbsp;<small><font color="red">non fourni&nbsp;</small></font><br>
												<?php $dossierok = 1 ?>
												<?php } ?>
									             <?php if ($mdph->getDatepjident()){  //justificatif identité ?>
												<?php echo '- Ident :&nbsp;<small><small>'.format_date( $mdph->getDatepjident(),'dd/MM/yy').'</small></small><br>' ?>
												 	<?php }else{?>
												- Ident :&nbsp;<small><font color="red">non fourni&nbsp;</small></font><br>
												 <?php $dossierok = 1 ?>
												<?php } ?>
									             <?php if ($mdph->getDatecreationpps()){  //cerfa ?>
												<?php echo '- Cerfa :&nbsp;<small><small>'.format_date( $mdph->getDatecreationpps(),'dd/MM/yy').'</small></small><br>'?>
												 	<?php }else{?>
												- Cerfa :&nbsp;<small><font color="red">non fourni&nbsp;</small></font><br>
												 <?php $dossierok = 1 ?>
												<?php } ?>
										       <?php if ($mdph->getDatebilanmedical()){  //bilan mdédical ?>
												 <?php echo '- BM. &nbsp;&nbsp;:&nbsp;<small><small>'.format_date( $mdph->getDatebilanmedical(),'dd/MM/yy').'</small></small><br>'?>
												 	<?php }else{?>
												- B. M. :&nbsp;<small><font color="red">non fourni&nbsp;</small></font><br>
												 <?php $dossierok = 1 ?>
												<?php } ?>
												</td>
												<!--colonne Pièces complémentaires !-->
												<td width=12%>
												
										        <?php if ( $count_bilanko > 0){ ?>
												<?php  foreach ( $bilanko as  $bilankos): ?>
													<?php echo '<small>-&nbsp;'.substr($bilankos['libellenaturebilan'],0,8).'.&nbsp;:<small><font color="red">&nbsp; Non Daté</font></small></small><br>' ?>
												<?php endforeach; ?> 
												 <?php $dossierok = 1 ?>
												 <?php } ?>
												 
												 <?php if ( $count_bilanok > 0){ ?>
												 
												 <?php  foreach ( $bilanok as  $bilanoks): ?>
													<?php echo '<small>-&nbsp;'. substr($bilanoks['libellenaturebilan'],0,8).'.&nbsp;<small>:&nbsp;'.format_date( $bilanoks['date_bilan'],'dd/MM/yy') .'</small></small><br>' ?>
												<?php endforeach; ?> 
												
												<?php } ?>
												
												</td> 
												<!--colonne Etat du dossier  !-->
												<td width=10%>
												<?php if (  $count_bilanko > 0 || $dossierok == 1 ){ ?>
												 <input type="checkbox" name="dossier" value="Bilan"   checked="checked" disabled="disabled"  >&nbsp;<small>incomplet&nbsp;</small>
												<?php } ?>
												 
												 <?php if ( $dossierok == 0 ){ ?>
												 <input type="checkbox" name="dossier" value="Bilan"  checked="checked" disabled="disabled"  >&nbsp;<small>complet</small>&nbsp;
												  <?php } ?>
												  <?php //echo $dossierok . 'ff'.$count_bilanko.'demande'.$demandes?>
												</td>
											<!--    <td>  <?php //echo format_date($mdph->getDateenvoiedossier(),'dd/MM/yy') ?> </td> -->
                                      
		
					</tr>
					<?php $i++ ?>
				<?php endforeach; ?>
				<?php if ($i == 1): ?>
					<tr><td colspan="7" style="font-style: italic">Cet élève n'a pas de dossier mdph</td></tr>
				<?php endif; ?>

				
			</tbody>
		</table>
	</fieldset>

<?php
echo jq_button_to_remote('Nouveau dossier ', array(
    'url' => 'mdph/new?eleve_id=' . $sf_request->getParameter('eleve_id'),
    'update' => 'div_mdph',
))
?>
<!-- Le second script pour le pop up d'aide -->
<script>

		
	function aide_mdph() {
	var src = "<?php echo url_for('mdph/aide') ?>";
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