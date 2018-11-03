<?php

namespace App\ImageProcessing\Filters;

use App\ImageProcessing\Contracts\FilterInterface;
use Intervention\Image\Image;;

abstract class FilterAbstract implements FilterInterface
{
    abstract public function apply(Image $image): void;
}
