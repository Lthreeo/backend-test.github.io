# PHP

## 1. What is the size of this array? 
```php
$arr = []; 
$arr[8] = 'test';
```

**Answer:** 
  - [X] 1 - count($arr) = 1. 8 represent the index of 'test' value in array $arr
  - [ ] 8 
  - [ ] 9


## 2. How many classes are instantiated?
```php
class A { }
class B { }
              
$a = new A(); 
$b = new B();
$c = $b;
```

**Answer:**
  - [ ] 1
  - [X] 2 - Reference of $b is assigned to $c.
  - [ ] 3

## 3. What is the output of the following snippets?

A.
```php 
$arr = [3, 1];
foreach ($arr as $item) {
    $item++;
}
$nb = (int) implode('', $arr);
echo $nb;
```

**Answer:** ?   
31

(int) is a cast of implode() result.    
implode() concat each item of `$arr` with no char glue.     
$item incrementation do nothing here & it doesn't use. $item is a copy of $arr[n] value.

B.
```php
$a = '1';

// $b init with the reference of $a
$b = &$a;

// $b is modified. So $a value too. $b = $a = 41
$b = "4{$b}"; 

// echo $b++ have no effect because the increment is proceed after $b++ instruction.
echo $a . ',' . $b++;

// 1; To affect the echo with the increment : use ++$b or add $b in echo concat
// 2; echo again will show 42,42. And $b = $a = 42
```

**Answer:** ?
41,41   
Explanation in code above


## 4. Which PHP code snippet shows an example of Dependency Injection?

A.
```php
class Client 
{
    private $logger;
    
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }
}
```

B.
```php
class Client 
{
    private $logger;
    
    public function __construct()
    {
        $this->logger = new Logger();
    }
}
```

C.
```php
    $client = new Client();
    $logger = new Logger();
    inject($client, $logger);
```

**Answer:**
  - [X] A - Argument $logger is an instance of a dependency previously instantiated (Outside of Client). Very powerful to may use   
  - [ ] B
  - [X] C


## 5. Name the following design patterns.

#### Design Pattern #1

```php
class MyClass 
{
    public static function newInstance(string: $type): Formatter {
        if ('number' === $type) {
            return new FormatNumber();
        } elseif ('string' === $type) {
            return new FormatString();
        }
    }
}
```
   
**Answer** : ?
It is a factory. Depends on $type argument the method return the appropriate object instance.   
Additional: FormatNumber & FormatString are child of Formatter (interface or extends class).
   
#### Design Pattern #2   

```php
class MyClass 
{
    private $_stays = [];

    private $_currentIndex = 0;

    public function count(): int
    {
        return count($this->_stays);
    }

    public function current(): Stay
    {
        return $this->_stays[$this->_currentIndex];
    }

    public function key: int
    {
        return $this->_currentIndex;
    }

    public function next()
    {
        return $this->_currentIndex++;
    }

    public function rewind()
    {
        return $this->_currentIndex = 0;
    }

    public function valid(): bool
    {
        return isset($this->_stays[$this->_currentIndex]);
    }
}
```

**Answer** : ?
It is iterator design pattern.  
This design help us to fetch an array of Stay objects with methods to secure fetching & do actions on fetching state. 
