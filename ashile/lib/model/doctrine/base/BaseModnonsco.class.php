<?php

/**
 * BaseModnonsco
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $eleve_id
 * @property integer $etabnonsco_id
 * @property integer $niveauscolairespe_id
 * @property integer $demijournee_id
 * @property integer $classespe_id
 * @property integer $quothorreff
 * @property date $datedebut
 * @property date $datefin
 * @property Classespe $Classespe
 * @property Demijournee $Demijournee
 * @property Etabnonsco $Etabnonsco
  * @property Etabnonsco $Niveauscolairespe
 * @property Eleve $Eleve
 * 
 * @method integer     getEleveId()        Returns the current record's "eleve_id" value
 * @method integer     getEtabnonscoId()   Returns the current record's "etabnonsco_id" value
 * @method integer     getNiveauscolairespeId()   Returns the current record's "niveauscolairespe_id" value
 * @method integer     getDemijourneeId()  Returns the current record's "demijournee_id" value
 * @method integer     getClassespeId()    Returns the current record's "classespe_id" value
 * @method integer     getQuothorreff()    Returns the current record's "quothorreff" value
 * @method date        getDatedebut()      Returns the current record's "datedebut" value
 * @method date        getDatefin()        Returns the current record's "datefin" value
 * @method Classespe   getClassespe()      Returns the current record's "Classespe" value
 * @method Demijournee getDemijournee()    Returns the current record's "Demijournee" value
 * @method Etabnonsco  getEtabnonsco()     Returns the current record's "Etabnonsco" value
 * @method Eleve       getEleve()          Returns the current record's "Eleve" value
 * @method Modnonsco   setEleveId()        Sets the current record's "eleve_id" value
 * @method Modnonsco   setEtabnonscoId()   Sets the current record's "etabnonsco_id" value
 * @method Modnonsco   setNiveauscolairespeId()   Sets the current record's "niveauscolairespe_id" value
 * @method Modnonsco   setDemijourneeId()  Sets the current record's "demijournee_id" value
 * @method Modnonsco   setClassespeId()    Sets the current record's "classespe_id" value
 * @method Modnonsco   setQuothorreff()    Sets the current record's "quothorreff" value
 * @method Modnonsco   setDatedebut()      Sets the current record's "datedebut" value
 * @method Modnonsco   setDatefin()        Sets the current record's "datefin" value
 * @method Modnonsco   setClassespe()      Sets the current record's "Classespe" value
 * @method Modnonsco   setDemijournee()    Sets the current record's "Demijournee" value
 * @method Modnonsco   setEtabnonsco()     Sets the current record's "Etabnonsco" value
 * @method Modnonsco   setEleve()          Sets the current record's "Eleve" value
 * 
 * @package    ash
 * @subpackage model
 * @author     regis Gravant
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseModnonsco extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('modnonsco');
        $this->hasColumn('eleve_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('etabnonsco_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
		$this->hasColumn('niveauscolairespe_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => false,
             ));
        $this->hasColumn('demijournee_id', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('classespe_id', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('quothorreff', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('datedebut', 'date', null, array(
             'type' => 'date',
             'notnull' => true,
             ));
        $this->hasColumn('datefin', 'date', null, array(
             'type' => 'date',
             ));

        $this->option('collate', 'utf8_unicode_ci');
        $this->option('charset', 'utf8');
        $this->option('type', 'InnoDB');
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Classespe', array(
             'local' => 'classespe_id',
             'foreign' => 'id'));

        $this->hasOne('Demijournee', array(
             'local' => 'demijournee_id',
             'foreign' => 'id'));

        $this->hasOne('Etabnonsco', array(
             'local' => 'etabnonsco_id',
             'foreign' => 'id'));
			 
		$this->hasOne('Niveauscolairespe', array(
             'local' => 'niveauscolairespe_id',
             'foreign' => 'id'));

        $this->hasOne('Eleve', array(
             'local' => 'eleve_id',
             'foreign' => 'id'));
    }
}