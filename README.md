# UTM statistics test task (CakePHP 2)

## Stack

- CakePHP 2.10.24
- PHP 7.2 + Apache
- MySQL 5.7
- Docker Compose

## Run

```bash
docker compose up -d --build
```
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
## Stop

```bash
docker compose down
```

To remove the DB volume too:

```bash
docker compose down -v
```
