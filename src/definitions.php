<?php

namespace PHPMaker2022\wfg_appraisal;

use Slim\Views\PhpRenderer;
use Slim\Csrf\Guard;
use Psr\Container\ContainerInterface;
use Monolog\Logger;
use Monolog\Handler\RotatingFileHandler;
use Doctrine\DBAL\Logging\LoggerChain;
use Doctrine\DBAL\Logging\DebugStack;

return [
    "cache" => function (ContainerInterface $c) {
        return new \Slim\HttpCache\CacheProvider();
    },
    "view" => function (ContainerInterface $c) {
        return new PhpRenderer("views/");
    },
    "flash" => function (ContainerInterface $c) {
        return new \Slim\Flash\Messages();
    },
    "audit" => function (ContainerInterface $c) {
        $logger = new Logger("audit"); // For audit trail
        $logger->pushHandler(new AuditTrailHandler("log/audit.log"));
        return $logger;
    },
    "log" => function (ContainerInterface $c) {
        global $RELATIVE_PATH;
        $logger = new Logger("log");
        $logger->pushHandler(new RotatingFileHandler($RELATIVE_PATH . "log/log.log"));
        return $logger;
    },
    "sqllogger" => function (ContainerInterface $c) {
        $loggers = [];
        if (Config("DEBUG")) {
            $loggers[] = $c->get("debugstack");
        }
        return (count($loggers) > 0) ? new LoggerChain($loggers) : null;
    },
    "csrf" => function (ContainerInterface $c) {
        global $ResponseFactory;
        return new Guard($ResponseFactory, Config("CSRF_PREFIX"));
    },
    "debugstack" => \DI\create(DebugStack::class),
    "debugsqllogger" => \DI\create(DebugSqlLogger::class),
    "security" => \DI\create(AdvancedSecurity::class),
    "profile" => \DI\create(UserProfile::class),
    "language" => \DI\create(Language::class),
    "timer" => \DI\create(Timer::class),
    "session" => \DI\create(HttpSession::class),

    // Tables
    "main_businessunits" => \DI\create(MainBusinessunits::class),
    "main_pa_appraisalhistory" => \DI\create(MainPaAppraisalhistory::class),
    "main_pa_category" => \DI\create(MainPaCategory::class),
    "main_pa_employee_rating_breakdown" => \DI\create(MainPaEmployeeRatingBreakdown::class),
    "main_pa_employee_ratings" => \DI\create(MainPaEmployeeRatings::class),
    "main_pa_employee_response" => \DI\create(MainPaEmployeeResponse::class),
    "main_pa_groups" => \DI\create(MainPaGroups::class),
    "main_pa_groups_employees" => \DI\create(MainPaGroupsEmployees::class),
    "main_pa_implementation" => \DI\create(MainPaImplementation::class),
    "main_pa_initialization" => \DI\create(MainPaInitialization::class),
    "main_pa_questions" => \DI\create(MainPaQuestions::class),
    "main_pa_ratings" => \DI\create(MainPaRatings::class),
    "main_pa_score" => \DI\create(MainPaScore::class),
    "main_users" => \DI\create(MainUsers::class),
    "users" => \DI\create(Users::class),
    "userlevelpermissions" => \DI\create(Userlevelpermissions::class),
    "userlevels" => \DI\create(Userlevels::class),
    "main_group_pa_questions" => \DI\create(MainGroupPaQuestions::class),
    "main_pa_group_manager" => \DI\create(MainPaGroupManager::class),
    "employee_appraisal" => \DI\create(EmployeeAppraisal::class),
    "permissions2" => \DI\create(Permissions2::class),
    "line_manager_one_appraisal" => \DI\create(LineManagerOneAppraisal::class),
    "appraisal_ratings" => \DI\create(AppraisalRatings::class),
    "message_templates" => \DI\create(MessageTemplates::class),
    "line_manager_two_appraisal" => \DI\create(LineManagerTwoAppraisal::class),
    "appraisal_report" => \DI\create(AppraisalReport::class),
    "pending_appraisal_ratings" => \DI\create(PendingAppraisalRatings::class),
    "pending_l2_appraisal" => \DI\create(PendingL2Appraisal::class),
    "update_appraisal" => \DI\create(UpdateAppraisal::class),

    // User table
    "usertable" => \DI\get("main_users"),
];
