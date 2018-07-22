Feature: Unit

  Scenario: I want to query unit based on key
    When I query for initial unit by default key, profile and version
    Then I get initial instance of response
    And I get response mark as default profile
    And I get response as minimal version
    And I get response with initial status
    And I get response with empty body