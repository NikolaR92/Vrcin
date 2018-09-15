-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 03, 2014 at 08:42 AM
-- Server version: 5.6.15-log
-- PHP Version: 5.5.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `biblioteka`
--

-- --------------------------------------------------------

--
-- Table structure for table `clanovi`
--

CREATE TABLE IF NOT EXISTS `clanovi` (
  `broj_karte` varchar(6) CHARACTER SET ascii COLLATE ascii_bin NOT NULL,
  `ime` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `prezime` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `adresa` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `datum_rodjenja` date DEFAULT NULL,
  `sifra` varchar(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`broj_karte`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `clanovi`
--

INSERT INTO `clanovi` (`broj_karte`, `ime`, `prezime`, `adresa`, `datum_rodjenja`, `sifra`) VALUES
('as0110', 'Ana', 'Sinđelić', 'Mileta Cerovca 57', '1992-10-01', 'Ana1992'),
('as1212', 'Ana', 'Stojanović', 'Cerska 10', '1992-12-12', '0123'),
('dj0208', 'Dragana', 'Janković', 'Avalska 102', '1992-08-02', 'Dragana0208'),
('ik2201', 'Igor', 'Krstić', 'Ibarska 23', '1991-01-22', 'IgorKrstic1991'),
('ip1112', 'Igor', 'Pribičević', 'Titelska 54', '1992-12-11', '1234'),
('is1805', 'Isidora', 'Starčević', 'Tranšped 43', '1993-05-18', 'Isidora1993'),
('mb3112', 'Mile', 'Bojović', 'Avalska 2', '1991-12-31', 'Bojovic1992'),
('mk2111', 'Miljana', 'Krstić', 'Cerska 6', '1994-11-21', 'MFr0205'),
('mp2211', 'Miljan', 'Petrović', 'Železnička 23', '1992-11-22', 'MP1992'),
('mr0711', 'Momčilo', 'Ristić', 'Mileta Cerovca 53', '1994-11-07', 'moma94'),
('ms2702', 'Momčilo', 'Sević', 'Železnička 54', '0000-00-00', 'Viktor27'),
('np0403', 'Nikola', 'Prokić', 'Avalska 24', '1992-03-04', 'Proka1992'),
('np2212', 'Nikola', 'Petrović', 'Železnička 22', '0000-00-00', 'MPetrovic'),
('nr1301', 'Nada', 'Rajić', 'Mileta Cerovca 24', '1995-01-13', '2345'),
('nr1501', 'Nikola', 'Ristić', 'Mileta Cerovca 53', '1992-01-15', 'Nikola92'),
('nr2804', 'Nevena', 'Rajić', 'Avalska 32', '1992-04-28', 'RajicN92'),
('pp1212', 'Petar', 'Pavlović', 'Ustanička 213', '1992-12-12', 'PP1212');

-- --------------------------------------------------------

--
-- Table structure for table `iznajmljivanje`
--

CREATE TABLE IF NOT EXISTS `iznajmljivanje` (
  `id_iznajmljivanja` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `broj_karte` varchar(6) COLLATE utf8_bin NOT NULL,
  `id_knjige` int(10) NOT NULL,
  `datum_iznajmljivanja` date DEFAULT NULL,
  `datum_vracanja` date DEFAULT NULL,
  PRIMARY KEY (`id_iznajmljivanja`),
  UNIQUE KEY `datum_vracanja_2` (`datum_vracanja`),
  KEY `broj_karte` (`broj_karte`,`id_knjige`),
  KEY `datum_iznajmljivanja` (`datum_iznajmljivanja`),
  KEY `datum_vracanja` (`datum_vracanja`),
  KEY `datum_vracanja_3` (`datum_vracanja`),
  KEY `broj_karte_2` (`broj_karte`),
  KEY `id_knjige` (`id_knjige`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=9 ;

--
-- Dumping data for table `iznajmljivanje`
--

INSERT INTO `iznajmljivanje` (`id_iznajmljivanja`, `broj_karte`, `id_knjige`, `datum_iznajmljivanja`, `datum_vracanja`) VALUES
(1, 'pp1212', 5, '2014-06-22', '2014-07-10'),
(2, 'ip1112', 4, '2014-08-23', NULL),
(3, 'dj0208', 3, '2014-05-20', '2014-06-12'),
(4, 'nr2804', 6, '2014-05-12', '2014-07-11'),
(5, 'as0110', 5, '2014-12-02', NULL),
(6, 'nr1501', 6, '2014-08-20', NULL),
(7, 'mb3112', 2, '2014-08-24', NULL),
(8, 'nr2804', 7, '2014-08-23', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `knjige`
--

CREATE TABLE IF NOT EXISTS `knjige` (
  `id_knjige` int(10) NOT NULL,
  `naziv` text COLLATE utf8_bin NOT NULL,
  `autor` text COLLATE utf8_bin NOT NULL,
  `izdavac` text COLLATE utf8_bin,
  `izdanje` date DEFAULT NULL,
  PRIMARY KEY (`id_knjige`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `knjige`
--

INSERT INTO `knjige` (`id_knjige`, `naziv`, `autor`, `izdavac`, `izdanje`) VALUES
(1, 'Laka lova', 'Jens Lapidus', 'Laguna', '2014-07-01'),
(2, 'Odabrana Dela', 'Jakov Ignatović', 'Budućnost-Novi Sad', '1969-06-23'),
(3, 'Naučnici', '', 'Budućnost-Novi Sad', '1971-07-03'),
(4, 'Na Drini Ćupriji', 'Ivo Andrić', 'Budućnost-Novi Sad', '1971-12-12'),
(5, 'Beograđanke', 'Igor Marojević', 'Laguna-Beograd', '2014-07-01'),
(6, 'Koreni', 'Dobrica Ćosić', 'Budućnost-Novi Sad', '1970-12-21'),
(7, 'Uvod u organizaciju Računara', 'Nenad Mitić', 'Matematički fakultet-Beograd', '2009-07-20'),
(8, 'Kakodalogija', 'Ivan Stanković', 'Laguna', '2014-07-10'),
(9, 'Otkačeni vukodlak', 'Roberto Pavanelo', 'Laguna-Beograd', '2014-08-28'),
(10, 'Vorska igra', 'Loiz Mekmaster Bižol', 'Laguna-Beograd', '2014-08-01');

-- --------------------------------------------------------

--
-- Table structure for table `novinski_clanci`
--

CREATE TABLE IF NOT EXISTS `novinski_clanci` (
  `naslov` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `autor` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tekst` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `datum` date NOT NULL,
  PRIMARY KEY (`naslov`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `novinski_clanci`
--

INSERT INTO `novinski_clanci` (`naslov`, `autor`, `tekst`, `datum`) VALUES
('CIA objavila priručnik', 'Beta', 'Američka obaveštajna služba (CIA) izdala je priručnik na 185 strana za agente o stilu pisanja službenih izveštaja.\r\n\r\nIzveštaj je objavljen na sajtu "Freedom of Information Act" jer, po američkom zakonu, građani treba da imaju pristup i dokumentima te službe.\r\n \r\nU opširnom priručniku čitava poglavlja su o interpunkciji, pisanju brojeva i skraćenica, o kurzivu.\r\n \r\nAgentima se savetuje "živ stil u pisanju", da ne skreću s osnovne teme, da pišu kratke rečenice i pasuse, i da izbegavaju žargon.\r\n \r\nU priručniku se posvećuje pažnja i rečniku agenata. Oni tako reč "režim" koja ima negativnu konotaciju, ne treba da koriste za demokratske vlasti i zemlje-saveznice SAD.\r\n \r\nIzraz "odredjen broj" ne bi trebalo da se koristi jer je neprecizan, vec agent treba da napise: "neodređeni broj".\r\n', '2014-07-14'),
('Germany expels US spy row office', 'BBC', 'The German government has ordered the expulsion of a CIA official in Berlin in response to two cases of alleged spying by the US.\r\n\r\nThe official is said to have acted as a CIA contact at the US embassy, reports say, in a scandal that has infuriated German politicians.\r\n\r\nA 31-year-old German intelligence official was arrested last week on suspicion of spying.\r\n\r\nReports on Wednesday said an inquiry had also begun into a German soldier.\r\n\r\n"The representative of the US intelligence services at the embassy of the United States of America has been told to leave Germany," government spokesman Steffen Seibert said.', '2014-07-10'),
('Intelov prvi desktop procesor sa osam jezgara', 'Blic', 'Za entuzijaste, gejmere i kreatore sadržaja koji žele ultimativne performanse, Intelov prvi procesor koji podržava 16 tredova i novu DDR4 memoriju, omogućiće jedan od najbržih desktop sistema ikada. Novi i poboljšani Intel X99 čipset i snažne overclocking mogućnosti će entuzijastima dozvoliti da pripreme svoj sistem za maksimalne performanse.\r\n \r\nTri nova sistema će biti dostupna sledeće sedmice u rasponu od šest do osam jezgara i po cenama od 389 do 999 dolara. Ovi procesori su takođe bezkonfliktni.\r\n', '2014-09-01'),
('Luis Suarez''s appeal against bite ban rejected by Fifa', 'BBC', 'Suarez was also banned for nine international matches after the incident at the World Cup in Brazil.\r\nPlay media\r\nJump media playerMedia player helpOut of media player. Press enter to return or tab to continue.\r\nWatch: Fifa spokesperson Delia Fischer announces Suarez''s punishment\r\nThe Uruguayan FA had described Fifa''s ruling as an "excessive decision" for which "there was not enough evidence".\r\nSuarez can now make a further appeal to the Court of Arbitration for Sport. \r\nFootball''s global governing body also imposed a fine of 100,000 Swiss Francs (£65,000) on Suarez, who has apologised for his behaviour.\r\nUnder the terms of the suspension, Suarez cannot train with his club and is prohibited from entering the confines of any stadium, although players'' union Fifpro argue the details "lack clarity".\r\nShould Suarez and the Uruguayan FA decide to appeal further, ordinarily the Court of Arbitration for Sport (Cas) would sit and hear the matter while the player adheres to the terms of his ban.\r\nHowever, as the World Cup is still ongoing, they could apply to the Cas ''ad-hoc'' division, which exists for the duration of the tournament to hear matters such as this.\r\nThe ad-hoc division could suspend the sanctions pending a full hearing later in the year, allowing Suarez to play and take part in "football related activities" in the meantime.\r\nLuis Suarez appears to bite Giorgio Chiellini\r\nIncluding this latest punishment, Suarez will have missed 32 games through four separate bans since arriving at Liverpool in 2011\r\nSince Suarez was suspended, Liverpool have been in transfer negotiations with Spanish giants Barcelona, who have told the Anfield club they are willing to meet a buy-out clause of £75m to sign the 27-year-old.\r\nThe Uruguayan has now been found guilty of biting three opponents in his career.\r\nSuarez was banned for 10 games for biting Chelsea''s Branislav Ivanovic during a Premier League match in 2013 and was also suspended for seven games for biting PSV Eindhoven''s Otman Bakkal while playing for Ajax in 2010.\r\nIncluding this latest punishment, Suarez will have missed 32 games through four separate bans since arriving at Liverpool in 2011.\r\nThe ban is the biggest in World Cup history, beating the eight games given to Italy''s Mauro Tassotti for elbowing Spain''s Luis Enrique in 1994', '2014-07-10'),
('Srpski kandidat za Oskara film "Montevideo, vidimo se"', 'Blic', 'Srpski kandidat za nagradu Oskar u kategoriji najbolji dugometražni igrani film na stranom jeziku u 2014. godini je "Montevideo, vidimo se" reditelja Dragana Bjelogrlića. To je danas odlučeno glasanjem članova Stručnog odbora Akademije filmske umetnosti i nauke Srbije, rekao je Tanjugu generalni sekretar te institucije Mirko Beoković.\r\n \r\n"Montevideo, vidimo se" dobio je devet glasova, a drugi kandidat - "Top je bio vreo" Slobodana Skerlića sedam glasova. Glasalo je ukupno 17 članova akademije a jedan glas je bio nevažeći', '2014-09-01');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `iznajmljivanje`
--
ALTER TABLE `iznajmljivanje`
  ADD CONSTRAINT `iznajmljivanje_ibfk_1` FOREIGN KEY (`id_knjige`) REFERENCES `knjige` (`id_knjige`) ON DELETE NO ACTION ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
