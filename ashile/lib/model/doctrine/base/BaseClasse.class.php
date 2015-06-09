<?php

/**
 * BaseClasse
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $typeetablissement_id
 * @property integer $typeclasse_id
 * @property TypeClasse $TypeClasse
 * @property Typeetablissement $Typeetablissement
 * @property Doctrine_Collection $Inclusions
 * @property Doctrine_Collection $Orientations
 * 
 * @method integer             getTypeetablissementId()  Returns the current record's "typeetablissement_id" value
 * @method integer             getTypeclasseId()         Returns the current record's "typeclasse_id" value
 * @method TypeClasse          getTypeClasse()           Returns the current record's "TypeClasse" value
 * @method Typeetablissement   getTypeetablissement()    Returns the current record's "Typeetablissement" value
 * @method Doctrine_Collection getInclusions()           Returns the current record's "Inclusions" collection
 * @method Doctrine_Collection getOrientations()         Returns the current record's "Orientations" collection
 * @method Classe              setTypeetablissementId()  Sets the current record's "typeetablissement_id" value
 * @method Classe              setTypeclasseId()         Sets the current record's "typeclasse_id" value
 * @method Classe              setTypeClasse()           Sets the current record's "TypeClasse" value
 * @method Classe              setTypeetablissement()    Sets the current record's "Typeetablissement" value
 * @method Classe              setInclusions()           Sets the current record's "Inclusions" collection
 * @method Classe              setOrientations()         Sets the current record's "Orientations" collection
 * 
 * @package    ash
 * @subpackage model
 * @author     regis Gravant
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseClasse extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('classe');
        $this->hasColumn('typeetablissement_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('typeclasse_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));

        $this->option('collate', 'utf8_unicode_ci');
        $this->option('charset', 'utf8');
        $this->option('type', 'InnoDB');
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('TypeClasse', array(
             'local' => 'typeclasse_id',
             'foreign' => 'id'));

        $this->hasOne('Typeetablissement', array(
             'local' => 'typeetablissement_id',
             'foreign' => 'id'));

        $this->hasMany('Inclusion as Inclusions', array(
             'local' => 'id',
             'foreign' => 'classe_id'));

        $this->hasMany('Orientation as Orientations', array(
             'local' => 'id',
             'foreign' => 'classe_id'));
    }
}