<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentRequest;
use App\Models\Student;
use App\Services\StudentService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;

class StudentController extends Controller
{
    public function __construct(
        private readonly StudentService $studentService
    )
    {
    }

    public function index(): \Inertia\Response
    {
        return Inertia::render('Students/Index', [
            'studentsData' => $this->studentService->get(),
        ]);
    }

    public function store(StudentRequest $request): RedirectResponse
    {
        $this->studentService->create($request->all());

        return to_route('students.index');

    }

    public function destroy(Request $request, $student_id): RedirectResponse
    {

        $this->studentService->delete($student_id);

        $totalStudents = Student::query()->count();
        $perPage = config('app.pagination.perPage');
        $lastPage = ceil($totalStudents / $perPage);

        return to_route('students.index', ['page' => $lastPage]);
    }
}
