<?php

/**
 * BaseTypeResponsableEleve
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $denomination
 * @property Doctrine_Collection $Tuteur
 * 
 * @method string               getDenomination() Returns the current record's "denomination" value
 * @method Doctrine_Collection  getTuteur()       Returns the current record's "Tuteur" collection
 * @method TypeResponsableEleve setDenomination() Sets the current record's "denomination" value
 * @method TypeResponsableEleve setTuteur()       Sets the current record's "Tuteur" collection
 * 
 * @package    ash
 * @subpackage model
 * @author     regis Gravant
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseTypeResponsableEleve extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('type_responsable_eleve');
        $this->hasColumn('denomination', 'string', 100, array(
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
        $this->hasMany('Tuteur', array(
             'local' => 'id',
             'foreign' => 'typeresponsableeleve_id'));
    }
}