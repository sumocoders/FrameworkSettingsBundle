# Getting Started With FrameworkSettingsBundle

## Installation

Add FrameworkSettingsBundle as a requirement in your composer.json:

```
{
    "require": {
        "sumocoders/framework-settings-bundle": "dev-master"
    }
}
```

**Warning**

> Replace `dev-master` with a sane thing

Run `composer update`

Enable the bundle in the kernel.

```php
<?php
// app/AppKernel.php

public function registerBundles()
{
    // ...
    $bundles = array(
        // ...
        new SumoCoders\FrameworkSettingsBundle\SumoCodersFrameworkSettingsBundle(),
    );
}
```
