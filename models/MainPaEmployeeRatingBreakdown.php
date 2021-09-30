<?php

namespace PHPMaker2022\wfg_appraisal;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Table class for main_pa_employee_rating_breakdown
 */
class MainPaEmployeeRatingBreakdown extends DbTable
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
    public $AuditTrailOnAdd = false;
    public $AuditTrailOnEdit = false;
    public $AuditTrailOnDelete = false;
    public $AuditTrailOnView = false;
    public $AuditTrailOnViewData = false;
    public $AuditTrailOnSearch = false;

    // Export
    public $ExportDoc;

    // Fields
    public $id;
    public $tenant_id;
    public $pa_emp_rating_id;
    public $pa_initialization_id;
    public $employee_id;
    public $pa_category_id;
    public $pa_question_id;
    public $emp_comment;
    public $emp_rating_id;
    public $emp_rating_value;
    public $manager_comment;
    public $manager_rating_id;
    public $manager_rating_value;
    public $created_at;
    public $updated_at;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage, $CurrentLocale;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'main_pa_employee_rating_breakdown';
        $this->TableName = 'main_pa_employee_rating_breakdown';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "`main_pa_employee_rating_breakdown`";
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

        // id
        $this->id = new DbField(
            'main_pa_employee_rating_breakdown',
            'main_pa_employee_rating_breakdown',
            'x_id',
            'id',
            '`id`',
            '`id`',
            3,
            11,
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
            'main_pa_employee_rating_breakdown',
            'main_pa_employee_rating_breakdown',
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
        $this->tenant_id->Nullable = false; // NOT NULL field
        $this->tenant_id->Required = true; // Required field
        $this->tenant_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['tenant_id'] = &$this->tenant_id;

        // pa_emp_rating_id
        $this->pa_emp_rating_id = new DbField(
            'main_pa_employee_rating_breakdown',
            'main_pa_employee_rating_breakdown',
            'x_pa_emp_rating_id',
            'pa_emp_rating_id',
            '`pa_emp_rating_id`',
            '`pa_emp_rating_id`',
            3,
            11,
            -1,
            false,
            '`pa_emp_rating_id`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->pa_emp_rating_id->InputTextType = "text";
        $this->pa_emp_rating_id->Nullable = false; // NOT NULL field
        $this->pa_emp_rating_id->Required = true; // Required field
        $this->pa_emp_rating_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['pa_emp_rating_id'] = &$this->pa_emp_rating_id;

        // pa_initialization_id
        $this->pa_initialization_id = new DbField(
            'main_pa_employee_rating_breakdown',
            'main_pa_employee_rating_breakdown',
            'x_pa_initialization_id',
            'pa_initialization_id',
            '`pa_initialization_id`',
            '`pa_initialization_id`',
            3,
            11,
            -1,
            false,
            '`pa_initialization_id`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->pa_initialization_id->InputTextType = "text";
        $this->pa_initialization_id->Nullable = false; // NOT NULL field
        $this->pa_initialization_id->Required = true; // Required field
        $this->pa_initialization_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['pa_initialization_id'] = &$this->pa_initialization_id;

        // employee_id
        $this->employee_id = new DbField(
            'main_pa_employee_rating_breakdown',
            'main_pa_employee_rating_breakdown',
            'x_employee_id',
            'employee_id',
            '`employee_id`',
            '`employee_id`',
            3,
            11,
            -1,
            false,
            '`employee_id`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->employee_id->InputTextType = "text";
        $this->employee_id->Nullable = false; // NOT NULL field
        $this->employee_id->Required = true; // Required field
        $this->employee_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['employee_id'] = &$this->employee_id;

        // pa_category_id
        $this->pa_category_id = new DbField(
            'main_pa_employee_rating_breakdown',
            'main_pa_employee_rating_breakdown',
            'x_pa_category_id',
            'pa_category_id',
            '`pa_category_id`',
            '`pa_category_id`',
            3,
            11,
            -1,
            false,
            '`pa_category_id`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->pa_category_id->InputTextType = "text";
        $this->pa_category_id->Nullable = false; // NOT NULL field
        $this->pa_category_id->Required = true; // Required field
        $this->pa_category_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['pa_category_id'] = &$this->pa_category_id;

        // pa_question_id
        $this->pa_question_id = new DbField(
            'main_pa_employee_rating_breakdown',
            'main_pa_employee_rating_breakdown',
            'x_pa_question_id',
            'pa_question_id',
            '`pa_question_id`',
            '`pa_question_id`',
            3,
            11,
            -1,
            false,
            '`pa_question_id`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->pa_question_id->InputTextType = "text";
        $this->pa_question_id->Nullable = false; // NOT NULL field
        $this->pa_question_id->Required = true; // Required field
        $this->pa_question_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['pa_question_id'] = &$this->pa_question_id;

        // emp_comment
        $this->emp_comment = new DbField(
            'main_pa_employee_rating_breakdown',
            'main_pa_employee_rating_breakdown',
            'x_emp_comment',
            'emp_comment',
            '`emp_comment`',
            '`emp_comment`',
            201,
            65535,
            -1,
            false,
            '`emp_comment`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXTAREA'
        );
        $this->emp_comment->InputTextType = "text";
        $this->Fields['emp_comment'] = &$this->emp_comment;

        // emp_rating_id
        $this->emp_rating_id = new DbField(
            'main_pa_employee_rating_breakdown',
            'main_pa_employee_rating_breakdown',
            'x_emp_rating_id',
            'emp_rating_id',
            '`emp_rating_id`',
            '`emp_rating_id`',
            3,
            11,
            -1,
            false,
            '`emp_rating_id`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->emp_rating_id->InputTextType = "text";
        $this->emp_rating_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['emp_rating_id'] = &$this->emp_rating_id;

        // emp_rating_value
        $this->emp_rating_value = new DbField(
            'main_pa_employee_rating_breakdown',
            'main_pa_employee_rating_breakdown',
            'x_emp_rating_value',
            'emp_rating_value',
            '`emp_rating_value`',
            '`emp_rating_value`',
            3,
            11,
            -1,
            false,
            '`emp_rating_value`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->emp_rating_value->InputTextType = "text";
        $this->emp_rating_value->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['emp_rating_value'] = &$this->emp_rating_value;

        // manager_comment
        $this->manager_comment = new DbField(
            'main_pa_employee_rating_breakdown',
            'main_pa_employee_rating_breakdown',
            'x_manager_comment',
            'manager_comment',
            '`manager_comment`',
            '`manager_comment`',
            201,
            65535,
            -1,
            false,
            '`manager_comment`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXTAREA'
        );
        $this->manager_comment->InputTextType = "text";
        $this->Fields['manager_comment'] = &$this->manager_comment;

        // manager_rating_id
        $this->manager_rating_id = new DbField(
            'main_pa_employee_rating_breakdown',
            'main_pa_employee_rating_breakdown',
            'x_manager_rating_id',
            'manager_rating_id',
            '`manager_rating_id`',
            '`manager_rating_id`',
            3,
            11,
            -1,
            false,
            '`manager_rating_id`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->manager_rating_id->InputTextType = "text";
        $this->manager_rating_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['manager_rating_id'] = &$this->manager_rating_id;

        // manager_rating_value
        $this->manager_rating_value = new DbField(
            'main_pa_employee_rating_breakdown',
            'main_pa_employee_rating_breakdown',
            'x_manager_rating_value',
            'manager_rating_value',
            '`manager_rating_value`',
            '`manager_rating_value`',
            3,
            11,
            -1,
            false,
            '`manager_rating_value`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->manager_rating_value->InputTextType = "text";
        $this->manager_rating_value->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['manager_rating_value'] = &$this->manager_rating_value;

        // created_at
        $this->created_at = new DbField(
            'main_pa_employee_rating_breakdown',
            'main_pa_employee_rating_breakdown',
            'x_created_at',
            'created_at',
            '`created_at`',
            CastDateFieldForLike("`created_at`", 0, "DB"),
            135,
            19,
            0,
            false,
            '`created_at`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->created_at->InputTextType = "text";
        $this->created_at->Nullable = false; // NOT NULL field
        $this->created_at->Required = true; // Required field
        $this->created_at->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->Fields['created_at'] = &$this->created_at;

        // updated_at
        $this->updated_at = new DbField(
            'main_pa_employee_rating_breakdown',
            'main_pa_employee_rating_breakdown',
            'x_updated_at',
            'updated_at',
            '`updated_at`',
            CastDateFieldForLike("`updated_at`", 0, "DB"),
            135,
            19,
            0,
            false,
            '`updated_at`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->updated_at->InputTextType = "text";
        $this->updated_at->Nullable = false; // NOT NULL field
        $this->updated_at->Required = true; // Required field
        $this->updated_at->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->Fields['updated_at'] = &$this->updated_at;

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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "`main_pa_employee_rating_breakdown`";
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
        $this->pa_emp_rating_id->DbValue = $row['pa_emp_rating_id'];
        $this->pa_initialization_id->DbValue = $row['pa_initialization_id'];
        $this->employee_id->DbValue = $row['employee_id'];
        $this->pa_category_id->DbValue = $row['pa_category_id'];
        $this->pa_question_id->DbValue = $row['pa_question_id'];
        $this->emp_comment->DbValue = $row['emp_comment'];
        $this->emp_rating_id->DbValue = $row['emp_rating_id'];
        $this->emp_rating_value->DbValue = $row['emp_rating_value'];
        $this->manager_comment->DbValue = $row['manager_comment'];
        $this->manager_rating_id->DbValue = $row['manager_rating_id'];
        $this->manager_rating_value->DbValue = $row['manager_rating_value'];
        $this->created_at->DbValue = $row['created_at'];
        $this->updated_at->DbValue = $row['updated_at'];
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
        return $_SESSION[$name] ?? GetUrl("mainpaemployeeratingbreakdownlist");
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
        if ($pageName == "mainpaemployeeratingbreakdownview") {
            return $Language->phrase("View");
        } elseif ($pageName == "mainpaemployeeratingbreakdownedit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "mainpaemployeeratingbreakdownadd") {
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
                return "MainPaEmployeeRatingBreakdownView";
            case Config("API_ADD_ACTION"):
                return "MainPaEmployeeRatingBreakdownAdd";
            case Config("API_EDIT_ACTION"):
                return "MainPaEmployeeRatingBreakdownEdit";
            case Config("API_DELETE_ACTION"):
                return "MainPaEmployeeRatingBreakdownDelete";
            case Config("API_LIST_ACTION"):
                return "MainPaEmployeeRatingBreakdownList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "mainpaemployeeratingbreakdownlist";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("mainpaemployeeratingbreakdownview", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("mainpaemployeeratingbreakdownview", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "mainpaemployeeratingbreakdownadd?" . $this->getUrlParm($parm);
        } else {
            $url = "mainpaemployeeratingbreakdownadd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("mainpaemployeeratingbreakdownedit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("mainpaemployeeratingbreakdownadd", $this->getUrlParm($parm));
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
        return $this->keyUrl("mainpaemployeeratingbreakdowndelete", $this->getUrlParm());
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
        $this->pa_emp_rating_id->setDbValue($row['pa_emp_rating_id']);
        $this->pa_initialization_id->setDbValue($row['pa_initialization_id']);
        $this->employee_id->setDbValue($row['employee_id']);
        $this->pa_category_id->setDbValue($row['pa_category_id']);
        $this->pa_question_id->setDbValue($row['pa_question_id']);
        $this->emp_comment->setDbValue($row['emp_comment']);
        $this->emp_rating_id->setDbValue($row['emp_rating_id']);
        $this->emp_rating_value->setDbValue($row['emp_rating_value']);
        $this->manager_comment->setDbValue($row['manager_comment']);
        $this->manager_rating_id->setDbValue($row['manager_rating_id']);
        $this->manager_rating_value->setDbValue($row['manager_rating_value']);
        $this->created_at->setDbValue($row['created_at']);
        $this->updated_at->setDbValue($row['updated_at']);
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

        // pa_emp_rating_id

        // pa_initialization_id

        // employee_id

        // pa_category_id

        // pa_question_id

        // emp_comment

        // emp_rating_id

        // emp_rating_value

        // manager_comment

        // manager_rating_id

        // manager_rating_value

        // created_at

        // updated_at

        // id
        $this->id->ViewValue = $this->id->CurrentValue;
        $this->id->ViewCustomAttributes = "";

        // tenant_id
        $this->tenant_id->ViewValue = $this->tenant_id->CurrentValue;
        $this->tenant_id->ViewValue = FormatNumber($this->tenant_id->ViewValue, "");
        $this->tenant_id->ViewCustomAttributes = "";

        // pa_emp_rating_id
        $this->pa_emp_rating_id->ViewValue = $this->pa_emp_rating_id->CurrentValue;
        $this->pa_emp_rating_id->ViewValue = FormatNumber($this->pa_emp_rating_id->ViewValue, "");
        $this->pa_emp_rating_id->ViewCustomAttributes = "";

        // pa_initialization_id
        $this->pa_initialization_id->ViewValue = $this->pa_initialization_id->CurrentValue;
        $this->pa_initialization_id->ViewValue = FormatNumber($this->pa_initialization_id->ViewValue, "");
        $this->pa_initialization_id->ViewCustomAttributes = "";

        // employee_id
        $this->employee_id->ViewValue = $this->employee_id->CurrentValue;
        $this->employee_id->ViewValue = FormatNumber($this->employee_id->ViewValue, "");
        $this->employee_id->ViewCustomAttributes = "";

        // pa_category_id
        $this->pa_category_id->ViewValue = $this->pa_category_id->CurrentValue;
        $this->pa_category_id->ViewValue = FormatNumber($this->pa_category_id->ViewValue, "");
        $this->pa_category_id->ViewCustomAttributes = "";

        // pa_question_id
        $this->pa_question_id->ViewValue = $this->pa_question_id->CurrentValue;
        $this->pa_question_id->ViewValue = FormatNumber($this->pa_question_id->ViewValue, "");
        $this->pa_question_id->ViewCustomAttributes = "";

        // emp_comment
        $this->emp_comment->ViewValue = $this->emp_comment->CurrentValue;
        $this->emp_comment->ViewCustomAttributes = "";

        // emp_rating_id
        $this->emp_rating_id->ViewValue = $this->emp_rating_id->CurrentValue;
        $this->emp_rating_id->ViewValue = FormatNumber($this->emp_rating_id->ViewValue, "");
        $this->emp_rating_id->ViewCustomAttributes = "";

        // emp_rating_value
        $this->emp_rating_value->ViewValue = $this->emp_rating_value->CurrentValue;
        $this->emp_rating_value->ViewValue = FormatNumber($this->emp_rating_value->ViewValue, "");
        $this->emp_rating_value->ViewCustomAttributes = "";

        // manager_comment
        $this->manager_comment->ViewValue = $this->manager_comment->CurrentValue;
        $this->manager_comment->ViewCustomAttributes = "";

        // manager_rating_id
        $this->manager_rating_id->ViewValue = $this->manager_rating_id->CurrentValue;
        $this->manager_rating_id->ViewValue = FormatNumber($this->manager_rating_id->ViewValue, "");
        $this->manager_rating_id->ViewCustomAttributes = "";

        // manager_rating_value
        $this->manager_rating_value->ViewValue = $this->manager_rating_value->CurrentValue;
        $this->manager_rating_value->ViewValue = FormatNumber($this->manager_rating_value->ViewValue, "");
        $this->manager_rating_value->ViewCustomAttributes = "";

        // created_at
        $this->created_at->ViewValue = $this->created_at->CurrentValue;
        $this->created_at->ViewValue = FormatDateTime($this->created_at->ViewValue, 0);
        $this->created_at->ViewCustomAttributes = "";

        // updated_at
        $this->updated_at->ViewValue = $this->updated_at->CurrentValue;
        $this->updated_at->ViewValue = FormatDateTime($this->updated_at->ViewValue, 0);
        $this->updated_at->ViewCustomAttributes = "";

        // id
        $this->id->LinkCustomAttributes = "";
        $this->id->HrefValue = "";
        $this->id->TooltipValue = "";

        // tenant_id
        $this->tenant_id->LinkCustomAttributes = "";
        $this->tenant_id->HrefValue = "";
        $this->tenant_id->TooltipValue = "";

        // pa_emp_rating_id
        $this->pa_emp_rating_id->LinkCustomAttributes = "";
        $this->pa_emp_rating_id->HrefValue = "";
        $this->pa_emp_rating_id->TooltipValue = "";

        // pa_initialization_id
        $this->pa_initialization_id->LinkCustomAttributes = "";
        $this->pa_initialization_id->HrefValue = "";
        $this->pa_initialization_id->TooltipValue = "";

        // employee_id
        $this->employee_id->LinkCustomAttributes = "";
        $this->employee_id->HrefValue = "";
        $this->employee_id->TooltipValue = "";

        // pa_category_id
        $this->pa_category_id->LinkCustomAttributes = "";
        $this->pa_category_id->HrefValue = "";
        $this->pa_category_id->TooltipValue = "";

        // pa_question_id
        $this->pa_question_id->LinkCustomAttributes = "";
        $this->pa_question_id->HrefValue = "";
        $this->pa_question_id->TooltipValue = "";

        // emp_comment
        $this->emp_comment->LinkCustomAttributes = "";
        $this->emp_comment->HrefValue = "";
        $this->emp_comment->TooltipValue = "";

        // emp_rating_id
        $this->emp_rating_id->LinkCustomAttributes = "";
        $this->emp_rating_id->HrefValue = "";
        $this->emp_rating_id->TooltipValue = "";

        // emp_rating_value
        $this->emp_rating_value->LinkCustomAttributes = "";
        $this->emp_rating_value->HrefValue = "";
        $this->emp_rating_value->TooltipValue = "";

        // manager_comment
        $this->manager_comment->LinkCustomAttributes = "";
        $this->manager_comment->HrefValue = "";
        $this->manager_comment->TooltipValue = "";

        // manager_rating_id
        $this->manager_rating_id->LinkCustomAttributes = "";
        $this->manager_rating_id->HrefValue = "";
        $this->manager_rating_id->TooltipValue = "";

        // manager_rating_value
        $this->manager_rating_value->LinkCustomAttributes = "";
        $this->manager_rating_value->HrefValue = "";
        $this->manager_rating_value->TooltipValue = "";

        // created_at
        $this->created_at->LinkCustomAttributes = "";
        $this->created_at->HrefValue = "";
        $this->created_at->TooltipValue = "";

        // updated_at
        $this->updated_at->LinkCustomAttributes = "";
        $this->updated_at->HrefValue = "";
        $this->updated_at->TooltipValue = "";

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

        // pa_emp_rating_id
        $this->pa_emp_rating_id->setupEditAttributes();
        $this->pa_emp_rating_id->EditCustomAttributes = "";
        $this->pa_emp_rating_id->EditValue = $this->pa_emp_rating_id->CurrentValue;
        $this->pa_emp_rating_id->PlaceHolder = RemoveHtml($this->pa_emp_rating_id->caption());
        if (strval($this->pa_emp_rating_id->EditValue) != "" && is_numeric($this->pa_emp_rating_id->EditValue)) {
            $this->pa_emp_rating_id->EditValue = FormatNumber($this->pa_emp_rating_id->EditValue, null);
        }

        // pa_initialization_id
        $this->pa_initialization_id->setupEditAttributes();
        $this->pa_initialization_id->EditCustomAttributes = "";
        $this->pa_initialization_id->EditValue = $this->pa_initialization_id->CurrentValue;
        $this->pa_initialization_id->PlaceHolder = RemoveHtml($this->pa_initialization_id->caption());
        if (strval($this->pa_initialization_id->EditValue) != "" && is_numeric($this->pa_initialization_id->EditValue)) {
            $this->pa_initialization_id->EditValue = FormatNumber($this->pa_initialization_id->EditValue, null);
        }

        // employee_id
        $this->employee_id->setupEditAttributes();
        $this->employee_id->EditCustomAttributes = "";
        $this->employee_id->EditValue = $this->employee_id->CurrentValue;
        $this->employee_id->PlaceHolder = RemoveHtml($this->employee_id->caption());
        if (strval($this->employee_id->EditValue) != "" && is_numeric($this->employee_id->EditValue)) {
            $this->employee_id->EditValue = FormatNumber($this->employee_id->EditValue, null);
        }

        // pa_category_id
        $this->pa_category_id->setupEditAttributes();
        $this->pa_category_id->EditCustomAttributes = "";
        $this->pa_category_id->EditValue = $this->pa_category_id->CurrentValue;
        $this->pa_category_id->PlaceHolder = RemoveHtml($this->pa_category_id->caption());
        if (strval($this->pa_category_id->EditValue) != "" && is_numeric($this->pa_category_id->EditValue)) {
            $this->pa_category_id->EditValue = FormatNumber($this->pa_category_id->EditValue, null);
        }

        // pa_question_id
        $this->pa_question_id->setupEditAttributes();
        $this->pa_question_id->EditCustomAttributes = "";
        $this->pa_question_id->EditValue = $this->pa_question_id->CurrentValue;
        $this->pa_question_id->PlaceHolder = RemoveHtml($this->pa_question_id->caption());
        if (strval($this->pa_question_id->EditValue) != "" && is_numeric($this->pa_question_id->EditValue)) {
            $this->pa_question_id->EditValue = FormatNumber($this->pa_question_id->EditValue, null);
        }

        // emp_comment
        $this->emp_comment->setupEditAttributes();
        $this->emp_comment->EditCustomAttributes = "";
        $this->emp_comment->EditValue = $this->emp_comment->CurrentValue;
        $this->emp_comment->PlaceHolder = RemoveHtml($this->emp_comment->caption());

        // emp_rating_id
        $this->emp_rating_id->setupEditAttributes();
        $this->emp_rating_id->EditCustomAttributes = "";
        $this->emp_rating_id->EditValue = $this->emp_rating_id->CurrentValue;
        $this->emp_rating_id->PlaceHolder = RemoveHtml($this->emp_rating_id->caption());
        if (strval($this->emp_rating_id->EditValue) != "" && is_numeric($this->emp_rating_id->EditValue)) {
            $this->emp_rating_id->EditValue = FormatNumber($this->emp_rating_id->EditValue, null);
        }

        // emp_rating_value
        $this->emp_rating_value->setupEditAttributes();
        $this->emp_rating_value->EditCustomAttributes = "";
        $this->emp_rating_value->EditValue = $this->emp_rating_value->CurrentValue;
        $this->emp_rating_value->PlaceHolder = RemoveHtml($this->emp_rating_value->caption());
        if (strval($this->emp_rating_value->EditValue) != "" && is_numeric($this->emp_rating_value->EditValue)) {
            $this->emp_rating_value->EditValue = FormatNumber($this->emp_rating_value->EditValue, null);
        }

        // manager_comment
        $this->manager_comment->setupEditAttributes();
        $this->manager_comment->EditCustomAttributes = "";
        $this->manager_comment->EditValue = $this->manager_comment->CurrentValue;
        $this->manager_comment->PlaceHolder = RemoveHtml($this->manager_comment->caption());

        // manager_rating_id
        $this->manager_rating_id->setupEditAttributes();
        $this->manager_rating_id->EditCustomAttributes = "";
        $this->manager_rating_id->EditValue = $this->manager_rating_id->CurrentValue;
        $this->manager_rating_id->PlaceHolder = RemoveHtml($this->manager_rating_id->caption());
        if (strval($this->manager_rating_id->EditValue) != "" && is_numeric($this->manager_rating_id->EditValue)) {
            $this->manager_rating_id->EditValue = FormatNumber($this->manager_rating_id->EditValue, null);
        }

        // manager_rating_value
        $this->manager_rating_value->setupEditAttributes();
        $this->manager_rating_value->EditCustomAttributes = "";
        $this->manager_rating_value->EditValue = $this->manager_rating_value->CurrentValue;
        $this->manager_rating_value->PlaceHolder = RemoveHtml($this->manager_rating_value->caption());
        if (strval($this->manager_rating_value->EditValue) != "" && is_numeric($this->manager_rating_value->EditValue)) {
            $this->manager_rating_value->EditValue = FormatNumber($this->manager_rating_value->EditValue, null);
        }

        // created_at
        $this->created_at->setupEditAttributes();
        $this->created_at->EditCustomAttributes = "";
        $this->created_at->EditValue = FormatDateTime($this->created_at->CurrentValue, 8);
        $this->created_at->PlaceHolder = RemoveHtml($this->created_at->caption());

        // updated_at
        $this->updated_at->setupEditAttributes();
        $this->updated_at->EditCustomAttributes = "";
        $this->updated_at->EditValue = FormatDateTime($this->updated_at->CurrentValue, 8);
        $this->updated_at->PlaceHolder = RemoveHtml($this->updated_at->caption());

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
                    $doc->exportCaption($this->pa_emp_rating_id);
                    $doc->exportCaption($this->pa_initialization_id);
                    $doc->exportCaption($this->employee_id);
                    $doc->exportCaption($this->pa_category_id);
                    $doc->exportCaption($this->pa_question_id);
                    $doc->exportCaption($this->emp_comment);
                    $doc->exportCaption($this->emp_rating_id);
                    $doc->exportCaption($this->emp_rating_value);
                    $doc->exportCaption($this->manager_comment);
                    $doc->exportCaption($this->manager_rating_id);
                    $doc->exportCaption($this->manager_rating_value);
                    $doc->exportCaption($this->created_at);
                    $doc->exportCaption($this->updated_at);
                } else {
                    $doc->exportCaption($this->id);
                    $doc->exportCaption($this->tenant_id);
                    $doc->exportCaption($this->pa_emp_rating_id);
                    $doc->exportCaption($this->pa_initialization_id);
                    $doc->exportCaption($this->employee_id);
                    $doc->exportCaption($this->pa_category_id);
                    $doc->exportCaption($this->pa_question_id);
                    $doc->exportCaption($this->emp_rating_id);
                    $doc->exportCaption($this->emp_rating_value);
                    $doc->exportCaption($this->manager_rating_id);
                    $doc->exportCaption($this->manager_rating_value);
                    $doc->exportCaption($this->created_at);
                    $doc->exportCaption($this->updated_at);
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
                        $doc->exportField($this->pa_emp_rating_id);
                        $doc->exportField($this->pa_initialization_id);
                        $doc->exportField($this->employee_id);
                        $doc->exportField($this->pa_category_id);
                        $doc->exportField($this->pa_question_id);
                        $doc->exportField($this->emp_comment);
                        $doc->exportField($this->emp_rating_id);
                        $doc->exportField($this->emp_rating_value);
                        $doc->exportField($this->manager_comment);
                        $doc->exportField($this->manager_rating_id);
                        $doc->exportField($this->manager_rating_value);
                        $doc->exportField($this->created_at);
                        $doc->exportField($this->updated_at);
                    } else {
                        $doc->exportField($this->id);
                        $doc->exportField($this->tenant_id);
                        $doc->exportField($this->pa_emp_rating_id);
                        $doc->exportField($this->pa_initialization_id);
                        $doc->exportField($this->employee_id);
                        $doc->exportField($this->pa_category_id);
                        $doc->exportField($this->pa_question_id);
                        $doc->exportField($this->emp_rating_id);
                        $doc->exportField($this->emp_rating_value);
                        $doc->exportField($this->manager_rating_id);
                        $doc->exportField($this->manager_rating_value);
                        $doc->exportField($this->created_at);
                        $doc->exportField($this->updated_at);
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
        $table = 'main_pa_employee_rating_breakdown';
        $usr = CurrentUserID();
        WriteAuditLog($usr, $typ, $table, "", "", "", "");
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
