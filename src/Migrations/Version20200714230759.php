<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200714230759 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE analysis_type ADD users_id INT NOT NULL');
        $this->addSql('ALTER TABLE analysis_type ADD CONSTRAINT FK_BD6D12C267B3B43D FOREIGN KEY (users_id) REFERENCES users (id)');
        $this->addSql('CREATE INDEX IDX_BD6D12C267B3B43D ON analysis_type (users_id)');
        $this->addSql('ALTER TABLE patients ADD users_id INT NOT NULL, CHANGE payment_sum_id payment_sum_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE patients ADD CONSTRAINT FK_2CCC2E2C67B3B43D FOREIGN KEY (users_id) REFERENCES users (id)');
        $this->addSql('CREATE INDEX IDX_2CCC2E2C67B3B43D ON patients (users_id)');
        $this->addSql('ALTER TABLE payments ADD users_id INT NOT NULL');
        $this->addSql('ALTER TABLE payments ADD CONSTRAINT FK_65D29B3267B3B43D FOREIGN KEY (users_id) REFERENCES users (id)');
        $this->addSql('CREATE INDEX IDX_65D29B3267B3B43D ON payments (users_id)');
        $this->addSql('ALTER TABLE reports ADD users_id INT NOT NULL');
        $this->addSql('ALTER TABLE reports ADD CONSTRAINT FK_F11FA74567B3B43D FOREIGN KEY (users_id) REFERENCES users (id)');
        $this->addSql('CREATE INDEX IDX_F11FA74567B3B43D ON reports (users_id)');
        $this->addSql('ALTER TABLE results ADD users_id INT NOT NULL');
        $this->addSql('ALTER TABLE results ADD CONSTRAINT FK_9FA3E41467B3B43D FOREIGN KEY (users_id) REFERENCES users (id)');
        $this->addSql('CREATE INDEX IDX_9FA3E41467B3B43D ON results (users_id)');
        $this->addSql('ALTER TABLE users CHANGE roles roles JSON NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE analysis_type DROP FOREIGN KEY FK_BD6D12C267B3B43D');
        $this->addSql('DROP INDEX IDX_BD6D12C267B3B43D ON analysis_type');
        $this->addSql('ALTER TABLE analysis_type DROP users_id');
        $this->addSql('ALTER TABLE patients DROP FOREIGN KEY FK_2CCC2E2C67B3B43D');
        $this->addSql('DROP INDEX IDX_2CCC2E2C67B3B43D ON patients');
        $this->addSql('ALTER TABLE patients DROP users_id, CHANGE payment_sum_id payment_sum_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE payments DROP FOREIGN KEY FK_65D29B3267B3B43D');
        $this->addSql('DROP INDEX IDX_65D29B3267B3B43D ON payments');
        $this->addSql('ALTER TABLE payments DROP users_id');
        $this->addSql('ALTER TABLE reports DROP FOREIGN KEY FK_F11FA74567B3B43D');
        $this->addSql('DROP INDEX IDX_F11FA74567B3B43D ON reports');
        $this->addSql('ALTER TABLE reports DROP users_id');
        $this->addSql('ALTER TABLE results DROP FOREIGN KEY FK_9FA3E41467B3B43D');
        $this->addSql('DROP INDEX IDX_9FA3E41467B3B43D ON results');
        $this->addSql('ALTER TABLE results DROP users_id');
        $this->addSql('ALTER TABLE users CHANGE roles roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_bin`');
    }
}
