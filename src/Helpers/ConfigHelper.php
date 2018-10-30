<?php

namespace App\Helpers;

class ConfigHelper
{
    public static function mergeDefaults(array $config, array $defaults): array
    {
        foreach ($defaults as $key => $value) {
            if (! isset($config[$key])) {
                $config[$key] = $value;
            } else {
                if (is_array($config[$key])) {
                    $config[$key] = array_merge($defaults[$key], $config[$key]);
                }
            }
        }

        return $config;
    }
}
