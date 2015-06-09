<?php use_helper('Date') ?> 
 <div class='aide' onClick="<?php echo url_for('demandemateriel/aide') ?>"> </div> 
<?php if ($form->getobject()-> getTraitement() != 'RDD' ){ ?>
<h3>Edition Demande materiel</h3>
<?php }else{ ?>
<h3>Demande Matériel de Prolongation</h3>
<?php } ?>
<div id="demande_materiel">
<?php 

  echo '<fieldset><legend><h3>Synthèse </h3></legend>';
         echo '<p><i> vous traitez l\'éleve :<strong> '.$mdph->getEleve().'</strong><br>Etablissement frequenté&nbsp:&nbsp <strong> '.$orientation->Etabsco->Typeetablissement->nomtypeetablissement.'&nbsp;'.$orientation->Etabsco->nometabsco.'</strong>&nbsp&nbsp Niveau scolaire :&nbsp<strong>'.$orientation->Niveauscolaire->nomniveauscolaire.'</strong>&nbsp&nbspClasse :&nbsp&nbsp<strong>'.$orientation->Classe->TypeClasse->nomtypeclasse.'</strong></i></p>';
  echo '<p><i> Dossier MDPH n °&nbsp  <strong>' .$mdph->id.'</strong>&nbsp Date ESS  :&nbsp'.format_date($mdph->dateess,'dd/MM/yyyy').'&nbsp Date envoi dossier : ' .format_date($mdph->dateenvoiedossier,'dd/M/yyyy').'</i></p>';


if ($form->getobject()->getMateriel_id()){  ; 
echo 'Id mat :&nbsp<strong>'.$materielattribué[0]['materielId'].'</strong>&nbsp;N° du matériel attribué :&nbsp;<strong> '.$materielattribué[0]['numeromateriel'].'</strong>&nbsp;de type :&nbsp;<strong>'.$materielattribué[0]['typemateriel'].'</strong>&nbsp;- Référence :&nbsp;<strong>'.$materielattribué[0]['libellemateriel'];
echo '</strong>&nbsp;&nbsp; -&nbsp;Prêt du :&nbsp;<strong>'.format_date($materielattribué[0]['datedebut'],'dd/MM/yyyy').'</strong>&nbspau&nbsp;<strong>'.format_date($materielattribué[0]['datefin'],'dd/MM/yyyy').'</strong>';
}
echo '</fieldset>';
?>
<fieldset>
<?php include_partial('form', array('form' => $form)) ?>
</fieldset>
<?php
	include_partial('eleve_materiel/materiel_eleve', array('materielEleve' => $materielEleve)) 
?>
</div>

<script>
var src = "<?php echo url_for('demandemateriel/aide') ?>";

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