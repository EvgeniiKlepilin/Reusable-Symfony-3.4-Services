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
    public function isPositiveInt($string)
    {
        return is_numeric($string) && $string > 0;
        
    }
    
    public function isMoreThan(string $string, int $len = 1)
    {
        return strlen($string) > $len ? true : false;
    }
}
