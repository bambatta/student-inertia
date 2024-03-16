<?php

namespace App\Services;

use App\Models\Student;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class StudentService
{
    public function create(array $attributes): Builder|Model
    {
        return Student::query()->create($attributes);
    }
    public function get(): Collection
    {
        return Student::all();
    }
    public function delete(int $student_id): mixed
    {
        return Student::query()->where('id', $student_id)->delete();
    }
}
