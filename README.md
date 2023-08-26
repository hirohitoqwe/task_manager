Таск менеджер на фреймворке Laravel + Vue.js

# TaskManager

Приложение умеет:

● Создавать разделы задач, удалять их

● Создавать сами задачи, удалять их, отмечать выполнение

● Бэкенд реализован на Laravel и с ним можно работать по средствам API

------------

API GET

{host}/api/section/{userID} - получить все разделы пользователя

{host}/api/nullTask/{userId} - получить все задачи начальной пользователя

{host}/api/tasks/{userId} - получить все задачи пользователя

{host}/api/user/ - получить текущего юзера

{host}/api/user/id - получить id текущего юзера

{host}/api/section/getTask/{id} - получить все задачи раздела

API POST

{host}/api/section/create - создать разедл

{host}/api/task - создать задачу

API DELETE

{host}/api/{id} - удалить раздел

{host}/api/task/{id} - удалить задачу

API PATCH

{host}/api/task/{id} - изменить статус задачи

----------------

## В проекте использовались

- Laravel Sanctum
- Vuex
- Bootstrap

## Как запустить?

* Склонируйте репозиторий на локальный компьютер
* composer update --ignore-platform-reqs
* npm install
* Сконфигурируйте .env file
* php artisan: migrate

##### Примечание

- Были написаны тесты для API

#### Gratitude to

* Danil Wirtenberger
* Andrey Khodyrev
