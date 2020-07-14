<?php

namespace cards;

use LogicException;
use request\Request;
use response\RequestResponse;
use validation\NumberValidator;
use validation\SkuValidator;
use validation\StringValidator;

class Controller
{
    private RequestResponse $requestResponse;
    private CardRepository $cardRepository;


    public function __construct(CardRepository $cards, RequestResponse $response)
    {
        $this->cardRepository = $cards;
        $this->requestResponse = $response;
    }

    public function cardList()
    {
        $cards = new \stdClass();
        $obtainedCards = $this->cardRepository->findCards();
        foreach ($obtainedCards as $card) {
            $cards->cards[] = $card->serialize();
        }
        $this->requestResponse->respond(true, []);
    }

    public function cardCreate(): void
    {
        $name = Request::getRequestParam("name");
        $cardnumber = Request::getRequestParam("cardnumber");
        $cardseries = Request::getRequestParam("cardseries");
        $cardperiod = Request::getRequestParam("cardperiod");
        $dateofissue = Request::getRequestParam("dateofissue");
        $dateofexpiry = Request::getRequestParam("dateofexpiry");
        $cardsum = Request::getRequestParam("cardsum");
        $statusofcard = Request::getRequestParam("statusofcard");

        $card = new Card($name, $cardnumber, $cardseries,$cardperiod,$dateofissue,$dateofexpiry, $cardsum, $statusofcard);

        try {
            $createdCard = $this->cardRepository->create($card);
        } catch (LogicException $exception) {
            $this->requestResponse->respond(false, $exception->getMessage());
            return;
        }

        if ($createdCard !== null) {
            $this->requestResponse->respond(true, $createdCard->serialize());
            return;
        }

        $this->requestResponse->respond(false, null);
    }

    public function cardUpdate(): void
    {
        $id = Request::getRequestParam("id");
        if (!NumberValidator::isValid($id)) {
            $this->requestResponse->respond(false, "Invalid input");
            return;
        }
        $foundCard = $this->cardRepository->findCard($id);
        if ($foundCard !== null) {
            $updatedCard = $this->cardRepository->update($this->updateFromRequestCard($foundCard));
            $this->requestResponse->respond(true, $updatedCard->serialize());
            return;
        } else {
            $this->requestResponse->respond(false, "Card not found");
            return;
        }
    }

    private function updateFromRequestCard(Card $card): Card
    {
        $name = Request::getRequestParam("name") ?? $card->getName();
        $cardnumber = Request::getRequestParam("cardnumber") ?? $card->getCardnumber();
        $cardseries = Request::getRequestParam("cardseries") ?? $card->getCardseries();
        $cardperiod = Request::getRequestParam("cardperiod") ?? $card->getCardperiod();
        $dateofissue = Request::getRequestParam("dateofissue") ?? $card->getDateofissue();
        $dateofexpiry = Request::getRequestParam("dateofexpiry") ?? $card->getDateofexpiry();
        $cardsum = Request::getRequestParam("cardsum") ?? $card->getCardsum();
        $statusofcard = Request::getRequestParam("statusofcard") ?? $card->getStatusofcard();

        $newCard = new Card($name,  $cardnumber, $cardseries, $cardperiod, $dateofissue, $dateofexpiry, $cardsum, $statusofcard);
        $newCard->setId($card->getId());
        $newCard->setDeleted($card->getDeleted());

        return $newCard;
    }

    public function cardDelete(): void
    {
        $id = Request::getRequestParam("id");
        if (!NumberValidator::isValid($id)) {
            $this->requestResponse->respond(false, "Invalid input");
            return;
        }
        $foundCard = $this->cardRepository->findCard($id);
        if ($foundCard !== null) {
            $this->cardRepository->delete($foundCard);
            $this->requestResponse->respond(true, "Card deleted");
            return;
        } else {
            $this->requestResponse->respond(false, "Card not found");
            return;
        }
    }
}