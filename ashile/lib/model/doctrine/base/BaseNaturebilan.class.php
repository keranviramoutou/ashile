<?php

/**
 * BaseNaturebilan
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $libellenaturebilan
 * @property Doctrine_Collection $Bilans
 * 
 * @method string              getLibellenaturebilan() Returns the current record's "libellenaturebilan" value
 * @method Doctrine_Collection getBilans()             Returns the current record's "Bilans" collection
 * @method Naturebilan         setLibellenaturebilan() Sets the current record's "libellenaturebilan" value
 * @method Naturebilan         setBilans()             Sets the current record's "Bilans" collection
 * 
 * @package    ash
 * @subpackage model
 * @author     regis Gravant
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseNaturebilan extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('naturebilan');
        $this->hasColumn('libellenaturebilan', 'string', 70, array(
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
        $this->hasMany('Bilan as Bilans', array(
             'local' => 'id',
             'foreign' => 'naturebilan_id'));
    }
}