<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190312093204 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE instrument (id INT AUTO_INCREMENT NOT NULL, instru_name VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_3CBF69DD8B38E998 (instru_name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE style (id INT AUTO_INCREMENT NOT NULL, style_name VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_33BDB86A31AF0FF7 (style_name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, instru_id INT DEFAULT NULL, style_id INT DEFAULT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, mail VARCHAR(70) NOT NULL, groupe TINYINT(1) NOT NULL, agreed_terms_at DATETIME NOT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), UNIQUE INDEX UNIQ_8D93D6495126AC48 (mail), INDEX IDX_8D93D649D868EB9A (instru_id), INDEX IDX_8D93D649BACD6074 (style_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649D868EB9A FOREIGN KEY (instru_id) REFERENCES instrument (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649BACD6074 FOREIGN KEY (style_id) REFERENCES style (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649D868EB9A');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649BACD6074');
        $this->addSql('DROP TABLE instrument');
        $this->addSql('DROP TABLE style');
        $this->addSql('DROP TABLE user');
    }
}
