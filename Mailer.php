<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace AppBundle\Utils;

/**
 * Description of Mailer
 *
 * @author eugene
 */
class Mailer
{
    
    private $mailer;
    
    //returns true in case mail delivery was successful
    private $mailStatus;
    
    public function __construct(\Swift_Mailer $mailer)
    {
        $this->mailer = $mailer;
    }
    
    public function send($title, $from, $to, $body)
    {
        $mail = (new \Swift_Message($title))
                ->setFrom($from)
                ->setTo($to)
                ->setBody($body, 'text/html');
            /*
             * If you also want to include a plaintext version of the message
              ->addPart(
              $this->renderView(
              'Emails/registration.txt.twig',
              array('name' => $name)
              ),
              'text/plain'
              )
             */
              

            if ($this->mailer->send($mail)) {
                //add a success message
                $this->mailStatus = true;
            } else {
                //add a failure message
                $this->mailStatus = false;
            }
    }
    
    public function getMailStatus()
    {
        return $this->mailStatus;
    }


}
