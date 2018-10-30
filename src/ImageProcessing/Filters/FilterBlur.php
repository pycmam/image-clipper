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

    public function apply(ImageInterface $image): ImageInterface
    {
        $image->effects()->blur($this->sigma);
    }

}