-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 02, 2015 at 08:17 PM
-- Server version: 5.6.14
-- PHP Version: 5.5.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `gknow`
--

-- --------------------------------------------------------

--
-- Table structure for table `answered`
--

CREATE TABLE IF NOT EXISTS `answered` (
  `Phone_Number` varchar(50) NOT NULL,
  `Question_Number` int(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`Phone_Number`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `answered`
--

INSERT INTO `answered` (`Phone_Number`, `Question_Number`) VALUES
('tel:94771122336', 2),
('tel:94771122340', 6);

-- --------------------------------------------------------

--
-- Table structure for table `checkuser`
--

CREATE TABLE IF NOT EXISTS `checkuser` (
  `sessionsid` varchar(100) NOT NULL,
  `getuser` int(4) NOT NULL,
  `enterpoints` int(4) NOT NULL,
  PRIMARY KEY (`sessionsid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `checkuser`
--

INSERT INTO `checkuser` (`sessionsid`, `getuser`, `enterpoints`) VALUES
('1', 1, 1),
('2', 1, 1),
('3', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

CREATE TABLE IF NOT EXISTS `question` (
  `Q_no` int(4) NOT NULL AUTO_INCREMENT,
  `Question` varchar(1000) NOT NULL,
  `Difficulty` int(3) NOT NULL,
  `Ans_1` varchar(20) NOT NULL,
  `Ans_2` varchar(20) NOT NULL,
  `Ans_3` varchar(20) NOT NULL,
  `Ans_4` varchar(20) NOT NULL,
  `Correct_Ans` int(1) NOT NULL,
  PRIMARY KEY (`Q_no`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=34 ;

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`Q_no`, `Question`, `Difficulty`, `Ans_1`, `Ans_2`, `Ans_3`, `Ans_4`, `Correct_Ans`) VALUES
(1, 'Wanduran 6 denekta kesel gedi 6k kaamata windi 6k yay.. wanduran 4 denekta kesel gedi 4k kaamata yana kalaya winadi keeyada?', 100, '3', '2', '4', '6', 4),
(2, 'Minsun 6 denek ekinekata 1 wara bagin athata atha dei. Athata atha deem keeyak sudu weida?', 100, '15', '36', '6', '18', 1),
(3, 'mata duuwaru 3n denek sitina athara thidenatama 1 sohoyura bagin sitiy. Mata sitina daruwan ganana kiyada?', 100, '6', '5', '4', '3', 3),
(4, '1th 1000th athara sankya wala wadipurama yedena ilakkama kumakda? (1 th 1000th athuluwa)', 200, '0', '1', '2', '3', 2),
(5, '1 = 5 da 2 =25 da 3 = 325 da 4 = 4325 da nam 5 = ? keeyada?', 100, '14325', '54325', '1', '654325', 3),
(6, 'Sri Lankawa janarajayak bawata path uwe kinam warshayeda?', 100, '1815', '1948', '1972', '1978', 3),
(7, 'Nimal ohuge sahodariyata wada 10kg barin wadiya. me dedenagema bara wala ekathuwa 110kg we. Sahodariyage bara keeyada?', 100, '60 kg', '50 kg', '55 kg', '65 kg', 2),
(8, 'waduwek 29" * 29" thahaduwaka daraya wate ana gasay.. thahaduwe ek daarayak dige sama durin ana 30k gasay nam awashya mulu ana ganana keeyada??', 100, '841', '119', '120', '116', 4),
(9, 'ekthara kaaryakata minisun 5 denekta dina 28k yana bawa arambayedi pawaseeya.. dina 10k gatha wu wita meme kaaryata kirimata thawa minisun 10k yedaweeya.. thawa dina keeyak karyata gatha weda?', 200, '18', '10', '6', '5', 3),
(10, 'Sri Lankawe prathama rajadhaniya kumakda?', 100, 'Anuradhapura', 'Polonnaruwa', 'Mahanuwara', 'Gampola', 1),
(11, 'golubellek diwa kalayedi biththiyak dige adi 4k ihalata nagi. Raathiriyedi adi 2k lissa wate. adi 30k biththiyak nageemata golubellata dina keeyak gatha weda?', 200, '14', '15', '13', '16', 1),
(12, 'ma langa pabalu sankyawa asamana kotas 2 kata bedanu labai. mewita labena pabalu sankyawal 2hi wenawa 35n guna kala wita labena agaya sankya 2 hi warga wala wenasata samanaya. ma gawa athi pabalu ganana keeyada?', 300, '35', '39', '30', '45', 1),
(13, 'mema sankya ratawe eelanga sankyawa kumakda??? 8723, 3872, 2387, ?', 200, '7283', '3827', '8372', '7238', 4),
(14, 'wilaka hitawa athi kanuwaka 1/2k polowa thulada, 1/3k jalayeda thibe. mathupita athi kotase diga adi 10k nam kanuwe mulu diga keeyada?', 200, '40', '50', '60', '30', 3),
(15, 'sankya 2ka antharaya 9k da, gunithaya 13k da nam, sankya dekehi warga wala ekathuwa keeyada?', 300, '121', '107', '56', '75', 2),
(16, '2+3 =95 da 4+5 = 259 da 6+7 = 4913 da nam 8+9 = ? hi agaya keeyada?', 300, '8917', '10054', '8117', '9451', 3),
(17, 'samanta payakadi chocolate 27k kai, amali winadi 10 kadi chocolate 2k kai, Kamal winadi 20 kadi chocolate 7 k kai, me thidenata chocolate 120k kaamata kopamana welawak(winadi) yaida?  ', 200, '120', '240', '100', '60', 1),
(18, 'Sulu karanna 2^1234 - 2^1233', 200, '2', '2^1233', '2^1234', '4', 2),
(19, 'Sri Lankawe wishalathama distrikkaya kumakda?', 100, 'Colomba', 'Polonnaruwa', 'Anuradhapuraya', 'Monaragala', 3),
(20, 'ekdina lakunu 10,000 ta wada raskala lankawe palumu cricket kreedakaya kawda?', 100, 'Kumar Sangakkara', 'Mahela Jayawardana', 'Sanath Jayasooriya', 'Aravinda De Silva', 3),
(21, 'Kumari ge wayasa awrudu 16 ki. Eyage wayasa, Eyage mallige wayasa men hathara gunayak wadiya. Eyage wayasa, mallige wayasa men degunayak wana wita, Kumari ta wayasa awrudu keeyada ?', 200, '20', '24', '28', '32', 2),
(22, 'chess puwaruwaka samachathurasra keeyak thibeda?', 300, '64', '96', '204', '154', 3),
(23, 'Sri Lankawe sita Indiyawata athi ketima dura kumakda?', 100, '12 km', '22 km', '32 km', '42 km', 3),
(24, 'Prasanna 25 ta kamathiya, 24ta akamathiya. Ohu 400ta kamathiya, 300ta akamathiya. Prasanna 144ta kamathiya, namuth 145ta akamathiya. Ohu pahatha ewayin kumana ankayakata kamathi wanu athda ?', 200, '10', '50', '500', '900', 4),
(25, 'mema shreniye meelang sankyawa kumakda?  1, 4, 8, 13, ?', 300, '19', '20', '21', '22', 1),
(26, 'Kumari, Samange mawa we. Sarath, Samange mawage paarshawayen siya we. Kumari, Sarathge kinam nadayekda?', 200, 'Maama', 'Samiya', 'Putha', 'Duwa', 4),
(27, '(2^x) (30^3) = (2^3) (3^3) (4^3) (5^3) , mehi x hi agaya soyanna..', 200, '6', '1240', '256', '10', 1),
(28, 'Sri Lankawe 4 wana widhayaka janadhipathi kawrunda?', 100, 'R. Premadasa', 'J. R. Jayawardana', 'Chandrika Bandaranay', ' Mahinda Rajapaksha', 3),
(29, 'lee walin sada sampurnayen sudu paha aalepa ganwu ghanakabayak thibe. mehi diga, palala ha usa 3" × 9" × 12" we. Meya  1" × 1" × 1" wana ghanaka 324 kata kapai. Ghanaka keeyaka ek paththaka ho sudu paha aalepa wee thibeda?', 300, '324', '254', '234', '342', 2),
(30, 'dalaka makuluwan ha massan ekathuwa 19ki. unge kakul ganana ganan kala eita 128k wiya. mehi makuluwan ganana keeyada?', 200, '12', '7', '19', '10', 2),
(31, 'Ekthara rataka bhaitha wana aakarayata 5n 1/2k 3ki.. mema rate bhawitha wana aakarayata 10 n 1/3k keeyada?', 300, '3.33', '10', '6', '4', 4),
(32, 'Lokaye prathama agamathiwariya kawda? ', 100, ' Margaret Thatcher', 'Condoliza Rise', 'Sirimavo Bandaranaya', 'Sonia Gandhi', 3),
(33, 'Tenis Tharangawaliyak knock out kramayata pawathwai.. Tharangawaliya nima weddi tharanga 15k pawath wuni nam kreedakayan kee denek tharangawaliyata sahabhagi weeda?', 200, ' 30', '15', '16', '20', 3);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE IF NOT EXISTS `sessions` (
  `sessionsid` varchar(100) NOT NULL,
  `tel` varchar(50) DEFAULT NULL,
  `menu` varchar(50) DEFAULT NULL,
  `pg` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `others` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`sessionsid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Handle the sessions';

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`sessionsid`, `tel`, `menu`, `pg`, `created_at`, `others`) VALUES
('1', 'tel:94771122336', 'selection', '0', '0000-00-00 00:00:00', ''),
('2', 'tel:94771122340', 'selection', '0', '0000-00-00 00:00:00', ''),
('3', 'tel:94771122340', 'answers', '0', '0000-00-00 00:00:00', '');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `PhoneNo` varchar(50) NOT NULL,
  `Name` varchar(25) NOT NULL,
  `Points` int(5) NOT NULL DEFAULT '0',
  PRIMARY KEY (`PhoneNo`),
  UNIQUE KEY `Name` (`Name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`PhoneNo`, `Name`, `Points`) VALUES
('tel:94771122336', 'thari', 300),
('tel:94771122340', 'janthu', 375);

--
-- Triggers `user`
--
DROP TRIGGER IF EXISTS `Add_To_Answered`;
DELIMITER //
CREATE TRIGGER `Add_To_Answered` AFTER INSERT ON `user`
 FOR EACH ROW BEGIN
INSERT INTO answered(Phone_Number) values (NEW.PhoneNo);
END
//
DELIMITER ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
