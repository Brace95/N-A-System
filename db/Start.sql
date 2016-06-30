/* Login Data */

DROP TABLE `grant`;
DROP TABLE `manager`;
DROP TABLE `auth`;


CREATE TABLE `manager` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`username` varchar(255) NOT NULL,
	`password` varchar(255) NOT NULL,
	`salt` varchar(255) NOT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE `auth` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`name` varchar(255),
	PRIMARY KEY(`id`)
);

CREATE TABLE `grant` (
	`mid` int(11) NOT NULL,
	`pid` int(11) NOT NULL,
	PRIMARY KEY(`mid`),
	FOREIGN KEY (`mid`) REFERENCES `manager` (`id`),
	FOREIGN KEY (`pid`) REFERENCES `auth` (`id`)
);

/* Enter some data */
LOCK TABLES `manager` WRITE;

INSERT INTO `manager` VALUES 
	(1,'Brace','b09ae99d7ae1b78ebefdb692fe88f859a0a7c71a840ab38f1e45b444fea77f504812bdf0921789255927315b954d2c6f93f4636b5a151f7c0a96ccd7ff047614','969E3CE18AB68331A5A43AB16F626'),
	(2,'Jason','bf85869d8f0a12bf829568c8477f004a24d62b177a7d94093abb67269f7647caa68f88b66505fad33955dc8b0439f0b8d0dbaa919185a450f9f9218ce9f604d0','IIR424DZILVPKGB8U4FFWRZU7LMOE'),
	(3,'Jess','1a4e760d18cd8ef828dc2f797b0cf5b85309a0280c46d20a1e49812e06857f29b6e26d810bd350e5642a024705f3dc2c131852534662695c50f0f79023c7d58d','LVWPFPARF15W2P4IVNRSPI5XVSR20R3'),
	(4,'Jude','685f51b23513a60c5c0ddb963a4d1ce90d0ed8808c3ed3c75044f472e2dba1fc3d95a482c4e4186ccf1610fecc0d3fddf33727a995c4b7bdbfa259cf95e94b50','KWSLFXWNIYGPW0DJIHHI4MIUE8DSCNY');

UNLOCK TABLES;

LOCK TABLES `auth` WRITE;

INSERT INTO `auth` VALUES
	(1, 'admin'),
	(2, 'manager');

UNLOCK TABLES;

LOCK TABLES `grant` WRITE;

INSERT INTO `grant` VALUES
	(1, 1),
	(2, 2),
	(3, 1);

UNLOCK TABLES;

/* NA Data */

CREATE TABLE `crew` (
	`metime` int(11) NOT NULL,
	`firstname` varchar(255),
	`surname` varchar(255),
	PRIMARY KEY(`metime`)
);

/* Enter all crew */

LOCK TABLES `crew` WRITE;

