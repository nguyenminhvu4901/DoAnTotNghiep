<?php

use App\Domains\Cart\Models\Cart;
use Illuminate\Support\Collection;
use Illuminate\Container\Container;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\Container\BindingResolutionException;

if (!function_exists('isCurrentRouteInRoutes')) {
    /**
     * Check current route in listed routes
     * String sample input: 'user.classes.*' | 'user.dashboard'
     *
     * @param array|string $routes
     * @return bool
     */
    function isCurrentRouteInRoutes(array|string $routes): bool
    {
        $currentRoutes = request()->route()->getName();
        if (is_array($routes)) {
            return in_array($currentRoutes, $routes);
        }

        preg_match('/' . $routes . '/', $currentRoutes, $matches);

        return (bool)count($matches);
    }
}

if (!function_exists('checkDisplayError')) {
    /**
     * Check current route in listed routes
     * String sample input: 'user.classes.*' | 'user.dashboard'
     *
     * @param $errors
     * @param string $field
     * @param string $classReturn
     * @return string
     */
    function checkDisplayError($errors, string $field, string $classReturn = 'is-invalid'): string
    {
        return $errors->has($field) ? $classReturn : '';
    }
}

if (!function_exists('customStripTag')) {
    /**
     * Transform open and close tag into html character
     * @param $string
     * @return array|string|string[]
     */
    function customStripTag($string): array|string
    {
        return str_replace(["<", ">"], ["&#60;", "&#62;"], $string);
    }
}

if (!function_exists('nl2br2')) {
    /**
     * Advance nl2br function with strip tag and unified new line characters
     * @param $string
     * @return string
     */
    function nl2br2($string): string
    {
        $string = customStripTag($string);

        return nl2br(str_replace(["\r\n", "\r", "\n"], "\n", $string));
    }
}

if (!function_exists('checkRecordIdExistInCollection')) {
    /**
     * @param $record
     * @param $collection
     * @param string $stringReturn
     * @return string|null
     */
    function checkRecordIdExistInCollection($record, $collection, string $stringReturn = 'selected'): ?string
    {
        if (!is_null($collection)) {
            $arrayRecord = is_array($collection) ? $collection : $collection->pluck('id')->toArray();
            if (in_array($record, $arrayRecord)) {
                return $stringReturn;
            }
        }

        return null;
    }
}

if (!function_exists('formatNumberWithNDigits')) {
    /**
     * @param int $number
     * @param int $digits
     * @return string
     */
    function formatNumberWithNDigits(int $number, int $digits)
    {
        $number = (string)$number;
        $length = strlen($number);
        if ($length >= $digits) {
            return substr($number, $length - $digits);
        } else {
            // if the number has less than $digits digits, append zeros to the left until it has $digits digits
            return str_pad($number, $digits, '0', STR_PAD_LEFT);
        }
    }
}

if (!function_exists('regexVnCharacter')) {
    /**
     * @param $str
     * @return array|string|string[]|null
     */
    function regexVnCharacter($str): array|string|null
    {
        $str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $str);
        $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
        $str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
        $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $str);
        $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);
        $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
        $str = preg_replace("/(đ)/", 'd', $str);

        $str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'A', $str);
        $str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $str);
        $str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $str);
        $str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'O', $str);
        $str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $str);
        $str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $str);
        $str = preg_replace("/(Đ)/", 'D', $str);

        return $str;
    }
}

if (!function_exists('collectionPaginate')) {
    /**
     * @param Collection $results
     * @param int $pageSize
     * @param int|null $currentPage
     * @param array $otherOptions
     * @return Closure|LengthAwarePaginator|mixed|object|null
     * @throws BindingResolutionException
     */
    function collectionPaginate(
        Collection $results,
        int $pageSize,
        int $currentPage = null,
        array $otherOptions = []
    ): mixed {
        $page = $currentPage ?? Paginator::resolveCurrentPage();
        $total = $results->count();
        $options = array_merge([
            'pageName' => 'page',
            'path' => config('app.url') . request()->getPathInfo(),
        ], $otherOptions);

        return Container::getInstance()->makeWith(LengthAwarePaginator::class, [
            'items' => $results->forPage($page, $pageSize),
            'total' => $total,
            'perPage' => $pageSize,
            'currentPage' => $currentPage,
            'options' => $options,
        ]);
    }
}

