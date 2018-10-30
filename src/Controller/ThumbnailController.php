<?php


namespace App\Controller;


use App\ImageProcessing\Contracts\FilterInterface;
use App\ImageProcessing\Filters\FilterBlur;
use App\ImageProcessing\Filters\FilterBrightness;
use App\ImageProcessing\Filters\FilterFit;
use App\ImageProcessing\Filters\FilterFixed;
use App\ImageProcessing\Filters\FilterGamma;
use App\ImageProcessing\Filters\FilterGrayscale;
use App\ImageProcessing\Filters\FilterOverlay;
use App\ImageProcessing\Filters\FilterSharpen;
use Imagine\Image\Box;
use Imagine\Image\ImageInterface;
use Imagine\Image\Palette\RGB;
use Imagine\Image\Point;
use Imagine\Imagick\Imagine;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\File\MimeType\MimeTypeGuesser;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ThumbnailController extends AbstractController
{
    public function index(string $preset, string $path, LoggerInterface $logger)
    {

        $logger->debug("Request to generate '{preset}' from image '{path}'", [
            'thumbnail' => $preset,
            'path' => $path,
        ]);

        // clean path
        $path = preg_replace('%(?:\.+)(?:\/+)%sim', '', $path);

        $configuration = $this->getParameter('thumbnails');

        $presets = $configuration['presets'];
        $sourcePath = $configuration['directories']['source'] . DIRECTORY_SEPARATOR . $path;
        $thumbnailPath = $configuration['directories']['destination'] . DIRECTORY_SEPARATOR . $preset . DIRECTORY_SEPARATOR . $path;

        // preset not found?
        if (!isset($presets[$preset]))
        {
            throw new NotFoundHttpException(sprintf('Thumbnail preset "%s" not found', $preset));
        }

        // source image not found?
        if (!is_readable($sourcePath))
        {
            throw new NotFoundHttpException(sprintf('Source image "%s" not found', $sourcePath));
        }

        $presetConfig = $this->mergePresetConfig($configuration['preset_defaults'], $presets[$preset]);

        $this->buildThumbnail($sourcePath, $thumbnailPath, $presetConfig);

        return new BinaryFileResponse($thumbnailPath, Response::HTTP_OK, [
            'Content-type' => MimeTypeGuesser::getInstance()->guess($thumbnailPath),
        ]);
    }

    private function mergePresetConfig(array $default, array $config): array
    {

        foreach ($default as $key => $value)
        {
            if (! isset($config[$key])) {
                $config[$key] = $value;
            } else {
                if (is_array($config[$key])) {
                    $config[$key] = array_merge($default[$key], $config[$key]);
                }
            }
        }

        return $config;
    }

    private function makeFilter(string $name, array $params): FilterInterface
    {
        $classMap = [
            'blur' => FilterBlur::class,
            'brightness' => FilterBrightness::class,
            'fit' => FilterFit::class,
            'fixed' => FilterFixed::class,
            'gamma' => FilterGamma::class,
            'grayscale' => FilterGrayscale::class,
            'overlay' => FilterOverlay::class,
            'sharpen' => FilterSharpen::class,
        ];

        if (! isset($classMap[$name])) {
            throw new \InvalidArgumentException(sprintf('Filter "%s" not found.', $name));
        }

        return $classMap[$name](...$params);
    }

    private function buildThumbnail(string $sourcePath, string $savePath, array $config): void
    {
        $image = (new Imagine())->open($sourcePath);

        foreach ($config['filters'] as $filterConfig)
        {
            $name = $filterConfig['name'];
            unset($filterConfig['name']);

            $filter = $this->makeFilter($name, $filterConfig);

            $image = $filter->apply($image);
        }

        if (! file_exists(dirname($savePath)))
        {
            mkdir(dirname($savePath), 0777, true);
        }

        $image->save($savePath, $config['quality']);
        chmod($savePath, 0777);
    }
}