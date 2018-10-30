<?php

namespace App\ImageProcessing\Filters;


use Imagine\Image\Box;
use Imagine\Image\ImageInterface;
use Imagine\Image\Palette\RGB;
use Imagine\Image\Point;
use Imagine\Imagick\Imagine;

class FilterFixed extends FilterFit
{

    protected const BG_COLOR = '#ffffff';
    protected const BG_TRANSPARENCY = 0;

    private $bgColor;
    private $bgTransparency;

    public function __construct(
        int $width,
        int $height,
        string $bgColor = self::BG_COLOR,
        int $bgTransparency = self::BG_TRANSPARENCY)
    {
        parent::__construct($width, $height);

        $this->bgColor = $bgColor;
        $this->bgTransparency = $bgTransparency;
    }

    public function apply(ImageInterface $image): ImageInterface
    {
        $thumb = parent::apply($image);

        $thumbWidth = $thumb->getSize()->getWidth();
        $thumbHeight = $thumb->getSize()->getHeight();

        $ratio = $thumbWidth / $thumbHeight;

        if ($ratio == 0) {
            return $thumb;
        };

        if ($ratio < 1) // width > thumbHeight
        {
            $x = floor(($this->width - $thumbWidth) / 2);
            $y = 0;
        } else { // thumbHeight > width
            $x = 0;
            $y = floor(($this->height - $thumbHeight) / 2);
        }

        return (new Imagine())
            ->create(
                new Box($this->width, $this->height),
                (new RGB())->color($this->bgColor, $this->bgTransparency)
            )
            ->paste($thumb, new Point($x, $y));
    }
}