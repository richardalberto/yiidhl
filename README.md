# YiiDHL

Yii extension for faster and easier DHL integration. 
Currently YiiDHL only supports DHL order tracking, but other features will be arriving soon.



## Quick start

To quick start get the files from [https://github.com/damnpoet/yiidhl](https://github.com/damnpoet/yiidhl), 
or clone the repo: `git clone https://github.com/damnpoet/yiidhl.git`.



## Bug tracker

Have a bug or a feature request? [Please open a new issue](https://github.com/damnpoet/yiidhl/issues). Before opening any issue, please search for existing issues and read the [Issue Guidelines](https://github.com/necolas/issue-guidelines), written by [Nicolas Gallagher](https://github.com/necolas/).




## Installing the extension

To install the extension, you need to copy the folder yiidhl to the protected/extensions folder on your Yii application.


## Configuring

To access the module, you need to modify the application configuration as follows:

```
<?php
return array(
    ...
    'import' => array(
        ...
        'ext.yiidhl.models.*',
    ),
    'components' => array(
        'dhl' => array(
            'class' => 'ext.yiidhl.YiiDHL',
            //'dhlSiteId'=>'DServiceVal',
            //'dhlPassword'=>'testServVal',
            'testMode' => true,
            'useProxy' => true,
            'proxyHost' => 'host:8080',
            'proxyAuth' => 'username:password',
        ),
        ...
    )
);
```

## Example usage

```
$dhlOrderInfo = Yii::app()->dhl->find($trackingNumber);
```


## Author

**Richard González**

+ [http://twitter.com/damnpoet](http://twitter.com/damnpoet)
+ [http://github.com/damnpoet](http://github.com/damnpoet)
+ [damnpoet@gmail.com](mailto:damnpoet@gmail.com)


## Copyright and license

Copyright (c) 2013 Richard González Alberto.

This library is free software; you can redistribute it and/or
modify it under the terms of the GNU Lesser General Public
License as published by the Free Software Foundation; either
version 2.1 of the License, or (at your option) any later version.

This library is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
Lesser General Public License for more details.

You should have received a copy of the GNU Lesser General Public
License along with this library; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301 USA