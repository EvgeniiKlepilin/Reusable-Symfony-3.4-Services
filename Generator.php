<?php
namespace AppBundle\Service;

class Generator
{
    const ALPHA_NUM = 0;
    const ALPHABETIC = 1;
    const NUMERIC = 2;
    
    public static function randomString($length, $type = self::ALPHA_NUM) {
        switch($type) {
            case self::ALPHA_NUM:
                $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                break;
            case self::ALPHABETIC:
                $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                break;
            case self::NUMERIC:
                $characters = '0123456789';
                break;
        }
        
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
