<?php

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_set_cookie_params([
        'httponly' => true,
        'secure' => !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off',
        'samesite' => 'Lax',
    ]);
    session_start();
}

function usuario_logado()
{
    return isset($_SESSION['usuario']);
}

function autenticar_usuario($usuario, $senha)
{
    if (!is_string($usuario) || !is_string($senha)) {
        return false;
    }

    $usuarios = require __DIR__ . '/../Dados dos Usuarios/usuarios.php';

    foreach ($usuarios as $cadastro) {
        if (
            hash_equals($cadastro['usuario'], $usuario) &&
            password_verify($senha, $cadastro['senha'])
        ) {
            return true;
        }
    }

    return false;
}
