# Spring challenge

## Description

A small web application that collects information using an online form.  The web application collects the name and address of a company and stores them into a database. The web application has information about the company, as well as company employees. 

* There can be multiple employees per company. 
* Can show all companies and the number of employees per company in a table. 
* Can show each employee and their respective companies.
* Uses proper validation and data filtering when collecting information using the online form. 
* The SQL queries to create the database that will store this data are in install.sql. 

## Limitations

1.  Only works with US addresses in the fifty states (not the District of Columbia, territories, nor military addresses).
2.  Only validates zip codes and states when entering companies.  
3.  Only validates company when entering employees.

## Future development

1.  More address possibilities (non-US, non-state).
2.  Organize validation, etc. into classes, etc.
3.  Implement a design with common styling.
4.  More restrictions on input.
5.  Larger UX design (e.g. how does one switch between companies and employees).
6.  Move configuration out of web root.
7.  Verify that it works in a folder; fix if not.  

## Installing

1.  Edit the includes/configure.php file to specify a valid database server, username, password, and database.
2.  Use phpMyAdmin or an alternative to run the install.sql file in that database.
3.  Upload files into a web server (tested in root of domain).  
4.  Visit companies.php or employees.php
