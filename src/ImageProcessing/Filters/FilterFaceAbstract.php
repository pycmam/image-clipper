<?php

namespace App\ImageProcessing\Filters;

use Intervention\Image\Image;


abstract class FilterFaceAbstract extends FilterAbstract
{
    private $cascade;

    /**
     * FilterFaceAbstract constructor.
     *
     * @param string $cascade Path to OpenCV Haar cascade XML
     */
    public function __construct(string $cascade)
    {
        $this->cascade = $cascade;
    }

    /**
     * @param Image $image
     *
     * @return array|null
     */
    protected function getFaces(Image $image)
    {
        $image->save($tmp = '/tmp/'.sha1((string) microtime(true)).'.jpg');

        $faces = face_detect($tmp, $this->cascade);

        unlink($tmp);

        if(count($faces) > 0) {
            return $faces;
        }

        return null;
    }
}
