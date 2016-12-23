
 <?php

 return [

    /*
    |--------------------------------------------------------------------------
    | Application Name
    |--------------------------------------------------------------------------
    |
    | This value is the name of your application. This value is used when the
    | framework needs to place the application's name in a notification or
    | any other location as required by the application or its packages.
    */

    'name' => env('APP_NAME', null),

    /*
    |--------------------------------------------------------------------------
    | Application Environment
    |--------------------------------------------------------------------------
    |
    | This value determines the "environment" your application is currently
    | running in. This may determine how you prefer to configure various
    | services your application utilizes. Set this in your ".env" file.
    |
    */

    'env' => env('APP_ENV', 'production'),

    /*
    |--------------------------------------------------------------------------
    | Application Debug Mode
    |--------------------------------------------------------------------------
    |
    | When your application is in debug mode, detailed error messages with
    | stack traces will be shown on every error that occurs within your
    | application. If disabled, a simple generic error page is shown.
    |
    */

    'debug' => env('APP_DEBUG', false),

    /*
    |--------------------------------------------------------------------------
    | Application URL
    |--------------------------------------------------------------------------
    |
    | This URL is used by the console to properly generate URLs when using
    | the Artisan command line tool. You should set this to the root of
    | your application so that it is used when running Artisan tasks.
    |
    */

    'url' => env('APP_URL', 'http://localhost'),

    /*
    |--------------------------------------------------------------------------
    | Application Timezone
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default timezone for your application, which
    | will be used by the PHP date and date-time functions. We have gone
    | ahead and set this to a sensible default for you out of the box.
    |
    */

    'timezone' => 'UTC+8',

    /*
    |--------------------------------------------------------------------------
    | Application Locale Configuration
    |--------------------------------------------------------------------------
    |
    | The application locale determines the default locale that will be used
    | by the translation service provider. You are free to set this value
    | to any of the locales which will be supported by the application.
    |
    */

    'locale' => 'zh-CN',

    /*
    |--------------------------------------------------------------------------
    | Application Fallback Locale
    |--------------------------------------------------------------------------
    |
    | The fallback locale determines the locale to use when the current one
    | is not available. You may change the value to correspond to any of
    | the language folders that are provided through your application.
    |
    */

    'fallback_locale' => 'zh-CN',

    /*
    |--------------------------------------------------------------------------
    | Encryption Key
    |--------------------------------------------------------------------------
    |
    | This key is used by the Illuminate encrypter service and should be set
    | to a random, 32 character string, otherwise these encrypted strings
    | will not be safe. Please do this before deploying an application!
    |
    */

    'key' => env('APP_KEY'),

    'cipher' => 'AES-256-CBC',

    /*
    |--------------------------------------------------------------------------
    | Logging Configuration
    |--------------------------------------------------------------------------
    |
    | Here you may configure the log settings for your application. Out of
    | the box, Laravel uses the Monolog PHP logging library. This gives
    | you a variety of powerful log handlers / formatters to utilize.
    |
    | Available Settings: "single", "daily", "syslog", "errorlog"
    |
    */

    'log' => env('APP_LOG', 'daily'),

    'log_level' => env('APP_LOG_LEVEL', 'debug'),

    /*
    |--------------------------------------------------------------------------
    | Autoloaded Service Providers
    |--------------------------------------------------------------------------
    |
    | The service providers listed here will be automatically loaded on the
    | request to your application. Feel free to add your own services to
    | this array to grant expanded functionality to your applications.
    |
    */

    'providers' => [

        /*
         * Laravel Framework Service Providers...
         */
        Illuminate\Auth\AuthServiceProvider::class,
        Illuminate\Broadcasting\BroadcastServiceProvider::class,
        Illuminate\Bus\BusServiceProvider::class,
        Illuminate\Cache\CacheServiceProvider::class,
        Illuminate\Foundation\Providers\ConsoleSupportServiceProvider::class,
        Illuminate\Cookie\CookieServiceProvider::class,
        Illuminate\Database\DatabaseServiceProvider::class,
        Illuminate\Encryption\EncryptionServiceProvider::class,
        Illuminate\Filesystem\FilesystemServiceProvider::class,
        Illuminate\Foundation\Providers\FoundationServiceProvider::class,
        Illuminate\Hashing\HashServiceProvider::class,
        Illuminate\Mail\MailServiceProvider::class,
        Illuminate\Notifications\NotificationServiceProvider::class,
        Illuminate\Pagination\PaginationServiceProvider::class,
        Illuminate\Pipeline\PipelineServiceProvider::class,
        Illuminate\Queue\QueueServiceProvider::class,
        Illuminate\Redis\RedisServiceProvider::class,
        Illuminate\Auth\Passwords\PasswordResetServiceProvider::class,
        Illuminate\Session\SessionServiceProvider::class,
        Illuminate\Translation\TranslationServiceProvider::class,
        Illuminate\Validation\ValidationServiceProvider::class,
        Illuminate\View\ViewServiceProvider::class,

        /*
         * Application Service Providers...
         */
        App\Providers\AppServiceProvider::class,
        // App\Providers\BroadcastServiceProvider::class,
        App\Providers\AuthServiceProvider::class,
        App\Providers\EventServiceProvider::class,
        App\Providers\RouteServiceProvider::class,
        //权限控制
        Zizaco\Entrust\EntrustServiceProvider::class,
        App\Providers\AccessServiceProvider::class,
        /**
         * PassportServiceProvider 官方Passport认证插件
         * SocialiteServiceProvider官方社会化登录插件
         * Scout官方全文搜索插件
         */
        Laravel\Passport\PassportServiceProvider::class,
        Laravel\Scout\ScoutServiceProvider::class,
        /*
         * 第三方组件
         */
        //调试分析工具
        Barryvdh\Debugbar\ServiceProvider::class,
        //Lsrur\Inspector\InspectorServiceProvider::class,
        //Html工具
        Collective\Html\HtmlServiceProvider::class,
        //Datatables插件
        Yajra\Datatables\DatatablesServiceProvider::class,
        //Active 导航选中插件
        HieuLe\Active\ActiveServiceProvider::class,
        //导航条插件
        DaveJamesMiller\Breadcrumbs\ServiceProvider::class,
        //短信接口插件
        Toplan\PhpSms\PhpSmsServiceProvider::class,
        Toplan\Sms\SmsManagerServiceProvider::class,
        //极验验证
        Germey\Geetest\GeetestServiceProvider::class,
        //dingo api
        Dingo\Api\Provider\LaravelServiceProvider::class,
        //分类插件
        Baum\Providers\BaumServiceProvider::class,
        //百度编辑器
        Stevenyangecho\UEditor\UEditorServiceProvider::class,
        //Media
        TalvBansal\MediaManager\Providers\MediaManagerServiceProvider::class,
        //图片处理
        Intervention\Image\ImageServiceProvider::class,
        //jquery validate
        Proengsoft\JsValidation\JsValidationServiceProvider::class,
        //上传插件
        JildertMiedema\LaravelPlupload\LaravelPluploadServiceProvider::class,
        //日志插件
        Arcanedev\LogViewer\LogViewerServiceProvider::class,
        App\Providers\ExceptionsServiceProvider::class,
        //Jpush
        App\Providers\JpushServiceProvider::class
    ],

    /*
    |--------------------------------------------------------------------------
    | Class Aliases
    |--------------------------------------------------------------------------
    |
    | This array of class aliases will be registered when this application
    | is started. However, feel free to register as many as you wish as
    | the aliases are "lazy" loaded so they don't hinder performance.
    |
    */

    'aliases' => [

        'App' => Illuminate\Support\Facades\App::class,
        'Artisan' => Illuminate\Support\Facades\Artisan::class,
        'Auth' => Illuminate\Support\Facades\Auth::class,
        'Blade' => Illuminate\Support\Facades\Blade::class,
        'Cache' => Illuminate\Support\Facades\Cache::class,
        'Config' => Illuminate\Support\Facades\Config::class,
        'Cookie' => Illuminate\Support\Facades\Cookie::class,
        'Crypt' => Illuminate\Support\Facades\Crypt::class,
        'DB' => Illuminate\Support\Facades\DB::class,
        'Eloquent' => Illuminate\Database\Eloquent\Model::class,
        'Event' => Illuminate\Support\Facades\Event::class,
        'File' => Illuminate\Support\Facades\File::class,
        'Gate' => Illuminate\Support\Facades\Gate::class,
        'Hash' => Illuminate\Support\Facades\Hash::class,
        'Input' => Illuminate\Support\Facades\Input::class,
        'Lang' => Illuminate\Support\Facades\Lang::class,
        'Log' => Illuminate\Support\Facades\Log::class,
        'Mail' => Illuminate\Support\Facades\Mail::class,
        'Password' => Illuminate\Support\Facades\Password::class,
        'Queue' => Illuminate\Support\Facades\Queue::class,
        'Redirect' => Illuminate\Support\Facades\Redirect::class,
        'Redis' => Illuminate\Support\Facades\Redis::class,
        'Request' => Illuminate\Support\Facades\Request::class,
        'Response' => Illuminate\Support\Facades\Response::class,
        'Route' => Illuminate\Support\Facades\Route::class,
        'Schema' => Illuminate\Support\Facades\Schema::class,
        'Session' => Illuminate\Support\Facades\Session::class,
        'Storage' => Illuminate\Support\Facades\Storage::class,
        'URL' => Illuminate\Support\Facades\URL::class,
        'Validator' => Illuminate\Support\Facades\Validator::class,
        'View' => Illuminate\Support\Facades\View::class,
        //官方社会化登录插件
        'Socialite' => Laravel\Socialite\Facades\Socialite::class,
        //调试分析工具
        'Debugbar' => Barryvdh\Debugbar\Facade::class,
        //'Inspector' => Lsrur\Inspector\Facade\Inspector::class,
        //HtmlForm工具
        'Html'        => Collective\Html\HtmlFacade::class,
        'Form'        => Collective\Html\FormFacade::class,
        //基于角色的权限系统
        'Entrust'   => Zizaco\Entrust\EntrustFacade::class,
        //Active 导航选中插件
        'Active' => HieuLe\Active\Facades\Active::class,
        //导航条插件
        'Breadcrumbs' => DaveJamesMiller\Breadcrumbs\Facade::class,
        //短信接口
        'PhpSms' => Toplan\PhpSms\Facades\Sms::class,
        'SmsManager' => Toplan\Sms\Facades\SmsManager::class,
        //极验验证
        'Geetest' => Germey\Geetest\Geetest::class,
        //Dingo api
        'Api' => Dingo\Api\Facade\API::class,
        'ApiRoute' => Dingo\Api\Facade\Route::class,
        //图片处理
        'Image' => Intervention\Image\Facades\Image::class,
        //jquery validate
        'JsValidator' => Proengsoft\JsValidation\Facades\JsValidatorFacade::class,
        'Plupload' => JildertMiedema\LaravelPlupload\Facades\Plupload::class,
        'Jpush' => App\Facades\Jpush::class,
    ],

 ];
