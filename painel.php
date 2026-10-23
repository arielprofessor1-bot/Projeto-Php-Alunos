<?php

require_once __DIR__ . '/includes/auth.php';

if (!usuario_logado()) {
    header('Location: login.php');
    exit;
}

$usuario = htmlspecialchars($_SESSION['usuario'], ENT_QUOTES, 'UTF-8');
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel | Sistema dos alunos</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <main class="pagina-painel">
        <header class="cabecalho-painel">
            <a class="nome-sistema" href="painel.php">Sistema dos alunos</a>
            <a class="link-sair" href="logout.php">Sair</a>
        </header>

        <section class="conteudo-painel">
            <p class="sobretitulo">ÁREA DO ALUNO</p>
            <h1>Olá, <?= $usuario ?>!</h1>
            <p class="descricao">Você entrou no sistema com sucesso.</p>

            <div class="cartao-boas-vindas">
                <span class="icone-check" aria-hidden="true">✓</span>
                <div>
                    <h2>Acesso confirmado</h2>
                    <p>Esta é a página inicial do seu painel.</p>
                </div>
            </div>
        </section>
    </main>
</body>
</html>
