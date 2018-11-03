<?php

namespace App\ImageProcessing\Filters;

use Intervention\Image\Image;

/**
 * Paste a given image source over the current image with an optional position and a offset coordinate
 */
class FilterOverlay extends FilterAbstract
{
    private $path;
    private $position;
    private $x;
    private $y;

    /**
     * FilterOverlay constructor.
     *
     * @param string $path The image source that will inserted on top of the current image.
     * @param string $position Set a position where image will be inserted.
     * @param int $x Optional relative offset of the new image on x-axis of the current image.
     *               Offset will be calculated relative to the position parameter.
     * @param int $y Optional relative offset of the new image on y-axis of the current image.
     *               Offset will be calculated relative to the position parameter.
     */
    public function __construct(string $path, string $position = 'center', int $x = 0, int $y = 0)
    {
        $this->path = $path;
        $this->position = $position;
        $this->x = $x;
        $this->y = $y;
    }

    public function apply(Image $image): void
    {
        $image->insert($this->path, $this->position, $this->x, $this->y);
    }
}
