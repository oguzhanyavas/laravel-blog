<?php
/*
|--------------------------------------------------------------------------
| Backend Route
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('site-bakimda', function () {
    return view('front.offline');
});

Route::prefix('admin')->name('admin.')->middleware('isLogin')->group(function () {
    Route::get('giris', 'Back\AuthController@login')->name('login');
    Route::post('giris', 'Back\AuthController@loginPost')->name('login.post');
});

Route::prefix('admin')->name('admin.')->middleware('isAdmin')->group(function () {
    Route::get('panel', 'Back\Dashboard@index')->name('dashboard');
    //Makale route
    Route::get('makaleler/silinenler', 'Back\ArticleController@trashed')->name('trashed.article');
    Route::resource('makaleler', 'Back\ArticleController');
    Route::get('switch', 'Back\ArticleController@switch')->name('switch');
    Route::get('makaleler/delete/{id}', 'Back\ArticleController@delete')->name('makaleler.delete');
    Route::get('makaleler/forcedelete/{id}', 'Back\ArticleController@forcedelete')->name('makaleler.forcedelete');
    Route::get('makaleler/recover/{id}', 'Back\ArticleController@recover')->name('makaleler.recover');
    //Kategori route
    Route::get('kategoriler', 'Back\CategoryController@index')->name('category.index');
    Route::get('categoryswitch', 'Back\CategoryController@switch')->name('category.switch');
    Route::post('kategori/create', 'Back\CategoryController@create')->name('category.create');
    Route::post('kategori/update', 'Back\CategoryController@update')->name('category.update');
    Route::get('kategori/getData', 'Back\CategoryController@getData')->name('category.getData');
    Route::post('kategori/delete', 'Back\CategoryController@delete')->name('category.delete');
    //Sayfalar route
    Route::get('sayfalar', 'Back\PageController@index')->name('page.index');
    Route::get('sayfalar/orders', 'Back\PageController@orders')->name('page.orders');
    Route::get('sayfalar/create', 'Back\PageController@create')->name('page.create');
    Route::post('sayfalar/create', 'Back\PageController@post')->name('page.post');
    Route::get('sayfalar/update/{id}', 'Back\PageController@update')->name('page.update');
    Route::post('sayfalar/update/{id}', 'Back\PageController@updatePost')->name('page.updatePost');
    Route::get('sayfalar/delete/{id}', 'Back\PageController@delete')->name('page.delete');
    Route::get('pageswitch', 'Back\PageController@switch')->name('page.switch');
    //config route
    Route::get('ayarlar', 'Back\ConfigController@index')->name('config.index');
    Route::post('ayarlar/update', 'Back\ConfigController@update')->name('config.update');
    //Messages Route
    Route::get('inbox/sentedAll', 'Back\InboxController@sentedAll')->name('inbox.sentedAll');
    Route::get('inbox/trashed', 'Back\InboxController@trashed')->name('inbox.trashed');
    Route::get('inbox/write', 'Back\InboxController@write')->name('inbox.write');
    Route::post('inbox/write', 'Back\InboxController@writePost')->name('inbox.writePost');
    Route::get('inbox/sendershow/{id}', 'Back\InboxController@sendershow')->name('inbox.sendershow');
    Route::post('inbox/reply/{id}', 'Back\InboxController@reply')->name('inbox.reply');
    Route::post('inbox/replyMulti', 'Back\InboxController@replyMulti')->name('replyMulti');
    Route::post('inbox/unreadMulti', 'Back\InboxController@unreadMulti')->name('unreadMulti');
    Route::post('inbox/readedMulti', 'Back\InboxController@readedMulti')->name('readedMulti');
    Route::post('inbox/trashMulti', 'Back\InboxController@trashMulti')->name('trashMulti');
    Route::post('inbox/refreshMulti', 'Back\InboxController@refreshMulti')->name('refreshMulti');
    Route::resource('inbox', 'Back\InboxController');


    Route::get('cikis', 'Back\AuthController@logout')->name('logout');
});


/*
|--------------------------------------------------------------------------
| Front Route
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route Users
    Route::post('users/giris', 'Front\Users\AuthController@loginPost')->name('users.login.post');
Route::prefix('users')->name('users.')->middleware('isUser')->group(function () {
    Route::get('cikis', 'Front\Users\AuthController@logout')->name('logout');
    Route::get('panel', 'Front\Users\Dashboard@index')->name('index');
    Route::post('panel', 'Front\Users\Dashboard@settingsUpdate')->name('settings.update');
});


Route::get('/', 'Front\Homepage@index')->name('homepage');
Route::get('/iletisim', 'Front\Homepage@contact')->name('contact');
Route::post('/iletisim', 'Front\Homepage@contactpost')->name('contact.post');;
Route::get('/{sayfa}', 'Front\Homepage@page')->name('page');
Route::get('/kategori/{category}', 'Front\Homepage@category')->name('category');
Route::get('/{category}/{slug}', 'Front\Homepage@single')->name('single');
