<?php

namespace App\ImageProcessing\Filters;

use Intervention\Image\Image;

/**
 * Write a text string to the current image at an optional x,y basepoint position
 */
class FilterText extends FilterAbstract
{
    private $text;
    private $x;
    private $y;
    private $align;
    private $valign;
    private $font;
    private $size;
    private $color;
    private $angle;

    /**
     * FilterText constructor.
     *
     * @param string $text The text string that will be written to the image.
     * @param int $x x-ordinate defining the basepoint of the first character.
     * @param int $y y-ordinate defining the basepoint of the first character.
     * @param string $align Set horizontal text alignment relative to given basepoint.
     *                      Possible values are left, right and center.
     * @param string $valign Set vertical text alignment relative to given basepoint.
     *                       Possible values are top, bottom and middle.
     * @param null|string $font Set path to a True Type Font file
     * @param int $size Set font size in pixels.
     *                  Font sizing is only available if a font file is set and will be ignored otherwise.
     * @param string $color Set color of the text
     * @param int|null $angle Set rotation angle of text in degrees.
     *                        Text will be rotated counter-clockwise around the vertical and horizontal aligned point.
     *                        Rotation is only available if a font file is set and will be ignored otherwise.
     */
    public function __construct(
        string $text,
        int $x = 0,
        int $y = 0,
        string $align = 'left',
        string $valign = 'bottom',
        ?string $font = null,
        int $size = 12,
        string $color = '#000000',
        ?int $angle = null)
    {
        $this->text = $text;
        $this->x = $x;
        $this->y = $y;
        $this->align = $align;
        $this->valign = $valign;
        $this->font = $font;
        $this->size = $size;
        $this->color = $color;
        $this->angle = $angle;
    }

    public function apply(Image $image): void
    {
        $image->text($this->text, $this->x, $this->y, function($font) {

            $this->font && $font->file($this->font);
            $this->angle && $font->angle($this->angle);

            $font->align($this->align);
            $font->valign($this->valign);
            $font->color($this->color);
            $font->size($this->size);
        });
    }
}
