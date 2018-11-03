<?php

namespace App\Services;

use App\Helpers\ConfigHelper;
use App\ImageProcessing\Contracts\ProcessorInterface;
use Imagine\Imagick\Imagine;
use Intervention\Image\ImageManager;

/**
 *
 */
class ThumbnailService
{
    /**
     * @var array
     */
    private $presets;

    /**
     * @var array
     */
    private $defaults;

    /**
     * @var string
     */
    private $source;

    /**
     * @var string
     */
    private $destination;

    /** @var ImageManager */
    private $manager = null;

    /**
     * @var ProcessorInterface
     */
    private $processor;

    public function __construct(array $config, ProcessorInterface $processor)
    {
        $this->presets = $config['presets'];
        $this->defaults = $config['preset_defaults'];
        $this->source = $config['directories']['source'];
        $this->destination = $config['directories']['destination'];

        $this->processor = $processor;

        $this->manager = $this->makeManager($config['driver']);
    }

    public function buildThumbnail(string $preset, string $path): string
    {
        $config = $this->getPresetConfig($preset);
        $thumbnailPath = $this->getDestinationPath($preset, $path);

        $this->checkDestinationPath($thumbnailPath);

        $image = $this->manager->make($this->getSourcePath($path));

        $this->processor->process($image, $config['filters']);

        $image->save($thumbnailPath, $config['quality']);

        if (! is_readable($thumbnailPath)) {
            throw new \RuntimeException(sprintf('Can\'t save thumbnail to file: %s', $thumbnailPath));
        }

        return $thumbnailPath;
    }


    public function hasPreset(string $name): bool
    {
        return isset($this->presets[$name]);
    }


    public function hasSource(string $relativePath): bool
    {
        return is_readable($this->getSourcePath($relativePath));
    }


    private function checkDestinationPath(string $path, int $mode = 755): void
    {
        $dir = dirname($path);

        if (! file_exists($dir)) {
            mkdir($dir, $mode, true);
        }
    }


    private function getPresetConfig(string $name): array
    {
        return ConfigHelper::mergeDefaults($this->presets[$name], $this->defaults);
    }


    private function getDestinationPath(string $preset, string $relativePath): string
    {
        return $this->destination . DIRECTORY_SEPARATOR . $preset . DIRECTORY_SEPARATOR . $relativePath;
    }


    private function getSourcePath(string $relativePath): string
    {
        return $this->source . DIRECTORY_SEPARATOR . $relativePath;
    }

    private function makeManager(string $driver): ImageManager
    {
        return new ImageManager(['driver' => $driver]);
    }
}
