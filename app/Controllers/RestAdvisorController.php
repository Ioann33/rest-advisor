<?php
namespace Controllers;

use Exception;
use Requests\RestAdvisorRequest;
use Resources\ResponseResource;
use Services\BoredRequestService;

class RestAdvisorController
{
    /**
     * @throws Exception
     */
    public function index(
        RestAdvisorRequest $request,
        BoredRequestService $requestService,
        ResponseResource $resource
    ): void
    {
        $result = $requestService->getRestAdvice(
            $request->getParticipantCount(),
            $request->getRestType()
        );
        $resource->handle($result, $request->getSender());
    }
}