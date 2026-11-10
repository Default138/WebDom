# WebDom

Meus exercícios e projetos da disciplina de **desenvolvimento web com PHP**, organizados por aula. Começa com o básico da linguagem e chega a sistemas completos com banco de dados, em camadas.

## Projetos completos

| Pasta | O que é |
|---|---|
| `crudalunos` | **CRUD de alunos e cursos**: cadastro, listagem, edição e exclusão. Código separado em `model`, `dao`, `service`, `controller` e `view`, com configuração centralizada em `util/config.php` e telas em Bootstrap. |
| `TrabalhoCrud` | **Sistema de Gestão de Atividades** (tarefas), na mesma arquitetura em camadas. O banco está em `task.sql`. |
| `Sessão` | Sistema com **login e sessão** de usuário, em camadas. Os bancos estão em `sesssao.sql`, `task.sql` e `usuarios.sql`. |

## Exercícios por aula

| Pasta | Assunto |
|---|---|
| `Aula1` | Primeiros exercícios em PHP |
| `Aula2` | Arrays e classes (países, presidentes e pokémon) |
| `Aula3` | Formulários com GET e POST (soma, média, calculadora) e a classe `Pessoa` |
| `Aula4` | Formulários e a classe `Veiculo` |
| `Aula5` | Cadastro de livros com banco de dados, edição, exclusão e validação em JavaScript |
| `Atividades` | Atividades avaliativas, incluindo o trabalho dos carros (`TrabalhoAVA`) |
| `Ana` | Jogo de adivinhação com uma classe `Palpite` |

## Como executar

Precisa do XAMPP (Apache e MySQL).

1. Copie a pasta do projeto que quer ver para `C:\xampp\htdocs\`.
2. Inicie o **Apache** e o **MySQL** no painel do XAMPP.
3. No phpMyAdmin, importe o arquivo `.sql` do projeto (por exemplo, `crudalunos/script_base_alunos.sql`).
4. Confira em `util/config.php` os dados do banco e a constante `BASE_URL`. Ela precisa bater com a pasta onde você colocou o projeto.
5. Abra o projeto pelo navegador, em `http://localhost/<pasta>/`.

### Usuário de teste (somente na pasta `Sessão`)

O arquivo `Sessão/setup.php` cria um usuário de teste para desenvolvimento local (`admin@email.com`, senha `admin123`, gravada com hash). É só para testar no próprio computador, e **não deve ser usado em um sistema real**.

## Tecnologias

PHP, MySQL, PDO, Bootstrap, HTML, CSS, JavaScript
