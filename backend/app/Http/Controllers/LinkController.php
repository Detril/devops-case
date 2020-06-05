<?php
  
namespace App\Http\Controllers;
  
use App\Link;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
  
  
class LinkController extends Controller
{
    public function index() {
        $links = Link::all();
        return response()->json($links);
    }

    public function create(Request $request) {
        // creating link
        $link = Link::create($request->all());
        // sending event
        Redis::publish(
            'link_created', 
            json_encode([
                'url' => $link->url,
                'id' => $link->id
            ])
        );
        // returning response
        return response()->json($link);
    }

    public function update(Request $request, $id){
        $link  = Link::find($id);
        $link->title = $request->input('title');
        $link->save();
  
        return response()->json($link);
    }
}
