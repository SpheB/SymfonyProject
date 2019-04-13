<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190413132716 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE concours (id INT AUTO_INCREMENT NOT NULL, gagnant_id INT DEFAULT NULL, theme VARCHAR(100) NOT NULL, date_debut DATETIME NOT NULL, date_fin DATETIME NOT NULL, comment_concours VARCHAR(500) DEFAULT NULL, INDEX IDX_4FAE51962F942B8 (gagnant_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE concours_look (concours_id INT NOT NULL, look_id INT NOT NULL, INDEX IDX_FFEF3DCED11E3C7 (concours_id), INDEX IDX_FFEF3DCE469DC8DC (look_id), PRIMARY KEY(concours_id, look_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fan (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, pseudo VARCHAR(50) NOT NULL, avatar VARCHAR(255) DEFAULT NULL, is_admin TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_65F77839E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fan_comment (id INT AUTO_INCREMENT NOT NULL, id_look_id INT DEFAULT NULL, id_fan_id INT NOT NULL, text_comment LONGTEXT NOT NULL, date_comment DATETIME NOT NULL, INDEX IDX_FC7CB497980061AC (id_look_id), INDEX IDX_FC7CB497AFF33AE6 (id_fan_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE look (id INT AUTO_INCREMENT NOT NULL, id_style_id INT DEFAULT NULL, picture VARCHAR(255) DEFAULT NULL, likes INT DEFAULT NULL, description VARCHAR(500) DEFAULT NULL, INDEX IDX_2B3AD402EA168CE1 (id_style_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE news (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(50) NOT NULL, text_news LONGTEXT NOT NULL, date_news DATETIME DEFAULT NULL, picture_news VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE style (id INT AUTO_INCREMENT NOT NULL, type_style VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vote (id INT AUTO_INCREMENT NOT NULL, id_concours_id INT DEFAULT NULL, id_fan_id INT NOT NULL, date_vote DATETIME NOT NULL, INDEX IDX_5A10856415032E30 (id_concours_id), INDEX IDX_5A108564AFF33AE6 (id_fan_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE concours ADD CONSTRAINT FK_4FAE51962F942B8 FOREIGN KEY (gagnant_id) REFERENCES look (id)');
        $this->addSql('ALTER TABLE concours_look ADD CONSTRAINT FK_FFEF3DCED11E3C7 FOREIGN KEY (concours_id) REFERENCES concours (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE concours_look ADD CONSTRAINT FK_FFEF3DCE469DC8DC FOREIGN KEY (look_id) REFERENCES look (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE fan_comment ADD CONSTRAINT FK_FC7CB497980061AC FOREIGN KEY (id_look_id) REFERENCES look (id)');
        $this->addSql('ALTER TABLE fan_comment ADD CONSTRAINT FK_FC7CB497AFF33AE6 FOREIGN KEY (id_fan_id) REFERENCES fan (id)');
        $this->addSql('ALTER TABLE look ADD CONSTRAINT FK_2B3AD402EA168CE1 FOREIGN KEY (id_style_id) REFERENCES style (id)');
        $this->addSql('ALTER TABLE vote ADD CONSTRAINT FK_5A10856415032E30 FOREIGN KEY (id_concours_id) REFERENCES concours (id)');
        $this->addSql('ALTER TABLE vote ADD CONSTRAINT FK_5A108564AFF33AE6 FOREIGN KEY (id_fan_id) REFERENCES fan (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE concours_look DROP FOREIGN KEY FK_FFEF3DCED11E3C7');
        $this->addSql('ALTER TABLE vote DROP FOREIGN KEY FK_5A10856415032E30');
        $this->addSql('ALTER TABLE fan_comment DROP FOREIGN KEY FK_FC7CB497AFF33AE6');
        $this->addSql('ALTER TABLE vote DROP FOREIGN KEY FK_5A108564AFF33AE6');
        $this->addSql('ALTER TABLE concours DROP FOREIGN KEY FK_4FAE51962F942B8');
        $this->addSql('ALTER TABLE concours_look DROP FOREIGN KEY FK_FFEF3DCE469DC8DC');
        $this->addSql('ALTER TABLE fan_comment DROP FOREIGN KEY FK_FC7CB497980061AC');
        $this->addSql('ALTER TABLE look DROP FOREIGN KEY FK_2B3AD402EA168CE1');
        $this->addSql('DROP TABLE concours');
        $this->addSql('DROP TABLE concours_look');
        $this->addSql('DROP TABLE fan');
        $this->addSql('DROP TABLE fan_comment');
        $this->addSql('DROP TABLE look');
        $this->addSql('DROP TABLE news');
        $this->addSql('DROP TABLE style');
        $this->addSql('DROP TABLE vote');
    }
}
