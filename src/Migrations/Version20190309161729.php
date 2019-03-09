<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190309161729 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql',
            'Migration can only be executed safely on \'mysql\'.');
        $this->addSql('ALTER TABLE posts CHANGE cat_id cat_id INT UNSIGNED NOT NULL, CHANGE active active INT DEFAULT 0 NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql',
            'Migration can only be executed safely on \'mysql\'.');
        $this->addSql('ALTER TABLE categories CHANGE active active INT UNSIGNED NOT NULL, CHANGE deleted deleted INT UNSIGNED NOT NULL, CHANGE start_time start_time DATETIME NOT NULL, CHANGE top_menu top_menu INT NOT NULL, CHANGE site_map site_map INT NOT NULL');
    }

}
