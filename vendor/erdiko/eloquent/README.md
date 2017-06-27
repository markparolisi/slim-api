# Eloquent
Use the Eloquent ORM from Laravel in your Erdiko app

Eloquent is a great ORM that uses the active record pattern.

You can use this to easily add Eleoquent to your erdiko app

To install via composer

    composer require erdiko/eloquent

How to Use
----------

In order to use Eloquent in your framework you can do one of the following

1. Require in the bootstrap file (/app/appstrap.php) and Eloquent is available on all pages/routes
```
    require_once VENDOR.'/erdiko/eloquent/src/bootstrap.php';
```

2. Lazy load Eloquent by having your models extend the erdiko\eloquent\Model class instead of the \Illuminate\Database\Eloquent\Model class
```
    class Users extends erdiko\eloquent\Model { }
```

3. Lazy load using traits; Create a base model and 
```
    class BaseModel extends \Illuminate\Database\Eloquent\Model {
        use \erdiko\eloquent\EloquentTraits;
    }
```

Remember you only need to pick one scheme above, no need for all three.  #2 is probably the most convenient.

Roadmap
-------

Coming Soon

Read More
---------

http://erdiko.org

https://laravel.com/docs/5.1/eloquent

