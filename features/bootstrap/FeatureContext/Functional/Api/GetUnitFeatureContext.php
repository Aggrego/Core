<?php

declare(strict_types = 1);

namespace FeatureContext\Functional\Api;

use Assert\Assertion;
use Behat\Behat\Context\Context;
use Tests\Profile\BaseTestWatchman;
use Tests\Profile\KeySpecification\Specification;
use Aggrego\Domain\Api\Query\GetUnit\Query;
use Aggrego\Domain\Api\Query\GetUnit\Response;
use Aggrego\Domain\Api\Query\GetUnit\UseCase;

class GetUnitFeatureContext implements Context
{
    /** @var UseCase */
    private $useCase;

    /** @var Response */
    private $response;

    public function __construct(UseCase $UseCase)
    {
        $this->useCase = $UseCase;
    }

    /**
     * @When I query for initial unit by default key, profile and version
     */
    public function iQueryForInitialUnit()
    {
        $this->response = $this->useCase->handle(
            new Query(
                Specification::DEFAULT_KEY,
                BaseTestWatchman::DEFAULT_PROFILE,
                BaseTestWatchman::DEFAULT_VERSION
            )
        );
    }

    /**
     * @When I query for unit with invalid key by default specification profile
     */
    public function iQueryForUnitWithInvalidKey()
    {
        $this->response = $this->useCase->handle(
            new Query(
                ['invalid' => 'init'],
                'test_false',
                BaseTestWatchman::DEFAULT_VERSION
            )
        );
    }

    /**
     * @When I query for unit with non exist profile
     */
    public function iQueryForUnitWithNonExistProfile()
    {
        $this->response = $this->useCase->handle(
            new Query(
                Specification::DEFAULT_KEY,
                'invalid profile',
                BaseTestWatchman::DEFAULT_VERSION
            )
        );
    }

    /**
     * @When I query for unit with non exist version for default profile
     */
    public function iQueryForUnitWithNonExistVersionForDefaultProfile()
    {
        $this->response = $this->useCase->handle(
            new Query(
                Specification::DEFAULT_KEY,
                BaseTestWatchman::DEFAULT_PROFILE,
                'non exist version'
            )
        );
    }

    /**
     * @Then I get initial instance of response
     */
    public function iWillInitialInstanceOfUnit()
    {
        Assertion::isInstanceOf($this->response, Response::class);
    }

    /**
     * @Then I get unit response mark as default profile
     */
    public function iWillGetResponseMarkAsDefaultProfile()
    {
        Assertion::eq(BaseTestWatchman::DEFAULT_PROFILE, $this->response->getProfileName());
    }

    /**
     * @Then I get unit response as minimal version
     */
    public function iWillGetResponseAsMinimalVersion()
    {
        Assertion::eq(BaseTestWatchman::DEFAULT_VERSION, $this->response->getVersionNumber());
    }

    /**
     * @Then I get unit response with done status
     */
    public function iWillGetResponseWithInitialStatus()
    {
        Assertion::eq(Response::DONE, $this->response->getStatus());
    }

    /**
     * @Then I get unit response with invalid status
     */
    public function iGetResponseWithInvalidStatus()
    {
        Assertion::eq(Response::INVALID, $this->response->getStatus());
    }

    /**
     * @Then I get unit response with empty body
     */
    public function iGetResponseWithEmptyBody()
    {
        Assertion::length($this->response->getBody(), 0);
    }

    /**
     * @Then I get unit response with transformed default body
     */
    public function iGetUnitResponseWithTransformedDefaultBody()
    {
        $expectedBody = sprintf(
            '%s %s ',
            UpdateBoardFeatureContext::DEFAULT_DATA_UPDATE,
            UpdateBoardFeatureContext::DEFAULT_DATA_UPDATE
        );

        Assertion::eq($this->response->getBody(), $expectedBody);
    }

}
