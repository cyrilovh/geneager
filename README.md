# Geneager

/!\ WARNING
Project under construction.

## Summary
I am developing this huge project in my spare time. I avoid to use a maximum of dependencies so that the project is easily understandable (for the most novices) and for facilitate its deployment (put in production). Indeed, we can found easly a hostinger low-cost who support PHP and MySQL or host the CMS at home with 2 clicks (with XAMPP, LAMP, ...). And my goal is also to create a work as qualitative as possible !

## Short description
Free CMS for the genealogy.

Twitter: https://twitter.com/geneager_cyril

## Informations
Languages:

- HTML
- CSS
- JS
- PHP
- MySQL

## Licence
Attribution - Non Commercial - ShareAlike 4.0 International (CC BY-NC-SA 4.0)
https://creativecommons.org/licenses/by-nc-sa/4.0/

### Architecture MVC
public --> all public ressources (Javascript, CSS, Images, ...)

src --> All my programs (view / model / controller)

view: HTML (with few php)

class: PHP classes

model: manages the site data

controller: logic program

### Requirement
Apache2:
- RewriteEngine required

PHP mods: 
- Imagick recommened
- Curl recommended
- openssl required (encrypt/decrypt data from database)

## Website (FR)
https://geneager.cyril.ovh

## PHP
Dev with PHP 8.0.6