INSERT INTO `crew` VALUES
	(1092312, 'Aaron', 'Cohen'),
	(1022151, 'Aaron', 'Warren'),
	(2253517, 'Abby', 'Maxwell'),
	(1055024, 'Alana', 'Dixon'),
	(2293710, 'Aleesha', 'Mcdougall'),
	(1895798, 'Aleyna', 'Taskiran'),
	(2016155, 'Alison', 'Sheehan'),
	(821171, 'Alysha', 'Kauhausen'),
	(2143670, 'Alyssa', 'Weston'),
	(2200085, 'Amanda', 'Abeyratne'),
	(43514, 'Amanda', 'Kruger-hancock'),
	(2317952, 'Amanda', 'Peiris'),
	(2293465, 'Andrew', 'Pereira'),
	(43510, 'Andy', 'Kazi'),
	(150789, 'Ashlee', 'Read'),
	(2308294, 'Atul', 'Mehta'),
	(1881186, 'Bailey', 'Clapton'),
	(2064008, 'Ben', 'Dallas'),
	(2090821, 'Ben', 'Drew'),
	(2243031, 'Bradley', 'Nicoll'),
	(557714, 'Brandon', 'Stenhouse'),
	(2211331, 'Breanna', 'Adams'),
	(2188594, 'Brianah', 'Smith'),
	(2302350, 'Brianna', 'Falzon'),
	(467656, 'Brittany', 'Read'),
	(1642830, 'Brodie', 'Cowburn'),
	(1749240, 'Brooke', 'Verveniotis'),
	(1797078, 'Callum', 'Johnson'),
	(43468, 'Candice', 'Caulcutt'),
	(1788811, 'Cassandra', 'Cain'),
	(432851, 'Chelsie', 'Selleck'),
	(1972295, 'Chloe', 'Freeman'),
	(1917162, 'Daniel', 'Barac'),
	(1150990, 'Daniel', 'Marshall'),
	(1926736, 'Daniel', 'Mehegan'),
	(2273493, 'Danielle', 'Devlin'),
	(2206968, 'Danielle', 'Dodos'),
	(2085541, 'Deborah', 'Doherty'),
	(1756166, 'Denholm', 'Waihua'),
	(1803524, 'Denzel', 'Herbert'),
	(861345, 'Dilushan', 'Sinnathamby'),
	(1945102, 'Dineth', 'Kateepearachchi'),
	(2210816, 'Dylan', 'Jones'),
	(1049553, 'Eden', 'Aspinall'),
	(1811284, 'Edeser', 'Iii Monserrate'),
	(83870, 'Elizabeth', 'Rickerby'),
	(2223161, 'Emily', 'Hughes'),
	(1980164, 'Emily', 'Pozman'),
	(1841801, 'Emma', 'Hill'),
	(943591, 'Emmanuel', 'Ilejay'),
	(2120370, 'Eseta', 'Faalau'),
	(1906551, 'Ethan', 'Roman'),
	(1481201, 'Farbod', 'Forouzan'),
	(2142538, 'Farhiyo', 'Ali'),
	(2212554, 'Gabrielle', 'Falzon'),
	(2141824, 'Gabrielle', 'Piccardt-Corn'),
	(1877196, 'Georgia', 'Dingle'),
	(1808644, 'Georgia', 'Healy'),
	(2115730, 'Georgia', 'Thornton'),
	(2161234, 'Harshit', 'Sharma'),
	(2135153, 'Holly', 'Atkinson'),
	(2206576, 'Ian', 'Auvale'),
	(2184851, 'Isabelita', 'Endozo'),
	(1961512, 'Isabella', 'Cooper'),
	(1856562, 'Jacinta', 'Foster'),
	(1652483, 'Jack', 'Parks-earl'),
	(2125305, 'Jackie', 'Dundas'),
	(1884285, 'Jackson', 'Sturzaker'),
	(2048204, 'Jacynta', 'Szentesi'),
	(1796808, 'Janice', 'Abrahams'),
	(2017176, 'Jasmyne', 'Mitchell'),
	(898630, 'Jason', 'Brown'),
	(274317, 'Jason', 'Hodges'),
	(1860347, 'Jayde', 'Boxall'),
	(2003415, 'Jemma', 'Smith'),
	(1781055, 'Jennifer', 'Hawken'),
	(2130206, 'Jerome', 'Sidiropoulos'),
	(2016796, 'Jesse', 'Murphy'),
	(1547400, 'Jessica', 'Evans'),
	(83903, 'Jessica', 'Light'),
	(2101290, 'John', 'Marilag'),
	(1790658, 'Johnathan', 'Lucas'),
	(2157251, 'Jonathan', 'Flores'),
	(1764180, 'Jordan', 'Raiacovici'),
	(1386217, 'Jorja', 'Henry'),
	(1829479, 'Josh', 'O\'brien'),
	(1284544, 'Joshua', 'Deumer'),
	(1955401, 'Joshua', 'Kelly'),
	(2206337, 'Joshua', 'Rabot'),
	(1483095, 'Kaitlyn', 'Pund'),
	(1842244, 'Keematpal', 'Singh'),
	(1533197, 'Kristian', 'Kumarich'),
	(826501, 'Kunal', 'Singh'),
	(2003968, 'Kyle', 'Donovan'),
	(1235968, 'Kyle', 'Hammond'),
	(1928755, 'Lachlan', 'Bradford'),
	(2152479, 'Laura', 'Mccormick'),
	(1781423, 'Luke', 'Sparks'),
	(2021623, 'Macy', 'Crozier'),
	(2207720, 'Maddison', 'Swallow'),
	(1960489, 'Madeleine', 'Hammond'),
	(2139262, 'Madeleine', 'Wright'),
	(2143181, 'Manilka', 'Wijesena'),
	(1308488, 'Marcus', 'Byl'),
	(2169247, 'Matthew', 'Stefan'),
	(1710809, 'Megan', 'Tindle'),
	(2021616, 'Melissa', 'Dingle'),
	(1644060, 'Michael', 'Stapleton'),
	(1874233, 'Miguel', 'Damaso'),
	(1534127, 'Mikayla', 'Dingle'),
	(1995716, 'Mitchell', 'Edsall'),
	(2293614, 'Mitchell', 'Walden'),
	(2238954, 'Mohan', 'Arachchige Don'),
	(1726171, 'Myles', 'Lucas'),
	(1302281, 'Nathan', 'Blaney'),
	(2208580, 'Naveed', 'Bahram'),
	(2115222, 'Niccole', 'Thatcher'),
	(1376991, 'Penina', 'Sagele'),
	(1349198, 'Peter', 'Brko'),
	(1530903, 'Peter', 'Zanetti'),
	(2205145, 'Rachael', 'Degering'),
	(1671134, 'Rachael', 'Suitor'),
	(2043212, 'Rajan', 'Akhil'),
	(1899088, 'Rhyce', 'Henry'),
	(2212514, 'Ronith', 'Koshy'),
	(1997379, 'Sabrina', 'Bulacios'),
	(1991387, 'Salfia', 'Arad'),
	(221993, 'Samantha', 'Jane Smith'),
	(1987449, 'Sarahjoy', 'Gertrude'),
	(2192678, 'Sarith', 'Kateepearachchi'),
	(467098, 'Sarona', 'Sagele'),
	(2291609, 'Sasikumar', 'Kanapathipillai'),
	(2098296, 'Shanaye', 'Young'),
	(1914207, 'Shania', 'Kaing'),
	(1764043, 'Shannon', 'Cocker'),
	(490686, 'Shannyn', 'Thatcher'),
	(1893293, 'Shara', 'Spurway'),
	(2127795, 'Sharnelle', 'Nabalarua'),
	(2094108, 'Shaylee', 'Hearn'),
	(2199625, 'Solomon', 'Kuol'),
	(290227, 'Sosefina', 'Sanele'),
	(2211669, 'Stacey', 'Mcgookin'),
	(2211040, 'Stephanie', 'Golland'),
	(2050036, 'Teagan', 'Harris'),
	(2145039, 'Tia', 'Mcdougall'),
	(132707, 'Tolga', 'Varova'),
	(2046183, 'Tori', 'Smith'),
	(1370458, 'Trent', 'Beard'),
	(2205166, 'Ty', 'Ellison'),
	(2211533, 'Vaughn', 'Octavio'),
	(2224156, 'Victoria', 'Pizzi'),
	(2107150, 'Vidhi', 'Fernandes'),
	(2022888, 'Wade', 'Puskaric'),
	(408776, 'Will', 'Deagan'),
	(1434452, 'Yasemin', 'Jovicic'),
	(2294309, 'Yasitha', 'Fernando'),
	(1186171, 'Zain', 'Khan'),
	(2140920, 'Zuhayr', 'Rahman');

UNLOCK TABLES;

CREATE TABLE `submit` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`date` int(10) unsigned NOT NULL,
	`reason` text,
	PRIMARY KEY (`id`)
);

CREATE TABLE `dayoff` (
	`mid` int(11) NOT NULL,
	`sid` int(11) NOT NULL,
	`date` int(10) unsigned NOT NULL,
	`check` BOOLEAN DEFAULT FALSE,
	PRIMARY KEY (`mid`, `date`),
	FOREIGN KEY (`mid`) REFERENCES `crew` (`metime`),
	FOREIGN KEY (`sid`) REFERENCES `submit` (`id`)
);