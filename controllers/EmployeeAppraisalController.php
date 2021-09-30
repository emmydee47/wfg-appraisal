<?php

namespace PHPMaker2022\wfg_appraisal;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

/**
 * employee_appraisal controller
 */
class EmployeeAppraisalController extends ControllerBase
{

    public function __invoke(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "EmployeeAppraisal");
    }
}
