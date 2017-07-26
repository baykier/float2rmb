数字金额转人民币大写Float2rmb
=============================

install
-------

```
    git clone https://github.com/baykier/float2rmb.git

    cd float2rmb

    composer install

```

usage
-----

```

use Baykier\Float2rmb\Float2rmb

// use composer autoloader
require_once __DIR__ .'/vendor/autoload.php';

$num = '233008.04';
echo Float2rmb::convert($num);
...
```

License
-------

MIT