<?php

Auth::routes();

Route::redirect('/', '/login');

Route::group(['middleware' => ['auth']], function () {

    Route::get('/dashboard', 'DashboardController@index')->name('dashboard.index');

    Route::group(['middleware' => ['role:admin']], function () {
        Route::resource('users', 'UsersController');
        Route::resource('grade-levels', 'GradeLevelController');
        Route::resource('school-years', 'SchoolYearController');
        Route::resource('subjects', 'SubjectController');
        Route::resource('sections', 'SectionController');
        Route::resource('announcements', 'AnnouncementController');

        Route::get('/school-info', 'DashboardController@schoolInfo')->name('dashboard.schoolInfo');
        Route::post('/school-info', 'DashboardController@schoolInfoStore')->name('dashboard.schoolInfoStore');
    });

    Route::group(['middleware' => ['role:admin|cashier']], function () {
        Route::resource('students', 'StudentController');
        Route::get('/fill-sections', 'EnrolmentController@fillSections')->name('enrolments.fillSection');
        Route::resource('enrolments', 'EnrolmentController');
        Route::resource('transactions', 'TransactionController');
        Route::resource('fees', 'FeeController');
    });    
    Route::group(['middleware' => ['role:admin|teacher']], function () {
        Route::get('grades/create/{section_id}/{subject_id}', 'GradeController@create')->name('grades.type.create');
        Route::get('grades/overall-grade/{section_id}/{subject_id}', 'GradeController@overallGrade')->name('grades.overallGrade');
        Route::post('grades/overall-grade', 'GradeController@overallGradeStore')->name('grades.overallGradeStore');
        Route::resource('grades', 'GradeController');
        Route::get('sms/failed-students/{grading}/{section_id}/{subject_id}', 'SmsController@failedStudents')->name('sms.failedStudents');
        Route::get('/sms', 'SmsController@index')->name('sms.index');
        Route::get('/searchWithGradeLevel', 'SmsController@searchWithGradeLevel')->name('sms.searchWithGradeLevel');
        Route::get('/sendBulk', 'SmsController@sendBulk')->name('sms.sendBulk');
        Route::get('/searchStudent', 'SmsController@searchStudent')->name('sms.searchStudent');
    });
    Route::group(['middleware' => ['role:admin|student|parent']], function () {
        Route::get('individual-grades', 'PortalController@individualGrade')->name('portal.grades');
    });
});
