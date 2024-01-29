-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 29, 2024 at 10:42 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `worknet`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbladmin`
--

CREATE TABLE `tbladmin` (
  `ID` int(10) NOT NULL,
  `AdminName` varchar(200) DEFAULT NULL,
  `UserName` varchar(200) DEFAULT NULL,
  `MobileNumber` bigint(10) DEFAULT NULL,
  `Email` varchar(200) DEFAULT NULL,
  `Password` varchar(200) DEFAULT NULL,
  `AdminRegdate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbladmin`
--

INSERT INTO `tbladmin` (`ID`, `AdminName`, `UserName`, `MobileNumber`, `Email`, `Password`, `AdminRegdate`) VALUES
(1, 'Admin', 'admin', 7987979878, 'admin@gmail.com', 'f925916e2754e5e03f75dd58a5733251', '2024-01-26 18:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `tblapplyjob`
--

CREATE TABLE `tblapplyjob` (
  `ID` int(10) NOT NULL,
  `UserId` int(5) DEFAULT NULL,
  `JobId` int(5) DEFAULT NULL,
  `Applydate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Status` varchar(200) DEFAULT NULL,
  `ResponseDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblapplyjob`
--

INSERT INTO `tblapplyjob` (`ID`, `UserId`, `JobId`, `Applydate`, `Status`, `ResponseDate`) VALUES
(2, 1, 7, '2024-01-26 15:12:33', NULL, NULL),
(3, 1, 2, '2024-01-26 15:19:14', 'Rejected', '2024-01-26 15:19:14'),
(4, 4, 9, '2024-01-28 16:42:43', NULL, NULL),
(5, 2, 14, '2024-01-28 19:21:08', 'Hired', '2024-01-28 19:21:08'),
(6, 2, 9, '2024-01-28 19:03:06', NULL, NULL),
(7, 3, 9, '2024-01-28 19:22:16', NULL, NULL),
(8, 3, 14, '2024-01-28 19:22:26', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblcategory`
--

