<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace AppBundle\Utils;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedException;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\ConflictHttpException;
use Symfony\Component\Translation\TranslatorInterface;
use Symfony\Component\Translation\Loader\ArrayLoader;

/**
 * Description of ApiError
 *
 * @author eugene
 */
class ApiError
{
    
    private $translator;
    
    private $statusCodes = array(
        400 => "api.request.bad_request",
        403 => "api.request.access_denied",
        404 => "api.request.not_found",
        405 => "api.request.not_allowed",
        409 => "api.request.conflict",
    );

    public function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }
    
    public function statusCode($code)
    {
        switch ($code) {
            case 400:
                throw new BadRequestHttpException($this->translator
                    ->trans($this->statusCodes[$code], array(), 'validators'));
                break;
            case 403:
                throw new AccessDeniedException($this->translator
                    ->trans($this->statusCodes[$code], array(), 'validators'));
                break;
            case 404:
                throw new NotFoundHttpException($this->translator
                    ->trans($this->statusCodes[$code], array(), 'validators'));
                break;
            case 405:
                throw new MethodNotAllowedHttpException(array(), $this->translator
                    ->trans($this->statusCodes[$code], array(), 'validators'));
                break;
            case 409:
                throw new ConflictHttpException($this->translator
                    ->trans($this->statusCodes[$code], array(), 'validators'));
                break;
        }
    }
}
