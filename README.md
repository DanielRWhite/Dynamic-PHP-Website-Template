# Dynamic PHP Website Template

Quick rundown of the basic programming structure in the PHP classes

```php
methods::execute_php("FILE LOCATION")
```
This will execute a PHP file of your choosing. The file can include javascript, php, html, web assembly, etc. All PHP code will be executed upon embedding it. The directory for file location will begin looking at your public/ directory. So if you have placed your dynamic php scripts in php/html/ the correct starting directory would be ../php/html/.

To run the template for development; install PHP 5 or above, go into the public/ directory, then run this command:
```bash
php -S localhost:80
```

Quick Note: Since you will most likely be using css/javascript, the addition to the webpage for those scripts is in ``` php/src/user-interface/UserInterface.php ```, the locations are stored in an array. The only problem with this is that HTML/CSS won't accept parent directories like PHP, so you will have to place them in public/ either just sitting there in the directory or in dedicated sub-folders.

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
