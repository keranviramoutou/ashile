<div class='aide' onClick="<?php echo url_for('materiel/aide') ?>"> </div> 
<h3>Matériels > Création d'un matériel</h3>

<?php
echo '<fieldset>';
include_partial('form', array('form' => $form)) ;
echo '</fieldset>';
?>


<script>
var src = "<?php echo url_for('materiel/aide') ?>";

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