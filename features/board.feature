Feature: Board

  Scenario: Create new board when non exists unit is pulled
    Given no board exists
    When I query for initial unit by default key, profile and version
    Then new board should be created
    And new board should have initial status
    And have shards initialized
