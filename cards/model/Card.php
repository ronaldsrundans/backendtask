<?php

namespace cards;

class Card
{
    private int $id;
    private bool $deleted;
    private int $cardnumber; //(kartes numurs)
    private string $cardseries; //(kartes tips)
    private int $cardperiod; //(kartes periods)
    private string $dateofissue; //(izdošanas datums)
    private string $dateofexpiry; //(beigu datums)
    private int $cardsum; //(kartes naudas summa)
    private string $statusofcard; //(active/not active/expired)
    private string $name;

    public function __construct(string $name, int $cardnumber,string $cardseries, int $cardperiod, string $dateofissue, string $dateofexpiry, int $cardsum, string $statusofcard)
    {
        $this->cardnumber = $cardnumber;
        $this->cardseries = $cardseries;
        $this->cardperiod = $cardperiod;
        $this->dateofissue = $dateofissue;
        $this->dateofexpiry = $dateofexpiry;
        $this->cardsum = $cardsum;
        $this->statusofcard = $statusofcard;
        $this->name = $name;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }
    public function getName(): string
    {
        return $this->name;
    }

    public function getCardnumber(): int
    {
        return $this->cardnumber;
    }

    public function getCardseries(): string
    {
        return $this->cardseries;
    }

    public function getCardperiod(): int
    {
        return $this->cardperiod;
    }

    public function getDateofissue(): string
    {
        return $this->dateofissue;
    }

    public function getDateofexpiry(): string
    {
        return $this->dateofexpiry;
    }

    public function getCardsum(): int
    {
        return $this->cardsum;
    }

    public function getStatusofcard(): string
    {
        return $this->statusofcard;
    }

    public function getDeleted(): bool
    {
        return $this->deleted;
    }

    public function setDeleted(bool $deleted): void
    {
        $this->deleted = $deleted;
    }

    public function __toString()
    {
        return "Card: " . $this->name;
    }

    public function serialize(): CardDto
    {
        $cardDto = new CardDto();
        $cardDto->id = $this->id;
        $cardDto->name = $this->name;
        $cardDto->cardnumber = $this->cardnumber;
        $cardDto->cardseries = $this->cardseries;
        $cardDto->cardperiod = $this->cardperiod;
        $cardDto->dateofissue = $this->dateofissue;
        $cardDto->dateofexpiry = $this->dateofexpiry;
        $cardDto->cardsum = $this->cardsum;
        $cardDto->statusofcard = $this->statusofcard;

        return $cardDto;
    }

}