<?php

namespace App\Supports;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Route;

class PageSupport
{
    public static function getCurrentSidebar($sidebar = [])
    {
        /** @var Collection $sidebar */
        $sidebar = collect($sidebar);
        $route = Route::getCurrentRoute();

        $routeName = $route->getName();
        $url = "/" . request()->getUri();

        $filteredSidebar = $sidebar;
        $selectedSidebar = null;
        while ($filteredSidebar->isNotEmpty()) {

            //iterate
            $selectedSidebar = self::iterateThroughSidebar($url, $routeName, $filteredSidebar);

            if ($selectedSidebar || $filteredSidebar->isEmpty()) {
                return $selectedSidebar;
            }

            $filteredSidebar = $filteredSidebar->pluck('children');
            $filteredSidebar = $filteredSidebar->flatten(1);
        }

        return $selectedSidebar;

    }

    private static function iterateThroughSidebar($url = "", $routeName = "", $sidebar = null)
    {
        if (!$sidebar) {
            $sidebar = collect();
        }
        $selectedSidebar = null;
        $sidebar = $sidebar->sortByDesc('url');
        $urls = $sidebar->pluck('url')->filter();
        foreach ($urls as $index => $item) {
            if (str_contains($item, $url)) {
                return $sidebar->toArray()[$index];
            }
        }

        $sidebar = $sidebar->sortByDesc('routeName');
        $routeNames = $sidebar->pluck('routeName')->filter();
        foreach ($routeNames as $index => $item) {
            if (str_contains($routeName, $item)) {
                return $sidebar->toArray()[$index];
            }
        }

        return $selectedSidebar ?? null;

    }
}
