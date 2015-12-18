# Link Validator Bundle

[![Build Status](https://travis-ci.org/loonkwil/link-validator-bundle.png)](https://travis-ci.org/loonkwil/link-validator-bundle)

## Install

### Symfony >=2.5, ^3.0

composer.json:
```json
{
  "repositories": [
      {
          "type": "vcs",
          "url": "https://github.com/loonkwil/link-validator-bundle.git"
      },
  ],
  "require": {
      "spe/link-validator-bundle": "~2.0.0",
  }
}
```

### Symfony <2.5

composer.json:
```json
{
  "repositories": [
      {
          "type": "vcs",
          "url": "https://github.com/loonkwil/link-validator-bundle.git"
      },
  ],
  "require": {
      "spe/link-validator-bundle": "~1.0.0",
  }
}
```

```bash
php composer.phar update
```

## Usage

```php
<?php
namespace Acme\AcmeDemoBundle\Entity;

use SPE\LinkValidatorBundle\Validator as LinkAssert;

class AcmeEntity {
  /**
   * @LinkAssert\YouTubeVideo(message="...")
   */
  protected $youtube_video;

  // ...
}
```

## Available asserts

 * YouTubeVideo
 * VimeoVideo
 * FacebookLink
