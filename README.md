## Large DB
- Generate Large Database
- Create APIs in Laravel, FastAPI and NodeJs
- Benchmarking performace 
- Applying Improvements

## DB Tech Stack
- DB: MySQL 9.1.x:
- LANG: PhP 8.2.x:

## Import DB
```bash

source {project-path}/large-db-stats-performance/db/seq-numbers.sql;
source {project-path}/large-db-stats-performance/db/bulk-seed-sql.sql;

## For Better DB Performance, do this:
```bash

innodb_buffer_pool_size = 70% of RAM
innodb_log_file_size    = 1–4GB
innodb_flush_log_at_trx_commit = 2

