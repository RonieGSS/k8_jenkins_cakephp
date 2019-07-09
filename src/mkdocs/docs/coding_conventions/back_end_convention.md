# Back-End Coding Convention

The following conventions are intently designed for PHP version 7 and higher. However, most ideas are applicable even for lower PHP versions.

---

---

## Naming Convention

In general, when writing code, we use values assigned to variables(properties) and code-blocks written in functions, classes, files, and even folders all over the application. This makes writing clear and understandable names highly important. 

Imagine declaring a property and a function like this:

```php
	private $a = "SELECT * FROM `users`";

	public function x()
	{
		// Some code ...
	}
```

Then, after 1243 lines of code you use both property and function like this:

```php
	public function yyy()
	{
		$m21 = $this->a . $this->x();
	}
```

The problem with this approach is how can you ensure what value `$m21` variable contains. What if a new developer will read your code? Then that developer needs to track the exact locations and declarations of these variables(properties) and functions in order for them to understand. Such case will take more development time, increase cost, and increase the probablity for errors.

Good naming conventions will give the developer reading your code a heads-up regarding your codes' definition. Such notion holds true for files and directories, since developers need to segregate codes properly into files, and also segregate files into folders.

### Variable Naming

Variable names should be written in snake_case. For instance, we can declare a variable like this:

```php
  	$variable_name = "variable name";  
```

Such convention adds readability to your code.

Variable names should have a descriptive or adjective tone. For instance, you want to create a variable holding the value of the longest word from a given array.

You can name the variable like this:

```php
	$longest_word_in_array = "supercalifragilisticexpialidocious";
```

This holds true even when you are declaring an object or class property like this:

```php
	private $longest_word_in_array = "Helloooooooooooooo"; 
```

As much as possible, start your variable name with an ***adjective*** or any describing word.


### Function Naming

Similar to variable names, function names should also be written in camelCase. Function names should be written in an action or ***verb*** form; where the verb is written at the beginning of the function name like this:

```php
	public function pushStringIntoArray()
	{
		// Some code here ...
	}

```

Combining the convention of variable(property) names and function names, we will arrive with the following example:

```php
	private $snake_case_property_name;

	private $another_snake_case_property_name;

	public function addCamelCasedFunctionName()
	{
		$snake_case_variable_name;

		// Some code here ...
	}
```

### Constant Naming

Constant names should be written in capital letters where each word are connected with underscore (`_`) character like this:

```php
	const ALL_CAPS_VALUE = "I'M CAPITAL";
```
or even this:

```php
	const __ALL_CAPS_VALUE__ = "_I'M CAPITAL_";
```

which is the same format as *Magic Constants*.

The tone of constant names should be descriptive(*adjective*) similar to variable names. This is just a basic review since setting contants to *all-caps* has always been the used convention. You can check this on the <a href="http://php.net/manual/en/language.constants.php" target="_blank">PHP Manual Constants</a> section.

### Class Naming

Class names should be written in PascalCase format like the following:

```php
	class PascalCase
	{
		// Some code here ...
	}
```

Since CakePHP is the framework we will be using in this project, you might already have an idea on how to name your classes. This type of naming convention is still advisable even for native php code. You can further learn about CakePHP naming conventions in <a href="https://book.cakephp.org/3.0/en/intro/conventions.html" target="_blank">CakePHP Conventions</a> section.

Additional Note: 
> Class name should be exactly the same as the name of the file where it is written. Even if you are not using a framework, as long as you are coding in PHP version 7 or higher; this concept will still be important for namespacing and autoloading(declared in composer.json file).

### File Naming

File names are written similar to Class names like what is written above(Class Naming section). Therefore, file names are also in PascalCase format like the following:

```php
	// Inside PascalCaseDirectoryName.php file

	class PascalCaseDirectoryName
	{

	}
```

As you may have noticed from the example above, the file name and class name are suffixed with the directory name. This convention is essential in helping you track down the location of the file(or class), especially when you are reusing the class within a code in other files and/or directories. You can learn more from <a href="https://book.cakephp.org/3.0/en/intro/conventions.html" target="_blank">CakePHP Conventions</a> section.

