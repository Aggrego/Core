Feature: Unit

  Scenario: I want to query unit based on key
    Given I have initial unit
    When I query for initial unit with default key
    Then I will initial instance of response