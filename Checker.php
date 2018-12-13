<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace AppBundle\Utils;

/**
 * Description of Checker
 *
 * @author eugene
 */
class Checker
{    
    private $acceptableEntities = array(
        'Post',
        'Comment',
        'User'
    );

    /**
     * If string is not entity, it returns false
     * Otherwise, it returns properly formatted entity name
     * @param string $string
     * @return bool|string
     */
    public function isEntity(string $string, bool $plural = false)
    {
        //if the class name is plural, remove 's'
        if ($plural) {
            if (substr($string, -3) == 'ies') {
                $singularString = substr_replace($string, "y", -3);
            } else {
                $singularString = substr_replace($string, "", -1);
            }
        } else {
            $singularString = $string;
        }
        
        $entityName = ucfirst(strtolower($singularString));
        
        if (in_array($entityName, $this->acceptableEntities)) {            
            return $entityName;
        } else {
            return false;
        }
    }
    
    public function isPositiveInt($string)
    {
        return is_numeric($string) && $string > 0;
        
    }
    
    public function isMoreThan(string $string, int $len = 1)
    {
        return strlen($string) > $len ? true : false;
    }
}
