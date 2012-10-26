<?php

namespace Discussione\DiscussionBundle\Controller;

use Discussione\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Discussione\DocumentBundle\Service\DocumentService;

class DiscussionController extends Controller
{
    public function viewAction($id)
    {
        $discussion = $this->getDocumentService()->getById($id);

        if (!$discussion) {
            throw $this->createNotFoundException('Discussion not found');
        }

        if ($this->isJsonRequest()) {
            return $this->createJsonResponse($discussion);
        }

        return $this->render('DiscussioneDiscussionBundle:Discussion:view.html.twig', array(
            'discussion' => $discussion
        ));
    }

    public function listAction()
    {
        return $this->render('DiscussioneDiscussionBundle:Discussion:list.html.twig', array(
            'discussions' => $this->getDocumentService()->all()
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