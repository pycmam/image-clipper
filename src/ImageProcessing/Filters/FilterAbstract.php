<?php

namespace App\ImageProcessing\Filters;

use App\ImageProcessing\Contracts\FilterInterface;
use Imagine\Image\ImageInterface;

abstract class FilterAbstract implements FilterInterface
{
    abstract public function apply(ImageInterface $image): void;
}
