<?php

use App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Route;

/**
 * Admin Auth
 */
Route::get('/', [Admin\AuthAdminController::class, 'login']);
Route::get('/login', [Admin\AuthAdminController::class, 'login'])->name('auth.login');
Route::post('/login-submit', [Admin\AuthAdminController::class, 'submitLogin'])->name('auth.login-submit');

Route::get('/register', [Admin\AuthAdminController::class, 'register'])->name('auth.register');
Route::get('/register/submit', [Admin\AuthAdminController::class, 'submitRegister'])->name('auth.register-submit');

Route::get('/forgot-password', [Admin\AuthAdminController::class, 'forgotPassword'])->name('auth.forgot-password');
Route::get('/forgot-password/submit', [Admin\AuthAdminController::class, 'submitForgotPassword'])->name('auth.forgot-password-submit');

Route::middleware(['auth'])->group(function () {

     /**
     * Admin Profile
     */
    Route::prefix('/profile')->group(function () {
        Route::get('/personal-information', [Admin\ProfileController::class, 'index'])->name('profile.index');
        Route::post('/personal-information', [Admin\ProfileController::class, 'store'])->name('profile.store');
        Route::get('/security-settings', [Admin\ProfileController::class, 'secuitySettingsIndex'])->name('profile.security-settings.index');
        Route::post('/security-settings', [Admin\ProfileController::class, 'secuitySettingsStore'])->name('profile.security-settings.store');
        Route::post('/change-language', [Admin\ProfileController::class, 'changeLanguage'])->name('profile.change-language');
        Route::post('/change-avatar', [Admin\ProfileController::class, 'changeAvatar'])->name('profile.change-avatar');
    });


    /**
     * Admin Dashboard
     */
    Route::get('/dashboard', [Admin\DashboardAdminController::class, 'index'])->name('dashboard');

    /**
     * Admin Posts
     */
    Route::prefix('/posts')->group(function () {
        Route::get('/', [Admin\PostController::class, 'index'])->name('posts.index');
        Route::get('/create', [Admin\PostController::class, 'form'])->name('posts.create');
        Route::get('/update/{id}', [Admin\PostController::class, 'form'])->name('posts.update');
        Route::post('/store', [Admin\PostController::class, 'form'])->name('posts.store');
        Route::any('/delete/{id}', [Admin\PostController::class, 'delete'])->name('posts.delete');

        Route::prefix('/tags')->group(function () {
            Route::get('/', [Admin\TagController::class, 'index'])->name('posts.tags.index');
            Route::get('/{id}', [Admin\TagController::class, 'show'])->name('posts.tags.show');
            Route::post('/store', [Admin\TagController::class, 'store'])->name('posts.tags.store');
            Route::any('/delete/{id}', [Admin\TagController::class, 'delete'])->name('posts.tags.delete');
            Route::post('/remove-selected', [Admin\TagController::class, 'removeSelected'])->name('posts.tags.remove-selected');
        });

        Route::prefix('/categories')->group(function () {
            Route::get('/', [Admin\CategoryController::class, 'index'])->name('posts.categories.index');
            Route::get('/child/{parent_id}', [Admin\CategoryController::class, 'childIndex'])->name('posts.categories.child-index');
            Route::get('/{id}', [Admin\CategoryController::class, 'show'])->name('categories.show');
            Route::post('/store', [Admin\CategoryController::class, 'store'])->name('categories.store');
            Route::any('/delete/{id}', [Admin\CategoryController::class, 'delete'])->name('categories.delete');
            Route::post('/remove-selected', [Admin\CategoryController::class, 'removeSelected'])->name('categories.remove-selected');
        });
    });

    /**
     * Admin Pages
     */
    Route::prefix('/pages')->group(function () {
        Route::get('/', [Admin\PageController::class, 'index'])->name('pages.index');
        Route::get('/create', [Admin\PageController::class, 'form'])->name('pages.create');
        Route::get('/update/{id}', [Admin\PageController::class, 'form'])->name('pages.update');
        Route::post('/store', [Admin\PageController::class, 'store'])->name('pages.store');
        Route::any('/delete/{id}', [Admin\PageController::class, 'delete'])->name('pages.delete');
    });

    Route::prefix('/medias')->group(function () {
        Route::get('/', [Admin\MediaController::class, 'index'])->name('medias.index');
        Route::get('/{id}', [Admin\MediaController::class, 'show'])->name('medias.show');
        Route::post('/store', [Admin\MediaController::class, 'store'])->name('medias.store');
        Route::any('/delete/{id}', [Admin\MediaController::class, 'delete'])->name('medias.delete');
        Route::post('/remove-selected', [Admin\MediaController::class, 'removeSelected'])->name('medias.remove-selected');
    });

    /**
     * Admin Settings
     */
    Route::prefix('/settings')->group(function () {
        Route::prefix('/bots')->group(function () {
            Route::get('/', [Admin\Settings\BotController::class, 'index'])->name('settings.bots.index');
            Route::get('/child/{parent_id}', [Admin\Settings\BotController::class, 'childIndex'])->name('settings.bots.child-index');
            Route::get('/{id}', [Admin\Settings\BotController::class, 'show'])->name('settings.bots.show');
            Route::post('/store', [Admin\Settings\BotController::class, 'store'])->name('settings.bots.store');
            Route::any('/delete/{id}', [Admin\Settings\BotController::class, 'delete'])->name('settings.bots.delete');
            Route::post('/remove-selected', [Admin\Settings\BotController::class, 'removeSelected'])->name('settings.bots.remove-selected');
        });

        Route::prefix('/bots/{bot}/setting')->group(function () {
            Route::get('/', [Admin\Settings\Bot\BotSettingController::class, 'form'])->name('settings.bots.setting.form');
            Route::post('/store', [Admin\Settings\Bot\BotSettingController::class, 'store'])->name('settings.bots.setting.store');
        });

        Route::prefix('/bots/{bot}/menus')->group(function () {
            Route::get('/', [Admin\Settings\Bot\BotMenuController::class, 'index'])->name('settings.bots.menus.index');
            Route::get('/child/{parent_id}', [Admin\Settings\Bot\BotMenuController::class, 'childIndex'])->name('settings.bots.menus.child-index');
            Route::get('/{id}', [Admin\Settings\Bot\BotMenuController::class, 'show'])->name('settings.bots.menus.show');
            Route::post('/store', [Admin\Settings\Bot\BotMenuController::class, 'store'])->name('settings.bots.menus.store');
            Route::any('/delete/{id}', [Admin\Settings\Bot\BotMenuController::class, 'delete'])->name('settings.bots.menus.delete');
            Route::post('/remove-selected', [Admin\Settings\Bot\BotMenuController::class, 'removeSelected'])->name('settings.bots.menus.remove-selected');
        });

        Route::prefix('/bots/{bot}/states')->group(function () {
            Route::get('/', [Admin\Settings\Bot\BotStateController::class, 'index'])->name('settings.bots.states.index');
            Route::get('/child/{parent_id}', [Admin\Settings\Bot\BotStateController::class, 'childIndex'])->name('settings.bots.states.child-index');
            Route::get('/{id}', [Admin\Settings\Bot\BotStateController::class, 'show'])->name('settings.bots.states.show');
            Route::post('/store', [Admin\Settings\Bot\BotStateController::class, 'store'])->name('settings.bots.states.store');
            Route::any('/delete/{id}', [Admin\Settings\Bot\BotStateController::class, 'delete'])->name('settings.bots.states.delete');
            Route::post('/remove-selected', [Admin\Settings\Bot\BotStateController::class, 'removeSelected'])->name('settings.bots.states.remove-selected');
        });

        Route::prefix('/users')->group(function () {
            Route::get('/', [Admin\Settings\UserController::class, 'index'])->name('settings.users.index');
            Route::get('/{id}', [Admin\Settings\UserController::class, 'show'])->name('settings.users.show');
            Route::post('/store', [Admin\Settings\UserController::class, 'store'])->name('settings.users.store');
            Route::any('/delete/{id}', [Admin\Settings\UserController::class, 'delete'])->name('settings.users.delete');
            Route::post('/remove-selected', [Admin\Settings\UserController::class, 'removeSelected'])->name('settings.users.remove-selected');
        });
    });
});
