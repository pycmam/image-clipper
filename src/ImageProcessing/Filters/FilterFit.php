<?php

namespace App\ImageProcessing\Filters;

use Intervention\Image\Image;

/**
 * Combine cropping and resizing to format image in a smart way.
 * The filter will find the best fitting aspect ratio of your given width and height on the current image automatically,
 * cut it out and resize it to the given dimension.
 */
class FilterFit extends FilterAbstract
{
    protected $width;
    protected $height;
    protected $position;

    /**
     * FilterFit constructor.
     *
     * @param int $width The width the image will be resized to after cropping out the best fitting aspect ratio.
     * @param int $height The height the image will be resized to after cropping out the best fitting aspect ratio.
     *                    If no height is given, method will use same value as width.
     * @param string $position Set a position where cutout will be positioned.
     *                         By default the best fitting aspect ration is centered.
     */
    public function __construct(int $width, int $height = null, string $position = 'center')
    {
        $this->width = $width;
        $this->height = $height;
        $this->position = $position;
    }

    public function apply(Image $image): void
    {
        $image->fit($this->width, $this->height, null, $this->position);
    }
}
