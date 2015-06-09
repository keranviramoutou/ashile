<?php

/**
 * BaseOrientation
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $niveaudgesco_id
 * @property integer $niveauscolaire_id
 * @property integer $rased_id
 * @property integer $rased2_id
 * @property string $libelleclasse
 * @property integer $demijournee_id
 * @property integer $eleve_id
 * @property integer $classe_id
 * @property integer $inclusion_id
 * @property integer $enseignant_id
 * @property integer $etabsco_id
 * @property date $datedebut
 * @property date $datefin
 * @property clob $notes
 * @property Enseignant $Enseignant
 * @property NiveauDgesco $NiveauDgesco
 * @property Niveauscolaire $Niveauscolaire
 * @property Rased $Rased
 * @property Rased2 $Rased2
 * @property Demijournee $Demijournee
 * @property Classe $Classe
 * @property Inclusion $Inclusion
 * @property Eleve $Eleve
 * @property Etabsco $Etabsco
 * @property Doctrine_Collection $Orientations
 * 
 * @method integer             getNiveaudgescoId()    Returns the current record's "niveaudgesco_id" value
 * @method integer             getNiveauscolaireId()  Returns the current record's "niveauscolaire_id" value
 * @method integer             getRasedId()           Returns the current record's "rased_id" value
 * @method integer             getRased2Id()          Returns the current record's "rased2_id" value
 * @method string              getLibelleclasse()     Returns the current record's "libelleclasse" value
 * @method integer             getDemijourneeId()     Returns the current record's "demijournee_id" value
 * @method integer             getEleveId()           Returns the current record's "eleve_id" value
 * @method integer             getClasseId()          Returns the current record's "classe_id" value
 * @method integer             getInclusionId()       Returns the current record's "inclusion_id" value
 * @method integer             getEnseignantId()      Returns the current record's "enseignant_id" value
 * @method integer             getEtabscoId()         Returns the current record's "etabsco_id" value
 * @method date                getDatedebut()         Returns the current record's "datedebut" value
 * @method date                getDatefin()           Returns the current record's "datefin" value
 * @method clob                getNotes()             Returns the current record's "notes" value
 * @method Enseignant          getEnseignant()        Returns the current record's "Enseignant" value
 * @method NiveauDgesco        getNiveauDgesco()      Returns the current record's "NiveauDgesco" value
 * @method Niveauscolaire      getNiveauscolaire()    Returns the current record's "Niveauscolaire" value
 * @method Rased               getRased()             Returns the current record's "Rased" value
 * @method Rased2              getRased2()            Returns the current record's "Rased2" value
 * @method Demijournee         getDemijournee()       Returns the current record's "Demijournee" value
 * @method Classe              getClasse()            Returns the current record's "Classe" value
 * @method Inclusion           getInclusion()         Returns the current record's "Inclusion" value
 * @method Eleve               getEleve()             Returns the current record's "Eleve" value
 * @method Etabsco             getEtabsco()           Returns the current record's "Etabsco" value
 * @method Doctrine_Collection getOrientations()      Returns the current record's "Orientations" collection
 * @method Orientation         setNiveaudgescoId()    Sets the current record's "niveaudgesco_id" value
 * @method Orientation         setNiveauscolaireId()  Sets the current record's "niveauscolaire_id" value
 * @method Orientation         setRasedId()           Sets the current record's "rased_id" value
 * @method Orientation         setRased2Id()          Sets the current record's "rased2_id" value
 * @method Orientation         setLibelleclasse()     Sets the current record's "libelleclasse" value
 * @method Orientation         setDemijourneeId()     Sets the current record's "demijournee_id" value
 * @method Orientation         setEleveId()           Sets the current record's "eleve_id" value
 * @method Orientation         setClasseId()          Sets the current record's "classe_id" value
 * @method Orientation         setInclusionId()       Sets the current record's "inclusion_id" value
 * @method Orientation         setEnseignantId()      Sets the current record's "enseignant_id" value
 * @method Orientation         setEtabscoId()         Sets the current record's "etabsco_id" value
 * @method Orientation         setDatedebut()         Sets the current record's "datedebut" value
 * @method Orientation         setDatefin()           Sets the current record's "datefin" value
 * @method Orientation         setNotes()             Sets the current record's "notes" value
 * @method Orientation         setEnseignant()        Sets the current record's "Enseignant" value
 * @method Orientation         setNiveauDgesco()      Sets the current record's "NiveauDgesco" value
 * @method Orientation         setNiveauscolaire()    Sets the current record's "Niveauscolaire" value
 * @method Orientation         setRased()             Sets the current record's "Rased" value
 * @method Orientation         setRased2()            Sets the current record's "Rased2" value
 * @method Orientation         setDemijournee()       Sets the current record's "Demijournee" value
 * @method Orientation         setClasse()            Sets the current record's "Classe" value
 * @method Orientation         setInclusion()         Sets the current record's "Inclusion" value
 * @method Orientation         setEleve()             Sets the current record's "Eleve" value
 * @method Orientation         setEtabsco()           Sets the current record's "Etabsco" value
 * @method Orientation         setOrientations()      Sets the current record's "Orientations" collection
 * 
 * @package    ash
 * @subpackage model
 * @author     regis Gravant
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseOrientation extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('orientation');
        $this->hasColumn('niveaudgesco_id', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('niveauscolaire_id', 'integer', null, array(
             'type' => 'integer',
			 'notnull' => true,
             ));
		$this->hasColumn('rased_id', 'integer', null, array(
             'type' => 'integer',
             ));
		$this->hasColumn('rased2_id', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('libelleclasse', 'string', 100, array(
             'type' => 'string',
             'length' => 100,
             ));
        $this->hasColumn('demijournee_id', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('eleve_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('classe_id', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('inclusion_id', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('enseignant_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => false,
             ));
        $this->hasColumn('etabsco_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('datedebut', 'date', null, array(
             'type' => 'date',
             ));
        $this->hasColumn('datefin', 'date', null, array(
             'type' => 'date',
             ));
		$this->hasColumn('notes', 'clob', null, array(
             'type' => 'clob',
             ));

        $this->option('collate', 'utf8_unicode_ci');
        $this->option('charset', 'utf8');
        $this->option('type', 'InnoDB');
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Enseignant', array(
             'local' => 'enseignant_id',
             'foreign' => 'id'));

        $this->hasOne('NiveauDgesco', array(
             'local' => 'niveaudgesco_id',
             'foreign' => 'id'));

        $this->hasOne('Niveauscolaire', array(
             'local' => 'niveauscolaire_id',
             'foreign' => 'id'));
			 
			 
		$this->hasOne('Rased', array(
             'local' => 'rased_id',
             'foreign' => 'id'));
			 
		$this->hasOne('Rased', array(
             'local' => 'rased2_id',
             'foreign' => 'id'));

        $this->hasOne('Demijournee', array(
             'local' => 'demijournee_id',
             'foreign' => 'id'));

        $this->hasOne('Classe', array(
             'local' => 'classe_id',
             'foreign' => 'id'));

        $this->hasOne('Inclusion', array(
             'local' => 'inclusion_id',
             'foreign' => 'id'));

        $this->hasOne('Eleve', array(
             'local' => 'eleve_id',
             'foreign' => 'id'));

        $this->hasOne('Etabsco', array(
             'local' => 'etabsco_id',
             'foreign' => 'id'));

        $this->hasMany('EleveAvs as Orientations', array(
             'local' => 'eleve_id',
             'foreign' => 'eleve_id'));
    }
}