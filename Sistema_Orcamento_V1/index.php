<?php

function e($valor)
{
    return htmlspecialchars((string) $valor, ENT_QUOTES, 'UTF-8');
}

$cliente = '';
$servico = '';
$descricao_servico = '';
$valor_hora = 0;
$horas_estimadas = '';
$data_inicio = '';
$data_fim = '';
$total_formatado = null;
$valor_hora_formatado = null;
$prazo_dias = null;
$erro = null;
$mostrar_resultado = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $mostrar_resultado = true;

    $cliente = trim($_POST['cliente'] ?? '');
    $servico = trim($_POST['servico'] ?? $_POST['projeto'] ?? '');
    $descricao_servico = trim($_POST['descricao_servico'] ?? '');
    $valor_hora = (float) ($_POST['valor_hora'] ?? 0);

    if ($valor_hora < 0) {
        $valor_hora = 0;
    }
    if ($valor_hora > 200) {
        $valor_hora = 200;
    }
    $horas_estimadas = (int) ($_POST['horas'] ?? 0);

    $total_orcamento = $valor_hora * $horas_estimadas;
    $total_formatado = number_format($total_orcamento, 2, ',', '.');
    $valor_hora_formatado = number_format($valor_hora, 2, ',', '.');

    $data_inicio = $_POST['data_inicio'] ?? '';
    $data_fim    = $_POST['data_fim'] ?? '';

    if (!empty($data_inicio) && !empty($data_fim) && strtotime($data_fim) < strtotime($data_inicio)) {
        $erro = "Atenção: A data de entrega não pode ser anterior ao início!";
    } elseif (!empty($data_inicio) && !empty($data_fim)) {
        $inicio = new DateTime($data_inicio);
        $fim = new DateTime($data_fim);
        $prazo_dias = $inicio->diff($fim)->days + 1;
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/style.css">
    <title>1° Projeto - Sistema Orçamento | Patrick Souza</title>
</head>

<body>
    <main class="card <?php echo $mostrar_resultado ? 'card-com-resultado' : ''; ?>">
        <h1>Sistema de Orçamento - V1</h1>

        <section class="formulario">
            <form action="index.php" method="post">
                <div class="campo_usuario">
                    <label for="cliente">Nome do Cliente</label>
                    <input type="text" name="cliente" id="cliente" required placeholder="Digite o nome do cliente" value="<?php echo e($cliente); ?>">
                </div>

                <div class="campo_usuario">
                    <label for="servico">Nome do Servico</label>
                    <input type="text" name="servico" id="servico" required placeholder="Digite o nome do servico" value="<?php echo e($servico); ?>">
                </div>

                <div class="campo_usuario">
                    <label for="descricao_servico">Breve descricao do servico</label>
                    <textarea name="descricao_servico" id="descricao_servico" rows="3" maxlength="200" placeholder="Descreva resumidamente o que sera entregue"><?php echo e($descricao_servico); ?></textarea>
                    <small id="contador_descricao" class="contador-descricao">0/200 caracteres</small>
                </div>

                <div class="campo">
                    <label for="valor_hora">Valor por Hora (R$)</label>
                    <div class="campo-valor-hora">
                        <input type="range" name="valor_hora" id="valor_hora" min="0" max="200" step="5" value="<?php echo (int) $valor_hora; ?>">
                        <div class="valor-hora-digitado">
                            <span>R$</span>
                            <input type="number" id="valor_hora_input" min="0" max="200" step="5" value="<?php echo (int) $valor_hora; ?>" aria-label="Digite o valor por hora">
                        </div>
                    </div>
                    <span id="display_valor">R$ <?php echo (int) $valor_hora; ?></span>
                </div>

                <div class="campo-duplo">
                    <div>
                        <label>Data Início</label>
                        <input type="date" name="data_inicio" value="<?php echo e($data_inicio); ?>">
                    </div>
                    <div>
                        <label>Data Entrega</label>
                        <input type="date" name="data_fim" value="<?php echo e($data_fim); ?>">
                    </div>
                </div>

                <div class="campo_usuario">
                    <label for="horas">Horas Estimadas</label>
                    <input type="number" name="horas" id="horas" min="1" placeholder="Ex: 20" required value="<?php echo e($horas_estimadas); ?>">
                </div>

                <div class="acoes-form">
                    <button type="submit">Gerar Orçamento</button>
                    <a href="index.php" class="botao-secundario">Limpar</a>
                </div>

            </form>
        </section>

        <?php if ($mostrar_resultado): ?>
            <section id="resultado" class="resultado">
                <?php if (isset($total_formatado)): ?>
                    <p class="resultado-titulo">Resumo do Orçamento</p>
                    <p><strong>Cliente:</strong> <?php echo e($cliente !== '' ? $cliente : 'Não informado'); ?></p>
                    <p><strong>Servico:</strong> <?php echo e($servico !== '' ? $servico : 'Não informado'); ?></p>
                    <?php if ($descricao_servico !== ''): ?>
                        <p><strong>Descricao:</strong><br><?php echo nl2br(e($descricao_servico)); ?></p>
                    <?php endif; ?>
                    <p><strong>Valor/Hora:</strong> R$ <?php echo e($valor_hora_formatado); ?></p>
                    <p><strong>Horas Estimadas:</strong> <?php echo e($horas_estimadas); ?>h</p>
                    <?php if (!empty($data_inicio) && !empty($data_fim) && isset($prazo_dias)): ?>
                        <p><strong>Período:</strong> <?php echo e(date('d/m/Y', strtotime($data_inicio))); ?> até <?php echo e(date('d/m/Y', strtotime($data_fim))); ?></p>
                        <p><strong>Prazo:</strong> <?php echo e($prazo_dias); ?> dias</p>
                    <?php endif; ?>
                    <h2>Total: R$ <?php echo e($total_formatado); ?></h2>
                    <button type="button" id="btn_pdf" class="botao-pdf">Baixar PDF</button>
                <?php endif; ?>

                <?php if (isset($erro)): ?>
                    <p style="color: red;"><?php echo e($erro); ?></p>
                <?php endif; ?>
            </section>
        <?php endif; ?>
    </main>

    <footer class="rodape-site">&copy; 2026 Feito by Patrick Souza</footer>
</body>
<script src="./assets/js/script.js"></script>

</html>