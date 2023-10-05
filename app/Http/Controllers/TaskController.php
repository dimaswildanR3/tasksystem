<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TaskModel; 
use App\Models\CategoryTask; 

class TaskController extends Controller
{
    public function awal(){
            
        return view('welcome');
    }
    public function index()
    {
         $categories = CategoryTask::with('tasks') // Ambil data tugas yang terkait dengan setiap kategori
            ->get();
        $tasks = TaskModel::where('completed', false)
            ->orderBy('category_id', 'desc')
            ->orderBy('due_date')
            ->get();
        return view('tasks.index', compact('tasks', 'categories'));
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable|max:255',
            'category_id' => 'required|max:255',
            'due_date' => 'nullable|max:255',
        ]);

        TaskModel::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'category_id' => $request->input('category_id'),
            'due_date' => $request->input('due_date'),
        ]);

        return redirect()->route('tasks.index')->with('success', 'Task Created Successfully');
    }
       public function edit(TaskModel $task)
    {
        return view('tasks.edit', compact('task'));
    }
    public function update(Request $request, TaskModel $task)
{
    $request->validate([
        'title' => 'required|max:255',
        'description' => 'nullable|max:255',
        'category_id' => 'required|in:low,medium,high',
        'due_date' => 'nullable|max:255',
    ]);

    // Dapatkan objek TaskModel yang ingin diupdate
    // Berdasarkan parameter route yang diambil dari URL
    // (misalnya, /tasks/8, di mana 8 adalah ID)
    $task = TaskModel::find($task->id);

    // Perbarui atribut-atribut model dengan data baru
    $task->title = $request->input('title');
    $task->description = $request->input('description');
    $task->category_id = $request->input('category_id');
    $task->due_date = $request->input('due_date');

    // Simpan perubahan ke dalam database
    $task->save();

    return redirect()->route('tasks.index')->with('success', 'Task Updated Successfully');
}

    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('tasks.index')->with('sukses', 'Task Deleted Successfully');
    }
    public function complete(TaskModel $task)
{
    $task->update([
        'completed' => true,
        'completed_at' => now(),
    ]);

    return redirect()->route('tasks.index')->with('success', 'Task completed Successfully');
}
    public function showComplete(TaskModel $task)
{
    $completedTasks = TaskModel::where('completed', true)->orderBy('completed_at','desc')->get();
    return view('tasks.taskshow', compact('completedTasks'));

}


}
