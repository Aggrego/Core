[![License](https://poser.pugx.org/aggrego/domain/license.svg)](https://packagist.org/packages/aggrego/domain)
[![Latest Stable Version](https://poser.pugx.org/aggrego/domain/v/stable.svg)](https://packagist.org/packages/aggrego/domain)
[![Total Downloads](https://poser.pugx.org/aggrego/domain/downloads.svg)](https://packagist.org/packages/aggrego/domain)
[![Travis](https://travis-ci.org/Aggrego/Domain.svg?branch=master)](https://travis-ci.org/Aggrego/Domain/builds)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/aggrego/domain/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/aggrego/domain/?branch=master)

# Aggrego

## Assumption
 
### Board (general)
* represents the real board, where you can attach data,
* can be created and later only transformed,
* transforming create new `Board` with ID of a parent,
* it structures depends on `Board`'s type and is build based on `Prototype`,
* for an identical set of data (`Key`, `Profile`) should generate same `UUID`,
* transformation of the board with identical `Key` should generate same `UUID`.

### Board's type
* defines internal structure of `Board` and pushed `Domain`'s `Event`

#### examples

* [local Behat test](https://github.com/Aggrego/Domain/tree/master/features/bootstrap/Tests/Board)
* [DataDomainBoard](https://github.com/Aggrego/DataBoard)
* [FragmentedDomainBoard](https://github.com/Aggrego/FragmentedDataBoardDomain)

### Profile
* is defined by `Name` and [`Version`](http://semver.org/spec/v2.0.0.html),
* it is specification for input `Key` structure for `CreateBoard` and `TransformBoard` actions,
* defines transformations bases on `Key` to given `Board` version,
* for given `Profile`'s `Name` and `Version` we expect always same data structure

#### examples 

* [local Behat test](https://github.com/Aggrego/Domain/tree/master/features/bootstrap/Tests/Profile)
* [BasicBlockDomainProfile](https://github.com/Aggrego/BasicBlockDomainProfile)

## Related libs

* [EventConsumer](https://github.com/Aggrego/EventConsumer)
* [CommandConsumer](https://github.com/Aggrego/CommandConsumer)

## Versioning

Staring version ``0.1.0``, will follow [Semantic Versioning v2.0.0](http://semver.org/spec/v2.0.0.html).

## Contributors

* Tomasz Kunicki [TimiTao](http://github.com/timiTao) [lead developer]