<?php

namespace App\Filters\V1;

use Illuminate\Http\Request;
use App\Filters\ApiFilter;

class CourseFilter extends ApiFilter {
    protected $safeParms = [
        'studentId' => ['eq'],
        'name'=> ['eq'],
        'status' => ['eq','ne'],
        'start_date' => ['eq','gt','lt','gte','lte'],
        'end_date' => ['eq','gt','lt','gte','lte']
    ];

    protected $columnMap = [
        'studentId' => 'student_id',
        'startDate' => 'start_date',
        'EndDate' => 'end_date'
    ];

    protected $operatorMap = [
        'eq' => '=',
        'lt' => '<',
        'lte'=> '<=',
        'gt' => '>',
        'gte'=> '>=',
        'ne'=> "!="
    ];

}