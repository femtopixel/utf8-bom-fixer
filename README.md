![logo](logo.png)

UTF-8 BOM Fixer
===============

[![Minimum PHP Version](https://img.shields.io/badge/php-%3E%3D%204.3-8892BF.svg?style=flat-square)](https://php.net/)
[![Minimum PHP Version](https://img.shields.io/badge/php-%3E%3D%205.0-8892BF.svg?style=flat-square)](https://php.net/)
[![Minimum PHP Version](https://img.shields.io/badge/php-%3E%3D%207.0-8892BF.svg?style=flat-square)](https://php.net/)
[![license](https://img.shields.io/github/license/femtopixel/utf8-bom-fixer.svg?maxAge=2592000)]()
[![PayPal donation](https://github.com/jaymoulin/jaymoulin.github.io/raw/master/ppl.png "PayPal donation")](https://www.paypal.me/jaymoulin)
[![Buy me a coffee](https://www.buymeacoffee.com/assets/img/custom_images/orange_img.png "Buy me a coffee")](https://www.buymeacoffee.com/3Yu8ajd7W)
[![Become a Patron](https://badgen.net/badge/become/a%20patron/F96854 "Become a Patron")](https://patreon.com/jaymoulin)

(This product is available under a free and permissive license, but needs financial support to sustain its continued improvements. In addition to maintenance and stability there are many desirable features yet to be added.)

Fix files "infected" by UTF-8 bom character. This script will remove the BOM character at the beginning of each files.

This character purpose is to force encode files in UTF-8 by adding a special character at the beginning of the file.
Issues appears with this character on a web server because it might be interpreted (e.g : PHP files are not interpreted anymore)

Usage
===

```
php bomreplacer.php [[directory] [comma_separated_extensions]]
```

## Parameters 

optional **directory** (current directory if not specified) directory to recursively "heal"
optional **comma_separated_extensions** (all if not specified) allowed extension a file must have to be "healed" (comma (,) separated)

## Example

```
php bomreplacer.php /home/www
```

Will fix all files in **/home/www** folder

```
php bomreplacer.php /home/www php,css
```

Will fix all **PHP** and **CSS** files in **/home/www** folder but will leave the other files as-is.

Docker Usage
===========

```
docker run --rm -ti -v "$PWD":/src femtopixel/utf8-bom-fixer
```

Will fix all files in your current path. You can call `bomreplacer` if you want to pass specific parameters

Example
-------

```
docker run --rm -ti -v "$PWD:/src" femtopixel/utf8-bom-fixer bomreplacer /src php,css
```

Will fix all **PHP** and **CSS** files in current directory but will leave the other files as-is.

