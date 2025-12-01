-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 01, 2025 at 07:50 AM
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
  `level` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `debugging_questions`
--

INSERT INTO `debugging_questions` (`id`, `language`, `difficulty`, `code_snippet`, `hint`, `correct_code`, `level`) VALUES
(4, 'Python', 'Beginner', 'print(2 + 3)', 'Check if the math is correct.', 'print(5)', 1),
(5, 'Python', 'Beginner', 'def hello print(\"Hello\")', 'You are missing something after hello.', 'def hello():\n    print(\"Hello\")', 2),
(6, 'Python', 'Beginner', 'for i in range(5)\n    print(i)', 'Missing symbol after range(5)', 'for i in range(5):\n    print(i)', 3);

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
  `correct_answer` varchar(10) NOT NULL,
  `difficulty` varchar(50) DEFAULT NULL,
  `level` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quiz_questions`
--

INSERT INTO `quiz_questions` (`id`, `question`, `choice_a`, `choice_b`, `choice_c`, `choice_d`, `correct_answer`, `difficulty`, `level`) VALUES
(37, 'Which of these is a string in Python?', '123', 'Hello', 'True', '5.6', 'B', 'beginner', 1),
(38, 'What is the data type of 10?', 'float', 'int', 'str', 'bool', 'B', 'beginner', 1),
(39, 'Which of these is a boolean value?', '10', 'False', 'True', 'None', 'C', 'beginner', 1),
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
(53, 'Which operator is logical AND?', '&', 'and', '&&', '|', 'B', 'beginner', 2),
(54, 'Which operator is logical OR?', '|', 'or', '||', 'xor', 'B', 'beginner', 2),
(55, 'What is the result of 5 + 3 * 2?', '16', '11', '10', '13', 'B', 'beginner', 2),
(56, 'What is the output of 10 % 3?', '1', '3', '0', '2', 'A', 'beginner', 2),
(137, 'Which keyword is used for conditional statements?', 'if', 'loop', 'while', 'switch', 'A', 'beginner', 3),
(138, 'Which keyword is used for alternative condition?', 'elif', 'else', 'then', 'elif/else', 'B', 'beginner', 3),
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
(159, 'Which of these adds an item to a list?', 'append()', 'add()', 'insert()', 'push()', 'A', 'beginner', 5),
(160, 'Which of these removes an item from a list?', 'delete()', 'remove()', 'pop()', 'discard()', 'C', 'beginner', 5),
(161, 'What type is (\"apple\", \"banana\")?', 'list', 'tuple', 'set', 'dictionary', 'B', 'beginner', 5),
(162, 'Which collection stores unique items?', 'list', 'tuple', 'set', 'dict', 'C', 'beginner', 5),
(163, 'Which collection stores key-value pairs?', 'list', 'tuple', 'set', 'dict', 'D', 'beginner', 5),
(164, 'Which method sorts a list?', 'sort()', 'order()', 'sorted()', 'arrange()', 'A', 'beginner', 5),
(165, 'What is the output of len([1,2,3])?', '2', '3', '4', '1', 'B', 'beginner', 5),
(166, 'How do you access a dictionary value by key?', 'dict[key]', 'dict.value()', 'dict[key()]', 'dict.get(key)', 'A', 'beginner', 5),
(177, 'Which function is used to get input from user?', 'input()', 'scan()', 'get()', 'read()', 'A', 'beginner', 6),
(178, 'Which function is used to display output?', 'show()', 'print()', 'echo()', 'display()', 'B', 'beginner', 6),
(179, 'How do you convert input to integer?', 'int()', 'str()', 'float()', 'bool()', 'A', 'beginner', 6),
(180, 'Which of these prints a message?', 'input(\"Enter\")', 'print(\"Hello\")', 'echo(\"Hi\")', 'show(\"Hello\")', 'B', 'beginner', 6),
(181, 'What is the default type of input()?', 'int', 'str', 'float', 'bool', 'B', 'beginner', 6),
(182, 'Which statement concatenates strings?', '+', '-', '*', '/', 'A', 'beginner', 6),
(183, 'How do you print multiple items?', 'print(x,y)', 'print(x+y)', 'print(x*y)', 'print(x-y)', 'A', 'beginner', 6),
(184, 'What is output of print(\"Hi \" + \"Rain\")?', 'Hi Rain', 'Hi+Rain', 'HiRain', 'Hi Rain!', 'A', 'beginner', 6),
(185, 'Which function stops the program?', 'exit()', 'stop()', 'break()', 'end()', 'A', 'beginner', 6),
(186, 'How do you read a number input?', 'input()', 'int(input())', 'float(input())', 'All of the above', 'D', 'beginner', 6),
(187, 'What symbol is used to apply a decorator?', '@', '#', '$', '&', 'A', 'advanced', 1),
(188, 'A decorator in Python is applied to:', 'Functions', 'Variables', 'Classes only', 'Modules', 'A', 'advanced', 1),
(189, 'What does a decorator return?', 'A function', 'A class', 'A string', 'Nothing', 'A', 'advanced', 1),
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
(215, 'What is shared between threads?', 'Memory', 'Processes', 'Classes', 'Modules only', 'A', 'advanced', 3),
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
(237, 'Which keyword defines a coroutine?', 'async', 'await', 'asyncio', 'future', 'A', 'advanced', 6),
(238, 'Which keyword pauses coroutine until completed?', 'await', 'async', 'pause', 'stop', 'A', 'advanced', 6),
(239, 'Which module supports async operations?', 'asyncio', 'threading', 'future', 'parallel', 'A', 'advanced', 6),
(240, 'async functions return:', 'Coroutines', 'Lists', 'Threads', 'Processes', 'A', 'advanced', 6),
(241, 'Which function runs async event loop?', 'asyncio.run()', 'async.go()', 'async.start()', 'event.run()', 'A', 'advanced', 6),
(242, 'Coroutines are:', 'Special functions that can pause', 'Normal functions', 'Threads', 'Processes', 'A', 'advanced', 6),
(243, 'await can only be used in:', 'async functions', 'normal functions', 'global scope', 'class only', 'A', 'advanced', 6),
(244, 'Async programming is best for:', 'I/O tasks', 'CPU tasks', 'Graphics', 'Math', 'A', 'advanced', 6),
(245, 'Which object represents a scheduled async task?', 'Task', 'Thread', 'Process', 'Future', 'A', 'advanced', 6),
(246, 'What happens if you call async function without await?', 'Returns coroutine object', 'Runs immediately', 'Error', 'Crashes', 'A', 'advanced', 6);

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
(1, 'dsada', 'dsada', 'universalrain23', 'april@gmail.com', '$2y$10$q8v/rlOiTQ9XgUsXEvyIvuJEWgZvzfIstWRvLUNvOaaPdxmk3PDQG', '2025-11-29 17:33:49');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `leaderboard`
--
ALTER TABLE `leaderboard`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `quiz_questions`
--
ALTER TABLE `quiz_questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=247;

--
-- AUTO_INCREMENT for table `register`
--
ALTER TABLE `register`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
