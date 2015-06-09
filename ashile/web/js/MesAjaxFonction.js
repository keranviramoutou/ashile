$j(function(){
	$j("#MessageJS").empty(); //Efface le message qui affiche que le navigateur ne prends pas en charge JAVASCRIPT.
	$j("#Page").show();// Si le JavaScript Fonction on affiche la page.	
	$j("select").change(function () {//Action lors d'une selection sur les boites dates
		ChangeOption(this);
	});
});
 
function ChangeOption(Balise){
var OptionChoisi= $j(Balise).val(), // On récupère la valeur de l'option
	ClassBalise = $j(Balise).attr("class"),// on récupère le nom de la class affecté au SELECT pour la suite de l'inter-action
	IDBalise = $j(Balise).attr("id")
	parametres = 'actionPOST='+IDBalise+'&IdSelectParent='+OptionChoisi, //déclare les parametres pour la fonction AJAX. 
	url = './RetourPHPSuccexx.php'; // L'URL du Script fournissant le retour.
 
if (OptionChoisi != 0){ // Je ne traite pas le ELSE à vous d'adapter en fonction de vos besoins.
$j.ajax({
		type: "POST", // Requete POST
		url: url, 
		dataType: "html", // Format du retour de l'url
		success : AfficheSuccess, // Si tout marche bien
		data: parametres, 
		error: AfficheErreur // Si on se plante ;o)
	})	
}
//Afin de pouvoir exploiter les variables de l'objet déclencheur nous déclarons la function de succès à l'interrieur de la fonction d'événement.
function AfficheSuccess(retourSuccess){
	switch (ClassBalise) {	// on change la façon de réagir en fonction de l'élément déclencheur.
 
		case 'Groupe' :
			$j('#resultat').empty();
			$j('select.SousGroupe').empty();
			$j('select.SousSousGroupe').empty();
			$j('select.SousGroupe').append( retourSuccess );
		break;
 
		case 'SousGroupe' :
			$j('#resultat').empty();
			$j('select.SousSousGroupe').empty();
			$j('select.SousSousGroupe').append( retourSuccess );
		break;		
 
		case 'SousSousGroupe' :
			$j('#resultat').empty();
			$j('#resultat').append( $j("select.Groupe").val()+'  '+ $j("select.SousGroupe").val()+'  '+ $j("select.SousSousGroupe").val() );
		break;
 
	}
}
}
 
function AfficheErreur(retourErreur){
	 $j('#MessageJS').append( retourErreur );
}
