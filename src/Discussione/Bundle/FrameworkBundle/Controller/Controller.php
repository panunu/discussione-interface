<?php

namespace Discussione\Bundle\FrameworkBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller as BaseController;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Response;

class Controller extends BaseController
{
    /**
     * Binds and validates a Form.
     *
     * @param Form $form
     * @return bool
     */
    public function validateForm(Form $form)
    {
        if ($this->getRequest()->getMethod() === 'POST') {
            return $form->bind($this->getRequest())->isValid();
        }

        return false;
    }

    /**
     * @return bool
     */
    public function isJsonRequest()
    {
        return $this->getRequest()->getRequestFormat() == 'json';
    }

    /**
     * @param array $json
     * @return Response
     */
    public function createJsonResponse(array $json)
    {
        $response = new Response(json_encode($json));
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
}