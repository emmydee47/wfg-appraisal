<?php

namespace PHPMaker2022\wfg_appraisal;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Table class for users
 */
class Users extends DbTable
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
    public $user_id;
    public $oauth_provider;
    public $oauth_uid;
    public $user_type;
    public $firstname;
    public $lastname;
    public $middlename;
    public $_email;
    public $_password;
    public $mobile_number;
    public $alternate_number;
    public $gender;
    public $nationality;
    public $dob;
    public $birthplace;
    public $languages;
    public $previousjobrole;
    public $martial_status;
    public $country;
    public $city;
    public $position;
    public $category;
    public $industry;
    public $driving_license;
    public $visa_status;
    public $current_salary;
    public $excepted_salary;
    public $resume;
    public $cover_letter;
    public $picture;
    public $passport;
    public $address;
    public $linkedin_url;
    public $skype_id;
    public $passport_no;
    public $user_status;
    public $created;
    public $modified;
    public $facebook_url;
    public $twitter_url;
    public $verification;
    public $pwd_reset_code;
    public $firsttime;
    public $blacklist;
    public $hrm_business_unit_id;
    public $main_user_id;
    public $department_id;
    public $main_user_detail;
    public $profile_img;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage, $CurrentLocale;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'users';
        $this->TableName = 'users';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "`users`";
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

        // user_id
        $this->user_id = new DbField(
            'users',
            'users',
            'x_user_id',
            'user_id',
            '`user_id`',
            '`user_id`',
            3,
            11,
            -1,
            false,
            '`user_id`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'NO'
        );
        $this->user_id->InputTextType = "text";
        $this->user_id->IsAutoIncrement = true; // Autoincrement field
        $this->user_id->IsPrimaryKey = true; // Primary key field
        $this->user_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['user_id'] = &$this->user_id;

        // oauth_provider
        $this->oauth_provider = new DbField(
            'users',
            'users',
            'x_oauth_provider',
            'oauth_provider',
            '`oauth_provider`',
            '`oauth_provider`',
            200,
            255,
            -1,
            false,
            '`oauth_provider`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->oauth_provider->InputTextType = "text";
        $this->oauth_provider->Nullable = false; // NOT NULL field
        $this->oauth_provider->Required = true; // Required field
        $this->Fields['oauth_provider'] = &$this->oauth_provider;

        // oauth_uid
        $this->oauth_uid = new DbField(
            'users',
            'users',
            'x_oauth_uid',
            'oauth_uid',
            '`oauth_uid`',
            '`oauth_uid`',
            200,
            255,
            -1,
            false,
            '`oauth_uid`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->oauth_uid->InputTextType = "text";
        $this->oauth_uid->Nullable = false; // NOT NULL field
        $this->oauth_uid->Required = true; // Required field
        $this->Fields['oauth_uid'] = &$this->oauth_uid;

        // user_type
        $this->user_type = new DbField(
            'users',
            'users',
            'x_user_type',
            'user_type',
            '`user_type`',
            '`user_type`',
            200,
            30,
            -1,
            false,
            '`user_type`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->user_type->InputTextType = "text";
        $this->user_type->Nullable = false; // NOT NULL field
        $this->user_type->Required = true; // Required field
        $this->Fields['user_type'] = &$this->user_type;

        // firstname
        $this->firstname = new DbField(
            'users',
            'users',
            'x_firstname',
            'firstname',
            '`firstname`',
            '`firstname`',
            200,
            20,
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
        $this->firstname->Nullable = false; // NOT NULL field
        $this->firstname->Required = true; // Required field
        $this->Fields['firstname'] = &$this->firstname;

        // lastname
        $this->lastname = new DbField(
            'users',
            'users',
            'x_lastname',
            'lastname',
            '`lastname`',
            '`lastname`',
            200,
            20,
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

        // middlename
        $this->middlename = new DbField(
            'users',
            'users',
            'x_middlename',
            'middlename',
            '`middlename`',
            '`middlename`',
            200,
            200,
            -1,
            false,
            '`middlename`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->middlename->InputTextType = "text";
        $this->middlename->Nullable = false; // NOT NULL field
        $this->middlename->Required = true; // Required field
        $this->Fields['middlename'] = &$this->middlename;

        // email
        $this->_email = new DbField(
            'users',
            'users',
            'x__email',
            'email',
            '`email`',
            '`email`',
            200,
            50,
            -1,
            false,
            '`email`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->_email->InputTextType = "text";
        $this->_email->Nullable = false; // NOT NULL field
        $this->_email->Required = true; // Required field
        $this->Fields['email'] = &$this->_email;

        // password
        $this->_password = new DbField(
            'users',
            'users',
            'x__password',
            'password',
            '`password`',
            '`password`',
            200,
            50,
            -1,
            false,
            '`password`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->_password->InputTextType = "text";
        $this->_password->Nullable = false; // NOT NULL field
        $this->_password->Required = true; // Required field
        $this->Fields['password'] = &$this->_password;

        // mobile_number
        $this->mobile_number = new DbField(
            'users',
            'users',
            'x_mobile_number',
            'mobile_number',
            '`mobile_number`',
            '`mobile_number`',
            200,
            30,
            -1,
            false,
            '`mobile_number`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->mobile_number->InputTextType = "text";
        $this->Fields['mobile_number'] = &$this->mobile_number;

        // alternate_number
        $this->alternate_number = new DbField(
            'users',
            'users',
            'x_alternate_number',
            'alternate_number',
            '`alternate_number`',
            '`alternate_number`',
            200,
            30,
            -1,
            false,
            '`alternate_number`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->alternate_number->InputTextType = "text";
        $this->Fields['alternate_number'] = &$this->alternate_number;

        // gender
        $this->gender = new DbField(
            'users',
            'users',
            'x_gender',
            'gender',
            '`gender`',
            '`gender`',
            200,
            10,
            -1,
            false,
            '`gender`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->gender->InputTextType = "text";
        $this->Fields['gender'] = &$this->gender;

        // nationality
        $this->nationality = new DbField(
            'users',
            'users',
            'x_nationality',
            'nationality',
            '`nationality`',
            '`nationality`',
            200,
            20,
            -1,
            false,
            '`nationality`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->nationality->InputTextType = "text";
        $this->Fields['nationality'] = &$this->nationality;

        // dob
        $this->dob = new DbField(
            'users',
            'users',
            'x_dob',
            'dob',
            '`dob`',
            '`dob`',
            200,
            30,
            -1,
            false,
            '`dob`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->dob->InputTextType = "text";
        $this->Fields['dob'] = &$this->dob;

        // birthplace
        $this->birthplace = new DbField(
            'users',
            'users',
            'x_birthplace',
            'birthplace',
            '`birthplace`',
            '`birthplace`',
            200,
            200,
            -1,
            false,
            '`birthplace`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->birthplace->InputTextType = "text";
        $this->birthplace->Nullable = false; // NOT NULL field
        $this->birthplace->Required = true; // Required field
        $this->Fields['birthplace'] = &$this->birthplace;

        // languages
        $this->languages = new DbField(
            'users',
            'users',
            'x_languages',
            'languages',
            '`languages`',
            '`languages`',
            200,
            200,
            -1,
            false,
            '`languages`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->languages->InputTextType = "text";
        $this->languages->Nullable = false; // NOT NULL field
        $this->languages->Required = true; // Required field
        $this->Fields['languages'] = &$this->languages;

        // previousjobrole
        $this->previousjobrole = new DbField(
            'users',
            'users',
            'x_previousjobrole',
            'previousjobrole',
            '`previousjobrole`',
            '`previousjobrole`',
            200,
            200,
            -1,
            false,
            '`previousjobrole`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->previousjobrole->InputTextType = "text";
        $this->previousjobrole->Nullable = false; // NOT NULL field
        $this->previousjobrole->Required = true; // Required field
        $this->Fields['previousjobrole'] = &$this->previousjobrole;

        // martial_status
        $this->martial_status = new DbField(
            'users',
            'users',
            'x_martial_status',
            'martial_status',
            '`martial_status`',
            '`martial_status`',
            200,
            10,
            -1,
            false,
            '`martial_status`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->martial_status->InputTextType = "text";
        $this->Fields['martial_status'] = &$this->martial_status;

        // country
        $this->country = new DbField(
            'users',
            'users',
            'x_country',
            'country',
            '`country`',
            '`country`',
            200,
            20,
            -1,
            false,
            '`country`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->country->InputTextType = "text";
        $this->Fields['country'] = &$this->country;

        // city
        $this->city = new DbField(
            'users',
            'users',
            'x_city',
            'city',
            '`city`',
            '`city`',
            200,
            20,
            -1,
            false,
            '`city`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->city->InputTextType = "text";
        $this->city->Nullable = false; // NOT NULL field
        $this->city->Required = true; // Required field
        $this->Fields['city'] = &$this->city;

        // position
        $this->position = new DbField(
            'users',
            'users',
            'x_position',
            'position',
            '`position`',
            '`position`',
            200,
            50,
            -1,
            false,
            '`position`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->position->InputTextType = "text";
        $this->position->Nullable = false; // NOT NULL field
        $this->position->Required = true; // Required field
        $this->Fields['position'] = &$this->position;

        // category
        $this->category = new DbField(
            'users',
            'users',
            'x_category',
            'category',
            '`category`',
            '`category`',
            200,
            50,
            -1,
            false,
            '`category`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->category->InputTextType = "text";
        $this->category->Nullable = false; // NOT NULL field
        $this->category->Required = true; // Required field
        $this->Fields['category'] = &$this->category;

        // industry
        $this->industry = new DbField(
            'users',
            'users',
            'x_industry',
            'industry',
            '`industry`',
            '`industry`',
            200,
            50,
            -1,
            false,
            '`industry`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->industry->InputTextType = "text";
        $this->Fields['industry'] = &$this->industry;

        // driving_license
        $this->driving_license = new DbField(
            'users',
            'users',
            'x_driving_license',
            'driving_license',
            '`driving_license`',
            '`driving_license`',
            200,
            10,
            -1,
            false,
            '`driving_license`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->driving_license->InputTextType = "text";
        $this->driving_license->Nullable = false; // NOT NULL field
        $this->driving_license->Required = true; // Required field
        $this->Fields['driving_license'] = &$this->driving_license;

        // visa_status
        $this->visa_status = new DbField(
            'users',
            'users',
            'x_visa_status',
            'visa_status',
            '`visa_status`',
            '`visa_status`',
            200,
            15,
            -1,
            false,
            '`visa_status`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->visa_status->InputTextType = "text";
        $this->visa_status->Nullable = false; // NOT NULL field
        $this->visa_status->Required = true; // Required field
        $this->Fields['visa_status'] = &$this->visa_status;

        // current_salary
        $this->current_salary = new DbField(
            'users',
            'users',
            'x_current_salary',
            'current_salary',
            '`current_salary`',
            '`current_salary`',
            200,
            20,
            -1,
            false,
            '`current_salary`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->current_salary->InputTextType = "text";
        $this->current_salary->Nullable = false; // NOT NULL field
        $this->current_salary->Required = true; // Required field
        $this->Fields['current_salary'] = &$this->current_salary;

        // excepted_salary
        $this->excepted_salary = new DbField(
            'users',
            'users',
            'x_excepted_salary',
            'excepted_salary',
            '`excepted_salary`',
            '`excepted_salary`',
            200,
            20,
            -1,
            false,
            '`excepted_salary`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->excepted_salary->InputTextType = "text";
        $this->excepted_salary->Nullable = false; // NOT NULL field
        $this->excepted_salary->Required = true; // Required field
        $this->Fields['excepted_salary'] = &$this->excepted_salary;

        // resume
        $this->resume = new DbField(
            'users',
            'users',
            'x_resume',
            'resume',
            '`resume`',
            '`resume`',
            200,
            50,
            -1,
            false,
            '`resume`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->resume->InputTextType = "text";
        $this->resume->Nullable = false; // NOT NULL field
        $this->resume->Required = true; // Required field
        $this->Fields['resume'] = &$this->resume;

        // cover_letter
        $this->cover_letter = new DbField(
            'users',
            'users',
            'x_cover_letter',
            'cover_letter',
            '`cover_letter`',
            '`cover_letter`',
            200,
            50,
            -1,
            false,
            '`cover_letter`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->cover_letter->InputTextType = "text";
        $this->cover_letter->Nullable = false; // NOT NULL field
        $this->cover_letter->Required = true; // Required field
        $this->Fields['cover_letter'] = &$this->cover_letter;

        // picture
        $this->picture = new DbField(
            'users',
            'users',
            'x_picture',
            'picture',
            '`picture`',
            '`picture`',
            200,
            50,
            -1,
            false,
            '`picture`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->picture->InputTextType = "text";
        $this->picture->Nullable = false; // NOT NULL field
        $this->picture->Required = true; // Required field
        $this->Fields['picture'] = &$this->picture;

        // passport
        $this->passport = new DbField(
            'users',
            'users',
            'x_passport',
            'passport',
            '`passport`',
            '`passport`',
            200,
            50,
            -1,
            false,
            '`passport`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->passport->InputTextType = "text";
        $this->passport->Nullable = false; // NOT NULL field
        $this->passport->Required = true; // Required field
        $this->Fields['passport'] = &$this->passport;

        // address
        $this->address = new DbField(
            'users',
            'users',
            'x_address',
            'address',
            '`address`',
            '`address`',
            200,
            255,
            -1,
            false,
            '`address`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->address->InputTextType = "text";
        $this->address->Nullable = false; // NOT NULL field
        $this->address->Required = true; // Required field
        $this->Fields['address'] = &$this->address;

        // linkedin_url
        $this->linkedin_url = new DbField(
            'users',
            'users',
            'x_linkedin_url',
            'linkedin_url',
            '`linkedin_url`',
            '`linkedin_url`',
            200,
            255,
            -1,
            false,
            '`linkedin_url`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->linkedin_url->InputTextType = "text";
        $this->linkedin_url->Nullable = false; // NOT NULL field
        $this->linkedin_url->Required = true; // Required field
        $this->Fields['linkedin_url'] = &$this->linkedin_url;

        // skype_id
        $this->skype_id = new DbField(
            'users',
            'users',
            'x_skype_id',
            'skype_id',
            '`skype_id`',
            '`skype_id`',
            200,
            50,
            -1,
            false,
            '`skype_id`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->skype_id->InputTextType = "text";
        $this->skype_id->Nullable = false; // NOT NULL field
        $this->skype_id->Required = true; // Required field
        $this->Fields['skype_id'] = &$this->skype_id;

        // passport_no
        $this->passport_no = new DbField(
            'users',
            'users',
            'x_passport_no',
            'passport_no',
            '`passport_no`',
            '`passport_no`',
            200,
            50,
            -1,
            false,
            '`passport_no`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->passport_no->InputTextType = "text";
        $this->passport_no->Nullable = false; // NOT NULL field
        $this->passport_no->Required = true; // Required field
        $this->Fields['passport_no'] = &$this->passport_no;

        // user_status
        $this->user_status = new DbField(
            'users',
            'users',
            'x_user_status',
            'user_status',
            '`user_status`',
            '`user_status`',
            200,
            20,
            -1,
            false,
            '`user_status`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->user_status->InputTextType = "text";
        $this->user_status->Nullable = false; // NOT NULL field
        $this->user_status->Required = true; // Required field
        $this->Fields['user_status'] = &$this->user_status;

        // created
        $this->created = new DbField(
            'users',
            'users',
            'x_created',
            'created',
            '`created`',
            CastDateFieldForLike("`created`", 0, "DB"),
            135,
            19,
            0,
            false,
            '`created`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->created->InputTextType = "text";
        $this->created->Nullable = false; // NOT NULL field
        $this->created->Required = true; // Required field
        $this->created->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->Fields['created'] = &$this->created;

        // modified
        $this->modified = new DbField(
            'users',
            'users',
            'x_modified',
            'modified',
            '`modified`',
            CastDateFieldForLike("`modified`", 0, "DB"),
            135,
            19,
            0,
            false,
            '`modified`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->modified->InputTextType = "text";
        $this->modified->Nullable = false; // NOT NULL field
        $this->modified->Required = true; // Required field
        $this->modified->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->Fields['modified'] = &$this->modified;

        // facebook_url
        $this->facebook_url = new DbField(
            'users',
            'users',
            'x_facebook_url',
            'facebook_url',
            '`facebook_url`',
            '`facebook_url`',
            201,
            1000,
            -1,
            false,
            '`facebook_url`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXTAREA'
        );
        $this->facebook_url->InputTextType = "text";
        $this->facebook_url->Nullable = false; // NOT NULL field
        $this->facebook_url->Required = true; // Required field
        $this->Fields['facebook_url'] = &$this->facebook_url;

        // twitter_url
        $this->twitter_url = new DbField(
            'users',
            'users',
            'x_twitter_url',
            'twitter_url',
            '`twitter_url`',
            '`twitter_url`',
            201,
            1000,
            -1,
            false,
            '`twitter_url`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXTAREA'
        );
        $this->twitter_url->InputTextType = "text";
        $this->twitter_url->Nullable = false; // NOT NULL field
        $this->twitter_url->Required = true; // Required field
        $this->Fields['twitter_url'] = &$this->twitter_url;

        // verification
        $this->verification = new DbField(
            'users',
            'users',
            'x_verification',
            'verification',
            '`verification`',
            '`verification`',
            200,
            20,
            -1,
            false,
            '`verification`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->verification->InputTextType = "text";
        $this->Fields['verification'] = &$this->verification;

        // pwd_reset_code
        $this->pwd_reset_code = new DbField(
            'users',
            'users',
            'x_pwd_reset_code',
            'pwd_reset_code',
            '`pwd_reset_code`',
            '`pwd_reset_code`',
            200,
            100,
            -1,
            false,
            '`pwd_reset_code`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->pwd_reset_code->InputTextType = "text";
        $this->pwd_reset_code->Nullable = false; // NOT NULL field
        $this->pwd_reset_code->Required = true; // Required field
        $this->Fields['pwd_reset_code'] = &$this->pwd_reset_code;

        // firsttime
        $this->firsttime = new DbField(
            'users',
            'users',
            'x_firsttime',
            'firsttime',
            '`firsttime`',
            '`firsttime`',
            16,
            1,
            -1,
            false,
            '`firsttime`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'CHECKBOX'
        );
        $this->firsttime->InputTextType = "text";
        $this->firsttime->Nullable = false; // NOT NULL field
        $this->firsttime->Required = true; // Required field
        $this->firsttime->DataType = DATATYPE_BOOLEAN;
        $this->firsttime->Lookup = new Lookup('firsttime', 'users', false, '', ["","","",""], [], [], [], [], [], [], '', '', "");
        $this->firsttime->OptionCount = 2;
        $this->firsttime->DefaultErrorMessage = $Language->phrase("IncorrectField");
        $this->Fields['firsttime'] = &$this->firsttime;

        // blacklist
        $this->blacklist = new DbField(
            'users',
            'users',
            'x_blacklist',
            'blacklist',
            '`blacklist`',
            '`blacklist`',
            16,
            1,
            -1,
            false,
            '`blacklist`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'CHECKBOX'
        );
        $this->blacklist->InputTextType = "text";
        $this->blacklist->Nullable = false; // NOT NULL field
        $this->blacklist->Required = true; // Required field
        $this->blacklist->DataType = DATATYPE_BOOLEAN;
        $this->blacklist->Lookup = new Lookup('blacklist', 'users', false, '', ["","","",""], [], [], [], [], [], [], '', '', "");
        $this->blacklist->OptionCount = 2;
        $this->blacklist->DefaultErrorMessage = $Language->phrase("IncorrectField");
        $this->Fields['blacklist'] = &$this->blacklist;

        // hrm_business_unit_id
        $this->hrm_business_unit_id = new DbField(
            'users',
            'users',
            'x_hrm_business_unit_id',
            'hrm_business_unit_id',
            '`hrm_business_unit_id`',
            '`hrm_business_unit_id`',
            3,
            11,
            -1,
            false,
            '`hrm_business_unit_id`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->hrm_business_unit_id->InputTextType = "text";
        $this->hrm_business_unit_id->Nullable = false; // NOT NULL field
        $this->hrm_business_unit_id->Required = true; // Required field
        $this->hrm_business_unit_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['hrm_business_unit_id'] = &$this->hrm_business_unit_id;

        // main_user_id
        $this->main_user_id = new DbField(
            'users',
            'users',
            'x_main_user_id',
            'main_user_id',
            '`main_user_id`',
            '`main_user_id`',
            20,
            20,
            -1,
            false,
            '`main_user_id`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->main_user_id->InputTextType = "text";
        $this->main_user_id->Nullable = false; // NOT NULL field
        $this->main_user_id->Required = true; // Required field
        $this->main_user_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['main_user_id'] = &$this->main_user_id;

        // department_id
        $this->department_id = new DbField(
            'users',
            'users',
            'x_department_id',
            'department_id',
            '`department_id`',
            '`department_id`',
            3,
            11,
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
        $this->department_id->Nullable = false; // NOT NULL field
        $this->department_id->Required = true; // Required field
        $this->department_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['department_id'] = &$this->department_id;

        // main_user_detail
        $this->main_user_detail = new DbField(
            'users',
            'users',
            'x_main_user_detail',
            'main_user_detail',
            '`main_user_detail`',
            '`main_user_detail`',
            201,
            65535,
            -1,
            false,
            '`main_user_detail`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXTAREA'
        );
        $this->main_user_detail->InputTextType = "text";
        $this->main_user_detail->Nullable = false; // NOT NULL field
        $this->main_user_detail->Required = true; // Required field
        $this->Fields['main_user_detail'] = &$this->main_user_detail;

        // profile_img
        $this->profile_img = new DbField(
            'users',
            'users',
            'x_profile_img',
            'profile_img',
            '`profile_img`',
            '`profile_img`',
            200,
            200,
            -1,
            false,
            '`profile_img`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->profile_img->InputTextType = "text";
        $this->profile_img->Nullable = false; // NOT NULL field
        $this->profile_img->Required = true; // Required field
        $this->Fields['profile_img'] = &$this->profile_img;

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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "`users`";
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
            $this->user_id->setDbValue($conn->lastInsertId());
            $rs['user_id'] = $this->user_id->DbValue;
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
            $fldname = 'user_id';
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
            if (array_key_exists('user_id', $rs)) {
                AddFilter($where, QuotedName('user_id', $this->Dbid) . '=' . QuotedValue($rs['user_id'], $this->user_id->DataType, $this->Dbid));
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
        $this->user_id->DbValue = $row['user_id'];
        $this->oauth_provider->DbValue = $row['oauth_provider'];
        $this->oauth_uid->DbValue = $row['oauth_uid'];
        $this->user_type->DbValue = $row['user_type'];
        $this->firstname->DbValue = $row['firstname'];
        $this->lastname->DbValue = $row['lastname'];
        $this->middlename->DbValue = $row['middlename'];
        $this->_email->DbValue = $row['email'];
        $this->_password->DbValue = $row['password'];
        $this->mobile_number->DbValue = $row['mobile_number'];
        $this->alternate_number->DbValue = $row['alternate_number'];
        $this->gender->DbValue = $row['gender'];
        $this->nationality->DbValue = $row['nationality'];
        $this->dob->DbValue = $row['dob'];
        $this->birthplace->DbValue = $row['birthplace'];
        $this->languages->DbValue = $row['languages'];
        $this->previousjobrole->DbValue = $row['previousjobrole'];
        $this->martial_status->DbValue = $row['martial_status'];
        $this->country->DbValue = $row['country'];
        $this->city->DbValue = $row['city'];
        $this->position->DbValue = $row['position'];
        $this->category->DbValue = $row['category'];
        $this->industry->DbValue = $row['industry'];
        $this->driving_license->DbValue = $row['driving_license'];
        $this->visa_status->DbValue = $row['visa_status'];
        $this->current_salary->DbValue = $row['current_salary'];
        $this->excepted_salary->DbValue = $row['excepted_salary'];
        $this->resume->DbValue = $row['resume'];
        $this->cover_letter->DbValue = $row['cover_letter'];
        $this->picture->DbValue = $row['picture'];
        $this->passport->DbValue = $row['passport'];
        $this->address->DbValue = $row['address'];
        $this->linkedin_url->DbValue = $row['linkedin_url'];
        $this->skype_id->DbValue = $row['skype_id'];
        $this->passport_no->DbValue = $row['passport_no'];
        $this->user_status->DbValue = $row['user_status'];
        $this->created->DbValue = $row['created'];
        $this->modified->DbValue = $row['modified'];
        $this->facebook_url->DbValue = $row['facebook_url'];
        $this->twitter_url->DbValue = $row['twitter_url'];
        $this->verification->DbValue = $row['verification'];
        $this->pwd_reset_code->DbValue = $row['pwd_reset_code'];
        $this->firsttime->DbValue = $row['firsttime'];
        $this->blacklist->DbValue = $row['blacklist'];
        $this->hrm_business_unit_id->DbValue = $row['hrm_business_unit_id'];
        $this->main_user_id->DbValue = $row['main_user_id'];
        $this->department_id->DbValue = $row['department_id'];
        $this->main_user_detail->DbValue = $row['main_user_detail'];
        $this->profile_img->DbValue = $row['profile_img'];
    }

    // Delete uploaded files
    public function deleteUploadedFiles($row)
    {
        $this->loadDbValues($row);
    }

    // Record filter WHERE clause
    protected function sqlKeyFilter()
    {
        return "`user_id` = @user_id@";
    }

    // Get Key
    public function getKey($current = false)
    {
        $keys = [];
        $val = $current ? $this->user_id->CurrentValue : $this->user_id->OldValue;
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
                $this->user_id->CurrentValue = $keys[0];
            } else {
                $this->user_id->OldValue = $keys[0];
            }
        }
    }

    // Get record filter
    public function getRecordFilter($row = null)
    {
        $keyFilter = $this->sqlKeyFilter();
        if (is_array($row)) {
            $val = array_key_exists('user_id', $row) ? $row['user_id'] : null;
        } else {
            $val = $this->user_id->OldValue !== null ? $this->user_id->OldValue : $this->user_id->CurrentValue;
        }
        if (!is_numeric($val)) {
            return "0=1"; // Invalid key
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@user_id@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
        return $_SESSION[$name] ?? GetUrl("userslist");
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
        if ($pageName == "usersview") {
            return $Language->phrase("View");
        } elseif ($pageName == "usersedit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "usersadd") {
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
                return "UsersView";
            case Config("API_ADD_ACTION"):
                return "UsersAdd";
            case Config("API_EDIT_ACTION"):
                return "UsersEdit";
            case Config("API_DELETE_ACTION"):
                return "UsersDelete";
            case Config("API_LIST_ACTION"):
                return "UsersList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "userslist";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("usersview", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("usersview", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "usersadd?" . $this->getUrlParm($parm);
        } else {
            $url = "usersadd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("usersedit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("usersadd", $this->getUrlParm($parm));
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
        return $this->keyUrl("usersdelete", $this->getUrlParm());
    }

    // Add master url
    public function addMasterUrl($url)
    {
        return $url;
    }

    public function keyToJson($htmlEncode = false)
    {
        $json = "";
        $json .= "\"user_id\":" . JsonEncode($this->user_id->CurrentValue, "number");
        $json = "{" . $json . "}";
        if ($htmlEncode) {
            $json = HtmlEncode($json);
        }
        return $json;
    }

    // Add key value to URL
    public function keyUrl($url, $parm = "")
    {
        if ($this->user_id->CurrentValue !== null) {
            $url .= "/" . $this->encodeKeyValue($this->user_id->CurrentValue);
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
            if (($keyValue = Param("user_id") ?? Route("user_id")) !== null) {
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
                $this->user_id->CurrentValue = $key;
            } else {
                $this->user_id->OldValue = $key;
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
        $this->user_id->setDbValue($row['user_id']);
        $this->oauth_provider->setDbValue($row['oauth_provider']);
        $this->oauth_uid->setDbValue($row['oauth_uid']);
        $this->user_type->setDbValue($row['user_type']);
        $this->firstname->setDbValue($row['firstname']);
        $this->lastname->setDbValue($row['lastname']);
        $this->middlename->setDbValue($row['middlename']);
        $this->_email->setDbValue($row['email']);
        $this->_password->setDbValue($row['password']);
        $this->mobile_number->setDbValue($row['mobile_number']);
        $this->alternate_number->setDbValue($row['alternate_number']);
        $this->gender->setDbValue($row['gender']);
        $this->nationality->setDbValue($row['nationality']);
        $this->dob->setDbValue($row['dob']);
        $this->birthplace->setDbValue($row['birthplace']);
        $this->languages->setDbValue($row['languages']);
        $this->previousjobrole->setDbValue($row['previousjobrole']);
        $this->martial_status->setDbValue($row['martial_status']);
        $this->country->setDbValue($row['country']);
        $this->city->setDbValue($row['city']);
        $this->position->setDbValue($row['position']);
        $this->category->setDbValue($row['category']);
        $this->industry->setDbValue($row['industry']);
        $this->driving_license->setDbValue($row['driving_license']);
        $this->visa_status->setDbValue($row['visa_status']);
        $this->current_salary->setDbValue($row['current_salary']);
        $this->excepted_salary->setDbValue($row['excepted_salary']);
        $this->resume->setDbValue($row['resume']);
        $this->cover_letter->setDbValue($row['cover_letter']);
        $this->picture->setDbValue($row['picture']);
        $this->passport->setDbValue($row['passport']);
        $this->address->setDbValue($row['address']);
        $this->linkedin_url->setDbValue($row['linkedin_url']);
        $this->skype_id->setDbValue($row['skype_id']);
        $this->passport_no->setDbValue($row['passport_no']);
        $this->user_status->setDbValue($row['user_status']);
        $this->created->setDbValue($row['created']);
        $this->modified->setDbValue($row['modified']);
        $this->facebook_url->setDbValue($row['facebook_url']);
        $this->twitter_url->setDbValue($row['twitter_url']);
        $this->verification->setDbValue($row['verification']);
        $this->pwd_reset_code->setDbValue($row['pwd_reset_code']);
        $this->firsttime->setDbValue($row['firsttime']);
        $this->blacklist->setDbValue($row['blacklist']);
        $this->hrm_business_unit_id->setDbValue($row['hrm_business_unit_id']);
        $this->main_user_id->setDbValue($row['main_user_id']);
        $this->department_id->setDbValue($row['department_id']);
        $this->main_user_detail->setDbValue($row['main_user_detail']);
        $this->profile_img->setDbValue($row['profile_img']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // user_id

        // oauth_provider

        // oauth_uid

        // user_type

        // firstname

        // lastname

        // middlename

        // email

        // password

        // mobile_number

        // alternate_number

        // gender

        // nationality

        // dob

        // birthplace

        // languages

        // previousjobrole

        // martial_status

        // country

        // city

        // position

        // category

        // industry

        // driving_license

        // visa_status

        // current_salary

        // excepted_salary

        // resume

        // cover_letter

        // picture

        // passport

        // address

        // linkedin_url

        // skype_id

        // passport_no

        // user_status

        // created

        // modified

        // facebook_url

        // twitter_url

        // verification

        // pwd_reset_code

        // firsttime

        // blacklist

        // hrm_business_unit_id

        // main_user_id

        // department_id

        // main_user_detail

        // profile_img

        // user_id
        $this->user_id->ViewValue = $this->user_id->CurrentValue;
        $this->user_id->ViewCustomAttributes = "";

        // oauth_provider
        $this->oauth_provider->ViewValue = $this->oauth_provider->CurrentValue;
        $this->oauth_provider->ViewCustomAttributes = "";

        // oauth_uid
        $this->oauth_uid->ViewValue = $this->oauth_uid->CurrentValue;
        $this->oauth_uid->ViewCustomAttributes = "";

        // user_type
        $this->user_type->ViewValue = $this->user_type->CurrentValue;
        $this->user_type->ViewCustomAttributes = "";

        // firstname
        $this->firstname->ViewValue = $this->firstname->CurrentValue;
        $this->firstname->ViewCustomAttributes = "";

        // lastname
        $this->lastname->ViewValue = $this->lastname->CurrentValue;
        $this->lastname->ViewCustomAttributes = "";

        // middlename
        $this->middlename->ViewValue = $this->middlename->CurrentValue;
        $this->middlename->ViewCustomAttributes = "";

        // email
        $this->_email->ViewValue = $this->_email->CurrentValue;
        $this->_email->ViewCustomAttributes = "";

        // password
        $this->_password->ViewValue = $this->_password->CurrentValue;
        $this->_password->ViewCustomAttributes = "";

        // mobile_number
        $this->mobile_number->ViewValue = $this->mobile_number->CurrentValue;
        $this->mobile_number->ViewCustomAttributes = "";

        // alternate_number
        $this->alternate_number->ViewValue = $this->alternate_number->CurrentValue;
        $this->alternate_number->ViewCustomAttributes = "";

        // gender
        $this->gender->ViewValue = $this->gender->CurrentValue;
        $this->gender->ViewCustomAttributes = "";

        // nationality
        $this->nationality->ViewValue = $this->nationality->CurrentValue;
        $this->nationality->ViewCustomAttributes = "";

        // dob
        $this->dob->ViewValue = $this->dob->CurrentValue;
        $this->dob->ViewCustomAttributes = "";

        // birthplace
        $this->birthplace->ViewValue = $this->birthplace->CurrentValue;
        $this->birthplace->ViewCustomAttributes = "";

        // languages
        $this->languages->ViewValue = $this->languages->CurrentValue;
        $this->languages->ViewCustomAttributes = "";

        // previousjobrole
        $this->previousjobrole->ViewValue = $this->previousjobrole->CurrentValue;
        $this->previousjobrole->ViewCustomAttributes = "";

        // martial_status
        $this->martial_status->ViewValue = $this->martial_status->CurrentValue;
        $this->martial_status->ViewCustomAttributes = "";

        // country
        $this->country->ViewValue = $this->country->CurrentValue;
        $this->country->ViewCustomAttributes = "";

        // city
        $this->city->ViewValue = $this->city->CurrentValue;
        $this->city->ViewCustomAttributes = "";

        // position
        $this->position->ViewValue = $this->position->CurrentValue;
        $this->position->ViewCustomAttributes = "";

        // category
        $this->category->ViewValue = $this->category->CurrentValue;
        $this->category->ViewCustomAttributes = "";

        // industry
        $this->industry->ViewValue = $this->industry->CurrentValue;
        $this->industry->ViewCustomAttributes = "";

        // driving_license
        $this->driving_license->ViewValue = $this->driving_license->CurrentValue;
        $this->driving_license->ViewCustomAttributes = "";

        // visa_status
        $this->visa_status->ViewValue = $this->visa_status->CurrentValue;
        $this->visa_status->ViewCustomAttributes = "";

        // current_salary
        $this->current_salary->ViewValue = $this->current_salary->CurrentValue;
        $this->current_salary->ViewCustomAttributes = "";

        // excepted_salary
        $this->excepted_salary->ViewValue = $this->excepted_salary->CurrentValue;
        $this->excepted_salary->ViewCustomAttributes = "";

        // resume
        $this->resume->ViewValue = $this->resume->CurrentValue;
        $this->resume->ViewCustomAttributes = "";

        // cover_letter
        $this->cover_letter->ViewValue = $this->cover_letter->CurrentValue;
        $this->cover_letter->ViewCustomAttributes = "";

        // picture
        $this->picture->ViewValue = $this->picture->CurrentValue;
        $this->picture->ViewCustomAttributes = "";

        // passport
        $this->passport->ViewValue = $this->passport->CurrentValue;
        $this->passport->ViewCustomAttributes = "";

        // address
        $this->address->ViewValue = $this->address->CurrentValue;
        $this->address->ViewCustomAttributes = "";

        // linkedin_url
        $this->linkedin_url->ViewValue = $this->linkedin_url->CurrentValue;
        $this->linkedin_url->ViewCustomAttributes = "";

        // skype_id
        $this->skype_id->ViewValue = $this->skype_id->CurrentValue;
        $this->skype_id->ViewCustomAttributes = "";

        // passport_no
        $this->passport_no->ViewValue = $this->passport_no->CurrentValue;
        $this->passport_no->ViewCustomAttributes = "";

        // user_status
        $this->user_status->ViewValue = $this->user_status->CurrentValue;
        $this->user_status->ViewCustomAttributes = "";

        // created
        $this->created->ViewValue = $this->created->CurrentValue;
        $this->created->ViewValue = FormatDateTime($this->created->ViewValue, 0);
        $this->created->ViewCustomAttributes = "";

        // modified
        $this->modified->ViewValue = $this->modified->CurrentValue;
        $this->modified->ViewValue = FormatDateTime($this->modified->ViewValue, 0);
        $this->modified->ViewCustomAttributes = "";

        // facebook_url
        $this->facebook_url->ViewValue = $this->facebook_url->CurrentValue;
        $this->facebook_url->ViewCustomAttributes = "";

        // twitter_url
        $this->twitter_url->ViewValue = $this->twitter_url->CurrentValue;
        $this->twitter_url->ViewCustomAttributes = "";

        // verification
        $this->verification->ViewValue = $this->verification->CurrentValue;
        $this->verification->ViewCustomAttributes = "";

        // pwd_reset_code
        $this->pwd_reset_code->ViewValue = $this->pwd_reset_code->CurrentValue;
        $this->pwd_reset_code->ViewCustomAttributes = "";

        // firsttime
        if (ConvertToBool($this->firsttime->CurrentValue)) {
            $this->firsttime->ViewValue = $this->firsttime->tagCaption(1) != "" ? $this->firsttime->tagCaption(1) : "Yes";
        } else {
            $this->firsttime->ViewValue = $this->firsttime->tagCaption(2) != "" ? $this->firsttime->tagCaption(2) : "No";
        }
        $this->firsttime->ViewCustomAttributes = "";

        // blacklist
        if (ConvertToBool($this->blacklist->CurrentValue)) {
            $this->blacklist->ViewValue = $this->blacklist->tagCaption(1) != "" ? $this->blacklist->tagCaption(1) : "Yes";
        } else {
            $this->blacklist->ViewValue = $this->blacklist->tagCaption(2) != "" ? $this->blacklist->tagCaption(2) : "No";
        }
        $this->blacklist->ViewCustomAttributes = "";

        // hrm_business_unit_id
        $this->hrm_business_unit_id->ViewValue = $this->hrm_business_unit_id->CurrentValue;
        $this->hrm_business_unit_id->ViewValue = FormatNumber($this->hrm_business_unit_id->ViewValue, "");
        $this->hrm_business_unit_id->ViewCustomAttributes = "";

        // main_user_id
        $this->main_user_id->ViewValue = $this->main_user_id->CurrentValue;
        $this->main_user_id->ViewValue = FormatNumber($this->main_user_id->ViewValue, "");
        $this->main_user_id->ViewCustomAttributes = "";

        // department_id
        $this->department_id->ViewValue = $this->department_id->CurrentValue;
        $this->department_id->ViewValue = FormatNumber($this->department_id->ViewValue, "");
        $this->department_id->ViewCustomAttributes = "";

        // main_user_detail
        $this->main_user_detail->ViewValue = $this->main_user_detail->CurrentValue;
        $this->main_user_detail->ViewCustomAttributes = "";

        // profile_img
        $this->profile_img->ViewValue = $this->profile_img->CurrentValue;
        $this->profile_img->ViewCustomAttributes = "";

        // user_id
        $this->user_id->LinkCustomAttributes = "";
        $this->user_id->HrefValue = "";
        $this->user_id->TooltipValue = "";

        // oauth_provider
        $this->oauth_provider->LinkCustomAttributes = "";
        $this->oauth_provider->HrefValue = "";
        $this->oauth_provider->TooltipValue = "";

        // oauth_uid
        $this->oauth_uid->LinkCustomAttributes = "";
        $this->oauth_uid->HrefValue = "";
        $this->oauth_uid->TooltipValue = "";

        // user_type
        $this->user_type->LinkCustomAttributes = "";
        $this->user_type->HrefValue = "";
        $this->user_type->TooltipValue = "";

        // firstname
        $this->firstname->LinkCustomAttributes = "";
        $this->firstname->HrefValue = "";
        $this->firstname->TooltipValue = "";

        // lastname
        $this->lastname->LinkCustomAttributes = "";
        $this->lastname->HrefValue = "";
        $this->lastname->TooltipValue = "";

        // middlename
        $this->middlename->LinkCustomAttributes = "";
        $this->middlename->HrefValue = "";
        $this->middlename->TooltipValue = "";

        // email
        $this->_email->LinkCustomAttributes = "";
        $this->_email->HrefValue = "";
        $this->_email->TooltipValue = "";

        // password
        $this->_password->LinkCustomAttributes = "";
        $this->_password->HrefValue = "";
        $this->_password->TooltipValue = "";

        // mobile_number
        $this->mobile_number->LinkCustomAttributes = "";
        $this->mobile_number->HrefValue = "";
        $this->mobile_number->TooltipValue = "";

        // alternate_number
        $this->alternate_number->LinkCustomAttributes = "";
        $this->alternate_number->HrefValue = "";
        $this->alternate_number->TooltipValue = "";

        // gender
        $this->gender->LinkCustomAttributes = "";
        $this->gender->HrefValue = "";
        $this->gender->TooltipValue = "";

        // nationality
        $this->nationality->LinkCustomAttributes = "";
        $this->nationality->HrefValue = "";
        $this->nationality->TooltipValue = "";

        // dob
        $this->dob->LinkCustomAttributes = "";
        $this->dob->HrefValue = "";
        $this->dob->TooltipValue = "";

        // birthplace
        $this->birthplace->LinkCustomAttributes = "";
        $this->birthplace->HrefValue = "";
        $this->birthplace->TooltipValue = "";

        // languages
        $this->languages->LinkCustomAttributes = "";
        $this->languages->HrefValue = "";
        $this->languages->TooltipValue = "";

        // previousjobrole
        $this->previousjobrole->LinkCustomAttributes = "";
        $this->previousjobrole->HrefValue = "";
        $this->previousjobrole->TooltipValue = "";

        // martial_status
        $this->martial_status->LinkCustomAttributes = "";
        $this->martial_status->HrefValue = "";
        $this->martial_status->TooltipValue = "";

        // country
        $this->country->LinkCustomAttributes = "";
        $this->country->HrefValue = "";
        $this->country->TooltipValue = "";

        // city
        $this->city->LinkCustomAttributes = "";
        $this->city->HrefValue = "";
        $this->city->TooltipValue = "";

        // position
        $this->position->LinkCustomAttributes = "";
        $this->position->HrefValue = "";
        $this->position->TooltipValue = "";

        // category
        $this->category->LinkCustomAttributes = "";
        $this->category->HrefValue = "";
        $this->category->TooltipValue = "";

        // industry
        $this->industry->LinkCustomAttributes = "";
        $this->industry->HrefValue = "";
        $this->industry->TooltipValue = "";

        // driving_license
        $this->driving_license->LinkCustomAttributes = "";
        $this->driving_license->HrefValue = "";
        $this->driving_license->TooltipValue = "";

        // visa_status
        $this->visa_status->LinkCustomAttributes = "";
        $this->visa_status->HrefValue = "";
        $this->visa_status->TooltipValue = "";

        // current_salary
        $this->current_salary->LinkCustomAttributes = "";
        $this->current_salary->HrefValue = "";
        $this->current_salary->TooltipValue = "";

        // excepted_salary
        $this->excepted_salary->LinkCustomAttributes = "";
        $this->excepted_salary->HrefValue = "";
        $this->excepted_salary->TooltipValue = "";

        // resume
        $this->resume->LinkCustomAttributes = "";
        $this->resume->HrefValue = "";
        $this->resume->TooltipValue = "";

        // cover_letter
        $this->cover_letter->LinkCustomAttributes = "";
        $this->cover_letter->HrefValue = "";
        $this->cover_letter->TooltipValue = "";

        // picture
        $this->picture->LinkCustomAttributes = "";
        $this->picture->HrefValue = "";
        $this->picture->TooltipValue = "";

        // passport
        $this->passport->LinkCustomAttributes = "";
        $this->passport->HrefValue = "";
        $this->passport->TooltipValue = "";

        // address
        $this->address->LinkCustomAttributes = "";
        $this->address->HrefValue = "";
        $this->address->TooltipValue = "";

        // linkedin_url
        $this->linkedin_url->LinkCustomAttributes = "";
        $this->linkedin_url->HrefValue = "";
        $this->linkedin_url->TooltipValue = "";

        // skype_id
        $this->skype_id->LinkCustomAttributes = "";
        $this->skype_id->HrefValue = "";
        $this->skype_id->TooltipValue = "";

        // passport_no
        $this->passport_no->LinkCustomAttributes = "";
        $this->passport_no->HrefValue = "";
        $this->passport_no->TooltipValue = "";

        // user_status
        $this->user_status->LinkCustomAttributes = "";
        $this->user_status->HrefValue = "";
        $this->user_status->TooltipValue = "";

        // created
        $this->created->LinkCustomAttributes = "";
        $this->created->HrefValue = "";
        $this->created->TooltipValue = "";

        // modified
        $this->modified->LinkCustomAttributes = "";
        $this->modified->HrefValue = "";
        $this->modified->TooltipValue = "";

        // facebook_url
        $this->facebook_url->LinkCustomAttributes = "";
        $this->facebook_url->HrefValue = "";
        $this->facebook_url->TooltipValue = "";

        // twitter_url
        $this->twitter_url->LinkCustomAttributes = "";
        $this->twitter_url->HrefValue = "";
        $this->twitter_url->TooltipValue = "";

        // verification
        $this->verification->LinkCustomAttributes = "";
        $this->verification->HrefValue = "";
        $this->verification->TooltipValue = "";

        // pwd_reset_code
        $this->pwd_reset_code->LinkCustomAttributes = "";
        $this->pwd_reset_code->HrefValue = "";
        $this->pwd_reset_code->TooltipValue = "";

        // firsttime
        $this->firsttime->LinkCustomAttributes = "";
        $this->firsttime->HrefValue = "";
        $this->firsttime->TooltipValue = "";

        // blacklist
        $this->blacklist->LinkCustomAttributes = "";
        $this->blacklist->HrefValue = "";
        $this->blacklist->TooltipValue = "";

        // hrm_business_unit_id
        $this->hrm_business_unit_id->LinkCustomAttributes = "";
        $this->hrm_business_unit_id->HrefValue = "";
        $this->hrm_business_unit_id->TooltipValue = "";

        // main_user_id
        $this->main_user_id->LinkCustomAttributes = "";
        $this->main_user_id->HrefValue = "";
        $this->main_user_id->TooltipValue = "";

        // department_id
        $this->department_id->LinkCustomAttributes = "";
        $this->department_id->HrefValue = "";
        $this->department_id->TooltipValue = "";

        // main_user_detail
        $this->main_user_detail->LinkCustomAttributes = "";
        $this->main_user_detail->HrefValue = "";
        $this->main_user_detail->TooltipValue = "";

        // profile_img
        $this->profile_img->LinkCustomAttributes = "";
        $this->profile_img->HrefValue = "";
        $this->profile_img->TooltipValue = "";

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

        // user_id
        $this->user_id->setupEditAttributes();
        $this->user_id->EditCustomAttributes = "";
        $this->user_id->EditValue = $this->user_id->CurrentValue;
        $this->user_id->ViewCustomAttributes = "";

        // oauth_provider
        $this->oauth_provider->setupEditAttributes();
        $this->oauth_provider->EditCustomAttributes = "";
        if (!$this->oauth_provider->Raw) {
            $this->oauth_provider->CurrentValue = HtmlDecode($this->oauth_provider->CurrentValue);
        }
        $this->oauth_provider->EditValue = $this->oauth_provider->CurrentValue;
        $this->oauth_provider->PlaceHolder = RemoveHtml($this->oauth_provider->caption());

        // oauth_uid
        $this->oauth_uid->setupEditAttributes();
        $this->oauth_uid->EditCustomAttributes = "";
        if (!$this->oauth_uid->Raw) {
            $this->oauth_uid->CurrentValue = HtmlDecode($this->oauth_uid->CurrentValue);
        }
        $this->oauth_uid->EditValue = $this->oauth_uid->CurrentValue;
        $this->oauth_uid->PlaceHolder = RemoveHtml($this->oauth_uid->caption());

        // user_type
        $this->user_type->setupEditAttributes();
        $this->user_type->EditCustomAttributes = "";
        if (!$this->user_type->Raw) {
            $this->user_type->CurrentValue = HtmlDecode($this->user_type->CurrentValue);
        }
        $this->user_type->EditValue = $this->user_type->CurrentValue;
        $this->user_type->PlaceHolder = RemoveHtml($this->user_type->caption());

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

        // middlename
        $this->middlename->setupEditAttributes();
        $this->middlename->EditCustomAttributes = "";
        if (!$this->middlename->Raw) {
            $this->middlename->CurrentValue = HtmlDecode($this->middlename->CurrentValue);
        }
        $this->middlename->EditValue = $this->middlename->CurrentValue;
        $this->middlename->PlaceHolder = RemoveHtml($this->middlename->caption());

        // email
        $this->_email->setupEditAttributes();
        $this->_email->EditCustomAttributes = "";
        if (!$this->_email->Raw) {
            $this->_email->CurrentValue = HtmlDecode($this->_email->CurrentValue);
        }
        $this->_email->EditValue = $this->_email->CurrentValue;
        $this->_email->PlaceHolder = RemoveHtml($this->_email->caption());

        // password
        $this->_password->setupEditAttributes();
        $this->_password->EditCustomAttributes = "";
        if (!$this->_password->Raw) {
            $this->_password->CurrentValue = HtmlDecode($this->_password->CurrentValue);
        }
        $this->_password->EditValue = $this->_password->CurrentValue;
        $this->_password->PlaceHolder = RemoveHtml($this->_password->caption());

        // mobile_number
        $this->mobile_number->setupEditAttributes();
        $this->mobile_number->EditCustomAttributes = "";
        if (!$this->mobile_number->Raw) {
            $this->mobile_number->CurrentValue = HtmlDecode($this->mobile_number->CurrentValue);
        }
        $this->mobile_number->EditValue = $this->mobile_number->CurrentValue;
        $this->mobile_number->PlaceHolder = RemoveHtml($this->mobile_number->caption());

        // alternate_number
        $this->alternate_number->setupEditAttributes();
        $this->alternate_number->EditCustomAttributes = "";
        if (!$this->alternate_number->Raw) {
            $this->alternate_number->CurrentValue = HtmlDecode($this->alternate_number->CurrentValue);
        }
        $this->alternate_number->EditValue = $this->alternate_number->CurrentValue;
        $this->alternate_number->PlaceHolder = RemoveHtml($this->alternate_number->caption());

        // gender
        $this->gender->setupEditAttributes();
        $this->gender->EditCustomAttributes = "";
        if (!$this->gender->Raw) {
            $this->gender->CurrentValue = HtmlDecode($this->gender->CurrentValue);
        }
        $this->gender->EditValue = $this->gender->CurrentValue;
        $this->gender->PlaceHolder = RemoveHtml($this->gender->caption());

        // nationality
        $this->nationality->setupEditAttributes();
        $this->nationality->EditCustomAttributes = "";
        if (!$this->nationality->Raw) {
            $this->nationality->CurrentValue = HtmlDecode($this->nationality->CurrentValue);
        }
        $this->nationality->EditValue = $this->nationality->CurrentValue;
        $this->nationality->PlaceHolder = RemoveHtml($this->nationality->caption());

        // dob
        $this->dob->setupEditAttributes();
        $this->dob->EditCustomAttributes = "";
        if (!$this->dob->Raw) {
            $this->dob->CurrentValue = HtmlDecode($this->dob->CurrentValue);
        }
        $this->dob->EditValue = $this->dob->CurrentValue;
        $this->dob->PlaceHolder = RemoveHtml($this->dob->caption());

        // birthplace
        $this->birthplace->setupEditAttributes();
        $this->birthplace->EditCustomAttributes = "";
        if (!$this->birthplace->Raw) {
            $this->birthplace->CurrentValue = HtmlDecode($this->birthplace->CurrentValue);
        }
        $this->birthplace->EditValue = $this->birthplace->CurrentValue;
        $this->birthplace->PlaceHolder = RemoveHtml($this->birthplace->caption());

        // languages
        $this->languages->setupEditAttributes();
        $this->languages->EditCustomAttributes = "";
        if (!$this->languages->Raw) {
            $this->languages->CurrentValue = HtmlDecode($this->languages->CurrentValue);
        }
        $this->languages->EditValue = $this->languages->CurrentValue;
        $this->languages->PlaceHolder = RemoveHtml($this->languages->caption());

        // previousjobrole
        $this->previousjobrole->setupEditAttributes();
        $this->previousjobrole->EditCustomAttributes = "";
        if (!$this->previousjobrole->Raw) {
            $this->previousjobrole->CurrentValue = HtmlDecode($this->previousjobrole->CurrentValue);
        }
        $this->previousjobrole->EditValue = $this->previousjobrole->CurrentValue;
        $this->previousjobrole->PlaceHolder = RemoveHtml($this->previousjobrole->caption());

        // martial_status
        $this->martial_status->setupEditAttributes();
        $this->martial_status->EditCustomAttributes = "";
        if (!$this->martial_status->Raw) {
            $this->martial_status->CurrentValue = HtmlDecode($this->martial_status->CurrentValue);
        }
        $this->martial_status->EditValue = $this->martial_status->CurrentValue;
        $this->martial_status->PlaceHolder = RemoveHtml($this->martial_status->caption());

        // country
        $this->country->setupEditAttributes();
        $this->country->EditCustomAttributes = "";
        if (!$this->country->Raw) {
            $this->country->CurrentValue = HtmlDecode($this->country->CurrentValue);
        }
        $this->country->EditValue = $this->country->CurrentValue;
        $this->country->PlaceHolder = RemoveHtml($this->country->caption());

        // city
        $this->city->setupEditAttributes();
        $this->city->EditCustomAttributes = "";
        if (!$this->city->Raw) {
            $this->city->CurrentValue = HtmlDecode($this->city->CurrentValue);
        }
        $this->city->EditValue = $this->city->CurrentValue;
        $this->city->PlaceHolder = RemoveHtml($this->city->caption());

        // position
        $this->position->setupEditAttributes();
        $this->position->EditCustomAttributes = "";
        if (!$this->position->Raw) {
            $this->position->CurrentValue = HtmlDecode($this->position->CurrentValue);
        }
        $this->position->EditValue = $this->position->CurrentValue;
        $this->position->PlaceHolder = RemoveHtml($this->position->caption());

        // category
        $this->category->setupEditAttributes();
        $this->category->EditCustomAttributes = "";
        if (!$this->category->Raw) {
            $this->category->CurrentValue = HtmlDecode($this->category->CurrentValue);
        }
        $this->category->EditValue = $this->category->CurrentValue;
        $this->category->PlaceHolder = RemoveHtml($this->category->caption());

        // industry
        $this->industry->setupEditAttributes();
        $this->industry->EditCustomAttributes = "";
        if (!$this->industry->Raw) {
            $this->industry->CurrentValue = HtmlDecode($this->industry->CurrentValue);
        }
        $this->industry->EditValue = $this->industry->CurrentValue;
        $this->industry->PlaceHolder = RemoveHtml($this->industry->caption());

        // driving_license
        $this->driving_license->setupEditAttributes();
        $this->driving_license->EditCustomAttributes = "";
        if (!$this->driving_license->Raw) {
            $this->driving_license->CurrentValue = HtmlDecode($this->driving_license->CurrentValue);
        }
        $this->driving_license->EditValue = $this->driving_license->CurrentValue;
        $this->driving_license->PlaceHolder = RemoveHtml($this->driving_license->caption());

        // visa_status
        $this->visa_status->setupEditAttributes();
        $this->visa_status->EditCustomAttributes = "";
        if (!$this->visa_status->Raw) {
            $this->visa_status->CurrentValue = HtmlDecode($this->visa_status->CurrentValue);
        }
        $this->visa_status->EditValue = $this->visa_status->CurrentValue;
        $this->visa_status->PlaceHolder = RemoveHtml($this->visa_status->caption());

        // current_salary
        $this->current_salary->setupEditAttributes();
        $this->current_salary->EditCustomAttributes = "";
        if (!$this->current_salary->Raw) {
            $this->current_salary->CurrentValue = HtmlDecode($this->current_salary->CurrentValue);
        }
        $this->current_salary->EditValue = $this->current_salary->CurrentValue;
        $this->current_salary->PlaceHolder = RemoveHtml($this->current_salary->caption());

        // excepted_salary
        $this->excepted_salary->setupEditAttributes();
        $this->excepted_salary->EditCustomAttributes = "";
        if (!$this->excepted_salary->Raw) {
            $this->excepted_salary->CurrentValue = HtmlDecode($this->excepted_salary->CurrentValue);
        }
        $this->excepted_salary->EditValue = $this->excepted_salary->CurrentValue;
        $this->excepted_salary->PlaceHolder = RemoveHtml($this->excepted_salary->caption());

        // resume
        $this->resume->setupEditAttributes();
        $this->resume->EditCustomAttributes = "";
        if (!$this->resume->Raw) {
            $this->resume->CurrentValue = HtmlDecode($this->resume->CurrentValue);
        }
        $this->resume->EditValue = $this->resume->CurrentValue;
        $this->resume->PlaceHolder = RemoveHtml($this->resume->caption());

        // cover_letter
        $this->cover_letter->setupEditAttributes();
        $this->cover_letter->EditCustomAttributes = "";
        if (!$this->cover_letter->Raw) {
            $this->cover_letter->CurrentValue = HtmlDecode($this->cover_letter->CurrentValue);
        }
        $this->cover_letter->EditValue = $this->cover_letter->CurrentValue;
        $this->cover_letter->PlaceHolder = RemoveHtml($this->cover_letter->caption());

        // picture
        $this->picture->setupEditAttributes();
        $this->picture->EditCustomAttributes = "";
        if (!$this->picture->Raw) {
            $this->picture->CurrentValue = HtmlDecode($this->picture->CurrentValue);
        }
        $this->picture->EditValue = $this->picture->CurrentValue;
        $this->picture->PlaceHolder = RemoveHtml($this->picture->caption());

        // passport
        $this->passport->setupEditAttributes();
        $this->passport->EditCustomAttributes = "";
        if (!$this->passport->Raw) {
            $this->passport->CurrentValue = HtmlDecode($this->passport->CurrentValue);
        }
        $this->passport->EditValue = $this->passport->CurrentValue;
        $this->passport->PlaceHolder = RemoveHtml($this->passport->caption());

        // address
        $this->address->setupEditAttributes();
        $this->address->EditCustomAttributes = "";
        if (!$this->address->Raw) {
            $this->address->CurrentValue = HtmlDecode($this->address->CurrentValue);
        }
        $this->address->EditValue = $this->address->CurrentValue;
        $this->address->PlaceHolder = RemoveHtml($this->address->caption());

        // linkedin_url
        $this->linkedin_url->setupEditAttributes();
        $this->linkedin_url->EditCustomAttributes = "";
        if (!$this->linkedin_url->Raw) {
            $this->linkedin_url->CurrentValue = HtmlDecode($this->linkedin_url->CurrentValue);
        }
        $this->linkedin_url->EditValue = $this->linkedin_url->CurrentValue;
        $this->linkedin_url->PlaceHolder = RemoveHtml($this->linkedin_url->caption());

        // skype_id
        $this->skype_id->setupEditAttributes();
        $this->skype_id->EditCustomAttributes = "";
        if (!$this->skype_id->Raw) {
            $this->skype_id->CurrentValue = HtmlDecode($this->skype_id->CurrentValue);
        }
        $this->skype_id->EditValue = $this->skype_id->CurrentValue;
        $this->skype_id->PlaceHolder = RemoveHtml($this->skype_id->caption());

        // passport_no
        $this->passport_no->setupEditAttributes();
        $this->passport_no->EditCustomAttributes = "";
        if (!$this->passport_no->Raw) {
            $this->passport_no->CurrentValue = HtmlDecode($this->passport_no->CurrentValue);
        }
        $this->passport_no->EditValue = $this->passport_no->CurrentValue;
        $this->passport_no->PlaceHolder = RemoveHtml($this->passport_no->caption());

        // user_status
        $this->user_status->setupEditAttributes();
        $this->user_status->EditCustomAttributes = "";
        if (!$this->user_status->Raw) {
            $this->user_status->CurrentValue = HtmlDecode($this->user_status->CurrentValue);
        }
        $this->user_status->EditValue = $this->user_status->CurrentValue;
        $this->user_status->PlaceHolder = RemoveHtml($this->user_status->caption());

        // created
        $this->created->setupEditAttributes();
        $this->created->EditCustomAttributes = "";
        $this->created->EditValue = FormatDateTime($this->created->CurrentValue, 8);
        $this->created->PlaceHolder = RemoveHtml($this->created->caption());

        // modified
        $this->modified->setupEditAttributes();
        $this->modified->EditCustomAttributes = "";
        $this->modified->EditValue = FormatDateTime($this->modified->CurrentValue, 8);
        $this->modified->PlaceHolder = RemoveHtml($this->modified->caption());

        // facebook_url
        $this->facebook_url->setupEditAttributes();
        $this->facebook_url->EditCustomAttributes = "";
        $this->facebook_url->EditValue = $this->facebook_url->CurrentValue;
        $this->facebook_url->PlaceHolder = RemoveHtml($this->facebook_url->caption());

        // twitter_url
        $this->twitter_url->setupEditAttributes();
        $this->twitter_url->EditCustomAttributes = "";
        $this->twitter_url->EditValue = $this->twitter_url->CurrentValue;
        $this->twitter_url->PlaceHolder = RemoveHtml($this->twitter_url->caption());

        // verification
        $this->verification->setupEditAttributes();
        $this->verification->EditCustomAttributes = "";
        if (!$this->verification->Raw) {
            $this->verification->CurrentValue = HtmlDecode($this->verification->CurrentValue);
        }
        $this->verification->EditValue = $this->verification->CurrentValue;
        $this->verification->PlaceHolder = RemoveHtml($this->verification->caption());

        // pwd_reset_code
        $this->pwd_reset_code->setupEditAttributes();
        $this->pwd_reset_code->EditCustomAttributes = "";
        if (!$this->pwd_reset_code->Raw) {
            $this->pwd_reset_code->CurrentValue = HtmlDecode($this->pwd_reset_code->CurrentValue);
        }
        $this->pwd_reset_code->EditValue = $this->pwd_reset_code->CurrentValue;
        $this->pwd_reset_code->PlaceHolder = RemoveHtml($this->pwd_reset_code->caption());

        // firsttime
        $this->firsttime->EditCustomAttributes = "";
        $this->firsttime->EditValue = $this->firsttime->options(false);
        $this->firsttime->PlaceHolder = RemoveHtml($this->firsttime->caption());

        // blacklist
        $this->blacklist->EditCustomAttributes = "";
        $this->blacklist->EditValue = $this->blacklist->options(false);
        $this->blacklist->PlaceHolder = RemoveHtml($this->blacklist->caption());

        // hrm_business_unit_id
        $this->hrm_business_unit_id->setupEditAttributes();
        $this->hrm_business_unit_id->EditCustomAttributes = "";
        $this->hrm_business_unit_id->EditValue = $this->hrm_business_unit_id->CurrentValue;
        $this->hrm_business_unit_id->PlaceHolder = RemoveHtml($this->hrm_business_unit_id->caption());
        if (strval($this->hrm_business_unit_id->EditValue) != "" && is_numeric($this->hrm_business_unit_id->EditValue)) {
            $this->hrm_business_unit_id->EditValue = FormatNumber($this->hrm_business_unit_id->EditValue, null);
        }

        // main_user_id
        $this->main_user_id->setupEditAttributes();
        $this->main_user_id->EditCustomAttributes = "";
        $this->main_user_id->EditValue = $this->main_user_id->CurrentValue;
        $this->main_user_id->PlaceHolder = RemoveHtml($this->main_user_id->caption());
        if (strval($this->main_user_id->EditValue) != "" && is_numeric($this->main_user_id->EditValue)) {
            $this->main_user_id->EditValue = FormatNumber($this->main_user_id->EditValue, null);
        }

        // department_id
        $this->department_id->setupEditAttributes();
        $this->department_id->EditCustomAttributes = "";
        $this->department_id->EditValue = $this->department_id->CurrentValue;
        $this->department_id->PlaceHolder = RemoveHtml($this->department_id->caption());
        if (strval($this->department_id->EditValue) != "" && is_numeric($this->department_id->EditValue)) {
            $this->department_id->EditValue = FormatNumber($this->department_id->EditValue, null);
        }

        // main_user_detail
        $this->main_user_detail->setupEditAttributes();
        $this->main_user_detail->EditCustomAttributes = "";
        $this->main_user_detail->EditValue = $this->main_user_detail->CurrentValue;
        $this->main_user_detail->PlaceHolder = RemoveHtml($this->main_user_detail->caption());

        // profile_img
        $this->profile_img->setupEditAttributes();
        $this->profile_img->EditCustomAttributes = "";
        if (!$this->profile_img->Raw) {
            $this->profile_img->CurrentValue = HtmlDecode($this->profile_img->CurrentValue);
        }
        $this->profile_img->EditValue = $this->profile_img->CurrentValue;
        $this->profile_img->PlaceHolder = RemoveHtml($this->profile_img->caption());

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
                    $doc->exportCaption($this->user_id);
                    $doc->exportCaption($this->oauth_provider);
                    $doc->exportCaption($this->oauth_uid);
                    $doc->exportCaption($this->user_type);
                    $doc->exportCaption($this->firstname);
                    $doc->exportCaption($this->lastname);
                    $doc->exportCaption($this->middlename);
                    $doc->exportCaption($this->_email);
                    $doc->exportCaption($this->_password);
                    $doc->exportCaption($this->mobile_number);
                    $doc->exportCaption($this->alternate_number);
                    $doc->exportCaption($this->gender);
                    $doc->exportCaption($this->nationality);
                    $doc->exportCaption($this->dob);
                    $doc->exportCaption($this->birthplace);
                    $doc->exportCaption($this->languages);
                    $doc->exportCaption($this->previousjobrole);
                    $doc->exportCaption($this->martial_status);
                    $doc->exportCaption($this->country);
                    $doc->exportCaption($this->city);
                    $doc->exportCaption($this->position);
                    $doc->exportCaption($this->category);
                    $doc->exportCaption($this->industry);
                    $doc->exportCaption($this->driving_license);
                    $doc->exportCaption($this->visa_status);
                    $doc->exportCaption($this->current_salary);
                    $doc->exportCaption($this->excepted_salary);
                    $doc->exportCaption($this->resume);
                    $doc->exportCaption($this->cover_letter);
                    $doc->exportCaption($this->picture);
                    $doc->exportCaption($this->passport);
                    $doc->exportCaption($this->address);
                    $doc->exportCaption($this->linkedin_url);
                    $doc->exportCaption($this->skype_id);
                    $doc->exportCaption($this->passport_no);
                    $doc->exportCaption($this->user_status);
                    $doc->exportCaption($this->created);
                    $doc->exportCaption($this->modified);
                    $doc->exportCaption($this->facebook_url);
                    $doc->exportCaption($this->twitter_url);
                    $doc->exportCaption($this->verification);
                    $doc->exportCaption($this->pwd_reset_code);
                    $doc->exportCaption($this->firsttime);
                    $doc->exportCaption($this->blacklist);
                    $doc->exportCaption($this->hrm_business_unit_id);
                    $doc->exportCaption($this->main_user_id);
                    $doc->exportCaption($this->department_id);
                    $doc->exportCaption($this->main_user_detail);
                    $doc->exportCaption($this->profile_img);
                } else {
                    $doc->exportCaption($this->user_id);
                    $doc->exportCaption($this->oauth_provider);
                    $doc->exportCaption($this->oauth_uid);
                    $doc->exportCaption($this->user_type);
                    $doc->exportCaption($this->firstname);
                    $doc->exportCaption($this->lastname);
                    $doc->exportCaption($this->middlename);
                    $doc->exportCaption($this->_email);
                    $doc->exportCaption($this->_password);
                    $doc->exportCaption($this->mobile_number);
                    $doc->exportCaption($this->alternate_number);
                    $doc->exportCaption($this->gender);
                    $doc->exportCaption($this->nationality);
                    $doc->exportCaption($this->dob);
                    $doc->exportCaption($this->birthplace);
                    $doc->exportCaption($this->languages);
                    $doc->exportCaption($this->previousjobrole);
                    $doc->exportCaption($this->martial_status);
                    $doc->exportCaption($this->country);
                    $doc->exportCaption($this->city);
                    $doc->exportCaption($this->position);
                    $doc->exportCaption($this->category);
                    $doc->exportCaption($this->industry);
                    $doc->exportCaption($this->driving_license);
                    $doc->exportCaption($this->visa_status);
                    $doc->exportCaption($this->current_salary);
                    $doc->exportCaption($this->excepted_salary);
                    $doc->exportCaption($this->resume);
                    $doc->exportCaption($this->cover_letter);
                    $doc->exportCaption($this->picture);
                    $doc->exportCaption($this->passport);
                    $doc->exportCaption($this->address);
                    $doc->exportCaption($this->linkedin_url);
                    $doc->exportCaption($this->skype_id);
                    $doc->exportCaption($this->passport_no);
                    $doc->exportCaption($this->user_status);
                    $doc->exportCaption($this->created);
                    $doc->exportCaption($this->modified);
                    $doc->exportCaption($this->verification);
                    $doc->exportCaption($this->pwd_reset_code);
                    $doc->exportCaption($this->firsttime);
                    $doc->exportCaption($this->blacklist);
                    $doc->exportCaption($this->hrm_business_unit_id);
                    $doc->exportCaption($this->main_user_id);
                    $doc->exportCaption($this->department_id);
                    $doc->exportCaption($this->profile_img);
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
                        $doc->exportField($this->user_id);
                        $doc->exportField($this->oauth_provider);
                        $doc->exportField($this->oauth_uid);
                        $doc->exportField($this->user_type);
                        $doc->exportField($this->firstname);
                        $doc->exportField($this->lastname);
                        $doc->exportField($this->middlename);
                        $doc->exportField($this->_email);
                        $doc->exportField($this->_password);
                        $doc->exportField($this->mobile_number);
                        $doc->exportField($this->alternate_number);
                        $doc->exportField($this->gender);
                        $doc->exportField($this->nationality);
                        $doc->exportField($this->dob);
                        $doc->exportField($this->birthplace);
                        $doc->exportField($this->languages);
                        $doc->exportField($this->previousjobrole);
                        $doc->exportField($this->martial_status);
                        $doc->exportField($this->country);
                        $doc->exportField($this->city);
                        $doc->exportField($this->position);
                        $doc->exportField($this->category);
                        $doc->exportField($this->industry);
                        $doc->exportField($this->driving_license);
                        $doc->exportField($this->visa_status);
                        $doc->exportField($this->current_salary);
                        $doc->exportField($this->excepted_salary);
                        $doc->exportField($this->resume);
                        $doc->exportField($this->cover_letter);
                        $doc->exportField($this->picture);
                        $doc->exportField($this->passport);
                        $doc->exportField($this->address);
                        $doc->exportField($this->linkedin_url);
                        $doc->exportField($this->skype_id);
                        $doc->exportField($this->passport_no);
                        $doc->exportField($this->user_status);
                        $doc->exportField($this->created);
                        $doc->exportField($this->modified);
                        $doc->exportField($this->facebook_url);
                        $doc->exportField($this->twitter_url);
                        $doc->exportField($this->verification);
                        $doc->exportField($this->pwd_reset_code);
                        $doc->exportField($this->firsttime);
                        $doc->exportField($this->blacklist);
                        $doc->exportField($this->hrm_business_unit_id);
                        $doc->exportField($this->main_user_id);
                        $doc->exportField($this->department_id);
                        $doc->exportField($this->main_user_detail);
                        $doc->exportField($this->profile_img);
                    } else {
                        $doc->exportField($this->user_id);
                        $doc->exportField($this->oauth_provider);
                        $doc->exportField($this->oauth_uid);
                        $doc->exportField($this->user_type);
                        $doc->exportField($this->firstname);
                        $doc->exportField($this->lastname);
                        $doc->exportField($this->middlename);
                        $doc->exportField($this->_email);
                        $doc->exportField($this->_password);
                        $doc->exportField($this->mobile_number);
                        $doc->exportField($this->alternate_number);
                        $doc->exportField($this->gender);
                        $doc->exportField($this->nationality);
                        $doc->exportField($this->dob);
                        $doc->exportField($this->birthplace);
                        $doc->exportField($this->languages);
                        $doc->exportField($this->previousjobrole);
                        $doc->exportField($this->martial_status);
                        $doc->exportField($this->country);
                        $doc->exportField($this->city);
                        $doc->exportField($this->position);
                        $doc->exportField($this->category);
                        $doc->exportField($this->industry);
                        $doc->exportField($this->driving_license);
                        $doc->exportField($this->visa_status);
                        $doc->exportField($this->current_salary);
                        $doc->exportField($this->excepted_salary);
                        $doc->exportField($this->resume);
                        $doc->exportField($this->cover_letter);
                        $doc->exportField($this->picture);
                        $doc->exportField($this->passport);
                        $doc->exportField($this->address);
                        $doc->exportField($this->linkedin_url);
                        $doc->exportField($this->skype_id);
                        $doc->exportField($this->passport_no);
                        $doc->exportField($this->user_status);
                        $doc->exportField($this->created);
                        $doc->exportField($this->modified);
                        $doc->exportField($this->verification);
                        $doc->exportField($this->pwd_reset_code);
                        $doc->exportField($this->firsttime);
                        $doc->exportField($this->blacklist);
                        $doc->exportField($this->hrm_business_unit_id);
                        $doc->exportField($this->main_user_id);
                        $doc->exportField($this->department_id);
                        $doc->exportField($this->profile_img);
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
        $table = 'users';
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
        $table = 'users';

        // Get key value
        $key = "";
        if ($key != "") {
            $key .= Config("COMPOSITE_KEY_SEPARATOR");
        }
        $key .= $rs['user_id'];

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
        $table = 'users';

        // Get key value
        $key = "";
        if ($key != "") {
            $key .= Config("COMPOSITE_KEY_SEPARATOR");
        }
        $key .= $rsold['user_id'];

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
        $table = 'users';

        // Get key value
        $key = "";
        if ($key != "") {
            $key .= Config("COMPOSITE_KEY_SEPARATOR");
        }
        $key .= $rs['user_id'];

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
