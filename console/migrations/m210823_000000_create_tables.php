<?php

use yii\db\Migration;
use mdm\admin\components\Configs;

/**
 * Class m210823_000000_create_tables
 */
class m210823_000000_create_tables extends Migration
{
    public function up()
    {
        $sql = <<<SQL
        -- -----------------------------------------------------
        -- Table `auth_rule`
        -- -----------------------------------------------------
        CREATE TABLE IF NOT EXISTS `auth_rule` (
          `name` VARCHAR(64) NOT NULL,
          `data` TEXT NULL DEFAULT NULL,
          `created_at` INT(11) NULL DEFAULT NULL,
          `updated_at` INT(11) NULL DEFAULT NULL,
          PRIMARY KEY (`name`))
        ENGINE = InnoDB
        DEFAULT CHARACTER SET = utf8mb4;
        
        
        -- -----------------------------------------------------
        -- Table `auth_item`
        -- -----------------------------------------------------
        CREATE TABLE IF NOT EXISTS `auth_item` (
          `name` VARCHAR(64) NOT NULL,
          `type` SMALLINT(6) NOT NULL,
          `description` TEXT NULL DEFAULT NULL,
          `rule_name` VARCHAR(64) NULL DEFAULT NULL,
          `data` TEXT NULL DEFAULT NULL,
          `created_at` INT(11) NULL DEFAULT NULL,
          `updated_at` INT(11) NULL DEFAULT NULL,
          PRIMARY KEY (`name`),
          INDEX `rule_name` (`rule_name` ASC) ,
          CONSTRAINT `auth_item_ibfk_1`
            FOREIGN KEY (`rule_name`)
            REFERENCES `auth_rule` (`name`)
            ON DELETE SET NULL
            ON UPDATE CASCADE)
        ENGINE = InnoDB
        DEFAULT CHARACTER SET = utf8mb4;
        
        
        -- -----------------------------------------------------
        -- Table `auth_assignment`
        -- -----------------------------------------------------
        CREATE TABLE IF NOT EXISTS `auth_assignment` (
          `item_name` VARCHAR(64) NOT NULL,
          `user_id` VARCHAR(64) NOT NULL,
          `created_at` INT(11) NULL DEFAULT NULL,
          PRIMARY KEY (`item_name`, `user_id`),
          CONSTRAINT `auth_assignment_ibfk_1`
            FOREIGN KEY (`item_name`)
            REFERENCES `auth_item` (`name`)
            ON DELETE CASCADE
            ON UPDATE CASCADE)
        ENGINE = InnoDB
        DEFAULT CHARACTER SET = utf8mb4;
        
        
        -- -----------------------------------------------------
        -- Table `auth_item_child`
        -- -----------------------------------------------------
        CREATE TABLE IF NOT EXISTS `auth_item_child` (
          `parent` VARCHAR(64) NOT NULL,
          `child` VARCHAR(64) NOT NULL,
          PRIMARY KEY (`parent`, `child`),
          INDEX `child` (`child` ASC) ,
          CONSTRAINT `auth_item_child_ibfk_1`
            FOREIGN KEY (`parent`)
            REFERENCES `auth_item` (`name`)
            ON DELETE CASCADE
            ON UPDATE CASCADE,
          CONSTRAINT `auth_item_child_ibfk_2`
            FOREIGN KEY (`child`)
            REFERENCES `auth_item` (`name`)
            ON DELETE CASCADE
            ON UPDATE CASCADE)
        ENGINE = InnoDB
        DEFAULT CHARACTER SET = utf8mb4;
        
        
        
        
        -- -----------------------------------------------------
        -- Table `menu`
        -- -----------------------------------------------------
        CREATE TABLE IF NOT EXISTS `menu` (
          `id` INT(11) NOT NULL AUTO_INCREMENT,
          `name` VARCHAR(128) NOT NULL,
          `parent` INT(11) NULL DEFAULT NULL,
          `route` VARCHAR(255) NULL DEFAULT NULL,
          `order` INT(11) NULL DEFAULT NULL,
          `data` BLOB NULL DEFAULT NULL,
          PRIMARY KEY (`id`),
          INDEX `parent` (`parent` ASC) ,
          CONSTRAINT `menu_ibfk_1`
            FOREIGN KEY (`parent`)
            REFERENCES `menu` (`id`)
            ON DELETE SET NULL
            ON UPDATE CASCADE)
        ENGINE = InnoDB
        DEFAULT CHARACTER SET = utf8;
        
        
        
        -- -----------------------------------------------------
        -- Table `users`
        -- -----------------------------------------------------
        CREATE TABLE IF NOT EXISTS `users` (
          `id` INT(11) NOT NULL AUTO_INCREMENT,
          `name` VARCHAR(255) NOT NULL,
          `email` VARCHAR(255) NOT NULL,
          `username` VARCHAR(255) NOT NULL,
          `password_hash` VARCHAR(255) NOT NULL,
          `status` SMALLINT(6) NOT NULL DEFAULT 10,
          PRIMARY KEY (`id`))
        ENGINE = InnoDB
        AUTO_INCREMENT = 7
        DEFAULT CHARACTER SET = utf8mb4;
 -- -----------------------------------------------------
 -- Table `app`.`customer`
 -- -----------------------------------------------------
 CREATE TABLE IF NOT EXISTS `app`.`customer` (
  `customer_id` INT(50) NOT NULL AUTO_INCREMENT,
  `company_name` VARCHAR(255) NOT NULL,
  `i_street_name` VARCHAR(255) NOT NULL,
  `i_house_number` VARCHAR(255) NOT NULL,
  `i_appendix` VARCHAR(255) NOT NULL,
  `i_zipcode` VARCHAR(255) NOT NULL,
  `i_city` VARCHAR(255) NOT NULL,
  `i_country` VARCHAR(255) NOT NULL,
  `d_street_name` VARCHAR(255) NOT NULL,
  `d_house_number` VARCHAR(255) NOT NULL,
  `d_appendix` VARCHAR(255) NOT NULL,
  `d_zipcode` VARCHAR(255) NOT NULL,
  `d_city` VARCHAR(255) NOT NULL,
  `d_country` VARCHAR(255) NOT NULL,
  `vat_number` VARCHAR(255) NOT NULL,
  `coc_number` VARCHAR(255) NOT NULL,
  `invoice_email` VARCHAR(255) NOT NULL,
  `delivery_notes` VARCHAR(255) NOT NULL,
  `notes` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`customer_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `app`.`customer_contact`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `app`.`customer_contact` (
  `contact_id` INT(11) NOT NULL AUTO_INCREMENT,
  `first_name` VARCHAR(255) NOT NULL,
  `last_name` VARCHAR(255) NOT NULL,
  `position` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `phone_number1` VARCHAR(255) NOT NULL,
  `phone_number2` VARCHAR(255) NOT NULL,
  `phone_number3` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`contact_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `app`.`delivery_raw_material`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `app`.`delivery_raw_material` (
  `delivery_raw_id` INT(11) NOT NULL AUTO_INCREMENT,
  `supplier_company_name` VARCHAR(255) NOT NULL,
  `raw_material_name` VARCHAR(255) NOT NULL,
  `date` DATE NOT NULL,
  `is_packaging_ok` VARCHAR(255) NOT NULL,
  `batch_no` VARCHAR(255) NOT NULL,
  `expiration_date` VARCHAR(255) NOT NULL,
  `unit` INT(255) NOT NULL,
  `total_units` INT(255) NOT NULL,
  `price_per_unit` INT(255) NOT NULL,
  PRIMARY KEY (`delivery_raw_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `app`.`manager`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `app`.`manager` (
  `manager_id` INT(11) NOT NULL AUTO_INCREMENT,
  `first_name` VARCHAR(255) NOT NULL,
  `last_name` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `phone` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`manager_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `app`.`order`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `app`.`order` (
  `order_id` INT(50) NOT NULL AUTO_INCREMENT,
  `date` INT(255) NOT NULL,
  `invoice_number` INT(255) NOT NULL,
  `company_name` INT(255) NOT NULL,
  `street_name` INT(255) NOT NULL,
  `house_number` INT(255) NOT NULL,
  `appendix` INT(255) NOT NULL,
  `zipcode` INT(255) NOT NULL,
  `city` INT(255) NOT NULL,
  `country` INT(255) NOT NULL,
  `vat_number` INT(255) NOT NULL,
  `discount` INT(255) NOT NULL,
  `products` VARCHAR(255) NOT NULL,
  `quantity` INT(255) NOT NULL,
  `unit_price` DOUBLE NOT NULL,
  `sub_total` DOUBLE NOT NULL,
  `total` INT(255) NOT NULL,
  PRIMARY KEY (`order_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `app`.`product`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `app`.`product` (
  `product_id` INT(11) NOT NULL AUTO_INCREMENT,
  `product_name` VARCHAR(255) NOT NULL,
  `barcode` VARCHAR(255) NOT NULL,
  `volume_or_weight` VARCHAR(255) NOT NULL,
  `retial_price` VARCHAR(255) NOT NULL,
  `wholesale_price` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`product_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `app`.`product_raw`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `app`.`product_raw` (
  `product_raw_id` INT(11) NOT NULL AUTO_INCREMENT,
  `raw_material_name` VARCHAR(255) NOT NULL,
  `unit` VARCHAR(255) NOT NULL,
  `weight` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`product_raw_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `app`.`production_batch`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `app`.`production_batch` (
  `batch_id` INT(11) NOT NULL AUTO_INCREMENT,
  `date` DATE NOT NULL,
  `production_name` VARCHAR(255) NOT NULL,
  `total_units` VARCHAR(255) NOT NULL,
  `expiration_date` VARCHAR(255) NOT NULL,
  `batch_number` VARCHAR(255) NOT NULL,
  `raw_material` VARCHAR(255) NOT NULL,
  `employee_name` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`batch_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `app`.`production_employees`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `app`.`production_employees` (
  `employees_id` INT(11) NOT NULL AUTO_INCREMENT,
  `first_name` VARCHAR(255) NOT NULL,
  `last_name` VARCHAR(255) NOT NULL,
  `phone_number` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `street` VARCHAR(255) NOT NULL,
  `house_number` VARCHAR(255) NOT NULL,
  `appendix` VARCHAR(255) NOT NULL,
  `zipcode` VARCHAR(255) NOT NULL,
  `city` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`employees_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `app`.`production_employees_work`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `app`.`production_employees_work` (
  `work_id` INT(11) NOT NULL AUTO_INCREMENT,
  `date` VARCHAR(255) NOT NULL,
  `working_hours` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`work_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `app`.`raw_material_report`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `app`.`raw_material_report` (
  `raw_id` INT(11) NOT NULL AUTO_INCREMENT,
  `start_date` DATE NOT NULL,
  `end_date` DATE NOT NULL,
  PRIMARY KEY (`raw_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `app`.`sales`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `app`.`sales` (
  `sales_id` INT(11) NOT NULL AUTO_INCREMENT,
  `total_sales` INT(255) NOT NULL,
  `total_outstanding` INT(255) NOT NULL,
  PRIMARY KEY (`sales_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `app`.`stock_goods`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `app`.`stock_goods` (
  `stock_id` INT(11) NOT NULL AUTO_INCREMENT,
  `product_name` VARCHAR(255) NOT NULL,
  `count` INT(255) NOT NULL,
  PRIMARY KEY (`stock_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `app`.`supplier`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `app`.`supplier` (
  `supplier_id` INT(11) NOT NULL AUTO_INCREMENT,
  `company_name` VARCHAR(255) NOT NULL,
  `street_name` VARCHAR(255) NOT NULL,
  `house_number` VARCHAR(255) NOT NULL,
  `appendix` VARCHAR(255) NOT NULL,
  `zipcode` VARCHAR(255) NOT NULL,
  `city` VARCHAR(255) NOT NULL,
  `country` VARCHAR(255) NOT NULL,
  `vat_number` VARCHAR(255) NOT NULL,
  `coc_number` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `notes` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`supplier_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `app`.`supplier_contact`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `app`.`supplier_contact` (
  `contact_id` INT(11) NOT NULL AUTO_INCREMENT,
  `first_name` VARCHAR(255) NOT NULL,
  `last_name` VARCHAR(255) NOT NULL,
  `position` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `phone_number1` VARCHAR(255) NOT NULL,
  `phone_number2` VARCHAR(255) NOT NULL,
  `phone_number3` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`contact_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `app`.`supplier_raw_material`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `app`.`supplier_raw_material` (
  `raw_id` INT(11) NOT NULL AUTO_INCREMENT,
  `raw_material_name` VARCHAR(255) NOT NULL,
  `supplier_code` VARCHAR(255) NOT NULL,
  `unit` VARCHAR(255) NOT NULL,
  `low_stock` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`raw_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

        
        SQL;

        $this->execute($sql);
    }

    public function down()
    {
        // Drop tables if needed, reverse of the above script
    }
}
