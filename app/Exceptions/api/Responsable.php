<?php
namespace App\Exceptions\api;

use Exception;
use Illuminate\Http\Request;

interface Responsable
{
    public function render(Request $request);
}
