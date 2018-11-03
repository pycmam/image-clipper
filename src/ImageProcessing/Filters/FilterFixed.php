<?php

namespace App\ImageProcessing\Filters;

use Intervention\Image\Image;

class FilterFixed extends FilterFit
{
    private $background;

    public function __construct(int $width, int $height, string $position = 'center', ?string $background = null) {
        parent::__construct($width, $height, $position);

        $this->background = $background;
    }

    public function apply(Image $image): void
    {
        parent::apply($image);

        $image->resizeCanvas($this->width, $this->height, $this->position, false, $this->background);


    }
}
