<?php


namespace App\Controller;


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

        $this->buildThumbnail($sourcePath, $thumbnailPath, $presets[$preset]);

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


    private function buildThumbnail(string $sourcePath, string $thumbnailPath, array $config)
    {
        $image = (new Imagine())->open($sourcePath);

//        foreach ($config['filters'] as $action)
//        {
//            if (count($action) > 1)
//            {
//                list ($operation, $params) = $action;
//            } else {
//                $operation = $action[0];
//                $params = null;
//            }
//
//            switch ($operation)
//            {
//
//                case 'fit':
//
//                    $image = $image->thumbnail(new Box($params[0], $params[1]),
//                        ImageInterface::THUMBNAIL_INSET,
//                        isset($params[3]) ? $params[3] : ImageInterface::FILTER_LANCZOS
//                    );
//
//                    break;
//
//                case 'fixed':
//
//                    $image = $image->thumbnail(new Box($params[0], $params[1]),
//                        ImageInterface::THUMBNAIL_INSET,
//                        isset($params[3]) ? $params[3] : ImageInterface::FILTER_LANCZOS);
//
//                    $width = $image->getSize()->getWidth();
//                    $height = $image->getSize()->getHeight();
//
//                    $ratio = $width / $height;
//
//                    if ($ratio == 0) continue;
//
//                    if ($ratio < 1) // width > height
//                    {
//
//                        $x = floor(($params[0] - $width) / 2);
//                        $y = 0;
//
//                    } else { // height > width
//
//                        $x = 0;
//                        $y = floor(($params[1] - $height) / 2);
//                    }
//
//                    $bg = (new Imagine())
//                        ->create(new Box($params[0], $params[1]), (new RGB())->color('#fff', 0))
//                        ->paste($image, new Point($x, $y));
//
//                    $image = $bg;
//
//                    break;
//
//                case 'overlay':
//
//                    $overlay = (new Imagine())
//                        ->open(config('app.overlays_dir') . DIRECTORY_SEPARATOR . $params[0]);
//
//                    if ($overlay->getSize()->getWidth() > $image->getSize()->getWidth() ||
//                        $overlay->getSize()->getHeight() > $image->getSize()->getHeight())
//                    {
//
//                        $overlay = $overlay->thumbnail(
//                            new Box($image->getSize()->getWidth(), $image->getSize()->getHeight()),
//                            ImageInterface::THUMBNAIL_INSET
//                        );
//                    }
//
//
//                    $x = floor(($image->getSize()->getWidth() - $overlay->getSize()->getWidth()) / 2);
//                    $y = floor(($image->getSize()->getHeight() - $overlay->getSize()->getHeight()) / 2);
//
//                    $image->paste($overlay, new Point($x, $y));
//
//                    break;
//
//                case 'blur':
//
//                    $image->effects()->blur($params);
//
//                    break;
//
//                case 'grayscale':
//
//                    $image->effects()->grayscale();
//
//                    break;
//
//
//                case 'gamma':
//
//                    $image->effects()->gamma($params);
//
//                    break;
//
//                case 'sharpen':
//
//                    $image->effects()->sharpen();
//
//                    break;
//
//                default:
//                    throw new \InvalidArgumentException('Invalid operation: '.$operation);
//            }
//
//        }
//
//        if (! file_exists(dirname($thumbnailPath)))
//        {
//            mkdir(dirname($thumbnailPath), 0777, true);
//        }
//
//        $image->save($thumbnailPath, [
//            'jpeg_quality'          => isset($config['quality']) ? $config['quality'] : 100,
//            'png_compression_level' => isset($config['compression']) ? $config['compression'] : 5,
//            'flatten'               => isset($config['flatten']) ? $config['flatten'] : true,
//        ]);
//        @chmod($thumbnailPath, 0777);

        return $image;
    }
}