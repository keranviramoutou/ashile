<?php

/**
 * BaseSpecialiste
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $specialite_id
 * @property integer $secteur_id
 * @property integer $organismesuivit_id
 * @property Specialite $Specialite
 * @property Secteur $Secteur
 * @property OrganismeSuivit $OrganismeSuivit
 * @property Doctrine_Collection $Bilans
 * @property Doctrine_Collection $SuivitExterne
 * 
 * @method integer             getSpecialiteId()       Returns the current record's "specialite_id" value
 * @method integer             getSecteurId()          Returns the current record's "secteur_id" value
 * @method integer             getOrganismesuivitId()  Returns the current record's "organismesuivit_id" value
 * @method Specialite          getSpecialite()         Returns the current record's "Specialite" value
 * @method Secteur             getSecteur()            Returns the current record's "Secteur" value
 * @method OrganismeSuivit     getOrganismeSuivit()    Returns the current record's "OrganismeSuivit" value
 * @method Doctrine_Collection getBilans()             Returns the current record's "Bilans" collection
 * @method Doctrine_Collection getSuivitExterne()      Returns the current record's "SuivitExterne" collection
 * @method Specialiste         setSpecialiteId()       Sets the current record's "specialite_id" value
 * @method Specialiste         setSecteurId()          Sets the current record's "secteur_id" value
 * @method Specialiste         setOrganismesuivitId()  Sets the current record's "organismesuivit_id" value
 * @method Specialiste         setSpecialite()         Sets the current record's "Specialite" value
 * @method Specialiste         setSecteur()            Sets the current record's "Secteur" value
 * @method Specialiste         setOrganismeSuivit()    Sets the current record's "OrganismeSuivit" value
 * @method Specialiste         setBilans()             Sets the current record's "Bilans" collection
 * @method Specialiste         setSuivitExterne()      Sets the current record's "SuivitExterne" collection
 * 
 * @package    ash
 * @subpackage model
 * @author     regis Gravant
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseSpecialiste extends Personne
{
    public function setTableDefinition()
    {
        parent::setTableDefinition();
        $this->setTableName('specialiste');
        $this->hasColumn('specialite_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('secteur_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('organismesuivit_id', 'integer', null, array(
             'type' => 'integer',
             ));

        $this->option('collate', 'utf8_unicode_ci');
        $this->option('charset', 'utf8');
        $this->option('type', 'InnoDB');
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Specialite', array(
             'local' => 'specialite_id',
             'foreign' => 'id'));

        $this->hasOne('Secteur', array(
             'local' => 'secteur_id',
             'foreign' => 'id'));

        $this->hasOne('OrganismeSuivit', array(
             'local' => 'organismesuivit_id',
             'foreign' => 'id'));

        $this->hasMany('Bilan as Bilans', array(
             'local' => 'id',
             'foreign' => 'specialiste_id'));

        $this->hasMany('SuivitExterne', array(
             'local' => 'id',
             'foreign' => 'specialiste_id'));
    }
}