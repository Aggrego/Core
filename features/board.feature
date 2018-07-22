Feature: Board

#  Scenario: Create new board for non exist key and profile
#    Given no board exists
#    When I create board for by default key, profile and version
#    Then new board should be created
#    And have shards initialized

#  Scenario: I want reject create command if given profile don't exist
#    When I create for unit with non exist profile
#    Then I get response with invalid status
#
#  Scenario: I want reject create command  if version don't exist for given profile
#    When I query for unit with non exist version for default profile
#    Then I get response with invalid status
#
#  Scenario: I want reject create command  if key don't meet specification of profile
#    When I query for unit with invalid key by default specification profile
#    Then I get response with invalid status

#  Scenario: Can update board's shard
#    Given default board exists
#    When I command update default board by default integration source with test string
#    Then default board should have updated shard

#  Scenario: Can't update board's shard by other integration source
#    Given default board exists
#    When I command update default board by other integration source with test string
#    Then default board shouldn't have updated shard
