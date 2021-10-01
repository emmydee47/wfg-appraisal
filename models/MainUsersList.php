<?php

namespace PHPMaker2022\wfg_appraisal;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Page class
 */
class MainUsersList extends MainUsers
{
    use MessagesTrait;

    // Page ID
    public $PageID = "list";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'main_users';

    // Page object name
    public $PageObjName = "MainUsersList";

    // View file path
    public $View = null;

    // Title
    public $Title = null; // Title for <title> tag

    // Rendering View
    public $RenderingView = false;

    // Grid form hidden field names
    public $FormName = "fmain_userslist";
    public $FormActionName = "k_action";
    public $FormBlankRowName = "k_blankrow";
    public $FormKeyCountName = "key_count";

    // Page URLs
    public $AddUrl;
    public $EditUrl;
    public $CopyUrl;
    public $DeleteUrl;
    public $ViewUrl;
    public $ListUrl;

    // Update URLs
    public $InlineAddUrl;
    public $InlineCopyUrl;
    public $InlineEditUrl;
    public $GridAddUrl;
    public $GridEditUrl;
    public $MultiDeleteUrl;
    public $MultiUpdateUrl;

    // Audit Trail
    public $AuditTrailOnAdd = true;
    public $AuditTrailOnEdit = true;
    public $AuditTrailOnDelete = true;
    public $AuditTrailOnView = false;
    public $AuditTrailOnViewData = false;
    public $AuditTrailOnSearch = false;

    // Page headings
    public $Heading = "";
    public $Subheading = "";
    public $PageHeader;
    public $PageFooter;

    // Page layout
    public $UseLayout = true;

    // Page terminated
    private $terminated = false;

    // Page heading
    public function pageHeading()
    {
        global $Language;
        if ($this->Heading != "") {
            return $this->Heading;
        }
        if (method_exists($this, "tableCaption")) {
            return $this->tableCaption();
        }
        return "";
    }

    // Page subheading
    public function pageSubheading()
    {
        global $Language;
        if ($this->Subheading != "") {
            return $this->Subheading;
        }
        if ($this->TableName) {
            return $Language->phrase($this->PageID);
        }
        return "";
    }

    // Page name
    public function pageName()
    {
        return CurrentPageName();
    }

    // Page URL
    public function pageUrl($withArgs = true)
    {
        $route = GetRoute();
        $args = $route->getArguments();
        if (!$withArgs) {
            foreach ($args as $key => &$val) {
                $val = "";
            }
            unset($val);
        }
        $url = rtrim(UrlFor($route->getName(), $args), "/") . "?";
        if ($this->UseTokenInUrl) {
            $url .= "t=" . $this->TableVar . "&"; // Add page token
        }
        return $url;
    }

    // Show Page Header
    public function showPageHeader()
    {
        $header = $this->PageHeader;
        $this->pageDataRendering($header);
        if ($header != "") { // Header exists, display
            echo '<p id="ew-page-header">' . $header . '</p>';
        }
    }

    // Show Page Footer
    public function showPageFooter()
    {
        $footer = $this->PageFooter;
        $this->pageDataRendered($footer);
        if ($footer != "") { // Footer exists, display
            echo '<p id="ew-page-footer">' . $footer . '</p>';
        }
    }

    // Validate page request
    protected function isPageRequest()
    {
        global $CurrentForm;
        if ($this->UseTokenInUrl) {
            if ($CurrentForm) {
                return $this->TableVar == $CurrentForm->getValue("t");
            }
            if (Get("t") !== null) {
                return $this->TableVar == Get("t");
            }
        }
        return true;
    }

