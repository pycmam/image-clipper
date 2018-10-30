<?php

namespace App\ImageProcessing\Contracts;


use Imagine\Image\ImageInterface;

interface FilterInterface
{
    public function apply(ImageInterface $image): ImageInterface;
}