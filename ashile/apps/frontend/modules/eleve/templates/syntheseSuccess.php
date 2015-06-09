<?php
use_helper('Text') ;
use_helper('jQuery');
use_helper('Date');
?>
<table width='90%'>
<tr>
<td width='70%'>
<?php echo jq_button_to_remote('Rafraîchir', array('url' => url_for(array('module' => 'eleve', 'action' => 'synthese')), 'update' => 'div_synthese','loading' => 'document.body.style.cursor="wait"',
	'complete' => 'document.body.style.cursor="default"',)).'</p>' ; ?>


</td>
<td width='30%'>
  <div class= 'aide' onClick="aide_synthese()">
  </td>
</tr>
</table>
<?php

		if (!$eleve):
			echo '<fieldset>Vous devez cliquer sur l\'onglet Elève pour commencer l\'enregistrement</fieldset>';
		else:
			// affichage des données de l'eleve et des messages de l'années scolaire en cours le concernant
			//-----------------------------------------------------------------------------------------------
		echo '<p class="boutonAdroite">';
        
	
				//echo '<fieldset><legend>Eleve</legend>';
			    echo '<fieldset><legend>'.link_to('Eleve','eleve/edit?id='.$eleve->getId().'#div_eleve').'</legend>';
				echo '<p> N° élève:&nbsp<strong>' . $eleve->getId(). '</strong><br>';
				echo 'Nom :&nbsp<strong>' . $eleve->getNom() . '</strong>&nbsp'.'&nbspPrénom :&nbsp;<strong>' . $eleve->getPrenom() . '&nbsp;</strong>';
				echo 'né(e) le <strong>'.format_date($eleve->getDatenaissance(),'dd/MM/yy').'</strong><br>';
				echo 'Adresse :&nbsp <strong>'.$eleve->getAdresseelevebat().'&nbsp;'.$eleve->getAdresseleverue().'</strong>&nbsp;commune :&nbsp;<strong>'.$eleve->getQuartier().'</strong></p>';
				if ($eleve->getEtatAcc()):
					echo 'Accompagnement terminé le &nbsp<strong>'.format_date($eleve->getEtatAcc(),'dd/MM/yy').'</strong> motif :&nbsp<strong>'.$eleve->getMotif()
					.'</strong>';
				endif;
      echo '</fieldset>';
	  endif;
	  
