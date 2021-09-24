Feature: Board

  Scenario: Create new board for non exist key and profile
    Given no board exists
    When I create board for by default key, profile and version
    Then new board should be created