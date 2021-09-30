<?php

namespace PHPMaker2022\wfg_appraisal;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Table class for pending_l2_appraisal
 */
class PendingL2Appraisal extends DbTable
{
    protected $SqlFrom = "";
    protected $SqlSelect = null;
    protected $SqlSelectList = null;
    protected $SqlWhere = "";
    protected $SqlGroupBy = "";
    protected $SqlHaving = "";
    protected $SqlOrderBy = "";
    public $UseSessionForListSql = true;

    // Column CSS classes
    public $LeftColumnClass = "col-sm-2 col-form-label ew-label";
    public $RightColumnClass = "col-sm-10";
    public $OffsetColumnClass = "col-sm-10 offset-sm-2";
    public $TableLeftColumnClass = "w-col-2";

    // Export
    public $ExportDoc;

    // Fields
    public $group_id;
    public $employee_id;
    public $appraisal_id;
    public $consolidated_rating;
    public $appraisal_status;
    public $createddate;
    public $line_manager;
    public $level;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage, $CurrentLocale;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'pending_l2_appraisal';
        $this->TableName = 'pending_l2_appraisal';
        $this->TableType = 'VIEW';

        // Update Table
        $this->UpdateTable = "`pending_l2_appraisal`";
        $this->Dbid = 'DB';
        $this->ExportAll = true;
        $this->ExportPageBreakCount = 0; // Page break per every n record (PDF only)
        $this->ExportPageOrientation = "portrait"; // Page orientation (PDF only)
        $this->ExportPageSize = "a4"; // Page size (PDF only)
        $this->ExportExcelPageOrientation = ""; // Page orientation (PhpSpreadsheet only)
        $this->ExportExcelPageSize = ""; // Page size (PhpSpreadsheet only)
        $this->ExportWordVersion = 12; // Word version (PHPWord only)
        $this->ExportWordPageOrientation = "portrait"; // Page orientation (PHPWord only)
        $this->ExportWordPageSize = "A4"; // Page orientation (PHPWord only)
        $this->ExportWordColumnWidth = null; // Cell width (PHPWord only)
        $this->DetailAdd = false; // Allow detail add
        $this->DetailEdit = false; // Allow detail edit
        $this->DetailView = false; // Allow detail view
        $this->ShowMultipleDetails = false; // Show multiple details
        $this->GridAddRowCount = 5;
        $this->AllowAddDeleteRow = true; // Allow add/delete row
        $this->UserIDAllowSecurity = Config("DEFAULT_USER_ID_ALLOW_SECURITY"); // Default User ID allowed permissions
        $this->BasicSearch = new BasicSearch($this->TableVar);

        // group_id
        $this->group_id = new DbField(
            'pending_l2_appraisal',
            'pending_l2_appraisal',
            'x_group_id',
            'group_id',
            '`group_id`',
            '`group_id`',
            3,
            15,
            -1,
            false,
            '`group_id`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'SELECT'
        );
        $this->group_id->InputTextType = "text";
        $this->group_id->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->group_id->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        $this->group_id->Lookup = new Lookup('group_id', 'main_pa_groups', false, 'id', ["group_name","","",""], [], [], [], [], [], [], '', '', "`group_name`");
        $this->group_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['group_id'] = &$this->group_id;

        // employee_id
        $this->employee_id = new DbField(
            'pending_l2_appraisal',
            'pending_l2_appraisal',
            'x_employee_id',
            'employee_id',
            '`employee_id`',
            '`employee_id`',
            21,
            20,
            -1,
            false,
            '`employee_id`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'SELECT'
        );
        $this->employee_id->InputTextType = "text";
        $this->employee_id->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->employee_id->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        $this->employee_id->Lookup = new Lookup('employee_id', 'main_users', false, 'id', ["firstname","lastname","",""], [], [], [], [], [], [], '', '', "CONCAT(COALESCE(`firstname`, ''),'" . ValueSeparator(1, $this->employee_id) . "',COALESCE(`lastname`,''))");
        $this->employee_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['employee_id'] = &$this->employee_id;

        // appraisal_id
        $this->appraisal_id = new DbField(
            'pending_l2_appraisal',
            'pending_l2_appraisal',
            'x_appraisal_id',
            'appraisal_id',
            '`appraisal_id`',
            '`appraisal_id`',
            21,
            20,
            -1,
            false,
            '`appraisal_id`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'SELECT'
        );
        $this->appraisal_id->InputTextType = "text";
        $this->appraisal_id->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->appraisal_id->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        $this->appraisal_id->Lookup = new Lookup('appraisal_id', 'main_pa_initialization', false, 'id', ["business_unit","group_id","appraisal_mode","from_year"], [], [], [], [], [], [], '', '', "CONCAT(COALESCE(`business_unit`, ''),'" . ValueSeparator(1, $this->appraisal_id) . "',COALESCE(`group_id`,''),'" . ValueSeparator(2, $this->appraisal_id) . "',COALESCE(`appraisal_mode`,''),'" . ValueSeparator(3, $this->appraisal_id) . "',COALESCE(`from_year`,''))");
        $this->appraisal_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['appraisal_id'] = &$this->appraisal_id;

