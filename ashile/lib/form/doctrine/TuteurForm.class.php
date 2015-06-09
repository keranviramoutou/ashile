<?php

/**
 * Tuteur form.
 *
 * @package    ash
 * @subpackage form
 * @author     regis Gravant
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class TuteurForm extends BaseTuteurForm {

    /**
     * @see PersonneForm
     */
    public function configure() {
        parent::configure();

        $this->widgetSchema->setLabels(array(
            'tuteurlegal' => 'Tuteur légal :',
            'typeresponsableeleve_id' => 'Lien :'
        ));

        $this->embedRelations(array(
            'ResponsableEleve' => array(
                'considerNewFormEmptyFields' => array(),
                'noNewForms' => true,
                'newFormLabel' => false,
                'formClassArgs' => array(array('ah_add_delete_checkbox' => false)),
            )
        ));
        
        $this->setValidator('eleve_id', new sfValidatorString());

        // Recuperation de eleve_id depuis le form eleve
        $eleve_id = sfContext::getInstance()->getUser()->getAttribute('eleve_id');

        // Recuperation des lignes dans les tables
        $res1s = Doctrine_core::getTable('TypeResponsableEleve')->findAll();
        $res2s = Doctrine_core::getTable('Tuteur')->findByEleveId($eleve_id);
        // Mettre le type dans un tableau $id => $libelle
        //instanciation des variables tableau
        $res1Arrays = array();
        $res2Arrays = array();
        $autreKey = 0;
        $autreValue = '';
        foreach ($res1s as $res1) {
            $res1Arrays[$res1->getId()] = $res1->getDenomination();
            // S'il n'y a plus des types tuteurs dispo, on va mettre autre par defaut
            if ((strtolower($res1->getDenomination()) == 'autre') || (strtolower($res1->getDenomination()) == 'autres')) {
                $autreKey = $res1->getId();
                $autreValue = $res1->getDenomination();
            }
        }
        // Mettre dans un tableau le type de lien de tuteur
        $i = 0;

        foreach ($res2s as $res2) {
            $res2Arrays[++$i] = Doctrine_core::getTable('TypeResponsableEleve')->find($res2->getTyperesponsableeleveId());
        }

        // Ici la difference des 2 tableaux à afficher dans le choix
        $resArray = array_diff($res1Arrays, $res2Arrays);
        // Ajouter autre
        if ((!in_array($autreValue, $resArray)) || ($autreValue != ''))
            $resArray[$autreKey] = $autreValue;

        // Si c'est en edit afficher la valeur de lien pour ce tuteur dans le choix qui etait enlevé dans le difference
        if (sfContext::getInstance()->getActionName() == 'edit') {
            // Recuperation de typeResponsableEleveId pris dans actions.class executeEdit
            $key = sfContext::getInstance()->getUser()->getAttribute('typeResponsableEleveId');
            $resArray[$key] = $res1Arrays[$key];

        }
        $this->widgetSchema['autretyperesponsable'] = new sfWidgetFormInputText(array(), array("style"=>'width: 250px;'));
        $this->widgetSchema['typeresponsableeleve_id'] = new sfWidgetFormChoice(array('choices' => $resArray, 'multiple' => false, 'expanded' => false, 'label' => 'Lien :'));
        $this->setDefault('tuteurlegal', false);
    }

}
