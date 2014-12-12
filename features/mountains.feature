Feature: I would like to edit mountains

  Scenario Outline: Insert records
    When I go to "/mountain"
    Then I should not see "<mountain>"
     And I follow "Create a new entry"
    Then I should see "Mountain creation"
    When I fill in "Name" with "<mountain>"
     And I fill in "Hight" with "<hight>"
     And I press "Create"
    Then I should see "<mountain>"
     And I should see "<hight>"

  Examples:
    |    mountain                  | hight |
    | Example The Mount Everest    | 8844  |
    | Example The Makalu           | 8485  |


  Scenario Outline: Edit records
    When I go to "/mountain"
    Then I should not see "<new-mountain>"
     And I follow "<old-mountain>"
    Then I should see "<old-mountain>"
    When I follow "Edit"
    When I fill in "Name" with "<new-mountain>"
     And I fill in "Hight" with "<new-hight>"
     And I press "Update"
     And I follow "Back to the list"
    Then I should see "<new-mountain>"
     And I should see "<new-hight>"
     And I should not see "<old-mountain>"

  Examples:
    |  old-mountain              |    new-mountain          | new-hight |
    | Example The Mount Everest  | EDITED The K2            |  8420     |



  Scenario Outline: Delete records
    When I go to "/mountain"
    Then I should see "<mountain>"
     And I follow "<mountain>"
    Then I should see "<mountain>"
    When I press "Delete"
     And I should not see "<mountain>"

  Examples:
    |  mountain                    |
    | Example The Makalu           |
    | EDITED The K2                |
