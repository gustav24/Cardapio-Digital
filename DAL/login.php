<?php
  session_start();
  include_once 'conexao.php';
?>
<!DOCTYPE html>
<html lang="pt-br" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body class="d-flex justify-content-center align-items-center min-vh-100 bg-body-tertiary">
    <main class="w-100" style="max-width: 330px;">
        <form>
            <img src="#" alt="Logo" class="mb-4" height="57" width="72">
            <h1 class="h3 mb-3 fw-normal text-center">Faça o Login</h1>
            
            <div class="form-floating mb-2">
                <input type="email" class="form-control" id="floatingInput" placeholder="seu-email@gmail.com">
                <label for="floatingInput">E-mail</label>
            </div>

            <div class="form-floating mb-2">
                <input type="password" class="form-control" id="floatingPassword" placeholder="Senha">
                <label for="floatingPassword">Senha</label>
            </div>

            <div class="form-check text-start my-3">
                <input type="checkbox" class="form-check-input" id="flexCheckDefault">
                <label class="form-check-label" for="flexCheckDefault">Lembre-me</label>
            </div>

            <button class="btn btn-primary w-100 py-2" type="submit">Entrar</button>
        </form>
    </main>
</body>
</html>
