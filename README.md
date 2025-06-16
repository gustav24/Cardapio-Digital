# Cardápio Digital

Um sistema completo de cardápio digital com frontend moderno e backend em PHP, permitindo que restaurantes gerenciem seus produtos e pedidos de forma eficiente.

## 🚀 Funcionalidades

### Frontend
- Página inicial com destaques e categorias
- Cardápio digital com filtros por categoria
- Carrinho de compras
- Sistema de pedidos online
- Página "Sobre" com informações do restaurante
- Página de contato com formulário e mapa

### Backend
- Painel administrativo para gerenciamento de produtos
- Sistema de gerenciamento de pedidos
- API RESTful para integração com o frontend
- Banco de dados MySQL para armazenamento de dados

## 🛠️ Tecnologias Utilizadas

- HTML5
- CSS3
- JavaScript (ES6+)
- PHP 7.4+
- MySQL
- Font Awesome (ícones)
- Google Maps API (opcional)

## 📋 Pré-requisitos

- Servidor web (Apache/Nginx)
- PHP 7.4 ou superior
- MySQL 5.7 ou superior
- Extensões PHP necessárias:
  - PDO
  - PDO_MySQL
  - JSON

## 🔧 Instalação

1. Clone o repositório:
```bash
git clone https://github.com/seu-usuario/cardapio-digital.git
```

2. Configure o banco de dados:
   - Crie um banco de dados MySQL
   - Execute o script `backend/database.sql`
   - Configure as credenciais em `backend/config/Database.php`

3. Configure o servidor web:
   - Aponte o DocumentRoot para a pasta do projeto
   - Certifique-se de que o mod_rewrite está habilitado (Apache)
   - Configure as permissões corretas nas pastas

4. Ajuste as configurações:
   - Edite as informações do restaurante no frontend
   - Configure as credenciais do banco de dados
   - Ajuste as URLs das imagens conforme necessário

## 📁 Estrutura do Projeto

```
cardapio-digital/
├── frontend/
│   ├── assets/
│   │   ├── css/
│   │   ├── js/
│   │   └── images/
│   ├── index.html
│   ├── menu.html
│   ├── cart.html
│   ├── about.html
│   └── contact.html
│
└── backend/
    ├── api/
    │   └── create_order.php
    ├── config/
    │   └── Database.php
    ├── models/
    │   ├── Product.php
    │   └── Order.php
    ├── admin/
    │   ├── products.php
    │   └── orders.php
    └── database.sql
```

## 💻 Uso

### Frontend
1. Acesse a página inicial (`index.html`)
2. Navegue pelo cardápio
3. Adicione itens ao carrinho
4. Faça o pedido

### Backend (Admin)
1. Acesse o painel de produtos (`backend/admin/products.php`)
   - Adicione novos produtos
   - Edite produtos existentes
   - Remova produtos

2. Acesse o painel de pedidos (`backend/admin/orders.php`)
   - Visualize pedidos
   - Atualize status dos pedidos
   - Gerencie entregas

## 🔒 Segurança

- Todas as entradas de dados são sanitizadas
- Proteção contra SQL Injection usando PDO
- Validação de dados no frontend e backend
- CORS configurado adequadamente

## 🤝 Contribuindo

1. Faça um Fork do projeto
2. Crie uma Branch para sua Feature (`git checkout -b feature/AmazingFeature`)
3. Commit suas mudanças (`git commit -m 'Add some AmazingFeature'`)
4. Push para a Branch (`git push origin feature/AmazingFeature`)
5. Abra um Pull Request

## 📝 Licença

Este projeto está sob a licença MIT. Veja o arquivo [LICENSE](LICENSE) para mais detalhes.

## ✨ Recursos Adicionais

- Design responsivo
- Interface moderna e intuitiva
- Sistema de carrinho com localStorage
- Filtros de produtos por categoria
- Gestão de pedidos em tempo real
- Suporte a múltiplos produtos e categorias

## 📞 Suporte

Para suporte, envie um email para GRBTECNOLOGIA.CM@gmail.com ou abra uma issue no GitHub.

## 🙏 Agradecimentos

- Font Awesome pelos ícones
- Comunidade PHP
- Todos os contribuidores do projeto 