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

    public function create(StoreOutfit $request)
    {
        $extension = $request->outfit->extension();

        $outfit = new Outfit();

        $outfit->filename = $outfit->id . '.' . $extension;

        $request->outfit->storeAs('outfits', $outfit->filename, 'public');

        DB::beginTransaction();

        try {
            Auth::user()->outfits()->save($outfit);
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            // DBとの不整合を避けるためアップロードしたファイルを削除
            Storage::disk()->delete($outfit->filename);
            throw $exception;
        }

        // リソースの新規作成なので
        // レスポンスコードは201(CREATED)を返却する
        return response($outfit, 201);
    }
}
