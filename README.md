## Base Cms ##

**Base Content Management System with Laravel 5.1**

### Installation ###

* `https://github.com/murattanriover/basecms-laravel.git projectname`
* `cd projectname`
* `composer install`
* `php artisan key:generate`
* Create a database and inform *.env*
* `php artisan migrate` to create tables
* `php artisan db:seed` to populate tables

### Include ###

* [Bootstrap](http://getbootstrap.com) for CSS and jQuery plugins
* [Font Awesome](http://fortawesome.github.io/Font-Awesome) for the nice icons
* [Startbootstrap](http://startbootstrap.com) for the free templates (sbadmin2)
* [DataTables](http://www.datatables.net) for the table lists

### Features ###

* Dashboard
* Authentication (login,logout)
* Dynamic Controller&Method based group perms management
* Group based user roles
* Custom Error Page
* Datatable lists
* User Management, Group Management, Definitions Management
* Turkish and English language support
* ...


### Packages included ###

* bllim/datatables
* illuminate/html

### Demo ###
[Demo Link](http://basecms.murattanriover.com.tr)

### Tricks ###

To test application the database is seeding with users :

* email = admin@admin.com, password = admin