<h1 align="center"> Flawed Fortress</h1>
<h4 align="center">Capture The Flag Marker</h4>
<p align="center">
<img align="center" src="https://cloud.githubusercontent.com/assets/12548071/25828874/ad225488-344a-11e7-84f1-2add49df6818.gif">
</p>


## Summary

Flawed Fortress is a front end platform for hosting Capture the Flag Event (CTF), it is programmed with PHP, JQuery, JavaScript and phpMyAdmin. Currently, It is designed to import [SecGen](https://github.com/cliffe/SecGen) CTF challenges using **`marker.xml`** file (which is generated in the project folder when creating a CTF Challenge)

## Features

#### Admin Account

* <i>Create Teams</i>
* <i>Generate Tokens (Allow players to register with their preferred logins) </i>
* <i>Generate Random Username & Password (Allow players to instantly login)</i>
* <i>Check Token Registration Status</i>
* <i>Send Live Announcement</i>
* <i>Restrict Users to Login</i>
* <i>Import SecGen CTF Challenges</i>
* <i>Update Homepage and Event Countdown Timer</i>
* <i>Database Management (Create or Drop all necessary tables)</i>
* <i>System Status (Check if there is any misconfiguration before the CTF event)</i>
* <i>Export Team Tokens as PDF file</i>
* <i>Export Username & Password as PDF file</i>

#### User Account

* _Team Scoreboard_
* _Team Activity_
* _Team Chat_
* _View Other Team Progress_
* _Challenges are represented as country map_
* _Live Timer_
* _Live Notification Update (For Scoreboard, Team, Chat, Flag, Announcement, Timer and Hints)_

## Installation

### Step 1

```sql
Create database in `phpMyAdmin` with secure db_username and db_password
```

### Step 2

```
git clone https://github.com/rgajendran/ctf_marker.git
```

### Step 3

```php
<?php
    $connection = mysqli_connect('HOSTNAME','DB_USERNAME','DB_PASSWORD','DATABASE_NAME');
?>
```

Open the project folder, navigate to **[template/connection.php](https://github.com/rgajendran/ctf_marker/blob/master/template/connection.php)** file and update with your server/database login credentials.

### Step 4

Transfer the entire project folder to your server domain `eg.www/`

### Step 5

Navigate to Admin Account `http://DOMAIN_NAME/admin.php`

<p align="center">
<img align="center" src="https://cloud.githubusercontent.com/assets/12548071/25828827/56a97f3c-344a-11e7-9388-10f19a3262a5.gif">
</p>

You don't need any username or password to access `admin.php` page for the first time. 

### Step 6

##### Create Database

Flawed Fortress front end has the capability to auto generate all required tables automatically in a click of a button. 

```php
Open   > admin.php page
Select > Options
Select > DATABASE MANAGEMENT
Click  > Create (SecGen Hint & Flag Table)
Click  > Create (Chat, Logger & Report Table)
Click  > Create (Scoreboard, Updater & Options Table)
Click  > Create (Users & Teams Table)
Click  > Create (SecGen Map Table)
```

### Step 7

<p align="center">
<img align="center" src="https://cloud.githubusercontent.com/assets/12548071/25874940/c6e073b0-350c-11e7-919d-9e92ab4a6959.png">
</p>

Once you create all the tables, Select <b>SYSTEM STATUS</b> tab in the admin account to check if there are any table errors.

### Step 8

After creating `Users & Team Table`, the page will automatically redirect you to <b>index.php</b> (To secure the admin account). Direct access using `http://DOMAIN_NAME/admin.php` will be restricted. You would need default login details to get admin access. You can change the password after logging in.

#### Default Admin Login Details

```
Username : admin

Password : admin
```

## Usage

1. Login to admin account and create teams.
2. Choose registration method (Generate `Tokens` or `Username and Password`).
3. Export login credential as PDF and distribute with team players.
4. Import SecGen challenges (Import same challenges for all the registered teams or Import seperate challenges for every single team)
5. Set Game End Timer
6. Allow Users Login
7. **Start your Game**
    

## Contributing

 1. **Fork** the repository on GitHub
 2. **Clone** the project to your own machine ```git clone https://github.com/rgajendran/ctf_marker.git```
 3. **Commit** changes to your own branch
 4. **Push** your work to your fork
 5. Submit your **Pull request** for review
