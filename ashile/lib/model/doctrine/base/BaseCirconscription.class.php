<?php

/**
 * BaseCirconscription
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $num_circonscription
 * @property string $libelle_circonscription
 * @property Doctrine_Collection $Etabscos
 * 
 * @method string              getNumCirconscription()      Returns the current record's "num_circonscription" value
 * @method string              getLibelleCirconscription()  Returns the current record's "libelle_circonscription" value
 * @method Doctrine_Collection getEtabscos()                Returns the current record's "Etabscos" collection
 * @method Circonscription     setNumCirconscription()      Sets the current record's "num_circonscription" value
 * @method Circonscription     setLibelleCirconscription()  Sets the current record's "libelle_circonscription" value
 * @method Circonscription     setEtabscos()                Sets the current record's "Etabscos" collection
 * 
 * @package    ash
 * @subpackage model
 * @author     regis Gravant
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseCirconscription extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('circonscription');
        $this->hasColumn('num_circonscription', 'string', 100, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 100,
             ));
        $this->hasColumn('libelle_circonscription', 'string', 100, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 100,
             ));

        $this->option('collate', 'utf8_unicode_ci');
        $this->option('charset', 'utf8');
        $this->option('type', 'InnoDB');
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('Etabsco as Etabscos', array(
             'local' => 'id',
             'foreign' => 'circonscription_id'));
    }
}