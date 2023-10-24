<?php

namespace App\Http\Controllers\API\V1;

use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// use App\Http\Requests\StoreStudentRequest;
// use App\Http\Requests\UpdateStudentRequest;
use App\Http\Resources\V1\StudentResource;
use App\Http\Resources\V1\StudentCollection;
use App\Filters\V1\StudentFilter;
use App\Http\Requests\V1\StoreStudentRequest;
use App\Http\Requests\V1\UpdateStudentRequest;
use App\Http\Requests\V1\BulkStoreStudentRequest;
use Illuminate\Support\Arr;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter = new StudentFilter();
        $filterItems = $filter->transform($request);
        
        $includeCourses = $request->query('includeCourses');

        $students = Student::where($filterItems);
        
        if($includeCourses){
            $students = $students->with('courses');
        }
        
        return new StudentCollection($students->paginate()->appends($request->query()));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStudentRequest $request)
    {
        return new StudentResource(Student::create($request->all()));
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        $includeCourses = request()->query('includeCourses');

        if($includeCourses){
            return new StudentResource($student->loadMissing('courses'));
        }

        return new StudentResource($student);
    }

    public function bulkStore(BulkStoreStudentRequest $request){
        $bulk = collect($request->all())->map(function($arr, $key){
            return Arr::except($arr,['postalCode']);
        });

        Student::insert($bulk->toArray());
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStudentRequest $request, Student $student)
    {
        $student->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        //
    }
}
