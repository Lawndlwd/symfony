<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200520102722 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE program CHANGE poster poster VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE season DROP FOREIGN KEY FK_F0E45BA9362B62A0');
        $this->addSql('DROP INDEX IDX_F0E45BA9362B62A0 ON season');
        $this->addSql('ALTER TABLE season DROP episode_id');
        $this->addSql('ALTER TABLE episode ADD season_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE episode ADD CONSTRAINT FK_DDAA1CDA68756988 FOREIGN KEY (season_id_id) REFERENCES season (id)');
        $this->addSql('CREATE INDEX IDX_DDAA1CDA68756988 ON episode (season_id_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE episode DROP FOREIGN KEY FK_DDAA1CDA68756988');
        $this->addSql('DROP INDEX IDX_DDAA1CDA68756988 ON episode');
        $this->addSql('ALTER TABLE episode DROP season_id_id');
        $this->addSql('ALTER TABLE program CHANGE poster poster VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE season ADD episode_id INT NOT NULL');
        $this->addSql('ALTER TABLE season ADD CONSTRAINT FK_F0E45BA9362B62A0 FOREIGN KEY (episode_id) REFERENCES episode (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_F0E45BA9362B62A0 ON season (episode_id)');
    }
}
