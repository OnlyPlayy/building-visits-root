System umawiania wizyt ekipy budowlanej

Sposób uruchomienia aplikacji lokalnie:
1. Folder `building-visits-root` wrzuć do katalogu `xampp/htdocs`
2. W terminalu w folderze `xampp/htdocs/building-visits-root` przygotuj frontend używając:
   - `cd frontend`
   - `npm install`
   - `npm run serve`
4. W terminalu przejdź do backendu i zainstaluj potrzebne zależności
   - `cd ../backend`
   - `composer install`
6. Uruchom aplikację XAMPP a w niej moduły Apache i MySQL
7. Na stronie `localhost/phpmyadmin` w przeglądarce zaimportuj plik znajdujący się w `db/schema.sql`
8. Aplikacja powinna już działać, spróbuj dodać nową wizytę używając formularza znajdującego się na stronie `localhost:8080`
9. Na stronie pojawi się odpowiedni komunikat, jeżeli wszystko poszło sprawnie w bazie danych pojawi się nowy rekord. Firma budowlana może zweryfikować obecność nowego rekordu na stronie localhost:8080/admin
