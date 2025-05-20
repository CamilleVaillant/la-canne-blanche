<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250520082648 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE type_user (type_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_5A9C1341C54C8C93 (type_id), INDEX IDX_5A9C1341A76ED395 (user_id), PRIMARY KEY(type_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE type_user ADD CONSTRAINT FK_5A9C1341C54C8C93 FOREIGN KEY (type_id) REFERENCES type (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE type_user ADD CONSTRAINT FK_5A9C1341A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE type_user DROP FOREIGN KEY FK_5A9C1341C54C8C93
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE type_user DROP FOREIGN KEY FK_5A9C1341A76ED395
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE type
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE type_user
        SQL);
    }
}
