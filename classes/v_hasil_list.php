<?php
namespace PHPMaker2020\project1;

/**
 * Page class
 */
class v_hasil_list extends v_hasil
{

	// Page ID
	public $PageID = "list";

	// Project ID
	public $ProjectID = "{1AAD1A73-56B4-43BC-A714-7268915FE311}";

	// Table name
	public $TableName = 'v_hasil';

	// Page object name
	public $PageObjName = "v_hasil_list";

	// Grid form hidden field names
	public $FormName = "fv_hasillist";
	public $FormActionName = "k_action";
	public $FormKeyName = "k_key";
	public $FormOldKeyName = "k_oldkey";
	public $FormBlankRowName = "k_blankrow";
	public $FormKeyCountName = "key_count";

	// Page URLs
	public $AddUrl;
	public $EditUrl;
	public $CopyUrl;
	public $DeleteUrl;
	public $ViewUrl;
	public $ListUrl;

	// Export URLs
	public $ExportPrintUrl;
	public $ExportHtmlUrl;
	public $ExportExcelUrl;
	public $ExportWordUrl;
	public $ExportXmlUrl;
	public $ExportCsvUrl;
	public $ExportPdfUrl;

	// Custom export
	public $ExportExcelCustom = FALSE;
	public $ExportWordCustom = FALSE;
	public $ExportPdfCustom = FALSE;
	public $ExportEmailCustom = FALSE;

	// Update URLs
	public $InlineAddUrl;
	public $InlineCopyUrl;
	public $InlineEditUrl;
	public $GridAddUrl;
	public $GridEditUrl;
	public $MultiDeleteUrl;
	public $MultiUpdateUrl;

	// Page headings
	public $Heading = "";
	public $Subheading = "";
	public $PageHeader;
	public $PageFooter;

	// Token
	public $Token = "";
	public $TokenTimeout = 0;
	public $CheckToken;

	// Page heading
	public function pageHeading()
	{
		global $Language;
		if ($this->Heading != "")
			return $this->Heading;
		if (method_exists($this, "tableCaption"))
			return $this->tableCaption();
		return "";
	}

	// Page subheading
	public function pageSubheading()
	{
		global $Language;
		if ($this->Subheading != "")
			return $this->Subheading;
		if ($this->TableName)
			return $Language->phrase($this->PageID);
		return "";
	}

	// Page name
	public function pageName()
	{
		return CurrentPageName();
	}

	// Page URL
	public function pageUrl()
	{
		$url = CurrentPageName() . "?";
		if ($this->UseTokenInUrl)
			$url .= "t=" . $this->TableVar . "&"; // Add page token
		return $url;
	}

	// Messages
	private $_message = "";
	private $_failureMessage = "";
	private $_successMessage = "";
	private $_warningMessage = "";

	// Get message
	public function getMessage()
	{
		return isset($_SESSION[SESSION_MESSAGE]) ? $_SESSION[SESSION_MESSAGE] : $this->_message;
	}

	// Set message
	public function setMessage($v)
	{
		AddMessage($this->_message, $v);
		$_SESSION[SESSION_MESSAGE] = $this->_message;
	}

	// Get failure message
	public function getFailureMessage()
	{
		return isset($_SESSION[SESSION_FAILURE_MESSAGE]) ? $_SESSION[SESSION_FAILURE_MESSAGE] : $this->_failureMessage;
	}

	// Set failure message
	public function setFailureMessage($v)
	{
		AddMessage($this->_failureMessage, $v);
		$_SESSION[SESSION_FAILURE_MESSAGE] = $this->_failureMessage;
	}

	// Get success message
	public function getSuccessMessage()
	{
		return isset($_SESSION[SESSION_SUCCESS_MESSAGE]) ? $_SESSION[SESSION_SUCCESS_MESSAGE] : $this->_successMessage;
	}

	// Set success message
	public function setSuccessMessage($v)
	{
		AddMessage($this->_successMessage, $v);
		$_SESSION[SESSION_SUCCESS_MESSAGE] = $this->_successMessage;
	}

	// Get warning message
	public function getWarningMessage()
	{
		return isset($_SESSION[SESSION_WARNING_MESSAGE]) ? $_SESSION[SESSION_WARNING_MESSAGE] : $this->_warningMessage;
	}

	// Set warning message
	public function setWarningMessage($v)
	{
		AddMessage($this->_warningMessage, $v);
		$_SESSION[SESSION_WARNING_MESSAGE] = $this->_warningMessage;
	}

	// Clear message
	public function clearMessage()
	{
		$this->_message = "";
		$_SESSION[SESSION_MESSAGE] = "";
	}

	// Clear failure message
	public function clearFailureMessage()
	{
		$this->_failureMessage = "";
		$_SESSION[SESSION_FAILURE_MESSAGE] = "";
	}

	// Clear success message
	public function clearSuccessMessage()
	{
		$this->_successMessage = "";
		$_SESSION[SESSION_SUCCESS_MESSAGE] = "";
	}

	// Clear warning message
	public function clearWarningMessage()
	{
		$this->_warningMessage = "";
		$_SESSION[SESSION_WARNING_MESSAGE] = "";
	}

	// Clear messages
	public function clearMessages()
	{
		$this->clearMessage();
		$this->clearFailureMessage();
		$this->clearSuccessMessage();
		$this->clearWarningMessage();
	}

	// Show message
	public function showMessage()
	{
		$hidden = TRUE;
		$html = "";

		// Message
		$message = $this->getMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($message, "");
		if ($message != "") { // Message in Session, display
			if (!$hidden)
				$message = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $message;
			$html .= '<div class="alert alert-info alert-dismissible ew-info"><i class="icon fas fa-info"></i>' . $message . '</div>';
			$_SESSION[SESSION_MESSAGE] = ""; // Clear message in Session
		}

		// Warning message
		$warningMessage = $this->getWarningMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($warningMessage, "warning");
		if ($warningMessage != "") { // Message in Session, display
			if (!$hidden)
				$warningMessage = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $warningMessage;
			$html .= '<div class="alert alert-warning alert-dismissible ew-warning"><i class="icon fas fa-exclamation"></i>' . $warningMessage . '</div>';
			$_SESSION[SESSION_WARNING_MESSAGE] = ""; // Clear message in Session
		}

		// Success message
		$successMessage = $this->getSuccessMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($successMessage, "success");
		if ($successMessage != "") { // Message in Session, display
			if (!$hidden)
				$successMessage = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $successMessage;
			$html .= '<div class="alert alert-success alert-dismissible ew-success"><i class="icon fas fa-check"></i>' . $successMessage . '</div>';
			$_SESSION[SESSION_SUCCESS_MESSAGE] = ""; // Clear message in Session
		}

		// Failure message
		$errorMessage = $this->getFailureMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($errorMessage, "failure");
		if ($errorMessage != "") { // Message in Session, display
			if (!$hidden)
				$errorMessage = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $errorMessage;
			$html .= '<div class="alert alert-danger alert-dismissible ew-error"><i class="icon fas fa-ban"></i>' . $errorMessage . '</div>';
			$_SESSION[SESSION_FAILURE_MESSAGE] = ""; // Clear message in Session
		}
		echo '<div class="ew-message-dialog' . (($hidden) ? ' d-none' : "") . '">' . $html . '</div>';
	}

	// Get message as array
	public function getMessages()
	{
		$ar = [];

		// Message
		$message = $this->getMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($message, "");

		if ($message != "") { // Message in Session, display
			$ar["message"] = $message;
			$_SESSION[SESSION_MESSAGE] = ""; // Clear message in Session
		}

		// Warning message
		$warningMessage = $this->getWarningMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($warningMessage, "warning");

		if ($warningMessage != "") { // Message in Session, display
			$ar["warningMessage"] = $warningMessage;
			$_SESSION[SESSION_WARNING_MESSAGE] = ""; // Clear message in Session
		}

		// Success message
		$successMessage = $this->getSuccessMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($successMessage, "success");

		if ($successMessage != "") { // Message in Session, display
			$ar["successMessage"] = $successMessage;
			$_SESSION[SESSION_SUCCESS_MESSAGE] = ""; // Clear message in Session
		}

		// Failure message
		$failureMessage = $this->getFailureMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($failureMessage, "failure");

		if ($failureMessage != "") { // Message in Session, display
			$ar["failureMessage"] = $failureMessage;
			$_SESSION[SESSION_FAILURE_MESSAGE] = ""; // Clear message in Session
		}
		return $ar;
	}

	// Show Page Header
	public function showPageHeader()
	{
		$header = $this->PageHeader;
		$this->Page_DataRendering($header);
		if ($header != "") { // Header exists, display
			echo '<p id="ew-page-header">' . $header . '</p>';
		}
	}

	// Show Page Footer
	public function showPageFooter()
	{
		$footer = $this->PageFooter;
		$this->Page_DataRendered($footer);
		if ($footer != "") { // Footer exists, display
			echo '<p id="ew-page-footer">' . $footer . '</p>';
		}
	}

	// Validate page request
	protected function isPageRequest()
	{
		global $CurrentForm;
		if ($this->UseTokenInUrl) {
			if ($CurrentForm)
				return ($this->TableVar == $CurrentForm->getValue("t"));
			if (Get("t") !== NULL)
				return ($this->TableVar == Get("t"));
		}
		return TRUE;
	}

	// Valid Post
	protected function validPost()
	{
		if (!$this->CheckToken || !IsPost() || IsApi())
			return TRUE;
		if (Post(Config("TOKEN_NAME")) === NULL)
			return FALSE;
		$fn = Config("CHECK_TOKEN_FUNC");
		if (is_callable($fn))
			return $fn(Post(Config("TOKEN_NAME")), $this->TokenTimeout);
		return FALSE;
	}

	// Create Token
	public function createToken()
	{
		global $CurrentToken;
		$fn = Config("CREATE_TOKEN_FUNC"); // Always create token, required by API file/lookup request
		if ($this->Token == "" && is_callable($fn)) // Create token
			$this->Token = $fn();
		$CurrentToken = $this->Token; // Save to global variable
	}

