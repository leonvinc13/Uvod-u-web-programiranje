# WALT - news portal

Studentski projekt izrađen u običnom PHP-u, HTML-u, CSS-u i MySQL-u za pokretanje u XAMPP-u.

## Analiza predložaka

- Stranica je bijeli, centrirani sadržaj na svijetlosivoj pozadini.
- Zaglavlje i podnožje su tamnoplavi, s velikim serifnim nazivom portala.
- Navigacija je u zasebnoj traci ispod logotipa.
- Naslovnica koristi odvojene sekcije i trostupčani raspored članaka.
- Kartica sadrži sliku, kategoriju, naslov, sažetak i datum.
- Stranica članka ima široku glavnu sliku, ali užu tekstualnu kolumnu radi čitljivosti.
- Administracija vizualno slijedi javni dio, ali koristi jasne forme i popis CRUD akcija.

## Struktura projekta

```text
news-portal/
|-- index.php                 naslovnica
|-- clanak.php                pojedinačni članak
|-- admin.php                 unos i popis članaka
|-- edit.php                  uređivanje članka
|-- delete.php                brisanje članka
|-- login.php                 prijava korisnika i administratora
|-- registracija.php          registracija novog korisnika
|-- registracija_obrada.php   validacija i unos korisnika u bazu
|-- logout.php                odjava
|-- config.php                postavke baze i aplikacije
|-- db.php                    MySQLi veza s bazom
|-- auth.php                  session i zaštita administracije
|-- functions.php             validacija, upload i pomoćne funkcije
|-- css/style.css             kompletan responzivni dizajn
|-- includes/                 zajednički dijelovi stranica i forme
|-- images/                   početne lokalne slike
|-- uploads/                  slike unesene kroz administraciju
`-- sql/baza.sql              struktura baze i početni podaci
```

## Podjela po fazama

### 1. faza - HTML i CSS

Datoteke `index.php`, `clanak.php`, `includes/` i `css/style.css` stvaraju naslovnicu i članak prema priloženom rasporedu. PHP je ovdje samo predložak koji ispisuje HTML.

### 2. faza - forma i PHP

`admin.php` sadrži POST formu za naslov, sažetak, puni tekst, kategoriju, sliku, datum i prikaz na naslovnici. `functions.php` provodi poslužiteljsku validaciju.

### 3. faza - PHP i MySQL

`sql/baza.sql` stvara tablice `articles` i `users`. `db.php` koristi MySQLi. Naslovnica dohvaća članke iz baze, `clanak.php` koristi URL parametar `id`, a `admin.php`, `edit.php` i `delete.php` čine CRUD.

### 4. / završna sigurnosna faza

- MySQLi prepared statements protiv SQL injectiona
- `password_hash` zapis u bazi i `password_verify` pri prijavi
- session prijava i regeneracija session ID-a
- zaštita svih administracijskih stranica
- uloge `admin` i `user`, pri čemu registrirani korisnik ne dobiva administratorske ovlasti
- CSRF tokeni za sve forme koje mijenjaju podatke
- `htmlspecialchars` pri prikazu korisničkih podataka
- provjera MIME tipa i veličine slike
- nasumični nazivi uploadanih slika
- zabrana izvršavanja PHP datoteka u mapi `uploads`
- brisanje isključivo POST metodom

## Pokretanje u XAMPP-u

1. Kopirajte mapu `news-portal` u `C:\xampp\htdocs\`.
2. Pokrenite Apache i MySQL u XAMPP Control Panelu.
3. Otvorite `http://localhost/phpmyadmin`.
4. Odaberite karticu **Import**, učitajte `sql/baza.sql` i pokrenite import.
5. Otvorite `http://localhost/news-portal/`.

Ako MySQL korisnik `root` ima lozinku, upišite je u `DB_PASS` unutar `config.php`.

## Administratorska prijava

- Korisničko ime: `admin`
- Lozinka: `admin123`


## Registracija korisnika

Stranica `registracija.php` prikazuje formu, a `registracija_obrada.php` validira podatke i unosi korisnika u bazu. Korisničko ime mora biti jedinstveno, a lozinka mora imati najmanje 8 znakova. Lozinka se u bazu sprema isključivo kao rezultat funkcije `password_hash`.

Nakon registracije korisnik se prijavljuje na `login.php`. Novi korisnici dobivaju ulogu `user`, dok samo početni račun s ulogom `admin` može dodavati, uređivati i brisati članke.

Prijavljeni obični korisnik može preko stavke `ADMINISTRACIJA` otvoriti svoj korisnički račun i odjaviti se. Administrator preko iste stavke ulazi u CRUD administraciju.
