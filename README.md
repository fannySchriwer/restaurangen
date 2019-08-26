# restaurangen


Code Style Guide

Basic 
Files MUST use only <?php and <?= tags.
Files MUST use only UTF-8 without BOM for PHP code.
Files SHOULD either declare symbols (classes, functions, constants, etc.) or cause side-effects (e.g. generate output, change .ini settings, etc.) but SHOULD NOT do both.
Class names MUST be declared in StudlyCaps/PascalCase.
Class constants MUST be declared in all upper case with underscore separators.
Method names MUST be declared in camelCase.
PHP Tags
PHP code MUST use the long <?php ?> tags or the short-echo <?= ?> tags; it MUST NOT use the other tag variations.

Constants
Class constants MUST be declared in all upper case with underscore separators. 

Properties
Use $camelCase property names.

Methods
Method names MUST be declared in camelCase().

Overview
Code MUST use 4 spaces for indenting, not tabs.
Single quotation marks MUST be used when it’s not required to have double quotation marks. For example in HTML and when using a string inside a string. 
There MUST NOT be a hard limit on line length; the soft limit MUST be 120 characters; lines SHOULD be 80 characters or less.
There MUST be one blank line after the namespace declaration, and there MUST be one blank line after the block of use declarations.
Opening braces for classes MUST go on the next line, and closing braces MUST go on the next line after the body.
Opening braces for methods MUST go on the next line, and closing braces MUST go on the next line after the body.
Visibility MUST be only declared on all properties and methods if it is not the standard visibility.
Control structure, method and function keywords MUST have one space after them.
Opening braces for control structures MUST go on the same line, and closing braces MUST go on the next line after the body.
Opening parentheses for control structures MUST NOT have a space after them, and closing parentheses for control structures MUST NOT have a space before.
