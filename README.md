# Dynamic PHP Website Template

Quick rundown of the basic programming structure in the PHP classes (Mainly ```methods.php```)


# Execute PHP files dynamically

```php
methods::execute_php("FILE LOCATION")
```
This will execute a PHP file of your choosing. The file can include javascript, php, html, web assembly, etc. All PHP code will be executed upon embedding it. The directory for file location will begin looking at your public/ directory. So if you have placed your dynamic php scripts in php/html/ the correct starting directory would be ../php/html/.

You can execute PHP files inside of other PHP files, as far as I have tested, there is no limit except for loading them into RAM & cache.


# Initialize elements (HTML)

```php
methods::iElement($tag, $pos)
```
Use this to create dynamic tagging for the creation of HTML elements, e.g token authenticated apps (I've used it for per-user based private video viewing with a one time token).

 - ```php $tag``` variable will indicate what to put between ```html <``` and ```html >```.
 - ```php $pos``` variable will indicate whether to put a ```html /``` in-front of the ```html <``` element to create an element ending indicator.


# Understanding sub-directory URL traversing

In the ```methods.php``` file you will see a function called ```php function urlArray()```. This is basically just going to return all the sub-directories of the current site's URL in an array, e.g ```https://en.wikipedia.org/wiki/Australia``` it will return an array of ```['wiki', 'Australia']```, you can then use this information to understand what page the user is requesting via calling ``` array[0...] EQUALS Certain_Function```. This can work great for sub-directories will multiple parts, e.g: Have a sub-directory from the parent directory that has an ```index.php``` file inside, that ```index.php``` file will then check the parsed information from ```array[1]``` which will then dynamically adjust the page for that specific area (This helps in keeping the ```UserInterface.php``` have clean code.)


# Running for development

To run the template for development; install PHP 5 or above, go into the public/ directory, then run this command:
```bash
php -S localhost:80
```


# Tips for running under NGINX

In the config file for your website where it defines ```config try_files $uri = /404.html;``` replace that with ```config try_files $uri = index.php;``` to eliminate errors for sub-directory traversing via URLs.

Warning: This hasn't been tested on any apache platform, I will update this README.md file once I have.


# Quick Notes

Since you will most likely be using css/javascript, the addition to the webpage for those scripts is in ``` php/src/user-interface/UserInterface.php ```, the locations are stored in an array. The only problem with this is that HTML/CSS won't accept parent directories like PHP, so you will have to place them in public/ either just sitting there in the directory or in dedicated sub-folders.

The arrays the scripts are stored in are as follows:

```php
$stylesheets = array(
  'css/en_default.css' // Default css file, can add multiple, just add another child.
);
$scripts = array(
  'js/jquery.min.js' // Default javascript file, can add multiple, just add another child.
);
foreach($stylesheets as $link) {
  print_r("<link rel='stylesheet' type='text/css' href='$link'>"); // Dynamically adds them into the <head></head> section
}
foreach($scripts as $link) {
  print_r("<script type='text/javascript' src='$link'></script>"); // Dynamically adds them into the <head></head> section
}
```

WARNING: These JavaScript/CSS files are not created by default, you will have to manually specify them and add custom ones.
