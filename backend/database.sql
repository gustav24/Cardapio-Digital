-- Criar o banco de dados
CREATE DATABASE IF NOT EXISTS cardapio_digital;
USE cardapio_digital;

-- Criar tabela de produtos
CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    price DECIMAL(10,2) NOT NULL,
    category VARCHAR(50) NOT NULL,
    image VARCHAR(255),
    created TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Criar tabela de pedidos
CREATE TABLE IF NOT EXISTS orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    customer_name VARCHAR(255) NOT NULL,
    customer_email VARCHAR(255) NOT NULL,
    customer_phone VARCHAR(20) NOT NULL,
    total DECIMAL(10,2) NOT NULL,
    status VARCHAR(20) NOT NULL DEFAULT 'pendente',
    created TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Criar tabela de itens do pedido
CREATE TABLE IF NOT EXISTS order_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT NOT NULL,
    product_id INT NOT NULL,
    quantity INT NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (order_id) REFERENCES orders(id),
    FOREIGN KEY (product_id) REFERENCES products(id)
);

-- Inserir alguns produtos de exemplo
INSERT INTO products (name, description, price, category, image) VALUES
('Salada Caesar', 'Alface romana, croutons, parmesão e molho caesar', 25.90, 'entradas', 'assets/images/menu-item-1.jpg'),
('Filé ao Molho Madeira', 'Filé mignon grelhado com molho madeira, acompanha arroz e batata', 45.90, 'pratos-principais', 'assets/images/menu-item-2.jpg'),
('Risoto de Cogumelos', 'Arroz arbóreo com mix de cogumelos, parmesão e manteiga', 35.90, 'pratos-principais', 'assets/images/menu-item-3.jpg'),
('Tiramisù', 'Sobremesa italiana com café, mascarpone e cacau', 18.90, 'sobremesas', 'assets/images/menu-item-4.jpg'); 