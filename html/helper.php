<?php

if (!function_exists('countModules')) {
    /**
     * Returns the total of active given modules.
     *
     * @param $modules
     *
     * @return int
     */

    function countModules($modules) {
        if (!is_array($modules)) {
            $modules = func_get_args();
        }

        $count = 0;

        foreach ($modules as $module) {
            $count += JDocument::getInstance()->countModules($module) > 0 ? 1 : 0;
        }

        return $count;
    }
}

if (!function_exists('hasModule')) {
    /**
     * Check if a module exists.
     *
     * @param $module
     *
     * @return bool
     */
    function hasModule($module) {
        return JDocument::getInstance()->countModules($module) > 0 ? true : false;
    }
}
