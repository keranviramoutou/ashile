<?php

/**
 * DirecteurEtabTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class DirecteurEtabTable extends PersonneTable
{
    /**
     * Returns an instance of this class.
     *
     * @return object DirecteurEtabTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('DirecteurEtab');
    }
}