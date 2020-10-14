# Fusion Command Line Interface

Fucli - это консольное приложение, разработанное для облегчения жизни разработчикам Битрикс24. В первую очередь оно ориентируется на применение в корпоративных порталах, хотя может использоваться и при разработке сайтов на БУС. Разработка и поддержка осуществляется компанией [ООО Фьюжн](https://efusion.ru/).\

## Возможности

* Генерация первичной структуры папки local
* Генерация простого компонента на новом ядре
* Генерация инсталлера для проекта
* Вывод лицензионного ключа продукта
* Самотестирование

## Требования

Для использования:
- PHP 7.0+
- ext/phar

Для сборки дополнительно:
- В php.ini: phar.readonly = Off

## Установка

### Для использования

Скачать файл fucli.phar, загрузить в корневую директорию проекта.

### Для сборки

- Подготовить окружение
- Клонировать репозиторий
- Запустить builder.php