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
$v_kapal_distribusi_list = new v_kapal_distribusi_list();

// Run the page
$v_kapal_distribusi_list->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$v_kapal_distribusi_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$v_kapal_distribusi_list->isExport()) { ?>
<script>
var fv_kapal_distribusilist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fv_kapal_distribusilist = currentForm = new ew.Form("fv_kapal_distribusilist", "list");
	fv_kapal_distribusilist.formKeyCountName = '<?php echo $v_kapal_distribusi_list->FormKeyCountName ?>';
	loadjs.done("fv_kapal_distribusilist");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$v_kapal_distribusi_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($v_kapal_distribusi_list->TotalRecords > 0 && $v_kapal_distribusi_list->ExportOptions->visible()) { ?>
<?php $v_kapal_distribusi_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($v_kapal_distribusi_list->ImportOptions->visible()) { ?>
<?php $v_kapal_distribusi_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$v_kapal_distribusi_list->renderOtherOptions();
?>
<?php $v_kapal_distribusi_list->showPageHeader(); ?>
<?php
$v_kapal_distribusi_list->showMessage();
?>
<?php if ($v_kapal_distribusi_list->TotalRecords > 0 || $v_kapal_distribusi->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($v_kapal_distribusi_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> v_kapal_distribusi">
<form name="fv_kapal_distribusilist" id="fv_kapal_distribusilist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="v_kapal_distribusi">
<div id="gmp_v_kapal_distribusi" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($v_kapal_distribusi_list->TotalRecords > 0 || $v_kapal_distribusi_list->isGridEdit()) { ?>
<table id="tbl_v_kapal_distribusilist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$v_kapal_distribusi->RowType = ROWTYPE_HEADER;

// Render list options
$v_kapal_distribusi_list->renderListOptions();

// Render list options (header, left)
$v_kapal_distribusi_list->ListOptions->render("header", "left");
?>
<?php if ($v_kapal_distribusi_list->kapal_id->Visible) { // kapal_id ?>
	<?php if ($v_kapal_distribusi_list->SortUrl($v_kapal_distribusi_list->kapal_id) == "") { ?>
		<th data-name="kapal_id" class="<?php echo $v_kapal_distribusi_list->kapal_id->headerCellClass() ?>"><div id="elh_v_kapal_distribusi_kapal_id" class="v_kapal_distribusi_kapal_id"><div class="ew-table-header-caption"><?php echo $v_kapal_distribusi_list->kapal_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kapal_id" class="<?php echo $v_kapal_distribusi_list->kapal_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $v_kapal_distribusi_list->SortUrl($v_kapal_distribusi_list->kapal_id) ?>', 1);"><div id="elh_v_kapal_distribusi_kapal_id" class="v_kapal_distribusi_kapal_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $v_kapal_distribusi_list->kapal_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($v_kapal_distribusi_list->kapal_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($v_kapal_distribusi_list->kapal_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($v_kapal_distribusi_list->distribusi_id->Visible) { // distribusi_id ?>
	<?php if ($v_kapal_distribusi_list->SortUrl($v_kapal_distribusi_list->distribusi_id) == "") { ?>
		<th data-name="distribusi_id" class="<?php echo $v_kapal_distribusi_list->distribusi_id->headerCellClass() ?>"><div id="elh_v_kapal_distribusi_distribusi_id" class="v_kapal_distribusi_distribusi_id"><div class="ew-table-header-caption"><?php echo $v_kapal_distribusi_list->distribusi_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="distribusi_id" class="<?php echo $v_kapal_distribusi_list->distribusi_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $v_kapal_distribusi_list->SortUrl($v_kapal_distribusi_list->distribusi_id) ?>', 1);"><div id="elh_v_kapal_distribusi_distribusi_id" class="v_kapal_distribusi_distribusi_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $v_kapal_distribusi_list->distribusi_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($v_kapal_distribusi_list->distribusi_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($v_kapal_distribusi_list->distribusi_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$v_kapal_distribusi_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($v_kapal_distribusi_list->ExportAll && $v_kapal_distribusi_list->isExport()) {
	$v_kapal_distribusi_list->StopRecord = $v_kapal_distribusi_list->TotalRecords;
} else {

	// Set the last record to display
	if ($v_kapal_distribusi_list->TotalRecords > $v_kapal_distribusi_list->StartRecord + $v_kapal_distribusi_list->DisplayRecords - 1)
		$v_kapal_distribusi_list->StopRecord = $v_kapal_distribusi_list->StartRecord + $v_kapal_distribusi_list->DisplayRecords - 1;
	else
		$v_kapal_distribusi_list->StopRecord = $v_kapal_distribusi_list->TotalRecords;
}
$v_kapal_distribusi_list->RecordCount = $v_kapal_distribusi_list->StartRecord - 1;
if ($v_kapal_distribusi_list->Recordset && !$v_kapal_distribusi_list->Recordset->EOF) {
	$v_kapal_distribusi_list->Recordset->moveFirst();
	$selectLimit = $v_kapal_distribusi_list->UseSelectLimit;
	if (!$selectLimit && $v_kapal_distribusi_list->StartRecord > 1)
		$v_kapal_distribusi_list->Recordset->move($v_kapal_distribusi_list->StartRecord - 1);
} elseif (!$v_kapal_distribusi->AllowAddDeleteRow && $v_kapal_distribusi_list->StopRecord == 0) {
	$v_kapal_distribusi_list->StopRecord = $v_kapal_distribusi->GridAddRowCount;
}

// Initialize aggregate
$v_kapal_distribusi->RowType = ROWTYPE_AGGREGATEINIT;
$v_kapal_distribusi->resetAttributes();
$v_kapal_distribusi_list->renderRow();
while ($v_kapal_distribusi_list->RecordCount < $v_kapal_distribusi_list->StopRecord) {
	$v_kapal_distribusi_list->RecordCount++;
	if ($v_kapal_distribusi_list->RecordCount >= $v_kapal_distribusi_list->StartRecord) {
		$v_kapal_distribusi_list->RowCount++;

		// Set up key count
		$v_kapal_distribusi_list->KeyCount = $v_kapal_distribusi_list->RowIndex;

		// Init row class and style
		$v_kapal_distribusi->resetAttributes();
		$v_kapal_distribusi->CssClass = "";
		if ($v_kapal_distribusi_list->isGridAdd()) {
		} else {
			$v_kapal_distribusi_list->loadRowValues($v_kapal_distribusi_list->Recordset); // Load row values
		}
		$v_kapal_distribusi->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$v_kapal_distribusi->RowAttrs->merge(["data-rowindex" => $v_kapal_distribusi_list->RowCount, "id" => "r" . $v_kapal_distribusi_list->RowCount . "_v_kapal_distribusi", "data-rowtype" => $v_kapal_distribusi->RowType]);

		// Render row
		$v_kapal_distribusi_list->renderRow();

		// Render list options
		$v_kapal_distribusi_list->renderListOptions();
?>
	<tr <?php echo $v_kapal_distribusi->rowAttributes() ?>>
<?php

// Render list options (body, left)
$v_kapal_distribusi_list->ListOptions->render("body", "left", $v_kapal_distribusi_list->RowCount);
?>
	<?php if ($v_kapal_distribusi_list->kapal_id->Visible) { // kapal_id ?>
		<td data-name="kapal_id" <?php echo $v_kapal_distribusi_list->kapal_id->cellAttributes() ?>>
<span id="el<?php echo $v_kapal_distribusi_list->RowCount ?>_v_kapal_distribusi_kapal_id">
<span<?php echo $v_kapal_distribusi_list->kapal_id->viewAttributes() ?>><?php echo $v_kapal_distribusi_list->kapal_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($v_kapal_distribusi_list->distribusi_id->Visible) { // distribusi_id ?>
		<td data-name="distribusi_id" <?php echo $v_kapal_distribusi_list->distribusi_id->cellAttributes() ?>>
<span id="el<?php echo $v_kapal_distribusi_list->RowCount ?>_v_kapal_distribusi_distribusi_id">
<span<?php echo $v_kapal_distribusi_list->distribusi_id->viewAttributes() ?>><?php echo $v_kapal_distribusi_list->distribusi_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$v_kapal_distribusi_list->ListOptions->render("body", "right", $v_kapal_distribusi_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$v_kapal_distribusi_list->isGridAdd())
		$v_kapal_distribusi_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$v_kapal_distribusi->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($v_kapal_distribusi_list->Recordset)
	$v_kapal_distribusi_list->Recordset->Close();
?>
<?php if (!$v_kapal_distribusi_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$v_kapal_distribusi_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $v_kapal_distribusi_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $v_kapal_distribusi_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($v_kapal_distribusi_list->TotalRecords == 0 && !$v_kapal_distribusi->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $v_kapal_distribusi_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$v_kapal_distribusi_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$v_kapal_distribusi_list->isExport()) { ?>
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
$v_kapal_distribusi_list->terminate();
?>