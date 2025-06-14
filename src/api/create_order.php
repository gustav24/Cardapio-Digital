<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');

include_once '../../src/config/Database.php';
include_once '../../src/models/Order.php';

$database = new Database();
$db = $database->connect();

$order = new Order($db);

$data = json_decode(file_get_contents("php://input"));

if(
    !empty($data->customer_name) &&
    !empty($data->customer_email) &&
    !empty($data->customer_phone) &&
    !empty($data->items)
) {
    $order->customer_name = $data->customer_name;
    $order->customer_email = $data->customer_email;
    $order->customer_phone = $data->customer_phone;
    $order->total_amount = $data->total_amount;

    if($order_id = $order->create()) {
        $success = true;
        foreach($data->items as $item) {
            if(!$order->addOrderItem($order_id, $item->product_id, $item->quantity, $item->price)) {
                $success = false;
                break;
            }
        }

        if($success) {
            echo json_encode([
                'status' => 'success',
                'message' => 'Pedido criado com sucesso',
                'order_id' => $order_id
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Erro ao adicionar itens ao pedido'
            ]);
        }
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'Erro ao criar pedido'
        ]);
    }
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'Dados incompletos'
    ]);
}
?> 