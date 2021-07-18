<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210718131514 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE volume (id INT AUTO_INCREMENT NOT NULL, unit VARCHAR(255) NOT NULL, amount DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE sold_item ADD volume_id INT DEFAULT NULL, DROP volume');
        $this->addSql('ALTER TABLE sold_item ADD CONSTRAINT FK_7D83906C8FD80EEA FOREIGN KEY (volume_id) REFERENCES volume (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_7D83906C8FD80EEA ON sold_item (volume_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE sold_item DROP FOREIGN KEY FK_7D83906C8FD80EEA');
        $this->addSql('DROP TABLE volume');
        $this->addSql('DROP INDEX UNIQ_7D83906C8FD80EEA ON sold_item');
        $this->addSql('ALTER TABLE sold_item ADD volume DOUBLE PRECISION NOT NULL, DROP volume_id');
    }
}
