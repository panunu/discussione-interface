<?php

namespace Discussione\UploadBundle\Controller;

use Discussione\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Discussione\UploadBundle\Model\Material;
use Discussione\UploadBundle\Form\Type\MaterialType;
use Discussione\MessageBundle\Service\MessageService;

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
        return $this->get('discussione_message.service.message');
    }
}