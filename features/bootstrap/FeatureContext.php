<?php

use Behat\Behat\Context\Context;
use Behat\Mink\WebAssert;
use Behat\MinkExtension\Context\MinkContext;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverExpectedCondition;


/**
 * classe FeatureContext to run fonctïonnel test
 */
class FeatureContext extends MinkContext
{

    /**
     *   driver PHP pour selenium
     * */

    protected $driver;
    /**
     * URL du serveur selenium
     */
    protected $serverUrl = 'http://localhost:4444';
    /**
     * Constructor.
     *
     *
     */
    public function __construct()
    {
        $desiredCapabilities = DesiredCapabilities::microsoftEdge();

        // Disable accepting SSL certificates
        $desiredCapabilities->setCapability('acceptSslCerts', false);
        $this->driver = RemoteWebDriver::create($this->serverUrl, $desiredCapabilities);

    }

    /**
     * @Given I am on the authentification page
     */
    public function iAmOnTheAuthentificationPage(){
        $this->driver->get('http://127.0.0.1/test4-correction');
    }

    /**
     * @Given /I authenticated as "(?P<username>[^"]*)" using "(?P<password>[^"]*)"/
     */
    public function iAuthenticatedWithUsernameAndPassword($username, $password){
        $this->driver->findElement(WebDriverBy::id('login'))
            ->sendKeys($username);
        $this->driver->findElement(WebDriverBy::id('password-input'))
            ->sendKeys($password);

    }

    /**
     * @When I submit the form
     */
    public function iSubmitTheForm(){

        $this->driver->findElement(WebDriverBy::id('valider'))
            ->submit();
    }

    /**
     * @Then I should see Accueil
     */
    public function iShouldSeeAccueil(){
        //wait to load the web page
        $this->driver->wait(10, 1000)->until(WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::linktext("Ajax")));

        // Find link Les tests unitaires (PHPUNIT) element of 'Accueil' page
        $this->driver->findElement(
            WebDriverBy::linkText("Les tests unitaires (PHPUNIT)")
        );
    }

    /**
     * @When /I add a book "(?P<name>[^"]*)" written by "(?P<author>[^"]*)" edited by "(?P<editor>[^"]*)" and is "(?P<info>[^"]*)"/
     */
    public function iAddABook($name, $author, $editor, $info){
        //I click to add a book
        $this->driver->findElement(WebDriverBy::linkText('Ajouter un livre'))
            ->click();

        //I fill the form
        $this->driver->findElement(WebDriverBy::name('nom'))
            ->sendKeys($name);
        $this->driver->findElement(WebDriverBy::id('auteur'))
            ->sendKeys($author);
        $this->driver->findElement(WebDriverBy::id('edition'))
            ->sendKeys($editor);
        $this->driver->findElement(WebDriverBy::id('info'))
            ->sendKeys($info);
        
        //I submit the form
        //$this->driver->findElement(WebDriverBy::name('Ajouter'))
            //->click();
    }

    /**
     * @Then I should see Book form
     */
    public function iShouldSeeBookForm(){
        //wait to load the web page
        $this->driver->wait(10,1000)->until(WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::name("nom")));
    }

    /**
     * @Then I quit at the end
     */
    public function iEnd()
    {
        // Make sure to always call quit() at the end to terminate the browser session
        $this->driver->quit();
    }
}
