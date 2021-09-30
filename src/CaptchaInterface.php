<?php

namespace PHPMaker2022\wfg_appraisal;

/**
 * Captcha interface
 */
interface CaptchaInterface
{

    public function getHtml();

    public function getConfirmHtml();

    public function validate();

    public function getScript($formName);
}
