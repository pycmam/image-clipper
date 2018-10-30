<?php

namespace App\ImageProcessing\Filters;


use Imagine\Image\ImageInterface;

class FilterSharpen extends FilterAbstract
{
    public function apply(ImageInterface $image): ImageInterface
    {
        return $image->effects()->sharpen();
    }
}