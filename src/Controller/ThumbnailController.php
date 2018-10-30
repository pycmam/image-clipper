<?php

namespace App\Controller;

use App\ImageProcessing\Contracts\ProcessorInterface;
use App\Services\ThumbnailService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\File\MimeType\MimeTypeGuesser;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ThumbnailController extends AbstractController
{
    public function index(string $preset, string $path, ProcessorInterface $processor)
    {
        $service = new ThumbnailService($this->getParameter('thumbnails'), $processor);

        if (! $service->hasPreset($preset)) {
            throw new NotFoundHttpException(sprintf('Thumbnail preset "%s" not found', $preset));
        }

        if (! $service->hasSource($path)) {
            throw new NotFoundHttpException(sprintf('Source image "%s" not found', $path));
        }

        $thumbnailPath = $service->buildThumbnail($preset, $path);

        return new BinaryFileResponse(
            $thumbnailPath,
            Response::HTTP_OK,
            ['Content-type' => MimeTypeGuesser::getInstance()->guess($thumbnailPath),]
        );
    }
}
