# ClassDash — Project Structure

```
PROJECT/
├── config/
│   ├── config.php            # DB connection + session bootstrap
│   └── constants.php         # roles, permission levels, categories
│
├── includes/
│   ├── controllers/          # one controller per feature area
│   ├── models/                # one model per DB table/entity
│   ├── components/            # shared PHP partials (sidebar, topbar, auth)
│   └── router.php             # maps clean URLs -> controllers
│
└── public/                    # web root — point your server here
    ├── index.php               # single entry point (front controller)
    ├── .htaccess                # rewrites all requests to index.php
    ├── pages/                   # views only, no routing/business logic
    └── assets/
        ├── css/
        │   ├── global/          # tokens, reset, base layout
        │   ├── components/      # sidebar.css, topbar.css, cards.css...
        │   └── pages/            # one file per page, page-specific only
        ├── js/                   # same global/components/pages split
        └── images/
```

## How a request flows

1. Browser requests `/treasury`.
2. `.htaccess` rewrites it to `public/index.php` (real files like CSS/JS are
   served directly and skip this).
3. `index.php` loads `config/config.php` (DB + session), then
   `includes/router.php`.
4. The router looks up `treasury` in its route table, sets
   `$activeNav = 'treasury'`, and calls `TreasuryController::index()`.
5. The controller pulls data via `includes/models/Transaction.php` and
   requires `public/pages/treasury.php` to render.
6. The view includes `includes/components/sidebar.php`, which reads
   `$activeNav` to highlight the right nav item and calls
   `classdash_get_current_user()` from `auth.php` to show the logged-in
   user's name/role.

## Adding a new page

1. Add a route to `includes/router.php`.
2. Add/extend a controller in `includes/controllers/`.
3. Add a model in `includes/models/` if it needs its own DB queries.
4. Add the view in `public/pages/`.
5. Add page-specific CSS in `public/assets/css/pages/`.

## Environment setup (.env)

DB credentials live in a `.env` file at the project root, **not** in
`config/config.php`. This keeps real credentials out of git.

1. Copy the template: `cp .env.example .env`
2. Fill in `.env` with your real `DB_HOST`, `DB_NAME`, `DB_USER`, `DB_PASS`.
3. `.env` is already listed in `.gitignore` — only `.env.example` (with
   placeholder values) should ever be committed.
4. `config/config.php` calls `classdash_load_env()` (from `config/env.php`)
   to read `.env` into `getenv()`, then builds the PDO connection from it.
5. `public/.htaccess` also explicitly denies web requests to any dotfile,
   as a second layer of protection in case `.env` ever ends up somewhere
   web-accessible.

If you outgrow the hand-rolled loader in `config/env.php` (e.g. need
nested/typed values), swap it for `vlucas/phpdotenv` via Composer — usage
stays the same since both expose values through `getenv()`.

## Database schema

Run `classdash_schema.sql` (in the project root, or wherever you saved it)
against your existing database in phpMyAdmin's SQL tab. It adds three
tables on top of your existing `users` table:

- **`users`** *(already existed)* — `id, username, pwd, email, role, created_at, updated_at`.
  `role` is `ENUM('president','vice','treasurer','secretary','student')`.
  The old `debt` column was dropped in favor of the `debts` table below.
- **`debts`** — one row per specific charge owed (e.g. "June Dues", "Event
  Supplies Fee"), each with its own `status` of `unpaid`/`paid`.
- **`transactions`** — the treasury ledger (dues collected, expenses,
  event proceeds, debt payments). A debt-payment transaction links back
  to the debt it settles via `debt_id`.
- **`announcements`** — Info Board posts, tagged `event`/`schedule`/`misc`.

`Transaction::payDebt()` handles the common "student pays off a debt"
flow: it inserts the payment as a transaction AND flips the debt to
`paid`, wrapped in a single DB transaction so they can't get out of sync.

**Note on `pwd`:** `User::verifyPassword()` uses PHP's `password_verify()`,
which expects the stored value to be a bcrypt hash from `password_hash()`
(what `User::create()` produces). If any existing rows in `users.pwd`
were inserted as plain text, login will fail for those until you rehash
them.



## Placeholders

Search for `PLACEHOLDER_..._SIDEBAR` across the project — these mark values
that come from your database/session at runtime (user name, role, error
messages, empty-state copy) rather than being hardcoded.
