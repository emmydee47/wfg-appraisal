<?php

namespace PHPMaker2022\wfg_appraisal;

// Page object
$EmployeeAppraisal = &$Page;
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
$token = ""; 
$userId=0;
$appraisal_id=0;
if(isset($_REQUEST['txtSubmit'])){
  $userId = $_REQUEST['user_id'];
  $appraisal_id = $_REQUEST['appraisal_id'];
  $response = $_REQUEST['employee_response'];
  
  submitEmployeeAppraisalResponse($userId,$appraisal_id, $response);
  echo $response;

}
if(isset($_REQUEST['t'])){
  $token = $_REQUEST['t'];
  debugCode($token);
  $qpos = strrpos($token,"?");
  if($qpos > 100){
    $token = substr($token, 0, $qpos);
   
  }

 $payload = decodeToken($token);
 $employee_details = getEmployeeDetails($payload->employee_id);
 $appraisal_questions = getAppraisalQuestions($payload->group_id);
 $appraisal_details = getAppraisalDetails($payload->appraisal_id);
 $employee_response = getEmployeeAppraisalResponse($payload->employee_id,$payload->appraisal_id);
 $appraisal_ratings = getAppraisalRatings($appraisal_details['appraisal_ratings']);

 $line_manager_one = getLineManager($payload->group_id, 1);
 $full_url = 'http://'.$_SERVER['HTTP_HOST'];
 debugCode(json_encode($appraisal_details));

?>


<input type="hidden" name="appraisal_id" id="appraisal_id" value="<?php echo $appraisal_details['id']; ?>" />
<input type="hidden" name="user_id" id="user_id" value="<?php echo $payload->employee_id; ?>" />

<div id="ap-div" class="panel panel-default">
  <div class="panel-heading">
  <?php echo $appraisal_details['unitname'].", ".$appraisal_details['group_name']." - ".$appraisal_details['appraisal_mode']." (".$appraisal_details['appraisal_period'].") ".$appraisal_details['from_year']." ".$employee_details['firstname']." ".$employee_details['lastname'];   ?>
  </div>
  <div class="panel-body">
  <div id="start-div">
<center>
<?php
  if($appraisal_details['initialize_status']==0){
?>

<h3>This appraisal is closed</h3>

<?php
}
?>
<?php
  if(!empty($employee_response)){
?>
<h3>You have already taken this appraisal</h3>
<?php
}else{
?>
<h3> Welcome, <?php echo $employee_details['firstname']." ".$employee_details['lastname']; ?>, <br /> Please click on the button below to start your appraisal </h3>
<button id="btnStart" class="btn-success btn btl-lg"> Start Appraisal </button>
<?php
}
?>
</center>
</div>
<div id="questions-div" class="invisible" >
  <?php
   if(!empty($appraisal_questions)){
   $count = 0;
foreach($appraisal_questions as $questions)
{
$count++;
 $ratings_content = '<div class="flex-container">';

 foreach($appraisal_ratings as $appraisal_rating){ 
 	$ratings_content.='<div><span><input data-qst="'.$questions['id'].'" type="radio" name="rdb'.$count.'" id="rating'.$count.$appraisal_rating['rating_value'].'" value="'.$appraisal_rating['rating_value'].'" class="rd-rating'.$count.'" style="display:inline; margin-right:10px; float:left;" data-toggle="tooltip" data-placement="bottom" title="'.$appraisal_rating['rating_description'].'" /></span><span class="badge" style="margin-top:12px;">'.$appraisal_rating['rating_value'].'</span><br /><br />'.$appraisal_rating['rating_text'].'</div>';
 }

  $ratings_content .= '</div>';
?>
<div class="row rating-rows" style="margin-bottom:20px;border-bottom:1px solid #cccccc;">
	<div class="col-md-2"><b><?php echo $questions['question']; ?></b></div>
	<div class="col-md-7"><?php echo $questions['description']; ?><br /><?php echo $ratings_content; ?></div>
	<div class="col-md-3"><Textarea class="form-control txt-explanation" placeholder="Explanation" cols="10" rows="5" style="margin-bottom:20px;"></Textarea></div>
</div>

<?php
}
}
?>
<div class="row" style="margin-bottom:20px;border-bottom:1px solid #cccccc; padding-bottom:20px;">
	<div class="col-md-4"></div>
	<div class="col-md-4"><input type="hidden" name="txtSubmit" value="true" /><button type="button" class="btn btn-lg btn-primary" id="btn-submit">Submit</button></div>
	<div class="col-md-4"></div>
</div>
  </div>
</div>
</div>
<div id="ap-conclusion" class="invisible"><h3>Your appraisal has been sent to your line manager</h3></div>
<?php
}

