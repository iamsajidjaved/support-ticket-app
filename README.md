## Requirements For Setup

1. Composer
2. Git
3. PHP
4. MySQL

## Setup Guide

1. Clone the project: `git clone https://github.com/iamsajidjaved/support-ticket-app.git`
2. Install dependencies: Go to the project repository and install the dependencies by running this command `composer install`
3. Connect Database: Create a copy of `env.example` which is located in the root of the project and rename the copy to `.env`. Then open .env file and add database credientials as shown in this [Screenshot](https://prnt.sc/11ie92c)
4. Create Tables: Now migrate migrations by running a command `php artisan migrate`
5. JWT: Generate JWT secret by running this command `php artisan jwt:secret`

## APIs Documentation

The project is divided into 3 modules(Auth, User and Ticket). Below are the publically available documentation/collection of each module

1. [Auth](https://documenter.getpostman.com/view/15404697/TzJrCeZU)
2. [User](https://documenter.getpostman.com/view/15404697/TzJrCeZW)
3. [Ticket](https://documenter.getpostman.com/view/15404697/TzJrBe3C)

## Usage

#### Visitors Flow
1. Register a user
2. Login with the user
3. Create Ticket
4. Logout

#### Admin Flow
1. Register a user with admin role
2. Login now
3. List created tickets

## Thanks To

The Coding Standards/Design Patterns used in this project are inspired from:

1. https://bit.ly/3uTDyvb
2. https://bit.ly/3tqi0Gr
