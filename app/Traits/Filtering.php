<?php

/*
|--------------------------------------------------------------------------
| Auto filtering with pagination and archiving for models
|--------------------------------------------------------------------------
|
| Here is where all the filtering logic happens, from filtering the
| current model to filtering other models and entrust.
|
*/

namespace App\Traits;

use Carbon\Carbon;

trait Filtering
{
    /**
     * Retrieve archives for model.
     *
     * @return array
     */
    public static function archives()
    {
        return static::selectRaw('year(created_at) year, monthname(created_at) month, count(*) published')
            ->groupBy('year', 'month')
            ->orderByRaw('created_at desc')
            ->get();
    }

    /**
     * Filter the query for model.
     *
     * 1. Filter by month and year
     * 2. Filter by other queries
     *
     * 3-a. Check if searchColumn exists in queries
     * 3-b. If searchColumn exists in the string then remove it
     * 3-c. Get all uppercase letter and their position
     * 3-d. $matches comes from the $matches in preg_match_all
     * 3-e. Loop everything in $matches
     * 3-f. Then add '_' to every upper case and convert it to lowercase
     * 3-g. Remove the first '_' in the string then add it to query
     *
     * @param  object $query
     * @param  \Illimunate\Http\Request $request
     * @return void
     */
    public function scopeFilter($query, $request)
    {
        if ($month = $request->month) {
            $query->whereMonth('created_at', Carbon::parse($month)->month);
        }

        if ($year = $request->year) {
            $query->whereYear('created_at', $year);
        }

        $query->where(function ($query) use ($request) {
            foreach ($request->all() as $key => $value) {
                if (in_array(self::convertToColumn($key), $this->fillable)) {
                    if (strpos($key, 'searchColumn') !== false &&
                        strpos($key, 'FromModel') == false &&
                        ! is_array($value) && $value !== null
                    ) {
                        $query->where(self::convertToColumn($key), 'Like', '%' . $value . '%');
                    }

                    if (strpos($key, 'searchArrayColumn') !== false &&
                        strpos($key, 'FromModel') == false &&
                        is_array($value)
                    ) {
                        $query->where(function ($query) use ($key, $value) {
                            foreach ($value as $arrayValue) {
                                if ($arrayValue !== null) {
                                    $query->where(self::convertToColumn($key), 'Like', '%' . $arrayValue . '%');
                                }
                            }
                        });
                    }
                }
            }
        });

        if ($request->has('is_published')) {
            if ($request->is_published == 1 || $request->is_published == 0) {
                $query->where('is_published', $request->is_published);
            }
        }

        self::checkTraits($query, $request);
    }

    /**
     * Check model if it uses other filtering options.
     *
     * @param  object $query
     * @param  object $request
     * @return void
     */
    public function checkTraits($query, $request)
    {
        foreach (class_uses($this) as $trait) {
            if (strpos($trait, 'FilterEntrust') !== false) {
                $this->filterEntrust($query, $request);
            }

            if (strpos($trait, 'FilterOtherModels') !== false) {
                $this->filterOtherModels($query, $request);
            }
        }
    }

    /**
     * Convert key string to column name.
     *
     * @param  string $key
     * @return string
     */
    public function convertToColumn($key)
    {
        $string = preg_replace('/searchColumn|searchArrayColumn|searchArray|search|FromModel.+|Model.+/i', '', $key);

        preg_match_all('/[A-Z]/', $string, $matches, PREG_OFFSET_CAPTURE);

        foreach ($matches[0] as $key => $matchPair) {
            $string = str_replace($matchPair[0], '_' . lcfirst($matchPair[0]), $string);
        }

        if (preg_match('/\_/', $string, $matches)) {
            return preg_replace('/_/', '', $string, 1);
        }
    }

    /**
     * Check and clean url also remove duplicated key value pairs.
     *
     * 1. Check if request uri has queries
     * 2. Parse all queries to remove duplication
     * 3. Remove _method and _token key
     * 4. Create full uri by combining current uri and query
     * 5. If remove page is true return full uri and page key
     * 6. Replace ?& with ? at the start of the query
     * 7. Remove & at the end of the query
     * 8. !! Return with page if $removePage is false
     * 9. !! Just return the path if no query found in the url
     *
     * @param  \Illuminate\Http\Request &$request
     * @return string
     */
    public static function createPaginationUrl($request, $removePage = false)
    {
        if (parse_url($request->path() . '?' . http_build_query(($request->all())), PHP_URL_QUERY)) {
            parse_str(parse_url($request->path() . '?' . http_build_query(($request->all())), PHP_URL_QUERY), $output);

            unset($output['_method']);

            unset($output['_token']);

            $uri = $request->path() . '?' . http_build_query($output);

            if ($removePage) {
                return preg_replace('/\?page=[\d]{1,}/', '', '/' . preg_replace('/\?&/', '?', rtrim(preg_replace('/\?page=[\d]{1,}\&page=[\d]{1,/', '', $uri), '&')));
            }

            return '/' . preg_replace('/\?&/', '?', rtrim($uri, '&'));
        }

        return '/' . $request->path();
    }
}
