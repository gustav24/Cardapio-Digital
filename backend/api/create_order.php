<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/Database.php';
include_once '../models/Order.php';

$database = new Database();
$db = $database->getConnection();

$order = new Order($db);

$data = json_decode(file_get_contents("php://input"));

if(
    !empty($data->customer_name) &&
    !empty($data->customer_email) &&
    !empty($data->customer_phone) &&
    !empty($data->total) &&
    !empty($data->items)
) {
    $order->customer_name = $data->customer_name;
    $order->customer_email = $data->customer_email;
    $order->customer_phone = $data->customer_phone;
    $order->total = $data->total;
    $order->status = "pendente";
    $order->items = $data->items;

    if($order->create()) {
        http_response_code(201);
        echo json_encode(array("message" => "Pedido criado com sucesso.", "order_id" => $order->id));
    } else {
        http_response_code(503);
        echo json_encode(array("message" => "Não foi possível criar o pedido."));
    }
} else {
    http_response_code(400);
    echo json_encode(array("message" => "Não foi possível criar o pedido. Dados incompletos."));
}
?> 