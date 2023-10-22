Для запуска использовал этот докер образ: https://github.com/Rafinol/yii2-docker

#### Миграции

```
php yii migrate
```

#### Генерация фикстур

```
php yii fixture/generate-all --count=50
php yii fixture/generate author --count=15
```

#### Загрузка фикстур

```
php yii fixture/load "*"
```

#### Проверить отчет

```
php yii get-best-authors-report
```

#### Проверить функционал работы подписки

В файле config/params вбить свой smsPilotApiKey и запустить:

```
php yii create-random-new-book
```