<?php

namespace CoDevelopers\WpAsset;

use Symfony\Component\Asset\Package;
use Symfony\Component\Asset\VersionStrategy\StaticVersionStrategy;
use Symfony\Component\Asset\VersionStrategy\JsonManifestVersionStrategy;
use Symfony\Component\Asset\VersionStrategy\EmptyVersionStrategy;

class WpAsset extends Package
{
    const EMPTY_VERSION_STRATEGY = 1;
    const STATIC_VERSION_STRATEGY = 2;
    const JSON_MANIFEST_VERSION_STRATEGY = 3;

    public function __construct(int $strategy = self::JSON_MANIFEST_VERSION_STRATEGY, ...$params)
    {
        switch ($strategy) {
            case self::STATIC_VERSION_STRATEGY:
                parent::__construct(new StaticVersionStrategy($params[0]));
                break;
            case self::JSON_MANIFEST_VERSION_STRATEGY:
                parent::__construct(new JsonManifestVersionStrategy($params[0]));
                break;
            default:
                parent::__construct(new EmptyVersionStrategy());
                break;
        }
    }

    public function get(string $filename): string
    {
        return function_exists('get_template_directory_uri') ? get_template_directory_uri() . '/' . ltrim($this->getUrl($filename), '/') : $this->getUrl($filename);
    }
}
