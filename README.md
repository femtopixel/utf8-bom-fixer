[![Minimum PHP Version](https://img.shields.io/badge/php-%3E%3D%204.3-8892BF.svg?style=flat-square)](https://php.net/)
[![Minimum PHP Version](https://img.shields.io/badge/php-%3E%3D%205.0-8892BF.svg?style=flat-square)](https://php.net/)
[![Minimum PHP Version](https://img.shields.io/badge/php-%3E%3D%207.0-8892BF.svg?style=flat-square)](https://php.net/)
[![Build Status](https://scrutinizer-ci.com/g/femtopixel/utf8-bom-fixer/badges/build.png?b=master)](https://scrutinizer-ci.com/g/femtopixel/utf8-bom-fixer/build-status/master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/femtopixel/utf8-bom-fixer/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/femtopixel/utf8-bom-fixer/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/femtopixel/utf8-bom-fixer/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/femtopixel/utf8-bom-fixer/?branch=master)
[![license](https://img.shields.io/github/license/femtopixel/utf8-bom-fixer.svg?maxAge=2592000)]()

UTF-8 BOM Fixer
===
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
