# phpword2text
PHP Library for simply extracting text from Word documents. No formatting provided.

## Usage
First you need to have composer installed. Then you clone this repo, go in its folder and run "composer install".

Then in your code you can do the following:

```php
<?php
include 'phpword2text.php';

$phpword = new PHPWord2Text();
$txt = $phpword->extractText('somefile.docx');
echo $txt;
```
