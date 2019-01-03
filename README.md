[![License](https://poser.pugx.org/aggrego/command-consumer/license.svg)](https://packagist.org/packages/aggrego/command-consumer)
[![Latest Stable Version](https://poser.pugx.org/aggrego/command-consumer/v/stable.svg)](https://packagist.org/packages/aggrego/command-consumer)
[![Total Downloads](https://poser.pugx.org/aggrego/command-consumer/downloads.svg)](https://packagist.org/packages/aggrego/command-consumer)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/aggrego/commandconsumer/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/aggrego/commandconsumer/?branch=master)
[![Travis](https://travis-ci.org/Aggrego/CommandConsumer.svg?branch=master)](https://travis-ci.org/Aggrego/CommandConsumer/builds)

# CommandConsumer

Base interface for any integration cooperates with commands.

### Assumptions

Commands:

* need to be unique
* need to return `Response`

Response:
* suggest that depends on implemented `Command` type, should follow rules for `CQRS`. Mostly relied [source](https://stackoverflow.com/a/43493623/1584408). 

## Versioning
 
Staring version ``1.0.0``, will follow [Semantic Versioning v2.0.0](http://semver.org/spec/v2.0.0.html).

## Contributors

* Tomasz Kunicki [TimiTao](http://github.com/timiTao) [lead developer]