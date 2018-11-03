<?php

namespace App\ImageProcessing\Filters;

use Intervention\Image\Image;

/**
 * Sharpen current image with an optional amount.
 */
class FilterSharpen extends FilterAbstract
{
    private $amount;

    /**
     * FilterSharpen constructor.
     *
     * @param int $amount The amount of the sharpening strength from 0 to 100
     */
    public function __construct(int $amount = 10)
    {
        $this->amount = $amount;
    }

    public function apply(Image $image): void
    {
        $image->sharpen($this->amount);
    }
}
