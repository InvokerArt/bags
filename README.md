## 项目注意事项
Metronic 模板gulp 失败注意使用  cd node_modules/gulp-sass/ 然后 npm install node-sass@3.3.2版本
"talvbansal/media-manager": "^1.0"
"stevenyangecho/laravel-u-editor": "^1.3"
根据自己项目有做修改

## Apidoc
apidoc -i App/Api/v1/Controllers -o public/apidoc  

## 守护进程Supervisor的配置
#### 安装Supervisor

Supervisor是Linux系统中常用的进程守护程序。如果队列进程queue:work意外关闭，它会自动重启启动队列进程。在Ubuntu安装Supervisor 非常简单：

````
sudo apt-get install supervisor
````

> 注：如果自己配置Supervisor有困难，可以考虑使用Laravel Forge，它会为Laravel项目自动安装并配置Supervisor。
> 
#### 配置Supervisor

Supervisor配置文件通常存放在/etc/supervisor/conf.d目录，在该目录中，可以创建多个配置文件指示Supervisor如何监视进程，例如，让我们创建一个开启并监视queue:work进程的laravel-worker.conf文件：

````
[program:laravel-worker]
process_name=%(program_name)s_%(process_num)02d
command=php /home/vagrant/Code/stone/artisan queue:work --sleep=3 --tries=3
autostart=true
autorestart=true
user=vagrant
numprocs=8
redirect_stderr=true
stdout_logfile=/home/vagrant/Code/stone/worker.log
````

在本例中，numprocs指令让Supervisor运行8个queue:work进程并监视它们，如果失败的话自动重启。配置文件创建好了之后，可以使用如下命令更新Supervisor配置并开启进程：

#### 启动Supervisor

当你成功创建配置文件后，你需要刷新Supervisor 的配置信息:

````
sudo supervisorctl reread
sudo supervisorctl update
sudo supervisorctl start laravel-worker:*
````

你可以通过Supervisor官方文档获的更多信息 [Supervisor文档](http://supervisord.org/index.html)。

#### 重启Supervisor

````
sudo supervisorctl reload
````
