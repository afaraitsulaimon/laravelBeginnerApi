

to test the api with post man

to assemble all your api in one folder
Click on new at the top
select collect and give the collection a name
Then navigate your mouse on the collection created
click on the 3 dots ...
then select Add Request
 and then name your request
When testing a request change it to post or get or delete or put
Then navigate to the Header
Then under the key - put Content-Type and under the value put application/json

Also do under the key - put Accept and under the value put application/json

inside the field above, where you select post or delete or get
put the url (http://127.0.0.1:8000/api/v1/edit/blog/10)

Then navigate to the Body and select Raw

{
    "first_name" : "Bulala",
    "last_name": "Akere",
    "email": "bubu_lala@aol.com",
    "phone_no" : "08029048920"
}

first_name is the exact row in a table (blogs) in the database
likewise last_name, email and phone_no

Then click send

Then in 

Content-Type# laravelBeginnerApi
Api Beginners for Laravel
