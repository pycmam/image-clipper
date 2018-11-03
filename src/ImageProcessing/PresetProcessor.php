<?php

namespace App\ImageProcessing;

use App\ImageProcessing\Contracts\FilterBuilderInterface;
use App\ImageProcessing\Contracts\ProcessorInterface;
use Intervention\Image\Image;

/**
 * Applies given filters to image
 */
class PresetProcessor implements ProcessorInterface
{
    private $builder;

    public function __construct(FilterBuilderInterface $builder)
    {
        $this->builder = $builder;
    }

    public function process(Image $image, array $filters): void
    {
        foreach ($filters as $params) {
            $name = strtolower($params['name']);

            $this->builder->build($name, $params)->apply($image);
        }
    }
}
