<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOutfit;
use App\Http\Requests\StoreComment;
use App\Models\Outfit;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class OutfitController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show', 'download']);
    }

    public function index()
    {
        $outfits = Outfit::all();
        return response()->json(compact('outfits'), 200);
    }

    public function create(StoreOutfit $request)
    {
        $fileName = $request->outfit->store('outfits', 'public');

        $outfit = new Outfit;
        $outfit->outfit = basename($fileName);
        $outfit->description = $request->description;
        $outfit->user_id = Auth::id();

        $outfit->save();

        // レスポンスコードは201(CREATED)を返却する
        return response($outfit, 201);
    }

    public function show(string $id)
    {
        $outfit = Outfit::where('id', $id)->with(['user', 'comments.author'])->first();

        return $outfit ?? abort(404);
    }

    public function download(Outfit $outfit)
    {
        $filePath = 'public/outfits/' . $outfit->outfit;
        $mimeType = Storage::mimeType($filePath);

        $disposition = 'attachment; outfit="' . $outfit->outfit . '"';
        $headers = [
            'Content-Type' => $mimeType,
            'Content-Disposition' => $disposition,
        ];

        return Storage::download($filePath, $outfit->outfit, $headers);
    }

    public function addComment(Outfit $outfit, StoreComment $request)
    {
        $comment = new Comment();
        $comment->content = $request->get('content');
        $comment->user_id = Auth::user()->id;
        $outfit->comments()->save($comment);

        // authorリレーションをロードするためにコメントを取得しなおす
        $new_comment = Comment::where('id', $comment->id)->with('author')->first();

        return response($new_comment, 201);
    }
}
