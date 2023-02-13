<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230212163453 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE item (id INT AUTO_INCREMENT NOT NULL, type_id INT NOT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_1F1B251EC54C8C93 (type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rpgclass (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, base_health VARCHAR(255) NOT NULL, base_force VARCHAR(255) NOT NULL, base_dext VARCHAR(255) NOT NULL, base_const VARCHAR(255) NOT NULL, base_intell VARCHAR(255) NOT NULL, base_wisdom VARCHAR(255) NOT NULL, base_charisma VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE allowed_items (rpgclass_id INT NOT NULL, item_id INT NOT NULL, INDEX IDX_22BFF3958CA0E752 (rpgclass_id), INDEX IDX_22BFF395126F525E (item_id), PRIMARY KEY(rpgclass_id, item_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE starting_items (rpgclass_id INT NOT NULL, item_id INT NOT NULL, INDEX IDX_76B744938CA0E752 (rpgclass_id), INDEX IDX_76B74493126F525E (item_id), PRIMARY KEY(rpgclass_id, item_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, attributes VARCHAR(8192) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE item ADD CONSTRAINT FK_1F1B251EC54C8C93 FOREIGN KEY (type_id) REFERENCES type (id)');
        $this->addSql('ALTER TABLE allowed_items ADD CONSTRAINT FK_22BFF3958CA0E752 FOREIGN KEY (rpgclass_id) REFERENCES rpgclass (id)');
        $this->addSql('ALTER TABLE allowed_items ADD CONSTRAINT FK_22BFF395126F525E FOREIGN KEY (item_id) REFERENCES item (id)');
        $this->addSql('ALTER TABLE starting_items ADD CONSTRAINT FK_76B744938CA0E752 FOREIGN KEY (rpgclass_id) REFERENCES rpgclass (id)');
        $this->addSql('ALTER TABLE starting_items ADD CONSTRAINT FK_76B74493126F525E FOREIGN KEY (item_id) REFERENCES item (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE item DROP FOREIGN KEY FK_1F1B251EC54C8C93');
        $this->addSql('ALTER TABLE allowed_items DROP FOREIGN KEY FK_22BFF3958CA0E752');
        $this->addSql('ALTER TABLE allowed_items DROP FOREIGN KEY FK_22BFF395126F525E');
        $this->addSql('ALTER TABLE starting_items DROP FOREIGN KEY FK_76B744938CA0E752');
        $this->addSql('ALTER TABLE starting_items DROP FOREIGN KEY FK_76B74493126F525E');
        $this->addSql('DROP TABLE item');
        $this->addSql('DROP TABLE rpgclass');
        $this->addSql('DROP TABLE allowed_items');
        $this->addSql('DROP TABLE starting_items');
        $this->addSql('DROP TABLE type');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
