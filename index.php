<?php

use Dotenv\Dotenv;
use Facebook\WebDriver\Chrome\ChromeDriver;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverExpectedCondition;
use Facebook\WebDriver\WebDriverSelect;

require_once './vendor/autoload.php';

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

putenv($_ENV['CHROMEDRIVER_PATH']);

// inicia o webdriver
$driver = ChromeDriver::start();
$driver->manage()->window()->maximize();
// acessa a url
$driver->get('https://frontseg.ambientehml.com/simular/cadastro.php');
// clica no input de nome e escreve
$driver->findElement(WebDriverBy::id('clientes_pfnome'))->sendKeys($_ENV['NOME']);
// clica no input de cpf e escreve
$driver->findElement(WebDriverBy::id('clientes_pfdocumento'))->sendKeys($_ENV['CPF']);
// clica no select de gênero e escolhe
$selectGenero = new WebDriverSelect($driver->findElement(WebDriverBy::id('clientes_pfsexo')));
$selectGenero->selectByValue($_ENV['GENERO']);
// clica no select de estado civil e escolhe
$selectEstCivil = new WebDriverSelect($driver->findElement(WebDriverBy::id('clientes_pfuf_civil')));
$selectEstCivil->selectByValue($_ENV['ESTCIVIL']);
// clica no input de cep e escreve
$driver->findElement(WebDriverBy::id('inptCep'))->sendKeys($_ENV['CEP']);
// clica no botão de pesquisar cep
$driver->findElement(WebDriverBy::id('lupaCep'))->click();
// espera até as informações do cep aparecerem para continuar
$driver->wait()->until(WebDriverExpectedCondition::not(WebDriverExpectedCondition::elementValueContains(WebDriverBy::id('inptEstado'), '...')));
// clica no input de número e escreve
$driver->findElement(WebDriverBy::id('inptNum'))->sendKeys($_ENV['NUMERO']);
// clica no input de data de nascimento e escreve
$driver->findElement(WebDriverBy::id('clientes_pfnascimento'))->sendKeys($_ENV['NASCIMENTO']);
// clica no input de celular e escreve
$driver->findElement(WebDriverBy::id('clientes_pftelefone_cel'))->sendKeys($_ENV['CELULAR']);
// clica no input de e-mail e escreve
$driver->findElement(WebDriverBy::id('clientes_pfemail'))->sendKeys($_ENV['EMAIL']);
// scrolla a página para baixo
$driver->executeScript('scroll(0, 250)');
// clica no primeiro checkbox
$driver->findElement(WebDriverBy::id('flexCheckChecked'))->click();
// clica no segundo checkbox
$driver->findElement(WebDriverBy::id('flexCheck2'))->click();
// clica no botão do form
$driver->findElement(WebDriverBy::id('clientes_pfButton_Insert'))->click();

// $driver->quit();
