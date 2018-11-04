<?php

namespace App\ImageProcessing\Filters;

use Intervention\Image\Image;

/**
 * Crop image by fist found face
 */
class FilterFaceCrop extends FilterFaceAbstract
{
    public function apply(Image $image): void
    {
        if ($faces = $this->getFaces($image)) {

            $face = array_shift($faces);

            $image->crop($face['w'], $face['h'], $face['x'], $face['y']);

            $image->rectangle($face['x']-10, $face['y']-20, $face['x']+$face['w']+20, $face['y']+$face['h'], function($rect) {
                $rect->border(2, '#ff0000');
            });
        }
    }
}