	// Constructor
	public function __construct()
	{
		global $Language, $DashboardReport;

		// Check token
		$this->CheckToken = Config("CHECK_TOKEN");

		// Initialize
		$GLOBALS["Page"] = &$this;
		$this->TokenTimeout = SessionTimeoutTime();

		// Language object
		if (!isset($Language))
			$Language = new Language();

		// Parent constuctor
		parent::__construct();

		// Table object (v_hasil)
		if (!isset($GLOBALS["v_hasil"]) || get_class($GLOBALS["v_hasil"]) == PROJECT_NAMESPACE . "v_hasil") {
			$GLOBALS["v_hasil"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["v_hasil"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->pageUrl() . "export=print";
		$this->ExportExcelUrl = $this->pageUrl() . "export=excel";
		$this->ExportWordUrl = $this->pageUrl() . "export=word";
		$this->ExportPdfUrl = $this->pageUrl() . "export=pdf";
		$this->ExportHtmlUrl = $this->pageUrl() . "export=html";
		$this->ExportXmlUrl = $this->pageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->pageUrl() . "export=csv";
		$this->AddUrl = "v_hasiladd.php";
		$this->InlineAddUrl = $this->pageUrl() . "action=add";
		$this->GridAddUrl = $this->pageUrl() . "action=gridadd";
		$this->GridEditUrl = $this->pageUrl() . "action=gridedit";
		$this->MultiDeleteUrl = "v_hasildelete.php";
		$this->MultiUpdateUrl = "v_hasilupdate.php";

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'list');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'v_hasil');

		// Start timer
		if (!isset($GLOBALS["DebugTimer"]))
			$GLOBALS["DebugTimer"] = new Timer();

		// Debug message
		LoadDebugMessage();

		// Open connection
		if (!isset($GLOBALS["Conn"]))
			$GLOBALS["Conn"] = $this->getConnection();

		// List options
		$this->ListOptions = new ListOptions();
		$this->ListOptions->TableVar = $this->TableVar;

		// Export options
		$this->ExportOptions = new ListOptions("div");
		$this->ExportOptions->TagClassName = "ew-export-option";

		// Import options
		$this->ImportOptions = new ListOptions("div");
		$this->ImportOptions->TagClassName = "ew-import-option";

		// Other options
		if (!$this->OtherOptions)
			$this->OtherOptions = new ListOptionsArray();
		$this->OtherOptions["addedit"] = new ListOptions("div");
		$this->OtherOptions["addedit"]->TagClassName = "ew-add-edit-option";
		$this->OtherOptions["detail"] = new ListOptions("div");
		$this->OtherOptions["detail"]->TagClassName = "ew-detail-option";
		$this->OtherOptions["action"] = new ListOptions("div");
		$this->OtherOptions["action"]->TagClassName = "ew-action-option";

		// Filter options
		$this->FilterOptions = new ListOptions("div");
		$this->FilterOptions->TagClassName = "ew-filter-option fv_hasillistsrch";

		// List actions
		$this->ListActions = new ListActions();
	}

	// Terminate page
	public function terminate($url = "")
	{
		global $ExportFileName, $TempImages, $DashboardReport;

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

		// Export
		global $v_hasil;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($v_hasil);
				$doc->Text = @$content;
				if ($this->isExport("email"))
					echo $this->exportEmail($doc->Text);
				else
					$doc->export();
				DeleteTempImages(); // Delete temp images
				exit();
			}
		}
		if (!IsApi())
			$this->Page_Redirecting($url);

		// Close connection
		CloseConnections();

		// Return for API
		if (IsApi()) {
			$res = $url === TRUE;
			if (!$res) // Show error
				WriteJson(array_merge(["success" => FALSE], $this->getMessages()));
			return;
		}

