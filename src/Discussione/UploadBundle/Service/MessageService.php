<?php

namespace Discussione\UploadBundle\Service;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class MessageService
{
    /**
     * @param UploadedFile $file
     * @return string
     */
    public function encode(UploadedFile $file)
    {
        return base64_encode(
            file_get_contents($file)
        );
    }

    /**
     * @param string $message
     * @return string
     */
    public function decode($message) {
        return base64_decode($message);
    }
}