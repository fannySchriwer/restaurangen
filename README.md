# Restaurangen - Code Style Guide

## Indentation Size
* Spaces: 4

## Basic 
* Files MUST use only <?php and <?= tags.
* If file only contains PHP then no ending tag is required
* Files MUST use only UTF-8 for PHP code.
* Files SHOULD either declare symbols (classes, functions, constants, etc.) or cause side-effects (e.g. generate output, change .ini settings, etc.) but SHOULD NOT do both.
* Class names MUST be declared in StudlyCaps/PascalCase.
* Method names MUST be declared in camelCase.

## PHP Tags
* PHP code MUST use the long <?php ?> tags or the short-echo <?= ?> tags.

## Properties
* Use $camelCase property names, unless otherwise stated ()

## Methods
* Method names MUST be declared in camelCase().

## Overview
* Single quotation marks MUST be used when it’s not required to have double quotation marks. For example in HTML and when using a string inside a string. 
* There MUST NOT be a hard limit on line length; the soft limit MUST be 120 characters; lines SHOULD be 80 characters or less.
* There must be one blank line after the block of use declarations.
* Opening braces for classes MUST be on the same line with a space after the class name, and closing braces MUST go on the next line after the body.
* Opening braces for methods MUST go on the same line with a space after the parentheses, and closing braces MUST go on the next line after the body.
* Visibility MUST be only declared on all properties and methods if it is not the standard visibility.
* Opening braces for control structures MUST go on the same line with a space after parentheses, and closing braces MUST go on the next line after the body.

## Example
```php

Class CoolClass {

}

functionName($parameter_one, $parameter_two) {
	$variable_name = 'String with single quotes';

	if() {

	} 
	else {

	}

	secondFunction() {

	}
}
```