-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 04, 2025 at 12:30 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gamification_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `achievements`
--

CREATE TABLE `achievements` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `requirement` varchar(255) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `debugging_questions`
--

CREATE TABLE `debugging_questions` (
  `id` int(11) NOT NULL,
  `language` text NOT NULL,
  `difficulty` text NOT NULL,
  `code_snippet` text NOT NULL,
  `hint` text DEFAULT NULL,
  `correct_code` text NOT NULL,
  `output_code` varchar(100) NOT NULL,
  `level` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `debugging_questions`
--

INSERT INTO `debugging_questions` (`id`, `language`, `difficulty`, `code_snippet`, `hint`, `correct_code`, `output_code`, `level`) VALUES
(80, 'Python', 'Beginner', 'x = \"5\"\ny = 3\nprint(x + y)', 'A string and a number cannot be added.', 'x = 5\ny = 3\nprint(x + y)', '8', 1),
(81, 'Python', 'Beginner', 'name = John\nprint(name)', 'String values must be inside quotes.', 'name = \"John\"\nprint(name)', 'John', 1),
(82, 'Python', 'Beginner', 'num = 10\nprint(numm)', 'Check the variable name.', 'num = 10\nprint(num)', '10', 1),
(83, 'Python', 'Beginner', 'pi = 3.14\nPi = 3.15\nprint(pi + PI)', 'Python is case-sensitive.', 'pi = 3.14\nPi = 3.15\nprint(pi + Pi)', '6.29', 1),
(84, 'Python', 'Beginner', 'is_true = true\nprint(is_true)', 'Use Python boolean keywords.', 'is_true = True\nprint(is_true)', 'True', 1),
(85, 'Python', 'Beginner', 'print(5 + )', 'The output should be 10', 'print(5 + 5)', '10', 2),
(86, 'Python', 'Beginner', 'result = 10 / 0\r\nprint(result)\r\n\r\n', 'The display results should be 5', 'result = 10 / 2\nprint(result)', '5', 2),
(87, 'Python', 'Beginner', 'x = 5\nprint(x === 5)', 'Python does not use ===.', 'x = 5\nprint(x == 5)', 'True', 2),
(88, 'Python', 'Beginner', 'a = 10\nb = 3\nprint(a // b*)', 'There is an extra symbol.', 'a = 10\nb = 3\nprint(a // b)', '3.33', 2),
(89, 'Python', 'Beginner', 'print(10 *** )', 'The power operator is **.', 'print(10 ** 3)', '1000', 2),
(90, 'Python', 'Beginner', 'age = 20\nif age > 18\n    print(\"Adult\")', 'Missing colon in the if statement.', 'age = 20\nif age > 18:\n    print(\"Adult\")', 'Adult', 3),
(91, 'Python', 'Beginner', 'num = 5\nif num == 5:\nprint(\"Five\")', 'Indentation is wrong.', 'num = 5\nif num == 5:\n    print(\"Five\")', 'Five', 3),
(92, 'Python', 'Beginner', 'for i in range(3)\n    print(i)', 'Missing colon in for loop.', 'for i in range(3):\n    print(i)', '0\r\n1\r\n2', 3),
(93, 'Python', 'Beginner', 'count = 3\nwhile count > 0\nprint(count)\ncount -= 1', 'While loop missing a colon and indentation.', 'count = 3\nwhile count > 0:\n    print(count)\n    count -= 1', '3\r\n2\r\n1', 3),
(94, 'Python', 'Beginner', 'x = 10\nif x > 5:\n    print(\"Big\")\nelse print(\"Small\")', 'Else needs a colon.', 'x = 10\nif x > 5:\n    print(\"Big\")\nelse:\n    print(\"Small\")', 'Big', 3),
(95, 'Python', 'Beginner', 'def greet\n    print(\"Hello\")', 'Function definition missing parentheses and colon.', 'def greet():\n    print(\"Hello\")', 'Hello', 4),
(96, 'Python', 'Beginner', 'def add(a, b):\nreturn a + b', 'Indent the return statement.', 'def add(a, b):\n    return a + b', '(nothing printed)', 4),
(97, 'Python', 'Beginner', 'hello()\ndef hello():\n    print(\"Hi\")', 'Function must be defined before calling.', 'def hello():\n    print(\"Hi\")\nhello()', 'Hi', 4),
(98, 'Python', 'Beginner', 'def show():\nprint(\"Test\")', 'Missing indentation.', 'def show():\n    print(\"Test\")', 'Test', 4),
(99, 'Python', 'Beginner', 'def multiply(a, b):\n    print(a * b)\nprint(multiply)', 'Function is printed instead of being called.', 'def multiply(a, b):\n    print(a * b)\nmultiply(2, 3)', '6', 4),
(100, 'Python', 'Beginner', 'nums = [1, 2, 3]\nprint(nums[3])', 'List index out of range.', 'nums = [1, 2, 3]\nprint(nums[2])', '3', 5),
(101, 'Python', 'Beginner', 'items = (\"a\", \"b\", \"c\")\nitems[0] = \"z\"', 'Tuples cannot be changed.', 'items = [\"a\", \"b\", \"c\"]\nitems[0] = \"z\"', '[ \"z\", \"b\", \"c\" ]', 5),
(102, 'Python', 'Beginner', 'fruits = [\"apple\", \"banana\"]\nprint(fruit[0])', 'Check the variable name.', 'fruits = [\"apple\", \"banana\"]\nprint(fruits[0])', 'apple, banana', 5),
(103, 'Python', 'Beginner', 'data = {\"name\": \"Ana\", \"age\": 20}\nprint(data[name])', 'Dictionary keys must be in quotes.', 'data = {\"name\": \"Ana\", \"age\": 20}\nprint(data[\"name\"])', 'Ana', 5),
(104, 'Python', 'Beginner', 'nums = [1, 2, 3]\nnums.append 4', 'append() needs parentheses.', 'nums = [1, 2, 3]\nnums.append(4)', '[1, 2, 3, 4]', 5),
(105, 'Python', 'Beginner', 'name = input(\"Enter name: Joey \"\r\nprint(name)', 'Missing closing parenthesis.', 'name = input(\"Enter name: Joey \")\r\nprint(name)', 'Joey', 6),
(106, 'Python', 'Beginner', 'print(\"Hello)', 'Missing closing quote.', 'print(\"Hello\")', 'Hello', 6),
(107, 'Python', 'Beginner', 'age = input(\"Age: 18 \")\r\nprint(\"Your age is \" + age )', 'Cannot add string and integer.', 'age = input(\"Age: 18 \")\r\nprint(\"Your age is \" + age)', 'Your age is 18', 6),
(108, 'Python', 'Beginner', 'print(Name)', 'print the name \"Jacob\"', 'Name = \"User\"\nprint(Name)', 'Jacob', 6),
(109, 'Python', 'Beginner', 'x = input(\"Enter number: \")\nprint(x * 2)', 'String multiplied by 2 repeats. Convert to int. and multiply it 10', 'x = int(input(\"Enter number: \"))\nprint(x * 2)', '20', 6);

-- --------------------------------------------------------

--
-- Table structure for table `leaderboard`
--

CREATE TABLE `leaderboard` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `score` int(11) DEFAULT 0,
  `game_mode` varchar(50) DEFAULT NULL,
  `difficulty` varchar(50) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `quiz_questions`
--

CREATE TABLE `quiz_questions` (
  `id` int(11) NOT NULL,
  `question` text NOT NULL,
  `choice_a` varchar(255) NOT NULL,
  `choice_b` varchar(255) NOT NULL,
  `choice_c` varchar(255) NOT NULL,
  `choice_d` varchar(255) NOT NULL,
  `correct_answer` text NOT NULL,
  `difficulty` varchar(50) DEFAULT NULL,
  `level` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quiz_questions`
--

INSERT INTO `quiz_questions` (`id`, `question`, `choice_a`, `choice_b`, `choice_c`, `choice_d`, `correct_answer`, `difficulty`, `level`) VALUES
(37, 'Which of these is a string in Python?', '123', '\"Hello\"', '[F]', '5.6', 'B', 'beginner', 1),
(38, 'What is the data type of 10?', 'float', 'int', 'str', 'bool', 'B', 'beginner', 1),
(39, 'Which of these is a boolean value?', '10', 'False', 'True', 'None', 'B|C', 'beginner', 1),
(40, 'What type of data does a list store?', 'Single value', 'Multiple values', 'Only numbers', 'Only strings', 'B', 'beginner', 1),
(41, 'Which of the following is a correct variable name?', '1name', 'my-name', '_name', 'my name', 'C', 'beginner', 1),
(42, 'What is the type of 3.14?', 'int', 'float', 'str', 'bool', 'B', 'beginner', 1),
(43, 'Which data type is used to store key-value pairs?', 'list', 'tuple', 'dictionary', 'set', 'C', 'beginner', 1),
(44, 'Which of these is immutable?', 'list', 'tuple', 'dictionary', 'set', 'B', 'beginner', 1),
(45, 'What is the type of \'Python\'?', 'str', 'int', 'float', 'bool', 'A', 'beginner', 1),
(46, 'Which of these is a set in Python?', '{1,2,3}', '[1,2,3]', '(1,2,3)', '{\"one\":1}', 'A', 'beginner', 1),
(47, 'Which operator is used for addition?', '+', '-', '*', '/', 'A', 'beginner', 2),
(48, 'Which operator is used for floor division?', '/', '//', '%', '**', 'B', 'beginner', 2),
(49, 'Which operator checks equality?', '=', '==', '!=', '===', 'B', 'beginner', 2),
(50, 'Which operator is used for modulus?', '/', '%', '**', '//', 'B', 'beginner', 2),
(51, 'Which operator is used for exponent?', '^', '**', 'exp', '//', 'B', 'beginner', 2),
(52, 'Which operator is used for \"not equal\"?', '!=', '==', '=', '<>', 'A', 'beginner', 2),
(53, 'Which operator is logical AND?', '&', 'and', '&&', '|', 'A|B', 'beginner', 2),
(54, 'Which operator is logical OR?', '|', 'or', '||', 'xor', 'B', 'beginner', 2),
(55, 'What is the result of 5 + 3 * 2?', '16', '11', '10', '13', 'B', 'beginner', 2),
(56, 'What is the output of 10 % 3?', '1', '3', '0', '2', 'A', 'beginner', 2),
(137, 'Which keyword is used for conditional statements?', 'if', 'loop', 'while', 'switch', 'A', 'beginner', 3),
(138, 'Which keyword is used for alternative condition?', 'elif', 'else', 'then', 'elif/else', 'A|B', 'beginner', 3),
(139, 'Which loop runs while a condition is true?', 'for', 'while', 'repeat', 'loop', 'B', 'beginner', 3),
(140, 'Which loop runs a fixed number of times?', 'while', 'repeat', 'for', 'loop', 'C', 'beginner', 3),
(141, 'Which keyword is used to stop a loop?', 'stop', 'exit', 'break', 'halt', 'C', 'beginner', 3),
(142, 'Which statement runs when all conditions fail?', 'else', 'elif', 'if', 'then', 'A', 'beginner', 3),
(143, 'What is the output of print(5>3)?', 'True', 'False', '5', '3', 'A', 'beginner', 3),
(144, 'Which loop is used to iterate over items in a list?', 'for', 'while', 'do', 'repeat', 'A', 'beginner', 3),
(145, 'Which statement is used to skip the rest of the code in a loop?', 'stop', 'continue', 'break', 'exit', 'B', 'beginner', 3),
(146, 'What is the output of print(not True)?', 'True', 'False', 'Error', 'None', 'B', 'beginner', 3),
(147, 'Which keyword is used to define a function?', 'func', 'define', 'def', 'lambda', 'C', 'beginner', 4),
(148, 'Which function is used to return a value?', 'return', 'yield', 'break', 'exit', 'A', 'beginner', 4),
(149, 'How do you call a function named greet?', 'greet()', 'call greet', 'greet', 'call()', 'A', 'beginner', 4),
(150, 'Which keyword creates an anonymous function?', 'def', 'lambda', 'func', 'anonymous', 'B', 'beginner', 4),
(151, 'Which of these is a correct function definition?', 'def myFunc():', 'function myFunc()', 'func myFunc()', 'def myFunc;', 'A', 'beginner', 4),
(152, 'What does a function do?', 'Stores data', 'Performs a task', 'Creates a variable', 'Ends program', 'B', 'beginner', 4),
(153, 'Which of these is a parameter in function?', 'x', 'print()', 'return', 'def', 'A', 'beginner', 4),
(154, 'Which of these calls a function with argument 5?', 'func(5)', 'func:5', 'func 5', 'func->5', 'A', 'beginner', 4),
(155, 'What is output of print(len(\"Python\"))?', '5', '6', '7', 'Error', 'B', 'beginner', 4),
(156, 'Which function prints output to console?', 'input()', 'print()', 'echo()', 'display()', 'B', 'beginner', 4),
(157, 'Which symbol creates a list?', '[]', '()', '{}', '<>', 'A', 'beginner', 5),
(158, 'How do you access first item of a list?', 'list[0]', 'list[1]', 'list[first]', 'list(0)', 'A', 'beginner', 5),
(159, 'Which of these adds an item to a list?', 'append()', 'add()', 'insert()', 'push()', 'A|C', 'beginner', 5),
(160, 'Which of these removes an item from a list?', 'delete()', 'remove()', 'pop()', 'discard()', 'C|B', 'beginner', 5),
(161, 'What type is (\"apple\", \"banana\")?', 'list', 'tuple', 'set', 'dictionary', 'B', 'beginner', 5),
(162, 'Which collection stores unique items?', 'list', 'tuple', 'set', 'dict', 'C', 'beginner', 5),
(163, 'Which collection stores key-value pairs?', 'list', 'tuple', 'set', 'dict', 'D', 'beginner', 5),
(164, 'Which method sorts a list?', 'sort()', 'order()', 'sorted()', 'arrange()', 'A|C', 'beginner', 5),
(165, 'What is the output of len([1,2,3])?', '2', '3', '4', '1', 'B', 'beginner', 5),
(166, 'How do you access a dictionary value by key?', 'dict[key]', 'dict.value()', 'dict[key()]', 'dict.get(key)', 'A|D', 'beginner', 5),
(177, 'Which function is used to get input from user?', 'input()', 'scan()', 'get()', 'read()', 'A', 'beginner', 6),
(178, 'Which function is used to display output?', 'show()', 'print()', 'echo()', 'display()', 'B', 'beginner', 6),
(179, 'How do you convert input to integer?', 'int()', 'str()', 'float()', 'bool()', 'A', 'beginner', 6),
(180, 'Which of these prints a message?', 'input(\"Enter\")', 'print(\"Hello\")', 'echo(\"Hi\")', 'show(\"Hello\")', 'B', 'beginner', 6),
(181, 'What is the default type of input()?', 'int', 'str', 'float', 'bool', 'B', 'beginner', 6),
(182, 'Which statement concatenates strings?', '+', '-', '*', '/', 'A', 'beginner', 6),
(183, 'How do you print multiple items?', 'print(x,y)', 'print(x+y)', 'print(x*y)', 'print(x-y)', 'A', 'beginner', 6),
(184, 'What is output of print(\"Hi \" + \"Rain\")?', 'Hi Rain', 'Hi+Rain', 'HiRain', 'Hi Rain!', 'A', 'beginner', 6),
(185, 'Which function stops the program?', 'exit()', 'stop()', 'break()', 'end()', 'A', 'beginner', 6),
(186, 'How do you read a number input?', 'input()', 'int(input())', 'float(input())', 'All of the above', 'B|C', 'beginner', 6),
(187, 'What symbol is used to apply a decorator?', '@', '#', '$', '&', 'A', 'advanced', 1),
(188, 'A decorator in Python is applied to:', 'Functions', 'Variables', 'Classes only', 'Modules', 'A', 'advanced', 1),
(189, 'What does a decorator return?', 'A function', 'A class', 'A string', 'Nothing', 'A|B', 'advanced', 1),
(190, 'Which keyword defines an inner function?', 'def', 'func', 'inner', 'lambda', 'A', 'advanced', 1),
(191, 'What is the purpose of *args in decorators?', 'Handle any number of arguments', 'Handle errors', 'Speed up functions', 'Return lists', 'A', 'advanced', 1),
(192, 'What is the purpose of **kwargs?', 'Handle named arguments', 'Create variables', 'Define lists', 'Replace arguments', 'A', 'advanced', 1),
(193, 'Which decorator preserves metadata of a function?', 'functools.wraps', 'functools.meta', 'decorator.wrap', 'wrap()', 'A', 'advanced', 1),
(194, 'Decorators are executed when?', 'At function definition', 'At program exit', 'Only at runtime', 'Only on import', 'A', 'advanced', 1),
(195, 'What does @staticmethod decorate?', 'A method without self', 'A class', 'A module', 'A property', 'A', 'advanced', 1),
(196, 'What does @property create?', 'Getter method', 'Setter method', 'Class variable', 'Private attribute', 'A', 'advanced', 1),
(197, 'Which keyword creates a generator?', 'yield', 'return', 'generate', 'yield()', 'A', 'advanced', 2),
(198, 'Generators return:', 'Iterators', 'Lists', 'Tuples', 'Dictionaries', 'A', 'advanced', 2),
(199, 'What is the method that gets next value from iterator?', 'next()', 'forward()', 'step()', 'fetch()', 'A', 'advanced', 2),
(200, '__next__() must return:', 'An iterator', 'A list', 'Any object', 'A tuple', 'A', 'advanced', 2),
(201, '__iter__() must return:', 'An iterator', 'A list', 'A dictionary', 'A string', 'A', 'advanced', 2),
(202, 'What exception stops iteration?', 'StopIteration', 'EndIteration', 'NextError', 'LoopStop', 'A', 'advanced', 2),
(203, 'Which generator expression is correct?', '(x*2 for x in range(5))', '[x*2 for x in range(5)]', '{x*2 for x in range(5)}', '<x*2 for x in range(5)>', 'A', 'advanced', 2),
(204, 'Generators save memory because they:', 'Produce values lazily', 'Use caching', 'Compress data', 'Store everything', 'A', 'advanced', 2),
(205, 'What does next() do?', 'Gets next item', 'Restarts loop', 'Ends loop', 'Copies list', 'A', 'advanced', 2),
(206, 'Can a generator be reused?', 'No', 'Yes', 'Sometimes', 'Only if reset', 'A', 'advanced', 2),
(207, 'Which module is used for multithreading?', 'threading', 'process', 'parallel', 'async', 'A', 'advanced', 3),
(208, 'Which module is used for multiprocessing?', 'multiprocessing', 'threading', 'parallel', 'subprocess', 'A', 'advanced', 3),
(209, 'Which issue affects multithreading in Python?', 'GIL', 'CPU lag', 'Memory leak', 'I/O freeze', 'A', 'advanced', 3),
(210, 'Threads are best for:', 'I/O tasks', 'CPU tasks', 'Graphics tasks', 'Math tasks', 'A', 'advanced', 3),
(211, 'Processes are best for:', 'CPU-heavy tasks', 'I/O tasks', 'Reading files', 'Networking', 'A', 'advanced', 3),
(212, 'Which function starts a thread?', 'start()', 'run()', 'begin()', 'execute()', 'A', 'advanced', 3),
(213, 'Which function waits for a thread to finish?', 'join()', 'wait()', 'stop()', 'follow()', 'A', 'advanced', 3),
(214, 'Which multiprocessing class runs tasks?', 'Process', 'Thread', 'Runner', 'Core', 'A', 'advanced', 3),
(215, 'What is shared between threads?', 'Memory', 'Processes', 'Classes', 'Modules only', 'A|D', 'advanced', 3),
(216, 'What is shared between processes?', 'Nothing by default', 'Everything', 'Only classes', 'Threads only', 'A', 'advanced', 3),
(217, 'Which module provides abstract classes?', 'abc', 'abstract', 'oop', 'inherit', 'A', 'advanced', 4),
(218, 'Which decorator marks abstract methods?', '@abstractmethod', '@method', '@abstract', '@abs', 'A', 'advanced', 4),
(219, 'What is method overriding?', 'Redefining a method in child class', 'Creating method twice', 'Using same method everywhere', 'Changing class name', 'A', 'advanced', 4),
(220, 'What is polymorphism?', 'Same method different behavior', 'Many classes one object', 'Copying objects', 'Hiding data', 'A', 'advanced', 4),
(221, 'Multiple inheritance means:', 'Class inherits many parents', 'Class has many children', 'Class has many objects', 'Class has many methods', 'A', 'advanced', 4),
(222, 'What does super() do?', 'Call parent methods', 'Call child', 'Exit function', 'Import class', 'A', 'advanced', 4),
(223, 'What is an abstract class?', 'Class with abstract methods', 'Class without objects', 'Class with no variables', 'Class with no methods', 'A', 'advanced', 4),
(224, 'What is a mixin?', 'Class providing helper features', 'A main class', 'A parent-only class', 'Hidden attribute', 'A', 'advanced', 4),
(225, 'Which method represents a formal string?', '__repr__', '__str__', '__format__', '__meta__', 'A', 'advanced', 4),
(226, 'Which principle hides implementation?', 'Abstraction', 'Inheritance', 'Polymorphism', 'Reduction', 'A', 'advanced', 4),
(227, 'Which structure is immutable?', 'Tuple', 'List', 'Dict', 'Set', 'A', 'advanced', 5),
(228, 'Which data structure stores unique items?', 'Set', 'Tuple', 'List', 'Dict', 'A', 'advanced', 5),
(229, 'Which syntax creates a set?', '{1,2,3}', '[1,2,3]', '(1,2,3)', '{1:2}', 'A', 'advanced', 5),
(230, 'Which operation finds common elements?', 'intersection()', 'combine()', 'match()', 'same()', 'A', 'advanced', 5),
(231, 'Which creates a dictionary comprehension?', '{k:v for k,v in items}', '(k:v for k,v in items)', '[k=v for k,v in items]', '{k-v for k,v in items}', 'A', 'advanced', 5),
(232, 'What method adds element to set?', 'add()', 'push()', 'insert()', 'append()', 'A', 'advanced', 5),
(233, 'Which structure uses key-value pairs?', 'Dictionary', 'Set', 'List', 'Tuple', 'A', 'advanced', 5),
(234, 'Which method removes and returns a random set item?', 'pop()', 'remove()', 'delete()', 'discard()', 'A', 'advanced', 5),
(235, 'What happens when adding duplicate to set?', 'Ignored', 'Error', 'Added twice', 'Converted to list', 'A', 'advanced', 5),
(236, 'How to get dictionary keys?', 'dict.keys()', 'dict.getkeys()', 'dict.items()', 'dict.values()', 'A', 'advanced', 5),
(238, 'Which keyword pauses coroutine until completed?', 'await', 'async', 'pause', 'stop', 'A', 'advanced', 6),
(239, 'Which module supports async operations?', 'asyncio', 'threading', 'future', 'parallel', 'A', 'advanced', 6),
(240, 'async functions return:', 'Coroutines', 'Lists', 'Threads', 'Processes', 'A', 'advanced', 6),
(241, 'Which function runs async event loop?', 'asyncio.run()', 'async.go()', 'async.start()', 'event.run()', 'A', 'advanced', 6),
(242, 'Coroutines are:', 'Special functions that can pause', 'Normal functions', 'Threads', 'Processes', 'A', 'advanced', 6),
(243, 'await can only be used in:', 'async functions', 'normal functions', 'global scope', 'class only', 'A', 'advanced', 6),
(244, 'Async programming is best for:', 'I/O tasks', 'CPU tasks', 'Graphics', 'Math', 'A', 'advanced', 6),
(245, 'Which object represents a scheduled async task?', 'Task', 'Thread', 'Process', 'Future', 'A|D', 'advanced', 6),
(246, 'What happens if you call async function without await?', 'Returns coroutine object', 'Runs immediately', 'Error', 'Crashes', 'A', 'advanced', 6),
(247, 'Which keyword defines a coroutine?', 'async', 'await', 'asyncio', 'future', 'A', 'advanced', 6),
(257, 'Which mode opens a file for reading?', 'r', 'w', 'a', 'x', 'A', 'intermediate', 2),
(258, 'Which mode opens a file for writing and overwrites existing content?', 'r', 'w', 'a', 'x', 'B', 'intermediate', 2),
(259, 'Which statement automatically closes a file?', 'with open()', 'file.close()', 'open.close()', 'file.auto()', 'A', 'intermediate', 2),
(260, 'Which method reads the entire file content?', 'read()', 'readline()', 'readlines()', 'fetch()', 'A|C', 'intermediate', 2),
(261, 'Which method writes text to a file?', 'write()', 'insert()', 'add()', 'put()', 'A', 'intermediate', 2),
(262, 'How do you append text to a file?', 'open(\"file.txt\",\"a\")', 'open(\"file.txt\",\"r\")', 'open(\"file.txt\",\"w\")', 'open(\"file.txt\",\"x\")', 'A', 'intermediate', 2),
(263, 'What does readlines() return?', 'A list of lines', 'A string', 'A dictionary', 'Error', 'A', 'intermediate', 2),
(264, 'Which function closes a file?', 'file.close()', 'file.exit()', 'file.stop()', 'file.end()', 'A', 'intermediate', 2),
(265, 'What happens if you open a file in \"x\" mode and file exists?', 'Overwrites it', 'Error', 'Appends', 'Reads', 'B', 'intermediate', 2),
(266, 'Which method moves the file pointer?', 'seek()', 'move()', 'pointer()', 'shift()', 'A', 'intermediate', 2),
(267, 'Which keyword handles exceptions?', 'try', 'catch', 'error', 'handle', 'A', 'intermediate', 3),
(268, 'Which block runs regardless of exception?', 'finally', 'except', 'else', 'try', 'A', 'intermediate', 3),
(269, 'Which keyword catches an exception?', 'except', 'catch', 'error', 'handle', 'A', 'intermediate', 3),
(270, 'How do you raise a custom exception?', 'raise Exception(\"Error\")', 'throw Exception', 'error Exception', 'fail Exception', 'A', 'intermediate', 3),
(271, 'Which exception occurs for division by zero?', 'ZeroDivisionError', 'ValueError', 'TypeError', 'IndexError', 'A', 'intermediate', 3),
(272, 'Which block runs if no exception occurs?', 'else', 'finally', 'except', 'try', 'A', 'intermediate', 3),
(273, 'Which exception occurs for invalid index?', 'IndexError', 'ValueError', 'KeyError', 'TypeError', 'A', 'intermediate', 3),
(274, 'Which exception occurs for invalid type operation?', 'TypeError', 'ValueError', 'KeyError', 'IndexError', 'A', 'intermediate', 3),
(275, 'Which exception occurs for invalid value?', 'ValueError', 'TypeError', 'KeyError', 'IndexError', 'A', 'intermediate', 3),
(276, 'Which exception occurs for missing dictionary key?', 'KeyError', 'IndexError', 'ValueError', 'TypeError', 'A', 'intermediate', 3),
(277, 'Which keyword imports a module?', 'import', 'require', 'include', 'using', 'A', 'intermediate', 4),
(278, 'How do you import a specific function from a module?', 'from module import func', 'import module.func', 'require module func', 'using module.func', 'A', 'intermediate', 4),
(279, 'Which module generates random numbers?', 'random', 'math', 'os', 'sys', 'A', 'intermediate', 4),
(280, 'Which module helps with date and time?', 'datetime', 'calendar', 'time', 'os', 'A', 'intermediate', 4),
(281, 'Which statement shows all functions in a module?', 'dir(module)', 'list(module)', 'show(module)', 'help(module)', 'A', 'intermediate', 4),
(282, 'Which module handles operating system tasks?', 'os', 'sys', 'math', 'random', 'A', 'intermediate', 4),
(283, 'Which function gives help about a module?', 'help(module)', 'info(module)', 'show(module)', 'dir(module)', 'A', 'intermediate', 4),
(284, 'Which module provides mathematical functions?', 'math', 'random', 'os', 'sys', 'A', 'intermediate', 4),
(285, 'Which statement runs all functions in a module interactively?', 'dir(module)', 'run(module)', 'exec(module)', 'help(module)', 'D', 'intermediate', 4),
(286, 'Which module handles system-specific parameters?', 'sys', 'os', 'math', 'time', 'A', 'intermediate', 4),
(287, 'Which keyword defines a class?', 'class', 'def', 'object', 'module', 'A', 'intermediate', 5),
(288, 'Which is an instance of a class?', 'object', 'method', 'function', 'variable', 'A', 'intermediate', 5),
(289, 'Which method runs when an object is created?', '__init__', '__start__', '__create__', '__new__', 'A', 'intermediate', 5),
(290, 'Which keyword is used for inheritance?', 'class', 'def', 'super', 'self', 'C', 'intermediate', 5),
(291, 'Which keyword refers to the object itself?', 'self', 'this', 'object', 'me', 'A', 'intermediate', 5),
(292, 'Which method represents object as string?', '__str__', '__repr__', '__init__', '__call__', 'A', 'intermediate', 5),
(293, 'How do you call a method of an object?', 'object.method()', 'method.object()', 'object->method()', 'call(object.method)', 'A', 'intermediate', 5),
(294, 'Which principle hides internal details?', 'Encapsulation', 'Inheritance', 'Polymorphism', 'Abstraction', 'A', 'intermediate', 5),
(295, 'Which principle allows many forms?', 'Polymorphism', 'Inheritance', 'Encapsulation', 'Abstraction', 'A', 'intermediate', 5),
(296, 'Which principle reuses code from another class?', 'Inheritance', 'Polymorphism', 'Encapsulation', 'Abstraction', 'A', 'intermediate', 5),
(297, 'Which symbol starts a lambda function?', 'lambda', 'def', 'func', 'anonymous', 'A', 'intermediate', 6),
(298, 'What does [x*2 for x in range(3)] return?', '[0,2,4]', '[1,2,3]', '[0,1,2]', '[2,4,6]', 'A', 'intermediate', 6),
(299, 'Which lambda adds two numbers?', 'lambda x,y: x+y', 'lambda x+y', 'lambda(x,y){x+y}', 'lambda x y -> x+y', 'A', 'intermediate', 6),
(300, 'Which is a correct list comprehension?', '[x for x in range(5)]', '[x in range(5)]', '{x for x in range(5)}', '(x for x in range(5))', 'A|D', 'intermediate', 6),
(301, 'What is the output of list(map(lambda x: x*2, [1,2,3]))?', '[2,4,6]', '[1,2,3]', '[1,4,9]', '[0,2,4]', 'A', 'intermediate', 6),
(302, 'Which function applies a function to all items in a list?', 'map()', 'filter()', 'reduce()', 'apply()', 'A', 'intermediate', 6),
(303, 'Which list comprehension filters even numbers?', '[x for x in range(5) if x%2==0]', '[x for x in range(5) if x%2!=0]', '[x for x in range(5)]', '[x for x in range(5) if x>2]', 'A', 'intermediate', 6),
(304, 'How do you assign a lambda to variable?', 'f = lambda x: x+1', 'f(x) = lambda x+1', 'lambda f(x): x+1', 'f = def(x): x+1', 'A', 'intermediate', 6),
(305, 'Which returns squares of numbers 0-4?', '[x**2 for x in range(5)]', '[x*2 for x in range(5)]', '[x+2 for x in range(5)]', '[x**3 for x in range(5)]', 'A', 'intermediate', 6),
(306, 'Which keyword is optional in list comprehension for filtering?', 'if', 'for', 'lambda', 'in', 'A', 'intermediate', 6),
(307, 'Which method converts a string to uppercase?', 'upper()', 'uppercase()', 'up()', 'caps()', 'A', 'intermediate', 1),
(308, 'What does \" Hello \".strip() do?', 'Removes spaces at start/end', 'Converts to lowercase', 'Replaces spaces with underscores', 'Error', 'A', 'intermediate', 1),
(309, 'How do you get the first 3 characters of a string s?', 's[0:3]', 's[:2]', 's[1:3]', 's[0,3]', 'A', 'intermediate', 1),
(310, 'Which method replaces text in a string?', 'replace()', 'switch()', 'update()', 'change()', 'A', 'intermediate', 1),
(311, 'What is the output of len(\"Python\")?', '5', '6', '7', 'Error', 'B', 'intermediate', 1),
(312, 'How do you check if a string starts with \"Py\"?', 'startswith(\"Py\")', 'start(\"Py\")', 'begin(\"Py\")', 'init(\"Py\")', 'A', 'intermediate', 1),
(313, 'Which symbol is used for string formatting with f-strings?', '{}', '%', 'f\"\"', '$', 'C', 'intermediate', 1),
(314, 'What is the output of \"Hi\" + \"There\"?', 'HiThere', 'Hi There', 'Hi+There', 'Error', 'A', 'intermediate', 1),
(315, 'How do you convert \"123\" to integer?', 'int(\"123\")', 'str(\"123\")', 'float(\"123\")', 'bool(\"123\")', 'A', 'intermediate', 1),
(316, 'Which method counts occurrences of a substring?', 'count()', 'find()', 'index()', 'length()', 'A', 'intermediate', 1);

-- --------------------------------------------------------

--
-- Table structure for table `register`
--

CREATE TABLE `register` (
  `id` int(11) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `register`
--

INSERT INTO `register` (`id`, `fname`, `lname`, `username`, `email`, `password`, `created_at`) VALUES
(1, 'dsada', 'dsada', 'universalrain23', 'april@gmail.com', '$2y$10$q8v/rlOiTQ9XgUsXEvyIvuJEWgZvzfIstWRvLUNvOaaPdxmk3PDQG', '2025-11-29 17:33:49'),
(2, 'rara', 'rara', 'r.mendoza.221752', 'lilrain232@gmail.com', '$2y$10$BGKCAfaNAeNSZBYCsmUILejIHop8dAExlN4qJneb4m4V.kUoyb2Xe', '2025-12-01 16:06:14');

-- --------------------------------------------------------

--
-- Table structure for table `user_achievements`
--

CREATE TABLE `user_achievements` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `achievement_id` int(11) NOT NULL,
  `unlocked_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `achievements`
--
ALTER TABLE `achievements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `debugging_questions`
--
ALTER TABLE `debugging_questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leaderboard`
--
ALTER TABLE `leaderboard`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `quiz_questions`
--
ALTER TABLE `quiz_questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `register`
--
ALTER TABLE `register`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_achievements`
--
ALTER TABLE `user_achievements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `achievement_id` (`achievement_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `achievements`
--
ALTER TABLE `achievements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `debugging_questions`
--
ALTER TABLE `debugging_questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- AUTO_INCREMENT for table `leaderboard`
--
ALTER TABLE `leaderboard`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `quiz_questions`
--
ALTER TABLE `quiz_questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=317;

--
-- AUTO_INCREMENT for table `register`
--
ALTER TABLE `register`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_achievements`
--
ALTER TABLE `user_achievements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `leaderboard`
--
ALTER TABLE `leaderboard`
  ADD CONSTRAINT `leaderboard_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `register` (`id`);

--
-- Constraints for table `user_achievements`
--
ALTER TABLE `user_achievements`
  ADD CONSTRAINT `user_achievements_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `register` (`id`),
  ADD CONSTRAINT `user_achievements_ibfk_2` FOREIGN KEY (`achievement_id`) REFERENCES `achievements` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
