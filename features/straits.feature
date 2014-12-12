Feature: I would like to edit straits

  Scenario Outline: Insert records
    When I go to "/strait"
    Then I should not see "<strait>"
     And I follow "Create a new entry"
    Then I should see "Strait creation"
    When I fill in "Name" with "<strait>"
     And I fill in "Length" with "<length>"
     And I press "Create"
    Then I should see "<strait>"
     And I should see "<length>"

  Examples:
    |    strait             | length |
    | Example The Bosfor    | 30     |
    | Example The Dardanele | 120    |


  Scenario Outline: Edit records
    When I go to "/strait"
    Then I should not see "<new-strait>"
     And I follow "<old-strait>"
    Then I should see "<old-strait>"
    When I follow "Edit"
    When I fill in "Name" with "<new-strait>"
     And I fill in "Length" with "<new-length>"
     And I press "Update"
     And I follow "Back to the list"
    Then I should see "<new-strait>"
     And I should see "<new-length>"
     And I should not see "<old-strait>"

  Examples:
    |  old-strait        |    new-strait     | new-length |
    | Example The Bosfor | EDITED The Bosfor | 231        |



  Scenario Outline: Delete records
    When I go to "/strait"
    Then I should see "<strait>"
     And I follow "<strait>"
    Then I should see "<strait>"
    When I press "Delete"
     And I should not see "<strait>"

  Examples:
    |  strait               |
    | Example The Dardanele |
    | EDITED The Bosfor     |  