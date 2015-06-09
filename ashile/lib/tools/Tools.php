<?php

/**
 * Regroupe toutes les fonctions necesaires au projet ashile
 *
 * @author Adm
 */
class Tools
{

    /**
     * Conversion, pour affichage de Ex: 1900-01-01 en 01/01/1900 pour le projet ashile.
     * Affichage des edit des date en champs de saisie, show, index
     * @param type $date 
     */
    public static function convertYmdTodmY($date)
    {
        return substr($date, 5, 2) .'&#47;'. substr($date, 8, 2) .'&#47;'. substr($date, 0, 4) . ' ';
    }

}

?>
