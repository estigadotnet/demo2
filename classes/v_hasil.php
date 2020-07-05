<?php namespace PHPMaker2020\project1; ?>
<?php

/**
 * Table class for v_hasil
 */
class v_hasil extends DbTable
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
	public $kapal_id;
	public $distribusi_id;
	public $kapal0_id;
	public $kapal0_nama;
	public $kapaldetail_id;
	public $Payload;
	public $DischRate;
	public $TCH;
	public $VarCost;
	public $VsLaden;
	public $VsBallast;
	public $ComDay;
	public $t_distribusi_id;
	public $source_id;
	public $destination_id;
	public $Jarak;
	public $Rate_O;
	public $Rate_D;
	public $Demand;
	public $sea_time;
	public $port_time;
	public $roundtrip_days;
	public $freqmaxbytrip;
	public $freqmaxbycargo;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'v_hasil';
		$this->TableName = 'v_hasil';
		$this->TableType = 'VIEW';

		// Update Table
		$this->UpdateTable = "`v_hasil`";
		$this->Dbid = 'DB';
		$this->ExportAll = TRUE;
		$this->ExportPageBreakCount = 0; // Page break per every n record (PDF only)
		$this->ExportPageOrientation = "portrait"; // Page orientation (PDF only)
		$this->ExportPageSize = "a4"; // Page size (PDF only)
		$this->ExportExcelPageOrientation = ""; // Page orientation (PhpSpreadsheet only)
		$this->ExportExcelPageSize = ""; // Page size (PhpSpreadsheet only)
		$this->ExportWordPageOrientation = "portrait"; // Page orientation (PHPWord only)
		$this->ExportWordColumnWidth = NULL; // Cell width (PHPWord only)
		$this->DetailAdd = FALSE; // Allow detail add
		$this->DetailEdit = FALSE; // Allow detail edit
		$this->DetailView = FALSE; // Allow detail view
		$this->ShowMultipleDetails = FALSE; // Show multiple details
		$this->GridAddRowCount = 5;
		$this->AllowAddDeleteRow = TRUE; // Allow add/delete row
		$this->UserIDAllowSecurity = Config("DEFAULT_USER_ID_ALLOW_SECURITY"); // Default User ID allowed permissions
		$this->BasicSearch = new BasicSearch($this->TableVar);

		// kapal_id
		$this->kapal_id = new DbField('v_hasil', 'v_hasil', 'x_kapal_id', 'kapal_id', '`kapal_id`', '`kapal_id`', 3, 11, -1, FALSE, '`kapal_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->kapal_id->IsAutoIncrement = TRUE; // Autoincrement field
		$this->kapal_id->IsPrimaryKey = TRUE; // Primary key field
		$this->kapal_id->Sortable = TRUE; // Allow sort
		$this->kapal_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['kapal_id'] = &$this->kapal_id;

		// distribusi_id
		$this->distribusi_id = new DbField('v_hasil', 'v_hasil', 'x_distribusi_id', 'distribusi_id', '`distribusi_id`', '`distribusi_id`', 3, 11, -1, FALSE, '`distribusi_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->distribusi_id->IsAutoIncrement = TRUE; // Autoincrement field
		$this->distribusi_id->IsPrimaryKey = TRUE; // Primary key field
		$this->distribusi_id->Sortable = TRUE; // Allow sort
		$this->distribusi_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['distribusi_id'] = &$this->distribusi_id;

		// kapal0_id
		$this->kapal0_id = new DbField('v_hasil', 'v_hasil', 'x_kapal0_id', 'kapal0_id', '`kapal0_id`', '`kapal0_id`', 3, 11, -1, FALSE, '`kapal0_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->kapal0_id->IsAutoIncrement = TRUE; // Autoincrement field
		$this->kapal0_id->IsPrimaryKey = TRUE; // Primary key field
		$this->kapal0_id->Sortable = TRUE; // Allow sort
		$this->kapal0_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['kapal0_id'] = &$this->kapal0_id;

		// kapal0_nama
		$this->kapal0_nama = new DbField('v_hasil', 'v_hasil', 'x_kapal0_nama', 'kapal0_nama', '`kapal0_nama`', '`kapal0_nama`', 200, 50, -1, FALSE, '`kapal0_nama`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->kapal0_nama->Sortable = TRUE; // Allow sort
		$this->fields['kapal0_nama'] = &$this->kapal0_nama;

		// kapaldetail_id
		$this->kapaldetail_id = new DbField('v_hasil', 'v_hasil', 'x_kapaldetail_id', 'kapaldetail_id', '`kapaldetail_id`', '`kapaldetail_id`', 3, 11, -1, FALSE, '`kapaldetail_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->kapaldetail_id->IsAutoIncrement = TRUE; // Autoincrement field
		$this->kapaldetail_id->IsPrimaryKey = TRUE; // Primary key field
		$this->kapaldetail_id->Sortable = TRUE; // Allow sort
		$this->kapaldetail_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['kapaldetail_id'] = &$this->kapaldetail_id;

		// Payload
		$this->Payload = new DbField('v_hasil', 'v_hasil', 'x_Payload', 'Payload', '`Payload`', '`Payload`', 4, 14, -1, FALSE, '`Payload`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Payload->Sortable = TRUE; // Allow sort
		$this->Payload->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['Payload'] = &$this->Payload;

		// DischRate
		$this->DischRate = new DbField('v_hasil', 'v_hasil', 'x_DischRate', 'DischRate', '`DischRate`', '`DischRate`', 4, 14, -1, FALSE, '`DischRate`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->DischRate->Sortable = TRUE; // Allow sort
		$this->DischRate->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['DischRate'] = &$this->DischRate;

		// TCH
		$this->TCH = new DbField('v_hasil', 'v_hasil', 'x_TCH', 'TCH', '`TCH`', '`TCH`', 4, 14, -1, FALSE, '`TCH`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->TCH->Sortable = TRUE; // Allow sort
		$this->TCH->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['TCH'] = &$this->TCH;

		// VarCost
		$this->VarCost = new DbField('v_hasil', 'v_hasil', 'x_VarCost', 'VarCost', '`VarCost`', '`VarCost`', 4, 14, -1, FALSE, '`VarCost`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->VarCost->Sortable = TRUE; // Allow sort
		$this->VarCost->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['VarCost'] = &$this->VarCost;

		// VsLaden
		$this->VsLaden = new DbField('v_hasil', 'v_hasil', 'x_VsLaden', 'VsLaden', '`VsLaden`', '`VsLaden`', 4, 14, -1, FALSE, '`VsLaden`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->VsLaden->Sortable = TRUE; // Allow sort
		$this->VsLaden->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['VsLaden'] = &$this->VsLaden;

		// VsBallast
		$this->VsBallast = new DbField('v_hasil', 'v_hasil', 'x_VsBallast', 'VsBallast', '`VsBallast`', '`VsBallast`', 4, 14, -1, FALSE, '`VsBallast`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->VsBallast->Sortable = TRUE; // Allow sort
		$this->VsBallast->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['VsBallast'] = &$this->VsBallast;

		// ComDay
		$this->ComDay = new DbField('v_hasil', 'v_hasil', 'x_ComDay', 'ComDay', '`ComDay`', '`ComDay`', 4, 14, -1, FALSE, '`ComDay`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ComDay->Sortable = TRUE; // Allow sort
		$this->ComDay->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['ComDay'] = &$this->ComDay;

		// t_distribusi_id
		$this->t_distribusi_id = new DbField('v_hasil', 'v_hasil', 'x_t_distribusi_id', 't_distribusi_id', '`t_distribusi_id`', '`t_distribusi_id`', 3, 11, -1, FALSE, '`t_distribusi_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->t_distribusi_id->IsAutoIncrement = TRUE; // Autoincrement field
		$this->t_distribusi_id->IsPrimaryKey = TRUE; // Primary key field
		$this->t_distribusi_id->Sortable = TRUE; // Allow sort
		$this->t_distribusi_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['t_distribusi_id'] = &$this->t_distribusi_id;

		// source_id
		$this->source_id = new DbField('v_hasil', 'v_hasil', 'x_source_id', 'source_id', '`source_id`', '`source_id`', 3, 11, -1, FALSE, '`source_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->source_id->Sortable = TRUE; // Allow sort
		$this->source_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['source_id'] = &$this->source_id;

		// destination_id
		$this->destination_id = new DbField('v_hasil', 'v_hasil', 'x_destination_id', 'destination_id', '`destination_id`', '`destination_id`', 3, 11, -1, FALSE, '`destination_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->destination_id->Sortable = TRUE; // Allow sort
		$this->destination_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['destination_id'] = &$this->destination_id;

		// Jarak
		$this->Jarak = new DbField('v_hasil', 'v_hasil', 'x_Jarak', 'Jarak', '`Jarak`', '`Jarak`', 4, 14, -1, FALSE, '`Jarak`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Jarak->Sortable = TRUE; // Allow sort
		$this->Jarak->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['Jarak'] = &$this->Jarak;

		// Rate_O
		$this->Rate_O = new DbField('v_hasil', 'v_hasil', 'x_Rate_O', 'Rate_O', '`Rate_O`', '`Rate_O`', 4, 14, -1, FALSE, '`Rate_O`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Rate_O->Sortable = TRUE; // Allow sort
		$this->Rate_O->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['Rate_O'] = &$this->Rate_O;

		// Rate_D
		$this->Rate_D = new DbField('v_hasil', 'v_hasil', 'x_Rate_D', 'Rate_D', '`Rate_D`', '`Rate_D`', 4, 14, -1, FALSE, '`Rate_D`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Rate_D->Sortable = TRUE; // Allow sort
		$this->Rate_D->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['Rate_D'] = &$this->Rate_D;

		// Demand
		$this->Demand = new DbField('v_hasil', 'v_hasil', 'x_Demand', 'Demand', '`Demand`', '`Demand`', 4, 14, -1, FALSE, '`Demand`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Demand->Sortable = TRUE; // Allow sort
		$this->Demand->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['Demand'] = &$this->Demand;

		// sea_time
		$this->sea_time = new DbField('v_hasil', 'v_hasil', 'x_sea_time', 'sea_time', '`sea_time`', '`sea_time`', 5, 23, -1, FALSE, '`sea_time`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->sea_time->Sortable = TRUE; // Allow sort
		$this->sea_time->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['sea_time'] = &$this->sea_time;

		// port_time
		$this->port_time = new DbField('v_hasil', 'v_hasil', 'x_port_time', 'port_time', '`port_time`', '`port_time`', 5, 23, -1, FALSE, '`port_time`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->port_time->Sortable = TRUE; // Allow sort
		$this->port_time->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['port_time'] = &$this->port_time;

		// roundtrip_days
		$this->roundtrip_days = new DbField('v_hasil', 'v_hasil', 'x_roundtrip_days', 'roundtrip_days', '`roundtrip_days`', '`roundtrip_days`', 5, 27, -1, FALSE, '`roundtrip_days`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->roundtrip_days->Sortable = TRUE; // Allow sort
		$this->roundtrip_days->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['roundtrip_days'] = &$this->roundtrip_days;

		// freqmaxbytrip
		$this->freqmaxbytrip = new DbField('v_hasil', 'v_hasil', 'x_freqmaxbytrip', 'freqmaxbytrip', '`freqmaxbytrip`', '`freqmaxbytrip`', 5, 17, -1, FALSE, '`freqmaxbytrip`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->freqmaxbytrip->Sortable = TRUE; // Allow sort
		$this->freqmaxbytrip->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['freqmaxbytrip'] = &$this->freqmaxbytrip;

		// freqmaxbycargo
		$this->freqmaxbycargo = new DbField('v_hasil', 'v_hasil', 'x_freqmaxbycargo', 'freqmaxbycargo', '`freqmaxbycargo`', '`freqmaxbycargo`', 5, 17, -1, FALSE, '`freqmaxbycargo`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->freqmaxbycargo->Sortable = TRUE; // Allow sort
		$this->freqmaxbycargo->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['freqmaxbycargo'] = &$this->freqmaxbycargo;
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

	// Table level SQL
	public function getSqlFrom() // From
	{
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`v_hasil`";
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
			$this->kapal_id->setDbValue($conn->insert_ID());
			$rs['kapal_id'] = $this->kapal_id->DbValue;

			// Get insert id if necessary
			$this->distribusi_id->setDbValue($conn->insert_ID());
			$rs['distribusi_id'] = $this->distribusi_id->DbValue;

			// Get insert id if necessary
			$this->kapal0_id->setDbValue($conn->insert_ID());
			$rs['kapal0_id'] = $this->kapal0_id->DbValue;

			// Get insert id if necessary
			$this->kapaldetail_id->setDbValue($conn->insert_ID());
			$rs['kapaldetail_id'] = $this->kapaldetail_id->DbValue;

			// Get insert id if necessary
			$this->t_distribusi_id->setDbValue($conn->insert_ID());
			$rs['t_distribusi_id'] = $this->t_distribusi_id->DbValue;
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
			if (array_key_exists('kapal_id', $rs))
				AddFilter($where, QuotedName('kapal_id', $this->Dbid) . '=' . QuotedValue($rs['kapal_id'], $this->kapal_id->DataType, $this->Dbid));
			if (array_key_exists('distribusi_id', $rs))
				AddFilter($where, QuotedName('distribusi_id', $this->Dbid) . '=' . QuotedValue($rs['distribusi_id'], $this->distribusi_id->DataType, $this->Dbid));
			if (array_key_exists('kapal0_id', $rs))
				AddFilter($where, QuotedName('kapal0_id', $this->Dbid) . '=' . QuotedValue($rs['kapal0_id'], $this->kapal0_id->DataType, $this->Dbid));
			if (array_key_exists('kapaldetail_id', $rs))
				AddFilter($where, QuotedName('kapaldetail_id', $this->Dbid) . '=' . QuotedValue($rs['kapaldetail_id'], $this->kapaldetail_id->DataType, $this->Dbid));
			if (array_key_exists('t_distribusi_id', $rs))
				AddFilter($where, QuotedName('t_distribusi_id', $this->Dbid) . '=' . QuotedValue($rs['t_distribusi_id'], $this->t_distribusi_id->DataType, $this->Dbid));
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
		$this->kapal_id->DbValue = $row['kapal_id'];
		$this->distribusi_id->DbValue = $row['distribusi_id'];
		$this->kapal0_id->DbValue = $row['kapal0_id'];
		$this->kapal0_nama->DbValue = $row['kapal0_nama'];
		$this->kapaldetail_id->DbValue = $row['kapaldetail_id'];
		$this->Payload->DbValue = $row['Payload'];
		$this->DischRate->DbValue = $row['DischRate'];
		$this->TCH->DbValue = $row['TCH'];
		$this->VarCost->DbValue = $row['VarCost'];
		$this->VsLaden->DbValue = $row['VsLaden'];
		$this->VsBallast->DbValue = $row['VsBallast'];
		$this->ComDay->DbValue = $row['ComDay'];
		$this->t_distribusi_id->DbValue = $row['t_distribusi_id'];
		$this->source_id->DbValue = $row['source_id'];
		$this->destination_id->DbValue = $row['destination_id'];
		$this->Jarak->DbValue = $row['Jarak'];
		$this->Rate_O->DbValue = $row['Rate_O'];
		$this->Rate_D->DbValue = $row['Rate_D'];
		$this->Demand->DbValue = $row['Demand'];
		$this->sea_time->DbValue = $row['sea_time'];
		$this->port_time->DbValue = $row['port_time'];
		$this->roundtrip_days->DbValue = $row['roundtrip_days'];
		$this->freqmaxbytrip->DbValue = $row['freqmaxbytrip'];
		$this->freqmaxbycargo->DbValue = $row['freqmaxbycargo'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "`kapal_id` = @kapal_id@ AND `distribusi_id` = @distribusi_id@ AND `kapal0_id` = @kapal0_id@ AND `kapaldetail_id` = @kapaldetail_id@ AND `t_distribusi_id` = @t_distribusi_id@";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
		if (is_array($row))
			$val = array_key_exists('kapal_id', $row) ? $row['kapal_id'] : NULL;
		else
			$val = $this->kapal_id->OldValue !== NULL ? $this->kapal_id->OldValue : $this->kapal_id->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@kapal_id@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
		if (is_array($row))
			$val = array_key_exists('distribusi_id', $row) ? $row['distribusi_id'] : NULL;
		else
			$val = $this->distribusi_id->OldValue !== NULL ? $this->distribusi_id->OldValue : $this->distribusi_id->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@distribusi_id@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
		if (is_array($row))
			$val = array_key_exists('kapal0_id', $row) ? $row['kapal0_id'] : NULL;
		else
			$val = $this->kapal0_id->OldValue !== NULL ? $this->kapal0_id->OldValue : $this->kapal0_id->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@kapal0_id@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
		if (is_array($row))
			$val = array_key_exists('kapaldetail_id', $row) ? $row['kapaldetail_id'] : NULL;
		else
			$val = $this->kapaldetail_id->OldValue !== NULL ? $this->kapaldetail_id->OldValue : $this->kapaldetail_id->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@kapaldetail_id@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
		if (is_array($row))
			$val = array_key_exists('t_distribusi_id', $row) ? $row['t_distribusi_id'] : NULL;
		else
			$val = $this->t_distribusi_id->OldValue !== NULL ? $this->t_distribusi_id->OldValue : $this->t_distribusi_id->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@t_distribusi_id@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
			return "v_hasillist.php";
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
		if ($pageName == "v_hasilview.php")
			return $Language->phrase("View");
		elseif ($pageName == "v_hasiledit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "v_hasiladd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "v_hasillist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("v_hasilview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("v_hasilview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "v_hasiladd.php?" . $this->getUrlParm($parm);
		else
			$url = "v_hasiladd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("v_hasiledit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("v_hasiladd.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("v_hasildelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "kapal_id:" . JsonEncode($this->kapal_id->CurrentValue, "number");
		$json .= ",distribusi_id:" . JsonEncode($this->distribusi_id->CurrentValue, "number");
		$json .= ",kapal0_id:" . JsonEncode($this->kapal0_id->CurrentValue, "number");
		$json .= ",kapaldetail_id:" . JsonEncode($this->kapaldetail_id->CurrentValue, "number");
		$json .= ",t_distribusi_id:" . JsonEncode($this->t_distribusi_id->CurrentValue, "number");
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
		if ($this->kapal_id->CurrentValue != NULL) {
			$url .= "kapal_id=" . urlencode($this->kapal_id->CurrentValue);
		} else {
			return "javascript:ew.alert(ew.language.phrase('InvalidRecord'));";
		}
		if ($this->distribusi_id->CurrentValue != NULL) {
			$url .= "&distribusi_id=" . urlencode($this->distribusi_id->CurrentValue);
		} else {
			return "javascript:ew.alert(ew.language.phrase('InvalidRecord'));";
		}
		if ($this->kapal0_id->CurrentValue != NULL) {
			$url .= "&kapal0_id=" . urlencode($this->kapal0_id->CurrentValue);
		} else {
			return "javascript:ew.alert(ew.language.phrase('InvalidRecord'));";
		}
		if ($this->kapaldetail_id->CurrentValue != NULL) {
			$url .= "&kapaldetail_id=" . urlencode($this->kapaldetail_id->CurrentValue);
		} else {
			return "javascript:ew.alert(ew.language.phrase('InvalidRecord'));";
		}
		if ($this->t_distribusi_id->CurrentValue != NULL) {
			$url .= "&t_distribusi_id=" . urlencode($this->t_distribusi_id->CurrentValue);
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
			for ($i = 0; $i < $cnt; $i++)
				$arKeys[$i] = explode(Config("COMPOSITE_KEY_SEPARATOR"), $arKeys[$i]);
		} else {
			if (Param("kapal_id") !== NULL)
				$arKey[] = Param("kapal_id");
			elseif (IsApi() && Key(0) !== NULL)
				$arKey[] = Key(0);
			elseif (IsApi() && Route(2) !== NULL)
				$arKey[] = Route(2);
			else
				$arKeys = NULL; // Do not setup
			if (Param("distribusi_id") !== NULL)
				$arKey[] = Param("distribusi_id");
			elseif (IsApi() && Key(1) !== NULL)
				$arKey[] = Key(1);
			elseif (IsApi() && Route(3) !== NULL)
				$arKey[] = Route(3);
			else
				$arKeys = NULL; // Do not setup
			if (Param("kapal0_id") !== NULL)
				$arKey[] = Param("kapal0_id");
			elseif (IsApi() && Key(2) !== NULL)
				$arKey[] = Key(2);
			elseif (IsApi() && Route(4) !== NULL)
				$arKey[] = Route(4);
			else
				$arKeys = NULL; // Do not setup
			if (Param("kapaldetail_id") !== NULL)
				$arKey[] = Param("kapaldetail_id");
			elseif (IsApi() && Key(3) !== NULL)
				$arKey[] = Key(3);
			elseif (IsApi() && Route(5) !== NULL)
				$arKey[] = Route(5);
			else
				$arKeys = NULL; // Do not setup
			if (Param("t_distribusi_id") !== NULL)
				$arKey[] = Param("t_distribusi_id");
			elseif (IsApi() && Key(4) !== NULL)
				$arKey[] = Key(4);
			elseif (IsApi() && Route(6) !== NULL)
				$arKey[] = Route(6);
			else
				$arKeys = NULL; // Do not setup
			if (is_array($arKeys)) $arKeys[] = $arKey;

			//return $arKeys; // Do not return yet, so the values will also be checked by the following code
		}

		// Check keys
		$ar = [];
		if (is_array($arKeys)) {
			foreach ($arKeys as $key) {
				if (!is_array($key) || count($key) != 5)
					continue; // Just skip so other keys will still work
				if (!is_numeric($key[0])) // kapal_id
					continue;
				if (!is_numeric($key[1])) // distribusi_id
					continue;
				if (!is_numeric($key[2])) // kapal0_id
					continue;
				if (!is_numeric($key[3])) // kapaldetail_id
					continue;
				if (!is_numeric($key[4])) // t_distribusi_id
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
				$this->kapal_id->CurrentValue = $key[0];
			else
				$this->kapal_id->OldValue = $key[0];
			if ($setCurrent)
				$this->distribusi_id->CurrentValue = $key[1];
			else
				$this->distribusi_id->OldValue = $key[1];
			if ($setCurrent)
				$this->kapal0_id->CurrentValue = $key[2];
			else
				$this->kapal0_id->OldValue = $key[2];
			if ($setCurrent)
				$this->kapaldetail_id->CurrentValue = $key[3];
			else
				$this->kapaldetail_id->OldValue = $key[3];
			if ($setCurrent)
				$this->t_distribusi_id->CurrentValue = $key[4];
			else
				$this->t_distribusi_id->OldValue = $key[4];
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
		$this->kapal_id->setDbValue($rs->fields('kapal_id'));
		$this->distribusi_id->setDbValue($rs->fields('distribusi_id'));
		$this->kapal0_id->setDbValue($rs->fields('kapal0_id'));
		$this->kapal0_nama->setDbValue($rs->fields('kapal0_nama'));
		$this->kapaldetail_id->setDbValue($rs->fields('kapaldetail_id'));
		$this->Payload->setDbValue($rs->fields('Payload'));
		$this->DischRate->setDbValue($rs->fields('DischRate'));
		$this->TCH->setDbValue($rs->fields('TCH'));
		$this->VarCost->setDbValue($rs->fields('VarCost'));
		$this->VsLaden->setDbValue($rs->fields('VsLaden'));
		$this->VsBallast->setDbValue($rs->fields('VsBallast'));
		$this->ComDay->setDbValue($rs->fields('ComDay'));
		$this->t_distribusi_id->setDbValue($rs->fields('t_distribusi_id'));
		$this->source_id->setDbValue($rs->fields('source_id'));
		$this->destination_id->setDbValue($rs->fields('destination_id'));
		$this->Jarak->setDbValue($rs->fields('Jarak'));
		$this->Rate_O->setDbValue($rs->fields('Rate_O'));
		$this->Rate_D->setDbValue($rs->fields('Rate_D'));
		$this->Demand->setDbValue($rs->fields('Demand'));
		$this->sea_time->setDbValue($rs->fields('sea_time'));
		$this->port_time->setDbValue($rs->fields('port_time'));
		$this->roundtrip_days->setDbValue($rs->fields('roundtrip_days'));
		$this->freqmaxbytrip->setDbValue($rs->fields('freqmaxbytrip'));
		$this->freqmaxbycargo->setDbValue($rs->fields('freqmaxbycargo'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// kapal_id
		// distribusi_id
		// kapal0_id
		// kapal0_nama
		// kapaldetail_id
		// Payload
		// DischRate
		// TCH
		// VarCost
		// VsLaden
		// VsBallast
		// ComDay
		// t_distribusi_id
		// source_id
		// destination_id
		// Jarak
		// Rate_O
		// Rate_D
		// Demand
		// sea_time
		// port_time
		// roundtrip_days
		// freqmaxbytrip
		// freqmaxbycargo
		// kapal_id

		$this->kapal_id->ViewValue = $this->kapal_id->CurrentValue;
		$this->kapal_id->ViewCustomAttributes = "";

		// distribusi_id
		$this->distribusi_id->ViewValue = $this->distribusi_id->CurrentValue;
		$this->distribusi_id->ViewCustomAttributes = "";

		// kapal0_id
		$this->kapal0_id->ViewValue = $this->kapal0_id->CurrentValue;
		$this->kapal0_id->ViewCustomAttributes = "";

		// kapal0_nama
		$this->kapal0_nama->ViewValue = $this->kapal0_nama->CurrentValue;
		$this->kapal0_nama->ViewCustomAttributes = "";

		// kapaldetail_id
		$this->kapaldetail_id->ViewValue = $this->kapaldetail_id->CurrentValue;
		$this->kapaldetail_id->ViewCustomAttributes = "";

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

		// t_distribusi_id
		$this->t_distribusi_id->ViewValue = $this->t_distribusi_id->CurrentValue;
		$this->t_distribusi_id->ViewCustomAttributes = "";

		// source_id
		$this->source_id->ViewValue = $this->source_id->CurrentValue;
		$this->source_id->ViewValue = FormatNumber($this->source_id->ViewValue, 0, -2, -2, -2);
		$this->source_id->ViewCustomAttributes = "";

		// destination_id
		$this->destination_id->ViewValue = $this->destination_id->CurrentValue;
		$this->destination_id->ViewValue = FormatNumber($this->destination_id->ViewValue, 0, -2, -2, -2);
		$this->destination_id->ViewCustomAttributes = "";

		// Jarak
		$this->Jarak->ViewValue = $this->Jarak->CurrentValue;
		$this->Jarak->ViewValue = FormatNumber($this->Jarak->ViewValue, 2, -2, -2, -2);
		$this->Jarak->ViewCustomAttributes = "";

		// Rate_O
		$this->Rate_O->ViewValue = $this->Rate_O->CurrentValue;
		$this->Rate_O->ViewValue = FormatNumber($this->Rate_O->ViewValue, 2, -2, -2, -2);
		$this->Rate_O->ViewCustomAttributes = "";

		// Rate_D
		$this->Rate_D->ViewValue = $this->Rate_D->CurrentValue;
		$this->Rate_D->ViewValue = FormatNumber($this->Rate_D->ViewValue, 2, -2, -2, -2);
		$this->Rate_D->ViewCustomAttributes = "";

		// Demand
		$this->Demand->ViewValue = $this->Demand->CurrentValue;
		$this->Demand->ViewValue = FormatNumber($this->Demand->ViewValue, 2, -2, -2, -2);
		$this->Demand->ViewCustomAttributes = "";

		// sea_time
		$this->sea_time->ViewValue = $this->sea_time->CurrentValue;
		$this->sea_time->ViewValue = FormatNumber($this->sea_time->ViewValue, 2, -2, -2, -2);
		$this->sea_time->ViewCustomAttributes = "";

		// port_time
		$this->port_time->ViewValue = $this->port_time->CurrentValue;
		$this->port_time->ViewValue = FormatNumber($this->port_time->ViewValue, 2, -2, -2, -2);
		$this->port_time->ViewCustomAttributes = "";

		// roundtrip_days
		$this->roundtrip_days->ViewValue = $this->roundtrip_days->CurrentValue;
		$this->roundtrip_days->ViewValue = FormatNumber($this->roundtrip_days->ViewValue, 2, -2, -2, -2);
		$this->roundtrip_days->ViewCustomAttributes = "";

		// freqmaxbytrip
		$this->freqmaxbytrip->ViewValue = $this->freqmaxbytrip->CurrentValue;
		$this->freqmaxbytrip->ViewValue = FormatNumber($this->freqmaxbytrip->ViewValue, 2, -2, -2, -2);
		$this->freqmaxbytrip->ViewCustomAttributes = "";

		// freqmaxbycargo
		$this->freqmaxbycargo->ViewValue = $this->freqmaxbycargo->CurrentValue;
		$this->freqmaxbycargo->ViewValue = FormatNumber($this->freqmaxbycargo->ViewValue, 2, -2, -2, -2);
		$this->freqmaxbycargo->ViewCustomAttributes = "";

		// kapal_id
		$this->kapal_id->LinkCustomAttributes = "";
		$this->kapal_id->HrefValue = "";
		$this->kapal_id->TooltipValue = "";

		// distribusi_id
		$this->distribusi_id->LinkCustomAttributes = "";
		$this->distribusi_id->HrefValue = "";
		$this->distribusi_id->TooltipValue = "";

		// kapal0_id
		$this->kapal0_id->LinkCustomAttributes = "";
		$this->kapal0_id->HrefValue = "";
		$this->kapal0_id->TooltipValue = "";

		// kapal0_nama
		$this->kapal0_nama->LinkCustomAttributes = "";
		$this->kapal0_nama->HrefValue = "";
		$this->kapal0_nama->TooltipValue = "";

		// kapaldetail_id
		$this->kapaldetail_id->LinkCustomAttributes = "";
		$this->kapaldetail_id->HrefValue = "";
		$this->kapaldetail_id->TooltipValue = "";

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

		// t_distribusi_id
		$this->t_distribusi_id->LinkCustomAttributes = "";
		$this->t_distribusi_id->HrefValue = "";
		$this->t_distribusi_id->TooltipValue = "";

		// source_id
		$this->source_id->LinkCustomAttributes = "";
		$this->source_id->HrefValue = "";
		$this->source_id->TooltipValue = "";

		// destination_id
		$this->destination_id->LinkCustomAttributes = "";
		$this->destination_id->HrefValue = "";
		$this->destination_id->TooltipValue = "";

		// Jarak
		$this->Jarak->LinkCustomAttributes = "";
		$this->Jarak->HrefValue = "";
		$this->Jarak->TooltipValue = "";

		// Rate_O
		$this->Rate_O->LinkCustomAttributes = "";
		$this->Rate_O->HrefValue = "";
		$this->Rate_O->TooltipValue = "";

		// Rate_D
		$this->Rate_D->LinkCustomAttributes = "";
		$this->Rate_D->HrefValue = "";
		$this->Rate_D->TooltipValue = "";

		// Demand
		$this->Demand->LinkCustomAttributes = "";
		$this->Demand->HrefValue = "";
		$this->Demand->TooltipValue = "";

		// sea_time
		$this->sea_time->LinkCustomAttributes = "";
		$this->sea_time->HrefValue = "";
		$this->sea_time->TooltipValue = "";

		// port_time
		$this->port_time->LinkCustomAttributes = "";
		$this->port_time->HrefValue = "";
		$this->port_time->TooltipValue = "";

		// roundtrip_days
		$this->roundtrip_days->LinkCustomAttributes = "";
		$this->roundtrip_days->HrefValue = "";
		$this->roundtrip_days->TooltipValue = "";

		// freqmaxbytrip
		$this->freqmaxbytrip->LinkCustomAttributes = "";
		$this->freqmaxbytrip->HrefValue = "";
		$this->freqmaxbytrip->TooltipValue = "";

		// freqmaxbycargo
		$this->freqmaxbycargo->LinkCustomAttributes = "";
		$this->freqmaxbycargo->HrefValue = "";
		$this->freqmaxbycargo->TooltipValue = "";

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

		// kapal_id
		$this->kapal_id->EditAttrs["class"] = "form-control";
		$this->kapal_id->EditCustomAttributes = "";
		$this->kapal_id->EditValue = $this->kapal_id->CurrentValue;
		$this->kapal_id->ViewCustomAttributes = "";

		// distribusi_id
		$this->distribusi_id->EditAttrs["class"] = "form-control";
		$this->distribusi_id->EditCustomAttributes = "";
		$this->distribusi_id->EditValue = $this->distribusi_id->CurrentValue;
		$this->distribusi_id->ViewCustomAttributes = "";

		// kapal0_id
		$this->kapal0_id->EditAttrs["class"] = "form-control";
		$this->kapal0_id->EditCustomAttributes = "";
		$this->kapal0_id->EditValue = $this->kapal0_id->CurrentValue;
		$this->kapal0_id->ViewCustomAttributes = "";

		// kapal0_nama
		$this->kapal0_nama->EditAttrs["class"] = "form-control";
		$this->kapal0_nama->EditCustomAttributes = "";
		if (!$this->kapal0_nama->Raw)
			$this->kapal0_nama->CurrentValue = HtmlDecode($this->kapal0_nama->CurrentValue);
		$this->kapal0_nama->EditValue = $this->kapal0_nama->CurrentValue;
		$this->kapal0_nama->PlaceHolder = RemoveHtml($this->kapal0_nama->caption());

		// kapaldetail_id
		$this->kapaldetail_id->EditAttrs["class"] = "form-control";
		$this->kapaldetail_id->EditCustomAttributes = "";
		$this->kapaldetail_id->EditValue = $this->kapaldetail_id->CurrentValue;
		$this->kapaldetail_id->ViewCustomAttributes = "";

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
		

		// t_distribusi_id
		$this->t_distribusi_id->EditAttrs["class"] = "form-control";
		$this->t_distribusi_id->EditCustomAttributes = "";
		$this->t_distribusi_id->EditValue = $this->t_distribusi_id->CurrentValue;
		$this->t_distribusi_id->ViewCustomAttributes = "";

		// source_id
		$this->source_id->EditAttrs["class"] = "form-control";
		$this->source_id->EditCustomAttributes = "";
		$this->source_id->EditValue = $this->source_id->CurrentValue;
		$this->source_id->PlaceHolder = RemoveHtml($this->source_id->caption());

		// destination_id
		$this->destination_id->EditAttrs["class"] = "form-control";
		$this->destination_id->EditCustomAttributes = "";
		$this->destination_id->EditValue = $this->destination_id->CurrentValue;
		$this->destination_id->PlaceHolder = RemoveHtml($this->destination_id->caption());

		// Jarak
		$this->Jarak->EditAttrs["class"] = "form-control";
		$this->Jarak->EditCustomAttributes = "";
		$this->Jarak->EditValue = $this->Jarak->CurrentValue;
		$this->Jarak->PlaceHolder = RemoveHtml($this->Jarak->caption());
		if (strval($this->Jarak->EditValue) != "" && is_numeric($this->Jarak->EditValue))
			$this->Jarak->EditValue = FormatNumber($this->Jarak->EditValue, -2, -2, -2, -2);
		

		// Rate_O
		$this->Rate_O->EditAttrs["class"] = "form-control";
		$this->Rate_O->EditCustomAttributes = "";
		$this->Rate_O->EditValue = $this->Rate_O->CurrentValue;
		$this->Rate_O->PlaceHolder = RemoveHtml($this->Rate_O->caption());
		if (strval($this->Rate_O->EditValue) != "" && is_numeric($this->Rate_O->EditValue))
			$this->Rate_O->EditValue = FormatNumber($this->Rate_O->EditValue, -2, -2, -2, -2);
		

		// Rate_D
		$this->Rate_D->EditAttrs["class"] = "form-control";
		$this->Rate_D->EditCustomAttributes = "";
		$this->Rate_D->EditValue = $this->Rate_D->CurrentValue;
		$this->Rate_D->PlaceHolder = RemoveHtml($this->Rate_D->caption());
		if (strval($this->Rate_D->EditValue) != "" && is_numeric($this->Rate_D->EditValue))
			$this->Rate_D->EditValue = FormatNumber($this->Rate_D->EditValue, -2, -2, -2, -2);
		

		// Demand
		$this->Demand->EditAttrs["class"] = "form-control";
		$this->Demand->EditCustomAttributes = "";
		$this->Demand->EditValue = $this->Demand->CurrentValue;
		$this->Demand->PlaceHolder = RemoveHtml($this->Demand->caption());
		if (strval($this->Demand->EditValue) != "" && is_numeric($this->Demand->EditValue))
			$this->Demand->EditValue = FormatNumber($this->Demand->EditValue, -2, -2, -2, -2);
		

		// sea_time
		$this->sea_time->EditAttrs["class"] = "form-control";
		$this->sea_time->EditCustomAttributes = "";
		$this->sea_time->EditValue = $this->sea_time->CurrentValue;
		$this->sea_time->PlaceHolder = RemoveHtml($this->sea_time->caption());
		if (strval($this->sea_time->EditValue) != "" && is_numeric($this->sea_time->EditValue))
			$this->sea_time->EditValue = FormatNumber($this->sea_time->EditValue, -2, -2, -2, -2);
		

		// port_time
		$this->port_time->EditAttrs["class"] = "form-control";
		$this->port_time->EditCustomAttributes = "";
		$this->port_time->EditValue = $this->port_time->CurrentValue;
		$this->port_time->PlaceHolder = RemoveHtml($this->port_time->caption());
		if (strval($this->port_time->EditValue) != "" && is_numeric($this->port_time->EditValue))
			$this->port_time->EditValue = FormatNumber($this->port_time->EditValue, -2, -2, -2, -2);
		

		// roundtrip_days
		$this->roundtrip_days->EditAttrs["class"] = "form-control";
		$this->roundtrip_days->EditCustomAttributes = "";
		$this->roundtrip_days->EditValue = $this->roundtrip_days->CurrentValue;
		$this->roundtrip_days->PlaceHolder = RemoveHtml($this->roundtrip_days->caption());
		if (strval($this->roundtrip_days->EditValue) != "" && is_numeric($this->roundtrip_days->EditValue))
			$this->roundtrip_days->EditValue = FormatNumber($this->roundtrip_days->EditValue, -2, -2, -2, -2);
		

		// freqmaxbytrip
		$this->freqmaxbytrip->EditAttrs["class"] = "form-control";
		$this->freqmaxbytrip->EditCustomAttributes = "";
		$this->freqmaxbytrip->EditValue = $this->freqmaxbytrip->CurrentValue;
		$this->freqmaxbytrip->PlaceHolder = RemoveHtml($this->freqmaxbytrip->caption());
		if (strval($this->freqmaxbytrip->EditValue) != "" && is_numeric($this->freqmaxbytrip->EditValue))
			$this->freqmaxbytrip->EditValue = FormatNumber($this->freqmaxbytrip->EditValue, -2, -2, -2, -2);
		

		// freqmaxbycargo
		$this->freqmaxbycargo->EditAttrs["class"] = "form-control";
		$this->freqmaxbycargo->EditCustomAttributes = "";
		$this->freqmaxbycargo->EditValue = $this->freqmaxbycargo->CurrentValue;
		$this->freqmaxbycargo->PlaceHolder = RemoveHtml($this->freqmaxbycargo->caption());
		if (strval($this->freqmaxbycargo->EditValue) != "" && is_numeric($this->freqmaxbycargo->EditValue))
			$this->freqmaxbycargo->EditValue = FormatNumber($this->freqmaxbycargo->EditValue, -2, -2, -2, -2);
		

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
					$doc->exportCaption($this->kapal_id);
					$doc->exportCaption($this->distribusi_id);
					$doc->exportCaption($this->kapal0_id);
					$doc->exportCaption($this->kapal0_nama);
					$doc->exportCaption($this->kapaldetail_id);
					$doc->exportCaption($this->Payload);
					$doc->exportCaption($this->DischRate);
					$doc->exportCaption($this->TCH);
					$doc->exportCaption($this->VarCost);
					$doc->exportCaption($this->VsLaden);
					$doc->exportCaption($this->VsBallast);
					$doc->exportCaption($this->ComDay);
					$doc->exportCaption($this->t_distribusi_id);
					$doc->exportCaption($this->source_id);
					$doc->exportCaption($this->destination_id);
					$doc->exportCaption($this->Jarak);
					$doc->exportCaption($this->Rate_O);
					$doc->exportCaption($this->Rate_D);
					$doc->exportCaption($this->Demand);
					$doc->exportCaption($this->sea_time);
					$doc->exportCaption($this->port_time);
					$doc->exportCaption($this->roundtrip_days);
					$doc->exportCaption($this->freqmaxbytrip);
					$doc->exportCaption($this->freqmaxbycargo);
				} else {
					$doc->exportCaption($this->kapal_id);
					$doc->exportCaption($this->distribusi_id);
					$doc->exportCaption($this->kapal0_id);
					$doc->exportCaption($this->kapal0_nama);
					$doc->exportCaption($this->kapaldetail_id);
					$doc->exportCaption($this->Payload);
					$doc->exportCaption($this->DischRate);
					$doc->exportCaption($this->TCH);
					$doc->exportCaption($this->VarCost);
					$doc->exportCaption($this->VsLaden);
					$doc->exportCaption($this->VsBallast);
					$doc->exportCaption($this->ComDay);
					$doc->exportCaption($this->t_distribusi_id);
					$doc->exportCaption($this->source_id);
					$doc->exportCaption($this->destination_id);
					$doc->exportCaption($this->Jarak);
					$doc->exportCaption($this->Rate_O);
					$doc->exportCaption($this->Rate_D);
					$doc->exportCaption($this->Demand);
					$doc->exportCaption($this->sea_time);
					$doc->exportCaption($this->port_time);
					$doc->exportCaption($this->roundtrip_days);
					$doc->exportCaption($this->freqmaxbytrip);
					$doc->exportCaption($this->freqmaxbycargo);
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
						$doc->exportField($this->kapal_id);
						$doc->exportField($this->distribusi_id);
						$doc->exportField($this->kapal0_id);
						$doc->exportField($this->kapal0_nama);
						$doc->exportField($this->kapaldetail_id);
						$doc->exportField($this->Payload);
						$doc->exportField($this->DischRate);
						$doc->exportField($this->TCH);
						$doc->exportField($this->VarCost);
						$doc->exportField($this->VsLaden);
						$doc->exportField($this->VsBallast);
						$doc->exportField($this->ComDay);
						$doc->exportField($this->t_distribusi_id);
						$doc->exportField($this->source_id);
						$doc->exportField($this->destination_id);
						$doc->exportField($this->Jarak);
						$doc->exportField($this->Rate_O);
						$doc->exportField($this->Rate_D);
						$doc->exportField($this->Demand);
						$doc->exportField($this->sea_time);
						$doc->exportField($this->port_time);
						$doc->exportField($this->roundtrip_days);
						$doc->exportField($this->freqmaxbytrip);
						$doc->exportField($this->freqmaxbycargo);
					} else {
						$doc->exportField($this->kapal_id);
						$doc->exportField($this->distribusi_id);
						$doc->exportField($this->kapal0_id);
						$doc->exportField($this->kapal0_nama);
						$doc->exportField($this->kapaldetail_id);
						$doc->exportField($this->Payload);
						$doc->exportField($this->DischRate);
						$doc->exportField($this->TCH);
						$doc->exportField($this->VarCost);
						$doc->exportField($this->VsLaden);
						$doc->exportField($this->VsBallast);
						$doc->exportField($this->ComDay);
						$doc->exportField($this->t_distribusi_id);
						$doc->exportField($this->source_id);
						$doc->exportField($this->destination_id);
						$doc->exportField($this->Jarak);
						$doc->exportField($this->Rate_O);
						$doc->exportField($this->Rate_D);
						$doc->exportField($this->Demand);
						$doc->exportField($this->sea_time);
						$doc->exportField($this->port_time);
						$doc->exportField($this->roundtrip_days);
						$doc->exportField($this->freqmaxbytrip);
						$doc->exportField($this->freqmaxbycargo);
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