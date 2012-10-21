<?php

namespace Discussione\MessageBundle\Consumer;

use OldSound\RabbitMqBundle\RabbitMq\ConsumerInterface;
use PhpAmqpLib\Message\AMQPMessage;

class ProcessedConsumer implements ConsumerInterface
{
    /**
     * @param AMQPMessage $msg
     */
    public function execute(AMQPMessage $msg)
    {
        $message = base64_decode($msg->body);

        echo $message;

        return true;
    }
}