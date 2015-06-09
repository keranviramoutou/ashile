<?php

/**
 * BaseDemandeSessad
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $mdph_id
 * @property integer $typesessad_id
 * @property date $date_demande_sessad
 * @property date $datedebutnotif
 * @property date $datefinnotif
 * @property date $datedecisioncda
 * @property boolean $decisioncda
 * @property boolean $traite
 * @property boolean $etat
 * @property clob $notes
 * @property Typesessad $Typesessad
 * @property Mdph $Mdph
 * 
 * @method integer       getMdphId()              Returns the current record's "mdph_id" value
 * @method integer       getTypesessadId()        Returns the current record's "typesessad_id" value
 * @method date          getDateDemandeSessad()   Returns the current record's "date_demande_sessad" value
 * @method date          getDatedebutnotif()      Returns the current record's "datedebutnotif" value
 * @method date          getDatefinnotif()        Returns the current record's "datefinnotif" value
 * @method date          getDatedecisioncda()     Returns the current record's "datedecisioncda" value
 * @method boolean       getDecisioncda()         Returns the current record's "decisioncda" value
 * @method boolean       getTraite()              Returns the current record's "traite" value
 * @method boolean       getEtat()                Returns the current record's "etat" value
 * @method clob          getNotes()               Returns the current record's "notes" value
 * @method Typesessad    getTypesessad()          Returns the current record's "Typesessad" value
 * @method Mdph          getMdph()                Returns the current record's "Mdph" value
 * @method DemandeSessad setMdphId()              Sets the current record's "mdph_id" value
 * @method DemandeSessad setTypesessadId()        Sets the current record's "typesessad_id" value
 * @method DemandeSessad setDateDemandeSessad()   Sets the current record's "date_demande_sessad" value
 * @method DemandeSessad setDatedebutnotif()      Sets the current record's "datedebutnotif" value
 * @method DemandeSessad setDatefinnotif()        Sets the current record's "datefinnotif" value
 * @method DemandeSessad setDatedecisioncda()     Sets the current record's "datedecisioncda" value
 * @method DemandeSessad setDecisioncda()         Sets the current record's "decisioncda" value
 * @method DemandeSessad setTraite()              Sets the current record's "traite" value
 * @method DemandeSessad setEtat()                Sets the current record's "etat" value
 * @method DemandeSessad setNotes()               Sets the current record's "notes" value
 * @method DemandeSessad setTypesessad()          Sets the current record's "Typesessad" value
 * @method DemandeSessad setMdph()                Sets the current record's "Mdph" value
 * 
 * @package    ash
 * @subpackage model
 * @author     regis Gravant
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseDemandeSessad extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('demande_sessad');
        $this->hasColumn('mdph_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             'unique' => true,
             ));
        $this->hasColumn('typesessad_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('date_demande_sessad', 'date', null, array(
             'type' => 'date',
             ));
        $this->hasColumn('datedebutnotif', 'date', null, array(
             'type' => 'date',
             ));
        $this->hasColumn('datefinnotif', 'date', null, array(
             'type' => 'date',
             ));
        $this->hasColumn('datedecisioncda', 'date', null, array(
             'type' => 'date',
             ));
        $this->hasColumn('decisioncda', 'boolean', null, array(
             'type' => 'boolean',
             ));
        $this->hasColumn('traite', 'boolean', null, array(
             'type' => 'boolean',
             ));
        $this->hasColumn('etat', 'boolean', null, array(
             'type' => 'boolean',
             ));
        $this->hasColumn('notes', 'clob', 65535, array(
             'type' => 'clob',
             'length' => 65535,
             ));

        $this->option('collate', 'utf8_unicode_ci');
        $this->option('charset', 'utf8');
        $this->option('type', 'InnoDB');
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Typesessad', array(
             'local' => 'typesessad_id',
             'foreign' => 'id'));

        $this->hasOne('Mdph', array(
             'local' => 'mdph_id',
             'foreign' => 'id',
             'owningSide' => true));
    }
}