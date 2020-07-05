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
$t_parameter_delete = new t_parameter_delete();

// Run the page
$t_parameter_delete->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_parameter_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ft_parameterdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	ft_parameterdelete = currentForm = new ew.Form("ft_parameterdelete", "delete");
	loadjs.done("ft_parameterdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $t_parameter_delete->showPageHeader(); ?>
<?php
$t_parameter_delete->showMessage();
?>
<form name="ft_parameterdelete" id="ft_parameterdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_parameter">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($t_parameter_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($t_parameter_delete->Parameter->Visible) { // Parameter ?>
		<th class="<?php echo $t_parameter_delete->Parameter->headerCellClass() ?>"><span id="elh_t_parameter_Parameter" class="t_parameter_Parameter"><?php echo $t_parameter_delete->Parameter->caption() ?></span></th>
<?php } ?>
<?php if ($t_parameter_delete->Nilai->Visible) { // Nilai ?>
		<th class="<?php echo $t_parameter_delete->Nilai->headerCellClass() ?>"><span id="elh_t_parameter_Nilai" class="t_parameter_Nilai"><?php echo $t_parameter_delete->Nilai->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$t_parameter_delete->RecordCount = 0;
$i = 0;
while (!$t_parameter_delete->Recordset->EOF) {
	$t_parameter_delete->RecordCount++;
	$t_parameter_delete->RowCount++;

	// Set row properties
	$t_parameter->resetAttributes();
	$t_parameter->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$t_parameter_delete->loadRowValues($t_parameter_delete->Recordset);

	// Render row
	$t_parameter_delete->renderRow();
?>
	<tr <?php echo $t_parameter->rowAttributes() ?>>
<?php if ($t_parameter_delete->Parameter->Visible) { // Parameter ?>
		<td <?php echo $t_parameter_delete->Parameter->cellAttributes() ?>>
<span id="el<?php echo $t_parameter_delete->RowCount ?>_t_parameter_Parameter" class="t_parameter_Parameter">
<span<?php echo $t_parameter_delete->Parameter->viewAttributes() ?>><?php echo $t_parameter_delete->Parameter->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_parameter_delete->Nilai->Visible) { // Nilai ?>
		<td <?php echo $t_parameter_delete->Nilai->cellAttributes() ?>>
<span id="el<?php echo $t_parameter_delete->RowCount ?>_t_parameter_Nilai" class="t_parameter_Nilai">
<span<?php echo $t_parameter_delete->Nilai->viewAttributes() ?>><?php echo $t_parameter_delete->Nilai->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$t_parameter_delete->Recordset->moveNext();
}
$t_parameter_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $t_parameter_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$t_parameter_delete->showPageFooter();
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
$t_parameter_delete->terminate();
?>