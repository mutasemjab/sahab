<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class QuestionController extends Controller
{
     public function index()
    {
        $questions = DB::table('questions')->orderBy('created_at', 'desc')->get();
        return view('admin.questions.index', compact('questions'));
    }

    public function create()
    {
        return view('admin.questions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'question_en' => 'required|string|max:255',
            'question_ar' => 'required|string|max:255',
            'answer_en' => 'required|string',
            'answer_ar' => 'required|string',
        ]);

        DB::table('questions')->insert([
            'question_en' => $request->question_en,
            'question_ar' => $request->question_ar,
            'answer_en' => $request->answer_en,
            'answer_ar' => $request->answer_ar,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('questions.index')->with('success', __('messages.question_created'));
    }

    public function edit($id)
    {
        $question = DB::table('questions')->where('id', $id)->first();
        if (!$question) {
            return redirect()->route('questions.index')->with('error', __('messages.question_not_found'));
        }
        return view('admin.questions.edit', compact('question'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'question_en' => 'required|string|max:255',
            'question_ar' => 'required|string|max:255',
            'answer_en' => 'required|string',
            'answer_ar' => 'required|string',
        ]);

        DB::table('questions')->where('id', $id)->update([
            'question_en' => $request->question_en,
            'question_ar' => $request->question_ar,
            'answer_en' => $request->answer_en,
            'answer_ar' => $request->answer_ar,
            'updated_at' => now(),
        ]);

        return redirect()->route('questions.index')->with('success', __('messages.question_updated'));
    }

    public function destroy($id)
    {
        DB::table('questions')->where('id', $id)->delete();
        return redirect()->route('questions.index')->with('success', __('messages.question_deleted'));
    }
}