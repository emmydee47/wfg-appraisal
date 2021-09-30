<?php

namespace PHPMaker2022\wfg_appraisal;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Page class
 */
class MainUsersAdd extends MainUsers
{
    use MessagesTrait;

    // Page ID
    public $PageID = "add";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'main_users';

    // Page object name
    public $PageObjName = "MainUsersAdd";

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

        // Table object (main_users)
        if (!isset($GLOBALS["main_users"]) || get_class($GLOBALS["main_users"]) == PROJECT_NAMESPACE . "main_users") {
            $GLOBALS["main_users"] = &$this;
        }

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

            // Handle modal response
            if ($this->IsModal) { // Show as modal
                $row = ["url" => GetUrl($url), "modal" => "1"];
                $pageName = GetPageName($url);
                if ($pageName != $this->getListUrl()) { // Not List page
                    $row["caption"] = $this->getModalCaption($pageName);
                    if ($pageName == "mainusersview") {
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
        $this->emprole->setVisibility();
        $this->userstatus->Visible = false;
        $this->firstname->setVisibility();
        $this->lastname->setVisibility();
        $this->userfullname->setVisibility();
        $this->emailaddress->setVisibility();
        $this->contactnumber->Visible = false;
        $this->empipaddress->setVisibility();
        $this->backgroundchk_status->setVisibility();
        $this->emptemplock->Visible = false;
        $this->empreasonlocked->Visible = false;
        $this->emplockeddate->Visible = false;
        $this->emppassword->setVisibility();
        $this->createdby->Visible = false;
        $this->modifiedby->Visible = false;
        $this->createddate->Visible = false;
        $this->modifieddate->Visible = false;
        $this->isactive->setVisibility();
        $this->staff_ID->setVisibility();
        $this->modeofentry->Visible = false;
        $this->other_modeofentry->Visible = false;
        $this->entrycomments->Visible = false;
        $this->selecteddate->Visible = false;
        $this->company_id->Visible = false;
        $this->profileimg->setVisibility();
        $this->jobtitle_id->Visible = false;
        $this->tourflag->Visible = false;
        $this->themes->Visible = false;
        $this->is_admin->Visible = false;
        $this->role_id->Visible = false;
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
        $this->setupLookupOptions($this->emprole);
        $this->setupLookupOptions($this->userstatus);
        $this->setupLookupOptions($this->backgroundchk_status);
        $this->setupLookupOptions($this->themes);

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
                    $this->terminate("mainuserslist"); // No matching record, return to list
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
                    if (GetPageName($returnUrl) == "mainuserslist") {
                        $returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
                    } elseif (GetPageName($returnUrl) == "mainusersview") {
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
        $this->profileimg->Upload->Index = $CurrentForm->Index;
        $this->profileimg->Upload->uploadFile();
        $this->profileimg->CurrentValue = $this->profileimg->Upload->FileName;
    }

    // Load default values
    protected function loadDefaultValues()
    {
        $this->id->CurrentValue = null;
        $this->id->OldValue = $this->id->CurrentValue;
        $this->emprole->CurrentValue = null;
        $this->emprole->OldValue = $this->emprole->CurrentValue;
        $this->userstatus->CurrentValue = "new";
        $this->firstname->CurrentValue = null;
        $this->firstname->OldValue = $this->firstname->CurrentValue;
        $this->lastname->CurrentValue = null;
        $this->lastname->OldValue = $this->lastname->CurrentValue;
        $this->userfullname->CurrentValue = null;
        $this->userfullname->OldValue = $this->userfullname->CurrentValue;
        $this->emailaddress->CurrentValue = null;
        $this->emailaddress->OldValue = $this->emailaddress->CurrentValue;
        $this->contactnumber->CurrentValue = null;
        $this->contactnumber->OldValue = $this->contactnumber->CurrentValue;
        $this->empipaddress->CurrentValue = null;
        $this->empipaddress->OldValue = $this->empipaddress->CurrentValue;
        $this->backgroundchk_status->CurrentValue = "Yet to start";
        $this->emptemplock->CurrentValue = 0;
        $this->empreasonlocked->CurrentValue = null;
        $this->empreasonlocked->OldValue = $this->empreasonlocked->CurrentValue;
        $this->emplockeddate->CurrentValue = null;
        $this->emplockeddate->OldValue = $this->emplockeddate->CurrentValue;
        $this->emppassword->CurrentValue = null;
        $this->emppassword->OldValue = $this->emppassword->CurrentValue;
        $this->createdby->CurrentValue = null;
        $this->createdby->OldValue = $this->createdby->CurrentValue;
        $this->modifiedby->CurrentValue = null;
        $this->modifiedby->OldValue = $this->modifiedby->CurrentValue;
        $this->createddate->CurrentValue = null;
        $this->createddate->OldValue = $this->createddate->CurrentValue;
        $this->modifieddate->CurrentValue = null;
        $this->modifieddate->OldValue = $this->modifieddate->CurrentValue;
        $this->isactive->CurrentValue = 1;
        $this->staff_ID->CurrentValue = null;
        $this->staff_ID->OldValue = $this->staff_ID->CurrentValue;
        $this->modeofentry->CurrentValue = null;
        $this->modeofentry->OldValue = $this->modeofentry->CurrentValue;
        $this->other_modeofentry->CurrentValue = null;
        $this->other_modeofentry->OldValue = $this->other_modeofentry->CurrentValue;
        $this->entrycomments->CurrentValue = null;
        $this->entrycomments->OldValue = $this->entrycomments->CurrentValue;
        $this->selecteddate->CurrentValue = null;
        $this->selecteddate->OldValue = $this->selecteddate->CurrentValue;
        $this->company_id->CurrentValue = null;
        $this->company_id->OldValue = $this->company_id->CurrentValue;
        $this->profileimg->Upload->DbValue = null;
        $this->profileimg->OldValue = $this->profileimg->Upload->DbValue;
        $this->profileimg->CurrentValue = null; // Clear file related field
        $this->jobtitle_id->CurrentValue = null;
        $this->jobtitle_id->OldValue = $this->jobtitle_id->CurrentValue;
        $this->tourflag->CurrentValue = 0;
        $this->themes->CurrentValue = "default";
        $this->is_admin->CurrentValue = null;
        $this->is_admin->OldValue = $this->is_admin->CurrentValue;
        $this->role_id->CurrentValue = null;
        $this->role_id->OldValue = $this->role_id->CurrentValue;
    }

    // Load form values
    protected function loadFormValues()
    {
        // Load from form
        global $CurrentForm;
        $validate = !Config("SERVER_VALIDATE");

        // Check field name 'emprole' first before field var 'x_emprole'
        $val = $CurrentForm->hasValue("emprole") ? $CurrentForm->getValue("emprole") : $CurrentForm->getValue("x_emprole");
        if (!$this->emprole->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->emprole->Visible = false; // Disable update for API request
            } else {
                $this->emprole->setFormValue($val);
            }
        }

        // Check field name 'firstname' first before field var 'x_firstname'
        $val = $CurrentForm->hasValue("firstname") ? $CurrentForm->getValue("firstname") : $CurrentForm->getValue("x_firstname");
        if (!$this->firstname->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->firstname->Visible = false; // Disable update for API request
            } else {
                $this->firstname->setFormValue($val);
            }
        }

        // Check field name 'lastname' first before field var 'x_lastname'
        $val = $CurrentForm->hasValue("lastname") ? $CurrentForm->getValue("lastname") : $CurrentForm->getValue("x_lastname");
        if (!$this->lastname->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->lastname->Visible = false; // Disable update for API request
            } else {
                $this->lastname->setFormValue($val);
            }
        }

        // Check field name 'userfullname' first before field var 'x_userfullname'
        $val = $CurrentForm->hasValue("userfullname") ? $CurrentForm->getValue("userfullname") : $CurrentForm->getValue("x_userfullname");
        if (!$this->userfullname->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->userfullname->Visible = false; // Disable update for API request
            } else {
                $this->userfullname->setFormValue($val);
            }
        }

