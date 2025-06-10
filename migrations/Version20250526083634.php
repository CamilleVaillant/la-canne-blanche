<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250526083634 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE user_type (user_id INT NOT NULL, type_id INT NOT NULL, INDEX IDX_F65F1BE0A76ED395 (user_id), INDEX IDX_F65F1BE0C54C8C93 (type_id), PRIMARY KEY(user_id, type_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE user_type ADD CONSTRAINT FK_F65F1BE0A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE user_type ADD CONSTRAINT FK_F65F1BE0C54C8C93 FOREIGN KEY (type_id) REFERENCES type (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE type_user DROP FOREIGN KEY FK_5A9C1341A76ED395
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE type_user DROP FOREIGN KEY FK_5A9C1341C54C8C93
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE type_user
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE type_user (type_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_5A9C1341A76ED395 (user_id), INDEX IDX_5A9C1341C54C8C93 (type_id), PRIMARY KEY(type_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = '' 
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE type_user ADD CONSTRAINT FK_5A9C1341A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE type_user ADD CONSTRAINT FK_5A9C1341C54C8C93 FOREIGN KEY (type_id) REFERENCES type (id) ON UPDATE NO ACTION ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE user_type DROP FOREIGN KEY FK_F65F1BE0A76ED395
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE user_type DROP FOREIGN KEY FK_F65F1BE0C54C8C93
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE user_type
        SQL);
    }
}
