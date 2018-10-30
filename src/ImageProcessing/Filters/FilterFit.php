<?php

namespace App\ImageProcessing\Filters;

use Imagine\Image\Box;
use Imagine\Image\ImageInterface;

class FilterFit extends FilterAbstract
{
    protected $width;
    protected $height;
    protected $filter;

    protected const RESIZE_FILTER = ImageInterface::FILTER_LANCZOS;

    public function __construct(int $width, int $height)
    {
        $this->width = $width;
        $this->height = $height;
    }

    public function apply(ImageInterface $image): void
    {
        $image->thumbnail(
            new Box($this->width, $this->height),
            ImageInterface::THUMBNAIL_INSET | ImageInterface::THUMBNAIL_FLAG_NOCLONE,
            static::RESIZE_FILTER
        );
    }
}
