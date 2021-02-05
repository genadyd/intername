# intername project
##description:
<p>
1. In the project I use Composer
for classes autoload and routing 
</p>
<p>
2. Class DBConnection is singleton.
</p>
3. In Users Class I declare DbConnection var as static<br>
    because I use it in static function:

>***checkIfUserExistsById*** - *check if user exists by user id*

##structure:

###controllers:

***Home Controller***

>display form controller
> use template *form.php*

***FillDBController***

>fetch api data and insert it into DB

***Json Controller***

>display data in json format
> use *json_show.php*

 

