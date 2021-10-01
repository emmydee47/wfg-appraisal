<?php

namespace PHPMaker2022\wfg_appraisal;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Page class
 */
class MainPaInitializationAdd extends MainPaInitialization
{
    use MessagesTrait;

    // Page ID
    public $PageID = "add";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'main_pa_initialization';

    // Page object name
    public $PageObjName = "MainPaInitializationAdd";

    // View file path
    public $View = null;

    // Title
    public $Title = null; // Title for <title> tag

    // Rendering View
    public $RenderingView = false;

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

        // Table object (main_pa_initialization)
        if (!isset($GLOBALS["main_pa_initialization"]) || get_class($GLOBALS["main_pa_initialization"]) == PROJECT_NAMESPACE . "main_pa_initialization") {
            $GLOBALS["main_pa_initialization"] = &$this;
        }

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'main_pa_initialization');
        }

        // Start timer
        $DebugTimer = Container("timer");

        // Debug message
        LoadDebugMessage();

        // Open connection
        $GLOBALS["Conn"] = $GLOBALS["Conn"] ?? $this->getConnection();

        // User table object
        $UserTable = Container("usertable");
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
                $tbl = Container("main_pa_initialization");
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

            // Handle modal response
            if ($this->IsModal) { // Show as modal
                $row = ["url" => GetUrl($url), "modal" => "1"];
                $pageName = GetPageName($url);
                if ($pageName != $this->getListUrl()) { // Not List page
                    $row["caption"] = $this->getModalCaption($pageName);
                    if ($pageName == "mainpainitializationview") {
                        $row["view"] = "1";
                    }
                } else { // List page should not be shown as modal => error
                    $row["error"] = $this->getFailureMessage();
                    $this->clearFailureMessage();
                }
                WriteJson($row);
            } else {
                SaveDebugMessage();
                Redirect(GetUrl($url));
            }
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
    public $FormClassName = "ew-form ew-add-form";
    public $IsModal = false;
    public $IsMobileOrModal = false;
    public $DbMasterFilter = "";
    public $DbDetailFilter = "";
    public $StartRecord;
    public $Priv = 0;
    public $OldRecordset;
    public $CopyRecord;

    /**
     * Page run
     *
     * @return void
     */
    public function run()
    {
        global $ExportType, $CustomExportType, $ExportFileName, $UserProfile, $Language, $Security, $CurrentForm,
            $SkipHeaderFooter;

        // Is modal
        $this->IsModal = Param("modal") == "1";
        $this->UseLayout = $this->UseLayout && !$this->IsModal;

        // Use layout
        $this->UseLayout = $this->UseLayout && ConvertToBool(Param("layout", true));

        // Create form object
        $CurrentForm = new HttpForm();
        $this->CurrentAction = Param("action"); // Set up current action
        $this->id->Visible = false;
        $this->business_unit->setVisibility();
        $this->group_id->setVisibility();
        $this->appraisal_mode->setVisibility();
        $this->appraisal_period->setVisibility();
        $this->from_year->setVisibility();
        $this->to_year->setVisibility();
        $this->employees_due_date->setVisibility();
        $this->managers_due_date->setVisibility();
        $this->initialize_status->setVisibility();
        $this->appraisal_ratings->setVisibility();
        $this->isactive->setVisibility();
        $this->createdby->setVisibility();
        $this->modifiedby->setVisibility();
        $this->createddate->setVisibility();
        $this->modifieddate->setVisibility();
        $this->hideFieldsForAddEdit();

        // Do not use lookup cache
        $this->setUseLookupCache(false);

        // Global Page Loading event (in userfn*.php)
        Page_Loading();

        // Page Load event
        if (method_exists($this, "pageLoad")) {
            $this->pageLoad();
        }

        // Set up lookup cache
        $this->setupLookupOptions($this->business_unit);
        $this->setupLookupOptions($this->group_id);
        $this->setupLookupOptions($this->appraisal_mode);
        $this->setupLookupOptions($this->appraisal_period);
        $this->setupLookupOptions($this->from_year);
        $this->setupLookupOptions($this->to_year);
        $this->setupLookupOptions($this->initialize_status);
        $this->setupLookupOptions($this->appraisal_ratings);
        $this->setupLookupOptions($this->isactive);

        // Check modal
        if ($this->IsModal) {
            $SkipHeaderFooter = true;
        }
        $this->IsMobileOrModal = IsMobile() || $this->IsModal;
        $this->FormClassName = "ew-form ew-add-form";
        $postBack = false;

        // Set up current action
        if (IsApi()) {
            $this->CurrentAction = "insert"; // Add record directly
            $postBack = true;
        } elseif (Post("action") !== null) {
            $this->CurrentAction = Post("action"); // Get form action
            $this->setKey(Post($this->OldKeyName));
            $postBack = true;
        } else {
            // Load key values from QueryString
            if (($keyValue = Get("id") ?? Route("id")) !== null) {
                $this->id->setQueryStringValue($keyValue);
            }
            $this->OldKey = $this->getKey(true); // Get from CurrentValue
            $this->CopyRecord = !EmptyValue($this->OldKey);
            if ($this->CopyRecord) {
                $this->CurrentAction = "copy"; // Copy record
            } else {
                $this->CurrentAction = "show"; // Display blank record
            }
        }

        // Load old record / default values
        $loaded = $this->loadOldRecord();

        // Load form values
        if ($postBack) {
            $this->loadFormValues(); // Load form values
        }

        // Set up detail parameters
        $this->setupDetailParms();

        // Validate form if post back
        if ($postBack) {
            if (!$this->validateForm()) {
                $this->EventCancelled = true; // Event cancelled
                $this->restoreFormValues(); // Restore form values
                if (IsApi()) {
                    $this->terminate();
                    return;
                } else {
                    $this->CurrentAction = "show"; // Form error, reset action
                }
            }
        }

        // Perform current action
        switch ($this->CurrentAction) {
            case "copy": // Copy an existing record
                if (!$loaded) { // Record not loaded
                    if ($this->getFailureMessage() == "") {
                        $this->setFailureMessage($Language->phrase("NoRecord")); // No record found
                    }
                    $this->terminate("mainpainitializationlist"); // No matching record, return to list
                    return;
                }

                // Set up detail parameters
                $this->setupDetailParms();
                break;
            case "insert": // Add new record
                $this->SendEmail = true; // Send email on add success
                if ($this->addRow($this->OldRecordset)) { // Add successful
                    if ($this->getSuccessMessage() == "" && Post("addopt") != "1") { // Skip success message for addopt (done in JavaScript)
                        $this->setSuccessMessage($Language->phrase("AddSuccess")); // Set up success message
                    }
                    if ($this->getCurrentDetailTable() != "") { // Master/detail add
                        $returnUrl = $this->getDetailUrl();
                    } else {
                        $returnUrl = $this->getReturnUrl();
                    }
                    if (GetPageName($returnUrl) == "mainpainitializationlist") {
                        $returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
                    } elseif (GetPageName($returnUrl) == "mainpainitializationview") {
                        $returnUrl = $this->getViewUrl(); // View page, return to View page with keyurl directly
                    }
                    if (IsApi()) { // Return to caller
                        $this->terminate(true);
                        return;
                    } else {
                        $this->terminate($returnUrl);
                        return;
                    }
                } elseif (IsApi()) { // API request, return
                    $this->terminate();
                    return;
                } else {
                    $this->EventCancelled = true; // Event cancelled
                    $this->restoreFormValues(); // Add failed, restore form values

                    // Set up detail parameters
                    $this->setupDetailParms();
                }
        }

        // Set up Breadcrumb
        $this->setupBreadcrumb();

        // Render row based on row type
        $this->RowType = ROWTYPE_ADD; // Render add type

        // Render row
        $this->resetAttributes();
        $this->renderRow();

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

    // Get upload files
    protected function getUploadFiles()
    {
        global $CurrentForm, $Language;
    }

    // Load default values
    protected function loadDefaultValues()
    {
        $this->id->CurrentValue = null;
        $this->id->OldValue = $this->id->CurrentValue;
        $this->business_unit->CurrentValue = null;
        $this->business_unit->OldValue = $this->business_unit->CurrentValue;
        $this->group_id->CurrentValue = null;
        $this->group_id->OldValue = $this->group_id->CurrentValue;
        $this->appraisal_mode->CurrentValue = null;
        $this->appraisal_mode->OldValue = $this->appraisal_mode->CurrentValue;
        $this->appraisal_period->CurrentValue = null;
        $this->appraisal_period->OldValue = $this->appraisal_period->CurrentValue;
        $this->from_year->CurrentValue = null;
        $this->from_year->OldValue = $this->from_year->CurrentValue;
        $this->to_year->CurrentValue = null;
        $this->to_year->OldValue = $this->to_year->CurrentValue;
        $this->employees_due_date->CurrentValue = null;
        $this->employees_due_date->OldValue = $this->employees_due_date->CurrentValue;
        $this->managers_due_date->CurrentValue = null;
        $this->managers_due_date->OldValue = $this->managers_due_date->CurrentValue;
        $this->initialize_status->CurrentValue = null;
        $this->initialize_status->OldValue = $this->initialize_status->CurrentValue;
        $this->appraisal_ratings->CurrentValue = null;
        $this->appraisal_ratings->OldValue = $this->appraisal_ratings->CurrentValue;
        $this->isactive->CurrentValue = null;
        $this->isactive->OldValue = $this->isactive->CurrentValue;
        $this->createdby->CurrentValue = null;
        $this->createdby->OldValue = $this->createdby->CurrentValue;
        $this->modifiedby->CurrentValue = null;
        $this->modifiedby->OldValue = $this->modifiedby->CurrentValue;
        $this->createddate->CurrentValue = null;
        $this->createddate->OldValue = $this->createddate->CurrentValue;
        $this->modifieddate->CurrentValue = null;
        $this->modifieddate->OldValue = $this->modifieddate->CurrentValue;
    }

    // Load form values
    protected function loadFormValues()
    {
        // Load from form
        global $CurrentForm;
        $validate = !Config("SERVER_VALIDATE");

        // Check field name 'business_unit' first before field var 'x_business_unit'
        $val = $CurrentForm->hasValue("business_unit") ? $CurrentForm->getValue("business_unit") : $CurrentForm->getValue("x_business_unit");
        if (!$this->business_unit->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->business_unit->Visible = false; // Disable update for API request
            } else {
                $this->business_unit->setFormValue($val);
            }
        }

        // Check field name 'group_id' first before field var 'x_group_id'
        $val = $CurrentForm->hasValue("group_id") ? $CurrentForm->getValue("group_id") : $CurrentForm->getValue("x_group_id");
        if (!$this->group_id->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->group_id->Visible = false; // Disable update for API request
            } else {
                $this->group_id->setFormValue($val);
            }
        }

        // Check field name 'appraisal_mode' first before field var 'x_appraisal_mode'
        $val = $CurrentForm->hasValue("appraisal_mode") ? $CurrentForm->getValue("appraisal_mode") : $CurrentForm->getValue("x_appraisal_mode");
        if (!$this->appraisal_mode->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->appraisal_mode->Visible = false; // Disable update for API request
            } else {
                $this->appraisal_mode->setFormValue($val);
            }
        }

        // Check field name 'appraisal_period' first before field var 'x_appraisal_period'
        $val = $CurrentForm->hasValue("appraisal_period") ? $CurrentForm->getValue("appraisal_period") : $CurrentForm->getValue("x_appraisal_period");
        if (!$this->appraisal_period->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->appraisal_period->Visible = false; // Disable update for API request
            } else {
                $this->appraisal_period->setFormValue($val);
            }
        }

        // Check field name 'from_year' first before field var 'x_from_year'
        $val = $CurrentForm->hasValue("from_year") ? $CurrentForm->getValue("from_year") : $CurrentForm->getValue("x_from_year");
        if (!$this->from_year->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->from_year->Visible = false; // Disable update for API request
            } else {
                $this->from_year->setFormValue($val);
            }
        }

        // Check field name 'to_year' first before field var 'x_to_year'
        $val = $CurrentForm->hasValue("to_year") ? $CurrentForm->getValue("to_year") : $CurrentForm->getValue("x_to_year");
        if (!$this->to_year->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->to_year->Visible = false; // Disable update for API request
            } else {
                $this->to_year->setFormValue($val);
            }
        }

        // Check field name 'employees_due_date' first before field var 'x_employees_due_date'
        $val = $CurrentForm->hasValue("employees_due_date") ? $CurrentForm->getValue("employees_due_date") : $CurrentForm->getValue("x_employees_due_date");
        if (!$this->employees_due_date->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->employees_due_date->Visible = false; // Disable update for API request
            } else {
                $this->employees_due_date->setFormValue($val, true, $validate);
            }
            $this->employees_due_date->CurrentValue = UnFormatDateTime($this->employees_due_date->CurrentValue, $this->employees_due_date->formatPattern());
        }

        // Check field name 'managers_due_date' first before field var 'x_managers_due_date'
        $val = $CurrentForm->hasValue("managers_due_date") ? $CurrentForm->getValue("managers_due_date") : $CurrentForm->getValue("x_managers_due_date");
        if (!$this->managers_due_date->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->managers_due_date->Visible = false; // Disable update for API request
            } else {
                $this->managers_due_date->setFormValue($val, true, $validate);
            }
            $this->managers_due_date->CurrentValue = UnFormatDateTime($this->managers_due_date->CurrentValue, $this->managers_due_date->formatPattern());
        }

        // Check field name 'initialize_status' first before field var 'x_initialize_status'
        $val = $CurrentForm->hasValue("initialize_status") ? $CurrentForm->getValue("initialize_status") : $CurrentForm->getValue("x_initialize_status");
        if (!$this->initialize_status->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->initialize_status->Visible = false; // Disable update for API request
            } else {
                $this->initialize_status->setFormValue($val);
            }
        }

        // Check field name 'appraisal_ratings' first before field var 'x_appraisal_ratings'
        $val = $CurrentForm->hasValue("appraisal_ratings") ? $CurrentForm->getValue("appraisal_ratings") : $CurrentForm->getValue("x_appraisal_ratings");
        if (!$this->appraisal_ratings->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->appraisal_ratings->Visible = false; // Disable update for API request
            } else {
                $this->appraisal_ratings->setFormValue($val);
            }
        }

        // Check field name 'isactive' first before field var 'x_isactive'
        $val = $CurrentForm->hasValue("isactive") ? $CurrentForm->getValue("isactive") : $CurrentForm->getValue("x_isactive");
        if (!$this->isactive->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->isactive->Visible = false; // Disable update for API request
            } else {
                $this->isactive->setFormValue($val);
            }
        }

        // Check field name 'createdby' first before field var 'x_createdby'
        $val = $CurrentForm->hasValue("createdby") ? $CurrentForm->getValue("createdby") : $CurrentForm->getValue("x_createdby");
        if (!$this->createdby->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->createdby->Visible = false; // Disable update for API request
            } else {
                $this->createdby->setFormValue($val);
            }
        }

        // Check field name 'modifiedby' first before field var 'x_modifiedby'
        $val = $CurrentForm->hasValue("modifiedby") ? $CurrentForm->getValue("modifiedby") : $CurrentForm->getValue("x_modifiedby");
        if (!$this->modifiedby->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->modifiedby->Visible = false; // Disable update for API request
            } else {
                $this->modifiedby->setFormValue($val);
            }
        }

        // Check field name 'createddate' first before field var 'x_createddate'
        $val = $CurrentForm->hasValue("createddate") ? $CurrentForm->getValue("createddate") : $CurrentForm->getValue("x_createddate");
        if (!$this->createddate->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->createddate->Visible = false; // Disable update for API request
            } else {
                $this->createddate->setFormValue($val);
            }
            $this->createddate->CurrentValue = UnFormatDateTime($this->createddate->CurrentValue, $this->createddate->formatPattern());
        }

        // Check field name 'modifieddate' first before field var 'x_modifieddate'
        $val = $CurrentForm->hasValue("modifieddate") ? $CurrentForm->getValue("modifieddate") : $CurrentForm->getValue("x_modifieddate");
        if (!$this->modifieddate->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->modifieddate->Visible = false; // Disable update for API request
            } else {
                $this->modifieddate->setFormValue($val);
            }
            $this->modifieddate->CurrentValue = UnFormatDateTime($this->modifieddate->CurrentValue, $this->modifieddate->formatPattern());
        }

        // Check field name 'id' first before field var 'x_id'
        $val = $CurrentForm->hasValue("id") ? $CurrentForm->getValue("id") : $CurrentForm->getValue("x_id");
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
        $this->business_unit->CurrentValue = $this->business_unit->FormValue;
        $this->group_id->CurrentValue = $this->group_id->FormValue;
        $this->appraisal_mode->CurrentValue = $this->appraisal_mode->FormValue;
        $this->appraisal_period->CurrentValue = $this->appraisal_period->FormValue;
        $this->from_year->CurrentValue = $this->from_year->FormValue;
        $this->to_year->CurrentValue = $this->to_year->FormValue;
        $this->employees_due_date->CurrentValue = $this->employees_due_date->FormValue;
        $this->employees_due_date->CurrentValue = UnFormatDateTime($this->employees_due_date->CurrentValue, $this->employees_due_date->formatPattern());
        $this->managers_due_date->CurrentValue = $this->managers_due_date->FormValue;
        $this->managers_due_date->CurrentValue = UnFormatDateTime($this->managers_due_date->CurrentValue, $this->managers_due_date->formatPattern());
        $this->initialize_status->CurrentValue = $this->initialize_status->FormValue;
        $this->appraisal_ratings->CurrentValue = $this->appraisal_ratings->FormValue;
        $this->isactive->CurrentValue = $this->isactive->FormValue;
        $this->createdby->CurrentValue = $this->createdby->FormValue;
        $this->modifiedby->CurrentValue = $this->modifiedby->FormValue;
        $this->createddate->CurrentValue = $this->createddate->FormValue;
        $this->createddate->CurrentValue = UnFormatDateTime($this->createddate->CurrentValue, $this->createddate->formatPattern());
        $this->modifieddate->CurrentValue = $this->modifieddate->FormValue;
        $this->modifieddate->CurrentValue = UnFormatDateTime($this->modifieddate->CurrentValue, $this->modifieddate->formatPattern());
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
        $this->business_unit->setDbValue($row['business_unit']);
        $this->group_id->setDbValue($row['group_id']);
        $this->appraisal_mode->setDbValue($row['appraisal_mode']);
        $this->appraisal_period->setDbValue($row['appraisal_period']);
        $this->from_year->setDbValue($row['from_year']);
        $this->to_year->setDbValue($row['to_year']);
        $this->employees_due_date->setDbValue($row['employees_due_date']);
        $this->managers_due_date->setDbValue($row['managers_due_date']);
        $this->initialize_status->setDbValue($row['initialize_status']);
        $this->appraisal_ratings->setDbValue($row['appraisal_ratings']);
        $this->isactive->setDbValue($row['isactive']);
        $this->createdby->setDbValue($row['createdby']);
        $this->modifiedby->setDbValue($row['modifiedby']);
        $this->createddate->setDbValue($row['createddate']);
        $this->modifieddate->setDbValue($row['modifieddate']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $this->loadDefaultValues();
        $row = [];
        $row['id'] = $this->id->CurrentValue;
        $row['business_unit'] = $this->business_unit->CurrentValue;
        $row['group_id'] = $this->group_id->CurrentValue;
        $row['appraisal_mode'] = $this->appraisal_mode->CurrentValue;
        $row['appraisal_period'] = $this->appraisal_period->CurrentValue;
        $row['from_year'] = $this->from_year->CurrentValue;
        $row['to_year'] = $this->to_year->CurrentValue;
        $row['employees_due_date'] = $this->employees_due_date->CurrentValue;
        $row['managers_due_date'] = $this->managers_due_date->CurrentValue;
        $row['initialize_status'] = $this->initialize_status->CurrentValue;
        $row['appraisal_ratings'] = $this->appraisal_ratings->CurrentValue;
        $row['isactive'] = $this->isactive->CurrentValue;
        $row['createdby'] = $this->createdby->CurrentValue;
        $row['modifiedby'] = $this->modifiedby->CurrentValue;
        $row['createddate'] = $this->createddate->CurrentValue;
        $row['modifieddate'] = $this->modifieddate->CurrentValue;
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

        // Call Row_Rendering event
        $this->rowRendering();

        // Common render codes for all row types

        // id
        $this->id->RowCssClass = "row";

        // business_unit
        $this->business_unit->RowCssClass = "row";

        // group_id
        $this->group_id->RowCssClass = "row";

        // appraisal_mode
        $this->appraisal_mode->RowCssClass = "row";

        // appraisal_period
        $this->appraisal_period->RowCssClass = "row";

        // from_year
        $this->from_year->RowCssClass = "row";

        // to_year
        $this->to_year->RowCssClass = "row";

        // employees_due_date
        $this->employees_due_date->RowCssClass = "row";

        // managers_due_date
        $this->managers_due_date->RowCssClass = "row";

        // initialize_status
        $this->initialize_status->RowCssClass = "row";

        // appraisal_ratings
        $this->appraisal_ratings->RowCssClass = "row";

        // isactive
        $this->isactive->RowCssClass = "row";

        // createdby
        $this->createdby->RowCssClass = "row";

        // modifiedby
        $this->modifiedby->RowCssClass = "row";

        // createddate
        $this->createddate->RowCssClass = "row";

        // modifieddate
        $this->modifieddate->RowCssClass = "row";

        // View row
        if ($this->RowType == ROWTYPE_VIEW) {
            // id
            $this->id->ViewValue = $this->id->CurrentValue;
            $this->id->ViewCustomAttributes = "";

            // business_unit
            $curVal = strval($this->business_unit->CurrentValue);
            if ($curVal != "") {
                $this->business_unit->ViewValue = $this->business_unit->lookupCacheOption($curVal);
                if ($this->business_unit->ViewValue === null) { // Lookup from database
                    $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $sqlWrk = $this->business_unit->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $conn = Conn();
                    $config = $conn->getConfiguration();
                    $config->setResultCacheImpl($this->Cache);
                    $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->business_unit->Lookup->renderViewRow($rswrk[0]);
                        $this->business_unit->ViewValue = $this->business_unit->displayValue($arwrk);
                    } else {
                        $this->business_unit->ViewValue = $this->business_unit->CurrentValue;
                    }
                }
            } else {
                $this->business_unit->ViewValue = null;
            }
            $this->business_unit->ViewCustomAttributes = "";

            // group_id
            $curVal = strval($this->group_id->CurrentValue);
            if ($curVal != "") {
                $this->group_id->ViewValue = $this->group_id->lookupCacheOption($curVal);
                if ($this->group_id->ViewValue === null) { // Lookup from database
                    $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $sqlWrk = $this->group_id->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $conn = Conn();
                    $config = $conn->getConfiguration();
                    $config->setResultCacheImpl($this->Cache);
                    $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->group_id->Lookup->renderViewRow($rswrk[0]);
                        $this->group_id->ViewValue = $this->group_id->displayValue($arwrk);
                    } else {
                        $this->group_id->ViewValue = $this->group_id->CurrentValue;
                    }
                }
            } else {
                $this->group_id->ViewValue = null;
            }
            $this->group_id->ViewCustomAttributes = "";

            // appraisal_mode
            if (strval($this->appraisal_mode->CurrentValue) != "") {
                $this->appraisal_mode->ViewValue = $this->appraisal_mode->optionCaption($this->appraisal_mode->CurrentValue);
            } else {
                $this->appraisal_mode->ViewValue = null;
            }
            $this->appraisal_mode->ViewCustomAttributes = "";

            // appraisal_period
            if (strval($this->appraisal_period->CurrentValue) != "") {
                $this->appraisal_period->ViewValue = $this->appraisal_period->optionCaption($this->appraisal_period->CurrentValue);
            } else {
                $this->appraisal_period->ViewValue = null;
            }
            $this->appraisal_period->ViewCustomAttributes = "";

            // from_year
            if (strval($this->from_year->CurrentValue) != "") {
                $this->from_year->ViewValue = $this->from_year->optionCaption($this->from_year->CurrentValue);
            } else {
                $this->from_year->ViewValue = null;
            }
            $this->from_year->ViewCustomAttributes = "";

            // to_year
            if (strval($this->to_year->CurrentValue) != "") {
                $this->to_year->ViewValue = $this->to_year->optionCaption($this->to_year->CurrentValue);
            } else {
                $this->to_year->ViewValue = null;
            }
            $this->to_year->ViewCustomAttributes = "";

            // employees_due_date
            $this->employees_due_date->ViewValue = $this->employees_due_date->CurrentValue;
            $this->employees_due_date->ViewValue = FormatDateTime($this->employees_due_date->ViewValue, 0);
            $this->employees_due_date->ViewCustomAttributes = "";

            // managers_due_date
            $this->managers_due_date->ViewValue = $this->managers_due_date->CurrentValue;
            $this->managers_due_date->ViewValue = FormatDateTime($this->managers_due_date->ViewValue, 0);
            $this->managers_due_date->ViewCustomAttributes = "";

            // initialize_status
            if (strval($this->initialize_status->CurrentValue) != "") {
                $this->initialize_status->ViewValue = $this->initialize_status->optionCaption($this->initialize_status->CurrentValue);
            } else {
                $this->initialize_status->ViewValue = null;
            }
            $this->initialize_status->ViewCustomAttributes = "";

            // appraisal_ratings
            $this->appraisal_ratings->ViewValue = $this->appraisal_ratings->CurrentValue;
            $curVal = strval($this->appraisal_ratings->CurrentValue);
            if ($curVal != "") {
                $this->appraisal_ratings->ViewValue = $this->appraisal_ratings->lookupCacheOption($curVal);
                if ($this->appraisal_ratings->ViewValue === null) { // Lookup from database
                    $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $sqlWrk = $this->appraisal_ratings->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $conn = Conn();
                    $config = $conn->getConfiguration();
                    $config->setResultCacheImpl($this->Cache);
                    $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->appraisal_ratings->Lookup->renderViewRow($rswrk[0]);
                        $this->appraisal_ratings->ViewValue = $this->appraisal_ratings->displayValue($arwrk);
                    } else {
                        $this->appraisal_ratings->ViewValue = $this->appraisal_ratings->CurrentValue;
                    }
                }
            } else {
                $this->appraisal_ratings->ViewValue = null;
            }
            $this->appraisal_ratings->ViewCustomAttributes = "";

            // isactive
            if (strval($this->isactive->CurrentValue) != "") {
                $this->isactive->ViewValue = $this->isactive->optionCaption($this->isactive->CurrentValue);
            } else {
                $this->isactive->ViewValue = null;
            }
            $this->isactive->ViewCustomAttributes = "";

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

            // business_unit
            $this->business_unit->LinkCustomAttributes = "";
            $this->business_unit->HrefValue = "";

            // group_id
            $this->group_id->LinkCustomAttributes = "";
            $this->group_id->HrefValue = "";

            // appraisal_mode
            $this->appraisal_mode->LinkCustomAttributes = "";
            $this->appraisal_mode->HrefValue = "";

            // appraisal_period
            $this->appraisal_period->LinkCustomAttributes = "";
            $this->appraisal_period->HrefValue = "";

            // from_year
            $this->from_year->LinkCustomAttributes = "";
            $this->from_year->HrefValue = "";

            // to_year
            $this->to_year->LinkCustomAttributes = "";
            $this->to_year->HrefValue = "";

            // employees_due_date
            $this->employees_due_date->LinkCustomAttributes = "";
            $this->employees_due_date->HrefValue = "";

            // managers_due_date
            $this->managers_due_date->LinkCustomAttributes = "";
            $this->managers_due_date->HrefValue = "";

            // initialize_status
            $this->initialize_status->LinkCustomAttributes = "";
            $this->initialize_status->HrefValue = "";

            // appraisal_ratings
            $this->appraisal_ratings->LinkCustomAttributes = "";
            $this->appraisal_ratings->HrefValue = "";

            // isactive
            $this->isactive->LinkCustomAttributes = "";
            $this->isactive->HrefValue = "";

            // createdby
            $this->createdby->LinkCustomAttributes = "";
            $this->createdby->HrefValue = "";

            // modifiedby
            $this->modifiedby->LinkCustomAttributes = "";
            $this->modifiedby->HrefValue = "";

            // createddate
            $this->createddate->LinkCustomAttributes = "";
            $this->createddate->HrefValue = "";

            // modifieddate
            $this->modifieddate->LinkCustomAttributes = "";
            $this->modifieddate->HrefValue = "";
        } elseif ($this->RowType == ROWTYPE_ADD) {
            // business_unit
            $this->business_unit->EditCustomAttributes = "";
            $curVal = trim(strval($this->business_unit->CurrentValue));
            if ($curVal != "") {
                $this->business_unit->ViewValue = $this->business_unit->lookupCacheOption($curVal);
            } else {
                $this->business_unit->ViewValue = $this->business_unit->Lookup !== null && is_array($this->business_unit->lookupOptions()) ? $curVal : null;
            }
            if ($this->business_unit->ViewValue !== null) { // Load from cache
                $this->business_unit->EditValue = array_values($this->business_unit->lookupOptions());
                if ($this->business_unit->ViewValue == "") {
                    $this->business_unit->ViewValue = $Language->phrase("PleaseSelect");
                }
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "`id`" . SearchString("=", $this->business_unit->CurrentValue, DATATYPE_NUMBER, "");
                }
                $sqlWrk = $this->business_unit->Lookup->getSql(true, $filterWrk, '', $this, false, true);
                $conn = Conn();
                $config = $conn->getConfiguration();
                $config->setResultCacheImpl($this->Cache);
                $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->business_unit->Lookup->renderViewRow($rswrk[0]);
                    $this->business_unit->ViewValue = $this->business_unit->displayValue($arwrk);
                } else {
                    $this->business_unit->ViewValue = $Language->phrase("PleaseSelect");
                }
                $arwrk = $rswrk;
                $this->business_unit->EditValue = $arwrk;
            }
            $this->business_unit->PlaceHolder = RemoveHtml($this->business_unit->caption());

            // group_id
            $this->group_id->EditCustomAttributes = "";
            $curVal = trim(strval($this->group_id->CurrentValue));
            if ($curVal != "") {
                $this->group_id->ViewValue = $this->group_id->lookupCacheOption($curVal);
            } else {
                $this->group_id->ViewValue = $this->group_id->Lookup !== null && is_array($this->group_id->lookupOptions()) ? $curVal : null;
            }
            if ($this->group_id->ViewValue !== null) { // Load from cache
                $this->group_id->EditValue = array_values($this->group_id->lookupOptions());
                if ($this->group_id->ViewValue == "") {
                    $this->group_id->ViewValue = $Language->phrase("PleaseSelect");
                }
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "`id`" . SearchString("=", $this->group_id->CurrentValue, DATATYPE_NUMBER, "");
                }
                $sqlWrk = $this->group_id->Lookup->getSql(true, $filterWrk, '', $this, false, true);
                $conn = Conn();
                $config = $conn->getConfiguration();
                $config->setResultCacheImpl($this->Cache);
                $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->group_id->Lookup->renderViewRow($rswrk[0]);
                    $this->group_id->ViewValue = $this->group_id->displayValue($arwrk);
                } else {
                    $this->group_id->ViewValue = $Language->phrase("PleaseSelect");
                }
                $arwrk = $rswrk;
                $this->group_id->EditValue = $arwrk;
            }
            $this->group_id->PlaceHolder = RemoveHtml($this->group_id->caption());

            // appraisal_mode
            $this->appraisal_mode->EditCustomAttributes = "";
            $this->appraisal_mode->EditValue = $this->appraisal_mode->options(false);
            $this->appraisal_mode->PlaceHolder = RemoveHtml($this->appraisal_mode->caption());

            // appraisal_period
            $this->appraisal_period->setupEditAttributes();
            $this->appraisal_period->EditCustomAttributes = "";
            $this->appraisal_period->EditValue = $this->appraisal_period->options(true);
            $this->appraisal_period->PlaceHolder = RemoveHtml($this->appraisal_period->caption());

            // from_year
            $this->from_year->setupEditAttributes();
            $this->from_year->EditCustomAttributes = "";
            $this->from_year->EditValue = $this->from_year->options(true);
            $this->from_year->PlaceHolder = RemoveHtml($this->from_year->caption());

            // to_year
            $this->to_year->setupEditAttributes();
            $this->to_year->EditCustomAttributes = "";
            $this->to_year->EditValue = $this->to_year->options(true);
            $this->to_year->PlaceHolder = RemoveHtml($this->to_year->caption());

            // employees_due_date
            $this->employees_due_date->setupEditAttributes();
            $this->employees_due_date->EditCustomAttributes = "";
            $this->employees_due_date->EditValue = HtmlEncode(FormatDateTime($this->employees_due_date->CurrentValue, 8));
            $this->employees_due_date->PlaceHolder = RemoveHtml($this->employees_due_date->caption());

            // managers_due_date
            $this->managers_due_date->setupEditAttributes();
            $this->managers_due_date->EditCustomAttributes = "";
            $this->managers_due_date->EditValue = HtmlEncode(FormatDateTime($this->managers_due_date->CurrentValue, 8));
            $this->managers_due_date->PlaceHolder = RemoveHtml($this->managers_due_date->caption());

            // initialize_status
            $this->initialize_status->EditCustomAttributes = "";
            $this->initialize_status->EditValue = $this->initialize_status->options(false);
            $this->initialize_status->PlaceHolder = RemoveHtml($this->initialize_status->caption());

            // appraisal_ratings
            $this->appraisal_ratings->setupEditAttributes();
            $this->appraisal_ratings->EditCustomAttributes = "";
            if (!$this->appraisal_ratings->Raw) {
                $this->appraisal_ratings->CurrentValue = HtmlDecode($this->appraisal_ratings->CurrentValue);
            }
            $this->appraisal_ratings->EditValue = HtmlEncode($this->appraisal_ratings->CurrentValue);
            $curVal = strval($this->appraisal_ratings->CurrentValue);
            if ($curVal != "") {
                $this->appraisal_ratings->EditValue = $this->appraisal_ratings->lookupCacheOption($curVal);
                if ($this->appraisal_ratings->EditValue === null) { // Lookup from database
                    $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $sqlWrk = $this->appraisal_ratings->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $conn = Conn();
                    $config = $conn->getConfiguration();
                    $config->setResultCacheImpl($this->Cache);
                    $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->appraisal_ratings->Lookup->renderViewRow($rswrk[0]);
                        $this->appraisal_ratings->EditValue = $this->appraisal_ratings->displayValue($arwrk);
                    } else {
                        $this->appraisal_ratings->EditValue = HtmlEncode($this->appraisal_ratings->CurrentValue);
                    }
                }
            } else {
                $this->appraisal_ratings->EditValue = null;
            }
            $this->appraisal_ratings->PlaceHolder = RemoveHtml($this->appraisal_ratings->caption());

            // isactive
            $this->isactive->EditCustomAttributes = "";
            $this->isactive->EditValue = $this->isactive->options(false);
            $this->isactive->PlaceHolder = RemoveHtml($this->isactive->caption());

            // createdby

            // modifiedby

            // createddate

            // modifieddate

            // Add refer script

            // business_unit
            $this->business_unit->LinkCustomAttributes = "";
            $this->business_unit->HrefValue = "";

            // group_id
            $this->group_id->LinkCustomAttributes = "";
            $this->group_id->HrefValue = "";

            // appraisal_mode
            $this->appraisal_mode->LinkCustomAttributes = "";
            $this->appraisal_mode->HrefValue = "";

            // appraisal_period
            $this->appraisal_period->LinkCustomAttributes = "";
            $this->appraisal_period->HrefValue = "";

            // from_year
            $this->from_year->LinkCustomAttributes = "";
            $this->from_year->HrefValue = "";

            // to_year
            $this->to_year->LinkCustomAttributes = "";
            $this->to_year->HrefValue = "";

            // employees_due_date
            $this->employees_due_date->LinkCustomAttributes = "";
            $this->employees_due_date->HrefValue = "";

            // managers_due_date
            $this->managers_due_date->LinkCustomAttributes = "";
            $this->managers_due_date->HrefValue = "";

            // initialize_status
            $this->initialize_status->LinkCustomAttributes = "";
            $this->initialize_status->HrefValue = "";

            // appraisal_ratings
            $this->appraisal_ratings->LinkCustomAttributes = "";
            $this->appraisal_ratings->HrefValue = "";

            // isactive
            $this->isactive->LinkCustomAttributes = "";
            $this->isactive->HrefValue = "";

            // createdby
            $this->createdby->LinkCustomAttributes = "";
            $this->createdby->HrefValue = "";

            // modifiedby
            $this->modifiedby->LinkCustomAttributes = "";
            $this->modifiedby->HrefValue = "";

            // createddate
            $this->createddate->LinkCustomAttributes = "";
            $this->createddate->HrefValue = "";

            // modifieddate
            $this->modifieddate->LinkCustomAttributes = "";
            $this->modifieddate->HrefValue = "";
        }
        if ($this->RowType == ROWTYPE_ADD || $this->RowType == ROWTYPE_EDIT || $this->RowType == ROWTYPE_SEARCH) { // Add/Edit/Search row
            $this->setupFieldTitles();
        }

        // Call Row Rendered event
        if ($this->RowType != ROWTYPE_AGGREGATEINIT) {
            $this->rowRendered();
        }
    }

    // Validate form
    protected function validateForm()
    {
        global $Language;

        // Check if validation required
        if (!Config("SERVER_VALIDATE")) {
            return true;
        }
        $validateForm = true;
        if ($this->business_unit->Required) {
            if (!$this->business_unit->IsDetailKey && EmptyValue($this->business_unit->FormValue)) {
                $this->business_unit->addErrorMessage(str_replace("%s", $this->business_unit->caption(), $this->business_unit->RequiredErrorMessage));
            }
        }
        if ($this->group_id->Required) {
            if (!$this->group_id->IsDetailKey && EmptyValue($this->group_id->FormValue)) {
                $this->group_id->addErrorMessage(str_replace("%s", $this->group_id->caption(), $this->group_id->RequiredErrorMessage));
            }
        }
        if ($this->appraisal_mode->Required) {
            if ($this->appraisal_mode->FormValue == "") {
                $this->appraisal_mode->addErrorMessage(str_replace("%s", $this->appraisal_mode->caption(), $this->appraisal_mode->RequiredErrorMessage));
            }
        }
        if ($this->appraisal_period->Required) {
            if (!$this->appraisal_period->IsDetailKey && EmptyValue($this->appraisal_period->FormValue)) {
                $this->appraisal_period->addErrorMessage(str_replace("%s", $this->appraisal_period->caption(), $this->appraisal_period->RequiredErrorMessage));
            }
        }
        if ($this->from_year->Required) {
            if (!$this->from_year->IsDetailKey && EmptyValue($this->from_year->FormValue)) {
                $this->from_year->addErrorMessage(str_replace("%s", $this->from_year->caption(), $this->from_year->RequiredErrorMessage));
            }
        }
        if ($this->to_year->Required) {
            if (!$this->to_year->IsDetailKey && EmptyValue($this->to_year->FormValue)) {
                $this->to_year->addErrorMessage(str_replace("%s", $this->to_year->caption(), $this->to_year->RequiredErrorMessage));
            }
        }
        if ($this->employees_due_date->Required) {
            if (!$this->employees_due_date->IsDetailKey && EmptyValue($this->employees_due_date->FormValue)) {
                $this->employees_due_date->addErrorMessage(str_replace("%s", $this->employees_due_date->caption(), $this->employees_due_date->RequiredErrorMessage));
            }
        }
        if (!CheckDate($this->employees_due_date->FormValue, $this->employees_due_date->formatPattern())) {
            $this->employees_due_date->addErrorMessage($this->employees_due_date->getErrorMessage(false));
        }
        if ($this->managers_due_date->Required) {
            if (!$this->managers_due_date->IsDetailKey && EmptyValue($this->managers_due_date->FormValue)) {
                $this->managers_due_date->addErrorMessage(str_replace("%s", $this->managers_due_date->caption(), $this->managers_due_date->RequiredErrorMessage));
            }
        }
        if (!CheckDate($this->managers_due_date->FormValue, $this->managers_due_date->formatPattern())) {
            $this->managers_due_date->addErrorMessage($this->managers_due_date->getErrorMessage(false));
        }
        if ($this->initialize_status->Required) {
            if ($this->initialize_status->FormValue == "") {
                $this->initialize_status->addErrorMessage(str_replace("%s", $this->initialize_status->caption(), $this->initialize_status->RequiredErrorMessage));
            }
        }
        if ($this->appraisal_ratings->Required) {
            if (!$this->appraisal_ratings->IsDetailKey && EmptyValue($this->appraisal_ratings->FormValue)) {
                $this->appraisal_ratings->addErrorMessage(str_replace("%s", $this->appraisal_ratings->caption(), $this->appraisal_ratings->RequiredErrorMessage));
            }
        }
        if ($this->isactive->Required) {
            if ($this->isactive->FormValue == "") {
                $this->isactive->addErrorMessage(str_replace("%s", $this->isactive->caption(), $this->isactive->RequiredErrorMessage));
            }
        }
        if ($this->createdby->Required) {
            if (!$this->createdby->IsDetailKey && EmptyValue($this->createdby->FormValue)) {
                $this->createdby->addErrorMessage(str_replace("%s", $this->createdby->caption(), $this->createdby->RequiredErrorMessage));
            }
        }
        if ($this->modifiedby->Required) {
            if (!$this->modifiedby->IsDetailKey && EmptyValue($this->modifiedby->FormValue)) {
                $this->modifiedby->addErrorMessage(str_replace("%s", $this->modifiedby->caption(), $this->modifiedby->RequiredErrorMessage));
            }
        }
        if ($this->createddate->Required) {
            if (!$this->createddate->IsDetailKey && EmptyValue($this->createddate->FormValue)) {
                $this->createddate->addErrorMessage(str_replace("%s", $this->createddate->caption(), $this->createddate->RequiredErrorMessage));
            }
        }
        if ($this->modifieddate->Required) {
            if (!$this->modifieddate->IsDetailKey && EmptyValue($this->modifieddate->FormValue)) {
                $this->modifieddate->addErrorMessage(str_replace("%s", $this->modifieddate->caption(), $this->modifieddate->RequiredErrorMessage));
            }
        }

        // Validate detail grid
        $detailTblVar = explode(",", $this->getCurrentDetailTable());
        $detailPage = Container("MainGroupPaQuestionsGrid");
        if (in_array("main_group_pa_questions", $detailTblVar) && $detailPage->DetailAdd) {
            $validateForm = $validateForm && $detailPage->validateGridForm();
        }

        // Return validate result
        $validateForm = $validateForm && !$this->hasInvalidFields();

        // Call Form_CustomValidate event
        $formCustomError = "";
        $validateForm = $validateForm && $this->formCustomValidate($formCustomError);
        if ($formCustomError != "") {
            $this->setFailureMessage($formCustomError);
        }
        return $validateForm;
    }

    // Add record
    protected function addRow($rsold = null)
    {
        global $Language, $Security;
        $conn = $this->getConnection();

        // Begin transaction
        if ($this->getCurrentDetailTable() != "" && $this->UseTransaction) {
            $conn->beginTransaction();
        }

        // Load db values from rsold
        $this->loadDbValues($rsold);
        if ($rsold) {
        }
        $rsnew = [];

        // business_unit
        $this->business_unit->setDbValueDef($rsnew, $this->business_unit->CurrentValue, null, false);

        // group_id
        $this->group_id->setDbValueDef($rsnew, $this->group_id->CurrentValue, null, false);

        // appraisal_mode
        $this->appraisal_mode->setDbValueDef($rsnew, $this->appraisal_mode->CurrentValue, null, false);

        // appraisal_period
        $this->appraisal_period->setDbValueDef($rsnew, $this->appraisal_period->CurrentValue, null, false);

        // from_year
        $this->from_year->setDbValueDef($rsnew, $this->from_year->CurrentValue, null, false);

        // to_year
        $this->to_year->setDbValueDef($rsnew, $this->to_year->CurrentValue, null, false);

        // employees_due_date
        $this->employees_due_date->setDbValueDef($rsnew, UnFormatDateTime($this->employees_due_date->CurrentValue, $this->employees_due_date->formatPattern()), null, false);

        // managers_due_date
        $this->managers_due_date->setDbValueDef($rsnew, UnFormatDateTime($this->managers_due_date->CurrentValue, $this->managers_due_date->formatPattern()), null, false);

        // initialize_status
        $this->initialize_status->setDbValueDef($rsnew, $this->initialize_status->CurrentValue, null, false);

        // appraisal_ratings
        $this->appraisal_ratings->setDbValueDef($rsnew, $this->appraisal_ratings->CurrentValue, null, false);

        // isactive
        $this->isactive->setDbValueDef($rsnew, $this->isactive->CurrentValue, null, false);

        // createdby
        $this->createdby->CurrentValue = CurrentUserID();
        $this->createdby->setDbValueDef($rsnew, $this->createdby->CurrentValue, null);

        // modifiedby
        $this->modifiedby->CurrentValue = CurrentUserIP();
        $this->modifiedby->setDbValueDef($rsnew, $this->modifiedby->CurrentValue, null);

        // createddate
        $this->createddate->CurrentValue = CurrentDate();
        $this->createddate->setDbValueDef($rsnew, $this->createddate->CurrentValue, null);

        // modifieddate
        $this->modifieddate->CurrentValue = CurrentDate();
        $this->modifieddate->setDbValueDef($rsnew, $this->modifieddate->CurrentValue, null);

        // Call Row Inserting event
        $insertRow = $this->rowInserting($rsold, $rsnew);
        if ($insertRow) {
            $addRow = $this->insert($rsnew);
            if ($addRow) {
            }
        } else {
            if ($this->getSuccessMessage() != "" || $this->getFailureMessage() != "") {
                // Use the message, do nothing
            } elseif ($this->CancelMessage != "") {
                $this->setFailureMessage($this->CancelMessage);
                $this->CancelMessage = "";
            } else {
                $this->setFailureMessage($Language->phrase("InsertCancelled"));
            }
            $addRow = false;
        }

        // Add detail records
        if ($addRow) {
            $detailTblVar = explode(",", $this->getCurrentDetailTable());
            $detailPage = Container("MainGroupPaQuestionsGrid");
            if (in_array("main_group_pa_questions", $detailTblVar) && $detailPage->DetailAdd) {
                $detailPage->appraisal_id->setSessionValue($this->id->CurrentValue); // Set master key
                $Security->loadCurrentUserLevel($this->ProjectID . "main_group_pa_questions"); // Load user level of detail table
                $addRow = $detailPage->gridInsert();
                $Security->loadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
                if (!$addRow) {
                $detailPage->appraisal_id->setSessionValue(""); // Clear master key if insert failed
                }
            }
        }

        // Commit/Rollback transaction
        if ($this->getCurrentDetailTable() != "") {
            if ($addRow) {
                if ($this->UseTransaction) { // Commit transaction
                    $conn->commit();
                }
            } else {
                if ($this->UseTransaction) { // Rollback transaction
                    $conn->rollback();
                }
            }
        }
        if ($addRow) {
            // Call Row Inserted event
            $this->rowInserted($rsold, $rsnew);
        }

        // Clean upload path if any
        if ($addRow) {
        }

        // Write JSON for API request
        if (IsApi() && $addRow) {
            $row = $this->getRecordsFromRecordset([$rsnew], true);
            WriteJson(["success" => true, $this->TableVar => $row]);
        }
        return $addRow;
    }

    // Set up detail parms based on QueryString
    protected function setupDetailParms()
    {
        // Get the keys for master table
        $detailTblVar = Get(Config("TABLE_SHOW_DETAIL"));
        if ($detailTblVar !== null) {
            $this->setCurrentDetailTable($detailTblVar);
        } else {
            $detailTblVar = $this->getCurrentDetailTable();
        }
        if ($detailTblVar != "") {
            $detailTblVar = explode(",", $detailTblVar);
            if (in_array("main_group_pa_questions", $detailTblVar)) {
                $detailPageObj = Container("MainGroupPaQuestionsGrid");
                if ($detailPageObj->DetailAdd) {
                    if ($this->CopyRecord) {
                        $detailPageObj->CurrentMode = "copy";
                    } else {
                        $detailPageObj->CurrentMode = "add";
                    }
                    $detailPageObj->CurrentAction = "gridadd";

                    // Save current master table to detail table
                    $detailPageObj->setCurrentMasterTable($this->TableVar);
                    $detailPageObj->setStartRecordNumber(1);
                    $detailPageObj->appraisal_id->IsDetailKey = true;
                    $detailPageObj->appraisal_id->CurrentValue = $this->id->CurrentValue;
                    $detailPageObj->appraisal_id->setSessionValue($detailPageObj->appraisal_id->CurrentValue);
                    $detailPageObj->question->setSessionValue(""); // Clear session key
                }
            }
        }
    }

    // Set up Breadcrumb
    protected function setupBreadcrumb()
    {
        global $Breadcrumb, $Language;
        $Breadcrumb = new Breadcrumb("index");
        $url = CurrentUrl();
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("mainpainitializationlist"), "", $this->TableVar, true);
        $pageId = ($this->isCopy()) ? "Copy" : "Add";
        $Breadcrumb->add("add", $pageId, $url);
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
                case "x_business_unit":
                    break;
                case "x_group_id":
                    break;
                case "x_appraisal_mode":
                    break;
                case "x_appraisal_period":
                    break;
                case "x_from_year":
                    break;
                case "x_to_year":
                    break;
                case "x_initialize_status":
                    break;
                case "x_appraisal_ratings":
                    break;
                case "x_isactive":
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
}
