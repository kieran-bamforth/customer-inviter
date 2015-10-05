# Customer Inviter
---
This is a PHP project that finds customers that are within 100Km of the Dublin office.

## Running the application (2 steps)

### Step 1: Install Composer

This project uses Composer to manage dev-dependencies / manage autoloading of classes. To generate the autoloader file, use the following Bash command in the root of the project:

```bash
$ composer update
```

This command requires you to have Composer installed globally, as explained
in the [installation chapter](https://getcomposer.org/doc/00-intro.md)
of the Composer documentation.

### Step 2: Run the entry PHP script

From the project root, enter these commands:

```bash
$ cd web
$ php -S localhost:8000
```

Now, point your browser to http://localhost:8000. You should now see a list of customers that are within 100Km of the Dublin office.

## Running the tests (2 commands)

This project uses PHPUnit for unit tests. Use the following commands from the project root:

```bash
$ composer update
$ ./vendor/bin/phpunit -c phpunit.xml
```