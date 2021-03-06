<?php

/**
 * BaseTypeClasse
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $nomtypeclasse
 * @property string $nomLongTypeClasse
 * @property integer $ordre
 * @property Doctrine_Collection $Classes
 * 
 * @method string              getNomtypeclasse()     Returns the current record's "nomtypeclasse" value
 * @method string              getNomLongTypeClasse() Returns the current record's "nomLongTypeClasse" value
 * @method integer             getOrdre()             Returns the current record's "ordre" value
 * @method Doctrine_Collection getClasses()           Returns the current record's "Classes" collection
 * @method TypeClasse          setNomtypeclasse()     Sets the current record's "nomtypeclasse" value
 * @method TypeClasse          setNomLongTypeClasse() Sets the current record's "nomLongTypeClasse" value
 * @method TypeClasse          setOrdre()             Sets the current record's "ordre" value
 * @method TypeClasse          setClasses()           Sets the current record's "Classes" collection
 * 
 * @package    ash
 * @subpackage model
 * @author     regis Gravant
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseTypeClasse extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('type_classe');
        $this->hasColumn('nomtypeclasse', 'string', 50, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 50,
             ));
        $this->hasColumn('nomLongTypeClasse', 'string', 100, array(
             'type' => 'string',
             'length' => 100,
             ));
        $this->hasColumn('ordre', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));

        $this->option('collate', 'utf8_unicode_ci');
        $this->option('charset', 'utf8');
        $this->option('type', 'InnoDB');
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('Classe as Classes', array(
             'local' => 'id',
             'foreign' => 'typeclasse_id'));
    }
}