        // consolidated_rating
        $this->consolidated_rating = new DbField(
            'pending_l2_appraisal',
            'pending_l2_appraisal',
            'x_consolidated_rating',
            'consolidated_rating',
            '`consolidated_rating`',
            '`consolidated_rating`',
            4,
            10,
            -1,
            false,
            '`consolidated_rating`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->consolidated_rating->InputTextType = "text";
        $this->consolidated_rating->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->Fields['consolidated_rating'] = &$this->consolidated_rating;

        // appraisal_status
        $this->appraisal_status = new DbField(
            'pending_l2_appraisal',
            'pending_l2_appraisal',
            'x_appraisal_status',
            'appraisal_status',
            '`appraisal_status`',
            '`appraisal_status`',
            202,
            24,
            -1,
            false,
            '`appraisal_status`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'RADIO'
        );
        $this->appraisal_status->InputTextType = "text";
        $this->appraisal_status->Lookup = new Lookup('appraisal_status', 'pending_l2_appraisal', false, '', ["","","",""], [], [], [], [], [], [], '', '', "");
        $this->appraisal_status->OptionCount = 7;
        $this->Fields['appraisal_status'] = &$this->appraisal_status;

        // createddate
        $this->createddate = new DbField(
            'pending_l2_appraisal',
            'pending_l2_appraisal',
            'x_createddate',
            'createddate',
            '`createddate`',
            CastDateFieldForLike("`createddate`", 0, "DB"),
            135,
            19,
            0,
            false,
            '`createddate`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->createddate->InputTextType = "text";
        $this->createddate->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->Fields['createddate'] = &$this->createddate;

        // line_manager
        $this->line_manager = new DbField(
            'pending_l2_appraisal',
            'pending_l2_appraisal',
            'x_line_manager',
            'line_manager',
            '`line_manager`',
            '`line_manager`',
            3,
            15,
            -1,
            false,
            '`line_manager`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'SELECT'
        );
        $this->line_manager->InputTextType = "text";
        $this->line_manager->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->line_manager->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        $this->line_manager->Lookup = new Lookup('line_manager', 'main_users', false, 'id', ["firstname","lastname","",""], [], [], [], [], [], [], '', '', "CONCAT(COALESCE(`firstname`, ''),'" . ValueSeparator(1, $this->line_manager) . "',COALESCE(`lastname`,''))");
        $this->line_manager->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['line_manager'] = &$this->line_manager;

        // level
        $this->level = new DbField(
            'pending_l2_appraisal',
            'pending_l2_appraisal',
            'x_level',
            'level',
            '`level`',
            '`level`',
            16,
            4,
            -1,
            false,
            '`level`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'SELECT'
        );
        $this->level->InputTextType = "text";
        $this->level->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->level->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        $this->level->Lookup = new Lookup('level', 'pending_l2_appraisal', false, '', ["","","",""], [], [], [], [], [], [], '', '', "");
        $this->level->OptionCount = 2;
        $this->level->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['level'] = &$this->level;

        // Add Doctrine Cache
        $this->Cache = new ArrayCache();
        $this->CacheProfile = new \Doctrine\DBAL\Cache\QueryCacheProfile(0, $this->TableVar);
    }

    // Field Visibility
    public function getFieldVisibility($fldParm)
    {
        global $Security;
        return $this->$fldParm->Visible; // Returns original value
    }

    // Set left column class (must be predefined col-*-* classes of Bootstrap grid system)
    public function setLeftColumnClass($class)
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
            if (in_array($this->CurrentOrderType, ["ASC", "DESC", "NO"])) {
                $curSort = $this->CurrentOrderType;
            } else {
                $curSort = $lastSort;
            }
            $fld->setSort($curSort);
            $orderBy = in_array($curSort, ["ASC", "DESC"]) ? $sortField . " " . $curSort : "";
            $this->setSessionOrderBy($orderBy); // Save to Session
        } else {
            $fld->setSort("");
        }
    }

    // Table level SQL
    public function getSqlFrom() // From
    {
        return ($this->SqlFrom != "") ? $this->SqlFrom : "`pending_l2_appraisal`";
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
        return $this->SqlSelect ?? $this->getQueryBuilder()->select("*");
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
        $this->DefaultFilter = "line_manager=".CurrentUserId();
        AddFilter($where, $this->DefaultFilter);
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
        return ($this->SqlOrderBy != "") ? $this->SqlOrderBy : $this->DefaultSort;
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
    public function applyUserIDFilters($filter)
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
            case "changepassword":
            case "resetpassword":
                return (($allow & 4) == 4);
            case "delete":
                return (($allow & 2) == 2);
            case "view":
                return (($allow & 32) == 32);
            case "search":
                return (($allow & 64) == 64);
            default:
                return (($allow & 8) == 8);
        }
    }

    /**
     * Get record count
     *
     * @param string|QueryBuilder $sql SQL or QueryBuilder
     * @param mixed $c Connection
     * @return int
     */
    public function getRecordCount($sql, $c = null)
    {
        $cnt = -1;
        $rs = null;
        if ($sql instanceof QueryBuilder) { // Query builder
            $sqlwrk = clone $sql;
            $sqlwrk = $sqlwrk->resetQueryPart("orderBy")->getSQL();
        } else {
            $sqlwrk = $sql;
        }
        $pattern = '/^SELECT\s([\s\S]+)\sFROM\s/i';
        // Skip Custom View / SubQuery / SELECT DISTINCT / ORDER BY
        if (
            ($this->TableType == 'TABLE' || $this->TableType == 'VIEW' || $this->TableType == 'LINKTABLE') &&
            preg_match($pattern, $sqlwrk) && !preg_match('/\(\s*(SELECT[^)]+)\)/i', $sqlwrk) &&
            !preg_match('/^\s*select\s+distinct\s+/i', $sqlwrk) && !preg_match('/\s+order\s+by\s+/i', $sqlwrk)
        ) {
            $sqlwrk = "SELECT COUNT(*) FROM " . preg_replace($pattern, "", $sqlwrk);
        } else {
            $sqlwrk = "SELECT COUNT(*) FROM (" . $sqlwrk . ") COUNT_TABLE";
        }
        $conn = $c ?? $this->getConnection();
        $cnt = $conn->fetchOne($sqlwrk);
        if ($cnt !== false) {
            return (int)$cnt;
        }

        // Unable to get count by SELECT COUNT(*), execute the SQL to get record count directly
        return ExecuteRecordCount($sql, $conn);
    }

    // Get SQL
    public function getSql($where, $orderBy = "")
    {
        return $this->buildSelectSql(
            $this->getSqlSelect(),
            $this->getSqlFrom(),
            $this->getSqlWhere(),
            $this->getSqlGroupBy(),
            $this->getSqlHaving(),
            $this->getSqlOrderBy(),
            $where,
            $orderBy
        )->getSQL();
    }

    // Table SQL
    public function getCurrentSql()
    {
        $filter = $this->CurrentFilter;
        $filter = $this->applyUserIDFilters($filter);
        $sort = $this->getSessionOrderBy();
        return $this->getSql($filter, $sort);
    }

    /**
     * Table SQL with List page filter
     *
     * @return QueryBuilder
     */
    public function getListSql()
    {
        $filter = $this->UseSessionForListSql ? $this->getSessionWhere() : "";
        AddFilter($filter, $this->CurrentFilter);
        $filter = $this->applyUserIDFilters($filter);
        $this->recordsetSelecting($filter);
        $select = $this->getSqlSelect();
        $from = $this->getSqlFrom();
        $sort = $this->UseSessionForListSql ? $this->getSessionOrderBy() : "";
        $this->Sort = $sort;
        return $this->buildSelectSql(
            $select,
            $from,
            $this->getSqlWhere(),
            $this->getSqlGroupBy(),
            $this->getSqlHaving(),
            $this->getSqlOrderBy(),
            $filter,
            $sort
        );
    }

    // Get ORDER BY clause
    public function getOrderBy()
    {
        $orderBy = $this->getSqlOrderBy();
        $sort = $this->getSessionOrderBy();
        if ($orderBy != "" && $sort != "") {
            $orderBy .= ", " . $sort;
        } elseif ($sort != "") {
            $orderBy = $sort;
        }
        return $orderBy;
    }

    // Get record count based on filter (for detail record count in master table pages)
    public function loadRecordCount($filter)
    {
        $origFilter = $this->CurrentFilter;
        $this->CurrentFilter = $filter;
        $this->recordsetSelecting($this->CurrentFilter);
        $select = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlSelect() : $this->getQueryBuilder()->select("*");
        $groupBy = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlGroupBy() : "";
        $having = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlHaving() : "";
        $sql = $this->buildSelectSql($select, $this->getSqlFrom(), $this->getSqlWhere(), $groupBy, $having, "", $this->CurrentFilter, "");
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
        $this->recordsetSelecting($filter);
        $select = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlSelect() : $this->getQueryBuilder()->select("*");
        $groupBy = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlGroupBy() : "";
        $having = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlHaving() : "";
        $sql = $this->buildSelectSql($select, $this->getSqlFrom(), $this->getSqlWhere(), $groupBy, $having, "", $filter, "");
        $cnt = $this->getRecordCount($sql);
        return $cnt;
    }

    /**
     * INSERT statement
     *
     * @param mixed $rs
     * @return QueryBuilder
     */
    public function insertSql(&$rs)
    {
        $queryBuilder = $this->getQueryBuilder();
        $queryBuilder->insert($this->UpdateTable);
        foreach ($rs as $name => $value) {
            if (!isset($this->Fields[$name]) || $this->Fields[$name]->IsCustom) {
                continue;
            }
            $type = GetParameterType($this->Fields[$name], $value, $this->Dbid);
            $queryBuilder->setValue($this->Fields[$name]->Expression, $queryBuilder->createPositionalParameter($value, $type));
        }
        return $queryBuilder;
    }

    // Insert
    public function insert(&$rs)
    {
        $conn = $this->getConnection();
        $success = $this->insertSql($rs)->execute();
        if ($success) {
        }
        return $success;
    }

    /**
     * UPDATE statement
     *
     * @param array $rs Data to be updated
     * @param string|array $where WHERE clause
     * @param string $curfilter Filter
     * @return QueryBuilder
     */
    public function updateSql(&$rs, $where = "", $curfilter = true)
    {
        $queryBuilder = $this->getQueryBuilder();
        $queryBuilder->update($this->UpdateTable);
        foreach ($rs as $name => $value) {
            if (!isset($this->Fields[$name]) || $this->Fields[$name]->IsCustom || $this->Fields[$name]->IsAutoIncrement) {
                continue;
            }
            $type = GetParameterType($this->Fields[$name], $value, $this->Dbid);
            $queryBuilder->set($this->Fields[$name]->Expression, $queryBuilder->createPositionalParameter($value, $type));
        }
        $filter = ($curfilter) ? $this->CurrentFilter : "";
        if (is_array($where)) {
            $where = $this->arrayToFilter($where);
        }
        AddFilter($filter, $where);
        if ($filter != "") {
            $queryBuilder->where($filter);
        }
        return $queryBuilder;
    }

    // Update
    public function update(&$rs, $where = "", $rsold = null, $curfilter = true)
    {
        // If no field is updated, execute may return 0. Treat as success
        $success = $this->updateSql($rs, $where, $curfilter)->execute();
        $success = ($success > 0) ? $success : true;
        return $success;
    }

    /**
     * DELETE statement
     *
     * @param array $rs Key values
     * @param string|array $where WHERE clause
     * @param string $curfilter Filter
     * @return QueryBuilder
     */
    public function deleteSql(&$rs, $where = "", $curfilter = true)
    {
        $queryBuilder = $this->getQueryBuilder();
        $queryBuilder->delete($this->UpdateTable);
        if (is_array($where)) {
            $where = $this->arrayToFilter($where);
        }
        if ($rs) {
        }
        $filter = ($curfilter) ? $this->CurrentFilter : "";
        AddFilter($filter, $where);
        return $queryBuilder->where($filter != "" ? $filter : "0=1");
    }

    // Delete
    public function delete(&$rs, $where = "", $curfilter = false)
    {
        $success = true;
        if ($success) {
            $success = $this->deleteSql($rs, $where, $curfilter)->execute();
        }
        return $success;
    }

    // Load DbValue from recordset or array
    protected function loadDbValues($row)
    {
        if (!is_array($row)) {
            return;
        }
        $this->group_id->DbValue = $row['group_id'];
        $this->employee_id->DbValue = $row['employee_id'];
        $this->appraisal_id->DbValue = $row['appraisal_id'];
        $this->consolidated_rating->DbValue = $row['consolidated_rating'];
        $this->appraisal_status->DbValue = $row['appraisal_status'];
        $this->createddate->DbValue = $row['createddate'];
        $this->line_manager->DbValue = $row['line_manager'];
        $this->level->DbValue = $row['level'];
    }

    // Delete uploaded files
    public function deleteUploadedFiles($row)
    {
        $this->loadDbValues($row);
    }

    // Record filter WHERE clause
    protected function sqlKeyFilter()
    {
        return "";
    }

    // Get Key
    public function getKey($current = false)
    {
        $keys = [];
        return implode(Config("COMPOSITE_KEY_SEPARATOR"), $keys);
    }

    // Set Key
    public function setKey($key, $current = false)
    {
        $this->OldKey = strval($key);
        $keys = explode(Config("COMPOSITE_KEY_SEPARATOR"), $this->OldKey);
        if (count($keys) == 0) {
        }
    }

    // Get record filter
    public function getRecordFilter($row = null)
    {
        $keyFilter = $this->sqlKeyFilter();
        return $keyFilter;
    }

    // Return page URL
    public function getReturnUrl()
    {
        $referUrl = ReferUrl();
        $referPageName = ReferPageName();
        $name = PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_RETURN_URL");
        // Get referer URL automatically
        if ($referUrl != "" && $referPageName != CurrentPageName() && $referPageName != "login") { // Referer not same page or login page
            $_SESSION[$name] = $referUrl; // Save to Session
        }
        return $_SESSION[$name] ?? GetUrl("pendingl2appraisallist");
    }

    // Set return page URL
    public function setReturnUrl($v)
    {
        $_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_RETURN_URL")] = $v;
    }

    // Get modal caption
    public function getModalCaption($pageName)
    {
        global $Language;
        if ($pageName == "pendingl2appraisalview") {
            return $Language->phrase("View");
        } elseif ($pageName == "pendingl2appraisaledit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "pendingl2appraisaladd") {
            return $Language->phrase("Add");
        } else {
            return "";
        }
    }

    // API page name
    public function getApiPageName($action)
    {
        switch (strtolower($action)) {
            case Config("API_VIEW_ACTION"):
                return "PendingL2AppraisalView";
            case Config("API_ADD_ACTION"):
                return "PendingL2AppraisalAdd";
            case Config("API_EDIT_ACTION"):
                return "PendingL2AppraisalEdit";
            case Config("API_DELETE_ACTION"):
                return "PendingL2AppraisalDelete";
            case Config("API_LIST_ACTION"):
                return "PendingL2AppraisalList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "pendingl2appraisallist";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("pendingl2appraisalview", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("pendingl2appraisalview", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "pendingl2appraisaladd?" . $this->getUrlParm($parm);
        } else {
            $url = "pendingl2appraisaladd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("pendingl2appraisaledit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("pendingl2appraisaladd", $this->getUrlParm($parm));
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
        return $this->keyUrl("pendingl2appraisaldelete", $this->getUrlParm());
    }

    // Add master url
    public function addMasterUrl($url)
    {
        return $url;
    }

    public function keyToJson($htmlEncode = false)
    {
        $json = "";
        $json = "{" . $json . "}";
        if ($htmlEncode) {
            $json = HtmlEncode($json);
        }
        return $json;
    }

    // Add key value to URL
    public function keyUrl($url, $parm = "")
    {
        if ($parm != "") {
            $url .= "?" . $parm;
        }
        return $url;
    }

    // Render sort
    public function renderFieldHeader($fld)
    {
        global $Security, $Language;
        $sortUrl = "";
        $attrs = "";
        if ($fld->Sortable) {
            $sortUrl = $this->sortUrl($fld);
            $attrs = ' role="button" data-sort-url="' . $sortUrl . '" data-sort-type="1"';
        }
        $html = '<div class="ew-table-header-caption"' . $attrs . '>' . $fld->caption() . '</div>';
        if ($sortUrl) {
            $html .= '<div class="ew-table-header-sort">' . $fld->getSortIcon() . '</div>';
        }
        if ($fld->UseFilter && $Security->canSearch()) {
            $html .= '<div class="ew-filter-dropdown-btn" data-ew-action="filter" data-table="' . $fld->TableVar . '" data-field="' . $fld->FieldVar .
                '"><div class="ew-table-header-filter" role="button" aria-haspopup="true">' . $Language->phrase("Filter") . '</div></div>';
        }
        $html = '<div class="ew-table-header-btn">' . $html . '</div>';
        if ($this->UseCustomTemplate) {
            $scriptId = str_replace("{id}", $fld->TableVar . "_" . $fld->Param, "tpc_{id}");
            $html = '<template id="' . $scriptId . '">' . $html . '</template>';
        }
        return $html;
    }

    // Sort URL
    public function sortUrl($fld)
    {
        if (
            $this->CurrentAction || $this->isExport() ||
            in_array($fld->Type, [128, 204, 205])
        ) { // Unsortable data type
                return "";
        } elseif ($fld->Sortable) {
            $urlParm = $this->getUrlParm("order=" . urlencode($fld->Name) . "&amp;ordertype=" . $fld->getNextSort());
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
        if (Param("key_m") !== null) {
            $arKeys = Param("key_m");
            $cnt = count($arKeys);
        } else {
            //return $arKeys; // Do not return yet, so the values will also be checked by the following code
        }
        // Check keys
        $ar = [];
        if (is_array($arKeys)) {
            foreach ($arKeys as $key) {
                $ar[] = $key;
            }
        }
        return $ar;
    }

    // Get filter from record keys
    public function getFilterFromRecordKeys($setCurrent = true)
    {
        $arKeys = $this->getRecordKeys();
        $keyFilter = "";
        foreach ($arKeys as $key) {
            if ($keyFilter != "") {
                $keyFilter .= " OR ";
            }
            $keyFilter .= "(" . $this->getRecordFilter() . ")";
        }
        return $keyFilter;
    }

    // Load recordset based on filter
    public function loadRs($filter)
    {
        $sql = $this->getSql($filter); // Set up filter (WHERE Clause)
        $conn = $this->getConnection();
        return $conn->executeQuery($sql);
    }

    // Load row values from record
    public function loadListRowValues(&$rs)
    {
        if (is_array($rs)) {
            $row = $rs;
        } elseif ($rs && property_exists($rs, "fields")) { // Recordset
            $row = $rs->fields;
        } else {
            return;
        }
        $this->group_id->setDbValue($row['group_id']);
        $this->employee_id->setDbValue($row['employee_id']);
        $this->appraisal_id->setDbValue($row['appraisal_id']);
        $this->consolidated_rating->setDbValue($row['consolidated_rating']);
        $this->appraisal_status->setDbValue($row['appraisal_status']);
        $this->createddate->setDbValue($row['createddate']);
        $this->line_manager->setDbValue($row['line_manager']);
        $this->level->setDbValue($row['level']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // group_id

        // employee_id

        // appraisal_id

        // consolidated_rating

        // appraisal_status

        // createddate

        // line_manager

        // level

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

        // employee_id
        $curVal = strval($this->employee_id->CurrentValue);
        if ($curVal != "") {
            $this->employee_id->ViewValue = $this->employee_id->lookupCacheOption($curVal);
            if ($this->employee_id->ViewValue === null) { // Lookup from database
                $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                $sqlWrk = $this->employee_id->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                $conn = Conn();
                $config = $conn->getConfiguration();
                $config->setResultCacheImpl($this->Cache);
                $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->employee_id->Lookup->renderViewRow($rswrk[0]);
                    $this->employee_id->ViewValue = $this->employee_id->displayValue($arwrk);
                } else {
                    $this->employee_id->ViewValue = $this->employee_id->CurrentValue;
                }
            }
        } else {
            $this->employee_id->ViewValue = null;
        }
        $this->employee_id->ViewCustomAttributes = "";

        // appraisal_id
        $curVal = strval($this->appraisal_id->CurrentValue);
        if ($curVal != "") {
            $this->appraisal_id->ViewValue = $this->appraisal_id->lookupCacheOption($curVal);
            if ($this->appraisal_id->ViewValue === null) { // Lookup from database
                $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                $sqlWrk = $this->appraisal_id->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                $conn = Conn();
                $config = $conn->getConfiguration();
                $config->setResultCacheImpl($this->Cache);
                $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->appraisal_id->Lookup->renderViewRow($rswrk[0]);
                    $this->appraisal_id->ViewValue = $this->appraisal_id->displayValue($arwrk);
                } else {
                    $this->appraisal_id->ViewValue = $this->appraisal_id->CurrentValue;
                }
            }
        } else {
            $this->appraisal_id->ViewValue = null;
        }
        $this->appraisal_id->ViewCustomAttributes = "";

        // consolidated_rating
        $this->consolidated_rating->ViewValue = $this->consolidated_rating->CurrentValue;
        $this->consolidated_rating->ViewValue = FormatNumber($this->consolidated_rating->ViewValue, "");
        $this->consolidated_rating->ViewCustomAttributes = "";

        // appraisal_status
        if (strval($this->appraisal_status->CurrentValue) != "") {
            $this->appraisal_status->ViewValue = $this->appraisal_status->optionCaption($this->appraisal_status->CurrentValue);
        } else {
            $this->appraisal_status->ViewValue = null;
        }
        $this->appraisal_status->ViewCustomAttributes = "";

        // createddate
        $this->createddate->ViewValue = $this->createddate->CurrentValue;
        $this->createddate->ViewValue = FormatDateTime($this->createddate->ViewValue, 0);
        $this->createddate->ViewCustomAttributes = "";

        // line_manager
        $curVal = strval($this->line_manager->CurrentValue);
        if ($curVal != "") {
            $this->line_manager->ViewValue = $this->line_manager->lookupCacheOption($curVal);
            if ($this->line_manager->ViewValue === null) { // Lookup from database
                $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                $sqlWrk = $this->line_manager->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                $conn = Conn();
                $config = $conn->getConfiguration();
                $config->setResultCacheImpl($this->Cache);
                $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->line_manager->Lookup->renderViewRow($rswrk[0]);
                    $this->line_manager->ViewValue = $this->line_manager->displayValue($arwrk);
                } else {
                    $this->line_manager->ViewValue = $this->line_manager->CurrentValue;
                }
            }
        } else {
            $this->line_manager->ViewValue = null;
        }
        $this->line_manager->ViewCustomAttributes = "";

        // level
        if (strval($this->level->CurrentValue) != "") {
            $this->level->ViewValue = $this->level->optionCaption($this->level->CurrentValue);
        } else {
            $this->level->ViewValue = null;
        }
        $this->level->ViewCustomAttributes = "";

        // group_id
        $this->group_id->LinkCustomAttributes = "";
        $this->group_id->HrefValue = "";
        $this->group_id->TooltipValue = "";

        // employee_id
        $this->employee_id->LinkCustomAttributes = "";
        $this->employee_id->HrefValue = "";
        $this->employee_id->TooltipValue = "";

        // appraisal_id
        $this->appraisal_id->LinkCustomAttributes = "";
        $this->appraisal_id->HrefValue = "";
        $this->appraisal_id->TooltipValue = "";

        // consolidated_rating
        $this->consolidated_rating->LinkCustomAttributes = "";
        $this->consolidated_rating->HrefValue = "";
        $this->consolidated_rating->TooltipValue = "";

        // appraisal_status
        $this->appraisal_status->LinkCustomAttributes = "";
        $this->appraisal_status->HrefValue = "";
        $this->appraisal_status->TooltipValue = "";

        // createddate
        $this->createddate->LinkCustomAttributes = "";
        $this->createddate->HrefValue = "";
        $this->createddate->TooltipValue = "";

        // line_manager
        $this->line_manager->LinkCustomAttributes = "";
        $this->line_manager->HrefValue = "";
        $this->line_manager->TooltipValue = "";

        // level
        $this->level->LinkCustomAttributes = "";
        $this->level->HrefValue = "";
        $this->level->TooltipValue = "";

        // Call Row Rendered event
        $this->rowRendered();

        // Save data for Custom Template
        $this->Rows[] = $this->customTemplateFieldValues();
    }

    // Render edit row values
    public function renderEditRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // group_id
        $this->group_id->setupEditAttributes();
        $this->group_id->EditCustomAttributes = "";
        $this->group_id->PlaceHolder = RemoveHtml($this->group_id->caption());

        // employee_id
        $this->employee_id->setupEditAttributes();
        $this->employee_id->EditCustomAttributes = "";
        $this->employee_id->PlaceHolder = RemoveHtml($this->employee_id->caption());

        // appraisal_id
        $this->appraisal_id->setupEditAttributes();
        $this->appraisal_id->EditCustomAttributes = "";
        $this->appraisal_id->PlaceHolder = RemoveHtml($this->appraisal_id->caption());

        // consolidated_rating
        $this->consolidated_rating->setupEditAttributes();
        $this->consolidated_rating->EditCustomAttributes = "";
        $this->consolidated_rating->EditValue = $this->consolidated_rating->CurrentValue;
        $this->consolidated_rating->PlaceHolder = RemoveHtml($this->consolidated_rating->caption());
        if (strval($this->consolidated_rating->EditValue) != "" && is_numeric($this->consolidated_rating->EditValue)) {
            $this->consolidated_rating->EditValue = FormatNumber($this->consolidated_rating->EditValue, null);
        }

        // appraisal_status
        $this->appraisal_status->EditCustomAttributes = "";
        $this->appraisal_status->EditValue = $this->appraisal_status->options(false);
        $this->appraisal_status->PlaceHolder = RemoveHtml($this->appraisal_status->caption());

        // createddate

        // line_manager
        $this->line_manager->setupEditAttributes();
        $this->line_manager->EditCustomAttributes = "";
        $this->line_manager->PlaceHolder = RemoveHtml($this->line_manager->caption());

        // level
        $this->level->setupEditAttributes();
        $this->level->EditCustomAttributes = "";
        $this->level->EditValue = $this->level->options(true);
        $this->level->PlaceHolder = RemoveHtml($this->level->caption());

        // Call Row Rendered event
        $this->rowRendered();
    }

    // Aggregate list row values
    public function aggregateListRowValues()
    {
    }

    // Aggregate list row (for rendering)
    public function aggregateListRow()
    {
        // Call Row Rendered event
        $this->rowRendered();
    }

    // Export data in HTML/CSV/Word/Excel/Email/PDF format
    public function exportDocument($doc, $recordset, $startRec = 1, $stopRec = 1, $exportPageType = "")
    {
        if (!$recordset || !$doc) {
            return;
        }
        if (!$doc->ExportCustom) {
            // Write header
            $doc->exportTableHeader();
            if ($doc->Horizontal) { // Horizontal format, write header
                $doc->beginExportRow();
                if ($exportPageType == "view") {
                    $doc->exportCaption($this->group_id);
                    $doc->exportCaption($this->employee_id);
                    $doc->exportCaption($this->appraisal_id);
                    $doc->exportCaption($this->consolidated_rating);
                    $doc->exportCaption($this->appraisal_status);
                    $doc->exportCaption($this->createddate);
                    $doc->exportCaption($this->line_manager);
                    $doc->exportCaption($this->level);
                } else {
                    $doc->exportCaption($this->group_id);
                    $doc->exportCaption($this->employee_id);
                    $doc->exportCaption($this->appraisal_id);
                    $doc->exportCaption($this->consolidated_rating);
                    $doc->exportCaption($this->appraisal_status);
                    $doc->exportCaption($this->createddate);
                    $doc->exportCaption($this->line_manager);
                    $doc->exportCaption($this->level);
                }
                $doc->endExportRow();
            }
        }

        // Move to first record
        $recCnt = $startRec - 1;
        $stopRec = ($stopRec > 0) ? $stopRec : PHP_INT_MAX;
        while (!$recordset->EOF && $recCnt < $stopRec) {
            $row = $recordset->fields;
            $recCnt++;
            if ($recCnt >= $startRec) {
                $rowCnt = $recCnt - $startRec + 1;

                // Page break
                if ($this->ExportPageBreakCount > 0) {
                    if ($rowCnt > 1 && ($rowCnt - 1) % $this->ExportPageBreakCount == 0) {
                        $doc->exportPageBreak();
                    }
                }
                $this->loadListRowValues($row);

                // Render row
                $this->RowType = ROWTYPE_VIEW; // Render view
                $this->resetAttributes();
                $this->renderListRow();
                if (!$doc->ExportCustom) {
                    $doc->beginExportRow($rowCnt); // Allow CSS styles if enabled
                    if ($exportPageType == "view") {
                        $doc->exportField($this->group_id);
                        $doc->exportField($this->employee_id);
                        $doc->exportField($this->appraisal_id);
                        $doc->exportField($this->consolidated_rating);
                        $doc->exportField($this->appraisal_status);
                        $doc->exportField($this->createddate);
                        $doc->exportField($this->line_manager);
                        $doc->exportField($this->level);
                    } else {
                        $doc->exportField($this->group_id);
                        $doc->exportField($this->employee_id);
                        $doc->exportField($this->appraisal_id);
                        $doc->exportField($this->consolidated_rating);
                        $doc->exportField($this->appraisal_status);
                        $doc->exportField($this->createddate);
                        $doc->exportField($this->line_manager);
                        $doc->exportField($this->level);
                    }
                    $doc->endExportRow($rowCnt);
                }
            }

            // Call Row Export server event
            if ($doc->ExportCustom) {
                $this->rowExport($row);
            }
            $recordset->moveNext();
        }
        if (!$doc->ExportCustom) {
            $doc->exportTableFooter();
        }
    }

    // Get file data
    public function getFileData($fldparm, $key, $resize, $width = 0, $height = 0, $plugins = [])
    {
        // No binary fields
        return false;
    }

    // Table level events

    // Recordset Selecting event
    public function recordsetSelecting(&$filter)
    {
        // Enter your code here
    }

    // Recordset Selected event
    public function recordsetSelected(&$rs)
    {
        //Log("Recordset Selected");
    }

    // Recordset Search Validated event
    public function recordsetSearchValidated()
    {
        // Example:
        //$this->MyField1->AdvancedSearch->SearchValue = "your search criteria"; // Search value
    }

    // Recordset Searching event
    public function recordsetSearching(&$filter)
    {
        // Enter your code here
    }

    // Row_Selecting event
    public function rowSelecting(&$filter)
    {
        // Enter your code here
    }

    // Row Selected event
    public function rowSelected(&$rs)
    {
        //Log("Row Selected");
    }

    // Row Inserting event
    public function rowInserting($rsold, &$rsnew)
    {
        // Enter your code here
        // To cancel, set return value to false
        return true;
    }

    // Row Inserted event
    public function rowInserted($rsold, &$rsnew)
    {
        //Log("Row Inserted");
    }

    // Row Updating event
    public function rowUpdating($rsold, &$rsnew)
    {
        // Enter your code here
        // To cancel, set return value to false
        return true;
    }

    // Row Updated event
    public function rowUpdated($rsold, &$rsnew)
    {
        //Log("Row Updated");
    }

    // Row Update Conflict event
    public function rowUpdateConflict($rsold, &$rsnew)
    {
        // Enter your code here
        // To ignore conflict, set return value to false
        return true;
    }

    // Grid Inserting event
    public function gridInserting()
    {
        // Enter your code here
        // To reject grid insert, set return value to false
        return true;
    }

    // Grid Inserted event
    public function gridInserted($rsnew)
    {
        //Log("Grid Inserted");
    }

    // Grid Updating event
    public function gridUpdating($rsold)
    {
        // Enter your code here
        // To reject grid update, set return value to false
        return true;
    }

    // Grid Updated event
    public function gridUpdated($rsold, $rsnew)
    {
        //Log("Grid Updated");
    }

    // Row Deleting event
    public function rowDeleting(&$rs)
    {
        // Enter your code here
        // To cancel, set return value to False
        return true;
    }

    // Row Deleted event
    public function rowDeleted(&$rs)
    {
        //Log("Row Deleted");
    }

    // Email Sending event
    public function emailSending($email, &$args)
    {
        //var_dump($email); var_dump($args); exit();
        return true;
    }

    // Lookup Selecting event
    public function lookupSelecting($fld, &$filter)
    {
        //var_dump($fld->Name, $fld->Lookup, $filter); // Uncomment to view the filter
        // Enter your code here
    }

    // Row Rendering event
    public function rowRendering()
    {
        // Enter your code here
    }

    // Row Rendered event
    public function rowRendered()
    {
        // To view properties of field class, use:
        //var_dump($this-><FieldName>);
    }

    // User ID Filtering event
    public function userIdFiltering(&$filter)
    {
        // Enter your code here
    }
}
