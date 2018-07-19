<?php

use Assert\Assertion;
use Behat\Behat\Context\Context;
use TimiTao\Construo\Domain\Model\Unit\Entity\Unit;
use TimiTao\Construo\Domain\Model\Unit\ValueObject\Key;
use TimiTao\Construo\Domain\Query\GetUnit\Query as GetUnitQuery;
use TimiTao\Construo\Domain\Query\GetUnit\Response as GetUnitResponse;
use TimiTao\Construo\Domain\Query\GetUnit\UseCase as GetUnitUseCase;

class DomainFeatureContext implements Context
{
    private const DEFAULT_KEY = ['init'];
    private const DEFAULT_PROFILE = 'test';
    private const DEFAULT_VERSION = '1.0.0';

    private const INITIAL_STATUS = 'initial';

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
     * @When I query for initial unit by default key, profile and version
     */
    public function iQueryForInitialUnit()
    {
        $this->response = $this->getUnitUseCase->handle(
            new GetUnitQuery(self::DEFAULT_KEY, self::DEFAULT_PROFILE, self::DEFAULT_VERSION)
        );
    }

    /**
     * @Then I will get initial instance of response
     */
    public function iWillInitialInstanceOfUnit()
    {
        Assertion::isInstanceOf($this->response, GetUnitResponse::class);
    }

    /**
     * @Then I will get response mark as default profile
     */
    public function iWillGetResponseMarkAsDefaultProfile()
    {
        Assertion::eq(self::DEFAULT_PROFILE, $this->response->getProfileName());
    }

    /**
     * @Then I will get response as minimal version
     */
    public function iWillGetResponseAsMinimalVersion()
    {
        Assertion::eq(self::DEFAULT_VERSION, $this->response->getVersionNumber());
    }

    /**
     * @Then I will get response with initial status
     */
    public function iWillGetResponseWithInitialStatus()
    {
        Assertion::eq(self::INITIAL_STATUS, $this->response->getStatus());
    }

}
