Weez Common
======

* Install database of test
```
Weez/Generator/demo/scripts/create_testzdmg_db.sql

```

* Setup config file (copy config.php.dist)

```
Weez/Generator/config/config.php.dist

```

* Generate Entity and EntityManager

```
php weezcmd app:model-generator Weez/Generator/config/config.php testzdmg Weez\\Generator\\demo\\Core\\Model Weez/Generator/demo/Core/Model --tables-all

```

Built In server test
In root directory 

```
php -S 0.0.0.0:8888

```

* Lanch browser

http://localhost:8888/Weez/Generator/demo