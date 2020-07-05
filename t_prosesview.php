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
$t_proses_view = new t_proses_view();

// Run the page
$t_proses_view->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_proses_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$t_proses_view->isExport()) { ?>
<script>
var ft_prosesview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	ft_prosesview = currentForm = new ew.Form("ft_prosesview", "view");
	loadjs.done("ft_prosesview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$t_proses_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $t_proses_view->ExportOptions->render("body") ?>
<?php $t_proses_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $t_proses_view->showPageHeader(); ?>
<?php
$t_proses_view->showMessage();
?>
<form name="ft_prosesview" id="ft_prosesview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_proses">
<input type="hidden" name="modal" value="<?php echo (int)$t_proses_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($t_proses_view->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $t_proses_view->TableLeftColumnClass ?>"><span id="elh_t_proses_id"><?php echo $t_proses_view->id->caption() ?></span></td>
		<td data-name="id" <?php echo $t_proses_view->id->cellAttributes() ?>>
<span id="el_t_proses_id">
<span<?php echo $t_proses_view->id->viewAttributes() ?>><?php echo $t_proses_view->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_proses_view->TotalCost->Visible) { // TotalCost ?>
	<tr id="r_TotalCost">
		<td class="<?php echo $t_proses_view->TableLeftColumnClass ?>"><span id="elh_t_proses_TotalCost"><?php echo $t_proses_view->TotalCost->caption() ?></span></td>
		<td data-name="TotalCost" <?php echo $t_proses_view->TotalCost->cellAttributes() ?>>
<span id="el_t_proses_TotalCost">
<span<?php echo $t_proses_view->TotalCost->viewAttributes() ?>><?php echo $t_proses_view->TotalCost->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_proses_view->TotalCargo->Visible) { // TotalCargo ?>
	<tr id="r_TotalCargo">
		<td class="<?php echo $t_proses_view->TableLeftColumnClass ?>"><span id="elh_t_proses_TotalCargo"><?php echo $t_proses_view->TotalCargo->caption() ?></span></td>
		<td data-name="TotalCargo" <?php echo $t_proses_view->TotalCargo->cellAttributes() ?>>
<span id="el_t_proses_TotalCargo">
<span<?php echo $t_proses_view->TotalCargo->viewAttributes() ?>><?php echo $t_proses_view->TotalCargo->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_proses_view->Fitness->Visible) { // Fitness ?>
	<tr id="r_Fitness">
		<td class="<?php echo $t_proses_view->TableLeftColumnClass ?>"><span id="elh_t_proses_Fitness"><?php echo $t_proses_view->Fitness->caption() ?></span></td>
		<td data-name="Fitness" <?php echo $t_proses_view->Fitness->cellAttributes() ?>>
<span id="el_t_proses_Fitness">
<span<?php echo $t_proses_view->Fitness->viewAttributes() ?>><?php echo $t_proses_view->Fitness->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_proses_view->Kromosom->Visible) { // Kromosom ?>
	<tr id="r_Kromosom">
		<td class="<?php echo $t_proses_view->TableLeftColumnClass ?>"><span id="elh_t_proses_Kromosom"><?php echo $t_proses_view->Kromosom->caption() ?></span></td>
		<td data-name="Kromosom" <?php echo $t_proses_view->Kromosom->cellAttributes() ?>>
<span id="el_t_proses_Kromosom">
<span<?php echo $t_proses_view->Kromosom->viewAttributes() ?>><?php echo $t_proses_view->Kromosom->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_proses_view->Generasi->Visible) { // Generasi ?>
	<tr id="r_Generasi">
		<td class="<?php echo $t_proses_view->TableLeftColumnClass ?>"><span id="elh_t_proses_Generasi"><?php echo $t_proses_view->Generasi->caption() ?></span></td>
		<td data-name="Generasi" <?php echo $t_proses_view->Generasi->cellAttributes() ?>>
<span id="el_t_proses_Generasi">
<span<?php echo $t_proses_view->Generasi->viewAttributes() ?>><?php echo $t_proses_view->Generasi->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$t_proses_view->IsModal) { ?>
<?php if (!$t_proses_view->isExport()) { ?>
<?php echo $t_proses_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$t_proses_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$t_proses_view->isExport()) { ?>
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
$t_proses_view->terminate();
?>