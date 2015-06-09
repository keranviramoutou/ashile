

<!--
<?php if($_SERVER["HTTP_X_FORWARDED_HOST"] == 'portail.ac-reunion.fr' ){ 
$retour='https://portail.ac-reunion.fr';
} ?>
<!-- 
<input style="cursor: pointer;padding:2.75px;" name="deconnexion" type="button" class="bouton" id="deconnexion" value="d&eacute;connexion" onclick="location.href='/login/ct_logout.jsp'" />
&nbsp;<input style="cursor: pointer;padding:2.75px;" type="button" value="Retour au Portail"  OnClick="location.href= '<?php echo $retour; ?>'" >
--->


<script type="text/javascript">
$(document).ready( function () {
    // On cache les sous-menus :
    $(".navigationIndex ul.subMenu").hide();
    // On sélectionne tous les items de liste portant la classe "toggleSubMenu"

    // et on remplace l'élément span qu'ils contiennent par un lien :
    $(".navigationIndex li.toggleSubMenu span").each( function () {
        // On stocke le contenu du span :
        var TexteSpan = $(this).text();
        $(this).replaceWith('<a href="" title="Afficher le sous-menu">' + TexteSpan + '<\/a>') ;
    } ) ;

    // On modifie l'évènement "click" sur les liens dans les items de liste
    // qui portent la classe "toggleSubMenu" :
    $(".navigationIndex li.toggleSubMenu > a").click( function () {
        // Si le sous-menu était déjà ouvert, on le referme :
        if ($(this).next("ul.subMenu:visible").length != 0) {
            $(this).next("ul.subMenu").slideUp("normal");
        }
        // Si le sous-menu est caché, on ferme les autres et on l'affiche :
        else {
            $(".navigationIndex ul.subMenu").slideUp("normal");
            $(this).next("ul.subMenu").slideDown("normal");
        }
        // On empêche le navigateur de suivre le lien :
        return false;
    });    


} ) ;
</script> 	

<ul class="navigationIndex">
   <br>
  <li><a href="<?php echo url_for('eleve/recherche') ?>" title="Rechercher et création d'un eleve" >Rechercher et création <br></a></li>

  <li><a href="<?php echo url_for('eleve/listeEleve'); ?>" title="Liste globale des éleves" onclick="document.body.style.cursor='wait'; return true;">Elèves du Secteur</a></li>
     
  
    <li class="toggleSubMenu"><span>Listes</span>
      <ul class="subMenu">
	   <li><a href="<?php echo url_for('eleve/index1'); ?>" title="Elèves non scolarisés"  onclick="document.body.style.cursor='wait'; return true;" >Elèves non scolarisés</a></li>
        <li><a href="<?php echo url_for('horsClisUlis')?>" title="Elèves hors CLIS/ULIS"  onclick="document.body.style.cursor='wait'; return true;" >Elèves hors CLIS/ULIS</a></li>
        <li><a href="<?php echo url_for('ulisClis')?>" title="Aller à la page 3.2">Elèves en CLIS/ULIS</a></li>
        <li><a href="<?php echo url_for('eleveavs/index1')?>" title="Aller à la page 3.2">Elèves accompagnés</a></li>
        <li><a href="<?php echo url_for('alertes/index1'); ?>" title="Liste des Sessad et Transport  en attente de prise en charge"  onclick="document.body.style.cursor='wait'; return true;" >Sessad et Transport  en attente de prise en charge</a></li>
		 <li><a href="<?php echo url_for('alertes/suividemande'); ?>" title="Demandes en attente décision"  onclick="document.body.style.cursor='wait'; return true;" >Demandes en attente de décision</a></li>
		  <li><a href="<?php echo url_for('alertes/suividemandetermine'); ?>" title="Suivi des demandes"  onclick="document.body.style.cursor='wait'; return true;" >Suivi des demandes</a></li>
		   <!-- <li><a href="<?php echo url_for('eleve/index?etab=avec'); ?>" title="Elèves par Etab.">Elèves par Etab.</a></li> -->
      </ul>
    </li>
    <li><a href="<?php echo url_for('dossiersIncomplets'); ?>" title="Dossiers incomplets"  onclick="document.body.style.cursor='wait'; return true;" >Dossiers ASH incomplets</a></li>
	    <li class="toggleSubMenu"><span>Partenaires</span>
      <ul class="subMenu">
       <li><a href="<?php echo url_for('specialiste/index'); ?>" title="Partenaires"  onclick="document.body.style.cursor='wait'; return true;" >Liste et création</a></li>
	   <li><a href="<?php echo url_for('specialiste/list'); ?>" title="Liste élèves suivis"  onclick="document.body.style.cursor='wait'; return true;" >Liste des élèves suivis</a></li>
	 <!--   <li><a href="#" onClick="partenaire()" title="Partenaires">Création</a></li> -->
      </ul>
    </li>
    
    <li><a href="<?php echo url_for('organismesuivit/index'); ?>" title="Organismes de suivi et établissements d'exercice"  onclick="document.body.style.cursor='wait'; return true;" >Organismes de suivi externe et établissements d'exercice</a></li>
    <li><a href="<?php echo url_for('etabnonsco/index'); ?>" title="Etablissements spécialisés">Etablissements spécialisés</a></li> 
	 <li class="toggleSubMenu"><span>Enquête Dgesco</span>
      <ul class="subMenu">
     <!--   <li><a name="dgesco" href="<?php echo url_for('dgesco/list1')?>" onclick="document.body.style.cursor='wait'; return true;" title="Saisie en masse">Saisie en masse</a></li> -->
        <li><a href="<?php echo url_for('dgesco/list')?>" title="Enquête" onclick="document.body.style.cursor='wait'; return true;">Enquête</a></li>
		<li><a href="<?php echo url_for('eleve/Pbscolarite'); ?>" title="Scolarité élève incomplète"  onclick="document.body.style.cursor='wait'; return true;" >Scolarité élève incomplète</a></li>
       </ul>
    </li>   
   <li><a href="<?php echo url_for('mail/index'); ?>" title="Historique des messages">Historique des messages</a></li>    
    <li><a href="<?php echo url_for('menu/mention'); ?>" title="Mentions légales">Mentions légales</a></li>  
	<li><a href="<?php echo url_for('menu/condition'); ?>" title="Mentions légales">Conditions d'utilisation</a></li>  	
</ul>




<script>
function partenaire() {
//ouverture d'une popup
//---------------------
 var url = " <?php echo url_for('specialiste/popup' ) ?>";
 var width  = 700;
 var height = 500;
 var left   = (screen.width  - width)/2;
 var top    = (screen.height - height)/2;
 var params = 'width='+width+', height='+height;
 params += ', top='+top+', left='+left;
 params += ', directories=no';
 params += ', location=no';
 params += ', menubar=no';
 params += ', resizable=no';
 params += ', scrollbars=no';
 params += ', status=no';
 params += ', toolbar=no';
 newwin=window.open(url,'windowname5', params);
 if (window.focus) {newwin.focus()}
 return false;
}
// -->

</script>
