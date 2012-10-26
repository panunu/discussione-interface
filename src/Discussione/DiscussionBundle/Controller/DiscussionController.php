<?php

namespace Discussione\DiscussionBundle\Controller;

use Discussione\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Discussione\DocumentBundle\Service\DocumentService;

class DiscussionController extends Controller
{
    /**
     * @param int $id
     */
    public function viewAction($id)
    {
        $discussion = $this->getDocumentService()->getById($id);

        if (!$discussion) {
            throw $this->createNotFoundException('Discussion not found');
        }

        return $this->render('DiscussioneDiscussionBundle:Discussion:view.html.twig', array(
            'discussion' => $this->getDocumentService()->getById($id),
        ));
    }

    /**
     * @return DocumentService
     */
    private function getDocumentService()
    {
        return $this->get('discussione_document.service.document');
    }
}