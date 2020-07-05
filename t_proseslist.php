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
$t_proses_list = new t_proses_list();

// Run the page
$t_proses_list->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_proses_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$t_proses_list->isExport()) { ?>
<script>
var ft_proseslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	ft_proseslist = currentForm = new ew.Form("ft_proseslist", "list");
	ft_proseslist.formKeyCountName = '<?php echo $t_proses_list->FormKeyCountName ?>';
	loadjs.done("ft_proseslist");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$t_proses_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($t_proses_list->TotalRecords > 0 && $t_proses_list->ExportOptions->visible()) { ?>
<?php $t_proses_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($t_proses_list->ImportOptions->visible()) { ?>
<?php $t_proses_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$t_proses_list->renderOtherOptions();
?>
<?php $t_proses_list->showPageHeader(); ?>
<?php
$t_proses_list->showMessage();
?>
<?php if ($t_proses_list->TotalRecords > 0 || $t_proses->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($t_proses_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> t_proses">
<form name="ft_proseslist" id="ft_proseslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_proses">
<div id="gmp_t_proses" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($t_proses_list->TotalRecords > 0 || $t_proses_list->isGridEdit()) { ?>
<table id="tbl_t_proseslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$t_proses->RowType = ROWTYPE_HEADER;

// Render list options
$t_proses_list->renderListOptions();

// Render list options (header, left)
$t_proses_list->ListOptions->render("header", "left");
?>
<?php if ($t_proses_list->id->Visible) { // id ?>
	<?php if ($t_proses_list->SortUrl($t_proses_list->id) == "") { ?>
		<th data-name="id" class="<?php echo $t_proses_list->id->headerCellClass() ?>"><div id="elh_t_proses_id" class="t_proses_id"><div class="ew-table-header-caption"><?php echo $t_proses_list->id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $t_proses_list->id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_proses_list->SortUrl($t_proses_list->id) ?>', 1);"><div id="elh_t_proses_id" class="t_proses_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_proses_list->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_proses_list->id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_proses_list->id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_proses_list->TotalCost->Visible) { // TotalCost ?>
	<?php if ($t_proses_list->SortUrl($t_proses_list->TotalCost) == "") { ?>
		<th data-name="TotalCost" class="<?php echo $t_proses_list->TotalCost->headerCellClass() ?>"><div id="elh_t_proses_TotalCost" class="t_proses_TotalCost"><div class="ew-table-header-caption"><?php echo $t_proses_list->TotalCost->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="TotalCost" class="<?php echo $t_proses_list->TotalCost->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_proses_list->SortUrl($t_proses_list->TotalCost) ?>', 1);"><div id="elh_t_proses_TotalCost" class="t_proses_TotalCost">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_proses_list->TotalCost->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_proses_list->TotalCost->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_proses_list->TotalCost->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_proses_list->TotalCargo->Visible) { // TotalCargo ?>
	<?php if ($t_proses_list->SortUrl($t_proses_list->TotalCargo) == "") { ?>
		<th data-name="TotalCargo" class="<?php echo $t_proses_list->TotalCargo->headerCellClass() ?>"><div id="elh_t_proses_TotalCargo" class="t_proses_TotalCargo"><div class="ew-table-header-caption"><?php echo $t_proses_list->TotalCargo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="TotalCargo" class="<?php echo $t_proses_list->TotalCargo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_proses_list->SortUrl($t_proses_list->TotalCargo) ?>', 1);"><div id="elh_t_proses_TotalCargo" class="t_proses_TotalCargo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_proses_list->TotalCargo->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_proses_list->TotalCargo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_proses_list->TotalCargo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_proses_list->Fitness->Visible) { // Fitness ?>
	<?php if ($t_proses_list->SortUrl($t_proses_list->Fitness) == "") { ?>
		<th data-name="Fitness" class="<?php echo $t_proses_list->Fitness->headerCellClass() ?>"><div id="elh_t_proses_Fitness" class="t_proses_Fitness"><div class="ew-table-header-caption"><?php echo $t_proses_list->Fitness->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Fitness" class="<?php echo $t_proses_list->Fitness->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_proses_list->SortUrl($t_proses_list->Fitness) ?>', 1);"><div id="elh_t_proses_Fitness" class="t_proses_Fitness">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_proses_list->Fitness->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_proses_list->Fitness->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_proses_list->Fitness->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_proses_list->Generasi->Visible) { // Generasi ?>
	<?php if ($t_proses_list->SortUrl($t_proses_list->Generasi) == "") { ?>
		<th data-name="Generasi" class="<?php echo $t_proses_list->Generasi->headerCellClass() ?>"><div id="elh_t_proses_Generasi" class="t_proses_Generasi"><div class="ew-table-header-caption"><?php echo $t_proses_list->Generasi->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Generasi" class="<?php echo $t_proses_list->Generasi->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_proses_list->SortUrl($t_proses_list->Generasi) ?>', 1);"><div id="elh_t_proses_Generasi" class="t_proses_Generasi">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_proses_list->Generasi->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_proses_list->Generasi->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_proses_list->Generasi->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$t_proses_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($t_proses_list->ExportAll && $t_proses_list->isExport()) {
	$t_proses_list->StopRecord = $t_proses_list->TotalRecords;
} else {

	// Set the last record to display
	if ($t_proses_list->TotalRecords > $t_proses_list->StartRecord + $t_proses_list->DisplayRecords - 1)
		$t_proses_list->StopRecord = $t_proses_list->StartRecord + $t_proses_list->DisplayRecords - 1;
	else
		$t_proses_list->StopRecord = $t_proses_list->TotalRecords;
}
$t_proses_list->RecordCount = $t_proses_list->StartRecord - 1;
if ($t_proses_list->Recordset && !$t_proses_list->Recordset->EOF) {
	$t_proses_list->Recordset->moveFirst();
	$selectLimit = $t_proses_list->UseSelectLimit;
	if (!$selectLimit && $t_proses_list->StartRecord > 1)
		$t_proses_list->Recordset->move($t_proses_list->StartRecord - 1);
} elseif (!$t_proses->AllowAddDeleteRow && $t_proses_list->StopRecord == 0) {
	$t_proses_list->StopRecord = $t_proses->GridAddRowCount;
}

// Initialize aggregate
$t_proses->RowType = ROWTYPE_AGGREGATEINIT;
$t_proses->resetAttributes();
$t_proses_list->renderRow();
while ($t_proses_list->RecordCount < $t_proses_list->StopRecord) {
	$t_proses_list->RecordCount++;
	if ($t_proses_list->RecordCount >= $t_proses_list->StartRecord) {
		$t_proses_list->RowCount++;

		// Set up key count
		$t_proses_list->KeyCount = $t_proses_list->RowIndex;

		// Init row class and style
		$t_proses->resetAttributes();
		$t_proses->CssClass = "";
		if ($t_proses_list->isGridAdd()) {
		} else {
			$t_proses_list->loadRowValues($t_proses_list->Recordset); // Load row values
		}
		$t_proses->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$t_proses->RowAttrs->merge(["data-rowindex" => $t_proses_list->RowCount, "id" => "r" . $t_proses_list->RowCount . "_t_proses", "data-rowtype" => $t_proses->RowType]);

		// Render row
		$t_proses_list->renderRow();

		// Render list options
		$t_proses_list->renderListOptions();
?>
	<tr <?php echo $t_proses->rowAttributes() ?>>
<?php

// Render list options (body, left)
$t_proses_list->ListOptions->render("body", "left", $t_proses_list->RowCount);
?>
	<?php if ($t_proses_list->id->Visible) { // id ?>
		<td data-name="id" <?php echo $t_proses_list->id->cellAttributes() ?>>
<span id="el<?php echo $t_proses_list->RowCount ?>_t_proses_id">
<span<?php echo $t_proses_list->id->viewAttributes() ?>><?php echo $t_proses_list->id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_proses_list->TotalCost->Visible) { // TotalCost ?>
		<td data-name="TotalCost" <?php echo $t_proses_list->TotalCost->cellAttributes() ?>>
<span id="el<?php echo $t_proses_list->RowCount ?>_t_proses_TotalCost">
<span<?php echo $t_proses_list->TotalCost->viewAttributes() ?>><?php echo $t_proses_list->TotalCost->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_proses_list->TotalCargo->Visible) { // TotalCargo ?>
		<td data-name="TotalCargo" <?php echo $t_proses_list->TotalCargo->cellAttributes() ?>>
<span id="el<?php echo $t_proses_list->RowCount ?>_t_proses_TotalCargo">
<span<?php echo $t_proses_list->TotalCargo->viewAttributes() ?>><?php echo $t_proses_list->TotalCargo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_proses_list->Fitness->Visible) { // Fitness ?>
		<td data-name="Fitness" <?php echo $t_proses_list->Fitness->cellAttributes() ?>>
<span id="el<?php echo $t_proses_list->RowCount ?>_t_proses_Fitness">
<span<?php echo $t_proses_list->Fitness->viewAttributes() ?>><?php echo $t_proses_list->Fitness->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_proses_list->Generasi->Visible) { // Generasi ?>
		<td data-name="Generasi" <?php echo $t_proses_list->Generasi->cellAttributes() ?>>
<span id="el<?php echo $t_proses_list->RowCount ?>_t_proses_Generasi">
<span<?php echo $t_proses_list->Generasi->viewAttributes() ?>><?php echo $t_proses_list->Generasi->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t_proses_list->ListOptions->render("body", "right", $t_proses_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$t_proses_list->isGridAdd())
		$t_proses_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$t_proses->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($t_proses_list->Recordset)
	$t_proses_list->Recordset->Close();
?>
<?php if (!$t_proses_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$t_proses_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $t_proses_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $t_proses_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($t_proses_list->TotalRecords == 0 && !$t_proses->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $t_proses_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$t_proses_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$t_proses_list->isExport()) { ?>
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
$t_proses_list->terminate();
?>