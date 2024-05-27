<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Language;
use App\Repositories\Eloquent\BrandEloquent;
use Illuminate\Http\Request;

class BrandController extends Controller
{

    private $brand;
    public function __construct(BrandEloquent $brandEloquent)
    {
        $this->brand = $brandEloquent;
    }

    public function anyData()
    {
        return $this->brand->anyData();
    }
    public function index()
    {

        $links = [
            '#' => __('dashboard.brands'),
            route('dashboard.brands.index') => __('dashboard.brands list'),
        ];

        $data = [
            'page_title' => __('dashboard.brands list'),
            'links' => $links
        ];
        return view(dashboard() . '.brands.index', $data);
    }
    public function create()
    {

        $links = [
            '#' => __('dashboard.brands'),
            route('dashboard.brands.index') => __('dashboard.brands list'),
            route('dashboard.brands.create') => __('dashboard.brands create'),

        ];
        $languages = Language::all();

        $data = [
            'page_title' => __('dashboard.brands create'),
            'links' => $links,
            'languages' => $languages,

        ];
        return view(dashboard() . '.brands.create', $data);
    }

    public function store(Request $request)
    {
        return $this->brand->create($request->all());

    }
    public function changeStatus(Brand $brand)
    {

        return $this->brand->changeStatus($brand->id);
    }


    public function show(Brand $brand)
    {
        $links = [
            '#' => __('dashboard.brands'),
            route('dashboard.brands.index') => __('dashboard.brands list'),
            route('dashboard.brands.show', $brand) => __('dashboard.brands show'),

        ];

        $data = [
            'page_title' => __('dashboard.brands show'),
            'links' => $links,
            'brand' => $brand,

        ];
        return view(dashboard() . '.brands.show', $data);
    }

    public function edit(Brand $brand)
    {
        $languages = Language::all();

        $links = [
            '#' => __('dashboard.brands'),
            route('dashboard.brands.index') => __('dashboard.brands list'),
            route('dashboard.brands.edit', $brand) => __('dashboard.brands edit'),

        ];

        $data = [
            'page_title' => __('dashboard.brands edit'),
            'links' => $links,
            'brand' => $brand,
            'languages' => $languages,
        ];
        return view(dashboard() . '.brands.create', $data);
    }


    public function update(Request $request, Brand $brand)
    {
        return $this->brand->update($request->all(),$brand->id);


    }

    public function destroy(Brand $brand)
    {
        return $this->brand->delete($brand->id);
    }
}
