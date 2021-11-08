<?php
define('BASE', __DIR__ . '/');

include_once(BASE . 'Collage.php');
define('DEBUG_MODE', false);
if (DEBUG_MODE) {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
}

$collage = new Collage();
$collage->create(BASE . 'assets')->display();
$collage->create(BASE . 'assets')->save('collage.png');

