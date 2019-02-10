<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190222195841 extends AbstractMigration
{

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE `categories` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `parent_id` INT UNSIGNED NOT NULL,
  `name` VARCHAR(100) NOT NULL,
  `url` VARCHAR(100) NOT NULL,
  `full_url` VARCHAR(250) NOT NULL,
  `title` VARCHAR(255) NOT NULL,
  `description` VARCHAR(255) NULL,
  `meta` VARCHAR(255) NULL,
  `keywords` VARCHAR(255) NULL,
  `active` INT(1) UNSIGNED NOT NULL DEFAULT 0,
  `deleted` INT(1) UNSIGNED NOT NULL DEFAULT 0,
  `created` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `start_time` DATETIME NULL,
  `end_time` DATETIME NULL,
  PRIMARY KEY (`id`),
  INDEX `cat_deleted` (`deleted` ASC),
  INDEX `cat_active` (`active` ASC),
  INDEX `cat_start_end_time` USING BTREE (`start_time` ASC, `end_time` ASC),
  UNIQUE INDEX `full_url_UNIQUE` (`full_url` ASC),
  INDEX `parent_id` (`parent_id` ASC),
  INDEX `cat_active_deleted` (`active` ASC, `deleted` ASC),
  INDEX `cat_active_deleted_start_end_time` (`deleted` ASC, `created` ASC, `start_time` ASC, `end_time` ASC),
  INDEX `full_search` (`parent_id` ASC, `active` ASC, `deleted` ASC, `start_time` ASC, `end_time` ASC));');

    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE IF EXISTS `categories`');

    }
}
