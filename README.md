# PierFans

PierFans é uma plataforma web desenvolvida em Laravel para monetização de conteúdo, semelhante a OnlyFans, permitindo que criadores publiquem conteúdos exclusivos para assinantes e realizem vendas de produtos digitais. O sistema oferece recursos avançados de gerenciamento de usuários, pagamentos, assinaturas, posts, mensagens privadas, blog, loja, integração com múltiplos gateways de pagamento e muito mais.

## Principais Funcionalidades
- Cadastro e autenticação de usuários (incluindo login social)
- Sistema de assinaturas pagas
- Publicação de posts, stories, vídeos e fotos
- Mensagens privadas e envio de mídia
- Loja de produtos digitais
- Sistema de gorjetas e pay-per-view
- Blog integrado
- Painel administrativo completo
- Suporte a múltiplos gateways de pagamento (Stripe, PayPal, Paystack, CCBill, Cardinity, MercadoPago, Razorpay, Mollie, etc.)
- Upload e processamento de mídia (imagens, vídeos)
- Suporte a 2FA (autenticação em dois fatores)
- Sistema de notificações
- Internacionalização (i18n)

## Estrutura de Pastas
- `app/` - Código principal da aplicação (Controllers, Models, Jobs, Services, etc.)
- `routes/` - Arquivos de rotas (web.php)
- `config/` - Configurações do Laravel e integrações
- `public/` - Assets públicos (imagens, JS, CSS)
- `resources/` - Views Blade, arquivos de tradução, etc.
- `database/` - Migrations, seeders e factories
- `tests/` - Testes automatizados

## Rotas Principais
As rotas estão definidas em `routes/web.php`. Exemplos:

- `/` - Página inicial
- `/login` e `/signup` - Autenticação
- `/logout` - Logout
- `/blog` - Blog
- `/p/{page}` - Páginas estáticas
- `/contact` - Contato
- `/messages` - Mensagens privadas
- `/my/products` - Meus produtos
- `/my/sales` - Minhas vendas
- `/my/purchased/items` - Minhas compras
- `/buy/subscription/success/{user}` - Sucesso na assinatura
- `/buy/subscription/cancel/{user}` - Cancelamento de assinatura
- `/payment/stripe`, `/payment/paystack`, `/payment/ccbill` - Pagamentos
- `/files/messages/{id}/{path}` - Arquivos de mensagens
- `/files/storage/{id}/{path}` - Arquivos de posts
- `/change/lang/{id}` - Troca de idioma
- `/sitemaps.xml` - Sitemap

E muitas outras rotas para gerenciamento de posts, uploads, loja, administração, etc.

## Instalação e Execução

### Pré-requisitos
- PHP >= 8.1
- Composer
- MySQL
- Node.js e npm
- Docker (opcional, recomendado)

### Instalação Manual
1. Clone o repositório:
   ```bash
   git clone <repo-url>
   cd pierfans-main
   ```
2. Instale as dependências PHP:
   ```bash
   composer install
   ```
3. Instale as dependências front-end:
   ```bash
   npm install && npm run build
   ```
4. Copie o arquivo `.env.example` para `.env` e configure as variáveis de ambiente (DB, e-mail, storage, etc.):
   ```bash
   cp .env.example .env
   ```
5. Gere a chave da aplicação:
   ```bash
   php artisan key:generate
   ```
6. Execute as migrations e seeders:
   ```bash
   php artisan migrate --seed
   ```
7. Inicie o servidor local:
   ```bash
   php artisan serve
   ```

### Instalação via Docker (passo a passo)
1. Certifique-se de ter o Docker Desktop instalado (ele já inclui o Docker Compose v2).
2. Na raiz do projeto, copie o `.env.example` para `.env`:
   ```bash
   cp .env.example .env
   ```
3. Edite o arquivo `.env` com as seguintes configurações mínimas para uso com o docker-compose deste projeto:
   - URL da aplicação (Traefik expõe com TLS):
     - APP_URL=https://pierfans.docker.localhost
   - Banco de dados (conforme docker-compose.yml):
     - DB_HOST=db
     - DB_PORT=3306
     - DB_DATABASE=p13rfns_db_hml
     - DB_USERNAME=docker
     - DB_PASSWORD=docker1
   - Redis e fila:
     - CACHE_DRIVER=redis
     - QUEUE_CONNECTION=redis
     - SESSION_DRIVER=file (ou redis, se preferir)
     - REDIS_HOST=redis
     - REDIS_PORT=6379
   - E-mail (MailDev):
     - MAIL_MAILER=smtp
     - MAIL_HOST=maildev
     - MAIL_PORT=1025
     - MAIL_USERNAME=null
     - MAIL_PASSWORD=null
     - MAIL_ENCRYPTION=null

4. Adicione os domínios ao arquivo de hosts do seu sistema operacional para que os hosts locais resolvam para 127.0.0.1:
   - 127.0.0.1 pierfans.docker.localhost
   - 127.0.0.1 webmail.docker.localhost
   Observação (Windows): o arquivo costuma estar em `C:\Windows\System32\drivers\etc\hosts` executando seu editor como Administrador.

5. Construa e suba os containers (modo destaque: em background):
   ```bash
   docker compose up -d --build
   # Caso sua versão utilize o binário antigo:
   # docker-compose up -d --build
   ```

6. Instale as dependências PHP dentro do container da aplicação:
   ```bash
   docker compose exec app composer install
   ```

7. Gere a chave da aplicação, crie o link do storage e rode as migrations/seeders (também dentro do container):
   ```bash
   docker compose exec app php artisan key:generate
   docker compose exec app php artisan storage:link
   docker compose exec app php artisan migrate --seed
   ```

8. Instale e construa os assets front-end na máquina host (o container PHP não possui Node.js):
   ```bash
   npm install
   npm run build
   # (opcional, para desenvolvimento) npm run dev
   ```

9. Acesse a aplicação:
   - App: https://pierfans.docker.localhost
   - MailDev (leitura de e-mails enviados pela app):
     - Via Traefik: https://webmail.docker.localhost
     - Ou diretamente pela porta: http://localhost:1080

10. Logs e comandos úteis:
    - Ver logs em tempo real: `docker compose logs -f app` (ou `queue`, `db`, `redis`, `traefik`)
    - Abrir um shell no container da app: `docker compose exec app bash`
    - Parar a stack: `docker compose down`
    - Parar e remover volumes (apaga o banco/arquivos em volumes): `docker compose down -v`

Observações:
- O worker de filas já é executado automaticamente pelo serviço `queue` definido no docker-compose.
- O MySQL fica acessível na porta `3306` do host (usuário: `docker`, senha: `docker1`, db: `p13rfns_db_hml`).
- Caso acesse via HTTPS e veja um aviso de certificado, aceite o certificado local gerenciado pelo Traefik para uso em desenvolvimento.

## Configuração de Pagamentos
Configure as chaves dos gateways de pagamento desejados no arquivo `.env`.

## Suporte e Licença
Este projeto utiliza a licença MIT. Para dúvidas, consulte a documentação ou abra uma issue.

---

> Projeto desenvolvido com Laravel 10, Livewire, Docker e integração com múltiplos serviços de pagamento.