<?php

namespace App\ImageProcessing\Filters;


use Imagine\Image\ImageInterface;

class FilterBrightness extends FilterAbstract
{
    private $brightness;

    public function __construct(int $brightness)
    {
        $this->brightness = $brightness;
    }

    public function apply(ImageInterface $image): ImageInterface
    {
        $image->effects()->grightness($this->brightness);
    }

}