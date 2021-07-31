<?php

namespace App\Http\Controllers;

use App\Models\Card;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CardController extends Controller
{
    private $response = ['STATUS_CODE' => 'ERROR','data' => null,'message'=>null];
    private $cardModel;

    public function __construct()
    {
        $this->cardModel = Card::class;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request,$id=null)
    {
        // dd($request->all(),$id);
        if($request->ajax()){
            try{
                $this->response['data'] = $this->cardModel::whereBoardId($id)->get();
                $this->response['STATUS_CODE'] = "OK";

            }catch(Exception $e){
                $this->response['ERROR'] = $e->getMessage();
            }
            return response()->json($this->response);
        }
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
        // dd($request->all());
        try{
            $Validator = Validator::make($request->all(),
            [
                'board_id'=>'integer|required',
                'title' => 'string|required|unique:cards,title',
                'description' => 'string|required',
            ]
            );
            
           
            if(!$Validator->fails()){
                if($this->cardModel::create($request->all())){
                    $this->response['STATUS_CODE'] = 'OK';
                    $this->response['message'] = 'Card added successfully';


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
        dd($id);

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
        $Validator = Validator::make($request->all(),
        [
            'id'   => 'integer|required',
            'board_id'=>'integer|required',
            'title' => 'string|required',
            'description' => 'string|required',
        ]
        );
        
       
        try{
            if(!$Validator->fails()){
                if($this->cardModel::where('id',$id)->update($request->all())){
                    $this->response['STATUS_CODE'] = 'OK';
                    $this->response['message'] = 'Card updated successfully';


                }
            }
            else{

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
                if($this->cardModel::where('id',$id)->exists()){
                   
                    if($this->cardModel::destroy($id)){
                        // dd('here');
                         $this->response['STATUS_CODE'] = 'OK';
                         $this->response['message'] = 'Card deleted successfully';
                    }
                }
            }

        }catch(Exception $e){
            $this->response['ERROR'] = $e->getMessage();
        }
        return response()->json($this->response);
    }
}
