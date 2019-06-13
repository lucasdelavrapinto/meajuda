## Me Ajuda - Sistema Financeiro

Criado com a proposta de ajudar pessoas leigas simples.

### Projeto

- Laravel 4.2
- MySQL 4.2.7.1
- PHP 5.6.39

#### Banco de Dados

```sh
--
-- Estrutura da tabela `lancamentos`
--

CREATE TABLE IF NOT EXISTS `lancamentos` (
`id` int(11) NOT NULL,
  `data` datetime NOT NULL,
  `descricao` varchar(255) NOT NULL,
  `tipo` varchar(255) NOT NULL,
  `conta` varchar(255) NOT NULL,
  `valor` float NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=60 ;
```

```sh

--
-- Estrutura da tabela `contas`
--

CREATE TABLE IF NOT EXISTS `contas` (
`id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

```

### Atualizações

- 13/06/2018
  - Adicionado SweetAlert2 em todas as opções do Crud.
  - Adicionado opção para Excluir todos os dados de Lançamentos e Contas.
