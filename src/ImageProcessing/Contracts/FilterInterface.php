<?php

namespace App\ImageProcessing\Contracts;

use Intervention\Image\Image;

/**
 * Filter interface
 */
interface FilterInterface
{
    public function apply(Image $image): void;
}
