<?php

namespace Discussione\UploadBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use OldSound\RabbitMqBundle\RabbitMq\Producer;
use Symfony\Component\HttpFoundation\Response;
use Discussione\UploadBundle\Model\Material;
use Discussione\UploadBundle\Form\Type\MaterialType;

class UploadController extends Controller
{
    public function uploadAction()
    {
        $form = $this->createForm(new MaterialType(), new Material());

        // TODO: Abstractify.
        if ($this->getRequest()->getMethod() === 'POST') {
            $form->bind($this->getRequest());
            if ($form->isValid()) {
                // TODO: Move to Service.
                $file = $form->getData()->file;
                $this->getUploadMaterialProducer()->publish($file);
            }
        }

        return $this->render('DiscussioneUploadBundle:Upload:upload.html.twig', array(
            'form' => $form
        ));
    }

    /**
     * @return Producer
     */
    private function getUploadMaterialProducer()
    {
        return $this->get('old_sound_rabbit_mq.upload_material_producer');
    }
}