# BAIT3173 INTEGRATIVE PROGRAMMING ASSIGNMENT
#### Author: Chan Zheng Jie, Thomas Lim Chi How, Poh Yuan Hao, Ong Choon Teck, Loh Jin Yi

## 1. Overview

The system allows people to choose pc components for reference and to see the prices and total prices of pc with the components they picked. They can also compare different components in the same category such as graphics card and CPU.

The system also allows people to grow a community to help support fellow pc builders by posting questions/advice in the forum, the forum has a comments section to allow people to answer questions and give feedback.

The system will also integrate a chat room microservice to allow users to communicate with each other via online chat.

The main application will be written in PHP, which uses the Laravel framework. The microservice is written in Typescript which uses the NestJS framework.

The modules of the project are XML and Forum, Chatroom Microservice, User, Component Management, PC Builder + Component Comparer, and Component rating.

The module that I am in charge of is Chatroom Microservice and Component Management.

The ORM used is the Laravel Eloquent ORM.


## 2. Installation Instruction
### Prerequisite
1. PHP ^8.0

### Installation
1. Install [Composer](https://getcomposer.org/) ^2.3.0
2. Install [NodeJS](https://nodejs.org/en/) ^16.0.0
3. Make sure Composer and Node is added to your computer environment path.
4. Clone this github repo to your device.
5. Open a command line and change directory to the cloned directory.
6. Run these commands:
    - **composer install**
    - **npm install**
    - **npm run dev**
    - **php artisan storage:link**
7. Open a file explorer and go to the cloned repo folder
8. Make a copy of the .env-example and rename it as .env
9. In the .env file, change these values:
    - DB_HOST to your database host
    - DB_PORT to your database port
    - DB_DATABASE to your database
    - DB_USERNAME to your MySQL username
    - If your MySQL user has a password, change the value of DB_PASSWORD to your password
10. Go back to your terminal and run this command:
    - **php artisan migrate:fresh --seed**

## 3. Running the project

To get the project up and running, make sure you have an Apache or Nginx server running and make sure you have a MySQL service running.
A great tool to run an Apache server and MySQL service on your computer is [XAMPP](http://localhost/dashboard/).
After started your Apache/Nginx server and MySQL service, follow the below step to run the project.

1. Open two terminal, change directory to the cloned repo directory on both terminal.
2. In one of the terminal, run this command: **php artisan serve**
3. In another terminal, run this command: **npm run watch**

After running the last command, your computer should open up a browser tab, it will show the project index.

At this point the chatroom function should be not available, to enable the chatroom function, follow this guide in [Chat Microservice](https://github.com/freshnoob1e/nestjs_chat_microservice)