        // Check field name 'emailaddress' first before field var 'x_emailaddress'
        $val = $CurrentForm->hasValue("emailaddress") ? $CurrentForm->getValue("emailaddress") : $CurrentForm->getValue("x_emailaddress");
        if (!$this->emailaddress->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->emailaddress->Visible = false; // Disable update for API request
            } else {
                $this->emailaddress->setFormValue($val);
            }
        }

        // Check field name 'empipaddress' first before field var 'x_empipaddress'
        $val = $CurrentForm->hasValue("empipaddress") ? $CurrentForm->getValue("empipaddress") : $CurrentForm->getValue("x_empipaddress");
        if (!$this->empipaddress->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->empipaddress->Visible = false; // Disable update for API request
            } else {
                $this->empipaddress->setFormValue($val);
            }
        }

        // Check field name 'backgroundchk_status' first before field var 'x_backgroundchk_status'
        $val = $CurrentForm->hasValue("backgroundchk_status") ? $CurrentForm->getValue("backgroundchk_status") : $CurrentForm->getValue("x_backgroundchk_status");
        if (!$this->backgroundchk_status->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->backgroundchk_status->Visible = false; // Disable update for API request
            } else {
                $this->backgroundchk_status->setFormValue($val);
            }
        }

        // Check field name 'emppassword' first before field var 'x_emppassword'
        $val = $CurrentForm->hasValue("emppassword") ? $CurrentForm->getValue("emppassword") : $CurrentForm->getValue("x_emppassword");
        if (!$this->emppassword->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->emppassword->Visible = false; // Disable update for API request
            } else {
                $this->emppassword->setFormValue($val);
            }
        }

        // Check field name 'isactive' first before field var 'x_isactive'
        $val = $CurrentForm->hasValue("isactive") ? $CurrentForm->getValue("isactive") : $CurrentForm->getValue("x_isactive");
        if (!$this->isactive->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->isactive->Visible = false; // Disable update for API request
            } else {
                $this->isactive->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'staff_ID' first before field var 'x_staff_ID'
        $val = $CurrentForm->hasValue("staff_ID") ? $CurrentForm->getValue("staff_ID") : $CurrentForm->getValue("x_staff_ID");
        if (!$this->staff_ID->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->staff_ID->Visible = false; // Disable update for API request
            } else {
                $this->staff_ID->setFormValue($val);
            }
        }

        // Check field name 'id' first before field var 'x_id'
        $val = $CurrentForm->hasValue("id") ? $CurrentForm->getValue("id") : $CurrentForm->getValue("x_id");
        $this->getUploadFiles(); // Get upload files
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
        $this->emprole->CurrentValue = $this->emprole->FormValue;
        $this->firstname->CurrentValue = $this->firstname->FormValue;
        $this->lastname->CurrentValue = $this->lastname->FormValue;
        $this->userfullname->CurrentValue = $this->userfullname->FormValue;
        $this->emailaddress->CurrentValue = $this->emailaddress->FormValue;
        $this->empipaddress->CurrentValue = $this->empipaddress->FormValue;
        $this->backgroundchk_status->CurrentValue = $this->backgroundchk_status->FormValue;
        $this->emppassword->CurrentValue = $this->emppassword->FormValue;
        $this->isactive->CurrentValue = $this->isactive->FormValue;
        $this->staff_ID->CurrentValue = $this->staff_ID->FormValue;
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

        // Check if valid User ID
        if ($res) {
            $res = $this->showOptionLink("add");
            if (!$res) {
                $userIdMsg = DeniedMessage();
                $this->setFailureMessage($userIdMsg);
            }
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
        $this->loadDefaultValues();
        $row = [];
        $row['id'] = $this->id->CurrentValue;
        $row['emprole'] = $this->emprole->CurrentValue;
        $row['userstatus'] = $this->userstatus->CurrentValue;
        $row['firstname'] = $this->firstname->CurrentValue;
        $row['lastname'] = $this->lastname->CurrentValue;
        $row['userfullname'] = $this->userfullname->CurrentValue;
        $row['emailaddress'] = $this->emailaddress->CurrentValue;
        $row['contactnumber'] = $this->contactnumber->CurrentValue;
        $row['empipaddress'] = $this->empipaddress->CurrentValue;
        $row['backgroundchk_status'] = $this->backgroundchk_status->CurrentValue;
        $row['emptemplock'] = $this->emptemplock->CurrentValue;
        $row['empreasonlocked'] = $this->empreasonlocked->CurrentValue;
        $row['emplockeddate'] = $this->emplockeddate->CurrentValue;
        $row['emppassword'] = $this->emppassword->CurrentValue;
        $row['createdby'] = $this->createdby->CurrentValue;
        $row['modifiedby'] = $this->modifiedby->CurrentValue;
        $row['createddate'] = $this->createddate->CurrentValue;
        $row['modifieddate'] = $this->modifieddate->CurrentValue;
        $row['isactive'] = $this->isactive->CurrentValue;
        $row['staff_ID'] = $this->staff_ID->CurrentValue;
        $row['modeofentry'] = $this->modeofentry->CurrentValue;
        $row['other_modeofentry'] = $this->other_modeofentry->CurrentValue;
        $row['entrycomments'] = $this->entrycomments->CurrentValue;
        $row['selecteddate'] = $this->selecteddate->CurrentValue;
        $row['company_id'] = $this->company_id->CurrentValue;
        $row['profileimg'] = $this->profileimg->Upload->DbValue;
        $row['jobtitle_id'] = $this->jobtitle_id->CurrentValue;
        $row['tourflag'] = $this->tourflag->CurrentValue;
        $row['themes'] = $this->themes->CurrentValue;
        $row['is_admin'] = $this->is_admin->CurrentValue;
        $row['role_id'] = $this->role_id->CurrentValue;
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

        // emprole
        $this->emprole->RowCssClass = "row";

        // userstatus
        $this->userstatus->RowCssClass = "row";

        // firstname
        $this->firstname->RowCssClass = "row";

        // lastname
        $this->lastname->RowCssClass = "row";

        // userfullname
        $this->userfullname->RowCssClass = "row";

        // emailaddress
        $this->emailaddress->RowCssClass = "row";

        // contactnumber
        $this->contactnumber->RowCssClass = "row";

        // empipaddress
        $this->empipaddress->RowCssClass = "row";

        // backgroundchk_status
        $this->backgroundchk_status->RowCssClass = "row";

        // emptemplock
        $this->emptemplock->RowCssClass = "row";

        // empreasonlocked
        $this->empreasonlocked->RowCssClass = "row";

        // emplockeddate
        $this->emplockeddate->RowCssClass = "row";

        // emppassword
        $this->emppassword->RowCssClass = "row";

        // createdby
        $this->createdby->RowCssClass = "row";

        // modifiedby
        $this->modifiedby->RowCssClass = "row";

        // createddate
        $this->createddate->RowCssClass = "row";

        // modifieddate
        $this->modifieddate->RowCssClass = "row";

        // isactive
        $this->isactive->RowCssClass = "row";

        // staff_ID
        $this->staff_ID->RowCssClass = "row";

        // modeofentry
        $this->modeofentry->RowCssClass = "row";

        // other_modeofentry
        $this->other_modeofentry->RowCssClass = "row";

        // entrycomments
        $this->entrycomments->RowCssClass = "row";

        // selecteddate
        $this->selecteddate->RowCssClass = "row";

        // company_id
        $this->company_id->RowCssClass = "row";

        // profileimg
        $this->profileimg->RowCssClass = "row";

        // jobtitle_id
        $this->jobtitle_id->RowCssClass = "row";

        // tourflag
        $this->tourflag->RowCssClass = "row";

        // themes
        $this->themes->RowCssClass = "row";

        // is_admin
        $this->is_admin->RowCssClass = "row";

        // role_id
        $this->role_id->RowCssClass = "row";

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

            // emprole
            $this->emprole->LinkCustomAttributes = "";
            $this->emprole->HrefValue = "";

            // firstname
            $this->firstname->LinkCustomAttributes = "";
            $this->firstname->HrefValue = "";

            // lastname
            $this->lastname->LinkCustomAttributes = "";
            $this->lastname->HrefValue = "";

            // userfullname
            $this->userfullname->LinkCustomAttributes = "";
            $this->userfullname->HrefValue = "";

            // emailaddress
            $this->emailaddress->LinkCustomAttributes = "";
            $this->emailaddress->HrefValue = "";

            // empipaddress
            $this->empipaddress->LinkCustomAttributes = "";
            $this->empipaddress->HrefValue = "";

            // backgroundchk_status
            $this->backgroundchk_status->LinkCustomAttributes = "";
            $this->backgroundchk_status->HrefValue = "";

            // emppassword
            $this->emppassword->LinkCustomAttributes = "";
            $this->emppassword->HrefValue = "";

            // isactive
            $this->isactive->LinkCustomAttributes = "";
            $this->isactive->HrefValue = "";

            // staff_ID
            $this->staff_ID->LinkCustomAttributes = "";
            $this->staff_ID->HrefValue = "";

            // profileimg
            $this->profileimg->LinkCustomAttributes = "";
            if (!EmptyValue($this->profileimg->Upload->DbValue)) {
                $this->profileimg->HrefValue = GetFileUploadUrl($this->profileimg, $this->profileimg->htmlDecode($this->profileimg->Upload->DbValue)); // Add prefix/suffix
                $this->profileimg->LinkAttrs["target"] = ""; // Add target
                if ($this->isExport()) {
                    $this->profileimg->HrefValue = FullUrl($this->profileimg->HrefValue, "href");
                }
            } else {
                $this->profileimg->HrefValue = "";
            }
            $this->profileimg->ExportHrefValue = $this->profileimg->UploadPath . $this->profileimg->Upload->DbValue;
        } elseif ($this->RowType == ROWTYPE_ADD) {
            // emprole
            $this->emprole->setupEditAttributes();
            $this->emprole->EditCustomAttributes = "";
            if (!$Security->canAdmin()) { // System admin
                $this->emprole->EditValue = $Language->phrase("PasswordMask");
            } else {
                $curVal = trim(strval($this->emprole->CurrentValue));
                if ($curVal != "") {
                    $this->emprole->ViewValue = $this->emprole->lookupCacheOption($curVal);
                } else {
                    $this->emprole->ViewValue = $this->emprole->Lookup !== null && is_array($this->emprole->lookupOptions()) ? $curVal : null;
                }
                if ($this->emprole->ViewValue !== null) { // Load from cache
                    $this->emprole->EditValue = array_values($this->emprole->lookupOptions());
                } else { // Lookup from database
                    if ($curVal == "") {
                        $filterWrk = "0=1";
                    } else {
                        $filterWrk = "`userlevelid`" . SearchString("=", $this->emprole->CurrentValue, DATATYPE_NUMBER, "");
                    }
                    $sqlWrk = $this->emprole->Lookup->getSql(true, $filterWrk, '', $this, false, true);
                    $conn = Conn();
                    $config = $conn->getConfiguration();
                    $config->setResultCacheImpl($this->Cache);
                    $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                    $ari = count($rswrk);
                    $arwrk = $rswrk;
                    $this->emprole->EditValue = $arwrk;
                }
                $this->emprole->PlaceHolder = RemoveHtml($this->emprole->caption());
            }

            // firstname
            $this->firstname->setupEditAttributes();
            $this->firstname->EditCustomAttributes = "";
            if (!$this->firstname->Raw) {
                $this->firstname->CurrentValue = HtmlDecode($this->firstname->CurrentValue);
            }
            $this->firstname->EditValue = HtmlEncode($this->firstname->CurrentValue);
            $this->firstname->PlaceHolder = RemoveHtml($this->firstname->caption());

            // lastname
            $this->lastname->setupEditAttributes();
            $this->lastname->EditCustomAttributes = "";
            if (!$this->lastname->Raw) {
                $this->lastname->CurrentValue = HtmlDecode($this->lastname->CurrentValue);
            }
            $this->lastname->EditValue = HtmlEncode($this->lastname->CurrentValue);
            $this->lastname->PlaceHolder = RemoveHtml($this->lastname->caption());

            // userfullname
            $this->userfullname->setupEditAttributes();
            $this->userfullname->EditCustomAttributes = "";
            if (!$this->userfullname->Raw) {
                $this->userfullname->CurrentValue = HtmlDecode($this->userfullname->CurrentValue);
            }
            $this->userfullname->EditValue = HtmlEncode($this->userfullname->CurrentValue);
            $this->userfullname->PlaceHolder = RemoveHtml($this->userfullname->caption());

            // emailaddress
            $this->emailaddress->setupEditAttributes();
            $this->emailaddress->EditCustomAttributes = "";
            if (!$this->emailaddress->Raw) {
                $this->emailaddress->CurrentValue = HtmlDecode($this->emailaddress->CurrentValue);
            }
            $this->emailaddress->EditValue = HtmlEncode($this->emailaddress->CurrentValue);
            $this->emailaddress->PlaceHolder = RemoveHtml($this->emailaddress->caption());

            // empipaddress
            $this->empipaddress->setupEditAttributes();
            $this->empipaddress->EditCustomAttributes = "";
            if (!$this->empipaddress->Raw) {
                $this->empipaddress->CurrentValue = HtmlDecode($this->empipaddress->CurrentValue);
            }
            $this->empipaddress->EditValue = HtmlEncode($this->empipaddress->CurrentValue);
            $this->empipaddress->PlaceHolder = RemoveHtml($this->empipaddress->caption());

            // backgroundchk_status
            $this->backgroundchk_status->EditCustomAttributes = "";
            $this->backgroundchk_status->EditValue = $this->backgroundchk_status->options(false);
            $this->backgroundchk_status->PlaceHolder = RemoveHtml($this->backgroundchk_status->caption());

            // emppassword
            $this->emppassword->setupEditAttributes();
            $this->emppassword->EditCustomAttributes = "";
            if (!$this->emppassword->Raw) {
                $this->emppassword->CurrentValue = HtmlDecode($this->emppassword->CurrentValue);
            }
            $this->emppassword->EditValue = HtmlEncode($this->emppassword->CurrentValue);
            $this->emppassword->PlaceHolder = RemoveHtml($this->emppassword->caption());

            // isactive
            $this->isactive->setupEditAttributes();
            $this->isactive->EditCustomAttributes = "";
            $this->isactive->EditValue = HtmlEncode($this->isactive->CurrentValue);
            $this->isactive->PlaceHolder = RemoveHtml($this->isactive->caption());
            if (strval($this->isactive->EditValue) != "" && is_numeric($this->isactive->EditValue)) {
                $this->isactive->EditValue = FormatNumber($this->isactive->EditValue, null);
            }

            // staff_ID
            $this->staff_ID->setupEditAttributes();
            $this->staff_ID->EditCustomAttributes = "";
            if (!$this->staff_ID->Raw) {
                $this->staff_ID->CurrentValue = HtmlDecode($this->staff_ID->CurrentValue);
            }
            $this->staff_ID->EditValue = HtmlEncode($this->staff_ID->CurrentValue);
            $this->staff_ID->PlaceHolder = RemoveHtml($this->staff_ID->caption());

            // profileimg
            $this->profileimg->setupEditAttributes();
            $this->profileimg->EditCustomAttributes = "";
            if (!EmptyValue($this->profileimg->Upload->DbValue)) {
                $this->profileimg->ImageWidth = 80;
                $this->profileimg->ImageHeight = 80;
                $this->profileimg->ImageAlt = $this->profileimg->alt();
                $this->profileimg->ImageCssClass = "ew-image";
                $this->profileimg->EditValue = $this->profileimg->Upload->DbValue;
            } else {
                $this->profileimg->EditValue = "";
            }
            if (!EmptyValue($this->profileimg->CurrentValue)) {
                $this->profileimg->Upload->FileName = $this->profileimg->CurrentValue;
            }
            if ($this->isShow() || $this->isCopy()) {
                RenderUploadField($this->profileimg);
            }

            // Add refer script

            // emprole
            $this->emprole->LinkCustomAttributes = "";
            $this->emprole->HrefValue = "";

            // firstname
            $this->firstname->LinkCustomAttributes = "";
            $this->firstname->HrefValue = "";

            // lastname
            $this->lastname->LinkCustomAttributes = "";
            $this->lastname->HrefValue = "";

            // userfullname
            $this->userfullname->LinkCustomAttributes = "";
            $this->userfullname->HrefValue = "";

            // emailaddress
            $this->emailaddress->LinkCustomAttributes = "";
            $this->emailaddress->HrefValue = "";

            // empipaddress
            $this->empipaddress->LinkCustomAttributes = "";
            $this->empipaddress->HrefValue = "";

            // backgroundchk_status
            $this->backgroundchk_status->LinkCustomAttributes = "";
            $this->backgroundchk_status->HrefValue = "";

            // emppassword
            $this->emppassword->LinkCustomAttributes = "";
            $this->emppassword->HrefValue = "";

            // isactive
            $this->isactive->LinkCustomAttributes = "";
            $this->isactive->HrefValue = "";

            // staff_ID
            $this->staff_ID->LinkCustomAttributes = "";
            $this->staff_ID->HrefValue = "";

            // profileimg
            $this->profileimg->LinkCustomAttributes = "";
            if (!EmptyValue($this->profileimg->Upload->DbValue)) {
                $this->profileimg->HrefValue = GetFileUploadUrl($this->profileimg, $this->profileimg->htmlDecode($this->profileimg->Upload->DbValue)); // Add prefix/suffix
                $this->profileimg->LinkAttrs["target"] = ""; // Add target
                if ($this->isExport()) {
                    $this->profileimg->HrefValue = FullUrl($this->profileimg->HrefValue, "href");
                }
            } else {
                $this->profileimg->HrefValue = "";
            }
            $this->profileimg->ExportHrefValue = $this->profileimg->UploadPath . $this->profileimg->Upload->DbValue;
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
        if ($this->emprole->Required) {
            if (!$this->emprole->IsDetailKey && EmptyValue($this->emprole->FormValue)) {
                $this->emprole->addErrorMessage(str_replace("%s", $this->emprole->caption(), $this->emprole->RequiredErrorMessage));
            }
        }
        if ($this->firstname->Required) {
            if (!$this->firstname->IsDetailKey && EmptyValue($this->firstname->FormValue)) {
                $this->firstname->addErrorMessage(str_replace("%s", $this->firstname->caption(), $this->firstname->RequiredErrorMessage));
            }
        }
        if ($this->lastname->Required) {
            if (!$this->lastname->IsDetailKey && EmptyValue($this->lastname->FormValue)) {
                $this->lastname->addErrorMessage(str_replace("%s", $this->lastname->caption(), $this->lastname->RequiredErrorMessage));
            }
        }
        if ($this->userfullname->Required) {
            if (!$this->userfullname->IsDetailKey && EmptyValue($this->userfullname->FormValue)) {
                $this->userfullname->addErrorMessage(str_replace("%s", $this->userfullname->caption(), $this->userfullname->RequiredErrorMessage));
            }
        }
        if ($this->emailaddress->Required) {
            if (!$this->emailaddress->IsDetailKey && EmptyValue($this->emailaddress->FormValue)) {
                $this->emailaddress->addErrorMessage(str_replace("%s", $this->emailaddress->caption(), $this->emailaddress->RequiredErrorMessage));
            }
        }
        if (!$this->emailaddress->Raw && Config("REMOVE_XSS") && CheckUsername($this->emailaddress->FormValue)) {
            $this->emailaddress->addErrorMessage($Language->phrase("InvalidUsernameChars"));
        }
        if ($this->empipaddress->Required) {
            if (!$this->empipaddress->IsDetailKey && EmptyValue($this->empipaddress->FormValue)) {
                $this->empipaddress->addErrorMessage(str_replace("%s", $this->empipaddress->caption(), $this->empipaddress->RequiredErrorMessage));
            }
        }
        if ($this->backgroundchk_status->Required) {
            if ($this->backgroundchk_status->FormValue == "") {
                $this->backgroundchk_status->addErrorMessage(str_replace("%s", $this->backgroundchk_status->caption(), $this->backgroundchk_status->RequiredErrorMessage));
            }
        }
        if ($this->emppassword->Required) {
            if (!$this->emppassword->IsDetailKey && EmptyValue($this->emppassword->FormValue)) {
                $this->emppassword->addErrorMessage(str_replace("%s", $this->emppassword->caption(), $this->emppassword->RequiredErrorMessage));
            }
        }
        if (!$this->emppassword->Raw && Config("REMOVE_XSS") && CheckPassword($this->emppassword->FormValue)) {
            $this->emppassword->addErrorMessage($Language->phrase("InvalidPasswordChars"));
        }
        if ($this->isactive->Required) {
            if (!$this->isactive->IsDetailKey && EmptyValue($this->isactive->FormValue)) {
                $this->isactive->addErrorMessage(str_replace("%s", $this->isactive->caption(), $this->isactive->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->isactive->FormValue)) {
            $this->isactive->addErrorMessage($this->isactive->getErrorMessage(false));
        }
        if ($this->staff_ID->Required) {
            if (!$this->staff_ID->IsDetailKey && EmptyValue($this->staff_ID->FormValue)) {
                $this->staff_ID->addErrorMessage(str_replace("%s", $this->staff_ID->caption(), $this->staff_ID->RequiredErrorMessage));
            }
        }
        if ($this->profileimg->Required) {
            if ($this->profileimg->Upload->FileName == "" && !$this->profileimg->Upload->KeepFile) {
                $this->profileimg->addErrorMessage(str_replace("%s", $this->profileimg->caption(), $this->profileimg->RequiredErrorMessage));
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

        // Check if valid User ID
        $validUser = false;
        if ($Security->currentUserID() != "" && !EmptyValue($this->id->CurrentValue) && !$Security->isAdmin()) { // Non system admin
            $validUser = $Security->isValidUserID($this->id->CurrentValue);
            if (!$validUser) {
                $userIdMsg = str_replace("%c", CurrentUserID(), $Language->phrase("UnAuthorizedUserID"));
                $userIdMsg = str_replace("%u", $this->id->CurrentValue, $userIdMsg);
                $this->setFailureMessage($userIdMsg);
                return false;
            }
        }
        $conn = $this->getConnection();

        // Load db values from rsold
        $this->loadDbValues($rsold);
        if ($rsold) {
        }
        $rsnew = [];

        // emprole
        if ($Security->canAdmin()) { // System admin
            $this->emprole->setDbValueDef($rsnew, $this->emprole->CurrentValue, null, false);
        }

        // firstname
        $this->firstname->setDbValueDef($rsnew, $this->firstname->CurrentValue, null, false);

        // lastname
        $this->lastname->setDbValueDef($rsnew, $this->lastname->CurrentValue, null, false);

        // userfullname
        $this->userfullname->setDbValueDef($rsnew, $this->userfullname->CurrentValue, null, false);

        // emailaddress
        $this->emailaddress->setDbValueDef($rsnew, $this->emailaddress->CurrentValue, null, false);

        // empipaddress
        $this->empipaddress->setDbValueDef($rsnew, $this->empipaddress->CurrentValue, null, false);

        // backgroundchk_status
        $this->backgroundchk_status->setDbValueDef($rsnew, $this->backgroundchk_status->CurrentValue, null, strval($this->backgroundchk_status->CurrentValue) == "");

        // emppassword
        $this->emppassword->setDbValueDef($rsnew, $this->emppassword->CurrentValue, null, false);

        // isactive
        $this->isactive->setDbValueDef($rsnew, $this->isactive->CurrentValue, null, strval($this->isactive->CurrentValue) == "");

        // staff_ID
        $this->staff_ID->setDbValueDef($rsnew, $this->staff_ID->CurrentValue, null, false);

        // profileimg
        if ($this->profileimg->Visible && !$this->profileimg->Upload->KeepFile) {
            $this->profileimg->Upload->DbValue = ""; // No need to delete old file
            if ($this->profileimg->Upload->FileName == "") {
                $rsnew['profileimg'] = null;
            } else {
                $rsnew['profileimg'] = $this->profileimg->Upload->FileName;
            }
        }

        // id
        if ($this->profileimg->Visible && !$this->profileimg->Upload->KeepFile) {
            $oldFiles = EmptyValue($this->profileimg->Upload->DbValue) ? [] : [$this->profileimg->htmlDecode($this->profileimg->Upload->DbValue)];
            if (!EmptyValue($this->profileimg->Upload->FileName)) {
                $newFiles = [$this->profileimg->Upload->FileName];
                $NewFileCount = count($newFiles);
                for ($i = 0; $i < $NewFileCount; $i++) {
                    if ($newFiles[$i] != "") {
                        $file = $newFiles[$i];
                        $tempPath = UploadTempPath($this->profileimg, $this->profileimg->Upload->Index);
                        if (file_exists($tempPath . $file)) {
                            if (Config("DELETE_UPLOADED_FILES")) {
                                $oldFileFound = false;
                                $oldFileCount = count($oldFiles);
                                for ($j = 0; $j < $oldFileCount; $j++) {
                                    $oldFile = $oldFiles[$j];
                                    if ($oldFile == $file) { // Old file found, no need to delete anymore
                                        array_splice($oldFiles, $j, 1);
                                        $oldFileFound = true;
                                        break;
                                    }
                                }
                                if ($oldFileFound) { // No need to check if file exists further
                                    continue;
                                }
                            }
                            $file1 = UniqueFilename($this->profileimg->physicalUploadPath(), $file); // Get new file name
                            if ($file1 != $file) { // Rename temp file
                                while (file_exists($tempPath . $file1) || file_exists($this->profileimg->physicalUploadPath() . $file1)) { // Make sure no file name clash
                                    $file1 = UniqueFilename([$this->profileimg->physicalUploadPath(), $tempPath], $file1, true); // Use indexed name
                                }
                                rename($tempPath . $file, $tempPath . $file1);
                                $newFiles[$i] = $file1;
                            }
                        }
                    }
                }
                $this->profileimg->Upload->DbValue = empty($oldFiles) ? "" : implode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $oldFiles);
                $this->profileimg->Upload->FileName = implode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $newFiles);
                $this->profileimg->setDbValueDef($rsnew, $this->profileimg->Upload->FileName, null, false);
            }
        }

        // Call Row Inserting event
        $insertRow = $this->rowInserting($rsold, $rsnew);
        if ($insertRow) {
            $addRow = $this->insert($rsnew);
            if ($addRow) {
                if ($this->profileimg->Visible && !$this->profileimg->Upload->KeepFile) {
                    $oldFiles = EmptyValue($this->profileimg->Upload->DbValue) ? [] : [$this->profileimg->htmlDecode($this->profileimg->Upload->DbValue)];
                    if (!EmptyValue($this->profileimg->Upload->FileName)) {
                        $newFiles = [$this->profileimg->Upload->FileName];
                        $newFiles2 = [$this->profileimg->htmlDecode($rsnew['profileimg'])];
                        $newFileCount = count($newFiles);
                        for ($i = 0; $i < $newFileCount; $i++) {
                            if ($newFiles[$i] != "") {
                                $file = UploadTempPath($this->profileimg, $this->profileimg->Upload->Index) . $newFiles[$i];
                                if (file_exists($file)) {
                                    if (@$newFiles2[$i] != "") { // Use correct file name
                                        $newFiles[$i] = $newFiles2[$i];
                                    }
                                    if (!$this->profileimg->Upload->SaveToFile($newFiles[$i], true, $i)) { // Just replace
                                        $this->setFailureMessage($Language->phrase("UploadErrMsg7"));
                                        return false;
                                    }
                                }
                            }
                        }
                    } else {
                        $newFiles = [];
                    }
                    if (Config("DELETE_UPLOADED_FILES")) {
                        foreach ($oldFiles as $oldFile) {
                            if ($oldFile != "" && !in_array($oldFile, $newFiles)) {
                                @unlink($this->profileimg->oldPhysicalUploadPath() . $oldFile);
                            }
                        }
                    }
                }
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
            // profileimg
            CleanUploadTempPath($this->profileimg, $this->profileimg->Upload->Index);
        }

        // Write JSON for API request
        if (IsApi() && $addRow) {
            $row = $this->getRecordsFromRecordset([$rsnew], true);
            WriteJson(["success" => true, $this->TableVar => $row]);
        }
        return $addRow;
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
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("mainuserslist"), "", $this->TableVar, true);
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
