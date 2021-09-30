<?php

namespace PHPMaker2022\wfg_appraisal;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

/**
 * update_appraisal controller
 */
class UpdateAppraisalController extends ControllerBase
{

    public function __invoke(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "UpdateAppraisal");
    }
}