if (!function_exists('roundNumber')) {
    /**
     * @param int|float $number
     * @param int $precision
     * @param int $mode
     * @return int|float
     */
    function roundNumber(int|float $number, int $precision = 0, int $mode = PHP_ROUND_HALF_UP): int|float
    {
        $percentage = round($number, $precision, $mode);
        if ($precision == 0 || $percentage - floor($percentage) == 0) {
            return (int) $percentage;
        }

        return $percentage;
    }
}

if (!function_exists('joinPaths')) {
    /**
     * @param ...$paths
     * @return string
     */
    function joinPaths(...$paths)
    {
        $joinedPath = '';

        foreach ($paths as $path) {
            $path = trim($path, '/');
            $joinedPath .= ($joinedPath === '' ? '' : '/') . $path;
        }

        return $joinedPath;
    }
}

if (!function_exists('getStorageDir')) {
    /**
     * @param string $name
     * @param bool $tmp
     * @return string
     */
    function getStorageDir(string $name, bool $tmp = false): string
    {
        return joinPaths(
            $name,
            $tmp ? 'tmp' : ''
        );
    }
}

if (!function_exists('containsNoNull')) {
    /**
     * @param array $arr
     * @return bool
     */
    function containsNoNull(array $arr): bool
    {
        return count(array_filter($arr, fn ($item) => $item === null)) === 0;
    }
}

if (!function_exists('activityTypesThatRequiresFile')) {
    /**
     * @param $type
     * @return bool
     */
    function activityTypesThatRequiresFile($type)
    {
        return in_array($type, [
            config('constants.activity_types.file'),
            config(('constants.activity_types.video'))
        ]);
    }
}

if (!function_exists('numberToRomantic')) {
    /**
     * @param int $number
     * @return string
     */
    function numberToRomantic($number)
    {
        $map = config('constants.roman-numbers');
        $returnValue = '';
        while ($number > 0) {
            foreach ($map as $roman => $int) {
                if ($number >= $int) {
                    $number -= $int;
                    $returnValue .= $roman;
                    break;
                }
            }
        }
        return $returnValue;
    }
}

if (!function_exists('formatDuration')) {
    /**
     * @param int $duration
     * @param string|null $appendText
     * @param string $defaultText
     * @return string
     */
    function formatDuration(int $duration, string|null $appendText = null, string $defaultText = '1'): string
    {
        $minutes = $duration / 60;
        $seconds = $duration % 60;
        if ($minutes > 0) {
            return floor($minutes) . ':' . $seconds . ($appendText ? ' ' . $appendText : '');
        }
        return $seconds > 0 ? $seconds . ($appendText ? ' ' . $appendText : '') : $defaultText;
    }
}

if (!function_exists('moreQuestionScopeDetails')) {
    /**
     * @return array
     */
    function moreQuestionScopeDetails(): array
    {
        $arr = [];
        foreach (config('constants.question-scopes') as $scopeName => $scopeKey) {
            $arr[$scopeKey] = __('CreateQuestion.GeneralInfo.QuestionScope') . ' - ' .
                ($scopeKey === config('constants.question-scopes.both') ? __('Unlimited scope') : __($scopeName));
        }
        return $arr;
    }
}

if (!function_exists('numericOrderToCharacters')) {
    /**
     * @param int $number
     * @return string
     */
    function numericOrderToCharacters(int $number)
    {
        $characters = '';
        $base = ord('A') - 1;

        while ($number > 0) {
            $remainder = ($number) % 26;
            $characters = chr($base + $remainder) . $characters;
            $number = intdiv($number - $remainder, 26);
        }

        return $characters;
    }
}

if (!function_exists('isSort')) {
    /**
     * @param string $key
     * @return bool
     */
    function isSort(string $key): bool
    {
        $sortConstants = config('constants.sort');
        return in_array($key, [$sortConstants['asc']['id'], $sortConstants['desc']['id']]);
    }
}

if (!function_exists('commandClearLines')) {
    /**
     * Clear lines of artisan commands
     *
     * @param $output
     * @param int $lines
     * @return void
     */
    function commandClearLines($output, int $lines = 1): void
    {
        $moveUp = "\033[1A";
        $moveStartCharacter = "\033[0G";
        $clearLine = "\033[2K";
        if ($lines == 1) {
            $output->write($moveStartCharacter . $clearLine);
        } else {
            for ($i = 1; $i < $lines - 1; $i++) {
                $output->write($moveUp . $moveStartCharacter . $clearLine);
            }
        }
    }
}

if (!function_exists('countProductInCart')) {
    /**
     * @return array
     */
    function countProductInCart()
    {
        return Cart::where('user_id', auth()->user()->id)
            ->where('product_quantity', '!=', 0)->count();
    }
}
