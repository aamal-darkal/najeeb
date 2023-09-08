<?php

namespace App\Exports;

use App\Models\Student;
use App\Models\Subject;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Database\Eloquent\Model;


class ExportStudents implements FromCollection,WithHeadings , WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */

    private $subject;
    public function __construct(Subject $subject)
    {
        $this->subject = $subject;
    }
    public function collection()
    {
        
        $subject_id = $this->subject->id;
        //bring all student has enrolled to the subject
        $students = Student::wherehas('subjects', function ($q) use ($subject_id) {
            return $q->where('subject_id', $subject_id);
        })->get();

        return  $students;
    }

    public function map($student):array
    {
        $subject_id = $this->subject->id;
        $lectureCount = $this->subject->lectures->count();
        $lectureCount = $lectureCount == 0? 1 :$lectureCount;
        return [
            $student->first_name ,
            $student->last_name,
            $student->lecture = round($student->lectures()->whereHas('subject', function ($q) use ($subject_id) {
                return $q->where('subject_id', $subject_id);
            })->count() * 100 / $lectureCount, 0)  . '%',
            $student->phone,
            $student->parent_phone,
            \Carbon\Carbon::create($student->created_at)->diffForHumans(),
        ];
    }

    public function headings(): array
    {
        return [
            'الاسم الأول',
            'الاسم الثاني',
           'نسبة الحضور',
           'رقم الجوال',
           'رقم الأب',
           'تاريخ انشاء الحساب'
        ];
    }
}
