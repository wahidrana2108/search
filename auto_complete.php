<?php

include('db.php'); 

$searchTerm = $_GET['term'];
$sql = "SELECT * FROM customers WHERE customer_name LIKE '%".$searchTerm."%'"; 
$result = $conn->query($sql); 
if ($result->num_rows > 0) {
  $tutorialData = array(); 
  while($row = $result->fetch_assoc()) {

   $data['id']    = $row['customer_id']; 
   $data['value'] = $row['customer_name'];
   array_push($tutorialData, $data);
} 
}
 echo json_encode($tutorialData);
?>