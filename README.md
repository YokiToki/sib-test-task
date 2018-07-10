# Test task

## Instalation

System requriments
```
PHP >= 7.0
PHP Xml Extension
```

Getting started
```
git clone https://github.com/YokiToki/sib-test-task.git
cd sib-test-task
composer install
```
Copy Nginx configuration file `nginx.conf` to `/etc/nginx/conf.d/`, or other Nginx configuration location of your operating
system. Rename file if need. Set in configuration file `root` and `server_name` directive.

You can launch application in your browser using the hostname specified in `server_name` directive.