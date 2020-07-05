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
$t_parameter_view = new t_parameter_view();

// Run the page
$t_parameter_view->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_parameter_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$t_parameter_view->isExport()) { ?>
<script>
var ft_parameterview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	ft_parameterview = currentForm = new ew.Form("ft_parameterview", "view");
	loadjs.done("ft_parameterview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$t_parameter_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $t_parameter_view->ExportOptions->render("body") ?>
<?php $t_parameter_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $t_parameter_view->showPageHeader(); ?>
<?php
$t_parameter_view->showMessage();
?>
<form name="ft_parameterview" id="ft_parameterview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_parameter">
<input type="hidden" name="modal" value="<?php echo (int)$t_parameter_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($t_parameter_view->Parameter->Visible) { // Parameter ?>
	<tr id="r_Parameter">
		<td class="<?php echo $t_parameter_view->TableLeftColumnClass ?>"><span id="elh_t_parameter_Parameter"><?php echo $t_parameter_view->Parameter->caption() ?></span></td>
		<td data-name="Parameter" <?php echo $t_parameter_view->Parameter->cellAttributes() ?>>
<span id="el_t_parameter_Parameter">
<span<?php echo $t_parameter_view->Parameter->viewAttributes() ?>><?php echo $t_parameter_view->Parameter->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_parameter_view->Nilai->Visible) { // Nilai ?>
	<tr id="r_Nilai">
		<td class="<?php echo $t_parameter_view->TableLeftColumnClass ?>"><span id="elh_t_parameter_Nilai"><?php echo $t_parameter_view->Nilai->caption() ?></span></td>
		<td data-name="Nilai" <?php echo $t_parameter_view->Nilai->cellAttributes() ?>>
<span id="el_t_parameter_Nilai">
<span<?php echo $t_parameter_view->Nilai->viewAttributes() ?>><?php echo $t_parameter_view->Nilai->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$t_parameter_view->IsModal) { ?>
<?php if (!$t_parameter_view->isExport()) { ?>
<?php echo $t_parameter_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$t_parameter_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$t_parameter_view->isExport()) { ?>
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
$t_parameter_view->terminate();
?>