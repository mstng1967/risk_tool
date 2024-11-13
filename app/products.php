<?php
include 'config.php';
session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
## Read value
$draw = $_POST['draw'];
$row = $_POST['start'];
$rowperpage = $_POST['length']; // Rows display per page
$columnIndex = $_POST['order'][0]['column']; // Column index
$columnName = $_POST['columns'][$columnIndex]['data']; // Column name
$columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
$searchValue = $_POST['search']['value']; // Search value

## Custom Field value
$searchBy_processproject = $_POST['searchBy_processproject'];
$searchBy_team = $_POST['searchBy_team'];
$searchByName = $_POST['searchByName'];
## Search 

$searchQuery = " ";
if($searchByName != ''){
    $searchQuery .= " and (product_name  like '%".$searchByName."%') ";
}
if($searchBy_team != ''){
    $searchQuery .= " and (team ='".$searchBy_team."' ) ";
}
if($searchBy_processproject != ''){
    $searchQuery .= " and (processproject='".$searchBy_processproject."') ";
}

if($searchValue != ''){
	$searchQuery .= " and (risk_id like '%".$searchValue."%' or 
    team like '%".$searchValue."%' or    
    product like '%".$searchValue."%' or 
    processproject like'%".$searchValue."%' ) ";
}

## Total number of records without filtering
$sel = mysqli_query($con,"select count(*) as allcount from risks");
$records = mysqli_fetch_assoc($sel);
$totalRecords = $records['allcount'];

## Total number of records with filtering
$sel = mysqli_query($con,"select count(*) as allcount from risks WHERE 1 ".$searchQuery);
$records = mysqli_fetch_assoc($sel);
$totalRecordwithFilter = $records['allcount'];

##Esta parte la he hecho yo, es para filtrar por los proyectos o equipo del usuario
##$nameda = $_SESSION["username"];  
##$sql = "SELECT * FROM users WHERE username = '$nameda'";
##$resulta = $con->query($sql);
##if ($resulta->num_rows > 0) {
##    while($aba = $resulta->fetch_assoc()) {
##        #echo $aba['team'];
##        $prod = $aba['team'];
##    }
##}

## Fetch records Aqui mas de lo mismo el production unit en un futuro deberia ser el team AND production_unit = $prod
$empQuery = "select * from risks WHERE 1 ".$searchQuery."  order by ".$columnName." ".$columnSortOrder." limit ".$row.",".$rowperpage;
$empRecords = mysqli_query($con, $empQuery);
$data = array();

while ($row = mysqli_fetch_assoc($empRecords)) {
    $data[] = array(
    		"risk_id"=>$row['risk_id'],
	        "date"=>$row['date'],
    		"product"=>$row['product'],
    		"process_project"=>$row['process_project'],
    		"failure_mode"=>$row['failure_mode'],
    		"failure_effect"=>$row['failure_effect'],
            "SEV_inherent"=>$row['SEV_inherent'],
    		"SEV"=>$row['SEV'],
	        "failure_mode_cause"=>$row['failure_mode_cause'],
	        "stakeholders_cause"=>$row['stakeholders_cause'],
	        "OCC_inherent"=>$row['OCC_inherent'],
	        "OCC"=>$row['OCC'],
	        "current_control"=>$row['current_control'],
	        "preventive_control"=>$row['preventive_control'],
	        "detective_control"=>$row['detective_control'],
	        "corrective_control"=>$row['corrective_control'],
	        "DET"=>$row['DET'],
	        "bottleneck"=>$row['bottleneck'],
	        "RPN_inherent"=>$row['RPN_inherent'],
	        "RPN"=>$row['RPN'],
	        "risk_level"=>$row['risk_level'],
	        "stakeholders_affected"=>$row['stakeholders_affected'],
	        "acceptable"=>$row['acceptable'],
	        "actions"=>$row['actions']	    
    	);
}

## Response
$response = array(
    "draw" => intval($draw),
    "iTotalRecords" => $totalRecords,
    "iTotalDisplayRecords" => $totalRecordwithFilter,
    "aaData" => $data
);

echo json_encode($response);
