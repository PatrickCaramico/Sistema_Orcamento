# Changelog - Sistema de Orcamentos V1

## [v1.5.0] - 2026-03-09

### Added

- Campo `Breve descricao do servico` abaixo do nome do servico.
- Limite de `200` caracteres na descricao (`maxlength`).
- Contador em tempo real `x/200 caracteres`.

### Changed

- Descricao passa a aparecer no resumo do orcamento e no PDF.
- README atualizado com os novos recursos e regras atuais.

## [v1.4.0] - 2026-03-09

### Fixed

- Correcao na digitacao do `Valor/Hora` no campo numerico.
- Agora valores como `180` podem ser digitados normalmente.
- Normalizacao de limite/step acontece em `blur` e `change`.

## [v1.3.0] - 2026-03-09

### Added

- Botao `Limpar` no formulario.
- Botao `Baixar PDF` no resumo.
- Rodape fixo: `© 2026 Feito by Patrick Souza`.

### Changed

- Campo `Projeto` renomeado para `Servico`.
- Valor/Hora passou para faixa de `0` a `200` (frontend e backend).

## [v1.2.0] - 2026-03-09

### Added

- Entrada dupla para `Valor/Hora`:
  - slider
  - campo numerico digitavel (sincronizado)
- Resumo mais completo com:
  - cliente
  - servico
  - valor/hora
  - horas
  - periodo
  - prazo
  - total

### Changed

- Persistencia dos dados no formulario apos submit.
- Melhoria visual no bloco de resultado.

## [v1.1.0] - 2026-03-09

### Added

- Layout dinamico:
  - estado inicial centralizado
  - apos gerar, duas colunas (formulario/esquerda e resultado/direita)
- Responsividade para mobile (`max-width: 900px`).
- Animacoes de transicao (`expandir-card`, `deslocar-form`, `revelar-resultado`).
- Suporte a `prefers-reduced-motion`.

## [v1.0.0] - 2026-03-09

### Added

- Estrutura base do sistema de orcamento com PHP, HTML, CSS e JS.
- Processamento com `$_POST`.
- Calculo do total: `valor_hora * horas_estimadas`.
- Validacao de datas (entrega nao pode ser anterior ao inicio).
- Exibicao do resultado na tela.

### Fixed

- Correcao de erro de sintaxe no bloco PHP/HTML do resultado.

## Estado atual

- Projeto funcional e pronto para portfolio/publicacao.
- Arquivos principais sem erros de sintaxe reportados.
