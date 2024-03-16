<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentRequest;
use App\Models\Student;
use App\Services\StudentService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class StudentController extends Controller
{
    public function __construct(
        private readonly StudentService $studentService
    ) {
    }

    public function index()
    {
        return Inertia::render('Students/Index',[
            'studentsData' => Student::orderByDesc('created_at')->paginate(5)
        ]);
    }

    public function store(StudentRequest $request)
    {
        Student::create($request->validated());

        return to_route('students.index');

    }

    public function destroy(Request $request, $student_id)
    {

        $this->studentService->delete($student_id);

        $totalStudents = Student::count();
        $perPage = 5;
        $lastPage =  ceil($totalStudents / $perPage);

        return to_route('students.index',['page' => $lastPage]);
    }
}
