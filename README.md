# MvcCore Extension - Tracy Authentication Panel
Extension for MvcCoreExt_Tracy extension to render and add into tracy debug panel currently authenticated user from MvcCoreExt_Auth service singleton instance, printed by \Tracy\Dumper::toHtml(MvcCoreExt_Auth::GetInstance()->GetUser());.

## Installation
```shell
composer require mvccore/ext-tracy-auth
```