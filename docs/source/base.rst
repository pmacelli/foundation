.. _base-classes:

Base classes
============

Classes in the ``\Comodojo\Foundation\Base`` namespace are designed to support basic functionalities like configuration (provider and loader), parameters processing and application version management.

Configuration provider
----------------------

The ``\Comodojo\Foundation\Base\Configuration`` class provides methods to set, update and delete configuration statements.

A base configuration object can be created using standard constructor or static ``Configuration::create`` method. Constructor accepts an optional array of parameters that will be pushed to the properties' stack.

.. code-block:: php
    :linenos:

    <?php

    $params = ["this"=>"is","a"=>["config", "statement"]];

    $configuration = new \Comodojo\Foundation\Base\Configuration($params)

    // or, alternatively:
    // $configuration = \Comodojo\Foundation\Base\Configuration::create($params)

.. note:: Configuration statements are key->value(s) pairs arranged as a tree. The key **shall** be an alphanumeric, **dots-free** string. Value(s) can be of any supported type, with the only restriction that a key in a nested array is considered as a sub-key.

Once created, the configuration object offers five methods to manage the statements:

- ``Configuration::set()``: set (or update) a statement

- ``Configuration::get()``: get value of statement

- ``Configuration::has()``: check if statement is defined

- ``Configuration::delete()``: remove a statement from stack

- ``Configuration::merge()``: merge a package of statements into current stack

For example, the following code:

.. code-block:: php
    :linenos:

    <?php

    $params = ["this"=>"is","a"=>["config", "statement"]];

    $configuration = \Comodojo\Foundation\Base\Configuration::create($params);

    var_dump($configuration->get("a"));

    $configuration->set("that", "value");

    var_dump($configuration->get("that"));

Produces this result:

.. code::

    array(2) {
      [0] =>
      string(6) "config"
      [1] =>
      string(9) "statement"
    }

    string(5) "value"

Dot notation
............

The dot notation is an handy format, supported by the ``\Comodojo\Foundation\Base\Configuration`` object, to navigate the configuration tree or selectively change a configuration statement.

Considering the following example (yaml instead of php array only to increase readability):

    .. code-block:: yaml
        :linenos:

        log:
            enable: true
            name: applog
            providers:
                local:
                    type: StreamHandler
                    level: debug
                    stream: logs/extenderd.log
        cache:
            enable: true
            providers:
                local:
                    type: Filesystem
                    cache_folder: cache

To change the *cache*->*enable* flag:

.. code-block:: php
    :linenos:

    $configuration->set("cache.enable", false);

Or to get the actual value of *log*->*providers*->*local*->*type*:

.. code-block:: php
    :linenos:

    $configuration->get("log.providers.local.type");
