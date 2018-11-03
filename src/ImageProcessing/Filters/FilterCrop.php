<?php

namespace App\ImageProcessing\Filters;

use Intervention\Image\Image;

class FilterCrop extends FilterAbstract
{
    private $width;
    private $height;
    private $x;
    private $y;

    /**
     * FilterCrop constructor.
     *
     * @param int $width Width of the rectangular cutout.
     * @param int $height Height of the rectangular cutout.
     * @param int|null $x X-Coordinate of the top-left corner if the rectangular cutout.
     *                    By default the rectangular part will be centered on the current image.
     * @param int|null $y Y-Coordinate of the top-left corner if the rectangular cutout.
     *                    By default the rectangular part will be centered on the current image.
     */
    public function __construct(int $width, int $height, int $x = null, int $y = null)
    {
        $this->width = $width;
        $this->height = $height;
        $this->x = $x;
        $this->y = $y;
    }

    public function apply(Image $image): void
    {
        $image->crop($this->width, $this->height, $this->x, $this->y);
    }
}
