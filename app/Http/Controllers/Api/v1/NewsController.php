<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use App\News;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        echo News::orderBy('id','DESC')->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {        
        //
        //$this->authorize('create', News::class);

        $this->validate($request, [
            'title' => 'required',
            'content' => 'required'
        ]);

        $title = $request->newsid;
        $titleid = str_replace('News-', '', $title);
        
        $image = $request->file('image');        
        if($image !== null){
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('uploads');
            $image->move($destinationPath, $name);
        }
        
        if($titleid !== 'News'){
            $news = News::find($titleid);
        }else{
            $news = new News;    
        }
        $news->title=$request->title;
        $news->content = $request->content;
        if($image !== null)$news->poster_url = $name;
        $news->save();
        
        
        // return News::find($titleid);
        // exit();
        
        
        return redirect('news');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        return News::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $news = News::find($id);
        $news->delete();        
    }


    /**
     * 
     */
    public function latest(){
        return News::orderBy('id', 'DESC')->take(6)->get();
    }

    /**
     * 
     */
    public function page($id){
        if($id < 0 )
            return null;
        
        //return News::orderBy('id', 'DESC')->find($id);
        $date = strtotime(date('Y-m-d'));
        $totalday = $id * 16;
        $date = date('Y-m-d', strtotime("-".$totalday." days"));
        
        $result = array();
        for($i = 0 ; $i < 16 ; $i ++){
            $date1 = date('Y-m-d', strtotime("-".$totalday." days"));
            $news = News::whereDate('created_at', $date1)->orderBy('id', 'DESC')->take(1)->get()->toArray();
            
            if(count($news) > 0){
                $news[0]['span'] = 1;
                $news[0]['created_at'] = $date1;
                array_push($result, $news[0]);
            }else{
                array_push($result, array( 'span' => 1, 'created_at' =>$date1, 'title' =>'- NO NEWS -' ));
            }
            
            $totalday ++;
        }
        
        echo json_encode($result);
        exit;
    }

    /**
     * 
     */
    public function date($date){
        
        $date1 = date("Y-m-d", strtotime($date));
        $news = News::whereDate('created_at', $date)->orderBy('id', 'DESC')->get();
        if(count($news) == 0){
            $array = array();
            array_push( $array,array('title'=>'- NO NEWS -') );
            $news = json_encode($array);
        }
        echo $news;
        
    }
}