		// Go to URL if specified
		if ($url != "") {
			if (!Config("DEBUG") && ob_get_length())
				ob_end_clean();
			SaveDebugMessage();
			AddHeader("Location", $url);
		}
		exit();
	}

	// Get records from recordset
	protected function getRecordsFromRecordset($rs, $current = FALSE)
	{
		$rows = [];
		if (is_object($rs)) { // Recordset
			while ($rs && !$rs->EOF) {
				$this->loadRowValues($rs); // Set up DbValue/CurrentValue
				$row = $this->getRecordFromArray($rs->fields);
				if ($current)
					return $row;
				else
					$rows[] = $row;
				$rs->moveNext();
			}
		} elseif (is_array($rs)) {
			foreach ($rs as $ar) {
				$row = $this->getRecordFromArray($ar);
				if ($current)
					return $row;
				else
					$rows[] = $row;
			}
		}
		return $rows;
	}

	// Get record from array
	protected function getRecordFromArray($ar)
	{
		$row = [];
		if (is_array($ar)) {
			foreach ($ar as $fldname => $val) {
				if (array_key_exists($fldname, $this->fields) && ($this->fields[$fldname]->Visible || $this->fields[$fldname]->IsPrimaryKey)) { // Primary key or Visible
					$fld = &$this->fields[$fldname];
					if ($fld->HtmlTag == "FILE") { // Upload field
						if (EmptyValue($val)) {
							$row[$fldname] = NULL;
						} else {
							if ($fld->DataType == DATATYPE_BLOB) {
								$url = FullUrl(GetApiUrl(Config("API_FILE_ACTION"),
									Config("API_OBJECT_NAME") . "=" . $fld->TableVar . "&" .
									Config("API_FIELD_NAME") . "=" . $fld->Param . "&" .
									Config("API_KEY_NAME") . "=" . rawurlencode($this->getRecordKeyValue($ar)))); //*** need to add this? API may not be in the same folder
								$row[$fldname] = ["type" => ContentType($val), "url" => $url, "name" => $fld->Param . ContentExtension($val)];
							} elseif (!$fld->UploadMultiple || !ContainsString($val, Config("MULTIPLE_UPLOAD_SEPARATOR"))) { // Single file
								$url = FullUrl(GetApiUrl(Config("API_FILE_ACTION"),
									Config("API_OBJECT_NAME") . "=" . $fld->TableVar . "&" .
									"fn=" . Encrypt($fld->physicalUploadPath() . $val)));
								$row[$fldname] = ["type" => MimeContentType($val), "url" => $url, "name" => $val];
							} else { // Multiple files
								$files = explode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $val);
								$ar = [];
								foreach ($files as $file) {
									$url = FullUrl(GetApiUrl(Config("API_FILE_ACTION"),
										Config("API_OBJECT_NAME") . "=" . $fld->TableVar . "&" .
										"fn=" . Encrypt($fld->physicalUploadPath() . $file)));
									if (!EmptyValue($file))
										$ar[] = ["type" => MimeContentType($file), "url" => $url, "name" => $file];
								}
								$row[$fldname] = $ar;
							}
						}
					} else {
						if ($fld->DataType == DATATYPE_MEMO && $fld->MemoMaxLength > 0)
							$val = TruncateMemo($val, $fld->MemoMaxLength, $fld->TruncateMemoRemoveHtml);
						$row[$fldname] = $val;
					}
				}
			}
		}
		return $row;
	}

	// Get record key value from array
	protected function getRecordKeyValue($ar)
	{
		$key = "";
		if (is_array($ar)) {
			$key .= @$ar['kapal_id'] . Config("COMPOSITE_KEY_SEPARATOR");
			$key .= @$ar['distribusi_id'] . Config("COMPOSITE_KEY_SEPARATOR");
			$key .= @$ar['kapal0_id'] . Config("COMPOSITE_KEY_SEPARATOR");
			$key .= @$ar['kapaldetail_id'] . Config("COMPOSITE_KEY_SEPARATOR");
			$key .= @$ar['t_distribusi_id'];
		}
		return $key;
	}

	/**
	 * Hide fields for add/edit
	 *
	 * @return void
	 */
	protected function hideFieldsForAddEdit()
	{
		if ($this->isAdd() || $this->isCopy() || $this->isGridAdd())
			$this->kapal_id->Visible = FALSE;
		if ($this->isAdd() || $this->isCopy() || $this->isGridAdd())
			$this->distribusi_id->Visible = FALSE;
		if ($this->isAdd() || $this->isCopy() || $this->isGridAdd())
			$this->kapal0_id->Visible = FALSE;
		if ($this->isAdd() || $this->isCopy() || $this->isGridAdd())
			$this->kapaldetail_id->Visible = FALSE;
		if ($this->isAdd() || $this->isCopy() || $this->isGridAdd())
			$this->t_distribusi_id->Visible = FALSE;
	}

	// Lookup data
	public function lookup()
	{
		global $Language, $Security;
		if (!isset($Language))
			$Language = new Language(Config("LANGUAGE_FOLDER"), Post("language", ""));

		// Set up API request
		if (!ValidApiRequest())
			return FALSE;
		$this->setupApiSecurity();

		// Get lookup object
		$fieldName = Post("field");
		if (!array_key_exists($fieldName, $this->fields))
			return FALSE;
		$lookupField = $this->fields[$fieldName];
		$lookup = $lookupField->Lookup;
		if ($lookup === NULL)
			return FALSE;

		// Get lookup parameters
		$lookupType = Post("ajax", "unknown");
		$pageSize = -1;
		$offset = -1;
		$searchValue = "";
		if (SameText($lookupType, "modal")) {
			$searchValue = Post("sv", "");
			$pageSize = Post("recperpage", 10);
			$offset = Post("start", 0);
		} elseif (SameText($lookupType, "autosuggest")) {
			$searchValue = Param("q", "");
			$pageSize = Param("n", -1);
			$pageSize = is_numeric($pageSize) ? (int)$pageSize : -1;
			if ($pageSize <= 0)
				$pageSize = Config("AUTO_SUGGEST_MAX_ENTRIES");
			$start = Param("start", -1);
			$start = is_numeric($start) ? (int)$start : -1;
			$page = Param("page", -1);
			$page = is_numeric($page) ? (int)$page : -1;
			$offset = $start >= 0 ? $start : ($page > 0 && $pageSize > 0 ? ($page - 1) * $pageSize : 0);
		}
		$userSelect = Decrypt(Post("s", ""));
		$userFilter = Decrypt(Post("f", ""));
		$userOrderBy = Decrypt(Post("o", ""));
		$keys = Post("keys");
		$lookup->LookupType = $lookupType; // Lookup type
		if ($keys !== NULL) { // Selected records from modal
			if (is_array($keys))
				$keys = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $keys);
			$lookup->FilterFields = []; // Skip parent fields if any
			$lookup->FilterValues[] = $keys; // Lookup values
			$pageSize = -1; // Show all records
		} else { // Lookup values
			$lookup->FilterValues[] = Post("v0", Post("lookupValue", ""));
		}
		$cnt = is_array($lookup->FilterFields) ? count($lookup->FilterFields) : 0;
		for ($i = 1; $i <= $cnt; $i++)
			$lookup->FilterValues[] = Post("v" . $i, "");
		$lookup->SearchValue = $searchValue;
		$lookup->PageSize = $pageSize;
		$lookup->Offset = $offset;
		if ($userSelect != "")
			$lookup->UserSelect = $userSelect;
		if ($userFilter != "")
			$lookup->UserFilter = $userFilter;
		if ($userOrderBy != "")
			$lookup->UserOrderBy = $userOrderBy;
		$lookup->toJson($this); // Use settings from current page
	}

	// Set up API security
	public function setupApiSecurity()
	{
		global $Security;

		// Setup security for API request
	}

	// Class variables
	public $ListOptions; // List options
	public $ExportOptions; // Export options
	public $SearchOptions; // Search options
	public $OtherOptions; // Other options
	public $FilterOptions; // Filter options
	public $ImportOptions; // Import options
	public $ListActions; // List actions
	public $SelectedCount = 0;
	public $SelectedIndex = 0;
	public $DisplayRecords = 20;
	public $StartRecord;
	public $StopRecord;
	public $TotalRecords = 0;
	public $RecordRange = 10;
	public $PageSizes = "10,20,50,-1"; // Page sizes (comma separated)
	public $DefaultSearchWhere = ""; // Default search WHERE clause
	public $SearchWhere = ""; // Search WHERE clause
	public $SearchPanelClass = "ew-search-panel collapse show"; // Search Panel class
	public $SearchRowCount = 0; // For extended search
	public $SearchColumnCount = 0; // For extended search
	public $SearchFieldsPerRow = 1; // For extended search
	public $RecordCount = 0; // Record count
	public $EditRowCount;
	public $StartRowCount = 1;
	public $RowCount = 0;
	public $Attrs = []; // Row attributes and cell attributes
	public $RowIndex = 0; // Row index
	public $KeyCount = 0; // Key count
	public $RowAction = ""; // Row action
	public $RowOldKey = ""; // Row old key (for copy)
	public $MultiColumnClass = "col-sm";
	public $MultiColumnEditClass = "w-100";
	public $DbMasterFilter = ""; // Master filter
	public $DbDetailFilter = ""; // Detail filter
	public $MasterRecordExists;
	public $MultiSelectKey;
	public $Command;
	public $RestoreSearch = FALSE;
	public $DetailPages;
	public $OldRecordset;

	//
	// Page run
	//

	public function run()
	{
		global $ExportType, $CustomExportType, $ExportFileName, $UserProfile, $Language, $Security, $CurrentForm,
			$FormError, $SearchError;

		// User profile
		$UserProfile = new UserProfile();

		// Security
		if (ValidApiRequest()) { // API request
			$this->setupApiSecurity(); // Set up API Security
		} else {
			$Security = new AdvancedSecurity();
		}
		$this->CurrentAction = Param("action"); // Set up current action

		// Get grid add count
		$gridaddcnt = Get(Config("TABLE_GRID_ADD_ROW_COUNT"), "");
		if (is_numeric($gridaddcnt) && $gridaddcnt > 0)
			$this->GridAddRowCount = $gridaddcnt;

		// Set up list options
		$this->setupListOptions();
		$this->kapal_id->setVisibility();
		$this->distribusi_id->setVisibility();
		$this->kapal0_id->setVisibility();
		$this->kapal0_nama->setVisibility();
		$this->kapaldetail_id->setVisibility();
		$this->Payload->setVisibility();
		$this->DischRate->setVisibility();
		$this->TCH->setVisibility();
		$this->VarCost->setVisibility();
		$this->VsLaden->setVisibility();
		$this->VsBallast->setVisibility();
		$this->ComDay->setVisibility();
		$this->t_distribusi_id->setVisibility();
		$this->source_id->setVisibility();
		$this->destination_id->setVisibility();
		$this->Jarak->setVisibility();
		$this->Rate_O->setVisibility();
		$this->Rate_D->setVisibility();
		$this->Demand->setVisibility();
		$this->sea_time->setVisibility();
		$this->port_time->setVisibility();
		$this->roundtrip_days->setVisibility();
		$this->freqmaxbytrip->setVisibility();
		$this->freqmaxbycargo->setVisibility();
		$this->hideFieldsForAddEdit();

		// Global Page Loading event (in userfn*.php)
		Page_Loading();

		// Page Load event
		$this->Page_Load();

		// Check token
		if (!$this->validPost()) {
			Write($Language->phrase("InvalidPostRequest"));
			$this->terminate();
		}

		// Create Token
		$this->createToken();

		// Setup other options
		$this->setupOtherOptions();

		// Set up custom action (compatible with old version)
		foreach ($this->CustomActions as $name => $action)
			$this->ListActions->add($name, $action);

		// Show checkbox column if multiple action
		foreach ($this->ListActions->Items as $listaction) {
			if ($listaction->Select == ACTION_MULTIPLE && $listaction->Allow) {
				$this->ListOptions["checkbox"]->Visible = TRUE;
				break;
			}
		}

		// Set up lookup cache
		// Search filters

		$srchAdvanced = ""; // Advanced search filter
		$srchBasic = ""; // Basic search filter
		$filter = "";

		// Get command
		$this->Command = strtolower(Get("cmd"));
		if ($this->isPageRequest()) { // Validate request

			// Process list action first
			if ($this->processListAction()) // Ajax request
				$this->terminate();

			// Set up records per page
			$this->setupDisplayRecords();

			// Handle reset command
			$this->resetCmd();

			// Set up Breadcrumb
			if (!$this->isExport())
				$this->setupBreadcrumb();

			// Hide list options
			if ($this->isExport()) {
				$this->ListOptions->hideAllOptions(["sequence"]);
				$this->ListOptions->UseDropDownButton = FALSE; // Disable drop down button
				$this->ListOptions->UseButtonGroup = FALSE; // Disable button group
			} elseif ($this->isGridAdd() || $this->isGridEdit()) {
				$this->ListOptions->hideAllOptions();
				$this->ListOptions->UseDropDownButton = FALSE; // Disable drop down button
				$this->ListOptions->UseButtonGroup = FALSE; // Disable button group
			}

			// Hide options
			if ($this->isExport() || $this->CurrentAction) {
				$this->ExportOptions->hideAllOptions();
				$this->FilterOptions->hideAllOptions();
				$this->ImportOptions->hideAllOptions();
			}

			// Hide other options
			if ($this->isExport())
				$this->OtherOptions->hideAllOptions();

			// Get default search criteria
			AddFilter($this->DefaultSearchWhere, $this->basicSearchWhere(TRUE));

			// Get basic search values
			$this->loadBasicSearchValues();

			// Process filter list
			if ($this->processFilterList())
				$this->terminate();

			// Restore search parms from Session if not searching / reset / export
			if (($this->isExport() || $this->Command != "search" && $this->Command != "reset" && $this->Command != "resetall") && $this->Command != "json" && $this->checkSearchParms())
				$this->restoreSearchParms();

			// Call Recordset SearchValidated event
			$this->Recordset_SearchValidated();

			// Set up sorting order
			$this->setupSortOrder();

			// Get basic search criteria
			if ($SearchError == "")
				$srchBasic = $this->basicSearchWhere();
		}

		// Restore display records
		if ($this->Command != "json" && $this->getRecordsPerPage() != "") {
			$this->DisplayRecords = $this->getRecordsPerPage(); // Restore from Session
		} else {
			$this->DisplayRecords = 20; // Load default
			$this->setRecordsPerPage($this->DisplayRecords); // Save default to Session
		}

		// Load Sorting Order
		if ($this->Command != "json")
			$this->loadSortOrder();

		// Load search default if no existing search criteria
		if (!$this->checkSearchParms()) {

			// Load basic search from default
			$this->BasicSearch->loadDefault();
			if ($this->BasicSearch->Keyword != "")
				$srchBasic = $this->basicSearchWhere();
		}

		// Build search criteria
		AddFilter($this->SearchWhere, $srchAdvanced);
		AddFilter($this->SearchWhere, $srchBasic);

		// Call Recordset_Searching event
		$this->Recordset_Searching($this->SearchWhere);

		// Save search criteria
		if ($this->Command == "search" && !$this->RestoreSearch) {
			$this->setSearchWhere($this->SearchWhere); // Save to Session
			$this->StartRecord = 1; // Reset start record counter
			$this->setStartRecordNumber($this->StartRecord);
		} elseif ($this->Command != "json") {
			$this->SearchWhere = $this->getSearchWhere();
		}

		// Build filter
		$filter = "";
		AddFilter($filter, $this->DbDetailFilter);
		AddFilter($filter, $this->SearchWhere);

		// Set up filter
		if ($this->Command == "json") {
			$this->UseSessionForListSql = FALSE; // Do not use session for ListSQL
			$this->CurrentFilter = $filter;
		} else {
			$this->setSessionWhere($filter);
			$this->CurrentFilter = "";
		}
		if ($this->isGridAdd()) {
			$this->CurrentFilter = "0=1";
			$this->StartRecord = 1;
			$this->DisplayRecords = $this->GridAddRowCount;
			$this->TotalRecords = $this->DisplayRecords;
			$this->StopRecord = $this->DisplayRecords;
		} else {
			$selectLimit = $this->UseSelectLimit;
			if ($selectLimit) {
				$this->TotalRecords = $this->listRecordCount();
			} else {
				if ($this->Recordset = $this->loadRecordset())
					$this->TotalRecords = $this->Recordset->RecordCount();
			}
			$this->StartRecord = 1;
			if ($this->DisplayRecords <= 0 || ($this->isExport() && $this->ExportAll)) // Display all records
				$this->DisplayRecords = $this->TotalRecords;
			if (!($this->isExport() && $this->ExportAll)) // Set up start record position
				$this->setupStartRecord();
			if ($selectLimit)
				$this->Recordset = $this->loadRecordset($this->StartRecord - 1, $this->DisplayRecords);

			// Set no record found message
			if (!$this->CurrentAction && $this->TotalRecords == 0) {
				if ($this->SearchWhere == "0=101")
					$this->setWarningMessage($Language->phrase("EnterSearchCriteria"));
				else
					$this->setWarningMessage($Language->phrase("NoRecord"));
			}
		}

		// Search options
		$this->setupSearchOptions();

		// Set up search panel class
		if ($this->SearchWhere != "")
			AppendClass($this->SearchPanelClass, "show");

		// Normal return
		if (IsApi()) {
			$rows = $this->getRecordsFromRecordset($this->Recordset);
			$this->Recordset->close();
			WriteJson(["success" => TRUE, $this->TableVar => $rows, "totalRecordCount" => $this->TotalRecords]);
			$this->terminate(TRUE);
		}

		// Set up pager
		$this->Pager = new PrevNextPager($this->StartRecord, $this->getRecordsPerPage(), $this->TotalRecords, $this->PageSizes, $this->RecordRange, $this->AutoHidePager, $this->AutoHidePageSizeSelector);
	}

	// Set up number of records displayed per page
	protected function setupDisplayRecords()
	{
		$wrk = Get(Config("TABLE_REC_PER_PAGE"), "");
		if ($wrk != "") {
			if (is_numeric($wrk)) {
				$this->DisplayRecords = (int)$wrk;
			} else {
				if (SameText($wrk, "all")) { // Display all records
					$this->DisplayRecords = -1;
				} else {
					$this->DisplayRecords = 20; // Non-numeric, load default
				}
			}
			$this->setRecordsPerPage($this->DisplayRecords); // Save to Session

			// Reset start position
			$this->StartRecord = 1;
			$this->setStartRecordNumber($this->StartRecord);
		}
	}

	// Build filter for all keys
	protected function buildKeyFilter()
	{
		global $CurrentForm;
		$wrkFilter = "";

		// Update row index and get row key
		$rowindex = 1;
		$CurrentForm->Index = $rowindex;
		$thisKey = strval($CurrentForm->getValue($this->FormKeyName));
		while ($thisKey != "") {
			if ($this->setupKeyValues($thisKey)) {
				$filter = $this->getRecordFilter();
				if ($wrkFilter != "")
					$wrkFilter .= " OR ";
				$wrkFilter .= $filter;
			} else {
				$wrkFilter = "0=1";
				break;
			}

			// Update row index and get row key
			$rowindex++; // Next row
			$CurrentForm->Index = $rowindex;
			$thisKey = strval($CurrentForm->getValue($this->FormKeyName));
		}
		return $wrkFilter;
	}

	// Set up key values
	protected function setupKeyValues($key)
	{
		$arKeyFlds = explode(Config("COMPOSITE_KEY_SEPARATOR"), $key);
		if (count($arKeyFlds) >= 5) {
			$this->kapal_id->setOldValue($arKeyFlds[0]);
			if (!is_numeric($this->kapal_id->OldValue))
				return FALSE;
			$this->distribusi_id->setOldValue($arKeyFlds[1]);
			if (!is_numeric($this->distribusi_id->OldValue))
				return FALSE;
			$this->kapal0_id->setOldValue($arKeyFlds[2]);
			if (!is_numeric($this->kapal0_id->OldValue))
				return FALSE;
			$this->kapaldetail_id->setOldValue($arKeyFlds[3]);
			if (!is_numeric($this->kapaldetail_id->OldValue))
				return FALSE;
			$this->t_distribusi_id->setOldValue($arKeyFlds[4]);
			if (!is_numeric($this->t_distribusi_id->OldValue))
				return FALSE;
		}
		return TRUE;
	}

	// Get list of filters
	public function getFilterList()
	{
		global $UserProfile;

		// Initialize
		$filterList = "";
		$savedFilterList = "";
		$filterList = Concat($filterList, $this->kapal_id->AdvancedSearch->toJson(), ","); // Field kapal_id
		$filterList = Concat($filterList, $this->distribusi_id->AdvancedSearch->toJson(), ","); // Field distribusi_id
		$filterList = Concat($filterList, $this->kapal0_id->AdvancedSearch->toJson(), ","); // Field kapal0_id
		$filterList = Concat($filterList, $this->kapal0_nama->AdvancedSearch->toJson(), ","); // Field kapal0_nama
		$filterList = Concat($filterList, $this->kapaldetail_id->AdvancedSearch->toJson(), ","); // Field kapaldetail_id
		$filterList = Concat($filterList, $this->Payload->AdvancedSearch->toJson(), ","); // Field Payload
		$filterList = Concat($filterList, $this->DischRate->AdvancedSearch->toJson(), ","); // Field DischRate
		$filterList = Concat($filterList, $this->TCH->AdvancedSearch->toJson(), ","); // Field TCH
		$filterList = Concat($filterList, $this->VarCost->AdvancedSearch->toJson(), ","); // Field VarCost
		$filterList = Concat($filterList, $this->VsLaden->AdvancedSearch->toJson(), ","); // Field VsLaden
		$filterList = Concat($filterList, $this->VsBallast->AdvancedSearch->toJson(), ","); // Field VsBallast
		$filterList = Concat($filterList, $this->ComDay->AdvancedSearch->toJson(), ","); // Field ComDay
		$filterList = Concat($filterList, $this->t_distribusi_id->AdvancedSearch->toJson(), ","); // Field t_distribusi_id
		$filterList = Concat($filterList, $this->source_id->AdvancedSearch->toJson(), ","); // Field source_id
		$filterList = Concat($filterList, $this->destination_id->AdvancedSearch->toJson(), ","); // Field destination_id
		$filterList = Concat($filterList, $this->Jarak->AdvancedSearch->toJson(), ","); // Field Jarak
		$filterList = Concat($filterList, $this->Rate_O->AdvancedSearch->toJson(), ","); // Field Rate_O
		$filterList = Concat($filterList, $this->Rate_D->AdvancedSearch->toJson(), ","); // Field Rate_D
		$filterList = Concat($filterList, $this->Demand->AdvancedSearch->toJson(), ","); // Field Demand
		$filterList = Concat($filterList, $this->sea_time->AdvancedSearch->toJson(), ","); // Field sea_time
		$filterList = Concat($filterList, $this->port_time->AdvancedSearch->toJson(), ","); // Field port_time
		$filterList = Concat($filterList, $this->roundtrip_days->AdvancedSearch->toJson(), ","); // Field roundtrip_days
		$filterList = Concat($filterList, $this->freqmaxbytrip->AdvancedSearch->toJson(), ","); // Field freqmaxbytrip
		$filterList = Concat($filterList, $this->freqmaxbycargo->AdvancedSearch->toJson(), ","); // Field freqmaxbycargo
		if ($this->BasicSearch->Keyword != "") {
			$wrk = "\"" . Config("TABLE_BASIC_SEARCH") . "\":\"" . JsEncode($this->BasicSearch->Keyword) . "\",\"" . Config("TABLE_BASIC_SEARCH_TYPE") . "\":\"" . JsEncode($this->BasicSearch->Type) . "\"";
			$filterList = Concat($filterList, $wrk, ",");
		}

		// Return filter list in JSON
		if ($filterList != "")
			$filterList = "\"data\":{" . $filterList . "}";
		if ($savedFilterList != "")
			$filterList = Concat($filterList, "\"filters\":" . $savedFilterList, ",");
		return ($filterList != "") ? "{" . $filterList . "}" : "null";
	}

	// Process filter list
	protected function processFilterList()
	{
		global $UserProfile;
		if (Post("ajax") == "savefilters") { // Save filter request (Ajax)
			$filters = Post("filters");
			$UserProfile->setSearchFilters(CurrentUserName(), "fv_hasillistsrch", $filters);
			WriteJson([["success" => TRUE]]); // Success
			return TRUE;
		} elseif (Post("cmd") == "resetfilter") {
			$this->restoreFilterList();
		}
		return FALSE;
	}

	// Restore list of filters
	protected function restoreFilterList()
	{

		// Return if not reset filter
		if (Post("cmd") !== "resetfilter")
			return FALSE;
		$filter = json_decode(Post("filter"), TRUE);
		$this->Command = "search";

		// Field kapal_id
		$this->kapal_id->AdvancedSearch->SearchValue = @$filter["x_kapal_id"];
		$this->kapal_id->AdvancedSearch->SearchOperator = @$filter["z_kapal_id"];
		$this->kapal_id->AdvancedSearch->SearchCondition = @$filter["v_kapal_id"];
		$this->kapal_id->AdvancedSearch->SearchValue2 = @$filter["y_kapal_id"];
		$this->kapal_id->AdvancedSearch->SearchOperator2 = @$filter["w_kapal_id"];
		$this->kapal_id->AdvancedSearch->save();

		// Field distribusi_id
		$this->distribusi_id->AdvancedSearch->SearchValue = @$filter["x_distribusi_id"];
		$this->distribusi_id->AdvancedSearch->SearchOperator = @$filter["z_distribusi_id"];
		$this->distribusi_id->AdvancedSearch->SearchCondition = @$filter["v_distribusi_id"];
		$this->distribusi_id->AdvancedSearch->SearchValue2 = @$filter["y_distribusi_id"];
		$this->distribusi_id->AdvancedSearch->SearchOperator2 = @$filter["w_distribusi_id"];
		$this->distribusi_id->AdvancedSearch->save();

		// Field kapal0_id
		$this->kapal0_id->AdvancedSearch->SearchValue = @$filter["x_kapal0_id"];
		$this->kapal0_id->AdvancedSearch->SearchOperator = @$filter["z_kapal0_id"];
		$this->kapal0_id->AdvancedSearch->SearchCondition = @$filter["v_kapal0_id"];
		$this->kapal0_id->AdvancedSearch->SearchValue2 = @$filter["y_kapal0_id"];
		$this->kapal0_id->AdvancedSearch->SearchOperator2 = @$filter["w_kapal0_id"];
		$this->kapal0_id->AdvancedSearch->save();

		// Field kapal0_nama
		$this->kapal0_nama->AdvancedSearch->SearchValue = @$filter["x_kapal0_nama"];
		$this->kapal0_nama->AdvancedSearch->SearchOperator = @$filter["z_kapal0_nama"];
		$this->kapal0_nama->AdvancedSearch->SearchCondition = @$filter["v_kapal0_nama"];
		$this->kapal0_nama->AdvancedSearch->SearchValue2 = @$filter["y_kapal0_nama"];
		$this->kapal0_nama->AdvancedSearch->SearchOperator2 = @$filter["w_kapal0_nama"];
		$this->kapal0_nama->AdvancedSearch->save();

		// Field kapaldetail_id
		$this->kapaldetail_id->AdvancedSearch->SearchValue = @$filter["x_kapaldetail_id"];
		$this->kapaldetail_id->AdvancedSearch->SearchOperator = @$filter["z_kapaldetail_id"];
		$this->kapaldetail_id->AdvancedSearch->SearchCondition = @$filter["v_kapaldetail_id"];
		$this->kapaldetail_id->AdvancedSearch->SearchValue2 = @$filter["y_kapaldetail_id"];
		$this->kapaldetail_id->AdvancedSearch->SearchOperator2 = @$filter["w_kapaldetail_id"];
		$this->kapaldetail_id->AdvancedSearch->save();

		// Field Payload
		$this->Payload->AdvancedSearch->SearchValue = @$filter["x_Payload"];
		$this->Payload->AdvancedSearch->SearchOperator = @$filter["z_Payload"];
		$this->Payload->AdvancedSearch->SearchCondition = @$filter["v_Payload"];
		$this->Payload->AdvancedSearch->SearchValue2 = @$filter["y_Payload"];
		$this->Payload->AdvancedSearch->SearchOperator2 = @$filter["w_Payload"];
		$this->Payload->AdvancedSearch->save();

		// Field DischRate
		$this->DischRate->AdvancedSearch->SearchValue = @$filter["x_DischRate"];
		$this->DischRate->AdvancedSearch->SearchOperator = @$filter["z_DischRate"];
		$this->DischRate->AdvancedSearch->SearchCondition = @$filter["v_DischRate"];
		$this->DischRate->AdvancedSearch->SearchValue2 = @$filter["y_DischRate"];
		$this->DischRate->AdvancedSearch->SearchOperator2 = @$filter["w_DischRate"];
		$this->DischRate->AdvancedSearch->save();

		// Field TCH
		$this->TCH->AdvancedSearch->SearchValue = @$filter["x_TCH"];
		$this->TCH->AdvancedSearch->SearchOperator = @$filter["z_TCH"];
		$this->TCH->AdvancedSearch->SearchCondition = @$filter["v_TCH"];
		$this->TCH->AdvancedSearch->SearchValue2 = @$filter["y_TCH"];
		$this->TCH->AdvancedSearch->SearchOperator2 = @$filter["w_TCH"];
		$this->TCH->AdvancedSearch->save();

		// Field VarCost
		$this->VarCost->AdvancedSearch->SearchValue = @$filter["x_VarCost"];
		$this->VarCost->AdvancedSearch->SearchOperator = @$filter["z_VarCost"];
		$this->VarCost->AdvancedSearch->SearchCondition = @$filter["v_VarCost"];
		$this->VarCost->AdvancedSearch->SearchValue2 = @$filter["y_VarCost"];
		$this->VarCost->AdvancedSearch->SearchOperator2 = @$filter["w_VarCost"];
		$this->VarCost->AdvancedSearch->save();

		// Field VsLaden
		$this->VsLaden->AdvancedSearch->SearchValue = @$filter["x_VsLaden"];
		$this->VsLaden->AdvancedSearch->SearchOperator = @$filter["z_VsLaden"];
		$this->VsLaden->AdvancedSearch->SearchCondition = @$filter["v_VsLaden"];
		$this->VsLaden->AdvancedSearch->SearchValue2 = @$filter["y_VsLaden"];
		$this->VsLaden->AdvancedSearch->SearchOperator2 = @$filter["w_VsLaden"];
		$this->VsLaden->AdvancedSearch->save();

		// Field VsBallast
		$this->VsBallast->AdvancedSearch->SearchValue = @$filter["x_VsBallast"];
		$this->VsBallast->AdvancedSearch->SearchOperator = @$filter["z_VsBallast"];
		$this->VsBallast->AdvancedSearch->SearchCondition = @$filter["v_VsBallast"];
		$this->VsBallast->AdvancedSearch->SearchValue2 = @$filter["y_VsBallast"];
		$this->VsBallast->AdvancedSearch->SearchOperator2 = @$filter["w_VsBallast"];
		$this->VsBallast->AdvancedSearch->save();

		// Field ComDay
		$this->ComDay->AdvancedSearch->SearchValue = @$filter["x_ComDay"];
		$this->ComDay->AdvancedSearch->SearchOperator = @$filter["z_ComDay"];
		$this->ComDay->AdvancedSearch->SearchCondition = @$filter["v_ComDay"];
		$this->ComDay->AdvancedSearch->SearchValue2 = @$filter["y_ComDay"];
		$this->ComDay->AdvancedSearch->SearchOperator2 = @$filter["w_ComDay"];
		$this->ComDay->AdvancedSearch->save();

		// Field t_distribusi_id
		$this->t_distribusi_id->AdvancedSearch->SearchValue = @$filter["x_t_distribusi_id"];
		$this->t_distribusi_id->AdvancedSearch->SearchOperator = @$filter["z_t_distribusi_id"];
		$this->t_distribusi_id->AdvancedSearch->SearchCondition = @$filter["v_t_distribusi_id"];
		$this->t_distribusi_id->AdvancedSearch->SearchValue2 = @$filter["y_t_distribusi_id"];
		$this->t_distribusi_id->AdvancedSearch->SearchOperator2 = @$filter["w_t_distribusi_id"];
		$this->t_distribusi_id->AdvancedSearch->save();

		// Field source_id
		$this->source_id->AdvancedSearch->SearchValue = @$filter["x_source_id"];
		$this->source_id->AdvancedSearch->SearchOperator = @$filter["z_source_id"];
		$this->source_id->AdvancedSearch->SearchCondition = @$filter["v_source_id"];
		$this->source_id->AdvancedSearch->SearchValue2 = @$filter["y_source_id"];
		$this->source_id->AdvancedSearch->SearchOperator2 = @$filter["w_source_id"];
		$this->source_id->AdvancedSearch->save();

		// Field destination_id
		$this->destination_id->AdvancedSearch->SearchValue = @$filter["x_destination_id"];
		$this->destination_id->AdvancedSearch->SearchOperator = @$filter["z_destination_id"];
		$this->destination_id->AdvancedSearch->SearchCondition = @$filter["v_destination_id"];
		$this->destination_id->AdvancedSearch->SearchValue2 = @$filter["y_destination_id"];
		$this->destination_id->AdvancedSearch->SearchOperator2 = @$filter["w_destination_id"];
		$this->destination_id->AdvancedSearch->save();

		// Field Jarak
		$this->Jarak->AdvancedSearch->SearchValue = @$filter["x_Jarak"];
		$this->Jarak->AdvancedSearch->SearchOperator = @$filter["z_Jarak"];
		$this->Jarak->AdvancedSearch->SearchCondition = @$filter["v_Jarak"];
		$this->Jarak->AdvancedSearch->SearchValue2 = @$filter["y_Jarak"];
		$this->Jarak->AdvancedSearch->SearchOperator2 = @$filter["w_Jarak"];
		$this->Jarak->AdvancedSearch->save();

		// Field Rate_O
		$this->Rate_O->AdvancedSearch->SearchValue = @$filter["x_Rate_O"];
		$this->Rate_O->AdvancedSearch->SearchOperator = @$filter["z_Rate_O"];
		$this->Rate_O->AdvancedSearch->SearchCondition = @$filter["v_Rate_O"];
		$this->Rate_O->AdvancedSearch->SearchValue2 = @$filter["y_Rate_O"];
		$this->Rate_O->AdvancedSearch->SearchOperator2 = @$filter["w_Rate_O"];
		$this->Rate_O->AdvancedSearch->save();

		// Field Rate_D
		$this->Rate_D->AdvancedSearch->SearchValue = @$filter["x_Rate_D"];
		$this->Rate_D->AdvancedSearch->SearchOperator = @$filter["z_Rate_D"];
		$this->Rate_D->AdvancedSearch->SearchCondition = @$filter["v_Rate_D"];
		$this->Rate_D->AdvancedSearch->SearchValue2 = @$filter["y_Rate_D"];
		$this->Rate_D->AdvancedSearch->SearchOperator2 = @$filter["w_Rate_D"];
		$this->Rate_D->AdvancedSearch->save();

		// Field Demand
		$this->Demand->AdvancedSearch->SearchValue = @$filter["x_Demand"];
		$this->Demand->AdvancedSearch->SearchOperator = @$filter["z_Demand"];
		$this->Demand->AdvancedSearch->SearchCondition = @$filter["v_Demand"];
		$this->Demand->AdvancedSearch->SearchValue2 = @$filter["y_Demand"];
		$this->Demand->AdvancedSearch->SearchOperator2 = @$filter["w_Demand"];
		$this->Demand->AdvancedSearch->save();

		// Field sea_time
		$this->sea_time->AdvancedSearch->SearchValue = @$filter["x_sea_time"];
		$this->sea_time->AdvancedSearch->SearchOperator = @$filter["z_sea_time"];
		$this->sea_time->AdvancedSearch->SearchCondition = @$filter["v_sea_time"];
		$this->sea_time->AdvancedSearch->SearchValue2 = @$filter["y_sea_time"];
		$this->sea_time->AdvancedSearch->SearchOperator2 = @$filter["w_sea_time"];
		$this->sea_time->AdvancedSearch->save();

		// Field port_time
		$this->port_time->AdvancedSearch->SearchValue = @$filter["x_port_time"];
		$this->port_time->AdvancedSearch->SearchOperator = @$filter["z_port_time"];
		$this->port_time->AdvancedSearch->SearchCondition = @$filter["v_port_time"];
		$this->port_time->AdvancedSearch->SearchValue2 = @$filter["y_port_time"];
		$this->port_time->AdvancedSearch->SearchOperator2 = @$filter["w_port_time"];
		$this->port_time->AdvancedSearch->save();

		// Field roundtrip_days
		$this->roundtrip_days->AdvancedSearch->SearchValue = @$filter["x_roundtrip_days"];
		$this->roundtrip_days->AdvancedSearch->SearchOperator = @$filter["z_roundtrip_days"];
		$this->roundtrip_days->AdvancedSearch->SearchCondition = @$filter["v_roundtrip_days"];
		$this->roundtrip_days->AdvancedSearch->SearchValue2 = @$filter["y_roundtrip_days"];
		$this->roundtrip_days->AdvancedSearch->SearchOperator2 = @$filter["w_roundtrip_days"];
		$this->roundtrip_days->AdvancedSearch->save();

		// Field freqmaxbytrip
		$this->freqmaxbytrip->AdvancedSearch->SearchValue = @$filter["x_freqmaxbytrip"];
		$this->freqmaxbytrip->AdvancedSearch->SearchOperator = @$filter["z_freqmaxbytrip"];
		$this->freqmaxbytrip->AdvancedSearch->SearchCondition = @$filter["v_freqmaxbytrip"];
		$this->freqmaxbytrip->AdvancedSearch->SearchValue2 = @$filter["y_freqmaxbytrip"];
		$this->freqmaxbytrip->AdvancedSearch->SearchOperator2 = @$filter["w_freqmaxbytrip"];
		$this->freqmaxbytrip->AdvancedSearch->save();

		// Field freqmaxbycargo
		$this->freqmaxbycargo->AdvancedSearch->SearchValue = @$filter["x_freqmaxbycargo"];
		$this->freqmaxbycargo->AdvancedSearch->SearchOperator = @$filter["z_freqmaxbycargo"];
		$this->freqmaxbycargo->AdvancedSearch->SearchCondition = @$filter["v_freqmaxbycargo"];
		$this->freqmaxbycargo->AdvancedSearch->SearchValue2 = @$filter["y_freqmaxbycargo"];
		$this->freqmaxbycargo->AdvancedSearch->SearchOperator2 = @$filter["w_freqmaxbycargo"];
		$this->freqmaxbycargo->AdvancedSearch->save();
		$this->BasicSearch->setKeyword(@$filter[Config("TABLE_BASIC_SEARCH")]);
		$this->BasicSearch->setType(@$filter[Config("TABLE_BASIC_SEARCH_TYPE")]);
	}

	// Return basic search SQL
	protected function basicSearchSql($arKeywords, $type)
	{
		$where = "";
		$this->buildBasicSearchSql($where, $this->kapal0_nama, $arKeywords, $type);
		return $where;
	}

	// Build basic search SQL
	protected function buildBasicSearchSql(&$where, &$fld, $arKeywords, $type)
	{
		$defCond = ($type == "OR") ? "OR" : "AND";
		$arSql = []; // Array for SQL parts
		$arCond = []; // Array for search conditions
		$cnt = count($arKeywords);
		$j = 0; // Number of SQL parts
		for ($i = 0; $i < $cnt; $i++) {
			$keyword = $arKeywords[$i];
			$keyword = trim($keyword);
			if (Config("BASIC_SEARCH_IGNORE_PATTERN") != "") {
				$keyword = preg_replace(Config("BASIC_SEARCH_IGNORE_PATTERN"), "\\", $keyword);
				$ar = explode("\\", $keyword);
			} else {
				$ar = [$keyword];
			}
			foreach ($ar as $keyword) {
				if ($keyword != "") {
					$wrk = "";
					if ($keyword == "OR" && $type == "") {
						if ($j > 0)
							$arCond[$j - 1] = "OR";
					} elseif ($keyword == Config("NULL_VALUE")) {
						$wrk = $fld->Expression . " IS NULL";
					} elseif ($keyword == Config("NOT_NULL_VALUE")) {
						$wrk = $fld->Expression . " IS NOT NULL";
					} elseif ($fld->IsVirtual) {
						$wrk = $fld->VirtualExpression . Like(QuotedValue("%" . $keyword . "%", DATATYPE_STRING, $this->Dbid), $this->Dbid);
					} elseif ($fld->DataType != DATATYPE_NUMBER || is_numeric($keyword)) {
						$wrk = $fld->BasicSearchExpression . Like(QuotedValue("%" . $keyword . "%", DATATYPE_STRING, $this->Dbid), $this->Dbid);
					}
					if ($wrk != "") {
						$arSql[$j] = $wrk;
						$arCond[$j] = $defCond;
						$j += 1;
					}
				}
			}
		}
		$cnt = count($arSql);
		$quoted = FALSE;
		$sql = "";
		if ($cnt > 0) {
			for ($i = 0; $i < $cnt - 1; $i++) {
				if ($arCond[$i] == "OR") {
					if (!$quoted)
						$sql .= "(";
					$quoted = TRUE;
				}
				$sql .= $arSql[$i];
				if ($quoted && $arCond[$i] != "OR") {
					$sql .= ")";
					$quoted = FALSE;
				}
				$sql .= " " . $arCond[$i] . " ";
			}
			$sql .= $arSql[$cnt - 1];
			if ($quoted)
				$sql .= ")";
		}
		if ($sql != "") {
			if ($where != "")
				$where .= " OR ";
			$where .= "(" . $sql . ")";
		}
	}

	// Return basic search WHERE clause based on search keyword and type
	protected function basicSearchWhere($default = FALSE)
	{
		global $Security;
		$searchStr = "";
		$searchKeyword = ($default) ? $this->BasicSearch->KeywordDefault : $this->BasicSearch->Keyword;
		$searchType = ($default) ? $this->BasicSearch->TypeDefault : $this->BasicSearch->Type;

		// Get search SQL
		if ($searchKeyword != "") {
			$ar = $this->BasicSearch->keywordList($default);

			// Search keyword in any fields
			if (($searchType == "OR" || $searchType == "AND") && $this->BasicSearch->BasicSearchAnyFields) {
				foreach ($ar as $keyword) {
					if ($keyword != "") {
						if ($searchStr != "")
							$searchStr .= " " . $searchType . " ";
						$searchStr .= "(" . $this->basicSearchSql([$keyword], $searchType) . ")";
					}
				}
			} else {
				$searchStr = $this->basicSearchSql($ar, $searchType);
			}
			if (!$default && in_array($this->Command, ["", "reset", "resetall"]))
				$this->Command = "search";
		}
		if (!$default && $this->Command == "search") {
			$this->BasicSearch->setKeyword($searchKeyword);
			$this->BasicSearch->setType($searchType);
		}
		return $searchStr;
	}

	// Check if search parm exists
	protected function checkSearchParms()
	{

		// Check basic search
		if ($this->BasicSearch->issetSession())
			return TRUE;
		return FALSE;
	}

	// Clear all search parameters
	protected function resetSearchParms()
	{

		// Clear search WHERE clause
		$this->SearchWhere = "";
		$this->setSearchWhere($this->SearchWhere);

		// Clear basic search parameters
		$this->resetBasicSearchParms();
	}

	// Load advanced search default values
	protected function loadAdvancedSearchDefault()
	{
		return FALSE;
	}

	// Clear all basic search parameters
	protected function resetBasicSearchParms()
	{
		$this->BasicSearch->unsetSession();
	}

	// Restore all search parameters
	protected function restoreSearchParms()
	{
		$this->RestoreSearch = TRUE;

		// Restore basic search values
		$this->BasicSearch->load();
	}

	// Set up sort parameters
	protected function setupSortOrder()
	{

		// Check for "order" parameter
		if (Get("order") !== NULL) {
			$this->CurrentOrder = Get("order");
			$this->CurrentOrderType = Get("ordertype", "");
			$this->updateSort($this->kapal_id); // kapal_id
			$this->updateSort($this->distribusi_id); // distribusi_id
			$this->updateSort($this->kapal0_id); // kapal0_id
			$this->updateSort($this->kapal0_nama); // kapal0_nama
			$this->updateSort($this->kapaldetail_id); // kapaldetail_id
			$this->updateSort($this->Payload); // Payload
			$this->updateSort($this->DischRate); // DischRate
			$this->updateSort($this->TCH); // TCH
			$this->updateSort($this->VarCost); // VarCost
			$this->updateSort($this->VsLaden); // VsLaden
			$this->updateSort($this->VsBallast); // VsBallast
			$this->updateSort($this->ComDay); // ComDay
			$this->updateSort($this->t_distribusi_id); // t_distribusi_id
			$this->updateSort($this->source_id); // source_id
			$this->updateSort($this->destination_id); // destination_id
			$this->updateSort($this->Jarak); // Jarak
			$this->updateSort($this->Rate_O); // Rate_O
			$this->updateSort($this->Rate_D); // Rate_D
			$this->updateSort($this->Demand); // Demand
			$this->updateSort($this->sea_time); // sea_time
			$this->updateSort($this->port_time); // port_time
			$this->updateSort($this->roundtrip_days); // roundtrip_days
			$this->updateSort($this->freqmaxbytrip); // freqmaxbytrip
			$this->updateSort($this->freqmaxbycargo); // freqmaxbycargo
			$this->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	protected function loadSortOrder()
	{
		$orderBy = $this->getSessionOrderBy(); // Get ORDER BY from Session
		if ($orderBy == "") {
			if ($this->getSqlOrderBy() != "") {
				$orderBy = $this->getSqlOrderBy();
				$this->setSessionOrderBy($orderBy);
			}
		}
	}

	// Reset command
	// - cmd=reset (Reset search parameters)
	// - cmd=resetall (Reset search and master/detail parameters)
	// - cmd=resetsort (Reset sort parameters)

	protected function resetCmd()
	{

		// Check if reset command
		if (StartsString("reset", $this->Command)) {

			// Reset search criteria
			if ($this->Command == "reset" || $this->Command == "resetall")
				$this->resetSearchParms();

			// Reset sorting order
			if ($this->Command == "resetsort") {
				$orderBy = "";
				$this->setSessionOrderBy($orderBy);
				$this->kapal_id->setSort("");
				$this->distribusi_id->setSort("");
				$this->kapal0_id->setSort("");
				$this->kapal0_nama->setSort("");
				$this->kapaldetail_id->setSort("");
				$this->Payload->setSort("");
				$this->DischRate->setSort("");
				$this->TCH->setSort("");
				$this->VarCost->setSort("");
				$this->VsLaden->setSort("");
				$this->VsBallast->setSort("");
				$this->ComDay->setSort("");
				$this->t_distribusi_id->setSort("");
				$this->source_id->setSort("");
				$this->destination_id->setSort("");
				$this->Jarak->setSort("");
				$this->Rate_O->setSort("");
				$this->Rate_D->setSort("");
				$this->Demand->setSort("");
				$this->sea_time->setSort("");
				$this->port_time->setSort("");
				$this->roundtrip_days->setSort("");
				$this->freqmaxbytrip->setSort("");
				$this->freqmaxbycargo->setSort("");
			}

			// Reset start position
			$this->StartRecord = 1;
			$this->setStartRecordNumber($this->StartRecord);
		}
	}

	// Set up list options
	protected function setupListOptions()
	{
		global $Security, $Language;

		// Add group option item
		$item = &$this->ListOptions->add($this->ListOptions->GroupOptionName);
		$item->Body = "";
		$item->OnLeft = FALSE;
		$item->Visible = FALSE;

		// List actions
		$item = &$this->ListOptions->add("listactions");
		$item->CssClass = "text-nowrap";
		$item->OnLeft = FALSE;
		$item->Visible = FALSE;
		$item->ShowInButtonGroup = FALSE;
		$item->ShowInDropDown = FALSE;

		// "checkbox"
		$item = &$this->ListOptions->add("checkbox");
		$item->Visible = FALSE;
		$item->OnLeft = FALSE;
		$item->Header = "<div class=\"custom-control custom-checkbox d-inline-block\"><input type=\"checkbox\" name=\"key\" id=\"key\" class=\"custom-control-input\" onclick=\"ew.selectAllKey(this);\"><label class=\"custom-control-label\" for=\"key\"></label></div>";
		$item->ShowInDropDown = FALSE;
		$item->ShowInButtonGroup = FALSE;

		// Drop down button for ListOptions
		$this->ListOptions->UseDropDownButton = FALSE;
		$this->ListOptions->DropDownButtonPhrase = $Language->phrase("ButtonListOptions");
		$this->ListOptions->UseButtonGroup = FALSE;
		if ($this->ListOptions->UseButtonGroup && IsMobile())
			$this->ListOptions->UseDropDownButton = TRUE;

		//$this->ListOptions->ButtonClass = ""; // Class for button group
		// Call ListOptions_Load event

		$this->ListOptions_Load();
		$this->setupListOptionsExt();
		$item = $this->ListOptions[$this->ListOptions->GroupOptionName];
		$item->Visible = $this->ListOptions->groupOptionVisible();
	}

	// Render list options
	public function renderListOptions()
	{
		global $Security, $Language, $CurrentForm;
		$this->ListOptions->loadDefault();

		// Call ListOptions_Rendering event
		$this->ListOptions_Rendering();

		// Set up list action buttons
		$opt = $this->ListOptions["listactions"];
		if ($opt && !$this->isExport() && !$this->CurrentAction) {
			$body = "";
			$links = [];
			foreach ($this->ListActions->Items as $listaction) {
				if ($listaction->Select == ACTION_SINGLE && $listaction->Allow) {
					$action = $listaction->Action;
					$caption = $listaction->Caption;
					$icon = ($listaction->Icon != "") ? "<i class=\"" . HtmlEncode(str_replace(" ew-icon", "", $listaction->Icon)) . "\" data-caption=\"" . HtmlTitle($caption) . "\"></i> " : "";
					$links[] = "<li><a class=\"dropdown-item ew-action ew-list-action\" data-action=\"" . HtmlEncode($action) . "\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"#\" onclick=\"return ew.submitAction(event,jQuery.extend({key:" . $this->keyToJson(TRUE) . "}," . $listaction->toJson(TRUE) . "));\">" . $icon . $listaction->Caption . "</a></li>";
					if (count($links) == 1) // Single button
						$body = "<a class=\"ew-action ew-list-action\" data-action=\"" . HtmlEncode($action) . "\" title=\"" . HtmlTitle($caption) . "\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"#\" onclick=\"return ew.submitAction(event,jQuery.extend({key:" . $this->keyToJson(TRUE) . "}," . $listaction->toJson(TRUE) . "));\">" . $icon . $listaction->Caption . "</a>";
				}
			}
			if (count($links) > 1) { // More than one buttons, use dropdown
				$body = "<button class=\"dropdown-toggle btn btn-default ew-actions\" title=\"" . HtmlTitle($Language->phrase("ListActionButton")) . "\" data-toggle=\"dropdown\">" . $Language->phrase("ListActionButton") . "</button>";
				$content = "";
				foreach ($links as $link)
					$content .= "<li>" . $link . "</li>";
				$body .= "<ul class=\"dropdown-menu" . ($opt->OnLeft ? "" : " dropdown-menu-right") . "\">". $content . "</ul>";
				$body = "<div class=\"btn-group btn-group-sm\">" . $body . "</div>";
			}
			if (count($links) > 0) {
				$opt->Body = $body;
				$opt->Visible = TRUE;
			}
		}

		// "checkbox"
		$opt = $this->ListOptions["checkbox"];
		$opt->Body = "<div class=\"custom-control custom-checkbox d-inline-block\"><input type=\"checkbox\" id=\"key_m_" . $this->RowCount . "\" name=\"key_m[]\" class=\"custom-control-input ew-multi-select\" value=\"" . HtmlEncode($this->kapal_id->CurrentValue . Config("COMPOSITE_KEY_SEPARATOR") . $this->distribusi_id->CurrentValue . Config("COMPOSITE_KEY_SEPARATOR") . $this->kapal0_id->CurrentValue . Config("COMPOSITE_KEY_SEPARATOR") . $this->kapaldetail_id->CurrentValue . Config("COMPOSITE_KEY_SEPARATOR") . $this->t_distribusi_id->CurrentValue) . "\" onclick=\"ew.clickMultiCheckbox(event);\"><label class=\"custom-control-label\" for=\"key_m_" . $this->RowCount . "\"></label></div>";
		$this->renderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	// Set up other options
	protected function setupOtherOptions()
	{
		global $Language, $Security;
		$options = &$this->OtherOptions;
		$option = $options["action"];

		// Set up options default
		foreach ($options as $option) {
			$option->UseDropDownButton = FALSE;
			$option->UseButtonGroup = TRUE;

			//$option->ButtonClass = ""; // Class for button group
			$item = &$option->add($option->GroupOptionName);
			$item->Body = "";
			$item->Visible = FALSE;
		}
		$options["addedit"]->DropDownButtonPhrase = $Language->phrase("ButtonAddEdit");
		$options["detail"]->DropDownButtonPhrase = $Language->phrase("ButtonDetails");
		$options["action"]->DropDownButtonPhrase = $Language->phrase("ButtonActions");

		// Filter button
		$item = &$this->FilterOptions->add("savecurrentfilter");
		$item->Body = "<a class=\"ew-save-filter\" data-form=\"fv_hasillistsrch\" href=\"#\" onclick=\"return false;\">" . $Language->phrase("SaveCurrentFilter") . "</a>";
		$item->Visible = TRUE;
		$item = &$this->FilterOptions->add("deletefilter");
		$item->Body = "<a class=\"ew-delete-filter\" data-form=\"fv_hasillistsrch\" href=\"#\" onclick=\"return false;\">" . $Language->phrase("DeleteFilter") . "</a>";
		$item->Visible = TRUE;
		$this->FilterOptions->UseDropDownButton = TRUE;
		$this->FilterOptions->UseButtonGroup = !$this->FilterOptions->UseDropDownButton;
		$this->FilterOptions->DropDownButtonPhrase = $Language->phrase("Filters");

		// Add group option item
		$item = &$this->FilterOptions->add($this->FilterOptions->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;
	}

	// Render other options
	public function renderOtherOptions()
	{
		global $Language, $Security;
		$options = &$this->OtherOptions;
			$option = $options["action"];

			// Set up list action buttons
			foreach ($this->ListActions->Items as $listaction) {
				if ($listaction->Select == ACTION_MULTIPLE) {
					$item = &$option->add("custom_" . $listaction->Action);
					$caption = $listaction->Caption;
					$icon = ($listaction->Icon != "") ? "<i class=\"" . HtmlEncode($listaction->Icon) . "\" data-caption=\"" . HtmlEncode($caption) . "\"></i> " . $caption : $caption;
					$item->Body = "<a class=\"ew-action ew-list-action\" title=\"" . HtmlEncode($caption) . "\" data-caption=\"" . HtmlEncode($caption) . "\" href=\"#\" onclick=\"return ew.submitAction(event,jQuery.extend({f:document.fv_hasillist}," . $listaction->toJson(TRUE) . "));\">" . $icon . "</a>";
					$item->Visible = $listaction->Allow;
				}
			}

			// Hide grid edit and other options
			if ($this->TotalRecords <= 0) {
				$option = $options["addedit"];
				$item = $option["gridedit"];
				if ($item)
					$item->Visible = FALSE;
				$option = $options["action"];
				$option->hideAllOptions();
			}
	}

	// Process list action
	protected function processListAction()
	{
		global $Language, $Security;
		$userlist = "";
		$user = "";
		$filter = $this->getFilterFromRecordKeys();
		$userAction = Post("useraction", "");
		if ($filter != "" && $userAction != "") {

			// Check permission first
			$actionCaption = $userAction;
			if (array_key_exists($userAction, $this->ListActions->Items)) {
				$actionCaption = $this->ListActions[$userAction]->Caption;
				if (!$this->ListActions[$userAction]->Allow) {
					$errmsg = str_replace('%s', $actionCaption, $Language->phrase("CustomActionNotAllowed"));
					if (Post("ajax") == $userAction) // Ajax
						echo "<p class=\"text-danger\">" . $errmsg . "</p>";
					else
						$this->setFailureMessage($errmsg);
					return FALSE;
				}
			}
			$this->CurrentFilter = $filter;
			$sql = $this->getCurrentSql();
			$conn = $this->getConnection();
			$conn->raiseErrorFn = Config("ERROR_FUNC");
			$rs = $conn->execute($sql);
			$conn->raiseErrorFn = "";
			$this->CurrentAction = $userAction;

			// Call row action event
			if ($rs && !$rs->EOF) {
				$conn->beginTrans();
				$this->SelectedCount = $rs->RecordCount();
				$this->SelectedIndex = 0;
				while (!$rs->EOF) {
					$this->SelectedIndex++;
					$row = $rs->fields;
					$processed = $this->Row_CustomAction($userAction, $row);
					if (!$processed)
						break;
					$rs->moveNext();
				}
				if ($processed) {
					$conn->commitTrans(); // Commit the changes
					if ($this->getSuccessMessage() == "" && !ob_get_length()) // No output
						$this->setSuccessMessage(str_replace('%s', $actionCaption, $Language->phrase("CustomActionCompleted"))); // Set up success message
				} else {
					$conn->rollbackTrans(); // Rollback changes

					// Set up error message
					if ($this->getSuccessMessage() != "" || $this->getFailureMessage() != "") {

						// Use the message, do nothing
					} elseif ($this->CancelMessage != "") {
						$this->setFailureMessage($this->CancelMessage);
						$this->CancelMessage = "";
					} else {
						$this->setFailureMessage(str_replace('%s', $actionCaption, $Language->phrase("CustomActionFailed")));
					}
				}
			}
			if ($rs)
				$rs->close();
			$this->CurrentAction = ""; // Clear action
			if (Post("ajax") == $userAction) { // Ajax
				if ($this->getSuccessMessage() != "") {
					echo "<p class=\"text-success\">" . $this->getSuccessMessage() . "</p>";
					$this->clearSuccessMessage(); // Clear message
				}
				if ($this->getFailureMessage() != "") {
					echo "<p class=\"text-danger\">" . $this->getFailureMessage() . "</p>";
					$this->clearFailureMessage(); // Clear message
				}
				return TRUE;
			}
		}
		return FALSE; // Not ajax request
	}

	// Set up list options (extended codes)
	protected function setupListOptionsExt()
	{
	}

	// Render list options (extended codes)
	protected function renderListOptionsExt()
	{
	}

	// Load basic search values
	protected function loadBasicSearchValues()
	{
		$this->BasicSearch->setKeyword(Get(Config("TABLE_BASIC_SEARCH"), ""), FALSE);
		if ($this->BasicSearch->Keyword != "" && $this->Command == "")
			$this->Command = "search";
		$this->BasicSearch->setType(Get(Config("TABLE_BASIC_SEARCH_TYPE"), ""), FALSE);
	}

	// Load recordset
	public function loadRecordset($offset = -1, $rowcnt = -1)
	{

		// Load List page SQL
		$sql = $this->getListSql();
		$conn = $this->getConnection();

		// Load recordset
		$dbtype = GetConnectionType($this->Dbid);
		if ($this->UseSelectLimit) {
			$conn->raiseErrorFn = Config("ERROR_FUNC");
			if ($dbtype == "MSSQL") {
				$rs = $conn->selectLimit($sql, $rowcnt, $offset, ["_hasOrderBy" => trim($this->getOrderBy()) || trim($this->getSessionOrderBy())]);
			} else {
				$rs = $conn->selectLimit($sql, $rowcnt, $offset);
			}
			$conn->raiseErrorFn = "";
		} else {
			$rs = LoadRecordset($sql, $conn);
		}

		// Call Recordset Selected event
		$this->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	public function loadRow()
	{
		global $Security, $Language;
		$filter = $this->getRecordFilter();

		// Call Row Selecting event
		$this->Row_Selecting($filter);

		// Load SQL based on filter
		$this->CurrentFilter = $filter;
		$sql = $this->getCurrentSql();
		$conn = $this->getConnection();
		$res = FALSE;
		$rs = LoadRecordset($sql, $conn);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->loadRowValues($rs); // Load row values
			$rs->close();
		}
		return $res;
	}

	// Load row values from recordset
	public function loadRowValues($rs = NULL)
	{
		if ($rs && !$rs->EOF)
			$row = $rs->fields;
		else
			$row = $this->newRow();

		// Call Row Selected event
		$this->Row_Selected($row);
		if (!$rs || $rs->EOF)
			return;
		$this->kapal_id->setDbValue($row['kapal_id']);
		$this->distribusi_id->setDbValue($row['distribusi_id']);
		$this->kapal0_id->setDbValue($row['kapal0_id']);
		$this->kapal0_nama->setDbValue($row['kapal0_nama']);
		$this->kapaldetail_id->setDbValue($row['kapaldetail_id']);
		$this->Payload->setDbValue($row['Payload']);
		$this->DischRate->setDbValue($row['DischRate']);
		$this->TCH->setDbValue($row['TCH']);
		$this->VarCost->setDbValue($row['VarCost']);
		$this->VsLaden->setDbValue($row['VsLaden']);
		$this->VsBallast->setDbValue($row['VsBallast']);
		$this->ComDay->setDbValue($row['ComDay']);
		$this->t_distribusi_id->setDbValue($row['t_distribusi_id']);
		$this->source_id->setDbValue($row['source_id']);
		$this->destination_id->setDbValue($row['destination_id']);
		$this->Jarak->setDbValue($row['Jarak']);
		$this->Rate_O->setDbValue($row['Rate_O']);
		$this->Rate_D->setDbValue($row['Rate_D']);
		$this->Demand->setDbValue($row['Demand']);
		$this->sea_time->setDbValue($row['sea_time']);
		$this->port_time->setDbValue($row['port_time']);
		$this->roundtrip_days->setDbValue($row['roundtrip_days']);
		$this->freqmaxbytrip->setDbValue($row['freqmaxbytrip']);
		$this->freqmaxbycargo->setDbValue($row['freqmaxbycargo']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$row = [];
		$row['kapal_id'] = NULL;
		$row['distribusi_id'] = NULL;
		$row['kapal0_id'] = NULL;
		$row['kapal0_nama'] = NULL;
		$row['kapaldetail_id'] = NULL;
		$row['Payload'] = NULL;
		$row['DischRate'] = NULL;
		$row['TCH'] = NULL;
		$row['VarCost'] = NULL;
		$row['VsLaden'] = NULL;
		$row['VsBallast'] = NULL;
		$row['ComDay'] = NULL;
		$row['t_distribusi_id'] = NULL;
		$row['source_id'] = NULL;
		$row['destination_id'] = NULL;
		$row['Jarak'] = NULL;
		$row['Rate_O'] = NULL;
		$row['Rate_D'] = NULL;
		$row['Demand'] = NULL;
		$row['sea_time'] = NULL;
		$row['port_time'] = NULL;
		$row['roundtrip_days'] = NULL;
		$row['freqmaxbytrip'] = NULL;
		$row['freqmaxbycargo'] = NULL;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("kapal_id")) != "")
			$this->kapal_id->OldValue = $this->getKey("kapal_id"); // kapal_id
		else
			$validKey = FALSE;
		if (strval($this->getKey("distribusi_id")) != "")
			$this->distribusi_id->OldValue = $this->getKey("distribusi_id"); // distribusi_id
		else
			$validKey = FALSE;
		if (strval($this->getKey("kapal0_id")) != "")
			$this->kapal0_id->OldValue = $this->getKey("kapal0_id"); // kapal0_id
		else
			$validKey = FALSE;
		if (strval($this->getKey("kapaldetail_id")) != "")
			$this->kapaldetail_id->OldValue = $this->getKey("kapaldetail_id"); // kapaldetail_id
		else
			$validKey = FALSE;
		if (strval($this->getKey("t_distribusi_id")) != "")
			$this->t_distribusi_id->OldValue = $this->getKey("t_distribusi_id"); // t_distribusi_id
		else
			$validKey = FALSE;

		// Load old record
		$this->OldRecordset = NULL;
		if ($validKey) {
			$this->CurrentFilter = $this->getRecordFilter();
			$sql = $this->getCurrentSql();
			$conn = $this->getConnection();
			$this->OldRecordset = LoadRecordset($sql, $conn);
		}
		$this->loadRowValues($this->OldRecordset); // Load row values
		return $validKey;
	}

	// Render row values based on field settings
	public function renderRow()
	{
		global $Security, $Language, $CurrentLanguage;

		// Initialize URLs
		$this->ViewUrl = $this->getViewUrl();
		$this->EditUrl = $this->getEditUrl();
		$this->InlineEditUrl = $this->getInlineEditUrl();
		$this->CopyUrl = $this->getCopyUrl();
		$this->InlineCopyUrl = $this->getInlineCopyUrl();
		$this->DeleteUrl = $this->getDeleteUrl();

		// Convert decimal values if posted back
		if ($this->Payload->FormValue == $this->Payload->CurrentValue && is_numeric(ConvertToFloatString($this->Payload->CurrentValue)))
			$this->Payload->CurrentValue = ConvertToFloatString($this->Payload->CurrentValue);

		// Convert decimal values if posted back
		if ($this->DischRate->FormValue == $this->DischRate->CurrentValue && is_numeric(ConvertToFloatString($this->DischRate->CurrentValue)))
			$this->DischRate->CurrentValue = ConvertToFloatString($this->DischRate->CurrentValue);

		// Convert decimal values if posted back
		if ($this->TCH->FormValue == $this->TCH->CurrentValue && is_numeric(ConvertToFloatString($this->TCH->CurrentValue)))
			$this->TCH->CurrentValue = ConvertToFloatString($this->TCH->CurrentValue);

		// Convert decimal values if posted back
		if ($this->VarCost->FormValue == $this->VarCost->CurrentValue && is_numeric(ConvertToFloatString($this->VarCost->CurrentValue)))
			$this->VarCost->CurrentValue = ConvertToFloatString($this->VarCost->CurrentValue);

		// Convert decimal values if posted back
		if ($this->VsLaden->FormValue == $this->VsLaden->CurrentValue && is_numeric(ConvertToFloatString($this->VsLaden->CurrentValue)))
			$this->VsLaden->CurrentValue = ConvertToFloatString($this->VsLaden->CurrentValue);

		// Convert decimal values if posted back
		if ($this->VsBallast->FormValue == $this->VsBallast->CurrentValue && is_numeric(ConvertToFloatString($this->VsBallast->CurrentValue)))
			$this->VsBallast->CurrentValue = ConvertToFloatString($this->VsBallast->CurrentValue);

		// Convert decimal values if posted back
		if ($this->ComDay->FormValue == $this->ComDay->CurrentValue && is_numeric(ConvertToFloatString($this->ComDay->CurrentValue)))
			$this->ComDay->CurrentValue = ConvertToFloatString($this->ComDay->CurrentValue);

		// Convert decimal values if posted back
		if ($this->Jarak->FormValue == $this->Jarak->CurrentValue && is_numeric(ConvertToFloatString($this->Jarak->CurrentValue)))
			$this->Jarak->CurrentValue = ConvertToFloatString($this->Jarak->CurrentValue);

		// Convert decimal values if posted back
		if ($this->Rate_O->FormValue == $this->Rate_O->CurrentValue && is_numeric(ConvertToFloatString($this->Rate_O->CurrentValue)))
			$this->Rate_O->CurrentValue = ConvertToFloatString($this->Rate_O->CurrentValue);

		// Convert decimal values if posted back
		if ($this->Rate_D->FormValue == $this->Rate_D->CurrentValue && is_numeric(ConvertToFloatString($this->Rate_D->CurrentValue)))
			$this->Rate_D->CurrentValue = ConvertToFloatString($this->Rate_D->CurrentValue);

		// Convert decimal values if posted back
		if ($this->Demand->FormValue == $this->Demand->CurrentValue && is_numeric(ConvertToFloatString($this->Demand->CurrentValue)))
			$this->Demand->CurrentValue = ConvertToFloatString($this->Demand->CurrentValue);

		// Convert decimal values if posted back
		if ($this->sea_time->FormValue == $this->sea_time->CurrentValue && is_numeric(ConvertToFloatString($this->sea_time->CurrentValue)))
			$this->sea_time->CurrentValue = ConvertToFloatString($this->sea_time->CurrentValue);

		// Convert decimal values if posted back
		if ($this->port_time->FormValue == $this->port_time->CurrentValue && is_numeric(ConvertToFloatString($this->port_time->CurrentValue)))
			$this->port_time->CurrentValue = ConvertToFloatString($this->port_time->CurrentValue);

		// Convert decimal values if posted back
		if ($this->roundtrip_days->FormValue == $this->roundtrip_days->CurrentValue && is_numeric(ConvertToFloatString($this->roundtrip_days->CurrentValue)))
			$this->roundtrip_days->CurrentValue = ConvertToFloatString($this->roundtrip_days->CurrentValue);

		// Convert decimal values if posted back
		if ($this->freqmaxbytrip->FormValue == $this->freqmaxbytrip->CurrentValue && is_numeric(ConvertToFloatString($this->freqmaxbytrip->CurrentValue)))
			$this->freqmaxbytrip->CurrentValue = ConvertToFloatString($this->freqmaxbytrip->CurrentValue);

		// Convert decimal values if posted back
		if ($this->freqmaxbycargo->FormValue == $this->freqmaxbycargo->CurrentValue && is_numeric(ConvertToFloatString($this->freqmaxbycargo->CurrentValue)))
			$this->freqmaxbycargo->CurrentValue = ConvertToFloatString($this->freqmaxbycargo->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
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

		if ($this->RowType == ROWTYPE_VIEW) { // View row

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
		}

		// Call Row Rendered event
		if ($this->RowType != ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
	}

	// Set up search options
	protected function setupSearchOptions()
	{
		global $Language;
		$this->SearchOptions = new ListOptions("div");
		$this->SearchOptions->TagClassName = "ew-search-option";

		// Search button
		$item = &$this->SearchOptions->add("searchtoggle");
		$searchToggleClass = ($this->SearchWhere != "") ? " active" : " active";
		$item->Body = "<a class=\"btn btn-default ew-search-toggle" . $searchToggleClass . "\" href=\"#\" role=\"button\" title=\"" . $Language->phrase("SearchPanel") . "\" data-caption=\"" . $Language->phrase("SearchPanel") . "\" data-toggle=\"button\" data-form=\"fv_hasillistsrch\" aria-pressed=\"" . ($searchToggleClass == " active" ? "true" : "false") . "\">" . $Language->phrase("SearchLink") . "</a>";
		$item->Visible = TRUE;

		// Show all button
		$item = &$this->SearchOptions->add("showall");
		$item->Body = "<a class=\"btn btn-default ew-show-all\" title=\"" . $Language->phrase("ShowAll") . "\" data-caption=\"" . $Language->phrase("ShowAll") . "\" href=\"" . $this->pageUrl() . "cmd=reset\">" . $Language->phrase("ShowAllBtn") . "</a>";
		$item->Visible = ($this->SearchWhere != $this->DefaultSearchWhere && $this->SearchWhere != "0=101");

		// Button group for search
		$this->SearchOptions->UseDropDownButton = FALSE;
		$this->SearchOptions->UseButtonGroup = TRUE;
		$this->SearchOptions->DropDownButtonPhrase = $Language->phrase("ButtonSearch");

		// Add group option item
		$item = &$this->SearchOptions->add($this->SearchOptions->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;

		// Hide search options
		if ($this->isExport() || $this->CurrentAction)
			$this->SearchOptions->hideAllOptions();
	}

	// Set up Breadcrumb
	protected function setupBreadcrumb()
	{
		global $Breadcrumb, $Language;
		$Breadcrumb = new Breadcrumb();
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/")+1);
		$url = preg_replace('/\?cmd=reset(all){0,1}$/i', '', $url); // Remove cmd=reset / cmd=resetall
		$Breadcrumb->add("list", $this->TableVar, $url, "", $this->TableVar, TRUE);
	}

	// Setup lookup options
	public function setupLookupOptions($fld)
	{
		if ($fld->Lookup !== NULL && $fld->Lookup->Options === NULL) {

			// Get default connection and filter
			$conn = $this->getConnection();
			$lookupFilter = "";

			// No need to check any more
			$fld->Lookup->Options = [];

			// Set up lookup SQL and connection
			switch ($fld->FieldVar) {
				default:
					$lookupFilter = "";
					break;
			}

			// Always call to Lookup->getSql so that user can setup Lookup->Options in Lookup_Selecting server event
			$sql = $fld->Lookup->getSql(FALSE, "", $lookupFilter, $this);

			// Set up lookup cache
			if ($fld->UseLookupCache && $sql != "" && count($fld->Lookup->Options) == 0) {
				$totalCnt = $this->getRecordCount($sql, $conn);
				if ($totalCnt > $fld->LookupCacheCount) // Total count > cache count, do not cache
					return;
				$rs = $conn->execute($sql);
				$ar = [];
				while ($rs && !$rs->EOF) {
					$row = &$rs->fields;

					// Format the field values
					switch ($fld->FieldVar) {
					}
					$ar[strval($row[0])] = $row;
					$rs->moveNext();
				}
				if ($rs)
					$rs->close();
				$fld->Lookup->Options = $ar;
			}
		}
	}

	// Set up starting record parameters
	public function setupStartRecord()
	{
		if ($this->DisplayRecords == 0)
			return;
		if ($this->isPageRequest()) { // Validate request
			$startRec = Get(Config("TABLE_START_REC"));
			$pageNo = Get(Config("TABLE_PAGE_NO"));
			if ($pageNo !== NULL) { // Check for "pageno" parameter first
				if (is_numeric($pageNo)) {
					$this->StartRecord = ($pageNo - 1) * $this->DisplayRecords + 1;
					if ($this->StartRecord <= 0) {
						$this->StartRecord = 1;
					} elseif ($this->StartRecord >= (int)(($this->TotalRecords - 1)/$this->DisplayRecords) * $this->DisplayRecords + 1) {
						$this->StartRecord = (int)(($this->TotalRecords - 1)/$this->DisplayRecords) * $this->DisplayRecords + 1;
					}
					$this->setStartRecordNumber($this->StartRecord);
				}
			} elseif ($startRec !== NULL) { // Check for "start" parameter
				$this->StartRecord = $startRec;
				$this->setStartRecordNumber($this->StartRecord);
			}
		}
		$this->StartRecord = $this->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRecord) || $this->StartRecord == "") { // Avoid invalid start record counter
			$this->StartRecord = 1; // Reset start record counter
			$this->setStartRecordNumber($this->StartRecord);
		} elseif ($this->StartRecord > $this->TotalRecords) { // Avoid starting record > total records
			$this->StartRecord = (int)(($this->TotalRecords - 1)/$this->DisplayRecords) * $this->DisplayRecords + 1; // Point to last page first record
			$this->setStartRecordNumber($this->StartRecord);
		} elseif (($this->StartRecord - 1) % $this->DisplayRecords != 0) {
			$this->StartRecord = (int)(($this->StartRecord - 1)/$this->DisplayRecords) * $this->DisplayRecords + 1; // Point to page boundary
			$this->setStartRecordNumber($this->StartRecord);
		}
	}

	// Page Load event
	function Page_Load() {

		//echo "Page Load";
	}

	// Page Unload event
	function Page_Unload() {

		//echo "Page Unload";
	}

	// Page Redirecting event
	function Page_Redirecting(&$url) {

		// Example:
		//$url = "your URL";

	}

	// Message Showing event
	// $type = ''|'success'|'failure'|'warning'
	function Message_Showing(&$msg, $type) {
		if ($type == 'success') {

			//$msg = "your success message";
		} elseif ($type == 'failure') {

			//$msg = "your failure message";
		} elseif ($type == 'warning') {

			//$msg = "your warning message";
		} else {

			//$msg = "your message";
		}
	}

	// Page Render event
	function Page_Render() {

		//echo "Page Render";
	}

	// Page Data Rendering event
	function Page_DataRendering(&$header) {

		// Example:
		//$header = "your header";

	}

	// Page Data Rendered event
	function Page_DataRendered(&$footer) {

		// Example:
		//$footer = "your footer";

	}

	// Form Custom Validate event
	function Form_CustomValidate(&$customError) {

		// Return error message in CustomError
		return TRUE;
	}

	// ListOptions Load event
	function ListOptions_Load() {

		// Example:
		//$opt = &$this->ListOptions->Add("new");
		//$opt->Header = "xxx";
		//$opt->OnLeft = TRUE; // Link on left
		//$opt->MoveTo(0); // Move to first column

	}

	// ListOptions Rendering event
	function ListOptions_Rendering() {

		//$GLOBALS["xxx_grid"]->DetailAdd = (...condition...); // Set to TRUE or FALSE conditionally
		//$GLOBALS["xxx_grid"]->DetailEdit = (...condition...); // Set to TRUE or FALSE conditionally
		//$GLOBALS["xxx_grid"]->DetailView = (...condition...); // Set to TRUE or FALSE conditionally

	}

	// ListOptions Rendered event
	function ListOptions_Rendered() {

		// Example:
		//$this->ListOptions["new"]->Body = "xxx";

	}

	// Row Custom Action event
	function Row_CustomAction($action, $row) {

		// Return FALSE to abort
		return TRUE;
	}

	// Page Exporting event
	// $this->ExportDoc = export document object
	function Page_Exporting() {

		//$this->ExportDoc->Text = "my header"; // Export header
		//return FALSE; // Return FALSE to skip default export and use Row_Export event

		return TRUE; // Return TRUE to use default export and skip Row_Export event
	}

	// Row Export event
	// $this->ExportDoc = export document object
	function Row_Export($rs) {

		//$this->ExportDoc->Text .= "my content"; // Build HTML with field value: $rs["MyField"] or $this->MyField->ViewValue
	}

	// Page Exported event
	// $this->ExportDoc = export document object
	function Page_Exported() {

		//$this->ExportDoc->Text .= "my footer"; // Export footer
		//echo $this->ExportDoc->Text;

	}

	// Page Importing event
	function Page_Importing($reader, &$options) {

		//var_dump($reader); // Import data reader
		//var_dump($options); // Show all options for importing
		//return FALSE; // Return FALSE to skip import

		return TRUE;
	}

	// Row Import event
	function Row_Import(&$row, $cnt) {

		//echo $cnt; // Import record count
		//var_dump($row); // Import row
		//return FALSE; // Return FALSE to skip import

		return TRUE;
	}

	// Page Imported event
	function Page_Imported($reader, $results) {

		//var_dump($reader); // Import data reader
		//var_dump($results); // Import results

	}
} // End class
?>