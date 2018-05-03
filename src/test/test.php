<?php
error_reporting(E_ALL);

require_once __DIR__ . '/../../vendor/autoload.php'; // Autoload files using Composer autoload
use WpClasses\WpNonce;

$WpNonce = new WpNonce();
var_dump($WpNonce);
$WpNonce->nonceCreate('wp');
var_dump($WpNonce->getNonce());
