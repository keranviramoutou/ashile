<?php

/**
 * BaseSituation
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $situation
 * 
 * @method string    getSituation() Returns the current record's "situation" value
 * @method Situation setSituation() Sets the current record's "situation" value
 * 
 * @package    ash
 * @subpackage model
 * @author     regis Gravant
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseSituation extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('situation');
        $this->hasColumn('situation', 'string', 10, array(
             'type' => 'string',
             'length' => 10,
             ));

        $this->option('charset', 'utf8');
    }

    public function setUp()
    {
        parent::setUp();
        
    }
}