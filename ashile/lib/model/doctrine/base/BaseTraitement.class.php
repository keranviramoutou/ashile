<?php

/**
 * BaseTraitement
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $libelletraitement
 * @property Doctrine_Collection $DemandeMateriels
 * 
 * @method string              getLibelletraitement() Returns the current record's "libelletraitement" value
 * @method Doctrine_Collection getDemandeMateriels()  Returns the current record's "DemandeMateriels" collection
 * @method Traitement          setLibelletraitement() Sets the current record's "libelletraitement" value
 * @method Traitement          setDemandeMateriels()  Sets the current record's "DemandeMateriels" collection
 * 
 * @package    ash
 * @subpackage model
 * @author     regis Gravant
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseTraitement extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('traitement');
        $this->hasColumn('libelletraitement', 'string', 30, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 30,
             ));

        $this->option('collate', 'utf8_unicode_ci');
        $this->option('charset', 'utf8');
        $this->option('type', 'InnoDB');
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('DemandeMateriel as DemandeMateriels', array(
             'local' => 'id',
             'foreign' => 'traitement_id'));
    }
}