<?php

namespace TCG\Voyager;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use TCG\Voyager\Models\Permission;
use TCG\Voyager\Models\Setting;
use TCG\Voyager\Models\User;
use App\PermissionRole;

class Voyager
{
    /**
     *  Singleton Voyager Class.
     */
    private static $instance;

    public static function getInstance()
    {
        if (null === static::$instance) {
            static::$instance = new static();
        }

        return static::$instance;
    }

    public function getVersion()
    {
        $composer_lock = __DIR__.'/../../../../composer.lock';
        $version = null;

        if (File::exists($composer_lock)) {
            // Get the composer.lock file
            $file = json_decode(
                File::get($composer_lock)
            );

            // Loop through all the packages and get the version of voyager
            foreach ($file->packages as $package) {
                if ($package->name == 'tcg/voyager') {
                    $version = $package->version;
                    break;
                }
            }
        }

        return $version;
    }

    protected function __construct()
    {
    }

    private function __clone()
    {
    }

    private function __wakeup()
    {
    }

    /**
     *  End Singleton operators.
     *
     * @param $key
     * @param null $default
     *
     * @return null
     */
    public static function setting($key, $default = null)
    {
        $setting = Setting::where('key', '=', $key)->first();
        if (isset($setting->id)) {
            return $setting->value;
        }

        return $default;
    }

    public static function image($file, $default = '')
    {
        if (!empty($file) && Storage::exists(config('voyager.storage.subfolder').$file)) {
            return Storage::url(config('voyager.storage.subfolder').$file);
        }

        return $default;
    }

    public static function routes()
    {
        require __DIR__.'/../routes/voyager.php';
    }

    public static function check($permission){
        $exist = Permission::where('key', $permission)->first();
        if($exist){
          $_permission = PermissionRole::where('permission_id', $exist->id)->where('role_id', Auth::user()->role_id)->first();
          if ($_permission) {
              return true;
          }
        }

        return false;
    }

    public static function can($permission)
    {
        // Check if permission exist
        $exist = Permission::where('key', $permission)->first();

        if ($exist) {
            $user = User::find(Auth::id());
            if (!$user->hasPermission($permission)) {
                throw new UnauthorizedHttpException(null);
            }
        }
    }
}
