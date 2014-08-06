Weez Common
======

* Install database of test
```
Weez/ZendModelGenerator/demo/scripts/create_testzdmg_db.sql

```

* Setup config file (copy config.php.dist)

```
Weez/ZendModelGenerator/config/config.php.dist

```

* Generate Entity and EntityManager

```
php weezcmd app:model-generator Weez/ZendModelGenerator/config/config.php testzdmg Weez\\ZendModelGenerator\\demo\\Core\\Model Weez/ZendModelGenerator/demo/Core/Model --tables-all --zfv 2

```

Built In server test
In root directory 

```
php -S 0.0.0.0:8888

```

* Lanch browser

http://localhost:8888/Weez/ZendModelGenerator/demo