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
$t_kapal_view = new t_kapal_view();

// Run the page
$t_kapal_view->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_kapal_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$t_kapal_view->isExport()) { ?>
<script>
var ft_kapalview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	ft_kapalview = currentForm = new ew.Form("ft_kapalview", "view");
	loadjs.done("ft_kapalview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$t_kapal_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $t_kapal_view->ExportOptions->render("body") ?>
<?php $t_kapal_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $t_kapal_view->showPageHeader(); ?>
<?php
$t_kapal_view->showMessage();
?>
<form name="ft_kapalview" id="ft_kapalview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_kapal">
<input type="hidden" name="modal" value="<?php echo (int)$t_kapal_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($t_kapal_view->Payload->Visible) { // Payload ?>
	<tr id="r_Payload">
		<td class="<?php echo $t_kapal_view->TableLeftColumnClass ?>"><span id="elh_t_kapal_Payload"><?php echo $t_kapal_view->Payload->caption() ?></span></td>
		<td data-name="Payload" <?php echo $t_kapal_view->Payload->cellAttributes() ?>>
<span id="el_t_kapal_Payload">
<span<?php echo $t_kapal_view->Payload->viewAttributes() ?>><?php echo $t_kapal_view->Payload->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_kapal_view->DischRate->Visible) { // DischRate ?>
	<tr id="r_DischRate">
		<td class="<?php echo $t_kapal_view->TableLeftColumnClass ?>"><span id="elh_t_kapal_DischRate"><?php echo $t_kapal_view->DischRate->caption() ?></span></td>
		<td data-name="DischRate" <?php echo $t_kapal_view->DischRate->cellAttributes() ?>>
<span id="el_t_kapal_DischRate">
<span<?php echo $t_kapal_view->DischRate->viewAttributes() ?>><?php echo $t_kapal_view->DischRate->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_kapal_view->TCH->Visible) { // TCH ?>
	<tr id="r_TCH">
		<td class="<?php echo $t_kapal_view->TableLeftColumnClass ?>"><span id="elh_t_kapal_TCH"><?php echo $t_kapal_view->TCH->caption() ?></span></td>
		<td data-name="TCH" <?php echo $t_kapal_view->TCH->cellAttributes() ?>>
<span id="el_t_kapal_TCH">
<span<?php echo $t_kapal_view->TCH->viewAttributes() ?>><?php echo $t_kapal_view->TCH->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_kapal_view->VarCost->Visible) { // VarCost ?>
	<tr id="r_VarCost">
		<td class="<?php echo $t_kapal_view->TableLeftColumnClass ?>"><span id="elh_t_kapal_VarCost"><?php echo $t_kapal_view->VarCost->caption() ?></span></td>
		<td data-name="VarCost" <?php echo $t_kapal_view->VarCost->cellAttributes() ?>>
<span id="el_t_kapal_VarCost">
<span<?php echo $t_kapal_view->VarCost->viewAttributes() ?>><?php echo $t_kapal_view->VarCost->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_kapal_view->VsLaden->Visible) { // VsLaden ?>
	<tr id="r_VsLaden">
		<td class="<?php echo $t_kapal_view->TableLeftColumnClass ?>"><span id="elh_t_kapal_VsLaden"><?php echo $t_kapal_view->VsLaden->caption() ?></span></td>
		<td data-name="VsLaden" <?php echo $t_kapal_view->VsLaden->cellAttributes() ?>>
<span id="el_t_kapal_VsLaden">
<span<?php echo $t_kapal_view->VsLaden->viewAttributes() ?>><?php echo $t_kapal_view->VsLaden->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_kapal_view->VsBallast->Visible) { // VsBallast ?>
	<tr id="r_VsBallast">
		<td class="<?php echo $t_kapal_view->TableLeftColumnClass ?>"><span id="elh_t_kapal_VsBallast"><?php echo $t_kapal_view->VsBallast->caption() ?></span></td>
		<td data-name="VsBallast" <?php echo $t_kapal_view->VsBallast->cellAttributes() ?>>
<span id="el_t_kapal_VsBallast">
<span<?php echo $t_kapal_view->VsBallast->viewAttributes() ?>><?php echo $t_kapal_view->VsBallast->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_kapal_view->ComDay->Visible) { // ComDay ?>
	<tr id="r_ComDay">
		<td class="<?php echo $t_kapal_view->TableLeftColumnClass ?>"><span id="elh_t_kapal_ComDay"><?php echo $t_kapal_view->ComDay->caption() ?></span></td>
		<td data-name="ComDay" <?php echo $t_kapal_view->ComDay->cellAttributes() ?>>
<span id="el_t_kapal_ComDay">
<span<?php echo $t_kapal_view->ComDay->viewAttributes() ?>><?php echo $t_kapal_view->ComDay->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$t_kapal_view->IsModal) { ?>
<?php if (!$t_kapal_view->isExport()) { ?>
<?php echo $t_kapal_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$t_kapal_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$t_kapal_view->isExport()) { ?>
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
$t_kapal_view->terminate();
?>