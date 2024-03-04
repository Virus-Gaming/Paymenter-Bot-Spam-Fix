# Paymenter Bot Spam Fix
This fixes the issue were some jerk would find peoples paymenter panel and run a script to make accounts with just random numbers.
 

## Step 1 Run the following commands to make the specified files.

First make sure you are in your paymenter directory. `/var/www/paymenter`

```bash
cd /var/www/paymenter
```

This is to make the command `php artisan user:deletebots`
```bash
php artisan make:command deletebots
```
This makes the mailing part of the account deletion.

```bash
php artisan make:mail AccountDeletionNotice
```

## Step 2 is to upload the files to the correct directorys. (If you are prompt to overwrite say yes)

Put `deletebots.php` in `/var/www/paymenter/app/Console/Commands/`

Put `AccountDeletionNotice.php` in `/var/www/paymenter/app/Mail/` 

Put `accountDeletionNotice.blade.php` in `/var/www/paymenter/resources/views/emails/`

# Making a systemd timer to run this command every second.

## step 1 upload the following files to `/etc/systemd/system/`

Upload `deletebots.service` to `/etc/systemd/system/`


