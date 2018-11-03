<?php

namespace App\ImageProcessing\Filters;

use Intervention\Image\Image;

/**
 * Applies a pixelation effect to the current image with a given size of pixels.
 */
class FilterPixelate extends FilterAbstract
{
    private $size;

    /**
     * FilterPixelate constructor.
     *
     * @param int $size Size of the pixels.
     */
    public function __construct(int $size)
    {
        $this->size = $size;
    }

    public function apply(Image $image): void
    {
        $image->pixelate($this->size);
    }
}
