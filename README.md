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
