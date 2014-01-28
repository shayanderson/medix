Medix
=====

Media Asset Manager for PHP 5.4+


Quick Example
=====
```php
// load Medix
require_once './medix.bootstrap.php';

use Medix\Manager as Medix;
use Medix\Asset\Snippet\Js as SnippetJs;

// register JavaScript snippet asset
Medix::asset('js.snippet.hello', new SnippetJs('
	/* my test js snippet */
	function hello()
	{
		alert(\'Hello!\');
	}
	hello();
'));

// import JavaScript asset snippet
echo Medix::import('js.snippet.hello');

// this will add script tag HTML like:
// <script src="skin/medix/0e771f5ec8270ceef00e605a8f820eaa.js"></script>
// and the script file will contain a line like:
// function hello(){alert('Hello');}hello();
```

More Examples
=====
View More Examples at http://www.shayanderson.com/projects/medix.htm