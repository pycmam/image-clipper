<?php

namespace App\ImageProcessing\Filters;

use Intervention\Image\Image;

/**
 * Turns image into a greyscale version.
 */
class FilterGreyscale extends FilterAbstract
{
    public function apply(Image $image): void
    {
        $image->greyscale();
    }
}
