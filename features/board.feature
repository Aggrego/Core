Feature: Board

  Scenario: Create new board for non exist key and profile
    Given no board exists
    When I create board for by default key, profile and version
    Then new board should be created

  Scenario: I want reject create command if given profile don't exist
    When I create board with non exist profile
    Then create command should be rejected

  Scenario: I want reject create command  if version don't exist for given profile
    When I create board with non exist version for default profile
    Then create command should be rejected

  Scenario: I want reject create command  if key don't meet specification of profile
    When I create board with invalid key for default profile
    Then create command should be rejected

#  Scenario: Can update board's shard
#    Given default board exists
#    When I command update default board by default integration source with test string
#    Then default board should have updated shards
#
#  Scenario: Can't update board's shard by other integration source
#    Given default board exists
#    When I command update default board by other integration source with test string
#    Then update command should be rejected
#    And default board shouldn't have updated shards
#
#  Scenario: Can't update board's shard twice
#    Given default board exists
#    And I command update default board by default integration source with test string
#    When I command update default board by default integration source with test string
#    Then update command should be rejected
#
#  Scenario: Can transform from initial to final state
#    Given default board fully updated exist
#    When I command transform default board
#    And board should be in final state
#
#  Scenario: Only finished boards should be transformed
#    Given default board exists
#    When I command transform default board
#    Then transform command should be rejected
#
#  Scenario: Can transform from initial to different state
#
#  Scenario: Can transform from different to another state
#
#  Scenario: Can transform from another to final state
#
