# 建表建模型

```
php artisan make:model -m Models/Admin
php artisan make:model -m Models/Admin_log
php artisan make:model -m Models/Admin_operate
php artisan make:model -m Models/Agent
php artisan make:model -m Models/Agent_log
php artisan make:model -m Models/Setting
php artisan make:model -m Models/College
php artisan make:model -m Models/College_detial
php artisan make:model -m Models/College_level
php artisan make:model -m Models/College_category
php artisan make:model -m Models/College_batch
php artisan make:model -m Models/College_major
php artisan make:model -m Models/College_admit_scoure
php artisan make:model -m Models/major
php artisan make:model -m Models/Student
php artisan make:model -m Models/Student_log
php artisan make:model -m Models/Student_plan_category
php artisan make:model -m Models/Student_plan
php artisan make:model -m Models/Student_wish
php artisan make:model -m Models/Student_college_favorite
php artisan make:model -m Models/Student_source_record
php artisan make:model -m Models/Student_subject_category
php artisan make:model -m Models/Event_category
php artisan make:model -m Models/Event_news
php artisan make:model -m Models/Event_tags
php artisan make:model -m Models/Article_category
php artisan make:model -m Models/Article_news
php artisan make:model -m Models/Article_tags
```

## 安装 laravel-ide-helper 仅限开发阶段

```
composer require --dev barryvdh/laravel-ide-helper

#app/Providers/AppServiceProvider.php

public function register()
{
    if ($this->app->environment() !== 'production') {
        $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
    }
    // ...
}
```