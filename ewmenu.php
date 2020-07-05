<?php
namespace PHPMaker2020\project1;

// Menu Language
if ($Language && function_exists(PROJECT_NAMESPACE . "Config") && $Language->LanguageFolder == Config("LANGUAGE_FOLDER")) {
	$MenuRelativePath = "";
	$MenuLanguage = &$Language;
} else { // Compat reports
	$LANGUAGE_FOLDER = "../lang/";
	$MenuRelativePath = "../";
	$MenuLanguage = new Language();
}

// Navbar menu
$topMenu = new Menu("navbar", TRUE, TRUE);
$topMenu->addMenuItem(15, "mi_c_dashboard", $MenuLanguage->MenuPhrase("15", "MenuText"), $MenuRelativePath . "c_dashboard.php", -1, "", TRUE, FALSE, FALSE, "", "", TRUE);
$topMenu->addMenuItem(13, "mci_Setup", $MenuLanguage->MenuPhrase("13", "MenuText"), "", -1, "", TRUE, FALSE, TRUE, "", "", TRUE);
$topMenu->addMenuItem(19, "mi_t_parameter", $MenuLanguage->MenuPhrase("19", "MenuText"), $MenuRelativePath . "t_parameterlist.php", 13, "", TRUE, FALSE, FALSE, "", "", TRUE);
$topMenu->addMenuItem(17, "mi_t_operator", $MenuLanguage->MenuPhrase("17", "MenuText"), $MenuRelativePath . "t_operatorlist.php", 13, "", TRUE, FALSE, FALSE, "", "", TRUE);
$topMenu->addMenuItem(2, "mi_t_kapal0", $MenuLanguage->MenuPhrase("2", "MenuText"), $MenuRelativePath . "t_kapal0list.php", 13, "", TRUE, FALSE, FALSE, "", "", TRUE);
$topMenu->addMenuItem(5, "mi_t_source", $MenuLanguage->MenuPhrase("5", "MenuText"), $MenuRelativePath . "t_sourcelist.php", 13, "", TRUE, FALSE, FALSE, "", "", TRUE);
$topMenu->addMenuItem(3, "mi_t_destination", $MenuLanguage->MenuPhrase("3", "MenuText"), $MenuRelativePath . "t_destinationlist.php", 13, "", TRUE, FALSE, FALSE, "", "", TRUE);
$topMenu->addMenuItem(4, "mi_t_distribusi", $MenuLanguage->MenuPhrase("4", "MenuText"), $MenuRelativePath . "t_distribusilist.php", 13, "", TRUE, FALSE, FALSE, "", "", TRUE);
$topMenu->addMenuItem(9, "mi_input", $MenuLanguage->MenuPhrase("9", "MenuText"), $MenuRelativePath . "input.php", -1, "", TRUE, FALSE, FALSE, "", "", TRUE);
$topMenu->addMenuItem(20, "mi_Report1", $MenuLanguage->MenuPhrase("20", "MenuText"), $MenuRelativePath . "Report1smry.php", -1, "", TRUE, FALSE, FALSE, "", "", TRUE);
echo $topMenu->toScript();

// Sidebar menu
$sideMenu = new Menu("menu", TRUE, FALSE);
$sideMenu->addMenuItem(15, "mi_c_dashboard", $MenuLanguage->MenuPhrase("15", "MenuText"), $MenuRelativePath . "c_dashboard.php", -1, "", TRUE, FALSE, FALSE, "", "", TRUE);
$sideMenu->addMenuItem(13, "mci_Setup", $MenuLanguage->MenuPhrase("13", "MenuText"), "", -1, "", TRUE, FALSE, TRUE, "", "", TRUE);
$sideMenu->addMenuItem(19, "mi_t_parameter", $MenuLanguage->MenuPhrase("19", "MenuText"), $MenuRelativePath . "t_parameterlist.php", 13, "", TRUE, FALSE, FALSE, "", "", TRUE);
$sideMenu->addMenuItem(17, "mi_t_operator", $MenuLanguage->MenuPhrase("17", "MenuText"), $MenuRelativePath . "t_operatorlist.php", 13, "", TRUE, FALSE, FALSE, "", "", TRUE);
$sideMenu->addMenuItem(2, "mi_t_kapal0", $MenuLanguage->MenuPhrase("2", "MenuText"), $MenuRelativePath . "t_kapal0list.php", 13, "", TRUE, FALSE, FALSE, "", "", TRUE);
$sideMenu->addMenuItem(5, "mi_t_source", $MenuLanguage->MenuPhrase("5", "MenuText"), $MenuRelativePath . "t_sourcelist.php", 13, "", TRUE, FALSE, FALSE, "", "", TRUE);
$sideMenu->addMenuItem(3, "mi_t_destination", $MenuLanguage->MenuPhrase("3", "MenuText"), $MenuRelativePath . "t_destinationlist.php", 13, "", TRUE, FALSE, FALSE, "", "", TRUE);
$sideMenu->addMenuItem(4, "mi_t_distribusi", $MenuLanguage->MenuPhrase("4", "MenuText"), $MenuRelativePath . "t_distribusilist.php", 13, "", TRUE, FALSE, FALSE, "", "", TRUE);
$sideMenu->addMenuItem(9, "mi_input", $MenuLanguage->MenuPhrase("9", "MenuText"), $MenuRelativePath . "input.php", -1, "", TRUE, FALSE, FALSE, "", "", TRUE);
$sideMenu->addMenuItem(20, "mi_Report1", $MenuLanguage->MenuPhrase("20", "MenuText"), $MenuRelativePath . "Report1smry.php", -1, "", TRUE, FALSE, FALSE, "", "", TRUE);
echo $sideMenu->toScript();
?>