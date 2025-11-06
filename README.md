# CRUD Clientes + Produtos (PHP + MySQLi)

Projeto exemplo com dois módulos completos (CRUD): **Clientes** e **Produtos**.

## Requisitos
- PHP 7.4+
- MySQL 5.7+ ou MariaDB 10+
- Servidor local (XAMPP, WampServer, Laragon, etc.)

## Instalação
1. Crie um banco (ex.: `crud_escola`) e **importe** o arquivo `database.sql` pelo phpMyAdmin.
2. Edite `config.inc.php` e ajuste `DB_HOST`, `DB_USER`, `DB_PASS`, `DB_NAME`.
3. Coloque a pasta `crud_clientes_produtos` no diretório do seu servidor (ex.: `htdocs/` no XAMPP).
4. Acesse no navegador: `http://localhost/crud_clientes_produtos/`

## Estrutura
```
crud_clientes_produtos/
├─ config.inc.php
├─ includes/
│  ├─ header.php
│  ├─ footer.php
│  └─ menu.php
├─ index.php
├─ public/
│  └─ style.css
├─ clientes/  (CRUD de clientes)
└─ produtos/  (CRUD de produtos)
```

## Segurança
- Uso de **Prepared Statements** (MySQLi) em INSERT/UPDATE/DELETE.
- `htmlspecialchars()` na saída para evitar XSS.
- Validação simples no backend.

## Créditos
Gerado automaticamente para fins didáticos.
