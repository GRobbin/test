Knowit Tools - Fullstack developer test
=======================================

Hi there! Welcome to the fullstack developer test of Knowit Tools. This test is designed to test your basic knowledge in ```HTML5```, ```CSS```, ```JavaScript``` and ```PHP```. You will also need to use ```git``` and a task runner (like ```gulp```, ```grunt``` or any other task runner of your choise).

## Outline

You are taking over a non-finished project from another developer. Your goal is to finish up the project by compleating and refining the code. The main task is to make these [products](products.json) searchable by ajax technology.

You can solve the main task how you like as long as the requirements below are met.

## Requirements

- Use git for version control. Remember to commit frequently and write informative commit messages.
- Solution must use ```HTML5```, ```CSS```, ```JavaScript``` and ```PHP```.
- The search algorithm should be implemented in object orientated ```PHP```.
- The search algorithm should support negative search keywords (prefixing keyword(s) with ```-``` should exclude matching products).
- The search algorithm should sort the results by relevance.
- Follow the [PSR guidelines](http://www.php-fig.org/psr/) for ```PHP``` code style.
- Use ```ajax``` to fetch search results.
- CSS and JavaScript needs to be minified with a task runner.

## Meriting

- Separation of concerns.
- Visual design (http://www.knowit.se), mobile optimization and accessibility.
- Security awareness.
- Error handling.
- Nice urls.
- Other (related) functions to impress us (please tell us about these so we don't miss them in out tests).

## Delivery

Email us the link to the git-repository of your solution (repository needs to be public so that we can see it).

We highly recommend you to get started by forking this repository.

## Test cases

Your solution will be tested on a server running Apache and PHP7. Your solution will be tested in multiple browsers.

- Searching "digital marketing" should show thease three products (in order):
    + Digital marketing
    + Digital transformation
    + Strategy and digitalization
- Searching "digital -marketing" should show these two products (in order):
    + Digital transformation
    + Strategy and digitalization

## Keep in mind

- Take a good look at the existing code, it may not be much but it might give you some valuable information and clues on what you need to do.
- Write reusable, maintainable and well documented code.
- Frameworks are allowed, but not required.
    + If using frameworks, prefer using a dependecy manager (like Composer or npm).
- Follow the instructions (or you will fail).
