# intername project
## description:

1. In the project I use Composer
for classes autoload and routing
   

2. Class DBConnection is singleton.


3. In Users Class I declare DbConnection var as static<br>
    because I use it in static function:

*"checkIfUserExistsById"* - check if user exists by user id

4. In the project I was use Apache 2.4.46(Ubuntu), PHP 8.0.1 , MySql 8.0.23 protocol 10
## structure:
### Entities:
1. index.php

2. router.php - route bu URL ( use Composer package "bramus/router": "~1.5")
   
3. config.php - DbConnection config and Api Urls

4. Controllers

5. Models

6. Db Connection

### Controllers:

***Home Controller***

>display form controller
> use template *form.php*

***FillDBController***

>fetch api data and insert it into DB

***Json Controller***

>display data in json format
> use template *json_show.php*

***FormHandlerController***

> validate and save user and post

 ### Models:

***Users***
>Has:<br> Public method
> *"create"* - add new user,<br>
> Private method *"checkIfUserExistsByEmail"* - check if user exists by email,<br>
> Public static method *"init"* - init the *"DbConnection"*<br>
> Public static method *"checkIfUserExistsById"* - check if user exists by id 

***Posts***
>Has:<br>
> Public method *"create"* - add new post<br>
> Public method *"searchById"* - retrieve Post object or false<br>
> Public method *"searchByUserId"* - retrieve Posts by user_id<br>
> Public method *"searchByContent"* - find Posts by content if fields "body" or "title"

***Api***
>Has:<br>
> Public method *"getData"* - get Users or Posts data By Api urls


