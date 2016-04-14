
SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";




CREATE TABLE agent (
  id int(11) NOT NULL AUTO_INCREMENT,
  `name` mediumtext NOT NULL,
  address1 mediumtext NOT NULL,
  address2 mediumtext NOT NULL,
  address3 mediumtext NOT NULL,
  country varchar(255) NOT NULL,
  state varchar(255) NOT NULL,
  city varchar(255) NOT NULL,
  pin_code varchar(255) NOT NULL,
  phone_no varchar(255) NOT NULL,
  mobile_no varchar(255) NOT NULL,
  fax varchar(255) NOT NULL,
  email_id varchar(255) NOT NULL,
  remarks mediumtext NOT NULL,
  created_by varchar(255) NOT NULL,
  created_on datetime NOT NULL,
  PRIMARY KEY (id)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;



CREATE TABLE category (
  id int(40) NOT NULL AUTO_INCREMENT,
  category_name varchar(255) NOT NULL,
  description mediumtext NOT NULL,
  PRIMARY KEY (id)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;



CREATE TABLE certificate (
  id int(40) NOT NULL AUTO_INCREMENT,
  certificate_of_inspection_no varchar(255) NOT NULL,
  agent_id int(11) NOT NULL,
  importer_id int(11) NOT NULL,
  seller_id int(11) NOT NULL,
  port_of_shipment varchar(255) NOT NULL,
  declare_invoice_value varchar(255) NOT NULL,
  currency varchar(255) NOT NULL,
  toi varchar(255) NOT NULL,
  certificate_date date NOT NULL,
  freight_amount varchar(255) NOT NULL,
  goods_invoice_no mediumtext NOT NULL,
  mabw_bl_no mediumtext NOT NULL,
  inspection_place varchar(255) NOT NULL,
  be_number varchar(255) NOT NULL,
  `function` mediumtext NOT NULL,
  comments mediumtext NOT NULL,
  approximate_year varchar(255) NOT NULL,
  freight_description mediumtext NOT NULL,
  PRIMARY KEY (id)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;



CREATE TABLE `client` (
  id int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(10) NOT NULL,
  display_code varchar(25) NOT NULL,
  `name` varchar(255) NOT NULL,
  place varchar(60) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;



CREATE TABLE common (
  id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  client_id int(11) NOT NULL,
  client_refer_id int(11) NOT NULL,
  report_type int(11) NOT NULL,
  report_no varchar(50) NOT NULL,
  created_date date NOT NULL,
  `status` tinyint(4) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;



CREATE TABLE granite (
  id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  common_id bigint(20) NOT NULL,
  place_of_survey varchar(255) NOT NULL,
  date_of_survey date NOT NULL,
  container_type int(10) DEFAULT NULL,
  description_of_cargo varchar(255) NOT NULL,
  vessel_name varchar(255) NOT NULL,
  voyage_no varchar(255) NOT NULL,
  exporter tinytext,
  consignee tinytext,
  invoice_no varchar(255) NOT NULL,
  marks_blocks varchar(255) NOT NULL,
  port_of_loading varchar(255) NOT NULL,
  shipping_bill_no varchar(255) NOT NULL,
  port_of_discharge varchar(255) NOT NULL,
  created_date date NOT NULL,
  PRIMARY KEY (id)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;



CREATE TABLE granite_details (
  id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  common_id bigint(20) NOT NULL,
  container_no varchar(255) NOT NULL,
  gross_weight varchar(255) NOT NULL,
  payload_weight varchar(255) NOT NULL,
  cha_weight varchar(255) NOT NULL,
  no_of_blocks int(10) DEFAULT NULL,
  blocks_numbers varchar(255) DEFAULT NULL,
  customer_seal varchar(255) NOT NULL,
  line_seal varchar(255) NOT NULL,
  year_of_mfg varchar(25) DEFAULT NULL,
  flb_lenght int(10) DEFAULT NULL,
  flb_breath int(10) DEFAULT NULL,
  flb_height int(10) DEFAULT NULL,
  flb_count int(11) NOT NULL,
  front_end_wooden int(10) DEFAULT NULL,
  rear_end_wooden int(10) DEFAULT NULL,
  left_side_framework int(10) DEFAULT NULL,
  left_side_bolster int(10) DEFAULT NULL,
  right_side_framework int(10) DEFAULT NULL,
  right_side_bolster int(10) DEFAULT NULL,
  PRIMARY KEY (id)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;



CREATE TABLE importer (
  id int(11) NOT NULL AUTO_INCREMENT,
  `name` mediumtext NOT NULL,
  address1 mediumtext NOT NULL,
  address2 mediumtext NOT NULL,
  address3 mediumtext NOT NULL,
  country varchar(255) NOT NULL,
  state varchar(255) NOT NULL,
  city varchar(255) NOT NULL,
  pin_code varchar(255) NOT NULL,
  phone_no varchar(255) NOT NULL,
  mobile_no varchar(255) NOT NULL,
  fax varchar(255) NOT NULL,
  email_id varchar(255) NOT NULL,
  remarks mediumtext NOT NULL,
  created_by varchar(255) NOT NULL,
  created_on datetime NOT NULL,
  PRIMARY KEY (id)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;



CREATE TABLE inspection (
  id int(11) unsigned NOT NULL AUTO_INCREMENT,
  common_id int(11) unsigned NOT NULL,
  job_order varchar(100) NOT NULL,
  place_of_survey varchar(100) NOT NULL,
  date_of_survey date NOT NULL,
  left_side varchar(255) NOT NULL,
  right_side varchar(255) NOT NULL,
  front_side varchar(255) NOT NULL,
  roof_side varchar(255) NOT NULL,
  interior varchar(255) NOT NULL,
  rear_side varchar(255) NOT NULL,
  under_structure varchar(255) NOT NULL,
  note varchar(255) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;



CREATE TABLE inspection_details (
  id int(11) unsigned NOT NULL AUTO_INCREMENT,
  common_id int(11) unsigned NOT NULL,
  container_no varchar(255) NOT NULL,
  size_type varchar(100) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  gross_weight varchar(255) NOT NULL,
  tare_weight varchar(255) NOT NULL,
  mfd varchar(255) NOT NULL,
  cubic varchar(255) NOT NULL,
  line varchar(255) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;



CREATE TABLE item (
  id int(11) NOT NULL AUTO_INCREMENT,
  category_id int(11) NOT NULL,
  item_name varchar(255) NOT NULL,
  item_specification mediumtext NOT NULL,
  manufacturer varchar(255) NOT NULL,
  model varchar(255) NOT NULL,
  capacity varchar(255) NOT NULL,
  purpose mediumtext NOT NULL,
  manufacturing_year varchar(255) NOT NULL,
  cost_brand_new varchar(255) NOT NULL,
  cost_reconditioned varchar(255) NOT NULL,
  appraised_value varchar(255) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;



CREATE TABLE item_detail (
  id int(40) NOT NULL AUTO_INCREMENT,
  certificate_id int(11) NOT NULL,
  item_category_id int(11) NOT NULL,
  item_name mediumtext NOT NULL,
  ce_remarks mediumtext NOT NULL,
  specification mediumtext NOT NULL,
  year_of_mfg varchar(255) NOT NULL,
  quantity varchar(255) NOT NULL,
  eval_year_of_mfg varchar(255) NOT NULL,
  cost_of_machine varchar(255) NOT NULL,
  cost_of_recondition varchar(255) NOT NULL,
  appraised_value varchar(255) NOT NULL,
  make varchar(255) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;



CREATE TABLE seller (
  id int(11) NOT NULL AUTO_INCREMENT,
  `name` mediumtext NOT NULL,
  address1 mediumtext NOT NULL,
  address2 mediumtext NOT NULL,
  address3 mediumtext NOT NULL,
  country varchar(255) NOT NULL,
  state varchar(255) NOT NULL,
  city varchar(255) NOT NULL,
  pin_code varchar(255) NOT NULL,
  phone_no varchar(255) NOT NULL,
  mobile_no varchar(255) NOT NULL,
  fax varchar(255) NOT NULL,
  email_id varchar(255) NOT NULL,
  remarks mediumtext NOT NULL,
  created_by varchar(255) NOT NULL,
  created_on datetime NOT NULL,
  PRIMARY KEY (id)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;



CREATE TABLE stuffing (
  id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  common_id bigint(20) NOT NULL,
  place_of_survey varchar(100) NOT NULL,
  date_of_survey date NOT NULL,
  number_of_container varchar(100) NOT NULL,
  vessel_name varchar(100) NOT NULL,
  voyage_number varchar(100) NOT NULL,
  container_number varchar(100) NOT NULL,
  port_of_shipment varchar(100) NOT NULL,
  port_of_discharge varchar(100) NOT NULL,
  total_cargo_cubics varchar(100) NOT NULL,
  description varchar(100) NOT NULL,
  total_packages varchar(100) NOT NULL,
  stuffing_commenced datetime NOT NULL,
  stuffing_completed datetime NOT NULL,
  remark mediumtext NOT NULL,
  created_date datetime NOT NULL,
  official_seal varchar(255) NOT NULL,
  liner_seal varchar(255) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;



CREATE TABLE stuffing_details (
  id int(10) unsigned NOT NULL AUTO_INCREMENT,
  common_id bigint(20) NOT NULL,
  s_b_no varchar(10) NOT NULL,
  `date` date NOT NULL,
  marks varchar(100) NOT NULL,
  shipper varchar(100) NOT NULL,
  consignee varchar(100) NOT NULL,
  gross_weight varchar(10) NOT NULL,
  no_of_packages varchar(10) NOT NULL,
  length varchar(10) NOT NULL,
  breath varchar(10) NOT NULL,
  height varchar(10) NOT NULL,
  inspection varchar(100) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;



CREATE TABLE tobacco (
  id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  common_id bigint(20) NOT NULL,
  place_of_stuffing varchar(255) NOT NULL,
  start_date_of_stuffing date NOT NULL,
  end_date_of_stuffing date NOT NULL,
  port_of_discharge varchar(255) NOT NULL,
  description varchar(255) NOT NULL,
  official_seal varchar(255) NOT NULL,
  liner_seal varchar(255) NOT NULL,
  remark varchar(255) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;



CREATE TABLE tobacco_details (
  id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  common_id bigint(20) NOT NULL,
  container_no varchar(100) NOT NULL,
  container_type int(11) NOT NULL,
  no_of_ctns int(11) NOT NULL,
  line varchar(255) NOT NULL,
  gross_weight varchar(100) NOT NULL,
  net_weight varchar(100) NOT NULL,
  stuffing_commenced datetime NOT NULL,
  stuffing_completed datetime NOT NULL,
  stuffing_pattern text NOT NULL,
  PRIMARY KEY (id)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;



CREATE TABLE tobacco_invoice (
  id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  common_id bigint(20) NOT NULL,
  invoice_no varchar(255) NOT NULL,
  invoice_date date NOT NULL,
  marks tinytext NOT NULL,
  shipper varchar(255) NOT NULL,
  consignee varchar(255) NOT NULL,
  gross_weight varchar(255) NOT NULL,
  net_weight varchar(255) NOT NULL,
  no_of_package varchar(255) NOT NULL,
  remark tinytext NOT NULL,
  PRIMARY KEY (id)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;
