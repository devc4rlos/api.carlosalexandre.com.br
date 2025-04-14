## API de contato pessoal - Carlos Alexandre

Esta é uma API desenvolvida em Laravel para centralizar e disponibilizar minhas informações de contato profissional e redes sociais. Ela serve como um ponto de acesso confiável e atualizado para quem deseja entrar em contato comigo para oportunidades de freelas ou parcerias.

> Projeto online: [https://api.carlosalexandre.com.br/v1/contacts](https://api.carlosalexandre.com.br/v1/contacts)

## Tecnologias Utilizadas

- Laravel 12
- Laravel Sail (Docker)
- Laravel Sanctum (autenticação via token)
- MySQL
- PHP 8.2

## Funcionalidades Principais

- Atualização de informações de contato (nome, e-mail, telefone)
- Gerenciamento de redes sociais (criar, listar, editar e remover links)
- Organização de links relacionados.
- Autenticação protegida com Sanctum.
- Respostas padronizadas.

## Como rodar localmente

### Pré-requisitos

- Docker instalado na máquina
- Git

### Passo a passo

1. Clone o repositório:
   ```bash
   git clone https://github.com/devc4rlos/api.carlosalexandre.com.br.git
   cd api.carlosalexandre.com.br
   ```

2. Copie o arquivo `.env.example` e renomeie para `.env`:
   ```bash
   cp .env.example .env
   ```

3. Inicie o ambiente com o Sail:
   ```bash
   ./vendor/bin/sail up -d
   ```

4. Instale as dependências do projeto:
   ```bash
   ./vendor/bin/sail composer install
   ```

5. Gere a chave da aplicação:
   ```bash
   ./vendor/bin/sail artisan key:generate
   ```

6. Execute as migrações e seeders:
   ```bash
   ./vendor/bin/sail artisan migrate --seed
   ```

7. A API estará disponível em `http://localhost`.

## Estrutura do Projeto

- `app/Http/Controllers/` - Controladores da API
- `app/Http/Requests/` - Validações customizadas das requisições
- `app/Http/Resources/` - Formatação padronizada das respostas
- `app/Models/` - Modelos da aplicação
- `routes/api.php` - Rotas da API
- `database/seeders/` - População inicial do banco de dados

## Demonstração

Esta API pode ser utilizada como ponto de contato para apresentar meu trabalho como desenvolvedor web freelancer. Ela centraliza minhas informações de contato e redes sociais, e está preparada para futuras integrações e melhorias.

### Exemplo simples de requisição

**Endpoint para buscar informações de contato:**
```http
GET https://api.carlosalexandre.com.br/v1/contacts
```
**Resposta:**
```json
{
    "message": "Contact information retrieved successfully.",
    "data": {
        "name": "Carlos Alexandre",
        "email": "dev@carlosalexandre.com.br",
        "phone": "+5511994411592",
        "freelance_available": true,
        "links": [],
        "socials": []
    },
    "error": null,
    "code": 200
}
```

## Licença

Este projeto está licenciado sob a Licença MIT. Veja o arquivo [LICENSE](LICENSE). Para mais informações.

## Colaboradores

Desenvolvido por [Carlos Alexandre](https://github.com/devc4rlos) — Full Stack Developer.  
