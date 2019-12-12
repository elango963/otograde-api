<?php
use Carbon\Carbon;

if (!function_exists('findVehicle')) {
    function findVehicle($source)
    {
        switch ($source) {
            case '2wheeler':
                $code = '2WHLR';
                break;
            case '3wheeler':
                $code = '3WHLR';
                break;
            case 'fe':
                $code = 'FAREQ';
                break;
            case 'cv':
                $code = 'CMVHL';
                break;
            case '4wheeler':
                $code = '4WHLR';
                break;
            case 'ce':
                $code = '4WHLR';
                break;
            default:
                $code = 'CONEQ';
                break;
        }

        return $code;
    }
}

if (!function_exists('aesEncrypt')) {

    function aesEncrypt($text)
    {
        $salt = config('app.key');
        return trim(base64_encode(@mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $salt, $text, MCRYPT_MODE_ECB, @mcrypt_create_iv(@mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND))));
    }
}

if (!function_exists('aesDecrypt')) {

    function aesDecrypt($text)
    {
        $salt = config('app.key');
        return trim(@mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $salt, base64_decode($text), MCRYPT_MODE_ECB, @mcrypt_create_iv(@mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND)));
    }
}

if (!function_exists('logInfo')) {
    function logInfo($message, $enableLog =  false)
    {
        if (env('APP_ENV') != 'production' || $enableLog) {
            \Log::info($message);
        }
    }
}

if (!function_exists('logException')) {
    function logException($e, $enableLog = true)
    {
        if (env('APP_ENV') != 'production' || $enableLog) {
            \Log::error($e->getline());
            \Log::error($e->getFile());
            \Log::error($e->getMessage());
        }
    }
}

if (!function_exists('removeKeys')) {
    function removeKeys($parent,$keysToRemove)
    {
        return array_diff_key($parent,array_flip($keysToRemove));
    }
}


if (!function_exists('findKeyInData')) {
    function findKeyInData($needle,$heystack) 
    {
        if(empty($heystack)===true)
        {
            return false;
        }
        if (array_key_exists($needle,$heystack) || in_array($needle,$heystack)) {
                 return array_get($heystack,$needle);
        } else {
            $return = false;
            foreach (array_values($heystack) as $value) {
                if (is_array($value) && !$return) {
                    $return = findKeyInData($needle,$value);
                }
            }
            return $return;
        }
    }
}


if (!function_exists('fetchData')) {
    function fetchData($array, $key) 
    {
        $values = array_values(explode('.', $key));
        $lastKey            =   end($values);
        $checkArrayExist    =   findKeyInData($lastKey,$array);
        return $checkArrayExist;
    }
}

if (!function_exists('returnFirstData')) {
    function returnFirstData(&$value,$key,$config) 
    {
        if(is_array($value) && array_key_exists($key, $config)){
            $value =  array_shift($value);
        }
    }
}

if ( ! function_exists('get_config_path')) {
    
    function get_config_path($path = '')
    {
        return app()->basePath() . '/config' . ($path ? '/' . $path : $path);
    }
}

if ( ! function_exists('get_public_path')) {
    
    function get_public_path($path = '')
    {
        return app()->basePath() . '/public' . ($path ? '/' . $path : $path);
    }
}

if ( ! function_exists('validateDate')) {
    
    function validateDate($date,$format)
    {
        $parseDate = Carbon::parse($date);
        return $parseDate && $parseDate->format($format) == $date;
    }
}

if (!function_exists('transformDate')) {

    function transformDate($date, $format = 'd-M-Y')
    {
        return Carbon::parse($date)->format($format);
    }
}

if (!function_exists('apiCall')) {

    function apiCall($url, $options = [], $method = "GET")
    {
        try {
            $client = app()->make(GuzzleHttp\Client::class);
            $response = $client->{$method}($url, $options);

            if ($response->getStatusCode() === 200) {

                $response = $response->getBody()->getContents();
                
                return $response;
            }
        } catch(\ClientException $e) {
            exceptionLogger("Helper api call", $e);
        } catch(\Exception $e) {
            exceptionLogger("Helper api call", $e);
        }
        
        return null;
    }
}

if (!function_exists('exceptionLogger')) {
    
    function exceptionLogger($name, $e)
    {
        $content = sprintf('%s File name : %s Line at %s', $e->getMessage(), $e->getFile(), $e->getLine());
        \Log::error($name . " Exception : " . $content);
    }
}

if (!function_exists('make')) {
    
    function make($class, array $param = [])
    {
        $class = new ReflectionClass($class);
        return $class->newInstanceArgs($param);
    }
}

if (!function_exists('dateSort')) {
    function dateSort($a, $b) 
    {
        return strtotime($b) - strtotime($a);
    }
}

if (!function_exists('dateCompare')) {
    function dateCompare($a, $b)
    {
        $t1 = strtotime($a['Transaction_date']);
        $t2 = strtotime($b['Transaction_date']);

        return $t1 - $t2;
    }  
}

if (!function_exists('getDateDiffInMonths')) {
    function getDateDiffInMonths($date1, $date2) {
        $date1 = new DateTime($date1);
        $date2 = new DateTime($date2);

        $interval = $date1->diff($date2);

        return (($interval->format('%y') * 12) + $interval->format('%m'));
    }
}