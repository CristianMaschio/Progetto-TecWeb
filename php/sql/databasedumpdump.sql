-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.5.31-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win32
-- HeidiSQL Version:             8.1.0.4545
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping database structure for biglietteria
CREATE DATABASE IF NOT EXISTS `biglietteria` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `biglietteria`;


-- Dumping structure for table biglietteria.biglietti
CREATE TABLE IF NOT EXISTS `biglietti` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `utente_id` int(11) NOT NULL DEFAULT '0',
  `spettacolo_id` int(11) NOT NULL DEFAULT '0',
  `codice` char(13) NOT NULL,
  `utilizzato` enum('si','no') NOT NULL DEFAULT 'no',
  PRIMARY KEY (`id`),
  UNIQUE KEY `codice` (`codice`),
  KEY `spettacolo_id_fk` (`spettacolo_id`),
  KEY `utente_id_fk` (`utente_id`),
  CONSTRAINT `spettacolo_id_fk` FOREIGN KEY (`spettacolo_id`) REFERENCES `spettacoli` (`id`) ON DELETE CASCADE,
  CONSTRAINT `utente_id_fk` FOREIGN KEY (`utente_id`) REFERENCES `utenti` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Dumping data for table biglietteria.biglietti: ~2 rows (approximately)
DELETE FROM `biglietti`;
/*!40000 ALTER TABLE `biglietti` DISABLE KEYS */;
INSERT INTO `biglietti` (`id`, `utente_id`, `spettacolo_id`, `codice`, `utilizzato`) VALUES
	(1, 1, 1, '5a13607c335ff', 'no'),
	(2, 4, 1, '5a1360bd111a7', 'no');
/*!40000 ALTER TABLE `biglietti` ENABLE KEYS */;


-- Dumping structure for table biglietteria.categorie
CREATE TABLE IF NOT EXISTS `categorie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` char(50) NOT NULL DEFAULT '0',
  `descrizione` longtext,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- Dumping data for table biglietteria.categorie: ~6 rows (approximately)
DELETE FROM `categorie`;
/*!40000 ALTER TABLE `categorie` DISABLE KEYS */;
INSERT INTO `categorie` (`id`, `nome`, `descrizione`) VALUES
	(1, 'Cinema', 'Proiezioni cinematografiche'),
	(2, 'Teatro', 'Spettacoli teatrali'),
	(3, 'Sport', 'Eventi sportivi'),
	(4, 'Musica', 'Concerti ed eventi musicali'),
	(5, 'Musei', 'Esposizioni di quadri e arte'),
	(6, 'Fiere', 'Fiere in centri fiere');
/*!40000 ALTER TABLE `categorie` ENABLE KEYS */;


-- Dumping structure for table biglietteria.eventi
CREATE TABLE IF NOT EXISTS `eventi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categoria_id` int(11) NOT NULL,
  `nome` char(50) NOT NULL DEFAULT '0',
  `descrizione` longtext,
  `durata` time DEFAULT '00:00:00',
  PRIMARY KEY (`id`),
  KEY `categoria_id_fk` (`categoria_id`),
  CONSTRAINT `categoria_id_fk` FOREIGN KEY (`categoria_id`) REFERENCES `categorie` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- Dumping data for table biglietteria.eventi: ~9 rows (approximately)
