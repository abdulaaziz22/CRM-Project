<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Builder;

class MacroServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $app = $this->app;

        Builder::macro('dynamicPaginate', function () use ($app) {
            /** @var Request $request */
            $request = $app->get('request');

            if ('none' === $request->get('pagination') ) {
                return $this->get();
            }

            $page = Paginator::resolveCurrentPage();

            $perPage = $request->get('per_page', 10);

            $results = ($total = $this->toBase()->getCountForPagination())
                ? $this->forPage($page, $perPage)->get(['*'])
                : $this->model->newCollection();

            return $this->paginator($results, $total, $perPage, $page, [
                'path' => Paginator::resolveCurrentPath(),
                'pageName' => 'page',
            ]);
        });
    }
}
