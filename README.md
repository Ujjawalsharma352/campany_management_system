# Company Management System
## About the Project
This is a simple **Company Management System** built using **PHP, MySQL, JavaScript, and Bootstrap**.
The purpose of this project is to manage employees, attendance, holidays, and salary information through an admin dashboard and employee interface.
The system allows administrators to manage company data efficiently while employees can log in and mark their attendance.
This project was created as a **practice project to understand backend development, CRUD operations, API structure, and dashboard management**.

## Main Features
### Admin Features
* Admin Login
* Employee Management (Add, Edit, Delete)
* View Employee List
* Attendance Management
* Holiday Management
* Salary Generation
* Dashboard Overview

### Employee Features
* Employee Login
* Employee Dashboard
* Punch In / Punch Out Attendance

## Technologies Used
**Frontend**
* HTML
* CSS
* Bootstrap
* JavaScript

**Backend**
* PHP

**Database**
* MySQL

**Tools**
* Git
* GitHub
* VS Code
* XAMPP

## Project Folder Structure
company_management_system
│
├── admin
│   ├── dashboard.php
│   ├── login.php
│   └── logout.php
│
├── api
│   ├── attendance_api.php
│   ├── employee_api.php
│   ├── holiday_api.php
│   └── salary_api.php
│
├── attendance
│   ├── list.php
│   └── mark.php
│
├── config
│   └── db.php
│
├── employees
│   ├── add.php
│   ├── dashboard.php
│   ├── delete.php
│   ├── edit.php
│   ├── list.php
│   ├── login.php
│   └── logout.php
│
├── holidays
│   ├── add.php
│   ├── delete.php
│   └── list.php
│
├── salary
│   ├── generate.php
│   └── list.php
│
└── header.php

## How to Run the Project
1. Clone the repository
git clone https://github.com/your-username/company_management_system.git

2. Move the project folder to your local server directory.
Example (XAMPP):
xampp/htdocs/company_management_system

3. Start **Apache** and **MySQL** in XAMPP.

4. Create a database in **phpMyAdmin**.

Example:
company_management

5. Import the database tables or create them manually.

6. Configure database connection inside:

config/db.php

7. Open the project in the browser:
8. 
http://localhost/company_management_system/index.php

##What I Learned From This Project
While building this project, I gained hands-on experience in:
*Structuring a full-stack web project.
*CRUD operations with PHP and MySQL.
*Creating RESTful APIs for backend operations.
*Handling sessions, authentication, and authorization.
*Using JavaScript and AJAX for dynamic frontend updates.
*Designing responsive layouts with Bootstrap.
*Organizing project folders and code for scalability.
*Implementing dashboards and visual data representation.

## Future Improvements
Some features that can be added in the future:
* Leave management system
* Attendance reports
* Employee profile page
* PDF salary slips
* Charts and analytics on dashboard
* Role-based access control



