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
$t_source_list = new t_source_list();

// Run the page
$t_source_list->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_source_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$t_source_list->isExport()) { ?>
<script>
var ft_sourcelist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	ft_sourcelist = currentForm = new ew.Form("ft_sourcelist", "list");
	ft_sourcelist.formKeyCountName = '<?php echo $t_source_list->FormKeyCountName ?>';

	// Validate form
	ft_sourcelist.validate = function() {
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
			<?php if ($t_source_list->Nama->Required) { ?>
				elm = this.getElements("x" + infix + "_Nama");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_source_list->Nama->caption(), $t_source_list->Nama->RequiredErrorMessage)) ?>");
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
	ft_sourcelist.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "Nama", false)) return false;
		return true;
	}

	// Form_CustomValidate
	ft_sourcelist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ft_sourcelist.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("ft_sourcelist");
});
var ft_sourcelistsrch;
loadjs.ready("head", function() {

	// Form object for search
	ft_sourcelistsrch = currentSearchForm = new ew.Form("ft_sourcelistsrch");

	// Dynamic selection lists
	// Filters

	ft_sourcelistsrch.filterList = <?php echo $t_source_list->getFilterList() ?>;
	loadjs.done("ft_sourcelistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$t_source_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($t_source_list->TotalRecords > 0 && $t_source_list->ExportOptions->visible()) { ?>
<?php $t_source_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($t_source_list->ImportOptions->visible()) { ?>
<?php $t_source_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($t_source_list->SearchOptions->visible()) { ?>
<?php $t_source_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($t_source_list->FilterOptions->visible()) { ?>
<?php $t_source_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$t_source_list->renderOtherOptions();
?>
<?php if (!$t_source_list->isExport() && !$t_source->CurrentAction) { ?>
<form name="ft_sourcelistsrch" id="ft_sourcelistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="ft_sourcelistsrch-search-panel" class="<?php echo $t_source_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="t_source">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $t_source_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($t_source_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($t_source_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $t_source_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($t_source_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($t_source_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($t_source_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($t_source_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php $t_source_list->showPageHeader(); ?>
<?php
$t_source_list->showMessage();
?>
<?php if ($t_source_list->TotalRecords > 0 || $t_source->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($t_source_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> t_source">
<form name="ft_sourcelist" id="ft_sourcelist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_source">
<div id="gmp_t_source" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($t_source_list->TotalRecords > 0 || $t_source_list->isGridEdit()) { ?>
<table id="tbl_t_sourcelist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$t_source->RowType = ROWTYPE_HEADER;

// Render list options
$t_source_list->renderListOptions();

// Render list options (header, left)
$t_source_list->ListOptions->render("header", "left");
?>
<?php if ($t_source_list->Nama->Visible) { // Nama ?>
	<?php if ($t_source_list->SortUrl($t_source_list->Nama) == "") { ?>
		<th data-name="Nama" class="<?php echo $t_source_list->Nama->headerCellClass() ?>"><div id="elh_t_source_Nama" class="t_source_Nama"><div class="ew-table-header-caption"><?php echo $t_source_list->Nama->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Nama" class="<?php echo $t_source_list->Nama->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_source_list->SortUrl($t_source_list->Nama) ?>', 1);"><div id="elh_t_source_Nama" class="t_source_Nama">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_source_list->Nama->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($t_source_list->Nama->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_source_list->Nama->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$t_source_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($t_source_list->ExportAll && $t_source_list->isExport()) {
	$t_source_list->StopRecord = $t_source_list->TotalRecords;
} else {

	// Set the last record to display
	if ($t_source_list->TotalRecords > $t_source_list->StartRecord + $t_source_list->DisplayRecords - 1)
		$t_source_list->StopRecord = $t_source_list->StartRecord + $t_source_list->DisplayRecords - 1;
	else
		$t_source_list->StopRecord = $t_source_list->TotalRecords;
}

// Restore number of post back records
if ($CurrentForm && ($t_source->isConfirm() || $t_source_list->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($t_source_list->FormKeyCountName) && ($t_source_list->isGridAdd() || $t_source_list->isGridEdit() || $t_source->isConfirm())) {
		$t_source_list->KeyCount = $CurrentForm->getValue($t_source_list->FormKeyCountName);
		$t_source_list->StopRecord = $t_source_list->StartRecord + $t_source_list->KeyCount - 1;
	}
}
$t_source_list->RecordCount = $t_source_list->StartRecord - 1;
if ($t_source_list->Recordset && !$t_source_list->Recordset->EOF) {
	$t_source_list->Recordset->moveFirst();
	$selectLimit = $t_source_list->UseSelectLimit;
	if (!$selectLimit && $t_source_list->StartRecord > 1)
		$t_source_list->Recordset->move($t_source_list->StartRecord - 1);
} elseif (!$t_source->AllowAddDeleteRow && $t_source_list->StopRecord == 0) {
	$t_source_list->StopRecord = $t_source->GridAddRowCount;
}

// Initialize aggregate
$t_source->RowType = ROWTYPE_AGGREGATEINIT;
$t_source->resetAttributes();
$t_source_list->renderRow();
if ($t_source_list->isGridAdd())
	$t_source_list->RowIndex = 0;
if ($t_source_list->isGridEdit())
	$t_source_list->RowIndex = 0;
while ($t_source_list->RecordCount < $t_source_list->StopRecord) {
	$t_source_list->RecordCount++;
	if ($t_source_list->RecordCount >= $t_source_list->StartRecord) {
		$t_source_list->RowCount++;
		if ($t_source_list->isGridAdd() || $t_source_list->isGridEdit() || $t_source->isConfirm()) {
			$t_source_list->RowIndex++;
			$CurrentForm->Index = $t_source_list->RowIndex;
			if ($CurrentForm->hasValue($t_source_list->FormActionName) && ($t_source->isConfirm() || $t_source_list->EventCancelled))
				$t_source_list->RowAction = strval($CurrentForm->getValue($t_source_list->FormActionName));
			elseif ($t_source_list->isGridAdd())
				$t_source_list->RowAction = "insert";
			else
				$t_source_list->RowAction = "";
		}

		// Set up key count
		$t_source_list->KeyCount = $t_source_list->RowIndex;

		// Init row class and style
		$t_source->resetAttributes();
		$t_source->CssClass = "";
		if ($t_source_list->isGridAdd()) {
			$t_source_list->loadRowValues(); // Load default values
		} else {
			$t_source_list->loadRowValues($t_source_list->Recordset); // Load row values
		}
		$t_source->RowType = ROWTYPE_VIEW; // Render view
		if ($t_source_list->isGridAdd()) // Grid add
			$t_source->RowType = ROWTYPE_ADD; // Render add
		if ($t_source_list->isGridAdd() && $t_source->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$t_source_list->restoreCurrentRowFormValues($t_source_list->RowIndex); // Restore form values
		if ($t_source_list->isGridEdit()) { // Grid edit
			if ($t_source->EventCancelled)
				$t_source_list->restoreCurrentRowFormValues($t_source_list->RowIndex); // Restore form values
			if ($t_source_list->RowAction == "insert")
				$t_source->RowType = ROWTYPE_ADD; // Render add
			else
				$t_source->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($t_source_list->isGridEdit() && ($t_source->RowType == ROWTYPE_EDIT || $t_source->RowType == ROWTYPE_ADD) && $t_source->EventCancelled) // Update failed
			$t_source_list->restoreCurrentRowFormValues($t_source_list->RowIndex); // Restore form values
		if ($t_source->RowType == ROWTYPE_EDIT) // Edit row
			$t_source_list->EditRowCount++;

		// Set up row id / data-rowindex
		$t_source->RowAttrs->merge(["data-rowindex" => $t_source_list->RowCount, "id" => "r" . $t_source_list->RowCount . "_t_source", "data-rowtype" => $t_source->RowType]);

		// Render row
		$t_source_list->renderRow();

		// Render list options
		$t_source_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($t_source_list->RowAction != "delete" && $t_source_list->RowAction != "insertdelete" && !($t_source_list->RowAction == "insert" && $t_source->isConfirm() && $t_source_list->emptyRow())) {
?>
	<tr <?php echo $t_source->rowAttributes() ?>>
<?php

// Render list options (body, left)
$t_source_list->ListOptions->render("body", "left", $t_source_list->RowCount);
?>
	<?php if ($t_source_list->Nama->Visible) { // Nama ?>
		<td data-name="Nama" <?php echo $t_source_list->Nama->cellAttributes() ?>>
<?php if ($t_source->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_source_list->RowCount ?>_t_source_Nama" class="form-group">
<input type="text" data-table="t_source" data-field="x_Nama" name="x<?php echo $t_source_list->RowIndex ?>_Nama" id="x<?php echo $t_source_list->RowIndex ?>_Nama" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($t_source_list->Nama->getPlaceHolder()) ?>" value="<?php echo $t_source_list->Nama->EditValue ?>"<?php echo $t_source_list->Nama->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_source" data-field="x_Nama" name="o<?php echo $t_source_list->RowIndex ?>_Nama" id="o<?php echo $t_source_list->RowIndex ?>_Nama" value="<?php echo HtmlEncode($t_source_list->Nama->OldValue) ?>">
<?php } ?>
<?php if ($t_source->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_source_list->RowCount ?>_t_source_Nama" class="form-group">
<input type="text" data-table="t_source" data-field="x_Nama" name="x<?php echo $t_source_list->RowIndex ?>_Nama" id="x<?php echo $t_source_list->RowIndex ?>_Nama" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($t_source_list->Nama->getPlaceHolder()) ?>" value="<?php echo $t_source_list->Nama->EditValue ?>"<?php echo $t_source_list->Nama->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($t_source->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_source_list->RowCount ?>_t_source_Nama">
<span<?php echo $t_source_list->Nama->viewAttributes() ?>><?php echo $t_source_list->Nama->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php if ($t_source->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="t_source" data-field="x_id" name="x<?php echo $t_source_list->RowIndex ?>_id" id="x<?php echo $t_source_list->RowIndex ?>_id" value="<?php echo HtmlEncode($t_source_list->id->CurrentValue) ?>">
<input type="hidden" data-table="t_source" data-field="x_id" name="o<?php echo $t_source_list->RowIndex ?>_id" id="o<?php echo $t_source_list->RowIndex ?>_id" value="<?php echo HtmlEncode($t_source_list->id->OldValue) ?>">
<?php } ?>
<?php if ($t_source->RowType == ROWTYPE_EDIT || $t_source->CurrentMode == "edit") { ?>
<input type="hidden" data-table="t_source" data-field="x_id" name="x<?php echo $t_source_list->RowIndex ?>_id" id="x<?php echo $t_source_list->RowIndex ?>_id" value="<?php echo HtmlEncode($t_source_list->id->CurrentValue) ?>">
<?php } ?>
<?php

// Render list options (body, right)
$t_source_list->ListOptions->render("body", "right", $t_source_list->RowCount);
?>
	</tr>
<?php if ($t_source->RowType == ROWTYPE_ADD || $t_source->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["ft_sourcelist", "load"], function() {
	ft_sourcelist.updateLists(<?php echo $t_source_list->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$t_source_list->isGridAdd())
		if (!$t_source_list->Recordset->EOF)
			$t_source_list->Recordset->moveNext();
}
?>
<?php
	if ($t_source_list->isGridAdd() || $t_source_list->isGridEdit()) {
		$t_source_list->RowIndex = '$rowindex$';
		$t_source_list->loadRowValues();

		// Set row properties
		$t_source->resetAttributes();
		$t_source->RowAttrs->merge(["data-rowindex" => $t_source_list->RowIndex, "id" => "r0_t_source", "data-rowtype" => ROWTYPE_ADD]);
		$t_source->RowAttrs->appendClass("ew-template");
		$t_source->RowType = ROWTYPE_ADD;

		// Render row
		$t_source_list->renderRow();

		// Render list options
		$t_source_list->renderListOptions();
		$t_source_list->StartRowCount = 0;
?>
	<tr <?php echo $t_source->rowAttributes() ?>>
<?php

// Render list options (body, left)
$t_source_list->ListOptions->render("body", "left", $t_source_list->RowIndex);
?>
	<?php if ($t_source_list->Nama->Visible) { // Nama ?>
		<td data-name="Nama">
<span id="el$rowindex$_t_source_Nama" class="form-group t_source_Nama">
<input type="text" data-table="t_source" data-field="x_Nama" name="x<?php echo $t_source_list->RowIndex ?>_Nama" id="x<?php echo $t_source_list->RowIndex ?>_Nama" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($t_source_list->Nama->getPlaceHolder()) ?>" value="<?php echo $t_source_list->Nama->EditValue ?>"<?php echo $t_source_list->Nama->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_source" data-field="x_Nama" name="o<?php echo $t_source_list->RowIndex ?>_Nama" id="o<?php echo $t_source_list->RowIndex ?>_Nama" value="<?php echo HtmlEncode($t_source_list->Nama->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t_source_list->ListOptions->render("body", "right", $t_source_list->RowIndex);
?>
<script>
loadjs.ready(["ft_sourcelist", "load"], function() {
	ft_sourcelist.updateLists(<?php echo $t_source_list->RowIndex ?>);
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
<?php if ($t_source_list->isGridAdd()) { ?>
<input type="hidden" name="action" id="action" value="gridinsert">
<input type="hidden" name="<?php echo $t_source_list->FormKeyCountName ?>" id="<?php echo $t_source_list->FormKeyCountName ?>" value="<?php echo $t_source_list->KeyCount ?>">
<?php echo $t_source_list->MultiSelectKey ?>
<?php } ?>
<?php if ($t_source_list->isGridEdit()) { ?>
<input type="hidden" name="action" id="action" value="gridupdate">
<input type="hidden" name="<?php echo $t_source_list->FormKeyCountName ?>" id="<?php echo $t_source_list->FormKeyCountName ?>" value="<?php echo $t_source_list->KeyCount ?>">
<?php echo $t_source_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$t_source->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($t_source_list->Recordset)
	$t_source_list->Recordset->Close();
?>
<?php if (!$t_source_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$t_source_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $t_source_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $t_source_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($t_source_list->TotalRecords == 0 && !$t_source->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $t_source_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$t_source_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$t_source_list->isExport()) { ?>
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
$t_source_list->terminate();
?>