<?php

/**
 * BaseNaturesuiviext
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $libellenaturesuiviext
 * @property Doctrine_Collection $SuivitExternes
 * 
 * @method string              getLibellenaturesuiviext() Returns the current record's "libellenaturesuiviext" value
 * @method Doctrine_Collection getSuivitExternes()        Returns the current record's "SuivitExternes" collection
 * @method Naturesuiviext      setLibellenaturesuiviext() Sets the current record's "libellenaturesuiviext" value
 * @method Naturesuiviext      setSuivitExternes()        Sets the current record's "SuivitExternes" collection
 * 
 * @package    ash
 * @subpackage model
 * @author     regis Gravant
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseNaturesuiviext extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('naturesuiviext');
        $this->hasColumn('libellenaturesuiviext', 'string', 70, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 70,
             ));

        $this->option('collate', 'utf8_unicode_ci');
        $this->option('charset', 'utf8');
        $this->option('type', 'InnoDB');
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('SuivitExterne as SuivitExternes', array(
             'local' => 'id',
             'foreign' => 'naturesuiviext_id'));
    }
}