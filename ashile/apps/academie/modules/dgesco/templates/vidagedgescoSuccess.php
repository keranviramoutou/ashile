<div class='aide' onClick="<?php echo url_for('dgesco/aide') ?>"> </div> 
 <h3> Enquêtes > DEGSCO > Archivage de l'enquête</h3>	<br>
<br><br>

 <div id="transfert">	
	<?php
 
 $vars = array(
   'options'   => $options,
   'delimiter' => $delimiter,
   'enclosure' => $enclosure,
   'outstream' => $outstream,
   'charset'   => $charset,
   'lines'     => $lines);
 

 
 if ( count($lines) > 0 && $sf_request->getParameter('vidage') == 1) 
 {
  //création du fichier d'export
  //--------------------------
   $repertoire_export = $outstream;
   $outstream = fopen($outstream, 'w');

 // création du contenu du fichier
 //---------------------------------
 foreach ( $lines as $line )
 {
     //unset($line['id']);
     
   foreach ( $line as $key => $value )
   $line[$key] = @iconv($charset['db'], $charset['ms'], $value);
  // echo $line['num_question'].'<br>';
   fputcsv($outstream, $line, $delimiter, $enclosure);
  // ob_flush();
  
  
 }
 
 
   //zippage du fichier archive
  //-----------------------------
  $fichierzip = sfConfig::get('sf_upload_dir').'/exportbase/'.$fichier.'.zip' ;
  $zip = new ZipArchive();
  $zip->open($fichierzip, ZipArchive::CREATE);
  $zip->addFile( $repertoire_export);
  
  
 //  echo 'fhicerzip'.$fichierzip ;
 //  echo '<br>'.$repertoire_export;
   

        if($_SERVER['REMOTE_ADDR'] == '192.168.220.3'){ //serveur portail
	  	  $chemin = '"https://portail.ac-reunion.fr/ashilep/uploads/exportbase/'.$fichier.'.zip'.'"';
		}
		if($_SERVER['REMOTE_ADDR'] == '172.31.176.121'){ //serveur accueil
		  $chemin_fichier = '"https://accueil.in.ac-reunion.fr/ashilep/uploads/exportbase/'.$fichier.'.zip'.'"';
		}
   
  //Téléchargement fichier archive  zippé
  echo $message = '<fieldset>Table Dgesco exporter au format csv (compressé zip)  <br>avant vidage de la table: <strong> ' ;
  echo   ' <a href='. $chemin_fichier.' >Table Dgesco export</a>'.'<strong><br></fieldset>';

  
 //fclose($outstream);
 }elseif( $sf_request->getParameter('vidage') == 0) {
 echo $message = '<fieldset>Abandon de la procédure  !!</fieldset><br>';
 }
 
 ?>
			
 
	
<br>

	<form action="<?php echo url_for('dgesco/vidagedgesco'); ?>"   onsubmit="return confirme(this.elements['vidage'])" method="POST">
 		
		<fieldset> 
         <table>			
		<tfoot>
				      <tr> 
					
				      <td>

						Vous voulez archiver et vider la table DGESCO ?<br/><br>
						<input type="radio" name="vidage" value= 1 id="oui" /> <label for="oui">oui</label>
						<input type="radio" name="vidage" value= 0  id="non" /> <label for="non">non</label>

						</p>
  
						   <br> <input type="submit" value="Valider" />&nbsp; 
	
					  </td>
				      </tr>

	   </tfoot>

      </table>
	  
     * champs obligatoire
	</fieldset> 
		
    </form>
</div>	

<script>
function confirme(champ) {

var str = champ.value;

if ( str > 0){
var confirmation = confirm('Confirmez vous l\'archivage et le vidage de la table DGESCO ');
 if(confirmation){
  //action à faire pour la valeur true
  return true;
  }
}else{
    alert("Abandon de la procédure" );
  //action à faire pour la valeur false
   return false;
}
}
</script>



