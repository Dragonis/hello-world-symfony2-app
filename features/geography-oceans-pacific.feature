Feature: Web pages

  Scenario: Geography/Oceans/Pacific page
    Given I am on "geography/oceans/pacific.html"
    Then the response status code should be 200
    Then I should see "This is The Geography/Oceans/Pacific page!"
