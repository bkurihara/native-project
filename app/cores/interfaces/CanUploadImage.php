<?php

namespace App\cores\interfaces;

interface CanUploadImage
{
    public function uploadImageAndGetPath($image);
}