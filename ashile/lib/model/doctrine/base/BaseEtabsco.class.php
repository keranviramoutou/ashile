<?php

/**
 * BaseEtabsco
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $quartier_id
 * @property integer $typeetablissement_id
 * @property integer $circonscription_id
 * @property string $rne
 * @property string $nometabsco
 * @property string $degreetabsco
 * @property string $adresseetabscobat
 * @property string $adresseetabscorue
 * @property string $telephoneetabsco
 * @property string $faxetabsco
 * @property string $emailetabsco
 * @property boolean $etabref
 * @property integer $directeuretab_id
 * @property integer $inclusionetab_id
 * @property Typeetablissement $Typeetablissement
 * @property Circonscription $Circonscription
 * @property Quartier $Quartier
 * @property DirecteurEtab $DirecteurEtab
 * @property EtabscoInclusion $EtabscoInclusion
 * @property Doctrine_Collection $ContratAvss
 * @property Doctrine_Collection $Orientations
 * @property Doctrine_Collection $SecteurEtabscos
 * 
 * @method integer             getQuartierId()           Returns the current record's "quartier_id" value
 * @method integer             getTypeetablissementId()  Returns the current record's "typeetablissement_id" value
 * @method integer             getCirconscriptionId()    Returns the current record's "circonscription_id" value
 * @method string              getRne()                  Returns the current record's "rne" value
 * @method string              getNometabsco()           Returns the current record's "nometabsco" value
 * @method string              getDegreetabsco()         Returns the current record's "degreetabsco" value
 * @method string              getAdresseetabscobat()    Returns the current record's "adresseetabscobat" value
 * @method string              getAdresseetabscorue()    Returns the current record's "adresseetabscorue" value
 * @method string              getTelephoneetabsco()     Returns the current record's "telephoneetabsco" value
 * @method string              getFaxetabsco()           Returns the current record's "faxetabsco" value
 * @method string              getEmailetabsco()         Returns the current record's "emailetabsco" value
 * @method boolean             getEtabref()              Returns the current record's "etabref" value
 * @method integer             getDirecteuretabId()      Returns the current record's "directeuretab_id" value
 * @method integer             getInclusionetabId()      Returns the current record's "inclusionetab_id" value
 * @method Typeetablissement   getTypeetablissement()    Returns the current record's "Typeetablissement" value
 * @method Circonscription     getCirconscription()      Returns the current record's "Circonscription" value
 * @method Quartier            getQuartier()             Returns the current record's "Quartier" value
 * @method DirecteurEtab       getDirecteurEtab()        Returns the current record's "DirecteurEtab" value
 * @method EtabscoInclusion    getEtabscoInclusion()     Returns the current record's "EtabscoInclusion" value
 * @method Doctrine_Collection getContratAvss()          Returns the current record's "ContratAvss" collection
 * @method Doctrine_Collection getOrientations()         Returns the current record's "Orientations" collection
 * @method Doctrine_Collection getSecteurEtabscos()      Returns the current record's "SecteurEtabscos" collection
 * @method Etabsco             setQuartierId()           Sets the current record's "quartier_id" value
 * @method Etabsco             setTypeetablissementId()  Sets the current record's "typeetablissement_id" value
 * @method Etabsco             setCirconscriptionId()    Sets the current record's "circonscription_id" value
 * @method Etabsco             setRne()                  Sets the current record's "rne" value
 * @method Etabsco             setNometabsco()           Sets the current record's "nometabsco" value
 * @method Etabsco             setDegreetabsco()         Sets the current record's "degreetabsco" value
 * @method Etabsco             setAdresseetabscobat()    Sets the current record's "adresseetabscobat" value
 * @method Etabsco             setAdresseetabscorue()    Sets the current record's "adresseetabscorue" value
 * @method Etabsco             setTelephoneetabsco()     Sets the current record's "telephoneetabsco" value
 * @method Etabsco             setFaxetabsco()           Sets the current record's "faxetabsco" value
 * @method Etabsco             setEmailetabsco()         Sets the current record's "emailetabsco" value
 * @method Etabsco             setEtabref()              Sets the current record's "etabref" value
 * @method Etabsco             setDirecteuretabId()      Sets the current record's "directeuretab_id" value
 * @method Etabsco             setInclusionetabId()      Sets the current record's "inclusionetab_id" value
 * @method Etabsco             setTypeetablissement()    Sets the current record's "Typeetablissement" value
 * @method Etabsco             setCirconscription()      Sets the current record's "Circonscription" value
 * @method Etabsco             setQuartier()             Sets the current record's "Quartier" value
 * @method Etabsco             setDirecteurEtab()        Sets the current record's "DirecteurEtab" value
 * @method Etabsco             setEtabscoInclusion()     Sets the current record's "EtabscoInclusion" value
 * @method Etabsco             setContratAvss()          Sets the current record's "ContratAvss" collection
 * @method Etabsco             setOrientations()         Sets the current record's "Orientations" collection
 * @method Etabsco             setSecteurEtabscos()      Sets the current record's "SecteurEtabscos" collection
 * 
 * @package    ash
 * @subpackage model
 * @author     regis Gravant
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseEtabsco extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('etabsco');
        $this->hasColumn('quartier_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('typeetablissement_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('circonscription_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('rne', 'string', 8, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 8,
             ));
        $this->hasColumn('nometabsco', 'string', 100, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 100,
             ));
        $this->hasColumn('degreetabsco', 'string', 25, array(
             'type' => 'string',
             'length' => 25,
             ));
        $this->hasColumn('adresseetabscobat', 'string', 100, array(
             'type' => 'string',
             'length' => 100,
             ));
        $this->hasColumn('adresseetabscorue', 'string', 100, array(
             'type' => 'string',
             'length' => 100,
             ));
        $this->hasColumn('telephoneetabsco', 'string', 10, array(
             'type' => 'string',
             'regexp' => '/^([\\s]*[0-9]+[\\s]*)+$/',
             'length' => 10,
             ));
        $this->hasColumn('faxetabsco', 'string', 10, array(
             'type' => 'string',
             'regexp' => '/^([\\s]*[0-9]+[\\s]*)+$/',
             'length' => 10,
             ));
        $this->hasColumn('emailetabsco', 'string', 150, array(
             'type' => 'string',
             'length' => 150,
             ));
        $this->hasColumn('etabref', 'boolean', null, array(
             'type' => 'boolean',
             ));
        $this->hasColumn('directeuretab_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => false,
             ));
        $this->hasColumn('inclusionetab_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => false,
             ));

        $this->option('collate', 'utf8_unicode_ci');
        $this->option('charset', 'utf8');
        $this->option('type', 'InnoDB');
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Typeetablissement', array(
             'local' => 'typeetablissement_id',
             'foreign' => 'id'));

        $this->hasOne('Circonscription', array(
             'local' => 'circonscription_id',
             'foreign' => 'id'));

        $this->hasOne('Quartier', array(
             'local' => 'quartier_id',
             'foreign' => 'id'));

        $this->hasOne('DirecteurEtab', array(
             'local' => 'directeuretab_id',
             'foreign' => 'id'));

        $this->hasOne('EtabscoInclusion', array(
             'local' => 'inclusionetab_id',
             'foreign' => 'id'));

        $this->hasMany('ContratAvs as ContratAvss', array(
             'local' => 'id',
             'foreign' => 'etabsco_id'));

        $this->hasMany('Orientation as Orientations', array(
             'local' => 'id',
             'foreign' => 'etabsco_id'));

        $this->hasMany('SecteurEtabsco as SecteurEtabscos', array(
             'local' => 'id',
             'foreign' => 'etabsco_id'));
    }
}