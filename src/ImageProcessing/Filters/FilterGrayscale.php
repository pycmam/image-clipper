<?php

namespace App\ImageProcessing\Filters;


use Imagine\Image\ImageInterface;

class FilterGrayscale extends FilterAbstract
{
    public function apply(ImageInterface $image): ImageInterface
    {
        return $image->effects()->grayscale();
    }
}