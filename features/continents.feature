Feature: I would like to edit continents

  Scenario Outline: Insert records
    When I go to "/continent"
    Then I should not see "<continent>"
     And I follow "Create a new entry"
    Then I should see "Continent creation"
    When I fill in "Name" with "<continent>"
     And I fill in "Area" with "<area>"
     And I press "Create"
    Then I should see "<continent>"
     And I should see "<area>"

  Examples:
    |    continent        | area     |
    | Example The Europe  | 10180000 |
    | Example The Asia    | 44579000 |


  Scenario Outline: Edit records
    When I go to "/continent"
    Then I should not see "<new-continent>"
     And I follow "<old-continent>"
    Then I should see "<old-continent>"
    When I follow "Edit"
    When I fill in "Name" with "<new-continent>"
     And I fill in "Area" with "<new-area>"
     And I press "Update"
     And I follow "Back to the list"
    Then I should see "<new-continent>"
     And I should see "<new-area>"
     And I should not see "<old-continent>"

  Examples:
    |  old-continent     |  new-continent    | new-area |
    | Example The Europe | EDITED The Europe | 20990340 |



  Scenario Outline: Delete records
    When I go to "/continent"
    Then I should see "<continent>"
     And I follow "<continent>"
    Then I should see "<continent>"
    When I press "Delete"
     And I should not see "<continent>"

  Examples:
    |  continent          |
    | Example The Asia    |
    | EDITED The Europe   |