<?php

namespace PHPMaker2022\wfg_appraisal;

// Menu Language
if ($Language && function_exists(PROJECT_NAMESPACE . "Config") && $Language->LanguageFolder == Config("LANGUAGE_FOLDER")) {
    $MenuRelativePath = "";
    $MenuLanguage = &$Language;
} else { // Compat reports
    $LANGUAGE_FOLDER = "../lang/";
    $MenuRelativePath = "../";
    $MenuLanguage = Container("language");
}

// Navbar menu
$topMenu = new Menu("navbar", true, true);
echo $topMenu->toScript();

// Sidebar menu
$sideMenu = new Menu("menu", true, false);
$sideMenu->addMenuItem(62, "mi_pending_appraisal_ratings", $MenuLanguage->MenuPhrase("62", "MenuText"), $MenuRelativePath . "pendingappraisalratingslist", -1, "", AllowListMenu('{253C54E3-FFFF-4F64-9A03-15AE59013125}pending_appraisal_ratings'), false, false, "", "", false);
$sideMenu->addMenuItem(63, "mi_pending_l2_appraisal", $MenuLanguage->MenuPhrase("63", "MenuText"), $MenuRelativePath . "pendingl2appraisallist", -1, "", AllowListMenu('{253C54E3-FFFF-4F64-9A03-15AE59013125}pending_l2_appraisal'), false, false, "", "", false);
$sideMenu->addMenuItem(64, "mi_update_appraisal", $MenuLanguage->MenuPhrase("64", "MenuText"), $MenuRelativePath . "updateappraisal", -1, "", AllowListMenu('{253C54E3-FFFF-4F64-9A03-15AE59013125}update_appraisal.php'), false, false, "", "", false);
$sideMenu->addMenuItem(21, "mci_Settings", $MenuLanguage->MenuPhrase("21", "MenuText"), "", -1, "", IsLoggedIn(), false, true, "", "", false);
$sideMenu->addMenuItem(14, "mi_main_users", $MenuLanguage->MenuPhrase("14", "MenuText"), $MenuRelativePath . "mainuserslist", 21, "", AllowListMenu('{253C54E3-FFFF-4F64-9A03-15AE59013125}main_users'), false, false, "", "", false);
$sideMenu->addMenuItem(1, "mi_main_businessunits", $MenuLanguage->MenuPhrase("1", "MenuText"), $MenuRelativePath . "mainbusinessunitslist", 21, "", AllowListMenu('{253C54E3-FFFF-4F64-9A03-15AE59013125}main_businessunits'), false, false, "", "", false);
$sideMenu->addMenuItem(7, "mi_main_pa_groups", $MenuLanguage->MenuPhrase("7", "MenuText"), $MenuRelativePath . "mainpagroupslist", 21, "", AllowListMenu('{253C54E3-FFFF-4F64-9A03-15AE59013125}main_pa_groups'), false, false, "", "", false);
$sideMenu->addMenuItem(8, "mi_main_pa_groups_employees", $MenuLanguage->MenuPhrase("8", "MenuText"), $MenuRelativePath . "mainpagroupsemployeeslist?cmd=resetall", 21, "", AllowListMenu('{253C54E3-FFFF-4F64-9A03-15AE59013125}main_pa_groups_employees'), false, false, "", "", false);
$sideMenu->addMenuItem(20, "mi_main_pa_group_manager", $MenuLanguage->MenuPhrase("20", "MenuText"), $MenuRelativePath . "mainpagroupmanagerlist", 21, "", AllowListMenu('{253C54E3-FFFF-4F64-9A03-15AE59013125}main_pa_group_manager'), false, false, "", "", false);
$sideMenu->addMenuItem(17, "mi_userlevels", $MenuLanguage->MenuPhrase("17", "MenuText"), $MenuRelativePath . "userlevelslist", 21, "", AllowListMenu('{253C54E3-FFFF-4F64-9A03-15AE59013125}userlevels'), false, false, "", "", false);
$sideMenu->addMenuItem(59, "mi_message_templates", $MenuLanguage->MenuPhrase("59", "MenuText"), $MenuRelativePath . "messagetemplateslist", 21, "", AllowListMenu('{253C54E3-FFFF-4F64-9A03-15AE59013125}message_templates'), false, false, "", "", false);
$sideMenu->addMenuItem(22, "mci_Appraisal", $MenuLanguage->MenuPhrase("22", "MenuText"), "", -1, "", true, false, true, "", "", false);
$sideMenu->addMenuItem(58, "mi_appraisal_ratings", $MenuLanguage->MenuPhrase("58", "MenuText"), $MenuRelativePath . "appraisalratingslist", 22, "", AllowListMenu('{253C54E3-FFFF-4F64-9A03-15AE59013125}appraisal_ratings'), false, false, "", "", false);
$sideMenu->addMenuItem(10, "mi_main_pa_initialization", $MenuLanguage->MenuPhrase("10", "MenuText"), $MenuRelativePath . "mainpainitializationlist", 22, "", AllowListMenu('{253C54E3-FFFF-4F64-9A03-15AE59013125}main_pa_initialization'), false, false, "", "", false);
$sideMenu->addMenuItem(5, "mi_main_pa_employee_ratings", $MenuLanguage->MenuPhrase("5", "MenuText"), $MenuRelativePath . "mainpaemployeeratingslist", 22, "", AllowListMenu('{253C54E3-FFFF-4F64-9A03-15AE59013125}main_pa_employee_ratings'), false, false, "", "", false);
$sideMenu->addMenuItem(23, "mci_Questions", $MenuLanguage->MenuPhrase("23", "MenuText"), "", -1, "", true, false, true, "", "", false);
$sideMenu->addMenuItem(11, "mi_main_pa_questions", $MenuLanguage->MenuPhrase("11", "MenuText"), $MenuRelativePath . "mainpaquestionslist", 23, "", AllowListMenu('{253C54E3-FFFF-4F64-9A03-15AE59013125}main_pa_questions'), false, false, "", "", false);
echo $sideMenu->toScript();
