<?php

require_once __DIR__ . '/includes/auth.php';

if (usuario_logado()) {
    header('Location: painel.php');
    exit;
}

header('Location: login.php');
exit;
