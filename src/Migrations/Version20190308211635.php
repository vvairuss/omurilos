<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190308211635 extends AbstractMigration
{

    public function up(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql',
            'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE `omurilos`.`posts` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `cat_id` INT(10) UNSIGNED NOT NULL,
  `name` VARCHAR(255) NOT NULL,
  `url` VARCHAR(425) NOT NULL,
  `active` INT(1) NOT NULL DEFAULT 0,
  `deleted` INT(1) NOT NULL,
  `created` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `start_time` DATETIME NULL DEFAULT NULL,
  `end_time` DATETIME NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_posts_1_idx` (`cat_id` ASC),
  UNIQUE INDEX `posts_cat_url` (`cat_id` ASC, `url` ASC),
  INDEX `active` (`active` ASC),
  INDEX `deleted` (`deleted` ASC),
  INDEX `active_deleted` (`active` ASC, `deleted` ASC),
  INDEX `start_end` (`start_time` ASC, `end_time` ASC),
  INDEX `active_start_end` (`active` ASC, `start_time` ASC, `end_time` ASC, `deleted` ASC),
  INDEX `cat_active_start_end` (`cat_id` ASC, `active` ASC, `deleted` ASC, `start_time` ASC, `end_time` ASC),
  INDEX `url_active_start_end` (`cat_id` ASC, `url` ASC, `active` ASC, `deleted` ASC, `start_time` ASC, `end_time` ASC),
  CONSTRAINT `fk_posts_1`
    FOREIGN KEY (`cat_id`)
    REFERENCES `omurilos`.`categories` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);');
    }

    public function down(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql',
            'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE posts');
    }
}
