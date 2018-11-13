# Reusable-Symfony-3.4-Services
A Collection of project-independent services that can be used in any project to accelerate development and provide needed functionality.

# Service Description
* [ApiError.php](ApiError.php) - Service that throws various errors based on status codes. Useful whenever creating API. Can take some amount of code away from the controller.
* [Mailer.php](Mailer.php) - Serivce that encapsulates mail sending through SwiftMailer Service. Takes unnecessary code from Controller into a separate service. Uses Sendmail. Make sure you have Sendmail properly installed and configured.
