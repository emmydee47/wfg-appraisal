<?php

namespace PHPMaker2022\wfg_appraisal;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Page class
 */
class MainUsersDelete extends MainUsers
{
    use MessagesTrait;

    // Page ID
    public $PageID = "delete";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'main_users';

    // Page object name
    public $PageObjName = "MainUsersDelete";

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
    public $DbMasterFilter = "";
    public $DbDetailFilter = "";
    public $StartRecord;
    public $TotalRecords = 0;
    public $RecordCount;
    public $RecKeys = [];
    public $StartRowCount = 1;
    public $RowCount = 0;

    /**
     * Page run
     *
     * @return void
     */
    public function run()
    {
        global $ExportType, $CustomExportType, $ExportFileName, $UserProfile, $Language, $Security, $CurrentForm;

        // Use layout
        $this->UseLayout = $this->UseLayout && ConvertToBool(Param("layout", true));
        $this->CurrentAction = Param("action"); // Set up current action
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

        // Set up Breadcrumb
        $this->setupBreadcrumb();

        // Load key parameters
        $this->RecKeys = $this->getRecordKeys(); // Load record keys
        $filter = $this->getFilterFromRecordKeys();
        if ($filter == "") {
            $this->terminate("mainuserslist"); // Prevent SQL injection, return to list
            return;
        }

        // Set up filter (WHERE Clause)
        $this->CurrentFilter = $filter;

        // Check if valid User ID
        $conn = $this->getConnection();
        $sql = $this->getSql($this->CurrentFilter);
        $rows = $conn->fetchAllAssociative($sql);
        $res = true;
        foreach ($rows as $row) {
            $this->loadRowValues($row);
            if (!$this->showOptionLink("delete")) {
                $userIdMsg = $Language->phrase("NoDeletePermission");
                $this->setFailureMessage($userIdMsg);
                $res = false;
                break;
            }
        }
        if (!$res) {
            $this->terminate("mainuserslist"); // Return to list
            return;
        }

        // Get action
        if (IsApi()) {
            $this->CurrentAction = "delete"; // Delete record directly
        } elseif (Post("action") !== null) {
            $this->CurrentAction = Post("action");
        } elseif (Get("action") == "1") {
            $this->CurrentAction = "delete"; // Delete record directly
        } else {
            $this->CurrentAction = "show"; // Display record
        }
        if ($this->isDelete()) {
            $this->SendEmail = true; // Send email on delete success
            if ($this->deleteRows()) { // Delete rows
                if ($this->getSuccessMessage() == "") {
                    $this->setSuccessMessage($Language->phrase("DeleteSuccess")); // Set up success message
                }
                if (IsApi()) {
                    $this->terminate(true);
                    return;
                } else {
                    $this->terminate($this->getReturnUrl()); // Return to caller
                    return;
                }
            } else { // Delete failed
                if (IsApi()) {
                    $this->terminate();
                    return;
                }
                $this->CurrentAction = "show"; // Display record
            }
        }
        if ($this->isShow()) { // Load records for display
            if ($this->Recordset = $this->loadRecordset()) {
                $this->TotalRecords = $this->Recordset->recordCount(); // Get record count
            }
            if ($this->TotalRecords <= 0) { // No record found, exit
                if ($this->Recordset) {
                    $this->Recordset->close();
                }
                $this->terminate("mainuserslist"); // Return to list
                return;
            }
        }

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

    // Render row values based on field settings
    public function renderRow()
    {
        global $Security, $Language, $CurrentLanguage;

        // Initialize URLs

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

    // Delete records based on current filter
    protected function deleteRows()
    {
        global $Language, $Security;
        if (!$Security->canDelete()) {
            $this->setFailureMessage($Language->phrase("NoDeletePermission")); // No delete permission
            return false;
        }
        $sql = $this->getCurrentSql();
        $conn = $this->getConnection();
        $rows = $conn->fetchAllAssociative($sql);
        if (count($rows) == 0) {
            $this->setFailureMessage($Language->phrase("NoRecord")); // No record found
            return false;
        }
        if ($this->UseTransaction) {
            $conn->beginTransaction();
        }

        // Clone old rows
        $rsold = $rows;
        $successKeys = [];
        $failKeys = [];
        foreach ($rsold as $row) {
            $thisKey = "";
            if ($thisKey != "") {
                $thisKey .= Config("COMPOSITE_KEY_SEPARATOR");
            }
            $thisKey .= $row['id'];

            // Call row deleting event
            $deleteRow = $this->rowDeleting($row);
            if ($deleteRow) { // Delete
                $deleteRow = $this->delete($row);
            }
            if ($deleteRow === false) {
                if ($this->UseTransaction) {
                    $successKeys = []; // Reset success keys
                    break;
                }
                $failKeys[] = $thisKey;
            } else {
                if (Config("DELETE_UPLOADED_FILES")) { // Delete old files
                    $this->deleteUploadedFiles($row);
                }

                // Call Row Deleted event
                $this->rowDeleted($row);
                $successKeys[] = $thisKey;
            }
        }

        // Any records deleted
        $deleteRows = count($successKeys) > 0;
        if (!$deleteRows) {
            // Set up error message
            if ($this->getSuccessMessage() != "" || $this->getFailureMessage() != "") {
                // Use the message, do nothing
            } elseif ($this->CancelMessage != "") {
                $this->setFailureMessage($this->CancelMessage);
                $this->CancelMessage = "";
            } else {
                $this->setFailureMessage($Language->phrase("DeleteCancelled"));
            }
        }
        if ($deleteRows) {
            if ($this->UseTransaction) { // Commit transaction
                $conn->commit();
            }

            // Set warning message if delete some records failed
            if (count($failKeys) > 0) {
                $this->setWarningMessage(str_replace("%k", explode(", ", $failKeys), $Language->phrase("DeleteSomeRecordsFailed")));
            }
        } else {
            if ($this->UseTransaction) { // Rollback transaction
                $conn->rollback();
            }
        }

        // Write JSON for API request
        if (IsApi() && $deleteRows) {
            $row = $this->getRecordsFromRecordset($rsold);
            WriteJson(["success" => true, $this->TableVar => $row]);
        }
        return $deleteRows;
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
        $pageId = "delete";
        $Breadcrumb->add("delete", $pageId, $url);
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
}
