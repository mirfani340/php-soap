# Table Of Content
- [Table Of Content](#table-of-content)
- [What is this](#what-is-this)
- [Installation](#installation)
- [Dependency](#dependency)


# What is this

The WSDL Project using forked NuSOAP

# Installation
```php
composer install
```
or
```php
composer require econea/nusoap
```

Don't forget to change `/uploads` directory permission:
```
chmod ugo+rwx uploads
```

Also, don't forget to change this variable on `config.php`:
```
$servername = "YOUR_DATABASE";
$username = "YOUR_DATABASE_USERNAME";
$password = "YOUR_DATABASE_PASSWORD";
$dbname = "YOUR_DATABASE_NAME";
```

# Dependency

https://github.com/f00b4r/nusoap