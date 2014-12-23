Feature: I would like to edit mercedes

  Scenario Outline: Insert records
    When I go to "/admin/mercedes"
    Then I should not see "<mercedes>"
    And I follow "Create a new entry"
    Then I should see "mercedes creation"
    When I fill in "Name" with "<mercedes>"
    And I fill in "Length" with "<length>"
    And I press "Create"
    Then I should see "<mercedes>"
    And I should see "<length>"

  Examples:
    |    mercedes    | length |
    | Fiat         | 452   |
    | Laguna     | 124   |
    | Polonez  | 621    |
    | Audi       | 50      |



  Scenario Outline: Edit records
    When I go to "/admin/mercedes"
    Then I should not see "<new-mercedes>"
    And I follow "<old-mercedes>"
    Then I should see "<old-mercedes>"
    When I follow "Edit"
    When I fill in "Name" with "<new-mercedes>"
    And I fill in "Length" with "<new-length>"
    And I press "Update"
    And I follow "Back to the list"
    Then I should see "<new-mercedes>"
    And I should see "<new-length>"
    And I should not see "<old-mercedes>"

  Examples:
    |  old-mercedes    |    new-mercedes    | new-length |
    | Laguna       | Rover        | 9876       |
    | Fiat         | Alfa Romeo  | 3333       |




  Scenario Outline: Delete records
    When I go to "/admin/mercedes"
    Then I should see "<mercedes>"
    And I follow "<mercedes>"
    Then I should see "<mercedes>"
    When I press "Delete"
    And I should not see "<mercedes>"

  Examples:
    |  mercedes    |
    | Polonez     |
    | Audi       |




  Scenario: I want to check the number of records
    When I go to "/admin/mercedes"
    Then I should see 3 ".records_list tbody tr" elements