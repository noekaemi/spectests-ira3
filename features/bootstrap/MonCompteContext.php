<?php

use Behat\Behat\Context\Context;
use Behat\MinkExtension\Context\MinkContext;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverExpectedCondition;


/**
 * classe MonCompteContext to run fonctïonnel test
 */
class MonCompteContext extends MinkContext
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
        $desiredCapabilities = DesiredCapabilities::firefox();

        // Disable accepting SSL certificates
        $desiredCapabilities->setCapability('acceptSslCerts', false);
        $this->driver = RemoteWebDriver::create($this->serverUrl, $desiredCapabilities);

    }

    /**
     * @Given I am on the MonCompte page
     */
    public function iAmOnMonComptePage()
    {
        $this->driver->get('http://127.0.0.1/test5');
        
        $this->driver->findElement(WebDriverBy::id('login'))
        ->sendKeys("jvaljean");
        $this->driver->findElement(WebDriverBy::id('password-input'))
        ->sendKeys("cosette");
        $this->driver->findElement(WebDriverBy::id('valider'))
        ->submit();
          //wait to load the web page
          $this->driver->wait(10, 1000)->until(WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::linktext("Ajax")));
          // Find link Mon Compte et click sur l'item
          $this->driver->findElement(
              WebDriverBy::linkText("Mon Compte"))
              ->click();
    }
    //@And I put nom 
    public function iWriteName()
    {
        $this->driver->findElement(WebDriverBy::id('nom'))
     ->sendKeys("test");
    }
      //@And I put prenom as "(?P<nom>[^"]*)" 
      public function iWriteLastName($prenom)
      {
          $this->driver->findElement(WebDriverBy::id('prenom'))
       ->sendKeys($prenom);
      }
}
