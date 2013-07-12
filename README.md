# YiiDHL v1.0.0

Yii extension for faster and easier DHL integration.



## Quick start

To quick start clone the repo: `git clone https://github.com/damnpoet/yiidhl.git`.



## Bug tracker

Have a bug or a feature request? [Please open a new issue](https://github.com/damnpoet/yiidhl/issues). Before opening any issue, please search for existing issues and read the [Issue Guidelines](https://github.com/necolas/issue-guidelines), written by [Nicolas Gallagher](https://github.com/necolas/).




## Installing the module

To install the module, you need to copy the folder yiidhl to the protected/extensions folder on your Yii application.


## Configuring

To access the module, you need to modify the application configuration as follows:

```
<?php
return array(
    ...
    'import => array(
        ...
        'ext.yiidhl.models.*',
    ),
    'components' => array(
        'dhl' => array(
            'class' => 'ext.yiidhl.YiiDHL',
            'testMode' => true,
            'useProxy' => true,
            'proxyHost' => 'host:8080',
            'proxyAuth' => 'username:password',
        ),
        ...
    )
);
```


## Author

**Richard González**

+ [http://twitter.com/damnpoet](http://twitter.com/damnpoet)
+ [http://github.com/damnpoet](http://github.com/damnpoet)


## Copyright and license

Copyright 2013 Richard González.

Licensed under the Apache License, Version 2.0 (the "License");
you may not use this work except in compliance with the License.
You may obtain a copy of the License in the LICENSE file, or at:

  [http://www.apache.org/licenses/LICENSE-2.0](http://www.apache.org/licenses/LICENSE-2.0)

Unless required by applicable law or agreed to in writing, software
distributed under the License is distributed on an "AS IS" BASIS,
WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
See the License for the specific language governing permissions and
limitations under the License.