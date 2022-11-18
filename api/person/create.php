<?php 
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once dirname(__FILE__) . '/../config/database.php';
include_once dirname(__FILE__) . '/../models/person.php';

$database = new Database();
$db = $database->connect();
$person = new Person($db);
$data = json_decode(file_get_contents("php://input"));

echo var_dump($data);

if (!empty($data))
{
    if ($person->create($data->name, $data->surname))
    {
        http_response_code(201);
        echo json_encode(array("Message"=> "Created"));
    }
    else
    {
        http_response_code(503);
        echo json_encode(array("Message"=>"Error"));
    }
}
else
{
    http_response_code(400);
    echo json_encode(array("Message" => "Bad request"));
}
?>