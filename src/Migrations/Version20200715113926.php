<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200715113926 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE analysis_type (id INT AUTO_INCREMENT NOT NULL, patients_id INT NOT NULL, users_id INT NOT NULL, analysis_name VARCHAR(255) NOT NULL, INDEX IDX_BD6D12C2CEC3FD2F (patients_id), INDEX IDX_BD6D12C267B3B43D (users_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE patients (id INT AUTO_INCREMENT NOT NULL, payment_sum_id INT DEFAULT NULL, report_patient_id INT NOT NULL, result_patient_id INT NOT NULL, users_id INT NOT NULL, name_patient VARCHAR(255) NOT NULL, firstname_patient VARCHAR(255) NOT NULL, phone INT NOT NULL, date_birth DATE NOT NULL, doctor VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_2CCC2E2C78321919 (payment_sum_id), UNIQUE INDEX UNIQ_2CCC2E2C78CBBE42 (report_patient_id), UNIQUE INDEX UNIQ_2CCC2E2C93D298A6 (result_patient_id), INDEX IDX_2CCC2E2C67B3B43D (users_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE payments (id INT AUTO_INCREMENT NOT NULL, users_id INT NOT NULL, name_payment VARCHAR(255) NOT NULL, status TINYINT(1) NOT NULL, sum INT NOT NULL, content_payment VARCHAR(255) NOT NULL, INDEX IDX_65D29B3267B3B43D (users_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reports (id INT AUTO_INCREMENT NOT NULL, users_id INT NOT NULL, name_report VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_F11FA74567B3B43D (users_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reset_password_request (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, selector VARCHAR(20) NOT NULL, hashed_token VARCHAR(100) NOT NULL, requested_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', expires_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_7CE748AA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE results (id INT AUTO_INCREMENT NOT NULL, users_id INT NOT NULL, name_result VARCHAR(255) NOT NULL, content_result VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_9FA3E41467B3B43D (users_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, is_verified TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_1483A5E9E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE analysis_type ADD CONSTRAINT FK_BD6D12C2CEC3FD2F FOREIGN KEY (patients_id) REFERENCES patients (id)');
        $this->addSql('ALTER TABLE analysis_type ADD CONSTRAINT FK_BD6D12C267B3B43D FOREIGN KEY (users_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE patients ADD CONSTRAINT FK_2CCC2E2C78321919 FOREIGN KEY (payment_sum_id) REFERENCES payments (id)');
        $this->addSql('ALTER TABLE patients ADD CONSTRAINT FK_2CCC2E2C78CBBE42 FOREIGN KEY (report_patient_id) REFERENCES reports (id)');
        $this->addSql('ALTER TABLE patients ADD CONSTRAINT FK_2CCC2E2C93D298A6 FOREIGN KEY (result_patient_id) REFERENCES results (id)');
        $this->addSql('ALTER TABLE patients ADD CONSTRAINT FK_2CCC2E2C67B3B43D FOREIGN KEY (users_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE payments ADD CONSTRAINT FK_65D29B3267B3B43D FOREIGN KEY (users_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE reports ADD CONSTRAINT FK_F11FA74567B3B43D FOREIGN KEY (users_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE reset_password_request ADD CONSTRAINT FK_7CE748AA76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE results ADD CONSTRAINT FK_9FA3E41467B3B43D FOREIGN KEY (users_id) REFERENCES users (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE analysis_type DROP FOREIGN KEY FK_BD6D12C2CEC3FD2F');
        $this->addSql('ALTER TABLE patients DROP FOREIGN KEY FK_2CCC2E2C78321919');
        $this->addSql('ALTER TABLE patients DROP FOREIGN KEY FK_2CCC2E2C78CBBE42');
        $this->addSql('ALTER TABLE patients DROP FOREIGN KEY FK_2CCC2E2C93D298A6');
        $this->addSql('ALTER TABLE analysis_type DROP FOREIGN KEY FK_BD6D12C267B3B43D');
        $this->addSql('ALTER TABLE patients DROP FOREIGN KEY FK_2CCC2E2C67B3B43D');
        $this->addSql('ALTER TABLE payments DROP FOREIGN KEY FK_65D29B3267B3B43D');
        $this->addSql('ALTER TABLE reports DROP FOREIGN KEY FK_F11FA74567B3B43D');
        $this->addSql('ALTER TABLE reset_password_request DROP FOREIGN KEY FK_7CE748AA76ED395');
        $this->addSql('ALTER TABLE results DROP FOREIGN KEY FK_9FA3E41467B3B43D');
        $this->addSql('DROP TABLE analysis_type');
        $this->addSql('DROP TABLE patients');
        $this->addSql('DROP TABLE payments');
        $this->addSql('DROP TABLE reports');
        $this->addSql('DROP TABLE reset_password_request');
        $this->addSql('DROP TABLE results');
        $this->addSql('DROP TABLE users');
    }
}