    // Constructor
    public function __construct()
    {
        global $Language, $DashboardReport, $DebugTimer;
        global $UserTable;

        // Initialize
        $GLOBALS["Page"] = &$this;

        // Language object
        $Language = Container("language");

        // Parent constuctor
        parent::__construct();

        // Table object (main_users)
        if (!isset($GLOBALS["main_users"]) || get_class($GLOBALS["main_users"]) == PROJECT_NAMESPACE . "main_users") {
            $GLOBALS["main_users"] = &$this;
        }

        // Page URL
        $pageUrl = $this->pageUrl(false);

        // Initialize URLs
        $this->AddUrl = "mainusersadd";
        $this->InlineAddUrl = $pageUrl . "action=add";
        $this->GridAddUrl = $pageUrl . "action=gridadd";
        $this->GridEditUrl = $pageUrl . "action=gridedit";
        $this->MultiDeleteUrl = "mainusersdelete";
        $this->MultiUpdateUrl = "mainusersupdate";

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'main_users');
        }

        // Start timer
        $DebugTimer = Container("timer");

        // Debug message
        LoadDebugMessage();

        // Open connection
        $GLOBALS["Conn"] = $GLOBALS["Conn"] ?? $this->getConnection();

        // User table object
        $UserTable = Container("usertable");

        // List options
        $this->ListOptions = new ListOptions(["Tag" => "td", "TableVar" => $this->TableVar]);

        // Export options
        $this->ExportOptions = new ListOptions(["TagClassName" => "ew-export-option"]);

        // Import options
        $this->ImportOptions = new ListOptions(["TagClassName" => "ew-import-option"]);

        // Other options
        if (!$this->OtherOptions) {
            $this->OtherOptions = new ListOptionsArray();
        }

        // Grid-Add/Edit
        $this->OtherOptions["addedit"] = new ListOptions([
            "TagClassName" => "ew-add-edit-option",
            "UseDropDownButton" => false,
            "DropDownButtonPhrase" => $Language->phrase("ButtonAddEdit"),
            "UseButtonGroup" => true
        ]);

        // Detail tables
        $this->OtherOptions["detail"] = new ListOptions(["TagClassName" => "ew-detail-option"]);
        // Actions
        $this->OtherOptions["action"] = new ListOptions(["TagClassName" => "ew-action-option"]);

        // Column visibility
        $this->OtherOptions["column"] = new ListOptions([
            "TableVar" => $this->TableVar,
            "TagClassName" => "ew-column-option",
            "ButtonGroupClass" => "ew-column-dropdown",
            "UseDropDownButton" => true,
            "DropDownButtonPhrase" => $Language->phrase("Columns"),
            "DropDownAutoClose" => "outside",
            "UseButtonGroup" => false
        ]);

        // Filter options
        $this->FilterOptions = new ListOptions(["TagClassName" => "ew-filter-option"]);

        // List actions
        $this->ListActions = new ListActions();
    }

    // Get content from stream
    public function getContents($stream = null): string
    {
        global $Response;
        return is_object($Response) ? $Response->getBody() : ob_get_clean();
    }

    // Is lookup
    public function isLookup()
    {
        return SameText(Route(0), Config("API_LOOKUP_ACTION"));
    }

    // Is AutoFill
    public function isAutoFill()
    {
        return $this->isLookup() && SameText(Post("ajax"), "autofill");
    }

    // Is AutoSuggest
    public function isAutoSuggest()
    {
        return $this->isLookup() && SameText(Post("ajax"), "autosuggest");
    }

    // Is modal lookup
    public function isModalLookup()
    {
        return $this->isLookup() && SameText(Post("ajax"), "modal");
    }

    // Is terminated
    public function isTerminated()
    {
        return $this->terminated;
    }

    /**
     * Terminate page
     *
     * @param string $url URL for direction
     * @return void
     */
    public function terminate($url = "")
    {
        if ($this->terminated) {
            return;
        }
        global $ExportFileName, $TempImages, $DashboardReport, $Response;

        // Page is terminated
        $this->terminated = true;

         // Page Unload event
        if (method_exists($this, "pageUnload")) {
            $this->pageUnload();
        }

        // Global Page Unloaded event (in userfn*.php)
        Page_Unloaded();

        // Export
        if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
            $content = $this->getContents();
            if ($ExportFileName == "") {
                $ExportFileName = $this->TableVar;
            }
            $class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
            if (class_exists($class)) {
                $tbl = Container("main_users");
                $doc = new $class($tbl);
                $doc->Text = @$content;
                if ($this->isExport("email")) {
                    echo $this->exportEmail($doc->Text);
                } else {
                    $doc->export();
                }
                DeleteTempImages(); // Delete temp images
                return;
            }
        }
        if (!IsApi() && method_exists($this, "pageRedirecting")) {
            $this->pageRedirecting($url);
        }

        // Close connection
        CloseConnections();

        // Return for API
        if (IsApi()) {
            $res = $url === true;
            if (!$res) { // Show error
                WriteJson(array_merge(["success" => false], $this->getMessages()));
            }
            return;
        } else { // Check if response is JSON
            if (StartsString("application/json", $Response->getHeaderLine("Content-type")) && $Response->getBody()->getSize()) { // With JSON response
                $this->clearMessages();
                return;
            }
        }

        // Go to URL if specified
        if ($url != "") {
            if (!Config("DEBUG") && ob_get_length()) {
                ob_end_clean();
            }
            SaveDebugMessage();
            Redirect(GetUrl($url));
        }
        return; // Return to controller
    }

    // Get records from recordset
    protected function getRecordsFromRecordset($rs, $current = false)
    {
        $rows = [];
        if (is_object($rs)) { // Recordset
            while ($rs && !$rs->EOF) {
                $this->loadRowValues($rs); // Set up DbValue/CurrentValue
                $row = $this->getRecordFromArray($rs->fields);
                if ($current) {
                    return $row;
                } else {
                    $rows[] = $row;
                }
                $rs->moveNext();
            }
        } elseif (is_array($rs)) {
            foreach ($rs as $ar) {
                $row = $this->getRecordFromArray($ar);
                if ($current) {
                    return $row;
                } else {
                    $rows[] = $row;
                }
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
                if (array_key_exists($fldname, $this->Fields) && ($this->Fields[$fldname]->Visible || $this->Fields[$fldname]->IsPrimaryKey)) { // Primary key or Visible
                    $fld = &$this->Fields[$fldname];
                    if ($fld->HtmlTag == "FILE") { // Upload field
                        if (EmptyValue($val)) {
                            $row[$fldname] = null;
                        } else {
                            if ($fld->DataType == DATATYPE_BLOB) {
                                $url = FullUrl(GetApiUrl(Config("API_FILE_ACTION") .
                                    "/" . $fld->TableVar . "/" . $fld->Param . "/" . rawurlencode($this->getRecordKeyValue($ar))));
                                $row[$fldname] = ["type" => ContentType($val), "url" => $url, "name" => $fld->Param . ContentExtension($val)];
                            } elseif (!$fld->UploadMultiple || !ContainsString($val, Config("MULTIPLE_UPLOAD_SEPARATOR"))) { // Single file
                                $url = FullUrl(GetApiUrl(Config("API_FILE_ACTION") .
                                    "/" . $fld->TableVar . "/" . Encrypt($fld->physicalUploadPath() . $val)));
                                $row[$fldname] = ["type" => MimeContentType($val), "url" => $url, "name" => $val];
                            } else { // Multiple files
                                $files = explode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $val);
                                $ar = [];
                                foreach ($files as $file) {
                                    $url = FullUrl(GetApiUrl(Config("API_FILE_ACTION") .
                                        "/" . $fld->TableVar . "/" . Encrypt($fld->physicalUploadPath() . $file)));
                                    if (!EmptyValue($file)) {
                                        $ar[] = ["type" => MimeContentType($file), "url" => $url, "name" => $file];
                                    }
                                }
                                $row[$fldname] = $ar;
                            }
                        }
                    } else {
                        if ($fld->DataType == DATATYPE_MEMO && $fld->MemoMaxLength > 0) {
                            $val = TruncateMemo($val, $fld->MemoMaxLength, $fld->TruncateMemoRemoveHtml);
                        }
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
            $key .= @$ar['id'];
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
        if ($this->isAdd() || $this->isCopy() || $this->isGridAdd()) {
            $this->id->Visible = false;
        }
    }

    // Lookup data
    public function lookup($ar = null)
    {
        global $Language, $Security;

        // Get lookup object
        $fieldName = $ar["field"] ?? Post("field");
        $lookup = $this->Fields[$fieldName]->Lookup;

        // Get lookup parameters
        $lookupType = $ar["ajax"] ?? Post("ajax", "unknown");
        $pageSize = -1;
        $offset = -1;
        $searchValue = "";
        if (SameText($lookupType, "modal") || SameText($lookupType, "filter")) {
            $searchValue = $ar["q"] ?? Param("q") ?? $ar["sv"] ?? Post("sv", "");
            $pageSize = $ar["n"] ?? Param("n") ?? $ar["recperpage"] ?? Post("recperpage", 10);
        } elseif (SameText($lookupType, "autosuggest")) {
            $searchValue = $ar["q"] ?? Param("q", "");
            $pageSize = $ar["n"] ?? Param("n", -1);
            $pageSize = is_numeric($pageSize) ? (int)$pageSize : -1;
            if ($pageSize <= 0) {
                $pageSize = Config("AUTO_SUGGEST_MAX_ENTRIES");
            }
        }
        $start = $ar["start"] ?? Param("start", -1);
        $start = is_numeric($start) ? (int)$start : -1;
        $page = $ar["page"] ?? Param("page", -1);
        $page = is_numeric($page) ? (int)$page : -1;
        $offset = $start >= 0 ? $start : ($page > 0 && $pageSize > 0 ? ($page - 1) * $pageSize : 0);
        $userSelect = Decrypt($ar["s"] ?? Post("s", ""));
        $userFilter = Decrypt($ar["f"] ?? Post("f", ""));
        $userOrderBy = Decrypt($ar["o"] ?? Post("o", ""));
        $keys = $ar["keys"] ?? Post("keys");
        $lookup->LookupType = $lookupType; // Lookup type
        $lookup->FilterValues = []; // Clear filter values first
        if ($keys !== null) { // Selected records from modal
            if (is_array($keys)) {
                $keys = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $keys);
            }
            $lookup->FilterFields = []; // Skip parent fields if any
            $lookup->FilterValues[] = $keys; // Lookup values
            $pageSize = -1; // Show all records
        } else { // Lookup values
            $lookup->FilterValues[] = $ar["v0"] ?? $ar["lookupValue"] ?? Post("v0", Post("lookupValue", ""));
        }
        $cnt = is_array($lookup->FilterFields) ? count($lookup->FilterFields) : 0;
        for ($i = 1; $i <= $cnt; $i++) {
            $lookup->FilterValues[] = $ar["v" . $i] ?? Post("v" . $i, "");
        }
        $lookup->SearchValue = $searchValue;
        $lookup->PageSize = $pageSize;
        $lookup->Offset = $offset;
        if ($userSelect != "") {
            $lookup->UserSelect = $userSelect;
        }
        if ($userFilter != "") {
            $lookup->UserFilter = $userFilter;
        }
        if ($userOrderBy != "") {
            $lookup->UserOrderBy = $userOrderBy;
        }
        return $lookup->toJson($this, !is_array($ar)); // Use settings from current page
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
    public $SearchColumnCount = 0; // For extended search
    public $SearchFieldsPerRow = 1; // For extended search
    public $RecordCount = 0; // Record count
    public $EditRowCount;
    public $StartRowCount = 1;
    public $RowCount = 0;
    public $Attrs = []; // Row attributes and cell attributes
    public $RowIndex = 0; // Row index
    public $KeyCount = 0; // Key count
    public $MultiColumnGridClass = "row-cols-md";
    public $MultiColumnEditClass = "col-12 w-100";
    public $MultiColumnCardClass = "card h-100 ew-card";
    public $MultiColumnListOptionsPosition = "bottom-start";
    public $DbMasterFilter = ""; // Master filter
    public $DbDetailFilter = ""; // Detail filter
    public $MasterRecordExists;
    public $MultiSelectKey;
    public $Command;
    public $UserAction; // User action
    public $RestoreSearch = false;
    public $HashValue; // Hash value
    public $DetailPages;
    public $OldRecordset;

    /**
     * Page run
     *
     * @return void
     */
    public function run()
    {
        global $ExportType, $CustomExportType, $ExportFileName, $UserProfile, $Language, $Security, $CurrentForm;

        // Multi column button position
        $this->MultiColumnListOptionsPosition = Config("MULTI_COLUMN_LIST_OPTIONS_POSITION");

        // Use layout
        $this->UseLayout = $this->UseLayout && ConvertToBool(Param("layout", true));

        // Get export parameters
        $custom = "";
        if (Param("export") !== null) {
            $this->Export = Param("export");
            $custom = Param("custom", "");
        } elseif (IsPost()) {
            if (Post("exporttype") !== null) {
                $this->Export = Post("exporttype");
            }
            $custom = Post("custom", "");
        } elseif (Get("cmd") == "json") {
            $this->Export = Get("cmd");
        } else {
            $this->setExportReturnUrl(CurrentUrl());
        }
        $ExportFileName = $this->TableVar; // Get export file, used in header

        // Get custom export parameters
        if ($this->isExport() && $custom != "") {
            $this->CustomExport = $this->Export;
            $this->Export = "print";
        }
        $CustomExportType = $this->CustomExport;
        $ExportType = $this->Export; // Get export parameter, used in header
        $this->CurrentAction = Param("action"); // Set up current action

        // Get grid add count
        $gridaddcnt = Get(Config("TABLE_GRID_ADD_ROW_COUNT"), "");
        if (is_numeric($gridaddcnt) && $gridaddcnt > 0) {
            $this->GridAddRowCount = $gridaddcnt;
        }

        // Set up list options
        $this->setupListOptions();

        // Setup export options
        $this->setupExportOptions();
        $this->id->setVisibility();
        $this->emprole->Visible = false;
        $this->userstatus->setVisibility();
        $this->firstname->setVisibility();
        $this->lastname->setVisibility();
        $this->userfullname->Visible = false;
        $this->emailaddress->setVisibility();
        $this->contactnumber->setVisibility();
        $this->empipaddress->Visible = false;
        $this->backgroundchk_status->Visible = false;
        $this->emptemplock->Visible = false;
        $this->empreasonlocked->Visible = false;
        $this->emplockeddate->Visible = false;
        $this->emppassword->Visible = false;
        $this->createdby->Visible = false;
        $this->modifiedby->Visible = false;
        $this->createddate->Visible = false;
        $this->modifieddate->Visible = false;
        $this->isactive->Visible = false;
        $this->staff_ID->setVisibility();
        $this->modeofentry->Visible = false;
        $this->other_modeofentry->Visible = false;
        $this->entrycomments->Visible = false;
        $this->selecteddate->Visible = false;
        $this->company_id->Visible = false;
        $this->profileimg->Visible = false;
        $this->jobtitle_id->Visible = false;
        $this->tourflag->Visible = false;
        $this->themes->Visible = false;
        $this->is_admin->Visible = false;
        $this->role_id->Visible = false;
        $this->hideFieldsForAddEdit();

        // Global Page Loading event (in userfn*.php)
        Page_Loading();

        // Page Load event
        if (method_exists($this, "pageLoad")) {
            $this->pageLoad();
        }

        // Setup other options
        $this->setupOtherOptions();

        // Set up custom action (compatible with old version)
        foreach ($this->CustomActions as $name => $action) {
            $this->ListActions->add($name, $action);
        }

        // Set up lookup cache
        $this->setupLookupOptions($this->emprole);
        $this->setupLookupOptions($this->userstatus);
        $this->setupLookupOptions($this->backgroundchk_status);
        $this->setupLookupOptions($this->themes);

        // Search filters
        $srchAdvanced = ""; // Advanced search filter
        $srchBasic = ""; // Basic search filter
        $filter = "";

        // Get command
        $this->Command = strtolower(Get("cmd"));
        if ($this->isPageRequest()) {
            // Process list action first
            if ($this->processListAction()) { // Ajax request
                $this->terminate();
                return;
            }

            // Set up records per page
            $this->setupDisplayRecords();

            // Handle reset command
            $this->resetCmd();

            // Set up Breadcrumb
            if (!$this->isExport()) {
                $this->setupBreadcrumb();
            }

            // Hide list options
            if ($this->isExport()) {
                $this->ListOptions->hideAllOptions(["sequence"]);
                $this->ListOptions->UseDropDownButton = false; // Disable drop down button
                $this->ListOptions->UseButtonGroup = false; // Disable button group
            } elseif ($this->isGridAdd() || $this->isGridEdit()) {
                $this->ListOptions->hideAllOptions();
                $this->ListOptions->UseDropDownButton = false; // Disable drop down button
                $this->ListOptions->UseButtonGroup = false; // Disable button group
            }

            // Hide options
            if ($this->isExport() || $this->CurrentAction) {
                $this->ExportOptions->hideAllOptions();
                $this->FilterOptions->hideAllOptions();
                $this->ImportOptions->hideAllOptions();
            }

            // Hide other options
            if ($this->isExport()) {
                $this->OtherOptions->hideAllOptions();
            }

            // Get default search criteria
            AddFilter($this->DefaultSearchWhere, $this->basicSearchWhere(true));

            // Get basic search values
            $this->loadBasicSearchValues();

            // Process filter list
            if ($this->processFilterList()) {
                $this->terminate();
                return;
            }

            // Restore search parms from Session if not searching / reset / export
            if (($this->isExport() || $this->Command != "search" && $this->Command != "reset" && $this->Command != "resetall") && $this->Command != "json" && $this->checkSearchParms()) {
                $this->restoreSearchParms();
            }

            // Call Recordset SearchValidated event
            $this->recordsetSearchValidated();

            // Set up sorting order
            $this->setupSortOrder();

            // Get basic search criteria
            if (!$this->hasInvalidFields()) {
                $srchBasic = $this->basicSearchWhere();
            }
        }

        // Restore display records
        if ($this->Command != "json" && $this->getRecordsPerPage() != "") {
            $this->DisplayRecords = $this->getRecordsPerPage(); // Restore from Session
        } else {
            $this->DisplayRecords = 20; // Load default
            $this->setRecordsPerPage($this->DisplayRecords); // Save default to Session
        }

        // Load Sorting Order
        if ($this->Command != "json") {
            $this->loadSortOrder();
        }

        // Load search default if no existing search criteria
        if (!$this->checkSearchParms()) {
            // Load basic search from default
            $this->BasicSearch->loadDefault();
            if ($this->BasicSearch->Keyword != "") {
                $srchBasic = $this->basicSearchWhere();
            }
        }

        // Build search criteria
        AddFilter($this->SearchWhere, $srchAdvanced);
        AddFilter($this->SearchWhere, $srchBasic);

        // Call Recordset_Searching event
        $this->recordsetSearching($this->SearchWhere);

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
        if (!$Security->canList()) {
            $filter = "(0=1)"; // Filter all records
        }
        AddFilter($filter, $this->DbDetailFilter);
        AddFilter($filter, $this->SearchWhere);

        // Set up filter
        if ($this->Command == "json") {
            $this->UseSessionForListSql = false; // Do not use session for ListSQL
            $this->CurrentFilter = $filter;
        } else {
            $this->setSessionWhere($filter);
            $this->CurrentFilter = "";
        }

        // Export data only
        if (!$this->CustomExport && in_array($this->Export, array_keys(Config("EXPORT_CLASSES")))) {
            $this->exportData();
            $this->terminate();
            return;
        }
        if ($this->isGridAdd()) {
            $this->CurrentFilter = "0=1";
            $this->StartRecord = 1;
            $this->DisplayRecords = $this->GridAddRowCount;
            $this->TotalRecords = $this->DisplayRecords;
            $this->StopRecord = $this->DisplayRecords;
        } else {
            $this->TotalRecords = $this->listRecordCount();
            $this->StartRecord = 1;
            if ($this->DisplayRecords <= 0 || ($this->isExport() && $this->ExportAll)) { // Display all records
                $this->DisplayRecords = $this->TotalRecords;
            }
            if (!($this->isExport() && $this->ExportAll)) { // Set up start record position
                $this->setupStartRecord();
            }
            $this->Recordset = $this->loadRecordset($this->StartRecord - 1, $this->DisplayRecords);

            // Set no record found message
            if (!$this->CurrentAction && $this->TotalRecords == 0) {
                if (!$Security->canList()) {
                    $this->setWarningMessage(DeniedMessage());
                }
                if ($this->SearchWhere == "0=101") {
                    $this->setWarningMessage($Language->phrase("EnterSearchCriteria"));
                } else {
                    $this->setWarningMessage($Language->phrase("NoRecord"));
                }
            }

            // Audit trail on search
            if ($this->AuditTrailOnSearch && $this->Command == "search" && !$this->RestoreSearch) {
                $searchParm = ServerVar("QUERY_STRING");
                $searchSql = $this->getSessionWhere();
                $this->writeAuditTrailOnSearch($searchParm, $searchSql);
            }
        }

        // Set up list action columns
        foreach ($this->ListActions->Items as $listaction) {
            if ($listaction->Allow) {
                if ($listaction->Select == ACTION_MULTIPLE) { // Show checkbox column if multiple action 
                    $this->ListOptions["checkbox"]->Visible = true;
                } elseif ($listaction->Select == ACTION_SINGLE) { // Show list action column
                        $this->ListOptions["listactions"]->Visible = true; // Set visible if any list action is allowed
                }
            }
        }

        // Search options
        $this->setupSearchOptions();

        // Set up search panel class
        if ($this->SearchWhere != "") {
            AppendClass($this->SearchPanelClass, "show");
        }

        // Normal return
        if (IsApi()) {
            $rows = $this->getRecordsFromRecordset($this->Recordset);
            $this->Recordset->close();
            WriteJson(["success" => true, $this->TableVar => $rows, "totalRecordCount" => $this->TotalRecords]);
            $this->terminate(true);
            return;
        }

        // Set up pager
        $this->Pager = new PrevNextPager($this->TableVar, $this->StartRecord, $this->getRecordsPerPage(), $this->TotalRecords, $this->PageSizes, $this->RecordRange, $this->AutoHidePager, $this->AutoHidePageSizeSelector);

        // Set LoginStatus / Page_Rendering / Page_Render
        if (!IsApi() && !$this->isTerminated()) {
            // Setup login status
            SetupLoginStatus();

            // Pass login status to client side
            SetClientVar("login", LoginStatus());

            // Global Page Rendering event (in userfn*.php)
            Page_Rendering();

            // Page Render event
            if (method_exists($this, "pageRender")) {
                $this->pageRender();
            }

            // Render search option
            if (method_exists($this, "renderSearchOptions")) {
                $this->renderSearchOptions();
            }
        }
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
        $thisKey = strval($CurrentForm->getValue($this->OldKeyName));
        while ($thisKey != "") {
            $this->setKey($thisKey);
            if ($this->OldKey != "") {
                $filter = $this->getRecordFilter();
                if ($wrkFilter != "") {
                    $wrkFilter .= " OR ";
                }
                $wrkFilter .= $filter;
            } else {
                $wrkFilter = "0=1";
                break;
            }

            // Update row index and get row key
            $rowindex++; // Next row
            $CurrentForm->Index = $rowindex;
            $thisKey = strval($CurrentForm->getValue($this->OldKeyName));
        }
        return $wrkFilter;
    }

    // Get list of filters
    public function getFilterList()
    {
        global $UserProfile;

        // Initialize
        $filterList = "";
        $savedFilterList = "";
        $filterList = Concat($filterList, $this->id->AdvancedSearch->toJson(), ","); // Field id
        $filterList = Concat($filterList, $this->emprole->AdvancedSearch->toJson(), ","); // Field emprole
        $filterList = Concat($filterList, $this->userstatus->AdvancedSearch->toJson(), ","); // Field userstatus
        $filterList = Concat($filterList, $this->firstname->AdvancedSearch->toJson(), ","); // Field firstname
        $filterList = Concat($filterList, $this->lastname->AdvancedSearch->toJson(), ","); // Field lastname
        $filterList = Concat($filterList, $this->userfullname->AdvancedSearch->toJson(), ","); // Field userfullname
        $filterList = Concat($filterList, $this->emailaddress->AdvancedSearch->toJson(), ","); // Field emailaddress
        $filterList = Concat($filterList, $this->contactnumber->AdvancedSearch->toJson(), ","); // Field contactnumber
        $filterList = Concat($filterList, $this->empipaddress->AdvancedSearch->toJson(), ","); // Field empipaddress
        $filterList = Concat($filterList, $this->backgroundchk_status->AdvancedSearch->toJson(), ","); // Field backgroundchk_status
        $filterList = Concat($filterList, $this->emptemplock->AdvancedSearch->toJson(), ","); // Field emptemplock
        $filterList = Concat($filterList, $this->empreasonlocked->AdvancedSearch->toJson(), ","); // Field empreasonlocked
        $filterList = Concat($filterList, $this->emplockeddate->AdvancedSearch->toJson(), ","); // Field emplockeddate
        $filterList = Concat($filterList, $this->emppassword->AdvancedSearch->toJson(), ","); // Field emppassword
        $filterList = Concat($filterList, $this->createdby->AdvancedSearch->toJson(), ","); // Field createdby
        $filterList = Concat($filterList, $this->modifiedby->AdvancedSearch->toJson(), ","); // Field modifiedby
        $filterList = Concat($filterList, $this->createddate->AdvancedSearch->toJson(), ","); // Field createddate
        $filterList = Concat($filterList, $this->modifieddate->AdvancedSearch->toJson(), ","); // Field modifieddate
        $filterList = Concat($filterList, $this->isactive->AdvancedSearch->toJson(), ","); // Field isactive
        $filterList = Concat($filterList, $this->staff_ID->AdvancedSearch->toJson(), ","); // Field staff_ID
        $filterList = Concat($filterList, $this->modeofentry->AdvancedSearch->toJson(), ","); // Field modeofentry
        $filterList = Concat($filterList, $this->other_modeofentry->AdvancedSearch->toJson(), ","); // Field other_modeofentry
        $filterList = Concat($filterList, $this->entrycomments->AdvancedSearch->toJson(), ","); // Field entrycomments
        $filterList = Concat($filterList, $this->selecteddate->AdvancedSearch->toJson(), ","); // Field selecteddate
        $filterList = Concat($filterList, $this->company_id->AdvancedSearch->toJson(), ","); // Field company_id
        $filterList = Concat($filterList, $this->profileimg->AdvancedSearch->toJson(), ","); // Field profileimg
        $filterList = Concat($filterList, $this->jobtitle_id->AdvancedSearch->toJson(), ","); // Field jobtitle_id
        $filterList = Concat($filterList, $this->tourflag->AdvancedSearch->toJson(), ","); // Field tourflag
        $filterList = Concat($filterList, $this->themes->AdvancedSearch->toJson(), ","); // Field themes
        $filterList = Concat($filterList, $this->is_admin->AdvancedSearch->toJson(), ","); // Field is_admin
        $filterList = Concat($filterList, $this->role_id->AdvancedSearch->toJson(), ","); // Field role_id
        if ($this->BasicSearch->Keyword != "") {
            $wrk = "\"" . Config("TABLE_BASIC_SEARCH") . "\":\"" . JsEncode($this->BasicSearch->Keyword) . "\",\"" . Config("TABLE_BASIC_SEARCH_TYPE") . "\":\"" . JsEncode($this->BasicSearch->Type) . "\"";
            $filterList = Concat($filterList, $wrk, ",");
        }

        // Return filter list in JSON
        if ($filterList != "") {
            $filterList = "\"data\":{" . $filterList . "}";
        }
        if ($savedFilterList != "") {
            $filterList = Concat($filterList, "\"filters\":" . $savedFilterList, ",");
        }
        return ($filterList != "") ? "{" . $filterList . "}" : "null";
    }

    // Process filter list
    protected function processFilterList()
    {
        global $UserProfile;
        if (Post("ajax") == "savefilters") { // Save filter request (Ajax)
            $filters = Post("filters");
            $UserProfile->setSearchFilters(CurrentUserName(), "fmain_userssrch", $filters);
            WriteJson([["success" => true]]); // Success
            return true;
        } elseif (Post("cmd") == "resetfilter") {
            $this->restoreFilterList();
        }
        return false;
    }

    // Restore list of filters
    protected function restoreFilterList()
    {
        // Return if not reset filter
        if (Post("cmd") !== "resetfilter") {
            return false;
        }
        $filter = json_decode(Post("filter"), true);
        $this->Command = "search";

        // Field id
        $this->id->AdvancedSearch->SearchValue = @$filter["x_id"];
        $this->id->AdvancedSearch->SearchOperator = @$filter["z_id"];
        $this->id->AdvancedSearch->SearchCondition = @$filter["v_id"];
        $this->id->AdvancedSearch->SearchValue2 = @$filter["y_id"];
        $this->id->AdvancedSearch->SearchOperator2 = @$filter["w_id"];
        $this->id->AdvancedSearch->save();

        // Field emprole
        $this->emprole->AdvancedSearch->SearchValue = @$filter["x_emprole"];
        $this->emprole->AdvancedSearch->SearchOperator = @$filter["z_emprole"];
        $this->emprole->AdvancedSearch->SearchCondition = @$filter["v_emprole"];
        $this->emprole->AdvancedSearch->SearchValue2 = @$filter["y_emprole"];
        $this->emprole->AdvancedSearch->SearchOperator2 = @$filter["w_emprole"];
        $this->emprole->AdvancedSearch->save();

        // Field userstatus
        $this->userstatus->AdvancedSearch->SearchValue = @$filter["x_userstatus"];
        $this->userstatus->AdvancedSearch->SearchOperator = @$filter["z_userstatus"];
        $this->userstatus->AdvancedSearch->SearchCondition = @$filter["v_userstatus"];
        $this->userstatus->AdvancedSearch->SearchValue2 = @$filter["y_userstatus"];
        $this->userstatus->AdvancedSearch->SearchOperator2 = @$filter["w_userstatus"];
        $this->userstatus->AdvancedSearch->save();

        // Field firstname
        $this->firstname->AdvancedSearch->SearchValue = @$filter["x_firstname"];
        $this->firstname->AdvancedSearch->SearchOperator = @$filter["z_firstname"];
        $this->firstname->AdvancedSearch->SearchCondition = @$filter["v_firstname"];
        $this->firstname->AdvancedSearch->SearchValue2 = @$filter["y_firstname"];
        $this->firstname->AdvancedSearch->SearchOperator2 = @$filter["w_firstname"];
        $this->firstname->AdvancedSearch->save();

        // Field lastname
        $this->lastname->AdvancedSearch->SearchValue = @$filter["x_lastname"];
        $this->lastname->AdvancedSearch->SearchOperator = @$filter["z_lastname"];
        $this->lastname->AdvancedSearch->SearchCondition = @$filter["v_lastname"];
        $this->lastname->AdvancedSearch->SearchValue2 = @$filter["y_lastname"];
        $this->lastname->AdvancedSearch->SearchOperator2 = @$filter["w_lastname"];
        $this->lastname->AdvancedSearch->save();

        // Field userfullname
        $this->userfullname->AdvancedSearch->SearchValue = @$filter["x_userfullname"];
        $this->userfullname->AdvancedSearch->SearchOperator = @$filter["z_userfullname"];
        $this->userfullname->AdvancedSearch->SearchCondition = @$filter["v_userfullname"];
        $this->userfullname->AdvancedSearch->SearchValue2 = @$filter["y_userfullname"];
        $this->userfullname->AdvancedSearch->SearchOperator2 = @$filter["w_userfullname"];
        $this->userfullname->AdvancedSearch->save();

        // Field emailaddress
        $this->emailaddress->AdvancedSearch->SearchValue = @$filter["x_emailaddress"];
        $this->emailaddress->AdvancedSearch->SearchOperator = @$filter["z_emailaddress"];
        $this->emailaddress->AdvancedSearch->SearchCondition = @$filter["v_emailaddress"];
        $this->emailaddress->AdvancedSearch->SearchValue2 = @$filter["y_emailaddress"];
        $this->emailaddress->AdvancedSearch->SearchOperator2 = @$filter["w_emailaddress"];
        $this->emailaddress->AdvancedSearch->save();

        // Field contactnumber
        $this->contactnumber->AdvancedSearch->SearchValue = @$filter["x_contactnumber"];
        $this->contactnumber->AdvancedSearch->SearchOperator = @$filter["z_contactnumber"];
        $this->contactnumber->AdvancedSearch->SearchCondition = @$filter["v_contactnumber"];
        $this->contactnumber->AdvancedSearch->SearchValue2 = @$filter["y_contactnumber"];
        $this->contactnumber->AdvancedSearch->SearchOperator2 = @$filter["w_contactnumber"];
        $this->contactnumber->AdvancedSearch->save();

        // Field empipaddress
        $this->empipaddress->AdvancedSearch->SearchValue = @$filter["x_empipaddress"];
        $this->empipaddress->AdvancedSearch->SearchOperator = @$filter["z_empipaddress"];
        $this->empipaddress->AdvancedSearch->SearchCondition = @$filter["v_empipaddress"];
        $this->empipaddress->AdvancedSearch->SearchValue2 = @$filter["y_empipaddress"];
        $this->empipaddress->AdvancedSearch->SearchOperator2 = @$filter["w_empipaddress"];
        $this->empipaddress->AdvancedSearch->save();

        // Field backgroundchk_status
        $this->backgroundchk_status->AdvancedSearch->SearchValue = @$filter["x_backgroundchk_status"];
        $this->backgroundchk_status->AdvancedSearch->SearchOperator = @$filter["z_backgroundchk_status"];
        $this->backgroundchk_status->AdvancedSearch->SearchCondition = @$filter["v_backgroundchk_status"];
        $this->backgroundchk_status->AdvancedSearch->SearchValue2 = @$filter["y_backgroundchk_status"];
        $this->backgroundchk_status->AdvancedSearch->SearchOperator2 = @$filter["w_backgroundchk_status"];
        $this->backgroundchk_status->AdvancedSearch->save();

        // Field emptemplock
        $this->emptemplock->AdvancedSearch->SearchValue = @$filter["x_emptemplock"];
        $this->emptemplock->AdvancedSearch->SearchOperator = @$filter["z_emptemplock"];
        $this->emptemplock->AdvancedSearch->SearchCondition = @$filter["v_emptemplock"];
        $this->emptemplock->AdvancedSearch->SearchValue2 = @$filter["y_emptemplock"];
        $this->emptemplock->AdvancedSearch->SearchOperator2 = @$filter["w_emptemplock"];
        $this->emptemplock->AdvancedSearch->save();

        // Field empreasonlocked
        $this->empreasonlocked->AdvancedSearch->SearchValue = @$filter["x_empreasonlocked"];
        $this->empreasonlocked->AdvancedSearch->SearchOperator = @$filter["z_empreasonlocked"];
        $this->empreasonlocked->AdvancedSearch->SearchCondition = @$filter["v_empreasonlocked"];
        $this->empreasonlocked->AdvancedSearch->SearchValue2 = @$filter["y_empreasonlocked"];
        $this->empreasonlocked->AdvancedSearch->SearchOperator2 = @$filter["w_empreasonlocked"];
        $this->empreasonlocked->AdvancedSearch->save();

        // Field emplockeddate
        $this->emplockeddate->AdvancedSearch->SearchValue = @$filter["x_emplockeddate"];
        $this->emplockeddate->AdvancedSearch->SearchOperator = @$filter["z_emplockeddate"];
        $this->emplockeddate->AdvancedSearch->SearchCondition = @$filter["v_emplockeddate"];
        $this->emplockeddate->AdvancedSearch->SearchValue2 = @$filter["y_emplockeddate"];
        $this->emplockeddate->AdvancedSearch->SearchOperator2 = @$filter["w_emplockeddate"];
        $this->emplockeddate->AdvancedSearch->save();

        // Field emppassword
        $this->emppassword->AdvancedSearch->SearchValue = @$filter["x_emppassword"];
        $this->emppassword->AdvancedSearch->SearchOperator = @$filter["z_emppassword"];
        $this->emppassword->AdvancedSearch->SearchCondition = @$filter["v_emppassword"];
        $this->emppassword->AdvancedSearch->SearchValue2 = @$filter["y_emppassword"];
        $this->emppassword->AdvancedSearch->SearchOperator2 = @$filter["w_emppassword"];
        $this->emppassword->AdvancedSearch->save();

        // Field createdby
        $this->createdby->AdvancedSearch->SearchValue = @$filter["x_createdby"];
        $this->createdby->AdvancedSearch->SearchOperator = @$filter["z_createdby"];
        $this->createdby->AdvancedSearch->SearchCondition = @$filter["v_createdby"];
        $this->createdby->AdvancedSearch->SearchValue2 = @$filter["y_createdby"];
        $this->createdby->AdvancedSearch->SearchOperator2 = @$filter["w_createdby"];
        $this->createdby->AdvancedSearch->save();

        // Field modifiedby
        $this->modifiedby->AdvancedSearch->SearchValue = @$filter["x_modifiedby"];
        $this->modifiedby->AdvancedSearch->SearchOperator = @$filter["z_modifiedby"];
        $this->modifiedby->AdvancedSearch->SearchCondition = @$filter["v_modifiedby"];
        $this->modifiedby->AdvancedSearch->SearchValue2 = @$filter["y_modifiedby"];
        $this->modifiedby->AdvancedSearch->SearchOperator2 = @$filter["w_modifiedby"];
        $this->modifiedby->AdvancedSearch->save();

        // Field createddate
        $this->createddate->AdvancedSearch->SearchValue = @$filter["x_createddate"];
        $this->createddate->AdvancedSearch->SearchOperator = @$filter["z_createddate"];
        $this->createddate->AdvancedSearch->SearchCondition = @$filter["v_createddate"];
        $this->createddate->AdvancedSearch->SearchValue2 = @$filter["y_createddate"];
        $this->createddate->AdvancedSearch->SearchOperator2 = @$filter["w_createddate"];
        $this->createddate->AdvancedSearch->save();

        // Field modifieddate
        $this->modifieddate->AdvancedSearch->SearchValue = @$filter["x_modifieddate"];
        $this->modifieddate->AdvancedSearch->SearchOperator = @$filter["z_modifieddate"];
        $this->modifieddate->AdvancedSearch->SearchCondition = @$filter["v_modifieddate"];
        $this->modifieddate->AdvancedSearch->SearchValue2 = @$filter["y_modifieddate"];
        $this->modifieddate->AdvancedSearch->SearchOperator2 = @$filter["w_modifieddate"];
        $this->modifieddate->AdvancedSearch->save();

        // Field isactive
        $this->isactive->AdvancedSearch->SearchValue = @$filter["x_isactive"];
        $this->isactive->AdvancedSearch->SearchOperator = @$filter["z_isactive"];
        $this->isactive->AdvancedSearch->SearchCondition = @$filter["v_isactive"];
        $this->isactive->AdvancedSearch->SearchValue2 = @$filter["y_isactive"];
        $this->isactive->AdvancedSearch->SearchOperator2 = @$filter["w_isactive"];
        $this->isactive->AdvancedSearch->save();

        // Field staff_ID
        $this->staff_ID->AdvancedSearch->SearchValue = @$filter["x_staff_ID"];
        $this->staff_ID->AdvancedSearch->SearchOperator = @$filter["z_staff_ID"];
        $this->staff_ID->AdvancedSearch->SearchCondition = @$filter["v_staff_ID"];
        $this->staff_ID->AdvancedSearch->SearchValue2 = @$filter["y_staff_ID"];
        $this->staff_ID->AdvancedSearch->SearchOperator2 = @$filter["w_staff_ID"];
        $this->staff_ID->AdvancedSearch->save();

        // Field modeofentry
        $this->modeofentry->AdvancedSearch->SearchValue = @$filter["x_modeofentry"];
        $this->modeofentry->AdvancedSearch->SearchOperator = @$filter["z_modeofentry"];
        $this->modeofentry->AdvancedSearch->SearchCondition = @$filter["v_modeofentry"];
        $this->modeofentry->AdvancedSearch->SearchValue2 = @$filter["y_modeofentry"];
        $this->modeofentry->AdvancedSearch->SearchOperator2 = @$filter["w_modeofentry"];
        $this->modeofentry->AdvancedSearch->save();

        // Field other_modeofentry
        $this->other_modeofentry->AdvancedSearch->SearchValue = @$filter["x_other_modeofentry"];
        $this->other_modeofentry->AdvancedSearch->SearchOperator = @$filter["z_other_modeofentry"];
        $this->other_modeofentry->AdvancedSearch->SearchCondition = @$filter["v_other_modeofentry"];
        $this->other_modeofentry->AdvancedSearch->SearchValue2 = @$filter["y_other_modeofentry"];
        $this->other_modeofentry->AdvancedSearch->SearchOperator2 = @$filter["w_other_modeofentry"];
        $this->other_modeofentry->AdvancedSearch->save();

        // Field entrycomments
        $this->entrycomments->AdvancedSearch->SearchValue = @$filter["x_entrycomments"];
        $this->entrycomments->AdvancedSearch->SearchOperator = @$filter["z_entrycomments"];
        $this->entrycomments->AdvancedSearch->SearchCondition = @$filter["v_entrycomments"];
        $this->entrycomments->AdvancedSearch->SearchValue2 = @$filter["y_entrycomments"];
        $this->entrycomments->AdvancedSearch->SearchOperator2 = @$filter["w_entrycomments"];
        $this->entrycomments->AdvancedSearch->save();

        // Field selecteddate
        $this->selecteddate->AdvancedSearch->SearchValue = @$filter["x_selecteddate"];
        $this->selecteddate->AdvancedSearch->SearchOperator = @$filter["z_selecteddate"];
        $this->selecteddate->AdvancedSearch->SearchCondition = @$filter["v_selecteddate"];
        $this->selecteddate->AdvancedSearch->SearchValue2 = @$filter["y_selecteddate"];
        $this->selecteddate->AdvancedSearch->SearchOperator2 = @$filter["w_selecteddate"];
        $this->selecteddate->AdvancedSearch->save();

        // Field company_id
        $this->company_id->AdvancedSearch->SearchValue = @$filter["x_company_id"];
        $this->company_id->AdvancedSearch->SearchOperator = @$filter["z_company_id"];
        $this->company_id->AdvancedSearch->SearchCondition = @$filter["v_company_id"];
        $this->company_id->AdvancedSearch->SearchValue2 = @$filter["y_company_id"];
        $this->company_id->AdvancedSearch->SearchOperator2 = @$filter["w_company_id"];
        $this->company_id->AdvancedSearch->save();

        // Field profileimg
        $this->profileimg->AdvancedSearch->SearchValue = @$filter["x_profileimg"];
        $this->profileimg->AdvancedSearch->SearchOperator = @$filter["z_profileimg"];
        $this->profileimg->AdvancedSearch->SearchCondition = @$filter["v_profileimg"];
        $this->profileimg->AdvancedSearch->SearchValue2 = @$filter["y_profileimg"];
        $this->profileimg->AdvancedSearch->SearchOperator2 = @$filter["w_profileimg"];
        $this->profileimg->AdvancedSearch->save();

        // Field jobtitle_id
        $this->jobtitle_id->AdvancedSearch->SearchValue = @$filter["x_jobtitle_id"];
        $this->jobtitle_id->AdvancedSearch->SearchOperator = @$filter["z_jobtitle_id"];
        $this->jobtitle_id->AdvancedSearch->SearchCondition = @$filter["v_jobtitle_id"];
        $this->jobtitle_id->AdvancedSearch->SearchValue2 = @$filter["y_jobtitle_id"];
        $this->jobtitle_id->AdvancedSearch->SearchOperator2 = @$filter["w_jobtitle_id"];
        $this->jobtitle_id->AdvancedSearch->save();

        // Field tourflag
        $this->tourflag->AdvancedSearch->SearchValue = @$filter["x_tourflag"];
        $this->tourflag->AdvancedSearch->SearchOperator = @$filter["z_tourflag"];
        $this->tourflag->AdvancedSearch->SearchCondition = @$filter["v_tourflag"];
        $this->tourflag->AdvancedSearch->SearchValue2 = @$filter["y_tourflag"];
        $this->tourflag->AdvancedSearch->SearchOperator2 = @$filter["w_tourflag"];
        $this->tourflag->AdvancedSearch->save();

        // Field themes
        $this->themes->AdvancedSearch->SearchValue = @$filter["x_themes"];
        $this->themes->AdvancedSearch->SearchOperator = @$filter["z_themes"];
        $this->themes->AdvancedSearch->SearchCondition = @$filter["v_themes"];
        $this->themes->AdvancedSearch->SearchValue2 = @$filter["y_themes"];
        $this->themes->AdvancedSearch->SearchOperator2 = @$filter["w_themes"];
        $this->themes->AdvancedSearch->save();

        // Field is_admin
        $this->is_admin->AdvancedSearch->SearchValue = @$filter["x_is_admin"];
        $this->is_admin->AdvancedSearch->SearchOperator = @$filter["z_is_admin"];
        $this->is_admin->AdvancedSearch->SearchCondition = @$filter["v_is_admin"];
        $this->is_admin->AdvancedSearch->SearchValue2 = @$filter["y_is_admin"];
        $this->is_admin->AdvancedSearch->SearchOperator2 = @$filter["w_is_admin"];
        $this->is_admin->AdvancedSearch->save();

        // Field role_id
        $this->role_id->AdvancedSearch->SearchValue = @$filter["x_role_id"];
        $this->role_id->AdvancedSearch->SearchOperator = @$filter["z_role_id"];
        $this->role_id->AdvancedSearch->SearchCondition = @$filter["v_role_id"];
        $this->role_id->AdvancedSearch->SearchValue2 = @$filter["y_role_id"];
        $this->role_id->AdvancedSearch->SearchOperator2 = @$filter["w_role_id"];
        $this->role_id->AdvancedSearch->save();
        $this->BasicSearch->setKeyword(@$filter[Config("TABLE_BASIC_SEARCH")]);
        $this->BasicSearch->setType(@$filter[Config("TABLE_BASIC_SEARCH_TYPE")]);
    }

    // Return basic search WHERE clause based on search keyword and type
    protected function basicSearchWhere($default = false)
    {
        global $Security;
        $searchStr = "";
        if (!$Security->canSearch()) {
            return "";
        }

        // Fields to search
        $searchFlds = [];
        $searchFlds[] = &$this->firstname;
        $searchFlds[] = &$this->lastname;
        $searchFlds[] = &$this->userfullname;
        $searchFlds[] = &$this->emailaddress;
        $searchFlds[] = &$this->contactnumber;
        $searchFlds[] = &$this->empipaddress;
        $searchFlds[] = &$this->empreasonlocked;
        $searchFlds[] = &$this->emppassword;
        $searchFlds[] = &$this->staff_ID;
        $searchFlds[] = &$this->modeofentry;
        $searchFlds[] = &$this->other_modeofentry;
        $searchFlds[] = &$this->entrycomments;
        $searchFlds[] = &$this->profileimg;
        $searchKeyword = $default ? $this->BasicSearch->KeywordDefault : $this->BasicSearch->Keyword;
        $searchType = $default ? $this->BasicSearch->TypeDefault : $this->BasicSearch->Type;

        // Get search SQL
        if ($searchKeyword != "") {
            $ar = $this->BasicSearch->keywordList($default);
            $searchStr = GetQuickSearchFilter($searchFlds, $ar, $searchType, Config("BASIC_SEARCH_ANY_FIELDS"), $this->Dbid);
            if (!$default && in_array($this->Command, ["", "reset", "resetall"])) {
                $this->Command = "search";
            }
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
        if ($this->BasicSearch->issetSession()) {
            return true;
        }
        return false;
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
        return false;
    }

    // Clear all basic search parameters
    protected function resetBasicSearchParms()
    {
        $this->BasicSearch->unsetSession();
    }

    // Restore all search parameters
    protected function restoreSearchParms()
    {
        $this->RestoreSearch = true;

        // Restore basic search values
        $this->BasicSearch->load();
    }

    // Set up sort parameters
    protected function setupSortOrder()
    {
        // Check for "order" parameter
        if (Get("order") !== null) {
            $this->CurrentOrder = Get("order");
            $this->CurrentOrderType = Get("ordertype", "");
            $this->updateSort($this->id); // id
            $this->updateSort($this->userstatus); // userstatus
            $this->updateSort($this->firstname); // firstname
            $this->updateSort($this->lastname); // lastname
            $this->updateSort($this->emailaddress); // emailaddress
            $this->updateSort($this->contactnumber); // contactnumber
            $this->updateSort($this->staff_ID); // staff_ID
            $this->setStartRecordNumber(1); // Reset start position
        }
    }

    // Load sort order parameters
    protected function loadSortOrder()
    {
        $orderBy = $this->getSessionOrderBy(); // Get ORDER BY from Session
        if ($orderBy == "") {
            $this->DefaultSort = "";
            if ($this->getSqlOrderBy() != "") {
                $useDefaultSort = true;
                if ($useDefaultSort) {
                    $orderBy = $this->getSqlOrderBy();
                    $this->setSessionOrderBy($orderBy);
                } else {
                    $this->setSessionOrderBy("");
                }
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
            if ($this->Command == "reset" || $this->Command == "resetall") {
                $this->resetSearchParms();
            }

            // Reset (clear) sorting order
            if ($this->Command == "resetsort") {
                $orderBy = "";
                $this->setSessionOrderBy($orderBy);
                $this->id->setSort("");
                $this->emprole->setSort("");
                $this->userstatus->setSort("");
                $this->firstname->setSort("");
                $this->lastname->setSort("");
                $this->userfullname->setSort("");
                $this->emailaddress->setSort("");
                $this->contactnumber->setSort("");
                $this->empipaddress->setSort("");
                $this->backgroundchk_status->setSort("");
                $this->emptemplock->setSort("");
                $this->empreasonlocked->setSort("");
                $this->emplockeddate->setSort("");
                $this->emppassword->setSort("");
                $this->createdby->setSort("");
                $this->modifiedby->setSort("");
                $this->createddate->setSort("");
                $this->modifieddate->setSort("");
                $this->isactive->setSort("");
                $this->staff_ID->setSort("");
                $this->modeofentry->setSort("");
                $this->other_modeofentry->setSort("");
                $this->entrycomments->setSort("");
                $this->selecteddate->setSort("");
                $this->company_id->setSort("");
                $this->profileimg->setSort("");
                $this->jobtitle_id->setSort("");
                $this->tourflag->setSort("");
                $this->themes->setSort("");
                $this->is_admin->setSort("");
                $this->role_id->setSort("");
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

        // Add group option item ("button")
        $item = &$this->ListOptions->addGroupOption();
        $item->Body = "";
        $item->OnLeft = false;
        $item->Visible = false;

        // "view"
        $item = &$this->ListOptions->add("view");
        $item->CssClass = "text-nowrap";
        $item->Visible = $Security->canView();
        $item->OnLeft = false;

        // "edit"
        $item = &$this->ListOptions->add("edit");
        $item->CssClass = "text-nowrap";
        $item->Visible = $Security->canEdit();
        $item->OnLeft = false;

        // "copy"
        $item = &$this->ListOptions->add("copy");
        $item->CssClass = "text-nowrap";
        $item->Visible = $Security->canAdd();
        $item->OnLeft = false;

        // "delete"
        $item = &$this->ListOptions->add("delete");
        $item->CssClass = "text-nowrap";
        $item->Visible = $Security->canDelete();
        $item->OnLeft = false;

        // List actions
        $item = &$this->ListOptions->add("listactions");
        $item->CssClass = "text-nowrap";
        $item->OnLeft = false;
        $item->Visible = false;
        $item->ShowInButtonGroup = false;
        $item->ShowInDropDown = false;

        // "checkbox"
        $item = &$this->ListOptions->add("checkbox");
        $item->Visible = false;
        $item->OnLeft = false;
        $item->Header = "<div class=\"form-check\"><input type=\"checkbox\" name=\"key\" id=\"key\" class=\"form-check-input\" data-ew-action=\"select-all-keys\"></div>";
        if ($item->OnLeft) {
            $item->moveTo(0);
        }
        $item->ShowInDropDown = false;
        $item->ShowInButtonGroup = false;

        // Drop down button for ListOptions
        $this->ListOptions->UseDropDownButton = false;
        $this->ListOptions->DropDownButtonPhrase = $Language->phrase("ButtonListOptions");
        $this->ListOptions->UseButtonGroup = false;
        if ($this->ListOptions->UseButtonGroup && IsMobile()) {
            $this->ListOptions->UseDropDownButton = true;
        }

        //$this->ListOptions->ButtonClass = ""; // Class for button group

        // Call ListOptions_Load event
        $this->listOptionsLoad();
        $this->setupListOptionsExt();
        $item = $this->ListOptions[$this->ListOptions->GroupOptionName];
        $item->Visible = $this->ListOptions->groupOptionVisible();
    }

    // Set up list options (extensions)
    protected function setupListOptionsExt()
    {
            // Set up list options (to be implemented by extensions)
    }

    // Render list options
    public function renderListOptions()
    {
        global $Security, $Language, $CurrentForm, $UserProfile;
        $this->ListOptions->loadDefault();

        // Call ListOptions_Rendering event
        $this->listOptionsRendering();
        $pageUrl = $this->pageUrl(false);
        if ($this->CurrentMode == "view") {
            // "view"
            $opt = $this->ListOptions["view"];
            $viewcaption = HtmlTitle($Language->phrase("ViewLink"));
            if ($Security->canView() && $this->showOptionLink("view")) {
                $opt->Body = "<a class=\"ew-row-link ew-view\" title=\"" . $viewcaption . "\" data-caption=\"" . $viewcaption . "\" href=\"" . HtmlEncode(GetUrl($this->ViewUrl)) . "\">" . $Language->phrase("ViewLink") . "</a>";
            } else {
                $opt->Body = "";
            }

            // "edit"
            $opt = $this->ListOptions["edit"];
            $editcaption = HtmlTitle($Language->phrase("EditLink"));
            if ($Security->canEdit() && $this->showOptionLink("edit")) {
                $opt->Body = "<a class=\"ew-row-link ew-edit\" title=\"" . HtmlTitle($Language->phrase("EditLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("EditLink")) . "\" href=\"" . HtmlEncode(GetUrl($this->EditUrl)) . "\">" . $Language->phrase("EditLink") . "</a>";
            } else {
                $opt->Body = "";
            }

            // "copy"
            $opt = $this->ListOptions["copy"];
            $copycaption = HtmlTitle($Language->phrase("CopyLink"));
            if ($Security->canAdd() && $this->showOptionLink("add")) {
                $opt->Body = "<a class=\"ew-row-link ew-copy\" title=\"" . $copycaption . "\" data-caption=\"" . $copycaption . "\" href=\"" . HtmlEncode(GetUrl($this->CopyUrl)) . "\">" . $Language->phrase("CopyLink") . "</a>";
            } else {
                $opt->Body = "";
            }

            // "delete"
            $opt = $this->ListOptions["delete"];
            if ($Security->canDelete() && $this->showOptionLink("delete")) {
                $opt->Body = "<a class=\"ew-row-link ew-delete\" data-ew-action=\"\" title=\"" . HtmlTitle($Language->phrase("DeleteLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("DeleteLink")) . "\" href=\"" . HtmlEncode(GetUrl($this->DeleteUrl)) . "\">" . $Language->phrase("DeleteLink") . "</a>";
            } else {
                $opt->Body = "";
            }
        } // End View mode

        // Set up list action buttons
        $opt = $this->ListOptions["listactions"];
        if ($opt && !$this->isExport() && !$this->CurrentAction) {
            $body = "";
            $links = [];
            foreach ($this->ListActions->Items as $listaction) {
                $action = $listaction->Action;
                $allowed = $listaction->Allow;
                if ($listaction->Select == ACTION_SINGLE && $allowed) {
                    $caption = $listaction->Caption;
                    $icon = ($listaction->Icon != "") ? "<i class=\"" . HtmlEncode(str_replace(" ew-icon", "", $listaction->Icon)) . "\" data-caption=\"" . HtmlTitle($caption) . "\"></i> " : "";
                    $link = "<li><button type=\"button\" class=\"dropdown-item ew-action ew-list-action\" data-caption=\"" . HtmlTitle($caption) . "\" data-ew-action=\"submit\" form=\"fmain_userslist\" data-key=\"" . $this->keyToJson(true) . "\"" . $listaction->toDataAttrs() . ">" . $icon . $listaction->Caption . "</button></li>";
                    if ($link != "") {
                        $links[] = $link;
                        if ($body == "") { // Setup first button
                            $body = "<button type=\"button\" class=\"btn btn-default ew-action ew-list-action\" title=\"" . HtmlTitle($caption) . "\" data-caption=\"" . HtmlTitle($caption) . "\" data-ew-action=\"submit\" form=\"fmain_userslist\" data-key=\"" . $this->keyToJson(true) . "\"" . $listaction->toDataAttrs() . ">" . $icon . $listaction->Caption . "</button>";
                        }
                    }
                }
            }
            if (count($links) > 1) { // More than one buttons, use dropdown
                $body = "<button class=\"dropdown-toggle btn btn-default ew-actions\" title=\"" . HtmlTitle($Language->phrase("ListActionButton")) . "\" data-bs-toggle=\"dropdown\">" . $Language->phrase("ListActionButton") . "</button>";
                $content = "";
                foreach ($links as $link) {
                    $content .= "<li>" . $link . "</li>";
                }
                $body .= "<ul class=\"dropdown-menu" . ($opt->OnLeft ? "" : " dropdown-menu-right") . "\">" . $content . "</ul>";
                $body = "<div class=\"btn-group btn-group-sm\">" . $body . "</div>";
            }
            if (count($links) > 0) {
                $opt->Body = $body;
            }
        }

        // "checkbox"
        $opt = $this->ListOptions["checkbox"];
        $opt->Body = "<div class=\"form-check\"><input type=\"checkbox\" id=\"key_m_" . $this->RowCount . "\" name=\"key_m[]\" class=\"form-check-input ew-multi-select\" value=\"" . HtmlEncode($this->id->CurrentValue) . "\" data-ew-action=\"select-key\"></div>";
        $this->renderListOptionsExt();

        // Call ListOptions_Rendered event
        $this->listOptionsRendered();
    }

    // Render list options (extensions)
    protected function renderListOptionsExt()
    {
        // Render list options (to be implemented by extensions)
        global $Security, $Language;
    }

    // Set up other options
    protected function setupOtherOptions()
    {
        global $Language, $Security;
        $options = &$this->OtherOptions;
        $option = $options["addedit"];

        // Add
        $item = &$option->add("add");
        $addcaption = HtmlTitle($Language->phrase("AddLink"));
        $item->Body = "<a class=\"ew-add-edit ew-add\" title=\"" . $addcaption . "\" data-caption=\"" . $addcaption . "\" href=\"" . HtmlEncode(GetUrl($this->AddUrl)) . "\">" . $Language->phrase("AddLink") . "</a>";
        $item->Visible = $this->AddUrl != "" && $Security->canAdd();
        $option = $options["action"];

        // Show column list for column visibility
        if ($this->UseColumnVisibility) {
            $option = $this->OtherOptions["column"];
            $item = &$option->addGroupOption();
            $item->Body = "";
            $item->Visible = $this->UseColumnVisibility;
            $option->add("id", $this->createColumnOption("id"));
            $option->add("userstatus", $this->createColumnOption("userstatus"));
            $option->add("firstname", $this->createColumnOption("firstname"));
            $option->add("lastname", $this->createColumnOption("lastname"));
            $option->add("emailaddress", $this->createColumnOption("emailaddress"));
            $option->add("contactnumber", $this->createColumnOption("contactnumber"));
            $option->add("staff_ID", $this->createColumnOption("staff_ID"));
        }

        // Set up options default
        foreach ($options as $name => $option) {
            if ($name != "column") { // Always use dropdown for column
                $option->UseDropDownButton = false;
                $option->UseButtonGroup = true;
            }
            //$option->ButtonClass = ""; // Class for button group
            $item = &$option->addGroupOption();
            $item->Body = "";
            $item->Visible = false;
        }
        $options["addedit"]->DropDownButtonPhrase = $Language->phrase("ButtonAddEdit");
        $options["detail"]->DropDownButtonPhrase = $Language->phrase("ButtonDetails");
        $options["action"]->DropDownButtonPhrase = $Language->phrase("ButtonActions");

        // Filter button
        $item = &$this->FilterOptions->add("savecurrentfilter");
        $item->Body = "<a class=\"ew-save-filter\" data-form=\"fmain_userssrch\" data-ew-action=\"none\">" . $Language->phrase("SaveCurrentFilter") . "</a>";
        $item->Visible = true;
        $item = &$this->FilterOptions->add("deletefilter");
        $item->Body = "<a class=\"ew-delete-filter\" data-form=\"fmain_userssrch\" data-ew-action=\"none\">" . $Language->phrase("DeleteFilter") . "</a>";
        $item->Visible = true;
        $this->FilterOptions->UseDropDownButton = true;
        $this->FilterOptions->UseButtonGroup = !$this->FilterOptions->UseDropDownButton;
        $this->FilterOptions->DropDownButtonPhrase = $Language->phrase("Filters");

        // Add group option item
        $item = &$this->FilterOptions->addGroupOption();
        $item->Body = "";
        $item->Visible = false;
    }

    // Create new column option
    public function createColumnOption($name)
    {
        $field = $this->Fields[$name] ?? false;
        if ($field && $field->Visible) {
            $item = new ListOption($field->Name);
            $item->Body = '<button class="dropdown-item">' . 
                '<div class="form-check ew-dropdown-checkbox">' .
                '<div class="form-check-input ew-dropdown-check-input" data-field="' . $field->Param . '"></div>' .
                '<label class="form-check-label ew-dropdown-check-label">' . $field->caption() . '</label></div></button>';
            return $item;
        }
        return null;
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
                $icon = ($listaction->Icon != "") ? '<i class="' . HtmlEncode($listaction->Icon) . '" data-caption="' . HtmlEncode($caption) . '"></i>' . $caption : $caption;
                $item->Body = '<button type="button" class="btn btn-default ew-action ew-list-action" title="' . HtmlEncode($caption) . '" data-caption="' . HtmlEncode($caption) . '" data-ew-action="submit" form="fmain_userslist"' . $listaction->toDataAttrs() . '>' . $icon . '</button>';
                $item->Visible = $listaction->Allow;
            }
        }

        // Hide grid edit and other options
        if ($this->TotalRecords <= 0) {
            $option = $options["addedit"];
            $item = $option["gridedit"];
            if ($item) {
                $item->Visible = false;
            }
            $option = $options["action"];
            $option->hideAllOptions();
        }
    }

    // Process list action
    protected function processListAction()
    {
        global $Language, $Security, $Response;
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
                    if (Post("ajax") == $userAction) { // Ajax
                        echo "<p class=\"text-danger\">" . $errmsg . "</p>";
                        return true;
                    } else {
                        $this->setFailureMessage($errmsg);
                        return false;
                    }
                }
            }
            $this->CurrentFilter = $filter;
            $sql = $this->getCurrentSql();
            $conn = $this->getConnection();
            $rs = LoadRecordset($sql, $conn);
            $this->UserAction = $userAction;
            $this->ActionValue = Post("actionvalue");

            // Call row action event
            if ($rs) {
                if ($this->UseTransaction) {
                    $conn->beginTransaction();
                }
                $this->SelectedCount = $rs->recordCount();
                $this->SelectedIndex = 0;
                while (!$rs->EOF) {
                    $this->SelectedIndex++;
                    $row = $rs->fields;
                    $user = GetUserInfo(Config("LOGIN_USERNAME_FIELD_NAME"), $row);
                    if ($userlist != "") {
                        $userlist .= ",";
                    }
                    $userlist .= $user;
                    if ($userAction == "resendregisteremail") {
                        $processed = false;
                    } elseif ($userAction == "resetconcurrentuser") {
                        $processed = false;
                    } elseif ($userAction == "resetloginretry") {
                        $processed = false;
                    } elseif ($userAction == "setpasswordexpired") {
                        $processed = false;
                    } elseif ($userAction == "resetusersecret") {
                        $processed = false;
                    } else {
                        $processed = $this->rowCustomAction($userAction, $row);
                     }
                    if (!$processed) {
                        break;
                    }
                    $rs->moveNext();
                }
                if ($processed) {
                    if ($this->UseTransaction) { // Commit transaction
                        $conn->commit();
                    }
                    if ($this->getSuccessMessage() == "" && !ob_get_length() && !$Response->getBody()->getSize()) { // No output
                        $this->setSuccessMessage(str_replace('%s', $actionCaption, $Language->phrase("CustomActionCompleted"))); // Set up success message
                    }
                } else {
                    if ($this->UseTransaction) { // Rollback transaction
                        $conn->rollback();
                    }

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
            if ($rs) {
                $rs->close();
            }
            if (Post("ajax") == $userAction) { // Ajax
                if ($this->getSuccessMessage() != "") {
                    echo "<p class=\"text-success\">" . $this->getSuccessMessage() . "</p>";
                    $this->clearSuccessMessage(); // Clear message
                }
                if ($this->getFailureMessage() != "") {
                    echo "<p class=\"text-danger\">" . $this->getFailureMessage() . "</p>";
                    $this->clearFailureMessage(); // Clear message
                }
                return true;
            }
        }
        return false; // Not ajax request
    }

    // Load basic search values
    protected function loadBasicSearchValues()
    {
        $this->BasicSearch->setKeyword(Get(Config("TABLE_BASIC_SEARCH"), ""), false);
        if ($this->BasicSearch->Keyword != "" && $this->Command == "") {
            $this->Command = "search";
        }
        $this->BasicSearch->setType(Get(Config("TABLE_BASIC_SEARCH_TYPE"), ""), false);
    }

    // Load recordset
    public function loadRecordset($offset = -1, $rowcnt = -1)
    {
        // Load List page SQL (QueryBuilder)
        $sql = $this->getListSql();

        // Load recordset
        if ($offset > -1) {
            $sql->setFirstResult($offset);
        }
        if ($rowcnt > 0) {
            $sql->setMaxResults($rowcnt);
        }
        $result = $sql->execute();
        $rs = new Recordset($result, $sql);

        // Call Recordset Selected event
        $this->recordsetSelected($rs);
        return $rs;
    }

    // Load records as associative array
    public function loadRows($offset = -1, $rowcnt = -1)
    {
        // Load List page SQL (QueryBuilder)
        $sql = $this->getListSql();

        // Load recordset
        if ($offset > -1) {
            $sql->setFirstResult($offset);
        }
        if ($rowcnt > 0) {
            $sql->setMaxResults($rowcnt);
        }
        $result = $sql->execute();
        return $result->fetchAll(FetchMode::ASSOCIATIVE);
    }

    /**
     * Load row based on key values
     *
     * @return void
     */
    public function loadRow()
    {
        global $Security, $Language;
        $filter = $this->getRecordFilter();

        // Call Row Selecting event
        $this->rowSelecting($filter);

        // Load SQL based on filter
        $this->CurrentFilter = $filter;
        $sql = $this->getCurrentSql();
        $conn = $this->getConnection();
        $res = false;
        $row = $conn->fetchAssociative($sql);
        if ($row) {
            $res = true;
            $this->loadRowValues($row); // Load row values
        }
        return $res;
    }

    /**
     * Load row values from recordset or record
     *
     * @param Recordset|array $rs Record
     * @return void
     */
    public function loadRowValues($rs = null)
    {
        if (is_array($rs)) {
            $row = $rs;
        } elseif ($rs && property_exists($rs, "fields")) { // Recordset
            $row = $rs->fields;
        } else {
            $row = $this->newRow();
        }
        if (!$row) {
            return;
        }

        // Call Row Selected event
        $this->rowSelected($row);
        $this->id->setDbValue($row['id']);
        $this->emprole->setDbValue($row['emprole']);
        $this->userstatus->setDbValue($row['userstatus']);
        $this->firstname->setDbValue($row['firstname']);
        $this->lastname->setDbValue($row['lastname']);
        $this->userfullname->setDbValue($row['userfullname']);
        $this->emailaddress->setDbValue($row['emailaddress']);
        $this->contactnumber->setDbValue($row['contactnumber']);
        $this->empipaddress->setDbValue($row['empipaddress']);
        $this->backgroundchk_status->setDbValue($row['backgroundchk_status']);
        $this->emptemplock->setDbValue($row['emptemplock']);
        $this->empreasonlocked->setDbValue($row['empreasonlocked']);
        $this->emplockeddate->setDbValue($row['emplockeddate']);
        $this->emppassword->setDbValue($row['emppassword']);
        $this->createdby->setDbValue($row['createdby']);
        $this->modifiedby->setDbValue($row['modifiedby']);
        $this->createddate->setDbValue($row['createddate']);
        $this->modifieddate->setDbValue($row['modifieddate']);
        $this->isactive->setDbValue($row['isactive']);
        $this->staff_ID->setDbValue($row['staff_ID']);
        $this->modeofentry->setDbValue($row['modeofentry']);
        $this->other_modeofentry->setDbValue($row['other_modeofentry']);
        $this->entrycomments->setDbValue($row['entrycomments']);
        $this->selecteddate->setDbValue($row['selecteddate']);
        $this->company_id->setDbValue($row['company_id']);
        $this->profileimg->Upload->DbValue = $row['profileimg'];
        $this->profileimg->setDbValue($this->profileimg->Upload->DbValue);
        $this->jobtitle_id->setDbValue($row['jobtitle_id']);
        $this->tourflag->setDbValue($row['tourflag']);
        $this->themes->setDbValue($row['themes']);
        $this->is_admin->setDbValue($row['is_admin']);
        $this->role_id->setDbValue($row['role_id']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $row = [];
        $row['id'] = null;
        $row['emprole'] = null;
        $row['userstatus'] = null;
        $row['firstname'] = null;
        $row['lastname'] = null;
        $row['userfullname'] = null;
        $row['emailaddress'] = null;
        $row['contactnumber'] = null;
        $row['empipaddress'] = null;
        $row['backgroundchk_status'] = null;
        $row['emptemplock'] = null;
        $row['empreasonlocked'] = null;
        $row['emplockeddate'] = null;
        $row['emppassword'] = null;
        $row['createdby'] = null;
        $row['modifiedby'] = null;
        $row['createddate'] = null;
        $row['modifieddate'] = null;
        $row['isactive'] = null;
        $row['staff_ID'] = null;
        $row['modeofentry'] = null;
        $row['other_modeofentry'] = null;
        $row['entrycomments'] = null;
        $row['selecteddate'] = null;
        $row['company_id'] = null;
        $row['profileimg'] = null;
        $row['jobtitle_id'] = null;
        $row['tourflag'] = null;
        $row['themes'] = null;
        $row['is_admin'] = null;
        $row['role_id'] = null;
        return $row;
    }

    // Load old record
    protected function loadOldRecord()
    {
        // Load old record
        $this->OldRecordset = null;
        $validKey = $this->OldKey != "";
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

        // Call Row_Rendering event
        $this->rowRendering();

        // Common render codes for all row types

        // id

        // emprole

        // userstatus

        // firstname

        // lastname

        // userfullname

        // emailaddress

        // contactnumber

        // empipaddress

        // backgroundchk_status

        // emptemplock

        // empreasonlocked

        // emplockeddate

        // emppassword

        // createdby

        // modifiedby

        // createddate

        // modifieddate

        // isactive

        // staff_ID

        // modeofentry

        // other_modeofentry

        // entrycomments

        // selecteddate

        // company_id

        // profileimg

        // jobtitle_id

        // tourflag

        // themes

        // is_admin

        // role_id

        // View row
        if ($this->RowType == ROWTYPE_VIEW) {
            // id
            $this->id->ViewValue = $this->id->CurrentValue;
            $this->id->ViewCustomAttributes = "";

            // emprole
            if ($Security->canAdmin()) { // System admin
                $curVal = strval($this->emprole->CurrentValue);
                if ($curVal != "") {
                    $this->emprole->ViewValue = $this->emprole->lookupCacheOption($curVal);
                    if ($this->emprole->ViewValue === null) { // Lookup from database
                        $filterWrk = "`userlevelid`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                        $sqlWrk = $this->emprole->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                        $conn = Conn();
                        $config = $conn->getConfiguration();
                        $config->setResultCacheImpl($this->Cache);
                        $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                        $ari = count($rswrk);
                        if ($ari > 0) { // Lookup values found
                            $arwrk = $this->emprole->Lookup->renderViewRow($rswrk[0]);
                            $this->emprole->ViewValue = $this->emprole->displayValue($arwrk);
                        } else {
                            $this->emprole->ViewValue = $this->emprole->CurrentValue;
                        }
                    }
                } else {
                    $this->emprole->ViewValue = null;
                }
            } else {
                $this->emprole->ViewValue = $Language->phrase("PasswordMask");
            }
            $this->emprole->ViewCustomAttributes = "";

            // userstatus
            if (strval($this->userstatus->CurrentValue) != "") {
                $this->userstatus->ViewValue = $this->userstatus->optionCaption($this->userstatus->CurrentValue);
            } else {
                $this->userstatus->ViewValue = null;
            }
            $this->userstatus->ViewCustomAttributes = "";

            // firstname
            $this->firstname->ViewValue = $this->firstname->CurrentValue;
            $this->firstname->ViewCustomAttributes = "";

            // lastname
            $this->lastname->ViewValue = $this->lastname->CurrentValue;
            $this->lastname->ViewCustomAttributes = "";

            // userfullname
            $this->userfullname->ViewValue = $this->userfullname->CurrentValue;
            $this->userfullname->ViewCustomAttributes = "";

            // emailaddress
            $this->emailaddress->ViewValue = $this->emailaddress->CurrentValue;
            $this->emailaddress->ViewCustomAttributes = "";

            // contactnumber
            $this->contactnumber->ViewValue = $this->contactnumber->CurrentValue;
            $this->contactnumber->ViewCustomAttributes = "";

            // empipaddress
            $this->empipaddress->ViewValue = $this->empipaddress->CurrentValue;
            $this->empipaddress->ViewCustomAttributes = "";

            // backgroundchk_status
            if (strval($this->backgroundchk_status->CurrentValue) != "") {
                $this->backgroundchk_status->ViewValue = $this->backgroundchk_status->optionCaption($this->backgroundchk_status->CurrentValue);
            } else {
                $this->backgroundchk_status->ViewValue = null;
            }
            $this->backgroundchk_status->ViewCustomAttributes = "";

            // emptemplock
            $this->emptemplock->ViewValue = $this->emptemplock->CurrentValue;
            $this->emptemplock->ViewValue = FormatNumber($this->emptemplock->ViewValue, "");
            $this->emptemplock->ViewCustomAttributes = "";

            // empreasonlocked
            $this->empreasonlocked->ViewValue = $this->empreasonlocked->CurrentValue;
            $this->empreasonlocked->ViewCustomAttributes = "";

            // emplockeddate
            $this->emplockeddate->ViewValue = $this->emplockeddate->CurrentValue;
            $this->emplockeddate->ViewValue = FormatDateTime($this->emplockeddate->ViewValue, 0);
            $this->emplockeddate->ViewCustomAttributes = "";

            // emppassword
            $this->emppassword->ViewValue = $this->emppassword->CurrentValue;
            $this->emppassword->ViewCustomAttributes = "";

            // createdby
            $this->createdby->ViewValue = $this->createdby->CurrentValue;
            $this->createdby->ViewValue = FormatNumber($this->createdby->ViewValue, "");
            $this->createdby->ViewCustomAttributes = "";

            // modifiedby
            $this->modifiedby->ViewValue = $this->modifiedby->CurrentValue;
            $this->modifiedby->ViewValue = FormatNumber($this->modifiedby->ViewValue, "");
            $this->modifiedby->ViewCustomAttributes = "";

            // createddate
            $this->createddate->ViewValue = $this->createddate->CurrentValue;
            $this->createddate->ViewValue = FormatDateTime($this->createddate->ViewValue, 0);
            $this->createddate->ViewCustomAttributes = "";

            // modifieddate
            $this->modifieddate->ViewValue = $this->modifieddate->CurrentValue;
            $this->modifieddate->ViewValue = FormatDateTime($this->modifieddate->ViewValue, 0);
            $this->modifieddate->ViewCustomAttributes = "";

            // isactive
            $this->isactive->ViewValue = $this->isactive->CurrentValue;
            $this->isactive->ViewValue = FormatNumber($this->isactive->ViewValue, "");
            $this->isactive->ViewCustomAttributes = "";

            // staff_ID
            $this->staff_ID->ViewValue = $this->staff_ID->CurrentValue;
            $this->staff_ID->ViewCustomAttributes = "";

            // modeofentry
            $this->modeofentry->ViewValue = $this->modeofentry->CurrentValue;
            $this->modeofentry->ViewCustomAttributes = "";

            // other_modeofentry
            $this->other_modeofentry->ViewValue = $this->other_modeofentry->CurrentValue;
            $this->other_modeofentry->ViewCustomAttributes = "";

            // entrycomments
            $this->entrycomments->ViewValue = $this->entrycomments->CurrentValue;
            $this->entrycomments->ViewCustomAttributes = "";

            // selecteddate
            $this->selecteddate->ViewValue = $this->selecteddate->CurrentValue;
            $this->selecteddate->ViewValue = FormatDateTime($this->selecteddate->ViewValue, 0);
            $this->selecteddate->ViewCustomAttributes = "";

            // company_id
            $this->company_id->ViewValue = $this->company_id->CurrentValue;
            $this->company_id->ViewValue = FormatNumber($this->company_id->ViewValue, "");
            $this->company_id->ViewCustomAttributes = "";

            // profileimg
            if (!EmptyValue($this->profileimg->Upload->DbValue)) {
                $this->profileimg->ImageWidth = 80;
                $this->profileimg->ImageHeight = 80;
                $this->profileimg->ImageAlt = $this->profileimg->alt();
                $this->profileimg->ImageCssClass = "ew-image";
                $this->profileimg->ViewValue = $this->profileimg->Upload->DbValue;
            } else {
                $this->profileimg->ViewValue = "";
            }
            $this->profileimg->ViewCustomAttributes = "";

            // jobtitle_id
            $this->jobtitle_id->ViewValue = $this->jobtitle_id->CurrentValue;
            $this->jobtitle_id->ViewValue = FormatNumber($this->jobtitle_id->ViewValue, "");
            $this->jobtitle_id->ViewCustomAttributes = "";

            // tourflag
            $this->tourflag->ViewValue = $this->tourflag->CurrentValue;
            $this->tourflag->ViewValue = FormatNumber($this->tourflag->ViewValue, "");
            $this->tourflag->ViewCustomAttributes = "";

            // themes
            if (strval($this->themes->CurrentValue) != "") {
                $this->themes->ViewValue = $this->themes->optionCaption($this->themes->CurrentValue);
            } else {
                $this->themes->ViewValue = null;
            }
            $this->themes->ViewCustomAttributes = "";

            // is_admin
            $this->is_admin->ViewValue = $this->is_admin->CurrentValue;
            $this->is_admin->ViewValue = FormatNumber($this->is_admin->ViewValue, "");
            $this->is_admin->ViewCustomAttributes = "";

            // role_id
            $this->role_id->ViewValue = $this->role_id->CurrentValue;
            $this->role_id->ViewValue = FormatNumber($this->role_id->ViewValue, "");
            $this->role_id->ViewCustomAttributes = "";

            // id
            $this->id->LinkCustomAttributes = "";
            $this->id->HrefValue = "";
            $this->id->TooltipValue = "";

            // userstatus
            $this->userstatus->LinkCustomAttributes = "";
            $this->userstatus->HrefValue = "";
            $this->userstatus->TooltipValue = "";

            // firstname
            $this->firstname->LinkCustomAttributes = "";
            $this->firstname->HrefValue = "";
            $this->firstname->TooltipValue = "";

            // lastname
            $this->lastname->LinkCustomAttributes = "";
            $this->lastname->HrefValue = "";
            $this->lastname->TooltipValue = "";

            // emailaddress
            $this->emailaddress->LinkCustomAttributes = "";
            $this->emailaddress->HrefValue = "";
            $this->emailaddress->TooltipValue = "";

            // contactnumber
            $this->contactnumber->LinkCustomAttributes = "";
            $this->contactnumber->HrefValue = "";
            $this->contactnumber->TooltipValue = "";

            // staff_ID
            $this->staff_ID->LinkCustomAttributes = "";
            $this->staff_ID->HrefValue = "";
            $this->staff_ID->TooltipValue = "";
        }

        // Call Row Rendered event
        if ($this->RowType != ROWTYPE_AGGREGATEINIT) {
            $this->rowRendered();
        }
    }

    // Get export HTML tag
    protected function getExportTag($type, $custom = false)
    {
        global $Language;
        $pageUrl = $this->pageUrl();
        $exportUrl = GetUrl($pageUrl . "export=" . $type . ($custom ? "&amp;custom=1" : ""));
        if (SameText($type, "excel")) {
            if ($custom) {
                return "<button type=\"button\" class=\"btn btn-default ew-export-link ew-excel\" title=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" form=\"fmain_userslist\" data-url=\"$exportUrl\" data-ew-action=\"export\" data-export=\"excel\" data-custom=\"true\" data-export-selected=\"false\">" . $Language->phrase("ExportToExcel") . "</button>";
            } else {
                return "<a href=\"$exportUrl\" class=\"btn btn-default ew-export-link ew-excel\" title=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\">" . $Language->phrase("ExportToExcel") . "</a>";
            }
        } elseif (SameText($type, "word")) {
            if ($custom) {
                return "<button type=\"button\" class=\"btn btn-default ew-export-link ew-word\" title=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" form=\"fmain_userslist\" data-url=\"$exportUrl\" data-ew-action=\"export\" data-export=\"word\" data-custom=\"true\" data-export-selected=\"false\">" . $Language->phrase("ExportToWord") . "</button>";
            } else {
                return "<a href=\"$exportUrl\" class=\"btn btn-default ew-export-link ew-word\" title=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\">" . $Language->phrase("ExportToWord") . "</a>";
            }
        } elseif (SameText($type, "pdf")) {
            if ($custom) {
                return "<button type=\"button\" class=\"btn btn-default ew-export-link ew-pdf\" title=\"" . HtmlEncode($Language->phrase("ExportToPdfText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToPdfText")) . "\" form=\"fmain_userslist\" data-url=\"$exportUrl\" data-ew-action=\"export\" data-export=\"pdf\" data-custom=\"true\" data-export-selected=\"false\">" . $Language->phrase("ExportToPdf") . "</button>";
            } else {
                return "<a href=\"$exportUrl\" class=\"btn btn-default ew-export-link ew-pdf\" title=\"" . HtmlEncode($Language->phrase("ExportToPdfText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToPdfText")) . "\">" . $Language->phrase("ExportToPdf") . "</a>";
            }
        } elseif (SameText($type, "html")) {
            return "<a href=\"$exportUrl\" class=\"btn btn-default ew-export-link ew-html\" title=\"" . HtmlEncode($Language->phrase("ExportToHtmlText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToHtmlText")) . "\">" . $Language->phrase("ExportToHtml") . "</a>";
        } elseif (SameText($type, "xml")) {
            return "<a href=\"$exportUrl\" class=\"btn btn-default ew-export-link ew-xml\" title=\"" . HtmlEncode($Language->phrase("ExportToXmlText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToXmlText")) . "\">" . $Language->phrase("ExportToXml") . "</a>";
        } elseif (SameText($type, "csv")) {
            return "<a href=\"$exportUrl\" class=\"btn btn-default ew-export-link ew-csv\" title=\"" . HtmlEncode($Language->phrase("ExportToCsvText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToCsvText")) . "\">" . $Language->phrase("ExportToCsv") . "</a>";
        } elseif (SameText($type, "email")) {
            $url = $custom ? ' data-url="' . $exportUrl . '"' : '';
            return '<button type="button" class="btn btn-default ew-export-link ew-email" title="' . $Language->phrase("ExportToEmailText") . '" data-caption="' . $Language->phrase("ExportToEmailText") . '" form="fmain_userslist" data-ew-action="email" data-hdr="' . $Language->phrase("ExportToEmailText") . '" data-sel="false"' . $url . '>' . $Language->phrase("ExportToEmail") . '</button>';
        } elseif (SameText($type, "print")) {
            return "<a href=\"$exportUrl\" class=\"btn btn-default ew-export-link ew-print\" title=\"" . HtmlEncode($Language->phrase("ExportToPrintText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToPrintText")) . "\">" . $Language->phrase("PrinterFriendly") . "</a>";
        }
    }

    // Set up export options
    protected function setupExportOptions()
    {
        global $Language;

        // Printer friendly
        $item = &$this->ExportOptions->add("print");
        $item->Body = $this->getExportTag("print");
        $item->Visible = false;

        // Export to Excel
        $item = &$this->ExportOptions->add("excel");
        $item->Body = $this->getExportTag("excel");
        $item->Visible = true;

        // Export to Word
        $item = &$this->ExportOptions->add("word");
        $item->Body = $this->getExportTag("word");
        $item->Visible = false;

        // Export to HTML
        $item = &$this->ExportOptions->add("html");
        $item->Body = $this->getExportTag("html");
        $item->Visible = false;

        // Export to XML
        $item = &$this->ExportOptions->add("xml");
        $item->Body = $this->getExportTag("xml");
        $item->Visible = false;

        // Export to CSV
        $item = &$this->ExportOptions->add("csv");
        $item->Body = $this->getExportTag("csv");
        $item->Visible = true;

        // Export to PDF
        $item = &$this->ExportOptions->add("pdf");
        $item->Body = $this->getExportTag("pdf");
        $item->Visible = false;

        // Export to Email
        $item = &$this->ExportOptions->add("email");
        $item->Body = $this->getExportTag("email");
        $item->Visible = false;

        // Drop down button for export
        $this->ExportOptions->UseButtonGroup = true;
        $this->ExportOptions->UseDropDownButton = false;
        if ($this->ExportOptions->UseButtonGroup && IsMobile()) {
            $this->ExportOptions->UseDropDownButton = true;
        }
        $this->ExportOptions->DropDownButtonPhrase = $Language->phrase("ButtonExport");

        // Add group option item
        $item = &$this->ExportOptions->addGroupOption();
        $item->Body = "";
        $item->Visible = false;
    }

    // Set up search options
    protected function setupSearchOptions()
    {
        global $Language, $Security;
        $pageUrl = $this->pageUrl();
        $this->SearchOptions = new ListOptions(["TagClassName" => "ew-search-option"]);

        // Search button
        $item = &$this->SearchOptions->add("searchtoggle");
        $searchToggleClass = ($this->SearchWhere != "") ? " active" : " active";
        $item->Body = "<a class=\"btn btn-default ew-search-toggle" . $searchToggleClass . "\" href=\"#\" role=\"button\" title=\"" . $Language->phrase("SearchPanel") . "\" data-caption=\"" . $Language->phrase("SearchPanel") . "\" data-bs-toggle=\"button\" data-form=\"fmain_userssrch\" aria-pressed=\"" . ($searchToggleClass == " active" ? "true" : "false") . "\">" . $Language->phrase("SearchLink") . "</a>";
        $item->Visible = true;

        // Show all button
        $item = &$this->SearchOptions->add("showall");
        $item->Body = "<a class=\"btn btn-default ew-show-all\" title=\"" . $Language->phrase("ShowAll") . "\" data-caption=\"" . $Language->phrase("ShowAll") . "\" href=\"" . $pageUrl . "cmd=reset\">" . $Language->phrase("ShowAllBtn") . "</a>";
        $item->Visible = ($this->SearchWhere != $this->DefaultSearchWhere && $this->SearchWhere != "0=101");

        // Button group for search
        $this->SearchOptions->UseDropDownButton = false;
        $this->SearchOptions->UseButtonGroup = true;
        $this->SearchOptions->DropDownButtonPhrase = $Language->phrase("ButtonSearch");

        // Add group option item
        $item = &$this->SearchOptions->addGroupOption();
        $item->Body = "";
        $item->Visible = false;

        // Hide search options
        if ($this->isExport() || $this->CurrentAction) {
            $this->SearchOptions->hideAllOptions();
        }
        if (!$Security->canSearch()) {
            $this->SearchOptions->hideAllOptions();
            $this->FilterOptions->hideAllOptions();
        }
    }

    // Check if any search fields
    public function hasSearchFields()
    {
        return true;
    }

    // Render search options
    protected function renderSearchOptions()
    {
        if (!$this->hasSearchFields() && $this->SearchOptions["searchtoggle"]) {
            $this->SearchOptions["searchtoggle"]->Visible = false;
        }
    }

    /**
    * Export data in HTML/CSV/Word/Excel/XML/Email/PDF format
    *
    * @param bool $return Return the data rather than output it
    * @return mixed
    */
    public function exportData($return = false)
    {
        global $Language;
        $utf8 = SameText(Config("PROJECT_CHARSET"), "utf-8");

        // Load recordset
        $this->TotalRecords = $this->listRecordCount();
        $this->StartRecord = 1;

        // Export all
        if ($this->ExportAll) {
            if (Config("EXPORT_ALL_TIME_LIMIT") >= 0) {
                @set_time_limit(Config("EXPORT_ALL_TIME_LIMIT"));
            }
            $this->DisplayRecords = $this->TotalRecords;
            $this->StopRecord = $this->TotalRecords;
        } else { // Export one page only
            $this->setupStartRecord(); // Set up start record position
            // Set the last record to display
            if ($this->DisplayRecords <= 0) {
                $this->StopRecord = $this->TotalRecords;
            } else {
                $this->StopRecord = $this->StartRecord + $this->DisplayRecords - 1;
            }
        }
        $rs = $this->loadRecordset($this->StartRecord - 1, $this->DisplayRecords <= 0 ? $this->TotalRecords : $this->DisplayRecords);
        $this->ExportDoc = GetExportDocument($this, "h");
        $doc = &$this->ExportDoc;
        if (!$doc) {
            $this->setFailureMessage($Language->phrase("ExportClassNotFound")); // Export class not found
        }
        if (!$rs || !$doc) {
            RemoveHeader("Content-Type"); // Remove header
            RemoveHeader("Content-Disposition");
            $this->showMessage();
            return;
        }
        $this->StartRecord = 1;
        $this->StopRecord = $this->DisplayRecords <= 0 ? $this->TotalRecords : $this->DisplayRecords;

        // Call Page Exporting server event
        $this->ExportDoc->ExportCustom = !$this->pageExporting();
        $header = $this->PageHeader;
        $this->pageDataRendering($header);
        $doc->Text .= $header;
        $this->exportDocument($doc, $rs, $this->StartRecord, $this->StopRecord, "");
        $footer = $this->PageFooter;
        $this->pageDataRendered($footer);
        $doc->Text .= $footer;

        // Close recordset
        $rs->close();

        // Call Page Exported server event
        $this->pageExported();

        // Export header and footer
        $doc->exportHeaderAndFooter();

        // Clean output buffer (without destroying output buffer)
        $buffer = ob_get_contents(); // Save the output buffer
        if (!Config("DEBUG") && $buffer) {
            ob_clean();
        }

        // Write debug message if enabled
        if (Config("DEBUG") && !$this->isExport("pdf")) {
            echo GetDebugMessage();
        }

        // Output data
        if ($this->isExport("email")) {
            // Export-to-email disabled
        } else {
            $doc->export();
            if ($return) {
                RemoveHeader("Content-Type"); // Remove header
                RemoveHeader("Content-Disposition");
                $content = ob_get_contents();
                if ($content) {
                    ob_clean();
                }
                if ($buffer) {
                    echo $buffer; // Resume the output buffer
                }
                return $content;
            }
        }
    }

    // Show link optionally based on User ID
    protected function showOptionLink($id = "")
    {
        global $Security;
        if ($Security->isLoggedIn() && !$Security->isAdmin() && !$this->userIDAllow($id)) {
            return $Security->isValidUserID($this->id->CurrentValue);
        }
        return true;
    }

    // Set up Breadcrumb
    protected function setupBreadcrumb()
    {
        global $Breadcrumb, $Language;
        $Breadcrumb = new Breadcrumb("index");
        $url = CurrentUrl();
        $url = preg_replace('/\?cmd=reset(all){0,1}$/i', '', $url); // Remove cmd=reset / cmd=resetall
        $Breadcrumb->add("list", $this->TableVar, $url, "", $this->TableVar, true);
    }

    // Setup lookup options
    public function setupLookupOptions($fld)
    {
        if ($fld->Lookup !== null && $fld->Lookup->Options === null) {
            // Get default connection and filter
            $conn = $this->getConnection();
            $lookupFilter = "";

            // No need to check any more
            $fld->Lookup->Options = [];

            // Set up lookup SQL and connection
            switch ($fld->FieldVar) {
                case "x_emprole":
                    break;
                case "x_userstatus":
                    break;
                case "x_backgroundchk_status":
                    break;
                case "x_themes":
                    break;
                default:
                    $lookupFilter = "";
                    break;
            }

            // Always call to Lookup->getSql so that user can setup Lookup->Options in Lookup_Selecting server event
            $sql = $fld->Lookup->getSql(false, "", $lookupFilter, $this);

            // Set up lookup cache
            if (!$fld->hasLookupOptions() && $fld->UseLookupCache && $sql != "" && count($fld->Lookup->Options) == 0) {
                $totalCnt = $this->getRecordCount($sql, $conn);
                if ($totalCnt > $fld->LookupCacheCount) { // Total count > cache count, do not cache
                    return;
                }
                $rows = $conn->executeQuery($sql)->fetchAll();
                $ar = [];
                foreach ($rows as $row) {
                    $row = $fld->Lookup->renderViewRow($row, Container($fld->Lookup->LinkTable));
                    $ar[strval($row["lf"])] = $row;
                }
                $fld->Lookup->Options = $ar;
            }
        }
    }

    // Set up starting record parameters
    public function setupStartRecord()
    {
        if ($this->DisplayRecords == 0) {
            return;
        }
        if ($this->isPageRequest()) { // Validate request
            $startRec = Get(Config("TABLE_START_REC"));
            $pageNo = Get(Config("TABLE_PAGE_NO"));
            if ($pageNo !== null) { // Check for "pageno" parameter first
                $pageNo = ParseInteger($pageNo);
                if (is_numeric($pageNo)) {
                    $this->StartRecord = ($pageNo - 1) * $this->DisplayRecords + 1;
                    if ($this->StartRecord <= 0) {
                        $this->StartRecord = 1;
                    } elseif ($this->StartRecord >= (int)(($this->TotalRecords - 1) / $this->DisplayRecords) * $this->DisplayRecords + 1) {
                        $this->StartRecord = (int)(($this->TotalRecords - 1) / $this->DisplayRecords) * $this->DisplayRecords + 1;
                    }
                    $this->setStartRecordNumber($this->StartRecord);
                }
            } elseif ($startRec !== null) { // Check for "start" parameter
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
            $this->StartRecord = (int)(($this->TotalRecords - 1) / $this->DisplayRecords) * $this->DisplayRecords + 1; // Point to last page first record
            $this->setStartRecordNumber($this->StartRecord);
        } elseif (($this->StartRecord - 1) % $this->DisplayRecords != 0) {
            $this->StartRecord = (int)(($this->StartRecord - 1) / $this->DisplayRecords) * $this->DisplayRecords + 1; // Point to page boundary
            $this->setStartRecordNumber($this->StartRecord);
        }
    }

    // Page Load event
    public function pageLoad()
    {
        //Log("Page Load");
    }

    // Page Unload event
    public function pageUnload()
    {
        //Log("Page Unload");
    }

    // Page Redirecting event
    public function pageRedirecting(&$url)
    {
        // Example:
        //$url = "your URL";
    }

    // Message Showing event
    // $type = ''|'success'|'failure'|'warning'
    public function messageShowing(&$msg, $type)
    {
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
    public function pageRender()
    {
        //Log("Page Render");
    }

    // Page Data Rendering event
    public function pageDataRendering(&$header)
    {
        // Example:
        //$header = "your header";
    }

    // Page Data Rendered event
    public function pageDataRendered(&$footer)
    {
        // Example:
        //$footer = "your footer";
    }

    // Form Custom Validate event
    public function formCustomValidate(&$customError)
    {
        // Return error message in $customError
        return true;
    }

    // ListOptions Load event
    public function listOptionsLoad()
    {
        // Example:
        //$opt = &$this->ListOptions->Add("new");
        //$opt->Header = "xxx";
        //$opt->OnLeft = true; // Link on left
        //$opt->MoveTo(0); // Move to first column
    }

    // ListOptions Rendering event
    public function listOptionsRendering()
    {
        //Container("DetailTableGrid")->DetailAdd = (...condition...); // Set to true or false conditionally
        //Container("DetailTableGrid")->DetailEdit = (...condition...); // Set to true or false conditionally
        //Container("DetailTableGrid")->DetailView = (...condition...); // Set to true or false conditionally
    }

    // ListOptions Rendered event
    public function listOptionsRendered()
    {
        // Example:
        //$this->ListOptions["new"]->Body = "xxx";
    }

    // Row Custom Action event
    public function rowCustomAction($action, $row)
    {
        // Return false to abort
        return true;
    }

    // Page Exporting event
    // $this->ExportDoc = export document object
    public function pageExporting()
    {
        //$this->ExportDoc->Text = "my header"; // Export header
        //return false; // Return false to skip default export and use Row_Export event
        return true; // Return true to use default export and skip Row_Export event
    }

    // Row Export event
    // $this->ExportDoc = export document object
    public function rowExport($rs)
    {
        //$this->ExportDoc->Text .= "my content"; // Build HTML with field value: $rs["MyField"] or $this->MyField->ViewValue
    }

    // Page Exported event
    // $this->ExportDoc = export document object
    public function pageExported()
    {
        //$this->ExportDoc->Text .= "my footer"; // Export footer
        //Log($this->ExportDoc->Text);
    }

    // Page Importing event
    public function pageImporting($reader, &$options)
    {
        //var_dump($reader); // Import data reader
        //var_dump($options); // Show all options for importing
        //return false; // Return false to skip import
        return true;
    }

    // Row Import event
    public function rowImport(&$row, $cnt)
    {
        //Log($cnt); // Import record count
        //var_dump($row); // Import row
        //return false; // Return false to skip import
        return true;
    }

    // Page Imported event
    public function pageImported($reader, $results)
    {
        //var_dump($reader); // Import data reader
        //var_dump($results); // Import results
    }
}
