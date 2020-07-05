<?php
namespace PHPMaker2020\project1;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($t_kapal_grid))
	$t_kapal_grid = new t_kapal_grid();

// Run the page
$t_kapal_grid->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_kapal_grid->Page_Render();
?>
<?php if (!$t_kapal_grid->isExport()) { ?>
<script>
var ft_kapalgrid, currentPageID;
loadjs.ready("head", function() {

	// Form object
	ft_kapalgrid = new ew.Form("ft_kapalgrid", "grid");
	ft_kapalgrid.formKeyCountName = '<?php echo $t_kapal_grid->FormKeyCountName ?>';

	// Validate form
	ft_kapalgrid.validate = function() {
		if (!this.validateRequired)
			return true; // Ignore validation
		var $ = jQuery, fobj = this.getForm(), $fobj = $(fobj);
		if ($fobj.find("#confirm").val() == "confirm")
			return true;
		var elm, felm, uelm, addcnt = 0;
		var $k = $fobj.find("#" + this.formKeyCountName); // Get key_count
		var rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1;
		var startcnt = (rowcnt == 0) ? 0 : 1; // Check rowcnt == 0 => Inline-Add
		var gridinsert = ["insert", "gridinsert"].includes($fobj.find("#action").val()) && $k[0];
		for (var i = startcnt; i <= rowcnt; i++) {
			var infix = ($k[0]) ? String(i) : "";
			$fobj.data("rowindex", infix);
			var checkrow = (gridinsert) ? !this.emptyRow(infix) : true;
			if (checkrow) {
				addcnt++;
			<?php if ($t_kapal_grid->Payload->Required) { ?>
				elm = this.getElements("x" + infix + "_Payload");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_kapal_grid->Payload->caption(), $t_kapal_grid->Payload->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Payload");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_kapal_grid->Payload->errorMessage()) ?>");
			<?php if ($t_kapal_grid->DischRate->Required) { ?>
				elm = this.getElements("x" + infix + "_DischRate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_kapal_grid->DischRate->caption(), $t_kapal_grid->DischRate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_DischRate");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_kapal_grid->DischRate->errorMessage()) ?>");
			<?php if ($t_kapal_grid->TCH->Required) { ?>
				elm = this.getElements("x" + infix + "_TCH");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_kapal_grid->TCH->caption(), $t_kapal_grid->TCH->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_TCH");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_kapal_grid->TCH->errorMessage()) ?>");
			<?php if ($t_kapal_grid->VarCost->Required) { ?>
				elm = this.getElements("x" + infix + "_VarCost");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_kapal_grid->VarCost->caption(), $t_kapal_grid->VarCost->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_VarCost");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_kapal_grid->VarCost->errorMessage()) ?>");
			<?php if ($t_kapal_grid->VsLaden->Required) { ?>
				elm = this.getElements("x" + infix + "_VsLaden");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_kapal_grid->VsLaden->caption(), $t_kapal_grid->VsLaden->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_VsLaden");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_kapal_grid->VsLaden->errorMessage()) ?>");
			<?php if ($t_kapal_grid->VsBallast->Required) { ?>
				elm = this.getElements("x" + infix + "_VsBallast");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_kapal_grid->VsBallast->caption(), $t_kapal_grid->VsBallast->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_VsBallast");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_kapal_grid->VsBallast->errorMessage()) ?>");
			<?php if ($t_kapal_grid->ComDay->Required) { ?>
				elm = this.getElements("x" + infix + "_ComDay");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_kapal_grid->ComDay->caption(), $t_kapal_grid->ComDay->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ComDay");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_kapal_grid->ComDay->errorMessage()) ?>");

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		return true;
	}

	// Check empty row
	ft_kapalgrid.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "Payload", false)) return false;
		if (ew.valueChanged(fobj, infix, "DischRate", false)) return false;
		if (ew.valueChanged(fobj, infix, "TCH", false)) return false;
		if (ew.valueChanged(fobj, infix, "VarCost", false)) return false;
		if (ew.valueChanged(fobj, infix, "VsLaden", false)) return false;
		if (ew.valueChanged(fobj, infix, "VsBallast", false)) return false;
		if (ew.valueChanged(fobj, infix, "ComDay", false)) return false;
		return true;
	}

	// Form_CustomValidate
	ft_kapalgrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ft_kapalgrid.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("ft_kapalgrid");
});
</script>
<?php } ?>
<?php
$t_kapal_grid->renderOtherOptions();
?>
<?php if ($t_kapal_grid->TotalRecords > 0 || $t_kapal->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($t_kapal_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> t_kapal">
<div id="ft_kapalgrid" class="ew-form ew-list-form form-inline">
<div id="gmp_t_kapal" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_t_kapalgrid" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$t_kapal->RowType = ROWTYPE_HEADER;

// Render list options
$t_kapal_grid->renderListOptions();

// Render list options (header, left)
$t_kapal_grid->ListOptions->render("header", "left");
?>
<?php if ($t_kapal_grid->Payload->Visible) { // Payload ?>
	<?php if ($t_kapal_grid->SortUrl($t_kapal_grid->Payload) == "") { ?>
		<th data-name="Payload" class="<?php echo $t_kapal_grid->Payload->headerCellClass() ?>"><div id="elh_t_kapal_Payload" class="t_kapal_Payload"><div class="ew-table-header-caption"><?php echo $t_kapal_grid->Payload->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Payload" class="<?php echo $t_kapal_grid->Payload->headerCellClass() ?>"><div><div id="elh_t_kapal_Payload" class="t_kapal_Payload">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_kapal_grid->Payload->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_kapal_grid->Payload->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_kapal_grid->Payload->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_kapal_grid->DischRate->Visible) { // DischRate ?>
	<?php if ($t_kapal_grid->SortUrl($t_kapal_grid->DischRate) == "") { ?>
		<th data-name="DischRate" class="<?php echo $t_kapal_grid->DischRate->headerCellClass() ?>"><div id="elh_t_kapal_DischRate" class="t_kapal_DischRate"><div class="ew-table-header-caption"><?php echo $t_kapal_grid->DischRate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DischRate" class="<?php echo $t_kapal_grid->DischRate->headerCellClass() ?>"><div><div id="elh_t_kapal_DischRate" class="t_kapal_DischRate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_kapal_grid->DischRate->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_kapal_grid->DischRate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_kapal_grid->DischRate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_kapal_grid->TCH->Visible) { // TCH ?>
	<?php if ($t_kapal_grid->SortUrl($t_kapal_grid->TCH) == "") { ?>
		<th data-name="TCH" class="<?php echo $t_kapal_grid->TCH->headerCellClass() ?>"><div id="elh_t_kapal_TCH" class="t_kapal_TCH"><div class="ew-table-header-caption"><?php echo $t_kapal_grid->TCH->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="TCH" class="<?php echo $t_kapal_grid->TCH->headerCellClass() ?>"><div><div id="elh_t_kapal_TCH" class="t_kapal_TCH">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_kapal_grid->TCH->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_kapal_grid->TCH->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_kapal_grid->TCH->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_kapal_grid->VarCost->Visible) { // VarCost ?>
	<?php if ($t_kapal_grid->SortUrl($t_kapal_grid->VarCost) == "") { ?>
		<th data-name="VarCost" class="<?php echo $t_kapal_grid->VarCost->headerCellClass() ?>"><div id="elh_t_kapal_VarCost" class="t_kapal_VarCost"><div class="ew-table-header-caption"><?php echo $t_kapal_grid->VarCost->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="VarCost" class="<?php echo $t_kapal_grid->VarCost->headerCellClass() ?>"><div><div id="elh_t_kapal_VarCost" class="t_kapal_VarCost">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_kapal_grid->VarCost->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_kapal_grid->VarCost->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_kapal_grid->VarCost->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_kapal_grid->VsLaden->Visible) { // VsLaden ?>
	<?php if ($t_kapal_grid->SortUrl($t_kapal_grid->VsLaden) == "") { ?>
		<th data-name="VsLaden" class="<?php echo $t_kapal_grid->VsLaden->headerCellClass() ?>"><div id="elh_t_kapal_VsLaden" class="t_kapal_VsLaden"><div class="ew-table-header-caption"><?php echo $t_kapal_grid->VsLaden->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="VsLaden" class="<?php echo $t_kapal_grid->VsLaden->headerCellClass() ?>"><div><div id="elh_t_kapal_VsLaden" class="t_kapal_VsLaden">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_kapal_grid->VsLaden->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_kapal_grid->VsLaden->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_kapal_grid->VsLaden->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_kapal_grid->VsBallast->Visible) { // VsBallast ?>
	<?php if ($t_kapal_grid->SortUrl($t_kapal_grid->VsBallast) == "") { ?>
		<th data-name="VsBallast" class="<?php echo $t_kapal_grid->VsBallast->headerCellClass() ?>"><div id="elh_t_kapal_VsBallast" class="t_kapal_VsBallast"><div class="ew-table-header-caption"><?php echo $t_kapal_grid->VsBallast->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="VsBallast" class="<?php echo $t_kapal_grid->VsBallast->headerCellClass() ?>"><div><div id="elh_t_kapal_VsBallast" class="t_kapal_VsBallast">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_kapal_grid->VsBallast->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_kapal_grid->VsBallast->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_kapal_grid->VsBallast->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_kapal_grid->ComDay->Visible) { // ComDay ?>
	<?php if ($t_kapal_grid->SortUrl($t_kapal_grid->ComDay) == "") { ?>
		<th data-name="ComDay" class="<?php echo $t_kapal_grid->ComDay->headerCellClass() ?>"><div id="elh_t_kapal_ComDay" class="t_kapal_ComDay"><div class="ew-table-header-caption"><?php echo $t_kapal_grid->ComDay->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ComDay" class="<?php echo $t_kapal_grid->ComDay->headerCellClass() ?>"><div><div id="elh_t_kapal_ComDay" class="t_kapal_ComDay">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_kapal_grid->ComDay->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_kapal_grid->ComDay->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_kapal_grid->ComDay->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$t_kapal_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$t_kapal_grid->StartRecord = 1;
$t_kapal_grid->StopRecord = $t_kapal_grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($t_kapal->isConfirm() || $t_kapal_grid->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($t_kapal_grid->FormKeyCountName) && ($t_kapal_grid->isGridAdd() || $t_kapal_grid->isGridEdit() || $t_kapal->isConfirm())) {
		$t_kapal_grid->KeyCount = $CurrentForm->getValue($t_kapal_grid->FormKeyCountName);
		$t_kapal_grid->StopRecord = $t_kapal_grid->StartRecord + $t_kapal_grid->KeyCount - 1;
	}
}
$t_kapal_grid->RecordCount = $t_kapal_grid->StartRecord - 1;
if ($t_kapal_grid->Recordset && !$t_kapal_grid->Recordset->EOF) {
	$t_kapal_grid->Recordset->moveFirst();
	$selectLimit = $t_kapal_grid->UseSelectLimit;
	if (!$selectLimit && $t_kapal_grid->StartRecord > 1)
		$t_kapal_grid->Recordset->move($t_kapal_grid->StartRecord - 1);
} elseif (!$t_kapal->AllowAddDeleteRow && $t_kapal_grid->StopRecord == 0) {
	$t_kapal_grid->StopRecord = $t_kapal->GridAddRowCount;
}

// Initialize aggregate
$t_kapal->RowType = ROWTYPE_AGGREGATEINIT;
$t_kapal->resetAttributes();
$t_kapal_grid->renderRow();
if ($t_kapal_grid->isGridAdd())
	$t_kapal_grid->RowIndex = 0;
if ($t_kapal_grid->isGridEdit())
	$t_kapal_grid->RowIndex = 0;
while ($t_kapal_grid->RecordCount < $t_kapal_grid->StopRecord) {
	$t_kapal_grid->RecordCount++;
	if ($t_kapal_grid->RecordCount >= $t_kapal_grid->StartRecord) {
		$t_kapal_grid->RowCount++;
		if ($t_kapal_grid->isGridAdd() || $t_kapal_grid->isGridEdit() || $t_kapal->isConfirm()) {
			$t_kapal_grid->RowIndex++;
			$CurrentForm->Index = $t_kapal_grid->RowIndex;
			if ($CurrentForm->hasValue($t_kapal_grid->FormActionName) && ($t_kapal->isConfirm() || $t_kapal_grid->EventCancelled))
				$t_kapal_grid->RowAction = strval($CurrentForm->getValue($t_kapal_grid->FormActionName));
			elseif ($t_kapal_grid->isGridAdd())
				$t_kapal_grid->RowAction = "insert";
			else
				$t_kapal_grid->RowAction = "";
		}

		// Set up key count
		$t_kapal_grid->KeyCount = $t_kapal_grid->RowIndex;

		// Init row class and style
		$t_kapal->resetAttributes();
		$t_kapal->CssClass = "";
		if ($t_kapal_grid->isGridAdd()) {
			if ($t_kapal->CurrentMode == "copy") {
				$t_kapal_grid->loadRowValues($t_kapal_grid->Recordset); // Load row values
				$t_kapal_grid->setRecordKey($t_kapal_grid->RowOldKey, $t_kapal_grid->Recordset); // Set old record key
			} else {
				$t_kapal_grid->loadRowValues(); // Load default values
				$t_kapal_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$t_kapal_grid->loadRowValues($t_kapal_grid->Recordset); // Load row values
		}
		$t_kapal->RowType = ROWTYPE_VIEW; // Render view
		if ($t_kapal_grid->isGridAdd()) // Grid add
			$t_kapal->RowType = ROWTYPE_ADD; // Render add
		if ($t_kapal_grid->isGridAdd() && $t_kapal->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$t_kapal_grid->restoreCurrentRowFormValues($t_kapal_grid->RowIndex); // Restore form values
		if ($t_kapal_grid->isGridEdit()) { // Grid edit
			if ($t_kapal->EventCancelled)
				$t_kapal_grid->restoreCurrentRowFormValues($t_kapal_grid->RowIndex); // Restore form values
			if ($t_kapal_grid->RowAction == "insert")
				$t_kapal->RowType = ROWTYPE_ADD; // Render add
			else
				$t_kapal->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($t_kapal_grid->isGridEdit() && ($t_kapal->RowType == ROWTYPE_EDIT || $t_kapal->RowType == ROWTYPE_ADD) && $t_kapal->EventCancelled) // Update failed
			$t_kapal_grid->restoreCurrentRowFormValues($t_kapal_grid->RowIndex); // Restore form values
		if ($t_kapal->RowType == ROWTYPE_EDIT) // Edit row
			$t_kapal_grid->EditRowCount++;
		if ($t_kapal->isConfirm()) // Confirm row
			$t_kapal_grid->restoreCurrentRowFormValues($t_kapal_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$t_kapal->RowAttrs->merge(["data-rowindex" => $t_kapal_grid->RowCount, "id" => "r" . $t_kapal_grid->RowCount . "_t_kapal", "data-rowtype" => $t_kapal->RowType]);

		// Render row
		$t_kapal_grid->renderRow();

		// Render list options
		$t_kapal_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($t_kapal_grid->RowAction != "delete" && $t_kapal_grid->RowAction != "insertdelete" && !($t_kapal_grid->RowAction == "insert" && $t_kapal->isConfirm() && $t_kapal_grid->emptyRow())) {
?>
	<tr <?php echo $t_kapal->rowAttributes() ?>>
<?php

// Render list options (body, left)
$t_kapal_grid->ListOptions->render("body", "left", $t_kapal_grid->RowCount);
?>
	<?php if ($t_kapal_grid->Payload->Visible) { // Payload ?>
		<td data-name="Payload" <?php echo $t_kapal_grid->Payload->cellAttributes() ?>>
<?php if ($t_kapal->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_kapal_grid->RowCount ?>_t_kapal_Payload" class="form-group">
<input type="text" data-table="t_kapal" data-field="x_Payload" name="x<?php echo $t_kapal_grid->RowIndex ?>_Payload" id="x<?php echo $t_kapal_grid->RowIndex ?>_Payload" size="10" maxlength="14" placeholder="<?php echo HtmlEncode($t_kapal_grid->Payload->getPlaceHolder()) ?>" value="<?php echo $t_kapal_grid->Payload->EditValue ?>"<?php echo $t_kapal_grid->Payload->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_kapal" data-field="x_Payload" name="o<?php echo $t_kapal_grid->RowIndex ?>_Payload" id="o<?php echo $t_kapal_grid->RowIndex ?>_Payload" value="<?php echo HtmlEncode($t_kapal_grid->Payload->OldValue) ?>">
<?php } ?>
<?php if ($t_kapal->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_kapal_grid->RowCount ?>_t_kapal_Payload" class="form-group">
<input type="text" data-table="t_kapal" data-field="x_Payload" name="x<?php echo $t_kapal_grid->RowIndex ?>_Payload" id="x<?php echo $t_kapal_grid->RowIndex ?>_Payload" size="10" maxlength="14" placeholder="<?php echo HtmlEncode($t_kapal_grid->Payload->getPlaceHolder()) ?>" value="<?php echo $t_kapal_grid->Payload->EditValue ?>"<?php echo $t_kapal_grid->Payload->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($t_kapal->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_kapal_grid->RowCount ?>_t_kapal_Payload">
<span<?php echo $t_kapal_grid->Payload->viewAttributes() ?>><?php echo $t_kapal_grid->Payload->getViewValue() ?></span>
</span>
<?php if (!$t_kapal->isConfirm()) { ?>
<input type="hidden" data-table="t_kapal" data-field="x_Payload" name="x<?php echo $t_kapal_grid->RowIndex ?>_Payload" id="x<?php echo $t_kapal_grid->RowIndex ?>_Payload" value="<?php echo HtmlEncode($t_kapal_grid->Payload->FormValue) ?>">
<input type="hidden" data-table="t_kapal" data-field="x_Payload" name="o<?php echo $t_kapal_grid->RowIndex ?>_Payload" id="o<?php echo $t_kapal_grid->RowIndex ?>_Payload" value="<?php echo HtmlEncode($t_kapal_grid->Payload->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_kapal" data-field="x_Payload" name="ft_kapalgrid$x<?php echo $t_kapal_grid->RowIndex ?>_Payload" id="ft_kapalgrid$x<?php echo $t_kapal_grid->RowIndex ?>_Payload" value="<?php echo HtmlEncode($t_kapal_grid->Payload->FormValue) ?>">
<input type="hidden" data-table="t_kapal" data-field="x_Payload" name="ft_kapalgrid$o<?php echo $t_kapal_grid->RowIndex ?>_Payload" id="ft_kapalgrid$o<?php echo $t_kapal_grid->RowIndex ?>_Payload" value="<?php echo HtmlEncode($t_kapal_grid->Payload->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php if ($t_kapal->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="t_kapal" data-field="x_id" name="x<?php echo $t_kapal_grid->RowIndex ?>_id" id="x<?php echo $t_kapal_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($t_kapal_grid->id->CurrentValue) ?>">
<input type="hidden" data-table="t_kapal" data-field="x_id" name="o<?php echo $t_kapal_grid->RowIndex ?>_id" id="o<?php echo $t_kapal_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($t_kapal_grid->id->OldValue) ?>">
<?php } ?>
<?php if ($t_kapal->RowType == ROWTYPE_EDIT || $t_kapal->CurrentMode == "edit") { ?>
<input type="hidden" data-table="t_kapal" data-field="x_id" name="x<?php echo $t_kapal_grid->RowIndex ?>_id" id="x<?php echo $t_kapal_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($t_kapal_grid->id->CurrentValue) ?>">
<?php } ?>
	<?php if ($t_kapal_grid->DischRate->Visible) { // DischRate ?>
		<td data-name="DischRate" <?php echo $t_kapal_grid->DischRate->cellAttributes() ?>>
<?php if ($t_kapal->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_kapal_grid->RowCount ?>_t_kapal_DischRate" class="form-group">
<input type="text" data-table="t_kapal" data-field="x_DischRate" name="x<?php echo $t_kapal_grid->RowIndex ?>_DischRate" id="x<?php echo $t_kapal_grid->RowIndex ?>_DischRate" size="10" maxlength="14" placeholder="<?php echo HtmlEncode($t_kapal_grid->DischRate->getPlaceHolder()) ?>" value="<?php echo $t_kapal_grid->DischRate->EditValue ?>"<?php echo $t_kapal_grid->DischRate->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_kapal" data-field="x_DischRate" name="o<?php echo $t_kapal_grid->RowIndex ?>_DischRate" id="o<?php echo $t_kapal_grid->RowIndex ?>_DischRate" value="<?php echo HtmlEncode($t_kapal_grid->DischRate->OldValue) ?>">
<?php } ?>
<?php if ($t_kapal->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_kapal_grid->RowCount ?>_t_kapal_DischRate" class="form-group">
<input type="text" data-table="t_kapal" data-field="x_DischRate" name="x<?php echo $t_kapal_grid->RowIndex ?>_DischRate" id="x<?php echo $t_kapal_grid->RowIndex ?>_DischRate" size="10" maxlength="14" placeholder="<?php echo HtmlEncode($t_kapal_grid->DischRate->getPlaceHolder()) ?>" value="<?php echo $t_kapal_grid->DischRate->EditValue ?>"<?php echo $t_kapal_grid->DischRate->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($t_kapal->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_kapal_grid->RowCount ?>_t_kapal_DischRate">
<span<?php echo $t_kapal_grid->DischRate->viewAttributes() ?>><?php echo $t_kapal_grid->DischRate->getViewValue() ?></span>
</span>
<?php if (!$t_kapal->isConfirm()) { ?>
<input type="hidden" data-table="t_kapal" data-field="x_DischRate" name="x<?php echo $t_kapal_grid->RowIndex ?>_DischRate" id="x<?php echo $t_kapal_grid->RowIndex ?>_DischRate" value="<?php echo HtmlEncode($t_kapal_grid->DischRate->FormValue) ?>">
<input type="hidden" data-table="t_kapal" data-field="x_DischRate" name="o<?php echo $t_kapal_grid->RowIndex ?>_DischRate" id="o<?php echo $t_kapal_grid->RowIndex ?>_DischRate" value="<?php echo HtmlEncode($t_kapal_grid->DischRate->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_kapal" data-field="x_DischRate" name="ft_kapalgrid$x<?php echo $t_kapal_grid->RowIndex ?>_DischRate" id="ft_kapalgrid$x<?php echo $t_kapal_grid->RowIndex ?>_DischRate" value="<?php echo HtmlEncode($t_kapal_grid->DischRate->FormValue) ?>">
<input type="hidden" data-table="t_kapal" data-field="x_DischRate" name="ft_kapalgrid$o<?php echo $t_kapal_grid->RowIndex ?>_DischRate" id="ft_kapalgrid$o<?php echo $t_kapal_grid->RowIndex ?>_DischRate" value="<?php echo HtmlEncode($t_kapal_grid->DischRate->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_kapal_grid->TCH->Visible) { // TCH ?>
		<td data-name="TCH" <?php echo $t_kapal_grid->TCH->cellAttributes() ?>>
<?php if ($t_kapal->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_kapal_grid->RowCount ?>_t_kapal_TCH" class="form-group">
<input type="text" data-table="t_kapal" data-field="x_TCH" name="x<?php echo $t_kapal_grid->RowIndex ?>_TCH" id="x<?php echo $t_kapal_grid->RowIndex ?>_TCH" size="10" maxlength="14" placeholder="<?php echo HtmlEncode($t_kapal_grid->TCH->getPlaceHolder()) ?>" value="<?php echo $t_kapal_grid->TCH->EditValue ?>"<?php echo $t_kapal_grid->TCH->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_kapal" data-field="x_TCH" name="o<?php echo $t_kapal_grid->RowIndex ?>_TCH" id="o<?php echo $t_kapal_grid->RowIndex ?>_TCH" value="<?php echo HtmlEncode($t_kapal_grid->TCH->OldValue) ?>">
<?php } ?>
<?php if ($t_kapal->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_kapal_grid->RowCount ?>_t_kapal_TCH" class="form-group">
<input type="text" data-table="t_kapal" data-field="x_TCH" name="x<?php echo $t_kapal_grid->RowIndex ?>_TCH" id="x<?php echo $t_kapal_grid->RowIndex ?>_TCH" size="10" maxlength="14" placeholder="<?php echo HtmlEncode($t_kapal_grid->TCH->getPlaceHolder()) ?>" value="<?php echo $t_kapal_grid->TCH->EditValue ?>"<?php echo $t_kapal_grid->TCH->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($t_kapal->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_kapal_grid->RowCount ?>_t_kapal_TCH">
<span<?php echo $t_kapal_grid->TCH->viewAttributes() ?>><?php echo $t_kapal_grid->TCH->getViewValue() ?></span>
</span>
<?php if (!$t_kapal->isConfirm()) { ?>
<input type="hidden" data-table="t_kapal" data-field="x_TCH" name="x<?php echo $t_kapal_grid->RowIndex ?>_TCH" id="x<?php echo $t_kapal_grid->RowIndex ?>_TCH" value="<?php echo HtmlEncode($t_kapal_grid->TCH->FormValue) ?>">
<input type="hidden" data-table="t_kapal" data-field="x_TCH" name="o<?php echo $t_kapal_grid->RowIndex ?>_TCH" id="o<?php echo $t_kapal_grid->RowIndex ?>_TCH" value="<?php echo HtmlEncode($t_kapal_grid->TCH->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_kapal" data-field="x_TCH" name="ft_kapalgrid$x<?php echo $t_kapal_grid->RowIndex ?>_TCH" id="ft_kapalgrid$x<?php echo $t_kapal_grid->RowIndex ?>_TCH" value="<?php echo HtmlEncode($t_kapal_grid->TCH->FormValue) ?>">
<input type="hidden" data-table="t_kapal" data-field="x_TCH" name="ft_kapalgrid$o<?php echo $t_kapal_grid->RowIndex ?>_TCH" id="ft_kapalgrid$o<?php echo $t_kapal_grid->RowIndex ?>_TCH" value="<?php echo HtmlEncode($t_kapal_grid->TCH->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_kapal_grid->VarCost->Visible) { // VarCost ?>
		<td data-name="VarCost" <?php echo $t_kapal_grid->VarCost->cellAttributes() ?>>
<?php if ($t_kapal->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_kapal_grid->RowCount ?>_t_kapal_VarCost" class="form-group">
<input type="text" data-table="t_kapal" data-field="x_VarCost" name="x<?php echo $t_kapal_grid->RowIndex ?>_VarCost" id="x<?php echo $t_kapal_grid->RowIndex ?>_VarCost" size="10" maxlength="14" placeholder="<?php echo HtmlEncode($t_kapal_grid->VarCost->getPlaceHolder()) ?>" value="<?php echo $t_kapal_grid->VarCost->EditValue ?>"<?php echo $t_kapal_grid->VarCost->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_kapal" data-field="x_VarCost" name="o<?php echo $t_kapal_grid->RowIndex ?>_VarCost" id="o<?php echo $t_kapal_grid->RowIndex ?>_VarCost" value="<?php echo HtmlEncode($t_kapal_grid->VarCost->OldValue) ?>">
<?php } ?>
<?php if ($t_kapal->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_kapal_grid->RowCount ?>_t_kapal_VarCost" class="form-group">
<input type="text" data-table="t_kapal" data-field="x_VarCost" name="x<?php echo $t_kapal_grid->RowIndex ?>_VarCost" id="x<?php echo $t_kapal_grid->RowIndex ?>_VarCost" size="10" maxlength="14" placeholder="<?php echo HtmlEncode($t_kapal_grid->VarCost->getPlaceHolder()) ?>" value="<?php echo $t_kapal_grid->VarCost->EditValue ?>"<?php echo $t_kapal_grid->VarCost->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($t_kapal->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_kapal_grid->RowCount ?>_t_kapal_VarCost">
<span<?php echo $t_kapal_grid->VarCost->viewAttributes() ?>><?php echo $t_kapal_grid->VarCost->getViewValue() ?></span>
</span>
<?php if (!$t_kapal->isConfirm()) { ?>
<input type="hidden" data-table="t_kapal" data-field="x_VarCost" name="x<?php echo $t_kapal_grid->RowIndex ?>_VarCost" id="x<?php echo $t_kapal_grid->RowIndex ?>_VarCost" value="<?php echo HtmlEncode($t_kapal_grid->VarCost->FormValue) ?>">
<input type="hidden" data-table="t_kapal" data-field="x_VarCost" name="o<?php echo $t_kapal_grid->RowIndex ?>_VarCost" id="o<?php echo $t_kapal_grid->RowIndex ?>_VarCost" value="<?php echo HtmlEncode($t_kapal_grid->VarCost->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_kapal" data-field="x_VarCost" name="ft_kapalgrid$x<?php echo $t_kapal_grid->RowIndex ?>_VarCost" id="ft_kapalgrid$x<?php echo $t_kapal_grid->RowIndex ?>_VarCost" value="<?php echo HtmlEncode($t_kapal_grid->VarCost->FormValue) ?>">
<input type="hidden" data-table="t_kapal" data-field="x_VarCost" name="ft_kapalgrid$o<?php echo $t_kapal_grid->RowIndex ?>_VarCost" id="ft_kapalgrid$o<?php echo $t_kapal_grid->RowIndex ?>_VarCost" value="<?php echo HtmlEncode($t_kapal_grid->VarCost->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_kapal_grid->VsLaden->Visible) { // VsLaden ?>
		<td data-name="VsLaden" <?php echo $t_kapal_grid->VsLaden->cellAttributes() ?>>
<?php if ($t_kapal->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_kapal_grid->RowCount ?>_t_kapal_VsLaden" class="form-group">
<input type="text" data-table="t_kapal" data-field="x_VsLaden" name="x<?php echo $t_kapal_grid->RowIndex ?>_VsLaden" id="x<?php echo $t_kapal_grid->RowIndex ?>_VsLaden" size="10" maxlength="14" placeholder="<?php echo HtmlEncode($t_kapal_grid->VsLaden->getPlaceHolder()) ?>" value="<?php echo $t_kapal_grid->VsLaden->EditValue ?>"<?php echo $t_kapal_grid->VsLaden->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_kapal" data-field="x_VsLaden" name="o<?php echo $t_kapal_grid->RowIndex ?>_VsLaden" id="o<?php echo $t_kapal_grid->RowIndex ?>_VsLaden" value="<?php echo HtmlEncode($t_kapal_grid->VsLaden->OldValue) ?>">
<?php } ?>
<?php if ($t_kapal->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_kapal_grid->RowCount ?>_t_kapal_VsLaden" class="form-group">
<input type="text" data-table="t_kapal" data-field="x_VsLaden" name="x<?php echo $t_kapal_grid->RowIndex ?>_VsLaden" id="x<?php echo $t_kapal_grid->RowIndex ?>_VsLaden" size="10" maxlength="14" placeholder="<?php echo HtmlEncode($t_kapal_grid->VsLaden->getPlaceHolder()) ?>" value="<?php echo $t_kapal_grid->VsLaden->EditValue ?>"<?php echo $t_kapal_grid->VsLaden->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($t_kapal->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_kapal_grid->RowCount ?>_t_kapal_VsLaden">
<span<?php echo $t_kapal_grid->VsLaden->viewAttributes() ?>><?php echo $t_kapal_grid->VsLaden->getViewValue() ?></span>
</span>
<?php if (!$t_kapal->isConfirm()) { ?>
<input type="hidden" data-table="t_kapal" data-field="x_VsLaden" name="x<?php echo $t_kapal_grid->RowIndex ?>_VsLaden" id="x<?php echo $t_kapal_grid->RowIndex ?>_VsLaden" value="<?php echo HtmlEncode($t_kapal_grid->VsLaden->FormValue) ?>">
<input type="hidden" data-table="t_kapal" data-field="x_VsLaden" name="o<?php echo $t_kapal_grid->RowIndex ?>_VsLaden" id="o<?php echo $t_kapal_grid->RowIndex ?>_VsLaden" value="<?php echo HtmlEncode($t_kapal_grid->VsLaden->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_kapal" data-field="x_VsLaden" name="ft_kapalgrid$x<?php echo $t_kapal_grid->RowIndex ?>_VsLaden" id="ft_kapalgrid$x<?php echo $t_kapal_grid->RowIndex ?>_VsLaden" value="<?php echo HtmlEncode($t_kapal_grid->VsLaden->FormValue) ?>">
<input type="hidden" data-table="t_kapal" data-field="x_VsLaden" name="ft_kapalgrid$o<?php echo $t_kapal_grid->RowIndex ?>_VsLaden" id="ft_kapalgrid$o<?php echo $t_kapal_grid->RowIndex ?>_VsLaden" value="<?php echo HtmlEncode($t_kapal_grid->VsLaden->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_kapal_grid->VsBallast->Visible) { // VsBallast ?>
		<td data-name="VsBallast" <?php echo $t_kapal_grid->VsBallast->cellAttributes() ?>>
<?php if ($t_kapal->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_kapal_grid->RowCount ?>_t_kapal_VsBallast" class="form-group">
<input type="text" data-table="t_kapal" data-field="x_VsBallast" name="x<?php echo $t_kapal_grid->RowIndex ?>_VsBallast" id="x<?php echo $t_kapal_grid->RowIndex ?>_VsBallast" size="10" maxlength="14" placeholder="<?php echo HtmlEncode($t_kapal_grid->VsBallast->getPlaceHolder()) ?>" value="<?php echo $t_kapal_grid->VsBallast->EditValue ?>"<?php echo $t_kapal_grid->VsBallast->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_kapal" data-field="x_VsBallast" name="o<?php echo $t_kapal_grid->RowIndex ?>_VsBallast" id="o<?php echo $t_kapal_grid->RowIndex ?>_VsBallast" value="<?php echo HtmlEncode($t_kapal_grid->VsBallast->OldValue) ?>">
<?php } ?>
<?php if ($t_kapal->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_kapal_grid->RowCount ?>_t_kapal_VsBallast" class="form-group">
<input type="text" data-table="t_kapal" data-field="x_VsBallast" name="x<?php echo $t_kapal_grid->RowIndex ?>_VsBallast" id="x<?php echo $t_kapal_grid->RowIndex ?>_VsBallast" size="10" maxlength="14" placeholder="<?php echo HtmlEncode($t_kapal_grid->VsBallast->getPlaceHolder()) ?>" value="<?php echo $t_kapal_grid->VsBallast->EditValue ?>"<?php echo $t_kapal_grid->VsBallast->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($t_kapal->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_kapal_grid->RowCount ?>_t_kapal_VsBallast">
<span<?php echo $t_kapal_grid->VsBallast->viewAttributes() ?>><?php echo $t_kapal_grid->VsBallast->getViewValue() ?></span>
</span>
<?php if (!$t_kapal->isConfirm()) { ?>
<input type="hidden" data-table="t_kapal" data-field="x_VsBallast" name="x<?php echo $t_kapal_grid->RowIndex ?>_VsBallast" id="x<?php echo $t_kapal_grid->RowIndex ?>_VsBallast" value="<?php echo HtmlEncode($t_kapal_grid->VsBallast->FormValue) ?>">
<input type="hidden" data-table="t_kapal" data-field="x_VsBallast" name="o<?php echo $t_kapal_grid->RowIndex ?>_VsBallast" id="o<?php echo $t_kapal_grid->RowIndex ?>_VsBallast" value="<?php echo HtmlEncode($t_kapal_grid->VsBallast->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_kapal" data-field="x_VsBallast" name="ft_kapalgrid$x<?php echo $t_kapal_grid->RowIndex ?>_VsBallast" id="ft_kapalgrid$x<?php echo $t_kapal_grid->RowIndex ?>_VsBallast" value="<?php echo HtmlEncode($t_kapal_grid->VsBallast->FormValue) ?>">
<input type="hidden" data-table="t_kapal" data-field="x_VsBallast" name="ft_kapalgrid$o<?php echo $t_kapal_grid->RowIndex ?>_VsBallast" id="ft_kapalgrid$o<?php echo $t_kapal_grid->RowIndex ?>_VsBallast" value="<?php echo HtmlEncode($t_kapal_grid->VsBallast->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_kapal_grid->ComDay->Visible) { // ComDay ?>
		<td data-name="ComDay" <?php echo $t_kapal_grid->ComDay->cellAttributes() ?>>
<?php if ($t_kapal->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_kapal_grid->RowCount ?>_t_kapal_ComDay" class="form-group">
<input type="text" data-table="t_kapal" data-field="x_ComDay" name="x<?php echo $t_kapal_grid->RowIndex ?>_ComDay" id="x<?php echo $t_kapal_grid->RowIndex ?>_ComDay" size="10" maxlength="14" placeholder="<?php echo HtmlEncode($t_kapal_grid->ComDay->getPlaceHolder()) ?>" value="<?php echo $t_kapal_grid->ComDay->EditValue ?>"<?php echo $t_kapal_grid->ComDay->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_kapal" data-field="x_ComDay" name="o<?php echo $t_kapal_grid->RowIndex ?>_ComDay" id="o<?php echo $t_kapal_grid->RowIndex ?>_ComDay" value="<?php echo HtmlEncode($t_kapal_grid->ComDay->OldValue) ?>">
<?php } ?>
<?php if ($t_kapal->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_kapal_grid->RowCount ?>_t_kapal_ComDay" class="form-group">
<input type="text" data-table="t_kapal" data-field="x_ComDay" name="x<?php echo $t_kapal_grid->RowIndex ?>_ComDay" id="x<?php echo $t_kapal_grid->RowIndex ?>_ComDay" size="10" maxlength="14" placeholder="<?php echo HtmlEncode($t_kapal_grid->ComDay->getPlaceHolder()) ?>" value="<?php echo $t_kapal_grid->ComDay->EditValue ?>"<?php echo $t_kapal_grid->ComDay->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($t_kapal->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_kapal_grid->RowCount ?>_t_kapal_ComDay">
<span<?php echo $t_kapal_grid->ComDay->viewAttributes() ?>><?php echo $t_kapal_grid->ComDay->getViewValue() ?></span>
</span>
<?php if (!$t_kapal->isConfirm()) { ?>
<input type="hidden" data-table="t_kapal" data-field="x_ComDay" name="x<?php echo $t_kapal_grid->RowIndex ?>_ComDay" id="x<?php echo $t_kapal_grid->RowIndex ?>_ComDay" value="<?php echo HtmlEncode($t_kapal_grid->ComDay->FormValue) ?>">
<input type="hidden" data-table="t_kapal" data-field="x_ComDay" name="o<?php echo $t_kapal_grid->RowIndex ?>_ComDay" id="o<?php echo $t_kapal_grid->RowIndex ?>_ComDay" value="<?php echo HtmlEncode($t_kapal_grid->ComDay->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_kapal" data-field="x_ComDay" name="ft_kapalgrid$x<?php echo $t_kapal_grid->RowIndex ?>_ComDay" id="ft_kapalgrid$x<?php echo $t_kapal_grid->RowIndex ?>_ComDay" value="<?php echo HtmlEncode($t_kapal_grid->ComDay->FormValue) ?>">
<input type="hidden" data-table="t_kapal" data-field="x_ComDay" name="ft_kapalgrid$o<?php echo $t_kapal_grid->RowIndex ?>_ComDay" id="ft_kapalgrid$o<?php echo $t_kapal_grid->RowIndex ?>_ComDay" value="<?php echo HtmlEncode($t_kapal_grid->ComDay->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t_kapal_grid->ListOptions->render("body", "right", $t_kapal_grid->RowCount);
?>
	</tr>
<?php if ($t_kapal->RowType == ROWTYPE_ADD || $t_kapal->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["ft_kapalgrid", "load"], function() {
	ft_kapalgrid.updateLists(<?php echo $t_kapal_grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$t_kapal_grid->isGridAdd() || $t_kapal->CurrentMode == "copy")
		if (!$t_kapal_grid->Recordset->EOF)
			$t_kapal_grid->Recordset->moveNext();
}
?>
<?php
	if ($t_kapal->CurrentMode == "add" || $t_kapal->CurrentMode == "copy" || $t_kapal->CurrentMode == "edit") {
		$t_kapal_grid->RowIndex = '$rowindex$';
		$t_kapal_grid->loadRowValues();

		// Set row properties
		$t_kapal->resetAttributes();
		$t_kapal->RowAttrs->merge(["data-rowindex" => $t_kapal_grid->RowIndex, "id" => "r0_t_kapal", "data-rowtype" => ROWTYPE_ADD]);
		$t_kapal->RowAttrs->appendClass("ew-template");
		$t_kapal->RowType = ROWTYPE_ADD;

		// Render row
		$t_kapal_grid->renderRow();

		// Render list options
		$t_kapal_grid->renderListOptions();
		$t_kapal_grid->StartRowCount = 0;
?>
	<tr <?php echo $t_kapal->rowAttributes() ?>>
<?php

// Render list options (body, left)
$t_kapal_grid->ListOptions->render("body", "left", $t_kapal_grid->RowIndex);
?>
	<?php if ($t_kapal_grid->Payload->Visible) { // Payload ?>
		<td data-name="Payload">
<?php if (!$t_kapal->isConfirm()) { ?>
<span id="el$rowindex$_t_kapal_Payload" class="form-group t_kapal_Payload">
<input type="text" data-table="t_kapal" data-field="x_Payload" name="x<?php echo $t_kapal_grid->RowIndex ?>_Payload" id="x<?php echo $t_kapal_grid->RowIndex ?>_Payload" size="10" maxlength="14" placeholder="<?php echo HtmlEncode($t_kapal_grid->Payload->getPlaceHolder()) ?>" value="<?php echo $t_kapal_grid->Payload->EditValue ?>"<?php echo $t_kapal_grid->Payload->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_kapal_Payload" class="form-group t_kapal_Payload">
<span<?php echo $t_kapal_grid->Payload->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_kapal_grid->Payload->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_kapal" data-field="x_Payload" name="x<?php echo $t_kapal_grid->RowIndex ?>_Payload" id="x<?php echo $t_kapal_grid->RowIndex ?>_Payload" value="<?php echo HtmlEncode($t_kapal_grid->Payload->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_kapal" data-field="x_Payload" name="o<?php echo $t_kapal_grid->RowIndex ?>_Payload" id="o<?php echo $t_kapal_grid->RowIndex ?>_Payload" value="<?php echo HtmlEncode($t_kapal_grid->Payload->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_kapal_grid->DischRate->Visible) { // DischRate ?>
		<td data-name="DischRate">
<?php if (!$t_kapal->isConfirm()) { ?>
<span id="el$rowindex$_t_kapal_DischRate" class="form-group t_kapal_DischRate">
<input type="text" data-table="t_kapal" data-field="x_DischRate" name="x<?php echo $t_kapal_grid->RowIndex ?>_DischRate" id="x<?php echo $t_kapal_grid->RowIndex ?>_DischRate" size="10" maxlength="14" placeholder="<?php echo HtmlEncode($t_kapal_grid->DischRate->getPlaceHolder()) ?>" value="<?php echo $t_kapal_grid->DischRate->EditValue ?>"<?php echo $t_kapal_grid->DischRate->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_kapal_DischRate" class="form-group t_kapal_DischRate">
<span<?php echo $t_kapal_grid->DischRate->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_kapal_grid->DischRate->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_kapal" data-field="x_DischRate" name="x<?php echo $t_kapal_grid->RowIndex ?>_DischRate" id="x<?php echo $t_kapal_grid->RowIndex ?>_DischRate" value="<?php echo HtmlEncode($t_kapal_grid->DischRate->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_kapal" data-field="x_DischRate" name="o<?php echo $t_kapal_grid->RowIndex ?>_DischRate" id="o<?php echo $t_kapal_grid->RowIndex ?>_DischRate" value="<?php echo HtmlEncode($t_kapal_grid->DischRate->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_kapal_grid->TCH->Visible) { // TCH ?>
		<td data-name="TCH">
<?php if (!$t_kapal->isConfirm()) { ?>
<span id="el$rowindex$_t_kapal_TCH" class="form-group t_kapal_TCH">
<input type="text" data-table="t_kapal" data-field="x_TCH" name="x<?php echo $t_kapal_grid->RowIndex ?>_TCH" id="x<?php echo $t_kapal_grid->RowIndex ?>_TCH" size="10" maxlength="14" placeholder="<?php echo HtmlEncode($t_kapal_grid->TCH->getPlaceHolder()) ?>" value="<?php echo $t_kapal_grid->TCH->EditValue ?>"<?php echo $t_kapal_grid->TCH->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_kapal_TCH" class="form-group t_kapal_TCH">
<span<?php echo $t_kapal_grid->TCH->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_kapal_grid->TCH->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_kapal" data-field="x_TCH" name="x<?php echo $t_kapal_grid->RowIndex ?>_TCH" id="x<?php echo $t_kapal_grid->RowIndex ?>_TCH" value="<?php echo HtmlEncode($t_kapal_grid->TCH->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_kapal" data-field="x_TCH" name="o<?php echo $t_kapal_grid->RowIndex ?>_TCH" id="o<?php echo $t_kapal_grid->RowIndex ?>_TCH" value="<?php echo HtmlEncode($t_kapal_grid->TCH->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_kapal_grid->VarCost->Visible) { // VarCost ?>
		<td data-name="VarCost">
<?php if (!$t_kapal->isConfirm()) { ?>
<span id="el$rowindex$_t_kapal_VarCost" class="form-group t_kapal_VarCost">
<input type="text" data-table="t_kapal" data-field="x_VarCost" name="x<?php echo $t_kapal_grid->RowIndex ?>_VarCost" id="x<?php echo $t_kapal_grid->RowIndex ?>_VarCost" size="10" maxlength="14" placeholder="<?php echo HtmlEncode($t_kapal_grid->VarCost->getPlaceHolder()) ?>" value="<?php echo $t_kapal_grid->VarCost->EditValue ?>"<?php echo $t_kapal_grid->VarCost->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_kapal_VarCost" class="form-group t_kapal_VarCost">
<span<?php echo $t_kapal_grid->VarCost->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_kapal_grid->VarCost->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_kapal" data-field="x_VarCost" name="x<?php echo $t_kapal_grid->RowIndex ?>_VarCost" id="x<?php echo $t_kapal_grid->RowIndex ?>_VarCost" value="<?php echo HtmlEncode($t_kapal_grid->VarCost->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_kapal" data-field="x_VarCost" name="o<?php echo $t_kapal_grid->RowIndex ?>_VarCost" id="o<?php echo $t_kapal_grid->RowIndex ?>_VarCost" value="<?php echo HtmlEncode($t_kapal_grid->VarCost->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_kapal_grid->VsLaden->Visible) { // VsLaden ?>
		<td data-name="VsLaden">
<?php if (!$t_kapal->isConfirm()) { ?>
<span id="el$rowindex$_t_kapal_VsLaden" class="form-group t_kapal_VsLaden">
<input type="text" data-table="t_kapal" data-field="x_VsLaden" name="x<?php echo $t_kapal_grid->RowIndex ?>_VsLaden" id="x<?php echo $t_kapal_grid->RowIndex ?>_VsLaden" size="10" maxlength="14" placeholder="<?php echo HtmlEncode($t_kapal_grid->VsLaden->getPlaceHolder()) ?>" value="<?php echo $t_kapal_grid->VsLaden->EditValue ?>"<?php echo $t_kapal_grid->VsLaden->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_kapal_VsLaden" class="form-group t_kapal_VsLaden">
<span<?php echo $t_kapal_grid->VsLaden->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_kapal_grid->VsLaden->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_kapal" data-field="x_VsLaden" name="x<?php echo $t_kapal_grid->RowIndex ?>_VsLaden" id="x<?php echo $t_kapal_grid->RowIndex ?>_VsLaden" value="<?php echo HtmlEncode($t_kapal_grid->VsLaden->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_kapal" data-field="x_VsLaden" name="o<?php echo $t_kapal_grid->RowIndex ?>_VsLaden" id="o<?php echo $t_kapal_grid->RowIndex ?>_VsLaden" value="<?php echo HtmlEncode($t_kapal_grid->VsLaden->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_kapal_grid->VsBallast->Visible) { // VsBallast ?>
		<td data-name="VsBallast">
<?php if (!$t_kapal->isConfirm()) { ?>
<span id="el$rowindex$_t_kapal_VsBallast" class="form-group t_kapal_VsBallast">
<input type="text" data-table="t_kapal" data-field="x_VsBallast" name="x<?php echo $t_kapal_grid->RowIndex ?>_VsBallast" id="x<?php echo $t_kapal_grid->RowIndex ?>_VsBallast" size="10" maxlength="14" placeholder="<?php echo HtmlEncode($t_kapal_grid->VsBallast->getPlaceHolder()) ?>" value="<?php echo $t_kapal_grid->VsBallast->EditValue ?>"<?php echo $t_kapal_grid->VsBallast->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_kapal_VsBallast" class="form-group t_kapal_VsBallast">
<span<?php echo $t_kapal_grid->VsBallast->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_kapal_grid->VsBallast->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_kapal" data-field="x_VsBallast" name="x<?php echo $t_kapal_grid->RowIndex ?>_VsBallast" id="x<?php echo $t_kapal_grid->RowIndex ?>_VsBallast" value="<?php echo HtmlEncode($t_kapal_grid->VsBallast->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_kapal" data-field="x_VsBallast" name="o<?php echo $t_kapal_grid->RowIndex ?>_VsBallast" id="o<?php echo $t_kapal_grid->RowIndex ?>_VsBallast" value="<?php echo HtmlEncode($t_kapal_grid->VsBallast->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_kapal_grid->ComDay->Visible) { // ComDay ?>
		<td data-name="ComDay">
<?php if (!$t_kapal->isConfirm()) { ?>
<span id="el$rowindex$_t_kapal_ComDay" class="form-group t_kapal_ComDay">
<input type="text" data-table="t_kapal" data-field="x_ComDay" name="x<?php echo $t_kapal_grid->RowIndex ?>_ComDay" id="x<?php echo $t_kapal_grid->RowIndex ?>_ComDay" size="10" maxlength="14" placeholder="<?php echo HtmlEncode($t_kapal_grid->ComDay->getPlaceHolder()) ?>" value="<?php echo $t_kapal_grid->ComDay->EditValue ?>"<?php echo $t_kapal_grid->ComDay->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_kapal_ComDay" class="form-group t_kapal_ComDay">
<span<?php echo $t_kapal_grid->ComDay->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($t_kapal_grid->ComDay->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="t_kapal" data-field="x_ComDay" name="x<?php echo $t_kapal_grid->RowIndex ?>_ComDay" id="x<?php echo $t_kapal_grid->RowIndex ?>_ComDay" value="<?php echo HtmlEncode($t_kapal_grid->ComDay->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_kapal" data-field="x_ComDay" name="o<?php echo $t_kapal_grid->RowIndex ?>_ComDay" id="o<?php echo $t_kapal_grid->RowIndex ?>_ComDay" value="<?php echo HtmlEncode($t_kapal_grid->ComDay->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t_kapal_grid->ListOptions->render("body", "right", $t_kapal_grid->RowIndex);
?>
<script>
loadjs.ready(["ft_kapalgrid", "load"], function() {
	ft_kapalgrid.updateLists(<?php echo $t_kapal_grid->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($t_kapal->CurrentMode == "add" || $t_kapal->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $t_kapal_grid->FormKeyCountName ?>" id="<?php echo $t_kapal_grid->FormKeyCountName ?>" value="<?php echo $t_kapal_grid->KeyCount ?>">
<?php echo $t_kapal_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($t_kapal->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $t_kapal_grid->FormKeyCountName ?>" id="<?php echo $t_kapal_grid->FormKeyCountName ?>" value="<?php echo $t_kapal_grid->KeyCount ?>">
<?php echo $t_kapal_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($t_kapal->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="ft_kapalgrid">
</div><!-- /.ew-list-form -->
<?php

// Close recordset
if ($t_kapal_grid->Recordset)
	$t_kapal_grid->Recordset->Close();
?>
<?php if ($t_kapal_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $t_kapal_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($t_kapal_grid->TotalRecords == 0 && !$t_kapal->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $t_kapal_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$t_kapal_grid->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php
$t_kapal_grid->terminate();
?>