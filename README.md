# EMPLOYEE SYSTEM FOR AWS ASSIGNMENT
#### Author: Chan Zheng Jie

## Overview

A simple web employee system for assignment of subnject: BAIT3273 Cloud Computing
This is the repo for application tier of the system.

## Purpose

There are three main purpose in this application:
- Manage employees
- Manage departments and jobs
- Payroll

### Manage employees
The application allow user to **Add**, **Edit**, and **Retrieve** employees intro/from the AWS RDS database.
The avatar image will be saved to AWS S3 bucket, the image path will be saved to the database.

### Manage departments and jobs
The application allow user to **Add**, **Edit** and **Retrieve** departments and jobs.
The job will determine the minimum basic salary and maximum basic salary, employee cannot have less/more basic salary than 
determined job basic salary.

### Payroll
The application allow user to **Add** payment, user can select employee to play, by selecting the employee,
the system will get the employee's basic salary, user will then need to insert the hours worked and overtime worked, 
after that, user is required to evaluate the employee in 5 criteria on a scale of 1-10, finally the system
will calculate if the employee is elligible to get bonus base on the evaluation and total hours worked.

# Installation Instruction
## Prerequisite
1. PHP ^8.0

## Installation
1. Install [Composer](https://getcomposer.org/) ^2.3.0
2. Install [NodeJS](https://nodejs.org/en/) ^16.0.0
3. Make sure Composer and Node is added to your computer environment path.
4. Clone this github repo to your device.
5. Open a command line and change directory to the cloned directory.
6. Run these commands:
```bash
$ composer install
$ npm install
$ npm run dev
```
php artisan storage:link
7. Open a file explorer and go to the cloned repo folder
8. Make a copy of the .env-aws-ready and rename it as .env
9. In the .env file, change these values:
    - DB_HOST to your database host
    - DB_PORT to your database port
    - DB_DATABASE to your database
    - DB_USERNAME to your MySQL username
    - If your MySQL user has a password, change the value of DB_PASSWORD to your password
    - AWS_BUCKET to your bucket name
    
    Change these value if using this application on ec2 instance, if in local environment, ignore.

    - AWS_ACCESS_KEY_ID to your IAM User Access Key
    - AWS_SECRET_ACCESS_KEY to your IAM User Secret Key
10. Go back to your terminal and run this command:
```bash
$ php artisan migrate:fresh --seed
```

# Running the project

To get the project up and running, make sure you have an Apache or Nginx server running and make sure you have a MySQL service running.
A great tool to run an Apache server and MySQL service on your computer is [XAMPP](http://localhost/dashboard/).
After started your Apache/Nginx server and MySQL service, follow the below step to run the project.

1. Open two terminal, change directory to the cloned repo directory on both terminal.
2. In one of the terminal, run this command: 
```bash
$ php artisan serve
```
3. In another terminal, run this command: 
```bash
$ npm run watch
```
