<?php use_stylesheet('data_table.css') ?>
<?php use_stylesheet('datatable_jui.css') ?>
<?php use_javascript('jquery.dataTables.min.js') ?>
<?php use_helper('Date') ?>
<?php use_helper('jQuery') ?>

<script type="text/javascript">
   $j(document).ready(function() {
       oTable = $j('#maTable').dataTable({
           "bJQueryUI": true,
           "sPaginationType": "full_numbers",
           "oLanguage" : {
               "sProcessing":     "Traitement en cours...",
               "sLengthMenu":     "Afficher _MENU_ matériels",
               "sZeroRecords":    "Aucun matériels; afficher",
               "sInfo":           "Affichage du matériel _START_ &agrave; _END_ sur _TOTAL_ matériel(s)",
               "sInfoEmpty":      "Affichage du matériel; 0 sur 0 matériel(s)",
               "sInfoFiltered":   "(filtr&eacute; de _MAX_ matériels au total)",
               "sInfoPostFix":    "",
               "sSearch":         "Rechercher&nbsp;:",
               "sLoadingRecords": "Téléchargement...",
               "sUrl":            "",
               "oPaginate": {
                   "sFirst":    "Premier",
                   "sPrevious": "Pr&eacute;c&eacute;dent",
                   "sNext":     "Suivant",
                   "sLast":     "Dernier"
               }
           }
       });
   } );
</script>



<div id="eleve_materiel"> 

<form action="javascript:maFonction()" name="livraison">
<SELECT id="selection" size="1">
	<option value="parent">  Matériel(s) remis aux parents <br>
	<option value="erf"  selected="selected">Matériel(s) remis à l'Erf <br>
</select>&nbsp;&nbsp; le <input type="text" name="dateRemise" id="calendrier1" style="width:80px;"><br>
<br>&nbsp;&nbsp;&nbsp;<input type="submit" value="Mise à jour date de remise " style="float: left" onClick="remiseMat()">
&nbsp;&nbsp;&nbsp;<input type="submit" value="Génération du Bon de livraison" style="float: left" onClick="editionBdl()"><br><br><br>
   </fieldset>
<small>

		<table cellpadding="0" cellspacing="0" border="0" class="display" id="maTable">
	  <thead>
		<tr>
		  <th>Id du prêt</th>
          <th> Matériel(s) alloué(s) </th> 
		  <th>catégorie </th>
		  <th>N° de série</th>
		  <th> Elève</th>
		  <th> Attribution </th> 
		  <th>date remise ERF</th>
		  <th>Date <br>de début <br>de prêt *</th>
		  <th>Date de Fin de prêt</th>
		 
		</tr>
	  </thead>
	  <tbody>
		<?php foreach ($Materielnonlivre as $elevemateriel): ?>
		<tr>
		        <td> <?php echo "&nbsp;<input type='checkbox' name='groupMateriel' value='".$elevemateriel['elevemateriel_id']."'>".'&nbsp;'.$elevemateriel['elevemateriel_id'] ?></td>
				<td><a href="<?php echo url_for('materiel/edit?id='.$elevemateriel['materiel_id']); ?>">
				<?php  echo $elevemateriel['libelleMateriel'].$elevemateriel['caracteristiqueMateriel'].'</a>&nbsp - type :&nbsp;'.$elevemateriel['typemateriel'].'</a>&nbsp - marque :&nbsp;'.$elevemateriel['libellemarque']   ?></td>
				<td><?php  echo  $elevemateriel['libellecatmateriel'] ?></td>
				<td><?php  echo  $elevemateriel['numeromateriel'] ?></td>
				<td> <?php echo $elevemateriel['nomeleve'].'&nbsp;-&nbsp;'.$elevemateriel['prenomeleve'] ?> </td>
				<td><?php if($elevemateriel['datefin']) {?>
				<a href="<?php echo url_for('eleve_materiel/edit?id='.$elevemateriel['elevemateriel_id'].'&eleve_id='.$elevemateriel['eleve_id'].'&materiel_id='.$elevemateriel['materiel_id']); ?>"><?php  echo 'Modifier' ?></a>
				
				</td>
				<?php } ?>
				</td>
				<td><?php echo format_date($elevemateriel['dateremiserf'],'dd/MM/yyyy') ?></td>
				<td><?php echo format_date($elevemateriel['datedebut'],'dd/MM/yyyy') ?></td>
				<td><?php echo format_date($elevemateriel['datefin'],'dd/MM/yyyy') ?></td>
				
		</tr>
		<?php endforeach; ?>
	  </tbody>
	</table>
		
	</form>
</div>




<script>
var src = "<?php echo url_for('eleve_materiel/aide') ?>";

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

	<!-- Script pour DatePicker -->
	<script>
		$j(function() {
		$j( "#calendrier1" ).datepicker({ dateFormat: 'dd-mm-yy'}); //'format_date' => ''  dd/mm/yy
	
		});
	<!---------------------------->
   </script>
