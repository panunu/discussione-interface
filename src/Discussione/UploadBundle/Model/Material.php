<?php

namespace Discussione\UploadBundle\Model;

use Symfony\Component\Validator\Constraints as Assert;

class Material
{
    /**
     * @Assert\File(mimeTypes = { "text/csv", "text/plain" })
     * @Assert\NotBlank()
     */
    public $file;
}
