<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190210191713 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        $this->addSql('DROP TABLE IF EXISTS `TEST`');

    }

    public function down(Schema $schema) : void
    {
        $this->addSql('CREATE TABLE IF NOT EXISTS `omurilos`.`TEST` (
  `id` INT NOT NULL,
  PRIMARY KEY (`id`));');
    }
}
