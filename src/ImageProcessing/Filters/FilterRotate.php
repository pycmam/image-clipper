<?php

namespace App\ImageProcessing\Filters;

use Imagine\Image\ImageInterface;
use Imagine\Image\Palette\RGB;

class FilterRotate extends FilterAbstract
{
    protected const DEFAULT_BACKGROUND = '#ffffff';
    protected const DEFAULT_ALFA = 100;

    private $angle;
    private $background;
    private $alfa;

    public function __construct(
        int $angle,
        string $background = self::DEFAULT_BACKGROUND,
        int $alfa = self::DEFAULT_ALFA
    ) {
        $this->angle = $angle;
        $this->background = $background;
        $this->alfa = $alfa;
    }

    public function apply(ImageInterface $image): void
    {
        $image->rotate($this->angle, (new RGB())->color($this->background, $this->alfa));
    }
}
