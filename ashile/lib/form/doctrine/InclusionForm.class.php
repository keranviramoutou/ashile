<?php

/**
 * Inclusion form.
 *
 * @package    ash
 * @subpackage form
 * @author     regis Gravant
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class InclusionForm extends BaseInclusionForm
{
  public function configure()
  {
        $this->widgetSchema->setLabels(array(
            'classe_id' => 'Classe d\'inclusion :',
            'temspclasseintegration' => 'Quotité temps :'
        ));
		
			
						
	/*--	$res2s  = Doctrine_Query::Create()
							->from('Classe c')
							->innerjoin('c.Typeetablissement t on t.id = c.typeetablissement_id ')
							->innerjoin('t.Etabscos e on e.typeetablissement_id = t.id')
							->innerJoin('c.TypeClasse tc ON tc.id = c.typeclasse_id')
							->where( 'e.id = ?', 276 );	
						//	->orderBy('tc.ordre');
   
		$this->widgetSchema['classe_id'] = new sfWidgetFormDoctrineChoice(array(
                    'model' => 'classe',
                    'query' => $res2s,
                    'add_empty' =>'tt',
                )); --*/
				
				
  }
}
