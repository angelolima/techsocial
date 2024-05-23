<?php

use Symfony\Component\Asset\Packages;
use Symfony\Component\Asset\Package;
use Symfony\Component\Asset\VersionStrategy\EmptyVersionStrategy;

$defaultPackage = new Package(new EmptyVersionStrategy());
$packages = new Packages($defaultPackage);

return $packages;