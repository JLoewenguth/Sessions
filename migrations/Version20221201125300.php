<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221201125300 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE programme ADD cours_id INT NOT NULL, ADD sessions_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE programme ADD CONSTRAINT FK_3DDCB9FF7ECF78B0 FOREIGN KEY (cours_id) REFERENCES cours (id)');
        $this->addSql('ALTER TABLE programme ADD CONSTRAINT FK_3DDCB9FFF17C4D8C FOREIGN KEY (sessions_id) REFERENCES session (id)');
        $this->addSql('CREATE INDEX IDX_3DDCB9FF7ECF78B0 ON programme (cours_id)');
        $this->addSql('CREATE INDEX IDX_3DDCB9FFF17C4D8C ON programme (sessions_id)');
        $this->addSql('ALTER TABLE user ADD sessions_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649F17C4D8C FOREIGN KEY (sessions_id) REFERENCES session (id)');
        $this->addSql('CREATE INDEX IDX_8D93D649F17C4D8C ON user (sessions_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE programme DROP FOREIGN KEY FK_3DDCB9FF7ECF78B0');
        $this->addSql('ALTER TABLE programme DROP FOREIGN KEY FK_3DDCB9FFF17C4D8C');
        $this->addSql('DROP INDEX IDX_3DDCB9FF7ECF78B0 ON programme');
        $this->addSql('DROP INDEX IDX_3DDCB9FFF17C4D8C ON programme');
        $this->addSql('ALTER TABLE programme DROP cours_id, DROP sessions_id');
        $this->addSql('ALTER TABLE `user` DROP FOREIGN KEY FK_8D93D649F17C4D8C');
        $this->addSql('DROP INDEX IDX_8D93D649F17C4D8C ON `user`');
        $this->addSql('ALTER TABLE `user` DROP sessions_id');
    }
}
