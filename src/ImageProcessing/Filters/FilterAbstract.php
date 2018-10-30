<?php

namespace App\ImageProcessing\Filters;


use Imagine\Image\ImageInterface;

abstract class FilterAbstract
{
    abstract public function apply(ImageInterface $image): ImageInterface;
}