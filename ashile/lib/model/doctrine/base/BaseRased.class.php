<?php

/**
 * BaseRased
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $type_rased
 * @property Doctrine_Collection $Orientations
 * 
 * @method string              getTypeRased()      Returns the current record's "type_rased" value
 * @method Doctrine_Collection getOrientations()   Returns the current record's "Orientations" collection
 * @method Rased      setTypeRased()               Sets the current record's "type_rased" value
 * @method Rased      setOrientations()           Sets the current record's "Orientations" collection
 * 
 * @package    ash
 * @subpackage model
 * @author     regis Gravant
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseRased extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('rased');
        $this->hasColumn('type_rased', 'string', 50, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 50,
             ));

        $this->option('collate', 'utf8_unicode_ci');
        $this->option('charset', 'utf8');
        $this->option('type', 'InnoDB');
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('Orientation as Orientations', array(
             'local' => 'id',
             'foreign' => 'rased_id'));
    }
}