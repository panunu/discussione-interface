<?php

namespace Discussione\FrameworkBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller as BaseController;
use Symfony\Component\Form\Form;

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
}