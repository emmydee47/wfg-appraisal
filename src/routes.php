<?php

namespace PHPMaker2022\wfg_appraisal;

use Slim\App;
use Slim\Routing\RouteCollectorProxy;

// Handle Routes
return function (App $app) {
    // main_businessunits
    $app->map(["GET","POST","OPTIONS"], '/mainbusinessunitslist[/{id}]', MainBusinessunitsController::class . ':list')->add(PermissionMiddleware::class)->setName('mainbusinessunitslist-main_businessunits-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/mainbusinessunitsadd[/{id}]', MainBusinessunitsController::class . ':add')->add(PermissionMiddleware::class)->setName('mainbusinessunitsadd-main_businessunits-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/mainbusinessunitsview[/{id}]', MainBusinessunitsController::class . ':view')->add(PermissionMiddleware::class)->setName('mainbusinessunitsview-main_businessunits-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/mainbusinessunitsedit[/{id}]', MainBusinessunitsController::class . ':edit')->add(PermissionMiddleware::class)->setName('mainbusinessunitsedit-main_businessunits-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/mainbusinessunitsdelete[/{id}]', MainBusinessunitsController::class . ':delete')->add(PermissionMiddleware::class)->setName('mainbusinessunitsdelete-main_businessunits-delete'); // delete
    $app->group(
        '/main_businessunits',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{id}]', MainBusinessunitsController::class . ':list')->add(PermissionMiddleware::class)->setName('main_businessunits/list-main_businessunits-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{id}]', MainBusinessunitsController::class . ':add')->add(PermissionMiddleware::class)->setName('main_businessunits/add-main_businessunits-add-2'); // add
            $group->map(["GET","OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{id}]', MainBusinessunitsController::class . ':view')->add(PermissionMiddleware::class)->setName('main_businessunits/view-main_businessunits-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{id}]', MainBusinessunitsController::class . ':edit')->add(PermissionMiddleware::class)->setName('main_businessunits/edit-main_businessunits-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{id}]', MainBusinessunitsController::class . ':delete')->add(PermissionMiddleware::class)->setName('main_businessunits/delete-main_businessunits-delete-2'); // delete
        }
    );

    // main_pa_appraisalhistory
    $app->map(["GET","POST","OPTIONS"], '/mainpaappraisalhistorylist[/{id}]', MainPaAppraisalhistoryController::class . ':list')->add(PermissionMiddleware::class)->setName('mainpaappraisalhistorylist-main_pa_appraisalhistory-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/mainpaappraisalhistoryadd[/{id}]', MainPaAppraisalhistoryController::class . ':add')->add(PermissionMiddleware::class)->setName('mainpaappraisalhistoryadd-main_pa_appraisalhistory-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/mainpaappraisalhistoryview[/{id}]', MainPaAppraisalhistoryController::class . ':view')->add(PermissionMiddleware::class)->setName('mainpaappraisalhistoryview-main_pa_appraisalhistory-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/mainpaappraisalhistoryedit[/{id}]', MainPaAppraisalhistoryController::class . ':edit')->add(PermissionMiddleware::class)->setName('mainpaappraisalhistoryedit-main_pa_appraisalhistory-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/mainpaappraisalhistorydelete[/{id}]', MainPaAppraisalhistoryController::class . ':delete')->add(PermissionMiddleware::class)->setName('mainpaappraisalhistorydelete-main_pa_appraisalhistory-delete'); // delete
    $app->group(
        '/main_pa_appraisalhistory',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{id}]', MainPaAppraisalhistoryController::class . ':list')->add(PermissionMiddleware::class)->setName('main_pa_appraisalhistory/list-main_pa_appraisalhistory-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{id}]', MainPaAppraisalhistoryController::class . ':add')->add(PermissionMiddleware::class)->setName('main_pa_appraisalhistory/add-main_pa_appraisalhistory-add-2'); // add
            $group->map(["GET","OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{id}]', MainPaAppraisalhistoryController::class . ':view')->add(PermissionMiddleware::class)->setName('main_pa_appraisalhistory/view-main_pa_appraisalhistory-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{id}]', MainPaAppraisalhistoryController::class . ':edit')->add(PermissionMiddleware::class)->setName('main_pa_appraisalhistory/edit-main_pa_appraisalhistory-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{id}]', MainPaAppraisalhistoryController::class . ':delete')->add(PermissionMiddleware::class)->setName('main_pa_appraisalhistory/delete-main_pa_appraisalhistory-delete-2'); // delete
        }
    );

    // main_pa_employee_ratings
    $app->map(["GET","POST","OPTIONS"], '/mainpaemployeeratingslist[/{id}]', MainPaEmployeeRatingsController::class . ':list')->add(PermissionMiddleware::class)->setName('mainpaemployeeratingslist-main_pa_employee_ratings-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/mainpaemployeeratingsadd[/{id}]', MainPaEmployeeRatingsController::class . ':add')->add(PermissionMiddleware::class)->setName('mainpaemployeeratingsadd-main_pa_employee_ratings-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/mainpaemployeeratingsedit[/{id}]', MainPaEmployeeRatingsController::class . ':edit')->add(PermissionMiddleware::class)->setName('mainpaemployeeratingsedit-main_pa_employee_ratings-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/mainpaemployeeratingsdelete[/{id}]', MainPaEmployeeRatingsController::class . ':delete')->add(PermissionMiddleware::class)->setName('mainpaemployeeratingsdelete-main_pa_employee_ratings-delete'); // delete
    $app->map(["GET","POST","OPTIONS"], '/mainpaemployeeratingssearch', MainPaEmployeeRatingsController::class . ':search')->add(PermissionMiddleware::class)->setName('mainpaemployeeratingssearch-main_pa_employee_ratings-search'); // search
    $app->group(
        '/main_pa_employee_ratings',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{id}]', MainPaEmployeeRatingsController::class . ':list')->add(PermissionMiddleware::class)->setName('main_pa_employee_ratings/list-main_pa_employee_ratings-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{id}]', MainPaEmployeeRatingsController::class . ':add')->add(PermissionMiddleware::class)->setName('main_pa_employee_ratings/add-main_pa_employee_ratings-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{id}]', MainPaEmployeeRatingsController::class . ':edit')->add(PermissionMiddleware::class)->setName('main_pa_employee_ratings/edit-main_pa_employee_ratings-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{id}]', MainPaEmployeeRatingsController::class . ':delete')->add(PermissionMiddleware::class)->setName('main_pa_employee_ratings/delete-main_pa_employee_ratings-delete-2'); // delete
            $group->map(["GET","POST","OPTIONS"], '/' . Config("SEARCH_ACTION") . '', MainPaEmployeeRatingsController::class . ':search')->add(PermissionMiddleware::class)->setName('main_pa_employee_ratings/search-main_pa_employee_ratings-search-2'); // search
        }
    );

    // main_pa_employee_response
    $app->map(["GET","POST","OPTIONS"], '/mainpaemployeeresponselist[/{id}]', MainPaEmployeeResponseController::class . ':list')->add(PermissionMiddleware::class)->setName('mainpaemployeeresponselist-main_pa_employee_response-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/mainpaemployeeresponseadd[/{id}]', MainPaEmployeeResponseController::class . ':add')->add(PermissionMiddleware::class)->setName('mainpaemployeeresponseadd-main_pa_employee_response-add'); // add
    $app->group(
        '/main_pa_employee_response',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{id}]', MainPaEmployeeResponseController::class . ':list')->add(PermissionMiddleware::class)->setName('main_pa_employee_response/list-main_pa_employee_response-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{id}]', MainPaEmployeeResponseController::class . ':add')->add(PermissionMiddleware::class)->setName('main_pa_employee_response/add-main_pa_employee_response-add-2'); // add
        }
    );

    // main_pa_groups
    $app->map(["GET","POST","OPTIONS"], '/mainpagroupslist[/{id}]', MainPaGroupsController::class . ':list')->add(PermissionMiddleware::class)->setName('mainpagroupslist-main_pa_groups-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/mainpagroupsadd[/{id}]', MainPaGroupsController::class . ':add')->add(PermissionMiddleware::class)->setName('mainpagroupsadd-main_pa_groups-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/mainpagroupsview[/{id}]', MainPaGroupsController::class . ':view')->add(PermissionMiddleware::class)->setName('mainpagroupsview-main_pa_groups-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/mainpagroupsedit[/{id}]', MainPaGroupsController::class . ':edit')->add(PermissionMiddleware::class)->setName('mainpagroupsedit-main_pa_groups-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/mainpagroupsdelete[/{id}]', MainPaGroupsController::class . ':delete')->add(PermissionMiddleware::class)->setName('mainpagroupsdelete-main_pa_groups-delete'); // delete
    $app->group(
        '/main_pa_groups',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{id}]', MainPaGroupsController::class . ':list')->add(PermissionMiddleware::class)->setName('main_pa_groups/list-main_pa_groups-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{id}]', MainPaGroupsController::class . ':add')->add(PermissionMiddleware::class)->setName('main_pa_groups/add-main_pa_groups-add-2'); // add
            $group->map(["GET","OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{id}]', MainPaGroupsController::class . ':view')->add(PermissionMiddleware::class)->setName('main_pa_groups/view-main_pa_groups-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{id}]', MainPaGroupsController::class . ':edit')->add(PermissionMiddleware::class)->setName('main_pa_groups/edit-main_pa_groups-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{id}]', MainPaGroupsController::class . ':delete')->add(PermissionMiddleware::class)->setName('main_pa_groups/delete-main_pa_groups-delete-2'); // delete
        }
    );

    // main_pa_groups_employees
    $app->map(["GET","POST","OPTIONS"], '/mainpagroupsemployeeslist[/{id}]', MainPaGroupsEmployeesController::class . ':list')->add(PermissionMiddleware::class)->setName('mainpagroupsemployeeslist-main_pa_groups_employees-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/mainpagroupsemployeesadd[/{id}]', MainPaGroupsEmployeesController::class . ':add')->add(PermissionMiddleware::class)->setName('mainpagroupsemployeesadd-main_pa_groups_employees-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/mainpagroupsemployeesview[/{id}]', MainPaGroupsEmployeesController::class . ':view')->add(PermissionMiddleware::class)->setName('mainpagroupsemployeesview-main_pa_groups_employees-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/mainpagroupsemployeesedit[/{id}]', MainPaGroupsEmployeesController::class . ':edit')->add(PermissionMiddleware::class)->setName('mainpagroupsemployeesedit-main_pa_groups_employees-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/mainpagroupsemployeesdelete[/{id}]', MainPaGroupsEmployeesController::class . ':delete')->add(PermissionMiddleware::class)->setName('mainpagroupsemployeesdelete-main_pa_groups_employees-delete'); // delete
    $app->group(
        '/main_pa_groups_employees',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{id}]', MainPaGroupsEmployeesController::class . ':list')->add(PermissionMiddleware::class)->setName('main_pa_groups_employees/list-main_pa_groups_employees-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{id}]', MainPaGroupsEmployeesController::class . ':add')->add(PermissionMiddleware::class)->setName('main_pa_groups_employees/add-main_pa_groups_employees-add-2'); // add
            $group->map(["GET","OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{id}]', MainPaGroupsEmployeesController::class . ':view')->add(PermissionMiddleware::class)->setName('main_pa_groups_employees/view-main_pa_groups_employees-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{id}]', MainPaGroupsEmployeesController::class . ':edit')->add(PermissionMiddleware::class)->setName('main_pa_groups_employees/edit-main_pa_groups_employees-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{id}]', MainPaGroupsEmployeesController::class . ':delete')->add(PermissionMiddleware::class)->setName('main_pa_groups_employees/delete-main_pa_groups_employees-delete-2'); // delete
        }
    );

    // main_pa_initialization
    $app->map(["GET","POST","OPTIONS"], '/mainpainitializationlist[/{id}]', MainPaInitializationController::class . ':list')->add(PermissionMiddleware::class)->setName('mainpainitializationlist-main_pa_initialization-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/mainpainitializationadd[/{id}]', MainPaInitializationController::class . ':add')->add(PermissionMiddleware::class)->setName('mainpainitializationadd-main_pa_initialization-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/mainpainitializationview[/{id}]', MainPaInitializationController::class . ':view')->add(PermissionMiddleware::class)->setName('mainpainitializationview-main_pa_initialization-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/mainpainitializationedit[/{id}]', MainPaInitializationController::class . ':edit')->add(PermissionMiddleware::class)->setName('mainpainitializationedit-main_pa_initialization-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/mainpainitializationdelete[/{id}]', MainPaInitializationController::class . ':delete')->add(PermissionMiddleware::class)->setName('mainpainitializationdelete-main_pa_initialization-delete'); // delete
    $app->group(
        '/main_pa_initialization',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{id}]', MainPaInitializationController::class . ':list')->add(PermissionMiddleware::class)->setName('main_pa_initialization/list-main_pa_initialization-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{id}]', MainPaInitializationController::class . ':add')->add(PermissionMiddleware::class)->setName('main_pa_initialization/add-main_pa_initialization-add-2'); // add
            $group->map(["GET","OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{id}]', MainPaInitializationController::class . ':view')->add(PermissionMiddleware::class)->setName('main_pa_initialization/view-main_pa_initialization-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{id}]', MainPaInitializationController::class . ':edit')->add(PermissionMiddleware::class)->setName('main_pa_initialization/edit-main_pa_initialization-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{id}]', MainPaInitializationController::class . ':delete')->add(PermissionMiddleware::class)->setName('main_pa_initialization/delete-main_pa_initialization-delete-2'); // delete
        }
    );

    // main_pa_questions
    $app->map(["GET","POST","OPTIONS"], '/mainpaquestionslist[/{id}]', MainPaQuestionsController::class . ':list')->add(PermissionMiddleware::class)->setName('mainpaquestionslist-main_pa_questions-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/mainpaquestionsadd[/{id}]', MainPaQuestionsController::class . ':add')->add(PermissionMiddleware::class)->setName('mainpaquestionsadd-main_pa_questions-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/mainpaquestionsaddopt', MainPaQuestionsController::class . ':addopt')->add(PermissionMiddleware::class)->setName('mainpaquestionsaddopt-main_pa_questions-addopt'); // addopt
    $app->map(["GET","POST","OPTIONS"], '/mainpaquestionsview[/{id}]', MainPaQuestionsController::class . ':view')->add(PermissionMiddleware::class)->setName('mainpaquestionsview-main_pa_questions-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/mainpaquestionsedit[/{id}]', MainPaQuestionsController::class . ':edit')->add(PermissionMiddleware::class)->setName('mainpaquestionsedit-main_pa_questions-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/mainpaquestionsdelete[/{id}]', MainPaQuestionsController::class . ':delete')->add(PermissionMiddleware::class)->setName('mainpaquestionsdelete-main_pa_questions-delete'); // delete
    $app->group(
        '/main_pa_questions',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{id}]', MainPaQuestionsController::class . ':list')->add(PermissionMiddleware::class)->setName('main_pa_questions/list-main_pa_questions-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{id}]', MainPaQuestionsController::class . ':add')->add(PermissionMiddleware::class)->setName('main_pa_questions/add-main_pa_questions-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADDOPT_ACTION") . '', MainPaQuestionsController::class . ':addopt')->add(PermissionMiddleware::class)->setName('main_pa_questions/addopt-main_pa_questions-addopt-2'); // addopt
            $group->map(["GET","OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{id}]', MainPaQuestionsController::class . ':view')->add(PermissionMiddleware::class)->setName('main_pa_questions/view-main_pa_questions-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{id}]', MainPaQuestionsController::class . ':edit')->add(PermissionMiddleware::class)->setName('main_pa_questions/edit-main_pa_questions-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{id}]', MainPaQuestionsController::class . ':delete')->add(PermissionMiddleware::class)->setName('main_pa_questions/delete-main_pa_questions-delete-2'); // delete
        }
    );

    // main_pa_ratings
    $app->map(["GET","POST","OPTIONS"], '/mainparatingslist[/{id}]', MainPaRatingsController::class . ':list')->add(PermissionMiddleware::class)->setName('mainparatingslist-main_pa_ratings-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/mainparatingsadd[/{id}]', MainPaRatingsController::class . ':add')->add(PermissionMiddleware::class)->setName('mainparatingsadd-main_pa_ratings-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/mainparatingsview[/{id}]', MainPaRatingsController::class . ':view')->add(PermissionMiddleware::class)->setName('mainparatingsview-main_pa_ratings-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/mainparatingsedit[/{id}]', MainPaRatingsController::class . ':edit')->add(PermissionMiddleware::class)->setName('mainparatingsedit-main_pa_ratings-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/mainparatingsdelete[/{id}]', MainPaRatingsController::class . ':delete')->add(PermissionMiddleware::class)->setName('mainparatingsdelete-main_pa_ratings-delete'); // delete
    $app->group(
        '/main_pa_ratings',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{id}]', MainPaRatingsController::class . ':list')->add(PermissionMiddleware::class)->setName('main_pa_ratings/list-main_pa_ratings-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{id}]', MainPaRatingsController::class . ':add')->add(PermissionMiddleware::class)->setName('main_pa_ratings/add-main_pa_ratings-add-2'); // add
            $group->map(["GET","OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{id}]', MainPaRatingsController::class . ':view')->add(PermissionMiddleware::class)->setName('main_pa_ratings/view-main_pa_ratings-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{id}]', MainPaRatingsController::class . ':edit')->add(PermissionMiddleware::class)->setName('main_pa_ratings/edit-main_pa_ratings-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{id}]', MainPaRatingsController::class . ':delete')->add(PermissionMiddleware::class)->setName('main_pa_ratings/delete-main_pa_ratings-delete-2'); // delete
        }
    );

    // main_pa_score
    $app->map(["GET","POST","OPTIONS"], '/mainpascorelist[/{id}]', MainPaScoreController::class . ':list')->add(PermissionMiddleware::class)->setName('mainpascorelist-main_pa_score-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/mainpascoreadd[/{id}]', MainPaScoreController::class . ':add')->add(PermissionMiddleware::class)->setName('mainpascoreadd-main_pa_score-add'); // add
    $app->group(
        '/main_pa_score',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{id}]', MainPaScoreController::class . ':list')->add(PermissionMiddleware::class)->setName('main_pa_score/list-main_pa_score-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{id}]', MainPaScoreController::class . ':add')->add(PermissionMiddleware::class)->setName('main_pa_score/add-main_pa_score-add-2'); // add
        }
    );

    // main_users
    $app->map(["GET","POST","OPTIONS"], '/mainuserslist[/{id}]', MainUsersController::class . ':list')->add(PermissionMiddleware::class)->setName('mainuserslist-main_users-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/mainusersadd[/{id}]', MainUsersController::class . ':add')->add(PermissionMiddleware::class)->setName('mainusersadd-main_users-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/mainusersview[/{id}]', MainUsersController::class . ':view')->add(PermissionMiddleware::class)->setName('mainusersview-main_users-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/mainusersedit[/{id}]', MainUsersController::class . ':edit')->add(PermissionMiddleware::class)->setName('mainusersedit-main_users-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/mainusersdelete[/{id}]', MainUsersController::class . ':delete')->add(PermissionMiddleware::class)->setName('mainusersdelete-main_users-delete'); // delete
    $app->group(
        '/main_users',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{id}]', MainUsersController::class . ':list')->add(PermissionMiddleware::class)->setName('main_users/list-main_users-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{id}]', MainUsersController::class . ':add')->add(PermissionMiddleware::class)->setName('main_users/add-main_users-add-2'); // add
            $group->map(["GET","OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{id}]', MainUsersController::class . ':view')->add(PermissionMiddleware::class)->setName('main_users/view-main_users-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{id}]', MainUsersController::class . ':edit')->add(PermissionMiddleware::class)->setName('main_users/edit-main_users-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{id}]', MainUsersController::class . ':delete')->add(PermissionMiddleware::class)->setName('main_users/delete-main_users-delete-2'); // delete
        }
    );

    // userlevelpermissions
    $app->map(["GET","POST","OPTIONS"], '/userlevelpermissionslist[/{keys:.*}]', UserlevelpermissionsController::class . ':list')->add(PermissionMiddleware::class)->setName('userlevelpermissionslist-userlevelpermissions-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/userlevelpermissionsadd[/{keys:.*}]', UserlevelpermissionsController::class . ':add')->add(PermissionMiddleware::class)->setName('userlevelpermissionsadd-userlevelpermissions-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/userlevelpermissionsview[/{keys:.*}]', UserlevelpermissionsController::class . ':view')->add(PermissionMiddleware::class)->setName('userlevelpermissionsview-userlevelpermissions-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/userlevelpermissionsedit[/{keys:.*}]', UserlevelpermissionsController::class . ':edit')->add(PermissionMiddleware::class)->setName('userlevelpermissionsedit-userlevelpermissions-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/userlevelpermissionsdelete[/{keys:.*}]', UserlevelpermissionsController::class . ':delete')->add(PermissionMiddleware::class)->setName('userlevelpermissionsdelete-userlevelpermissions-delete'); // delete
    $app->group(
        '/userlevelpermissions',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{keys:.*}]', UserlevelpermissionsController::class . ':list')->add(PermissionMiddleware::class)->setName('userlevelpermissions/list-userlevelpermissions-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{keys:.*}]', UserlevelpermissionsController::class . ':add')->add(PermissionMiddleware::class)->setName('userlevelpermissions/add-userlevelpermissions-add-2'); // add
            $group->map(["GET","OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{keys:.*}]', UserlevelpermissionsController::class . ':view')->add(PermissionMiddleware::class)->setName('userlevelpermissions/view-userlevelpermissions-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{keys:.*}]', UserlevelpermissionsController::class . ':edit')->add(PermissionMiddleware::class)->setName('userlevelpermissions/edit-userlevelpermissions-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{keys:.*}]', UserlevelpermissionsController::class . ':delete')->add(PermissionMiddleware::class)->setName('userlevelpermissions/delete-userlevelpermissions-delete-2'); // delete
        }
    );

    // userlevels
    $app->map(["GET","POST","OPTIONS"], '/userlevelslist[/{userlevelid}]', UserlevelsController::class . ':list')->add(PermissionMiddleware::class)->setName('userlevelslist-userlevels-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/userlevelsadd[/{userlevelid}]', UserlevelsController::class . ':add')->add(PermissionMiddleware::class)->setName('userlevelsadd-userlevels-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/userlevelsview[/{userlevelid}]', UserlevelsController::class . ':view')->add(PermissionMiddleware::class)->setName('userlevelsview-userlevels-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/userlevelsedit[/{userlevelid}]', UserlevelsController::class . ':edit')->add(PermissionMiddleware::class)->setName('userlevelsedit-userlevels-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/userlevelsdelete[/{userlevelid}]', UserlevelsController::class . ':delete')->add(PermissionMiddleware::class)->setName('userlevelsdelete-userlevels-delete'); // delete
    $app->group(
        '/userlevels',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{userlevelid}]', UserlevelsController::class . ':list')->add(PermissionMiddleware::class)->setName('userlevels/list-userlevels-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{userlevelid}]', UserlevelsController::class . ':add')->add(PermissionMiddleware::class)->setName('userlevels/add-userlevels-add-2'); // add
            $group->map(["GET","OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{userlevelid}]', UserlevelsController::class . ':view')->add(PermissionMiddleware::class)->setName('userlevels/view-userlevels-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{userlevelid}]', UserlevelsController::class . ':edit')->add(PermissionMiddleware::class)->setName('userlevels/edit-userlevels-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{userlevelid}]', UserlevelsController::class . ':delete')->add(PermissionMiddleware::class)->setName('userlevels/delete-userlevels-delete-2'); // delete
        }
    );

    // main_group_pa_questions
    $app->map(["GET","POST","OPTIONS"], '/maingrouppaquestionslist[/{id}]', MainGroupPaQuestionsController::class . ':list')->add(PermissionMiddleware::class)->setName('maingrouppaquestionslist-main_group_pa_questions-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/maingrouppaquestionsadd[/{id}]', MainGroupPaQuestionsController::class . ':add')->add(PermissionMiddleware::class)->setName('maingrouppaquestionsadd-main_group_pa_questions-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/maingrouppaquestionsedit[/{id}]', MainGroupPaQuestionsController::class . ':edit')->add(PermissionMiddleware::class)->setName('maingrouppaquestionsedit-main_group_pa_questions-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/maingrouppaquestionsdelete[/{id}]', MainGroupPaQuestionsController::class . ':delete')->add(PermissionMiddleware::class)->setName('maingrouppaquestionsdelete-main_group_pa_questions-delete'); // delete
    $app->group(
        '/main_group_pa_questions',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{id}]', MainGroupPaQuestionsController::class . ':list')->add(PermissionMiddleware::class)->setName('main_group_pa_questions/list-main_group_pa_questions-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{id}]', MainGroupPaQuestionsController::class . ':add')->add(PermissionMiddleware::class)->setName('main_group_pa_questions/add-main_group_pa_questions-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{id}]', MainGroupPaQuestionsController::class . ':edit')->add(PermissionMiddleware::class)->setName('main_group_pa_questions/edit-main_group_pa_questions-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{id}]', MainGroupPaQuestionsController::class . ':delete')->add(PermissionMiddleware::class)->setName('main_group_pa_questions/delete-main_group_pa_questions-delete-2'); // delete
        }
    );

    // main_pa_group_manager
    $app->map(["GET","POST","OPTIONS"], '/mainpagroupmanagerlist[/{id}]', MainPaGroupManagerController::class . ':list')->add(PermissionMiddleware::class)->setName('mainpagroupmanagerlist-main_pa_group_manager-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/mainpagroupmanageradd[/{id}]', MainPaGroupManagerController::class . ':add')->add(PermissionMiddleware::class)->setName('mainpagroupmanageradd-main_pa_group_manager-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/mainpagroupmanagerview[/{id}]', MainPaGroupManagerController::class . ':view')->add(PermissionMiddleware::class)->setName('mainpagroupmanagerview-main_pa_group_manager-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/mainpagroupmanageredit[/{id}]', MainPaGroupManagerController::class . ':edit')->add(PermissionMiddleware::class)->setName('mainpagroupmanageredit-main_pa_group_manager-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/mainpagroupmanagerdelete[/{id}]', MainPaGroupManagerController::class . ':delete')->add(PermissionMiddleware::class)->setName('mainpagroupmanagerdelete-main_pa_group_manager-delete'); // delete
    $app->group(
        '/main_pa_group_manager',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{id}]', MainPaGroupManagerController::class . ':list')->add(PermissionMiddleware::class)->setName('main_pa_group_manager/list-main_pa_group_manager-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{id}]', MainPaGroupManagerController::class . ':add')->add(PermissionMiddleware::class)->setName('main_pa_group_manager/add-main_pa_group_manager-add-2'); // add
            $group->map(["GET","OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{id}]', MainPaGroupManagerController::class . ':view')->add(PermissionMiddleware::class)->setName('main_pa_group_manager/view-main_pa_group_manager-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{id}]', MainPaGroupManagerController::class . ':edit')->add(PermissionMiddleware::class)->setName('main_pa_group_manager/edit-main_pa_group_manager-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{id}]', MainPaGroupManagerController::class . ':delete')->add(PermissionMiddleware::class)->setName('main_pa_group_manager/delete-main_pa_group_manager-delete-2'); // delete
        }
    );

    // employee_appraisal
    $app->map(["GET", "POST", "OPTIONS"], '/employeeappraisal[/{params:.*}]', EmployeeAppraisalController::class)->add(PermissionMiddleware::class)->setName('employeeappraisal-employee_appraisal-custom'); // custom

    // line_manager_one_appraisal
    $app->map(["GET", "POST", "OPTIONS"], '/linemanageroneappraisal[/{params:.*}]', LineManagerOneAppraisalController::class)->add(PermissionMiddleware::class)->setName('linemanageroneappraisal-line_manager_one_appraisal-custom'); // custom

    // appraisal_ratings
    $app->map(["GET","POST","OPTIONS"], '/appraisalratingslist', AppraisalRatingsController::class . ':list')->add(PermissionMiddleware::class)->setName('appraisalratingslist-appraisal_ratings-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/appraisalratingsadd', AppraisalRatingsController::class . ':add')->add(PermissionMiddleware::class)->setName('appraisalratingsadd-appraisal_ratings-add'); // add
    $app->group(
        '/appraisal_ratings',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '', AppraisalRatingsController::class . ':list')->add(PermissionMiddleware::class)->setName('appraisal_ratings/list-appraisal_ratings-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '', AppraisalRatingsController::class . ':add')->add(PermissionMiddleware::class)->setName('appraisal_ratings/add-appraisal_ratings-add-2'); // add
        }
    );

    // message_templates
    $app->map(["GET","POST","OPTIONS"], '/messagetemplateslist[/{id}]', MessageTemplatesController::class . ':list')->add(PermissionMiddleware::class)->setName('messagetemplateslist-message_templates-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/messagetemplatesadd[/{id}]', MessageTemplatesController::class . ':add')->add(PermissionMiddleware::class)->setName('messagetemplatesadd-message_templates-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/messagetemplatesview[/{id}]', MessageTemplatesController::class . ':view')->add(PermissionMiddleware::class)->setName('messagetemplatesview-message_templates-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/messagetemplatesedit[/{id}]', MessageTemplatesController::class . ':edit')->add(PermissionMiddleware::class)->setName('messagetemplatesedit-message_templates-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/messagetemplatesdelete[/{id}]', MessageTemplatesController::class . ':delete')->add(PermissionMiddleware::class)->setName('messagetemplatesdelete-message_templates-delete'); // delete
    $app->group(
        '/message_templates',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{id}]', MessageTemplatesController::class . ':list')->add(PermissionMiddleware::class)->setName('message_templates/list-message_templates-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{id}]', MessageTemplatesController::class . ':add')->add(PermissionMiddleware::class)->setName('message_templates/add-message_templates-add-2'); // add
            $group->map(["GET","OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{id}]', MessageTemplatesController::class . ':view')->add(PermissionMiddleware::class)->setName('message_templates/view-message_templates-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{id}]', MessageTemplatesController::class . ':edit')->add(PermissionMiddleware::class)->setName('message_templates/edit-message_templates-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{id}]', MessageTemplatesController::class . ':delete')->add(PermissionMiddleware::class)->setName('message_templates/delete-message_templates-delete-2'); // delete
        }
    );

    // line_manager_two_appraisal
    $app->map(["GET", "POST", "OPTIONS"], '/linemanagertwoappraisal[/{params:.*}]', LineManagerTwoAppraisalController::class)->add(PermissionMiddleware::class)->setName('linemanagertwoappraisal-line_manager_two_appraisal-custom'); // custom

    // appraisal_report
    $app->map(["GET", "POST", "OPTIONS"], '/appraisalreport[/{params:.*}]', AppraisalReportController::class)->add(PermissionMiddleware::class)->setName('appraisalreport-appraisal_report-custom'); // custom

    // pending_appraisal_ratings
    $app->map(["GET","POST","OPTIONS"], '/pendingappraisalratingslist', PendingAppraisalRatingsController::class . ':list')->add(PermissionMiddleware::class)->setName('pendingappraisalratingslist-pending_appraisal_ratings-list'); // list
    $app->group(
        '/pending_appraisal_ratings',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '', PendingAppraisalRatingsController::class . ':list')->add(PermissionMiddleware::class)->setName('pending_appraisal_ratings/list-pending_appraisal_ratings-list-2'); // list
        }
    );

    // pending_l2_appraisal
    $app->map(["GET","POST","OPTIONS"], '/pendingl2appraisallist', PendingL2AppraisalController::class . ':list')->add(PermissionMiddleware::class)->setName('pendingl2appraisallist-pending_l2_appraisal-list'); // list
    $app->group(
        '/pending_l2_appraisal',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '', PendingL2AppraisalController::class . ':list')->add(PermissionMiddleware::class)->setName('pending_l2_appraisal/list-pending_l2_appraisal-list-2'); // list
        }
    );

    // update_appraisal
    $app->map(["GET", "POST", "OPTIONS"], '/updateappraisal[/{params:.*}]', UpdateAppraisalController::class)->add(PermissionMiddleware::class)->setName('updateappraisal-update_appraisal-custom'); // custom

    // error
    $app->map(["GET","POST","OPTIONS"], '/error', OthersController::class . ':error')->add(PermissionMiddleware::class)->setName('error');

    // personal_data
    $app->map(["GET","POST","OPTIONS"], '/personaldata', OthersController::class . ':personaldata')->add(PermissionMiddleware::class)->setName('personaldata');

    // login
    $app->map(["GET","POST","OPTIONS"], '/login', OthersController::class . ':login')->add(PermissionMiddleware::class)->setName('login');

    // reset_password
    $app->map(["GET","POST","OPTIONS"], '/resetpassword', OthersController::class . ':resetpassword')->add(PermissionMiddleware::class)->setName('resetpassword');

    // change_password
    $app->map(["GET","POST","OPTIONS"], '/changepassword', OthersController::class . ':changepassword')->add(PermissionMiddleware::class)->setName('changepassword');

    // userpriv
    $app->map(["GET","POST","OPTIONS"], '/userpriv', OthersController::class . ':userpriv')->add(PermissionMiddleware::class)->setName('userpriv');

    // logout
    $app->map(["GET","POST","OPTIONS"], '/logout', OthersController::class . ':logout')->add(PermissionMiddleware::class)->setName('logout');

    // Swagger
    $app->get('/' . Config("SWAGGER_ACTION"), OthersController::class . ':swagger')->setName(Config("SWAGGER_ACTION")); // Swagger

    // Index
    $app->get('/[index]', OthersController::class . ':index')->add(PermissionMiddleware::class)->setName('index');

    // Route Action event
    if (function_exists(PROJECT_NAMESPACE . "Route_Action")) {
        Route_Action($app);
    }

    /**
     * Catch-all route to serve a 404 Not Found page if none of the routes match
     * NOTE: Make sure this route is defined last.
     */
    $app->map(
        ['GET', 'POST', 'PUT', 'DELETE', 'PATCH'],
        '/{routes:.+}',
        function ($request, $response, $params) {
            $error = [
                "statusCode" => "404",
                "error" => [
                    "class" => "text-warning",
                    "type" => Container("language")->phrase("Error"),
                    "description" => str_replace("%p", $params["routes"], Container("language")->phrase("PageNotFound")),
                ],
            ];
            Container("flash")->addMessage("error", $error);
            return $response->withStatus(302)->withHeader("Location", GetUrl("error")); // Redirect to error page
        }
    );
};
