<?php

namespace PHPMaker2022\wfg_appraisal;

// Page object
$UpdateAppraisal = &$Page;
?>
<?php

function getAppraisalEmployees(){
	return ExecuteRows("SELECT * FROM main_pa_score");
}

function updateThisAppraisal($appraisal_id, $score, $employee){
	$myResult = ExecuteUpdate("UPDATE main_pa_employee_ratings SET 
consolidated_rating=".$score." WHERE appraisal_id=".$appraisal_id." AND employee_id=".$employee);
return $myResult;
}

$appraisal_employees = getAppraisalEmployees();
$average_score = 0;
foreach($appraisal_employees as $employees){
	$line_manager_one_response = (Object) $employees['line_manager_one_response'];
	$line_manager_two_response = (Object) $employees['line_manager_two_response'];

	if($employees['line_manager_one_response']!="{}"){
	foreach($line_manager_one_response as $response)
	{
		$sum_score = 0;
		$cnt = 0;
		$response = json_decode($response);
		foreach($response as $resp){
			$sum_score += $resp->rating;
			$cnt++;
		}
		$average_score = $sum_score/$cnt;
		
		updateThisAppraisal($employees['appraisal'], $average_score, $employees['employee']);
		echo $average_score;	
	}
}

	
	if($employees['line_manager_two_response']!="{}"){
		foreach($line_manager_two_response as $response)
		{
			//$object = (Object) $line_manager_two_response;
			$response = json_decode($response);
			$average_score = $response->rating;
		}
		
		updateThisAppraisal($employees['appraisal'], $average_score,  $employees['employee']);
		
	}


 }

?>

<?= GetDebugMessage() ?>
