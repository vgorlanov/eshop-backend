## Eshop backend

### Description
Демонстрационный пример интернет магазина.

#### Реализовано:
- Поиск товаров с использование Elasticsearch с учётом категории
- Формирование корзины с товарами
- Формирование заказа
- Создание/редактирование/удаление товара
- Создание/редактирование/удаление катергоии 
- Просмотр заказов

#### Техническая реализация
- Frontend и Admin-ка реализованы на VueJs (SPA) 
- Backend реализован на Laravel

На инфраструктурном для получения сущностей Product используется 
паттерн Repository

```
App\Infrastructure\Repositories\Product\ProductRepository
App\Infrastructure\Repositories\Product\EloquentRepository
App\Infrastructure\Repositories\Product\MemoryRepository
App\Infrastructure\Repositories\Product\ElasticRepository
```
Что позволяет легко менять реализацию получения данных из хранилищь 
(бд, elasticsearch, memory).
Для frontend-а можно использовать реализацию ElasticRepository
Для admin-ки EloquentRepository
Для тестирования MemoryRepository:
```
Tests\Unit\Repository\MemoryTes
```

Для функционала карзины 
 ```
App\Library\Cart\Cart
 ```
с помощью DI имеется возможность менять реализацию хранилица корзины.
на боевом RedisCartStore
на тестах ArrayCartStore

#### Stack 
- PHP
- Laravel
- MySQL
- VueJs
- Elasticsearch
- Redis
- Nginx
- Docker

## Install

#### composer
```
export NGINX_IP=$(hostname -I | awk '{print $1}') && docker-compose run --rm composer install
```
#### up & migrations
```
docker-compose up -d && docker exec eshop-backend sh cmd.sh
```

#### passport key
```
set PASSPORT_CLIENT_SECRET for cliend 2
```

### links
backend - http://localhost/api

front - http://localhost:8181

admin - http://localhost:8182/admin


## Demo
http://vgorlanov.ru

