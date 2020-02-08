[![License](https://poser.pugx.org/aggrego/command-consumer/license.svg)](https://packagist.org/packages/aggrego/command-consumer)
[![Latest Stable Version](https://poser.pugx.org/aggrego/command-consumer/v/stable.svg)](https://packagist.org/packages/aggrego/command-consumer)
[![Total Downloads](https://poser.pugx.org/aggrego/command-consumer/downloads.svg)](https://packagist.org/packages/aggrego/command-consumer)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/aggrego/commandconsumer/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/aggrego/commandconsumer/?branch=master)
[![Travis](https://travis-ci.org/Aggrego/CommandConsumer.svg?branch=master)](https://travis-ci.org/Aggrego/CommandConsumer/builds)

# CommandConsumer

This library is a core concept of communication via commands.

### Assumptions

* Command are unique and need to be recognized via `Uuid`,
* Commands don't return any response - they are or not executed simply,
* Each command should be able to recreate class via implements `Serializable`.

Response:
* suggest that depends on implemented `Command` type, should follow rules for `CQRS`. Mostly relied [source](https://stackoverflow.com/a/43493623/1584408). 

## Versioning
 
Staring version ``1.0.0``, will follow [Semantic Versioning v2.0.0](http://semver.org/spec/v2.0.0.html).

## Contributors

* Tomasz Kunicki [TimiTao](http://github.com/timiTao) [lead developer]