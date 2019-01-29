# phone_book

# How to install
Clone git repo

```git clone https://github.com/madcod3r/phone_book.git```

Open phone_book directory

```cd phone_book```

Install dependencies

```composer install```

Create user for mysql (user phone_book, password: phone_book)
or change user details in .env:27 in string `DATABASE_URL=`

Create database

```php bin/console doctrine:database:create```

Use migrations

```bin/console doctrine:migrations:migrate```

Run server

```php bin/console server:run```

Example:
![alt text](http://i.piccy.info/i9/78d8e5ddbefc5d5186b1c9540de4ee1f/1548780541/59374/1298234/phone_book_example.jpg)