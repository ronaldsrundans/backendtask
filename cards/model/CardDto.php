<?php

namespace cards;

class CardDto
{
    public int $id;
    public string $name;
    private int $cardnumber;
    private string $cardseries;
    private int $cardperiod;
    private string $dateofissue;
    private string $dateofexpiry;
    private int $cardsum;
    private string $statusofcard;
}