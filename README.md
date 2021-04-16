## Requirements For Setup

1. Composer
2. PHP
3. MySQL

## Setup Guide

1. Clone the project: `https://github.com/iamsajidjaved/support-ticket-app.git`
2. Go to the project repository and install the dependencies by running this command `composer install`
3. Setup Database: Create a copy of `env.example` which is located in the root of the project and rename the copy to `.env`
4. Now migrate migrations by running a command `php artisan migrate`

## APIs Documentation

The project is divided into 3 modules(Auth, User and Ticket). Below are the publically available documentation/collection of each module

1. [Auth](https://documenter.getpostman.com/view/15404697/TzJrCeZU)
2. [User](https://documenter.getpostman.com/view/15404697/TzJrCeZW)
3. [Ticket](https://documenter.getpostman.com/view/15404697/TzJrBe3C)

