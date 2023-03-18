DROP TABLE master_ac_type;

CREATE TABLE `master_ac_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ac_type` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

INSERT INTO master_ac_type VALUES("4","Split AC");
INSERT INTO master_ac_type VALUES("5","Window AC");
INSERT INTO master_ac_type VALUES("6","Chiller");



DROP TABLE master_accounttype;

CREATE TABLE `master_accounttype` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account_type` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO master_accounttype VALUES("1","Current");
INSERT INTO master_accounttype VALUES("2","Savings");



DROP TABLE master_amc_type;

CREATE TABLE `master_amc_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `amc_type` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

INSERT INTO master_amc_type VALUES("4","Free");
INSERT INTO master_amc_type VALUES("5","Paid");



DROP TABLE master_amc_visit;

CREATE TABLE `master_amc_visit` (
  `id` int(11) NOT NULL,
  `amc_visit` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO master_amc_visit VALUES("0","1");
INSERT INTO master_amc_visit VALUES("0","2");
INSERT INTO master_amc_visit VALUES("0","3");
INSERT INTO master_amc_visit VALUES("0","4");



DROP TABLE master_brand;

CREATE TABLE `master_brand` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `brand` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

INSERT INTO master_brand VALUES("3","Linux Server");
INSERT INTO master_brand VALUES("4","Windows Server");
INSERT INTO master_brand VALUES("5","Promotional SMS");
INSERT INTO master_brand VALUES("6","Transactional SMS");



DROP TABLE master_capacity;

CREATE TABLE `master_capacity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `capacity` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




DROP TABLE master_con_method;

CREATE TABLE `master_con_method` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contact_method` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO master_con_method VALUES("1","BY Phone");
INSERT INTO master_con_method VALUES("2","BY Mail");



DROP TABLE master_contract_period;

CREATE TABLE `master_contract_period` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contract_period` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO master_contract_period VALUES("1","6 Months");
INSERT INTO master_contract_period VALUES("2","1 Year");



DROP TABLE master_customer_category;

CREATE TABLE `master_customer_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_category` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

INSERT INTO master_customer_category VALUES("1","Preffered");
INSERT INTO master_customer_category VALUES("2","Normal");



DROP TABLE master_department;

CREATE TABLE `master_department` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `department` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

INSERT INTO master_department VALUES("1","Customer Support");
INSERT INTO master_department VALUES("3","Marketing");
INSERT INTO master_department VALUES("4","Development");
INSERT INTO master_department VALUES("5","Front Office");
INSERT INTO master_department VALUES("6","Accounts");



DROP TABLE master_enquiry_source;

CREATE TABLE `master_enquiry_source` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `enquiry_source` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

INSERT INTO master_enquiry_source VALUES("1","Website");
INSERT INTO master_enquiry_source VALUES("3","Cold Call");
INSERT INTO master_enquiry_source VALUES("4","Existing Customer");
INSERT INTO master_enquiry_source VALUES("5","Self Generated");
INSERT INTO master_enquiry_source VALUES("6","Employee");
INSERT INTO master_enquiry_source VALUES("7","Partner");
INSERT INTO master_enquiry_source VALUES("8","Public Relation");
INSERT INTO master_enquiry_source VALUES("9","Mail");
INSERT INTO master_enquiry_source VALUES("10","Word of Mouth");
INSERT INTO master_enquiry_source VALUES("11","Advertaisement");



DROP TABLE master_enquiry_status;

CREATE TABLE `master_enquiry_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `enquiry_status` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

INSERT INTO master_enquiry_status VALUES("2","Client Appointment Need");
INSERT INTO master_enquiry_status VALUES("3","Client Appointment Fixed");
INSERT INTO master_enquiry_status VALUES("4","Converted as Order");
INSERT INTO master_enquiry_status VALUES("5","Dropped");
INSERT INTO master_enquiry_status VALUES("6","On Followup");



DROP TABLE master_financialyear;

CREATE TABLE `master_financialyear` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `financial_year` varchar(50) NOT NULL,
  `database_name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO master_financialyear VALUES("1","2015-2016","srinfosoft_sid20152016");



DROP TABLE master_lead_activity;

CREATE TABLE `master_lead_activity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `activity` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

INSERT INTO master_lead_activity VALUES("1","Appointment");
INSERT INTO master_lead_activity VALUES("2","Meeting");
INSERT INTO master_lead_activity VALUES("3","Mobile Call");
INSERT INTO master_lead_activity VALUES("4","Email");
INSERT INTO master_lead_activity VALUES("5","To Do");



DROP TABLE master_month;

CREATE TABLE `master_month` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `month_no` varchar(50) NOT NULL,
  `month_name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

INSERT INTO master_month VALUES("1","1","January");
INSERT INTO master_month VALUES("2","2","February");
INSERT INTO master_month VALUES("3","3","March");
INSERT INTO master_month VALUES("4","4","April");
INSERT INTO master_month VALUES("5","5","May");
INSERT INTO master_month VALUES("6","6","June");
INSERT INTO master_month VALUES("7","7","July");
INSERT INTO master_month VALUES("8","8","August");
INSERT INTO master_month VALUES("9","9","September");
INSERT INTO master_month VALUES("10","10","October");
INSERT INTO master_month VALUES("11","11","November");
INSERT INTO master_month VALUES("12","12","December");



DROP TABLE master_options;

CREATE TABLE `master_options` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `option_name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO master_options VALUES("1","Yes");
INSERT INTO master_options VALUES("2","No");



DROP TABLE master_payment_mode;

CREATE TABLE `master_payment_mode` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `payment_mode` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

INSERT INTO master_payment_mode VALUES("10","Cash");
INSERT INTO master_payment_mode VALUES("11","Cheque");
INSERT INTO master_payment_mode VALUES("12","NEFT");
INSERT INTO master_payment_mode VALUES("13","Credit Card");



DROP TABLE master_priority;

CREATE TABLE `master_priority` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `priority` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

INSERT INTO master_priority VALUES("1","Hot");
INSERT INTO master_priority VALUES("2","Warm");
INSERT INTO master_priority VALUES("3","Cold");



DROP TABLE master_product_group;

CREATE TABLE `master_product_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_group` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

INSERT INTO master_product_group VALUES("2","SID");
INSERT INTO master_product_group VALUES("3","VYOM");



DROP TABLE master_quotation_status;

CREATE TABLE `master_quotation_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `quotation_status` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

INSERT INTO master_quotation_status VALUES("1","Converted To Sales");
INSERT INTO master_quotation_status VALUES("2","Cancelled By Customer");
INSERT INTO master_quotation_status VALUES("3","Cancelled By Company");
INSERT INTO master_quotation_status VALUES("4","Revised Quotation Has Raised");
INSERT INTO master_quotation_status VALUES("5","Dropped");



DROP TABLE master_service_type;

CREATE TABLE `master_service_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service_type` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




DROP TABLE master_status;

CREATE TABLE `master_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO master_status VALUES("1","Open");
INSERT INTO master_status VALUES("2","Close");



DROP TABLE master_tax_rate;

CREATE TABLE `master_tax_rate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tax_name` varchar(50) NOT NULL,
  `tax_rate` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

INSERT INTO master_tax_rate VALUES("5","Sales","5");
INSERT INTO master_tax_rate VALUES("6","Sales","14.5");
INSERT INTO master_tax_rate VALUES("7","Service","14.5");



DROP TABLE master_tax_type;

CREATE TABLE `master_tax_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tax_type` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO master_tax_type VALUES("1","In");
INSERT INTO master_tax_type VALUES("2","Ex");



DROP TABLE master_terms_condition;

CREATE TABLE `master_terms_condition` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `term_name` varchar(100) NOT NULL,
  `term_value` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO master_terms_condition VALUES("2","Product Demo","1. The demo link will automatically expire in 15 days<br>2. The product is registered in the name of SID Corptech LLC");



DROP TABLE master_unit;

CREATE TABLE `master_unit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `unit` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

INSERT INTO master_unit VALUES("4","Nos");



DROP TABLE master_usertype;

CREATE TABLE `master_usertype` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usertype` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO master_usertype VALUES("1","Super Administrator");



DROP TABLE master_visit_status;

CREATE TABLE `master_visit_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

INSERT INTO master_visit_status VALUES("4","Closed");
INSERT INTO master_visit_status VALUES("5","Pending");



DROP TABLE master_year;

CREATE TABLE `master_year` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `year` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

INSERT INTO master_year VALUES("1","2015");
INSERT INTO master_year VALUES("2","2016");
INSERT INTO master_year VALUES("3","2017");
INSERT INTO master_year VALUES("4","2018");
INSERT INTO master_year VALUES("5","2019");
INSERT INTO master_year VALUES("6","2020");
INSERT INTO master_year VALUES("7","2021");
INSERT INTO master_year VALUES("8","2022");
INSERT INTO master_year VALUES("9","2023");
INSERT INTO master_year VALUES("10","2024");
INSERT INTO master_year VALUES("11","2025");



DROP TABLE sr_company;

CREATE TABLE `sr_company` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_name` varchar(100) NOT NULL,
  `company_caption` varchar(250) NOT NULL,
  `address_line1` varchar(100) NOT NULL,
  `address_line2` varchar(100) NOT NULL,
  `city` varchar(75) NOT NULL,
  `pincode` varchar(25) NOT NULL,
  `telephone_no` varchar(50) NOT NULL,
  `mobile_no` varchar(50) NOT NULL,
  `fax_no` varchar(50) NOT NULL,
  `email_id` varchar(100) NOT NULL,
  `website_id` varchar(100) NOT NULL,
  `tin_no` varchar(50) NOT NULL,
  `cst_no` varchar(50) NOT NULL,
  `company_type` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO sr_company VALUES("1","SID CORPTECH LLC","Highly Refined Cloud Data Service","#360, Mohanram Nagar, EVK Sampath Salai ","Mogappair East, Near Indian Bank","Chennai","600 037","9144 29000314, 0444 42800568","+91 89 39 199 899 ","","technologypartners@sidcorp.in ","www.sidcorp.in","","","Head Office");



DROP TABLE sr_customer;

CREATE TABLE `sr_customer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_group` varchar(50) NOT NULL,
  `customer_name` varchar(100) NOT NULL,
  `customer_company` varchar(100) NOT NULL,
  `customer_category` varchar(100) NOT NULL,
  `address_line1` varchar(200) NOT NULL,
  `address_line2` varchar(200) NOT NULL,
  `city` varchar(50) NOT NULL,
  `pincode` varchar(50) NOT NULL,
  `telephone_number` varchar(50) NOT NULL,
  `mobile_number` varchar(50) NOT NULL,
  `email_id` varchar(100) NOT NULL,
  `tin_no` varchar(100) NOT NULL,
  `cst_no` varchar(100) NOT NULL,
  `entry_date` varchar(100) NOT NULL,
  `lead_source` varchar(100) NOT NULL,
  `reffered_by` varchar(100) NOT NULL,
  `lead_description` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

INSERT INTO sr_customer VALUES("2","SID","Naren","SR Infosoft","Preffered","28 Mangai Street","Jafferkhanpet","Chennai","600083","044 42807596","9789048705","naren@srinfosoft.com","NA","NA","01-01-2016","Website","None","None");
INSERT INTO sr_customer VALUES("4","VYOM","Sundar","SR Infosoft","Normal","28 Mangai Street","Jafferkhanpet","Chennai","600083","044 42807596","9789048705","sundar@srinfosoft.com","NA","NA","01-01-2016","Existing Customer","Naren","None");



DROP TABLE sr_employee;

CREATE TABLE `sr_employee` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_group` varchar(50) NOT NULL,
  `employee_name` varchar(100) NOT NULL,
  `department` varchar(100) NOT NULL,
  `address_line1` varchar(200) NOT NULL,
  `address_line2` varchar(200) NOT NULL,
  `city` varchar(50) NOT NULL,
  `pincode` varchar(50) NOT NULL,
  `telephone_number` varchar(50) NOT NULL,
  `mobile_number` varchar(50) NOT NULL,
  `email_id` varchar(50) NOT NULL,
  `bank_name` varchar(50) NOT NULL,
  `bank_branch` varchar(50) NOT NULL,
  `ac_no` varchar(50) NOT NULL,
  `ac_name` varchar(100) NOT NULL,
  `ac_type` varchar(50) NOT NULL,
  `ifsc_code` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

INSERT INTO sr_employee VALUES("3","SID","Raj Kumar","Customer Support","10 Nehru Street","Vadapalani","Chennai","600025","044 42563254","9876543210","rajkumar@gmail.com","State Bank of India","Vadapalani","96521422536","Rajkumar","Savings","SBIN0001255");



DROP TABLE sr_product;

CREATE TABLE `sr_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_group` varchar(100) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_description` varchar(500) NOT NULL,
  `product_brand` varchar(100) NOT NULL,
  `product_code` varchar(100) NOT NULL,
  `product_unit` varchar(500) NOT NULL,
  `quantity` varchar(50) NOT NULL,
  `minimum_quantity` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

INSERT INTO sr_product VALUES("2","VYOM","Linux Server 1GB","512 MB Ram, 3 Email ID, 3 GB Bandwidth","Linux Server","VYOM1","Nos","","");
INSERT INTO sr_product VALUES("4","VYOM","10000 Pack","None","Promotional SMS","VYOM2","Nos","","");



DROP TABLE sr_user;

CREATE TABLE `sr_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(50) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `usertype` varchar(50) NOT NULL,
  `display_name` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `registered_at` varchar(100) NOT NULL,
  `active_status` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

INSERT INTO sr_user VALUES("2","1","Super Administrator","SID Corptech","sid","sid","07-01-2016 12:00:00 AM","Active");



