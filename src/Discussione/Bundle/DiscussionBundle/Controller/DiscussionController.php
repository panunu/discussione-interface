<?php

namespace Discussione\Bundle\DiscussionBundle\Controller;

use Discussione\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Discussione\Service\DocumentService;

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

        return $this->render('DiscussioneDiscussionBundle:Discussion:view.html.twig', [
            'discussion' => $discussion
        ]);
    }

    public function listAction()
    {
        return $this->render('DiscussioneDiscussionBundle:Discussion:list.html.twig', [
            'discussions' => $this->getDocumentService()->all()
        ]);
    }

    /**
     * @return DocumentService
     */
    private function getDocumentService()
    {
        return $this->get('discussione.service.document');
    }
}