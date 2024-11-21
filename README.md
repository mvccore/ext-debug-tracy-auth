# MvcCore - Extension - Debug - Nette Tracy - Panel Authentication

[![Latest Stable Version](https://img.shields.io/badge/Stable-v5.3.0-brightgreen.svg?style=plastic)](https://github.com/mvccore/ext-debug-tracy-auth/releases)
[![License](https://img.shields.io/badge/License-BSD%203-brightgreen.svg?style=plastic)](https://mvccore.github.io/docs/mvccore/5.0.0/LICENSE.md)
![PHP Version](https://img.shields.io/badge/PHP->=5.4-brightgreen.svg?style=plastic)

MvcCore Debug Tracy Extension to render and add into tracy debug panel currently authenticated user by `\MvcCore\Ext\Auth` service singleton instance, printed by `\Tracy\Dumper::toHtml(\MvcCore\Ext\Auth::GetInstance()->GetUser());`.

## Installation
```shell
composer require mvccore/ext-debug-tracy-auth
```
