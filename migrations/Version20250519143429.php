<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250519143429 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE style (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE style_user (style_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_E21FA7B8BACD6074 (style_id), INDEX IDX_E21FA7B8A76ED395 (user_id), PRIMARY KEY(style_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE style_user ADD CONSTRAINT FK_E21FA7B8BACD6074 FOREIGN KEY (style_id) REFERENCES style (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE style_user ADD CONSTRAINT FK_E21FA7B8A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE user ADD image_name VARCHAR(255) DEFAULT NULL, ADD updated_at DATETIME DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)'
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE style_user DROP FOREIGN KEY FK_E21FA7B8BACD6074
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE style_user DROP FOREIGN KEY FK_E21FA7B8A76ED395
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE style
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE style_user
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE user DROP image_name, DROP updated_at
        SQL);
    }
}
