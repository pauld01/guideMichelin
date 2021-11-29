<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211129150056 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE resto DROP FOREIGN KEY FK_892155B1CB97E181');
        $this->addSql('ALTER TABLE resto ADD CONSTRAINT FK_892155B1CB97E181 FOREIGN KEY (id_chef_id) REFERENCES chef (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE resto DROP FOREIGN KEY FK_892155B1CB97E181');
        $this->addSql('ALTER TABLE resto ADD CONSTRAINT FK_892155B1CB97E181 FOREIGN KEY (id_chef_id) REFERENCES chef (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
    }
}
