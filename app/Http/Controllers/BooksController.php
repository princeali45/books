<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Books;
use App\Traits\ApiResponser;

class BooksController extends Controller
{

    use ApiResponser;
    private $request;

    public function __construct(Request $request){
        $this->request = $request;
    }

    public function getBooks(){
        $books = Books::all();
        return response()->json($books, 200);
    }
    
    public function index()
    {
        $books = Books::all();
        return $this->successResponse($books);
    }

    public function add(Request $request ){
        $rules = [
        'id' => 'required|not_in:0|min:1',
        'bookname' => 'required|max:150',
        'yearpublish' => 'required|not_in:0|min:1',
        'authorid' => 'required|numeric|min:1|not_in:0',
        ];  
        $this->validate($request,$rules);
        // uncomment last
        // $booksjob = bookJob::findOrFail($request->jobid);
        $book = Books::create($request->all());
        return $this->successResponse($book, Response::HTTP_CREATED);
    }

    public function show($id)
    {
        $book = Books::findOrFail($id);
        // $book = Books::where('id', $id)->findOrFail();    
        return $this->successResponse($book);    
        // return $this->errorResponse('Books ID is not found', Response::HTTP_NOT_FOUND); 
    }

    public function update(Request $request,$id)
    {
        $rules = [
            'id' => 'required|not_in:0|min:1',
            'bookname' => 'required',
            'yearpublish' => 'required|not_in:0|min:1',
            'authorid' => 'required|numeric|min:1|not_in:0',
        ];  

        $this->validate($request, $rules);
        $book = Books::findOrFail($id);  
        // $book = Books::where('id', $id)->firstOrFail(); 
        $book->fill($request->all());
        if ($book->isClean()) {
            return $this->errorResponse('At least one value must change', Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $book->save();
        return $this->successResponse($book);

    }

    public function delete($id)
    {
        $book = Books::findOrFail($id);
        $book->delete();
        return $this->successResponse($book);
        
    }
    
}
