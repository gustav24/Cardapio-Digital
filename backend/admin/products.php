<?php
session_start();
include_once '../config/Database.php';
include_once '../models/Product.php';

$database = new Database();
$db = $database->getConnection();

$product = new Product($db);
$products = $product->read();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administração - Produtos</title>
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

        .btn {
            display: inline-block;
            padding: 0.8rem 1.5rem;
            background: #e74c3c;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            margin-bottom: 1rem;
        }

        .btn:hover {
            background: #c0392b;
        }

        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 2rem;
        }

        .product-card {
            background: #fff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
        }

        .product-image {
            height: 200px;
            overflow: hidden;
        }

        .product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .product-info {
            padding: 1.5rem;
        }

        .product-title {
            font-size: 1.2rem;
            color: #333;
            margin-bottom: 0.5rem;
        }

        .product-price {
            color: #e74c3c;
            font-weight: bold;
            margin-bottom: 0.5rem;
        }

        .product-category {
            color: #666;
            margin-bottom: 1rem;
        }

        .product-actions {
            display: flex;
            gap: 1rem;
        }

        .btn-edit {
            background: #3498db;
        }

        .btn-edit:hover {
            background: #2980b9;
        }

        .btn-delete {
            background: #e74c3c;
        }

        .btn-delete:hover {
            background: #c0392b;
        }

        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
        }

        .modal-content {
            background: #fff;
            width: 90%;
            max-width: 500px;
            margin: 50px auto;
            padding: 2rem;
            border-radius: 10px;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
        }

        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 0.8rem;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .modal-actions {
            display: flex;
            justify-content: flex-end;
            gap: 1rem;
            margin-top: 1rem;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Administração de Produtos</h1>
    </div>

    <div class="container">
        <a href="#" class="btn" onclick="openModal()">Adicionar Produto</a>

        <div class="products-grid">
            <?php while ($row = $products->fetch(PDO::FETCH_ASSOC)): ?>
                <div class="product-card">
                    <div class="product-image">
                        <img src="<?php echo $row['image']; ?>" alt="<?php echo $row['name']; ?>">
                    </div>
                    <div class="product-info">
                        <h3 class="product-title"><?php echo $row['name']; ?></h3>
                        <p class="product-price">R$ <?php echo number_format($row['price'], 2, ',', '.'); ?></p>
                        <p class="product-category"><?php echo $row['category']; ?></p>
                        <div class="product-actions">
                            <a href="#" class="btn btn-edit" onclick="editProduct(<?php echo $row['id']; ?>)">Editar</a>
                            <a href="#" class="btn btn-delete" onclick="deleteProduct(<?php echo $row['id']; ?>)">Excluir</a>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>

    <div id="productModal" class="modal">
        <div class="modal-content">
            <h2>Adicionar Produto</h2>
            <form id="productForm" onsubmit="saveProduct(event)">
                <input type="hidden" id="productId" name="id">
                <div class="form-group">
                    <label for="name">Nome</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="description">Descrição</label>
                    <textarea id="description" name="description" required></textarea>
                </div>
                <div class="form-group">
                    <label for="price">Preço</label>
                    <input type="number" id="price" name="price" step="0.01" required>
                </div>
                <div class="form-group">
                    <label for="category">Categoria</label>
                    <select id="category" name="category" required>
                        <option value="pratos-principais">Pratos Principais</option>
                        <option value="entradas">Entradas</option>
                        <option value="sobremesas">Sobremesas</option>
                        <option value="bebidas">Bebidas</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="image">URL da Imagem</label>
                    <input type="url" id="image" name="image" required>
                </div>
                <div class="modal-actions">
                    <button type="button" class="btn" onclick="closeModal()">Cancelar</button>
                    <button type="submit" class="btn">Salvar</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openModal() {
            document.getElementById('productModal').style.display = 'block';
            document.getElementById('productForm').reset();
            document.getElementById('productId').value = '';
        }

        function closeModal() {
            document.getElementById('productModal').style.display = 'none';
        }

        function editProduct(id) {
            // Implementar edição
            openModal();
        }

        function deleteProduct(id) {
            if(confirm('Tem certeza que deseja excluir este produto?')) {
                // Implementar exclusão
            }
        }

        function saveProduct(event) {
            event.preventDefault();
            // Implementar salvamento
            closeModal();
        }
    </script>
</body>
</html> 