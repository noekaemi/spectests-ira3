Feature: MonCompte
Saisie des champs de la page moncompte puis validation

Test fonctionnel sur la page mon Compte
Scenario: test fonctionnel sur les parametres du compte Utilisateur
Given I am on the MonCompte page
And I put  nom
And I put prenom as 'jeannot'
And I put dateNaiss as '10/10/1950"
And I put tel as '0101020202'
And I put email as 'toto@freefr'
And I put password as "titi"
And I put password2 as "titi"
And I put numero as "21"
And I put rue as "boulevard Magenta"
And I put codePostal as "75012"
And I put ville as "Paris"
When I submit the form Validation
Then I should see Validation