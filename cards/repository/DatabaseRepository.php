<?php

namespace cards;

use database\Database;
use LogicException;

require_once("cards/repository/CardRepository.php");

class DatabaseRepository implements CardRepository
{
    const TABLE_NAME = "cards";
    private Database $database;

    public function __construct()
    {
        $this->database = Database::getInstance();
    }

    public function findCard(int $id): ?Card
    {
        $where = [
            ["name" => "id", "operation" => "=", "val" => $id]
        ];
        $cardFromDb = $this->database->selectAllWhere(self::TABLE_NAME, $where);
        return empty($cardFromDb) ? null : $this->transformDbRowToCard($cardFromDb[0]);
    }

    public function findCards(): array
    {
        $result = [];
        $dbCards = $this->database->selectAll(self::TABLE_NAME);
        foreach ($dbCards as $dbCard) {
            $result[] = $this->transformDbRowToCard($dbCard);
        }

        return $result;
    }

    public function create(Card $card): ?Card
    {
        $data = [
            /*["val" => $card->getName(), "type" => "char"],
            ["val" => $card->getPrice(), "type" => "int"],
            ["val" => $card->getSku(), "type" => "char"],*/
            ["val" => $card->getName(), "type" => "char"],
            ["val" => $card->getCardnumber(), "type" => "int"],
            ["val" => $card->getCardseries(), "type" => "char"],
            ["val" => $card->getCardperiod(), "type" => "int"],
            ["val" => $card->getDateofissue(), "type" => "char"],
            ["val" => $card->getDateofexpiry(), "type" => "char"],
            ["val" => $card->getCardsum(), "type" => "int"],
            ["val" => $card->getStatusofcard(), "type" => "char"],

        ];
        //$fields = ["name", "price", "sku"];
        $fields = ["name", "cardnumber", "cardseries","cardperiod","dateofissue","dateofexpiry","cardsum", "statusofcard"];

        $isInserted = $this->database->insertInto(self::TABLE_NAME, $data, $fields);
        if (!$isInserted) {
            throw new LogicException("Card already exists!");
        }
        $where = [
            ["name" => "sku", "operation" => "=", "val" => $card->getName()]
        ];
        $cardFromDb = $this->database->selectAllWhere(self::TABLE_NAME, $where);

        return empty($cardFromDb) ? null : $this->transformDbRowToCard($cardFromDb[0]);
    }

    private function transformDbRowToCard(array $dbCard): Card
    {
        $card = new Card($dbCard["name"], $dbCard[""], $dbCard["sku"]);
        $card->setId($dbCard["id"]);
        $card->setDeleted($dbCard["deleted"]);

        return $card;
    }

    public function update(Card $card): ?Card
    {
        $data = [
            ["name" => "name", "val" => $card->getName()],
            /*["name" => "price", "val" => $card->getPrice()],
            ["name" => "sku", "val" => $card->getSku()],*/
            ["name" => "cardnumber", "val" => $card->getCardnumber()],
            ["name" => "cardseries", "val" => $card->getCardseries()],
            ["name" => "cardperiod", "val" => $card->getCardperiod()],
            ["name" => "dateofissue", "val" => $card->getDateofissue()],
            ["name" => "dateofexpiry", "val" => $card->getDateofexpiry()],
            ["name" => "cardsum", "val" => $card->getCardsum()],
            ["name" => "statusofcard", "val" => $card->getStatusofcard()],
        ];
        $this->database->update(self::TABLE_NAME, $data, $card->getId());

        $where = [
            ["name" => "id", "operation" => "=", "val" => $card->getId()]
        ];
        $cardFromDb = $this->database->selectAllWhere(self::TABLE_NAME, $where);

        return empty($cardFromDb) ? null : $this->transformDbRowToCard($cardFromDb[0]);
    }

    public function delete(Card $card): ?Card
    {
        $data = [
            ["name" => "deleted", "val" => 1],
        ];
        $this->database->update(self::TABLE_NAME, $data, $card->getId());

        $where = [
            ["name" => "id", "operation" => "=", "val" => $card->getId()]
        ];
        $cardFromDb = $this->database->selectAllWhere(self::TABLE_NAME, $where);

        return empty($cardFromDb) ? null : $this->transformDbRowToCard($cardFromDb[0]);
    }

    public function isNotDeleted(array $dbCard): bool
    {
        return !$dbCard["deleted"];
    }
}