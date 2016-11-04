##项目注意事项
Metronic 模板gulp 失败注意使用  cd node_modules/gulp-sass/ 然后 npm install node-sass@3.3.2版本
"talvbansal/media-manager": "^1.0"
"stevenyangecho/laravel-u-editor": "^1.3"
根据自己项目有做修改
"toplan/laravel-sms"
注意修改查看https://github.com/toplan/laravel-sms/blob/master/src/Toplan/LaravelSms/validations.php#L16
修改为$attempts = isset($state['attempts']) ? $state['attempts'] : 0 + 1;

### apidoc
apidoc -i App/Api/v1/Controllers -o public/apidoc