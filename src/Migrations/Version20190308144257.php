<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190308144257 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE instrument ADD users_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE instrument ADD CONSTRAINT FK_3CBF69DD67B3B43D FOREIGN KEY (users_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_3CBF69DD67B3B43D ON instrument (users_id)');
        $this->addSql('ALTER TABLE style ADD users_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE style ADD CONSTRAINT FK_33BDB86A67B3B43D FOREIGN KEY (users_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_33BDB86A67B3B43D ON style (users_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE instrument DROP FOREIGN KEY FK_3CBF69DD67B3B43D');
        $this->addSql('DROP INDEX IDX_3CBF69DD67B3B43D ON instrument');
        $this->addSql('ALTER TABLE instrument DROP users_id');
        $this->addSql('ALTER TABLE style DROP FOREIGN KEY FK_33BDB86A67B3B43D');
        $this->addSql('DROP INDEX IDX_33BDB86A67B3B43D ON style');
        $this->addSql('ALTER TABLE style DROP users_id');
    }
}
