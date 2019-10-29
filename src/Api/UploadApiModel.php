<?php
namespace App\Api;

use Symfony\Component\Validator\Constraints as Assert;

class UploadApiModel
{
    /**
     * @Assert\NotBlank()
     */
    public $filename;

    /**
     * @Assert\NotBlank()
     */
    public $data;
}
