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
$v_hasil_list = new v_hasil_list();

// Run the page
$v_hasil_list->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$v_hasil_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$v_hasil_list->isExport()) { ?>
<script>
var fv_hasillist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fv_hasillist = currentForm = new ew.Form("fv_hasillist", "list");
	fv_hasillist.formKeyCountName = '<?php echo $v_hasil_list->FormKeyCountName ?>';
	loadjs.done("fv_hasillist");
});
var fv_hasillistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fv_hasillistsrch = currentSearchForm = new ew.Form("fv_hasillistsrch");

	// Dynamic selection lists
	// Filters

	fv_hasillistsrch.filterList = <?php echo $v_hasil_list->getFilterList() ?>;
	loadjs.done("fv_hasillistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$v_hasil_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($v_hasil_list->TotalRecords > 0 && $v_hasil_list->ExportOptions->visible()) { ?>
<?php $v_hasil_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($v_hasil_list->ImportOptions->visible()) { ?>
<?php $v_hasil_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($v_hasil_list->SearchOptions->visible()) { ?>
<?php $v_hasil_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($v_hasil_list->FilterOptions->visible()) { ?>
<?php $v_hasil_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$v_hasil_list->renderOtherOptions();
?>
<?php if (!$v_hasil_list->isExport() && !$v_hasil->CurrentAction) { ?>
<form name="fv_hasillistsrch" id="fv_hasillistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fv_hasillistsrch-search-panel" class="<?php echo $v_hasil_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="v_hasil">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $v_hasil_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($v_hasil_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($v_hasil_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $v_hasil_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($v_hasil_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($v_hasil_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($v_hasil_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($v_hasil_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php $v_hasil_list->showPageHeader(); ?>
<?php
$v_hasil_list->showMessage();
?>
<?php if ($v_hasil_list->TotalRecords > 0 || $v_hasil->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($v_hasil_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> v_hasil">
<form name="fv_hasillist" id="fv_hasillist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="v_hasil">
<div id="gmp_v_hasil" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($v_hasil_list->TotalRecords > 0 || $v_hasil_list->isGridEdit()) { ?>
<table id="tbl_v_hasillist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$v_hasil->RowType = ROWTYPE_HEADER;

// Render list options
$v_hasil_list->renderListOptions();

// Render list options (header, left)
$v_hasil_list->ListOptions->render("header", "left");
?>
<?php if ($v_hasil_list->kapal_id->Visible) { // kapal_id ?>
	<?php if ($v_hasil_list->SortUrl($v_hasil_list->kapal_id) == "") { ?>
		<th data-name="kapal_id" class="<?php echo $v_hasil_list->kapal_id->headerCellClass() ?>"><div id="elh_v_hasil_kapal_id" class="v_hasil_kapal_id"><div class="ew-table-header-caption"><?php echo $v_hasil_list->kapal_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kapal_id" class="<?php echo $v_hasil_list->kapal_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $v_hasil_list->SortUrl($v_hasil_list->kapal_id) ?>', 1);"><div id="elh_v_hasil_kapal_id" class="v_hasil_kapal_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $v_hasil_list->kapal_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($v_hasil_list->kapal_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($v_hasil_list->kapal_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($v_hasil_list->distribusi_id->Visible) { // distribusi_id ?>
	<?php if ($v_hasil_list->SortUrl($v_hasil_list->distribusi_id) == "") { ?>
		<th data-name="distribusi_id" class="<?php echo $v_hasil_list->distribusi_id->headerCellClass() ?>"><div id="elh_v_hasil_distribusi_id" class="v_hasil_distribusi_id"><div class="ew-table-header-caption"><?php echo $v_hasil_list->distribusi_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="distribusi_id" class="<?php echo $v_hasil_list->distribusi_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $v_hasil_list->SortUrl($v_hasil_list->distribusi_id) ?>', 1);"><div id="elh_v_hasil_distribusi_id" class="v_hasil_distribusi_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $v_hasil_list->distribusi_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($v_hasil_list->distribusi_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($v_hasil_list->distribusi_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($v_hasil_list->kapal0_id->Visible) { // kapal0_id ?>
	<?php if ($v_hasil_list->SortUrl($v_hasil_list->kapal0_id) == "") { ?>
		<th data-name="kapal0_id" class="<?php echo $v_hasil_list->kapal0_id->headerCellClass() ?>"><div id="elh_v_hasil_kapal0_id" class="v_hasil_kapal0_id"><div class="ew-table-header-caption"><?php echo $v_hasil_list->kapal0_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kapal0_id" class="<?php echo $v_hasil_list->kapal0_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $v_hasil_list->SortUrl($v_hasil_list->kapal0_id) ?>', 1);"><div id="elh_v_hasil_kapal0_id" class="v_hasil_kapal0_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $v_hasil_list->kapal0_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($v_hasil_list->kapal0_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($v_hasil_list->kapal0_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($v_hasil_list->kapal0_nama->Visible) { // kapal0_nama ?>
	<?php if ($v_hasil_list->SortUrl($v_hasil_list->kapal0_nama) == "") { ?>
		<th data-name="kapal0_nama" class="<?php echo $v_hasil_list->kapal0_nama->headerCellClass() ?>"><div id="elh_v_hasil_kapal0_nama" class="v_hasil_kapal0_nama"><div class="ew-table-header-caption"><?php echo $v_hasil_list->kapal0_nama->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kapal0_nama" class="<?php echo $v_hasil_list->kapal0_nama->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $v_hasil_list->SortUrl($v_hasil_list->kapal0_nama) ?>', 1);"><div id="elh_v_hasil_kapal0_nama" class="v_hasil_kapal0_nama">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $v_hasil_list->kapal0_nama->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($v_hasil_list->kapal0_nama->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($v_hasil_list->kapal0_nama->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($v_hasil_list->kapaldetail_id->Visible) { // kapaldetail_id ?>
	<?php if ($v_hasil_list->SortUrl($v_hasil_list->kapaldetail_id) == "") { ?>
		<th data-name="kapaldetail_id" class="<?php echo $v_hasil_list->kapaldetail_id->headerCellClass() ?>"><div id="elh_v_hasil_kapaldetail_id" class="v_hasil_kapaldetail_id"><div class="ew-table-header-caption"><?php echo $v_hasil_list->kapaldetail_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kapaldetail_id" class="<?php echo $v_hasil_list->kapaldetail_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $v_hasil_list->SortUrl($v_hasil_list->kapaldetail_id) ?>', 1);"><div id="elh_v_hasil_kapaldetail_id" class="v_hasil_kapaldetail_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $v_hasil_list->kapaldetail_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($v_hasil_list->kapaldetail_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($v_hasil_list->kapaldetail_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($v_hasil_list->Payload->Visible) { // Payload ?>
	<?php if ($v_hasil_list->SortUrl($v_hasil_list->Payload) == "") { ?>
		<th data-name="Payload" class="<?php echo $v_hasil_list->Payload->headerCellClass() ?>"><div id="elh_v_hasil_Payload" class="v_hasil_Payload"><div class="ew-table-header-caption"><?php echo $v_hasil_list->Payload->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Payload" class="<?php echo $v_hasil_list->Payload->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $v_hasil_list->SortUrl($v_hasil_list->Payload) ?>', 1);"><div id="elh_v_hasil_Payload" class="v_hasil_Payload">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $v_hasil_list->Payload->caption() ?></span><span class="ew-table-header-sort"><?php if ($v_hasil_list->Payload->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($v_hasil_list->Payload->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($v_hasil_list->DischRate->Visible) { // DischRate ?>
	<?php if ($v_hasil_list->SortUrl($v_hasil_list->DischRate) == "") { ?>
		<th data-name="DischRate" class="<?php echo $v_hasil_list->DischRate->headerCellClass() ?>"><div id="elh_v_hasil_DischRate" class="v_hasil_DischRate"><div class="ew-table-header-caption"><?php echo $v_hasil_list->DischRate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DischRate" class="<?php echo $v_hasil_list->DischRate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $v_hasil_list->SortUrl($v_hasil_list->DischRate) ?>', 1);"><div id="elh_v_hasil_DischRate" class="v_hasil_DischRate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $v_hasil_list->DischRate->caption() ?></span><span class="ew-table-header-sort"><?php if ($v_hasil_list->DischRate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($v_hasil_list->DischRate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($v_hasil_list->TCH->Visible) { // TCH ?>
	<?php if ($v_hasil_list->SortUrl($v_hasil_list->TCH) == "") { ?>
		<th data-name="TCH" class="<?php echo $v_hasil_list->TCH->headerCellClass() ?>"><div id="elh_v_hasil_TCH" class="v_hasil_TCH"><div class="ew-table-header-caption"><?php echo $v_hasil_list->TCH->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="TCH" class="<?php echo $v_hasil_list->TCH->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $v_hasil_list->SortUrl($v_hasil_list->TCH) ?>', 1);"><div id="elh_v_hasil_TCH" class="v_hasil_TCH">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $v_hasil_list->TCH->caption() ?></span><span class="ew-table-header-sort"><?php if ($v_hasil_list->TCH->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($v_hasil_list->TCH->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($v_hasil_list->VarCost->Visible) { // VarCost ?>
	<?php if ($v_hasil_list->SortUrl($v_hasil_list->VarCost) == "") { ?>
		<th data-name="VarCost" class="<?php echo $v_hasil_list->VarCost->headerCellClass() ?>"><div id="elh_v_hasil_VarCost" class="v_hasil_VarCost"><div class="ew-table-header-caption"><?php echo $v_hasil_list->VarCost->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="VarCost" class="<?php echo $v_hasil_list->VarCost->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $v_hasil_list->SortUrl($v_hasil_list->VarCost) ?>', 1);"><div id="elh_v_hasil_VarCost" class="v_hasil_VarCost">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $v_hasil_list->VarCost->caption() ?></span><span class="ew-table-header-sort"><?php if ($v_hasil_list->VarCost->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($v_hasil_list->VarCost->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($v_hasil_list->VsLaden->Visible) { // VsLaden ?>
	<?php if ($v_hasil_list->SortUrl($v_hasil_list->VsLaden) == "") { ?>
		<th data-name="VsLaden" class="<?php echo $v_hasil_list->VsLaden->headerCellClass() ?>"><div id="elh_v_hasil_VsLaden" class="v_hasil_VsLaden"><div class="ew-table-header-caption"><?php echo $v_hasil_list->VsLaden->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="VsLaden" class="<?php echo $v_hasil_list->VsLaden->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $v_hasil_list->SortUrl($v_hasil_list->VsLaden) ?>', 1);"><div id="elh_v_hasil_VsLaden" class="v_hasil_VsLaden">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $v_hasil_list->VsLaden->caption() ?></span><span class="ew-table-header-sort"><?php if ($v_hasil_list->VsLaden->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($v_hasil_list->VsLaden->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($v_hasil_list->VsBallast->Visible) { // VsBallast ?>
	<?php if ($v_hasil_list->SortUrl($v_hasil_list->VsBallast) == "") { ?>
		<th data-name="VsBallast" class="<?php echo $v_hasil_list->VsBallast->headerCellClass() ?>"><div id="elh_v_hasil_VsBallast" class="v_hasil_VsBallast"><div class="ew-table-header-caption"><?php echo $v_hasil_list->VsBallast->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="VsBallast" class="<?php echo $v_hasil_list->VsBallast->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $v_hasil_list->SortUrl($v_hasil_list->VsBallast) ?>', 1);"><div id="elh_v_hasil_VsBallast" class="v_hasil_VsBallast">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $v_hasil_list->VsBallast->caption() ?></span><span class="ew-table-header-sort"><?php if ($v_hasil_list->VsBallast->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($v_hasil_list->VsBallast->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($v_hasil_list->ComDay->Visible) { // ComDay ?>
	<?php if ($v_hasil_list->SortUrl($v_hasil_list->ComDay) == "") { ?>
		<th data-name="ComDay" class="<?php echo $v_hasil_list->ComDay->headerCellClass() ?>"><div id="elh_v_hasil_ComDay" class="v_hasil_ComDay"><div class="ew-table-header-caption"><?php echo $v_hasil_list->ComDay->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ComDay" class="<?php echo $v_hasil_list->ComDay->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $v_hasil_list->SortUrl($v_hasil_list->ComDay) ?>', 1);"><div id="elh_v_hasil_ComDay" class="v_hasil_ComDay">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $v_hasil_list->ComDay->caption() ?></span><span class="ew-table-header-sort"><?php if ($v_hasil_list->ComDay->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($v_hasil_list->ComDay->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($v_hasil_list->t_distribusi_id->Visible) { // t_distribusi_id ?>
	<?php if ($v_hasil_list->SortUrl($v_hasil_list->t_distribusi_id) == "") { ?>
		<th data-name="t_distribusi_id" class="<?php echo $v_hasil_list->t_distribusi_id->headerCellClass() ?>"><div id="elh_v_hasil_t_distribusi_id" class="v_hasil_t_distribusi_id"><div class="ew-table-header-caption"><?php echo $v_hasil_list->t_distribusi_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="t_distribusi_id" class="<?php echo $v_hasil_list->t_distribusi_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $v_hasil_list->SortUrl($v_hasil_list->t_distribusi_id) ?>', 1);"><div id="elh_v_hasil_t_distribusi_id" class="v_hasil_t_distribusi_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $v_hasil_list->t_distribusi_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($v_hasil_list->t_distribusi_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($v_hasil_list->t_distribusi_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($v_hasil_list->source_id->Visible) { // source_id ?>
	<?php if ($v_hasil_list->SortUrl($v_hasil_list->source_id) == "") { ?>
		<th data-name="source_id" class="<?php echo $v_hasil_list->source_id->headerCellClass() ?>"><div id="elh_v_hasil_source_id" class="v_hasil_source_id"><div class="ew-table-header-caption"><?php echo $v_hasil_list->source_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="source_id" class="<?php echo $v_hasil_list->source_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $v_hasil_list->SortUrl($v_hasil_list->source_id) ?>', 1);"><div id="elh_v_hasil_source_id" class="v_hasil_source_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $v_hasil_list->source_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($v_hasil_list->source_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($v_hasil_list->source_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($v_hasil_list->destination_id->Visible) { // destination_id ?>
	<?php if ($v_hasil_list->SortUrl($v_hasil_list->destination_id) == "") { ?>
		<th data-name="destination_id" class="<?php echo $v_hasil_list->destination_id->headerCellClass() ?>"><div id="elh_v_hasil_destination_id" class="v_hasil_destination_id"><div class="ew-table-header-caption"><?php echo $v_hasil_list->destination_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="destination_id" class="<?php echo $v_hasil_list->destination_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $v_hasil_list->SortUrl($v_hasil_list->destination_id) ?>', 1);"><div id="elh_v_hasil_destination_id" class="v_hasil_destination_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $v_hasil_list->destination_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($v_hasil_list->destination_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($v_hasil_list->destination_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($v_hasil_list->Jarak->Visible) { // Jarak ?>
	<?php if ($v_hasil_list->SortUrl($v_hasil_list->Jarak) == "") { ?>
		<th data-name="Jarak" class="<?php echo $v_hasil_list->Jarak->headerCellClass() ?>"><div id="elh_v_hasil_Jarak" class="v_hasil_Jarak"><div class="ew-table-header-caption"><?php echo $v_hasil_list->Jarak->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Jarak" class="<?php echo $v_hasil_list->Jarak->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $v_hasil_list->SortUrl($v_hasil_list->Jarak) ?>', 1);"><div id="elh_v_hasil_Jarak" class="v_hasil_Jarak">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $v_hasil_list->Jarak->caption() ?></span><span class="ew-table-header-sort"><?php if ($v_hasil_list->Jarak->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($v_hasil_list->Jarak->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($v_hasil_list->Rate_O->Visible) { // Rate_O ?>
	<?php if ($v_hasil_list->SortUrl($v_hasil_list->Rate_O) == "") { ?>
		<th data-name="Rate_O" class="<?php echo $v_hasil_list->Rate_O->headerCellClass() ?>"><div id="elh_v_hasil_Rate_O" class="v_hasil_Rate_O"><div class="ew-table-header-caption"><?php echo $v_hasil_list->Rate_O->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Rate_O" class="<?php echo $v_hasil_list->Rate_O->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $v_hasil_list->SortUrl($v_hasil_list->Rate_O) ?>', 1);"><div id="elh_v_hasil_Rate_O" class="v_hasil_Rate_O">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $v_hasil_list->Rate_O->caption() ?></span><span class="ew-table-header-sort"><?php if ($v_hasil_list->Rate_O->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($v_hasil_list->Rate_O->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($v_hasil_list->Rate_D->Visible) { // Rate_D ?>
	<?php if ($v_hasil_list->SortUrl($v_hasil_list->Rate_D) == "") { ?>
		<th data-name="Rate_D" class="<?php echo $v_hasil_list->Rate_D->headerCellClass() ?>"><div id="elh_v_hasil_Rate_D" class="v_hasil_Rate_D"><div class="ew-table-header-caption"><?php echo $v_hasil_list->Rate_D->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Rate_D" class="<?php echo $v_hasil_list->Rate_D->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $v_hasil_list->SortUrl($v_hasil_list->Rate_D) ?>', 1);"><div id="elh_v_hasil_Rate_D" class="v_hasil_Rate_D">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $v_hasil_list->Rate_D->caption() ?></span><span class="ew-table-header-sort"><?php if ($v_hasil_list->Rate_D->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($v_hasil_list->Rate_D->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($v_hasil_list->Demand->Visible) { // Demand ?>
	<?php if ($v_hasil_list->SortUrl($v_hasil_list->Demand) == "") { ?>
		<th data-name="Demand" class="<?php echo $v_hasil_list->Demand->headerCellClass() ?>"><div id="elh_v_hasil_Demand" class="v_hasil_Demand"><div class="ew-table-header-caption"><?php echo $v_hasil_list->Demand->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Demand" class="<?php echo $v_hasil_list->Demand->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $v_hasil_list->SortUrl($v_hasil_list->Demand) ?>', 1);"><div id="elh_v_hasil_Demand" class="v_hasil_Demand">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $v_hasil_list->Demand->caption() ?></span><span class="ew-table-header-sort"><?php if ($v_hasil_list->Demand->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($v_hasil_list->Demand->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($v_hasil_list->sea_time->Visible) { // sea_time ?>
	<?php if ($v_hasil_list->SortUrl($v_hasil_list->sea_time) == "") { ?>
		<th data-name="sea_time" class="<?php echo $v_hasil_list->sea_time->headerCellClass() ?>"><div id="elh_v_hasil_sea_time" class="v_hasil_sea_time"><div class="ew-table-header-caption"><?php echo $v_hasil_list->sea_time->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="sea_time" class="<?php echo $v_hasil_list->sea_time->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $v_hasil_list->SortUrl($v_hasil_list->sea_time) ?>', 1);"><div id="elh_v_hasil_sea_time" class="v_hasil_sea_time">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $v_hasil_list->sea_time->caption() ?></span><span class="ew-table-header-sort"><?php if ($v_hasil_list->sea_time->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($v_hasil_list->sea_time->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($v_hasil_list->port_time->Visible) { // port_time ?>
	<?php if ($v_hasil_list->SortUrl($v_hasil_list->port_time) == "") { ?>
		<th data-name="port_time" class="<?php echo $v_hasil_list->port_time->headerCellClass() ?>"><div id="elh_v_hasil_port_time" class="v_hasil_port_time"><div class="ew-table-header-caption"><?php echo $v_hasil_list->port_time->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="port_time" class="<?php echo $v_hasil_list->port_time->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $v_hasil_list->SortUrl($v_hasil_list->port_time) ?>', 1);"><div id="elh_v_hasil_port_time" class="v_hasil_port_time">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $v_hasil_list->port_time->caption() ?></span><span class="ew-table-header-sort"><?php if ($v_hasil_list->port_time->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($v_hasil_list->port_time->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($v_hasil_list->roundtrip_days->Visible) { // roundtrip_days ?>
	<?php if ($v_hasil_list->SortUrl($v_hasil_list->roundtrip_days) == "") { ?>
		<th data-name="roundtrip_days" class="<?php echo $v_hasil_list->roundtrip_days->headerCellClass() ?>"><div id="elh_v_hasil_roundtrip_days" class="v_hasil_roundtrip_days"><div class="ew-table-header-caption"><?php echo $v_hasil_list->roundtrip_days->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="roundtrip_days" class="<?php echo $v_hasil_list->roundtrip_days->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $v_hasil_list->SortUrl($v_hasil_list->roundtrip_days) ?>', 1);"><div id="elh_v_hasil_roundtrip_days" class="v_hasil_roundtrip_days">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $v_hasil_list->roundtrip_days->caption() ?></span><span class="ew-table-header-sort"><?php if ($v_hasil_list->roundtrip_days->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($v_hasil_list->roundtrip_days->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($v_hasil_list->freqmaxbytrip->Visible) { // freqmaxbytrip ?>
	<?php if ($v_hasil_list->SortUrl($v_hasil_list->freqmaxbytrip) == "") { ?>
		<th data-name="freqmaxbytrip" class="<?php echo $v_hasil_list->freqmaxbytrip->headerCellClass() ?>"><div id="elh_v_hasil_freqmaxbytrip" class="v_hasil_freqmaxbytrip"><div class="ew-table-header-caption"><?php echo $v_hasil_list->freqmaxbytrip->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="freqmaxbytrip" class="<?php echo $v_hasil_list->freqmaxbytrip->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $v_hasil_list->SortUrl($v_hasil_list->freqmaxbytrip) ?>', 1);"><div id="elh_v_hasil_freqmaxbytrip" class="v_hasil_freqmaxbytrip">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $v_hasil_list->freqmaxbytrip->caption() ?></span><span class="ew-table-header-sort"><?php if ($v_hasil_list->freqmaxbytrip->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($v_hasil_list->freqmaxbytrip->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($v_hasil_list->freqmaxbycargo->Visible) { // freqmaxbycargo ?>
	<?php if ($v_hasil_list->SortUrl($v_hasil_list->freqmaxbycargo) == "") { ?>
		<th data-name="freqmaxbycargo" class="<?php echo $v_hasil_list->freqmaxbycargo->headerCellClass() ?>"><div id="elh_v_hasil_freqmaxbycargo" class="v_hasil_freqmaxbycargo"><div class="ew-table-header-caption"><?php echo $v_hasil_list->freqmaxbycargo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="freqmaxbycargo" class="<?php echo $v_hasil_list->freqmaxbycargo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $v_hasil_list->SortUrl($v_hasil_list->freqmaxbycargo) ?>', 1);"><div id="elh_v_hasil_freqmaxbycargo" class="v_hasil_freqmaxbycargo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $v_hasil_list->freqmaxbycargo->caption() ?></span><span class="ew-table-header-sort"><?php if ($v_hasil_list->freqmaxbycargo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($v_hasil_list->freqmaxbycargo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$v_hasil_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($v_hasil_list->ExportAll && $v_hasil_list->isExport()) {
	$v_hasil_list->StopRecord = $v_hasil_list->TotalRecords;
} else {

	// Set the last record to display
	if ($v_hasil_list->TotalRecords > $v_hasil_list->StartRecord + $v_hasil_list->DisplayRecords - 1)
		$v_hasil_list->StopRecord = $v_hasil_list->StartRecord + $v_hasil_list->DisplayRecords - 1;
	else
		$v_hasil_list->StopRecord = $v_hasil_list->TotalRecords;
}
$v_hasil_list->RecordCount = $v_hasil_list->StartRecord - 1;
if ($v_hasil_list->Recordset && !$v_hasil_list->Recordset->EOF) {
	$v_hasil_list->Recordset->moveFirst();
	$selectLimit = $v_hasil_list->UseSelectLimit;
	if (!$selectLimit && $v_hasil_list->StartRecord > 1)
		$v_hasil_list->Recordset->move($v_hasil_list->StartRecord - 1);
} elseif (!$v_hasil->AllowAddDeleteRow && $v_hasil_list->StopRecord == 0) {
	$v_hasil_list->StopRecord = $v_hasil->GridAddRowCount;
}

// Initialize aggregate
$v_hasil->RowType = ROWTYPE_AGGREGATEINIT;
$v_hasil->resetAttributes();
$v_hasil_list->renderRow();
while ($v_hasil_list->RecordCount < $v_hasil_list->StopRecord) {
	$v_hasil_list->RecordCount++;
	if ($v_hasil_list->RecordCount >= $v_hasil_list->StartRecord) {
		$v_hasil_list->RowCount++;

		// Set up key count
		$v_hasil_list->KeyCount = $v_hasil_list->RowIndex;

		// Init row class and style
		$v_hasil->resetAttributes();
		$v_hasil->CssClass = "";
		if ($v_hasil_list->isGridAdd()) {
		} else {
			$v_hasil_list->loadRowValues($v_hasil_list->Recordset); // Load row values
		}
		$v_hasil->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$v_hasil->RowAttrs->merge(["data-rowindex" => $v_hasil_list->RowCount, "id" => "r" . $v_hasil_list->RowCount . "_v_hasil", "data-rowtype" => $v_hasil->RowType]);

		// Render row
		$v_hasil_list->renderRow();

		// Render list options
		$v_hasil_list->renderListOptions();
?>
	<tr <?php echo $v_hasil->rowAttributes() ?>>
<?php

// Render list options (body, left)
$v_hasil_list->ListOptions->render("body", "left", $v_hasil_list->RowCount);
?>
	<?php if ($v_hasil_list->kapal_id->Visible) { // kapal_id ?>
		<td data-name="kapal_id" <?php echo $v_hasil_list->kapal_id->cellAttributes() ?>>
<span id="el<?php echo $v_hasil_list->RowCount ?>_v_hasil_kapal_id">
<span<?php echo $v_hasil_list->kapal_id->viewAttributes() ?>><?php echo $v_hasil_list->kapal_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($v_hasil_list->distribusi_id->Visible) { // distribusi_id ?>
		<td data-name="distribusi_id" <?php echo $v_hasil_list->distribusi_id->cellAttributes() ?>>
<span id="el<?php echo $v_hasil_list->RowCount ?>_v_hasil_distribusi_id">
<span<?php echo $v_hasil_list->distribusi_id->viewAttributes() ?>><?php echo $v_hasil_list->distribusi_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($v_hasil_list->kapal0_id->Visible) { // kapal0_id ?>
		<td data-name="kapal0_id" <?php echo $v_hasil_list->kapal0_id->cellAttributes() ?>>
<span id="el<?php echo $v_hasil_list->RowCount ?>_v_hasil_kapal0_id">
<span<?php echo $v_hasil_list->kapal0_id->viewAttributes() ?>><?php echo $v_hasil_list->kapal0_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($v_hasil_list->kapal0_nama->Visible) { // kapal0_nama ?>
		<td data-name="kapal0_nama" <?php echo $v_hasil_list->kapal0_nama->cellAttributes() ?>>
<span id="el<?php echo $v_hasil_list->RowCount ?>_v_hasil_kapal0_nama">
<span<?php echo $v_hasil_list->kapal0_nama->viewAttributes() ?>><?php echo $v_hasil_list->kapal0_nama->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($v_hasil_list->kapaldetail_id->Visible) { // kapaldetail_id ?>
		<td data-name="kapaldetail_id" <?php echo $v_hasil_list->kapaldetail_id->cellAttributes() ?>>
<span id="el<?php echo $v_hasil_list->RowCount ?>_v_hasil_kapaldetail_id">
<span<?php echo $v_hasil_list->kapaldetail_id->viewAttributes() ?>><?php echo $v_hasil_list->kapaldetail_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($v_hasil_list->Payload->Visible) { // Payload ?>
		<td data-name="Payload" <?php echo $v_hasil_list->Payload->cellAttributes() ?>>
<span id="el<?php echo $v_hasil_list->RowCount ?>_v_hasil_Payload">
<span<?php echo $v_hasil_list->Payload->viewAttributes() ?>><?php echo $v_hasil_list->Payload->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($v_hasil_list->DischRate->Visible) { // DischRate ?>
		<td data-name="DischRate" <?php echo $v_hasil_list->DischRate->cellAttributes() ?>>
<span id="el<?php echo $v_hasil_list->RowCount ?>_v_hasil_DischRate">
<span<?php echo $v_hasil_list->DischRate->viewAttributes() ?>><?php echo $v_hasil_list->DischRate->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($v_hasil_list->TCH->Visible) { // TCH ?>
		<td data-name="TCH" <?php echo $v_hasil_list->TCH->cellAttributes() ?>>
<span id="el<?php echo $v_hasil_list->RowCount ?>_v_hasil_TCH">
<span<?php echo $v_hasil_list->TCH->viewAttributes() ?>><?php echo $v_hasil_list->TCH->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($v_hasil_list->VarCost->Visible) { // VarCost ?>
		<td data-name="VarCost" <?php echo $v_hasil_list->VarCost->cellAttributes() ?>>
<span id="el<?php echo $v_hasil_list->RowCount ?>_v_hasil_VarCost">
<span<?php echo $v_hasil_list->VarCost->viewAttributes() ?>><?php echo $v_hasil_list->VarCost->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($v_hasil_list->VsLaden->Visible) { // VsLaden ?>
		<td data-name="VsLaden" <?php echo $v_hasil_list->VsLaden->cellAttributes() ?>>
<span id="el<?php echo $v_hasil_list->RowCount ?>_v_hasil_VsLaden">
<span<?php echo $v_hasil_list->VsLaden->viewAttributes() ?>><?php echo $v_hasil_list->VsLaden->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($v_hasil_list->VsBallast->Visible) { // VsBallast ?>
		<td data-name="VsBallast" <?php echo $v_hasil_list->VsBallast->cellAttributes() ?>>
<span id="el<?php echo $v_hasil_list->RowCount ?>_v_hasil_VsBallast">
<span<?php echo $v_hasil_list->VsBallast->viewAttributes() ?>><?php echo $v_hasil_list->VsBallast->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($v_hasil_list->ComDay->Visible) { // ComDay ?>
		<td data-name="ComDay" <?php echo $v_hasil_list->ComDay->cellAttributes() ?>>
<span id="el<?php echo $v_hasil_list->RowCount ?>_v_hasil_ComDay">
<span<?php echo $v_hasil_list->ComDay->viewAttributes() ?>><?php echo $v_hasil_list->ComDay->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($v_hasil_list->t_distribusi_id->Visible) { // t_distribusi_id ?>
		<td data-name="t_distribusi_id" <?php echo $v_hasil_list->t_distribusi_id->cellAttributes() ?>>
<span id="el<?php echo $v_hasil_list->RowCount ?>_v_hasil_t_distribusi_id">
<span<?php echo $v_hasil_list->t_distribusi_id->viewAttributes() ?>><?php echo $v_hasil_list->t_distribusi_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($v_hasil_list->source_id->Visible) { // source_id ?>
		<td data-name="source_id" <?php echo $v_hasil_list->source_id->cellAttributes() ?>>
<span id="el<?php echo $v_hasil_list->RowCount ?>_v_hasil_source_id">
<span<?php echo $v_hasil_list->source_id->viewAttributes() ?>><?php echo $v_hasil_list->source_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($v_hasil_list->destination_id->Visible) { // destination_id ?>
		<td data-name="destination_id" <?php echo $v_hasil_list->destination_id->cellAttributes() ?>>
<span id="el<?php echo $v_hasil_list->RowCount ?>_v_hasil_destination_id">
<span<?php echo $v_hasil_list->destination_id->viewAttributes() ?>><?php echo $v_hasil_list->destination_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($v_hasil_list->Jarak->Visible) { // Jarak ?>
		<td data-name="Jarak" <?php echo $v_hasil_list->Jarak->cellAttributes() ?>>
<span id="el<?php echo $v_hasil_list->RowCount ?>_v_hasil_Jarak">
<span<?php echo $v_hasil_list->Jarak->viewAttributes() ?>><?php echo $v_hasil_list->Jarak->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($v_hasil_list->Rate_O->Visible) { // Rate_O ?>
		<td data-name="Rate_O" <?php echo $v_hasil_list->Rate_O->cellAttributes() ?>>
<span id="el<?php echo $v_hasil_list->RowCount ?>_v_hasil_Rate_O">
<span<?php echo $v_hasil_list->Rate_O->viewAttributes() ?>><?php echo $v_hasil_list->Rate_O->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($v_hasil_list->Rate_D->Visible) { // Rate_D ?>
		<td data-name="Rate_D" <?php echo $v_hasil_list->Rate_D->cellAttributes() ?>>
<span id="el<?php echo $v_hasil_list->RowCount ?>_v_hasil_Rate_D">
<span<?php echo $v_hasil_list->Rate_D->viewAttributes() ?>><?php echo $v_hasil_list->Rate_D->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($v_hasil_list->Demand->Visible) { // Demand ?>
		<td data-name="Demand" <?php echo $v_hasil_list->Demand->cellAttributes() ?>>
<span id="el<?php echo $v_hasil_list->RowCount ?>_v_hasil_Demand">
<span<?php echo $v_hasil_list->Demand->viewAttributes() ?>><?php echo $v_hasil_list->Demand->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($v_hasil_list->sea_time->Visible) { // sea_time ?>
		<td data-name="sea_time" <?php echo $v_hasil_list->sea_time->cellAttributes() ?>>
<span id="el<?php echo $v_hasil_list->RowCount ?>_v_hasil_sea_time">
<span<?php echo $v_hasil_list->sea_time->viewAttributes() ?>><?php echo $v_hasil_list->sea_time->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($v_hasil_list->port_time->Visible) { // port_time ?>
		<td data-name="port_time" <?php echo $v_hasil_list->port_time->cellAttributes() ?>>
<span id="el<?php echo $v_hasil_list->RowCount ?>_v_hasil_port_time">
<span<?php echo $v_hasil_list->port_time->viewAttributes() ?>><?php echo $v_hasil_list->port_time->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($v_hasil_list->roundtrip_days->Visible) { // roundtrip_days ?>
		<td data-name="roundtrip_days" <?php echo $v_hasil_list->roundtrip_days->cellAttributes() ?>>
<span id="el<?php echo $v_hasil_list->RowCount ?>_v_hasil_roundtrip_days">
<span<?php echo $v_hasil_list->roundtrip_days->viewAttributes() ?>><?php echo $v_hasil_list->roundtrip_days->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($v_hasil_list->freqmaxbytrip->Visible) { // freqmaxbytrip ?>
		<td data-name="freqmaxbytrip" <?php echo $v_hasil_list->freqmaxbytrip->cellAttributes() ?>>
<span id="el<?php echo $v_hasil_list->RowCount ?>_v_hasil_freqmaxbytrip">
<span<?php echo $v_hasil_list->freqmaxbytrip->viewAttributes() ?>><?php echo $v_hasil_list->freqmaxbytrip->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($v_hasil_list->freqmaxbycargo->Visible) { // freqmaxbycargo ?>
		<td data-name="freqmaxbycargo" <?php echo $v_hasil_list->freqmaxbycargo->cellAttributes() ?>>
<span id="el<?php echo $v_hasil_list->RowCount ?>_v_hasil_freqmaxbycargo">
<span<?php echo $v_hasil_list->freqmaxbycargo->viewAttributes() ?>><?php echo $v_hasil_list->freqmaxbycargo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$v_hasil_list->ListOptions->render("body", "right", $v_hasil_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$v_hasil_list->isGridAdd())
		$v_hasil_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$v_hasil->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($v_hasil_list->Recordset)
	$v_hasil_list->Recordset->Close();
?>
<?php if (!$v_hasil_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$v_hasil_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $v_hasil_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $v_hasil_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($v_hasil_list->TotalRecords == 0 && !$v_hasil->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $v_hasil_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$v_hasil_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$v_hasil_list->isExport()) { ?>
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
$v_hasil_list->terminate();
?>