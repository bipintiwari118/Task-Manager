<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function create(){
        $users=User::all();
        return view('admin.task.add',compact('users'));
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'nullable|string|in:to_do,in_progress,completed',
            'priority' => 'nullable|string|in:low,medium,high',
            'assigned_to' => 'nullable|exists:users,id',
            'assigned_date' => 'nullable|date',
            'completed_date' => 'nullable|date|after_or_equal:assigned_date',
        ]);

        $imagePaths = [];
        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $image) {
                $path = $image->store('tasks/images', 'public');
                $imagePaths[] = $path;
            }
        }

        $task = Task::create([
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            // 'image' => json_encode($imagePaths),
            'status' => $validated['status'] ?? 'pending',
            'priority' => $validated['priority'] ?? null,
            'created_by' => Auth::id(),
            'assigned_to' => $validated['assigned_to'] ?? null,
            'assigned_date' => $validated['assigned_date'] ?? null,
            'completed_date' => $validated['completed_date'] ?? null,
        ]);

        return redirect()->route('task.list')->with('success', 'Task created successfully!');
    }

    public function list(Request $request){

         $tasks = Task::query();
                        if ($request->filled('title')) {
                            $tasks->where('title', 'like', '%' . $request->title . '%');
                        }

                        if ($request->filled('date')) {
                            $tasks->where('assigned_date', $request->date)
                                 ->orWhere('completed_date',$request->date);
                        }

                        if ($request->filled('status')) {
                            $tasks->where('status', $request->status);
                        }


        $tasks = $tasks->with('creator', 'assigne')
                ->orderByRaw("FIELD(priority, 'high', 'medium', 'low')")
                ->orderBy('position')
                ->paginate(10);
        return view('admin.task.list',compact('tasks'));
    }



    public function edit($slug){
        $task=Task::where('slug',$slug)->first();
        $users=User::all();

        return view('admin.task.edit',compact('task','users'));
    }


    public function update(Request $request , $slug)
    {
        $validated = $request->validate([
                    'title' => 'required|string|max:255',
                    'description' => 'nullable|string',
                    'image.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                    'status' => 'nullable|string|in:to_do,in_progress,completed',
                    'priority' => 'nullable|string|in:low,medium,high',
                    'assigned_to' => 'nullable|exists:users,id',
                    'assigned_date' => 'nullable|date',
                    'completed_date' => 'nullable|date|after_or_equal:assigned_date',
                ]);


       $task=Task::where('slug',$slug)->first();

       $task->update([

            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            // 'image' => json_encode($imagePaths),
            'status' => $validated['status'] ?? 'pending',
            'priority' => $validated['priority'] ?? null,
            'created_by' => Auth::id(),
            'assigned_to' => $validated['assigned_to'] ?? null,
            'assigned_date' => $validated['assigned_date'] ?? null,
            'completed_date' => $validated['completed_date'] ?? null,

       ]);


        return redirect()->route('task.list')->with('success', 'Task Updated successfully!');


    }


    public function delete($slug){
        $task=Task::where('slug',$slug)->first();
        $task->delete();
         return redirect()->route('task.list')->with('success', 'Task Deleted successfully!');
    }


    public function view($slug){
         $task=Task::where('slug',$slug)->first();
         return view('admin.task.view',compact('task'));
    }


       public function reorder(Request $request)


        {
            $order = $request->input('order');
                foreach ($order as $item) {
                     Task::where('id', $item['id'])->update(['position' => $item['position']]);
                    }
            return response()->json(['status' => 'success']);
        }

}
