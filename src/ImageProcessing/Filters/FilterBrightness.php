<?php

namespace App\ImageProcessing\Filters;

use Intervention\Image\Image;

/**
 * Changes the brightness of the current image by the given level.
 */
class FilterBrightness extends FilterAbstract
{
    private $level;

    /**
     * FilterBrightness constructor.
     *
     * @param int $level from -100 to 100, 0 - no change
     */
    public function __construct(int $level)
    {
        $this->level = $level;
    }

    public function apply(Image $image): void
    {
        $image->brightness($this->level);
    }
}
