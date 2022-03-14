<?php

namespace App\Http\Controllers;

use DB;
use File;
use App\Article;
use App\Resource;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\ArticleAddRequest;
use App\Http\Requests\ArticleEditRequest;

class ArticleController extends Controller
{
    public function getList()
    {
        $data =  DB::table('articles')->orderBy('id','DESC')->get();
    	return view('backend.article.index',compact('data'));
    }

    public function getAdd()
    {
        $data = DB::table('products')->orderBy('id','DESC')->get();
    	return view('backend.article.add',compact('data'));
    }

    public function postAdd(ArticleAddRequest $request)
    {
        // $request->file('fImage')->getClientOriginalName();
        $filename=$request->file('fImage')->getClientOriginalName();
        $request->file('fImage')->move(
            'images/article/', $filename
        );
    	$article              = new Article();
        $article->title       = $request->txtMNTittle;
        $article->summary     = $request->txtMNResum;
        $article->description = $request->txtMNContent;
        $article->slug        = Str::slug($request->txtMNTittle);
        $article->views       = 1;
        $article->image       = $filename;

        $article->save();

        $data = $request->input('products',[]);
        foreach ($data as  $item) {
            $resource             = new Resource();
            $resource->product_id = $item;
            $resource->article_id = $article->id;

            $resource->save();
        }
        return redirect()->route('admin.article.index')->with(['flash_level'=>'success','flash_message'=>'Đăng tin thành công!!!']);
    }

    public function getDelete($id)
    {
        $article = DB::table('articles')->where('id',$id)->first();
        $img = 'images/article/'.$article->image;
        File::delete($img);
    	DB::table('resources')->where('article_id',$id)->delete();
    	DB::table('articles')->where('id',$id)->delete();
        return redirect()->route('admin.article.index')->with(['flash_level'=>'success','flash_message'=>'Xóa thành công!!!']);
    }

    public function getEdit($id)
    {
    	$article = DB::table('articles')->where('id',$id)->first();
        $resources = DB::table('resources')->select('product_id')->where('article_id',$id)->get();
        foreach ($resources as $key => $val) {
            $resource[] = $val->product_id;
        }
        if (!empty($resources)) {
        
            $product_1 = DB::table('products')
                    ->whereIn('id',$resource)
                    ->get();
        } else {
            $product_1 = DB::table('products')
                    ->whereIn('id',['0'])
                    ->get();
        }

        if (empty($resource)) {
            $product_2 = DB::table('products')
                    ->whereNotIn('id',['0'])
                    ->get();
        } else {
            $product_2 = DB::table('products')
                    ->whereNotIn('id',$resource)
                    ->get();
        }
        return view('backend.article.edit',compact('article','product_1','product_2'));
    }

    public function postEdit(ArticleEditRequest $request,$id)
    {
    	$fImage = $request->fImage;
        $img_current = 'images/article/'.$request->fImageCurrent;
        if (!empty($fImage )) {
             $filename=$fImage ->getClientOriginalName();
             DB::table('articles')->where('id',$id)
                            ->update([
                                'title'   => $request->txtMNTittle,
                                'summary'           => $request->txtMNResum,
                                'description' => $request->txtMNContent,
                                'slug'   => Str::slug($request->txtMNTittle),
                                'image'=> $filename
                                ]);
             $fImage ->move('images/article/', $filename);
             File::delete($img_current);
        } else {
            DB::table('articles')->where('id',$id)
                            ->update([
                                'title'   => $request->txtMNTittle,
                                'summary'           => $request->txtMNResum,
                                'description' => $request->txtMNContent,
                                'slug'   => Str::slug($request->txtMNTittle)
                                ]);
        }
        
        DB::table('resources')->where('article_id',$id)->delete();
        $data = $request->input('products',[]);
        foreach ($data as  $item) {
            $resource = new Resource();
            $resource->product_id = $item;
            $resource->article_id = $id;
            $resource->save();
        }
        return redirect()->route('admin.article.index')->with(['flash_level'=>'success','flash_message'=>'Cập nhật thành công!!!']);
    }

    public function getEditMaterial($id)
    {
        $resource = DB::table('resources')->select('product_id')->where('article_id',$id)->get();
        foreach ($resource as $key => $val) {
            $resource[] = $val->product_id;
        }
        if (!empty($resource)) {
        
            $product_1 = DB::table('products')
                    ->whereIn('id',$resource)
                    ->get();
        } else {
            $product_1 = DB::table('products')
                    ->whereIn('id',['0'])
                    ->get();
        }

        if (empty($resource)) {
            $product_2 = DB::table('products')
                    ->whereNotIn('id',['0'])
                    ->get();
        } else {
            $product_2 = DB::table('products')
                    ->whereNotIn('id',$resource)
                    ->get();
        }
        return view('backend.article.resource_edit',compact('product_1','product_2'));
    }

    public function postEditMaterial(Request $request,$id)
    {
        DB::table('resources')->where('article_id',$id)->delete();
        $data = $request->input('products',[]);
        foreach ($data as  $item) {
            $resource = new Resource();
            $resource->product_id = $item;
            $resource->article_id = $id;
            $resource->save();
        }
        return redirect()->route('admin.article.index')->with(['flash_level'=>'success','flash_message'=>'Sửa thành công!!!']);
    }

    public function getAddMaterial()
    {
        $san_pham = DB::table('products')->orderBy('id','DESC')->get();
        return view('backend.article.resource_add',compact('sanpham'));
    }

    public function postAddMaterial(Request $request)
    {
        $data = $request->input('products',[]);
        foreach ($data as  $item) {
            //print_r($item);
            $resource = new Resource();
            $resource->product_id = $item;
            $resource->article_id = $request->txtID;
            $resource->save();
        }
        return redirect()->route('admin.article.index')->with(['flash_level'=>'success','flash_message'=>'Thêm thành công!!!']);
    }

    // public function listMat($id)
    // {
    //     $data =  DB::table('resources')->where('article_id',$id)->orderBy('id','DESC')->get();
    //     return view('backend.article.resource_index',compact('data'));
    // }
}
