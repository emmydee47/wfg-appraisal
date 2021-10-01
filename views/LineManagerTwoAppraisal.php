<?php

namespace PHPMaker2022\wfg_appraisal;

// Page object
$LineManagerTwoAppraisal = &$Page;
?>
<style>
@import url('https://fonts.googleapis.com/css2?family=Open+Sans+Condensed:wght@800&display=swap');
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
   font-family: 'Open Sans Condensed', sans-serif !important;
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

  $qpos = strrpos($token,"?");
  if($qpos > 100){
    $token = substr($token, 0, $qpos);
    debugCode($token);
  }

 $payload = decodeToken($token);
 $employee_details = getEmployeeDetails($payload->employee_id);
 $appraisal_questions = getAppraisalQuestions($payload->group_id);
 $appraisal_details = getAppraisalDetails($payload->appraisal_id);
 $employee_response =  getEmployeeAppraisalResponse($payload->employee_id,$payload->appraisal_id);
 $appraisal_rating = $appraisal_details['appraisal_ratings'];
 $appraisal_ratings = getAppraisalRatings($appraisal_details['appraisal_ratings']);
 $cnt = (int)$appraisal_ratings[1];

 $line_manager_two = getLineManager($payload->group_id, 2);
 $full_url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
 
//$employee_response = json_decode($employee_response);

function  searchArrayOfObjects($arrayOfObjects, $searchedValue){

  foreach($arrayOfObjects as $obj){
    if($obj->question==$searchedValue){
      return $obj;
    }
  }

}
?>


<input type="hidden" name="appraisal_id" id="appraisal_id" value="<?php echo $appraisal_details['id']; ?>" />
<input type="hidden" name="user_id" id="user_id" value="<?php echo $payload->employee_id; ?>" />
<div class="panel panel-default" id="ap-div">
  <div class="panel-heading">
  <?php echo $appraisal_details['unitname'].", ".$appraisal_details['group_name']." - ".$appraisal_details['appraisal_mode']." (".$appraisal_details['appraisal_period'].") ".$appraisal_details['from_year']." ".$employee_details['firstname']." ".$employee_details['lastname'];   ?>
  </div>
  <div class="panel-body">
  <?php
   
   if(!empty($appraisal_questions)){
   $count = 0;
$ratings_content = '<div class="flex-container">';
 foreach($appraisal_ratings as $appraisal_rating){ 
 	$ratings_content.='<div><span><input  type="radio" name="rating" id="rating'.$appraisal_rating['rating_value'].'" value="'.$appraisal_rating['rating_value'].'" class=" rd-rating" style="display:inline; margin-right:10px; float:left;" data-toggle="tooltip" data-placement="bottom" title="'.$appraisal_rating['rating_description'].'" /></span><span class="badge" style="margin-top:12px;">'.$appraisal_rating['rating_value'].'</span><br /><br />'.$appraisal_rating['rating_text'].'</div>';
 }
 $ratings_content .= '</div>';
foreach($appraisal_questions as $questions)
{
  $count++;
  $emp_response = searchArrayOfObjects(json_decode($employee_response['employee_response']),$questions['id']);
  $line_manager_one_response = searchArrayOfObjects(json_decode($employee_response['line_manager_one_response']),$questions['id']);
 



  
?>
<div class="row rating-rows" style="margin-bottom:20px;border-bottom:1px solid #cccccc;">
	<div class="col-md-3">
	      <p><b><?php echo $questions['question']; ?></b></p>
	      <p>Employee Rating: <?php echo $emp_response->rating; ?></p>
	      <p>Explanation: <?php echo $emp_response->explanation; ?></p>
	      <p>Line Manager One Rating: <?php echo $line_manager_one_response->rating; ?></p>
	      <p>Line Manager One Explanation: <?php echo $line_manager_one_response->explanation; ?></p>
	</div>
</div>
<?php
}
}
?>
<div class="row">
<div class="col-md-12">
<p>Please rate employee and explain</p>
<p><?php echo $ratings_content; ?><p>
<p><Textarea class="form-control txt-explanation" placeholder="Explanation" cols="10" rows="5" style="margin-bottom:20px;" id="txt-explanation"></Textarea></p>
</div>
</div>
<div class="row" style="margin-bottom:20px;border-bottom:1px solid #cccccc;">
	<div class="col-md-4"></div>
	<div class="col-md-4"><input type="hidden" name="txtSubmit" value="true" /></div>
	<div class="col-md-4"><button type="button" class="btn btn-lg btn-primary" id="btn-submit">Submit</button></div>
</div>
  </div>
</div>
<?php
}
?>

<div id="ap-conclusion" class="invisible"><h3>Appraisal submitted successfully</h3></div>
<script>
 
let rating_response = [];
 let qst_response = [];
 
 let qst = 0;
const emp_id = "<?php echo $payload->employee_id; ?>";
const appraisal_id = "<?php echo $payload->appraisal_id; ?>";
const current_user_id = "<?php echo CurrentUserID(); ?>";
let domain = document.location.origin;

if(domain==='http://localhost')
   domain=domain+'/employeeAppraisal';
   
   
  $('#btn-submit').click(function(){
  let cnt = 0;
  employee_appraisal = {"emp_id":emp_id, "appraisal_id":appraisal_id};
      
  	let rating = 0;
  	  		$('.rd-rating').each(function(){
  	  			if($(this).is(':checked')){
  	  				rating = $(this).val();
  	  			}
  	  			qst = $(this).data('qst');
  	  		});
  	  		if(rating===0){
  	  		alert("please select a rating");
  	  		return false;
  	  		}
  	  		let explanation = $('#txt-explanation').val();

  	  		if(explanation.length==0)
  	  		{
  	  			alert("please explain your rating");
  	  			return false;
  	  		}

  	  		var qst_object ={
  	  			"question":qst,
  	  			"rating":rating,
  	  			"explanation":explanation
  	  		};
  	  	
  	  		employee_appraisal.response = qst_object;
  	  		submitManagerAppraisal(employee_appraisal);
  	  	
  });
 function submitManagerAppraisal(sdata){
	 
 	 $.ajax({
            url:  domain+"/api/postLineManagerTwoResponse",
            type: "POST",
             data:{"action":"post_appraisal", "appraisal_data": sdata, "current_user_id":current_user_id},
            success: function(data, status, xhr) {
            console.log(data);
                var out = (data && typeof data === 'object') ? JSON.stringify(data) : data;
                var resp = $.parseJSON(out);
                if(resp.message===1){
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

 
</script>


<?= GetDebugMessage() ?>
