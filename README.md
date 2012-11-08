# FuelPHP Package for bitly

***

## Usage
### 1: Configuration
1. Get login & apikey [http://bitly.com/a/your_api_key](http://bitly.com/a/your_api_key)
2. Copy packages/bitly/config/bitly.php to under app/config directory.  
3. Edit bitly.php that copied.  

### 2: Enable bitly package.
##### In app/config/config.php

	'always_load' => array('packages' => array(
		'bitly',
		...

or

##### In your code

	Package::load('bitly');

## Supported API
### /v3/expand

	Bitly::expand('http://bit.ly/MiCtW6'); // 'http://google.com/'

### /v3/shorten

	Bitly::shorten('http://google.com/') // 'http://bit.ly/MiCtW6'

