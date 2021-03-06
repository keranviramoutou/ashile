<?php

/**
 * BaseOrganismeSuivit
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $libellesuivit
 * @property integer $secteur_id
 * @property Secteur $Secteur
 * @property Doctrine_Collection $SuivitExternes
 * @property Doctrine_Collection $Specialistes
 * 
 * @method string              getLibellesuivit()  Returns the current record's "libellesuivit" value
 * @method integer             getSecteurId()      Returns the current record's "secteur_id" value
 * @method Secteur             getSecteur()        Returns the current record's "Secteur" value
 * @method Doctrine_Collection getSuivitExternes() Returns the current record's "SuivitExternes" collection
 * @method Doctrine_Collection getSpecialistes()   Returns the current record's "Specialistes" collection
 * @method OrganismeSuivit     setLibellesuivit()  Sets the current record's "libellesuivit" value
 * @method OrganismeSuivit     setSecteurId()      Sets the current record's "secteur_id" value
 * @method OrganismeSuivit     setSecteur()        Sets the current record's "Secteur" value
 * @method OrganismeSuivit     setSuivitExternes() Sets the current record's "SuivitExternes" collection
 * @method OrganismeSuivit     setSpecialistes()   Sets the current record's "Specialistes" collection
 * 
 * @package    ash
 * @subpackage model
 * @author     regis Gravant
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseOrganismeSuivit extends Etabnonsco
{
    public function setTableDefinition()
    {
        parent::setTableDefinition();
        $this->setTableName('organisme_suivit');
        $this->hasColumn('libellesuivit', 'string', 100, array(
             'type' => 'string',
             'length' => 100,
             ));
        $this->hasColumn('secteur_id', 'integer', null, array(
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
        $this->hasOne('Secteur', array(
             'local' => 'secteur_id',
             'foreign' => 'id'));

        $this->hasMany('SuivitExterne as SuivitExternes', array(
             'local' => 'id',
             'foreign' => 'organismesuivit_id'));

        $this->hasMany('Specialiste as Specialistes', array(
             'local' => 'id',
             'foreign' => 'organismesuivit_id'));
    }
}