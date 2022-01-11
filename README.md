# Dependency Injection

## Learning objectives
- Understand the value of a Dependency Injection Layer
- Use the DI container inside Symfony
- Know how to configure services and dependencies

### Steps
- [x] Create an interface called `transform`
- [x] Create a class which capitalizes every other letter in a string. Implement the `transform` interface.
- [x] Create another class which changes all spaces to dashes "-". Implement the `transform` interface.
- [x] Create a logger class which logs messages in a file called "log.info" using [Monolog](https://github.com/Seldaek/monolog).
- [x] Create a "master" class that accepts the user input and uses the previously created classes to log and convert the user input. (Without using the "new" keyword)
- [x] Execute the master class in a controller
- [x] Add a dropdown where the user can choose a converter (this should work without changing the code in the master class -> Polymorphism).
