<?php

/**
 * BaseReunion
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $eleve_id
 * @property integer $typereunion_id
 * @property string $libellereunion
 * @property date $datereunion
 * @property clob $observation
 * @property Eleve $Eleve
 * @property TypeReunion $TypeReunion
 * 
 * @method integer     getEleveId()        Returns the current record's "eleve_id" value
 * @method integer     getTypereunionId()  Returns the current record's "typereunion_id" value
 * @method string      getLibellereunion() Returns the current record's "libellereunion" value
 * @method date        getDatereunion()    Returns the current record's "datereunion" value
 * @method clob        getObservation()    Returns the current record's "observation" value
 * @method Eleve       getEleve()          Returns the current record's "Eleve" value
 * @method TypeReunion getTypeReunion()    Returns the current record's "TypeReunion" value
 * @method Reunion     setEleveId()        Sets the current record's "eleve_id" value
 * @method Reunion     setTypereunionId()  Sets the current record's "typereunion_id" value
 * @method Reunion     setLibellereunion() Sets the current record's "libellereunion" value
 * @method Reunion     setDatereunion()    Sets the current record's "datereunion" value
 * @method Reunion     setObservation()    Sets the current record's "observation" value
 * @method Reunion     setEleve()          Sets the current record's "Eleve" value
 * @method Reunion     setTypeReunion()    Sets the current record's "TypeReunion" value
 * 
 * @package    ash
 * @subpackage model
 * @author     regis Gravant
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseReunion extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('reunion');
        $this->hasColumn('eleve_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('typereunion_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('libellereunion', 'string', 100, array(
             'type' => 'string',
             'length' => 100,
             ));
        $this->hasColumn('datereunion', 'date', null, array(
             'type' => 'date',
             ));
        $this->hasColumn('observation', 'clob', 65535, array(
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
        $this->hasOne('Eleve', array(
             'local' => 'eleve_id',
             'foreign' => 'id'));

        $this->hasOne('TypeReunion', array(
             'local' => 'typereunion_id',
             'foreign' => 'id'));
    }
}