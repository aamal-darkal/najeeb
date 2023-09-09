<?php

namespace App\Exports;

use App\Models\Student;
use App\Models\Subject;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ExportStudents implements FromQuery,WithHeadings , WithMapping , ShouldAutoSize, WithStyles
{
    /**
     * @return \Illuminate\Support\Collection
     */
    use Exportable;
    private $subject;
    public function __construct(Subject $subject)
    {
        $this->subject = $subject;
    }

    public function query()
    {
        
        $subject_id = $this->subject->id;
        //bring all student has enrolled to the subject
        $students = Student::wherehas('subjects', function ($q) use ($subject_id) {
            return $q->where('subject_id', $subject_id);
        });
    // })->get();

        return  $students;
    }

    public function map($studentRec):array
    {
        $subject_id = $this->subject->id;
        $lectureCount = $this->subject->lectures->count();
        $lectureCount = $lectureCount == 0? 1 :$lectureCount;
        return [
            $studentRec->first_name ,
            $studentRec->last_name,
            $studentRec->lecture = round($studentRec->lectures()->whereHas('subject', function ($q) use ($subject_id) {
                return $q->where('subject_id', $subject_id);
            })->count() * 100 / $lectureCount, 0)  . '%',
            $studentRec->phone,
            $studentRec->parent_phone,
            \Carbon\Carbon::create($studentRec->created_at)->diffForHumans(),
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

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true]],
        ];
    }
}
