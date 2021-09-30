<?php

namespace PHPMaker2022\wfg_appraisal;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Page class
 */
class MainPaScoreAdd extends MainPaScore
{
    use MessagesTrait;

    // Page ID
    public $PageID = "add";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'main_pa_score';

    // Page object name
    public $PageObjName = "MainPaScoreAdd";

    // View file path
    public $View = null;

    // Title
    public $Title = null; // Title for <title> tag

    // Rendering View
    public $RenderingView = false;

    // Audit Trail
    public $AuditTrailOnAdd = false;
    public $AuditTrailOnEdit = false;
    public $AuditTrailOnDelete = false;
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

        // Table object (main_pa_score)
        if (!isset($GLOBALS["main_pa_score"]) || get_class($GLOBALS["main_pa_score"]) == PROJECT_NAMESPACE . "main_pa_score") {
            $GLOBALS["main_pa_score"] = &$this;
        }

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'main_pa_score');
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
                $tbl = Container("main_pa_score");
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
                    if ($pageName == "mainpascoreview") {
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
        $this->appraisal->setVisibility();
        $this->employee->setVisibility();
        $this->employee_response->setVisibility();
        $this->line_manager_one->setVisibility();
        $this->line_manager_one_response->setVisibility();
        $this->line_manager_two->setVisibility();
        $this->line_manager_two_response->setVisibility();
        $this->consolidate_score->setVisibility();
        $this->created_at->setVisibility();
        $this->updated_at->setVisibility();
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
        $this->setupLookupOptions($this->appraisal);
        $this->setupLookupOptions($this->employee);
        $this->setupLookupOptions($this->line_manager_one);
        $this->setupLookupOptions($this->line_manager_two);

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
                    $this->terminate("mainpascorelist"); // No matching record, return to list
                    return;
                }
                break;
            case "insert": // Add new record
                $this->SendEmail = true; // Send email on add success
                if ($this->addRow($this->OldRecordset)) { // Add successful
                    if ($this->getSuccessMessage() == "" && Post("addopt") != "1") { // Skip success message for addopt (done in JavaScript)
                        $this->setSuccessMessage($Language->phrase("AddSuccess")); // Set up success message
                    }
                    $returnUrl = $this->getReturnUrl();
                    if (GetPageName($returnUrl) == "mainpascorelist") {
                        $returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
                    } elseif (GetPageName($returnUrl) == "mainpascoreview") {
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
        $this->appraisal->CurrentValue = null;
        $this->appraisal->OldValue = $this->appraisal->CurrentValue;
        $this->employee->CurrentValue = null;
        $this->employee->OldValue = $this->employee->CurrentValue;
        $this->employee_response->CurrentValue = null;
        $this->employee_response->OldValue = $this->employee_response->CurrentValue;
        $this->line_manager_one->CurrentValue = null;
        $this->line_manager_one->OldValue = $this->line_manager_one->CurrentValue;
        $this->line_manager_one_response->CurrentValue = null;
        $this->line_manager_one_response->OldValue = $this->line_manager_one_response->CurrentValue;
        $this->line_manager_two->CurrentValue = null;
        $this->line_manager_two->OldValue = $this->line_manager_two->CurrentValue;
        $this->line_manager_two_response->CurrentValue = null;
        $this->line_manager_two_response->OldValue = $this->line_manager_two_response->CurrentValue;
        $this->consolidate_score->CurrentValue = null;
        $this->consolidate_score->OldValue = $this->consolidate_score->CurrentValue;
        $this->created_at->CurrentValue = null;
        $this->created_at->OldValue = $this->created_at->CurrentValue;
        $this->updated_at->CurrentValue = null;
        $this->updated_at->OldValue = $this->updated_at->CurrentValue;
    }

    // Load form values
    protected function loadFormValues()
    {
        // Load from form
        global $CurrentForm;
        $validate = !Config("SERVER_VALIDATE");

        // Check field name 'appraisal' first before field var 'x_appraisal'
        $val = $CurrentForm->hasValue("appraisal") ? $CurrentForm->getValue("appraisal") : $CurrentForm->getValue("x_appraisal");
        if (!$this->appraisal->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->appraisal->Visible = false; // Disable update for API request
            } else {
                $this->appraisal->setFormValue($val);
            }
        }

        // Check field name 'employee' first before field var 'x_employee'
        $val = $CurrentForm->hasValue("employee") ? $CurrentForm->getValue("employee") : $CurrentForm->getValue("x_employee");
        if (!$this->employee->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->employee->Visible = false; // Disable update for API request
            } else {
                $this->employee->setFormValue($val);
            }
        }

        // Check field name 'employee_response' first before field var 'x_employee_response'
        $val = $CurrentForm->hasValue("employee_response") ? $CurrentForm->getValue("employee_response") : $CurrentForm->getValue("x_employee_response");
        if (!$this->employee_response->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->employee_response->Visible = false; // Disable update for API request
            } else {
                $this->employee_response->setFormValue($val);
            }
        }

        // Check field name 'line_manager_one' first before field var 'x_line_manager_one'
        $val = $CurrentForm->hasValue("line_manager_one") ? $CurrentForm->getValue("line_manager_one") : $CurrentForm->getValue("x_line_manager_one");
        if (!$this->line_manager_one->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->line_manager_one->Visible = false; // Disable update for API request
            } else {
                $this->line_manager_one->setFormValue($val);
            }
        }

        // Check field name 'line_manager_one_response' first before field var 'x_line_manager_one_response'
        $val = $CurrentForm->hasValue("line_manager_one_response") ? $CurrentForm->getValue("line_manager_one_response") : $CurrentForm->getValue("x_line_manager_one_response");
        if (!$this->line_manager_one_response->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->line_manager_one_response->Visible = false; // Disable update for API request
            } else {
                $this->line_manager_one_response->setFormValue($val);
            }
        }

        // Check field name 'line_manager_two' first before field var 'x_line_manager_two'
        $val = $CurrentForm->hasValue("line_manager_two") ? $CurrentForm->getValue("line_manager_two") : $CurrentForm->getValue("x_line_manager_two");
        if (!$this->line_manager_two->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->line_manager_two->Visible = false; // Disable update for API request
            } else {
                $this->line_manager_two->setFormValue($val);
            }
        }

        // Check field name 'line_manager_two_response' first before field var 'x_line_manager_two_response'
        $val = $CurrentForm->hasValue("line_manager_two_response") ? $CurrentForm->getValue("line_manager_two_response") : $CurrentForm->getValue("x_line_manager_two_response");
        if (!$this->line_manager_two_response->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->line_manager_two_response->Visible = false; // Disable update for API request
            } else {
                $this->line_manager_two_response->setFormValue($val);
            }
        }

        // Check field name 'consolidate_score' first before field var 'x_consolidate_score'
        $val = $CurrentForm->hasValue("consolidate_score") ? $CurrentForm->getValue("consolidate_score") : $CurrentForm->getValue("x_consolidate_score");
        if (!$this->consolidate_score->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->consolidate_score->Visible = false; // Disable update for API request
            } else {
                $this->consolidate_score->setFormValue($val);
            }
        }

        // Check field name 'created_at' first before field var 'x_created_at'
        $val = $CurrentForm->hasValue("created_at") ? $CurrentForm->getValue("created_at") : $CurrentForm->getValue("x_created_at");
        if (!$this->created_at->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->created_at->Visible = false; // Disable update for API request
            } else {
                $this->created_at->setFormValue($val);
            }
            $this->created_at->CurrentValue = UnFormatDateTime($this->created_at->CurrentValue, $this->created_at->formatPattern());
        }

        // Check field name 'updated_at' first before field var 'x_updated_at'
        $val = $CurrentForm->hasValue("updated_at") ? $CurrentForm->getValue("updated_at") : $CurrentForm->getValue("x_updated_at");
        if (!$this->updated_at->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->updated_at->Visible = false; // Disable update for API request
            } else {
                $this->updated_at->setFormValue($val);
            }
            $this->updated_at->CurrentValue = UnFormatDateTime($this->updated_at->CurrentValue, $this->updated_at->formatPattern());
        }

        // Check field name 'id' first before field var 'x_id'
        $val = $CurrentForm->hasValue("id") ? $CurrentForm->getValue("id") : $CurrentForm->getValue("x_id");
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
        $this->appraisal->CurrentValue = $this->appraisal->FormValue;
        $this->employee->CurrentValue = $this->employee->FormValue;
        $this->employee_response->CurrentValue = $this->employee_response->FormValue;
        $this->line_manager_one->CurrentValue = $this->line_manager_one->FormValue;
        $this->line_manager_one_response->CurrentValue = $this->line_manager_one_response->FormValue;
        $this->line_manager_two->CurrentValue = $this->line_manager_two->FormValue;
        $this->line_manager_two_response->CurrentValue = $this->line_manager_two_response->FormValue;
        $this->consolidate_score->CurrentValue = $this->consolidate_score->FormValue;
        $this->created_at->CurrentValue = $this->created_at->FormValue;
        $this->created_at->CurrentValue = UnFormatDateTime($this->created_at->CurrentValue, $this->created_at->formatPattern());
        $this->updated_at->CurrentValue = $this->updated_at->FormValue;
        $this->updated_at->CurrentValue = UnFormatDateTime($this->updated_at->CurrentValue, $this->updated_at->formatPattern());
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
        $this->appraisal->setDbValue($row['appraisal']);
        $this->employee->setDbValue($row['employee']);
        $this->employee_response->setDbValue($row['employee_response']);
        $this->line_manager_one->setDbValue($row['line_manager_one']);
        $this->line_manager_one_response->setDbValue($row['line_manager_one_response']);
        $this->line_manager_two->setDbValue($row['line_manager_two']);
        $this->line_manager_two_response->setDbValue($row['line_manager_two_response']);
        $this->consolidate_score->setDbValue($row['consolidate_score']);
        $this->created_at->setDbValue($row['created_at']);
        $this->updated_at->setDbValue($row['updated_at']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $this->loadDefaultValues();
        $row = [];
        $row['id'] = $this->id->CurrentValue;
        $row['appraisal'] = $this->appraisal->CurrentValue;
        $row['employee'] = $this->employee->CurrentValue;
        $row['employee_response'] = $this->employee_response->CurrentValue;
        $row['line_manager_one'] = $this->line_manager_one->CurrentValue;
        $row['line_manager_one_response'] = $this->line_manager_one_response->CurrentValue;
        $row['line_manager_two'] = $this->line_manager_two->CurrentValue;
        $row['line_manager_two_response'] = $this->line_manager_two_response->CurrentValue;
        $row['consolidate_score'] = $this->consolidate_score->CurrentValue;
        $row['created_at'] = $this->created_at->CurrentValue;
        $row['updated_at'] = $this->updated_at->CurrentValue;
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

        // appraisal
        $this->appraisal->RowCssClass = "row";

        // employee
        $this->employee->RowCssClass = "row";

        // employee_response
        $this->employee_response->RowCssClass = "row";

        // line_manager_one
        $this->line_manager_one->RowCssClass = "row";

        // line_manager_one_response
        $this->line_manager_one_response->RowCssClass = "row";

        // line_manager_two
        $this->line_manager_two->RowCssClass = "row";

        // line_manager_two_response
        $this->line_manager_two_response->RowCssClass = "row";

        // consolidate_score
        $this->consolidate_score->RowCssClass = "row";

        // created_at
        $this->created_at->RowCssClass = "row";

        // updated_at
        $this->updated_at->RowCssClass = "row";

        // View row
        if ($this->RowType == ROWTYPE_VIEW) {
            // id
            $this->id->ViewValue = $this->id->CurrentValue;
            $this->id->ViewValue = FormatNumber($this->id->ViewValue, "");
            $this->id->ViewCustomAttributes = "";

            // appraisal
            $curVal = strval($this->appraisal->CurrentValue);
            if ($curVal != "") {
                $this->appraisal->ViewValue = $this->appraisal->lookupCacheOption($curVal);
                if ($this->appraisal->ViewValue === null) { // Lookup from database
                    $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $sqlWrk = $this->appraisal->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $conn = Conn();
                    $config = $conn->getConfiguration();
                    $config->setResultCacheImpl($this->Cache);
                    $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->appraisal->Lookup->renderViewRow($rswrk[0]);
                        $this->appraisal->ViewValue = $this->appraisal->displayValue($arwrk);
                    } else {
                        $this->appraisal->ViewValue = $this->appraisal->CurrentValue;
                    }
                }
            } else {
                $this->appraisal->ViewValue = null;
            }
            $this->appraisal->ViewCustomAttributes = "";

            // employee
            $curVal = strval($this->employee->CurrentValue);
            if ($curVal != "") {
                $this->employee->ViewValue = $this->employee->lookupCacheOption($curVal);
                if ($this->employee->ViewValue === null) { // Lookup from database
                    $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $sqlWrk = $this->employee->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $conn = Conn();
                    $config = $conn->getConfiguration();
                    $config->setResultCacheImpl($this->Cache);
                    $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->employee->Lookup->renderViewRow($rswrk[0]);
                        $this->employee->ViewValue = $this->employee->displayValue($arwrk);
                    } else {
                        $this->employee->ViewValue = $this->employee->CurrentValue;
                    }
                }
            } else {
                $this->employee->ViewValue = null;
            }
            $this->employee->ViewCustomAttributes = "";

            // employee_response
            $this->employee_response->ViewValue = $this->employee_response->CurrentValue;
            $this->employee_response->ViewCustomAttributes = "";

            // line_manager_one
            $curVal = strval($this->line_manager_one->CurrentValue);
            if ($curVal != "") {
                $this->line_manager_one->ViewValue = $this->line_manager_one->lookupCacheOption($curVal);
                if ($this->line_manager_one->ViewValue === null) { // Lookup from database
                    $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $sqlWrk = $this->line_manager_one->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $conn = Conn();
                    $config = $conn->getConfiguration();
                    $config->setResultCacheImpl($this->Cache);
                    $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->line_manager_one->Lookup->renderViewRow($rswrk[0]);
                        $this->line_manager_one->ViewValue = $this->line_manager_one->displayValue($arwrk);
                    } else {
                        $this->line_manager_one->ViewValue = $this->line_manager_one->CurrentValue;
                    }
                }
            } else {
                $this->line_manager_one->ViewValue = null;
            }
            $this->line_manager_one->ViewCustomAttributes = "";

            // line_manager_one_response
            $this->line_manager_one_response->ViewValue = $this->line_manager_one_response->CurrentValue;
            $this->line_manager_one_response->ViewCustomAttributes = "";

            // line_manager_two
            $curVal = strval($this->line_manager_two->CurrentValue);
            if ($curVal != "") {
                $this->line_manager_two->ViewValue = $this->line_manager_two->lookupCacheOption($curVal);
                if ($this->line_manager_two->ViewValue === null) { // Lookup from database
                    $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $sqlWrk = $this->line_manager_two->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $conn = Conn();
                    $config = $conn->getConfiguration();
                    $config->setResultCacheImpl($this->Cache);
                    $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->line_manager_two->Lookup->renderViewRow($rswrk[0]);
                        $this->line_manager_two->ViewValue = $this->line_manager_two->displayValue($arwrk);
                    } else {
                        $this->line_manager_two->ViewValue = $this->line_manager_two->CurrentValue;
                    }
                }
            } else {
                $this->line_manager_two->ViewValue = null;
            }
            $this->line_manager_two->ViewCustomAttributes = "";

            // line_manager_two_response
            $this->line_manager_two_response->ViewValue = $this->line_manager_two_response->CurrentValue;
            $this->line_manager_two_response->ViewCustomAttributes = "";

            // consolidate_score
            $this->consolidate_score->ViewValue = $this->consolidate_score->CurrentValue;
            $this->consolidate_score->ViewCustomAttributes = "";

            // created_at
            $this->created_at->ViewValue = $this->created_at->CurrentValue;
            $this->created_at->ViewValue = FormatDateTime($this->created_at->ViewValue, 0);
            $this->created_at->ViewCustomAttributes = "";

            // updated_at
            $this->updated_at->ViewValue = $this->updated_at->CurrentValue;
            $this->updated_at->ViewValue = FormatDateTime($this->updated_at->ViewValue, 0);
            $this->updated_at->ViewCustomAttributes = "";

            // appraisal
            $this->appraisal->LinkCustomAttributes = "";
            $this->appraisal->HrefValue = "";

            // employee
            $this->employee->LinkCustomAttributes = "";
            $this->employee->HrefValue = "";

            // employee_response
            $this->employee_response->LinkCustomAttributes = "";
            $this->employee_response->HrefValue = "";

            // line_manager_one
            $this->line_manager_one->LinkCustomAttributes = "";
            $this->line_manager_one->HrefValue = "";

            // line_manager_one_response
            $this->line_manager_one_response->LinkCustomAttributes = "";
            $this->line_manager_one_response->HrefValue = "";

            // line_manager_two
            $this->line_manager_two->LinkCustomAttributes = "";
            $this->line_manager_two->HrefValue = "";

            // line_manager_two_response
            $this->line_manager_two_response->LinkCustomAttributes = "";
            $this->line_manager_two_response->HrefValue = "";

            // consolidate_score
            $this->consolidate_score->LinkCustomAttributes = "";
            $this->consolidate_score->HrefValue = "";

            // created_at
            $this->created_at->LinkCustomAttributes = "";
            $this->created_at->HrefValue = "";

            // updated_at
            $this->updated_at->LinkCustomAttributes = "";
            $this->updated_at->HrefValue = "";
        } elseif ($this->RowType == ROWTYPE_ADD) {
            // appraisal
            $this->appraisal->EditCustomAttributes = "";
            $curVal = trim(strval($this->appraisal->CurrentValue));
            if ($curVal != "") {
                $this->appraisal->ViewValue = $this->appraisal->lookupCacheOption($curVal);
            } else {
                $this->appraisal->ViewValue = $this->appraisal->Lookup !== null && is_array($this->appraisal->lookupOptions()) ? $curVal : null;
            }
            if ($this->appraisal->ViewValue !== null) { // Load from cache
                $this->appraisal->EditValue = array_values($this->appraisal->lookupOptions());
                if ($this->appraisal->ViewValue == "") {
                    $this->appraisal->ViewValue = $Language->phrase("PleaseSelect");
                }
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "`id`" . SearchString("=", $this->appraisal->CurrentValue, DATATYPE_NUMBER, "");
                }
                $sqlWrk = $this->appraisal->Lookup->getSql(true, $filterWrk, '', $this, false, true);
                $conn = Conn();
                $config = $conn->getConfiguration();
                $config->setResultCacheImpl($this->Cache);
                $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->appraisal->Lookup->renderViewRow($rswrk[0]);
                    $this->appraisal->ViewValue = $this->appraisal->displayValue($arwrk);
                } else {
                    $this->appraisal->ViewValue = $Language->phrase("PleaseSelect");
                }
                $arwrk = $rswrk;
                foreach ($arwrk as &$row) {
                    $row = $this->appraisal->Lookup->renderViewRow($row);
                }
                $this->appraisal->EditValue = $arwrk;
            }
            $this->appraisal->PlaceHolder = RemoveHtml($this->appraisal->caption());

            // employee
            $this->employee->EditCustomAttributes = "";
            $curVal = trim(strval($this->employee->CurrentValue));
            if ($curVal != "") {
                $this->employee->ViewValue = $this->employee->lookupCacheOption($curVal);
            } else {
                $this->employee->ViewValue = $this->employee->Lookup !== null && is_array($this->employee->lookupOptions()) ? $curVal : null;
            }
            if ($this->employee->ViewValue !== null) { // Load from cache
                $this->employee->EditValue = array_values($this->employee->lookupOptions());
                if ($this->employee->ViewValue == "") {
                    $this->employee->ViewValue = $Language->phrase("PleaseSelect");
                }
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "`id`" . SearchString("=", $this->employee->CurrentValue, DATATYPE_NUMBER, "");
                }
                $sqlWrk = $this->employee->Lookup->getSql(true, $filterWrk, '', $this, false, true);
                $conn = Conn();
                $config = $conn->getConfiguration();
                $config->setResultCacheImpl($this->Cache);
                $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->employee->Lookup->renderViewRow($rswrk[0]);
                    $this->employee->ViewValue = $this->employee->displayValue($arwrk);
                } else {
                    $this->employee->ViewValue = $Language->phrase("PleaseSelect");
                }
                $arwrk = $rswrk;
                $this->employee->EditValue = $arwrk;
            }
            $this->employee->PlaceHolder = RemoveHtml($this->employee->caption());

            // employee_response
            $this->employee_response->setupEditAttributes();
            $this->employee_response->EditCustomAttributes = "";
            $this->employee_response->EditValue = HtmlEncode($this->employee_response->CurrentValue);
            $this->employee_response->PlaceHolder = RemoveHtml($this->employee_response->caption());

            // line_manager_one
            $this->line_manager_one->setupEditAttributes();
            $this->line_manager_one->EditCustomAttributes = "";
            $curVal = trim(strval($this->line_manager_one->CurrentValue));
            if ($curVal != "") {
                $this->line_manager_one->ViewValue = $this->line_manager_one->lookupCacheOption($curVal);
            } else {
                $this->line_manager_one->ViewValue = $this->line_manager_one->Lookup !== null && is_array($this->line_manager_one->lookupOptions()) ? $curVal : null;
            }
            if ($this->line_manager_one->ViewValue !== null) { // Load from cache
                $this->line_manager_one->EditValue = array_values($this->line_manager_one->lookupOptions());
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "`id`" . SearchString("=", $this->line_manager_one->CurrentValue, DATATYPE_NUMBER, "");
                }
                $sqlWrk = $this->line_manager_one->Lookup->getSql(true, $filterWrk, '', $this, false, true);
                $conn = Conn();
                $config = $conn->getConfiguration();
                $config->setResultCacheImpl($this->Cache);
                $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->line_manager_one->EditValue = $arwrk;
            }
            $this->line_manager_one->PlaceHolder = RemoveHtml($this->line_manager_one->caption());

            // line_manager_one_response
            $this->line_manager_one_response->setupEditAttributes();
            $this->line_manager_one_response->EditCustomAttributes = "";
            $this->line_manager_one_response->EditValue = HtmlEncode($this->line_manager_one_response->CurrentValue);
            $this->line_manager_one_response->PlaceHolder = RemoveHtml($this->line_manager_one_response->caption());

            // line_manager_two
            $this->line_manager_two->setupEditAttributes();
            $this->line_manager_two->EditCustomAttributes = "";
            $curVal = trim(strval($this->line_manager_two->CurrentValue));
            if ($curVal != "") {
                $this->line_manager_two->ViewValue = $this->line_manager_two->lookupCacheOption($curVal);
            } else {
                $this->line_manager_two->ViewValue = $this->line_manager_two->Lookup !== null && is_array($this->line_manager_two->lookupOptions()) ? $curVal : null;
            }
            if ($this->line_manager_two->ViewValue !== null) { // Load from cache
                $this->line_manager_two->EditValue = array_values($this->line_manager_two->lookupOptions());
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "`id`" . SearchString("=", $this->line_manager_two->CurrentValue, DATATYPE_NUMBER, "");
                }
                $sqlWrk = $this->line_manager_two->Lookup->getSql(true, $filterWrk, '', $this, false, true);
                $conn = Conn();
                $config = $conn->getConfiguration();
                $config->setResultCacheImpl($this->Cache);
                $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->line_manager_two->EditValue = $arwrk;
            }
            $this->line_manager_two->PlaceHolder = RemoveHtml($this->line_manager_two->caption());

            // line_manager_two_response
            $this->line_manager_two_response->setupEditAttributes();
            $this->line_manager_two_response->EditCustomAttributes = "";
            $this->line_manager_two_response->EditValue = HtmlEncode($this->line_manager_two_response->CurrentValue);
            $this->line_manager_two_response->PlaceHolder = RemoveHtml($this->line_manager_two_response->caption());

            // consolidate_score
            $this->consolidate_score->setupEditAttributes();
            $this->consolidate_score->EditCustomAttributes = "";
            $this->consolidate_score->EditValue = HtmlEncode($this->consolidate_score->CurrentValue);
            $this->consolidate_score->PlaceHolder = RemoveHtml($this->consolidate_score->caption());

            // created_at

            // updated_at

            // Add refer script

            // appraisal
            $this->appraisal->LinkCustomAttributes = "";
            $this->appraisal->HrefValue = "";

            // employee
            $this->employee->LinkCustomAttributes = "";
            $this->employee->HrefValue = "";

            // employee_response
            $this->employee_response->LinkCustomAttributes = "";
            $this->employee_response->HrefValue = "";

            // line_manager_one
            $this->line_manager_one->LinkCustomAttributes = "";
            $this->line_manager_one->HrefValue = "";

            // line_manager_one_response
            $this->line_manager_one_response->LinkCustomAttributes = "";
            $this->line_manager_one_response->HrefValue = "";

            // line_manager_two
            $this->line_manager_two->LinkCustomAttributes = "";
            $this->line_manager_two->HrefValue = "";

            // line_manager_two_response
            $this->line_manager_two_response->LinkCustomAttributes = "";
            $this->line_manager_two_response->HrefValue = "";

            // consolidate_score
            $this->consolidate_score->LinkCustomAttributes = "";
            $this->consolidate_score->HrefValue = "";

            // created_at
            $this->created_at->LinkCustomAttributes = "";
            $this->created_at->HrefValue = "";

            // updated_at
            $this->updated_at->LinkCustomAttributes = "";
            $this->updated_at->HrefValue = "";
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
        if ($this->appraisal->Required) {
            if (!$this->appraisal->IsDetailKey && EmptyValue($this->appraisal->FormValue)) {
                $this->appraisal->addErrorMessage(str_replace("%s", $this->appraisal->caption(), $this->appraisal->RequiredErrorMessage));
            }
        }
        if ($this->employee->Required) {
            if (!$this->employee->IsDetailKey && EmptyValue($this->employee->FormValue)) {
                $this->employee->addErrorMessage(str_replace("%s", $this->employee->caption(), $this->employee->RequiredErrorMessage));
            }
        }
        if ($this->employee_response->Required) {
            if (!$this->employee_response->IsDetailKey && EmptyValue($this->employee_response->FormValue)) {
                $this->employee_response->addErrorMessage(str_replace("%s", $this->employee_response->caption(), $this->employee_response->RequiredErrorMessage));
            }
        }
        if ($this->line_manager_one->Required) {
            if (!$this->line_manager_one->IsDetailKey && EmptyValue($this->line_manager_one->FormValue)) {
                $this->line_manager_one->addErrorMessage(str_replace("%s", $this->line_manager_one->caption(), $this->line_manager_one->RequiredErrorMessage));
            }
        }
        if ($this->line_manager_one_response->Required) {
            if (!$this->line_manager_one_response->IsDetailKey && EmptyValue($this->line_manager_one_response->FormValue)) {
                $this->line_manager_one_response->addErrorMessage(str_replace("%s", $this->line_manager_one_response->caption(), $this->line_manager_one_response->RequiredErrorMessage));
            }
        }
        if ($this->line_manager_two->Required) {
            if (!$this->line_manager_two->IsDetailKey && EmptyValue($this->line_manager_two->FormValue)) {
                $this->line_manager_two->addErrorMessage(str_replace("%s", $this->line_manager_two->caption(), $this->line_manager_two->RequiredErrorMessage));
            }
        }
        if ($this->line_manager_two_response->Required) {
            if (!$this->line_manager_two_response->IsDetailKey && EmptyValue($this->line_manager_two_response->FormValue)) {
                $this->line_manager_two_response->addErrorMessage(str_replace("%s", $this->line_manager_two_response->caption(), $this->line_manager_two_response->RequiredErrorMessage));
            }
        }
        if ($this->consolidate_score->Required) {
            if (!$this->consolidate_score->IsDetailKey && EmptyValue($this->consolidate_score->FormValue)) {
                $this->consolidate_score->addErrorMessage(str_replace("%s", $this->consolidate_score->caption(), $this->consolidate_score->RequiredErrorMessage));
            }
        }
        if ($this->created_at->Required) {
            if (!$this->created_at->IsDetailKey && EmptyValue($this->created_at->FormValue)) {
                $this->created_at->addErrorMessage(str_replace("%s", $this->created_at->caption(), $this->created_at->RequiredErrorMessage));
            }
        }
        if ($this->updated_at->Required) {
            if (!$this->updated_at->IsDetailKey && EmptyValue($this->updated_at->FormValue)) {
                $this->updated_at->addErrorMessage(str_replace("%s", $this->updated_at->caption(), $this->updated_at->RequiredErrorMessage));
            }
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

        // Load db values from rsold
        $this->loadDbValues($rsold);
        if ($rsold) {
        }
        $rsnew = [];

        // appraisal
        $this->appraisal->setDbValueDef($rsnew, $this->appraisal->CurrentValue, null, false);

        // employee
        $this->employee->setDbValueDef($rsnew, $this->employee->CurrentValue, null, false);

        // employee_response
        $this->employee_response->setDbValueDef($rsnew, $this->employee_response->CurrentValue, null, false);

        // line_manager_one
        $this->line_manager_one->setDbValueDef($rsnew, $this->line_manager_one->CurrentValue, null, false);

        // line_manager_one_response
        $this->line_manager_one_response->setDbValueDef($rsnew, $this->line_manager_one_response->CurrentValue, null, false);

        // line_manager_two
        $this->line_manager_two->setDbValueDef($rsnew, $this->line_manager_two->CurrentValue, null, false);

        // line_manager_two_response
        $this->line_manager_two_response->setDbValueDef($rsnew, $this->line_manager_two_response->CurrentValue, null, false);

        // consolidate_score
        $this->consolidate_score->setDbValueDef($rsnew, $this->consolidate_score->CurrentValue, "", false);

        // created_at
        $this->created_at->CurrentValue = CurrentDate();
        $this->created_at->setDbValueDef($rsnew, $this->created_at->CurrentValue, null);

        // updated_at
        $this->updated_at->CurrentValue = CurrentDate();
        $this->updated_at->setDbValueDef($rsnew, $this->updated_at->CurrentValue, null);

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

    // Set up Breadcrumb
    protected function setupBreadcrumb()
    {
        global $Breadcrumb, $Language;
        $Breadcrumb = new Breadcrumb("index");
        $url = CurrentUrl();
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("mainpascorelist"), "", $this->TableVar, true);
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
                case "x_appraisal":
                    break;
                case "x_employee":
                    break;
                case "x_line_manager_one":
                    break;
                case "x_line_manager_two":
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
