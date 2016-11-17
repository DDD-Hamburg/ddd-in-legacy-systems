# DDD In Legacy Systems [![Build Status](https://travis-ci.org/DDD-Hamburg/ddd-in-legacy-systems.svg?branch=master)](https://travis-ci.org/DDD-Hamburg/ddd-in-legacy-systems)

Example implementation of ACL concepts from Eric Evans' paper
["Getting Started With DDD When Surrounded By Legacy Systems"](http://domainlanguage.com/wp-content/uploads/2016/04/GettingStartedWithDDDWhenSurroundedByLegacySystemsV1.pdf).

## Setup

```
# Clone the repo
$ git clone git@github.com:DDD-Hamburg/ddd-in-legacy-systems.git

# Install composer and project dependencies
$ make bootstrap
```

## General Information

The repository provides a `Makefile` to help you speeding up your development process.

```
$ make help
bootstrap    Install composer
tests        Execute test suite and create code coverage report
update       Update composer packages
```
