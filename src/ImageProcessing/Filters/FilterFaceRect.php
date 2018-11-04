<?php

namespace App\ImageProcessing\Filters;

use Intervention\Image\Image;

/**
 * Draw rectangles on faces
 */
class FilterFaceRect extends FilterFaceAbstract
{
    private $size;
    private $color;

    public function __construct(string $cascade, $size = 1, $color = '#ff0000')
    {
        parent::__construct($cascade);

        $this->size = $size;
        $this->color = $color;
    }

    public function apply(Image $image, int $size = 1, $color = '#ff0000'): void
    {
        if ($faces = $this->getFaces($image)) {
            foreach ($faces as $face) {
                $image->rectangle($face['x'], $face['y'], $face['x'] + $face['w'], $face['y'] + $face['h'], function($rect) {
                    $rect->border($this->size, $this->color);
                });
            }
        }
    }
}
