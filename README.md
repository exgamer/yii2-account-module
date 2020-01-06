# concepture-yii2account-module

    
Подключение

"require": {
    "concepture/yii2-blog" : "*"
},
    

Миграции
 php yii migrate/up --migrationPath=@concepture/yii2account/console/migrations --interactive=0
 
Подключение модуля для админки

     'modules' => [
         'article' => [
             'class' => 'concepture\yii2account\Module'
         ],
     ],
     
Для переопределния контроллера добавялем в настройки модуля

     'modules' => [
         'article' => [
            'class' => 'concepture\yii2account\Module',
            'controllerMap' => [
                'post' => 'backend\controllers\PostController'
            ],
         ],
     ],

            
Для переопределния папки с представленяими добавялем в настройки модуля

     'modules' => [
         'article' => [
             'class' => 'concepture\yii2account\Module',
             'viewPath' => '@backend/views'
         ],
     ],
     
Для переопределния любого класса можно вооспользоваться инекцией зависимостей через config.php
К примеру подменить модель StaticBlock на свой

    <?php
    return [
        'container' => [
            'definitions' => [
                'concepture\yii2account\models\StaticBlock' => ['class' => 'backend\models\StaticBlock'],
            ],
        ],
    ]