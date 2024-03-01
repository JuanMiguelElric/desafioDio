<?php

namespace App\Services;

use App\Models\Student;
use Exception;
use App\Services\AllService;

class StudentService implements AllService

{
    public function __construct(private Student $student)
    {
    }


    public function findById(string $id): Student|bool
    {
        $estudante = $this->student->find($id);
        if($estudante){
            return $estudante;
        }
        throw new Exception('Estudante não encontrado!', 404);
        return false;
    }

    public function add(array $data): Student|bool
    {
        /**
         * @var Student $student
         */
        $student = new Student(array_merge(['terms' => 0, 'email_verified_at'=> now()], $data));
        
        if(!$student->save()){
            return false;
        }
        return $student;
    }
}
