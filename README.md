### Laravel Banners Module

ver. 1.0.0

### Usage

1. Установить пакет (если ещё не установлен) для поддержки модулей:

```
composer require nwidart/laravel-modules
```

2. Выполнить:

```
php artisan vendor:publish --provider="Nwidart\Modules\LaravelModulesServiceProvider"
```

3. В файл `composer.json` добавить `"Modules\\": "Modules/"`:

```
"autoload": {
    "psr-4": {
        "App\\": "app/",
        "Modules\\": "Modules/"
    },
```

4. В папке проекта создать папку `Modules/`
5. Создать пустой модуль:

```
php artisan module:make Banners --plain
```

6. Удалить все файлы из папки `Modules/Banners`:
7. Скопировать файлы модуля из репозитория:

```
git clone git@git.artjoker.ua:laravel/modules/laravel-banners.git Modules/Banners
```

8. Выполнить:

```
composer dump-autoload
```

9. Зайти в контейнер:

```
docker-compose exec php bash
```

10. Выполнить в контейнере:

```
php artisan module:migrate Banners
```

или

```
php artisan migrate:fresh --seed
```
### ВНИМАНИЕ!
При этом сиды из модуля не будут запущены. Их надо запустить отдельно или перенести в основной сидинг проекта.

11. Запустить сиды модуля можно так:

```
php artisan module:seed Banners
```

12. Проверить правильность префикса админпанели и необходимых middlewares в файле роутов модуля `Modules/Banners/Routes/web.php`:

```
Route::group([
        'prefix' => config('app.admin_panel_uri'),
        'as'     => 'backend.',
        'middleware' => ['setLocale', 'auth:admin'],
    ], function () {
    ...
```
13. Указать правильную ссылку на основной шаблон страниц админпанели (backend) в файле модуля `Modules/Banners/Resources/views/layouts/app.blade.php`, например:
```
@extends('backend.layouts.app')
```

14. Добавить ссылку в меню админпанели на страницы модуля:

```
<a href="{{ route('backend.campaigns') }}">Баннеры</a>
```
15. Изменить файлы шаблонов страниц модуля в соответствии с выбранной темой (дизайном) для админпанели.