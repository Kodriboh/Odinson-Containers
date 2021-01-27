# Bjornstad

Derived from the norse word for 'son of', and spawned from my previous framework 'Hoegr' (taken from the norse word for 'conenient'), Bjornstad is a simplistic MVC framework built into it's own dockerized project container for ease-of-use. 

Bjornstad is a learning framework, utilising an advanced routing engine that uses regex to route requests between controllers. Bjornstad is intended to be used to teach the concepts of MVC by providing a bare-bones example on how modern frameworks are constructed.

## Dependencies

- Docker 
- vlucas/Dotenv

## Framework Documentation

### Routes

### Helper Functions

#### Dump and Die

As a quality-of-life feature Bjornstad contains a dump and die method. This can be used anywhere as it is included by the bootstrap.php.

<pre>
    $arr = [1, 2, 3, 4];

    dd($arr);

     Output: 
        array (size=4)
            0 => int 1
            1 => int 2
            2 => int 3
            3 => int 4
</pre>

<br> 

---

# Development Notes

This is a detailed description of the steps taken in developing this framework. This is not only to promote total transparency, but to allow you to learn from this framework as it is intended to be used as a teaching/learning tool. Please note that this framework is not battle-tested and therefore not appropriate for a production environment. 
## Front Controller

Nginx is set up to forward all traffic through to a single entry point. In this case we are routing all traffic from the browser through <code>public/index.php</code> This traffic includes parameters which are passed in through the URI as query strings. These requests are passed from the Front Controller to the router. 

## Router

## Overview

The responsibiltiy of the router is to get the <code>Controller</code> and the <code>Action</code>. The only thing the router should care about is whether or not it can find match for the provided URI in the routing table, to delegate work to the controller and method requested.

## Introduction

The router routes requests recieved from the Front Controller to the corresponding controller and action. An action is the method which is called within the controller. This is achieved by a relatively 'smart' routing table. The routing table is a basic array holding key value pairs. The stored items in this array include the <code>route</code> itself, the <code>controller</code> to call, and the <code>action</code>. If we take a look inside our routes array after adding a few routes to it we get a picture of how our routing table is being stored:

<code>
    <pre>
        array (size=3)
        '' => 
            array (size=2)
            'controller' => string 'HomeController' (length=14)
            'action' => string 'index' (length=5)
        'posts' => 
            array (size=2)
            'contorller' => string 'PostController' (length=14)
            'action' => string 'index' (length=5)
        'posts/new' => 
            array (size=2)
            'controller' => string 'Posts' (length=5)
            'action' => string 'new' (length=3)
    </pre>
</code>

The first key is our route e.g. <code>'posts'</code> which has a value of an array, containing two key-value pairs: our <code>controller</code> and our <code>method</code>. The visual below shows a design table for a basic routing table.

        | Route       | Controller  | Action      |
        | ----------- | ----------- | ----------- | 
        | "/"         | Home        | index       |
        | "/posts"    | Posts       | index       |

The route is passed in from the URl, the router then looks up the route in this routing table (array), if there is a match, the router must then look up the corresponding controller and action. The only responsibility of the router is to get the <code>Controller</code> and <code>Action</code> requested.

### Route Matching

The router match method takes a URL from the query string. This then iterates over the key-value pair array (associative array) of the routing table to find a matching route. If ther eis a route which matches, the parameters for that route are set to be the parameters passed in the query string and true is returned to indicate a match has been found, otherwise we simply return false. In the Front Controller the <code>$_SERVER</code> is accessed for the <code>REQUEST_URI</code>. 

We can check the matching by declaring a few routes and echoing out our parameters in the browser:

<pre>
        $router = new Router;

        $router->add('/', ['controller' => 'HomeController', 'action' => 'index']);
        $router->add('/posts', ['contorller' => 'PostController', 'action' => 'index']);
        $router->add('/posts/new', ['controller' => 'Posts', 'action' => 'new']);

        $url = $_SERVER['REQUEST_URI'];

        if ($router->match($url)) {
            dd($router->getParams());
        } else {
            echo "No route found for URL '$url'";
        }
</pre>

### Advanced Route Matching

Simple string routing is not efficient. Matching a simple string can lead to duplications and a much larger routing table than necessary. Instead, we can use pattern matching, as routes follow a similar pattern. We have our controller, a '/' and our action. If we can get this pattern from the URL then we can pattern-match to determine whether or not the controller and action exists within our routing table. We can do this through the use of Regular Expressions.

<br> 

#### Regex

Regular expressions are expressions used for advanced string matching/extracting. Regex can be used to create intricate rules in which characters can be compared and extracted to an exact pattern. This pattern matching enables complex behaviours such as extracting controller/method names from our routes.

##### Character Matching

Regex patterns are written between two "/".

###### Match Strings

- /abc/ - Matches abc in any string

- ^abc$ - Matches whole string "abc" only

- a+ - Match one or more "a"

- /abc/i - Match abc case insensitive

##### Symbols

- ^ - Match start of string

- $ - Match end of string

- \* - Match zero or more

- \+ \- Match one or more

- \. - Match any single character: letter, number or whitespace

- \ - Escape character

##### Modifiers

- i - Makes case insensitive

##### Character Sets

Character sets are denoted with "[]" this will match one
of any characters within the brackets e.g.[abc] matches a, b, or c nothing else.

Hyphens can be used to specify a character range e.g. [1-5].

We cancombine this with the repetition operators:

- /[a-z0-9 ]+/ - matches any sequence of alphaneumeric
characters and spaces at least one character in length.

#### Meta Characters

Used to match a specific type of character/

- \d - Matches any digit 0 to 9

- \w - Matches any character from a to z, A to Z and 0 to 9

- \s - Matches any whitespace character

#### Functoins

- preg_match($regex, $string, $matches) - matches string to regex

- preg_replace($regex, $replacement, $string) - replace matching string

#### Capture Groups

Capture Groups can be passed to regex functions which allow for it (such as preg_match). Any subpattern in parentheses will be captured as a group.

Names capture groups can be used (?<name>regex) to retrieve items by name from the capture group array.

Capture groups can be referred to using backreferences (\1,\2 etc...)

### Examples


#### Capture Group Backreference
<br>

<pre>
    $regex = '/ab(c)/';

    $replacement = '\lde';

    $string = abc;

    preg_replace($regex, $replacement, $string);

    result: cde
</pre>

#### Named Capture Groups
<br>

<pre>
    /(?<month>[a-zA-Z]+) (?<year>\d+)/
</pre>

#### Replace With Capture Groups

<pre>
    $regex =  '/(\w+) and (\w+)/';

    $replacement = '\1 or \2';

    $string = 'Bill and Ben';

    result: Bill or Ben
</pre>


___

# Resources

- Regex
    - https://www.phpliveregex.com/

- Packagist
    - https://packagist.org/

- PHP 
    - https://www.php.net/docs.php