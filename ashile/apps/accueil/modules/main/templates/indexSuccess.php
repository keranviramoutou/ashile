
<?php use_helper('Date') ?>
<?php //echo phpinfo() ?>
<!-- On définit 2 styles pour l'affichage des messages destinés à l'utilisateur-->
<style>

.div1{
margin-left: 100px;
margin-top: 60px;	
width:500px;
height:300px;
overflow-y: scroll;
overflow-x: hidden;
padding-right: 5px;
visibility: visible;
border: thin solid white; 
background-color: #D5D5D5; 
scrollbar-face-color: #336699; scrollbar-3dlight-color: #336699; scrollbar-base-color: #336699; 
scrollbar-track-color: #336699; scrollbar-darkshadow-color: #000; scrollbar-arrow-color: #000; 
scrollbar-shadow-color: #fff; scrollbar-highlight-color: #fff; } 
}

</style>

<?php	 ?>
		
		<style>
		.divAnnonce{
		margin-left: 100px;
		margin-top: 60px;	
		width:500px;
		height:90px;
		overflow-y: scroll;
		overflow-x: hidden;
		padding-right: 5px;
		visibility: visible;
		border: thin solid white; 
		background-color: #A5A5A5; 
		scrollbar-face-color: #336699; scrollbar-3dlight-color: #336699; scrollbar-base-color: #336699; 
		scrollbar-track-color: #336699; scrollbar-darkshadow-color: #000; scrollbar-arrow-color: #000; 
		scrollbar-shadow-color: #fff; scrollbar-highlight-color: #fff; } 
		}
		</style>
		<!-- <?php echo 'Mail ERF:&nbsp;'.$_SERVER['HTTP_CTEMAIL'] ?>
		<?php echo '<br>Groupe utilisateur&nbsp; :&nbsp;'.$perm[0] ?>-->
		<?php echo '<br>Remote addr :&nbsp;'.$_SERVER['REMOTE_ADDR'] ?>
		<!-- Un premier div qui contiendra les annonces generales-->
		<div class="divAnnonce" >
				<h4 style="text-align:center;color:white">Messages Généraux</h4>
					<?php

						foreach($messages as $message):
								echo '</br>';
								echo "<i>Message du :".date("d/m/Y")."</i></br>";
								echo $message->getType()."</br>";
						endforeach;
						
					?>
		</div>


<!-- et un second qui contiendra les annonces concernant les eleves du secteur --> 


 <?php /* if($perm[0] == 'eref'){*/ ?> <!-- message côté frontend -->
<div class="div1">
		<h4 style="text-align:center;color:#606060">Messages secteur</h4>
		<?php
			
			foreach($texts as $text):
				echo '</br>';
				echo '<i>Message du :&nbsp;'.format_date($text['date'],'dd/MM/yyyy').'<br>Elève :&nbsp;';
			// if($_SERVER['HTTP_HOST'] == 'ashile.ac-reunion.fr' && $_SERVER['REMOTE_ADDR'] == '192.168.220.3' ){ //en dev
			   echo link_to($text['nom'].'&nbsp'.$text['prenom'], '/ashile/frontend.php/eleve/edit?id=' . $text['eleve_id'] ).'</i></br>';
			  // }else{
			   echo link_to($text['nom'].'&nbsp'.$text['prenom'], '/ashilep/frontend.php/eleve/edit?id=' . $text['eleve_id'] ).'</i></br>';
			   //}
				echo 'Objet :&nbsp;'.$text['sujet'].'</br>';
				echo 'Contenu :&nbsp;<small>'.$text['texte'].'</small>';
				echo '</br>';
				endforeach; ?>
		</div>
		<?php  ?>
	




 <!--<?php if($perm[0] == 'acad'){ ?> <!-- message côté académique -->
 		<?php echo 'Mail Gestionnaire :&nbsp;'.$_SERVER['HTTP_CTEMAIL'] ?>
		<?php echo '<br>Groupe utilisateur  :'.$perm[0] ?>
		<?php echo '<br>Remote Addr :&nbsp;'.$_SERVER['REMOTE_ADDR'] ?>
        <?php //echo '<br>gggg'.sfContext::getInstance()->getConfiguration()->getApplication() ?>
		<div class="div1">
	
		<?php
			include_partial('index', array('nb_nd_avs' => $nb_nd_avs,'nb_am_avs' => $nb_am_avs,'nb_nd_materiel' => $nb_nd_materiel,'nb_am_materiel' => $nb_am_materiel,'nb_nd_sessad' => $nb_nd_sessad,'nb_am_sessad' => $nb_am_sessad,
			'nb_nd_transport' => $nb_nd_transport,'nb_am_transport' => $nb_am_transport)); 
		?>
		</div>
<?php }	?>	

     <div style=margin-left:50px>
	<!-- le bouton -->
	<form>
	  <br>
		 Voulez vous entrer sur l'interface enseignant referent ?  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" value="Entrer"  OnClick="location.href= '/data/appli/ashile/web/frontend.php/eleve/recherche/action'" >

<br>		
 <br>
 <br>
Voulez vous entrer sur l'interface académique  ? &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" value="Entrer"  OnClick="location.href='/data/appli/ashile/web/academie.php/eleve/recherche/action'" >



	</form>	
	</div>

