<?php


namespace App\Interfaces;


use Illuminate\Http\Request;

interface ProductServiceInterface
{

    /**
     * @param Request $request
     * @return mixed
     */
    public function getAll(Request $request);

    /**
     * @param Request $request
     * @return mixed
     */
    public function create(Request $request);

}
