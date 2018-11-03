<?php

namespace App\ImageProcessing\Filters;

use Intervention\Image\Image;

/**
 * Performs a gamma correction operation
 */
class FilterGamma extends FilterAbstract
{
    private $correction;

    /**
     * FilterGamma constructor.
     *
     * @param float $correction Gamma compensation value.
     */
    public function __construct(float $correction)
    {
        $this->correction = $correction;
    }

    public function apply(Image $image): void
    {
        $image->gamma($this->correction);
    }
}