DELETE FROM `eventi`;
/*!40000 ALTER TABLE `eventi` DISABLE KEYS */;
INSERT INTO `eventi` (`id`, `categoria_id`, `nome`, `descrizione`, `durata`) VALUES
	(1, 1, 'Frozen', 'Celebre film prodotto dalla Disney che con atmosfere natalizie racconta della storia della principessa Elsa, dei suoi compagni e della loro avventura nel regno dei ghiacci.', '01:42:00'),
	(3, 6, 'Seridò', 'Seridò è una grande festa con stand attivi, aree gioco, spazi creativi, spettacoli ed attrazioni gratuite che coinvolgono i bambini e le loro famiglie. Seridò è un progetto realizzato da Adasm Fism Brescia e Centro Fiera del Garda di Montichiari.', '00:00:00'),
	(4, 6, 'Fiera della caccia e della pesca', 'Salone delle attività faunistiche, venatorie e della pesca.', '00:00:00'),
	(5, 3, 'Partita Juventus-Milan', 'Partita di champions League Juventus vs Milan.', '01:30:00'),
	(6, 5, 'Esposizione di Van Gogh', 'Esposizione di quadri del celebre pittore impressionista Van Gogh', '00:00:00'),
	(7, 2, 'Aida', 'Aida è una principessa etiope, catturata e fatta schiava dagli Egiziani. Ama, ricambiata, Radamès, un comandante dell’esercito, che è a sua volta amato, ma invano, dalla figlia del faraone, la principessa  Amneris. L\'opera tratta della loro drammatica storia.', '03:20:00'),
	(8, 4, 'Concerto Madonna', 'Concerto musica della famosa cantante pop Madonna.', '03:15:00'),
	(9, 1, 'Iron man 3', 'Terzo film della saga di Iron Man prodotta dalla Marvel. Questa volta Tony Stark si scontrerà con le sue stesse armature.', '01:55:00'),
	(11, 4, 'Gigi d\'Alessio tour', 'Tuor con varie tappe italiane di Gigi d\'Alessio che presenterà il suo nuovo disco.', '03:00:00');
/*!40000 ALTER TABLE `eventi` ENABLE KEYS */;


-- Dumping structure for table biglietteria.luoghi
CREATE TABLE IF NOT EXISTS `luoghi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` char(50) NOT NULL,
  `indirizzo` longtext,
  `telefono` char(40) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- Dumping data for table biglietteria.luoghi: ~7 rows (approximately)
DELETE FROM `luoghi`;
/*!40000 ALTER TABLE `luoghi` DISABLE KEYS */;
INSERT INTO `luoghi` (`id`, `nome`, `indirizzo`, `telefono`) VALUES
	(1, 'Multisala King', 'SS567, 25017 Provincia di Brescia1', '030 991 3670'),
	(2, 'Arena di Verona', 'Piazza Brà, 1, 37121 Verona (VR)', '045 800 5151'),
	(3, 'Juventus Stadium', 'Corso Gaetano Scirea, 50, Torino (TO)', '899 999 897'),
	(5, 'Centro fiere Montichiari', 'Via Brescia, 129 - 25018 Montichiari (BS)', '030 961148'),
	(6, 'Multisala OZ', 'Via Sorbanella, 12, 25125 Brescia (BS)', ' 899 678903'),
	(7, 'Museo Santa Giulia', 'Via dei Musei, 81/b, 25121 Provincia di Brescia', '030 297 7834'),
	(8, 'Piazza Loggia', 'Piazza della Loggia, 25121 Brescia (BS)', '030 29771');
/*!40000 ALTER TABLE `luoghi` ENABLE KEYS */;


