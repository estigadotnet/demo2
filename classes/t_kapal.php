<?php namespace PHPMaker2020\project1; ?>
<?php

/**
 * Table class for t_kapal
 */
class t_kapal extends DbTable
{
	protected $SqlFrom = "";
	protected $SqlSelect = "";
	protected $SqlSelectList = "";
	protected $SqlWhere = "";
	protected $SqlGroupBy = "";
	protected $SqlHaving = "";
	protected $SqlOrderBy = "";
	public $UseSessionForListSql = TRUE;

	// Column CSS classes
	public $LeftColumnClass = "col-sm-2 col-form-label ew-label";
	public $RightColumnClass = "col-sm-10";
	public $OffsetColumnClass = "col-sm-10 offset-sm-2";
	public $TableLeftColumnClass = "w-col-2";

	// Export
	public $ExportDoc;

	// Fields
	public $id;
	public $kapal_id;
	public $Payload;
	public $DischRate;
	public $TCH;
	public $VarCost;
	public $VsLaden;
	public $VsBallast;
	public $ComDay;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 't_kapal';
		$this->TableName = 't_kapal';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`t_kapal`";
		$this->Dbid = 'DB';
		$this->ExportAll = TRUE;
		$this->ExportPageBreakCount = 0; // Page break per every n record (PDF only)
		$this->ExportPageOrientation = "portrait"; // Page orientation (PDF only)
		$this->ExportPageSize = "a4"; // Page size (PDF only)
		$this->ExportExcelPageOrientation = ""; // Page orientation (PhpSpreadsheet only)
		$this->ExportExcelPageSize = ""; // Page size (PhpSpreadsheet only)
		$this->ExportWordPageOrientation = "portrait"; // Page orientation (PHPWord only)
		$this->ExportWordColumnWidth = NULL; // Cell width (PHPWord only)
		$this->DetailAdd = TRUE; // Allow detail add
		$this->DetailEdit = TRUE; // Allow detail edit
		$this->DetailView = TRUE; // Allow detail view
		$this->ShowMultipleDetails = FALSE; // Show multiple details
		$this->GridAddRowCount = 5;
		$this->AllowAddDeleteRow = TRUE; // Allow add/delete row
		$this->UserIDAllowSecurity = Config("DEFAULT_USER_ID_ALLOW_SECURITY"); // Default User ID allowed permissions
		$this->BasicSearch = new BasicSearch($this->TableVar);

