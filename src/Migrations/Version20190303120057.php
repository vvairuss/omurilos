<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190303120057 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql',
            'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP INDEX full_search_map ON categories');
        $this->addSql('DROP INDEX full_search_top_menu ON categories');
        $this->addSql('ALTER TABLE categories CHANGE active active INT UNSIGNED NOT NULL, CHANGE deleted deleted INT UNSIGNED NOT NULL, CHANGE created created DATETIME NOT NULL, CHANGE updated updated DATETIME DEFAULT NULL, CHANGE top_menu top_menu INT NOT NULL, CHANGE site_map site_map INT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql',
            'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE categories CHANGE active active INT UNSIGNED DEFAULT 0 NOT NULL, CHANGE deleted deleted INT UNSIGNED DEFAULT 0 NOT NULL, CHANGE created created DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, CHANGE updated updated DATETIME DEFAULT CURRENT_TIMESTAMP, CHANGE top_menu top_menu INT DEFAULT 0 NOT NULL, CHANGE site_map site_map INT DEFAULT 0 NOT NULL');
        $this->addSql('CREATE INDEX full_search_map ON categories (active, deleted, end_time, start_time, site_map)');
        $this->addSql('CREATE INDEX full_search_top_menu ON categories (top_menu, end_time, start_time, deleted, active)');
    }
}
