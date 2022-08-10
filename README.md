Component Locker
================

Gerenciador de lock de recursos e execussões.

Instalação
----------

É recomendado instalar **component-locker** através do [composer](http://getcomposer.org).

```json
{
    "require": {
        "lidercap/framework-component-locker": "dev-master"
    },
    "repositories": [
        {
            "type": "vcs",
            "url":  "git@github.com:lidercap/framework-component-locker.git"
        }
    ]
}
```

ExecutionLocker::isLocked()
---------------------------

Verifica se há lock de execussão.

```php
<?php

$locker = new \Lidercap\Component\Locker\ExecutionLoker();
$locker->setLockFile('/path/to/lock/file.lock');
$locker->setPidFile('/path/to/pid/file.pid');
$locker->setPidNumber(123);

var_dump($locker->isLocked()); // TRUE | FALSE

```

ExecutionLocker::lock()
-----------------------

Cria um lock de execussão.

```php
<?php

$locker = new \Lidercap\Component\Locker\ExecutionLoker();
$locker->setLockFile('/path/to/lock/file.lock');
$locker->setPidFile('/path/to/pid/file.pid');
$locker->setPidNumber(123);

$locker->lock();

var_dump($locker->isLocked()); // TRUE

```

ExecutionLocker::unLock()
-------------------------

Remove um lock de execussão.

```php
<?php

$locker = new \Lidercap\Component\Locker\ExecutionLoker();
$locker->setLockFile('/path/to/lock/file.lock');
$locker->setPidFile('/path/to/pid/file.pid');
$locker->setPidNumber(123);

$locker->unLock();

var_dump($locker->isLocked()); // FALSE

```

Desenvolvimento e Testes
------------------------

Dependências:

 * PHP 7.0.x ou superior
 * Composer
 * Git
 * Make

Para rodar a suite de testes, você deve instalar as dependências externas do projeto e então rodar o PHPUnit.

    $ make install
    $ make testdox (com relatório detalhado)
    $ make test    (sem relatório simples)

Responsáveis técnicos
---------------------

 * **Leonardo Thibes: <lthibes@lidercap.com.br>**
 * **Gabriel Specian: <gspecian@lidercap.com.br>**
