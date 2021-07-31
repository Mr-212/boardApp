<?php

namespace App\Http\Controllers;

use App\Models\Board;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BoardController extends Controller
{
    private $response = ['STATUS_CODE' => 'ERROR','data' => null,'message'=>null];
    private $boardModel;

    public function __construct()
    {
        $this->boardModel = Board::class;
    }

   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            try{
                $this->response['data'] = $this->boardModel::get();
                $this->response['STATUS_CODE'] = "OK";

            }catch(Exception $e){
                $this->response['ERROR'] = $e->getMessage();
            }
            return response()->json($this->response);
        }
        else
            return view('pages.board');
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
        
        try{
            $Validator = Validator::make($request->all(),
            [
                'title' => 'string|required|unique:boards,title'
            ]
            );
            
           
            if(!$Validator->fails() && $request->has('title')){
                if($this->boardModel::create(['title'=>$request->title])){
                    $this->response['STATUS_CODE'] = 'OK';
                    $this->response['message'] = 'Board added successfully';


                }
            }
            else{
                $this->response['STATUS_CODE'] = 'VALIDATION_ERROR';
                $this->response['ERROR'] = $Validator->errors();  
            }

        }catch(Exception $e){
            $this->response['ERROR'] = $e->getMessage();
        }
        return response()->json($this->response);
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
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
        // dd($request->all());
        $request->validate(
            [
                'id' => 'integer|required',
                'title' => 'string|required'
            ]
        );
        try{
           
            if(!empty($id) && $request->has('id')){
                if($this->boardModel::where('id',$request->id)->update(['title'=>$request->title])){
                    $this->response['STATUS_CODE'] = 'OK';
                    $this->response['message'] = 'Board title updated successfully';


                }
            }

        }catch(Exception $e){
            $this->response['ERROR'] = $e->getMessage();
        }
        return response()->json($this->response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
           
            if(!empty($id)){
                if($this->boardModel::where('id',$id)->exists()){
                   
                    if($this->boardModel::destroy($id)){
                        // dd('here');
                         $this->response['STATUS_CODE'] = 'OK';
                         $this->response['message'] = 'Board deleted successfully';
                    }
                }
            }

        }catch(Exception $e){
            $this->response['ERROR'] = $e->getMessage();
        }
        return response()->json($this->response);
    }
}
