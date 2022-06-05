#### Api napisane na potrzeby serwisu minecraftlista. 

| metoda | endpoint             | opis                                                                                                                                               |
|--------|----------------------|----------------------------------------------------------------------------------------------------------------------------------------------------|
| POST   | /servers             | Dodaje nowy serwer (wymagane podanie ip serwera lub rekordu SRV). Aplikacja wysyła zapytanie do zewnętrznego serwisu i stamtąd pobiera informacje. |
| GET    | /servers             | Zwraca wszystkie dostępne serwery, posegregowane według liczby głosów na dany serwer.                                                              |
| GET    | /servers/**{id}**    | Zwraca serwer o konkretnym id.                                                                                                                     |
| POST   | /categories          | Tworzy nową kategorie, wymagane podanie nazwy tej kategorii.                                                                                       |
| GET    | /categories          | Zwraca kategorie.                                                                                                                                  |
| GET    | /categories/**{id}** | Zwraca kategorie o konkretnym id dodatkowo serwery przypisane do tej kategorii.                                                                    |
| POST   | /votes               | Oddaje głos na konkretny serwer. Wymagane jest podanie id serwera.                                                                                 |
