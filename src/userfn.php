<?php

namespace PHPMaker2022\wfg_appraisal;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Container\ContainerInterface;
use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;
use Slim\App;
use Slim\Routing\RouteCollectorProxy;

// Filter for 'Last Month' (example)
function GetLastMonthFilter($FldExpression, $dbid = 0)
{
    $today = getdate();
    $lastmonth = mktime(0, 0, 0, $today['mon'] - 1, 1, $today['year']);
    $val = date("Y|m", $lastmonth);
    $wrk = $FldExpression . " BETWEEN " .
        QuotedValue(DateValue("month", $val, 1, $dbid), DATATYPE_DATE, $dbid) .
        " AND " .
        QuotedValue(DateValue("month", $val, 2, $dbid), DATATYPE_DATE, $dbid);
    return $wrk;
}

// Filter for 'Starts With A' (example)
function GetStartsWithAFilter($FldExpression, $dbid = 0)
{
    return $FldExpression . Like("'A%'", $dbid);
}

// Global user functions

// Database Connecting event
function Database_Connecting(&$info)
{
    // Example:
    //var_dump($info);
    //if ($info["id"] == "DB" && IsLocal()) { // Testing on local PC
    //    $info["host"] = "locahost";
    //    $info["user"] = "root";
    //    $info["pass"] = "";
    //}
}

// Database Connected event
function Database_Connected(&$conn)
{
    // Example:
    //if ($conn->info["id"] == "DB") {
    //    $conn->executeQuery("Your SQL");
    //}
}

function MenuItem_Adding($item)
{
    //var_dump($item);
    // Return false if menu item not allowed
    return true;
}

function Menu_Rendering($menu)
{
    // Change menu items here
}

function Menu_Rendered($menu)
{
    // Clean up here
}

// Page Loading event
function Page_Loading()
{
    //Log("Page Loading");
}

// Page Rendering event
function Page_Rendering()
{
    //Log("Page Rendering");
}

// Page Unloaded event
function Page_Unloaded()
{
    //Log("Page Unloaded");
}

// AuditTrail Inserting event
function AuditTrail_Inserting(&$rsnew)
{
    //var_dump($rsnew);
    return true;
}

// Personal Data Downloading event
function PersonalData_Downloading(&$row)
{
    //Log("PersonalData Downloading");
}

// Personal Data Deleted event
function PersonalData_Deleted($row)
{
    //Log("PersonalData Deleted");
}

// Route Action event
function Route_Action($app)
{
    // Example:
    // $app->get('/myaction', function ($request, $response, $args) {
    //    return $response->withJson(["name" => "myaction"]); // Note: Always return Psr\Http\Message\ResponseInterface object
    // });
    // $app->get('/myaction2', function ($request, $response, $args) {
    //    return $response->withJson(["name" => "myaction2"]); // Note: Always return Psr\Http\Message\ResponseInterface object
    // });
}

// API Action event
function Api_Action($app)
{
  $app->post('/postAppraisalResponse', function ($request, $response, $args) {
        $data= $_REQUEST['appraisal_data'];
        $resp = submitEmployeeAppraisalResponse($data['emp_id'],$data['appraisal_id'],json_encode($data['response']));
        return $response->withJson(["message" => $resp]);  // Return Psr\Http\Message\ResponseInterface object 
    });
 $app->post('/postLineManagerOneResponse', function ($request, $response, $args) {
        $data= $_REQUEST['appraisal_data'];
        $current_user_id = $_REQUEST['current_user_id'];
        $resp = submitLineManagerOneAppraisalResponse($current_user_id, $data['emp_id'],$data['appraisal_id'],json_encode($data['response']));
        debugCode($resp);
        return $response->withJson(["message" => $resp]);  // Return Psr\Http\Message\ResponseInterface object 
    });
   $app->post('/postLineManagerTwoResponse', function ($request, $response, $args) {
        $data= $_REQUEST['appraisal_data'];
        $current_user_id = $_REQUEST['current_user_id'];
        $resp = submitLineManagerTwoAppraisalResponse($current_user_id, $data['emp_id'],$data['appraisal_id'],json_encode($data['response']));
        return $response->withJson(["message" => $resp]);  // Return Psr\Http\Message\ResponseInterface object 
    });
   $app->post('/sendToLineManager', function ($request, $response, $args) {
        $current_user_id= $_REQUEST['current_user_id'];
        $appraisal_id= $_REQUEST['appraisal_id'];
        $user_id= $_REQUEST['user_id'];
        $level= $_REQUEST['level'];
        $resp = sendAppraisalToLineManager($appraisal_id, $user_id, $level);
        return $response->withJson(["message" => $resp]);  // Return Psr\Http\Message\ResponseInterface object 
    });
}

