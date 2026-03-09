# Sistema de Orcamentos V1

Gerador de orcamentos para freelancers, desenvolvido em PHP, HTML, CSS e JavaScript.

Projeto criado com foco no desafio:

- Uso de `$_POST`
- Logica matematica para calculo de total
- Exibicao dos dados de forma clara

## Desafio Base

> 1. Sistema de Orcamentos (Simples)
>
> - Descricao: Gerador de orcamentos para freelancers.
> - Recursos: Formulario com Nome do Servico, Valor/Hora e Horas.
> - Calculo automatico do total.
> - Foco: `$_POST`, logica matematica e exibicao de dados.

## Funcionalidades Implementadas

- Formulario com:
  - Nome do Cliente
  - Nome do Servico
  - Breve descricao do servico (ate 200 caracteres, com contador)
  - Valor/Hora
  - Horas estimadas
  - Data de inicio e data de entrega
- Valor/Hora com duas formas de entrada:
  - Slider
  - Campo numerico digitavel (sincronizado com o slider)
- Calculo automatico do total: `valor_hora * horas`
- Validacao de prazo:
  - Exibe aviso quando a data de entrega e anterior a data de inicio
- Persistencia de dados apos submit
- Layout responsivo:
  - Inicial centralizado
  - Apos gerar orcamento, divide em duas colunas (formulario e resultado)
- Acoes extras:
  - Botao `Limpar`
  - Botao `Baixar PDF` (via janela de impressao do navegador)

## Estrutura do Projeto

```text
index.php
assets/
  css/
    style.css
  js/
    script.js
  images/
  docs/
    notes.md
```

## Tecnologias

- PHP
- HTML5
- CSS3
- JavaScript (Vanilla)

## Como Executar Localmente

1. Coloque o projeto na pasta do XAMPP:
   - `c:\xampp\htdocs\Sistema_Orcamento_V1`
2. Inicie o Apache no painel do XAMPP.
3. Acesse no navegador:
   - `http://localhost/Sistema_Orcamento_V1/`

## Como Usar

1. Preencha os campos do formulario.
2. Escreva a descricao breve do servico (opcional, ate 200 caracteres).
3. Defina o valor/hora pelo slider ou digitando no campo numerico.
4. Clique em `Gerar Orcamento`.
5. Veja o resumo na lateral direita.
6. Clique em `Baixar PDF` para salvar o resumo como PDF.
7. Clique em `Limpar` para resetar o formulario.

## Regras de Negocio

- O total e calculado com:
  - `total = valor_hora * horas_estimadas`
- Se `data_fim < data_inicio`, o sistema exibe mensagem de erro.
- Valor/hora permitido no intervalo de `0` a `200`.

## Melhorias Futuras (Roadmap)

- Geracao real de PDF no servidor (ex.: Dompdf)
- Salvar historico de orcamentos (arquivo ou banco de dados)
- Edicao e exclusao de orcamentos
- Tema escuro
- Mascara de moeda BRL com formatacao automatica
- Compartilhamento por WhatsApp ou email

## Publicacao

Para publicar no GitHub:

```bash
git init
git add .
git commit -m "feat: sistema de orcamentos v1"
git branch -M main
git remote add origin <url-do-repositorio>
git push -u origin main
```

## Licenca

Uso educacional e portfolio.
