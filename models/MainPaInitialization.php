<?php

namespace PHPMaker2022\wfg_appraisal;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Table class for main_pa_initialization
 */
class MainPaInitialization extends DbTable
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

    // Audit trail
    public $AuditTrailOnAdd = true;
    public $AuditTrailOnEdit = true;
    public $AuditTrailOnDelete = true;
    public $AuditTrailOnView = false;
    public $AuditTrailOnViewData = false;
    public $AuditTrailOnSearch = false;

    // Export
    public $ExportDoc;

    // Fields
    public $id;
    public $business_unit;
    public $group_id;
    public $appraisal_mode;
    public $appraisal_period;
    public $from_year;
    public $to_year;
    public $employees_due_date;
    public $managers_due_date;
    public $initialize_status;
    public $appraisal_ratings;
    public $isactive;
    public $createdby;
    public $modifiedby;
    public $createddate;
    public $modifieddate;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage, $CurrentLocale;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'main_pa_initialization';
        $this->TableName = 'main_pa_initialization';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "`main_pa_initialization`";
        $this->Dbid = 'DB';
        $this->ExportAll = false;
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
        $this->DetailEdit = true; // Allow detail edit
        $this->DetailView = true; // Allow detail view
        $this->ShowMultipleDetails = false; // Show multiple details
        $this->GridAddRowCount = 5;
        $this->AllowAddDeleteRow = true; // Allow add/delete row
        $this->UserIDAllowSecurity = Config("DEFAULT_USER_ID_ALLOW_SECURITY"); // Default User ID allowed permissions
        $this->BasicSearch = new BasicSearch($this->TableVar);

        // id
        $this->id = new DbField(
            'main_pa_initialization',
            'main_pa_initialization',
            'x_id',
            'id',
            '`id`',
            '`id`',
            21,
            20,
            -1,
            false,
            '`id`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->id->InputTextType = "text";
        $this->id->IsAutoIncrement = true; // Autoincrement field
        $this->id->IsPrimaryKey = true; // Primary key field
        $this->id->IsForeignKey = true; // Foreign key field
        $this->id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['id'] = &$this->id;

        // business_unit
        $this->business_unit = new DbField(
            'main_pa_initialization',
            'main_pa_initialization',
            'x_business_unit',
            'business_unit',
            '`business_unit`',
            '`business_unit`',
            3,
            15,
            -1,
            false,
            '`business_unit`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'SELECT'
        );
        $this->business_unit->InputTextType = "text";
        $this->business_unit->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->business_unit->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        $this->business_unit->Lookup = new Lookup('business_unit', 'main_businessunits', false, 'id', ["unitname","unitcode","",""], [], ["x_group_id"], [], [], [], [], '', '', "CONCAT(COALESCE(`unitname`, ''),'" . ValueSeparator(1, $this->business_unit) . "',COALESCE(`unitcode`,''))");
        $this->business_unit->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['business_unit'] = &$this->business_unit;

        // group_id
        $this->group_id = new DbField(
            'main_pa_initialization',
            'main_pa_initialization',
            'x_group_id',
            'group_id',
            '`group_id`',
            '`group_id`',
            19,
            10,
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
        $this->group_id->Lookup = new Lookup('group_id', 'main_pa_groups', false, 'id', ["group_name","","",""], ["x_business_unit"], [], ["business_unit"], ["x_business_unit"], [], [], '', '', "`group_name`");
        $this->group_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['group_id'] = &$this->group_id;

        // appraisal_mode
        $this->appraisal_mode = new DbField(
            'main_pa_initialization',
            'main_pa_initialization',
            'x_appraisal_mode',
            'appraisal_mode',
            '`appraisal_mode`',
            '`appraisal_mode`',
            202,
            11,
            -1,
            false,
            '`appraisal_mode`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'RADIO'
        );
        $this->appraisal_mode->InputTextType = "text";
        $this->appraisal_mode->Lookup = new Lookup('appraisal_mode', 'main_pa_initialization', false, '', ["","","",""], [], [], [], [], [], [], '', '', "");
        $this->appraisal_mode->OptionCount = 3;
        $this->Fields['appraisal_mode'] = &$this->appraisal_mode;

        // appraisal_period
        $this->appraisal_period = new DbField(
            'main_pa_initialization',
            'main_pa_initialization',
            'x_appraisal_period',
            'appraisal_period',
            '`appraisal_period`',
            '`appraisal_period`',
            200,
            50,
            -1,
            false,
            '`appraisal_period`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'SELECT'
        );
        $this->appraisal_period->InputTextType = "text";
        $this->appraisal_period->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->appraisal_period->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        $this->appraisal_period->Lookup = new Lookup('appraisal_period', 'main_pa_initialization', false, '', ["","","",""], [], [], [], [], [], [], '', '', "");
        $this->appraisal_period->OptionCount = 6;
        $this->Fields['appraisal_period'] = &$this->appraisal_period;

        // from_year
        $this->from_year = new DbField(
            'main_pa_initialization',
            'main_pa_initialization',
            'x_from_year',
            'from_year',
            '`from_year`',
            '`from_year`',
            19,
            10,
            -1,
            false,
            '`from_year`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'SELECT'
        );
        $this->from_year->InputTextType = "text";
        $this->from_year->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->from_year->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        $this->from_year->Lookup = new Lookup('from_year', 'main_pa_initialization', false, '', ["","","",""], [], [], [], [], [], [], '', '', "");
        $this->from_year->OptionCount = 5;
        $this->from_year->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['from_year'] = &$this->from_year;

        // to_year
        $this->to_year = new DbField(
            'main_pa_initialization',
            'main_pa_initialization',
            'x_to_year',
            'to_year',
            '`to_year`',
            '`to_year`',
            19,
            10,
            -1,
            false,
            '`to_year`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'SELECT'
        );
        $this->to_year->InputTextType = "text";
        $this->to_year->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->to_year->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        $this->to_year->Lookup = new Lookup('to_year', 'main_pa_initialization', false, '', ["","","",""], [], [], [], [], [], [], '', '', "");
        $this->to_year->OptionCount = 5;
        $this->to_year->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['to_year'] = &$this->to_year;

        // employees_due_date
        $this->employees_due_date = new DbField(
            'main_pa_initialization',
            'main_pa_initialization',
            'x_employees_due_date',
            'employees_due_date',
            '`employees_due_date`',
            CastDateFieldForLike("`employees_due_date`", 0, "DB"),
            133,
            10,
            0,
            false,
            '`employees_due_date`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->employees_due_date->InputTextType = "text";
        $this->employees_due_date->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->Fields['employees_due_date'] = &$this->employees_due_date;

        // managers_due_date
        $this->managers_due_date = new DbField(
            'main_pa_initialization',
            'main_pa_initialization',
            'x_managers_due_date',
            'managers_due_date',
            '`managers_due_date`',
            CastDateFieldForLike("`managers_due_date`", 0, "DB"),
            133,
            10,
            0,
            false,
            '`managers_due_date`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->managers_due_date->InputTextType = "text";
        $this->managers_due_date->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->Fields['managers_due_date'] = &$this->managers_due_date;

        // initialize_status
        $this->initialize_status = new DbField(
            'main_pa_initialization',
            'main_pa_initialization',
            'x_initialize_status',
            'initialize_status',
            '`initialize_status`',
            '`initialize_status`',
            17,
            11,
            -1,
            false,
            '`initialize_status`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'RADIO'
        );
        $this->initialize_status->InputTextType = "text";
        $this->initialize_status->Lookup = new Lookup('initialize_status', 'main_pa_initialization', false, '', ["","","",""], [], [], [], [], [], [], '', '', "");
        $this->initialize_status->OptionCount = 2;
        $this->initialize_status->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['initialize_status'] = &$this->initialize_status;

        // appraisal_ratings
        $this->appraisal_ratings = new DbField(
            'main_pa_initialization',
            'main_pa_initialization',
            'x_appraisal_ratings',
            'appraisal_ratings',
            '`appraisal_ratings`',
            '`appraisal_ratings`',
            200,
            255,
            -1,
            false,
            '`appraisal_ratings`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->appraisal_ratings->InputTextType = "text";
        $this->appraisal_ratings->Lookup = new Lookup('appraisal_ratings', 'appraisal_ratings', false, 'id', ["rating","","",""], [], [], [], [], [], [], '', '', "`rating`");
        $this->Fields['appraisal_ratings'] = &$this->appraisal_ratings;

        // isactive
        $this->isactive = new DbField(
            'main_pa_initialization',
            'main_pa_initialization',
            'x_isactive',
            'isactive',
            '`isactive`',
            '`isactive`',
            17,
            3,
            -1,
            false,
            '`isactive`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'RADIO'
        );
        $this->isactive->InputTextType = "text";
        $this->isactive->Lookup = new Lookup('isactive', 'main_pa_initialization', false, '', ["","","",""], [], [], [], [], [], [], '', '', "");
        $this->isactive->OptionCount = 2;
        $this->isactive->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['isactive'] = &$this->isactive;

        // createdby
        $this->createdby = new DbField(
            'main_pa_initialization',
            'main_pa_initialization',
            'x_createdby',
            'createdby',
            '`createdby`',
            '`createdby`',
            21,
            20,
            -1,
            false,
            '`createdby`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->createdby->InputTextType = "text";
        $this->createdby->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['createdby'] = &$this->createdby;

        // modifiedby
        $this->modifiedby = new DbField(
            'main_pa_initialization',
            'main_pa_initialization',
            'x_modifiedby',
            'modifiedby',
            '`modifiedby`',
            '`modifiedby`',
            21,
            20,
            -1,
            false,
            '`modifiedby`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->modifiedby->InputTextType = "text";
        $this->modifiedby->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['modifiedby'] = &$this->modifiedby;

        // createddate
        $this->createddate = new DbField(
            'main_pa_initialization',
            'main_pa_initialization',
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

        // modifieddate
        $this->modifieddate = new DbField(
            'main_pa_initialization',
            'main_pa_initialization',
            'x_modifieddate',
            'modifieddate',
            '`modifieddate`',
            CastDateFieldForLike("`modifieddate`", 0, "DB"),
            135,
            19,
            0,
            false,
            '`modifieddate`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->modifieddate->InputTextType = "text";
        $this->modifieddate->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->Fields['modifieddate'] = &$this->modifieddate;

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

    // Current detail table name
    public function getCurrentDetailTable()
    {
        return Session(PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_DETAIL_TABLE"));
    }

    public function setCurrentDetailTable($v)
    {
        $_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_DETAIL_TABLE")] = $v;
    }

    // Get detail url
    public function getDetailUrl()
    {
        // Detail url
        $detailUrl = "";
        if ($this->getCurrentDetailTable() == "main_group_pa_questions") {
            $detailUrl = Container("main_group_pa_questions")->getListUrl() . "?" . Config("TABLE_SHOW_MASTER") . "=" . $this->TableVar;
            $detailUrl .= "&" . GetForeignKeyUrl("fk_id", $this->id->CurrentValue);
        }
        if ($detailUrl == "") {
            $detailUrl = "mainpainitializationlist";
        }
        return $detailUrl;
    }

    // Table level SQL
    public function getSqlFrom() // From
    {
        return ($this->SqlFrom != "") ? $this->SqlFrom : "`main_pa_initialization`";
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
        $this->DefaultFilter = "";
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
            // Get insert id if necessary
            $this->id->setDbValue($conn->lastInsertId());
            $rs['id'] = $this->id->DbValue;
            if ($this->AuditTrailOnAdd) {
                $this->writeAuditTrailOnAdd($rs);
            }
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
        // Cascade Update detail table 'main_group_pa_questions'
        $cascadeUpdate = false;
        $rscascade = [];
        if ($rsold && (isset($rs['id']) && $rsold['id'] != $rs['id'])) { // Update detail field 'appraisal_id'
            $cascadeUpdate = true;
            $rscascade['appraisal_id'] = $rs['id'];
        }
        if ($cascadeUpdate) {
            $rswrk = Container("main_group_pa_questions")->loadRs("`appraisal_id` = " . QuotedValue($rsold['id'], DATATYPE_NUMBER, 'DB'))->fetchAllAssociative();
            foreach ($rswrk as $rsdtlold) {
                $rskey = [];
                $fldname = 'id';
                $rskey[$fldname] = $rsdtlold[$fldname];
                $rsdtlnew = array_merge($rsdtlold, $rscascade);
                // Call Row_Updating event
                $success = Container("main_group_pa_questions")->rowUpdating($rsdtlold, $rsdtlnew);
                if ($success) {
                    $success = Container("main_group_pa_questions")->update($rscascade, $rskey, $rsdtlold);
                }
                if (!$success) {
                    return false;
                }
                // Call Row_Updated event
                Container("main_group_pa_questions")->rowUpdated($rsdtlold, $rsdtlnew);
            }
        }

        // If no field is updated, execute may return 0. Treat as success
        $success = $this->updateSql($rs, $where, $curfilter)->execute();
        $success = ($success > 0) ? $success : true;
        if ($success && $this->AuditTrailOnEdit && $rsold) {
            $rsaudit = $rs;
            $fldname = 'id';
            if (!array_key_exists($fldname, $rsaudit)) {
                $rsaudit[$fldname] = $rsold[$fldname];
            }
            $this->writeAuditTrailOnEdit($rsold, $rsaudit);
        }
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
            if (array_key_exists('id', $rs)) {
                AddFilter($where, QuotedName('id', $this->Dbid) . '=' . QuotedValue($rs['id'], $this->id->DataType, $this->Dbid));
            }
        }
        $filter = ($curfilter) ? $this->CurrentFilter : "";
        AddFilter($filter, $where);
        return $queryBuilder->where($filter != "" ? $filter : "0=1");
    }

    // Delete
    public function delete(&$rs, $where = "", $curfilter = false)
    {
        $success = true;

        // Cascade delete detail table 'main_group_pa_questions'
        $dtlrows = Container("main_group_pa_questions")->loadRs("`appraisal_id` = " . QuotedValue($rs['id'], DATATYPE_NUMBER, "DB"))->fetchAllAssociative();
        // Call Row Deleting event
        foreach ($dtlrows as $dtlrow) {
            $success = Container("main_group_pa_questions")->rowDeleting($dtlrow);
            if (!$success) {
                break;
            }
        }
        if ($success) {
            foreach ($dtlrows as $dtlrow) {
                $success = Container("main_group_pa_questions")->delete($dtlrow); // Delete
                if (!$success) {
                    break;
                }
            }
        }
        // Call Row Deleted event
        if ($success) {
            foreach ($dtlrows as $dtlrow) {
                Container("main_group_pa_questions")->rowDeleted($dtlrow);
            }
        }
        if ($success) {
            $success = $this->deleteSql($rs, $where, $curfilter)->execute();
        }
        if ($success && $this->AuditTrailOnDelete) {
            $this->writeAuditTrailOnDelete($rs);
        }
        return $success;
    }

    // Load DbValue from recordset or array
    protected function loadDbValues($row)
    {
        if (!is_array($row)) {
            return;
        }
        $this->id->DbValue = $row['id'];
        $this->business_unit->DbValue = $row['business_unit'];
        $this->group_id->DbValue = $row['group_id'];
        $this->appraisal_mode->DbValue = $row['appraisal_mode'];
        $this->appraisal_period->DbValue = $row['appraisal_period'];
        $this->from_year->DbValue = $row['from_year'];
        $this->to_year->DbValue = $row['to_year'];
        $this->employees_due_date->DbValue = $row['employees_due_date'];
        $this->managers_due_date->DbValue = $row['managers_due_date'];
        $this->initialize_status->DbValue = $row['initialize_status'];
        $this->appraisal_ratings->DbValue = $row['appraisal_ratings'];
        $this->isactive->DbValue = $row['isactive'];
        $this->createdby->DbValue = $row['createdby'];
        $this->modifiedby->DbValue = $row['modifiedby'];
        $this->createddate->DbValue = $row['createddate'];
        $this->modifieddate->DbValue = $row['modifieddate'];
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

    // Get Key
    public function getKey($current = false)
    {
        $keys = [];
        $val = $current ? $this->id->CurrentValue : $this->id->OldValue;
        if (EmptyValue($val)) {
            return "";
        } else {
            $keys[] = $val;
        }
        return implode(Config("COMPOSITE_KEY_SEPARATOR"), $keys);
    }

    // Set Key
    public function setKey($key, $current = false)
    {
        $this->OldKey = strval($key);
        $keys = explode(Config("COMPOSITE_KEY_SEPARATOR"), $this->OldKey);
        if (count($keys) == 1) {
            if ($current) {
                $this->id->CurrentValue = $keys[0];
            } else {
                $this->id->OldValue = $keys[0];
            }
        }
    }

    // Get record filter
    public function getRecordFilter($row = null)
    {
        $keyFilter = $this->sqlKeyFilter();
        if (is_array($row)) {
            $val = array_key_exists('id', $row) ? $row['id'] : null;
        } else {
            $val = $this->id->OldValue !== null ? $this->id->OldValue : $this->id->CurrentValue;
        }
        if (!is_numeric($val)) {
            return "0=1"; // Invalid key
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@id@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
        }
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
        return $_SESSION[$name] ?? GetUrl("mainpainitializationlist");
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
        if ($pageName == "mainpainitializationview") {
            return $Language->phrase("View");
        } elseif ($pageName == "mainpainitializationedit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "mainpainitializationadd") {
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
                return "MainPaInitializationView";
            case Config("API_ADD_ACTION"):
                return "MainPaInitializationAdd";
            case Config("API_EDIT_ACTION"):
                return "MainPaInitializationEdit";
            case Config("API_DELETE_ACTION"):
                return "MainPaInitializationDelete";
            case Config("API_LIST_ACTION"):
                return "MainPaInitializationList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "mainpainitializationlist";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("mainpainitializationview", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("mainpainitializationview", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "mainpainitializationadd?" . $this->getUrlParm($parm);
        } else {
            $url = "mainpainitializationadd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("mainpainitializationedit", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("mainpainitializationedit", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
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
        if ($parm != "") {
            $url = $this->keyUrl("mainpainitializationadd", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("mainpainitializationadd", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
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
        return $this->keyUrl("mainpainitializationdelete", $this->getUrlParm());
    }

    // Add master url
    public function addMasterUrl($url)
    {
        return $url;
    }

    public function keyToJson($htmlEncode = false)
    {
        $json = "";
        $json .= "\"id\":" . JsonEncode($this->id->CurrentValue, "number");
        $json = "{" . $json . "}";
        if ($htmlEncode) {
            $json = HtmlEncode($json);
        }
        return $json;
    }

    // Add key value to URL
    public function keyUrl($url, $parm = "")
    {
        if ($this->id->CurrentValue !== null) {
            $url .= "/" . $this->encodeKeyValue($this->id->CurrentValue);
        } else {
            return "javascript:ew.alert(ew.language.phrase('InvalidRecord'));";
        }
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
            if (($keyValue = Param("id") ?? Route("id")) !== null) {
                $arKeys[] = $keyValue;
            } elseif (IsApi() && (($keyValue = Key(0) ?? Route(2)) !== null)) {
                $arKeys[] = $keyValue;
            } else {
                $arKeys = null; // Do not setup
            }

            //return $arKeys; // Do not return yet, so the values will also be checked by the following code
        }
        // Check keys
        $ar = [];
        if (is_array($arKeys)) {
            foreach ($arKeys as $key) {
                if (!is_numeric($key)) {
                    continue;
                }
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
            if ($setCurrent) {
                $this->id->CurrentValue = $key;
            } else {
                $this->id->OldValue = $key;
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

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // id

        // business_unit

        // group_id

        // appraisal_mode

        // appraisal_period

        // from_year

        // to_year

        // employees_due_date

        // managers_due_date

        // initialize_status

        // appraisal_ratings

        // isactive

        // createdby

        // modifiedby

        // createddate

        // modifieddate

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

        // id
        $this->id->LinkCustomAttributes = "";
        $this->id->HrefValue = "";
        $this->id->TooltipValue = "";

        // business_unit
        $this->business_unit->LinkCustomAttributes = "";
        $this->business_unit->HrefValue = "";
        $this->business_unit->TooltipValue = "";

        // group_id
        $this->group_id->LinkCustomAttributes = "";
        $this->group_id->HrefValue = "";
        $this->group_id->TooltipValue = "";

        // appraisal_mode
        $this->appraisal_mode->LinkCustomAttributes = "";
        $this->appraisal_mode->HrefValue = "";
        $this->appraisal_mode->TooltipValue = "";

        // appraisal_period
        $this->appraisal_period->LinkCustomAttributes = "";
        $this->appraisal_period->HrefValue = "";
        $this->appraisal_period->TooltipValue = "";

        // from_year
        $this->from_year->LinkCustomAttributes = "";
        $this->from_year->HrefValue = "";
        $this->from_year->TooltipValue = "";

        // to_year
        $this->to_year->LinkCustomAttributes = "";
        $this->to_year->HrefValue = "";
        $this->to_year->TooltipValue = "";

        // employees_due_date
        $this->employees_due_date->LinkCustomAttributes = "";
        $this->employees_due_date->HrefValue = "";
        $this->employees_due_date->TooltipValue = "";

        // managers_due_date
        $this->managers_due_date->LinkCustomAttributes = "";
        $this->managers_due_date->HrefValue = "";
        $this->managers_due_date->TooltipValue = "";

        // initialize_status
        $this->initialize_status->LinkCustomAttributes = "";
        $this->initialize_status->HrefValue = "";
        $this->initialize_status->TooltipValue = "";

        // appraisal_ratings
        $this->appraisal_ratings->LinkCustomAttributes = "";
        $this->appraisal_ratings->HrefValue = "";
        $this->appraisal_ratings->TooltipValue = "";

        // isactive
        $this->isactive->LinkCustomAttributes = "";
        $this->isactive->HrefValue = "";
        $this->isactive->TooltipValue = "";

        // createdby
        $this->createdby->LinkCustomAttributes = "";
        $this->createdby->HrefValue = "";
        $this->createdby->TooltipValue = "";

        // modifiedby
        $this->modifiedby->LinkCustomAttributes = "";
        $this->modifiedby->HrefValue = "";
        $this->modifiedby->TooltipValue = "";

        // createddate
        $this->createddate->LinkCustomAttributes = "";
        $this->createddate->HrefValue = "";
        $this->createddate->TooltipValue = "";

        // modifieddate
        $this->modifieddate->LinkCustomAttributes = "";
        $this->modifieddate->HrefValue = "";
        $this->modifieddate->TooltipValue = "";

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

        // id
        $this->id->setupEditAttributes();
        $this->id->EditCustomAttributes = "";
        $this->id->EditValue = $this->id->CurrentValue;
        $this->id->ViewCustomAttributes = "";

        // business_unit
        $this->business_unit->setupEditAttributes();
        $this->business_unit->EditCustomAttributes = "";
        $this->business_unit->PlaceHolder = RemoveHtml($this->business_unit->caption());

        // group_id
        $this->group_id->setupEditAttributes();
        $this->group_id->EditCustomAttributes = "";
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
        $this->employees_due_date->EditValue = FormatDateTime($this->employees_due_date->CurrentValue, 8);
        $this->employees_due_date->PlaceHolder = RemoveHtml($this->employees_due_date->caption());

        // managers_due_date
        $this->managers_due_date->setupEditAttributes();
        $this->managers_due_date->EditCustomAttributes = "";
        $this->managers_due_date->EditValue = FormatDateTime($this->managers_due_date->CurrentValue, 8);
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
        $this->appraisal_ratings->EditValue = $this->appraisal_ratings->CurrentValue;
        $this->appraisal_ratings->PlaceHolder = RemoveHtml($this->appraisal_ratings->caption());

        // isactive
        $this->isactive->EditCustomAttributes = "";
        $this->isactive->EditValue = $this->isactive->options(false);
        $this->isactive->PlaceHolder = RemoveHtml($this->isactive->caption());

        // createdby

        // modifiedby

        // createddate

        // modifieddate

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
                    $doc->exportCaption($this->id);
                    $doc->exportCaption($this->business_unit);
                    $doc->exportCaption($this->group_id);
                    $doc->exportCaption($this->appraisal_mode);
                    $doc->exportCaption($this->appraisal_period);
                    $doc->exportCaption($this->from_year);
                    $doc->exportCaption($this->to_year);
                    $doc->exportCaption($this->employees_due_date);
                    $doc->exportCaption($this->managers_due_date);
                    $doc->exportCaption($this->initialize_status);
                    $doc->exportCaption($this->appraisal_ratings);
                    $doc->exportCaption($this->isactive);
                    $doc->exportCaption($this->createdby);
                    $doc->exportCaption($this->modifiedby);
                    $doc->exportCaption($this->createddate);
                    $doc->exportCaption($this->modifieddate);
                } else {
                    $doc->exportCaption($this->id);
                    $doc->exportCaption($this->business_unit);
                    $doc->exportCaption($this->group_id);
                    $doc->exportCaption($this->appraisal_mode);
                    $doc->exportCaption($this->appraisal_period);
                    $doc->exportCaption($this->from_year);
                    $doc->exportCaption($this->to_year);
                    $doc->exportCaption($this->employees_due_date);
                    $doc->exportCaption($this->managers_due_date);
                    $doc->exportCaption($this->initialize_status);
                    $doc->exportCaption($this->appraisal_ratings);
                    $doc->exportCaption($this->isactive);
                    $doc->exportCaption($this->createdby);
                    $doc->exportCaption($this->modifiedby);
                    $doc->exportCaption($this->createddate);
                    $doc->exportCaption($this->modifieddate);
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
                        $doc->exportField($this->id);
                        $doc->exportField($this->business_unit);
                        $doc->exportField($this->group_id);
                        $doc->exportField($this->appraisal_mode);
                        $doc->exportField($this->appraisal_period);
                        $doc->exportField($this->from_year);
                        $doc->exportField($this->to_year);
                        $doc->exportField($this->employees_due_date);
                        $doc->exportField($this->managers_due_date);
                        $doc->exportField($this->initialize_status);
                        $doc->exportField($this->appraisal_ratings);
                        $doc->exportField($this->isactive);
                        $doc->exportField($this->createdby);
                        $doc->exportField($this->modifiedby);
                        $doc->exportField($this->createddate);
                        $doc->exportField($this->modifieddate);
                    } else {
                        $doc->exportField($this->id);
                        $doc->exportField($this->business_unit);
                        $doc->exportField($this->group_id);
                        $doc->exportField($this->appraisal_mode);
                        $doc->exportField($this->appraisal_period);
                        $doc->exportField($this->from_year);
                        $doc->exportField($this->to_year);
                        $doc->exportField($this->employees_due_date);
                        $doc->exportField($this->managers_due_date);
                        $doc->exportField($this->initialize_status);
                        $doc->exportField($this->appraisal_ratings);
                        $doc->exportField($this->isactive);
                        $doc->exportField($this->createdby);
                        $doc->exportField($this->modifiedby);
                        $doc->exportField($this->createddate);
                        $doc->exportField($this->modifieddate);
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

    // Write Audit Trail start/end for grid update
    public function writeAuditTrailDummy($typ)
    {
        $table = 'main_pa_initialization';
        $usr = CurrentUserID();
        WriteAuditLog($usr, $typ, $table, "", "", "", "");
    }

    // Write Audit Trail (add page)
    public function writeAuditTrailOnAdd(&$rs)
    {
        global $Language;
        if (!$this->AuditTrailOnAdd) {
            return;
        }
        $table = 'main_pa_initialization';

        // Get key value
        $key = "";
        if ($key != "") {
            $key .= Config("COMPOSITE_KEY_SEPARATOR");
        }
        $key .= $rs['id'];

        // Write Audit Trail
        $usr = CurrentUserID();
        foreach (array_keys($rs) as $fldname) {
            if (array_key_exists($fldname, $this->Fields) && $this->Fields[$fldname]->DataType != DATATYPE_BLOB) { // Ignore BLOB fields
                if ($this->Fields[$fldname]->HtmlTag == "PASSWORD") {
                    $newvalue = $Language->phrase("PasswordMask"); // Password Field
                } elseif ($this->Fields[$fldname]->DataType == DATATYPE_MEMO) {
                    if (Config("AUDIT_TRAIL_TO_DATABASE")) {
                        $newvalue = $rs[$fldname];
                    } else {
                        $newvalue = "[MEMO]"; // Memo Field
                    }
                } elseif ($this->Fields[$fldname]->DataType == DATATYPE_XML) {
                    $newvalue = "[XML]"; // XML Field
                } else {
                    $newvalue = $rs[$fldname];
                }
                WriteAuditLog($usr, "A", $table, $fldname, $key, "", $newvalue);
            }
        }
    }

    // Write Audit Trail (edit page)
    public function writeAuditTrailOnEdit(&$rsold, &$rsnew)
    {
        global $Language;
        if (!$this->AuditTrailOnEdit) {
            return;
        }
        $table = 'main_pa_initialization';

        // Get key value
        $key = "";
        if ($key != "") {
            $key .= Config("COMPOSITE_KEY_SEPARATOR");
        }
        $key .= $rsold['id'];

        // Write Audit Trail
        $usr = CurrentUserID();
        foreach (array_keys($rsnew) as $fldname) {
            if (array_key_exists($fldname, $this->Fields) && array_key_exists($fldname, $rsold) && $this->Fields[$fldname]->DataType != DATATYPE_BLOB) { // Ignore BLOB fields
                if ($this->Fields[$fldname]->DataType == DATATYPE_DATE) { // DateTime field
                    $modified = (FormatDateTime($rsold[$fldname], 0) != FormatDateTime($rsnew[$fldname], 0));
                } else {
                    $modified = !CompareValue($rsold[$fldname], $rsnew[$fldname]);
                }
                if ($modified) {
                    if ($this->Fields[$fldname]->HtmlTag == "PASSWORD") { // Password Field
                        $oldvalue = $Language->phrase("PasswordMask");
                        $newvalue = $Language->phrase("PasswordMask");
                    } elseif ($this->Fields[$fldname]->DataType == DATATYPE_MEMO) { // Memo field
                        if (Config("AUDIT_TRAIL_TO_DATABASE")) {
                            $oldvalue = $rsold[$fldname];
                            $newvalue = $rsnew[$fldname];
                        } else {
                            $oldvalue = "[MEMO]";
                            $newvalue = "[MEMO]";
                        }
                    } elseif ($this->Fields[$fldname]->DataType == DATATYPE_XML) { // XML field
                        $oldvalue = "[XML]";
                        $newvalue = "[XML]";
                    } else {
                        $oldvalue = $rsold[$fldname];
                        $newvalue = $rsnew[$fldname];
                    }
                    WriteAuditLog($usr, "U", $table, $fldname, $key, $oldvalue, $newvalue);
                }
            }
        }
    }

    // Write Audit Trail (delete page)
    public function writeAuditTrailOnDelete(&$rs)
    {
        global $Language;
        if (!$this->AuditTrailOnDelete) {
            return;
        }
        $table = 'main_pa_initialization';

        // Get key value
        $key = "";
        if ($key != "") {
            $key .= Config("COMPOSITE_KEY_SEPARATOR");
        }
        $key .= $rs['id'];

        // Write Audit Trail
        $curUser = CurrentUserID();
        foreach (array_keys($rs) as $fldname) {
            if (array_key_exists($fldname, $this->Fields) && $this->Fields[$fldname]->DataType != DATATYPE_BLOB) { // Ignore BLOB fields
                if ($this->Fields[$fldname]->HtmlTag == "PASSWORD") {
                    $oldvalue = $Language->phrase("PasswordMask"); // Password Field
                } elseif ($this->Fields[$fldname]->DataType == DATATYPE_MEMO) {
                    if (Config("AUDIT_TRAIL_TO_DATABASE")) {
                        $oldvalue = $rs[$fldname];
                    } else {
                        $oldvalue = "[MEMO]"; // Memo field
                    }
                } elseif ($this->Fields[$fldname]->DataType == DATATYPE_XML) {
                    $oldvalue = "[XML]"; // XML field
                } else {
                    $oldvalue = $rs[$fldname];
                }
                WriteAuditLog($curUser, "D", $table, $fldname, $key, $oldvalue, "");
            }
        }
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
    	$group_id = $rsnew["group_id"];
    	$group_employees = getGroupEmployees($group_id);
    	$appraisal_details = getAppraisalDetails($rsnew["id"]);
    	$message_template = getAppraisalMessageTemplate("Employees");
    	foreach($group_employees as $employees){
    		$payload = [
    					"employee_id"=>$employees["employee_id"],
    					"group_id"=>$group_id,
    					"appraisal_id"=>$rsnew["id"]
    					];
    		createEmployeeRatings($employees["employee_id"],$rsnew["id"]);
    		$jwt_token = createJWTToken($payload);
    		$content = "This is a new appraisal please click on the link below to start ";
    		$url = $_SERVER['HTTP_HOST'].'/employeeappraisal/?t='.$jwt_token;
    	    $url = '<a href="https://'.$url.'" class="btn btn-primary btn-lg">Start Appraisal</a>';
    	    //$url = htmlspecialchars($url);
    			$variables = [
    						"firstname"=>$employees["firstname"],
    						"lastname"=>$employees["lastname"],
    						"groupname"=>$appraisal_details["group_name"],
    						"businessunit"=>$appraisal_details["unitname"],
    						"period"=>$appraisal_details["period"],
    						"url"=>$url
    						];
    		$message = replacePlaceHolders($variables, $message_template['content']);
    		if($rsnew["isactive"]==1){
    sendThisMail("hr@workforcegroup.com", $employees['emailaddress'], $message_template['title'], $message);
    }
    	}
    	header("Location: maingrouppaquestionslist?action=gridadd&appraisal_id=".$rsnew["id"]."&business_unit=".$rsnew["business_unit"]."&group_id=".$rsnew["group_id"]);
    die();
        $this->setSuccessMessage("Record Inserted. The ID of the new record is " . $rsnew["ID"]);    
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
       if($rsnew["isactive"]==1){
       	$group_id = $rsnew["group_id"];
       	debugCode(json_encode($rsnew));
    	$group_employees = getGroupEmployees($group_id);
    	$appraisal_details = getAppraisalDetails($rsold["id"]);
    	$message_template = getAppraisalMessageTemplate("Employees");
    	foreach($group_employees as $employees){
    		$payload = [
    					"employee_id"=>$employees["employee_id"],
    					"group_id"=>$group_id,
    					"appraisal_id"=>$rsold["id"]
    					];
    		createEmployeeRatings($employees["employee_id"],$rsold["id"]);
    		$jwt_token = createJWTToken($payload);
    		$content = "This is a new appraisal please click on the link below to start ";
    		$url = $_SERVER['HTTP_HOST'].'/employeeappraisal/?t='.$jwt_token;
    	    $url = '<a href="https://'.$url.'" class="btn btn-primary btn-lg">Start Appraisal</a>';
    	    //$url = htmlspecialchars($url);
    			$variables = [
    						"firstname"=>$employees["firstname"],
    						"lastname"=>$employees["lastname"],
    						"groupname"=>$appraisal_details["group_name"],
    						"businessunit"=>$appraisal_details["unitname"],
    						"period"=>$appraisal_details["period"],
    						"url"=>$url
    						];
    		$message = replacePlaceHolders($variables, $message_template['content']);
    		if($rsnew["isactive"]==1){
    sendThisMail("hr@workforcegroup.com", $employees['emailaddress'], $message_template['title'], $message);
    }
    	}
    	debugCode("maingrouppaquestionslist?action=gridadd&appraisal_id=".$rsnew["id"]."&business_unit=".$rsnew["business_unit"]."&group_id=".$rsnew["group_id"]);
    	header("Location: maingrouppaquestionslist?action=gridadd&appraisal_id=".$rsnew["id"]."&business_unit=".$rsnew["business_unit"]."&group_id=".$rsnew["group_id"]);
    die();
        $this->setSuccessMessage("Record Inserted. The ID of the new record is " . $rsnew["ID"]);    
    }
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
