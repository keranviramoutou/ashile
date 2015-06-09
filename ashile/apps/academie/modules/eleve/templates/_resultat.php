<?php use_helper('jQuery') ?>
<?php use_stylesheet('data_table.css') ?>
<?php use_stylesheet('datatable_jui.css') ?>
<?php use_javascript('jquery.dataTables.min.js') ?>
<?php use_helper('Date') ?>
<?php //$form = $form->getObject() ?>

	
			  
<?php echo '&nbsp;&nbsp;'.link_to('<button padding="1"><small>Fiche élève ASH</small></button> ', 'eleve/edit?id='. $resultat[0]['id'].'&eleve_nom='. $resultat[0]['nom'].'&eleve_prenom=' .$resultat[0]['prenom'].'&retour='. 1).'&nbsp;' ?>&nbsp;
<?php 	if( $resultat[0]['eleve_id'] ){	?>	
 <button type="button" onclick="document.body.style.cursor='wait';location.href='<?php echo link_to_frontend('', array('module' => 'eleve', 'action' => 'edit', 'id' => $resultat[0]['id'],  'academie' => 'true'))."#div_eleve"  ?>'"> Fiche élève ERF</button>
<script type="text/javascript">

   $j(document).ready(function() {
       oTable = $j('#maTable').dataTable({
           "bJQueryUI": true,
           "sPaginationType": "full_numbers",

           "oLanguage" : {
               "sProcessing":     "Traitement en cours...",
               "sLengthMenu":     "<?php echo '-&nbsp;Elève : &nbsp;'. '<font size =+1>'.$resultat[0]['nom'].' '.$resultat[0]['prenom'].'</font>&nbsp; ('.$resultat[0]['eleve_id'].')&nbsp;'.'&nbsp;<br>- né(e) le :&nbsp;'.format_date($resultat[0]['datenaissance'],'dd/MM/yyyy').'&nbsp;<br>- Secteur sur la fiche élève:&nbsp;'.$resultat[0]['libellesecteur'].'</strong>' ?>",
               "sZeroRecords":    "",
               "sInfo":           "",
               "sInfoEmpty":      "",
               "sInfoFiltered":   "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
               "sInfoPostFix":    "",
               "sSearch":         "Rechercher&nbsp;:",
               "sLoadingRecords": "Téléchargement...",
               "sUrl":            "",
               "oPaginate": {
                   "sFirst":    "",
                   "sPrevious": "",
                   "sNext":     "",
                   "sLast":     ""
               }
           }
       });
   } );
</script>


<div id="recherche_resultat">


		<?php 	if($_POST['nom_eleve']){	?>
			<?php $recherche = ' le Nom de l\'élève contenant : <strong>'.$_POST['nom_eleve'].'</strong>' ?>
		<?php }?>
		<?php 	if($_POST['prenom_eleve']){	?>	
		<?php $recherche = $recherche . '&nbsp;le Prénom de l\'élève contenant: <strong>'.$_POST['prenom_eleve'].'</strong>'?>
		<?php }?>
		
		<?php // echo '<u>Résultat de la Recherche correspondant à :&nbsp;</u>'.$recherche .''?>
	
		<?php
		//historique des acc pour l'élève selectionné
		//---------------------------------------------
		$eleve_avs_histo = Doctrine_Core::getTable('EleveAvs')->getEleveAvecAcc($resultat[0]['eleve_id']);
		$count_avs_histo = count($eleve_avs_histo);
	   ?>
	   <?php
		//historique des demandes avs traitées l'élève selectionné
		//-----------------------------------------------------------------------
		$dem_avs_histo = Doctrine_Core::getTable('DemandeAvs')->getHistoDemandeAvs($resultat[0]['eleve_id']);
		$count_dem_avs_histo = count($dem_avs_histo);
	   ?>
	   
		<?php
		//Dernière demande matériel en cours à la date du jour pour l'élève selectionné
		//-----------------------------------------------------------------------
		$dem_mat = Doctrine_Core::getTable('DemandeMateriel')->getDerDemandeMat($resultat[0]['eleve_id']);
		$count_dem_mat = count($dem_mat);
	   ?>
	   
		<?php
		//liste des matériels alloués en cours pour l'élève selectionné
		//---------------------------------------------------------------
		$eleve_mat = Doctrine_Core::getTable('EleveMateriel')->getListMaterielencoursEleve($resultat[0]['eleve_id']);
		$count_eleve_mat_encours = count($eleve_mat);
	   ?>
	   
		  <?php
		//les matériels qui ne sont pas encore édités sur une convention
		//---------------------------------------------------------------
		$materielssansconv = Doctrine::getTable('EleveMateriel')->getMatSansConvParEleve($resultat[0]['eleve_id']);
		$countmaterielssansconv = count($materielssansconv);
		?>
		
		
		<?php
		//liste des scolarisation de l'élève 
		//-----------------------------------
		$dersco = Doctrine_Core::getTable('Orientation')->getListeSco($resultat[0]['eleve_id']);
		$count_list_sco = count($dersco);
	   ?>
	   
					<?php
				//dernière scolarisation de l'élève en cours à la date du jour
				//--------------------------------------------------------------
				$dersco1 = Doctrine_Core::getTable('Orientation')->getDerSco($resultat[0]['eleve_id']);
				$count_dersco = count($dersco1);
			   ?>   
			   
       <?php     

	   //liste des contarts avec l' Historique des positions
	   //----------------------------------------------------   
            $PosAvs = Doctrine_Core::getTable('EleveAvs')->getListeContratsAccavecPos($resultat[0]['eleve_id']);
			$count_PosAvs = count($PosAvs);
		?>  
		  
	   <?php if($resultat[0]['secteur_id'] != $dersco1[0]['secteur_id_etab']){
		echo '<BLINK ><font color ="red">Attention INCOHERENCE</BLINK></font> entre le secteur sur la fiche élève :'.$resultat[0]['libellesecteur']. ' et le secteur de l\'établissement (scolarité en cours) '.$dersco1[0]['libellesecteur_etab'].'<br></br>';
		}

?>
			   
		<table cellpadding="0" cellspacing="0" border="0" class="display" id="maTable">
		  <thead>
             <!-- entête scolarisation -->
			  <th>
				<?php if($count_list_sco > 0) { ?>
				<u><a href="<?php echo url_for('orientation/list1?eleve_id=' . $resultat[0]['eleve_id'].'&eleve_nom=' . $resultat[0]['nom'].'&eleve_prenom=' . $resultat[0]['prenom']. '&retour='. 1 ) ?>" onclick="document.body.style.cursor='wait'">&nbsp;<?php echo 'Scolarisation(s)<br><br>' ?></a></u>

				<?php }else{ echo 'Scolarisation(s)<br>' ?>
				<?php  } ?>
				<?php echo link_to('<button padding="1"><small>Créer</small></button> ', 'orientation/new?eleve_id=' . $resultat[0]['eleve_id']. '&eleve_nom=' . $resultat[0]['nom'].'&eleve_prenom=' . $resultat[0]['prenom']. '&retour='. 1 )  ?>

			  </th>
			   <!-- entête accompagnement -->
			  <th>	
				<?php if($count_avs_histo > 0 ) { ?>
				<u><a href="<?php echo url_for('eleve_avs/list?eleve_id=' . $resultat[0]['eleve_id'] .'&secteur_id=' . $resultat[0]['secteur_id'].'&eleve_nom=' . $resultat[0]['nom'].'&eleve_prenom=' . $resultat[0]['prenom']. '&retour='. 1 ) ?>" onclick="document.body.style.cursor='wait'">&nbsp;<?php echo 'Accompagnement(s)<br><br>' ?> </a></u>
            	 <?php if($count_PosAvs > 0 ) { ?>
				  <?php echo link_to('<p><u>Histo. Position contrat</u><br>', 'eleve_avs/listpos?eleve_id='.$resultat[0]['eleve_id']. '&retour='. 1, 
				  array('popup' => array('popupWindow', 'width=600,height=300,left=350,top=60','scrollbars=yes')) )  ?>
				 <?php } ?>
				<?php }else { echo 'Accompagnement(s)<br>'?>
				<?php } ?>
				<?php //if($count_dem_avs > 0) {  //création possible si demande avs en cours notifiée ?>
				<?php echo link_to('<button padding="1"  ><small>Créer</small></button> ', 'eleve_avs/new?eleve_id=' . $resultat[0]['eleve_id'] .'&secteur_id=' . $resultat[0]['secteur_id']. '&eleve_nom=' .$resultat[0]['nom'].'&eleve_prenom=' .$resultat[0]['prenom'] . '&retour='. 1) ?>
				<?php //}else{ ?>
				<?php // echo '<small><br>impossible de affecter un avs,</br> pas de demande en cours notifiée</small>' ?>
				<?php //} ?>
			  </th>
			   <!-- entête demande AVS -->
			  <th>
    		 <?php if($count_dem_avs_histo > 0 ) { ?> 
			  <u><a href="<?php echo url_for( 'demandeavs/list1?eleve_id=' . $resultat[0]['eleve_id'].'&secteur_id=' . $resultat[0]['secteur_id'].'&eleve_nom=' . $resultat[0]['nom'].'&eleve_prenom=' . $resultat[0]['prenom'] ) ?>" onclick="document.body.style.cursor='wait'">&nbsp;<?php echo 'Demande(s) AVS <br><br>' ?></a></u>
              <?php }else{ echo 'Demande(s) <br>d\'accompagnant <br><br>' ?>
			 <?php  } ?>
			 <?php echo '&nbsp;'.link_to('<button padding="1"><small>Créer</small></button>', 'mdph/new?eleve_id=' . $resultat[0]['eleve_id'] .'&eleve_nom=' . $resultat[0]['nom'].'&eleve_prenom=' . $resultat[0]['prenom'].'&flag_recherche=1', array('method' => 'delete', 'confirm' => 'un nouveau dossier MDPH sera créé pour cette nouvelle demande Etes vous sur ?') ) ?> 
			  </th>
			  
			   <!-- entête matériel(s) en prêt -->
			  <th>
			  <?php if($count_eleve_mat_encours > 0) { ?>
			  	<u><a href="<?php echo url_for( 'eleve_materiel/list1?eleve_id=' . $resultat[0]['eleve_id'].'&secteur_id=' . $resultat[0]['secteur_id'].'&eleve_nom=' . $resultat[0]['nom'].'&eleve_prenom=' .$resultat[0]['prenom'] ) ?>" onclick="document.body.style.cursor='wait'">&nbsp;<?php echo '<font color ="green"> Prêt Matériel(s)</font></small><br>' ?></a></u>
              <?php }else{ echo '<font color ="green"> Prêt Matériel(s) </font></small><br><br>' ?>		     
			 <?php } ?>
			  <?php echo ''. link_to('<button style="width:50px"><small>Créer</small></button>', 'eleve_materiel/new?eleve_id='.$resultat[0]['eleve_id'].'&secteur_id=' . $resultat[0]['secteur_id'].'&eleve_nom=' . $resultat[0]['nom'].'&eleve_prenom=' . $resultat[0]['prenom'] )  ?>

			  </th>
			  
			  
			  <th><font color ="green"> Demande(s) Matériel </font></small><br><br>
			  <?php echo '<font color ="green">'.link_to('<button><small>Créer</small></button>', 'demandemateriel/new?eleve_id=' . $resultat[0]['eleve_id'] .'&eleve_nom=' . $resultat[0]['nom'].'&eleve_prenom=' . $resultat[0]['prenom'].'&mdph_id='.$resultat[0]['mdph_id'].'&flag_recherche=1', array( 'confirm' => 'une nouvelle demande matériel sera créé pour le dossier dernier dossier MDPH Etes vous sur ?') ) ?>
			 </th>
	
			</tr>
		  </thead>

		
		
		<?php foreach($resultat as $eleve):?>
			 <!-- modal content -->
			<tr>
				
			    <?php
			 
				//liste des matériels alloués pour l'élève selectionné
				//----------------------------------------------------------------------------------
				//$eleve_mat = Doctrine_Core::getTable('EleveMateriel')->getListMaterielEleve($eleve['id']);
				//$count_eleve_mat = count($eleve_mat);
			   ?>
			   
			   	<?php
			 
				//liste des matériels en stock à la date du jour en fonction du type de la demande matériel
				//-----------------------------------------------------------------------------------------
				$eleve_mat_en_stock = Doctrine_Core::getTable('Materiel')-> getMaterielenStock($dem_mat[0]['typemateriel_id']);
				$count_eleve_mat_en_stock = count($eleve_mat_en_stock);
			   ?>			   
				
				<?php
				//Liste des demande matériel en attente de traitement CDA  pour l'élève selectionné
				//----------------------------------------------------------------------------------
				$dem_mat_cda = Doctrine_Core::getTable('DemandeMateriel')->getListDemandeMatCDA($eleve['id']);
				$count_dem_mat_cda = count($dem_mat_cda);
			   ?>
			
				
				<?php
				//dernière scolarisation de l'élève en cours à la date du jour
				//--------------------------------------------------------------
				$dersco1 = Doctrine_Core::getTable('Orientation')->getDerSco($eleve['id']);
				$count_dersco = count($dersco1);
			   ?>
	  
	  			<?php
				// Scolarité en milieu spécialisé
				//----------------------------------
				$modnonscos = Doctrine_core::getTable('Modnonsco')->getScoencour($eleve['id']) ;  
				?>
			   
			    <?php
				//dernier accompagnement en cours de l'élève  à la date du jour
				//---------------------------------------------------------------------
				$eleve_avs = Doctrine_Core::getTable('EleveAvs')->getEleveAcc($eleve['eleve_id']);
				$count_avs = count($eleve_avs);
			   ?>
			   
			  <?php
				//liste des Dernières demande AVS en cours à la date du jour pour l'élève selectionné
				//-----------------------------------------------------------------------
				$dem_avs = Doctrine_Core::getTable('DemandeAvs')->getListDerDemandeAcc($eleve['eleve_id']);
				$count_dem_avs = count($dem_avs);
			   ?>
			   
			   	<?php
				//Dernière demande AVS en attente de traitement CDA pour l'élève selectionné
				//-----------------------------------------------------------------------
				$dem_avs_cda = Doctrine_Core::getTable('DemandeAvs')->getListDemandeAccCDA($eleve['eleve_id']);
				$count_dem_avs_cda = count($dem_avs_cda);
			   ?>
			   

   					
				<!-- la scolarité en milieu ordinaire -->
				<!-------------------------------------->
				<td><?php echo '<br>*&nbsp;'.'<u>En milieu ordinaire</u><br>'; ?>
				
				<?php if ($count_dersco > 0){ ?>

				&nbsp;<a href="<?php echo url_for('orientation/edit?id=' . $dersco1[0]['orienId'].'&eleve_id=' .$eleve['eleve_id'] .'&secteur_id=' .$eleve['secteur_id']. '&eleve_nom=' .$eleve['nom'].'&eleve_prenom=' . $eleve['prenom']. '&retour='. 1 ) ?>" onclick="document.body.style.cursor='wait'"><?php echo ''.$dersco1[0]['typetab'].'&nbsp'.$dersco1[0]['nometabsco'].'&nbsp;' .'</a>'.'<br>&nbsp;<small>('.$dersco1[0]['rne'].')</small>&nbsp;'?>
				<?php echo '<small>'.$dersco1[0]['libellesecteur_etab'].'</small><br>'?>
				<?php echo '&nbsp; - classe :&nbsp;'.$dersco1[0]['nomlongtypeclasse'].'</br>'?>
				<?php echo '&nbsp; - Niveau scolaire :&nbsp;'.$dersco1[0]['nomniveauscolaire'].'</br>'?>
				<?php }else{ 
				echo 'pas scolarisé(e) *'; ?>
				<?php  } ?>

				
				<!-- la scolarité en milieu spécialisé -->
				<!-------------------------------------->				
				<?php	
			
				$nbModnonsco = count($modnonscos);
			
				if ($nbModnonsco > 0){
				echo '<br>*&nbsp;'.'<u>En milieu spécialisé</u><br>';
				$nbModnonsco = 0;
				foreach ($modnonscos as $modnonsco):
					if( $modnonsco->getEtabnonscoId() > 0):
						$etab = '-&nbsp;' . $modnonsco->getEtabnonsco(). '</b>&nbsp;';
					endif;
					if( $modnonsco->getClassespeId() > 0):
						$classespe = '<br>- Classe :&nbsp;   ' . $modnonsco->getClassespe() . '&nbsp;';
					endif;
					if( $modnonsco->quothorreff > 0):
						$quotiteh = '<br>- Quotite :&nbsp; ' . $modnonsco->getQuothorreff() . '&nbsp;Heure(s)&nbsp;';
					endif;
					
					if( $modnonsco->quothorreff > 0):
						$nbdemijournée = '<br>- Nb de Demi-journée :&nbsp;' . $modnonsco->getDemijournee() . '&nbsp;';
					endif;
					echo ''.$etab.$classespe. $quotiteh.  $nbdemijournée.'<br>' ;
					$nbModnonsco++;
				endforeach;
				}else{
					echo '<i><br><br>- Pas de scolarisation en milieu spécialisé</i> ';
				}; ?>
					<?php if ($eleve['datesortie']){
					echo '<br><font color ="RED">- Fin de prise en charge par l\'ASH &nbsp;:&nbsp;'.format_date($eleve['datesortie'],'dd/MM/yyyy').'</font><br>';
					  } ?>
					<?php if ($eleve['etat_acc']){
					echo '<br><font color ="RED">- Fin de prise en charge AVS &nbsp;:&nbsp;'.format_date($eleve['etat_acc'],'dd/MM/yyyy').'</font><br>';
					  } ?>
					<?php if ($eleve['etat_mat']){
					echo '<br><font color ="RED">- Fin de prise en charge matériel&nbsp;:&nbsp;'.format_date($eleve['etat_mat'],'dd/MM/yyyy').'</font><br>';
					  } ?> 
		          <!--  affiche d'un message si demande AVS en cours à une condition suspensive -->
		           <?php if ($count_dem_avs > 0){
		             foreach($dem_avs as $dem_avss):?>
						 <?php if ($dem_avss['conditionsuspensive']){ $count_suspensive = $count_suspensive +1;}
						 
					endforeach; 
					 		if ($count_suspensive > 0){
							echo '<FONT COLOR="red" ><blink> - Demande AVS notifiée avec close suspensive:&nbsp;'.'</FONT></blink>';
				             }
							} ?>
		 
					
					
										
					<!-- scolarisation -->
					</td>
	
					<!-- accompagnement en cours -->
					<td>
					<?php foreach($eleve_avs as $eleve_avss):?>
					 </small><a href="<?php echo url_for('eleve_avs/edit?id='.$eleve_avss['eleveAvsId'].'&eleve_id=' . $eleve_avss['EleveId'] . '&avs_id=' . $eleve_avss['avs_id']. '&eleve_nom=' .$eleve['nom'].'&eleve_prenom=' . $eleve['prenom'] . '&retour='. 1); ?>" onclick="document.body.style.cursor='wait'"><?php echo '<small>'.$eleve_avss['avsnom'].'&nbsp;'.$eleve_avss['avsprenom'].'' ?></a><?php echo '&nbsp;('.$eleve_avss['avs_id'].')</small><br>'?>
					<?php echo '<small>-&nbsp '.'du&nbsp;'.format_date($eleve_avss['datedebut'],'dd/MM/yyyy').'&nbsp;au&nbsp'.
					format_date($eleve_avss['datefin'],'dd/MM/yyyy').'&nbsp;<br>pour&nbsp;'.$eleve_avss['quotite'].'&nbsp;Heure(s)</small>' ?>
				    </br>
					<?php
					
				    //dernier contrat de l'avs en cours à la date du jour
				    //--------------------------------------------------------------
					if ($count_avs > 0){
					 $contrat_avs= Doctrine_Core::getTable('ContratAvs')->ContratsAcc($eleve_avss['avs_id']);
					 $count_contratavs = count($contrat_avs);
					}
					?>
					<?php echo '<small>- Type contrat : &nbsp'.$contrat_avs[0]['typecontrat'].'</small>' ?><br>
					<?php echo '<small>- Temps hebd : &nbsp'.$contrat_avs[0]['temps_hebdo'].'&nbsp;Heure(s)</small></br>' ?>
					<?php echo '<small>du &nbsp'.format_date($contrat_avs[0]['date_debut_contrat'],'dd/MM/yyyy').'&nbsp;au&nbsp;'.format_date($contrat_avs[0]['date_fin_contrat'],'dd/MM/yyyy').'</small>' ?>
					<?php if($count_avs > 1) { ?>
					 <?php echo '<br>&nbsp;&nbsp;------------------------</br>' ?>
					 <?php  } ?>
					<?php endforeach; ?>
					
					<!-- accompagnement liste -->
						
					<!-- calcul de la quotité horaire restant à affecter à l'élève -->	
					<?php $quotite_avs = 0 ;     ?>
					<?php foreach($eleve_avs as $eleve_avss):?>
					<!-- calcul du total horaire affecté -->
					<?php $quotite_avs = $quotite_avs + $eleve_avss['quotite'] ;     ?>
					<?php endforeach; ?>
					
					<!-- calcul et affichage de la quotité horaire restant à affecter à l'élève -->	  
					<?php foreach($dem_avs as $dem_avss):?>
						 <?php $dispo = $dem_avss['quotitehorrairenotifie'] - $quotite_avs; 
							if ($dispo < 0){
							$dispo= '<small><FONT COLOR="red" ><blink>'.$dispo.'&nbsp;Heure(s)</FONT></blink></small>';
							}else{ //disponible horaire positif
							$dispo= '<small><br>Quotité horaire à affecter:&nbsp;'.$dispo.'&nbsp;Heure(s)</small>';
							}
							 endforeach; 
						   $dispo = 0 ;$quotite_avs = 0?>
					
					</td>

					
				<!-- Affichage des demande AVS -->
					
				<td>
				
			    <!-- affichage des demandes avs avec la décision en cours à la date du jour -->
					 <?php if ($count_dem_avs > 0){ ?>
					 <?php foreach($dem_avs as $dem_avss):?>	
						    <?php if($dem_avss['decisioncda'] == 1 ): ?>
							<?php $decisioncda='&nbsp;Acceptée&nbsp;'; ?>
			               <?php else: ?>
							<?php $decisioncda='&nbsp;Refusée&nbsp;'; ?>
							<?php endif; ?>
					
					 <a href="<?php echo url_for('suiviDSM/edit?eleve_id='.$sf_request->getParameter('eleve_id').'&id=' . $dem_avss['DemandeAvsId'].'&eleve_nom=' . $eleve['nom'].'&eleve_prenom=' . $eleve['prenom']. '&retour='. 1  ) ?>" onclick="document.body.style.cursor='wait'"><?php echo '<br><small>- dem n°:&nbsp;'.$dem_avss['DemandeAvsId'].'&nbsp;de type :&nbsp;'.$dem_avss['naturecontrat'].'</small>' ?></a> 
					 <?php  echo '<br><small>-'.$decisioncda.'par la CDA du :&nbsp;'.format_date($dem_avss['datedecisioncda'],'dd/MM/yyyy').'&nbsp;<br>- du&nbsp;'.format_date($dem_avss['datedebutnotif'],'dd/MM/yyyy').'&nbsp;au&nbsp;'.format_date($dem_avss['datefinnotif'],'dd/MM/yyyy').
					 '<br>- QH notifiée :&nbsp;'.$dem_avss['quotitehorrairenotifie'].'&nbsp;Heure(s)</small>'; ?>
					 <?php if ($dem_avss['conditionsuspensive']){ echo '<br><small><FONT COLOR="red" ><blink> - Close suspensive:&nbsp;'.$dem_avss['conditionsuspensive'].'</FONT></blink></small>';} ?>
					<!-- <br><?php echo link_to('Supprimer', 'demandeavs/delete?id='. $dem_avss['DemandeAvsId'].'&eleve_nom=' . $eleve['nom'].'&eleve_prenom=' . $eleve['prenom'].'&flag_recherche=1', array('method' => 'delete', 'confirm' => 'Are you sure?')) ?> -->
					<?php if($count_dem_avs > 0) { ?>
					 
					 <?php echo '<br>&nbsp;&nbsp;------------------------</br>' ?>
					 <?php  } ?>
					 <?php endforeach; ?>
					<?php }else{
					  echo '<small>pas de demande notifiée<br></small>';
                     } ?>
					<!--liste des demandes Avs en attente de traitement CDA-->
					 <?php if($count_dem_avs_cda > 0 ) { ?> 
				       <?php foreach($dem_avs_cda as $dem_avs_cdas):?>
					      <?php echo '&nbsp;'.link_to('<br><small>- dem n°:&nbsp;'.$dem_avs_cdas['DemandeAvsId'].'&nbsp; de type :&nbsp;'.$dem_avs_cdas['naturecontrat'].'</small>', 'demandeavs/edit?id=' . $dem_avs_cdas['DemandeAvsId'].'&eleve_nom=' . $eleve['nom'].'&eleve_prenom=' . $eleve['prenom'].'&eleve_id='.$sf_request->getParameter('eleve_id'). '&retour='. 1   ) ?>
					      <?php echo '<br>attente décision CDA</br>' ?>
                        <!--  <?php echo link_to('Supprimer', 'demandeavs/delete?id='. $dem_avs_cdas['DemandeAvsId'].'&eleve_nom=' . $eleve['nom'].'&eleve_prenom=' . $eleve['prenom'].'&flag_recherche=1', array('method' => 'delete', 'confirm' => 'Are you sure?')) ?>	-->				 
					    <?php endforeach; ?>	
					<?php } ?></a>
				

					</td>
					
					<!-- matériel(s) prêtés(s) en cours à la date du jour -->
					<!------------------------------------------------------>
					<td>
				
					<?php if($count_eleve_mat_encours > 0) { ?>
					
					<?php foreach($eleve_mat as $eleve_mats):?>
				      <a href="<?php echo url_for('eleve_materiel/edit?id='.$eleve_mats['eleve_materiel_Id'].'&eleve_id='.$eleve_mats['eleve_id'].'&materiel_id='.$eleve_mats['materiel_id'].'&eleve_nom=' . $eleve['nom'].'&eleve_prenom=' . $eleve['prenom']. '&retour='. 1); ?>" onclick="document.body.style.cursor='wait'">
					  <?php echo '<font color ="green"><small>-&nbsp;'.$eleve_mats['libelletypemateriel'].'&nbsp;-&nbsp;'.$eleve_mats['libellemarque'].'&nbsp;'.'</a><br>-&nbsp;'.$eleve_mats['libelleMateriel'].'<br>&nbsp;n°&nbsp;'.$eleve_mats['numeroMateriel'].'</font>' ?>
					  <?php echo '<font color ="green"><br>du '.format_date($eleve_mats['datedebut'],'dd/MM/yyyy').'&nbsp;au&nbsp'.format_date($eleve_mats['datefin'],'dd/MM/yyyy').'&nbsp;</small><br>' ?>
					<?php endforeach; ?>
					<?php } ?>

					<?php if($count_eleve_mat_en_stock == 0 && $count_dem_mat > 0) { ?>
					<?php //echo '<br><small>impossible d\'allouer du matériel</br> pas de stock pour le matériel de type :&nbsp;'. $dem_mat[0]['typemateriel'].'</small></br>' ?>
					<?php } ?>
					
					<!-- édition convention possible si du matériel attribués à l'élève existe sans date de convention -->
					<?php //if($countmaterielssansconv > 0) { ?>
						<?php if(1) { ?>
					<?php echo link_to('<br><button style="width:40px"><small>Convention</small></button>', 'eleve_materiel/conv?eleve_id='.$resultat[0]['eleve_id'], 
					array('popup' => array('popupWindow', 'width=310,height=400,left=320,top=0','scrollbars=yes')) )  ?>
					<?php } ?>



					
					</td>
					 
					 <!-- DEMANDES Matériel -->
					 <td>

					
					<!--demande MATERIEL valide en cours -->
					 <?php if($count_dem_mat > 0 ) { ?> 
					 	<?php foreach($dem_mat as $dem_mats):?>
						    
						    <?php if($dem_mats['decisioncda'] == 1 ): ?>
							<?php $decisioncda='&nbsp;Acceptée&nbsp;'; ?>
			               <?php else: ?>
							<?php $decisioncda='&nbsp;Refusée&nbsp; !!>;'; ?>
							<?php endif; ?>
					        <a href="<?php echo url_for('demandemateriel/edit?id=' . $dem_mats['demandemateriel_id'] .'&secteur_id=' . $eleve['secteur_id'].'&eleve_nom=' . $eleve['nom'].'&eleve_prenom=' . $eleve['prenom'].'&eleve_id=' . $eleve['eleve_id']. '&retour='. 1) ?>" onclick="document.body.style.cursor='wait'"><?php echo '<font color ="green"><br>-&nbsp;' .$dem_mats['typemateriel'] ?></a> 
                            <!-- <?php echo '<font color ="green">&nbsp;'.link_to('<small>Supprimer</small>', 'demandemateriel/delete?id=' . $dem_mats['demandemateriel_id'] .'&eleve_nom=' . $eleve['nom'].'&eleve_prenom=' . $eleve['prenom'], array('method' => 'delete', 'confirm' => 'Are you sure?')) ?>	-->
							<?php  echo '<font color ="green"><br><small>-'.$decisioncda.'par la CDA du :&nbsp;'.format_date($dem_mats['datedecisioncda'],'dd/MM/yyyy').'- du&nbsp;'.format_date($dem_mats['datedebutnotif'],'dd/MM/yyyy').'&nbsp;au&nbsp;'.format_date($dem_mats['datefinnotif'],'dd/MM/yyyy').'</small>'?>                  
    					    <?php echo '<br><small>'.$dem_mats['libelletraitement'].'</small>' ?>
							
						  <?php endforeach; ?>					
					<?php } ?></a>
					
					<!--demande MATERIEL en attente de traitement CDA-->
					 <?php if($count_dem_mat_cda > 0 ) { ?> 
				     <?php foreach($dem_mat_cda as $dem_mat_cdas):?>
					  <?php echo '&nbsp;'.link_to('<font color ="green"><small><br>- dem n°:&nbsp;'.$dem_mat_cdas['demandemateriel_id'].'&nbsp;de type :&nbsp;'. $dem_mat_cdas['typemateriel'].'</small>', 'demandemateriel/edit?id=' . $dem_mat_cdas['demandemateriel_id'] .'&secteur_id=' . $eleve['secteur_id'].'&eleve_nom=' . $eleve['nom'].'&eleve_prenom=' . $eleve['prenom'].'&eleve_id=' . $eleve['eleve_id']. '&retour='. 1 ).'<font color ="green"><small><br>&nbsp; attente décision CDA</small>' ?>
                      <!-- <br><?php //echo  '<font color ="green">'.link_to('<small>Supprimer</small>', 'demandemateriel/delete?id=' . $dem_mat_cdas['demandemateriel_id'] .'&eleve_nom=' . $eleve['nom'].'&eleve_prenom=' . $eleve['prenom'], array('method' => 'delete', 'confirm' => 'Are you sure?')) ?>	-->				 
					 <?php endforeach; ?>	
					<?php } ?></a>
					 <?php //if($count_dem_mat_cda == 0 ) { ?> 
	   		          <!--   <?php echo '<br>&nbsp;<font color ="green">'.link_to('Créer ', 'demandemateriel/new?eleve_id=' . $eleve['eleve_id'] .'&eleve_nom=' . $eleve['nom'].'&eleve_prenom=' . $eleve['prenom'].'&mdph_id='.$eleve['mdph_id'].'&flag_recherche=1', array( 'confirm' => 'une nouvelle demande matériel sera créé pour le dossier dernier dossier MDPH Etes vous sur ?') ) ?> -->
					 <?php //} ?></a>
					</td>
					 
			
		

	
			</tr>	
		 <?php endforeach; ?>

		</table>
<?php //$resultat->free() ?>
<?php }else{ ?>
       <?php 	if($_POST['nom_eleve'] || $_POST['prenom_eleve'] ){	?>

			<?php 	if($_POST['nom_eleve']){	?>
				<?php $recherche = ' le Nom de l\'élève contenant : <strong>'.$_POST['nom_eleve'].'</strong>' ?>
			<?php }?>
			<?php 	if($_POST['prenom_eleve']){	?>	
				<?php $recherche = $recherche . ', le Prénom de l\'élève contenant: <strong>'.$_POST['prenom_eleve'].'</strong>'?>
			<?php }?>
			
			<?php echo '<br><u><strong>Pas de résultats correspondant au(x) critère(s) de recherche ! :&nbsp;</strong></u>'.$recherche .'</br><br></br>'?>
	    <?php } ?>
<?php } ?>
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



