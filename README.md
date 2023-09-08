# Tarmetec task


## How to run

Software used:

* Apache 2.4
* PHP 8.1
* MySQL 8.0

This also includes all the 
needed modules to connect these 3.
This was developed on linux with php 
turned on and files placed in /var/www/html folder.
The page should now be accessable by 
going to http://localhost using a browser.

To get the MYSQL server working create a user with following features:

USERNAME: website

PASSWORD: password

(These can also be seen in the config.php file, if there is a need to use a different user)

Next create a DB:

NAME: website_db

FULL PERMISSIONS TO USER: website

Then use the db_dump.sql to add the tables and example data.

This should create two tables, one for products and the other for clients. The client_id in products links to the id-s of the client table

After confirming that the user can access the tables and they have been successfully added you can start using the application.



## How to use and features

When opening the the application the left side displays the products table with the name of clients pulled from the other table. 
On the bottom of the table are buttons to sort the table using various columns. Clicking them sorts the table view. There is also 
a search feature to find specific names.
 These both are implemented not ton the site side, but using SQL commands. This lowers the amount of data pulled any one time (pulling all data and then filtering 
uses more of the MySQL time, which can stall on large requests).

The right side displays a form to enter new data. The name and price fields are mandatory (except when updating). To update a ID needs to be provided. Any field not filled will not
 be updated when using this feature.

There is also a javascript reload button to reload the site without form data. (depends on the browser used however, some still refuse to clear form data).


## Challenges

Most of my challanges with this task centered on making sure data entering the db matches what the db expects. Debugging building this is a bit less intuitive when coming from node.js and react. 
The other challenge was not being able to use node.js as node has so many modules that make building sth like this much quicker and easier. Being use to node makes using php not very fun :D.


## Extras

I also implemented the ability to set the client. The list of clients gets pulled from clients table and then shown in a select list.

## Possible improvements

The data validation should be build a bit better to ensure no SQL injection and be more sure not errors pop up. Also the site should get a bit more beautification using CSS but due to time constraints I did not have the time to do so. 
Hopefully what is there shows that I am indeed able to use CSS.  