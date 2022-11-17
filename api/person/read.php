<?php 
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once dirname(__FILE__) . '/../config/database.php';
include_once dirname(__FILE__) . '/../models/person.php';

$database = new Database();
$db = $database->connect();

$person = new Person($db);

$stmt = $person->read();

if ($stmt->num_rows > 0)
{
    $person_arr = array();
    $person_arr['records'] = array();
    while($record = $stmt->fetch_assoc())
    {
       extract($record);
       $person_record = array(
        'id' => $id,
        'name' => $name,
        'surname' => $surname
       );
       array_push($person_arr['records'], $person_record);
    }
    echo json_encode($person_arr);
}
else {
    echo "\n\nNo record";
}
?>