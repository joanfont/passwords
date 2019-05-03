# Passwords
[![Build Status](https://travis-ci.org/joanfont/passwords.svg?branch=master)](https://travis-ci.org/joanfont/passwords)
[![codecov](https://codecov.io/gh/joanfont/passwords/branch/master/graph/badge.svg)](https://codecov.io/gh/joanfont/passwords)

PHP approach to [Django's password system](https://docs.djangoproject.com/en/2.2/topics/auth/passwords/)
## Usage 

### Basic usage
```php
use Passwords\Hasher;
use Passwords\Helper as PasswordHelper;

PasswordHelper::registerHasher(new Hasher\PBKDFSHA512(10000));
$password = PasswordHelper::make('my-awesome-password', 'my-awesome-salt');

PasswordHelper::check('my-awesome-password', 'PBKDF2SHA512$10000$my-awesome-salt$c25c4933b6dc9a9717813b4e7d1c5269d8bb81aea2730470faa538f0abdb6097068fc34d03362441f03a2d47cd157c6168d26a47a246af5b4e855dd9b2c1a068');
```

### Register multiple hashers
```php
use Passwords\Hasher;
use Passwords\Helper as PasswordHelper;

$default_hasher = new Hasher\PBKDF2SHA512(10000);
PasswordHelper::setDefaultHasher($default_hasher);

PasswordHelper::registerHasher($default_hasher);
PasswordHelper::registerHasher(new Hasher\SHA1);
```

If no default hasher is provided, first hasher registered will be used as default.

###  Make your custom hasher
Please do not use in production in any purpose.
```php
use Password\Hasher\Hasher;

class MyAwesomeHasher extends Hasher 
{
  const NAME = 'MyAwesomeHasher';
  
  public function encode(string $raw, ?string $salt): string
  {
    return strrev($raw);
  }
}
```   

Usage

```php
use Password\Helper as PasswordHelper;

PasswordHelper::registerHasher(new MyAwesomeHasher);
// Salt doesn't matter with this hasher
$password = PasswordHelper::make('my-awesome-password', null);

PasswordHelper::check('my-awesome-password', 'MyAsweomeHasher$$$drowssap-emosewa-ym');
```


## Testing
```bash
make install
make test
```

## Credits
* [Pep Mañas](https://github.com/Neengash)
* [Joan Font](https://github.com/joanfont)
