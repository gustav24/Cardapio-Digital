# Cardápio Digital

Um sistema de cardápio digital com frontend em HTML/JavaScript e backend em PHP.

## Estrutura do Projeto

```
cardapio-digital/
├── public/                 # Arquivos públicos
│   ├── assets/            # Recursos estáticos
│   │   ├── css/          # Arquivos CSS
│   │   ├── js/           # Arquivos JavaScript
│   │   └── images/       # Imagens
│   ├── views/            # Templates PHP
│   └── index.html        # Página principal
├── src/                   # Código fonte PHP
│   ├── config/           # Arquivos de configuração
│   ├── controllers/      # Controladores
│   ├── models/           # Modelos
│   └── routes/           # Rotas
└── index.php             # Ponto de entrada da aplicação
```

## Requisitos

- PHP 7.4 ou superior
- Servidor web (Apache/Nginx)
- MySQL 5.7 ou superior

## Configuração

1. Clone o repositório
2. Configure seu servidor web para apontar para o diretório `public/`
3. Copie o arquivo `src/config/config.php` para `src/config/config.local.php` e ajuste as configurações
4. Importe o banco de dados usando o arquivo `database/schema.sql`

## Desenvolvimento

Para iniciar o desenvolvimento:

1. Configure seu ambiente de desenvolvimento
2. Execute o servidor web local
3. Acesse `http://localhost/cardapio-digital`

## Contribuição

1. Faça um fork do projeto
2. Crie uma branch para sua feature (`git checkout -b feature/nova-feature`)
3. Commit suas mudanças (`git commit -m 'Adiciona nova feature'`)
4. Push para a branch (`git push origin feature/nova-feature`)
5. Abra um Pull Request 