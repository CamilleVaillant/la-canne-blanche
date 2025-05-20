<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250520080352 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE fiche DROP FOREIGN KEY FK_4C13CC78A76ED395
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE fiche DROP FOREIGN KEY FK_4C13CC78C9CEB381
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE consommable
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE fiche
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE user ADD image_name VARCHAR(255) DEFAULT NULL, ADD updated_at DATETIME DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)'
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE consommable (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, quantité VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, detail VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = '' 
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE fiche (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, consommable_id INT DEFAULT NULL, date VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_4C13CC78A76ED395 (user_id), INDEX IDX_4C13CC78C9CEB381 (consommable_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = '' 
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE fiche ADD CONSTRAINT FK_4C13CC78A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE fiche ADD CONSTRAINT FK_4C13CC78C9CEB381 FOREIGN KEY (consommable_id) REFERENCES consommable (id) ON UPDATE NO ACTION ON DELETE NO ACTION
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE user DROP image_name, DROP updated_at
        SQL);
    }
}
