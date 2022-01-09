<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211205144628 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user_commande (user_id INT NOT NULL, commande_id INT NOT NULL, INDEX IDX_8E67427DA76ED395 (user_id), INDEX IDX_8E67427D82EA2E54 (commande_id), PRIMARY KEY(user_id, commande_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_commande ADD CONSTRAINT FK_8E67427DA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_commande ADD CONSTRAINT FK_8E67427D82EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commande ADD client_id INT DEFAULT NULL, ADD restaurant_id INT NOT NULL');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D19EB6921 FOREIGN KEY (client_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67DB1E7706E FOREIGN KEY (restaurant_id) REFERENCES restaurant (id)');
        $this->addSql('CREATE INDEX IDX_6EEAA67D19EB6921 ON commande (client_id)');
        $this->addSql('CREATE INDEX IDX_6EEAA67DB1E7706E ON commande (restaurant_id)');
        $this->addSql('ALTER TABLE ligne_de_commande ADD commande_id INT NOT NULL, ADD produit_id INT NOT NULL');
        $this->addSql('ALTER TABLE ligne_de_commande ADD CONSTRAINT FK_7982ACE682EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id)');
        $this->addSql('ALTER TABLE ligne_de_commande ADD CONSTRAINT FK_7982ACE6F347EFB FOREIGN KEY (produit_id) REFERENCES produit (id)');
        $this->addSql('CREATE INDEX IDX_7982ACE682EA2E54 ON ligne_de_commande (commande_id)');
        $this->addSql('CREATE INDEX IDX_7982ACE6F347EFB ON ligne_de_commande (produit_id)');
        $this->addSql('ALTER TABLE produit ADD restaurant_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC27B1E7706E FOREIGN KEY (restaurant_id) REFERENCES restaurant (id)');
        $this->addSql('CREATE INDEX IDX_29A5EC27B1E7706E ON produit (restaurant_id)');
        $this->addSql('ALTER TABLE user ADD responsables_id INT DEFAULT NULL, ADD liste_de_restaurant_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649592968A8 FOREIGN KEY (responsables_id) REFERENCES restaurant (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649FBB7F807 FOREIGN KEY (liste_de_restaurant_id) REFERENCES restaurant (id)');
        $this->addSql('CREATE INDEX IDX_8D93D649592968A8 ON user (responsables_id)');
        $this->addSql('CREATE INDEX IDX_8D93D649FBB7F807 ON user (liste_de_restaurant_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE user_commande');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D19EB6921');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67DB1E7706E');
        $this->addSql('DROP INDEX IDX_6EEAA67D19EB6921 ON commande');
        $this->addSql('DROP INDEX IDX_6EEAA67DB1E7706E ON commande');
        $this->addSql('ALTER TABLE commande DROP client_id, DROP restaurant_id');
        $this->addSql('ALTER TABLE ligne_de_commande DROP FOREIGN KEY FK_7982ACE682EA2E54');
        $this->addSql('ALTER TABLE ligne_de_commande DROP FOREIGN KEY FK_7982ACE6F347EFB');
        $this->addSql('DROP INDEX IDX_7982ACE682EA2E54 ON ligne_de_commande');
        $this->addSql('DROP INDEX IDX_7982ACE6F347EFB ON ligne_de_commande');
        $this->addSql('ALTER TABLE ligne_de_commande DROP commande_id, DROP produit_id');
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC27B1E7706E');
        $this->addSql('DROP INDEX IDX_29A5EC27B1E7706E ON produit');
        $this->addSql('ALTER TABLE produit DROP restaurant_id');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649592968A8');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649FBB7F807');
        $this->addSql('DROP INDEX IDX_8D93D649592968A8 ON user');
        $this->addSql('DROP INDEX IDX_8D93D649FBB7F807 ON user');
        $this->addSql('ALTER TABLE user DROP responsables_id, DROP liste_de_restaurant_id');
    }
}
