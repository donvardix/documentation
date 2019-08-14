<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\ParserRequest;
use App\Http\Controllers\Controller;
use App\Jobs\StartParser;

class ParserController extends Controller
{
    public function startParser(ParserRequest $request)
    {
        StartParser::dispatch($request->city, $request->checkin, $request->checkout, auth()->user()->id);
        return response()->api(['Parser started work']);
    }
}
