<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\User;
use App\Models\Status;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function create(){
        $users=User::all();
        $statuses = Status::all();

        return view('admin.task.add',compact('users',"statuses"));
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status_id' => 'required|exists:statuses,id',
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
            'status_id' => $validated['status_id'],
            'priority' => $validated['priority'] ?? null,
            'created_by' => Auth::id(),
            'assigned_to' => $validated['assigned_to'] ?? null,
            'assigned_date' => $validated['assigned_date'] ?? null,
            'completed_date' => $validated['completed_date'] ?? null,
        ]);

        return redirect()->route('task.list')->with('success', 'Task created successfully!');
    }

    public function list(Request $request){

        // $statuses=Status::all();

        //  $tasks = Task::query();
        //                 if ($request->filled('title')) {
        //                     $tasks->where('title', 'like', '%' . $request->title . '%');
        //                 }

        //                 if ($request->filled('date')) {
        //                     $tasks->where('assigned_date', $request->date)
        //                          ->orWhere('completed_date',$request->date);
        //                 }

        //                 if ($request->filled('status')) {
        //                     $tasks->where('status_id', $request->status);
        //                 }


        // $tasks = $tasks->with('creator', 'assigne','status')
        //         ->orderByRaw("FIELD(priority, 'high', 'medium', 'low')")
        //         ->orderBy('position')
        //         ->paginate(10);
        // return view('admin.task.list',compact('tasks','statuses'));

           $statuses = Status::with(['tasks' => function ($query) use ($request) {
        // Apply filters
        if ($request->filled('title')) {
            $query->where('title', 'like', '%' . $request->title . '%');
        }

        if ($request->filled('date')) {
            $query->where(function ($q) use ($request) {
                $q->where('assigned_date', $request->date)
                  ->orWhere('completed_date', $request->date);
            });
        }

        if ($request->filled('status')) {
            // This filter is redundant here since tasks belong to the status,
            // but you can add it if needed (or skip it)
            $query->where('status_id', $request->status);
        }

        // Order tasks by priority and maybe position
        $query->orderByRaw("FIELD(priority, 'high', 'medium', 'low')")
              ->orderBy('position')
              ->orderBy('created_at');
    }])->get();
    return view('admin.task.list', compact('statuses'));

    }



    public function edit($slug){
        $task=Task::where('slug',$slug)->first();
        $statuses=Status::all();
        $users=User::all();

        return view('admin.task.edit',compact('task','users','statuses'));
    }


    public function update(Request $request , $slug)
    {
        $validated = $request->validate([
                    'title' => 'required|string|max:255',
                    'description' => 'nullable|string',
                    'image.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                    'status_id' => 'required|exists:statuses,id',
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
            'status_id' => $validated['status_id'],
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


        public function updateStatus(Request $request)
            {
                $request->validate([
                    'task_id' => 'required|exists:tasks,id',
                    'status_id' => 'required|exists:statuses,id',
                ]);

                $task = Task::findOrFail($request->task_id);
                $task->status_id = $request->status_id;
                $task->save();

                return response()->json(['success' => true]);
            }

}
