Backups
===
Two backups are taken. The default TSO backup runs ever 5-6 days. A custom script backups everyday at 6am in the morning. More details below.



## Daily Backups
The PROMPT database is updated daily at 6am GMT via a cron script conigured on TSO hosts as follows:
```
0	6	*	*	* /bin/sh /var/sites/p/prompt.intalert.org/backupGenerator.sh
```

This script produces mysql backups of the database in:

```
/var/sites/p/prompt.intalert.org/additional_backups
```


These daily backups are kept for 30 days.

## Weekly Backups
A separate, TSO process produces backups every 5-6 days in this folder:

```
/var/sites/p/prompt.intalert.org/mysql_backups
```

## Restoring a backup
1. Log in to the server via SSH* or FTP
2. Navigate to ```/var/sites/p/prompt.intalert.org/additional_backups```
3. Download the appropriate backup file
4. Open the database in your [MySQL client](remote-database-access.md)
5. Import the database export

 * SCP shortcut command:
```
scp prompt:/var/sites/p/prompt.intalert.org/additional_backups/06-08-16_06:00-sql_backup.sql ./
```

## Practice restoring a backup
Follow the steps above but restore the backup on staging instead.


