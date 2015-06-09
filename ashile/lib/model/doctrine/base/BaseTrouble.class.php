<?php

/**
 * BaseTrouble
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $trouble
 * 
 * @method string  getTrouble() Returns the current record's "trouble" value
 * @method Trouble setTrouble() Sets the current record's "trouble" value
 * 
 * @package    ash
 * @subpackage model
 * @author     regis Gravant
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseTrouble extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('trouble');
        $this->hasColumn('trouble', 'string', 100, array(
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
        
    }
}