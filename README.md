# DoAnTotNghiep
Đồ án tốt nghiệp của Nguyễn Minh Vũ

Link thiết kế DB: https://app.diagrams.net/#G1dy5sSgL-0gXNjyShtfKGx_T7xyXnIJ8G

### Installation
Put laradock and source code directories like below:
```sh
- projects
    -- laradock
    -- DoAnTotNghiep
```
### 1. Laradock
```sh
git clone https://github.com/Laradock/laradock.git
cd laradock
cp env-example .env
```

Open Laradock .env and config as below
```sh
vi .env
```

```sh
PHP_VERSION=8.1
APP_CODE_PATH_HOST=../DoAnTotNghiep
COMPOSE_PROJECT_NAME=DoAnTotNghiep
WORKSPACE_INSTALL_NODE=true
WORKSPACE_INSTALL_YARN=true

PHP_FPM_INSTALL_MYSQLI=true

MYSQL_VERSION=latest
MYSQL_DATABASE=default
MYSQL_USER=default
MYSQL_PASSWORD=secret
```

### 2. Source code:
Clone code:
```sh
git clone https://github.com/nguyenminhvu4901/DoAnTotNghiep
cd DoAnTotNghiep
cp .env.example .env
```

Run docker:
```sh
cd laradock
docker-compose up -d mysql nginx workspace
```

Open workspace:
```sh
docker-compose exec workspace bash
```

Build vendor
```sh
composer install
npm install
yarn
php artisan key:generate
php artisan migrate --seed
art db:seed --class=Database\\Seeders\\Data\\StaffSeeder
art db:seed --class=Database\\Seeders\\Data\\CustomerSeeder
npm run production
phpunit
php artisan storage:link
```
Notice
```
Mỗi khi chạy seed sẽ chạy hết các lệnh seed đã lưu ở trên
```


