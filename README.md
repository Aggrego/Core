[![License](https://poser.pugx.org/aggrego/event-consumer/license.svg)](https://packagist.org/packages/aggrego/event-consumer)
[![Latest Stable Version](https://poser.pugx.org/aggrego/event-consumer/v/stable.svg)](https://packagist.org/packages/aggrego/event-consumer)
[![Total Downloads](https://poser.pugx.org/aggrego/event-consumer/downloads.svg)](https://packagist.org/packages/aggrego/event-consumer)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/aggrego/eventconsumer/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/aggrego/eventconsumer/?branch=master)
[![Travis](https://travis-ci.org/Aggrego/EventConsumer.svg?branch=master)](https://travis-ci.org/Aggrego/EventConsumer/builds)

# EventConsumer

This library is a core concept of communication via events. By this the base structure, we should be able to identify origins of the event:
* `Domain` as it `Name` and `Uuid` of a given entity
* `Name` of the event in a given domain that should be unique,
* `Version` that holds [Semantic Versioning v2.0.0](http://semver.org/spec/v2.0.0.html)
* `CreatedAt` hold creation time of the event

By `Client` I understand class will consume `Event` or can push the event to `Consumer`. There is no feedback needed in that process.

# Extra

In `Aggrego\EventConsumer\Shared\BlankClient` exist implementation client to ignore messages by default. 

## Versioning
 
Staring version ``0.1.0``, will follow [Semantic Versioning v2.0.0](http://semver.org/spec/v2.0.0.html).

## Contributors

* Tomasz Kunicki [TimiTao](http://github.com/timiTao) [lead developer]