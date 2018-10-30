<?php

namespace App\ImageProcessing\Filters;

use Imagine\Image\Box;
use Imagine\Image\ImageInterface;
use Imagine\Image\Palette\RGB;
use Imagine\Image\Point;
use Imagine\Imagick\Imagine;

class FilterFixed extends FilterFit
{
    protected const DEFAULT_BACKGROUND = '#ffffff';
    protected const DEFAULT_ALFA = 100;

    private $background;
    private $alfa;

    public function __construct(
        int $width,
        int $height,
        string $background = self::DEFAULT_BACKGROUND,
        int $alfa = self::DEFAULT_ALFA
    ) {
        parent::__construct($width, $height);

        $this->background = $background;
        $this->alfa = $alfa;
    }

    public function apply(ImageInterface $image): void
    {
        parent::apply($image);

        $thumbWidth = $image->getSize()->getWidth();
        $thumbHeight = $image->getSize()->getHeight();

        $ratio = $thumbWidth / $thumbHeight;

        if ($ratio == 0) {
            return;
        };

        if ($ratio < 1) { // width > thumbHeight
            $x = floor(($this->width - $thumbWidth) / 2);
            $y = 0;
        } else { // thumbHeight > width
            $x = 0;
            $y = floor(($this->height - $thumbHeight) / 2);
        }

        $image = (new Imagine())
            ->create(
                new Box($this->width, $this->height),
                (new RGB())->color($this->background, $this->alfa)
            )
            ->paste($image, new Point($x, $y));
    }
}