<script>
	
	/* ---- fonction qui envoie les materiel attribué selectionés pour edition du bon de livraison */
	
	function editionBdl() {

		var lesMats = [];
		var REMOTE_ADDR = '<?php echo($_SERVER['REMOTE_ADDR']); ?>';
		var HTTP_HOST = '<?php echo($_SERVER['HTTP_HOST']); ?>';

		if (HTTP_HOST == 'ashile2.ac-reunion.fr' && REMOTE_ADDR == '192.168.220.3' ) //portail.ac-reunion.fr
		  {
				 var url_dest = 'https://portail.ac-reunion.fr/ashile/academie.php/eleve_materiel/bdlpdf?lesMats= ' ;
		
		} else if (HTTP_HOST  == 'ashile.ac-reunion.fr' && REMOTE_ADDR == '192.168.220.3' ) { 
				 var url_dest = 'https://portail.ac-reunion.fr/ashilep/academie.php/eleve_materiel/bdlpdf?lesMats= ' ;
		  } 
		
		 if ( HTTP_HOST  == 'ashile2.ac-reunion.fr' && REMOTE_ADDR == '172.31.176.121' ) // accueil.in.ac-reunion.fr
		  {
				 var url_dest = 'https://accueil.in.ac-reunion.fr/ashile/academie.php/eleve_materiel/bdlpdf?lesMats=';
		 
		 } else if( HTTP_HOST  == 'ashile.ac-reunion.fr' && REMOTE_ADDR == '172.31.176.121' ){
				 var url_dest = 'https://accueil.in.ac-reunion.fr/ashilep/academie.php/eleve_materiel/bdlpdf?lesMats=' ;
		  }    
		 else{ var url_dest ='toto';}
			
			for (i=0;i<document.getElementsByName("groupMateriel").length;i++)
			{
				if(document.getElementsByName("groupMateriel")[i].checked)
				{
					lesMats[i] =document.getElementsByName("groupMateriel")[i].value;
				}
			}
			 dateremiseerf = document.getElementById("calendrier1").value ;
			 var url_dest =  url_dest+lesMats+"";
		if(lesMats != '' ){		
		//$href="http://accueil.in.ac-reunion.fr/ashilep/academie.php/eleve_materiel/bdlpdf?lesMats="+lesMats+""; 
		// document.location.replace(url_dest); 
		 window.open(url_dest,"popupWindow","width=710,height=700,left=220,top=10");	
		}else{
		alert ('Vous devez selectionner le matériel à éditer sur le bon de livraison');
		}
		
		 
	}
	
	
		function remiseMat() {

		var lesMats = [];
				var REMOTE_ADDR = '<?php echo($_SERVER['REMOTE_ADDR']); ?>';
		var HTTP_HOST = '<?php echo($_SERVER['HTTP_HOST']); ?>';

		if (HTTP_HOST == 'ashile2.ac-reunion.fr' && REMOTE_ADDR == '192.168.220.3' ) //portail.ac-reunion.fr
		  {
				 var url_dest = 'https://portail.ac-reunion.fr/ashile/academie.php/eleve_materiel/bdlpdf?lesMats= ' ;
		
		} else if (HTTP_HOST  == 'ashile.ac-reunion.fr' && REMOTE_ADDR == '192.168.220.3' ) { 
				 var url_dest = 'https://portail.ac-reunion.fr/ashilep/academie.php/eleve_materiel/bdlpdf?lesMats= ' ;
		  } 
		
		 if ( HTTP_HOST  == 'ashile2.ac-reunion.fr' && REMOTE_ADDR == '172.31.176.121' ) // accueil.in.ac-reunion.fr
		  {
				 var url_dest = 'https://accueil.in.ac-reunion.fr/ashile/academie.php/eleve_materiel/bdlpdf?lesMats=';
		 
		 } else if( HTTP_HOST  == 'ashile.ac-reunion.fr' && REMOTE_ADDR == '172.31.176.121' ){
				 var url_dest = 'https://accueil.in.ac-reunion.fr/ashilep/academie.php/eleve_materiel/bdlpdf?lesMats=' ;
		  }    
		 else{ var url_dest ='toto';}
			
			for (i=0;i<document.getElementsByName("groupMateriel").length;i++)
			{
				if(document.getElementsByName("groupMateriel")[i].checked)
				{
					lesMats[i] =document.getElementsByName("groupMateriel")[i].value;
				}
			}
			
			dateremiseerf = document.getElementById("calendrier1").value ;
			//var url_dest =  url_dest+lesMats+"&dateremiseerf="+dateremiseerf+"";
			var selectElmt = document.getElementById("selection");
			var valeurselectionnee = selectElmt.options[selectElmt.selectedIndex].value;

			
			
		if (document.getElementById("calendrier1").value != '' && lesMats != ''  ){	

			if ( valeurselectionnee == 'erf'){ //matériel remis à ERF
				var url_dest =  url_dest+lesMats+"&dateremiseerf="+dateremiseerf+"";
				//alert('titi');
			
			}else{ //matériel remis aux parents
			   var url_dest =  url_dest+lesMats+"&dateremiseparent="+dateremiseerf+"";
			  // alert('ttututu');
			} 
			document.location.replace(url_dest); //redirection
		}else{
		//alert(document.getElementByName("selection")[0].value );
		alert ('Vous devez selectionner le matériel et saisir une date de mise à jour');
		}
	}
</script>