# Celem warsztatów jest napisanie pełnej i funkcjonalnej aplikacji do wypożyczania książek

metodą REST. Projekt będzie składał się z dwóch części:

• Serwer: napisany w PHP, implementujący funkcjonalność REST,

• Client: napisany w HTML i JS, komunikujący się z serwerem za pomocą AJAX.

Serwer ma implementować następujące klasy:

• Book: ma posiadać swoje id, Nazwę, Autora i opis.

Serwer ma też implementować następujące ścieżki dostępu :

--Metoda HTTP Adres--> Co robi?

GET api/books.php--> Zwraca listę wszystkich książek.

POST api/books.php--> Tworzy nową książkę na podstawie danych przekazanych z formularza i zapisuje ją do bazy danych.

GET api/books.php?id=1--> Wyświetla informacje o książce o podanym id.

PUT api/books.php?id=1&amp; --> Zmienia informacje o książce o podanym id na nowe

DELETE api/books.php?id=1 Usuwa książkę o podanym id z bazy danych



Klient ma implementować tylko stronę główną:

• Strona ta ma pokazać wszystkie książki stworzone w systemie. Dane mają być

wczytane AJAX-em z api/books.php

• Na tej górze tej strony ma być też formularz do tworzenia nowych książek wysyłając dane AJAX-em (metoda POST).

• Po kliknięciu na nazwę książki pod nią ma się rozwijać div z informacjami na temat tej strony wczytane 
za pomocą AJAX (GET) z endpointu api/books.php?id=….
Div ten ma też zawierać formularz służący do edycji tej książki (AJAX, metoda PUT)

• Obok nazwy ma się znajdować guzik służący do usuwania książki (AJAX, metoda DELETE)