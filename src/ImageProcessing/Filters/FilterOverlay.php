<?php

namespace App\ImageProcessing\Filters;


use Imagine\Image\Box;
use Imagine\Image\ImageInterface;
use Imagine\Image\Point;
use Imagine\Imagick\Imagine;

class FilterOverlay extends FilterAbstract
{
    private $path;

    public function __construct(string $path)
    {
        $this->path = $path;
    }

    public function apply(ImageInterface $image): ImageInterface
    {
        $overlay = (new Imagine())->open($this->path);

        if ($overlay->getSize()->getWidth() > $image->getSize()->getWidth() ||
            $overlay->getSize()->getHeight() > $image->getSize()->getHeight())
        {

            $overlay = $overlay->thumbnail(
                new Box($image->getSize()->getWidth(), $image->getSize()->getHeight()),
                ImageInterface::THUMBNAIL_INSET
            );
        }

        $x = floor(($image->getSize()->getWidth() - $overlay->getSize()->getWidth()) / 2);
        $y = floor(($image->getSize()->getHeight() - $overlay->getSize()->getHeight()) / 2);

        return $image->paste($overlay, new Point($x, $y));
    }
}