		// id
		$this->id = new DbField('t_kapal', 't_kapal', 'x_id', 'id', '`id`', '`id`', 3, 11, -1, FALSE, '`id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->id->IsAutoIncrement = TRUE; // Autoincrement field
		$this->id->IsPrimaryKey = TRUE; // Primary key field
		$this->id->Sortable = TRUE; // Allow sort
		$this->id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['id'] = &$this->id;

		// kapal_id
		$this->kapal_id = new DbField('t_kapal', 't_kapal', 'x_kapal_id', 'kapal_id', '`kapal_id`', '`kapal_id`', 3, 11, -1, FALSE, '`kapal_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->kapal_id->IsForeignKey = TRUE; // Foreign key field
		$this->kapal_id->Nullable = FALSE; // NOT NULL field
		$this->kapal_id->Required = TRUE; // Required field
		$this->kapal_id->Sortable = TRUE; // Allow sort
		$this->kapal_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['kapal_id'] = &$this->kapal_id;

		// Payload
		$this->Payload = new DbField('t_kapal', 't_kapal', 'x_Payload', 'Payload', '`Payload`', '`Payload`', 4, 14, -1, FALSE, '`Payload`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Payload->Nullable = FALSE; // NOT NULL field
		$this->Payload->Required = TRUE; // Required field
		$this->Payload->Sortable = TRUE; // Allow sort
		$this->Payload->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['Payload'] = &$this->Payload;

		// DischRate
		$this->DischRate = new DbField('t_kapal', 't_kapal', 'x_DischRate', 'DischRate', '`DischRate`', '`DischRate`', 4, 14, -1, FALSE, '`DischRate`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->DischRate->Nullable = FALSE; // NOT NULL field
		$this->DischRate->Required = TRUE; // Required field
		$this->DischRate->Sortable = TRUE; // Allow sort
		$this->DischRate->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['DischRate'] = &$this->DischRate;

		// TCH
		$this->TCH = new DbField('t_kapal', 't_kapal', 'x_TCH', 'TCH', '`TCH`', '`TCH`', 4, 14, -1, FALSE, '`TCH`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->TCH->Nullable = FALSE; // NOT NULL field
		$this->TCH->Required = TRUE; // Required field
		$this->TCH->Sortable = TRUE; // Allow sort
		$this->TCH->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['TCH'] = &$this->TCH;

		// VarCost
		$this->VarCost = new DbField('t_kapal', 't_kapal', 'x_VarCost', 'VarCost', '`VarCost`', '`VarCost`', 4, 14, -1, FALSE, '`VarCost`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->VarCost->Nullable = FALSE; // NOT NULL field
		$this->VarCost->Required = TRUE; // Required field
		$this->VarCost->Sortable = TRUE; // Allow sort
		$this->VarCost->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['VarCost'] = &$this->VarCost;

		// VsLaden
		$this->VsLaden = new DbField('t_kapal', 't_kapal', 'x_VsLaden', 'VsLaden', '`VsLaden`', '`VsLaden`', 4, 14, -1, FALSE, '`VsLaden`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->VsLaden->Nullable = FALSE; // NOT NULL field
		$this->VsLaden->Required = TRUE; // Required field
		$this->VsLaden->Sortable = TRUE; // Allow sort
		$this->VsLaden->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['VsLaden'] = &$this->VsLaden;

		// VsBallast
		$this->VsBallast = new DbField('t_kapal', 't_kapal', 'x_VsBallast', 'VsBallast', '`VsBallast`', '`VsBallast`', 4, 14, -1, FALSE, '`VsBallast`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->VsBallast->Nullable = FALSE; // NOT NULL field
		$this->VsBallast->Required = TRUE; // Required field
		$this->VsBallast->Sortable = TRUE; // Allow sort
		$this->VsBallast->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['VsBallast'] = &$this->VsBallast;

		// ComDay
		$this->ComDay = new DbField('t_kapal', 't_kapal', 'x_ComDay', 'ComDay', '`ComDay`', '`ComDay`', 4, 14, -1, FALSE, '`ComDay`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ComDay->Nullable = FALSE; // NOT NULL field
		$this->ComDay->Required = TRUE; // Required field
		$this->ComDay->Sortable = TRUE; // Allow sort
		$this->ComDay->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['ComDay'] = &$this->ComDay;
	}

	// Field Visibility
	public function getFieldVisibility($fldParm)
	{
		global $Security;
		return $this->$fldParm->Visible; // Returns original value
	}

	// Set left column class (must be predefined col-*-* classes of Bootstrap grid system)
	function setLeftColumnClass($class)
	{
		if (preg_match('/^col\-(\w+)\-(\d+)$/', $class, $match)) {
			$this->LeftColumnClass = $class . " col-form-label ew-label";
			$this->RightColumnClass = "col-" . $match[1] . "-" . strval(12 - (int)$match[2]);
			$this->OffsetColumnClass = $this->RightColumnClass . " " . str_replace("col-", "offset-", $class);
			$this->TableLeftColumnClass = preg_replace('/^col-\w+-(\d+)$/', "w-col-$1", $class); // Change to w-col-*
		}
	}

	// Single column sort
	public function updateSort(&$fld)
	{
		if ($this->CurrentOrder == $fld->Name) {
			$sortField = $fld->Expression;
			$lastSort = $fld->getSort();
			if ($this->CurrentOrderType == "ASC" || $this->CurrentOrderType == "DESC") {
				$thisSort = $this->CurrentOrderType;
			} else {
				$thisSort = ($lastSort == "ASC") ? "DESC" : "ASC";
			}
			$fld->setSort($thisSort);
			$this->setSessionOrderBy($sortField . " " . $thisSort); // Save to Session
		} else {
			$fld->setSort("");
		}
	}

	// Current master table name
	public function getCurrentMasterTable()
	{
		return @$_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_MASTER_TABLE")];
	}
	public function setCurrentMasterTable($v)
	{
		$_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_MASTER_TABLE")] = $v;
	}

	// Session master WHERE clause
	public function getMasterFilter()
	{

		// Master filter
		$masterFilter = "";
		if ($this->getCurrentMasterTable() == "t_kapal0") {
			if ($this->kapal_id->getSessionValue() != "")
				$masterFilter .= "`id`=" . QuotedValue($this->kapal_id->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
		}
		return $masterFilter;
	}

	// Session detail WHERE clause
	public function getDetailFilter()
	{

		// Detail filter
		$detailFilter = "";
		if ($this->getCurrentMasterTable() == "t_kapal0") {
			if ($this->kapal_id->getSessionValue() != "")
				$detailFilter .= "`kapal_id`=" . QuotedValue($this->kapal_id->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
		}
		return $detailFilter;
	}

	// Master filter
	public function sqlMasterFilter_t_kapal0()
	{
		return "`id`=@id@";
	}

	// Detail filter
	public function sqlDetailFilter_t_kapal0()
	{
		return "`kapal_id`=@kapal_id@";
	}

	// Table level SQL
	public function getSqlFrom() // From
	{
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`t_kapal`";
	}
	public function sqlFrom() // For backward compatibility
	{
		return $this->getSqlFrom();
	}
	public function setSqlFrom($v)
	{
		$this->SqlFrom = $v;
	}
	public function getSqlSelect() // Select
	{
		return ($this->SqlSelect != "") ? $this->SqlSelect : "SELECT * FROM " . $this->getSqlFrom();
	}
	public function sqlSelect() // For backward compatibility
	{
		return $this->getSqlSelect();
	}
	public function setSqlSelect($v)
	{
		$this->SqlSelect = $v;
	}
	public function getSqlWhere() // Where
	{
		$where = ($this->SqlWhere != "") ? $this->SqlWhere : "";
		$this->TableFilter = "";
		AddFilter($where, $this->TableFilter);
		return $where;
	}
	public function sqlWhere() // For backward compatibility
	{
		return $this->getSqlWhere();
	}
	public function setSqlWhere($v)
	{
		$this->SqlWhere = $v;
	}
	public function getSqlGroupBy() // Group By
	{
		return ($this->SqlGroupBy != "") ? $this->SqlGroupBy : "";
	}
	public function sqlGroupBy() // For backward compatibility
	{
		return $this->getSqlGroupBy();
	}
	public function setSqlGroupBy($v)
	{
		$this->SqlGroupBy = $v;
	}
	public function getSqlHaving() // Having
	{
		return ($this->SqlHaving != "") ? $this->SqlHaving : "";
	}
	public function sqlHaving() // For backward compatibility
	{
		return $this->getSqlHaving();
	}
	public function setSqlHaving($v)
	{
		$this->SqlHaving = $v;
	}
	public function getSqlOrderBy() // Order By
	{
		return ($this->SqlOrderBy != "") ? $this->SqlOrderBy : "";
	}
	public function sqlOrderBy() // For backward compatibility
	{
		return $this->getSqlOrderBy();
	}
	public function setSqlOrderBy($v)
	{
		$this->SqlOrderBy = $v;
	}

	// Apply User ID filters
	public function applyUserIDFilters($filter, $id = "")
	{
		return $filter;
	}

	// Check if User ID security allows view all
	public function userIDAllow($id = "")
	{
		$allow = $this->UserIDAllowSecurity;
		switch ($id) {
			case "add":
			case "copy":
			case "gridadd":
			case "register":
			case "addopt":
				return (($allow & 1) == 1);
			case "edit":
			case "gridedit":
			case "update":
			case "changepwd":
			case "forgotpwd":
				return (($allow & 4) == 4);
			case "delete":
				return (($allow & 2) == 2);
			case "view":
				return (($allow & 32) == 32);
			case "search":
				return (($allow & 64) == 64);
			case "lookup":
				return (($allow & 256) == 256);
			default:
				return (($allow & 8) == 8);
		}
	}

	// Get recordset
	public function getRecordset($sql, $rowcnt = -1, $offset = -1)
	{
		$conn = $this->getConnection();
		$conn->raiseErrorFn = Config("ERROR_FUNC");
		$rs = $conn->selectLimit($sql, $rowcnt, $offset);
		$conn->raiseErrorFn = "";
		return $rs;
	}

	// Get record count
	public function getRecordCount($sql, $c = NULL)
	{
		$cnt = -1;
		$rs = NULL;
		$sql = preg_replace('/\/\*BeginOrderBy\*\/[\s\S]+\/\*EndOrderBy\*\//', "", $sql); // Remove ORDER BY clause (MSSQL)
		$pattern = '/^SELECT\s([\s\S]+)\sFROM\s/i';

		// Skip Custom View / SubQuery / SELECT DISTINCT / ORDER BY
		if (($this->TableType == 'TABLE' || $this->TableType == 'VIEW' || $this->TableType == 'LINKTABLE') &&
			preg_match($pattern, $sql) && !preg_match('/\(\s*(SELECT[^)]+)\)/i', $sql) &&
			!preg_match('/^\s*select\s+distinct\s+/i', $sql) && !preg_match('/\s+order\s+by\s+/i', $sql)) {
			$sqlwrk = "SELECT COUNT(*) FROM " . preg_replace($pattern, "", $sql);
		} else {
			$sqlwrk = "SELECT COUNT(*) FROM (" . $sql . ") COUNT_TABLE";
		}
		$conn = $c ?: $this->getConnection();
		if ($rs = $conn->execute($sqlwrk)) {
			if (!$rs->EOF && $rs->FieldCount() > 0) {
				$cnt = $rs->fields[0];
				$rs->close();
			}
			return (int)$cnt;
		}

		// Unable to get count, get record count directly
		if ($rs = $conn->execute($sql)) {
			$cnt = $rs->RecordCount();
			$rs->close();
			return (int)$cnt;
		}
		return $cnt;
	}

	// Get SQL
	public function getSql($where, $orderBy = "")
	{
		return BuildSelectSql($this->getSqlSelect(), $this->getSqlWhere(),
			$this->getSqlGroupBy(), $this->getSqlHaving(), $this->getSqlOrderBy(),
			$where, $orderBy);
	}

	// Table SQL
	public function getCurrentSql()
	{
		$filter = $this->CurrentFilter;
		$filter = $this->applyUserIDFilters($filter);
		$sort = $this->getSessionOrderBy();
		return $this->getSql($filter, $sort);
	}

	// Table SQL with List page filter
	public function getListSql()
	{
		$filter = $this->UseSessionForListSql ? $this->getSessionWhere() : "";
		AddFilter($filter, $this->CurrentFilter);
		$filter = $this->applyUserIDFilters($filter);
		$this->Recordset_Selecting($filter);
		$select = $this->getSqlSelect();
		$sort = $this->UseSessionForListSql ? $this->getSessionOrderBy() : "";
		return BuildSelectSql($select, $this->getSqlWhere(), $this->getSqlGroupBy(),
			$this->getSqlHaving(), $this->getSqlOrderBy(), $filter, $sort);
	}

	// Get ORDER BY clause
	public function getOrderBy()
	{
		$sort = $this->getSessionOrderBy();
		return BuildSelectSql("", "", "", "", $this->getSqlOrderBy(), "", $sort);
	}

	// Get record count based on filter (for detail record count in master table pages)
	public function loadRecordCount($filter)
	{
		$origFilter = $this->CurrentFilter;
		$this->CurrentFilter = $filter;
		$this->Recordset_Selecting($this->CurrentFilter);
		$select = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlSelect() : "SELECT * FROM " . $this->getSqlFrom();
		$groupBy = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlGroupBy() : "";
		$having = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlHaving() : "";
		$sql = BuildSelectSql($select, $this->getSqlWhere(), $groupBy, $having, "", $this->CurrentFilter, "");
		$cnt = $this->getRecordCount($sql);
		$this->CurrentFilter = $origFilter;
		return $cnt;
	}

	// Get record count (for current List page)
	public function listRecordCount()
	{
		$filter = $this->getSessionWhere();
		AddFilter($filter, $this->CurrentFilter);
		$filter = $this->applyUserIDFilters($filter);
		$this->Recordset_Selecting($filter);
		$select = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlSelect() : "SELECT * FROM " . $this->getSqlFrom();
		$groupBy = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlGroupBy() : "";
		$having = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlHaving() : "";
		$sql = BuildSelectSql($select, $this->getSqlWhere(), $groupBy, $having, "", $filter, "");
		$cnt = $this->getRecordCount($sql);
		return $cnt;
	}

	// INSERT statement
	protected function insertSql(&$rs)
	{
		$names = "";
		$values = "";
		foreach ($rs as $name => $value) {
			if (!isset($this->fields[$name]) || $this->fields[$name]->IsCustom)
				continue;
			$names .= $this->fields[$name]->Expression . ",";
			$values .= QuotedValue($value, $this->fields[$name]->DataType, $this->Dbid) . ",";
		}
		$names = preg_replace('/,+$/', "", $names);
		$values = preg_replace('/,+$/', "", $values);
		return "INSERT INTO " . $this->UpdateTable . " (" . $names . ") VALUES (" . $values . ")";
	}

	// Insert
	public function insert(&$rs)
	{
		$conn = $this->getConnection();
		$success = $conn->execute($this->insertSql($rs));
		if ($success) {

			// Get insert id if necessary
			$this->id->setDbValue($conn->insert_ID());
			$rs['id'] = $this->id->DbValue;
		}
		return $success;
	}

	// UPDATE statement
	protected function updateSql(&$rs, $where = "", $curfilter = TRUE)
	{
		$sql = "UPDATE " . $this->UpdateTable . " SET ";
		foreach ($rs as $name => $value) {
			if (!isset($this->fields[$name]) || $this->fields[$name]->IsCustom || $this->fields[$name]->IsAutoIncrement)
				continue;
			$sql .= $this->fields[$name]->Expression . "=";
			$sql .= QuotedValue($value, $this->fields[$name]->DataType, $this->Dbid) . ",";
		}
		$sql = preg_replace('/,+$/', "", $sql);
		$filter = ($curfilter) ? $this->CurrentFilter : "";
		if (is_array($where))
			$where = $this->arrayToFilter($where);
		AddFilter($filter, $where);
		if ($filter != "")
			$sql .= " WHERE " . $filter;
		return $sql;
	}

	// Update
	public function update(&$rs, $where = "", $rsold = NULL, $curfilter = TRUE)
	{
		$conn = $this->getConnection();
		$success = $conn->execute($this->updateSql($rs, $where, $curfilter));
		return $success;
	}

	// DELETE statement
	protected function deleteSql(&$rs, $where = "", $curfilter = TRUE)
	{
		$sql = "DELETE FROM " . $this->UpdateTable . " WHERE ";
		if (is_array($where))
			$where = $this->arrayToFilter($where);
		if ($rs) {
			if (array_key_exists('id', $rs))
				AddFilter($where, QuotedName('id', $this->Dbid) . '=' . QuotedValue($rs['id'], $this->id->DataType, $this->Dbid));
		}
		$filter = ($curfilter) ? $this->CurrentFilter : "";
		AddFilter($filter, $where);
		if ($filter != "")
			$sql .= $filter;
		else
			$sql .= "0=1"; // Avoid delete
		return $sql;
	}

	// Delete
	public function delete(&$rs, $where = "", $curfilter = FALSE)
	{
		$success = TRUE;
		$conn = $this->getConnection();
		if ($success)
			$success = $conn->execute($this->deleteSql($rs, $where, $curfilter));
		return $success;
	}

	// Load DbValue from recordset or array
	protected function loadDbValues(&$rs)
	{
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->id->DbValue = $row['id'];
		$this->kapal_id->DbValue = $row['kapal_id'];
		$this->Payload->DbValue = $row['Payload'];
		$this->DischRate->DbValue = $row['DischRate'];
		$this->TCH->DbValue = $row['TCH'];
		$this->VarCost->DbValue = $row['VarCost'];
		$this->VsLaden->DbValue = $row['VsLaden'];
		$this->VsBallast->DbValue = $row['VsBallast'];
		$this->ComDay->DbValue = $row['ComDay'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "`id` = @id@";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
		if (is_array($row))
			$val = array_key_exists('id', $row) ? $row['id'] : NULL;
		else
			$val = $this->id->OldValue !== NULL ? $this->id->OldValue : $this->id->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@id@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
		return $keyFilter;
	}

	// Return page URL
	public function getReturnUrl()
	{
		$name = PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_RETURN_URL");

		// Get referer URL automatically
		if (ServerVar("HTTP_REFERER") != "" && ReferPageName() != CurrentPageName() && ReferPageName() != "login.php") // Referer not same page or login page
			$_SESSION[$name] = ServerVar("HTTP_REFERER"); // Save to Session
		if (@$_SESSION[$name] != "") {
			return $_SESSION[$name];
		} else {
			return "t_kapallist.php";
		}
	}
	public function setReturnUrl($v)
	{
		$_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_RETURN_URL")] = $v;
	}

	// Get modal caption
	public function getModalCaption($pageName)
	{
		global $Language;
		if ($pageName == "t_kapalview.php")
			return $Language->phrase("View");
		elseif ($pageName == "t_kapaledit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "t_kapaladd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "t_kapallist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("t_kapalview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("t_kapalview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "t_kapaladd.php?" . $this->getUrlParm($parm);
		else
			$url = "t_kapaladd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("t_kapaledit.php", $this->getUrlParm($parm));
		return $this->addMasterUrl($url);
	}

	// Inline edit URL
	public function getInlineEditUrl()
	{
		$url = $this->keyUrl(CurrentPageName(), $this->getUrlParm("action=edit"));
		return $this->addMasterUrl($url);
	}

	// Copy URL
	public function getCopyUrl($parm = "")
	{
		$url = $this->keyUrl("t_kapaladd.php", $this->getUrlParm($parm));
		return $this->addMasterUrl($url);
	}

	// Inline copy URL
	public function getInlineCopyUrl()
	{
		$url = $this->keyUrl(CurrentPageName(), $this->getUrlParm("action=copy"));
		return $this->addMasterUrl($url);
	}

	// Delete URL
	public function getDeleteUrl()
	{
		return $this->keyUrl("t_kapaldelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		if ($this->getCurrentMasterTable() == "t_kapal0" && !ContainsString($url, Config("TABLE_SHOW_MASTER") . "=")) {
			$url .= (ContainsString($url, "?") ? "&" : "?") . Config("TABLE_SHOW_MASTER") . "=" . $this->getCurrentMasterTable();
			$url .= "&fk_id=" . urlencode($this->kapal_id->CurrentValue);
		}
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "id:" . JsonEncode($this->id->CurrentValue, "number");
		$json = "{" . $json . "}";
		if ($htmlEncode)
			$json = HtmlEncode($json);
		return $json;
	}

	// Add key value to URL
	public function keyUrl($url, $parm = "")
	{
		$url = $url . "?";
		if ($parm != "")
			$url .= $parm . "&";
		if ($this->id->CurrentValue != NULL) {
			$url .= "id=" . urlencode($this->id->CurrentValue);
		} else {
			return "javascript:ew.alert(ew.language.phrase('InvalidRecord'));";
		}
		return $url;
	}

	// Sort URL
	public function sortUrl(&$fld)
	{
		if ($this->CurrentAction || $this->isExport() ||
			in_array($fld->Type, [128, 204, 205])) { // Unsortable data type
				return "";
		} elseif ($fld->Sortable) {
			$urlParm = $this->getUrlParm("order=" . urlencode($fld->Name) . "&amp;ordertype=" . $fld->reverseSort());
			return $this->addMasterUrl(CurrentPageName() . "?" . $urlParm);
		} else {
			return "";
		}
	}

	// Get record keys from Post/Get/Session
	public function getRecordKeys()
	{
		$arKeys = [];
		$arKey = [];
		if (Param("key_m") !== NULL) {
			$arKeys = Param("key_m");
			$cnt = count($arKeys);
		} else {
			if (Param("id") !== NULL)
				$arKeys[] = Param("id");
			elseif (IsApi() && Key(0) !== NULL)
				$arKeys[] = Key(0);
			elseif (IsApi() && Route(2) !== NULL)
				$arKeys[] = Route(2);
			else
				$arKeys = NULL; // Do not setup

			//return $arKeys; // Do not return yet, so the values will also be checked by the following code
		}

		// Check keys
		$ar = [];
		if (is_array($arKeys)) {
			foreach ($arKeys as $key) {
				if (!is_numeric($key))
					continue;
				$ar[] = $key;
			}
		}
		return $ar;
	}

	// Get filter from record keys
	public function getFilterFromRecordKeys($setCurrent = TRUE)
	{
		$arKeys = $this->getRecordKeys();
		$keyFilter = "";
		foreach ($arKeys as $key) {
			if ($keyFilter != "") $keyFilter .= " OR ";
			if ($setCurrent)
				$this->id->CurrentValue = $key;
			else
				$this->id->OldValue = $key;
			$keyFilter .= "(" . $this->getRecordFilter() . ")";
		}
		return $keyFilter;
	}

	// Load rows based on filter
	public function &loadRs($filter)
	{

		// Set up filter (WHERE Clause)
		$sql = $this->getSql($filter);
		$conn = $this->getConnection();
		$rs = $conn->execute($sql);
		return $rs;
	}

	// Load row values from recordset
	public function loadListRowValues(&$rs)
	{
		$this->id->setDbValue($rs->fields('id'));
		$this->kapal_id->setDbValue($rs->fields('kapal_id'));
		$this->Payload->setDbValue($rs->fields('Payload'));
		$this->DischRate->setDbValue($rs->fields('DischRate'));
		$this->TCH->setDbValue($rs->fields('TCH'));
		$this->VarCost->setDbValue($rs->fields('VarCost'));
		$this->VsLaden->setDbValue($rs->fields('VsLaden'));
		$this->VsBallast->setDbValue($rs->fields('VsBallast'));
		$this->ComDay->setDbValue($rs->fields('ComDay'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// id
		// kapal_id
		// Payload
		// DischRate
		// TCH
		// VarCost
		// VsLaden
		// VsBallast
		// ComDay
		// id

		$this->id->ViewValue = $this->id->CurrentValue;
		$this->id->ViewCustomAttributes = "";

		// kapal_id
		$this->kapal_id->ViewValue = $this->kapal_id->CurrentValue;
		$this->kapal_id->ViewValue = FormatNumber($this->kapal_id->ViewValue, 0, -2, -2, -2);
		$this->kapal_id->ViewCustomAttributes = "";

		// Payload
		$this->Payload->ViewValue = $this->Payload->CurrentValue;
		$this->Payload->ViewValue = FormatNumber($this->Payload->ViewValue, 2, -2, -2, -2);
		$this->Payload->ViewCustomAttributes = "";

		// DischRate
		$this->DischRate->ViewValue = $this->DischRate->CurrentValue;
		$this->DischRate->ViewValue = FormatNumber($this->DischRate->ViewValue, 2, -2, -2, -2);
		$this->DischRate->ViewCustomAttributes = "";

		// TCH
		$this->TCH->ViewValue = $this->TCH->CurrentValue;
		$this->TCH->ViewValue = FormatNumber($this->TCH->ViewValue, 2, -2, -2, -2);
		$this->TCH->ViewCustomAttributes = "";

		// VarCost
		$this->VarCost->ViewValue = $this->VarCost->CurrentValue;
		$this->VarCost->ViewValue = FormatNumber($this->VarCost->ViewValue, 2, -2, -2, -2);
		$this->VarCost->ViewCustomAttributes = "";

		// VsLaden
		$this->VsLaden->ViewValue = $this->VsLaden->CurrentValue;
		$this->VsLaden->ViewValue = FormatNumber($this->VsLaden->ViewValue, 2, -2, -2, -2);
		$this->VsLaden->ViewCustomAttributes = "";

		// VsBallast
		$this->VsBallast->ViewValue = $this->VsBallast->CurrentValue;
		$this->VsBallast->ViewValue = FormatNumber($this->VsBallast->ViewValue, 2, -2, -2, -2);
		$this->VsBallast->ViewCustomAttributes = "";

		// ComDay
		$this->ComDay->ViewValue = $this->ComDay->CurrentValue;
		$this->ComDay->ViewValue = FormatNumber($this->ComDay->ViewValue, 2, -2, -2, -2);
		$this->ComDay->ViewCustomAttributes = "";

		// id
		$this->id->LinkCustomAttributes = "";
		$this->id->HrefValue = "";
		$this->id->TooltipValue = "";

		// kapal_id
		$this->kapal_id->LinkCustomAttributes = "";
		$this->kapal_id->HrefValue = "";
		$this->kapal_id->TooltipValue = "";

		// Payload
		$this->Payload->LinkCustomAttributes = "";
		$this->Payload->HrefValue = "";
		$this->Payload->TooltipValue = "";

		// DischRate
		$this->DischRate->LinkCustomAttributes = "";
		$this->DischRate->HrefValue = "";
		$this->DischRate->TooltipValue = "";

		// TCH
		$this->TCH->LinkCustomAttributes = "";
		$this->TCH->HrefValue = "";
		$this->TCH->TooltipValue = "";

		// VarCost
		$this->VarCost->LinkCustomAttributes = "";
		$this->VarCost->HrefValue = "";
		$this->VarCost->TooltipValue = "";

		// VsLaden
		$this->VsLaden->LinkCustomAttributes = "";
		$this->VsLaden->HrefValue = "";
		$this->VsLaden->TooltipValue = "";

		// VsBallast
		$this->VsBallast->LinkCustomAttributes = "";
		$this->VsBallast->HrefValue = "";
		$this->VsBallast->TooltipValue = "";

		// ComDay
		$this->ComDay->LinkCustomAttributes = "";
		$this->ComDay->HrefValue = "";
		$this->ComDay->TooltipValue = "";

		// Call Row Rendered event
		$this->Row_Rendered();

		// Save data for Custom Template
		$this->Rows[] = $this->customTemplateFieldValues();
	}

	// Render edit row values
	public function renderEditRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// id
		$this->id->EditAttrs["class"] = "form-control";
		$this->id->EditCustomAttributes = "";
		$this->id->EditValue = $this->id->CurrentValue;
		$this->id->ViewCustomAttributes = "";

		// kapal_id
		$this->kapal_id->EditAttrs["class"] = "form-control";
		$this->kapal_id->EditCustomAttributes = "";
		if ($this->kapal_id->getSessionValue() != "") {
			$this->kapal_id->CurrentValue = $this->kapal_id->getSessionValue();
			$this->kapal_id->ViewValue = $this->kapal_id->CurrentValue;
			$this->kapal_id->ViewValue = FormatNumber($this->kapal_id->ViewValue, 0, -2, -2, -2);
			$this->kapal_id->ViewCustomAttributes = "";
		} else {
			$this->kapal_id->EditValue = $this->kapal_id->CurrentValue;
			$this->kapal_id->PlaceHolder = RemoveHtml($this->kapal_id->caption());
		}

		// Payload
		$this->Payload->EditAttrs["class"] = "form-control";
		$this->Payload->EditCustomAttributes = "";
		$this->Payload->EditValue = $this->Payload->CurrentValue;
		$this->Payload->PlaceHolder = RemoveHtml($this->Payload->caption());
		if (strval($this->Payload->EditValue) != "" && is_numeric($this->Payload->EditValue))
			$this->Payload->EditValue = FormatNumber($this->Payload->EditValue, -2, -2, -2, -2);
		

		// DischRate
		$this->DischRate->EditAttrs["class"] = "form-control";
		$this->DischRate->EditCustomAttributes = "";
		$this->DischRate->EditValue = $this->DischRate->CurrentValue;
		$this->DischRate->PlaceHolder = RemoveHtml($this->DischRate->caption());
		if (strval($this->DischRate->EditValue) != "" && is_numeric($this->DischRate->EditValue))
			$this->DischRate->EditValue = FormatNumber($this->DischRate->EditValue, -2, -2, -2, -2);
		

		// TCH
		$this->TCH->EditAttrs["class"] = "form-control";
		$this->TCH->EditCustomAttributes = "";
		$this->TCH->EditValue = $this->TCH->CurrentValue;
		$this->TCH->PlaceHolder = RemoveHtml($this->TCH->caption());
		if (strval($this->TCH->EditValue) != "" && is_numeric($this->TCH->EditValue))
			$this->TCH->EditValue = FormatNumber($this->TCH->EditValue, -2, -2, -2, -2);
		

		// VarCost
		$this->VarCost->EditAttrs["class"] = "form-control";
		$this->VarCost->EditCustomAttributes = "";
		$this->VarCost->EditValue = $this->VarCost->CurrentValue;
		$this->VarCost->PlaceHolder = RemoveHtml($this->VarCost->caption());
		if (strval($this->VarCost->EditValue) != "" && is_numeric($this->VarCost->EditValue))
			$this->VarCost->EditValue = FormatNumber($this->VarCost->EditValue, -2, -2, -2, -2);
		

		// VsLaden
		$this->VsLaden->EditAttrs["class"] = "form-control";
		$this->VsLaden->EditCustomAttributes = "";
		$this->VsLaden->EditValue = $this->VsLaden->CurrentValue;
		$this->VsLaden->PlaceHolder = RemoveHtml($this->VsLaden->caption());
		if (strval($this->VsLaden->EditValue) != "" && is_numeric($this->VsLaden->EditValue))
			$this->VsLaden->EditValue = FormatNumber($this->VsLaden->EditValue, -2, -2, -2, -2);
		

		// VsBallast
		$this->VsBallast->EditAttrs["class"] = "form-control";
		$this->VsBallast->EditCustomAttributes = "";
		$this->VsBallast->EditValue = $this->VsBallast->CurrentValue;
		$this->VsBallast->PlaceHolder = RemoveHtml($this->VsBallast->caption());
		if (strval($this->VsBallast->EditValue) != "" && is_numeric($this->VsBallast->EditValue))
			$this->VsBallast->EditValue = FormatNumber($this->VsBallast->EditValue, -2, -2, -2, -2);
		

		// ComDay
		$this->ComDay->EditAttrs["class"] = "form-control";
		$this->ComDay->EditCustomAttributes = "";
		$this->ComDay->EditValue = $this->ComDay->CurrentValue;
		$this->ComDay->PlaceHolder = RemoveHtml($this->ComDay->caption());
		if (strval($this->ComDay->EditValue) != "" && is_numeric($this->ComDay->EditValue))
			$this->ComDay->EditValue = FormatNumber($this->ComDay->EditValue, -2, -2, -2, -2);
		

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Aggregate list row values
	public function aggregateListRowValues()
	{
	}

	// Aggregate list row (for rendering)
	public function aggregateListRow()
	{

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Export data in HTML/CSV/Word/Excel/Email/PDF format
	public function exportDocument($doc, $recordset, $startRec = 1, $stopRec = 1, $exportPageType = "")
	{
		if (!$recordset || !$doc)
			return;
		if (!$doc->ExportCustom) {

			// Write header
			$doc->exportTableHeader();
			if ($doc->Horizontal) { // Horizontal format, write header
				$doc->beginExportRow();
				if ($exportPageType == "view") {
					$doc->exportCaption($this->Payload);
					$doc->exportCaption($this->DischRate);
					$doc->exportCaption($this->TCH);
					$doc->exportCaption($this->VarCost);
					$doc->exportCaption($this->VsLaden);
					$doc->exportCaption($this->VsBallast);
					$doc->exportCaption($this->ComDay);
				} else {
					$doc->exportCaption($this->id);
					$doc->exportCaption($this->kapal_id);
					$doc->exportCaption($this->Payload);
					$doc->exportCaption($this->DischRate);
					$doc->exportCaption($this->TCH);
					$doc->exportCaption($this->VarCost);
					$doc->exportCaption($this->VsLaden);
					$doc->exportCaption($this->VsBallast);
					$doc->exportCaption($this->ComDay);
				}
				$doc->endExportRow();
			}
		}

		// Move to first record
		$recCnt = $startRec - 1;
		if (!$recordset->EOF) {
			$recordset->moveFirst();
			if ($startRec > 1)
				$recordset->move($startRec - 1);
		}
		while (!$recordset->EOF && $recCnt < $stopRec) {
			$recCnt++;
			if ($recCnt >= $startRec) {
				$rowCnt = $recCnt - $startRec + 1;

				// Page break
				if ($this->ExportPageBreakCount > 0) {
					if ($rowCnt > 1 && ($rowCnt - 1) % $this->ExportPageBreakCount == 0)
						$doc->exportPageBreak();
				}
				$this->loadListRowValues($recordset);

				// Render row
				$this->RowType = ROWTYPE_VIEW; // Render view
				$this->resetAttributes();
				$this->renderListRow();
				if (!$doc->ExportCustom) {
					$doc->beginExportRow($rowCnt); // Allow CSS styles if enabled
					if ($exportPageType == "view") {
						$doc->exportField($this->Payload);
						$doc->exportField($this->DischRate);
						$doc->exportField($this->TCH);
						$doc->exportField($this->VarCost);
						$doc->exportField($this->VsLaden);
						$doc->exportField($this->VsBallast);
						$doc->exportField($this->ComDay);
					} else {
						$doc->exportField($this->id);
						$doc->exportField($this->kapal_id);
						$doc->exportField($this->Payload);
						$doc->exportField($this->DischRate);
						$doc->exportField($this->TCH);
						$doc->exportField($this->VarCost);
						$doc->exportField($this->VsLaden);
						$doc->exportField($this->VsBallast);
						$doc->exportField($this->ComDay);
					}
					$doc->endExportRow($rowCnt);
				}
			}

			// Call Row Export server event
			if ($doc->ExportCustom)
				$this->Row_Export($recordset->fields);
			$recordset->moveNext();
		}
		if (!$doc->ExportCustom) {
			$doc->exportTableFooter();
		}
	}

	// Get file data
	public function getFileData($fldparm, $key, $resize, $width = 0, $height = 0)
	{

		// No binary fields
		return FALSE;
	}

	// Table level events
	// Recordset Selecting event
	function Recordset_Selecting(&$filter) {

		// Enter your code here
	}

	// Recordset Selected event
	function Recordset_Selected(&$rs) {

		//echo "Recordset Selected";
	}

	// Recordset Search Validated event
	function Recordset_SearchValidated() {

		// Example:
		//$this->MyField1->AdvancedSearch->SearchValue = "your search criteria"; // Search value

	}

	// Recordset Searching event
	function Recordset_Searching(&$filter) {

		// Enter your code here
	}

	// Row_Selecting event
	function Row_Selecting(&$filter) {

		// Enter your code here
	}

	// Row Selected event
	function Row_Selected(&$rs) {

		//echo "Row Selected";
	}

	// Row Inserting event
	function Row_Inserting($rsold, &$rsnew) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// Row Inserted event
	function Row_Inserted($rsold, &$rsnew) {

		//echo "Row Inserted"
	}

	// Row Updating event
	function Row_Updating($rsold, &$rsnew) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// Row Updated event
	function Row_Updated($rsold, &$rsnew) {

		//echo "Row Updated";
	}

	// Row Update Conflict event
	function Row_UpdateConflict($rsold, &$rsnew) {

		// Enter your code here
		// To ignore conflict, set return value to FALSE

		return TRUE;
	}

	// Grid Inserting event
	function Grid_Inserting() {

		// Enter your code here
		// To reject grid insert, set return value to FALSE

		return TRUE;
	}

	// Grid Inserted event
	function Grid_Inserted($rsnew) {

		//echo "Grid Inserted";
	}

	// Grid Updating event
	function Grid_Updating($rsold) {

		// Enter your code here
		// To reject grid update, set return value to FALSE

		return TRUE;
	}

	// Grid Updated event
	function Grid_Updated($rsold, $rsnew) {

		//echo "Grid Updated";
	}

	// Row Deleting event
	function Row_Deleting(&$rs) {

		// Enter your code here
		// To cancel, set return value to False

		return TRUE;
	}

	// Row Deleted event
	function Row_Deleted(&$rs) {

		//echo "Row Deleted";
	}

	// Email Sending event
	function Email_Sending($email, &$args) {

		//var_dump($email); var_dump($args); exit();
		return TRUE;
	}

	// Lookup Selecting event
	function Lookup_Selecting($fld, &$filter) {

		//var_dump($fld->Name, $fld->Lookup, $filter); // Uncomment to view the filter
		// Enter your code here

	}

	// Row Rendering event
	function Row_Rendering() {

		// Enter your code here
	}

	// Row Rendered event
	function Row_Rendered() {

		// To view properties of field class, use:
		//var_dump($this-><FieldName>);

	}

	// User ID Filtering event
	function UserID_Filtering(&$filter) {

		// Enter your code here
	}
}
?>