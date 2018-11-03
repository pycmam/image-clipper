<?php

namespace App\ImageProcessing\Filters;

use Intervention\Image\Image;

/**
 * Changes the contrast of the current image by the given level.
 */
class FilterContrast extends FilterAbstract
{
    private $level;

    /**
     * FilterContrast constructor.
     *
     * @param int $level from -100 to 100, 0 - no changes
     */
    public function __construct(int $level)
    {
        $this->level = $level;
    }

    public function apply(Image $image): void
    {
        $image->contrast($this->level);
    }
}
