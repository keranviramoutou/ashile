<?php use_helper('jQuery') ?>
<?php use_stylesheet('data_table.css') ?>
<?php use_stylesheet('datatable_jui.css') ?>
<?php use_javascript('jquery.dataTables.min.js') ?>
<?php use_helper('Date') ?>




<div>
		


<?php // echo '<br>count_bascul1&nbsp;'.$bascule1 ?>

<?php //echo '<br>count_bascul&nbsp;'.$bascule ?>


	<div id="recherche_materiel">
		<fieldset>  
				<div class='aide' onClick="<?php echo url_for('orientation/aide') ?>"> </div> 
		         <h3> <?php echo 'Administration > Bascule de l\'Année scolaire en cours :&nbsp;'.format_date( $deb_encours,'dd/MM/yyyy').'&nbsp;au&nbsp;'.format_date( $fin_encours,'dd/MM/yyyy')  ?></h3>
			   
		<form action="<?php echo url_for('orientation/bascule'); ?>" method="POST">
        <table>
		<tfoot>  
		<?php if( $bascule1 == 0){ ?>
		<?php //if( $_POST['datedebut'] && $_POST['datefin']){ ?>
		<?php echo 'Nombre de scolarité en cours à basculer :&nbsp;<strong>'.$count_eleve.' scolarité(s)</strong><br>' ?>
        <?php // } ?>
						<br>Début de la nouvelle année scolaire  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="text" value="<?php echo $_POST['datedebut'] ?>" name="datedebut" style="width:80px" id="calendrier"></br>
						<br>Fin de la nouvelle année scolaire &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="text" value="<?php echo $_POST['datefin'] ?>" name="datefin" style="width:80px" id="calendrier1"></br>
					
					    <br> <input type="submit" value="Basculer" />
	   <?php }else{ ?>
	   
	   <?php } ?>
						 
	   </tfoot>

      </table>
      </form>

 	   </fieldset>	
 
<?php if(1) { 
	echo '<div>';
	  //include_partial('resultat_bascule', array('orientation' => $orientation,'bascule' => $bascule,'bascule1' => $bascule1)); 
	echo '<div>';
	};
	?>

	</div>

	<!-- Script pour DatePicker -->
	<script>
		$j(function() {
		$j( "#calendrier" ).datepicker({ dateFormat: 'dd-mm-yy'}); //'format_date' => ''  dd/mm/yy
		$j( "#calendrier1" ).datepicker({ dateFormat: 'dd-mm-yy'}); //'format_date' => ''  dd/mm/yy
		});
	</script>
	<!---------------------------->


<script>
var src = "<?php echo url_for('orientation/aide') ?>";

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
