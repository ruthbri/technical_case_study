<?php
require_once __DIR__ . '/vendor/autoload.php';

use Controllers\InsuranceController;

try {
    $controller = new InsuranceController();
    $xmlOutput = $controller->run('input_complete.json');
    header('Content-Type: application/xml');
    echo $xmlOutput;
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
