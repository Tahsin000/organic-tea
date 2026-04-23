<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class ErrorController extends Controller
{
    public function e400()        { return view('admin.errors.400'); }
    public function e401()        { return view('admin.errors.401'); }
    public function e403()        { return view('admin.errors.403'); }
    public function e404()        { return view('admin.errors.404'); }
    public function e408()        { return view('admin.errors.408'); }
    public function e429()        { return view('admin.errors.429'); }
    public function e500()        { return view('admin.errors.500'); }
    public function e502()        { return view('admin.errors.502'); }
    public function e503()        { return view('admin.errors.503'); }
    public function e504()        { return view('admin.errors.504'); }
    public function maintenance() { return view('admin.errors.maintenance'); }
}
