<?php

/**
 * BaseEtabscoInclusion
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $typeinclusion
 * @property Doctrine_Collection $Etabscos
 * 
 * @method string              getTypeinclusion() Returns the current record's "typeinclusion" value
 * @method Doctrine_Collection getEtabscos()      Returns the current record's "Etabscos" collection
 * @method EtabscoInclusion    setTypeinclusion() Sets the current record's "typeinclusion" value
 * @method EtabscoInclusion    setEtabscos()      Sets the current record's "Etabscos" collection
 * 
 * @package    ash
 * @subpackage model
 * @author     regis Gravant
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseEtabscoInclusion extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('etabsco_inclusion');
        $this->hasColumn('typeinclusion', 'string', 20, array(
             'type' => 'string',
             'length' => 20,
             ));

        $this->option('collate', 'utf8_unicode_ci');
        $this->option('charset', 'utf8');
        $this->option('type', 'InnoDB');
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('Etabsco as Etabscos', array(
             'local' => 'id',
             'foreign' => 'inclusionetab_id'));
    }
}