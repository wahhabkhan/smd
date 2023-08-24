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
        -- Table `stakeholder`
        -- -----------------------------------------------------
        CREATE TABLE IF NOT EXISTS `stakeholder` (
          `stakeholder_id` INT(11) NOT NULL AUTO_INCREMENT,
          `stakeholder_category` VARCHAR(255) NULL DEFAULT NULL,
          `organization_name` VARCHAR(255) NULL DEFAULT NULL,
          `legal_form` VARCHAR(255) NULL DEFAULT NULL,
          `stakeholder_cat_specific_info` VARCHAR(255) NULL DEFAULT NULL,
          `size` VARCHAR(255) NULL DEFAULT NULL,
          `products` VARCHAR(255) NULL DEFAULT NULL,
          `production_capacity` VARCHAR(255) NULL DEFAULT NULL,
          `main_markets` VARCHAR(255) NULL DEFAULT NULL,
          `brands` VARCHAR(255) NULL DEFAULT NULL,
          `purchasing_capacity` VARCHAR(255) NULL DEFAULT NULL,
          `main_purchasing_markets` VARCHAR(255) NULL DEFAULT NULL,
          `main_sales_markets` VARCHAR(255) NULL DEFAULT NULL,
          `suppling_factories` VARCHAR(255) NULL DEFAULT NULL,
          `department` VARCHAR(255) NULL DEFAULT NULL,
          `sub_category` VARCHAR(255) NULL DEFAULT NULL,
          `organizational_location` VARCHAR(255) NULL DEFAULT NULL,
          `objective` VARCHAR(255) NULL DEFAULT NULL,
          `main_services` VARCHAR(255) NULL DEFAULT NULL,
          `membership` VARCHAR(255) NULL DEFAULT NULL,
          `giz_intervention_history` VARCHAR(255) NULL DEFAULT NULL,
          PRIMARY KEY (`stakeholder_id`))
        ENGINE = InnoDB
        AUTO_INCREMENT = 28
        DEFAULT CHARACTER SET = utf8mb4;
        
        
        -- -----------------------------------------------------
        -- Table `contacts`
        -- -----------------------------------------------------
        CREATE TABLE IF NOT EXISTS `contacts` (
          `id_contacts` INT(11) NOT NULL AUTO_INCREMENT,
          `contact_category` VARCHAR(255) NULL DEFAULT NULL,
          `gender` VARCHAR(255) NULL DEFAULT NULL,
          `academic_titles` VARCHAR(255) NULL DEFAULT NULL,
          `last_name` VARCHAR(255) NULL DEFAULT NULL,
          `first_name` VARCHAR(255) NULL DEFAULT NULL,
          `call_name` VARCHAR(255) NULL DEFAULT NULL,
          `current_company` VARCHAR(255) NULL DEFAULT NULL,
          `designation` VARCHAR(255) NULL DEFAULT NULL,
          `previous_company` VARCHAR(255) NULL DEFAULT NULL,
          `house_number` VARCHAR(255) NULL DEFAULT NULL,
          `street` VARCHAR(255) NULL DEFAULT NULL,
          `city` VARCHAR(255) NULL DEFAULT NULL,
          `postal_code` VARCHAR(255) NULL DEFAULT NULL,
          `extra_info_of_place` VARCHAR(255) NULL DEFAULT NULL,
          `country` VARCHAR(255) NULL DEFAULT NULL,
          `web_link` VARCHAR(255) NULL DEFAULT NULL,
          `geo_data` VARCHAR(255) NULL DEFAULT NULL,
          `landline_phone_1` VARCHAR(255) NULL DEFAULT NULL,
          `landline_phone_2` VARCHAR(255) NULL DEFAULT NULL,
          `fax` VARCHAR(255) NULL DEFAULT NULL,
          `cell_phone_1` VARCHAR(255) NULL DEFAULT NULL,
          `cell_phone_2` VARCHAR(255) NULL DEFAULT NULL,
          `cell_phone_3` VARCHAR(255) NOT NULL,
          `cell_phone_4` VARCHAR(255) NOT NULL,
          `email_1` VARCHAR(255) NOT NULL,
          `email_2` VARCHAR(255) NOT NULL,
          `email_3` VARCHAR(255) NOT NULL,
          `email_4` VARCHAR(255) NOT NULL,
          `whatsapp_1` VARCHAR(255) NOT NULL,
          `whatsapp_2` VARCHAR(255) NOT NULL,
          `whatsapp_3` VARCHAR(255) NOT NULL,
          `whatsapp_4` VARCHAR(255) NOT NULL,
          `stakeholder_id` INT(11) NOT NULL,
          PRIMARY KEY (`id_contacts`),
          INDEX `fk_contacts_stakeholder_idx` (`stakeholder_id` ASC) ,
          CONSTRAINT `fk_contacts_stakeholder`
            FOREIGN KEY (`stakeholder_id`)
            REFERENCES `stakeholder` (`stakeholder_id`)
            ON DELETE NO ACTION
            ON UPDATE NO ACTION)
        ENGINE = InnoDB
        AUTO_INCREMENT = 7
        DEFAULT CHARACTER SET = utf8mb4;
        
        
        -- -----------------------------------------------------
        -- Table `giz_intervention`
        -- -----------------------------------------------------
        CREATE TABLE IF NOT EXISTS `giz_intervention` (
          `intervention_id` INT(11) NOT NULL AUTO_INCREMENT,
          `name_of_intervention` VARCHAR(255) NULL DEFAULT NULL,
          `short_description` VARCHAR(255) NULL DEFAULT NULL,
          `giz_module` VARCHAR(255) NULL DEFAULT NULL,
          `component_manager` VARCHAR(255) NULL DEFAULT NULL,
          `comments` VARCHAR(255) NULL DEFAULT NULL,
          PRIMARY KEY (`intervention_id`))
        ENGINE = InnoDB
        AUTO_INCREMENT = 8
        DEFAULT CHARACTER SET = utf8mb4;
        
        
        -- -----------------------------------------------------
        -- Table `giz_project`
        -- -----------------------------------------------------
        CREATE TABLE IF NOT EXISTS `giz_project` (
          `project_id` INT(11) NOT NULL AUTO_INCREMENT,
          `name_of_module` VARCHAR(255) NULL DEFAULT NULL,
          `short_description` VARCHAR(255) NULL DEFAULT NULL,
          `giz_intervention` VARCHAR(255) NULL DEFAULT NULL,
          `duration` VARCHAR(255) NULL DEFAULT NULL,
          `av` VARCHAR(255) NULL DEFAULT NULL,
          `budget` VARCHAR(255) NULL DEFAULT NULL,
          `comments` VARCHAR(255) NULL DEFAULT NULL,
          PRIMARY KEY (`project_id`))
        ENGINE = InnoDB
        AUTO_INCREMENT = 7
        DEFAULT CHARACTER SET = utf8mb4;
        
        
        -- -----------------------------------------------------
        -- Table `giz_interventions_history`
        -- -----------------------------------------------------
        CREATE TABLE IF NOT EXISTS `giz_interventions_history` (
          `intervention_history_id` INT(11) NOT NULL AUTO_INCREMENT,
          `year_of_intervention` VARCHAR(255) NULL DEFAULT NULL,
          `giz_intervention` VARCHAR(255) NULL DEFAULT NULL,
          `focal_person` VARCHAR(255) NULL DEFAULT NULL,
          `comments` VARCHAR(255) NULL DEFAULT NULL,
          `stakeholder_id` INT(11) NOT NULL,
          `project_id` INT(11) NOT NULL,
          `intervention_id` INT(11) NOT NULL,
          PRIMARY KEY (`intervention_history_id`),
          INDEX `fk_giz_interventions_history_stakeholder1_idx` (`stakeholder_id` ASC) ,
          INDEX `fk_giz_interventions_history_giz_project1_idx` (`project_id` ASC) ,
          INDEX `fk_giz_interventions_history_giz_intervention1_idx` (`intervention_id` ASC) ,
          CONSTRAINT `fk_giz_interventions_history_giz_intervention1`
            FOREIGN KEY (`intervention_id`)
            REFERENCES `giz_intervention` (`intervention_id`)
            ON DELETE NO ACTION
            ON UPDATE NO ACTION,
          CONSTRAINT `fk_giz_interventions_history_giz_project1`
            FOREIGN KEY (`project_id`)
            REFERENCES `giz_project` (`project_id`)
            ON DELETE NO ACTION
            ON UPDATE NO ACTION,
          CONSTRAINT `fk_giz_interventions_history_stakeholder1`
            FOREIGN KEY (`stakeholder_id`)
            REFERENCES `stakeholder` (`stakeholder_id`)
            ON DELETE NO ACTION
            ON UPDATE NO ACTION)
        ENGINE = InnoDB
        AUTO_INCREMENT = 9
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
        
        SQL;

        $this->execute($sql);
    }

    public function down()
    {
        // Drop tables if needed, reverse of the above script
    }
}
