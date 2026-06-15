CREATE DATABASE IF NOT EXISTS news_portal
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE news_portal;

DROP TABLE IF EXISTS articles;
DROP TABLE IF EXISTS users;

CREATE TABLE users (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'user') NOT NULL DEFAULT 'user',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE articles (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(180) NOT NULL,
    summary VARCHAR(500) NOT NULL,
    content TEXT NOT NULL,
    category ENUM('politika', 'sport') NOT NULL,
    image VARCHAR(255) NOT NULL,
    published_at DATE NOT NULL,
    show_on_homepage TINYINT(1) NOT NULL DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_home_category_date (show_on_homepage, category, published_at)
) ENGINE=InnoDB;

-- Korisničko ime: admin
-- Lozinka: admin123
INSERT INTO users (username, password, role) VALUES
('admin', '$2y$10$c8gdTKTiym/.3v6zlSq5ye.0YCQgQhQuFiaJMQg.PIPHbSU7dQVGW', 'admin');

INSERT INTO articles
    (title, summary, content, category, image, published_at, show_on_homepage)
VALUES
(
    'Europski čelnici dogovorili novi paket mjera',
    'Nakon višesatnog sastanka postignut je dogovor o zajedničkim ulaganjima, energetskoj sigurnosti i potpori građanima.',
    'Europski čelnici završili su sastanak dogovorom o novom paketu mjera koji bi trebao ojačati energetsku sigurnost i potaknuti zajednička ulaganja. Predstavnici država naglasili su da će provedba biti postupna i prilagođena gospodarskim mogućnostima svake članice.

U središtu razgovora bili su troškovi energije, razvoj infrastrukture i zaštita kućanstava. Konačni dokument predviđa redovito praćenje rezultata te mogućnost izmjena ako se gospodarske okolnosti značajno promijene.

Prvi konkretni prijedlozi trebali bi biti predstavljeni tijekom sljedećeg mjeseca, nakon dodatnih razgovora stručnih radnih skupina.',
    'politika',
    'images/politika-1.svg',
    '2026-06-12',
    1
),
(
    'Vlada predstavila prioritete za drugu polovicu godine',
    'Program stavlja naglasak na stanovanje, obrazovanje i brže digitalne javne usluge, uz najavu javnog savjetovanja.',
    'Vlada je predstavila prioritete za drugu polovicu godine. Među glavnim temama nalaze se dostupnije stanovanje, modernizacija obrazovanja i jednostavniji pristup javnim uslugama.

Ministri su najavili da će se pojedini prijedlozi prije upućivanja u parlament otvoriti za javno savjetovanje. Cilj je, navode, uključiti građane i stručnu javnost u ranijoj fazi pripreme zakona.

Oporbene stranke zatražile su preciznije rokove i financijske pokazatelje, a rasprava će se nastaviti na sljedećoj sjednici.',
    'politika',
    'images/politika-2.svg',
    '2026-06-10',
    1
),
(
    'Parlament otvorio raspravu o novom zakonu',
    'Prijedlog zakona uređuje transparentnost javnih podataka i uvodi jedinstvene rokove za odgovore institucija.',
    'U parlamentu je otvorena rasprava o novom zakonu kojim se želi unaprijediti dostupnost javnih podataka. Prijedlog uvodi jedinstvene rokove i jasnija pravila za tijela javne vlasti.

Predlagatelji smatraju da će novi sustav građanima omogućiti brži pristup informacijama. Dio zastupnika upozorio je na potrebu dodatne zaštite osobnih podataka i boljeg tehničkog opremanja institucija.

Glasanje o prijedlogu očekuje se nakon završetka rasprave i razmatranja podnesenih amandmana.',
    'politika',
    'images/politika-3.svg',
    '2026-06-08',
    1
),
(
    'Velika pobjeda u završnici prvenstva',
    'Momčad je pred punim tribinama preokrenula rezultat u posljednjih deset minuta i osvojila važna tri boda.',
    'Domaća momčad ostvarila je važnu pobjedu u završnici prvenstva. Nakon ranog zaostatka igrači su strpljivo gradili napade i do izjednačenja stigli početkom drugog poluvremena.

Odlučujući pogodak postignut je u posljednjih deset minuta susreta. Trener je nakon utakmice pohvalio disciplinu i podršku navijača, ali je naglasio da posao još nije završen.

Sljedeće kolo donosi izravni susret s konkurentom za vrh ljestvice, zbog čega će pripreme početi već sutra.',
    'sport',
    'images/sport-1.svg',
    '2026-06-13',
    1
),
(
    'Mladi plivači osvojili pet medalja',
    'Reprezentacija se s međunarodnog natjecanja vraća s dva zlata, dva srebra i jednom brončanom medaljom.',
    'Mladi plivači ostvarili su zapažen rezultat na međunarodnom natjecanju i osvojili ukupno pet medalja. Najuspješniji su bili u disciplinama slobodnim stilom i leptir.

Izbornik je istaknuo da su rezultati potvrda kvalitetnog rada u klubovima. Posebno ga veseli što je nekoliko natjecatelja popravilo osobne rekorde.

Sportaše sada očekuje kratak odmor, a zatim pripreme za ljetno prvenstvo koje je glavni cilj sezone.',
    'sport',
    'images/sport-2.svg',
    '2026-06-09',
    1
),
(
    'Košarkaši izborili mjesto u finalu',
    'Čvrstom obranom i mirnom završnicom košarkaši su dobili odlučujuću utakmicu polufinalne serije.',
    'Košarkaši su izborili plasman u finale nakon napete odlučujuće utakmice. Susret je većim dijelom bio izjednačen, a pobjednik je odlučen u posljednje dvije minute.

Ključnom se pokazala obrana koja je suparniku dopustila samo jedan uspješan napad u završnici. Najefikasniji igrač utakmice naglasio je da je pobjeda rezultat momčadskog pristupa.

Finalna serija počinje sljedećeg vikenda, a prve dvije utakmice igraju se pred domaćom publikom.',
    'sport',
    'images/sport-3.svg',
    '2026-06-07',
    1
);
