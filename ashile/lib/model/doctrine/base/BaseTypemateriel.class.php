<?php

/**
 * BaseTypemateriel
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $libelletypemateriel
 * @property Doctrine_Collection $DemandeMateriels
 * @property Doctrine_Collection $DetailCommande
 * @property Doctrine_Collection $Materiels
 * 
 * @method string              getLibelletypemateriel() Returns the current record's "libelletypemateriel" value
 * @method Doctrine_Collection getDemandeMateriels()    Returns the current record's "DemandeMateriels" collection
 * @method Doctrine_Collection getDetailCommande()      Returns the current record's "DetailCommande" collection
 * @method Doctrine_Collection getMateriels()           Returns the current record's "Materiels" collection
 * @method Typemateriel        setLibelletypemateriel() Sets the current record's "libelletypemateriel" value
 * @method Typemateriel        setDemandeMateriels()    Sets the current record's "DemandeMateriels" collection
 * @method Typemateriel        setDetailCommande()      Sets the current record's "DetailCommande" collection
 * @method Typemateriel        setMateriels()           Sets the current record's "Materiels" collection
 * 
 * @package    ash
 * @subpackage model
 * @author     regis Gravant
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseTypemateriel extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('typemateriel');
        $this->hasColumn('libelletypemateriel', 'string', 100, array(
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
        $this->hasMany('DemandeMateriel as DemandeMateriels', array(
             'local' => 'id',
             'foreign' => 'typemateriel_id'));

        $this->hasMany('DetailCommande', array(
             'local' => 'id',
             'foreign' => 'typemateriel_id'));

        $this->hasMany('Materiel as Materiels', array(
             'local' => 'id',
             'foreign' => 'typemateriel_id'));
    }
}