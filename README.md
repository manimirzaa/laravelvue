<h1>Laravelvue</h1>

<p>Laravelvue is simple integration of Laravel with Vue.js</p>

<h5>1 - First Download the code from GitHub by using following git command on server or localhost.</h5>

<code>
$ git clone git@github.com:manimirzaa/laravelvue.git desired-name-of-app
</code>

<h5>This will download the code in to your local or remote server.</h5>

<h5>2 - Create new Database of you desired name and Edit the file on the root folder called “.env” and add your database information.
<br/>
<ol>
  <li>Host: Your Current Host</li>
  <li>Database: Your database name</li>
  <li>Username: Username for your database user (root for xampp localhost)</li>
  <li>Password: Password for you database user ( no password for xampp default root user).</h5></li>
</ol>

<h5>3 - Run the “Database Migration” by typing following command.</h5>

<code>$ php artisan migrate</code>

<h5>This command will create all the database table necessary for running application.</h5>

<h5>4 - Generate Laravel Key by running this command.</h5>

<code>$ php artisan key:genrate</code>

<h5>5 - Clear cache and old configuration files.</h5>

<code>$ php artisan config:clear</code>

<h5>6 - Finally run this command to see the application running in the browser.</h5>

<code>$ php artisan serve</code>

<h5>This command will give you the url where you can access the application 
e.g. for localhost its on “localhost:8000” by default.</h5>
