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

    public function apply(ImageInterface $image): ImageInterface
    {
        return $image->thumbnail(new Box($this->width, $this->height),
            ImageInterface::THUMBNAIL_INSET,
            static::RESIZE_FILTER
        );
    }
}