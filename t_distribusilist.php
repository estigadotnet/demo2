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
$t_distribusi_list = new t_distribusi_list();

// Run the page
$t_distribusi_list->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_distribusi_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$t_distribusi_list->isExport()) { ?>
<script>
var ft_distribusilist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	ft_distribusilist = currentForm = new ew.Form("ft_distribusilist", "list");
	ft_distribusilist.formKeyCountName = '<?php echo $t_distribusi_list->FormKeyCountName ?>';

	// Validate form
	ft_distribusilist.validate = function() {
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
			<?php if ($t_distribusi_list->source_id->Required) { ?>
				elm = this.getElements("x" + infix + "_source_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_distribusi_list->source_id->caption(), $t_distribusi_list->source_id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_distribusi_list->destination_id->Required) { ?>
				elm = this.getElements("x" + infix + "_destination_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_distribusi_list->destination_id->caption(), $t_distribusi_list->destination_id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($t_distribusi_list->Jarak->Required) { ?>
				elm = this.getElements("x" + infix + "_Jarak");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_distribusi_list->Jarak->caption(), $t_distribusi_list->Jarak->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Jarak");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_distribusi_list->Jarak->errorMessage()) ?>");
			<?php if ($t_distribusi_list->Rate_O->Required) { ?>
				elm = this.getElements("x" + infix + "_Rate_O");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_distribusi_list->Rate_O->caption(), $t_distribusi_list->Rate_O->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Rate_O");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_distribusi_list->Rate_O->errorMessage()) ?>");
			<?php if ($t_distribusi_list->Rate_D->Required) { ?>
				elm = this.getElements("x" + infix + "_Rate_D");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_distribusi_list->Rate_D->caption(), $t_distribusi_list->Rate_D->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Rate_D");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_distribusi_list->Rate_D->errorMessage()) ?>");
			<?php if ($t_distribusi_list->Demand->Required) { ?>
				elm = this.getElements("x" + infix + "_Demand");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $t_distribusi_list->Demand->caption(), $t_distribusi_list->Demand->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Demand");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($t_distribusi_list->Demand->errorMessage()) ?>");

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
	ft_distribusilist.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "source_id", false)) return false;
		if (ew.valueChanged(fobj, infix, "destination_id", false)) return false;
		if (ew.valueChanged(fobj, infix, "Jarak", false)) return false;
		if (ew.valueChanged(fobj, infix, "Rate_O", false)) return false;
		if (ew.valueChanged(fobj, infix, "Rate_D", false)) return false;
		if (ew.valueChanged(fobj, infix, "Demand", false)) return false;
		return true;
	}

	// Form_CustomValidate
	ft_distribusilist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ft_distribusilist.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	ft_distribusilist.lists["x_source_id"] = <?php echo $t_distribusi_list->source_id->Lookup->toClientList($t_distribusi_list) ?>;
	ft_distribusilist.lists["x_source_id"].options = <?php echo JsonEncode($t_distribusi_list->source_id->lookupOptions()) ?>;
	ft_distribusilist.lists["x_destination_id"] = <?php echo $t_distribusi_list->destination_id->Lookup->toClientList($t_distribusi_list) ?>;
	ft_distribusilist.lists["x_destination_id"].options = <?php echo JsonEncode($t_distribusi_list->destination_id->lookupOptions()) ?>;
	loadjs.done("ft_distribusilist");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$t_distribusi_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($t_distribusi_list->TotalRecords > 0 && $t_distribusi_list->ExportOptions->visible()) { ?>
<?php $t_distribusi_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($t_distribusi_list->ImportOptions->visible()) { ?>
<?php $t_distribusi_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$t_distribusi_list->renderOtherOptions();
?>
<?php $t_distribusi_list->showPageHeader(); ?>
<?php
$t_distribusi_list->showMessage();
?>
<?php if ($t_distribusi_list->TotalRecords > 0 || $t_distribusi->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($t_distribusi_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> t_distribusi">
<form name="ft_distribusilist" id="ft_distribusilist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_distribusi">
<div id="gmp_t_distribusi" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($t_distribusi_list->TotalRecords > 0 || $t_distribusi_list->isGridEdit()) { ?>
<table id="tbl_t_distribusilist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$t_distribusi->RowType = ROWTYPE_HEADER;

// Render list options
$t_distribusi_list->renderListOptions();

// Render list options (header, left)
$t_distribusi_list->ListOptions->render("header", "left");
?>
<?php if ($t_distribusi_list->source_id->Visible) { // source_id ?>
	<?php if ($t_distribusi_list->SortUrl($t_distribusi_list->source_id) == "") { ?>
		<th data-name="source_id" class="<?php echo $t_distribusi_list->source_id->headerCellClass() ?>"><div id="elh_t_distribusi_source_id" class="t_distribusi_source_id"><div class="ew-table-header-caption"><?php echo $t_distribusi_list->source_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="source_id" class="<?php echo $t_distribusi_list->source_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_distribusi_list->SortUrl($t_distribusi_list->source_id) ?>', 1);"><div id="elh_t_distribusi_source_id" class="t_distribusi_source_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_distribusi_list->source_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_distribusi_list->source_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_distribusi_list->source_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_distribusi_list->destination_id->Visible) { // destination_id ?>
	<?php if ($t_distribusi_list->SortUrl($t_distribusi_list->destination_id) == "") { ?>
		<th data-name="destination_id" class="<?php echo $t_distribusi_list->destination_id->headerCellClass() ?>"><div id="elh_t_distribusi_destination_id" class="t_distribusi_destination_id"><div class="ew-table-header-caption"><?php echo $t_distribusi_list->destination_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="destination_id" class="<?php echo $t_distribusi_list->destination_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_distribusi_list->SortUrl($t_distribusi_list->destination_id) ?>', 1);"><div id="elh_t_distribusi_destination_id" class="t_distribusi_destination_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_distribusi_list->destination_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_distribusi_list->destination_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_distribusi_list->destination_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_distribusi_list->Jarak->Visible) { // Jarak ?>
	<?php if ($t_distribusi_list->SortUrl($t_distribusi_list->Jarak) == "") { ?>
		<th data-name="Jarak" class="<?php echo $t_distribusi_list->Jarak->headerCellClass() ?>"><div id="elh_t_distribusi_Jarak" class="t_distribusi_Jarak"><div class="ew-table-header-caption"><?php echo $t_distribusi_list->Jarak->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Jarak" class="<?php echo $t_distribusi_list->Jarak->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_distribusi_list->SortUrl($t_distribusi_list->Jarak) ?>', 1);"><div id="elh_t_distribusi_Jarak" class="t_distribusi_Jarak">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_distribusi_list->Jarak->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_distribusi_list->Jarak->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_distribusi_list->Jarak->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_distribusi_list->Rate_O->Visible) { // Rate_O ?>
	<?php if ($t_distribusi_list->SortUrl($t_distribusi_list->Rate_O) == "") { ?>
		<th data-name="Rate_O" class="<?php echo $t_distribusi_list->Rate_O->headerCellClass() ?>"><div id="elh_t_distribusi_Rate_O" class="t_distribusi_Rate_O"><div class="ew-table-header-caption"><?php echo $t_distribusi_list->Rate_O->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Rate_O" class="<?php echo $t_distribusi_list->Rate_O->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_distribusi_list->SortUrl($t_distribusi_list->Rate_O) ?>', 1);"><div id="elh_t_distribusi_Rate_O" class="t_distribusi_Rate_O">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_distribusi_list->Rate_O->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_distribusi_list->Rate_O->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_distribusi_list->Rate_O->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_distribusi_list->Rate_D->Visible) { // Rate_D ?>
	<?php if ($t_distribusi_list->SortUrl($t_distribusi_list->Rate_D) == "") { ?>
		<th data-name="Rate_D" class="<?php echo $t_distribusi_list->Rate_D->headerCellClass() ?>"><div id="elh_t_distribusi_Rate_D" class="t_distribusi_Rate_D"><div class="ew-table-header-caption"><?php echo $t_distribusi_list->Rate_D->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Rate_D" class="<?php echo $t_distribusi_list->Rate_D->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_distribusi_list->SortUrl($t_distribusi_list->Rate_D) ?>', 1);"><div id="elh_t_distribusi_Rate_D" class="t_distribusi_Rate_D">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_distribusi_list->Rate_D->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_distribusi_list->Rate_D->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_distribusi_list->Rate_D->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_distribusi_list->Demand->Visible) { // Demand ?>
	<?php if ($t_distribusi_list->SortUrl($t_distribusi_list->Demand) == "") { ?>
		<th data-name="Demand" class="<?php echo $t_distribusi_list->Demand->headerCellClass() ?>"><div id="elh_t_distribusi_Demand" class="t_distribusi_Demand"><div class="ew-table-header-caption"><?php echo $t_distribusi_list->Demand->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Demand" class="<?php echo $t_distribusi_list->Demand->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_distribusi_list->SortUrl($t_distribusi_list->Demand) ?>', 1);"><div id="elh_t_distribusi_Demand" class="t_distribusi_Demand">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_distribusi_list->Demand->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_distribusi_list->Demand->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_distribusi_list->Demand->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$t_distribusi_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($t_distribusi_list->ExportAll && $t_distribusi_list->isExport()) {
	$t_distribusi_list->StopRecord = $t_distribusi_list->TotalRecords;
} else {

	// Set the last record to display
	if ($t_distribusi_list->TotalRecords > $t_distribusi_list->StartRecord + $t_distribusi_list->DisplayRecords - 1)
		$t_distribusi_list->StopRecord = $t_distribusi_list->StartRecord + $t_distribusi_list->DisplayRecords - 1;
	else
		$t_distribusi_list->StopRecord = $t_distribusi_list->TotalRecords;
}

// Restore number of post back records
if ($CurrentForm && ($t_distribusi->isConfirm() || $t_distribusi_list->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($t_distribusi_list->FormKeyCountName) && ($t_distribusi_list->isGridAdd() || $t_distribusi_list->isGridEdit() || $t_distribusi->isConfirm())) {
		$t_distribusi_list->KeyCount = $CurrentForm->getValue($t_distribusi_list->FormKeyCountName);
		$t_distribusi_list->StopRecord = $t_distribusi_list->StartRecord + $t_distribusi_list->KeyCount - 1;
	}
}
$t_distribusi_list->RecordCount = $t_distribusi_list->StartRecord - 1;
if ($t_distribusi_list->Recordset && !$t_distribusi_list->Recordset->EOF) {
	$t_distribusi_list->Recordset->moveFirst();
	$selectLimit = $t_distribusi_list->UseSelectLimit;
	if (!$selectLimit && $t_distribusi_list->StartRecord > 1)
		$t_distribusi_list->Recordset->move($t_distribusi_list->StartRecord - 1);
} elseif (!$t_distribusi->AllowAddDeleteRow && $t_distribusi_list->StopRecord == 0) {
	$t_distribusi_list->StopRecord = $t_distribusi->GridAddRowCount;
}

// Initialize aggregate
$t_distribusi->RowType = ROWTYPE_AGGREGATEINIT;
$t_distribusi->resetAttributes();
$t_distribusi_list->renderRow();
if ($t_distribusi_list->isGridAdd())
	$t_distribusi_list->RowIndex = 0;
if ($t_distribusi_list->isGridEdit())
	$t_distribusi_list->RowIndex = 0;
while ($t_distribusi_list->RecordCount < $t_distribusi_list->StopRecord) {
	$t_distribusi_list->RecordCount++;
	if ($t_distribusi_list->RecordCount >= $t_distribusi_list->StartRecord) {
		$t_distribusi_list->RowCount++;
		if ($t_distribusi_list->isGridAdd() || $t_distribusi_list->isGridEdit() || $t_distribusi->isConfirm()) {
			$t_distribusi_list->RowIndex++;
			$CurrentForm->Index = $t_distribusi_list->RowIndex;
			if ($CurrentForm->hasValue($t_distribusi_list->FormActionName) && ($t_distribusi->isConfirm() || $t_distribusi_list->EventCancelled))
				$t_distribusi_list->RowAction = strval($CurrentForm->getValue($t_distribusi_list->FormActionName));
			elseif ($t_distribusi_list->isGridAdd())
				$t_distribusi_list->RowAction = "insert";
			else
				$t_distribusi_list->RowAction = "";
		}

		// Set up key count
		$t_distribusi_list->KeyCount = $t_distribusi_list->RowIndex;

		// Init row class and style
		$t_distribusi->resetAttributes();
		$t_distribusi->CssClass = "";
		if ($t_distribusi_list->isGridAdd()) {
			$t_distribusi_list->loadRowValues(); // Load default values
		} else {
			$t_distribusi_list->loadRowValues($t_distribusi_list->Recordset); // Load row values
		}
		$t_distribusi->RowType = ROWTYPE_VIEW; // Render view
		if ($t_distribusi_list->isGridAdd()) // Grid add
			$t_distribusi->RowType = ROWTYPE_ADD; // Render add
		if ($t_distribusi_list->isGridAdd() && $t_distribusi->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$t_distribusi_list->restoreCurrentRowFormValues($t_distribusi_list->RowIndex); // Restore form values
		if ($t_distribusi_list->isGridEdit()) { // Grid edit
			if ($t_distribusi->EventCancelled)
				$t_distribusi_list->restoreCurrentRowFormValues($t_distribusi_list->RowIndex); // Restore form values
			if ($t_distribusi_list->RowAction == "insert")
				$t_distribusi->RowType = ROWTYPE_ADD; // Render add
			else
				$t_distribusi->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($t_distribusi_list->isGridEdit() && ($t_distribusi->RowType == ROWTYPE_EDIT || $t_distribusi->RowType == ROWTYPE_ADD) && $t_distribusi->EventCancelled) // Update failed
			$t_distribusi_list->restoreCurrentRowFormValues($t_distribusi_list->RowIndex); // Restore form values
		if ($t_distribusi->RowType == ROWTYPE_EDIT) // Edit row
			$t_distribusi_list->EditRowCount++;

		// Set up row id / data-rowindex
		$t_distribusi->RowAttrs->merge(["data-rowindex" => $t_distribusi_list->RowCount, "id" => "r" . $t_distribusi_list->RowCount . "_t_distribusi", "data-rowtype" => $t_distribusi->RowType]);

		// Render row
		$t_distribusi_list->renderRow();

		// Render list options
		$t_distribusi_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($t_distribusi_list->RowAction != "delete" && $t_distribusi_list->RowAction != "insertdelete" && !($t_distribusi_list->RowAction == "insert" && $t_distribusi->isConfirm() && $t_distribusi_list->emptyRow())) {
?>
	<tr <?php echo $t_distribusi->rowAttributes() ?>>
<?php

// Render list options (body, left)
$t_distribusi_list->ListOptions->render("body", "left", $t_distribusi_list->RowCount);
?>
	<?php if ($t_distribusi_list->source_id->Visible) { // source_id ?>
		<td data-name="source_id" <?php echo $t_distribusi_list->source_id->cellAttributes() ?>>
<?php if ($t_distribusi->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_distribusi_list->RowCount ?>_t_distribusi_source_id" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_distribusi" data-field="x_source_id" data-value-separator="<?php echo $t_distribusi_list->source_id->displayValueSeparatorAttribute() ?>" id="x<?php echo $t_distribusi_list->RowIndex ?>_source_id" name="x<?php echo $t_distribusi_list->RowIndex ?>_source_id"<?php echo $t_distribusi_list->source_id->editAttributes() ?>>
			<?php echo $t_distribusi_list->source_id->selectOptionListHtml("x{$t_distribusi_list->RowIndex}_source_id") ?>
		</select>
</div>
<?php echo $t_distribusi_list->source_id->Lookup->getParamTag($t_distribusi_list, "p_x" . $t_distribusi_list->RowIndex . "_source_id") ?>
</span>
<input type="hidden" data-table="t_distribusi" data-field="x_source_id" name="o<?php echo $t_distribusi_list->RowIndex ?>_source_id" id="o<?php echo $t_distribusi_list->RowIndex ?>_source_id" value="<?php echo HtmlEncode($t_distribusi_list->source_id->OldValue) ?>">
<?php } ?>
<?php if ($t_distribusi->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_distribusi_list->RowCount ?>_t_distribusi_source_id" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_distribusi" data-field="x_source_id" data-value-separator="<?php echo $t_distribusi_list->source_id->displayValueSeparatorAttribute() ?>" id="x<?php echo $t_distribusi_list->RowIndex ?>_source_id" name="x<?php echo $t_distribusi_list->RowIndex ?>_source_id"<?php echo $t_distribusi_list->source_id->editAttributes() ?>>
			<?php echo $t_distribusi_list->source_id->selectOptionListHtml("x{$t_distribusi_list->RowIndex}_source_id") ?>
		</select>
</div>
<?php echo $t_distribusi_list->source_id->Lookup->getParamTag($t_distribusi_list, "p_x" . $t_distribusi_list->RowIndex . "_source_id") ?>
</span>
<?php } ?>
<?php if ($t_distribusi->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_distribusi_list->RowCount ?>_t_distribusi_source_id">
<span<?php echo $t_distribusi_list->source_id->viewAttributes() ?>><?php echo $t_distribusi_list->source_id->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php if ($t_distribusi->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="t_distribusi" data-field="x_id" name="x<?php echo $t_distribusi_list->RowIndex ?>_id" id="x<?php echo $t_distribusi_list->RowIndex ?>_id" value="<?php echo HtmlEncode($t_distribusi_list->id->CurrentValue) ?>">
<input type="hidden" data-table="t_distribusi" data-field="x_id" name="o<?php echo $t_distribusi_list->RowIndex ?>_id" id="o<?php echo $t_distribusi_list->RowIndex ?>_id" value="<?php echo HtmlEncode($t_distribusi_list->id->OldValue) ?>">
<?php } ?>
<?php if ($t_distribusi->RowType == ROWTYPE_EDIT || $t_distribusi->CurrentMode == "edit") { ?>
<input type="hidden" data-table="t_distribusi" data-field="x_id" name="x<?php echo $t_distribusi_list->RowIndex ?>_id" id="x<?php echo $t_distribusi_list->RowIndex ?>_id" value="<?php echo HtmlEncode($t_distribusi_list->id->CurrentValue) ?>">
<?php } ?>
	<?php if ($t_distribusi_list->destination_id->Visible) { // destination_id ?>
		<td data-name="destination_id" <?php echo $t_distribusi_list->destination_id->cellAttributes() ?>>
<?php if ($t_distribusi->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_distribusi_list->RowCount ?>_t_distribusi_destination_id" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_distribusi" data-field="x_destination_id" data-value-separator="<?php echo $t_distribusi_list->destination_id->displayValueSeparatorAttribute() ?>" id="x<?php echo $t_distribusi_list->RowIndex ?>_destination_id" name="x<?php echo $t_distribusi_list->RowIndex ?>_destination_id"<?php echo $t_distribusi_list->destination_id->editAttributes() ?>>
			<?php echo $t_distribusi_list->destination_id->selectOptionListHtml("x{$t_distribusi_list->RowIndex}_destination_id") ?>
		</select>
</div>
<?php echo $t_distribusi_list->destination_id->Lookup->getParamTag($t_distribusi_list, "p_x" . $t_distribusi_list->RowIndex . "_destination_id") ?>
</span>
<input type="hidden" data-table="t_distribusi" data-field="x_destination_id" name="o<?php echo $t_distribusi_list->RowIndex ?>_destination_id" id="o<?php echo $t_distribusi_list->RowIndex ?>_destination_id" value="<?php echo HtmlEncode($t_distribusi_list->destination_id->OldValue) ?>">
<?php } ?>
<?php if ($t_distribusi->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_distribusi_list->RowCount ?>_t_distribusi_destination_id" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_distribusi" data-field="x_destination_id" data-value-separator="<?php echo $t_distribusi_list->destination_id->displayValueSeparatorAttribute() ?>" id="x<?php echo $t_distribusi_list->RowIndex ?>_destination_id" name="x<?php echo $t_distribusi_list->RowIndex ?>_destination_id"<?php echo $t_distribusi_list->destination_id->editAttributes() ?>>
			<?php echo $t_distribusi_list->destination_id->selectOptionListHtml("x{$t_distribusi_list->RowIndex}_destination_id") ?>
		</select>
</div>
<?php echo $t_distribusi_list->destination_id->Lookup->getParamTag($t_distribusi_list, "p_x" . $t_distribusi_list->RowIndex . "_destination_id") ?>
</span>
<?php } ?>
<?php if ($t_distribusi->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_distribusi_list->RowCount ?>_t_distribusi_destination_id">
<span<?php echo $t_distribusi_list->destination_id->viewAttributes() ?>><?php echo $t_distribusi_list->destination_id->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_distribusi_list->Jarak->Visible) { // Jarak ?>
		<td data-name="Jarak" <?php echo $t_distribusi_list->Jarak->cellAttributes() ?>>
<?php if ($t_distribusi->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_distribusi_list->RowCount ?>_t_distribusi_Jarak" class="form-group">
<input type="text" data-table="t_distribusi" data-field="x_Jarak" name="x<?php echo $t_distribusi_list->RowIndex ?>_Jarak" id="x<?php echo $t_distribusi_list->RowIndex ?>_Jarak" size="30" maxlength="14" placeholder="<?php echo HtmlEncode($t_distribusi_list->Jarak->getPlaceHolder()) ?>" value="<?php echo $t_distribusi_list->Jarak->EditValue ?>"<?php echo $t_distribusi_list->Jarak->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_distribusi" data-field="x_Jarak" name="o<?php echo $t_distribusi_list->RowIndex ?>_Jarak" id="o<?php echo $t_distribusi_list->RowIndex ?>_Jarak" value="<?php echo HtmlEncode($t_distribusi_list->Jarak->OldValue) ?>">
<?php } ?>
<?php if ($t_distribusi->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_distribusi_list->RowCount ?>_t_distribusi_Jarak" class="form-group">
<input type="text" data-table="t_distribusi" data-field="x_Jarak" name="x<?php echo $t_distribusi_list->RowIndex ?>_Jarak" id="x<?php echo $t_distribusi_list->RowIndex ?>_Jarak" size="30" maxlength="14" placeholder="<?php echo HtmlEncode($t_distribusi_list->Jarak->getPlaceHolder()) ?>" value="<?php echo $t_distribusi_list->Jarak->EditValue ?>"<?php echo $t_distribusi_list->Jarak->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($t_distribusi->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_distribusi_list->RowCount ?>_t_distribusi_Jarak">
<span<?php echo $t_distribusi_list->Jarak->viewAttributes() ?>><?php echo $t_distribusi_list->Jarak->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_distribusi_list->Rate_O->Visible) { // Rate_O ?>
		<td data-name="Rate_O" <?php echo $t_distribusi_list->Rate_O->cellAttributes() ?>>
<?php if ($t_distribusi->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_distribusi_list->RowCount ?>_t_distribusi_Rate_O" class="form-group">
<input type="text" data-table="t_distribusi" data-field="x_Rate_O" name="x<?php echo $t_distribusi_list->RowIndex ?>_Rate_O" id="x<?php echo $t_distribusi_list->RowIndex ?>_Rate_O" size="30" maxlength="14" placeholder="<?php echo HtmlEncode($t_distribusi_list->Rate_O->getPlaceHolder()) ?>" value="<?php echo $t_distribusi_list->Rate_O->EditValue ?>"<?php echo $t_distribusi_list->Rate_O->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_distribusi" data-field="x_Rate_O" name="o<?php echo $t_distribusi_list->RowIndex ?>_Rate_O" id="o<?php echo $t_distribusi_list->RowIndex ?>_Rate_O" value="<?php echo HtmlEncode($t_distribusi_list->Rate_O->OldValue) ?>">
<?php } ?>
<?php if ($t_distribusi->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_distribusi_list->RowCount ?>_t_distribusi_Rate_O" class="form-group">
<input type="text" data-table="t_distribusi" data-field="x_Rate_O" name="x<?php echo $t_distribusi_list->RowIndex ?>_Rate_O" id="x<?php echo $t_distribusi_list->RowIndex ?>_Rate_O" size="30" maxlength="14" placeholder="<?php echo HtmlEncode($t_distribusi_list->Rate_O->getPlaceHolder()) ?>" value="<?php echo $t_distribusi_list->Rate_O->EditValue ?>"<?php echo $t_distribusi_list->Rate_O->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($t_distribusi->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_distribusi_list->RowCount ?>_t_distribusi_Rate_O">
<span<?php echo $t_distribusi_list->Rate_O->viewAttributes() ?>><?php echo $t_distribusi_list->Rate_O->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_distribusi_list->Rate_D->Visible) { // Rate_D ?>
		<td data-name="Rate_D" <?php echo $t_distribusi_list->Rate_D->cellAttributes() ?>>
<?php if ($t_distribusi->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_distribusi_list->RowCount ?>_t_distribusi_Rate_D" class="form-group">
<input type="text" data-table="t_distribusi" data-field="x_Rate_D" name="x<?php echo $t_distribusi_list->RowIndex ?>_Rate_D" id="x<?php echo $t_distribusi_list->RowIndex ?>_Rate_D" size="30" maxlength="14" placeholder="<?php echo HtmlEncode($t_distribusi_list->Rate_D->getPlaceHolder()) ?>" value="<?php echo $t_distribusi_list->Rate_D->EditValue ?>"<?php echo $t_distribusi_list->Rate_D->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_distribusi" data-field="x_Rate_D" name="o<?php echo $t_distribusi_list->RowIndex ?>_Rate_D" id="o<?php echo $t_distribusi_list->RowIndex ?>_Rate_D" value="<?php echo HtmlEncode($t_distribusi_list->Rate_D->OldValue) ?>">
<?php } ?>
<?php if ($t_distribusi->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_distribusi_list->RowCount ?>_t_distribusi_Rate_D" class="form-group">
<input type="text" data-table="t_distribusi" data-field="x_Rate_D" name="x<?php echo $t_distribusi_list->RowIndex ?>_Rate_D" id="x<?php echo $t_distribusi_list->RowIndex ?>_Rate_D" size="30" maxlength="14" placeholder="<?php echo HtmlEncode($t_distribusi_list->Rate_D->getPlaceHolder()) ?>" value="<?php echo $t_distribusi_list->Rate_D->EditValue ?>"<?php echo $t_distribusi_list->Rate_D->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($t_distribusi->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_distribusi_list->RowCount ?>_t_distribusi_Rate_D">
<span<?php echo $t_distribusi_list->Rate_D->viewAttributes() ?>><?php echo $t_distribusi_list->Rate_D->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_distribusi_list->Demand->Visible) { // Demand ?>
		<td data-name="Demand" <?php echo $t_distribusi_list->Demand->cellAttributes() ?>>
<?php if ($t_distribusi->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_distribusi_list->RowCount ?>_t_distribusi_Demand" class="form-group">
<input type="text" data-table="t_distribusi" data-field="x_Demand" name="x<?php echo $t_distribusi_list->RowIndex ?>_Demand" id="x<?php echo $t_distribusi_list->RowIndex ?>_Demand" size="30" maxlength="14" placeholder="<?php echo HtmlEncode($t_distribusi_list->Demand->getPlaceHolder()) ?>" value="<?php echo $t_distribusi_list->Demand->EditValue ?>"<?php echo $t_distribusi_list->Demand->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_distribusi" data-field="x_Demand" name="o<?php echo $t_distribusi_list->RowIndex ?>_Demand" id="o<?php echo $t_distribusi_list->RowIndex ?>_Demand" value="<?php echo HtmlEncode($t_distribusi_list->Demand->OldValue) ?>">
<?php } ?>
<?php if ($t_distribusi->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_distribusi_list->RowCount ?>_t_distribusi_Demand" class="form-group">
<input type="text" data-table="t_distribusi" data-field="x_Demand" name="x<?php echo $t_distribusi_list->RowIndex ?>_Demand" id="x<?php echo $t_distribusi_list->RowIndex ?>_Demand" size="30" maxlength="14" placeholder="<?php echo HtmlEncode($t_distribusi_list->Demand->getPlaceHolder()) ?>" value="<?php echo $t_distribusi_list->Demand->EditValue ?>"<?php echo $t_distribusi_list->Demand->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($t_distribusi->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_distribusi_list->RowCount ?>_t_distribusi_Demand">
<span<?php echo $t_distribusi_list->Demand->viewAttributes() ?>><?php echo $t_distribusi_list->Demand->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t_distribusi_list->ListOptions->render("body", "right", $t_distribusi_list->RowCount);
?>
	</tr>
<?php if ($t_distribusi->RowType == ROWTYPE_ADD || $t_distribusi->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["ft_distribusilist", "load"], function() {
	ft_distribusilist.updateLists(<?php echo $t_distribusi_list->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$t_distribusi_list->isGridAdd())
		if (!$t_distribusi_list->Recordset->EOF)
			$t_distribusi_list->Recordset->moveNext();
}
?>
<?php
	if ($t_distribusi_list->isGridAdd() || $t_distribusi_list->isGridEdit()) {
		$t_distribusi_list->RowIndex = '$rowindex$';
		$t_distribusi_list->loadRowValues();

		// Set row properties
		$t_distribusi->resetAttributes();
		$t_distribusi->RowAttrs->merge(["data-rowindex" => $t_distribusi_list->RowIndex, "id" => "r0_t_distribusi", "data-rowtype" => ROWTYPE_ADD]);
		$t_distribusi->RowAttrs->appendClass("ew-template");
		$t_distribusi->RowType = ROWTYPE_ADD;

		// Render row
		$t_distribusi_list->renderRow();

		// Render list options
		$t_distribusi_list->renderListOptions();
		$t_distribusi_list->StartRowCount = 0;
?>
	<tr <?php echo $t_distribusi->rowAttributes() ?>>
<?php

// Render list options (body, left)
$t_distribusi_list->ListOptions->render("body", "left", $t_distribusi_list->RowIndex);
?>
	<?php if ($t_distribusi_list->source_id->Visible) { // source_id ?>
		<td data-name="source_id">
<span id="el$rowindex$_t_distribusi_source_id" class="form-group t_distribusi_source_id">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_distribusi" data-field="x_source_id" data-value-separator="<?php echo $t_distribusi_list->source_id->displayValueSeparatorAttribute() ?>" id="x<?php echo $t_distribusi_list->RowIndex ?>_source_id" name="x<?php echo $t_distribusi_list->RowIndex ?>_source_id"<?php echo $t_distribusi_list->source_id->editAttributes() ?>>
			<?php echo $t_distribusi_list->source_id->selectOptionListHtml("x{$t_distribusi_list->RowIndex}_source_id") ?>
		</select>
</div>
<?php echo $t_distribusi_list->source_id->Lookup->getParamTag($t_distribusi_list, "p_x" . $t_distribusi_list->RowIndex . "_source_id") ?>
</span>
<input type="hidden" data-table="t_distribusi" data-field="x_source_id" name="o<?php echo $t_distribusi_list->RowIndex ?>_source_id" id="o<?php echo $t_distribusi_list->RowIndex ?>_source_id" value="<?php echo HtmlEncode($t_distribusi_list->source_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_distribusi_list->destination_id->Visible) { // destination_id ?>
		<td data-name="destination_id">
<span id="el$rowindex$_t_distribusi_destination_id" class="form-group t_distribusi_destination_id">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="t_distribusi" data-field="x_destination_id" data-value-separator="<?php echo $t_distribusi_list->destination_id->displayValueSeparatorAttribute() ?>" id="x<?php echo $t_distribusi_list->RowIndex ?>_destination_id" name="x<?php echo $t_distribusi_list->RowIndex ?>_destination_id"<?php echo $t_distribusi_list->destination_id->editAttributes() ?>>
			<?php echo $t_distribusi_list->destination_id->selectOptionListHtml("x{$t_distribusi_list->RowIndex}_destination_id") ?>
		</select>
</div>
<?php echo $t_distribusi_list->destination_id->Lookup->getParamTag($t_distribusi_list, "p_x" . $t_distribusi_list->RowIndex . "_destination_id") ?>
</span>
<input type="hidden" data-table="t_distribusi" data-field="x_destination_id" name="o<?php echo $t_distribusi_list->RowIndex ?>_destination_id" id="o<?php echo $t_distribusi_list->RowIndex ?>_destination_id" value="<?php echo HtmlEncode($t_distribusi_list->destination_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_distribusi_list->Jarak->Visible) { // Jarak ?>
		<td data-name="Jarak">
<span id="el$rowindex$_t_distribusi_Jarak" class="form-group t_distribusi_Jarak">
<input type="text" data-table="t_distribusi" data-field="x_Jarak" name="x<?php echo $t_distribusi_list->RowIndex ?>_Jarak" id="x<?php echo $t_distribusi_list->RowIndex ?>_Jarak" size="30" maxlength="14" placeholder="<?php echo HtmlEncode($t_distribusi_list->Jarak->getPlaceHolder()) ?>" value="<?php echo $t_distribusi_list->Jarak->EditValue ?>"<?php echo $t_distribusi_list->Jarak->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_distribusi" data-field="x_Jarak" name="o<?php echo $t_distribusi_list->RowIndex ?>_Jarak" id="o<?php echo $t_distribusi_list->RowIndex ?>_Jarak" value="<?php echo HtmlEncode($t_distribusi_list->Jarak->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_distribusi_list->Rate_O->Visible) { // Rate_O ?>
		<td data-name="Rate_O">
<span id="el$rowindex$_t_distribusi_Rate_O" class="form-group t_distribusi_Rate_O">
<input type="text" data-table="t_distribusi" data-field="x_Rate_O" name="x<?php echo $t_distribusi_list->RowIndex ?>_Rate_O" id="x<?php echo $t_distribusi_list->RowIndex ?>_Rate_O" size="30" maxlength="14" placeholder="<?php echo HtmlEncode($t_distribusi_list->Rate_O->getPlaceHolder()) ?>" value="<?php echo $t_distribusi_list->Rate_O->EditValue ?>"<?php echo $t_distribusi_list->Rate_O->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_distribusi" data-field="x_Rate_O" name="o<?php echo $t_distribusi_list->RowIndex ?>_Rate_O" id="o<?php echo $t_distribusi_list->RowIndex ?>_Rate_O" value="<?php echo HtmlEncode($t_distribusi_list->Rate_O->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_distribusi_list->Rate_D->Visible) { // Rate_D ?>
		<td data-name="Rate_D">
<span id="el$rowindex$_t_distribusi_Rate_D" class="form-group t_distribusi_Rate_D">
<input type="text" data-table="t_distribusi" data-field="x_Rate_D" name="x<?php echo $t_distribusi_list->RowIndex ?>_Rate_D" id="x<?php echo $t_distribusi_list->RowIndex ?>_Rate_D" size="30" maxlength="14" placeholder="<?php echo HtmlEncode($t_distribusi_list->Rate_D->getPlaceHolder()) ?>" value="<?php echo $t_distribusi_list->Rate_D->EditValue ?>"<?php echo $t_distribusi_list->Rate_D->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_distribusi" data-field="x_Rate_D" name="o<?php echo $t_distribusi_list->RowIndex ?>_Rate_D" id="o<?php echo $t_distribusi_list->RowIndex ?>_Rate_D" value="<?php echo HtmlEncode($t_distribusi_list->Rate_D->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_distribusi_list->Demand->Visible) { // Demand ?>
		<td data-name="Demand">
<span id="el$rowindex$_t_distribusi_Demand" class="form-group t_distribusi_Demand">
<input type="text" data-table="t_distribusi" data-field="x_Demand" name="x<?php echo $t_distribusi_list->RowIndex ?>_Demand" id="x<?php echo $t_distribusi_list->RowIndex ?>_Demand" size="30" maxlength="14" placeholder="<?php echo HtmlEncode($t_distribusi_list->Demand->getPlaceHolder()) ?>" value="<?php echo $t_distribusi_list->Demand->EditValue ?>"<?php echo $t_distribusi_list->Demand->editAttributes() ?>>
</span>
<input type="hidden" data-table="t_distribusi" data-field="x_Demand" name="o<?php echo $t_distribusi_list->RowIndex ?>_Demand" id="o<?php echo $t_distribusi_list->RowIndex ?>_Demand" value="<?php echo HtmlEncode($t_distribusi_list->Demand->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t_distribusi_list->ListOptions->render("body", "right", $t_distribusi_list->RowIndex);
?>
<script>
loadjs.ready(["ft_distribusilist", "load"], function() {
	ft_distribusilist.updateLists(<?php echo $t_distribusi_list->RowIndex ?>);
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
<?php if ($t_distribusi_list->isGridAdd()) { ?>
<input type="hidden" name="action" id="action" value="gridinsert">
<input type="hidden" name="<?php echo $t_distribusi_list->FormKeyCountName ?>" id="<?php echo $t_distribusi_list->FormKeyCountName ?>" value="<?php echo $t_distribusi_list->KeyCount ?>">
<?php echo $t_distribusi_list->MultiSelectKey ?>
<?php } ?>
<?php if ($t_distribusi_list->isGridEdit()) { ?>
<input type="hidden" name="action" id="action" value="gridupdate">
<input type="hidden" name="<?php echo $t_distribusi_list->FormKeyCountName ?>" id="<?php echo $t_distribusi_list->FormKeyCountName ?>" value="<?php echo $t_distribusi_list->KeyCount ?>">
<?php echo $t_distribusi_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$t_distribusi->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($t_distribusi_list->Recordset)
	$t_distribusi_list->Recordset->Close();
?>
<?php if (!$t_distribusi_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$t_distribusi_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $t_distribusi_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $t_distribusi_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($t_distribusi_list->TotalRecords == 0 && !$t_distribusi->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $t_distribusi_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$t_distribusi_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$t_distribusi_list->isExport()) { ?>
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
$t_distribusi_list->terminate();
?>