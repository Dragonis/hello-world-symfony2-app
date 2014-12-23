Feature: I would like to edit cars

  Scenario Outline: Insert records
    When I go to "/admin/car"
    Then I should not see "<car>"
    And I follow "Create a new entry"
    Then I should see "car creation"
    When I fill in "Name" with "<car>"
    And I fill in "Length" with "<length>"
    And I press "Create"
    Then I should see "<car>"
    And I should see "<length>"

  Examples:
    |    car    | length |
    | Fiar         | 452   |
    | Mercedes     | 124   |
    | Polonez  | 621    |
    | Audi       | 50      |



  Scenario Outline: Edit records
    When I go to "/admin/car"
    Then I should not see "<new-car>"
    And I follow "<old-car>"
    Then I should see "<old-car>"
    When I follow "Edit"
    When I fill in "Name" with "<new-car>"
    And I fill in "Length" with "<new-length>"
    And I press "Update"
    And I follow "Back to the list"
    Then I should see "<new-car>"
    And I should see "<new-length>"
    And I should not see "<old-car>"

  Examples:
    |  old-car    |    new-car    | new-length |
    | Mercedes       | Mercedes Benz        | 9876       |
    | Fiat         | Alfa Romeo  | 3333       |




  Scenario Outline: Delete records
    When I go to "/admin/car"
    Then I should see "<car>"
    And I follow "<car>"
    Then I should see "<car>"
    When I press "Delete"
    And I should not see "<car>"

  Examples:
    |  car    |
    | Polonez     |
    | Audi       |




  Scenario: I want to check the number of records
    When I go to "/admin/car"
    Then I should see 3 ".records_list tbody tr" elements