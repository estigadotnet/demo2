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
$t_kapal0_list = new t_kapal0_list();

// Run the page
$t_kapal0_list->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_kapal0_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$t_kapal0_list->isExport()) { ?>
<script>
var ft_kapal0list, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	ft_kapal0list = currentForm = new ew.Form("ft_kapal0list", "list");
	ft_kapal0list.formKeyCountName = '<?php echo $t_kapal0_list->FormKeyCountName ?>';
	loadjs.done("ft_kapal0list");
});
var ft_kapal0listsrch;
loadjs.ready("head", function() {

	// Form object for search
	ft_kapal0listsrch = currentSearchForm = new ew.Form("ft_kapal0listsrch");

	// Dynamic selection lists
	// Filters

	ft_kapal0listsrch.filterList = <?php echo $t_kapal0_list->getFilterList() ?>;
	loadjs.done("ft_kapal0listsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$t_kapal0_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($t_kapal0_list->TotalRecords > 0 && $t_kapal0_list->ExportOptions->visible()) { ?>
<?php $t_kapal0_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($t_kapal0_list->ImportOptions->visible()) { ?>
<?php $t_kapal0_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($t_kapal0_list->SearchOptions->visible()) { ?>
<?php $t_kapal0_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($t_kapal0_list->FilterOptions->visible()) { ?>
<?php $t_kapal0_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$t_kapal0_list->renderOtherOptions();
?>
<?php if (!$t_kapal0_list->isExport() && !$t_kapal0->CurrentAction) { ?>
<form name="ft_kapal0listsrch" id="ft_kapal0listsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="ft_kapal0listsrch-search-panel" class="<?php echo $t_kapal0_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="t_kapal0">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $t_kapal0_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($t_kapal0_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($t_kapal0_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $t_kapal0_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($t_kapal0_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($t_kapal0_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($t_kapal0_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($t_kapal0_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php $t_kapal0_list->showPageHeader(); ?>
<?php
$t_kapal0_list->showMessage();
?>
<?php if ($t_kapal0_list->TotalRecords > 0 || $t_kapal0->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($t_kapal0_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> t_kapal0">
<form name="ft_kapal0list" id="ft_kapal0list" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_kapal0">
<div id="gmp_t_kapal0" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($t_kapal0_list->TotalRecords > 0 || $t_kapal0_list->isGridEdit()) { ?>
<table id="tbl_t_kapal0list" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$t_kapal0->RowType = ROWTYPE_HEADER;

// Render list options
$t_kapal0_list->renderListOptions();

// Render list options (header, left)
$t_kapal0_list->ListOptions->render("header", "left");
?>
<?php if ($t_kapal0_list->Nama->Visible) { // Nama ?>
	<?php if ($t_kapal0_list->SortUrl($t_kapal0_list->Nama) == "") { ?>
		<th data-name="Nama" class="<?php echo $t_kapal0_list->Nama->headerCellClass() ?>"><div id="elh_t_kapal0_Nama" class="t_kapal0_Nama"><div class="ew-table-header-caption"><?php echo $t_kapal0_list->Nama->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Nama" class="<?php echo $t_kapal0_list->Nama->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_kapal0_list->SortUrl($t_kapal0_list->Nama) ?>', 1);"><div id="elh_t_kapal0_Nama" class="t_kapal0_Nama">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_kapal0_list->Nama->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($t_kapal0_list->Nama->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_kapal0_list->Nama->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$t_kapal0_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($t_kapal0_list->ExportAll && $t_kapal0_list->isExport()) {
	$t_kapal0_list->StopRecord = $t_kapal0_list->TotalRecords;
} else {

	// Set the last record to display
	if ($t_kapal0_list->TotalRecords > $t_kapal0_list->StartRecord + $t_kapal0_list->DisplayRecords - 1)
		$t_kapal0_list->StopRecord = $t_kapal0_list->StartRecord + $t_kapal0_list->DisplayRecords - 1;
	else
		$t_kapal0_list->StopRecord = $t_kapal0_list->TotalRecords;
}
$t_kapal0_list->RecordCount = $t_kapal0_list->StartRecord - 1;
if ($t_kapal0_list->Recordset && !$t_kapal0_list->Recordset->EOF) {
	$t_kapal0_list->Recordset->moveFirst();
	$selectLimit = $t_kapal0_list->UseSelectLimit;
	if (!$selectLimit && $t_kapal0_list->StartRecord > 1)
		$t_kapal0_list->Recordset->move($t_kapal0_list->StartRecord - 1);
} elseif (!$t_kapal0->AllowAddDeleteRow && $t_kapal0_list->StopRecord == 0) {
	$t_kapal0_list->StopRecord = $t_kapal0->GridAddRowCount;
}

// Initialize aggregate
$t_kapal0->RowType = ROWTYPE_AGGREGATEINIT;
$t_kapal0->resetAttributes();
$t_kapal0_list->renderRow();
while ($t_kapal0_list->RecordCount < $t_kapal0_list->StopRecord) {
	$t_kapal0_list->RecordCount++;
	if ($t_kapal0_list->RecordCount >= $t_kapal0_list->StartRecord) {
		$t_kapal0_list->RowCount++;

		// Set up key count
		$t_kapal0_list->KeyCount = $t_kapal0_list->RowIndex;

		// Init row class and style
		$t_kapal0->resetAttributes();
		$t_kapal0->CssClass = "";
		if ($t_kapal0_list->isGridAdd()) {
		} else {
			$t_kapal0_list->loadRowValues($t_kapal0_list->Recordset); // Load row values
		}
		$t_kapal0->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$t_kapal0->RowAttrs->merge(["data-rowindex" => $t_kapal0_list->RowCount, "id" => "r" . $t_kapal0_list->RowCount . "_t_kapal0", "data-rowtype" => $t_kapal0->RowType]);

		// Render row
		$t_kapal0_list->renderRow();

		// Render list options
		$t_kapal0_list->renderListOptions();
?>
	<tr <?php echo $t_kapal0->rowAttributes() ?>>
<?php

// Render list options (body, left)
$t_kapal0_list->ListOptions->render("body", "left", $t_kapal0_list->RowCount);
?>
	<?php if ($t_kapal0_list->Nama->Visible) { // Nama ?>
		<td data-name="Nama" <?php echo $t_kapal0_list->Nama->cellAttributes() ?>>
<span id="el<?php echo $t_kapal0_list->RowCount ?>_t_kapal0_Nama">
<span<?php echo $t_kapal0_list->Nama->viewAttributes() ?>><?php echo $t_kapal0_list->Nama->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t_kapal0_list->ListOptions->render("body", "right", $t_kapal0_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$t_kapal0_list->isGridAdd())
		$t_kapal0_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$t_kapal0->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($t_kapal0_list->Recordset)
	$t_kapal0_list->Recordset->Close();
?>
<?php if (!$t_kapal0_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$t_kapal0_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $t_kapal0_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $t_kapal0_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($t_kapal0_list->TotalRecords == 0 && !$t_kapal0->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $t_kapal0_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$t_kapal0_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$t_kapal0_list->isExport()) { ?>
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
$t_kapal0_list->terminate();
?>