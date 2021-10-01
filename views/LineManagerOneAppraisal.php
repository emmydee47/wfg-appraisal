<?php

namespace PHPMaker2022\wfg_appraisal;

// Page object
$LineManagerOneAppraisal = &$Page;
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
$employee_id=0;
$appraisal_id=0;
$chk_appraisal = false;

 $payload = "";
 $employee_details = [];
 $appraisal_questions = [];
 $appraisal_details = [];
 $employee_response = [];
 $appraisal_rating = [];
 $appraisal_ratings = [];
 $cnt = 0;


if(isset($_REQUEST['appraisal_id'])){
  $userId = $_REQUEST['user_id'];
  $employee_id = $_REQUEST['user_id'];
  $appraisal_id = $_REQUEST['appraisal_id'];
  $level = $_REQUEST['level'];
  $group_id = $_REQUEST['group_id'];

  $employee_details = getEmployeeDetails($userId);
 $appraisal_questions = getAppraisalQuestions($group_id);
 $appraisal_details = getAppraisalDetails($appraisal_id);
 $employee_response = getEmployeeAppraisalResponse($userId,$appraisal_id);
 $appraisal_rating = $appraisal_details['appraisal_ratings'];
 $appraisal_ratings = getAppraisalRatings($appraisal_details['appraisal_ratings']);
 $cnt = (int)$appraisal_ratings[1];

 $line_manager_two = getLineManager($group_id, 2);
  
 $chk_appraisal = true;

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
 $employee_id = $payload->employee_id;
 $appraisal_id = $payload->appraisal_id;
 $group_id = $payload->employee_id;
 $employee_response = getEmployeeAppraisalResponse($payload->employee_id,$payload->appraisal_id);
 $appraisal_rating = $appraisal_details['appraisal_ratings'];
 $appraisal_ratings = getAppraisalRatings($appraisal_details['appraisal_ratings']);
 $cnt = (int)$appraisal_ratings[1];

 $line_manager_two = getLineManager($payload->group_id, 2);
 $chk_appraisal = true;

 }

 if($chk_appraisal == true){
?>


<input type="hidden" name="appraisal_id" id="appraisal_id" value="<?php echo $appraisal_details['id']; ?>" />
<input type="hidden" name="user_id" id="user_id" value="<?php echo $employee_id; ?>" />

<div class="panel panel-default" id="ap-div">
  <div class="panel-heading">
  <?php echo $appraisal_details['unitname'].", ".$appraisal_details['group_name']." - ".$appraisal_details['appraisal_mode']." (".$appraisal_details['appraisal_period'].") ".$appraisal_details['from_year']." ".$employee_details['firstname']." ".$employee_details['lastname'];   ?>
  </div>
  <div class="panel-body ap-div">
  <?php
  //  $emp_scores = json_encode($employee_response['employee_response']);
  //   ($emp_scores[0]->question." ".$emp_scores[0]->score);
 
  if($employee_response==false){
    echo "<h3>Cannot find appraisal</h3>";
  }else{
   if(!empty($appraisal_questions)){
   $count = 0;
    foreach($appraisal_questions as $questions)
    {
      $count++;
      $emp_response = searchArrayOfObjects($employee_response['employee_response'],$questions['id']);
      $ratings_content = '<div class="flex-container">';

    foreach($appraisal_ratings as $appraisal_rating){ 
      $ratings_content.='<div><span><input data-qst="'.$questions['id'].'" type="radio" name="rdb'.$count.'" id="rating'.$count.$appraisal_rating['rating_value'].'" value="'.$appraisal_rating['rating_value'].'" class="rd-rating'.$count.'" style="display:inline; margin-right:10px; float:left;" data-toggle="tooltip" data-placement="bottom" title="'.$appraisal_rating['rating_description'].'" /></span><span class="badge" style="margin-top:12px;">'.$appraisal_rating['rating_value'].'</span><br /><br />'.$appraisal_rating['rating_text'].'</div>';
    }

  $ratings_content .= '</div>';
?>
<div class="row rating-rows" style="margin-bottom:20px;border-bottom:1px solid #cccccc;">
	<div class="col-md-3">
	      <p><b><?php echo $questions['question']; ?></b></p>
	      <p>Employee Rating: <?php echo $emp_response->rating; ?></p>
	      <p>Explanation: <?php echo $emp_response->explanation; ?></p>
	</div>
	<div class="col-md-6">Please rate employee and explain<br /><?php echo $ratings_content; ?></div>
	<div class="col-md-3"><Textarea class="form-control txt-explanation" placeholder="Explanation" cols="10" rows="5" style="margin-bottom:20px;"></Textarea></div>
</div>
<?php
}
}
?>
<div class="row" style="margin-bottom:20px;border-bottom:1px solid #cccccc;">
	<div class="col-md-4"></div>
	<div class="col-md-4"><input type="hidden" name="txtSubmit" value="true" /></div>
	<div class="col-md-4"><button type="button" class="btn btn-lg btn-primary" id="btn-submit">Submit</button></div>
</div>
  </div>
</div>
<?php
}
}

function  searchArrayOfObjects($arrayOfObjects, $searchedValue){
  $arrayOfObjects = json_decode($arrayOfObjects); 
    foreach($arrayOfObjects as $appraisal_obj){
    if($appraisal_obj->question==$searchedValue){
      return $appraisal_obj;
    }
  }

}
?>
<div id="ap-conclusion" class="invisible"><h3>Your appraisal has been sent to your line manager</h3></div>
<script>
 
let rating_response = [];
 let qst_response = [];
 
 let qst = 0;
const emp_id = "<?php echo $employee_id; ?>";
const appraisal_id = "<?php echo $appraisal_id; ?>";
const current_user_id = "<?php echo CurrentUserID(); ?>";

let domain = document.location.origin;

if(domain==='http://localhost')
   domain=domain+'/employeeAppraisal';
   
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
  	  		return;
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
                    alert("please fill all fields");
                    return false;
                }
  	  		});

          if(explanation.length==0)
          {
            return false;
          }
  	  		
  	  		employee_appraisal.response = qst_response;
  	  		submitManagerAppraisal(employee_appraisal);
  	  	
  });
 function submitManagerAppraisal(sdata){
	  const appraisal_data = sdata;
 	 $.ajax({
            url: domain+"/api/postLineManagerOneResponse",
            type: "POST",
             data:{"action":"post_appraisal", "appraisal_data": sdata, "current_user_id":current_user_id},
            success: function(data, status, xhr) {
                var out = (data && typeof data === 'object') ? JSON.stringify(data) : data;
                var resp = $.parseJSON(out);
               
                if(resp.message===1){
                  sendToLineManager(appraisal_data['appraisal_id'], appraisal_data['emp_id'], 2);
                //	alert("Appraisal submitted successfuly");
                		$('#ap-div').hide();
                		$('#ap-conclusion').removeClass('invisible');
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr);
                alert("status: " + xhr.status + ", error: " + thrownError);
            },
            beforeSend: function(request) { // Set JWT header
               // request.setRequestHeader('X-Authorization', 'Bearer ' + store.JWT);
             } 
        });

 }


</script>
<?= GetDebugMessage() ?>
