<?php

use Assert\Assertion;
use Behat\Behat\Context\Context;
use Behat\Behat\Tester\Exception\PendingException;
use TimiTao\Construo\Domain\Model\Unit\Entity\Unit;
use TimiTao\Construo\Domain\Model\Unit\ValueObject\Key;
use TimiTao\Construo\Domain\Query\GetUnit\Query as GetUnitQuery;
use TimiTao\Construo\Domain\Query\GetUnit\Response as GetUnitResponse;
use TimiTao\Construo\Domain\Query\GetUnit\UseCase as GetUnitUseCase;

class DomainFeatureContext implements Context
{
    private const DEFAULT_KEY = ['init'];

    /** @var Unit */
    private $unit;

    /** @var GetUnitUseCase */
    private $getUnitUseCase;

    /** @var GetUnitResponse */
    private $response;

    public function __construct(GetUnitUseCase $getUnitUseCase)
    {
        $this->getUnitUseCase = $getUnitUseCase;
    }


    /**
     * @Given I have initial unit
     */
    public function iHaveInitialUnit()
    {
        $this->unit = new Unit(new Key(self::DEFAULT_KEY));
    }

    /**
     * @When I query for initial unit with default key
     */
    public function iQueryForInitialUnit()
    {
        $this->response = $this->getUnitUseCase->handle(new GetUnitQuery(self::DEFAULT_KEY));
    }

    /**
     * @Then I will initial instance of response
     */
    public function iWillInitialInstanceOfUnit()
    {
        Assertion::isInstanceOf($this->response, GetUnitResponse::class);
    }
}
