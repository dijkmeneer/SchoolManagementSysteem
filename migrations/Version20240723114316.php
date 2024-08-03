<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240723114316 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE foto (id INT AUTO_INCREMENT NOT NULL, filename VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE klas (id INT AUTO_INCREMENT NOT NULL, naam VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_3944E73AFC4DB938 (naam), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE klas_leraar (klas_id INT NOT NULL, leraar_id INT NOT NULL, INDEX IDX_BD96A4E2F3345ED (klas_id), INDEX IDX_BD96A4E806EFFF4 (leraar_id), PRIMARY KEY(klas_id, leraar_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE leraar (id INT AUTO_INCREMENT NOT NULL, naam VARCHAR(255) NOT NULL, leeftijd INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE student (id INT AUTO_INCREMENT NOT NULL, foto_id INT NOT NULL, klas_id INT NOT NULL, naam VARCHAR(255) NOT NULL, leeftijd INT NOT NULL, UNIQUE INDEX UNIQ_B723AF337ABFA656 (foto_id), INDEX IDX_B723AF332F3345ED (klas_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE klas_leraar ADD CONSTRAINT FK_BD96A4E2F3345ED FOREIGN KEY (klas_id) REFERENCES klas (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE klas_leraar ADD CONSTRAINT FK_BD96A4E806EFFF4 FOREIGN KEY (leraar_id) REFERENCES leraar (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE student ADD CONSTRAINT FK_B723AF337ABFA656 FOREIGN KEY (foto_id) REFERENCES foto (id)');
        $this->addSql('ALTER TABLE student ADD CONSTRAINT FK_B723AF332F3345ED FOREIGN KEY (klas_id) REFERENCES klas (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE klas_leraar DROP FOREIGN KEY FK_BD96A4E2F3345ED');
        $this->addSql('ALTER TABLE klas_leraar DROP FOREIGN KEY FK_BD96A4E806EFFF4');
        $this->addSql('ALTER TABLE student DROP FOREIGN KEY FK_B723AF337ABFA656');
        $this->addSql('ALTER TABLE student DROP FOREIGN KEY FK_B723AF332F3345ED');
        $this->addSql('DROP TABLE foto');
        $this->addSql('DROP TABLE klas');
        $this->addSql('DROP TABLE klas_leraar');
        $this->addSql('DROP TABLE leraar');
        $this->addSql('DROP TABLE student');
    }
}