?>
<script>
 
let rating_response = [];
 let qst_response = [];
 
 let qst = 0;
const emp_id = "<?php echo $payload->employee_id; ?>";
const appraisal_id = "<?php echo $payload->appraisal_id; ?>";
let domain = document.location.origin;

if(domain==='http://localhost')
   domain=domain+'/employeeAppraisal';

$('#btnStart').click(function(){

	$('#start-div').hide();
	$('#questions-div').removeClass('invisible');
});

  $('#btn-submit').click(function(){
  let cnt = 0;
  employee_appraisal = {"emp_id":emp_id, "appraisal_id":appraisal_id};
      
  	  $('.rating-rows').each(function(){
  	  		cnt++;
  	  		let rating=0;
  	  		let explanation = "";
  	  		$('.rd-rating'+cnt).each(function(){
  	  			if($(this).is(':checked')){
  	  				rating = $(this).val();
  	  			}
  	  			qst = $(this).data('qst');
  	  		});
  	  		if(rating===0){
  	  		alert("please fill all fields");
  	  		return false;
  	  		}
  	  		explanation = $(this).find('.txt-explanation').val();

  	  		var qst_object ={
  	  			"question":qst,
  	  			"rating":rating,
  	  			"explanation":explanation
  	  		};
  	  		qst_response.push(qst_object);
  	  		});

  	  		$('.txt-explanation').each(function(){
  	  			explanation = $(this).val();
  	  		
  	  		if(explanation.length==0)
  	  		{
  	  			ew.alert("please fill all fields");
  	  			return false;
  	  		}
  	  		});
  	  		employee_appraisal.response = qst_response;
  	  		
ew.prompt("Are you sure you want to submit this appraisal", function(result) {
    if (result) {
        submitAppraisal(employee_appraisal);
    } else {
       return false;
    }
});
  	  		
  	  	
  });
 function submitAppraisal(data){
	 const appraisal_data = data;
 	 $.ajax({
            url:  domain+"/api/postAppraisalResponse",
            type: "POST",
             data:{"action":"post_appraisal", "appraisal_data": data},
            success: function(data, status, xhr) {
                var out = (data && typeof data === 'object') ? JSON.stringify(data) : data;
                var resp = $.parseJSON(out);
                if(resp.message===1){
                	sendToLineManager(appraisal_data['appraisal_id'], appraisal_data['emp_id'], 1);
                	alert("Appraisal submitted successfuly");
                		$('#ap-div').hide();
                		$('#ap-conclusion').removeClass('invisible');
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert("status: " + xhr.status + ", error: " + thrownError);
            },
            beforeSend: function(request) { // Set JWT header
               // request.setRequestHeader('X-Authorization', 'Bearer ' + store.JWT);
             } 
        });

 }

 function sendToLineManager(appraisalId, userId, level){

      $.ajax({
            url: domain+"/api/sendToLineManager",
            type: "POST",
            data:{"appraisal_id":appraisalId, "user_id": userId, "level":level},
            success: function(data, status, xhr) {
                var out = (data && typeof data === 'object') ? JSON.stringify(data) : data;
                var resp = $.parseJSON(out);
                if(resp.message==1){
                   
                }
                
            },
            error: function (xhr, ajaxOptions, thrownError) {
              console.log("status: " + xhr.status + ", error: " + thrownError);
            },
            beforeSend: function(request) { // Set JWT header
               // request.setRequestHeader('X-Authorization', 'Bearer ' + store.JWT);
             } 
        });
 }
</script>

<?= GetDebugMessage() ?>
