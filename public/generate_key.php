<?php
require __DIR__ . '/../vendor/autoload.php';

use Defuse\Crypto\Key;

$key = Key::createNewRandomKey();
echo $key->saveToAsciiSafeString();