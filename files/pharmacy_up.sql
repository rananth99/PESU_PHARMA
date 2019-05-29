CREATE DATABASE IF NOT EXISTS `pharmacy`;

CREATE TABLE IF NOT EXISTS `ADMINISTRATOR` (
  `admin_id` INT NOT NULL AUTO_INCREMENT,
  `admin_fname` VARCHAR(15) NOT NULL,
  `admin_lname` VARCHAR(15),
  `admin_sex` CHAR(1) NOT NULL,
  `username`  VARCHAR(15) NOT NULL UNIQUE,
  `password`  VARCHAR(20) NOT NULL,

  PRIMARY KEY(`admin_id`),
  CONSTRAINT gender_constraint CHECK (admin_sex = 'M' OR admin_sex = 'F')
);

CREATE TABLE IF NOT EXISTS `STOCK`(
  `stock_id` INT NOT NULL AUTO_INCREMENT,
  `drug` VARCHAR(25) NOT NULL,
  `quantity` INT,
  `company` VARCHAR(25) NOT NULL,
  `cost` INT,
  `description` VARCHAR(50),
  `expiry_date` DATE,
  `admin_id` INT,

  PRIMARY KEY(`stock_id`),
  FOREIGN KEY(`admin_id`) REFERENCES ADMINISTRATOR(`admin_id`)
);

CREATE TABLE IF NOT EXISTS `CASHIER` (
  `cashier_id` INT NOT NULL AUTO_INCREMENT,
  `cashier_name` VARCHAR(15) NOT NULL,
  `cashier_sex` CHAR(1),
  `cashier_phone` INT NOT NULL,
  `username` varchar(15) NOT NULL,
  `password` varchar(20) NOT NULL,
  `admin_id` INT NOT NULL,

  PRIMARY KEY(`cashier_id`),
  FOREIGN KEY(`admin_id`)REFERENCES ADMINISTRATOR(`admin_id`),
  CONSTRAINT gender_constraint CHECK (cashier_sex = 'M' OR cashier_sex = 'F')
);

CREATE TABLE IF NOT EXISTS `SUPPLIER`(
  `supplier_id` INT NOT NULL AUTO_INCREMENT,
  `supplier_name` VARCHAR(15) NOT NULL,
  `supplier_sex` CHAR(1),
  `supplier_phone` INT NOT NULL,
  `admin_id` INT NOT NULL,

  PRIMARY KEY(`supplier_id`),
  FOREIGN KEY(`admin_id`)REFERENCES ADMINISTRATOR(`admin_id`),
  CONSTRAINT gender_constraint CHECK (supplier_sex = 'M' OR supplier_sex = 'F')
);

CREATE TABLE IF NOT EXISTS `CUSTOMER`(
  `cust_id` INT NOT NULL AUTO_INCREMENT,
  `cust_fname` VARCHAR(25) NOT NULL,
  `cust_lname` VARCHAR(25),
  `cust_email` VARCHAR(25),
  `cust_phone` INT NOT NULL,
  `cust_sex` CHAR(1) NOT NULL,
  `cust_address` VARCHAR(60) NOT NULL UNIQUE,
  
  PRIMARY KEY(`cust_id`),
  CONSTRAINT gender_constraint CHECK (cust_sex = 'M' OR cust_sex = 'F')
);

CREATE TABLE IF NOT EXISTS `PRESCRIPTION`(
  `prescription_id` INT NOT NULL AUTO_INCREMENT,
  `order_date` DATE NOT NULL,
  `drug_quantity` INT NOT NULL,
  `stock_id` INT NOT NULL,
  `cust_id` INT NOT NULL,
  `cashier_id` INT NOT NULL,

  PRIMARY KEY(`prescription_id`),
  FOREIGN KEY(`cust_id`) REFERENCES CUSTOMER(`cust_id`),
  FOREIGN KEY(`cashier_id`) REFERENCES CASHIER(`cashier_id`),
  FOREIGN KEY(`stock_id`) REFERENCES STOCK(`stock_id`)
);

CREATE TABLE IF NOT EXISTS `BILL` (
  `invoice_no` INT NOT NULL AUTO_INCREMENT,
  `bill_date` DATE NOT NULL,
  `cost` INT NOT NULL,
  `cust_id` INT NOT NULL,
  `cashier_id` INT NOT NULL,
  `supplier_id` INT NOT NULL,

  PRIMARY KEY(`invoice_no`),
  FOREIGN KEY(`cust_id`)REFERENCES CUSTOMER(`cust_id`),
  FOREIGN KEY(`cashier_id`)REFERENCES CASHIER(`cashier_id`),
  FOREIGN KEY(`supplier_id`)REFERENCES SUPPLIER(`supplier_id`)
);

