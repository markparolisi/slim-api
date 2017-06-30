# DEMO Slim PHP API
[![Build Status](https://travis-ci.org/markparolisi/slim-api.svg?branch=master)](https://travis-ci.org/markparolisi/slim-api.svg?branch=master)

Quick and short example application for a PHP-based JSON API with all of the testing, linting, and build info.

## Installation

1. Download this repository
1. Install the VM with `vagrant up`
1. Install dependencies with `composer install`
1. Test web app at `http://localhost:8080/ping`

## Code Quality 

- [PHPUnit](https://phpunit.de/) tests are located in the `/tests` directory and are automatically run on Composer updates. 
- [PHP Mess Detector](https://phpmd.org/) and Code Sniffer are also automatically run
- [PHPDocumentor](https://www.phpdoc.org/) has to be manually run with `composer run-script document`


## Continuous Integration

Using [Travis CI](https://travis-ci.org/markparolisi/slim-api) to automatically run the code quality tools on branch changes. 

## Config

The configuration JSON file is loaded via the \App\Utils\Config singleton class and provides easy getters for complex values.

## Routing

[SlimPHP](https://www.slimframework.com/) handles all of the routing. Just one route in the main app.php now for demo purposes. 

## Models

Using the [Eloquent ORM package](https://laravel.com/docs/5.0/eloquent) (from the Laravel project) as a standalone.
There is a generic customer database file used to scaffold some data, and I've built two relational models as an example.

## Controllers

The controllers are generic callbacks that are referenced by the Slim PHP route calls

## Authentication

Using [JWT authentication](https://jwt.io/). The secret is in the config.json, but you should NEVER version or make this value public.
Only here for demonstration purposes.

All endpoints require authentication except for the `/ping` endpoint and the `/token` endpoint which is used to generate a new token for a user.

For the purposes of this demo, you can use this token:
`eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJTbGltIFBIUCBEZW1vIEFwcCIsImlhdCI6MTQ5ODc4MjAyNSwiZXhwIjoxNTYxODU0MDI1LCJhdWQiOiJ3d3cuc2xpbS1waHAtZGVtby5jb20iLCJzdWIiOiJ0ZXN0QGV4YW1wbGUuY29tIiwiR2l2ZW5OYW1lIjoiSmFuZSIsIlN1cm5hbWUiOiJEb2UiLCJFbWFpbCI6ImphbmUuZG9lQGV4YW1wbGUuY29tIiwiUm9sZSI6IkFkbWluIn0.aukn-FcigKdQ_kOFviMGuj1D5CxrjBWEt37yykuAdzA`

A successful request would look like:

`http://localhost:8080/customers 'Cookie:token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJTbGltIFBIUCBEZW1vIEFwcCIsImlhdCI6MTQ5ODc4MjAyNSwiZXhwIjoxNTYxODU0MDI1LCJhdWQiOiJ3d3cuc2xpbS1waHAtZGVtby5jb20iLCJzdWIiOiJ0ZXN0QGV4YW1wbGUuY29tIiwiR2l2ZW5OYW1lIjoiSmFuZSIsIlN1cm5hbWUiOiJEb2UiLCJFbWFpbCI6ImphbmUuZG9lQGV4YW1wbGUuY29tIiwiUm9sZSI6IkFkbWluIn0.aukn-FcigKdQ_kOFviMGuj1D5CxrjBWEt37yykuAdzA'`


## Error Messaging

Always use appropriate status codes (401, 405, etc) for error responses and include a `message` property in the JSON response.