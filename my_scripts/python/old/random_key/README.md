# Пример работы кода:
``` python
>>> print(rnd_key("ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789", "-", 5, 3))
"598Y0-WEF2E-NWYOJ"
```

``` python
>>> print(rnd_key("ABC", "-", 5, 3))
"AAABC-ABCAA-ACCCC"
```

``` python
>>> print(rnd_key("ABC", "^^", 2, 5))
"BB^^BC^^BB^^AA^^CB"
```
