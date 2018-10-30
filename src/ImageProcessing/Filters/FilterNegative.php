<?php

namespace App\ImageProcessing\Filters;

use Imagine\Image\ImageInterface;

class FilterNegative extends FilterAbstract
{
    public function apply(ImageInterface $image): void
    {
        $image->effects()->negative();
    }
}
