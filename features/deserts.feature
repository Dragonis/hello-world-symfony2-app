Feature: I would like to edit deserts

  Scenario Outline: Insert records
    When I go to "/desert"
    Then I should not see "<desert>"
     And I follow "Create a new entry"
    Then I should see "Desert creation"
    When I fill in "Name" with "<desert>"
     And I fill in "Area" with "<area>"
     And I press "Create"
    Then I should see "<desert>"
     And I should see "<area>"

  Examples:
    | desert              | area    |
    | Example the Gobi    | 1295000 |
    | Example the Ogaden  | 327068  |


  Scenario Outline: Edit records
    When I go to "/desert"
    Then I should not see "<new-desert>"
     And I follow "<old-desert>"
    Then I should see "<old-desert>"
    When I follow "Edit"
    When I fill in "Name" with "<new-desert>"
     And I fill in "Area" with "<new-area>"
     And I press "Update"
     And I follow "Back to the list"
    Then I should see "<new-desert>"
     And I should see "<new-area>"
     And I should not see "<old-desert>"

  Examples:
    | old-desert       | new-desert  | new-area |
    | Example the Gobi | EDITED Gobi | 1295111  |



  Scenario Outline: Delete records
    When I go to "/desert"
    Then I should see "<desert>"
     And I follow "<desert>"
    Then I should see "<desert>"
    When I press "Delete"
     And I should not see "<desert>"

  Examples:
    | desert             |
    | Example the Ogaden |
    | EDITED Gobi        |