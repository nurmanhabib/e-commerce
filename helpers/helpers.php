<?php

if ( ! function_exists('config_path'))
{
    /**
     * Get the configuration path.
     *
     * @param  string $path
     * @return string
     */
    function config_path($path = '')
    {
        return app()->basePath() . '/config' . ($path ? '/' . $path : $path);
    }
}

if ( ! function_exists('asset'))
{
    function asset($path = '')
    {
        $url = url($path);

        if (str_contains($url, 'index.php')) {
            $url = str_replace('/index.php', '', $url);
        }

        return $url;
    }
}
