Feature: Unit

  Scenario: I want to query unit based on data that don't exist
    When I query for initial unit by default key, profile and version
    Then I get initial instance of response
    And I get unit response mark as default profile
    And I get unit response as minimal version
    And I get unit response with invalid status
    And I get unit response with empty body

    Scenario: I want to get unit that is transformed from final board
      Given default board fully updated exist
      And I command transform default board
      When I query for initial unit by default key, profile and version
      Then I get initial instance of response
      And I get unit response mark as default profile
      And I get unit response as minimal version
      And I get unit response with done status
      And I get unit response with transformed default body