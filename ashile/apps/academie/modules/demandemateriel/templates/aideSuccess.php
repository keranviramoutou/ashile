<div class='attribution'>
<p><h3> -Liste des élèves en attente d'attribution</h3> cette liste affiche la liste des élèves scolarisés dans l'année scolaire en cours<br> 
qui ont des demandes matériels à l'état 'A ATTRIBUER'</p>
</div>

<h3>- Demande Matériel</h3>

<p><u>le champs intitulé Matériel_Id </u> le numéro affiché correspond au numéro interne du matériel attaché à la demande, il est visible également dans le cadre synthèse <br>
<p> cette zone permet de modifier la référence du matériel, lorsque à la création du prêt de matériel le numéro interne du matériel choisi (Id)  n'est pas reporté correctement sur la demande de matériel traitée </p>
<p><u> le bouton intitulé "Dupliquer"</u> : il permet de dupliquer la demande matériel à l'écran et de modifier la date de fin de prêt pour le matériel attaché à cette demande dupliquée
,cette demande dupliquée est à l'état remis.Il sert essentiellement à traiter les prolongation de notification (stratégie : une nouvelle demande pour la prolongation)<br>
<p> A l'enregistrement de cette nouvelle demande dupliquée, le prêt correspondant au matériel attaché à la demande est modifié. <p>
<p> la date de fin de prêt est modifiée avec la date de fin de la demande de notification dupliquée.</p>
<p> Ajout en commentaire de la demande dupliquée la mention :" Demande matériel dupliquée, prolongation du prêt du matériel n°"<p>


<p> <u>Passage d'une demande à l'état "RDD" </u>,Il sert essentiellement à traiter les prolongation de notification (stratégie : la même demande modifiée (date de fin de notification modifiée) pour la prolongation)
à l'enregistrement de cette demande la date de fin de prêt correspondant au matériel de la demande va être modifié avec la date de fin 
de notification de la demande (idem bouton Dupliquer), cette demande passe automatiquement alors à l'état "Remis".
<p> Ajout en commentaire de la demande modifiée la mention : "Demande non dupliquée (traiter à l\'état RDD) modifiée pour prolonger le prêt pour le matériel n°"<p>

<p><u>Bouton intitulé "Typer la demande suivante"</u>,pour réaliser cette action la demande matériel doit être à l'état "ND"<br>
Il permet pour élève de passer d'une demande matériel à une autre à l'état 'ND', pour saisir les dates de notifications;
ces demandes passent automatiquement à l'état 'A ATTRIBUER' .</p>

<p> <u>Changement d'état de  la demande :</u><br>
le gestionnaire peut changer par lui même l'état de la demande, ce qui peut avoir des conséquences sur le traitement des prêts ou de la demande.<br>
1 - A l'état "A ATTRIBUER" , la demande est visible pour effectuer un prêt, si elle est selectionnée pour un prêt, la demande passe automatiquement à l'état 'AFFECTEE'</p>
Cette demande passe de l'état 'AFFECTEE' à l'état 'REMIS' lorsque pour le prêt de matériel concerné par cette demande, on saisit la date de début de prêt (date de remise aux parents).<br>
2 - A l'état 'RDD' , le changement de la date de fin de notification , modifie la date de fin de prêt pour le matériel attaché à cette demande; elle passe automatiquement
à l'enregistrement à l'état 'REMIS'<br>
3 - A l'état à 'COMMANDER' , cette valeur n'entraine aucun traitement. Le gestionnaire Académique doit modifier cette demande à l'état 'A ATTRIBUER' pour pouvoir faire le prêt.<br>
4 - A l'état à 'EN ATTENTE' , cette valeur n'entraine aucun traitement. Le gestionnaire Académique met cette demande dans cet état transitoire quand il n'a pas à sa disposition
les informations nécessaires au traitement de la demande.<br>
5 - A l'état à 'FIN',  cette valeur n'entraine aucun traitement. Le gestionnaire Académique met cette demande dans cet état quand la demande de matériel est annulée <br>
(exemple de motif : annulation demandée par la famille)<br>

<p><u> Suppression de la demande matériel<p>
<p> cette action est possible si la demande matériel n'est pas traitée, c'est à dire qu'elle n'est pas lié à un prêt de matériel (Id matériel non renseigné)</p>


