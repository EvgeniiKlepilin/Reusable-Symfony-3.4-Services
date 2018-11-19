<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace AppBundle\Utils;

use Vich\UploaderBundle\Templating\Helper\UploaderHelper;
/**
 * Description of FileUrler
 *
 * @author eugene
 */
class FileUrler
{
    private $helper;
    
    public function __construct(UploaderHelper $helper)
    {
        $this->helper = $helper;
    }

        public function fileToURL(object &$entity, $fileType = 'image')
    {
        //all entities have same fields and same methods relating to images
        //change just filename to full relative url for client side
        $setter_name = 'set' . ucfirst($fileType);
        if(method_exists($entity, $setter_name)) {
            $entity->setImage($this->helper->asset($entity, $fileType . 'File'));
        } else {
            throw new InvalidArgumentException('Given Entity doesn\'t have \"' 
                . $setter_name . '\" method!');
        }     
    }
}
