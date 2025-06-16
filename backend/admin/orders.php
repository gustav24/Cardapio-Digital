<?php
session_start();
include_once '../config/Database.php';
include_once '../models/Order.php';

$database = new Database();
$db = $database->getConnection();

$order = new Order($db);
$orders = $order->read();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administração - Pedidos</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            background: #f4f4f4;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            background: #333;
            color: #fff;
            padding: 1rem;
            margin-bottom: 2rem;
        }

        .header h1 {
            text-align: center;
        }

        .orders-list {
            background: #fff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
        }

        .order-item {
            padding: 1.5rem;
            border-bottom: 1px solid #eee;
        }

        .order-item:last-child {
            border-bottom: none;
        }

        .order-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }

        .order-id {
            font-weight: bold;
            color: #333;
        }

        .order-date {
            color: #666;
        }

        .order-status {
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: bold;
        }

        .status-pendente {
            background: #f1c40f;
            color: #fff;
        }

        .status-preparando {
            background: #3498db;
            color: #fff;
        }

        .status-pronto {
            background: #2ecc71;
            color: #fff;
        }

        .status-entregue {
            background: #95a5a6;
            color: #fff;
        }

        .order-customer {
            margin-bottom: 1rem;
        }

        .order-customer p {
            margin-bottom: 0.5rem;
            color: #666;
        }

        .order-items {
            margin-bottom: 1rem;
        }

        .order-item-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 0.5rem;
            padding: 0.5rem;
            background: #f9f9f9;
            border-radius: 5px;
        }

        .order-total {
            font-weight: bold;
            color: #e74c3c;
            text-align: right;
        }

        .order-actions {
            display: flex;
            gap: 1rem;
            justify-content: flex-end;
        }

        .btn {
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            text-decoration: none;
            display: inline-block;
        }

        .btn-update {
            background: #3498db;
            color: #fff;
        }

        .btn-update:hover {
            background: #2980b9;
        }

        .btn-view {
            background: #2ecc71;
            color: #fff;
        }

        .btn-view:hover {
            background: #27ae60;
        }

        .status-select {
            padding: 0.5rem;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-right: 1rem;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Administração de Pedidos</h1>
    </div>

    <div class="container">
        <div class="orders-list">
            <?php while ($row = $orders->fetch(PDO::FETCH_ASSOC)): ?>
                <div class="order-item">
                    <div class="order-header">
                        <div>
                            <span class="order-id">Pedido #<?php echo $row['id']; ?></span>
                            <span class="order-date"><?php echo date('d/m/Y H:i', strtotime($row['created'])); ?></span>
                        </div>
                        <span class="order-status status-<?php echo $row['status']; ?>">
                            <?php echo ucfirst($row['status']); ?>
                        </span>
                    </div>

                    <div class="order-customer">
                        <p><strong>Cliente:</strong> <?php echo $row['customer_name']; ?></p>
                        <p><strong>Email:</strong> <?php echo $row['customer_email']; ?></p>
                        <p><strong>Telefone:</strong> <?php echo $row['customer_phone']; ?></p>
                    </div>

                    <div class="order-items">
                        <?php
                        $items = explode('|', $row['items']);
                        foreach($items as $item) {
                            list($product_id, $quantity, $price) = explode(':', $item);
                            ?>
                            <div class="order-item-row">
                                <span>Produto #<?php echo $product_id; ?></span>
                                <span>Qtd: <?php echo $quantity; ?></span>
                                <span>R$ <?php echo number_format($price, 2, ',', '.'); ?></span>
                            </div>
                        <?php } ?>
                    </div>

                    <div class="order-total">
                        Total: R$ <?php echo number_format($row['total'], 2, ',', '.'); ?>
                    </div>

                    <div class="order-actions">
                        <select class="status-select" onchange="updateStatus(<?php echo $row['id']; ?>, this.value)">
                            <option value="pendente" <?php echo $row['status'] == 'pendente' ? 'selected' : ''; ?>>Pendente</option>
                            <option value="preparando" <?php echo $row['status'] == 'preparando' ? 'selected' : ''; ?>>Preparando</option>
                            <option value="pronto" <?php echo $row['status'] == 'pronto' ? 'selected' : ''; ?>>Pronto</option>
                            <option value="entregue" <?php echo $row['status'] == 'entregue' ? 'selected' : ''; ?>>Entregue</option>
                        </select>
                        <a href="#" class="btn btn-view" onclick="viewOrder(<?php echo $row['id']; ?>)">Ver Detalhes</a>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>

    <script>
        function updateStatus(orderId, status) {
            // Implementar atualização de status
            console.log('Atualizando pedido', orderId, 'para status', status);
        }

        function viewOrder(orderId) {
            // Implementar visualização detalhada
            console.log('Visualizando pedido', orderId);
        }
    </script>
</body>
</html> 