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
$searchBy_financial_quarter = $_POST['searchBy_financial_quarter'];
$searchByfinancial_year = $_POST['searchByfinancial_year'];
$searchByName = $_POST['searchByName'];
## Search 

$searchQuery = " ";
if($searchByName != ''){
    $searchQuery .= " and (product_name  like '%".$searchByName."%') ";
}
if($searchByfinancial_year != ''){
    $searchQuery .= " and (financial_year ='".$searchByfinancial_year."' ) ";
}
if($searchBy_financial_quarter != ''){
    $searchQuery .= " and (financial_quarter='".$searchBy_financial_quarter."') ";
}

if($searchValue != ''){
	$searchQuery .= " and (user_id like '%".$searchValue."%' or 
    financial_year like '%".$searchValue."%' or    
    product_name like '%".$searchValue."%' or 
    uploded_on like '%".$searchValue."%' or 
    financial_quarter like'%".$searchValue."%' ) ";
}

## Total number of records without filtering
$sel = mysqli_query($con,"select count(*) as allcount from mis_production");
$records = mysqli_fetch_assoc($sel);
$totalRecords = $records['allcount'];

## Total number of records with filtering
$sel = mysqli_query($con,"select count(*) as allcount from mis_production WHERE 1 ".$searchQuery);
$records = mysqli_fetch_assoc($sel);
$totalRecordwithFilter = $records['allcount'];

##Esta parte la he hecho yo, es para filtrar por los proyectos o equipo del usuario
$nameda = $_SESSION["username"];  
$sql = "SELECT * FROM users WHERE username = '$nameda'";
$resulta = $con->query($sql);
if ($resulta->num_rows > 0) {
    while($aba = $resulta->fetch_assoc()) {
        #echo $aba['team'];
        $prod = $aba['team'];
    }
}

## Fetch records Aqui mas de lo mismo el production unit en un futuro deberia ser el team
$empQuery = "select * from mis_production WHERE 1 ".$searchQuery." AND production_unit = $prod order by ".$columnName." ".$columnSortOrder." limit ".$row.",".$rowperpage;
$empRecords = mysqli_query($con, $empQuery);
$data = array();

while ($row = mysqli_fetch_assoc($empRecords)) {
    $data[] = array(
    		"user_id"=>$row['user_id'],
    		"financial_year"=>$row['financial_year'],
    		"financial_quarter"=>$row['financial_quarter'],
    		"product_name"=>$row['product_name'],
    		"production_unit"=>$row['production_unit'],
            "total_production"=>$row['total_production'],
    		"uploded_on"=>$row['uploded_on']
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
