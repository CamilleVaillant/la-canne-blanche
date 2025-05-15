<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250515083631 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE fiche (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, consommable_id INT DEFAULT NULL, date VARCHAR(255) NOT NULL, INDEX IDX_4C13CC78A76ED395 (user_id), INDEX IDX_4C13CC78C9CEB381 (consommable_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE fiche ADD CONSTRAINT FK_4C13CC78A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE fiche ADD CONSTRAINT FK_4C13CC78C9CEB381 FOREIGN KEY (consommable_id) REFERENCES consommable (id)
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE commande
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE commande (id INT AUTO_INCREMENT NOT NULL, date VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, relation VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = '' 
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE fiche DROP FOREIGN KEY FK_4C13CC78A76ED395
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE fiche DROP FOREIGN KEY FK_4C13CC78C9CEB381
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE fiche
        SQL);
    }
}
