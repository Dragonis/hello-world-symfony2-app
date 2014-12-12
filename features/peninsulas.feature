Feature: I would like to edit peninsulas

  Scenario Outline: Insert records
    When I go to "/peninsula"
    Then I should not see "<peninsula>"
     And I follow "Create a new entry"
    Then I should see "Peninsula creation"
    When I fill in "Name" with "<peninsula>"
     And I fill in "Area" with "<area>"
     And I press "Create"
    Then I should see "<peninsula>"
     And I should see "<area>"

  Examples:
    | peninsula             | area    |
    | Example the Malay     | 180000  |
    | Example the Kamchatka | 270000  |


  Scenario Outline: Edit records
    When I go to "/peninsula"
    Then I should not see "<new-peninsula>"
     And I follow "<old-peninsula>"
    Then I should see "<old-peninsula>"
    When I follow "Edit"
    When I fill in "Name" with "<new-peninsula>"
     And I fill in "Area" with "<new-area>"
     And I press "Update"
     And I follow "Back to the list"
    Then I should see "<new-peninsula>"
     And I should see "<new-area>"
     And I should not see "<old-peninsula>"

  Examples:
    | old-peninsula     | new-peninsula | new-area |
    | Example the Malay | EDITED Malay  | 190000   |



  Scenario Outline: Delete records
    When I go to "/peninsula"
    Then I should see "<peninsula>"
     And I follow "<peninsula>"
    Then I should see "<peninsula>"
    When I press "Delete"
     And I should not see "<peninsula>"

  Examples:
    | peninsula             |
    | Example the Kamchatka |
    | EDITED Malay          |