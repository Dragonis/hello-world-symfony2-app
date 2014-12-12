Feature: I would like to edit oceans

  Scenario Outline: Insert records
    When I go to "/ocean"
    Then I should not see "<ocean>"
     And I follow "Create a new entry"
    Then I should see "Ocean creation"
    When I fill in "Name" with "<ocean>"
     And I fill in "Length" with "<length>"
     And I press "Create"
    Then I should see "<ocean>"
     And I should see "<length>"

  Examples:
    |    ocean            | length |
    | Pacific Ocean    | 7182   |
    | Atlantic Ocean | 1122   |
    | Indian Ocean | 2428 |
    | Arctic Ocean| 1872 |
    | Southern Ocean aka Antarctic Ocean | 4465 |


  Scenario Outline: Edit records
    When I go to "/ocean"
    Then I should not see "<new-ocean>"
     And I follow "<old-ocean>"
    Then I should see "<old-ocean>"
    When I follow "Edit"
    When I fill in "Name" with "<new-ocean>"
     And I fill in "Length" with "<new-length>"
     And I press "Update"
     And I follow "Back to the list"
    Then I should see "<new-ocean>"
     And I should see "<new-length>"
     And I should not see "<old-ocean>"

  Examples:
    |  old-ocean        |    new-ocean    | new-length |
    | Indian Ocean  | Antarctic Ocean | 4465 |



  Scenario Outline: Delete records
    When I go to "/ocean"
    Then I should see "<ocean>"
     And I follow "<ocean>"
    Then I should see "<ocean>"
    When I press "Delete"
     And I should not see "<ocean>"

  Examples:
    |  ocean              |
    | Atlantic Ocea |
    | Southern Ocean aka Antarctic Ocean     |