1. go to terminal and composer install
2. if dependencies missing, install the following dependencies
```bash
composer require laminas/laminas-component-installer
composer require laminas/laminas-development-mode
composer require laminas/laminas-skeleton-installer
composer require laminas/laminas-mvc
composer require laminas/laminas-router
composer require laminas/laminas-form
composer require laminas/laminas-inputfilter
composer require laminas/laminas-validator
composer require laminas/laminas-i18n
composer require laminas/laminas-log
composer require laminas/laminas-di
composer require laminas/laminas-db
composer require laminas/laminas-developer-tools
composer require doctrine/orm
composer require doctrine/migrations
composer require doctrine/dbal
composer require doctrine/doctrine-orm-module
composer require doctrine/doctrine-orm-module
composer require doctrine/annotations
composer require doctrine/doctrine-orm-module
composer require vlucas/phpdotenv
composer require doctrine/doctrine-orm-module
composer require doctrine/doctrine-migrations-bundle
```
3. go to C:\xampp\php\php.ini and enable extension=intl
4. go to xampp control panel, start apache and mysql, and press shell
```bash
mysql -u root -p
```
5. create database
```bash
CREATE DATABASE notes;
```
6. go to your database
```bash
USE notes;
```
7. create "note" table
```bash
CREATE TABLE note (
    id INT AUTO_INCREMENT NOT NULL,
    title VARCHAR(255) NOT NULL,
    content LONGTEXT NOT NULL,
    created_at DATETIME NOT NULL,
    PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;
```
8. make a sample note
```bash
INSERT INTO note (title, content, created_at) VALUES ('Sample Note', 'This is a sample content.', NOW());
```
9. see sample note
```bash
SELECT * FROM note;
```
10. create another table
```bash
CREATE TABLE doctrine_migration_versions (
    version VARCHAR(255) NOT NULL,
    executed_at DATETIME NOT NULL,
    PRIMARY KEY(version));
```
11. record migration
```bash
INSERT INTO doctrine_migration_versions (version, executed_at) VALUES ('Version20240926105400', NOW());

```
12. go back to terminal and
```bash
vendor/bin/doctrine-module orm:clear-cache:metadata
```
```bash
vendor/bin/doctrine-module migrations:sync-metadata-storage
```
13. enable development mode
```bash
composer development-enable
```
14. serve project
```bash
php -S localhost:8080 -t public
```
15. test in postman (raw json)