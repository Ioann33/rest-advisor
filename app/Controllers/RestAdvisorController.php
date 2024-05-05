<?php
namespace Controllers;

use Exception;
use Requests\RestAdvisorRequest;
use Services\BoredRequestService;

class RestAdvisorController
{
    /**
     * @throws Exception
     */
    public function index(RestAdvisorRequest $request, BoredRequestService $requestService)
    {
        $requestService->getRestAdvice(
            $request->getParticipantCount(),
            $request->getRestType()
        );
    }
}