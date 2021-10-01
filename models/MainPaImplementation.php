<?php

namespace PHPMaker2022\wfg_appraisal;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Table class for main_pa_implementation
 */
class MainPaImplementation extends DbTable
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
    public $tenant_id;
    public $businessunit_id;
    public $department_id;
    public $performance_app_flag;
    public $appraisal_mode;
    public $approval_selection;
    public $appraisal_ratings;
    public $module_flag;
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
        $this->TableVar = 'main_pa_implementation';
        $this->TableName = 'main_pa_implementation';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "`main_pa_implementation`";
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
        $this->DetailEdit = false; // Allow detail edit
        $this->DetailView = false; // Allow detail view
        $this->ShowMultipleDetails = false; // Show multiple details
        $this->GridAddRowCount = 5;
        $this->AllowAddDeleteRow = true; // Allow add/delete row
        $this->UserIDAllowSecurity = Config("DEFAULT_USER_ID_ALLOW_SECURITY"); // Default User ID allowed permissions
        $this->BasicSearch = new BasicSearch($this->TableVar);

        // id
        $this->id = new DbField(
            'main_pa_implementation',
            'main_pa_implementation',
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
            'NO'
        );
        $this->id->InputTextType = "text";
        $this->id->IsAutoIncrement = true; // Autoincrement field
        $this->id->IsPrimaryKey = true; // Primary key field
        $this->id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['id'] = &$this->id;

        // tenant_id
        $this->tenant_id = new DbField(
            'main_pa_implementation',
            'main_pa_implementation',
            'x_tenant_id',
            'tenant_id',
            '`tenant_id`',
            '`tenant_id`',
            3,
            11,
            -1,
            false,
            '`tenant_id`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->tenant_id->InputTextType = "text";
        $this->tenant_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['tenant_id'] = &$this->tenant_id;

        // businessunit_id
        $this->businessunit_id = new DbField(
            'main_pa_implementation',
            'main_pa_implementation',
            'x_businessunit_id',
            'businessunit_id',
            '`businessunit_id`',
            '`businessunit_id`',
            21,
            20,
            -1,
            false,
            '`businessunit_id`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->businessunit_id->InputTextType = "text";
        $this->businessunit_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['businessunit_id'] = &$this->businessunit_id;

        // department_id
        $this->department_id = new DbField(
            'main_pa_implementation',
            'main_pa_implementation',
            'x_department_id',
            'department_id',
            '`department_id`',
            '`department_id`',
            21,
            20,
            -1,
            false,
            '`department_id`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->department_id->InputTextType = "text";
        $this->department_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['department_id'] = &$this->department_id;

        // performance_app_flag
        $this->performance_app_flag = new DbField(
            'main_pa_implementation',
            'main_pa_implementation',
            'x_performance_app_flag',
            'performance_app_flag',
            '`performance_app_flag`',
            '`performance_app_flag`',
            17,
            3,
            -1,
            false,
            '`performance_app_flag`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->performance_app_flag->InputTextType = "text";
        $this->performance_app_flag->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['performance_app_flag'] = &$this->performance_app_flag;

        // appraisal_mode
        $this->appraisal_mode = new DbField(
            'main_pa_implementation',
            'main_pa_implementation',
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
        $this->appraisal_mode->Lookup = new Lookup('appraisal_mode', 'main_pa_implementation', false, '', ["","","",""], [], [], [], [], [], [], '', '', "");
        $this->appraisal_mode->OptionCount = 3;
        $this->Fields['appraisal_mode'] = &$this->appraisal_mode;

        // approval_selection
        $this->approval_selection = new DbField(
            'main_pa_implementation',
            'main_pa_implementation',
            'x_approval_selection',
            'approval_selection',
            '`approval_selection`',
            '`approval_selection`',
            17,
            3,
            -1,
            false,
            '`approval_selection`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->approval_selection->InputTextType = "text";
        $this->approval_selection->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['approval_selection'] = &$this->approval_selection;

        // appraisal_ratings
        $this->appraisal_ratings = new DbField(
            'main_pa_implementation',
            'main_pa_implementation',
            'x_appraisal_ratings',
            'appraisal_ratings',
            '`appraisal_ratings`',
            '`appraisal_ratings`',
            17,
            3,
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
        $this->appraisal_ratings->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['appraisal_ratings'] = &$this->appraisal_ratings;

        // module_flag
        $this->module_flag = new DbField(
            'main_pa_implementation',
            'main_pa_implementation',
            'x_module_flag',
            'module_flag',
            '`module_flag`',
            '`module_flag`',
            17,
            3,
            -1,
            false,
            '`module_flag`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->module_flag->InputTextType = "text";
        $this->module_flag->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['module_flag'] = &$this->module_flag;

        // isactive
        $this->isactive = new DbField(
            'main_pa_implementation',
            'main_pa_implementation',
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
            'TEXT'
        );
        $this->isactive->InputTextType = "text";
        $this->isactive->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['isactive'] = &$this->isactive;

        // createdby
        $this->createdby = new DbField(
            'main_pa_implementation',
            'main_pa_implementation',
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
            'main_pa_implementation',
            'main_pa_implementation',
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
            'main_pa_implementation',
            'main_pa_implementation',
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
            'main_pa_implementation',
            'main_pa_implementation',
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

    // Table level SQL
    public function getSqlFrom() // From
    {
        return ($this->SqlFrom != "") ? $this->SqlFrom : "`main_pa_implementation`";
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
        $this->tenant_id->DbValue = $row['tenant_id'];
        $this->businessunit_id->DbValue = $row['businessunit_id'];
        $this->department_id->DbValue = $row['department_id'];
        $this->performance_app_flag->DbValue = $row['performance_app_flag'];
        $this->appraisal_mode->DbValue = $row['appraisal_mode'];
        $this->approval_selection->DbValue = $row['approval_selection'];
        $this->appraisal_ratings->DbValue = $row['appraisal_ratings'];
        $this->module_flag->DbValue = $row['module_flag'];
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
        return $_SESSION[$name] ?? GetUrl("mainpaimplementationlist");
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
        if ($pageName == "mainpaimplementationview") {
            return $Language->phrase("View");
        } elseif ($pageName == "mainpaimplementationedit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "mainpaimplementationadd") {
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
                return "MainPaImplementationView";
            case Config("API_ADD_ACTION"):
                return "MainPaImplementationAdd";
            case Config("API_EDIT_ACTION"):
                return "MainPaImplementationEdit";
            case Config("API_DELETE_ACTION"):
                return "MainPaImplementationDelete";
            case Config("API_LIST_ACTION"):
                return "MainPaImplementationList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "mainpaimplementationlist";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("mainpaimplementationview", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("mainpaimplementationview", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "mainpaimplementationadd?" . $this->getUrlParm($parm);
        } else {
            $url = "mainpaimplementationadd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("mainpaimplementationedit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("mainpaimplementationadd", $this->getUrlParm($parm));
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
        return $this->keyUrl("mainpaimplementationdelete", $this->getUrlParm());
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
        $this->tenant_id->setDbValue($row['tenant_id']);
        $this->businessunit_id->setDbValue($row['businessunit_id']);
        $this->department_id->setDbValue($row['department_id']);
        $this->performance_app_flag->setDbValue($row['performance_app_flag']);
        $this->appraisal_mode->setDbValue($row['appraisal_mode']);
        $this->approval_selection->setDbValue($row['approval_selection']);
        $this->appraisal_ratings->setDbValue($row['appraisal_ratings']);
        $this->module_flag->setDbValue($row['module_flag']);
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

        // tenant_id

        // businessunit_id

        // department_id

        // performance_app_flag

        // appraisal_mode

        // approval_selection

        // appraisal_ratings

        // module_flag

        // isactive

        // createdby

        // modifiedby

        // createddate

        // modifieddate

        // id
        $this->id->ViewValue = $this->id->CurrentValue;
        $this->id->ViewCustomAttributes = "";

        // tenant_id
        $this->tenant_id->ViewValue = $this->tenant_id->CurrentValue;
        $this->tenant_id->ViewValue = FormatNumber($this->tenant_id->ViewValue, "");
        $this->tenant_id->ViewCustomAttributes = "";

        // businessunit_id
        $this->businessunit_id->ViewValue = $this->businessunit_id->CurrentValue;
        $this->businessunit_id->ViewValue = FormatNumber($this->businessunit_id->ViewValue, "");
        $this->businessunit_id->ViewCustomAttributes = "";

        // department_id
        $this->department_id->ViewValue = $this->department_id->CurrentValue;
        $this->department_id->ViewValue = FormatNumber($this->department_id->ViewValue, "");
        $this->department_id->ViewCustomAttributes = "";

        // performance_app_flag
        $this->performance_app_flag->ViewValue = $this->performance_app_flag->CurrentValue;
        $this->performance_app_flag->ViewValue = FormatNumber($this->performance_app_flag->ViewValue, "");
        $this->performance_app_flag->ViewCustomAttributes = "";

        // appraisal_mode
        if (strval($this->appraisal_mode->CurrentValue) != "") {
            $this->appraisal_mode->ViewValue = $this->appraisal_mode->optionCaption($this->appraisal_mode->CurrentValue);
        } else {
            $this->appraisal_mode->ViewValue = null;
        }
        $this->appraisal_mode->ViewCustomAttributes = "";

        // approval_selection
        $this->approval_selection->ViewValue = $this->approval_selection->CurrentValue;
        $this->approval_selection->ViewValue = FormatNumber($this->approval_selection->ViewValue, "");
        $this->approval_selection->ViewCustomAttributes = "";

        // appraisal_ratings
        $this->appraisal_ratings->ViewValue = $this->appraisal_ratings->CurrentValue;
        $this->appraisal_ratings->ViewValue = FormatNumber($this->appraisal_ratings->ViewValue, "");
        $this->appraisal_ratings->ViewCustomAttributes = "";

        // module_flag
        $this->module_flag->ViewValue = $this->module_flag->CurrentValue;
        $this->module_flag->ViewValue = FormatNumber($this->module_flag->ViewValue, "");
        $this->module_flag->ViewCustomAttributes = "";

        // isactive
        $this->isactive->ViewValue = $this->isactive->CurrentValue;
        $this->isactive->ViewValue = FormatNumber($this->isactive->ViewValue, "");
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

        // tenant_id
        $this->tenant_id->LinkCustomAttributes = "";
        $this->tenant_id->HrefValue = "";
        $this->tenant_id->TooltipValue = "";

        // businessunit_id
        $this->businessunit_id->LinkCustomAttributes = "";
        $this->businessunit_id->HrefValue = "";
        $this->businessunit_id->TooltipValue = "";

        // department_id
        $this->department_id->LinkCustomAttributes = "";
        $this->department_id->HrefValue = "";
        $this->department_id->TooltipValue = "";

        // performance_app_flag
        $this->performance_app_flag->LinkCustomAttributes = "";
        $this->performance_app_flag->HrefValue = "";
        $this->performance_app_flag->TooltipValue = "";

        // appraisal_mode
        $this->appraisal_mode->LinkCustomAttributes = "";
        $this->appraisal_mode->HrefValue = "";
        $this->appraisal_mode->TooltipValue = "";

        // approval_selection
        $this->approval_selection->LinkCustomAttributes = "";
        $this->approval_selection->HrefValue = "";
        $this->approval_selection->TooltipValue = "";

        // appraisal_ratings
        $this->appraisal_ratings->LinkCustomAttributes = "";
        $this->appraisal_ratings->HrefValue = "";
        $this->appraisal_ratings->TooltipValue = "";

        // module_flag
        $this->module_flag->LinkCustomAttributes = "";
        $this->module_flag->HrefValue = "";
        $this->module_flag->TooltipValue = "";

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

        // tenant_id
        $this->tenant_id->setupEditAttributes();
        $this->tenant_id->EditCustomAttributes = "";
        $this->tenant_id->EditValue = $this->tenant_id->CurrentValue;
        $this->tenant_id->PlaceHolder = RemoveHtml($this->tenant_id->caption());
        if (strval($this->tenant_id->EditValue) != "" && is_numeric($this->tenant_id->EditValue)) {
            $this->tenant_id->EditValue = FormatNumber($this->tenant_id->EditValue, null);
        }

        // businessunit_id
        $this->businessunit_id->setupEditAttributes();
        $this->businessunit_id->EditCustomAttributes = "";
        $this->businessunit_id->EditValue = $this->businessunit_id->CurrentValue;
        $this->businessunit_id->PlaceHolder = RemoveHtml($this->businessunit_id->caption());
        if (strval($this->businessunit_id->EditValue) != "" && is_numeric($this->businessunit_id->EditValue)) {
            $this->businessunit_id->EditValue = FormatNumber($this->businessunit_id->EditValue, null);
        }

        // department_id
        $this->department_id->setupEditAttributes();
        $this->department_id->EditCustomAttributes = "";
        $this->department_id->EditValue = $this->department_id->CurrentValue;
        $this->department_id->PlaceHolder = RemoveHtml($this->department_id->caption());
        if (strval($this->department_id->EditValue) != "" && is_numeric($this->department_id->EditValue)) {
            $this->department_id->EditValue = FormatNumber($this->department_id->EditValue, null);
        }

        // performance_app_flag
        $this->performance_app_flag->setupEditAttributes();
        $this->performance_app_flag->EditCustomAttributes = "";
        $this->performance_app_flag->EditValue = $this->performance_app_flag->CurrentValue;
        $this->performance_app_flag->PlaceHolder = RemoveHtml($this->performance_app_flag->caption());
        if (strval($this->performance_app_flag->EditValue) != "" && is_numeric($this->performance_app_flag->EditValue)) {
            $this->performance_app_flag->EditValue = FormatNumber($this->performance_app_flag->EditValue, null);
        }

        // appraisal_mode
        $this->appraisal_mode->EditCustomAttributes = "";
        $this->appraisal_mode->EditValue = $this->appraisal_mode->options(false);
        $this->appraisal_mode->PlaceHolder = RemoveHtml($this->appraisal_mode->caption());

        // approval_selection
        $this->approval_selection->setupEditAttributes();
        $this->approval_selection->EditCustomAttributes = "";
        $this->approval_selection->EditValue = $this->approval_selection->CurrentValue;
        $this->approval_selection->PlaceHolder = RemoveHtml($this->approval_selection->caption());
        if (strval($this->approval_selection->EditValue) != "" && is_numeric($this->approval_selection->EditValue)) {
            $this->approval_selection->EditValue = FormatNumber($this->approval_selection->EditValue, null);
        }

        // appraisal_ratings
        $this->appraisal_ratings->setupEditAttributes();
        $this->appraisal_ratings->EditCustomAttributes = "";
        $this->appraisal_ratings->EditValue = $this->appraisal_ratings->CurrentValue;
        $this->appraisal_ratings->PlaceHolder = RemoveHtml($this->appraisal_ratings->caption());
        if (strval($this->appraisal_ratings->EditValue) != "" && is_numeric($this->appraisal_ratings->EditValue)) {
            $this->appraisal_ratings->EditValue = FormatNumber($this->appraisal_ratings->EditValue, null);
        }

        // module_flag
        $this->module_flag->setupEditAttributes();
        $this->module_flag->EditCustomAttributes = "";
        $this->module_flag->EditValue = $this->module_flag->CurrentValue;
        $this->module_flag->PlaceHolder = RemoveHtml($this->module_flag->caption());
        if (strval($this->module_flag->EditValue) != "" && is_numeric($this->module_flag->EditValue)) {
            $this->module_flag->EditValue = FormatNumber($this->module_flag->EditValue, null);
        }

        // isactive
        $this->isactive->setupEditAttributes();
        $this->isactive->EditCustomAttributes = "";
        $this->isactive->EditValue = $this->isactive->CurrentValue;
        $this->isactive->PlaceHolder = RemoveHtml($this->isactive->caption());
        if (strval($this->isactive->EditValue) != "" && is_numeric($this->isactive->EditValue)) {
            $this->isactive->EditValue = FormatNumber($this->isactive->EditValue, null);
        }

        // createdby
        $this->createdby->setupEditAttributes();
        $this->createdby->EditCustomAttributes = "";
        $this->createdby->EditValue = $this->createdby->CurrentValue;
        $this->createdby->PlaceHolder = RemoveHtml($this->createdby->caption());
        if (strval($this->createdby->EditValue) != "" && is_numeric($this->createdby->EditValue)) {
            $this->createdby->EditValue = FormatNumber($this->createdby->EditValue, null);
        }

        // modifiedby
        $this->modifiedby->setupEditAttributes();
        $this->modifiedby->EditCustomAttributes = "";
        $this->modifiedby->EditValue = $this->modifiedby->CurrentValue;
        $this->modifiedby->PlaceHolder = RemoveHtml($this->modifiedby->caption());
        if (strval($this->modifiedby->EditValue) != "" && is_numeric($this->modifiedby->EditValue)) {
            $this->modifiedby->EditValue = FormatNumber($this->modifiedby->EditValue, null);
        }

        // createddate
        $this->createddate->setupEditAttributes();
        $this->createddate->EditCustomAttributes = "";
        $this->createddate->EditValue = FormatDateTime($this->createddate->CurrentValue, 8);
        $this->createddate->PlaceHolder = RemoveHtml($this->createddate->caption());

        // modifieddate
        $this->modifieddate->setupEditAttributes();
        $this->modifieddate->EditCustomAttributes = "";
        $this->modifieddate->EditValue = FormatDateTime($this->modifieddate->CurrentValue, 8);
        $this->modifieddate->PlaceHolder = RemoveHtml($this->modifieddate->caption());

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
                    $doc->exportCaption($this->tenant_id);
                    $doc->exportCaption($this->businessunit_id);
                    $doc->exportCaption($this->department_id);
                    $doc->exportCaption($this->performance_app_flag);
                    $doc->exportCaption($this->appraisal_mode);
                    $doc->exportCaption($this->approval_selection);
                    $doc->exportCaption($this->appraisal_ratings);
                    $doc->exportCaption($this->module_flag);
                    $doc->exportCaption($this->isactive);
                    $doc->exportCaption($this->createdby);
                    $doc->exportCaption($this->modifiedby);
                    $doc->exportCaption($this->createddate);
                    $doc->exportCaption($this->modifieddate);
                } else {
                    $doc->exportCaption($this->id);
                    $doc->exportCaption($this->tenant_id);
                    $doc->exportCaption($this->businessunit_id);
                    $doc->exportCaption($this->department_id);
                    $doc->exportCaption($this->performance_app_flag);
                    $doc->exportCaption($this->appraisal_mode);
                    $doc->exportCaption($this->approval_selection);
                    $doc->exportCaption($this->appraisal_ratings);
                    $doc->exportCaption($this->module_flag);
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
                        $doc->exportField($this->tenant_id);
                        $doc->exportField($this->businessunit_id);
                        $doc->exportField($this->department_id);
                        $doc->exportField($this->performance_app_flag);
                        $doc->exportField($this->appraisal_mode);
                        $doc->exportField($this->approval_selection);
                        $doc->exportField($this->appraisal_ratings);
                        $doc->exportField($this->module_flag);
                        $doc->exportField($this->isactive);
                        $doc->exportField($this->createdby);
                        $doc->exportField($this->modifiedby);
                        $doc->exportField($this->createddate);
                        $doc->exportField($this->modifieddate);
                    } else {
                        $doc->exportField($this->id);
                        $doc->exportField($this->tenant_id);
                        $doc->exportField($this->businessunit_id);
                        $doc->exportField($this->department_id);
                        $doc->exportField($this->performance_app_flag);
                        $doc->exportField($this->appraisal_mode);
                        $doc->exportField($this->approval_selection);
                        $doc->exportField($this->appraisal_ratings);
                        $doc->exportField($this->module_flag);
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
        $table = 'main_pa_implementation';
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
        $table = 'main_pa_implementation';

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
        $table = 'main_pa_implementation';

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
        $table = 'main_pa_implementation';

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
