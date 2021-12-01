<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211201091417 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE plat_resto (plat_id INT NOT NULL, resto_id INT NOT NULL, INDEX IDX_1929D3CDD73DB560 (plat_id), INDEX IDX_1929D3CD2978E8D1 (resto_id), PRIMARY KEY(plat_id, resto_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE plat_resto ADD CONSTRAINT FK_1929D3CDD73DB560 FOREIGN KEY (plat_id) REFERENCES plat (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE plat_resto ADD CONSTRAINT FK_1929D3CD2978E8D1 FOREIGN KEY (resto_id) REFERENCES resto (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE plat_resto');
    }
}
