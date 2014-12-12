Feature: I would like to edit rivers

  Scenario Outline: Insert records
    When I go to "/river"
    Then I should not see "<river>"
     And I follow "Create a new entry"
    Then I should see "River creation"
    When I fill in "Name" with "<river>"
     And I fill in "Length" with "<length>"
     And I press "Create"
    Then I should see "<river>"
     And I should see "<length>"

  Examples:
    |    river            | length |
    | Example The Nile    | 7182   |
    | Example The Vistula | 1122   |


  Scenario Outline: Edit records
    When I go to "/river"
    Then I should not see "<new-river>"
     And I follow "<old-river>"
    Then I should see "<old-river>"
    When I follow "Edit"
    When I fill in "Name" with "<new-river>"
     And I fill in "Length" with "<new-length>"
     And I press "Update"
     And I follow "Back to the list"
    Then I should see "<new-river>"
     And I should see "<new-length>"
     And I should not see "<old-river>"

  Examples:
    |  old-river        |    new-river    | new-length |
    | Example The Nile  | EDITED The Nile | 911        |



  Scenario Outline: Delete records
    When I go to "/river"
    Then I should see "<river>"
     And I follow "<river>"
    Then I should see "<river>"
    When I press "Delete"
     And I should not see "<river>"

  Examples:
    |  river              |
    | Example The Vistula |
    | EDITED The Nile     |
