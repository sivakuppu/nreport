ALTER TABLE `certificate` ADD `invoice_date` DATE NOT NULL AFTER `goods_invoice_no`, ADD `inspection_date` DATE NOT NULL AFTER `invoice_date`, ADD `inspection_duration` TINYINT NOT NULL AFTER `inspection_date`;

ALTER TABLE `importer` ADD `code` VARCHAR(30) NOT NULL AFTER `fax`;
