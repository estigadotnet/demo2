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
$t_destination_delete = new t_destination_delete();

// Run the page
$t_destination_delete->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_destination_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ft_destinationdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	ft_destinationdelete = currentForm = new ew.Form("ft_destinationdelete", "delete");
	loadjs.done("ft_destinationdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $t_destination_delete->showPageHeader(); ?>
<?php
$t_destination_delete->showMessage();
?>
<form name="ft_destinationdelete" id="ft_destinationdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_destination">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($t_destination_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($t_destination_delete->Nama->Visible) { // Nama ?>
		<th class="<?php echo $t_destination_delete->Nama->headerCellClass() ?>"><span id="elh_t_destination_Nama" class="t_destination_Nama"><?php echo $t_destination_delete->Nama->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$t_destination_delete->RecordCount = 0;
$i = 0;
while (!$t_destination_delete->Recordset->EOF) {
	$t_destination_delete->RecordCount++;
	$t_destination_delete->RowCount++;

	// Set row properties
	$t_destination->resetAttributes();
	$t_destination->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$t_destination_delete->loadRowValues($t_destination_delete->Recordset);

	// Render row
	$t_destination_delete->renderRow();
?>
	<tr <?php echo $t_destination->rowAttributes() ?>>
<?php if ($t_destination_delete->Nama->Visible) { // Nama ?>
		<td <?php echo $t_destination_delete->Nama->cellAttributes() ?>>
<span id="el<?php echo $t_destination_delete->RowCount ?>_t_destination_Nama" class="t_destination_Nama">
<span<?php echo $t_destination_delete->Nama->viewAttributes() ?>><?php echo $t_destination_delete->Nama->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$t_destination_delete->Recordset->moveNext();
}
$t_destination_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $t_destination_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$t_destination_delete->showPageFooter();
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
$t_destination_delete->terminate();
?>