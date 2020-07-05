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
$t_kapal_list = new t_kapal_list();

// Run the page
$t_kapal_list->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_kapal_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$t_kapal_list->isExport()) { ?>
<script>
var ft_kapallist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	ft_kapallist = currentForm = new ew.Form("ft_kapallist", "list");
	ft_kapallist.formKeyCountName = '<?php echo $t_kapal_list->FormKeyCountName ?>';
	loadjs.done("ft_kapallist");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$t_kapal_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($t_kapal_list->TotalRecords > 0 && $t_kapal_list->ExportOptions->visible()) { ?>
<?php $t_kapal_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($t_kapal_list->ImportOptions->visible()) { ?>
<?php $t_kapal_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$t_kapal_list->isExport() || Config("EXPORT_MASTER_RECORD") && $t_kapal_list->isExport("print")) { ?>
<?php
if ($t_kapal_list->DbMasterFilter != "" && $t_kapal->getCurrentMasterTable() == "t_kapal0") {
	if ($t_kapal_list->MasterRecordExists) {
		include_once "t_kapal0master.php";
	}
}
?>
<?php } ?>
<?php
$t_kapal_list->renderOtherOptions();
?>
<?php $t_kapal_list->showPageHeader(); ?>
<?php
$t_kapal_list->showMessage();
?>
<?php if ($t_kapal_list->TotalRecords > 0 || $t_kapal->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($t_kapal_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> t_kapal">
<form name="ft_kapallist" id="ft_kapallist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_kapal">
<?php if ($t_kapal->getCurrentMasterTable() == "t_kapal0" && $t_kapal->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="t_kapal0">
<input type="hidden" name="fk_id" value="<?php echo HtmlEncode($t_kapal_list->kapal_id->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_t_kapal" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($t_kapal_list->TotalRecords > 0 || $t_kapal_list->isGridEdit()) { ?>
<table id="tbl_t_kapallist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$t_kapal->RowType = ROWTYPE_HEADER;

// Render list options
$t_kapal_list->renderListOptions();

// Render list options (header, left)
$t_kapal_list->ListOptions->render("header", "left");
?>
<?php if ($t_kapal_list->Payload->Visible) { // Payload ?>
	<?php if ($t_kapal_list->SortUrl($t_kapal_list->Payload) == "") { ?>
		<th data-name="Payload" class="<?php echo $t_kapal_list->Payload->headerCellClass() ?>"><div id="elh_t_kapal_Payload" class="t_kapal_Payload"><div class="ew-table-header-caption"><?php echo $t_kapal_list->Payload->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Payload" class="<?php echo $t_kapal_list->Payload->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_kapal_list->SortUrl($t_kapal_list->Payload) ?>', 1);"><div id="elh_t_kapal_Payload" class="t_kapal_Payload">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_kapal_list->Payload->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_kapal_list->Payload->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_kapal_list->Payload->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_kapal_list->DischRate->Visible) { // DischRate ?>
	<?php if ($t_kapal_list->SortUrl($t_kapal_list->DischRate) == "") { ?>
		<th data-name="DischRate" class="<?php echo $t_kapal_list->DischRate->headerCellClass() ?>"><div id="elh_t_kapal_DischRate" class="t_kapal_DischRate"><div class="ew-table-header-caption"><?php echo $t_kapal_list->DischRate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DischRate" class="<?php echo $t_kapal_list->DischRate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_kapal_list->SortUrl($t_kapal_list->DischRate) ?>', 1);"><div id="elh_t_kapal_DischRate" class="t_kapal_DischRate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_kapal_list->DischRate->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_kapal_list->DischRate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_kapal_list->DischRate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_kapal_list->TCH->Visible) { // TCH ?>
	<?php if ($t_kapal_list->SortUrl($t_kapal_list->TCH) == "") { ?>
		<th data-name="TCH" class="<?php echo $t_kapal_list->TCH->headerCellClass() ?>"><div id="elh_t_kapal_TCH" class="t_kapal_TCH"><div class="ew-table-header-caption"><?php echo $t_kapal_list->TCH->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="TCH" class="<?php echo $t_kapal_list->TCH->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_kapal_list->SortUrl($t_kapal_list->TCH) ?>', 1);"><div id="elh_t_kapal_TCH" class="t_kapal_TCH">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_kapal_list->TCH->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_kapal_list->TCH->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_kapal_list->TCH->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_kapal_list->VarCost->Visible) { // VarCost ?>
	<?php if ($t_kapal_list->SortUrl($t_kapal_list->VarCost) == "") { ?>
		<th data-name="VarCost" class="<?php echo $t_kapal_list->VarCost->headerCellClass() ?>"><div id="elh_t_kapal_VarCost" class="t_kapal_VarCost"><div class="ew-table-header-caption"><?php echo $t_kapal_list->VarCost->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="VarCost" class="<?php echo $t_kapal_list->VarCost->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_kapal_list->SortUrl($t_kapal_list->VarCost) ?>', 1);"><div id="elh_t_kapal_VarCost" class="t_kapal_VarCost">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_kapal_list->VarCost->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_kapal_list->VarCost->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_kapal_list->VarCost->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_kapal_list->VsLaden->Visible) { // VsLaden ?>
	<?php if ($t_kapal_list->SortUrl($t_kapal_list->VsLaden) == "") { ?>
		<th data-name="VsLaden" class="<?php echo $t_kapal_list->VsLaden->headerCellClass() ?>"><div id="elh_t_kapal_VsLaden" class="t_kapal_VsLaden"><div class="ew-table-header-caption"><?php echo $t_kapal_list->VsLaden->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="VsLaden" class="<?php echo $t_kapal_list->VsLaden->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_kapal_list->SortUrl($t_kapal_list->VsLaden) ?>', 1);"><div id="elh_t_kapal_VsLaden" class="t_kapal_VsLaden">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_kapal_list->VsLaden->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_kapal_list->VsLaden->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_kapal_list->VsLaden->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_kapal_list->VsBallast->Visible) { // VsBallast ?>
	<?php if ($t_kapal_list->SortUrl($t_kapal_list->VsBallast) == "") { ?>
		<th data-name="VsBallast" class="<?php echo $t_kapal_list->VsBallast->headerCellClass() ?>"><div id="elh_t_kapal_VsBallast" class="t_kapal_VsBallast"><div class="ew-table-header-caption"><?php echo $t_kapal_list->VsBallast->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="VsBallast" class="<?php echo $t_kapal_list->VsBallast->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_kapal_list->SortUrl($t_kapal_list->VsBallast) ?>', 1);"><div id="elh_t_kapal_VsBallast" class="t_kapal_VsBallast">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_kapal_list->VsBallast->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_kapal_list->VsBallast->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_kapal_list->VsBallast->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($t_kapal_list->ComDay->Visible) { // ComDay ?>
	<?php if ($t_kapal_list->SortUrl($t_kapal_list->ComDay) == "") { ?>
		<th data-name="ComDay" class="<?php echo $t_kapal_list->ComDay->headerCellClass() ?>"><div id="elh_t_kapal_ComDay" class="t_kapal_ComDay"><div class="ew-table-header-caption"><?php echo $t_kapal_list->ComDay->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ComDay" class="<?php echo $t_kapal_list->ComDay->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $t_kapal_list->SortUrl($t_kapal_list->ComDay) ?>', 1);"><div id="elh_t_kapal_ComDay" class="t_kapal_ComDay">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $t_kapal_list->ComDay->caption() ?></span><span class="ew-table-header-sort"><?php if ($t_kapal_list->ComDay->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($t_kapal_list->ComDay->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$t_kapal_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($t_kapal_list->ExportAll && $t_kapal_list->isExport()) {
	$t_kapal_list->StopRecord = $t_kapal_list->TotalRecords;
} else {

	// Set the last record to display
	if ($t_kapal_list->TotalRecords > $t_kapal_list->StartRecord + $t_kapal_list->DisplayRecords - 1)
		$t_kapal_list->StopRecord = $t_kapal_list->StartRecord + $t_kapal_list->DisplayRecords - 1;
	else
		$t_kapal_list->StopRecord = $t_kapal_list->TotalRecords;
}
$t_kapal_list->RecordCount = $t_kapal_list->StartRecord - 1;
if ($t_kapal_list->Recordset && !$t_kapal_list->Recordset->EOF) {
	$t_kapal_list->Recordset->moveFirst();
	$selectLimit = $t_kapal_list->UseSelectLimit;
	if (!$selectLimit && $t_kapal_list->StartRecord > 1)
		$t_kapal_list->Recordset->move($t_kapal_list->StartRecord - 1);
} elseif (!$t_kapal->AllowAddDeleteRow && $t_kapal_list->StopRecord == 0) {
	$t_kapal_list->StopRecord = $t_kapal->GridAddRowCount;
}

// Initialize aggregate
$t_kapal->RowType = ROWTYPE_AGGREGATEINIT;
$t_kapal->resetAttributes();
$t_kapal_list->renderRow();
while ($t_kapal_list->RecordCount < $t_kapal_list->StopRecord) {
	$t_kapal_list->RecordCount++;
	if ($t_kapal_list->RecordCount >= $t_kapal_list->StartRecord) {
		$t_kapal_list->RowCount++;

		// Set up key count
		$t_kapal_list->KeyCount = $t_kapal_list->RowIndex;

		// Init row class and style
		$t_kapal->resetAttributes();
		$t_kapal->CssClass = "";
		if ($t_kapal_list->isGridAdd()) {
		} else {
			$t_kapal_list->loadRowValues($t_kapal_list->Recordset); // Load row values
		}
		$t_kapal->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$t_kapal->RowAttrs->merge(["data-rowindex" => $t_kapal_list->RowCount, "id" => "r" . $t_kapal_list->RowCount . "_t_kapal", "data-rowtype" => $t_kapal->RowType]);

		// Render row
		$t_kapal_list->renderRow();

		// Render list options
		$t_kapal_list->renderListOptions();
?>
	<tr <?php echo $t_kapal->rowAttributes() ?>>
<?php

// Render list options (body, left)
$t_kapal_list->ListOptions->render("body", "left", $t_kapal_list->RowCount);
?>
	<?php if ($t_kapal_list->Payload->Visible) { // Payload ?>
		<td data-name="Payload" <?php echo $t_kapal_list->Payload->cellAttributes() ?>>
<span id="el<?php echo $t_kapal_list->RowCount ?>_t_kapal_Payload">
<span<?php echo $t_kapal_list->Payload->viewAttributes() ?>><?php echo $t_kapal_list->Payload->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_kapal_list->DischRate->Visible) { // DischRate ?>
		<td data-name="DischRate" <?php echo $t_kapal_list->DischRate->cellAttributes() ?>>
<span id="el<?php echo $t_kapal_list->RowCount ?>_t_kapal_DischRate">
<span<?php echo $t_kapal_list->DischRate->viewAttributes() ?>><?php echo $t_kapal_list->DischRate->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_kapal_list->TCH->Visible) { // TCH ?>
		<td data-name="TCH" <?php echo $t_kapal_list->TCH->cellAttributes() ?>>
<span id="el<?php echo $t_kapal_list->RowCount ?>_t_kapal_TCH">
<span<?php echo $t_kapal_list->TCH->viewAttributes() ?>><?php echo $t_kapal_list->TCH->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_kapal_list->VarCost->Visible) { // VarCost ?>
		<td data-name="VarCost" <?php echo $t_kapal_list->VarCost->cellAttributes() ?>>
<span id="el<?php echo $t_kapal_list->RowCount ?>_t_kapal_VarCost">
<span<?php echo $t_kapal_list->VarCost->viewAttributes() ?>><?php echo $t_kapal_list->VarCost->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_kapal_list->VsLaden->Visible) { // VsLaden ?>
		<td data-name="VsLaden" <?php echo $t_kapal_list->VsLaden->cellAttributes() ?>>
<span id="el<?php echo $t_kapal_list->RowCount ?>_t_kapal_VsLaden">
<span<?php echo $t_kapal_list->VsLaden->viewAttributes() ?>><?php echo $t_kapal_list->VsLaden->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_kapal_list->VsBallast->Visible) { // VsBallast ?>
		<td data-name="VsBallast" <?php echo $t_kapal_list->VsBallast->cellAttributes() ?>>
<span id="el<?php echo $t_kapal_list->RowCount ?>_t_kapal_VsBallast">
<span<?php echo $t_kapal_list->VsBallast->viewAttributes() ?>><?php echo $t_kapal_list->VsBallast->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($t_kapal_list->ComDay->Visible) { // ComDay ?>
		<td data-name="ComDay" <?php echo $t_kapal_list->ComDay->cellAttributes() ?>>
<span id="el<?php echo $t_kapal_list->RowCount ?>_t_kapal_ComDay">
<span<?php echo $t_kapal_list->ComDay->viewAttributes() ?>><?php echo $t_kapal_list->ComDay->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t_kapal_list->ListOptions->render("body", "right", $t_kapal_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$t_kapal_list->isGridAdd())
		$t_kapal_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$t_kapal->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($t_kapal_list->Recordset)
	$t_kapal_list->Recordset->Close();
?>
<?php if (!$t_kapal_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$t_kapal_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $t_kapal_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $t_kapal_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($t_kapal_list->TotalRecords == 0 && !$t_kapal->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $t_kapal_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$t_kapal_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$t_kapal_list->isExport()) { ?>
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
$t_kapal_list->terminate();
?>