Feature: Unit

  Background:
    Given I have initial unit

  Scenario: I want to query unit based on key
    When I query for initial unit by default key, profile and version
    Then I will get initial instance of response
    And I will get response mark as default profile
    And I will get response as minimal version
    And I will get response with initial status