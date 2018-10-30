<?php

namespace App\ImageProcessing\Contracts;

use Imagine\Image\ImageInterface;

/**
 * Filter interface
 */
interface FilterInterface
{
    public function apply(ImageInterface $image): void;
}
