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
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) unsigned NOT NULL,
  `name` varchar(100) NOT NULL,
  `url` varchar(100) NOT NULL,
  `full_url` varchar(250) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `meta` varchar(255) DEFAULT NULL,
  `keywords` varchar(255) DEFAULT NULL,
  `active` int(10) unsigned NOT NULL DEFAULT \'0\',
  `deleted` int(10) unsigned NOT NULL DEFAULT \'0\',
  `created` DATETIME NOT NULL,
  `updated` DATETIME NOT NULL,
  `start_time` datetime DEFAULT NULL,
  `end_time` datetime DEFAULT NULL,
  `top_menu` int(11) NOT NULL DEFAULT \'0\',
  `site_map` int(11) NOT NULL DEFAULT \'0\',
  PRIMARY KEY (`id`),
  UNIQUE KEY `full_url_UNIQUE` (`full_url`),
  KEY `cat_deleted` (`deleted`),
  KEY `cat_active` (`active`),
  KEY `cat_start_end_time` (`start_time`,`end_time`) USING BTREE,
  KEY `parent_id` (`parent_id`),
  KEY `cat_active_deleted` (`active`,`deleted`),
  KEY `cat_active_deleted_start_end_time` (`deleted`,`created`,`start_time`,`end_time`),
  KEY `full_search` (`parent_id`,`active`,`deleted`,`start_time`,`end_time`),
  KEY `full_search_map` (`active`,`deleted`,`end_time`,`start_time`,`site_map`),
  KEY `full_search_top_menu` (`top_menu`,`end_time`,`start_time`,`deleted`,`active`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;');

    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE IF EXISTS `categories`');

    }
}
