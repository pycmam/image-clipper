<?php

namespace App\ImageProcessing\Filters;

use Imagine\Image\ImageInterface;

class FilterFlip extends FilterAbstract
{
    private $axis;

    private const AXIS_V = 'v';
    private const AXIS_H = 'h';

    public function __construct(string $axis)
    {
        $this->axis = strtolower($axis);
    }

    public function apply(ImageInterface $image): void
    {
        if (self::AXIS_H === $this->axis) {
            $image->flipHorizontally();
        } else {
            if (self::AXIS_V === $this->axis) {
                $image->flipVertically();
            } else {
                throw new \InvalidArgumentException(sprintf('Invalid flip axis: %s', $this->axis));
            }
        }
    }
}
