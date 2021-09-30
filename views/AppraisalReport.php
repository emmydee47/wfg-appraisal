<?php

namespace PHPMaker2022\wfg_appraisal;

// Page object
$AppraisalReport = &$Page;
?>
<style>
@import url('https://fonts.googleapis.com/css2?family=Open+Sans+Condensed:wght@300&display=swap');
</style>
<style>
.flex-container {
  display:flex;
  flex-flow: row wrap;
  justify-content: space-around;
}

.visible {
  visibility: visible;
}
.invisible {
  visibility: hidden;
}
body{
   font-family: 'Open Sans Condensed', sans-serif;
}
</style>
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<?php

function  searchArrayOfObjects($arrayOfObjects, $searchedValue){

  foreach($arrayOfObjects as $obj){
    if($obj->question==$searchedValue){
      return $obj;
    }
  }

}
$token = "";
$userId=0;
$employee_id;
$appraisal_id=0;
$chk_appraisal = false;

 $payload = "";
 $employee_details = [];
 $appraisal_questions = [];
 $appraisal_details = [];
 $employee_response = [];
 $appraisal_rating = [];
 $appraisal_ratings = [];
 $line_manager_two = [];
 $consolidated_score = 0.0;
 $cnt = 0;


if(isset($_REQUEST['appraisal_id'])){
  $userId = $_REQUEST['user_id'];
  $employee_id = $_REQUEST['user_id'];
  $appraisal_id = $_REQUEST['appraisal_id'];
  $group_id = $_REQUEST['group_id'];

  $employee_details = getEmployeeDetails($userId);
 $appraisal_questions = getAppraisalQuestions($group_id);
 $appraisal_details = getAppraisalDetails($appraisal_id);
 $employee_response = getEmployeeAppraisalResponse($userId,$appraisal_id);
 if($employee_response!=[]){
 $appraisal_rating = $appraisal_details['appraisal_ratings'];
 $appraisal_ratings = getAppraisalRatings($appraisal_details['appraisal_ratings']);
 $cnt = (int)$appraisal_ratings[1];
$consolidated_score = getConsolidatedScore($appraisal_id, $employee_id );
 $line_manager_two = getLineManager($group_id, 2);
  
 $chk_appraisal = true;
 }

}

if(isset($_REQUEST['t'])){
  $token = $_REQUEST['t'];
  $qpos = strrpos($token,"?");
  if($qpos > 100){
    $token = substr($token, 0, $qpos);
  }
 $payload = decodeToken($token);
 $employee_details = getEmployeeDetails($payload->employee_id);
 $appraisal_questions = getAppraisalQuestions($payload->group_id);
 $appraisal_details = getAppraisalDetails($payload->appraisal_id);
 $employee_response = getEmployeeAppraisalResponse($payload->employee_id,$payload->appraisal_id);
 $appraisal_rating = $appraisal_details['appraisal_ratings'];
 $appraisal_ratings = getAppraisalRatings($appraisal_details['appraisal_ratings']);
 $consolidated_score = getConsolidatedScore($payload->appraisal_id, $payload->employee_id );
 $cnt = (int)$appraisal_ratings[1];

 $line_manager_two = getLineManager($payload->group_id, 2);
 $chk_appraisal = true;
}
?>


<input type="hidden" name="appraisal_id" id="appraisal_id" value="<?php echo $appraisal_details['id']; ?>" />
<input type="hidden" name="user_id" id="user_id" value="<?php echo $employee_id; ?>" />
<div class="panel panel-default" id="ap-div">
  <div class="panel-heading">
  <?php echo $appraisal_details['unitname'].", ".$appraisal_details['group_name']." - ".$appraisal_details['appraisal_mode']." (".$appraisal_details['appraisal_period'].") ".$appraisal_details['from_year']." ".$employee_details['firstname']." ".$employee_details['lastname'];   ?>
  </div>
  <div class="panel-body">
  <div class="panel panel-default">
  <div class="panel-heading" style="text-align:center;">
  <?php
  if($chk_appraisal == true){
  ?>
    <div class="row">
        <div class="col-md-4">
            <b>Question</b>
        </div>
        <div class="col-md-4">
        <b>Response</b>
        </div>
        <div class="col-md-4">
        <b>Line Manager One Response</b>
        </div>
    </div>
  </div>
  <div class="panel-body" style="text-align:center;">
  <?php
foreach($appraisal_questions as $questions)
{
  $line_manager_one_response = null;
  $line_manager_two_response = null;
  $emp_response = searchArrayOfObjects(json_decode($employee_response['employee_response']),$questions['id']);
  if($employee_response['line_manager_one_response'])
    $line_manager_one_response = searchArrayOfObjects(json_decode($employee_response['line_manager_one_response']),$questions['id']);
  if($employee_response['line_manager_two_response'])
    $line_manager_two_response = json_decode($employee_response['line_manager_two_response']);
  
?>
<div class="row rating-rows" style="margin-bottom:20px;border-bottom:1px solid #cccccc;">
	<div class="col-md-4">
	     <b><?php echo $questions['question']; ?></b>
	</div>
	<div class="col-md-4">
	 <p>Rating:<h4><?php echo $emp_response->rating; ?></h4></p>
	 <p>Explanation:<em><?php echo $emp_response->explanation; ?></em></p>
	</div>
	<div class="col-md-4">
	 <p>Rating:<h4><?php echo $line_manager_one_response?$line_manager_one_response->rating:""; ?></h4></p>
	 <p>Explanation:<em><?php echo $line_manager_one_response?$line_manager_one_response->explanation:""; ?></em></p>
	</div>
</div>
<?php
}

?>
<?php
if($line_manager_two!=[]){

?>
<div class="row">
<div class="col-md-12">
<p>Line Manager Two Response</p>
<p>Rating:<h4><?php echo $line_manager_two_response?$line_manager_two_response->rating:""; ?></h4><p>
<p>Explanation:<em><?php echo $line_manager_two_response?$line_manager_two_response->explanation:""; ?></em><p>
</div>
</div>

<?php
}
?>
<div class="row" style="margin-bottom:20px;border-bottom:1px solid #cccccc;">
	<div class="col-md-12"><h3>Your Consolidated Score: <?php echo $consolidated_score; ?></h3> </div>
</div>
<?php
}else{
?>
<div>
<h3> Appraisal is pending employee response</h3>
</div>
<?php
}
?>
  </div>
  </div>
</div>

<?= GetDebugMessage() ?>
