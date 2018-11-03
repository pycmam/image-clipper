<?php

namespace App\ImageProcessing\Filters;

use Intervention\Image\Image;

/**
 * Apply a gaussian blur filter with a optional amount
 */
class FilterBlur extends FilterAbstract
{
    private $amount;

    /**
     * FilterBlur constructor.
     *
     * @param int $amount from 0 to 100
     */
    public function __construct(int $amount = 1)
    {
        $this->amount = $amount;
    }

    public function apply(Image $image): void
    {
        $image->blur($this->amount);
    }
}
