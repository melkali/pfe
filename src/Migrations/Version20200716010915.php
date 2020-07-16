<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200716010915 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE analysis_categories ADD patients_id INT NOT NULL, ADD users_id INT NOT NULL');
        $this->addSql('ALTER TABLE analysis_categories ADD CONSTRAINT FK_FC0D14C3CEC3FD2F FOREIGN KEY (patients_id) REFERENCES patients (id)');
        $this->addSql('ALTER TABLE analysis_categories ADD CONSTRAINT FK_FC0D14C367B3B43D FOREIGN KEY (users_id) REFERENCES users (id)');
        $this->addSql('CREATE INDEX IDX_FC0D14C3CEC3FD2F ON analysis_categories (patients_id)');
        $this->addSql('CREATE INDEX IDX_FC0D14C367B3B43D ON analysis_categories (users_id)');
        $this->addSql('ALTER TABLE patients ADD room_id INT DEFAULT NULL, CHANGE payment_sum_id payment_sum_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE patients ADD CONSTRAINT FK_2CCC2E2C54177093 FOREIGN KEY (room_id) REFERENCES room (id)');
        $this->addSql('CREATE INDEX IDX_2CCC2E2C54177093 ON patients (room_id)');
        $this->addSql('ALTER TABLE room ADD users_id INT NOT NULL');
        $this->addSql('ALTER TABLE room ADD CONSTRAINT FK_729F519B67B3B43D FOREIGN KEY (users_id) REFERENCES users (id)');
        $this->addSql('CREATE INDEX IDX_729F519B67B3B43D ON room (users_id)');
        $this->addSql('ALTER TABLE users CHANGE roles roles JSON NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE analysis_categories DROP FOREIGN KEY FK_FC0D14C3CEC3FD2F');
        $this->addSql('ALTER TABLE analysis_categories DROP FOREIGN KEY FK_FC0D14C367B3B43D');
        $this->addSql('DROP INDEX IDX_FC0D14C3CEC3FD2F ON analysis_categories');
        $this->addSql('DROP INDEX IDX_FC0D14C367B3B43D ON analysis_categories');
        $this->addSql('ALTER TABLE analysis_categories DROP patients_id, DROP users_id');
        $this->addSql('ALTER TABLE patients DROP FOREIGN KEY FK_2CCC2E2C54177093');
        $this->addSql('DROP INDEX IDX_2CCC2E2C54177093 ON patients');
        $this->addSql('ALTER TABLE patients DROP room_id, CHANGE payment_sum_id payment_sum_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE room DROP FOREIGN KEY FK_729F519B67B3B43D');
        $this->addSql('DROP INDEX IDX_729F519B67B3B43D ON room');
        $this->addSql('ALTER TABLE room DROP users_id');
        $this->addSql('ALTER TABLE users CHANGE roles roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_bin`');
    }
}
