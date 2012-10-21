<?php

namespace Discussione\MessageBundle\Service;

use OldSound\RabbitMqBundle\RabbitMq\Producer;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class MessageService
{
    private $producer;

    /**
     * @param Producer $producer
     */
    public function __construct(Producer $producer)
    {
        $this->producer = $producer;
    }

    /**
     * @param UploadedFile $file
     */
    public function publish(UploadedFile $file)
    {
        $this->producer->publish(
            $this->encode($file)
        );
    }

    /**
     * @param UploadedFile $file
     * @return string
     */
    private function encode(UploadedFile $file)
    {
        return base64_encode(
            file_get_contents($file)
        );
    }

    /**
     * @param string $message
     * @return string
     */
    private function decode($message) {
        return base64_decode($message);
    }
}