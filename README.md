XSS/SQLi Remover
================

Class for complete remove XSS and SQLi from strings in PHP.

Installation
============

Simply download and add to your namespace or library.

Usage
=====

If you want to clean simple string use ```cleanInput()``` function.

```
  $cleanString = Clean::cleanInput($dirtyString);
```

If you want to clean array with various values use ```cleanArray()``` function.

```
  $cleanArray = Clean::cleanArray($dirtyArray);
```

Dev info
========

All methods are static, so you don't need to create new Instance of the class.
Simply use as it is. It is secure.

Function ```cleanInput($data, $addSlashes)``` have two parameters

```$data```  - Posted data to clean, in this case one string

```$addSlashes``` - If you want to use addslashes, for better security, set this as ```TRUE```, default is ```FALSE```

Function ```cleanArray($data, $addSlashes)``` have two parameters

```$data```  - Posted data to clean, in this case multi-dimensional array

```$addSlashes``` - If you want to use addslashes, for better security, set this as ```TRUE```, default is ```FALSE```


