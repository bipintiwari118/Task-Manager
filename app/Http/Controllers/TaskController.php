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
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status_id' => 'required|exists:statuses,id',
            'priority' => 'nullable|string|in:low,medium,high',
            'assigned_to' => 'nullable|array',
            'assigned_to.*' => 'exists:users,id',
            'assigned_date' => 'nullable|date',
            'completed_date' => 'nullable|date|after_or_equal:assigned_date',
        ]);

        $task = Task::create([
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'status_id' => $validated['status_id'],
            'priority' => $validated['priority'] ?? null,
            'created_by' => Auth::id(),
            'assigned_date' => $validated['assigned_date'] ?? null,
            'completed_date' => $validated['completed_date'] ?? null,
        ]);


         if ($request->hasFile('images')) {

        $featuredImage = $request->file('images');
        $featuredImageName = time().'.'.$featuredImage->extension();
        $featuredImage->move(public_path('images/featured_image/'),$featuredImageName);
        $featuredImagePath = 'images/featured_image/' . $featuredImageName;

        $task->images=$featuredImagePath;


         }

         // Attach assigned users

         if($request->assigned_to){
        $task->assignedUsers()->attach($validated['assigned_to']);}

        return redirect()->route('task.list')->with('success', 'Task created successfully!');
    }

    public function list(Request $request){

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
        $assignedUsers = $task->assignedUsers->pluck('id')->toArray();

        return view('admin.task.edit',compact('task','users','statuses','assignedUsers'));
    }


    public function update(Request $request , $slug)
    {
        $validated = $request->validate([
                    'title' => 'required|string|max:255',
                    'description' => 'nullable|string',
                    'image.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                    'status_id' => 'required|exists:statuses,id',
                    'priority' => 'nullable|string|in:low,medium,high',
                    'assigned_to' => 'nullable|array',
                    'assigned_to.*' => 'exists:users,id',
                    'assigned_date' => 'nullable|date',
                    'completed_date' => 'nullable|date|after_or_equal:assigned_date',
                ]);




       $task=Task::where('slug',$slug)->first();

         if ($request->hasFile('images')) {

       $featuredImage = $request->file('images');
        $featuredImageName = time().'.'.$featuredImage->extension();
        $featuredImage->move(public_path('images/featured_image/'),$featuredImageName);
        $featuredImagePath = 'images/featured_image/' . $featuredImageName;
         }else{
            $featuredImagePath = $task->images;
         }

       $task->update([

            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'images' => $featuredImagePath ?? null,
            'status_id' => $validated['status_id'],
            'priority' => $validated['priority'] ?? null,
            'created_by' => Auth::id(),
            'assigned_date' => $validated['assigned_date'] ?? null,
            'completed_date' => $validated['completed_date'] ?? null,

       ]);

       if($request->assigned_to){
         $task->assignedUsers()->sync($validated['assigned_to']);
       }



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
