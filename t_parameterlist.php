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
$t_parameter_list = new t_parameter_list();

// Run the page
$t_parameter_list->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_parameter_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$t_parameter_list->isExport()) { ?>
<script>
var ft_parameterlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	ft_parameterlist = currentForm = new ew.Form("ft_parameterlist", "list");
	ft_parameterlist.formKeyCountName = '<?php echo $t_parameter_list->FormKeyCountName ?>';

	// Validate form
	ft_parameterlist.validate = function() {
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
			<?php if ($t_parameter_list->Parameter->Required) { ?>
				elm = this.getElements("x" + infix + "_Parameter");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_parameter_list->Parameter->caption(), $t_parameter_list->Parameter->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_parameter_list->Nilai->Required) { ?>
				elm = this.getElements("x" + infix + "_Nilai");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_parameter_list->Nilai->caption(), $t_parameter_list->Nilai->RequiredErrorMessage)) ?>");
			<?php } ?>

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		if (gridinsert && addcnt == 0) { // No row added
			ew.alert(ew.language.phrase("NoAddRecord"));
			return false;
		}
		return true;
	}

	// Check empty row
	ft_parameterlist.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "Parameter", false)) return false;
		if (ew.valueChanged(fobj, infix, "Nilai", false)) return false;
		return true;
	}

	// Form_CustomValidate
	ft_parameterlist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ft_parameterlist.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("ft_parameterlist");
});
var ft_parameterlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	ft_parameterlistsrch = currentSearchForm = new ew.Form("ft_parameterlistsrch");

	// Dynamic selection lists
	// Filters

	ft_parameterlistsrch.filterList = <?php echo $t_parameter_list->getFilterList() ?>;
	loadjs.done("ft_parameterlistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$t_parameter_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($t_parameter_list->TotalRecords > 0 && $t_parameter_list->ExportOptions->visible()) { ?>
<?php $t_parameter_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($t_parameter_list->ImportOptions->visible()) { ?>
<?php $t_parameter_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($t_parameter_list->SearchOptions->visible()) { ?>
<?php $t_parameter_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($t_parameter_list->FilterOptions->visible()) { ?>
<?php $t_parameter_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$t_parameter_list->renderOtherOptions();
?>
<?php if (!$t_parameter_list->isExport() && !$t_parameter->CurrentAction) { ?>
<form name="ft_parameterlistsrch" id="ft_parameterlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="ft_parameterlistsrch-search-panel" class="<?php echo $t_parameter_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="t_parameter">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $t_parameter_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($t_parameter_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($t_parameter_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $t_parameter_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($t_parameter_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($t_parameter_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($t_parameter_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($t_parameter_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php $t_parameter_list->showPageHeader(); ?>
<?php
$t_parameter_list->showMessage();
?>
<?php if ($t_parameter_list->TotalRecords > 0 || $t_parameter->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($t_parameter_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> t_parameter">
<form name="ft_parameterlist" id="ft_parameterlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_parameter">
<div id="gmp_t_parameter" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($t_parameter_list->TotalRecords > 0 || $t_parameter_list->isGridEdit()) { ?>
<table id="tbl_t_parameterlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$t_parameter->RowType = ROWTYPE_HEADER;

// Render list options
$t_parameter_list->renderListOptions();

// Render list options (header, left)
$t_parameter_list->ListOptions->render("header", "left");
?>
<?php if ($t_parameter_list->Parameter->Visible) { // Parameter ?>
	<?php if ($t_parameter_list->SortUrl($t_parameter_list->Parameter) == "") { ?>
		<th data-name="Parameter" class="<?php echo $t_parameter_list->Parameter->headerCellClass() ?>"><div id="elh_t_parameter_Parameter" class="t_parameter_Parameter"><div class="ew-table-header-caption"><?php echo $t_parameter_list->Parameter->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Parameter" class="<?php echo $t_parameter_list->Parameter->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_parameter_list->SortUrl($t_parameter_list->Parameter) ?>', 1);"><div id="elh_t_parameter_Parameter" class="t_parameter_Parameter">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_parameter_list->Parameter->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($t_parameter_list->Parameter->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_parameter_list->Parameter->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_parameter_list->Nilai->Visible) { // Nilai ?>
	<?php if ($t_parameter_list->SortUrl($t_parameter_list->Nilai) == "") { ?>
		<th data-name="Nilai" class="<?php echo $t_parameter_list->Nilai->headerCellClass() ?>"><div id="elh_t_parameter_Nilai" class="t_parameter_Nilai"><div class="ew-table-header-caption"><?php echo $t_parameter_list->Nilai->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Nilai" class="<?php echo $t_parameter_list->Nilai->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_parameter_list->SortUrl($t_parameter_list->Nilai) ?>', 1);"><div id="elh_t_parameter_Nilai" class="t_parameter_Nilai">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_parameter_list->Nilai->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($t_parameter_list->Nilai->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_parameter_list->Nilai->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$t_parameter_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($t_parameter_list->ExportAll && $t_parameter_list->isExport()) {
	$t_parameter_list->StopRecord = $t_parameter_list->TotalRecords;
} else {

	// Set the last record to display
	if ($t_parameter_list->TotalRecords > $t_parameter_list->StartRecord + $t_parameter_list->DisplayRecords - 1)
		$t_parameter_list->StopRecord = $t_parameter_list->StartRecord + $t_parameter_list->DisplayRecords - 1;
	else
		$t_parameter_list->StopRecord = $t_parameter_list->TotalRecords;
}

// Restore number of post back records
if ($CurrentForm && ($t_parameter->isConfirm() || $t_parameter_list->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($t_parameter_list->FormKeyCountName) && ($t_parameter_list->isGridAdd() || $t_parameter_list->isGridEdit() || $t_parameter->isConfirm())) {
		$t_parameter_list->KeyCount = $CurrentForm->getValue($t_parameter_list->FormKeyCountName);
		$t_parameter_list->StopRecord = $t_parameter_list->StartRecord + $t_parameter_list->KeyCount - 1;
	}
}
$t_parameter_list->RecordCount = $t_parameter_list->StartRecord - 1;
if ($t_parameter_list->Recordset && !$t_parameter_list->Recordset->EOF) {
	$t_parameter_list->Recordset->moveFirst();
	$selectLimit = $t_parameter_list->UseSelectLimit;
	if (!$selectLimit && $t_parameter_list->StartRecord > 1)
		$t_parameter_list->Recordset->move($t_parameter_list->StartRecord - 1);
} elseif (!$t_parameter->AllowAddDeleteRow && $t_parameter_list->StopRecord == 0) {
	$t_parameter_list->StopRecord = $t_parameter->GridAddRowCount;
}

// Initialize aggregate
$t_parameter->RowType = ROWTYPE_AGGREGATEINIT;
$t_parameter->resetAttributes();
$t_parameter_list->renderRow();
if ($t_parameter_list->isGridAdd())
	$t_parameter_list->RowIndex = 0;
if ($t_parameter_list->isGridEdit())
	$t_parameter_list->RowIndex = 0;
while ($t_parameter_list->RecordCount < $t_parameter_list->StopRecord) {
	$t_parameter_list->RecordCount++;
	if ($t_parameter_list->RecordCount >= $t_parameter_list->StartRecord) {
		$t_parameter_list->RowCount++;
		if ($t_parameter_list->isGridAdd() || $t_parameter_list->isGridEdit() || $t_parameter->isConfirm()) {
			$t_parameter_list->RowIndex++;
			$CurrentForm->Index = $t_parameter_list->RowIndex;
			if ($CurrentForm->hasValue($t_parameter_list->FormActionName) && ($t_parameter->isConfirm() || $t_parameter_list->EventCancelled))
				$t_parameter_list->RowAction = strval($CurrentForm->getValue($t_parameter_list->FormActionName));
			elseif ($t_parameter_list->isGridAdd())
				$t_parameter_list->RowAction = "insert";
			else
				$t_parameter_list->RowAction = "";
		}

		// Set up key count
		$t_parameter_list->KeyCount = $t_parameter_list->RowIndex;

		// Init row class and style
		$t_parameter->resetAttributes();
		$t_parameter->CssClass = "";
		if ($t_parameter_list->isGridAdd()) {
			$t_parameter_list->loadRowValues(); // Load default values
		} else {
			$t_parameter_list->loadRowValues($t_parameter_list->Recordset); // Load row values
		}
		$t_parameter->RowType = ROWTYPE_VIEW; // Render view
		if ($t_parameter_list->isGridAdd()) // Grid add
			$t_parameter->RowType = ROWTYPE_ADD; // Render add
		if ($t_parameter_list->isGridAdd() && $t_parameter->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$t_parameter_list->restoreCurrentRowFormValues($t_parameter_list->RowIndex); // Restore form values
		if ($t_parameter_list->isGridEdit()) { // Grid edit
			if ($t_parameter->EventCancelled)
				$t_parameter_list->restoreCurrentRowFormValues($t_parameter_list->RowIndex); // Restore form values
			if ($t_parameter_list->RowAction == "insert")
				$t_parameter->RowType = ROWTYPE_ADD; // Render add
			else
				$t_parameter->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($t_parameter_list->isGridEdit() && ($t_parameter->RowType == ROWTYPE_EDIT || $t_parameter->RowType == ROWTYPE_ADD) && $t_parameter->EventCancelled) // Update failed
			$t_parameter_list->restoreCurrentRowFormValues($t_parameter_list->RowIndex); // Restore form values
		if ($t_parameter->RowType == ROWTYPE_EDIT) // Edit row
			$t_parameter_list->EditRowCount++;

		// Set up row id / data-rowindex
		$t_parameter->RowAttrs->merge(["data-rowindex" => $t_parameter_list->RowCount, "id" => "r" . $t_parameter_list->RowCount . "_t_parameter", "data-rowtype" => $t_parameter->RowType]);

		// Render row
		$t_parameter_list->renderRow();

		// Render list options
		$t_parameter_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($t_parameter_list->RowAction != "delete" && $t_parameter_list->RowAction != "insertdelete" && !($t_parameter_list->RowAction == "insert" && $t_parameter->isConfirm() && $t_parameter_list->emptyRow())) {
?>
	<tr <?php echo $t_parameter->rowAttributes() ?>>
<?php

// Render list options (body, left)
$t_parameter_list->ListOptions->render("body", "left", $t_parameter_list->RowCount);
?>
	<?php if ($t_parameter_list->Parameter->Visible) { // Parameter ?>
		<td data-name="Parameter" <?php echo $t_parameter_list->Parameter->cellAttributes() ?>>
<?php if ($t_parameter->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_parameter_list->RowCount ?>_t_parameter_Parameter" class="form-group">
<textarea data-table="t_parameter" data-field="x_Parameter" name="x<?php echo $t_parameter_list->RowIndex ?>_Parameter" id="x<?php echo $t_parameter_list->RowIndex ?>_Parameter" cols="20" rows="1" placeholder="<?php echo HtmlEncode($t_parameter_list->Parameter->getPlaceHolder()) ?>"<?php echo $t_parameter_list->Parameter->editAttributes() ?>><?php echo $t_parameter_list->Parameter->EditValue ?></textarea>
</span>
<input type="hidden" data-table="t_parameter" data-field="x_Parameter" name="o<?php echo $t_parameter_list->RowIndex ?>_Parameter" id="o<?php echo $t_parameter_list->RowIndex ?>_Parameter" value="<?php echo HtmlEncode($t_parameter_list->Parameter->OldValue) ?>">
<?php } ?>
<?php if ($t_parameter->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_parameter_list->RowCount ?>_t_parameter_Parameter" class="form-group">
<textarea data-table="t_parameter" data-field="x_Parameter" name="x<?php echo $t_parameter_list->RowIndex ?>_Parameter" id="x<?php echo $t_parameter_list->RowIndex ?>_Parameter" cols="20" rows="1" placeholder="<?php echo HtmlEncode($t_parameter_list->Parameter->getPlaceHolder()) ?>"<?php echo $t_parameter_list->Parameter->editAttributes() ?>><?php echo $t_parameter_list->Parameter->EditValue ?></textarea>
</span>
<?php } ?>
<?php if ($t_parameter->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_parameter_list->RowCount ?>_t_parameter_Parameter">
<span<?php echo $t_parameter_list->Parameter->viewAttributes() ?>><?php echo $t_parameter_list->Parameter->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php if ($t_parameter->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="t_parameter" data-field="x_id" name="x<?php echo $t_parameter_list->RowIndex ?>_id" id="x<?php echo $t_parameter_list->RowIndex ?>_id" value="<?php echo HtmlEncode($t_parameter_list->id->CurrentValue) ?>">
<input type="hidden" data-table="t_parameter" data-field="x_id" name="o<?php echo $t_parameter_list->RowIndex ?>_id" id="o<?php echo $t_parameter_list->RowIndex ?>_id" value="<?php echo HtmlEncode($t_parameter_list->id->OldValue) ?>">
<?php } ?>
<?php if ($t_parameter->RowType == ROWTYPE_EDIT || $t_parameter->CurrentMode == "edit") { ?>
<input type="hidden" data-table="t_parameter" data-field="x_id" name="x<?php echo $t_parameter_list->RowIndex ?>_id" id="x<?php echo $t_parameter_list->RowIndex ?>_id" value="<?php echo HtmlEncode($t_parameter_list->id->CurrentValue) ?>">
<?php } ?>
	<?php if ($t_parameter_list->Nilai->Visible) { // Nilai ?>
		<td data-name="Nilai" <?php echo $t_parameter_list->Nilai->cellAttributes() ?>>
<?php if ($t_parameter->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_parameter_list->RowCount ?>_t_parameter_Nilai" class="form-group">
<textarea data-table="t_parameter" data-field="x_Nilai" name="x<?php echo $t_parameter_list->RowIndex ?>_Nilai" id="x<?php echo $t_parameter_list->RowIndex ?>_Nilai" cols="30" rows="1" placeholder="<?php echo HtmlEncode($t_parameter_list->Nilai->getPlaceHolder()) ?>"<?php echo $t_parameter_list->Nilai->editAttributes() ?>><?php echo $t_parameter_list->Nilai->EditValue ?></textarea>
</span>
<input type="hidden" data-table="t_parameter" data-field="x_Nilai" name="o<?php echo $t_parameter_list->RowIndex ?>_Nilai" id="o<?php echo $t_parameter_list->RowIndex ?>_Nilai" value="<?php echo HtmlEncode($t_parameter_list->Nilai->OldValue) ?>">
<?php } ?>
<?php if ($t_parameter->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_parameter_list->RowCount ?>_t_parameter_Nilai" class="form-group">
<textarea data-table="t_parameter" data-field="x_Nilai" name="x<?php echo $t_parameter_list->RowIndex ?>_Nilai" id="x<?php echo $t_parameter_list->RowIndex ?>_Nilai" cols="30" rows="1" placeholder="<?php echo HtmlEncode($t_parameter_list->Nilai->getPlaceHolder()) ?>"<?php echo $t_parameter_list->Nilai->editAttributes() ?>><?php echo $t_parameter_list->Nilai->EditValue ?></textarea>
</span>
<?php } ?>
<?php if ($t_parameter->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_parameter_list->RowCount ?>_t_parameter_Nilai">
<span<?php echo $t_parameter_list->Nilai->viewAttributes() ?>><?php echo $t_parameter_list->Nilai->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t_parameter_list->ListOptions->render("body", "right", $t_parameter_list->RowCount);
?>
	</tr>
<?php if ($t_parameter->RowType == ROWTYPE_ADD || $t_parameter->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["ft_parameterlist", "load"], function() {
	ft_parameterlist.updateLists(<?php echo $t_parameter_list->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$t_parameter_list->isGridAdd())
		if (!$t_parameter_list->Recordset->EOF)
			$t_parameter_list->Recordset->moveNext();
}
?>
<?php
	if ($t_parameter_list->isGridAdd() || $t_parameter_list->isGridEdit()) {
		$t_parameter_list->RowIndex = '$rowindex$';
		$t_parameter_list->loadRowValues();

		// Set row properties
		$t_parameter->resetAttributes();
		$t_parameter->RowAttrs->merge(["data-rowindex" => $t_parameter_list->RowIndex, "id" => "r0_t_parameter", "data-rowtype" => ROWTYPE_ADD]);
		$t_parameter->RowAttrs->appendClass("ew-template");
		$t_parameter->RowType = ROWTYPE_ADD;

		// Render row
		$t_parameter_list->renderRow();

		// Render list options
		$t_parameter_list->renderListOptions();
		$t_parameter_list->StartRowCount = 0;
?>
	<tr <?php echo $t_parameter->rowAttributes() ?>>
<?php

// Render list options (body, left)
$t_parameter_list->ListOptions->render("body", "left", $t_parameter_list->RowIndex);
?>
	<?php if ($t_parameter_list->Parameter->Visible) { // Parameter ?>
		<td data-name="Parameter">
<span id="el$rowindex$_t_parameter_Parameter" class="form-group t_parameter_Parameter">
<textarea data-table="t_parameter" data-field="x_Parameter" name="x<?php echo $t_parameter_list->RowIndex ?>_Parameter" id="x<?php echo $t_parameter_list->RowIndex ?>_Parameter" cols="20" rows="1" placeholder="<?php echo HtmlEncode($t_parameter_list->Parameter->getPlaceHolder()) ?>"<?php echo $t_parameter_list->Parameter->editAttributes() ?>><?php echo $t_parameter_list->Parameter->EditValue ?></textarea>
</span>
<input type="hidden" data-table="t_parameter" data-field="x_Parameter" name="o<?php echo $t_parameter_list->RowIndex ?>_Parameter" id="o<?php echo $t_parameter_list->RowIndex ?>_Parameter" value="<?php echo HtmlEncode($t_parameter_list->Parameter->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_parameter_list->Nilai->Visible) { // Nilai ?>
		<td data-name="Nilai">
<span id="el$rowindex$_t_parameter_Nilai" class="form-group t_parameter_Nilai">
<textarea data-table="t_parameter" data-field="x_Nilai" name="x<?php echo $t_parameter_list->RowIndex ?>_Nilai" id="x<?php echo $t_parameter_list->RowIndex ?>_Nilai" cols="30" rows="1" placeholder="<?php echo HtmlEncode($t_parameter_list->Nilai->getPlaceHolder()) ?>"<?php echo $t_parameter_list->Nilai->editAttributes() ?>><?php echo $t_parameter_list->Nilai->EditValue ?></textarea>
</span>
<input type="hidden" data-table="t_parameter" data-field="x_Nilai" name="o<?php echo $t_parameter_list->RowIndex ?>_Nilai" id="o<?php echo $t_parameter_list->RowIndex ?>_Nilai" value="<?php echo HtmlEncode($t_parameter_list->Nilai->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t_parameter_list->ListOptions->render("body", "right", $t_parameter_list->RowIndex);
?>
<script>
loadjs.ready(["ft_parameterlist", "load"], function() {
	ft_parameterlist.updateLists(<?php echo $t_parameter_list->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if ($t_parameter_list->isGridAdd()) { ?>
<input type="hidden" name="action" id="action" value="gridinsert">
<input type="hidden" name="<?php echo $t_parameter_list->FormKeyCountName ?>" id="<?php echo $t_parameter_list->FormKeyCountName ?>" value="<?php echo $t_parameter_list->KeyCount ?>">
<?php echo $t_parameter_list->MultiSelectKey ?>
<?php } ?>
<?php if ($t_parameter_list->isGridEdit()) { ?>
<input type="hidden" name="action" id="action" value="gridupdate">
<input type="hidden" name="<?php echo $t_parameter_list->FormKeyCountName ?>" id="<?php echo $t_parameter_list->FormKeyCountName ?>" value="<?php echo $t_parameter_list->KeyCount ?>">
<?php echo $t_parameter_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$t_parameter->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($t_parameter_list->Recordset)
	$t_parameter_list->Recordset->Close();
?>
<?php if (!$t_parameter_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$t_parameter_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $t_parameter_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $t_parameter_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($t_parameter_list->TotalRecords == 0 && !$t_parameter->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $t_parameter_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$t_parameter_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$t_parameter_list->isExport()) { ?>
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
$t_parameter_list->terminate();
?>