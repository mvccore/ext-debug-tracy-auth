# MvcCore Extension - Tracy Authentication Panel

[![Latest Stable Version](https://img.shields.io/badge/Stable-v3.1.0-brightgreen.svg?style=plastic)](https://github.com/mvccore/example-helloworld/releases)
[![License](https://img.shields.io/badge/Licence-BSD-brightgreen.svg?style=plastic)](https://github.com/mvccore/example-helloworld/blob/master/LICENCE.md)
![PHP Version](https://img.shields.io/badge/PHP->=5.3-brightgreen.svg?style=plastic)

Extension for MvcCoreExt_Tracy extension to render and add into tracy debug panel currently authenticated user from MvcCoreExt_Auth service singleton instance, printed by \Tracy\Dumper::toHtml(MvcCoreExt_Auth::GetInstance()->GetUser());.

## Installation
```shell
composer require mvccore/ext-tracy-auth
```
