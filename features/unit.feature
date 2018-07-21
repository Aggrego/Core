Feature: Unit

  Scenario: I want to query unit based on key
    When I query for initial unit by default key, profile and version
    Then I get initial instance of response
    And I get response mark as default profile
    And I get response as minimal version
    And I get response with initial status
    And I get response with empty body

  Scenario: I want reject query if given profile don't exist
    When I query for unit with non exist profile
    Then I get response with invalid status

  Scenario: I want reject query if version don't exist for given profile
    When I query for unit with non exist version for default profile
    Then I get response with invalid status

  Scenario: I want reject query if key don't meet specification of profile
    When I query for unit with invalid key by default specification profile
    Then I get response with invalid status