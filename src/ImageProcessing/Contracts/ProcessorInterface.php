<?php

namespace App\ImageProcessing\Contracts;

use Intervention\Image\Image;

/**
 * Preset processor interface
 */
interface ProcessorInterface
{
    public function process(Image $image, array $config): void;
}
