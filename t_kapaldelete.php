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
$t_kapal_delete = new t_kapal_delete();

// Run the page
$t_kapal_delete->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_kapal_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ft_kapaldelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	ft_kapaldelete = currentForm = new ew.Form("ft_kapaldelete", "delete");
	loadjs.done("ft_kapaldelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $t_kapal_delete->showPageHeader(); ?>
<?php
$t_kapal_delete->showMessage();
?>
<form name="ft_kapaldelete" id="ft_kapaldelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_kapal">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($t_kapal_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($t_kapal_delete->Payload->Visible) { // Payload ?>
		<th class="<?php echo $t_kapal_delete->Payload->headerCellClass() ?>"><span id="elh_t_kapal_Payload" class="t_kapal_Payload"><?php echo $t_kapal_delete->Payload->caption() ?></span></th>
<?php } ?>
<?php if ($t_kapal_delete->DischRate->Visible) { // DischRate ?>
		<th class="<?php echo $t_kapal_delete->DischRate->headerCellClass() ?>"><span id="elh_t_kapal_DischRate" class="t_kapal_DischRate"><?php echo $t_kapal_delete->DischRate->caption() ?></span></th>
<?php } ?>
<?php if ($t_kapal_delete->TCH->Visible) { // TCH ?>
		<th class="<?php echo $t_kapal_delete->TCH->headerCellClass() ?>"><span id="elh_t_kapal_TCH" class="t_kapal_TCH"><?php echo $t_kapal_delete->TCH->caption() ?></span></th>
<?php } ?>
<?php if ($t_kapal_delete->VarCost->Visible) { // VarCost ?>
		<th class="<?php echo $t_kapal_delete->VarCost->headerCellClass() ?>"><span id="elh_t_kapal_VarCost" class="t_kapal_VarCost"><?php echo $t_kapal_delete->VarCost->caption() ?></span></th>
<?php } ?>
<?php if ($t_kapal_delete->VsLaden->Visible) { // VsLaden ?>
		<th class="<?php echo $t_kapal_delete->VsLaden->headerCellClass() ?>"><span id="elh_t_kapal_VsLaden" class="t_kapal_VsLaden"><?php echo $t_kapal_delete->VsLaden->caption() ?></span></th>
<?php } ?>
<?php if ($t_kapal_delete->VsBallast->Visible) { // VsBallast ?>
		<th class="<?php echo $t_kapal_delete->VsBallast->headerCellClass() ?>"><span id="elh_t_kapal_VsBallast" class="t_kapal_VsBallast"><?php echo $t_kapal_delete->VsBallast->caption() ?></span></th>
<?php } ?>
<?php if ($t_kapal_delete->ComDay->Visible) { // ComDay ?>
		<th class="<?php echo $t_kapal_delete->ComDay->headerCellClass() ?>"><span id="elh_t_kapal_ComDay" class="t_kapal_ComDay"><?php echo $t_kapal_delete->ComDay->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$t_kapal_delete->RecordCount = 0;
$i = 0;
while (!$t_kapal_delete->Recordset->EOF) {
	$t_kapal_delete->RecordCount++;
	$t_kapal_delete->RowCount++;

	// Set row properties
	$t_kapal->resetAttributes();
	$t_kapal->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$t_kapal_delete->loadRowValues($t_kapal_delete->Recordset);

	// Render row
	$t_kapal_delete->renderRow();
?>
	<tr <?php echo $t_kapal->rowAttributes() ?>>
<?php if ($t_kapal_delete->Payload->Visible) { // Payload ?>
		<td <?php echo $t_kapal_delete->Payload->cellAttributes() ?>>
<span id="el<?php echo $t_kapal_delete->RowCount ?>_t_kapal_Payload" class="t_kapal_Payload">
<span<?php echo $t_kapal_delete->Payload->viewAttributes() ?>><?php echo $t_kapal_delete->Payload->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_kapal_delete->DischRate->Visible) { // DischRate ?>
		<td <?php echo $t_kapal_delete->DischRate->cellAttributes() ?>>
<span id="el<?php echo $t_kapal_delete->RowCount ?>_t_kapal_DischRate" class="t_kapal_DischRate">
<span<?php echo $t_kapal_delete->DischRate->viewAttributes() ?>><?php echo $t_kapal_delete->DischRate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_kapal_delete->TCH->Visible) { // TCH ?>
		<td <?php echo $t_kapal_delete->TCH->cellAttributes() ?>>
<span id="el<?php echo $t_kapal_delete->RowCount ?>_t_kapal_TCH" class="t_kapal_TCH">
<span<?php echo $t_kapal_delete->TCH->viewAttributes() ?>><?php echo $t_kapal_delete->TCH->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_kapal_delete->VarCost->Visible) { // VarCost ?>
		<td <?php echo $t_kapal_delete->VarCost->cellAttributes() ?>>
<span id="el<?php echo $t_kapal_delete->RowCount ?>_t_kapal_VarCost" class="t_kapal_VarCost">
<span<?php echo $t_kapal_delete->VarCost->viewAttributes() ?>><?php echo $t_kapal_delete->VarCost->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_kapal_delete->VsLaden->Visible) { // VsLaden ?>
		<td <?php echo $t_kapal_delete->VsLaden->cellAttributes() ?>>
<span id="el<?php echo $t_kapal_delete->RowCount ?>_t_kapal_VsLaden" class="t_kapal_VsLaden">
<span<?php echo $t_kapal_delete->VsLaden->viewAttributes() ?>><?php echo $t_kapal_delete->VsLaden->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_kapal_delete->VsBallast->Visible) { // VsBallast ?>
		<td <?php echo $t_kapal_delete->VsBallast->cellAttributes() ?>>
<span id="el<?php echo $t_kapal_delete->RowCount ?>_t_kapal_VsBallast" class="t_kapal_VsBallast">
<span<?php echo $t_kapal_delete->VsBallast->viewAttributes() ?>><?php echo $t_kapal_delete->VsBallast->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_kapal_delete->ComDay->Visible) { // ComDay ?>
		<td <?php echo $t_kapal_delete->ComDay->cellAttributes() ?>>
<span id="el<?php echo $t_kapal_delete->RowCount ?>_t_kapal_ComDay" class="t_kapal_ComDay">
<span<?php echo $t_kapal_delete->ComDay->viewAttributes() ?>><?php echo $t_kapal_delete->ComDay->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$t_kapal_delete->Recordset->moveNext();
}
$t_kapal_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $t_kapal_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$t_kapal_delete->showPageFooter();
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
$t_kapal_delete->terminate();
?>