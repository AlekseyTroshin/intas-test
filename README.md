## использовался MAMP (Apach, Mysql)

## БД intas_db_test_work

## порт http://localhost:8080


создание БД ----------

### папка create-mysql-data

1) заходим в папку create-mysql-data 
2) запускаем php create-file-mysql.php
3) создаёт intas_db_test_work.sql
4) в Mysql создаём БД intas_db_test_work 
5) создаём данные из дампа 


Проект -----------

### папка intas-test-work

1) заходим в папку intas-test-work
2) в компандной строке прописываем composer install

опиание проекта

app
- основная логика проекта
config
- конфигурации проекта
core
- создание базогово функционала для работы
helpers
- помощь при разработке 
public
- отсюда запускается проект и подключаются внешние зависимости
routes
- обрабатываются запросы к серверу