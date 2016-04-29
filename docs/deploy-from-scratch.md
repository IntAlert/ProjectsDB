Deploying from scratch
====
Follow the steps below to deploy PROMPT on a new server.


Pre-requisites
=====
- The MySQL schema, eg. Vagrant-config/sql/promptin_db_2015-10-28.sql
- Access to this GitHub repo

Getting the code onto the server
=====
1. Create server
2. Login via SSH and generate an SSH key (https://help.github.com/articles/generating-a-new-ssh-key-and-adding-it-to-the-ssh-agent/)
3. Add this key to the deploy keys for GitHub
4. ```git clone git@github.com:IntAlert/ProjectsDB.git```

Create database
====
1. Create a MySQL database
2. Load your MySQL export of the application database
3. Save credentials for later


Soft link public_html folder
====
If your server has a default root folder for serving HTML, delete the target folder and create a soft link to the 'frontend' folder

1. ```rm -rf public_html```
2. ```ln -s ProjectsDB/site/application/frontend public_html```

Create configuration files
====
These files are gitignored - ideally, these values should be set at environment variable level, but this isn't available on TSO Hosts for Command line environment variables, so we use configuration files that are hidden from this public repo

Database Configuration
====

Create the following configuration file:

```
nano ProjectsDB/site/application/backend/app-common/Config/database-common.php
```

Example content:
```
<?php

class DATABASE_CONFIG {

	public $default = array(
		'datasource' => 'Database/Mysql',
		'persistent' => false,
		'host' => '***',
		'login' => '***',
		'password' => '***',
		'database' => '***',
		'prefix' => '',
		'encoding' => 'utf8',
	);

}

?>

```

Office365 Configuration
====

Create the following configuration file:

```
nano ProjectsDB/site/application/backend/app-common/Config/office365.php
```


Example content:
```
<?php
// API keys.. not in Git
define('OFFICE365_TENANT_ID', '***');
define('OFFICE365_CLIENT_ID', '***');
define('OFFICE365_CLIENT_SECRET', '***');
?>

```

Email Configuration

Create the following configuration file:
``` 
nano ProjectsDB/site/application/backend/app-common/Config/email-common.php
```

```
<?php

class EmailConfig {

    public $default = array(
    	'host' => 'smtp.office365.com',
        'port' => 587,
        'username' => '***@***',
        'password' => '***',
        'transport' => 'Smtp',
        'tls'=>true,
        'from' => array('***@***' => 'FROM NAME'),
    );

}
?>
```
Enable the app domain on Azure
====
1. Visit http://manage.windowsazure.com
2. Select "International Alert"
3. Select "Applications"
4. Select "PROMPT"
5. Select "Configure"
6. To the "Single Sign-on" add a reply URL of the form:
	http://staging-prompt.intalert.org/pdb/office365users/callback
	(replacing staging-prompt.intalert.org with your domain)
7. Click "Save"


Finito Benito
====
You should now be able to visit [PROMPT](http://prompt.intalert.org)


