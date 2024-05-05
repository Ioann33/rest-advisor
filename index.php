<?php
include_once 'bootstrap.php';

use Controllers\RestAdvisorController;
use Requests\RestAdvisorRequest;
use Resources\ResponseResource;
use Services\BoredRequestService;

$c = new RestAdvisorController();
try {
    $c->index(new RestAdvisorRequest($argv), new BoredRequestService(), new ResponseResource());
} catch (Exception $e) {
    print_r($e->getMessage());
    echo PHP_EOL;
}