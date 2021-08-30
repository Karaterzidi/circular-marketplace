## Circular Marketplace

Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description Description

## System Requirements

This Project can be installed and run in any operating system (ex. Windows, Linux, macOS)

You need to have installed:
- Apache Server
- PHP Version 7.4
- Composer Version 2+
- MySQL

## Download Steps

Follow the steps below to download this project.

- git clone https://github.com/Karaterzidi/circular-marketplace.git
- cd circular-marketplace
- Run composer install
- Run cp .env.example .env
- Run php artisan key:generate
- create a database using a database manager of your preference
- In the .env file fill the credentials of the database you just created
 
 DB_CONNECTION=mysql<br/>
 DB_HOST=127.0.0.1<br/>
 DB_PORT=3306<br/>
 DB_DATABASE=TheNameOfYourDatabase<br/>
 DB_USERNAME=Username (ex: root)<br/>
 DB_PASSWORD=Password (ex: 12345)

- Run php artisan migrate
- Run php artisan db:seed
- Run php artisan storage:link.

This project uses a service called mailtrap for handling emails. Make sure you create a [mailtrap account](https://mailtrap.io/) account. Create a new inbox and select integration with LARAVEL7+. You will see something like this:

MAIL_MAILER=smtp<br/>
MAIL_HOST=smtp.mailtrap.io<br/>
MAIL_PORT=2525<br/>
MAIL_USERNAME=38cc38cc38cc38<br/>
MAIL_PASSWORD=38cc38cc38cc38<br/>
MAIL_ENCRYPTION=tls<br/>

Replace those credentials in your .env file (line:26-31). Set a MAIL_FROM_ADDRESS (ex: MAIL_FROM_ADDRESS=info@cmarketplace.com).<br/>
Change QUEUE_CONNECTION=database (line:18)


- Open 2 terminal tabs and cd into your project
- In the first tab run php artisan serve
- In the second tab run php artisan queue:work

Finally navigate to your development server (ex. http://127.0.0.1:8000). 

### Admin Credentials

email: admin
password: admin
