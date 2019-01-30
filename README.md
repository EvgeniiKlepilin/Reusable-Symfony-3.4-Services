# Reusable-Symfony-3.4-Services
A Collection of project-independent services that can be used in any project to accelerate development and provide needed functionality.

# Service Description
* [ApiError.php](ApiError.php) - Service that throws various errors based on status codes. Useful whenever creating API. Can take some amount of code away from the controller.
* [Mailer.php](Mailer.php) - Serivce that encapsulates mail sending through SwiftMailer Service. Takes unnecessary code from Controller into a separate service. Uses Sendmail. Make sure you have Sendmail properly installed and configured.
* [Checker.php](Checker.php) - Service that outsources long conditional statements for the sake of keeping the code clean. Especially when it comes to controller code.
* [FileUrler.php](FileUrler.php) - Service that uses UploaderHelper from VichUploaderBundle to turn just filenames into full relative paths filenames. Very useful when working with API Clients: client will be able to use this URL with no problem.
* [FilterProcessor.php](FilterProcessor.php) - Creates valid DQL filters for select query. Filters must be provided as an array of arrays: {"field" => "field_name", "value" => "value", "operator" => "operator"}. Acceptable Operator Values: eq | gt | lt | gte | lte | neq | in | notIn. Very flexible across various Entities as long as you use same naming rules and try to standardize it as much as you can.
* [Generator.php](Generator.php) - Service that outsources generation of tokens and strings. Can be made to be static.
* [ApiService.php](ApiService.php) - Service that allows for easy implementation of use of 3-rd party API. Good example of OOP design.
