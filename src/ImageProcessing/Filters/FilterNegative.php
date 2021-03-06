<?php

namespace App\ImageProcessing\Filters;

use Intervention\Image\Image;

/**
 * Reverses all colors
 */
class FilterNegative extends FilterAbstract
{
    public function apply(Image $image): void
    {
        $image->invert();
    }
}