?>	  

 <?php  if ($eleve){ ?>
 <?php echo'<fieldset>';
   echo '<h4>en milieu ordinaire</h4>';

    // la scolarite ordinaire
    //-----------------------

    $nbOrientation = 0;
    foreach ($orientations as $orientation):
				
        if( $orientation['nomniveauscolaire']):
       $niveau = '&nbsp; Niveau scolaire :&nbsp;<strong>' . $orientation['nomniveauscolaire'].'</strong>';
        endif; 
        if( $orientation['nomlongtypeclasse']):
        $classe ='</strong>&nbsp;en classe &nbsp;de &nbsp;<strong>' .$orientation['nomlongtypeclasse'].'</strong>';
        endif;
        if( $orientation->enseignant_id > 0):
        $enseignant = '</strong>Enseignant :&nbsp;<strong>' . $orientation->getEnseignant() . '&nbsp;</p>';
        endif;
        if(  $orientation['classeinclusion']):
        $inclusion = 'Classe d\'inclusion :&nbsp;<strong>' . $orientation['classeinclusion'] . '</strong>&nbsp;';
        $tempsinclusion = '&nbsp;- Temps :&nbsp;<strong>' . $orientation['temspclasseintegration'] . '</strong>&nbsp;Heure(s)&nbsp;';
        endif;
		echo '<strong>'.$orientation['typetab'].'&nbsp;'.$orientation['nometabsco'].'</strong>&nbsp;('.$orientation['rne'].')&nbsp;'.$classe. $enseignant.$niveau.'<br>' ;
		echo   $inclusion.$tempsinclusion ;
        $nbOrientation++;
    endforeach;
    if (!$nbOrientation):
        echo '<i><small>scolarité non renseignée</small></i>';
    endif;

    // la scolarite en milieu spécialise
    //------------------------------------
    $nbModnonsco = count($modnonscos);
	if ($nbModnonsco){
    echo '<h4>en milieu spécialisé</h4>';
    $nbModnonsco = 0;
    foreach ($modnonscos as $modnonsco):
        if( $modnonsco->getEtabnonscoId() > 0):
      $etab = '<strong>' .$modnonsco->getEtabnonsco()->getTypeetablissementnonsco().'&nbsp;'. $modnonsco->getEtabnonsco(). '&nbsp;</strong></strong>'.$modnonsco->getEtabnonsco()->getQuartier().'&nbsp;';
        endif;
        if( $modnonsco->getClassespeId() > 0):
        $classespe = '</strong>en Classe :&nbsp;  <strong> ' . $modnonsco->getClassespe() . '&nbsp;</strong>';
        endif;
        if( $modnonsco->quothorreff > 0):
        $quotiteh = '- Quotite Horaire :&nbsp; <strong>' . $modnonsco->getQuothorreff() . '</strong>&nbsp;Heure(s)&nbsp;';
        endif;
		
		if( $modnonsco->quothorreff > 0):
        $nbdemijournée = '- Nb de Demi-journée :&nbsp;<strong>' . $modnonsco->getDemijournee() . '&nbsp;</strong>';
        endif;
		echo '<strong>'.$etab.$classespe. $quotiteh.  $nbdemijournée.'</strong><br>' ;
        $nbModnonsco++;
    endforeach;
    }else{
        echo '<i><br><br>- Pas de scolarisation en milieu spécialisé</i> ';
    };
    echo '</fieldset>'; ?>

<?php
    // le tuteur
    //-----------
    //echo '<fieldset><legend>Responsable(s)</legend>';
	 echo '<fieldset><legend>'.link_to('Responsable(s)','eleve/edit?id='.$eleve->getId().'#div_tuteur').'</legend>';
    $nbTuteur = 0;
    foreach ($tuteurs as $tuteur):
	  if ($tuteur['tuteurlegal'] == 1 ){
            $tuteur_legal1 = '&nbsp;<small>(tuteur légal)</small>&nbsp;';
        }elseif($tuteur['tuteurlegal'] == 0) {
		$tuteur_legal1='';
		}
        echo '<strong>'.$tuteur['typeresp'].'</strong>&nbsp;:&nbsp;'. $tuteur_legal1.$tuteur['nom'].'&nbsp'.$tuteur['prenom'].'&nbsp;-Tél1 :&nbsp;'.$tuteur['tel1'].'&nbsp;-Tél2 :&nbsp'.$tuteur['tel2'].'&nbsp;-Mail :&nbsp'.$tuteur['email'];
      
        echo '&nbsp;</p>';
        $nbTuteur++;
    endforeach;
    echo '</fieldset>';


 // echo '<fieldset><legend>Droit(s) ouvert(s)</legend>'; 
  echo '<fieldset><legend>'.link_to('Droit(s) ouvert(s) à la date du Jour','eleve/edit?id='.$eleve->getId().'#div_mdph').'</legend>'; ?>

     <?php  if (count($demande_avs) > 0){ ?>
      <?php   // demande AVS droit ouvert
             //----------------------------- ?>
		-  <input type="checkbox" name="avs" value="tuteur" checked="checked" disabled="disabled"  > Acc. <?php echo '<small>('.format_date($demande_avs[0]['datefinnotif'],'dd/MM/yy').')&nbsp;'.$demande_avs[0]['quotitehorrairenotifie'].'H</small>&nbsp;&nbsp;' ?>&nbsp;&nbsp;
       <?php  }else{ ?>
		-  <input type="checkbox" name="avs" value="tuteur" disabled="disabled"  > Acc. &nbsp;&nbsp;
       <?php  } ?>
	   

	     <?php  if (count($demande_orientation) > 0){ ?>
		 <?php  foreach ($demande_orientation as $demande_orientations): ?>
			<?php  
			// demande orientation droit ouvert
             //--------------------------------- ?>
			- <input type="checkbox" name="orientation" value="tuteur" checked="checked" disabled="disabled"  > Orientation   <?php echo '<small>('.format_date($demande_orientations['datefinnotif'],'dd/MM/yy').'-'.$demande_orientations['libelleclasseext'].')</small>&nbsp;&nbsp;' ?>&nbsp;&nbsp;
		<?php endforeach; ?>
		<?php  }else{ ?>
			- <input type="checkbox" name="orientation" value="tuteur" disabled="disabled"  > Orientation &nbsp;&nbsp;
       <?php  } ?>

      
<?php
        // demande matériel droit ouvert
        //------------------------------

      if (count($demande_materiel) > 0){ ?>
	 <?php 
		  foreach ($demande_materiel as $demande_materiels):
					
			$affichedatefinnotif = format_date($demande_materiels['datefinnotif'],'dd/MM/yy') .'&nbsp;-&nbsp;' .$affichedatefinnotif  ;

		endforeach;
	  ?>
		- <input type="checkbox" name="materiel" value="tuteur" checked="checked" disabled="disabled"  > Matériel <?php echo '<small>('.$affichedatefinnotif .')</small>&nbsp;&nbsp;' ?>&nbsp;&nbsp;
       <?php  }else{ ?>
	    - <input type="checkbox" name="materiel" value="tuteur" disabled="disabled"  > Matériel&nbsp;&nbsp;
       <?php  } ?>


	<?php
		 
		//demande SESSAD droit ouvert
        //--------------------------

      if (count($demande_sessads) > 0){ ?>
   
		- <input type="checkbox" name="sessad" value="tuteur" checked="checked" disabled="disabled"  > Sessad <?php echo '<small>('.format_date($demande_sessads[0]['datefinnotif'],'dd/MM/yy').')</small>' ?>&nbsp;&nbsp;<?php echo '<small>('.$demande_sessads[0]['libelletypesessad'] .')</small>&nbsp;&nbsp;' ?>
       <?php  }else{ ?>
	    - <input type="checkbox" name="sessad" value="tuteur" disabled="disabled"  > Sessad &nbsp;&nbsp;
       <?php  } ?>
		

	<?php

       // demandes de transport droit ouvert
        //---------------------------------
     
     if (count($demande_transport) > 0){ ?>
   
		- <input type="checkbox" name="transport" value="tuteur" checked="checked" disabled="disabled"  > Transport <?php echo '<small>('.format_date($demande_transport[0]['datefinnotif'],'dd/MM/yy').')</small>&nbsp;&nbsp;' ?>&nbsp;&nbsp;
       <?php  }else{ ?>
	   - <input type="checkbox" name="transport" value="tuteur" disabled="disabled"  > Transport &nbsp;&nbsp;
       <?php  } ?>
	<?php    echo '</fieldset>'; ?>   
	   
	 <?php  
	   echo '<fieldset><legend>'.link_to('Demande(s) en cours','eleve/edit?id='.$eleve->getId().'#div_mdph').'</legend>'; ?>
	<!-- echo '<fieldset><legend>Demande(s) en cours</legend>'; ?> -->
	 
	    <?php  if (count($demande_avs_cour) > 0){ ?>
		
      <?php  
  	  // demande Acc. en cours
      //--------------------- ?>
		- <input type="checkbox" name="avs" value="tuteur" checked="checked" disabled="disabled"  > Acc. &nbsp;&nbsp;
       <?php  }else{ ?>
		- <input type="checkbox" name="avs" value="tuteur" disabled="disabled"  > Acc.&nbsp;&nbsp;
       <?php  } ?>
	   
	   	   
	   <?php  if (count($demande_orientation_cour) > 0){ ?>
	    <?php  foreach ($demande_orientation_cour as $demande_orientation_cours): ?>
			<?php  
			// demande orientation droit en cours
			//----------------------------- -----?>
			- <input type="checkbox" name="orientation" value="tuteur" checked="checked" disabled="disabled"  > Orientation <?php echo '<small>- ('.$demande_orientation_cours['libelleclasseext'].') </small>'  ?>
        	<?php endforeach; ?>     
	 <?php  }else{ ?>
		- 	  <input type="checkbox" name="orientation" value="tuteur" disabled="disabled"  > Orientation &nbsp;&nbsp;
       <?php  } ?>
	 
  	 <?php
        // demande matériel en cours
        //---------------------------

      if (count($demande_materiel_cour) > 0){ ?>
     
		- <input type="checkbox" name="materiel" value="tuteur" checked="checked" disabled="disabled"  > Matériel &nbsp;&nbsp;
       <?php  }else{ ?>
	    - <input type="checkbox" name="materiel" value="tuteur" disabled="disabled"  > Matériel &nbsp;&nbsp;
       <?php  } ?>
	   
	   
	 	<?php
		 
		//demande SESSAD en cours
        //--------------------------

      if (count($demande_sessads_cour) > 0){ ?>
   
		- <input type="checkbox" name="sessad" value="tuteur" checked="checked" disabled="disabled"  > Sessad &nbsp;<?php echo '<small>('.$demande_sessads_cour[0]['libelletypesessad'] .')</small>&nbsp;&nbsp;' ?>
       <?php  }else{ ?>
	    - <input type="checkbox" name="sessad" value="tuteur" disabled="disabled"  > Sessad &nbsp;&nbsp;
       <?php  } ?>
	   
	<?php

       // demandes de transport den cours
        //---------------------------------
   
     if (count($demande_transport_cour) > 0){ ?>
   
		- <input type="checkbox" name="transport" value="tuteur" checked="checked" disabled="disabled"  > Transport &nbsp;&nbsp;
       <?php  }else{ ?>
	   - <input type="checkbox" name="transport" value="tuteur" disabled="disabled"  > Transport &nbsp;&nbsp;
       <?php  } ?>
	<?php    echo '</fieldset>'; ?>   
	   
	  	 <?php  
	//alerte moyen TRANSPORT à traiter
	//----------------------------------
	     if (count($transport_alerte) > 0){ ?>
		    <?php echo '<fieldset><legend>'.link_to('Transport','eleve/edit?id='.$eleve->getId().'#div_transport').'</legend>'; ?>
       <?php // echo '<fieldset><legend> Transport</legend>';  ?> 
		<font color="red">- en attente de moyen</font><input type="checkbox" name="transport" value="tuteur" checked="checked" disabled="disabled"  >&nbsp;&nbsp;
    <?php // echo 'gggg'.$transport_alerte[0]['transportobtenu_id'].'hhh'.$transport_alerte[0]['eleve_id'] ?>
     <?php     echo '</fieldset>'; 
	   } ;?>  

	 	  	 <?php  
	//alerte moyen SESSAD à traiter
	//----------------------------------
	     if (count($sessad_alerte) > 0){ ?>
		 <?php echo '<fieldset><legend>'.link_to('Sessad ','eleve/edit?id='.$eleve->getId().'#div_sessad').'</legend>'; ?>
      
		- <font color="red">en attente de moyen </font><input type="checkbox" name="transport" value="tuteur" checked="checked" disabled="disabled"  >&nbsp;&nbsp;

     <?php     echo '</fieldset>'; 
	   } ;?>  
	 
   	 <?php 
     //Suivi externe en cour
     //------------------------	 
	 $periode ='';
	// echo '<fieldset><legend>Suivi(s) externe(s)</legend>';
	  echo '<fieldset><legend>'.link_to('Suivi(s) externe(s) ','eleve/edit?id='.$eleve->getId().'#div_suivitext').'</legend>'; 
    foreach ($suivi_externe_cour as $suivi_externe_cours):
	  if (count($suivi_externe_cours)  == 0 ){
            $suivi = '&nbsp;<small>pas de suivi en cour</small>&nbsp;';
        }
		
	if($suivi_externe_cours['datedebutpriseencharge']){
	$periode = '- Prise en charge du&nbsp;<strong>'.format_date($suivi_externe_cours['datedebutpriseencharge'],'dd/MM/yy').'</strong>';
	}
	
	
	if($suivi_externe_cours['datefinpriseencharge']){
	$periode = $periode . '&nbsp;au&nbsp;<strong>'.format_date($suivi_externe_cours['datefinpriseencharge'],'dd/MM/yy').'</strong>';
	}
        echo 'nature du suivi :&nbsp;<strong>'.$suivi_externe_cours['libellenaturesuiviext'].'</strong>&nbsp;'.$periode;
      
        echo '&nbsp;</p>';
    
    endforeach;
	    echo '</fieldset>' ?>
	   
	   	 <?php  
	//dernière réunion
	//-----------------
	// echo '<fieldset><legend>Dernière réunion </legend>'; 
	  echo '<fieldset><legend>'.link_to('Dernière réunion ','eleve/edit?id='.$eleve->getId().'#div_reunion').'</legend>'; 
	  foreach ($reunion as $reunions):
	  if (count($reunion_esss)  == 0 ){
            $suivi = '&nbsp;<small>pas de reunion ESS en cour</small>&nbsp;';
        }
        echo 'Réunion à la date du :&nbsp;<strong>'.format_date($reunions['datereunion'],'dd/MM/yy').'</strong>&nbsp;Intitulé :&nbsp;<strong>'.$reunions['libellereunion'].'</strong>'
		.'&nbsp;&nbsp;de type :&nbsp;<strong>'.$reunions['libelletypereunion'].'</strong>';
      
        echo '&nbsp;</p>';
    
    endforeach;
	    echo '</fieldset>' ?>  

<?php 
			
	    //affichage des messages concernant l'élève selectionné
		//-----------------------------------------------------
		
        if ($existmails):  //test si pas de message concernant cet élève
       echo '<fieldset><legend>Messages</legend>';
		echo "<div style='height:90pt; overflow: auto' >";
         foreach ($mails as $mail):

           //  echo '<p class="infoField"><label>Sessad :</label>' . $sessad->getSessad() . '&nbsp;</p>';
               echo '</small></strong><br>Sujet :&nbsp;<strong>'.$mail['sujet'].'</strong><small>&nbsp;-&nbsp;message du :&nbsp;<strong>'.format_date($mail['date'],'dd/MM/yy').'</small>'.
			   '</strong><br>Message :&nbsp;<strong><small>'.$mail['texte'].'</small></strong><br>';			   ;
          
         endforeach;
		echo "</div>";
        endif;


     echo '</fieldset>'; 
?>
<?php } // test fin exitance élève?>	
<p class="boutonAdroite">
  <?php echo jq_button_to_remote('Rafraîchir', array('url' => url_for(array('module' => 'eleve', 'action' => 'synthese')), 'update' => 'div_synthese','loading' => 'document.body.style.cursor="wait"',
	'complete' => 'document.body.style.cursor="default"',)).'</p>' ; ?>
</p>

<script>

function aide_synthese() {
	var src = "<?php echo url_for('eleve/aide') ?>";
		$j.modal('<iframe src="' + src + '" height="450" width="830" style="border:0">', {
			closeHTML:"",
			containerCss:{
				backgroundColor:"#fff",
				borderColor:"#fff",
				height:450,
				padding:0,
				width:600
			},
			overlayClose:true
		});
	}


</script>