INSERT INTO `ADMINISTRATOR`(`admin_fname`,`admin_lname`,`admin_sex`,`username`,`password`) VALUES
("DAVID","BENIOFF","M","david","david123"),
("DB","WEISS","M","db","db123");

INSERT INTO `STOCK`(`drug`,`quantity`,`company`,`cost`,`description`,`expiry_date`,`admin_id`) VALUES
("dolo 650",5,"Micro Labs",3,"Treat cold,cough,fever","2018-12-26",1),
("opioid",10,"Purdue Pharma",3,"Pain relief","2020-03-30",1),
("codeine",15,"Aesica",8,"Treat pain,cough,diarrhea","2020-04-15",1),
("zopiclone",25,"Actavis",10,"Treatment of insomania","2025-12-30",1),
("glucobay",4,"Bayer Pharma",5,"Diabeties","2019-01-27",1),
("trazodone",16,"Watson Labs",5,"Anti-depressent medicine","2021-08-05",1),
("hyoscine",14,"Alchem International",13,"Treat Motion Sickness","2021-09-05",1),
("diazepam",26,"Aesica",9,"Cause memory loss during medical procedure","2022-04-10",1),
("crocin",5,"GSK",2,"Treat cold,cough,fever","2018-12-31",1);

INSERT INTO `CASHIER`(`cashier_name`,`cashier_sex`,`cashier_phone`,`username`,`password`,`admin_id`) VALUES
("ROBERT","M",654341324,"robert","robert123","1"),
("NED","M",852642324,"ned","ned123","2"),
("SKYLER","F",873465422,"skyler","sky123","2"),
("AEGON","M",811349828,"aegon","aegon123","1");


INSERT INTO `SUPPLIER`(`supplier_name`,`supplier_sex`,`supplier_phone`,`admin_id`) VALUES
("WATSON","M",852399213,"1"),
("OBERYN","M",851292763,"1"),
("DUSTIN","M",793359211,"2"),
("NANCY","F",852399212,"1"),
("CERSEI","F",782365912,"1"),
("PETYR","M",978659874,"2");


INSERT INTO `CUSTOMER`(`cust_fname`,`cust_lname`,`cust_email`,`cust_phone`,`cust_sex`,`cust_address`) VALUES
("JON","SNOW","jon@gmail.com",824756897,"M","No 10 Avenue Street Winterfell"),
("JAIME","LANNISTER","jaime@gmail.com",824756898,"M","241 OldTown Casterly Rock"),
("SHERLOCK","HOLMES","sherlock@gmail.com",822114897,"M","221B Baker Street London"),
("STANNIS","B","stannis@gmail.com",824756224,"M","No 132 6th Avenue Storms End"),
("DAENERYS","T","dany@gmail.com",824756899,"F","32B Royal Street KingsLanding"),
("AARYA","STARK","aarya@gmail.com",824756111,"F","56A Churchil Broadway Winterfell"),
("TYRION","L","tyrion@gmail.com",786756891,"M","No 31 Park.Ave Casterly Rock"),
("WALTER","WHITE","wwhite@gmail.com",924256877,"M","308 Negra Arroyo Lane Albuquerque"),
("CATELYN","STARK","catelyn@gmail.com",821243897,"F","212A HighTower Alley Riverrun"),
("Mary","Castillo","Mary21@gmail.com",989829568,"F","7934 Dalton Crossing Ashleymouth, PA 16384"),
("Barrett","Boden","Barrett31@gmail.com",875811535,"M","4027 Perkins Via Suite 382 West Johnmouth, MD 47755"),
("Araceli","Green","Araceli35@gmail.com",93534940,"F","925 Sandra Centers Suite 307 Lake Cheyennehaven, PA 74398"),
("Gaynell","Martin","Gaynell36@gmail.com",947350396,"F","7057 Johnson Pines North Thomasview, WV 88668"),
("Jeanette","Sacco","Jeanette31@gmail.com",852362061,"F","94935 Brett Trail Johnsonfurt, DC 70179"),
("Wayne","Gillam","Wayne33@gmail.com",947276126,"M","38915 Martinez Squares Port Melissa, MO 02852"),
("Terry","Davis","Terry33@gmail.com",8462454915,"M","7164 Kayla Street Port Tammy, IN 93040"),
("Dustin","Stalder","Dustin30@gmail.com",989129310,"M","5491 Harris Neck Cohenmouth, MO 34799"),
("Edmond","Richmond","Edmond32@gmail.com",976282316,"M","079 Linda Plain Powellmouth, MD 62941"),
("Evelyn","Goforth","Evelyn19@gmail.com",930180396,"F","PSC 9508, Box 4431 APO AP 96806"),
("Pablo","Warnke","Pablo28@gmail.com",984908771,"M","537 Stuart Fords Apt. 863 Whiteport, SD 56835"),
("Michael","Vichidvongsa","Michael22@gmail.com",824928573,"M","7014 Jennings Walk Port Anna, NY 68646"),
("Margaret","Kearney","Margaret43@gmail.com",945839380,"F","55244 Mendoza Estate West Teresaport, NH 11645"),
("Lawrence","Dooley","Lawrence22@gmail.com",937022078,"M","43759 Joshua Port Apt. 863 Tonyaborough, DE 30170"),
("David","Fitzpatrick","David18@gmail.com",931945810,"M","26345 Bell Road West Aaronville, AR 22358"),
("Jesus","Negron","Jesus25@gmail.com",967965917,"M","9667 Eric Stream Jameston, LA 33710"),
("Jeanette","Mitchell","Jeanette42@gmail.com",975398134,"F","222 Penny Mountains Suite 316 Gomezborough, VA 85751"),
("Andrea","Desorcy","Andrea30@gmail.com",910474436,"F","7520 Rangel Point Suite 467 New Joanne, MI 52563"),
("Christopher","Robinson","Christopher26@gmail.com",890691407,"M","35728 Crystal Place Suite 463 Lake Kyle, IA 23358"),
("Robert","Hazlett","Robert31@gmail.com",891657445,"M","244 Smith Parkways Port Carolinetown, HI 85674");

