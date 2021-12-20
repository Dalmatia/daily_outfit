<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOutfit;
use App\Models\Outfit;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class OutfitController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return Outfit::all();
    }

    public function create(StoreOutfit $request)
    {
        $filePath = $request->outfit->store('outfits');

        $outfit = new Outfit;
        $outfit->outfit = basename($filePath);
        $outfit->description = $request->description;
        $outfit->user_id = Auth::id();

        $outfit->save();

        // レスポンスコードは201(CREATED)を返却する
        return response($outfit, 201);
    }
}
