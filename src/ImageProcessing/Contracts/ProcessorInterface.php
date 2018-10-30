<?php

namespace App\ImageProcessing\Contracts;

use Imagine\Image\ImageInterface;

/**
 * Preset processor interface
 */
interface ProcessorInterface
{
    public function process(ImageInterface $image, array $config): void;
}
