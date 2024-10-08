<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\TagTodo;
use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

use function Pest\Laravel\get;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $todos = Todo::latest()->paginate(5);

        return view('todos.index', compact('todos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tags = Tag::all();

        return view('todos.create', compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validate the request
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable',
            'tags' => 'nullable|array',
            // 'tags.*' => 'nullable|boolean',
        ]);

        // $notNullTags = array_filter($request->tags);

        // dd($request->tags, $request->title);

        DB::beginTransaction();

        try {
            $todo = Auth::user()
                ->todos()
                ->create([
                    'title' => $request->title,
                    'description' => $request->description,
                ]);

            foreach ($request->tags as $index => $tagId) {
                TagTodo::create([
                    'todo_id' => $todo->id,
                    'tag_id' => $tagId,
                ]);
            }

            // foreach ($request->answers as $index => $answerText) {
            //     $isCorrect = $request->correct_answer == $index;
            //     $question->answers()->create([
            //         'answer' => $answerText,
            //         'is_correct' => $isCorrect,
            //     ]);
            // }

            // foreach ($request->tags as $index => $todoTag){

            //     $todo->tags()->create([

            //     ])

            // };

            DB::commit();

            notify()->success('Created successfully.');
            return redirect()->route('todos.index');
        } catch (\Exception $e) {
            DB::rollBack();
            $error = ValidationException::withMessages([
                'system_error' => ['System error!' . $e->getMessage()],
            ]);

            throw $error;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Todo $todo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Todo $todo)
    {
        $tags = Tag::all();

        return view('todos.edit', compact(['todo', 'tags']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Todo $todo)
    {
        // validate the request
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable',
        ]);

        // dd($request);

        DB::beginTransaction();

        try {
            $todo->update($validated);

            DB::commit();

            notify()->success('Created successfully.');
            return redirect()->route('todos.index');
        } catch (\Exception $e) {
            DB::rollBack();
            $error = ValidationException::withMessages([
                'system_error' => ['System error!' . $e->getMessage()],
            ]);

            throw $error;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Todo $todo)
    {
        try {
            $todo->delete();
            notify()->success('Deleted successfully.');
            return redirect()->route('todos.index');
        } catch (\Exception $e) {
            DB::rollBack();
            $error = ValidationException::withMessages([
                'system_error' => ['System error!' . $e->getMessage()],
            ]);

            throw $error;
        }
    }
}
