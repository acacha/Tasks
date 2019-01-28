# Supervisor per a Que worker

Path:

```
/etc/supervisor/conf.d/tasks.sergitur.scool.cat.conf
```

Contingut: 

LOCAL:
```
[program:laravel-worker-tasks-sergitur-scool-cat]
process_name=%(program_name)s_%(process_num)02d
command=php /home/sergi/Code/acacha/tasks/artisan queue:work redis --sleep=3 --tries=3
autostart=true
autorestart=true
user=sergi
numprocs=8
redirect_stderr=true
stdout_logfile=/home/sergi/Code/acacha/tasks/storage/logs/worker.log
```

EXPLOTACIO:

```
[program:laravel-worker-tasks-sergitur-scool-cat]
process_name=%(program_name)s_%(process_num)02d
command=php /home/forge/app.com/artisan queue:work sqs --sleep=3 --tries=3
autostart=true
autorestart=true
user=forge
numprocs=8
redirect_stderr=true
stdout_logfile=/home/forge/app.com/worker.log
```

# Supervisor per a Horizon

LOCAL:

Fitxer:

```
/etc/supervisor/conf.d/horizon-tasks-sergitur-scool-cat.conf
```

```
[program:horizon-tasks-sergitur-scool-cat]
process_name=%(program_name)s
command=php /home/sergi/Code/acacha/tasks/artisan horizon
autostart=true
autorestart=true
user=sergi
redirect_stderr=true
stdout_logfile=/home/sergi/Code/acacha/tasks/storage/logs/horizon.log
```
