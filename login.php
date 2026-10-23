<?php

require_once __DIR__ . '/includes/auth.php';

if (usuario_logado()) {
    header('Location: painel.php');
    exit;
}

$erro = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuarioEnviado = $_POST['usuario'] ?? '';
    $senhaEnviada = $_POST['senha'] ?? '';
    $usuario = is_string($usuarioEnviado) ? trim($usuarioEnviado) : '';
    $senha = is_string($senhaEnviada) ? $senhaEnviada : '';

    if (autenticar_usuario($usuario, $senha)) {
        session_regenerate_id(true);
        $_SESSION['usuario'] = $usuario;

        header('Location: painel.php');
        exit;
    }

    $erro = 'Usuário ou senha inválidos.';
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Entrar | Sistema dos alunos</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <main class="pagina-login">
        <div class="login-layout">
            <section class="painel-apresentacao" aria-label="Apresentação do sistema">
                <a class="marca marca-clara" href="index.php" aria-label="Sistema dos alunos, início">A</a>
                <p class="sobretitulo">SUA JORNADA COMEÇA AQUI</p>
                <h1>Aprender abre<br>novos caminhos.</h1>
                <p class="texto-apresentacao">Acesse seu espaço e acompanhe sua jornada de aprendizagem em um só lugar.</p>

                <div class="destaque-apresentacao">
                    <span class="icone-livro" aria-hidden="true">✦</span>
                    <div>
                        <strong>Um passo de cada vez</strong>
                        <span>Continue avançando nos seus estudos.</span>
                    </div>
                </div>
                <span class="detalhe-circulo detalhe-circulo-um" aria-hidden="true"></span>
                <span class="detalhe-circulo detalhe-circulo-dois" aria-hidden="true"></span>
            </section>

            <section class="cartao-login" aria-labelledby="titulo-login">
                <p class="sobretitulo sobretitulo-azul">ÁREA DO ALUNO</p>
                <h2 id="titulo-login">Boas-vindas!</h2>
                <p class="descricao">Entre com seus dados para acessar o painel.</p>

                <?php if ($erro !== ''): ?>
                    <p class="mensagem-erro" role="alert"><?= htmlspecialchars($erro, ENT_QUOTES, 'UTF-8') ?></p>
                <?php endif; ?>

                <form action="login.php" method="post">
                    <label for="usuario">E-mail</label>
                    <input
                        type="email"
                        id="usuario"
                        name="usuario"
                        autocomplete="username"
                        placeholder="voce@exemplo.com"
                        value="<?= htmlspecialchars($usuario ?? '', ENT_QUOTES, 'UTF-8') ?>"
                        required
                        autofocus
                    >

                    <label for="senha">Senha</label>
                    <input
                        type="password"
                        id="senha"
                        name="senha"
                        autocomplete="current-password"
                        placeholder="Digite sua senha"
                        required
                    >

                    <button type="submit">Entrar no painel <span aria-hidden="true">→</span></button>
                </form>
                <p class="nota">Acesso exclusivo para alunos cadastrados.</p>
            </section>
        </div>
    </main>
</body>
</html>
