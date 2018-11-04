<?php

namespace App\ImageProcessing;

use App\ImageProcessing\Filters\FilterBlur;
use App\ImageProcessing\Filters\FilterBrightness;
use App\ImageProcessing\Filters\FilterContrast;
use App\ImageProcessing\Filters\FilterCrop;
use App\ImageProcessing\Filters\FilterFaceCrop;
use App\ImageProcessing\Filters\FilterFaceRect;
use App\ImageProcessing\Filters\FilterFit;
use App\ImageProcessing\Filters\FilterFixed;
use App\ImageProcessing\Filters\FilterFlip;
use App\ImageProcessing\Filters\FilterGamma;
use App\ImageProcessing\Filters\FilterGreyscale;
use App\ImageProcessing\Filters\FilterNegative;
use App\ImageProcessing\Filters\FilterOpacity;
use App\ImageProcessing\Filters\FilterOverlay;
use App\ImageProcessing\Filters\FilterPixelate;
use App\ImageProcessing\Filters\FilterRotate;
use App\ImageProcessing\Filters\FilterSharpen;
use App\ImageProcessing\Filters\FilterText;

/**
 * Filters map by name
 */
class FilterMap
{
    public const MAP = [
        'blur' => FilterBlur::class,
        'brightness' => FilterBrightness::class,
        'contrast' => FilterContrast::class,
        'crop' => FilterCrop::class,
        'face_crop' => FilterFaceCrop::class,
        'face_rect' => FilterFaceRect::class,
        'fit' => FilterFit::class,
        'fixed' => FilterFixed::class,
        'flip' => FilterFlip::class,
        'gamma' => FilterGamma::class,
        'greyscale' => FilterGreyscale::class,
        'negative' => FilterNegative::class,
        'opacity' => FilterOpacity::class,
        'overlay' => FilterOverlay::class,
        'pixelate' => FilterPixelate::class,
        'rotate' => FilterRotate::class,
        'sharpen' => FilterSharpen::class,
        'text' => FilterText::class,
    ];
}