Additional Note:
> Files without class declarations can be exempted from the naming convention above (such as view files or config files). But similar to the file naming convention above, the name should always be brief enough to summarize it's content. Also, the name should be in a ***Noun*** tone.
 
### Directory(Folder) Naming

Directory names should also be in PascalCase format similar to file and class names like the following:

```php
	// Inside PascalCaseDirectoryName.php file
	// Which is inside DirectoryName

	class PascalCaseDirectoryName
	{

	}
```
Since we will be using CakePHP 3 framework for the project, we will be using the <a href="https://book.cakephp.org/3.0/en/intro/cakephp-folder-structure.html" target="_blank">CakePHP 3 directory structure</a>.

Additional Note:
> Even if only one directory is PascalCased in a certain location, all directories that will be added should also be in PascalCase for consistency. Parent directories can be exempted from PascalCase format as long as it is not aligned with any PascalCased named directory like the directory structure below:

```
	- grandparent/
		- parent/
			- PascalCasedEldestChild/ 
				- PascalCasedMiddleChild/
				- PascalCasedTwinStepSister/ 
				- PascalCasedYoungestChild/ 

		- uncle/   
			- PascalCasedFirstCousin/   
			- PascalCasedAdoptedCousin/ 
		- auntie/  
		- bestman/ 
```

---

## Spacing and Indention

Spacing and indention are important factors for code readability. The following is an example of code without spacing and indention.

```php
	class PilotClass
	{
	private $pilot;
	private $steward;
	public function flyPlane($passengers, $passenger_filled_plane, $plane_rows)
	{
	try{
	if(isset($passenger_filled_plane)){
	foreach($passengers as $index => $passenger){
	$plane_rows[$index] = $passenger;
	}
	return $plane_rows;
	}
	}catch(Exception $e){
	return $e->getMessage();
	}
	}
	}
	}
```

Now imagine the code above to be a thousand-lines of code. That would be too difficult to read. That is why we are introducing the essence of spacing and indention.

### Horizontal Spacing

