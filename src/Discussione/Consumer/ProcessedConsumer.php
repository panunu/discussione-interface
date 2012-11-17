<?php

namespace Discussione\Consumer;

use OldSound\RabbitMqBundle\RabbitMq\ConsumerInterface;
use PhpAmqpLib\Message\AMQPMessage;
use Discussione\Service\DocumentService;

class ProcessedConsumer implements ConsumerInterface
{
    private $documentService;

    public function __construct(DocumentService $documentService)
    {
        $this->documentService = $documentService;
    }

    /**
     * @param AMQPMessage $msg
     */
    public function execute(AMQPMessage $msg)
    {
        return $this->documentService->insert(
            json_decode(base64_decode($msg->body), true)
        );
    }
}