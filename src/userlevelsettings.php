<?php
/**
 * PHPMaker 2022 user level settings
 */
namespace PHPMaker2022\wfg_appraisal;

// User level info
$USER_LEVELS = [["-2","Anonymous"],
    ["0","Default"]];
// User level priv info
$USER_LEVEL_PRIVS = [["{253C54E3-FFFF-4F64-9A03-15AE59013125}main_businessunits","-2","0"],
    ["{253C54E3-FFFF-4F64-9A03-15AE59013125}main_businessunits","0","0"],
    ["{253C54E3-FFFF-4F64-9A03-15AE59013125}main_pa_appraisalhistory","-2","0"],
    ["{253C54E3-FFFF-4F64-9A03-15AE59013125}main_pa_appraisalhistory","0","0"],
    ["{253C54E3-FFFF-4F64-9A03-15AE59013125}main_pa_category","-2","0"],
    ["{253C54E3-FFFF-4F64-9A03-15AE59013125}main_pa_category","0","0"],
    ["{253C54E3-FFFF-4F64-9A03-15AE59013125}main_pa_employee_rating_breakdown","-2","0"],
    ["{253C54E3-FFFF-4F64-9A03-15AE59013125}main_pa_employee_rating_breakdown","0","0"],
    ["{253C54E3-FFFF-4F64-9A03-15AE59013125}main_pa_employee_ratings","-2","0"],
    ["{253C54E3-FFFF-4F64-9A03-15AE59013125}main_pa_employee_ratings","0","0"],
    ["{253C54E3-FFFF-4F64-9A03-15AE59013125}main_pa_employee_response","-2","0"],
    ["{253C54E3-FFFF-4F64-9A03-15AE59013125}main_pa_employee_response","0","0"],
    ["{253C54E3-FFFF-4F64-9A03-15AE59013125}main_pa_groups","-2","0"],
    ["{253C54E3-FFFF-4F64-9A03-15AE59013125}main_pa_groups","0","0"],
    ["{253C54E3-FFFF-4F64-9A03-15AE59013125}main_pa_groups_employees","-2","0"],
    ["{253C54E3-FFFF-4F64-9A03-15AE59013125}main_pa_groups_employees","0","0"],
    ["{253C54E3-FFFF-4F64-9A03-15AE59013125}main_pa_implementation","-2","0"],
    ["{253C54E3-FFFF-4F64-9A03-15AE59013125}main_pa_implementation","0","0"],
    ["{253C54E3-FFFF-4F64-9A03-15AE59013125}main_pa_initialization","-2","0"],
    ["{253C54E3-FFFF-4F64-9A03-15AE59013125}main_pa_initialization","0","0"],
    ["{253C54E3-FFFF-4F64-9A03-15AE59013125}main_pa_questions","-2","0"],
    ["{253C54E3-FFFF-4F64-9A03-15AE59013125}main_pa_questions","0","0"],
    ["{253C54E3-FFFF-4F64-9A03-15AE59013125}main_pa_ratings","-2","0"],
    ["{253C54E3-FFFF-4F64-9A03-15AE59013125}main_pa_ratings","0","0"],
    ["{253C54E3-FFFF-4F64-9A03-15AE59013125}main_pa_score","-2","0"],
    ["{253C54E3-FFFF-4F64-9A03-15AE59013125}main_pa_score","0","0"],
    ["{253C54E3-FFFF-4F64-9A03-15AE59013125}main_users","-2","0"],
    ["{253C54E3-FFFF-4F64-9A03-15AE59013125}main_users","0","0"],
    ["{253C54E3-FFFF-4F64-9A03-15AE59013125}users","-2","0"],
    ["{253C54E3-FFFF-4F64-9A03-15AE59013125}users","0","0"],
    ["{253C54E3-FFFF-4F64-9A03-15AE59013125}userlevelpermissions","-2","0"],
    ["{253C54E3-FFFF-4F64-9A03-15AE59013125}userlevelpermissions","0","0"],
    ["{253C54E3-FFFF-4F64-9A03-15AE59013125}userlevels","-2","0"],
    ["{253C54E3-FFFF-4F64-9A03-15AE59013125}userlevels","0","0"],
    ["{253C54E3-FFFF-4F64-9A03-15AE59013125}main_group_pa_questions","-2","0"],
    ["{253C54E3-FFFF-4F64-9A03-15AE59013125}main_group_pa_questions","0","0"],
    ["{253C54E3-FFFF-4F64-9A03-15AE59013125}main_pa_group_manager","-2","0"],
    ["{253C54E3-FFFF-4F64-9A03-15AE59013125}main_pa_group_manager","0","0"],
    ["{253C54E3-FFFF-4F64-9A03-15AE59013125}employee_appraisal.php","-2","495"],
    ["{253C54E3-FFFF-4F64-9A03-15AE59013125}employee_appraisal.php","0","495"],
    ["{253C54E3-FFFF-4F64-9A03-15AE59013125}permissions","-2","0"],
    ["{253C54E3-FFFF-4F64-9A03-15AE59013125}permissions","0","0"],
    ["{253C54E3-FFFF-4F64-9A03-15AE59013125}line_manager_one_appraisal.php","-2","495"],
    ["{253C54E3-FFFF-4F64-9A03-15AE59013125}line_manager_one_appraisal.php","0","495"],
    ["{253C54E3-FFFF-4F64-9A03-15AE59013125}appraisal_ratings","-2","0"],
    ["{253C54E3-FFFF-4F64-9A03-15AE59013125}appraisal_ratings","0","0"],
    ["{253C54E3-FFFF-4F64-9A03-15AE59013125}message_templates","-2","0"],
    ["{253C54E3-FFFF-4F64-9A03-15AE59013125}message_templates","0","0"],
    ["{253C54E3-FFFF-4F64-9A03-15AE59013125}line_manager_two_appraisal.php","-2","495"],
    ["{253C54E3-FFFF-4F64-9A03-15AE59013125}line_manager_two_appraisal.php","0","495"],
    ["{253C54E3-FFFF-4F64-9A03-15AE59013125}appraisal_report.php","-2","0"],
    ["{253C54E3-FFFF-4F64-9A03-15AE59013125}appraisal_report.php","0","0"],
    ["{253C54E3-FFFF-4F64-9A03-15AE59013125}pending_appraisal_ratings","-2","0"],
    ["{253C54E3-FFFF-4F64-9A03-15AE59013125}pending_appraisal_ratings","0","0"],
    ["{253C54E3-FFFF-4F64-9A03-15AE59013125}pending_l2_appraisal","-2","0"],
    ["{253C54E3-FFFF-4F64-9A03-15AE59013125}pending_l2_appraisal","0","0"],
    ["{253C54E3-FFFF-4F64-9A03-15AE59013125}update_appraisal.php","-2","0"],
    ["{253C54E3-FFFF-4F64-9A03-15AE59013125}update_appraisal.php","0","0"]];
