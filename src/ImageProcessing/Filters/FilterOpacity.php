<?php

namespace App\ImageProcessing\Filters;

use Intervention\Image\Image;

/**
 * Set the opacity in percent of the current image ranging from 100% for opaque and 0% for full transparency.
 */
class FilterOpacity extends FilterAbstract
{
    private $transparency;

    /**
     * FilterOpacity constructor.
     *
     * @param int $transparency The new percent of transparency
     */
    public function __construct(int $transparency)
    {
        $this->transparency = $transparency;
    }

    public function apply(Image $image): void
    {
        $image->opacity($this->transparency);
    }
}
