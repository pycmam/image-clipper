<?php

namespace App\ImageProcessing\Filters;

use Intervention\Image\Image;

/**
 * Mirror the current image horizontally or vertically by specifying the mode
 */
class FilterFlip extends FilterAbstract
{
    private $axis;

    /**
     * FilterFlip constructor.
     *
     * @param string $axis Specify the mode the image will be flipped.
     *                     You can set h for horizontal (default) or v for vertical flip.
     */
    public function __construct(string $axis)
    {
        $this->axis = strtolower($axis);
    }

    public function apply(Image $image): void
    {
        $image->flip($this->axis);
    }
}
