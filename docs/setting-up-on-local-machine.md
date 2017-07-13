Setting up PROMPT on a local machine
====
Follow the steps below to deploy PROMPT on your local machine.


Pre-requisites
=====
- VirtualBox (https://www.virtualbox.org/wiki/Downloads)
- VirtualBox Extension Pack (https://www.virtualbox.org/wiki/Downloads)
- Vagrant (https://www.vagrantup.com)
- The MySQL schema, eg. Vagrant-config/sql/empty.sql
- Access to this GitHub repo

Getting the code onto your local machine
=====
1. ```git clone git@github.com:IntAlert/ProjectsDB.git```

Start Vagrant
====
1. ```vagrant up```

Create configuration files
====
These files are gitignored - ideally, these values should be set at environment variable level, but this isn't available on TSO Hosts for Command line environment variables, so we use configuration files that are hidden from this public repo

Database Configuration
====

Create the following configuration file:

```
nano /srv/site/application/backend/app-common/Config/database-common.php
```

Example content:
```
<?php

class DATABASE_CONFIG {

	public $default = array(
		'datasource' => 'Database/Mysql',
		'persistent' => false,
		'host' => '127.0.0.1',
		'login' => 'root',
		'password' => 'rootpass',
		'database' => 'app',
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

Local DNS
===
You may need to manually make a record in your ```hosts``` file like:
	```
	10.168.33.58	local.projects.international-alert.org
	```

(This IP matches that found in the ```Vagrantfile```)

Finito Benito
====
You should now be able to visit [PROMPT](http://local.projects.international-alert.org)