CREATE TABLE `tblcategory` (
  `id` int(11) NOT NULL,
  `CategoryName` varchar(200) NOT NULL,
  `Description` mediumtext NOT NULL,
  `PostingDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL,
  `Is_Active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblcategory`
--

INSERT INTO `tblcategory` (`id`, `CategoryName`, `Description`, `PostingDate`, `UpdationDate`, `Is_Active`) VALUES
(1, 'HR', 'Human Resource', '2023-02-25 10:54:19', NULL, 0),
(2, 'Product Manager', 'Product Manager', '2023-02-25 10:54:42', NULL, 0),
(3, 'IT', 'Information Technology', '2023-02-25 10:55:08', NULL, 0),
(4, 'Operations', 'Operations', '2023-02-25 10:55:31', NULL, 0),
(5, 'Digital Marketing', 'Digital Marketing', '2023-02-25 10:55:47', NULL, 0),
(6, 'Shitese', 'Puntore ne kompani shitese', '2024-01-28 19:10:51', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbleducation`
--

CREATE TABLE `tbleducation` (
  `ID` int(10) NOT NULL,
  `UserID` int(5) DEFAULT NULL,
  `Qualification` varchar(200) DEFAULT NULL,
  `ClgorschName` varchar(200) DEFAULT NULL,
  `PassingYear` varchar(200) DEFAULT NULL,
  `Stream` varchar(200) DEFAULT NULL,
  `CGPA` decimal(2,0) DEFAULT NULL,
  `Percentage` decimal(4,0) DEFAULT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbleducation`
--

INSERT INTO `tbleducation` (`ID`, `UserID`, `Qualification`, `ClgorschName`, `PassingYear`, `Stream`, `CGPA`, `Percentage`, `CreationDate`) VALUES
(4, 2, 'Graduation', 'UBT', '2023', 'Software Enginnering', '8', '100', '2024-01-28 19:06:42');

-- --------------------------------------------------------

--
-- Table structure for table `tblemployers`
--

CREATE TABLE `tblemployers` (
  `id` int(11) NOT NULL,
  `ConcernPerson` varchar(150) DEFAULT NULL,
  `EmpEmail` varchar(250) DEFAULT NULL,
  `EmpPassword` varchar(250) DEFAULT NULL,
  `CompnayName` varchar(255) DEFAULT NULL,
  `CompanyTagline` mediumtext DEFAULT NULL,
  `CompnayDescription` mediumtext DEFAULT NULL,
  `CompanyUrl` varchar(255) DEFAULT NULL,
  `CompnayLogo` varchar(200) DEFAULT NULL,
  `noOfEmployee` char(10) DEFAULT NULL,
  `industry` varchar(255) DEFAULT NULL,
  `typeBusinessEntity` varchar(255) DEFAULT NULL,
  `lcation` varchar(255) DEFAULT NULL,
  `establishedIn` char(200) DEFAULT NULL,
  `RegDtae` timestamp NULL DEFAULT current_timestamp(),
  `LastUpdationDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Is_Active` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblemployers`
--

INSERT INTO `tblemployers` (`id`, `ConcernPerson`, `EmpEmail`, `EmpPassword`, `CompnayName`, `CompanyTagline`, `CompnayDescription`, `CompanyUrl`, `CompnayLogo`, `noOfEmployee`, `industry`, `typeBusinessEntity`, `lcation`, `establishedIn`, `RegDtae`, `LastUpdationDate`, `Is_Active`) VALUES
(4, 'Korab Shaqiri', 'aztech@aztech.com', '$2y$12$tLTeIp1kTD/NToFYgv6DrOiHQv/JI4vL6cP.suulTafz4aIkVakV.', 'Aztech', 'Mirë se vini në vendin e Teknologjisë', 'Mire se vini ne AZTECH, nje kompani e dalluar me nje rrjet te gjere te dyqaneve teknologjike te vendosura ne gjithe territorin e Kosoves. Kompania jone ofron nje game te larmishme produktesh, duke perfshire pajisje te teknologjise se informacionit, pajisje shtepiake, pajisje elektronike, produkte te bardha dhe pajisje per kujdesin personal.', 'https://aztechonline.com/', 'aztechlogo.png', '212257705', 'Shitje', 'Sole Proprietorship', 'Kosove', '2014', '2024-01-28 16:01:11', '2024-01-29 09:18:27', 1),
(5, 'Gjirafa', 'gjirafa@gjirafa.com', '$2y$12$uqhFhua5IV6XySq8AhFEPezW5pKAT1G5Gui5CQKTwiiFz9m4Oz8zy', 'Gjirafa', 'Ne sherbimin tuaj', 'Gjirafa eshte nje nga kompanite e teknologjise me rritjen me te shpejte ne Evropen Qendrore dhe eshte ndertuar per te qendruar. Ne jemi te perqendruar te klientet, te orientuar drejt rezultateve dhe kemi standarde te larta te pameshirshme. Misioni yne perfundimtar eshte te ndertojme ekonomine e internetit ne rajonin e CE.\r\n\r\nEkosistemi i sherbimeve te Gjirafes perfshin tregtine elektronike, transmetimin e videove, marketingun ne internet, kompjuterin cloud dhe prodhimin e argetimit.\r\nNe Gjirafa, ne jemi te pakompromis kur behet fjale per cilesine, efikasitetin, besueshmerine dhe perballueshmerine. Ne jemi thellesisht entuziaste per te permbushur pritshmerite e klienteve tane dhe per te ofruar pervoja terheqese per ta.\r\nPlatforma kryesore e portalit Gjirafa, perfshin kerkimin, kerkimin vertikal, njoftimet, lajmet dhe orarin e autobuseve.\r\n', 'https://gjirafa.com/', 'gjirafalogo.jpg', '212258765', 'Shitje', 'Sole Proprietorship', 'Prishtine, Kosove', '2010', '2024-01-28 16:10:41', '2024-01-29 09:19:09', 1),
(6, 'StarLabs', 'starlabs@starlabs.com', '$2y$12$2HNN2U5E0/TZvPH.BZVEr.qAm3XZZ4cLTa/oA8gRZpcGFGGvptvli', 'starlabs', 'Developing the future', 'Ne ndertojme ekipet tuaja te dedikuara ne distance!\r\nKjo do te thote, ekipet tona jane ndertuar ne baze te kerkeses suaj dhe jane te dedikuara vetem per nevojat tuaja. Individet e kualifikuar punesohen, trajnohen dhe menaxhohen gjate gjithe operacioneve, ndersa sigurohen qe detyrat te kryhen ne kohe dhe me cilesi te larte.\r\n', 'https://www.starlabs.dev/', 'stralabslogo.jpg', '212256324', 'Sherbyese', 'Partnership', 'Prishtine, Prizren', '2018', '2024-01-28 16:49:16', '2024-01-29 09:20:32', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblexperience`
--

CREATE TABLE `tblexperience` (
  `ID` int(10) NOT NULL,
  `UserID` int(10) DEFAULT NULL,
  `EmployerName` varchar(200) DEFAULT NULL,
  `EmployementType` varchar(200) DEFAULT NULL,
  `Designation` varchar(200) DEFAULT NULL,
  `Ctc` decimal(10,0) DEFAULT NULL,
  `FromDate` varchar(200) DEFAULT NULL,
  `ToDate` varchar(200) DEFAULT NULL,
  `Skills` varchar(200) NOT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblexperience`
--

INSERT INTO `tblexperience` (`ID`, `UserID`, `EmployerName`, `EmployementType`, `Designation`, `Ctc`, `FromDate`, `ToDate`, `Skills`, `CreationDate`) VALUES
(2, 2, 'Vivafresh', 'Shites', 'sektoriste', '280', '2020-02-02', '2021-02-22', '', '2024-01-28 19:05:59'),
(3, 2, 'Peqani N.N.SH', 'Hidraulik, Elektriciste', 'Ndihmes- mjeshter', '550', '2022-01-08', '2023-01-03', '', '2024-01-28 19:08:37');

-- --------------------------------------------------------

--
-- Table structure for table `tbljobs`
--

CREATE TABLE `tbljobs` (
  `jobId` int(11) NOT NULL,
  `employerId` int(11) NOT NULL,
  `jobCategory` varchar(255) DEFAULT NULL,
  `jobTitle` varchar(255) DEFAULT NULL,
  `jobType` varchar(255) DEFAULT NULL,
  `salaryPackage` char(200) DEFAULT NULL,
  `skillsRequired` varchar(255) DEFAULT NULL,
  `experience` varchar(50) DEFAULT NULL,
  `jobLocation` varchar(255) DEFAULT NULL,
  `jobDescription` mediumtext DEFAULT NULL,
  `JobExpdate` date DEFAULT NULL,
  `postinDate` timestamp NULL DEFAULT current_timestamp(),
  `updationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `isActive` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbljobs`
--

INSERT INTO `tbljobs` (`jobId`, `employerId`, `jobCategory`, `jobTitle`, `jobType`, `salaryPackage`, `skillsRequired`, `experience`, `jobLocation`, `jobDescription`, `JobExpdate`, `postinDate`, `updationDate`, `isActive`) VALUES
(8, 5, 'Digital Marketing', 'Specialist i Medias Sociale', 'Full Time', '800', 'Komunikimi ,Analiza dhe Interpretimi i Të Dhënave, Njohuri të Motorëve të Kërkimit, Përdorimi i Mjeteve të Email Marketingut (SEO), Kreativitet dhe Krijueshmëri, Menaxhimi i Platformave Sociale,', '1-2', 'Prishtine', 'Jemi duke kerkuar nje Specialiste te medias sociale , i cili eshte i gatshem te punoj me ne , duke plotesuar kushtet e cekura', '2024-02-15', '2024-01-28 16:19:57', NULL, 1),
(9, 5, 'IT', 'Full Stack Developer', 'Full Time', '1800-2200', 'JAVA, Windows, PHP, Sql , Oracle', '3-5', 'Prishtine', 'Ne jemi duke shikuar per nje zhvillues Full Stack , i cili do te pershtatet me kompanin tone.', '2024-02-25', '2024-01-28 16:25:16', NULL, 1),
(10, 5, 'HR', 'HR Menaxher', 'Full Time', '1500', 'Menaxhimi i Njerëzve, Menaxhimi i Marrëdhënieve me Punonjësit, Aftësi Analitike dhe Vendimmarrje, Përdorimi i Teknologjisë dhe Mjeteve të HR, Siguria dhe Integriteti', '2-5', 'Prishtine', 'Po kerkojme nje Menaxher te burimeve njerezore , i cili ka aftesite e kerkuar me  larte dhe eshte i gatshem te punoj per ne.', '2024-03-25', '2024-01-28 16:33:33', NULL, 1),
(11, 5, 'Operations', 'Operations Manager', 'Full Time', '1200-1500', 'Aftësi të shquara organizative dhe menaxheriale. Njohuri të thelluara të proceseve operative dhe procedurave të biznesit. Aftësi për të menaxhuar efikasitetin dhe performancën e përgjithshme të operacioneve. Njohuri të përdorshme të mjeteve dhe teknologji', '5 +', 'Prishtine', 'Po shikojm per nje menaxher te operimeve , qe i ploteson keto kushte:Planifikimi, organizimi dhe monitorimi i të gjitha proceseve operative.\r\nZhvillimi dhe implementimi i politikave dhe procedurave operative.\r\nMenaxhimi i ekipit të operacioneve dhe sigurimi i një bashkëpunimi efikas mes tyre.\r\nOptimalizimi i performancës operative dhe identifikimi i mundësive për përmirësime.\r\nKoordinimi i lidhjeve me departamentet tjera për të siguruar një bashkëpunim të ngushtë dhe efikas.\r\nMonitorimi i burimeve dhe inventarit për të siguruar që operacionet të funksionojnë pa pengesa.\r\nZbatim i praktikave të sigurisë dhe rregullave të përgjithshme të punës.', '2024-03-01', '2024-01-28 16:39:15', NULL, 1),
(12, 6, 'Product Manager', 'Product Manager', 'Full Time', '1000-1500', 'Analize strategjike, Zhvillues i produktit, analize e marketit, powepoint', '2-4', 'Prizren', 'Roli i një  menaxherin e produktit në përmirësimin e fushatave të marketingut të një produkti ekzistues ose në zhvillimin e produkteve të reja të përshtatshme për kompaninë. Ata punojnë nën mbikëqyrjen e një menaxheri produkti, duke krijuar strategji marketingu për një produkt specifik në treg. Ndihmës menaxherët e produkteve janë përgjegjës për krijimin e politikave të marketingut të një kompanie.\r\nDisa nga detyrat themelore të një ndihmës menaxheri produkti përfshijnë detyrat e monitorimit të përfshira në marketing, shitje dhe prodhim; mbështetja e menaxherit të produktit në vendimmarrje dhe sigurimi që cilësia dhe pikat e forta të produktit të mos cenohen. Ndihmës menaxherët e produkteve janë ata që zhvillojnë strategji për të promovuar një produkt; ndihmë në identifikimin e audiencës së synuar të një produkti; dhe kontrolloni efikasitetin e strategjive të zbatuara të zhvillimit të produktit dhe marketingut. Ata gjithashtu mbikëqyrin prodhimin, shpërndarjen dhe inventarin e një produkti dhe analizojnë të gjitha aspektet e marketingut dhe prodhimit, siç janë analizimi i konkurrentëve dhe raportet statistikore.', '2024-02-28', '2024-01-28 16:56:37', NULL, 1),
(13, 6, 'IT', 'BackEnd Developer', 'Part Time', '500-800', 'Php, Java , nodeJS, javaScript, react', '1', 'Prizren', 'Kerkomje nje zhvillues te frontend i cili njeh mire gjuhet programuese: PHP, Java, nodejs , javascript dhe react , gjithashtu duhet te jete pozitiv per pune .', '2024-02-12', '2024-01-28 18:43:45', '2024-01-28 18:44:31', 1),
(14, 6, 'IT', 'FrontEnd Developer', 'Freelance', '400-600', 'CSS , Laravel, Bootsrap , any framework', '1', 'Prishtine', 'Kekojme zhvillues per pjesen frontend te aplikacioneve, i cili duhet ti njoh pergjithesisht disa gjuhe si :css me framework e tij , dhe do te punoj me gjysme-orari.', '2024-02-18', '2024-01-28 18:48:10', '2024-01-29 08:27:05', 1),
(15, 4, 'Digital Marketing', 'Specialist i Analizave tï¿½ Medias Sociale', 'Half Time', '800', 'Mendimi kritik, Aalize, Perfundim i sakte', '2', 'Prishtine', 'Analizon dhe interpreton tï¿½ dhï¿½nat e medias sociale pï¿½r tï¿½ kuptuar performancï¿½n dhe pï¿½r tï¿½ sjellï¿½ pï¿½rmirï¿½sime.\r\nHarton raporte pï¿½r tï¿½ identifikuar tendencat dhe mundï¿½sitï¿½ e reja.', '2024-10-03', '2024-01-28 18:54:21', '2024-01-29 08:31:03', 1),
(16, 4, 'Digital Marketing', 'Specialist i Shitjeve ', 'Full Time', '800', 'Analize dhe interpretim i te dhenave, Njohuri e tregut, Aftesi komunikuese, pergatitje dhe analize e raporteve', '3+', 'Prishtine', 'Po shikojme per specialiste te shitjeve qe fokusohet në shitjen e produkteve ose shërbimeve të teknologjisë.\r\nInterviston dhe lidhet me klientët, prezanton ofertat dhe zhvillon mundësitë e reja biznesi.', '2024-03-20', '2024-01-28 19:00:00', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbljobseekers`
--

CREATE TABLE `tbljobseekers` (
  `id` int(11) NOT NULL,
  `FullName` varchar(150) DEFAULT NULL,
  `EmailId` varchar(150) DEFAULT NULL,
  `ContactNumber` bigint(15) DEFAULT NULL,
  `Password` varchar(150) DEFAULT NULL,
  `Resume` varchar(150) DEFAULT NULL,
  `AboutMe` mediumtext DEFAULT NULL,
  `ProfilePic` varchar(200) DEFAULT NULL,
  `Skills` varchar(200) DEFAULT NULL,
  `RegDate` timestamp NULL DEFAULT current_timestamp(),
  `LastUpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `IsActive` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbljobseekers`
--

INSERT INTO `tbljobseekers` (`id`, `FullName`, `EmailId`, `ContactNumber`, `Password`, `Resume`, `AboutMe`, `ProfilePic`, `Skills`, `RegDate`, `LastUpdationDate`, `IsActive`) VALUES
(2, 'Driton', 'driton@gmail.com', 49826096, '$2a$10$plprolXP8OzL.B0pvln9UeFLwE.pO2jwZB0C5WIOdQ7.xSm6NKIku', '3ff4c2b487c4a934aad3b1781bfec2791706457008docx', NULL, NULL, NULL, '2024-01-28 15:50:08', NULL, 1),
(3, 'flamur', 'flamur@gmail.com', 69837242, '$2y$12$QmZDw4a6QzCLmhTeUCVVnOmRsFPDdb30k38YLWqUpE6mU5TpbNR76', '3ff4c2b487c4a934aad3b1781bfec2791706457089docx', NULL, NULL, NULL, '2024-01-28 15:51:29', NULL, 1),
(4, 'Dea', 'dea@hotmail.com', 12345645, '$2y$12$VOKcWwZr4h3ui3ScHSZOMuQDFvGz0Lp4ItJ9q6cPxNrbe2XCQYRMS', '3ff4c2b487c4a934aad3b1781bfec2791706457169docx', NULL, NULL, NULL, '2024-01-28 15:52:49', NULL, 1),
(5, 'filan', 'filan@gmail.com', 43243445, '$2y$12$NG0dpZVK22sdbGMooYWJgeTe/Q54ka1pYGN85GNGKPauS8KE7A9C2', '3ff4c2b487c4a934aad3b1781bfec2791706469988docx', NULL, NULL, NULL, '2024-01-28 19:26:28', NULL, 1),
(6, 'Testing', 'Test@gmail.com', 38349111222, '$2y$12$NEX8LyvZRC/ehjYUxa/46eR4PyNZL9oeWqptEtFI2oHo6cdGv2POG', '7ed2a4fdad0748f653df6cf07bb715ff1706476269.pdf', NULL, NULL, NULL, '2024-01-28 21:11:09', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblmessage`
--

CREATE TABLE `tblmessage` (
  `ID` int(10) NOT NULL,
  `JobID` int(5) DEFAULT NULL,
  `UserID` int(5) DEFAULT NULL,
  `Message` mediumtext DEFAULT NULL,
  `Status` varchar(200) DEFAULT NULL,
  `ResponseDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblmessage`
--

INSERT INTO `tblmessage` (`ID`, `JobID`, `UserID`, `Message`, `Status`, `ResponseDate`) VALUES
(4, 14, 2, 'Ju deshirojme sukses ne pune!', 'Hired', '2024-01-28 19:21:08');

-- --------------------------------------------------------

--
-- Table structure for table `tblpages`
--

CREATE TABLE `tblpages` (
  `ID` int(11) NOT NULL,
  `PageType` varchar(200) DEFAULT NULL,
  `PageTitle` mediumtext DEFAULT NULL,
  `PageDescription` longtext DEFAULT NULL,
  `Email` varchar(200) NOT NULL,
  `MobileNumber` bigint(10) NOT NULL,
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblpages`
--

INSERT INTO `tblpages` (`ID`, `PageType`, `PageTitle`, `PageDescription`, `Email`, `MobileNumber`, `UpdationDate`) VALUES
(1, 'aboutus', 'Rreth Nesh', '<div class=\"iw-heading  style1 vc_custom_1511523196571 border-color-theme\" style=\"outline: none; box-sizing: border-box; margin-top: 0px; margin-right: auto; margin-left: auto;\" open=\"\" sans\";=\"\" font-size:=\"\" 13px;=\"\" width:=\"\" 670px;=\"\" margin-bottom:=\"\" 35px=\"\" !important;\"=\"\"><div class=\"iwh-description\" style=\"outline: none; box-sizing: border-box; line-height: 28px;\"><font color=\"#333333\"><span style=\"font-size: 16px;\">Qellimi i WorkNet eshte te transformoje menyren se si lidhemi me tregun e punes, duke ofruar nje platforme inovative dhe efikase per punekerkuesit dhe punedhenesit. Ne synojme te lehtesojme procesin e rekrutimit duke siguruar nje mjedis te sigurt dhe transparent per shpalljen dhe aplikimin e pozitave te lira. Me nje qellim te qarte per te mundesuar lidhjen e perdoruesve me mundesite e reja te karrieres, ne perdorim teknologjite me te fundit per te sjelle nje pervoje te perdoruesit te permiresuar dhe inovative. Qendrueshmeria, siguria e te dhenave, dhe permiresimi i perdorueshmerise jane thelbi i angazhimit tone, duke synuar te kontribuojme ne rritjen ekonomike dhe suksesin e individeve dhe bizneseve. Me nje vemendje te veqante ndaj nevojave te paleve te interesuara, ne shperblehemi nga arritjet e suksesshme te punekerkuesve dhe punedhenesve permes platformes sone. WorkNet eshte me shume se nje platforme e rekrutimit - eshte nje ure e lidhur qe krijon mundesi dhe lidhje qe ndertojne karrierat dhe formojne te ardhmen e punes.</span></font><br></div></div>', '2024-06-05 12:18:06', 0, '2024-01-29 09:17:29'),
(2, 'contactus', 'Kontakt', 'Brigada 123, Suhareke, Kosove', 'WorkNet@info.com', 38348500500, '2024-01-28 19:27:48');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbladmin`
--
ALTER TABLE `tbladmin`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblapplyjob`
--
ALTER TABLE `tblapplyjob`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblcategory`
--
ALTER TABLE `tblcategory`
  ADD PRIMARY KEY (`id`),
  ADD KEY `CategoryName` (`CategoryName`);

--
-- Indexes for table `tbleducation`
--
ALTER TABLE `tbleducation`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblemployers`
--
ALTER TABLE `tblemployers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblexperience`
--
ALTER TABLE `tblexperience`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `tbljobs`
--
ALTER TABLE `tbljobs`
  ADD PRIMARY KEY (`jobId`);

--
-- Indexes for table `tbljobseekers`
--
ALTER TABLE `tbljobseekers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `tblmessage`
--
ALTER TABLE `tblmessage`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblpages`
--
ALTER TABLE `tblpages`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbladmin`
--
ALTER TABLE `tbladmin`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tblapplyjob`
--
ALTER TABLE `tblapplyjob`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tblcategory`
--
ALTER TABLE `tblcategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbleducation`
--
ALTER TABLE `tbleducation`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tblemployers`
--
ALTER TABLE `tblemployers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tblexperience`
--
ALTER TABLE `tblexperience`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbljobs`
--
ALTER TABLE `tbljobs`
  MODIFY `jobId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tbljobseekers`
--
ALTER TABLE `tbljobseekers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tblmessage`
--
ALTER TABLE `tblmessage`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tblpages`
--
ALTER TABLE `tblpages`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
