<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductFormRequest;
use App\Models\Answer;
use App\Models\Category;
use App\Models\Product;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductControllerResource extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        if(auth()->user()->type === 'admin'){
            return view('admin.products.index',['products'=>$products]);
        }
        else
        {
            return view('products.index',['products'=>$products]);

        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('products.create',['categories'=>$categories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function getQuestions($categoryId)
    {
        // Retrieve questions based on the selected category
        $questions = Question::where('category_id', $categoryId)->get();
        return response()->json($questions);
    }

    public function store(ProductFormRequest $request)
    {
        DB::beginTransaction();

        $product = Product::create($request->only('category_id', 'name', 'description', 'price'));

        foreach ($request->input('answers') as $answerData) {
            $product->answer()->create([
                'question_id' => $answerData['question_id'],
                'answer' => $answerData['answer'],
            ]);
        }
        DB::commit();

        return redirect()->to('/products')->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $product->load(['questions.answer']);
        return view('admin.products.show', compact('product'));
    }
    public function showQuestions(Product $product)
    {
        $questions = $product->questions()->withPivot('answer')->get();
        return response()->json(['questions' => $questions]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
