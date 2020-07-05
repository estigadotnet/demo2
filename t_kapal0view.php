<?php
namespace PHPMaker2020\project1;

// Autoload
include_once "autoload.php";

// Session
if (session_status() !== PHP_SESSION_ACTIVE)
	\Delight\Cookie\Session::start(Config("COOKIE_SAMESITE")); // Init session data

// Output buffering
ob_start();
?>
<?php

// Write header
WriteHeader(FALSE);

// Create page object
$t_kapal0_view = new t_kapal0_view();

// Run the page
$t_kapal0_view->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_kapal0_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$t_kapal0_view->isExport()) { ?>
<script>
var ft_kapal0view, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	ft_kapal0view = currentForm = new ew.Form("ft_kapal0view", "view");
	loadjs.done("ft_kapal0view");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$t_kapal0_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $t_kapal0_view->ExportOptions->render("body") ?>
<?php $t_kapal0_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $t_kapal0_view->showPageHeader(); ?>
<?php
$t_kapal0_view->showMessage();
?>
<form name="ft_kapal0view" id="ft_kapal0view" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_kapal0">
<input type="hidden" name="modal" value="<?php echo (int)$t_kapal0_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($t_kapal0_view->Nama->Visible) { // Nama ?>
	<tr id="r_Nama">
		<td class="<?php echo $t_kapal0_view->TableLeftColumnClass ?>"><span id="elh_t_kapal0_Nama"><?php echo $t_kapal0_view->Nama->caption() ?></span></td>
		<td data-name="Nama" <?php echo $t_kapal0_view->Nama->cellAttributes() ?>>
<span id="el_t_kapal0_Nama">
<span<?php echo $t_kapal0_view->Nama->viewAttributes() ?>><?php echo $t_kapal0_view->Nama->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$t_kapal0_view->IsModal) { ?>
<?php if (!$t_kapal0_view->isExport()) { ?>
<?php echo $t_kapal0_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
<?php
	if (in_array("t_kapal", explode(",", $t_kapal0->getCurrentDetailTable())) && $t_kapal->DetailView) {
?>
<?php if ($t_kapal0->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("t_kapal", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "t_kapalgrid.php" ?>
<?php } ?>
</form>
<?php
$t_kapal0_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$t_kapal0_view->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php include_once "footer.php"; ?>
<?php
$t_kapal0_view->terminate();
?>