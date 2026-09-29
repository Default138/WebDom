<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema MVC com Sessão e BD</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 600px; margin: 40px auto; background-color: #f4f6f8; color: #333; }
        .card { background: #fff; padding: 24px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); margin-bottom: 20px; }
        .status-box { padding: 16px; border-radius: 6px; font-weight: bold; text-align: center; margin-bottom: 15px; }
        .status-active { background-color: #e8f5e9; color: #2e7d32; border: 1px solid #a5d6a7; }
        .status-empty { background-color: #ffebee; color: #c62828; border: 1px solid #ef9a9a; }
        .msg { padding: 12px; border-radius: 6px; margin-bottom: 15px; text-align: center; font-weight: bold; }
        .sucesso { background-color: #e3f2fd; color: #1565c0; border: 1px solid #90caf9; }
        .erro { background-color: #fff3e0; color: #e65100; border: 1px solid #ffcc80; }
        form { display: flex; gap: 10px; margin-bottom: 12px; }
        input[type="text"] { flex: 1; padding: 10px; border: 1px solid #ccc; border-radius: 4px; }
        button { padding: 10px 16px; border: none; border-radius: 4px; cursor: pointer; font-weight: bold; color: white;}
        .btn-criar { background-color: #2e7d32; }
        .btn-alterar { background-color: #f57c00; }
        .btn-remover { background-color: #c62828; width: 100%; margin-top: 5px; }
        .logs { font-size: 0.9em; background: #eee; padding: 10px; border-radius: 5px; }
    </style>
</head>
<body>

    <div class="card">
        <h2>Painel da Sessão (MVC)</h2>
        
        <!-- d) Exibição do valor e status da sessão -->
        <?php if ($sessaoExiste): ?>
            <div class="status-box status-active">Valor armazenado: <?= htmlspecialchars($valorSessao) ?></div>
        <?php else: ?>
            <div class="status-box status-empty">Sessão não existe!</div>
        <?php endif; ?>

        <?php if (!empty($mensagem)): ?>
            <div class="msg <?= htmlspecialchars($tipoMensagem) ?>">
                <?= htmlspecialchars($mensagem) ?>
            </div>
        <?php endif; ?>
    </div>

    <div class="card">
        <h3>Ações</h3>
        <form method="POST">
            <input type="hidden" name="acao" value="criar">
            <input type="text" name="valor" placeholder="Valor (texto, número, etc.)">
            <button type="submit" class="btn-criar">Criar</button>
        </form>

        <form method="POST">
            <input type="hidden" name="acao" value="alterar">
            <input type="text" name="valor" placeholder="Novo valor">
            <button type="submit" class="btn-alterar">Alterar</button>
        </form>

        <form method="POST">
            <input type="hidden" name="acao" value="remover">
            <button type="submit" class="btn-remover">Remover Sessão</button>
        </form>
    </div>

    <!-- Integração com Banco de Dados -->
    <div class="card">
        <h3>Últimos Registros no Banco de Dados (Logs)</h3>
        <div class="logs">
            <ul>
                <?php foreach ($logs as $log): ?>
                    <li>
                        <strong><?= date('d/m/Y H:i:s', strtotime($log['data_hora'])) ?>:</strong> 
                        <?= htmlspecialchars($log['acao']) ?> 
                        (Valor: <?= htmlspecialchars($log['valor']) ?>)
                    </li>
                <?php endforeach; ?>
                <?php if(empty($logs)): ?>
                    <li>Nenhum log registrado ainda.</li>
                <?php endif; ?>
            </ul>
        </div>
    </div>

</body>
</html>