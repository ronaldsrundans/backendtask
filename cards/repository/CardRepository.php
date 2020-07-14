<?php

namespace cards;

interface CardRepository
{
    function findCards(): array;

    function findCard(int $id): ?Card;

    function create(Card $card): ?Card;

    function update(Card $card): ?Card;

    function delete(Card $card): ?Card;
}