-- Dumping structure for table biglietteria.spettacoli
CREATE TABLE IF NOT EXISTS `spettacoli` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `evento_id` int(11) NOT NULL DEFAULT '0',
  `luogo_id` int(11) NOT NULL DEFAULT '0',
  `data_ora` datetime NOT NULL,
  `posti_disponibili` bigint(20) NOT NULL DEFAULT '0',
  `prezzo` decimal(7,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id`),
  KEY `evento_id_fk` (`evento_id`),
  KEY `luogo_id_fk` (`luogo_id`),
  CONSTRAINT `evento_id_fk` FOREIGN KEY (`evento_id`) REFERENCES `eventi` (`id`) ON DELETE CASCADE,
  CONSTRAINT `luogo_id_fk` FOREIGN KEY (`luogo_id`) REFERENCES `luoghi` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Dumping data for table biglietteria.spettacoli: ~1 rows (approximately)
DELETE FROM `spettacoli`;
/*!40000 ALTER TABLE `spettacoli` DISABLE KEYS */;
INSERT INTO `spettacoli` (`id`, `evento_id`, `luogo_id`, `data_ora`, `posti_disponibili`, `prezzo`) VALUES
	(1, 1, 6, '2017-11-29 11:11:00', 418, 7.40);
/*!40000 ALTER TABLE `spettacoli` ENABLE KEYS */;


-- Dumping structure for table biglietteria.utenti
CREATE TABLE IF NOT EXISTS `utenti` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` char(50) NOT NULL,
  `luogo_id` int(11) DEFAULT NULL,
  `pass` char(50) NOT NULL,
  `nome` char(50) NOT NULL,
  `cognome` char(50) NOT NULL,
  `email` char(50) NOT NULL,
  `tipo` enum('U','O','A','L') NOT NULL DEFAULT 'U',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  KEY `fk_id_luogo` (`luogo_id`),
  CONSTRAINT `fk_id_luogo` FOREIGN KEY (`luogo_id`) REFERENCES `luoghi` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- Dumping data for table biglietteria.utenti: ~13 rows (approximately)
DELETE FROM `utenti`;
/*!40000 ALTER TABLE `utenti` DISABLE KEYS */;
INSERT INTO `utenti` (`id`, `username`, `luogo_id`, `pass`, `nome`, `cognome`, `email`, `tipo`) VALUES
	(1, 'admin', NULL, '*4ACFE3202A5FF5CF467898FC58AAB1D615029441', 'Amministratore', 'Utente1', 'admin@admin.it', 'A'),
	(3, 'operatore', NULL, '*8EAB1F519FB24E2D4E796F2E6A9E0DB306701778', 'Francesco', 'Parolini', 'freppo96@gmail.com', 'O'),
	(4, 'user', NULL, '*D5D9F81F5542DE067FFF5FF7A4CA4BDD322C578F', 'ciao', 'Gualtieri', 'gualtio@endri.it', 'U'),
	(5, 'freppo', NULL, '*7E983E1D5E5BFD4849CEE53BE2861447A06A74C1', 'Francesco', 'Parolini', 'freppo96@gmail.com', 'U'),
	(6, 'freppo1', NULL, '*E6CC90B878B948C35E92B003C792C46C58C4AF40', '1', '1', '1@1', 'U'),
	(7, 'freppo2', NULL, '*12033B78389744F3F39AC4CE4CCFCAD6960D8EA0', '2', '2', 'freppo@2', 'U'),
	(9, 'multisalaking', 1, '*0117407580D33D1A7DF1B4859EE7B1BF7AF14690', 'multi', 'sala', 'king@king.it', 'L'),
	(10, 'piazzaloggia', 8, '*42D4CBCB1ADBE3325BEDAAF8140FB2CC4C16905D', 'piazza', 'loggia', 'piazza@loggia.it', 'L'),
	(11, 'user2', NULL, '*12A20BE57AF67CBF230D55FD33FBAF5230CFDBC4', 'Andrea', 'Gualtieri', 'andri@gualty.it', 'U'),
	(12, 'mamma', NULL, '*33852BD37ED6B7EC4A767CF4ED9CB64F00989F75', 'Cristina', 'Maraviglia', 'wewewew@wewewee.it', 'U'),
	(13, 'paulio', NULL, '*0F6188E353012D1D828CFA87047085E28AF17DD1', 'paulio', 'ekerlo', 'lil@peccher.i$', 'A'),
	(14, 'ugo', NULL, '*A444649B9F4387691F2CC67135BFC05CA573CEE2', 'Ugo', 'Ughi', 'ugp@ugo.it', 'U'),
	(15, 'gigi', NULL, '*431AB8EB0EEA6C3A23BD019F42485CBD770FE273', 'Gigi', 'de Gigi', 'gigi@gigi.it', 'U');
/*!40000 ALTER TABLE `utenti` ENABLE KEYS */;


-- Dumping structure for trigger biglietteria.decrementa_posti
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `decrementa_posti` AFTER INSERT ON `biglietti` FOR EACH ROW UPDATE spettacoli
	SET spettacoli.posti_disponibili = spettacoli.posti_disponibili-1
	WHERE spettacoli.id = NEW.spettacolo_id//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
