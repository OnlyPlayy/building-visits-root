System umawiania wizyt ekipy budowlanej

Sposób uruchomienia aplikacji lokalnie:
1. Folder building-visits-root wrzuć do katalogu xampp/htdocs
2. Uruchom Xampp a w nim moduły Apache i MySQL
3. W terminalu w folderze building-visits-root/frontend uruchom frontend używając 'npm run serve'
4. Aplikacja powinna już działać, spróbuj dodać nową wizytę używając formularza znajdującego się na stronie localhost:8080
5. Na stronie pojawi się odpowiedni komunikat, jeżeli wszystko poszło sprawnie w bazie danych pojawi się nowy rekord. Firma budowlana może zweryfikować obecność nowego rekordu na stronie localhost:8080/admin