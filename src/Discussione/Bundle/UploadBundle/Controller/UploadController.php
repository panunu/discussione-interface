<?php

namespace Discussione\Bundle\UploadBundle\Controller;

use Discussione\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Discussione\Model\Material;
use Discussione\Bundle\UploadBundle\Form\Type\MaterialType;
use Discussione\Service\MessageService;

class UploadController extends Controller
{
    public function uploadAction()
    {
        $form = $this->createForm(new MaterialType(), new Material());

        if ($this->validateForm($form)) {
            $file = $form->getData()->file;

            $this->getMessageService()->publish($file);

            unset($file);

            // TODO: Redirect.
            // TODO: Show a loader animation, and check for every 10 seconds if material has been processed.
        }

        return $this->render('DiscussioneUploadBundle:Upload:upload.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @return MessageService
     */
    private function getMessageService()
    {
        return $this->get('discussione.service.message');
    }
}