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
$t_proses_delete = new t_proses_delete();

// Run the page
$t_proses_delete->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_proses_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ft_prosesdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	ft_prosesdelete = currentForm = new ew.Form("ft_prosesdelete", "delete");
	loadjs.done("ft_prosesdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $t_proses_delete->showPageHeader(); ?>
<?php
$t_proses_delete->showMessage();
?>
<form name="ft_prosesdelete" id="ft_prosesdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_proses">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($t_proses_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($t_proses_delete->id->Visible) { // id ?>
		<th class="<?php echo $t_proses_delete->id->headerCellClass() ?>"><span id="elh_t_proses_id" class="t_proses_id"><?php echo $t_proses_delete->id->caption() ?></span></th>
<?php } ?>
<?php if ($t_proses_delete->TotalCost->Visible) { // TotalCost ?>
		<th class="<?php echo $t_proses_delete->TotalCost->headerCellClass() ?>"><span id="elh_t_proses_TotalCost" class="t_proses_TotalCost"><?php echo $t_proses_delete->TotalCost->caption() ?></span></th>
<?php } ?>
<?php if ($t_proses_delete->TotalCargo->Visible) { // TotalCargo ?>
		<th class="<?php echo $t_proses_delete->TotalCargo->headerCellClass() ?>"><span id="elh_t_proses_TotalCargo" class="t_proses_TotalCargo"><?php echo $t_proses_delete->TotalCargo->caption() ?></span></th>
<?php } ?>
<?php if ($t_proses_delete->Fitness->Visible) { // Fitness ?>
		<th class="<?php echo $t_proses_delete->Fitness->headerCellClass() ?>"><span id="elh_t_proses_Fitness" class="t_proses_Fitness"><?php echo $t_proses_delete->Fitness->caption() ?></span></th>
<?php } ?>
<?php if ($t_proses_delete->Generasi->Visible) { // Generasi ?>
		<th class="<?php echo $t_proses_delete->Generasi->headerCellClass() ?>"><span id="elh_t_proses_Generasi" class="t_proses_Generasi"><?php echo $t_proses_delete->Generasi->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$t_proses_delete->RecordCount = 0;
$i = 0;
while (!$t_proses_delete->Recordset->EOF) {
	$t_proses_delete->RecordCount++;
	$t_proses_delete->RowCount++;

	// Set row properties
	$t_proses->resetAttributes();
	$t_proses->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$t_proses_delete->loadRowValues($t_proses_delete->Recordset);

	// Render row
	$t_proses_delete->renderRow();
?>
	<tr <?php echo $t_proses->rowAttributes() ?>>
<?php if ($t_proses_delete->id->Visible) { // id ?>
		<td <?php echo $t_proses_delete->id->cellAttributes() ?>>
<span id="el<?php echo $t_proses_delete->RowCount ?>_t_proses_id" class="t_proses_id">
<span<?php echo $t_proses_delete->id->viewAttributes() ?>><?php echo $t_proses_delete->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_proses_delete->TotalCost->Visible) { // TotalCost ?>
		<td <?php echo $t_proses_delete->TotalCost->cellAttributes() ?>>
<span id="el<?php echo $t_proses_delete->RowCount ?>_t_proses_TotalCost" class="t_proses_TotalCost">
<span<?php echo $t_proses_delete->TotalCost->viewAttributes() ?>><?php echo $t_proses_delete->TotalCost->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_proses_delete->TotalCargo->Visible) { // TotalCargo ?>
		<td <?php echo $t_proses_delete->TotalCargo->cellAttributes() ?>>
<span id="el<?php echo $t_proses_delete->RowCount ?>_t_proses_TotalCargo" class="t_proses_TotalCargo">
<span<?php echo $t_proses_delete->TotalCargo->viewAttributes() ?>><?php echo $t_proses_delete->TotalCargo->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_proses_delete->Fitness->Visible) { // Fitness ?>
		<td <?php echo $t_proses_delete->Fitness->cellAttributes() ?>>
<span id="el<?php echo $t_proses_delete->RowCount ?>_t_proses_Fitness" class="t_proses_Fitness">
<span<?php echo $t_proses_delete->Fitness->viewAttributes() ?>><?php echo $t_proses_delete->Fitness->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_proses_delete->Generasi->Visible) { // Generasi ?>
		<td <?php echo $t_proses_delete->Generasi->cellAttributes() ?>>
<span id="el<?php echo $t_proses_delete->RowCount ?>_t_proses_Generasi" class="t_proses_Generasi">
<span<?php echo $t_proses_delete->Generasi->viewAttributes() ?>><?php echo $t_proses_delete->Generasi->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$t_proses_delete->Recordset->moveNext();
}
$t_proses_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $t_proses_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$t_proses_delete->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php include_once "footer.php"; ?>
<?php
$t_proses_delete->terminate();
?>