INSERT INTO `PRESCRIPTION`(`order_date`,`stock_id`,`drug_quantity`,`cust_id`,`cashier_id`) VALUES
("2019-02-13",2,3,1,1),
("2019-03-21",4,7,2,1),
("2019-03-12",3,4,3,1),
("2019-01-18",6,10,4,1),
("2019-03-13",2,3,5,1),
("2019-01-31",6,6,6,1),
("2019-03-22",8,7,7,1),
("2019-03-16",7,4,8,1),
("2019-02-24",4,10,9,1),
("2019-03-19",8,1,10,1),
("2019-02-15",6,3,11,1),
("2019-02-15",8,2,12,1),
("2019-01-22",3,9,13,1),
("2019-01-28",3,5,14,1),
("2019-03-17",3,6,15,1),
("2019-02-12",7,10,16,1),
("2019-03-09",4,5,17,1),
("2019-01-27",7,7,18,1),
("2019-01-16",9,7,19,1),
("2019-01-12",4,4,21,1),
("2019-02-25",6,5,22,1),
("2019-01-12",8,8,23,1),
("2019-02-26",8,5,24,1),
("2019-01-17",9,6,25,1),
("2019-02-20",8,3,26,1),
("2019-03-01",6,8,27,1),
("2019-02-11",6,9,28,1),
("2019-03-09",3,1,29,1),
("2019-02-13",6,10,20,1);


INSERT INTO `BILL`(`bill_date`,`cost`,`cust_id`,`cashier_id`,`supplier_id`) VALUES
('2019-04-21',29,1,1,1),
('2019-03-20',78,2,1,1),
('2019-04-01',27,3,1,1),
('2019-03-05',36,4,1,1),
('2019-02-28',243,5,1,1),
('2019-02-17',52,6,1,1),
('2019-03-08',81,7,1,1),
('2019-03-21',87,8,1,1),
('2019-04-03',217,9,1,1),
('2019-02-15',246,10,1,1),
('2019-03-27',310,11,1,1),
('2019-03-25',328,12,1,1),
('2019-04-17',217,13,1,1),
('2019-03-08',156,14,1,1),
('2019-04-15',29,15,1,1),
('2019-03-15',36,16,1,1),
('2019-04-11',234,17,1,1),
('2019-03-20',58,18,1,1),
('2019-02-24',324,19,1,1),
('2019-03-02',180,20,1,1),
('2019-04-19',216,21,1,1),
('2019-03-17',150,22,1,1),
('2019-04-11',205,23,1,1),
('2019-03-01',105,24,1,1),
('2019-04-11',36,25,1,1);