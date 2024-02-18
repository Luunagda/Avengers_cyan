<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240218222543 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE mots_cles (id INT AUTO_INCREMENT NOT NULL, mots_cles VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mots_cles_marque_page (mots_cles_id INT NOT NULL, marque_page_id INT NOT NULL, INDEX IDX_C3F9F601C0BE80DB (mots_cles_id), INDEX IDX_C3F9F601D59CC0F1 (marque_page_id), PRIMARY KEY(mots_cles_id, marque_page_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE mots_cles_marque_page ADD CONSTRAINT FK_C3F9F601C0BE80DB FOREIGN KEY (mots_cles_id) REFERENCES mots_cles (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE mots_cles_marque_page ADD CONSTRAINT FK_C3F9F601D59CC0F1 FOREIGN KEY (marque_page_id) REFERENCES marque_page (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE mots_cles_marque_page DROP FOREIGN KEY FK_C3F9F601C0BE80DB');
        $this->addSql('ALTER TABLE mots_cles_marque_page DROP FOREIGN KEY FK_C3F9F601D59CC0F1');
        $this->addSql('DROP TABLE mots_cles');
        $this->addSql('DROP TABLE mots_cles_marque_page');
    }
}
