<?php
include_once 'bootstrap.php';

use Controllers\RestAdvisorController;
use Requests\RestAdvisorRequest;

$c = new RestAdvisorController();

try {
    $c->index(new RestAdvisorRequest($argv));
} catch (Exception $e) {
    print_r($e->getMessage());
    echo PHP_EOL;
}