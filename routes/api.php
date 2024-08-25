<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------xs
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('auth/otpcode/get',[\App\Http\Controllers\AdminPanel\Admin\AdminController::class,'getOtpCode']);
Route::post('auth/otpcode/check',[\App\Http\Controllers\AdminPanel\Admin\AdminController::class,'checkOtpCode']);
Route::post('auth/register',[\App\Http\Controllers\AdminPanel\Admin\AdminController::class,'store']);


Route::middleware('auth:sanctum')->group(function () {

    //Authenticate
    Route::post('auth/logout',[\App\Http\Controllers\AdminPanel\Admin\AdminController::class,'logout']);

    //University
    Route::prefix('university')->group(function (){
        Route::post('store',[\App\Http\Controllers\AdminPanel\University\UniversityController::class,'store']);
        Route::get('list',[\App\Http\Controllers\AdminPanel\University\UniversityController::class,'index']);
        Route::get('{university}/show',[\App\Http\Controllers\AdminPanel\University\UniversityController::class,'show']);
        Route::put('{university}/update',[\App\Http\Controllers\AdminPanel\University\UniversityController::class,'update']);
        Route::post('delete',[\App\Http\Controllers\AdminPanel\University\UniversityController::class,'autoDestroy']);
    });

    //Faculty
    Route::prefix('faculty')->group(function (){
        Route::post('store',[\App\Http\Controllers\AdminPanel\Faculty\FacultyController::class,'store']);
        Route::get('list',[\App\Http\Controllers\AdminPanel\Faculty\FacultyController::class,'index']);
        Route::get('{faculty}/show',[\App\Http\Controllers\AdminPanel\Faculty\FacultyController::class,'show']);
        Route::put('{faculty}/update',[\App\Http\Controllers\AdminPanel\Faculty\FacultyController::class,'update']);
        Route::post('delete',[\App\Http\Controllers\AdminPanel\Faculty\FacultyController::class,'autoDestroy']);
    });

    //ClassRoom
    Route::prefix('class/room')->group(function (){
        Route::post('store',[\App\Http\Controllers\AdminPanel\ClassRoom\ClassRoomController::class,'store']);
        Route::get('list',[\App\Http\Controllers\AdminPanel\ClassRoom\ClassRoomController::class,'index']);
        Route::get('{class_room}/show',[\App\Http\Controllers\AdminPanel\ClassRoom\ClassRoomController::class,'show']);
        Route::put('{class_room}/update',[\App\Http\Controllers\AdminPanel\ClassRoom\ClassRoomController::class,'update']);
        Route::post('delete',[\App\Http\Controllers\AdminPanel\ClassRoom\ClassRoomController::class,'autoDestroy']);
    });

    //ScientificGroup
    Route::prefix('scientific/group')->group(function (){
        Route::post('store',[\App\Http\Controllers\AdminPanel\ScientificGroup\ScientificGroupController::class,'store']);
        Route::get('list',[\App\Http\Controllers\AdminPanel\ScientificGroup\ScientificGroupController::class,'index']);
        Route::get('{scientific_group}/show',[\App\Http\Controllers\AdminPanel\ScientificGroup\ScientificGroupController::class,'show']);
        Route::put('{scientific_group}/update',[\App\Http\Controllers\AdminPanel\ScientificGroup\ScientificGroupController::class,'update']);
        Route::post('delete',[\App\Http\Controllers\AdminPanel\ScientificGroup\ScientificGroupController::class,'autoDestroy']);
    });

    //Course
    Route::prefix('course')->group(function (){
        Route::post('store',[\App\Http\Controllers\AdminPanel\Course\CourseController::class,'store']);
        Route::get('list',[\App\Http\Controllers\AdminPanel\Course\CourseController::class,'index']);
        Route::get('{course}/show',[\App\Http\Controllers\AdminPanel\Course\CourseController::class,'show']);
        Route::put('{course}/update',[\App\Http\Controllers\AdminPanel\Course\CourseController::class,'update']);
        Route::post('delete',[\App\Http\Controllers\AdminPanel\Course\CourseController::class,'autoDestroy']);
    });

    //Lecture
    Route::prefix('lecture')->group(function (){
        Route::post('store',[\App\Http\Controllers\AdminPanel\Lecture\LectureController::class,'store']);
        Route::get('list',[\App\Http\Controllers\AdminPanel\Lecture\LectureController::class,'index']);
        Route::get('{lecture}/show',[\App\Http\Controllers\AdminPanel\Lecture\LectureController::class,'show']);
        Route::put('{lecture}/update',[\App\Http\Controllers\AdminPanel\Lecture\LectureController::class,'update']);
        Route::post('delete',[\App\Http\Controllers\AdminPanel\Lecture\LectureController::class,'autoDestroy']);
    });

    //Semester
    Route::prefix('semester')->group(function (){
        Route::post('store',[\App\Http\Controllers\AdminPanel\Semester\SemesterController::class,'store']);
        Route::get('list',[\App\Http\Controllers\AdminPanel\Semester\SemesterController::class,'index']);
        Route::get('{semester}/show',[\App\Http\Controllers\AdminPanel\Semester\SemesterController::class,'show']);
        Route::put('{semester}/update',[\App\Http\Controllers\AdminPanel\Semester\SemesterController::class,'update']);
        Route::post('delete',[\App\Http\Controllers\AdminPanel\Semester\SemesterController::class,'autoDestroy']);
    });

    //LectureCourse
    Route::prefix('lecture/course')->group(function (){
        Route::post('store',[\App\Http\Controllers\AdminPanel\LectureCourse\LectureCourseController::class,'store']);
        Route::get('list',[\App\Http\Controllers\AdminPanel\LectureCourse\LectureCourseController::class,'index']);
        Route::get('{lecture_course}/show',[\App\Http\Controllers\AdminPanel\LectureCourse\LectureCourseController::class,'show']);
        Route::put('{lecture_course}/update',[\App\Http\Controllers\AdminPanel\LectureCourse\LectureCourseController::class,'update']);
        Route::post('delete',[\App\Http\Controllers\AdminPanel\LectureCourse\LectureCourseController::class,'autoDestroy']);
    });

    //Lecture-Time_Table
    Route::prefix('lecture/time/table')->group(function (){
        Route::post('store',[\App\Http\Controllers\AdminPanel\Lecture_TimeTable\LectureTimeTableController::class,'store']);
//        Route::get('list',[TimeTable\LectureTimeTableController::class,'index']);
//        Route::get('{lecture_time_table}/show',[TimeTable\LectureTimeTableController::class,'show']);
//        Route::put('{lecture_time_table}/update',[TimeTable\LectureTimeTableController::class,'update']);
//        Route::post('delete',[TimeTable\LectureTimeTableController::class,'autoDestroy']);
    });

    Route::prefix('plan')->group(function (){
        Route::get('auto/generate',[\App\Http\Controllers\AdminPanel\Auto_Generate_Plan\AutoGeneratePlanController::class,'autoGeneratePlan']);
//        Route::get('list',[TimeTable\LectureTimeTableController::class,'index']);
//        Route::get('{lecture_time_table}/show',[TimeTable\LectureTimeTableController::class,'show']);
//        Route::put('{lecture_time_table}/update',[TimeTable\LectureTimeTableController::class,'update']);
//        Route::post('delete',[TimeTable\LectureTimeTableController::class,'autoDestroy']);
    });

    //Faculty-Time-Table-Semester
    Route::prefix('faculty/time/table')->group(function (){
        Route::post('semester/{semester}/generate',[\App\Http\Controllers\AdminPanel\Faculty_TimeTable_Semester\FacultyTimeTableSemesterController::class,'generate']);
        Route::get('semester/list',[\App\Http\Controllers\AdminPanel\Faculty_TimeTable_Semester\FacultyTimeTableSemesterController::class,'index']);
        Route::get('{faculty_time_table_semester}/semester/show',[\App\Http\Controllers\AdminPanel\Faculty_TimeTable_Semester\FacultyTimeTableSemesterController::class,'show']);
        Route::put('{faculty_time_table_semester}/semester/update',[\App\Http\Controllers\AdminPanel\Faculty_TimeTable_Semester\FacultyTimeTableSemesterController::class,'update']);
        Route::post('semester/delete',[\App\Http\Controllers\AdminPanel\Faculty_TimeTable_Semester\FacultyTimeTableSemesterController::class,'autoDestroy']);
    });

    //ClassRoom-Time-Table-Semester
    Route::prefix('classroom/time/table')->group(function (){
        Route::post('semester/{semester}/generate',[\App\Http\Controllers\AdminPanel\ClassRoom_TimeTable_Semester\ClassRoomTimeTableSemesterController::class,'generate']);
        Route::get('semester/list',[\App\Http\Controllers\AdminPanel\ClassRoom_TimeTable_Semester\ClassRoomTimeTableSemesterController::class,'index']);
        Route::get('{class_room_time_table_semester}/semester/show',[\App\Http\Controllers\AdminPanel\ClassRoom_TimeTable_Semester\ClassRoomTimeTableSemesterController::class,'show']);
        Route::put('{class_room_time_table_semester}/semester/update',[\App\Http\Controllers\AdminPanel\ClassRoom_TimeTable_Semester\ClassRoomTimeTableSemesterController::class,'update']);
        Route::post('semester/delete',[\App\Http\Controllers\AdminPanel\ClassRoom_TimeTable_Semester\ClassRoomTimeTableSemesterController::class,'autoDestroy']);
    });


});
