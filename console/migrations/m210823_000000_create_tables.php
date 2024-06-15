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
              


        
        SQL;

        $this->execute($sql);
    }

    public function down()
    {
        // Drop tables if needed, reverse of the above script
    }
}
