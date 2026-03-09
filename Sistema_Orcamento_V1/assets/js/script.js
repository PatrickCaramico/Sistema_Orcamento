const slider = document.getElementById("valor_hora");
const display = document.getElementById("display_valor");
const valorHoraInput = document.getElementById("valor_hora_input");

if (slider && display && valorHoraInput) {
  const min = Number(slider.min);
  const max = Number(slider.max);
  const step = Number(slider.step) || 1;

  const atualizarValor = () => {
    display.innerText = "R$ " + slider.value;
    valorHoraInput.value = slider.value;
  };

  const atualizarPreviewPeloInput = () => {
    const valorDigitado = Number(valorHoraInput.value);

    if (!Number.isNaN(valorDigitado)) {
      const valorLimitado = Math.min(max, Math.max(min, valorDigitado));
      slider.value = String(valorLimitado);
      display.innerText = "R$ " + slider.value;
    }
  };

  const normalizarInput = () => {
    let valor = Number(valorHoraInput.value);

    if (Number.isNaN(valor)) {
      valor = min;
    }

    if (valor < min) {
      valor = min;
    }

    if (valor > max) {
      valor = max;
    }

    // Mantem o valor alinhado com o step do controle principal.
    valor = Math.round(valor / step) * step;

    slider.value = String(valor);
    valorHoraInput.value = String(valor);
    display.innerText = "R$ " + slider.value;
  };

  slider.addEventListener("input", atualizarValor);
  valorHoraInput.addEventListener("input", atualizarPreviewPeloInput);
  valorHoraInput.addEventListener("change", normalizarInput);
  valorHoraInput.addEventListener("blur", normalizarInput);
  atualizarValor();
}

const btnPdf = document.getElementById("btn_pdf");
const resultado = document.getElementById("resultado");
const descricaoServico = document.getElementById("descricao_servico");
const contadorDescricao = document.getElementById("contador_descricao");

if (descricaoServico && contadorDescricao) {
  const limite = Number(descricaoServico.maxLength) || 200;

  const atualizarContadorDescricao = () => {
    const tamanhoAtual = descricaoServico.value.length;
    contadorDescricao.innerText = `${tamanhoAtual}/${limite} caracteres`;

    if (tamanhoAtual >= limite * 0.9) {
      contadorDescricao.classList.add("limite");
    } else {
      contadorDescricao.classList.remove("limite");
    }
  };

  descricaoServico.addEventListener("input", atualizarContadorDescricao);
  atualizarContadorDescricao();
}

if (btnPdf && resultado) {
  btnPdf.addEventListener("click", () => {
    const conteudo = resultado.cloneNode(true);
    const botaoNoClone = conteudo.querySelector("#btn_pdf");

    if (botaoNoClone) {
      botaoNoClone.remove();
    }

    const janela = window.open("", "_blank", "width=900,height=700");

    if (!janela) {
      alert("Não foi possível abrir a janela de impressão. Verifique o bloqueador de pop-up.");
      return;
    }

    janela.document.write(`
      <!doctype html>
      <html lang="pt-br">
      <head>
        <meta charset="utf-8" />
        <title>Orçamento</title>
        <style>
          body { font-family: Arial, sans-serif; margin: 32px; color: #2F3E46; }
          h1 { color: #84A98C; text-align: center; margin-bottom: 20px; }
          #resultado { border: 1px solid #dfe6e2; border-radius: 10px; padding: 20px; background: #f8f9f8; }
          #resultado p { margin: 0 0 8px 0; }
          #resultado h2 { margin-top: 16px; color: #84A98C; text-align: center; }
          .resultado-titulo { font-weight: 700; text-align: center; margin-bottom: 14px; color: #84A98C; }
          @media print { body { margin: 16px; } }
        </style>
      </head>
      <body>
        <h1>Orçamento</h1>
        ${conteudo.outerHTML}
      </body>
      </html>
    `);

    janela.document.close();
    janela.focus();
    setTimeout(() => {
      janela.print();
      janela.close();
    }, 250);
  });
}
