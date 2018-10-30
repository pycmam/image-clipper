<?php

namespace App\ImageProcessing\Filters;

use Imagine\Image\ImageInterface;

class FilterBlur extends FilterAbstract
{
    private $sigma;

    public function __construct(float $sigma)
    {
        $this->sigma = $sigma;
    }

    public function apply(ImageInterface $image): void
    {
        $image->effects()->blur($this->sigma);
    }
}
