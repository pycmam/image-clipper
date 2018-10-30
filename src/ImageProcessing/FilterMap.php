<?php

namespace App\ImageProcessing;

use App\ImageProcessing\Filters\FilterBlur;
use App\ImageProcessing\Filters\FilterBrightness;
use App\ImageProcessing\Filters\FilterFit;
use App\ImageProcessing\Filters\FilterFixed;
use App\ImageProcessing\Filters\FilterFlip;
use App\ImageProcessing\Filters\FilterGamma;
use App\ImageProcessing\Filters\FilterGrayscale;
use App\ImageProcessing\Filters\FilterNegative;
use App\ImageProcessing\Filters\FilterOverlay;
use App\ImageProcessing\Filters\FilterRotate;
use App\ImageProcessing\Filters\FilterSharpen;

/**
 * Filters map by name
 */
class FilterMap
{
    public const MAP = [
        'blur' => FilterBlur::class,
        'brightness' => FilterBrightness::class,
        'fit' => FilterFit::class,
        'fixed' => FilterFixed::class,
        'gamma' => FilterGamma::class,
        'grayscale' => FilterGrayscale::class,
        'overlay' => FilterOverlay::class,
        'sharpen' => FilterSharpen::class,
        'negative' => FilterNegative::class,
        'flip' => FilterFlip::class,
        'rotate' => FilterRotate::class,
    ];
}
