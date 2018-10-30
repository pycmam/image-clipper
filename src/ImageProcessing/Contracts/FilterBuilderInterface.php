<?php

namespace App\ImageProcessing\Contracts;

/**
 * FilterBuilder interface
 */
interface FilterBuilderInterface
{
    public function build(string $name, array $params): FilterInterface;
}
