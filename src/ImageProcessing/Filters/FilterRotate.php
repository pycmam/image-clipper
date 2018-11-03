<?php

namespace App\ImageProcessing\Filters;

use Intervention\Image\Image;

/**
 * Rotate the current image counter-clockwise by a given angle.
 * Optionally define a background color for the uncovered zone after the rotation.
 */
class FilterRotate extends FilterAbstract
{
    private $angle;
    private $background;

    /**
     * FilterRotate constructor.
     *
     * @param float $angle The rotation angle in degrees to rotate the image counter-clockwise.
     * @param string|null $background A background color for the uncovered zone after the rotation. Default #ffffff
     */
    public function __construct(float $angle, string $background = null)
    {
        $this->angle = $angle;
        $this->background = $background;
    }

    public function apply(Image $image): void
    {
        $image->rotate($this->angle, $this->background);
    }
}
