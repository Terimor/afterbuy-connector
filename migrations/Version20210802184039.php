<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210802184039 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE `order` DROP INDEX IDX_F529939895835496');
        $this->addSql('ALTER TABLE `order` CHANGE afterbuy_account_id afterbuy_account_id INT NOT NULL');
        $this->addSql('ALTER TABLE `order` ADD INDEX IDX_F529939895835496 (afterbuy_account_id)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE `order` DROP INDEX IDX_F529939895835496');
        $this->addSql('ALTER TABLE `order` CHANGE afterbuy_account_id afterbuy_account_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE `order` ADD INDEX IDX_F529939895835496 (afterbuy_account_id)');
    }
}
