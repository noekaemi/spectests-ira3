Feature: Adding a book
In order to sign in an account as a user and add a book

Test fonctionnel sur l'authentification d'un user et l'ajout d'un livre
Scenario: test authentification I fill my username and password only
Given I am on the authentification page
And I authenticated as "jvaljean" using "cosette"
When I submit the form
Then I should see Accueil
When I add a book "livre" written by "auteur" edited by "editeur" and is "info"
Then I should see Book form