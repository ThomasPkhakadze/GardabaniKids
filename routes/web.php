<?php

Route::redirect('/admin', '/login');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Auth::routes();

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Crm Status
    Route::delete('crm-statuses/destroy', 'CrmStatusController@massDestroy')->name('crm-statuses.massDestroy');
    Route::resource('crm-statuses', 'CrmStatusController');

    // Crm Customer
    Route::delete('crm-customers/destroy', 'CrmCustomerController@massDestroy')->name('crm-customers.massDestroy');
    Route::resource('crm-customers', 'CrmCustomerController');

    // Crm Note
    Route::delete('crm-notes/destroy', 'CrmNoteController@massDestroy')->name('crm-notes.massDestroy');
    Route::resource('crm-notes', 'CrmNoteController');

    // Crm Document
    Route::delete('crm-documents/destroy', 'CrmDocumentController@massDestroy')->name('crm-documents.massDestroy');
    Route::post('crm-documents/media', 'CrmDocumentController@storeMedia')->name('crm-documents.storeMedia');
    Route::post('crm-documents/ckmedia', 'CrmDocumentController@storeCKEditorImages')->name('crm-documents.storeCKEditorImages');
    Route::resource('crm-documents', 'CrmDocumentController');

    // Kindergarden Branch
    Route::delete('kindergarden-branches/destroy', 'KindergardenBranchController@massDestroy')->name('kindergarden-branches.massDestroy');
    Route::resource('kindergarden-branches', 'KindergardenBranchController');

    // Kindergarden Group
    Route::delete('kindergarden-groups/destroy', 'KindergardenGroupController@massDestroy')->name('kindergarden-groups.massDestroy');
    Route::resource('kindergarden-groups', 'KindergardenGroupController');

    // Kid
    Route::delete('kids/destroy', 'KidController@massDestroy')->name('kids.massDestroy');
    Route::resource('kids', 'KidController');

    // Parent Guardian
    Route::delete('parent-guardians/destroy', 'ParentGuardianController@massDestroy')->name('parent-guardians.massDestroy');
    Route::resource('parent-guardians', 'ParentGuardianController');
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
    }
});
Route::middleware(['web'])->group(function () {
    Route::get('/', function () {
        return view('front.layouts.main');
    });
    Route::get('/home', function(){
        return view('front.home');
    });
    Route::get('/register', function(){
        return view('front.pages.register');
    });
    Route::get('/about', function(){
        return view('front.pages.about');
    });
    Route::get('/check-if-registered', function(){
        return view('front.pages.checkIfResgistered');
    });
    Route::post('/register', 'Front\RegisterController@register')->name('register');
    Route::post('/getBranches', 'Front\RegisterController@getBranches')->name('getBranches');
    Route::post('/getBranchGroups', 'Front\RegisterController@getBranchGroups')->name('getBranchGroups');
    Route::post('/checking-if-registered', 'Front\RegisterController@checkIfRegistered')->name('checkIfRegistered');
    Route::post('/get-branches', 'Front\RegisterController@retrieveBranchesWithGroups')->name('retrieveBranchesWithGroups');

});