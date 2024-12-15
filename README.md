# CI4 Simplify Template
A template with several helper classes and a Makefile to gather 
- Bootstrap
- Bootstrap Icons
- phpscss
- htmz
- CI Shield

```bash
composer create-project -s dev m3tti/ci-simplify --repository '{"type":"vcs","url":"https://github.com/m3tti/ci-simplify"}' <project_name>

make assets
make scss

# first make your database settings otherwise we'll use an sqlite3 database
php spark migrate --all
php spark serve
```