// Container Build event
function Container_Build($builder)
{
    // Example:
    // $builder->addDefinitions([
    //    "myservice" => function (ContainerInterface $c) {
    //        // your code to provide the service, e.g.
    //        return new MyService();
    //    },
    //    "myservice2" => function (ContainerInterface $c) {
    //        // your code to provide the service, e.g.
    //        return new MyService2();
    //    }
    // ]);
}

use Firebase\JWT\JWT;

function getAppraisalDetails($appraisalId){
	return ExecuteRow("SELECT MPI.*, BU.unitname, G.id as group_id, G.group_name FROM main_pa_initialization MPI
						INNER JOIN main_businessunits BU ON MPI.business_unit=BU.id
						INNER JOIN main_pa_groups G ON MPI.group_id=G.id
						 WHERE MPI.id=".$appraisalId); 
}

function getAppraisalFromGroup($groupId){
	return ExecuteRow("SELECT MPI.*, BU.unitname, G.id as group_id, G.group_name FROM main_pa_initialization MPI
						INNER JOIN main_businessunits BU ON MPI.business_unit=BU.id
						INNER JOIN main_pa_groups G ON MPI.group_id=G.id
						 WHERE MPI.group_id=".$groupId); 
}

function getAppraisalQuestions($group){
	return ExecuteRows("SELECT GQ.*, Q.question, Q.description FROM main_group_pa_questions GQ
						INNER JOIN main_pa_questions Q ON GQ.question=Q.id WHERE GQ.group=".$group." ORDER BY id DESC");
}

function getAppraisalRatings($ratingId){
	return ExecuteRows("SELECT * FROM main_pa_ratings WHERE rating_type=".$ratingId);
}

function getGroupEmployees($groupId){
	return ExecuteRows("SELECT GE.*, MU.emprole, MU.userstatus, MU.firstname, MU.lastname, MU.emailaddress FROM main_pa_groups_employees GE INNER JOIN main_users MU
	ON GE.employee_id=MU.id WHERE GE.group_id=".$groupId);
}

function getEmployeeGroup($userId){
	return ExecuteRows("SELECT GE.*, MU.emprole, MU.userstatus, MU.firstname, MU.lastname, MU.emailaddress FROM main_pa_groups_employees GE INNER JOIN main_users MU
	ON GE.employee_id=MU.id WHERE MU.id=".$userId);
}

function getRatingDetails($groupId){
	return ExecuteRows("SELECT GE.*, MU.emprole, MU.userstatus, MU.firstname, MU.lastname, MU.emailaddress FROM main_pa_groups_employees GE INNER JOIN main_users MU
	ON GE.employee_id=MU.id WHERE GE.group_id=".$groupId);
}

function getEmployeeDetails($empId){
	return ExecuteRow("SELECT * FROM main_users WHERE id=".$empId);
}

function getEmployeeAppraisalResponse($empId,$appraisalId){
	return ExecuteRow("SELECT * FROM main_pa_score WHERE appraisal=".$appraisalId." AND employee=".$empId);
}

function getAppraisalMessageTemplate($group){
	return ExecuteRow("SELECT * FROM message_templates WHERE recepient_group='".$group."'");
}

function getLineManager($group_id, $level ){
return ExecuteRow("SELECT GM.*, MU.firstname, MU.lastname, MU.emailaddress FROM main_pa_group_manager GM
	INNER JOIN main_users MU ON GM.line_manager=MU.id WHERE GM.group_id=".$group_id." AND GM.level=".$level);
}

function getConsolidatedScore($appraisal_id, $userId ){
return ExecuteScalar("SELECT consolidated_rating FROM main_pa_employee_ratings
WHERE employee_id=".$userId." AND appraisal_id=".$appraisal_id);
}

function createEmployeeRatings($userId,$appraisal_id){
$myResult = ExecuteUpdate("INSERT INTO main_pa_employee_ratings (appraisal_id, employee_id, appraisal_status, createdby, modifiedby, createddate, modifieddate)
VALUES (".$appraisal_id.", ".$userId.",'Pending Employee Ratings', ".CurrentUserID().",".CurrentUserID().",'".CurrentDate()."','".CurrentDate()."')");
return $myResult;
}

function submitEmployeeAppraisalResponse($userId,$appraisal_id, $response){
$myResult = ExecuteUpdate("INSERT INTO main_pa_score (appraisal, employee, employee_response)
VALUES (".$appraisal_id.",".$userId.",'".addSlashes(htmlspecialchars_decode($response))."')");
updateEmployeeRating($userId,$appraisal_id, $response, 0);
return $myResult;
}

function updateEmployeeRating($userId,$appraisal_id, $response, $level){
 $scores = json_decode($response);
 $consolidated_score = 0;
 $prev_score=0;
 $cnt = 0;
 foreach($scores as $score){
   $cnt++;
   $consolidated_score+= (int) $score->rating;
 }
 $consolidated_score = $consolidated_score/$cnt;
 $status = "Pending L1 Ratings";
 if($level==1){
 $status = "Pending L2 Ratings";
 //$prev_score = getConsolidatedScore($appraisal_id, $userId );
// $consolidated_score = ($consolidated_score + $prev_score)/2;
 }elseif($level==2){
 $status = "Appraisal Completed";
 //$prev_score = getConsolidatedScore($appraisal_id, $userId );
// $consolidated_score = ($consolidated_score + $prev_score)/2;
 }
$myResult = ExecuteUpdate("UPDATE main_pa_employee_ratings SET appraisal_status='".$status."',
consolidated_rating=".$consolidated_score." WHERE appraisal_id=".$appraisal_id." AND employee_id=".$userId);
return $myResult;
}

function submitLineManagerOneAppraisalResponse($current_user_id, $userId, $appraisal_id, $response){
$myResult = ExecuteUpdate("UPDATE main_pa_score SET line_manager_one=".$current_user_id.", line_manager_one_response='".addSlashes(htmlspecialchars_decode($response))."' WHERE employee=".$userId." AND appraisal=".$appraisal_id);
updateEmployeeRating($userId,$appraisal_id, $response, 1);
return $myResult;
}

function submitLineManagerTwoAppraisalResponse($current_user_id, $userId, $appraisal_id, $response){
$myResult = ExecuteUpdate("UPDATE main_pa_score SET line_manager_two=".$current_user_id.", line_manager_two_response='".addSlashes(htmlspecialchars_decode($response))."' WHERE employee=".$userId." AND appraisal=".$appraisal_id);
return $myResult;
}

function generateAppraisalURL($appraisalId, $userId, $manager_level){
		$appraisal_details = getAppraisalDetails($appraisalId);
    $url = "";
	$payload = [
					"employee_id"=>$userId,
					"group_id"=>$appraisal_details['group_id'],
					"appraisal_id"=>$appraisalId
					];
		$jwt_token = createJWTToken($payload);
		$server = $_SERVER['HTTP_HOST'];
		$url = "https://".$server."/linemanageroneappraisal/?t=".$jwt_token;
        if($server=="localhost")
        {
            $url = "http://".$server."/employeeAppraisal/linemanageroneappraisal/?t=".$jwt_token;
        }
        if($manager_level==2){
			$url = "https://".$server."/linemanagertwoappraisal/?t=".$jwt_token;
            if($server=="localhost")
            {
             $url = "http://".$server."/employeeAppraisal/linemanagertwoappraisal/?t=".$jwt_token;
            }
		}
		return $url;
}

function sendAppraisalToLineManager($appraisalId, $userId, $manager_level){
	$appraisal_details = getAppraisalDetails($appraisalId);
	$line_manager = getLineManager($appraisal_details['group_id'], $manager_level);
	$employee = getEmployeeDetails($userId);
		$payload = [
					"employee_id"=>$userId,
					"group_id"=>$appraisal_details['group_id'],
					"appraisal_id"=>$appraisalId
					];
		$jwt_token = createJWTToken($payload);
		$mail_content = getAppraisalMessageTemplate("Line Manager One");
		if($manager_level==2)
		$mail_content = getAppraisalMessageTemplate("Line Manager Two");
		 $server = $_SERVER['HTTP_HOST'];
		$url = "https://".$server."/linemanageroneappraisal/?t=".$jwt_token;
        if($server=="localhost")
        {
            $url = "http://".$server."/employeeAppraisal/linemanageroneappraisal/?t=".$jwt_token;
        }
        if($manager_level==2){
		$mail_content = getAppraisalMessageTemplate("Line Manager Two");
				$url = "https://".$server."/linemanagertwoappraisal/?t=".$jwt_token;
               if($server=="localhost")
               {
                $url = "http://".$server."/employeeAppraisal/linemanagertwoappraisal/?t=".$jwt_token;
                }
		}
        $url = '<a href="'.$url.'">Here</a>';
			$variables = [
						"firstname"=>$line_manager["firstname"],
						"lastname"=>$line_manager["lastname"],
						"groupname"=>$appraisal_details["group_name"],
						"businessunit"=>$appraisal_details["unitname"],
						"period"=>$appraisal_details["period"],
						"employee"=>$employee["firstname"]." ".$employee["lastname"],
						"url"=>$url
						];
		$message = replacePlaceHolders($variables, $mail_content['content']);
		sendEmployeeResponseEmail($appraisalId, $userId, $manager_level);
        return  sendThisMail("hr@workforcegroup.com", $line_manager['emailaddress'], $mail_content['title'], $message);
}

function sendEmployeeResponseEmail($appraisalId, $userId, $manager_level){
	$appraisal_details = getAppraisalDetails($appraisalId);
	$employee = getLineManager($appraisal_details['group_id'], $manager_level);
	$employee = getEmployeeDetails($userId);
		$payload = [
					"employee_id"=>$userId,
					"group_id"=>$appraisal_details['group_id'],
					"appraisal_id"=>$appraisalId
					];
		$jwt_token = createJWTToken($payload);
		$mail_content = getAppraisalMessageTemplate("Employee Response");
		 $server = $_SERVER['HTTP_HOST'];
		$url = "https://".$server."/appraisalreport/?t=".$jwt_token;
        if($server=="localhost")
        {
            $url = "http://".$server."/employeeAppraisal/appraisalreport/?t=".$jwt_token;
        }
        $url = '<a href="'.$url.'">Here</a>';
			$variables = [
						"firstname"=>$line_manager["firstname"],
						"lastname"=>$line_manager["lastname"],
						"groupname"=>$appraisal_details["group_name"],
						"businessunit"=>$appraisal_details["unitname"],
						"period"=>$appraisal_details["period"],
						"employee"=>$employee["firstname"]." ".$employee["lastname"],
						"url"=>$url
						];
		$message = replacePlaceHolders($variables, $mail_content['content']);	
        return  sendThisMail("hr@workforcegroup.com", $employee['emailaddress'], $mail_content['title'], $message);
}

function createJWTToken($payload){
$key = "wfg3ncrypt10nk3y";
$jwt = JWT::encode($payload, $key);
return $jwt;
//$decoded = JWT::decode($jwt, $key, array('HS256'));
}

function decodeToken($token){
$key = "wfg3ncrypt10nk3y";
$decoded = JWT::decode($token, $key, array('HS256'));
return $decoded;
}

function debugCode($txt){
$fp = fopen("debug.txt", "w");
fwrite($fp, $txt);
fclose($fp);
}

function sendThisMail($sender, $recipient, $subject, $content){
return SendEmail($sender, $recipient, "", "", $subject, $content, "html", "");
}

function replacePlaceHolders($variables, $messageTemp)
    {
        foreach ($variables as $key => $value) {
            $messageTemp = str_replace('{' . $key . '}', $value, $messageTemp);
        }
        return $messageTemp;
    }
