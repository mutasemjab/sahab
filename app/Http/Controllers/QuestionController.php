<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuestionController extends Controller
{
    public function index(Request $request)
    {
        $query = Question::query();
        
        // Search functionality
        if ($request->has('search') && !empty($request->search)) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('question_ar', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('question_en', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('answer_ar', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('answer_en', 'LIKE', "%{$searchTerm}%");
            });
        }
        
        $questions = $query->orderBy('created_at', 'desc')->get();
        
        // If it's an AJAX request, return JSON
        if ($request->ajax()) {
            return response()->json([
                'questions' => $questions->map(function($question) {
                    return [
                        'id' => $question->id,
                        'question' => $question->question,
                        'answer' => $question->answer
                    ];
                })
            ]);
        }
        
        return view('user.questions', compact('questions'));
    }
    
     public function search(Request $request)
    {
        $searchTerm = $request->get('q');
        
        if (empty($searchTerm)) {
            $questions = Question::all();
        } else {
            $questions = Question::where(function($query) use ($searchTerm) {
                $query->where('question_ar', 'LIKE', "%{$searchTerm}%")
                      ->orWhere('question_en', 'LIKE', "%{$searchTerm}%")
                      ->orWhere('answer_ar', 'LIKE', "%{$searchTerm}%")
                      ->orWhere('answer_en', 'LIKE', "%{$searchTerm}%");
            })->get();
        }
        
        return response()->json([
            'questions' => $questions->map(function($question) {
                return [
                    'id' => $question->id,
                    'question' => $question->question,
                    'answer' => $question->answer
                ];
            })
        ]);
    }
   
}