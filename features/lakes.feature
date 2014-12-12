Feature: I would like to edit lakes

  Scenario Outline: Insert records
    When I go to "/lake"
    Then I should not see "<lake>"
     And I follow "Create a new entry"
    Then I should see "Lake creation"
    When I fill in "Name" with "<lake>"
     And I fill in "Depth" with "<depth>"
     And I press "Create"
    Then I should see "<lake>"
     And I should see "<depth>"

  Examples:
    |    lake            | depth |
    | Example The Hancza    | 109   |
    | Example The Firlej | 32  |


  Scenario Outline: Edit records
    When I go to "/lake"
    Then I should not see "<new-lake>"
     And I follow "<old-lake>"
    Then I should see "<old-lake>"
    When I follow "Edit"
    When I fill in "Name" with "<new-lake>"
     And I fill in "Depth" with "<new-depth>"
     And I press "Update"
     And I follow "Back to the list"
    Then I should see "<new-lake>"
     And I should see "<new-depth>"
     And I should not see "<old-lake>"

  Examples:
    |  old-lake        |    new-lake    | new-depth |
    | Example The Hancza  | EDITED Bialka | 88        |



  Scenario Outline: Delete records
    When I go to "/lake"
    Then I should see "<lake>"
     And I follow "<lake>"
    Then I should see "<lake>"
    When I press "Delete"
     And I should not see "<lake>"

  Examples:
    |  lake              |
    | Example The Firlej |
    | EDITED Bialka  |
