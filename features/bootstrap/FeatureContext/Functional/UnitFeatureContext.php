<?php

declare(strict_types = 1);

namespace FeatureContext\Functional;

use Assert\Assertion;
use Behat\Behat\Context\Context;
use TimiTao\Construo\Domain\ValueObject\Status;
use TimiTao\Construo\Domain\Query\GetUnit\Query as GetUnitQuery;
use TimiTao\Construo\Domain\Query\GetUnit\Response as GetUnitResponse;
use TimiTao\Construo\Domain\Query\GetUnit\UseCase as GetUnitUseCase;

class UnitFeatureContext implements Context
{
    /** @var GetUnitUseCase */
    private $getUnitUseCase;

    /** @var GetUnitResponse */
    private $response;

    public function __construct(GetUnitUseCase $getUnitUseCase)
    {
        $this->getUnitUseCase = $getUnitUseCase;
    }

    /**
     * @When I query for initial unit by default key, profile and version
     */
    public function iQueryForInitialUnit()
    {
        $this->response = $this->getUnitUseCase->handle(
            new GetUnitQuery(
                BoardFeatureContext::DEFAULT_KEY,
                ProfileFeatureContext::DEFAULT_PROFILE,
                ProfileFeatureContext::DEFAULT_VERSION
            )
        );
    }

    /**
     * @Then I get initial instance of response
     */
    public function iWillInitialInstanceOfUnit()
    {
        Assertion::isInstanceOf($this->response, GetUnitResponse::class);
    }

    /**
     * @Then I get response mark as default profile
     */
    public function iWillGetResponseMarkAsDefaultProfile()
    {
        Assertion::eq(ProfileFeatureContext::DEFAULT_PROFILE, $this->response->getProfileName());
    }

    /**
     * @Then I get response as minimal version
     */
    public function iWillGetResponseAsMinimalVersion()
    {
        Assertion::eq(ProfileFeatureContext::DEFAULT_VERSION, $this->response->getVersionNumber());
    }

    /**
     * @Then I get response with initial status
     */
    public function iWillGetResponseWithInitialStatus()
    {
        Assertion::eq(Status::INITIAL, $this->response->getStatus());
    }

    /**
     * @When I query for unit with invalid key by default specification profile
     */
    public function iQueryForUnitWithInvalidKey()
    {
        $this->response = $this->getUnitUseCase->handle(
            new GetUnitQuery(
                ['invalid' => 'init'],
                'test_false',
                ProfileFeatureContext::DEFAULT_VERSION
            )
        );
    }

    /**
     * @Then I get response with invalid status
     */
    public function iGetResponseWithInvalidStatus()
    {
        Assertion::eq(Status::INVALID, $this->response->getStatus());
    }

    /**
     * @When I query for unit with non exist profile
     */
    public function iQueryForUnitWithNonExistProfile()
    {
        $this->response = $this->getUnitUseCase->handle(
            new GetUnitQuery(
                BoardFeatureContext::DEFAULT_KEY,
                'invalid profile',
                ProfileFeatureContext::DEFAULT_VERSION
            )
        );
    }
    /**
     * @When I query for unit with non exist version for default profile
     */
    public function iQueryForUnitWithNonExistVersionForDefaultProfile()
    {
        $this->response = $this->getUnitUseCase->handle(
            new GetUnitQuery(
                BoardFeatureContext::DEFAULT_KEY,
                ProfileFeatureContext::DEFAULT_PROFILE,
                'non exist version'
            )
        );
    }

    /**
     * @Then I get response with empty body
     */
    public function iGetResponseWithEmptyBody()
    {
        Assertion::length($this->response->getBody(), 0);
    }

}
