<?php include_stylesheets() ?>

<div class='aideMod'></div>
                <!-- modal content -->

<h3>A - Gestion des matériels > Recherche </h3>
<p> si vous n'indiquez pas de date d'observation ,cette date ne sera pas prise en compte comme critère de sélection</p>		
<p> A partir du résultat de la recherche d'un matériel en STOCK, on peut créer un prêt de matériel à condition qu'il existe des demandes </p>	
<p> de matériel à l'état à ATTRIBUER </p>
<h3>B - Liste des materiels affectés à des élèves > Gestion des attributions > liste des matériels affectés </h3>
<p><u>Pour figurer sur cette liste : </u></p>
<p>la date de fin d'attribution doit être supérieure ou égale à la date du jour</p>
<p>la date de convention doit être renseignée</p>

 <p> Seule une attribution de matériel avec une date de fin d'attribution supérieure à la date du jour peut être modifiée.</p>
 <p> Pour éditer une convention pour un élève cliquer sur le bouton <u>Modifier</u></p>
 <p> le bouton <u>Créer</u> permet de créer une nouvelle attribution pour l'élève  de la ligne concernée.</p>
 
 <h3>C - Gestion Matériel > Attribution d'un matériel (prêt)</h3>
 <p><u> Date d'autorisation parentale</u> elle correspond à la date d'autorisation donnée par les parents pour enlever le contrôle parental sur les naviguateurs Internet<p>
 <p><u> la date d'édition de la convention et le numéro de convention </u> sont générés automatiquement à l'éditon de la convention<p>
 <p>Pour éditer une nouvelle convention modifiée il faut:<br>
  1 -  Supprimer la date d'édition déjà inscrite et enregistrer le prêt.<br>
  2 -  Procéder aux modifications nécessaires (renseignements élèves,matériels,prêt).<br>
  3 -  Faire Recherche élève et cliquer sur le lien 'Convention' pour plus de détail cliquer sur l'Aide de <a href="<?php echo url_for('eleve/aide#convention'); ?>"><?php echo 'Recherche élèves' ?></a><p>
 <p><u> la mise à jour de la date de remise au parent entraine : </u></p>
  1 - le changement d'état de la demande matériel à l'état 'REMIS' <br>
  2 - La date de fin du dernier mouvement pour ce matériel à l'état en STOCK est mise à jour avec la date de remise aux parents <br>
  3 - la création d'un mouvement matériel à l'état REMIS avec comme date de début la date de remise aux parents <br>
<p><u> Attribution d'un matériel par 'Recherche élève'</u></p>
<u> conditions d'attribution</u>
<p> 1 - cet élève doit avoir une demande matériel à l'état 'A ATTRIBUER'<p>
<p> 2 - il doit exister un matériel à l'état en stock(à la date du jour) correspondant à la même catégorie de matériel que la demande à l'état "A ATTRIBUER'</p>
 
 <p><u> Attribution d'un matériel à un élève à partir de 'Recherche Matériel' : </u></p>
 <p> Après avoir selectionné le matériel en 'STOCK' </p>
 <p> Selectionner l'élève qui a une demande de matériel à l'état 'A ATTRIBUER' de même catégorie <p>
 



<div id= "bdl" >
<h3>D - Gestion des matériels > Bon de livraison </h3>
<p>cette liste permet d'éditer un bon de livraison pour l'ERF pour un ensemble de matériels selectionnés (cocher la case),bouton intitulé "Génération Bon de Livraison"
<p>Ne sont visible dans cette liste que les matériels dont la demande matériel est à l'état 'AFFECTE' (pas encore remis aux parents) </p>
<p> la génération du bon de livraison permet d'éditer un document sur lequel figure le matériel selectionné, aucun traitement de mise à jour est effectué après cette édition </p>
<p> le bouton intitulé <u>"Mise à jour date de remise"</u> permet pour les matériels selectionnés de mettre à jour sur les fiches de prêt la date de remise à l'ERF</p>
<p> Dans ce cas la demande matériel est toujours à l'état 'AFFECTEE' </p>
<p> 





<div>
