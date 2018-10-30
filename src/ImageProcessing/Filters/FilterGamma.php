<?php

namespace App\ImageProcessing\Filters;

use Imagine\Image\ImageInterface;

class FilterGamma extends FilterAbstract
{
    private $correction;

    public function __construct(float $correction)
    {
        $this->correction = $correction;
    }

    public function apply(ImageInterface $image): void
    {
        $image->effects()->gamma($this->correction);
    }
}
