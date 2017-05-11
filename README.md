<h1 align="center"> Flawed Fortress</h1>
<h4 align="center">Capture The Flag Marker</h4>
<p align="center">
<img align="center" src="https://cloud.githubusercontent.com/assets/12548071/25828874/ad225488-344a-11e7-84f1-2add49df6818.gif">
</p>
<h2>Summary</h2>
<p>Flawed Fortress is a front end platform for hosting Capture the Flag Event (CTF), it is programmed with PHP, JQuery, JavaScript and phpMyAdmin. Currently, It is designed to import <a href="https://github.com/cliffe/SecGen">SecGen</a> CTF challenges using <b>`marker.xml`</b> file (which is generated in the project folder when creating a CTF Challenge)</p>

<h2>Features</h2>

<h4>Admin Account</h4>

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

<h4>User Account</h4>

* <i>Team Scoreboard</i>
* <i>Team Activity</i>
* <i>Team Chat</i>
* <i>View Other Team Progress</i>
* <i>Challenges are represented as country map</i>
* <i>Live Timer</i>
* <i>Live Notification Update (For Scoreboard, Team, Chat, Flag, Announcement, Timer and Hints)</i>

<h2>Installation</h2>

<h3>Step 1</h3>

```sql
Create database in `phpMyAdmin` with secure db_username and db_password
```

<h3>Step 2</h3>

```
git clone https://github.com/rgajendran/ctf_marker.git
```
<h3>Step 3</h3>

```php
<?php
    $connection = mysqli_connect('HOSTNAME','DB_USERNAME','DB_PASSWORD','DATABASE_NAME');
?>
```
<p>Open the project folder, navigate to <b><a href="https://github.com/rgajendran/ctf_marker/blob/master/template/connection.php">template/connection.php</a></b> file and update with your server/database login credentials.</p>

<h3>Step 4</h3>

Transfer the entire project folder to your server domain `eg.www/`

<h3>Step 5</h3>

Navigate to Admin Account `http://DOMAIN_NAME/admin.php`

<p align="center">
<img align="center" src="https://cloud.githubusercontent.com/assets/12548071/25828827/56a97f3c-344a-11e7-9388-10f19a3262a5.gif">
</p>

You don't need any username or password to access `admin.php` page for the first time. 

<h3>Step 6</h3><h5>Create Database</h5>

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
<h3>Step 7</h3>

<p align="center">
<img align="center" src="https://cloud.githubusercontent.com/assets/12548071/25874940/c6e073b0-350c-11e7-919d-9e92ab4a6959.png">
</p>

Once you create all the tables, Select <b>SYSTEM STATUS</b> tab in the admin account to check if there are any table errors.

<h3>Step 8</h3>

After creating `Users & Team Table`, the page will automatically redirect you to <b>index.php</b> (To secure the admin account). Direct access using `http://DOMAIN_NAME/admin.php` will be restricted. You would need default login details to get admin access. You can change the password after logging in.

<h4>Default Admin Login Details</h4>

```
Username : admin

Password : admin
```

<h2>Usage</h2>

* <h3>Step 1</h3>

    * Login to admin account and create teams.

* <h3>Step 2</h3>

    * Choose registration method (Generate `Tokens` or `Username and Password`).
    
* <h3>Step 3</h3>
    
    * Export login credential as PDF and distribute with team players.
    
* <h3>Step 4</h3>    

    * Import SecGen challenges (Import same challenges for all the registered teams or Import seperate challenges for every single team)
    
* <h3>Step 5</h3>    

    * Set Game End Timer
    
* <h3>Step 6</h3>

    * Allow Users Login
    
* <h3>Step 7</h3>

    * <b>Start your Game</b>
    

<h2>Contributing</h2>

 1. **Fork** the repository on GitHub
 2. **Clone** the project to your own machine ```git clone https://github.com/rgajendran/ctf_marker.git```
 3. **Commit** changes to your own branch
 4. **Push** your work to your fork
 5. Submit your **Pull request** for review
