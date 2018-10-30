<?php

namespace App\ImageProcessing;

use App\ImageProcessing\Contracts\FilterBuilderInterface;
use App\ImageProcessing\Contracts\FilterInterface;

/**
 * Build filter instance by given name and parameters
 */
class FilterBuilder implements FilterBuilderInterface
{
    /**
     * Builds filter instance by short name and parameters
     */
    public function build(string $name, array $params): FilterInterface
    {
        $class = $this->getFilterClass($name);
        $arguments = $this->makeConstructorArguments($class, $params);

        return new $class(...$arguments);
    }

    /**
     * Make arguments for filter constructor
     */
    private function makeConstructorArguments(string $class, array $params): array
    {
        $reflection = new \ReflectionClass($class);
        $arguments = [];
        if ($constructor = $reflection->getConstructor()) {
            foreach ($reflection->getConstructor()->getParameters() as $parameter) {
                $name = $parameter->getName();

                $arguments[] = isset($params[$name])
                    ? $params[$name]
                    : ($parameter->isDefaultValueAvailable()
                        ? $parameter->getDefaultValue()
                        : null);
            }
        }

        return $arguments;
    }

    /**
     * Returns filter class by short name
     */
    private function getFilterClass(string $name): string
    {
        if (! isset(FilterMap::MAP[$name])) {
            throw new \InvalidArgumentException(sprintf('Filter "%s" not found.', $name));
        }

        return FilterMap::MAP[$name];
    }
}
