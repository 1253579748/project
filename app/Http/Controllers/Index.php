<?php


namespace App\Http\Controllers;


class Index
{
    public function index()
    {
        return view('admin.index.index');
    }

    public function add()
    {
        return view('admin.index.add', [
                'name' => 'zuohge'

            ]);
    }
}