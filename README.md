# Projeto API — Clínica Médica

Projeto adaptado do material de aula. Mantém o Docker Compose original e o Laravel em `laravel/projetos`.

## Estrutura solicitada
- 3 Models: `Paciente`, `Medico`, `Consulta`.
- 3 Controllers: `PacienteController`, `MedicoController`, `ConsultaController`.
- 3 migrations próprias.
- 5 operações HTTP: GET/POST pacientes, GET/POST médicos e GET resumo de consultas.
- Relacionamentos: Paciente hasMany Consultas; Médico hasMany Consultas; Consulta belongsTo Paciente e Médico.

## Executar com Docker
Na pasta raiz (onde está `docker-compose.yml`):

```bash
docker compose up -d mysql laravel
```

Aguarde o container `laravel` terminar a preparação inicial. Instale as dependências usando o serviço Composer já definido no compose:

```bash
docker compose run --rm composer --working-dir=/app/projetos install
```

Crie o arquivo `.env` dentro de `laravel/projetos` copiando `.env.example`. Gere a chave e rode as migrations e dados de demonstração:

```bash
docker compose exec laravel bash
cd projetos
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan serve --host=0.0.0.0 --port=8000
```

A API ficará em `http://localhost:8000/api`. O banco MySQL está no serviço `mysql`, database `aula_db`, usuário `root`, senha `root` (configuração original de aula).

> Se o container `laravel` já estiver rodando, não execute `docker compose up` novamente em outro terminal sem necessidade. Para parar: `docker compose down` (não use `-v` se quiser preservar os dados do banco).

## Endpoints
| Método | URL | Função |
|---|---|---|
| GET | `/api/pacientes` | Listar pacientes |
| POST | `/api/pacientes` | Cadastrar paciente |
| GET | `/api/medicos` | Listar médicos |
| POST | `/api/medicos` | Cadastrar médico |
| GET | `/api/consultas/resumo` | Total de consultas e total agendadas |

### JSON para cadastrar paciente
```json
{ "nome": "Ana Lima", "cpf": "987.654.321-00", "telefone": "41988887777" }
```

### JSON para cadastrar médico
```json
{ "nome": "Dra. Paula Reis", "crm": "CRM-PR-54321", "especialidade": "Cardiologia" }
```

No Postman, use `Content-Type: application/json` e `Accept: application/json` nos POSTs.

## Observações
- O endpoint de resumo retorna `total_consultas` e `consultas_agendadas`.
- O enunciado não exige cadastro de consultas; por isso não foi criado POST de consultas. O `--seed` cria uma consulta demonstrativa para o resumo retornar valores.
- O projeto original utiliza PHP 8.4 no container Laravel, compatível com a exigência `^8.3` do `composer.json`.
