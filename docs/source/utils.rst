Generic utilities
=================

Array Operations
----------------

ArrayOps::circularDiffKeys
..........................

Perform a circular diff between two arrays using keys.

This method is useful to compute the actual differences between two arrays.

Usage:

.. code-block:: php

    $left = [
        "ford" => "perfect",
        "marvin" => "android",
        "arthur" => "dent"
    ];

    $right = [
        "marvin" => "android",
        "tricia" => "mcmillan"
    ];

    var_dump(\Comodojo\Foundation\Utils\ArrayOps::circularDiffKeys($left, $right));

It returns:

.. code::

    array(3) {
      [0] =>
      array(2) {
        'ford' =>
        string(7) "perfect"
        'arthur' =>
        string(4) "dent"
      }
      [1] =>
      array(1) {
        'marvin' =>
        string(7) "android"
      }
      [2] =>
      array(1) {
        'tricia' =>
        string(8) "mcmillan"
      }
    }

ArrayOps::filterByKeys
......................

Filter an array by an array of keys.

Usage:

.. code-block:: php

    $stack = [
        "ford" => "perfect",
        "marvin" => "android",
        "arthur" => "dent"
    ];

    $keys = [
        "ford",
        "arthur"
    ];

    var_dump(\Comodojo\Foundation\Utils\ArrayOps::filterByKeys($keys, $stack));

It returns:

.. code::

    array(2) {
      'ford' =>
      string(7) "perfect"
      'arthur' =>
      string(4) "dent"
    }

ArrayOps::replaceStrict
.......................

Perform a selective replace of items only if relative keys are actually defined in source array.

Usage:

.. code-block:: php

    $stack = [
        "ford" => "perfect",
        "marvin" => "android",
        "arthur" => "dent"
    ];

    $replace = [
        "marvin" => "robot",
        "tricia" => "mcmillan"
    ];

    var_dump(\Comodojo\Foundation\Utils\ArrayOps::replaceStrict($stack, $replace));

It returns:

.. code::

    array(3) {
      'ford' =>
      string(7) "perfect"
      'marvin' =>
      string(5) "robot"
      'arthur' =>
      string(4) "dent"
    }
