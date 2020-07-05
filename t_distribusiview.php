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
$t_distribusi_view = new t_distribusi_view();

// Run the page
$t_distribusi_view->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_distribusi_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$t_distribusi_view->isExport()) { ?>
<script>
var ft_distribusiview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	ft_distribusiview = currentForm = new ew.Form("ft_distribusiview", "view");
	loadjs.done("ft_distribusiview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$t_distribusi_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $t_distribusi_view->ExportOptions->render("body") ?>
<?php $t_distribusi_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $t_distribusi_view->showPageHeader(); ?>
<?php
$t_distribusi_view->showMessage();
?>
<form name="ft_distribusiview" id="ft_distribusiview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_distribusi">
<input type="hidden" name="modal" value="<?php echo (int)$t_distribusi_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($t_distribusi_view->source_id->Visible) { // source_id ?>
	<tr id="r_source_id">
		<td class="<?php echo $t_distribusi_view->TableLeftColumnClass ?>"><span id="elh_t_distribusi_source_id"><?php echo $t_distribusi_view->source_id->caption() ?></span></td>
		<td data-name="source_id" <?php echo $t_distribusi_view->source_id->cellAttributes() ?>>
<span id="el_t_distribusi_source_id">
<span<?php echo $t_distribusi_view->source_id->viewAttributes() ?>><?php echo $t_distribusi_view->source_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_distribusi_view->destination_id->Visible) { // destination_id ?>
	<tr id="r_destination_id">
		<td class="<?php echo $t_distribusi_view->TableLeftColumnClass ?>"><span id="elh_t_distribusi_destination_id"><?php echo $t_distribusi_view->destination_id->caption() ?></span></td>
		<td data-name="destination_id" <?php echo $t_distribusi_view->destination_id->cellAttributes() ?>>
<span id="el_t_distribusi_destination_id">
<span<?php echo $t_distribusi_view->destination_id->viewAttributes() ?>><?php echo $t_distribusi_view->destination_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_distribusi_view->Jarak->Visible) { // Jarak ?>
	<tr id="r_Jarak">
		<td class="<?php echo $t_distribusi_view->TableLeftColumnClass ?>"><span id="elh_t_distribusi_Jarak"><?php echo $t_distribusi_view->Jarak->caption() ?></span></td>
		<td data-name="Jarak" <?php echo $t_distribusi_view->Jarak->cellAttributes() ?>>
<span id="el_t_distribusi_Jarak">
<span<?php echo $t_distribusi_view->Jarak->viewAttributes() ?>><?php echo $t_distribusi_view->Jarak->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_distribusi_view->Rate_O->Visible) { // Rate_O ?>
	<tr id="r_Rate_O">
		<td class="<?php echo $t_distribusi_view->TableLeftColumnClass ?>"><span id="elh_t_distribusi_Rate_O"><?php echo $t_distribusi_view->Rate_O->caption() ?></span></td>
		<td data-name="Rate_O" <?php echo $t_distribusi_view->Rate_O->cellAttributes() ?>>
<span id="el_t_distribusi_Rate_O">
<span<?php echo $t_distribusi_view->Rate_O->viewAttributes() ?>><?php echo $t_distribusi_view->Rate_O->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_distribusi_view->Rate_D->Visible) { // Rate_D ?>
	<tr id="r_Rate_D">
		<td class="<?php echo $t_distribusi_view->TableLeftColumnClass ?>"><span id="elh_t_distribusi_Rate_D"><?php echo $t_distribusi_view->Rate_D->caption() ?></span></td>
		<td data-name="Rate_D" <?php echo $t_distribusi_view->Rate_D->cellAttributes() ?>>
<span id="el_t_distribusi_Rate_D">
<span<?php echo $t_distribusi_view->Rate_D->viewAttributes() ?>><?php echo $t_distribusi_view->Rate_D->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($t_distribusi_view->Demand->Visible) { // Demand ?>
	<tr id="r_Demand">
		<td class="<?php echo $t_distribusi_view->TableLeftColumnClass ?>"><span id="elh_t_distribusi_Demand"><?php echo $t_distribusi_view->Demand->caption() ?></span></td>
		<td data-name="Demand" <?php echo $t_distribusi_view->Demand->cellAttributes() ?>>
<span id="el_t_distribusi_Demand">
<span<?php echo $t_distribusi_view->Demand->viewAttributes() ?>><?php echo $t_distribusi_view->Demand->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$t_distribusi_view->IsModal) { ?>
<?php if (!$t_distribusi_view->isExport()) { ?>
<?php echo $t_distribusi_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$t_distribusi_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$t_distribusi_view->isExport()) { ?>
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
$t_distribusi_view->terminate();
?>