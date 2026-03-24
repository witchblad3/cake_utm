# UTM statistics test task (CakePHP 2)

A layered implementation of the test task on CakePHP 2:

- Controller: handles HTTP request/response
- Repository: isolates DB queries
- Service: orchestrates the use case
- TreeBuilder: converts flat rows into a nested tree
- Helper: recursively renders the tree in the view

## Stack

- CakePHP 2.10.24
- PHP 7.2 + Apache
- MySQL 5.7
- Docker Compose

## Run

```bash
docker compose up -d --build
```

After startup, open:

- App: http://localhost:8080/statistics/utm/list
- MySQL: localhost:3307

## Database credentials

- database: `utm_test`
- user: `cake`
- password: `cake`
- root password: `root`

## Project structure

```text
app/
  Config/
    database.php
    routes.php
  Controller/
    StatisticsController.php
  Model/
    UtmDatum.php
  Lib/
    UtmStatistics/
      Repository/
        UtmDataRepository.php
      Service/
        UtmStatisticsService.php
        UtmTreeBuilder.php
  View/
    Helper/
      UtmTreeHelper.php
    Statistics/
      utm_list.ctp

database/
  init.sql

docker/
  entrypoint.sh
```

## Notes

- Pagination is applied to distinct `source` values.
- One page contains at most 20 unique sources.
- `NULL` values are rendered as the string `NULL`.
- The DB is seeded automatically from `database/init.sql` on first startup.

## Stop

```bash
docker compose down
```

To remove the DB volume too:

```bash
docker compose down -v
```