// User level table info
$USER_LEVEL_TABLES = [["main_businessunits","main_businessunits","Business Units",true,"{253C54E3-FFFF-4F64-9A03-15AE59013125}","mainbusinessunitslist"],
    ["main_pa_appraisalhistory","main_pa_appraisalhistory","Appraisal History",true,"{253C54E3-FFFF-4F64-9A03-15AE59013125}","mainpaappraisalhistorylist"],
    ["main_pa_category","main_pa_category","Appraisal Category",true,"{253C54E3-FFFF-4F64-9A03-15AE59013125}",""],
    ["main_pa_employee_rating_breakdown","main_pa_employee_rating_breakdown","main pa employee rating breakdown",true,"{253C54E3-FFFF-4F64-9A03-15AE59013125}",""],
    ["main_pa_employee_ratings","main_pa_employee_ratings","Employee Ratings",true,"{253C54E3-FFFF-4F64-9A03-15AE59013125}","mainpaemployeeratingslist"],
    ["main_pa_employee_response","main_pa_employee_response","Employee Response",true,"{253C54E3-FFFF-4F64-9A03-15AE59013125}","mainpaemployeeresponselist"],
    ["main_pa_groups","main_pa_groups","Appraisal Groups",true,"{253C54E3-FFFF-4F64-9A03-15AE59013125}","mainpagroupslist"],
    ["main_pa_groups_employees","main_pa_groups_employees","Appraisal Group Employees",true,"{253C54E3-FFFF-4F64-9A03-15AE59013125}","mainpagroupsemployeeslist"],
    ["main_pa_implementation","main_pa_implementation","main pa implementation",true,"{253C54E3-FFFF-4F64-9A03-15AE59013125}",""],
    ["main_pa_initialization","main_pa_initialization","Appraisal Initialization",true,"{253C54E3-FFFF-4F64-9A03-15AE59013125}","mainpainitializationlist"],
    ["main_pa_questions","main_pa_questions","Appraisal Questions",true,"{253C54E3-FFFF-4F64-9A03-15AE59013125}","mainpaquestionslist"],
    ["main_pa_ratings","main_pa_ratings","Appraisal Ratings",true,"{253C54E3-FFFF-4F64-9A03-15AE59013125}","mainparatingslist"],
    ["main_pa_score","main_pa_score","Appraisal Score",true,"{253C54E3-FFFF-4F64-9A03-15AE59013125}","mainpascorelist"],
    ["main_users","main_users","Employees",true,"{253C54E3-FFFF-4F64-9A03-15AE59013125}","mainuserslist"],
    ["users","users","users",true,"{253C54E3-FFFF-4F64-9A03-15AE59013125}",""],
    ["userlevelpermissions","userlevelpermissions","userlevelpermissions",true,"{253C54E3-FFFF-4F64-9A03-15AE59013125}","userlevelpermissionslist"],
    ["userlevels","userlevels","userlevels",true,"{253C54E3-FFFF-4F64-9A03-15AE59013125}","userlevelslist"],
    ["main_group_pa_questions","main_group_pa_questions","Group Appraisal Questions",true,"{253C54E3-FFFF-4F64-9A03-15AE59013125}","maingrouppaquestionslist"],
    ["main_pa_group_manager","main_pa_group_manager","Group Line Manager",true,"{253C54E3-FFFF-4F64-9A03-15AE59013125}","mainpagroupmanagerlist"],
    ["employee_appraisal.php","employee_appraisal","Employee Appraisal",true,"{253C54E3-FFFF-4F64-9A03-15AE59013125}","employeeappraisal"],
    ["permissions","permissions2","permissions",true,"{253C54E3-FFFF-4F64-9A03-15AE59013125}",""],
    ["line_manager_one_appraisal.php","line_manager_one_appraisal","Line Manager One Appraisal",true,"{253C54E3-FFFF-4F64-9A03-15AE59013125}","linemanageroneappraisal"],
    ["appraisal_ratings","appraisal_ratings","Appraisal Ratings",true,"{253C54E3-FFFF-4F64-9A03-15AE59013125}","appraisalratingslist"],
    ["message_templates","message_templates","Message Templates",true,"{253C54E3-FFFF-4F64-9A03-15AE59013125}","messagetemplateslist"],
    ["line_manager_two_appraisal.php","line_manager_two_appraisal","Line Manager Two Appraisal",true,"{253C54E3-FFFF-4F64-9A03-15AE59013125}","linemanagertwoappraisal"],
    ["appraisal_report.php","appraisal_report","Appraisal Report",true,"{253C54E3-FFFF-4F64-9A03-15AE59013125}","appraisalreport"],
    ["pending_appraisal_ratings","pending_appraisal_ratings","Pending Line Maneger One Appraisal",true,"{253C54E3-FFFF-4F64-9A03-15AE59013125}","pendingappraisalratingslist"],
    ["pending_l2_appraisal","pending_l2_appraisal","Pending Line Maneger Two Appraisal",true,"{253C54E3-FFFF-4F64-9A03-15AE59013125}","pendingl2appraisallist"],
    ["update_appraisal.php","update_appraisal","Update Appraisal",true,"{253C54E3-FFFF-4F64-9A03-15AE59013125}","updateappraisal"]];
