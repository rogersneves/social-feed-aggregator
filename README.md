# Querosene

## Descrição
Agregador de posts de redes sociais com feed completo, administração de usuários e posts com permissões granulares, e armazenamento criptografado em CSV.

## Funcionalidades Principais

### Feed Público
- Visualização de posts das principais redes sociais (YouTube, Instagram, Facebook, Vimeo, TikTok, X, Pinterest, Snapchat)
- Suporte para vídeos e imagens locais
- Sistema de lazy loading para melhor performance
- Barra de navegacião fixa com campo de pesquisa
- Incorporação de posts de redes sociais
- Votos (Gostei/Não gostei) em tempo real
- Pesquisa por título e tags

### Área de Administração (/admin)

#### Gerenciamento de Usuários
- Cadastro de novos usuários com email único
- Sistema de dois níveis de permissão:
  - **Editor**: Acesso apenas aos seus próprios posts
  - **Administrador**: Acesso aos posts de todos e gerenciamento de usuários

#### Cadastro de Posts
- Suporte para três tipos de posts:
  - **Redes Sociais**: Código de incorporação
  - **Imagem Local**: 1920px de largura, altura máxima 3413px
  - **Vídeo Local**: 1920px x 1080px
- Campos: ID, Título, Tipo, Tags
- Edição e deleção de posts

## Tecnologias

- **Frontend**: React, Bootstrap, HTML5, CSS3
- **Backend**: PHP
- **Banco de Dados**: CSV criptografado (AES-256-CBC)
- **Seguração**: Criptografia de alto nível para dados sensibilizados

## Estrutura de Diretórios

```
social-feed-aggregator/
├── index.html          # Página principal
├── app.js             # Aplicação React
├── styles.css         # Estilos CSS
├── api/               # APIs PHP
│   ├── config.php       # Configuração e criptografia
│   ├── posts.php        # API de posts
│   ├── login.php        # Autenticação
│   ├── vote.php         # Sistema de votos
│   └── search.php       # Busca de posts
└── dbspl/            # Banco de dados
    ├── users.csv        # Usuários (criptografado)
    ├── posts.csv        # Posts (criptografado)
    ├── votes.csv        # Votos (criptografado)
    ├── images/          # Imagens locais
    └── videos/          # Vídeos locais
```

## Instalação

1. Clone o repositório
2. Configure um servidor PHP (Apache, Nginx com PHP-FPM, etc.)
3. Coloque os arquivos no diretório public_html ou www
4. A pasta `dbspl` será criada automaticamente
5. Configure a chave de criptografia em `api/config.php`

## Configuração de Segurança

Antes de usar em produção:

1. Altere a `ENCRYPTION_KEY` em `api/config.php` para uma chave forte
2. Configure permissões de arquivo adequadas (chmod)
3. Use HTTPS
4. Implemente rate limiting
5. Valide e sanitize todas as entradas

## Download da Chave Criptográfica

Administradores podem baixar a chave criptográfica na área /admin para fins de backup.

## API Endpoints

- `GET /api/posts.php?page=1` - Obter posts com paginação
- `GET /api/search.php?q=query` - Pesquisar posts
- `POST /api/login.php` - Autenticação de usuário
- `POST /api/vote.php` - Registrar voto

## Licença

MIT License

## Autor

Roger Neves (rogersneves)
