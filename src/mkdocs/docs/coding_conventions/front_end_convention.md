# Front-End Coding Convention

This document enumerates formatting and style rules for HTML, CSS and JS. This is to help other developers or to improve collaboration and to have a quality code to the whole project.

---

---

## General Guidelines
----

### Indention  
  Use 2 spaces, don't use tabs. It can help the reviewee in github to easily compare diffs.
```html
<ul>
  <li>List 1</li>
  <li>List 2</li>
</ul>
```
### Capitalization  
  All code has to be lowercase. This applies to HTML element names, attributes, attribute values (unless text/CDATA), CSS selectors, properties, and property values (with the exception of strings).

```html
// Don't do this
<a CLASS="capital" href="#"></a>
```
```html
// Do this
<a class="capital" href="#"></a>
```
### Trailing Whitespace  
  Remove trailing white spaces. Trailing white spaces are unnecessary and can complicate diffs.
```html
// Don't do this
<p>What?_
```
```html
// Do this
<p>What?</p>
```
### Comments
  The general rule for comment is to explain code as needed, keep it readable and undestandable.
	Well commented code is really important. Don't leave other developers guessing the purpose of specific block of code.
```css
/* Bad example */
/* Modal header */
.modal-header {
  ...
}
```
```css
/* Good example */
/* Wrapping element for .modal-title and .modal-close */
.modal-header {
  ...
}
```
## HTML Guidelines
----

### Semantic Markup
  *Use well-structured, semantic markup.*

  Semantic HTML is the use of HTML markup to reinforce the semantics,
  or meaning, of the information in webpages and web applications
  rather than merely to define its presentation or look.

### Double Quotes

  Use double quotes on all attributes

### Valid HTML

  Ensure you write valid HTML. Check using tools such as the [W3C Markup Validation Service](https://validator.w3.org/)

### Optional Tags

  Do **NOT** omit optional tags. It may be unclear whether a tag has been deliberately omitted, or if it has been left out accidentally. [Check this link.](https://html.spec.whatwg.org/multipage/syntax.html#syntax-tag-omission)

### Quote Attribute Values

  Always quote attribute values, even though unquoted attributes are supported.

```html
  //Not Good
  <input type=text class=form__control>
```

```html
  //Good
  <input type="text" class="form__control">
```

### Protocols

  Remove protocols from external resources to prevent unintended security warning through protocols:

```html
// Don't do this  
<script src="https://github.com/qmu-jp/frnc-docs/blob/back_end_convention_1/doc/md/project_overview_en/back_end_convention.md"></script>
```

```html
// Do this  
<script src="//github.com/qmu-jp/frnc-docs/blob/back_end_convention_1/doc/md/project_overview_en/back_end_convention.md"></script>
```

### Boolean

  *Use the single word syntax for boolean attribute values to aid readability, reduce clutter and prevent unnecessary bytes going down the wire.*

  The presence of the attribute itself implies that the value is "true", an absence implies a value of "false":

```html
  // old
  <option selected="selected">value 1<option>
```

```html
  // new
  <option selected>value 1<option>
```

### Paragraphs

  Avoid using `<br>` tags to separate paragraphs or lines of text. Use `<p>` instead with proper opening and closing statements.

## CSS Guidelines
----

### Classes Naming
  Use <a href="http://getbem.com/">BEM's</a>, it use to divide the user interface into independent blocks. This makes interface development easy and fast even with a complex UI, and it allows reuse of existing code without copying and pasting.
```css
/* Block component */
.btn {}

/* Element that depends upon the block */
.btn__price {}

/* Modifier that changes the style of the block */
.btn--orange {}
.btn--big {}
```

### Individual Selectors
  When grouping selectors, keep individual selectors to a single line.
```css
/* Bad CSS */
.red, .blue, .yellow {
  padding: 15px;
  margin: 25px 10px;
}

/* Good CSS */
.red,
.blue,
.yellow {
  padding: 15px;
  margin: 25px 10px;
}
```
### Type Selectors
  Avoid qualifying ID and class names with type selectors.
```css
/* Bad CSS */
div#sidebar {}
main.menu {}
```
```css
/* Good CSS */
#sidebar {}
.menu {}
```
### Shorthand Properties
  Use shorthand properties where possible. Using shorthand properties is useful for code efficiency and understandability.
```css
/* Bad CSS */
.sidebar{
	padding-top: 20px;
	padding-right: 10px;
	padding-bottom: 40px;
	padding-left: 50px;
}
```
```css
/* Good CSS */
.sidebar{
	padding: 20px 10px 40px 50px;
}
```
### Property Name Space
  Use a space after a property name’s colon.
```css
/* Bad CSS */
span {
  color:red;
}
```
```css
/* Good CSS */
span {
  color: red;
}
```
### Nesting in Less and Sass
  Avoid unnecessary nesting. Just because you can nest, doesn't mean you always should. Consider nesting only if you must scope styles to a parent and if there are multiple elements to be nested.
```css
// Without nesting
.table > thead > tr > th { … }
.table > thead > tr > td { … }
```
```css
// With nesting
.table > thead > tr {
  & > th { … }
  & > td { … }
}
```



## Javascript Guidelines

### Keywords (var, let and const)

  <ul>
    <li> Prefer *const*. You can use it for all variables whose values never change </li>
    <li> Otherwise, use *let* - For variables whose values do change </li>
    <li> Avoid *var* </li>
    <li> Every statement must be terminated with a semicolon </li>
  </ul>

### Properties in object literals

  As soon as an object literal spans multiple lines, add comma after the last entry. Such a trailing comma has been legal since ES5. As a consequence, method definitions always end with `},`

```Javascript
  const obj =
  {

    foo() {

    },
    bar() {

    },
  };
```

### Code Indentation

  Always use 4 spaces for indentation of code blocks:

```Javascript
function toCelsius(fahrenheit) {
    return (5 / 9) * (fahrenheit - 32);
}
```  
### General Rules for Compound statements:

  <ul>
    <li>Put the opening bracket at the end of the first line</li>
    <li>Use one space before the opening bracket.</li>
    <li>Put the closing bracket on a new line, without leading spaces.</li>
    <li>Do not end a complex statement with a semicolon.</li>
  </ul>

Functions

```Javascript

function toCelsius(fahrenheit) {
    return (5 / 9) * (fahrenheit - 32);
}

```  

Loops

```Javascript

for (i = 0; i < 5; i++) {
    x += i;
}

```

Conditionals

```Javascript

if (time < 20) {
    greeting = "Good day";
} else {
    greeting = "Good evening";
}

```

## References

* [https://google.github.io/styleguide/htmlcssguide.html](https://google.github.io/styleguide/htmlcssguide.html)
* [https://github.com/cxpartners/coding-standards]([https://github.com/cxpartners/coding-standards])
* [http://codeguide.co/#css-syntax]([http://codeguide.co/#css-syntax])
* [https://isobar-us.github.io/code-standards/](https://isobar-us.github.io/code-standards/)
* [http://exploringjs.com/es6/ch_coding-style.html](http://exploringjs.com/es6/ch_coding-style.html)
* [https://www.w3schools.com/js/js_conventions.asp](https://www.w3schools.com/js/js_conventions.asp)
