<?php

namespace PHPMaker2022\wfg_appraisal;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Table class for main_users
 */
class MainUsers extends DbTable
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
    public $emprole;
    public $userstatus;
    public $firstname;
    public $lastname;
    public $userfullname;
    public $emailaddress;
    public $contactnumber;
    public $empipaddress;
    public $backgroundchk_status;
    public $emptemplock;
    public $empreasonlocked;
    public $emplockeddate;
    public $emppassword;
    public $createdby;
    public $modifiedby;
    public $createddate;
    public $modifieddate;
    public $isactive;
    public $staff_ID;
    public $modeofentry;
    public $other_modeofentry;
    public $entrycomments;
    public $selecteddate;
    public $company_id;
    public $profileimg;
    public $jobtitle_id;
    public $tourflag;
    public $themes;
    public $is_admin;
    public $role_id;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage, $CurrentLocale;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'main_users';
        $this->TableName = 'main_users';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "`main_users`";
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
        $this->BasicSearch = new BasicSearch($this->TableVar);

        // id
        $this->id = new DbField(
            'main_users',
            'main_users',
            'x_id',
            'id',
            '`id`',
            '`id`',
            19,
            10,
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

        // emprole
        $this->emprole = new DbField(
            'main_users',
            'main_users',
            'x_emprole',
            'emprole',
            '`emprole`',
            '`emprole`',
            3,
            10,
            -1,
            false,
            '`emprole`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'SELECT'
        );
        $this->emprole->InputTextType = "text";
        $this->emprole->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->emprole->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        $this->emprole->Lookup = new Lookup('emprole', 'userlevels', false, 'userlevelid', ["userlevelname","","",""], [], [], [], [], [], [], '', '', "`userlevelname`");
        $this->emprole->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['emprole'] = &$this->emprole;

        // userstatus
        $this->userstatus = new DbField(
            'main_users',
            'main_users',
            'x_userstatus',
            'userstatus',
            '`userstatus`',
            '`userstatus`',
            202,
            3,
            -1,
            false,
            '`userstatus`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'RADIO'
        );
        $this->userstatus->InputTextType = "text";
        $this->userstatus->Lookup = new Lookup('userstatus', 'main_users', false, '', ["","","",""], [], [], [], [], [], [], '', '', "");
        $this->userstatus->OptionCount = 2;
        $this->Fields['userstatus'] = &$this->userstatus;

        // firstname
        $this->firstname = new DbField(
            'main_users',
            'main_users',
            'x_firstname',
            'firstname',
            '`firstname`',
            '`firstname`',
            200,
            255,
            -1,
            false,
            '`firstname`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->firstname->InputTextType = "text";
        $this->Fields['firstname'] = &$this->firstname;

        // lastname
        $this->lastname = new DbField(
            'main_users',
            'main_users',
            'x_lastname',
            'lastname',
            '`lastname`',
            '`lastname`',
            200,
            255,
            -1,
            false,
            '`lastname`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->lastname->InputTextType = "text";
        $this->Fields['lastname'] = &$this->lastname;

        // userfullname
        $this->userfullname = new DbField(
            'main_users',
            'main_users',
            'x_userfullname',
            'userfullname',
            '`userfullname`',
            '`userfullname`',
            200,
            255,
            -1,
            false,
            '`userfullname`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->userfullname->InputTextType = "text";
        $this->Fields['userfullname'] = &$this->userfullname;

        // emailaddress
        $this->emailaddress = new DbField(
            'main_users',
            'main_users',
            'x_emailaddress',
            'emailaddress',
            '`emailaddress`',
            '`emailaddress`',
            200,
            255,
            -1,
            false,
            '`emailaddress`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->emailaddress->InputTextType = "text";
        $this->emailaddress->Required = true; // Required field
        $this->Fields['emailaddress'] = &$this->emailaddress;

        // contactnumber
        $this->contactnumber = new DbField(
            'main_users',
            'main_users',
            'x_contactnumber',
            'contactnumber',
            '`contactnumber`',
            '`contactnumber`',
            200,
            15,
            -1,
            false,
            '`contactnumber`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->contactnumber->InputTextType = "text";
        $this->Fields['contactnumber'] = &$this->contactnumber;

        // empipaddress
        $this->empipaddress = new DbField(
            'main_users',
            'main_users',
            'x_empipaddress',
            'empipaddress',
            '`empipaddress`',
            '`empipaddress`',
            200,
            255,
            -1,
            false,
            '`empipaddress`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->empipaddress->InputTextType = "text";
        $this->Fields['empipaddress'] = &$this->empipaddress;

        // backgroundchk_status
        $this->backgroundchk_status = new DbField(
            'main_users',
            'main_users',
            'x_backgroundchk_status',
            'backgroundchk_status',
            '`backgroundchk_status`',
            '`backgroundchk_status`',
            202,
            14,
            -1,
            false,
            '`backgroundchk_status`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'RADIO'
        );
        $this->backgroundchk_status->InputTextType = "text";
        $this->backgroundchk_status->Lookup = new Lookup('backgroundchk_status', 'main_users', false, '', ["","","",""], [], [], [], [], [], [], '', '', "");
        $this->backgroundchk_status->OptionCount = 5;
        $this->Fields['backgroundchk_status'] = &$this->backgroundchk_status;

        // emptemplock
        $this->emptemplock = new DbField(
            'main_users',
            'main_users',
            'x_emptemplock',
            'emptemplock',
            '`emptemplock`',
            '`emptemplock`',
            17,
            3,
            -1,
            false,
            '`emptemplock`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->emptemplock->InputTextType = "text";
        $this->emptemplock->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['emptemplock'] = &$this->emptemplock;

        // empreasonlocked
        $this->empreasonlocked = new DbField(
            'main_users',
            'main_users',
            'x_empreasonlocked',
            'empreasonlocked',
            '`empreasonlocked`',
            '`empreasonlocked`',
            200,
            255,
            -1,
            false,
            '`empreasonlocked`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->empreasonlocked->InputTextType = "text";
        $this->Fields['empreasonlocked'] = &$this->empreasonlocked;

        // emplockeddate
        $this->emplockeddate = new DbField(
            'main_users',
            'main_users',
            'x_emplockeddate',
            'emplockeddate',
            '`emplockeddate`',
            CastDateFieldForLike("`emplockeddate`", 0, "DB"),
            133,
            10,
            0,
            false,
            '`emplockeddate`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->emplockeddate->InputTextType = "text";
        $this->emplockeddate->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->Fields['emplockeddate'] = &$this->emplockeddate;

        // emppassword
        $this->emppassword = new DbField(
            'main_users',
            'main_users',
            'x_emppassword',
            'emppassword',
            '`emppassword`',
            '`emppassword`',
            200,
            255,
            -1,
            false,
            '`emppassword`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->emppassword->InputTextType = "text";
        if (Config("ENCRYPTED_PASSWORD")) {
            $this->emppassword->Raw = true;
        }
        $this->emppassword->Required = true; // Required field
        $this->Fields['emppassword'] = &$this->emppassword;

        // createdby
        $this->createdby = new DbField(
            'main_users',
            'main_users',
            'x_createdby',
            'createdby',
            '`createdby`',
            '`createdby`',
            19,
            10,
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
            'main_users',
            'main_users',
            'x_modifiedby',
            'modifiedby',
            '`modifiedby`',
            '`modifiedby`',
            19,
            10,
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
            'main_users',
            'main_users',
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
            'main_users',
            'main_users',
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

        // isactive
        $this->isactive = new DbField(
            'main_users',
            'main_users',
            'x_isactive',
            'isactive',
            '`isactive`',
            '`isactive`',
            18,
            5,
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

        // staff_ID
        $this->staff_ID = new DbField(
            'main_users',
            'main_users',
            'x_staff_ID',
            'staff_ID',
            '`staff_ID`',
            '`staff_ID`',
            200,
            200,
            -1,
            false,
            '`staff_ID`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->staff_ID->InputTextType = "text";
        $this->Fields['staff_ID'] = &$this->staff_ID;

        // modeofentry
        $this->modeofentry = new DbField(
            'main_users',
            'main_users',
            'x_modeofentry',
            'modeofentry',
            '`modeofentry`',
            '`modeofentry`',
            200,
            255,
            -1,
            false,
            '`modeofentry`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->modeofentry->InputTextType = "text";
        $this->Fields['modeofentry'] = &$this->modeofentry;

        // other_modeofentry
        $this->other_modeofentry = new DbField(
            'main_users',
            'main_users',
            'x_other_modeofentry',
            'other_modeofentry',
            '`other_modeofentry`',
            '`other_modeofentry`',
            200,
            255,
            -1,
            false,
            '`other_modeofentry`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->other_modeofentry->InputTextType = "text";
        $this->Fields['other_modeofentry'] = &$this->other_modeofentry;

        // entrycomments
        $this->entrycomments = new DbField(
            'main_users',
            'main_users',
            'x_entrycomments',
            'entrycomments',
            '`entrycomments`',
            '`entrycomments`',
            200,
            255,
            -1,
            false,
            '`entrycomments`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->entrycomments->InputTextType = "text";
        $this->Fields['entrycomments'] = &$this->entrycomments;

        // selecteddate
        $this->selecteddate = new DbField(
            'main_users',
            'main_users',
            'x_selecteddate',
            'selecteddate',
            '`selecteddate`',
            CastDateFieldForLike("`selecteddate`", 0, "DB"),
            133,
            10,
            0,
            false,
            '`selecteddate`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->selecteddate->InputTextType = "text";
        $this->selecteddate->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->Fields['selecteddate'] = &$this->selecteddate;

        // company_id
        $this->company_id = new DbField(
            'main_users',
            'main_users',
            'x_company_id',
            'company_id',
            '`company_id`',
            '`company_id`',
            19,
            10,
            -1,
            false,
            '`company_id`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->company_id->InputTextType = "text";
        $this->company_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['company_id'] = &$this->company_id;

        // profileimg
        $this->profileimg = new DbField(
            'main_users',
            'main_users',
            'x_profileimg',
            'profileimg',
            '`profileimg`',
            '`profileimg`',
            200,
            255,
            -1,
            true,
            '`profileimg`',
            false,
            false,
            false,
            'IMAGE',
            'FILE'
        );
        $this->profileimg->InputTextType = "text";
        $this->Fields['profileimg'] = &$this->profileimg;

        // jobtitle_id
        $this->jobtitle_id = new DbField(
            'main_users',
            'main_users',
            'x_jobtitle_id',
            'jobtitle_id',
            '`jobtitle_id`',
            '`jobtitle_id`',
            21,
            20,
            -1,
            false,
            '`jobtitle_id`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->jobtitle_id->InputTextType = "text";
        $this->jobtitle_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['jobtitle_id'] = &$this->jobtitle_id;

        // tourflag
        $this->tourflag = new DbField(
            'main_users',
            'main_users',
            'x_tourflag',
            'tourflag',
            '`tourflag`',
            '`tourflag`',
            17,
            3,
            -1,
            false,
            '`tourflag`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->tourflag->InputTextType = "text";
        $this->tourflag->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['tourflag'] = &$this->tourflag;

        // themes
        $this->themes = new DbField(
            'main_users',
            'main_users',
            'x_themes',
            'themes',
            '`themes`',
            '`themes`',
            202,
            7,
            -1,
            false,
            '`themes`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'RADIO'
        );
        $this->themes->InputTextType = "text";
        $this->themes->Lookup = new Lookup('themes', 'main_users', false, '', ["","","",""], [], [], [], [], [], [], '', '', "");
        $this->themes->OptionCount = 7;
        $this->Fields['themes'] = &$this->themes;

        // is_admin
        $this->is_admin = new DbField(
            'main_users',
            'main_users',
            'x_is_admin',
            'is_admin',
            '`is_admin`',
            '`is_admin`',
            3,
            11,
            -1,
            false,
            '`is_admin`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->is_admin->InputTextType = "text";
        $this->is_admin->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['is_admin'] = &$this->is_admin;

        // role_id
        $this->role_id = new DbField(
            'main_users',
            'main_users',
            'x_role_id',
            'role_id',
            '`role_id`',
            '`role_id`',
            3,
            11,
            -1,
            false,
            '`role_id`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->role_id->InputTextType = "text";
        $this->role_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['role_id'] = &$this->role_id;

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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "`main_users`";
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
        global $Security;
        // Add User ID filter
        if ($Security->currentUserID() != "" && !$Security->isAdmin()) { // Non system admin
            $filter = $this->addUserIDFilter($filter);
        }
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
            if (Config("ENCRYPTED_PASSWORD") && $name == Config("LOGIN_PASSWORD_FIELD_NAME")) {
                $value = Config("CASE_SENSITIVE_PASSWORD") ? EncryptPassword($value) : EncryptPassword(strtolower($value));
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
            if (Config("ENCRYPTED_PASSWORD") && $name == Config("LOGIN_PASSWORD_FIELD_NAME")) {
                if ($value == $this->Fields[$name]->OldValue) { // No need to update hashed password if not changed
                    continue;
                }
                $value = Config("CASE_SENSITIVE_PASSWORD") ? EncryptPassword($value) : EncryptPassword(strtolower($value));
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
        $this->emprole->DbValue = $row['emprole'];
        $this->userstatus->DbValue = $row['userstatus'];
        $this->firstname->DbValue = $row['firstname'];
        $this->lastname->DbValue = $row['lastname'];
        $this->userfullname->DbValue = $row['userfullname'];
        $this->emailaddress->DbValue = $row['emailaddress'];
        $this->contactnumber->DbValue = $row['contactnumber'];
        $this->empipaddress->DbValue = $row['empipaddress'];
        $this->backgroundchk_status->DbValue = $row['backgroundchk_status'];
        $this->emptemplock->DbValue = $row['emptemplock'];
        $this->empreasonlocked->DbValue = $row['empreasonlocked'];
        $this->emplockeddate->DbValue = $row['emplockeddate'];
        $this->emppassword->DbValue = $row['emppassword'];
        $this->createdby->DbValue = $row['createdby'];
        $this->modifiedby->DbValue = $row['modifiedby'];
        $this->createddate->DbValue = $row['createddate'];
        $this->modifieddate->DbValue = $row['modifieddate'];
        $this->isactive->DbValue = $row['isactive'];
        $this->staff_ID->DbValue = $row['staff_ID'];
        $this->modeofentry->DbValue = $row['modeofentry'];
        $this->other_modeofentry->DbValue = $row['other_modeofentry'];
        $this->entrycomments->DbValue = $row['entrycomments'];
        $this->selecteddate->DbValue = $row['selecteddate'];
        $this->company_id->DbValue = $row['company_id'];
        $this->profileimg->Upload->DbValue = $row['profileimg'];
        $this->jobtitle_id->DbValue = $row['jobtitle_id'];
        $this->tourflag->DbValue = $row['tourflag'];
        $this->themes->DbValue = $row['themes'];
        $this->is_admin->DbValue = $row['is_admin'];
        $this->role_id->DbValue = $row['role_id'];
    }

    // Delete uploaded files
    public function deleteUploadedFiles($row)
    {
        $this->loadDbValues($row);
        $oldFiles = EmptyValue($row['profileimg']) ? [] : [$row['profileimg']];
        foreach ($oldFiles as $oldFile) {
            if (file_exists($this->profileimg->oldPhysicalUploadPath() . $oldFile)) {
                @unlink($this->profileimg->oldPhysicalUploadPath() . $oldFile);
            }
        }
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
        return $_SESSION[$name] ?? GetUrl("mainuserslist");
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
        if ($pageName == "mainusersview") {
            return $Language->phrase("View");
        } elseif ($pageName == "mainusersedit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "mainusersadd") {
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
                return "MainUsersView";
            case Config("API_ADD_ACTION"):
                return "MainUsersAdd";
            case Config("API_EDIT_ACTION"):
                return "MainUsersEdit";
            case Config("API_DELETE_ACTION"):
                return "MainUsersDelete";
            case Config("API_LIST_ACTION"):
                return "MainUsersList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "mainuserslist";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("mainusersview", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("mainusersview", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "mainusersadd?" . $this->getUrlParm($parm);
        } else {
            $url = "mainusersadd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("mainusersedit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("mainusersadd", $this->getUrlParm($parm));
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
        return $this->keyUrl("mainusersdelete", $this->getUrlParm());
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
        $this->jobtitle_id->setDbValue($row['jobtitle_id']);
        $this->tourflag->setDbValue($row['tourflag']);
        $this->themes->setDbValue($row['themes']);
        $this->is_admin->setDbValue($row['is_admin']);
        $this->role_id->setDbValue($row['role_id']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

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

        // emprole
        $this->emprole->LinkCustomAttributes = "";
        $this->emprole->HrefValue = "";
        $this->emprole->TooltipValue = "";

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

        // userfullname
        $this->userfullname->LinkCustomAttributes = "";
        $this->userfullname->HrefValue = "";
        $this->userfullname->TooltipValue = "";

        // emailaddress
        $this->emailaddress->LinkCustomAttributes = "";
        $this->emailaddress->HrefValue = "";
        $this->emailaddress->TooltipValue = "";

        // contactnumber
        $this->contactnumber->LinkCustomAttributes = "";
        $this->contactnumber->HrefValue = "";
        $this->contactnumber->TooltipValue = "";

        // empipaddress
        $this->empipaddress->LinkCustomAttributes = "";
        $this->empipaddress->HrefValue = "";
        $this->empipaddress->TooltipValue = "";

        // backgroundchk_status
        $this->backgroundchk_status->LinkCustomAttributes = "";
        $this->backgroundchk_status->HrefValue = "";
        $this->backgroundchk_status->TooltipValue = "";

        // emptemplock
        $this->emptemplock->LinkCustomAttributes = "";
        $this->emptemplock->HrefValue = "";
        $this->emptemplock->TooltipValue = "";

        // empreasonlocked
        $this->empreasonlocked->LinkCustomAttributes = "";
        $this->empreasonlocked->HrefValue = "";
        $this->empreasonlocked->TooltipValue = "";

        // emplockeddate
        $this->emplockeddate->LinkCustomAttributes = "";
        $this->emplockeddate->HrefValue = "";
        $this->emplockeddate->TooltipValue = "";

        // emppassword
        $this->emppassword->LinkCustomAttributes = "";
        $this->emppassword->HrefValue = "";
        $this->emppassword->TooltipValue = "";

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

        // isactive
        $this->isactive->LinkCustomAttributes = "";
        $this->isactive->HrefValue = "";
        $this->isactive->TooltipValue = "";

        // staff_ID
        $this->staff_ID->LinkCustomAttributes = "";
        $this->staff_ID->HrefValue = "";
        $this->staff_ID->TooltipValue = "";

        // modeofentry
        $this->modeofentry->LinkCustomAttributes = "";
        $this->modeofentry->HrefValue = "";
        $this->modeofentry->TooltipValue = "";

        // other_modeofentry
        $this->other_modeofentry->LinkCustomAttributes = "";
        $this->other_modeofentry->HrefValue = "";
        $this->other_modeofentry->TooltipValue = "";

        // entrycomments
        $this->entrycomments->LinkCustomAttributes = "";
        $this->entrycomments->HrefValue = "";
        $this->entrycomments->TooltipValue = "";

        // selecteddate
        $this->selecteddate->LinkCustomAttributes = "";
        $this->selecteddate->HrefValue = "";
        $this->selecteddate->TooltipValue = "";

        // company_id
        $this->company_id->LinkCustomAttributes = "";
        $this->company_id->HrefValue = "";
        $this->company_id->TooltipValue = "";

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
        $this->profileimg->TooltipValue = "";
        if ($this->profileimg->UseColorbox) {
            if (EmptyValue($this->profileimg->TooltipValue)) {
                $this->profileimg->LinkAttrs["title"] = $Language->phrase("ViewImageGallery");
            }
            $this->profileimg->LinkAttrs["data-rel"] = "main_users_x_profileimg";
            $this->profileimg->LinkAttrs->appendClass("ew-lightbox");
        }

        // jobtitle_id
        $this->jobtitle_id->LinkCustomAttributes = "";
        $this->jobtitle_id->HrefValue = "";
        $this->jobtitle_id->TooltipValue = "";

        // tourflag
        $this->tourflag->LinkCustomAttributes = "";
        $this->tourflag->HrefValue = "";
        $this->tourflag->TooltipValue = "";

        // themes
        $this->themes->LinkCustomAttributes = "";
        $this->themes->HrefValue = "";
        $this->themes->TooltipValue = "";

        // is_admin
        $this->is_admin->LinkCustomAttributes = "";
        $this->is_admin->HrefValue = "";
        $this->is_admin->TooltipValue = "";

        // role_id
        $this->role_id->LinkCustomAttributes = "";
        $this->role_id->HrefValue = "";
        $this->role_id->TooltipValue = "";

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

        // emprole
        $this->emprole->setupEditAttributes();
        $this->emprole->EditCustomAttributes = "";
        if (!$Security->canAdmin()) { // System admin
            $this->emprole->EditValue = $Language->phrase("PasswordMask");
        } else {
            $this->emprole->PlaceHolder = RemoveHtml($this->emprole->caption());
        }

        // userstatus
        $this->userstatus->EditCustomAttributes = "";
        $this->userstatus->EditValue = $this->userstatus->options(false);
        $this->userstatus->PlaceHolder = RemoveHtml($this->userstatus->caption());

        // firstname
        $this->firstname->setupEditAttributes();
        $this->firstname->EditCustomAttributes = "";
        if (!$this->firstname->Raw) {
            $this->firstname->CurrentValue = HtmlDecode($this->firstname->CurrentValue);
        }
        $this->firstname->EditValue = $this->firstname->CurrentValue;
        $this->firstname->PlaceHolder = RemoveHtml($this->firstname->caption());

        // lastname
        $this->lastname->setupEditAttributes();
        $this->lastname->EditCustomAttributes = "";
        if (!$this->lastname->Raw) {
            $this->lastname->CurrentValue = HtmlDecode($this->lastname->CurrentValue);
        }
        $this->lastname->EditValue = $this->lastname->CurrentValue;
        $this->lastname->PlaceHolder = RemoveHtml($this->lastname->caption());

        // userfullname
        $this->userfullname->setupEditAttributes();
        $this->userfullname->EditCustomAttributes = "";
        if (!$this->userfullname->Raw) {
            $this->userfullname->CurrentValue = HtmlDecode($this->userfullname->CurrentValue);
        }
        $this->userfullname->EditValue = $this->userfullname->CurrentValue;
        $this->userfullname->PlaceHolder = RemoveHtml($this->userfullname->caption());

        // emailaddress
        $this->emailaddress->setupEditAttributes();
        $this->emailaddress->EditCustomAttributes = "";
        if (!$this->emailaddress->Raw) {
            $this->emailaddress->CurrentValue = HtmlDecode($this->emailaddress->CurrentValue);
        }
        $this->emailaddress->EditValue = $this->emailaddress->CurrentValue;
        $this->emailaddress->PlaceHolder = RemoveHtml($this->emailaddress->caption());

        // contactnumber
        $this->contactnumber->setupEditAttributes();
        $this->contactnumber->EditCustomAttributes = "";
        if (!$this->contactnumber->Raw) {
            $this->contactnumber->CurrentValue = HtmlDecode($this->contactnumber->CurrentValue);
        }
        $this->contactnumber->EditValue = $this->contactnumber->CurrentValue;
        $this->contactnumber->PlaceHolder = RemoveHtml($this->contactnumber->caption());

        // empipaddress
        $this->empipaddress->setupEditAttributes();
        $this->empipaddress->EditCustomAttributes = "";
        if (!$this->empipaddress->Raw) {
            $this->empipaddress->CurrentValue = HtmlDecode($this->empipaddress->CurrentValue);
        }
        $this->empipaddress->EditValue = $this->empipaddress->CurrentValue;
        $this->empipaddress->PlaceHolder = RemoveHtml($this->empipaddress->caption());

        // backgroundchk_status
        $this->backgroundchk_status->EditCustomAttributes = "";
        $this->backgroundchk_status->EditValue = $this->backgroundchk_status->options(false);
        $this->backgroundchk_status->PlaceHolder = RemoveHtml($this->backgroundchk_status->caption());

        // emptemplock
        $this->emptemplock->setupEditAttributes();
        $this->emptemplock->EditCustomAttributes = "";
        $this->emptemplock->EditValue = $this->emptemplock->CurrentValue;
        $this->emptemplock->PlaceHolder = RemoveHtml($this->emptemplock->caption());
        if (strval($this->emptemplock->EditValue) != "" && is_numeric($this->emptemplock->EditValue)) {
            $this->emptemplock->EditValue = FormatNumber($this->emptemplock->EditValue, null);
        }

        // empreasonlocked
        $this->empreasonlocked->setupEditAttributes();
        $this->empreasonlocked->EditCustomAttributes = "";
        if (!$this->empreasonlocked->Raw) {
            $this->empreasonlocked->CurrentValue = HtmlDecode($this->empreasonlocked->CurrentValue);
        }
        $this->empreasonlocked->EditValue = $this->empreasonlocked->CurrentValue;
        $this->empreasonlocked->PlaceHolder = RemoveHtml($this->empreasonlocked->caption());

        // emplockeddate
        $this->emplockeddate->setupEditAttributes();
        $this->emplockeddate->EditCustomAttributes = "";
        $this->emplockeddate->EditValue = FormatDateTime($this->emplockeddate->CurrentValue, 8);
        $this->emplockeddate->PlaceHolder = RemoveHtml($this->emplockeddate->caption());

        // emppassword
        $this->emppassword->setupEditAttributes();
        $this->emppassword->EditCustomAttributes = "";
        if (!$this->emppassword->Raw) {
            $this->emppassword->CurrentValue = HtmlDecode($this->emppassword->CurrentValue);
        }
        $this->emppassword->EditValue = $this->emppassword->CurrentValue;
        $this->emppassword->PlaceHolder = RemoveHtml($this->emppassword->caption());

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

        // isactive
        $this->isactive->setupEditAttributes();
        $this->isactive->EditCustomAttributes = "";
        $this->isactive->EditValue = $this->isactive->CurrentValue;
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
        $this->staff_ID->EditValue = $this->staff_ID->CurrentValue;
        $this->staff_ID->PlaceHolder = RemoveHtml($this->staff_ID->caption());

        // modeofentry
        $this->modeofentry->setupEditAttributes();
        $this->modeofentry->EditCustomAttributes = "";
        if (!$this->modeofentry->Raw) {
            $this->modeofentry->CurrentValue = HtmlDecode($this->modeofentry->CurrentValue);
        }
        $this->modeofentry->EditValue = $this->modeofentry->CurrentValue;
        $this->modeofentry->PlaceHolder = RemoveHtml($this->modeofentry->caption());

        // other_modeofentry
        $this->other_modeofentry->setupEditAttributes();
        $this->other_modeofentry->EditCustomAttributes = "";
        if (!$this->other_modeofentry->Raw) {
            $this->other_modeofentry->CurrentValue = HtmlDecode($this->other_modeofentry->CurrentValue);
        }
        $this->other_modeofentry->EditValue = $this->other_modeofentry->CurrentValue;
        $this->other_modeofentry->PlaceHolder = RemoveHtml($this->other_modeofentry->caption());

        // entrycomments
        $this->entrycomments->setupEditAttributes();
        $this->entrycomments->EditCustomAttributes = "";
        if (!$this->entrycomments->Raw) {
            $this->entrycomments->CurrentValue = HtmlDecode($this->entrycomments->CurrentValue);
        }
        $this->entrycomments->EditValue = $this->entrycomments->CurrentValue;
        $this->entrycomments->PlaceHolder = RemoveHtml($this->entrycomments->caption());

        // selecteddate
        $this->selecteddate->setupEditAttributes();
        $this->selecteddate->EditCustomAttributes = "";
        $this->selecteddate->EditValue = FormatDateTime($this->selecteddate->CurrentValue, 8);
        $this->selecteddate->PlaceHolder = RemoveHtml($this->selecteddate->caption());

        // company_id
        $this->company_id->setupEditAttributes();
        $this->company_id->EditCustomAttributes = "";
        $this->company_id->EditValue = $this->company_id->CurrentValue;
        $this->company_id->PlaceHolder = RemoveHtml($this->company_id->caption());
        if (strval($this->company_id->EditValue) != "" && is_numeric($this->company_id->EditValue)) {
            $this->company_id->EditValue = FormatNumber($this->company_id->EditValue, null);
        }

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

        // jobtitle_id
        $this->jobtitle_id->setupEditAttributes();
        $this->jobtitle_id->EditCustomAttributes = "";
        $this->jobtitle_id->EditValue = $this->jobtitle_id->CurrentValue;
        $this->jobtitle_id->PlaceHolder = RemoveHtml($this->jobtitle_id->caption());
        if (strval($this->jobtitle_id->EditValue) != "" && is_numeric($this->jobtitle_id->EditValue)) {
            $this->jobtitle_id->EditValue = FormatNumber($this->jobtitle_id->EditValue, null);
        }

        // tourflag
        $this->tourflag->setupEditAttributes();
        $this->tourflag->EditCustomAttributes = "";
        $this->tourflag->EditValue = $this->tourflag->CurrentValue;
        $this->tourflag->PlaceHolder = RemoveHtml($this->tourflag->caption());
        if (strval($this->tourflag->EditValue) != "" && is_numeric($this->tourflag->EditValue)) {
            $this->tourflag->EditValue = FormatNumber($this->tourflag->EditValue, null);
        }

        // themes
        $this->themes->EditCustomAttributes = "";
        $this->themes->EditValue = $this->themes->options(false);
        $this->themes->PlaceHolder = RemoveHtml($this->themes->caption());

        // is_admin
        $this->is_admin->setupEditAttributes();
        $this->is_admin->EditCustomAttributes = "";
        $this->is_admin->EditValue = $this->is_admin->CurrentValue;
        $this->is_admin->PlaceHolder = RemoveHtml($this->is_admin->caption());
        if (strval($this->is_admin->EditValue) != "" && is_numeric($this->is_admin->EditValue)) {
            $this->is_admin->EditValue = FormatNumber($this->is_admin->EditValue, null);
        }

        // role_id
        $this->role_id->setupEditAttributes();
        $this->role_id->EditCustomAttributes = "";
        $this->role_id->EditValue = $this->role_id->CurrentValue;
        $this->role_id->PlaceHolder = RemoveHtml($this->role_id->caption());
        if (strval($this->role_id->EditValue) != "" && is_numeric($this->role_id->EditValue)) {
            $this->role_id->EditValue = FormatNumber($this->role_id->EditValue, null);
        }

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
                    $doc->exportCaption($this->emprole);
                    $doc->exportCaption($this->userstatus);
                    $doc->exportCaption($this->firstname);
                    $doc->exportCaption($this->lastname);
                    $doc->exportCaption($this->userfullname);
                    $doc->exportCaption($this->emailaddress);
                    $doc->exportCaption($this->contactnumber);
                    $doc->exportCaption($this->empipaddress);
                    $doc->exportCaption($this->backgroundchk_status);
                    $doc->exportCaption($this->emptemplock);
                    $doc->exportCaption($this->empreasonlocked);
                    $doc->exportCaption($this->emplockeddate);
                    $doc->exportCaption($this->emppassword);
                    $doc->exportCaption($this->createdby);
                    $doc->exportCaption($this->modifiedby);
                    $doc->exportCaption($this->createddate);
                    $doc->exportCaption($this->modifieddate);
                    $doc->exportCaption($this->isactive);
                    $doc->exportCaption($this->staff_ID);
                    $doc->exportCaption($this->modeofentry);
                    $doc->exportCaption($this->other_modeofentry);
                    $doc->exportCaption($this->entrycomments);
                    $doc->exportCaption($this->selecteddate);
                    $doc->exportCaption($this->company_id);
                    $doc->exportCaption($this->profileimg);
                    $doc->exportCaption($this->jobtitle_id);
                    $doc->exportCaption($this->tourflag);
                    $doc->exportCaption($this->themes);
                    $doc->exportCaption($this->is_admin);
                    $doc->exportCaption($this->role_id);
                } else {
                    $doc->exportCaption($this->id);
                    $doc->exportCaption($this->emprole);
                    $doc->exportCaption($this->userstatus);
                    $doc->exportCaption($this->firstname);
                    $doc->exportCaption($this->lastname);
                    $doc->exportCaption($this->userfullname);
                    $doc->exportCaption($this->emailaddress);
                    $doc->exportCaption($this->contactnumber);
                    $doc->exportCaption($this->empipaddress);
                    $doc->exportCaption($this->backgroundchk_status);
                    $doc->exportCaption($this->emptemplock);
                    $doc->exportCaption($this->empreasonlocked);
                    $doc->exportCaption($this->emplockeddate);
                    $doc->exportCaption($this->emppassword);
                    $doc->exportCaption($this->createdby);
                    $doc->exportCaption($this->modifiedby);
                    $doc->exportCaption($this->createddate);
                    $doc->exportCaption($this->modifieddate);
                    $doc->exportCaption($this->isactive);
                    $doc->exportCaption($this->staff_ID);
                    $doc->exportCaption($this->modeofentry);
                    $doc->exportCaption($this->other_modeofentry);
                    $doc->exportCaption($this->entrycomments);
                    $doc->exportCaption($this->selecteddate);
                    $doc->exportCaption($this->company_id);
                    $doc->exportCaption($this->profileimg);
                    $doc->exportCaption($this->jobtitle_id);
                    $doc->exportCaption($this->tourflag);
                    $doc->exportCaption($this->themes);
                    $doc->exportCaption($this->is_admin);
                    $doc->exportCaption($this->role_id);
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
                        $doc->exportField($this->emprole);
                        $doc->exportField($this->userstatus);
                        $doc->exportField($this->firstname);
                        $doc->exportField($this->lastname);
                        $doc->exportField($this->userfullname);
                        $doc->exportField($this->emailaddress);
                        $doc->exportField($this->contactnumber);
                        $doc->exportField($this->empipaddress);
                        $doc->exportField($this->backgroundchk_status);
                        $doc->exportField($this->emptemplock);
                        $doc->exportField($this->empreasonlocked);
                        $doc->exportField($this->emplockeddate);
                        $doc->exportField($this->emppassword);
                        $doc->exportField($this->createdby);
                        $doc->exportField($this->modifiedby);
                        $doc->exportField($this->createddate);
                        $doc->exportField($this->modifieddate);
                        $doc->exportField($this->isactive);
                        $doc->exportField($this->staff_ID);
                        $doc->exportField($this->modeofentry);
                        $doc->exportField($this->other_modeofentry);
                        $doc->exportField($this->entrycomments);
                        $doc->exportField($this->selecteddate);
                        $doc->exportField($this->company_id);
                        $doc->exportField($this->profileimg);
                        $doc->exportField($this->jobtitle_id);
                        $doc->exportField($this->tourflag);
                        $doc->exportField($this->themes);
                        $doc->exportField($this->is_admin);
                        $doc->exportField($this->role_id);
                    } else {
                        $doc->exportField($this->id);
                        $doc->exportField($this->emprole);
                        $doc->exportField($this->userstatus);
                        $doc->exportField($this->firstname);
                        $doc->exportField($this->lastname);
                        $doc->exportField($this->userfullname);
                        $doc->exportField($this->emailaddress);
                        $doc->exportField($this->contactnumber);
                        $doc->exportField($this->empipaddress);
                        $doc->exportField($this->backgroundchk_status);
                        $doc->exportField($this->emptemplock);
                        $doc->exportField($this->empreasonlocked);
                        $doc->exportField($this->emplockeddate);
                        $doc->exportField($this->emppassword);
                        $doc->exportField($this->createdby);
                        $doc->exportField($this->modifiedby);
                        $doc->exportField($this->createddate);
                        $doc->exportField($this->modifieddate);
                        $doc->exportField($this->isactive);
                        $doc->exportField($this->staff_ID);
                        $doc->exportField($this->modeofentry);
                        $doc->exportField($this->other_modeofentry);
                        $doc->exportField($this->entrycomments);
                        $doc->exportField($this->selecteddate);
                        $doc->exportField($this->company_id);
                        $doc->exportField($this->profileimg);
                        $doc->exportField($this->jobtitle_id);
                        $doc->exportField($this->tourflag);
                        $doc->exportField($this->themes);
                        $doc->exportField($this->is_admin);
                        $doc->exportField($this->role_id);
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

    // User ID filter
    public function getUserIDFilter($userId)
    {
        global $Security;
        $userIdFilter = '`id` = ' . QuotedValue($userId, DATATYPE_NUMBER, Config("USER_TABLE_DBID"));
        return $userIdFilter;
    }

    // Add User ID filter
    public function addUserIDFilter($filter = "")
    {
        global $Security;
        $filterWrk = "";
        $id = (CurrentPageID() == "list") ? $this->CurrentAction : CurrentPageID();
        if (!$this->userIDAllow($id) && !$Security->isAdmin()) {
            $filterWrk = $Security->userIdList();
            if ($filterWrk != "") {
                $filterWrk = '`id` IN (' . $filterWrk . ')';
            }
        }

        // Call User ID Filtering event
        $this->userIdFiltering($filterWrk);
        AddFilter($filter, $filterWrk);
        return $filter;
    }

    // User ID subquery
    public function getUserIDSubquery(&$fld, &$masterfld)
    {
        global $UserTable;
        $wrk = "";
        $sql = "SELECT " . $masterfld->Expression . " FROM `main_users`";
        $filter = $this->addUserIDFilter("");
        if ($filter != "") {
            $sql .= " WHERE " . $filter;
        }

        // List all values
        $conn = Conn($UserTable->Dbid);
        $config = $conn->getConfiguration();
        $config->setResultCacheImpl($this->Cache);
        if ($rs = $conn->executeCacheQuery($sql, [], [], $this->CacheProfile)->fetchAllNumeric()) {
            foreach ($rs as $row) {
                if ($wrk != "") {
                    $wrk .= ",";
                }
                $wrk .= QuotedValue($row[0], $masterfld->DataType, Config("USER_TABLE_DBID"));
            }
        }
        if ($wrk != "") {
            $wrk = $fld->Expression . " IN (" . $wrk . ")";
        } else { // No User ID value found
            $wrk = "0=1";
        }
        return $wrk;
    }

    // Get file data
    public function getFileData($fldparm, $key, $resize, $width = 0, $height = 0, $plugins = [])
    {
        $width = ($width > 0) ? $width : Config("THUMBNAIL_DEFAULT_WIDTH");
        $height = ($height > 0) ? $height : Config("THUMBNAIL_DEFAULT_HEIGHT");

        // Set up field name / file name field / file type field
        $fldName = "";
        $fileNameFld = "";
        $fileTypeFld = "";
        if ($fldparm == 'profileimg') {
            $fldName = "profileimg";
            $fileNameFld = "profileimg";
        } else {
            return false; // Incorrect field
        }

        // Set up key values
        $ar = explode(Config("COMPOSITE_KEY_SEPARATOR"), $key);
        if (count($ar) == 1) {
            $this->id->CurrentValue = $ar[0];
        } else {
            return false; // Incorrect key
        }

        // Set up filter (WHERE Clause)
        $filter = $this->getRecordFilter();
        $this->CurrentFilter = $filter;
        $sql = $this->getCurrentSql();
        $conn = $this->getConnection();
        $dbtype = GetConnectionType($this->Dbid);
        if ($row = $conn->fetchAssociative($sql)) {
            $val = $row[$fldName];
            if (!EmptyValue($val)) {
                $fld = $this->Fields[$fldName];

                // Binary data
                if ($fld->DataType == DATATYPE_BLOB) {
                    if ($dbtype != "MYSQL") {
                        if (is_resource($val) && get_resource_type($val) == "stream") { // Byte array
                            $val = stream_get_contents($val);
                        }
                    }
                    if ($resize) {
                        ResizeBinary($val, $width, $height, $plugins);
                    }

                    // Write file type
                    if ($fileTypeFld != "" && !EmptyValue($row[$fileTypeFld])) {
                        AddHeader("Content-type", $row[$fileTypeFld]);
                    } else {
                        AddHeader("Content-type", ContentType($val));
                    }

                    // Write file name
                    $downloadPdf = !Config("EMBED_PDF") && Config("DOWNLOAD_PDF_FILE");
                    if ($fileNameFld != "" && !EmptyValue($row[$fileNameFld])) {
                        $fileName = $row[$fileNameFld];
                        $pathinfo = pathinfo($fileName);
                        $ext = strtolower(@$pathinfo["extension"]);
                        $isPdf = SameText($ext, "pdf");
                        if ($downloadPdf || !$isPdf) { // Skip header if not download PDF
                            AddHeader("Content-Disposition", "attachment; filename=\"" . $fileName . "\"");
                        }
                    } else {
                        $ext = ContentExtension($val);
                        $isPdf = SameText($ext, ".pdf");
                        if ($isPdf && $downloadPdf) { // Add header if download PDF
                            AddHeader("Content-Disposition", "attachment; filename=\"" . $fileName . "\"");
                        }
                    }

                    // Write file data
                    if (
                        StartsString("PK", $val) &&
                        ContainsString($val, "[Content_Types].xml") &&
                        ContainsString($val, "_rels") &&
                        ContainsString($val, "docProps")
                    ) { // Fix Office 2007 documents
                        if (!EndsString("\0\0\0", $val)) { // Not ends with 3 or 4 \0
                            $val .= "\0\0\0\0";
                        }
                    }

                    // Clear any debug message
                    if (ob_get_length()) {
                        ob_end_clean();
                    }

                    // Write binary data
                    Write($val);

                // Upload to folder
                } else {
                    if ($fld->UploadMultiple) {
                        $files = explode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $val);
                    } else {
                        $files = [$val];
                    }
                    $data = [];
                    $ar = [];
                    foreach ($files as $file) {
                        if (!EmptyValue($file)) {
                            if (Config("ENCRYPT_FILE_PATH")) {
                                $ar[$file] = FullUrl(GetApiUrl(Config("API_FILE_ACTION") .
                                    "/" . $this->TableVar . "/" . Encrypt($fld->physicalUploadPath() . $file)));
                            } else {
                                $ar[$file] = FullUrl($fld->hrefPath() . $file);
                            }
                        }
                    }
                    $data[$fld->Param] = $ar;
                    WriteJson($data);
                }
            }
            return true;
        }
        return false;
    }

    // Write Audit Trail start/end for grid update
    public function writeAuditTrailDummy($typ)
    {
        $table = 'main_users';
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
        $table = 'main_users';

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
                if ($fldname == Config("LOGIN_PASSWORD_FIELD_NAME")) {
                    $newvalue = $Language->phrase("PasswordMask");
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
        $table = 'main_users';

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
                    if ($fldname == Config("LOGIN_PASSWORD_FIELD_NAME")) {
                        $oldvalue = $Language->phrase("PasswordMask");
                        $newvalue = $Language->phrase("PasswordMask");
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
        $table = 'main_users';

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
                if ($fldname == Config("LOGIN_PASSWORD_FIELD_NAME")) {
                    $oldvalue = $Language->phrase("PasswordMask");
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
