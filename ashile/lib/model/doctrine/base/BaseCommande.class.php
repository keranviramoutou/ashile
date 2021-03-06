<?php

/**
 * BaseCommande
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $fournisseur_id
 * @property date $date_commande
 * @property Fournisseur $fournisseur
 * @property Fournisseur $Fournisseur
 * @property Doctrine_Collection $DetailCommande
 * 
 * @method integer             getFournisseurId()  Returns the current record's "fournisseur_id" value
 * @method date                getDateCommande()   Returns the current record's "date_commande" value
 * @method Fournisseur         getFournisseur()    Returns the current record's "fournisseur" value
 * @method Fournisseur         getFournisseur()    Returns the current record's "Fournisseur" value
 * @method Doctrine_Collection getDetailCommande() Returns the current record's "DetailCommande" collection
 * @method Commande            setFournisseurId()  Sets the current record's "fournisseur_id" value
 * @method Commande            setDateCommande()   Sets the current record's "date_commande" value
 * @method Commande            setFournisseur()    Sets the current record's "fournisseur" value
 * @method Commande            setFournisseur()    Sets the current record's "Fournisseur" value
 * @method Commande            setDetailCommande() Sets the current record's "DetailCommande" collection
 * 
 * @package    ash
 * @subpackage model
 * @author     regis Gravant
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseCommande extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('commande');
        $this->hasColumn('fournisseur_id', 'integer', 8, array(
             'type' => 'integer',
             'notnull' => true,
             'length' => 8,
             ));
        $this->hasColumn('date_commande', 'date', null, array(
             'type' => 'date',
             'notnull' => true,
             ));

        $this->option('collate', 'utf8_unicode_ci');
        $this->option('charset', 'utf8');
        $this->option('type', 'InnoDB');
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Fournisseur as fournisseur', array(
             'local' => 'fournisseur_id',
             'foreign' => 'id'));

        $this->hasOne('Fournisseur', array(
             'local' => 'fournisseur_id',
             'foreign' => 'id'));

        $this->hasMany('DetailCommande', array(
             'local' => 'id',
             'foreign' => 'commande_id'));
    }
}