<?php

namespace Discussione\UploadBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use OldSound\RabbitMqBundle\RabbitMq\Producer;
use Symfony\Component\HttpFoundation\Response;
use Discussione\UploadBundle\Model\Material;
use Discussione\UploadBundle\Form\Type\MaterialType;
use Discussione\UploadBundle\Service\MessageService;

class UploadController extends Controller
{
    public function uploadAction()
    {
        $form = $this->createForm(new MaterialType(), new Material());

        // TODO: Abstractify Form processing.
        if ($this->getRequest()->getMethod() === 'POST') {
            $form->bind($this->getRequest());
            if ($form->isValid()) {
                $file = $form->getData()->file;

                $this->getUploadMaterialProducer()->publish(
                    $this->getMessageService()->encode($file)
                );

                unset($file);
            }
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
        return $this->get('discussione_upload.service.message');
    }

    /**
     * @return Producer
     */
    private function getUploadMaterialProducer()
    {
        return $this->get('old_sound_rabbit_mq.upload_material_producer');
    }
}