Generally speaking, one indention must be equal to four spaces. Every code inside a block should be indented once. A block of code is identified as code being enclosed by open and close curly brackets **{ }**. In conditional, try/catch, and loop statements(e.g. if/elseif/else or switch, for or foreach, while or do while), the condition enclosed by parentheses should have a single space after the statement type(e.g. if, switch), before the open curly bracket, and after a closing bracket(if there's a following condition).

### Vertical Spacing

The block of codes within the same scope should also have a single vertical space before and after every block. The comments or docblocks on top of a block of code don't need to have a vertical space because it should be seen as part of that code. The should be, however, a vertical space before the comment/docblock.

Combining the concepts and rules of horizontal and vertical spacing, the code above can be modified as follows:

```php
	class PilotController
	{
		private $pilot;

		private $steward;

		public function flyPlane($passengers, $passenger_filled_plane, $plane_rows)
		{
			try {
				if (isset($passenger_filled_plane)) {
					foreach ($passengers as $index => $passenger) {
						$plane_rows[$index] = $passenger;
					}
					return $plane_rows;
				}
			} catch (Exception $e) {
				return $e->getMessage();
			}
		}
	}
```

As you can see, the modified code is far more readable than the previous code; and a lot easier to follow.

---

## Single and Double Quotes

### Single Quotes

As much as possible, we should always use single quotes for strings. The reason for this is that double quotes will still be evaluated by PHP. Since single-quoted strings are processed exactly as it is; this means running single-quoted strings are faster than double-quoted strings. 

### Double Quotes

Now, recommending single quotes doesn't necessarily mean that there is no room for double quotes. For example we are adding a lot of variables and/or objects in our code like the following:

```php
	echo 'This is my ' . $dog_name . ' which I bought from ' . $this->$compound_place . \n . ' for about ' .
		 $this->price_range[10] . ' today(' . date('Y-m-d') . ').';
```

That was not just tough to write, but also tough to read and even prone to errors especially with spacing.
Therefore, my convention is to use single quotes and concatenation when there is only one variable, array, or object to be concatenated. The performance issue won't hurt much as long as you minimize the use of double quotes by following the previous statement; and not to necessarily prevent. So the following will be acceptable:

```php
	echo "This is my {$dog_name} which I bought from {$this->$compound_place} \n for about
		 {$this->price_range[10]} today({date('Y-m-d')}).";
```

As you can see, it is simpler and more readable this way. Additionally, I also recommend the use of curly brackets even for variables to keep them easier to trace.

For Heredoc and Nowdoc, which are used for multi-line strings, you should not use quotes for Heredoc opening statement and should always use single-quotes for Nowdoc opening statement like the following.

#### Nowdoc

```php
	echo <<<'POEM'
		This poem entitled 'My Poem'
		will exactly be shown on the
		browser similar to the way
		it is written here. 
POEM;
```

#### Heredoc

```php
	echo <<<POEM
		This poem entitled {$this->getTitle()}
		will exactly be shown on the
		browser similar to the way
		it is written here. 
POEM;
```

You can further learn about Heredoc and Nowdoc from <a href="http://php.net/manual/en/language.types.string.php" target="_blank">PHP Manual Strings</a> section.

---

## Statement Declaration Convention

Statements are either ended by a semi-colon or by a closing curly bracket like if/switch statements. 

### Strict Typing

Strict Typing is a new feature in PHP 7, and should be the first statement declared on your source code file. Strict Types are declared as follows:

```php
	<?php declare(strict_types=1);
```

With Strict Typing declared equal to one, we can easily catch any type erros and will definitely be clearly shown on your browser page. To make it work it's magic, we should apply type hinting in our functions and methods like the following example:

```php
	public function sum(int $num_a, int $num_b): int
	{
		// Some code here
	}

	public function getSum()
	{
		// This will return a Fatal Error:
		$sum = $this->sum(3, 'foo');
	}
```

The error code for this example will be returned even before any code inside that sum function block is executed. This will return a complete and clear error response:

```
	Fatal error: Uncaught TypeError: Argument 2 passed to sum() must be of the type integer, string given, called in - on line 9 and defined in -:1
	Stack trace:
	#0 -(9): sum(3, 'foo')
	#1 {main}
		thrown in - on line 1
```

To learn more about strict types, you can refer to <a href="http://php.net/manual/en/functions.arguments.php#functions.arguments.type-declaration.strict" target="_blank">PHP Manual Strict Typing</a> section.

### Namespaces and Use Statements

Namespaces are like directory path to a certain file. They should be the second statement on your source code files. Technically, to avoid errors, you should avoid using reserved words for namespaces.

The following example will return a Parse Error,

```php
	// Inside Trait Directory
	// Inside SomeTrait.php file

	namespace App\Trait;
```  

since Trait is a reserved word. You may refer to the <a href="http://php.net/manual/en/reserved.keywords.php" target="_blank">PHP Manual Reserved Keywords</a> section. The following example will be acceptable:

```php
	// Inside Traits Directory
	// Inside SomeTrait.php file - since traits must be suffixed with 'Trait'

	namespace App\Traits;
```  

In addition, all *use* statements(except for traits) should be declared after the namespace:

```php
	namespace App\Controller;

	use \App\Interfaces\MyInterface;
```

### Classes and Functions

Classes and functions should be declared with the open curly bracket written on the next line like the following:

```php
	class SomeClass
	{
		public function someFunction()
		{
			// Some code here ...
		}
	}
```

The reason for this is convenience and readability. This will be obvious when you are applying prototyping and strict typing so instead of:

```php
	class SomeClass extends SomeParentClass implements SomeInterface {
		public function someFunction(): string {
			// Some code here ...
		}
	}
```

The following format will be better:

```php
	class SomeClass extends SomeParentClass implements SomeInterface 
	{
		public function someFunction(): string 
		{
			// Some code here ...
		}
	}
```
### Closures

Closures must also be declared with added Horizontal Spacing like the following:

```php
	$openClosure = function ($args) {  
		// Some open code here ...
	};
		// OR
	$openClosure = function ($args) use ($some_var) { 
		// Some open code here ...
	};
```

### Conditional and Loop Statements

#### If/Switch/Try-Catch

The following conditional statements should follow the convention mentioned on the Horizontal Spacing section.

```php
	// If/ElseIf/Else

	if ($good) {
		// Good code
	} elseif ($average) {
		// Average code
	} else {
		// Quite bad code
	}

	// Switch

	switch ($rating) {
		case 'good': // <-- switch cases are also blocks so indention is necessary
			// Good code
			break;
		case 'average':
			// Average code
			break
		case default:
			// Quite bad code
	}

	// Try-Catch

	try {
		// Some Good, Average, and Quite bad code
	} catch (Exception $e) {
		// Some Good catch
	}
```

The above code are well-written Conditional Statements.

#### For/Foreach/While/Do While

The following loop statements should follow the convention mentioned on the Horizontal Spacing section.

```php
	// For
	
	for ($i = 0; $i < $mean_length; $i++) {
		// Some loop code here ...
		// TAKE NOTE of the spaces added above
	}

	// Foreach

	foreach ($mean_lengths as $index => $lengths) {
		// Some loop code here ...
	}

	// While

	while ($mean_lengths) {
		// Some loop code here ...
	}

	// Do While

	do {
		// Some loop code here ...
	} while ($mean_lengths);
```

You can learn more about conventions from the <a href="https://www.php-fig.org/psr/psr-2/" target="_blank">PSR Coding Style</a> section

---

## DocBlocks and Comments

### DocBlocks

Documentation blocks are important especially for the readers of your code. Documentations will assist developers to understand the code even without reading the code itself which increases speed and efficiency in development. Also, documentation blocks helps in decreasing probability of errors and confusion on your code.

DocBlocks should be written before the following:
* Namespace
* Class Declaration
* Class Property Statements
* Class Methods
in the following format:

```php
	/**
	 * PHP Version Number(e.g. 7)
	 *
	 * @author Your Name <email address>
	 * @since Date you started coding in this file like (Apr 21, 2018)
	 */
	namespace App\Controller;

	use \App\Interfaces\MyInterface;

	/**
	 * Class Name
	 *
	 * Class description/responsibility(Keep it Short and Simple)
	 */
	class SomeClass implements MyInterface
	{
		/**
		 * @var property_type property_name
		 * Property description/responsibility(KISS)
		 */
		private $property;

		/**
		 * Method Name
		 *
		 * Method short description/responsibility(KISS)
		 * @param param_type param_name param_description/responsibility(KISS) - Only if needed
		 * @return return_type return_name return_description/responsibility(KISS) - Only if needed
		 * @throws exception_name exception_condition(KISS) - Only if needed
		 */
		public function addSomeFunction(string $some_param): string
		{
			if (!$okay) {
				throw new Exception('I\'m Sick!');
			} 

			return 'Yehey';
		}
	}
```

The above looks readable, understandable, and formal.

### Comments

Adding inline comments is necessary if you are using functions or variables(properties) in a certain line of code that might seem to be confusing or to assist the reader(developer) where to track a certain code or function.

The following is a good example for adding inline comments:

```php
	public function addSomeFunction(string $some_param): string
	{
		// evaluateParam evaluates blahblahblah - located at MyDad parent class
		$someVar = $this->evaluateParam($some_param);
	}
```

Double forward-slash comment is recommended rather than sharp comment for more convenience in typing.

---


## References
* <a href="http://php.net/manual/en/" target="_blank">http://php.net/manual/en/</a>
* <a href="https://www.php-fig.org/psr/" target="_blank">https://www.php-fig.org/psr/</a>
* <a href="https://book.cakephp.org/3.0/en/index.html" target="_blank">https://book.cakephp.org/3.0/en/index.html</a>

---