<?php

namespace CoDevelopers\Elastic\Component;

use Symfony\Component\Asset\Package;
use Symfony\Component\Asset\VersionStrategy\JsonManifestVersionStrategy;

class Asset extends Package
{
    private static $package = null;

    public function __construct(string $manifestPath)
    {
        parent::__construct(new JsonManifestVersionStrategy($manifestPath));
    }
    
    public function get(string $filename): string
    {
        return $this->getUrl($filename);
    }
}
