<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DoctorDashboardController;
use App\Http\Controllers\PatientDashboardController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ArticleLikeController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\AppointmentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Lightweight health endpoint for platform checks (no DB access)
Route::get('/health', function () {
    return response()->json(['status' => 'ok']);
});

// Role-based Dashboard Redirector
Route::get('/dashboard', function () {
    $user = auth()->user();

    if ($user->role === 'admin') {
        return redirect()->route('admin.dashboard');
    } elseif ($user->role === 'doctor') {
        return redirect()->route('doctor.dashboard');
    } elseif ($user->role === 'patient') {
        return redirect()->route('patient.dashboard');
    }

    return redirect('/');
})->middleware('auth')->name('dashboard');

// Admin Dashboard & Reports Routes
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    Route::prefix('reports')->group(function () {
        Route::get('/sales', [ReportController::class, 'sales'])->name('reports.sales');
        Route::get('/users', [ReportController::class, 'users'])->name('reports.users');
    });
});

// Doctor Dashboard Routes
Route::middleware(['auth', 'role:doctor'])->prefix('doctor')->group(function () {
    Route::get('/dashboard', [DoctorDashboardController::class, 'index'])->name('doctor.dashboard');

    // Prescription Routes (Doctor)
    Route::get('/prescriptions', [\App\Http\Controllers\PrescriptionController::class, 'doctorIndex'])->name('doctor.prescriptions.index');
    Route::get('/appointments/{appointment}/prescription/create', [\App\Http\Controllers\PrescriptionController::class, 'create'])->name('doctor.prescriptions.create');
    Route::post('/appointments/{appointment}/prescription', [\App\Http\Controllers\PrescriptionController::class, 'store'])->name('doctor.prescriptions.store');
    Route::get('/prescriptions/{prescription}/edit', [\App\Http\Controllers\PrescriptionController::class, 'edit'])->name('doctor.prescriptions.edit');
    Route::put('/prescriptions/{prescription}', [\App\Http\Controllers\PrescriptionController::class, 'update'])->name('doctor.prescriptions.update');
    Route::get('/prescriptions/{prescription}', [\App\Http\Controllers\PrescriptionController::class, 'show'])->name('doctor.prescriptions.show');

    // Appointment Routes (Doctor)
    Route::get('/appointments', [DoctorDashboardController::class, 'appointments'])->name('doctor.appointments.index');
    Route::get('/appointments/create', [DoctorDashboardController::class, 'createAppointment'])->name('doctor.appointments.create');
    Route::post('/appointments', [DoctorDashboardController::class, 'storeAppointment'])->name('doctor.appointments.store');
    Route::get('/appointments/{appointment}', [DoctorDashboardController::class, 'showAppointment'])->name('doctor.appointments.show');
    Route::post('/appointments/{appointment}/confirm', [DoctorDashboardController::class, 'confirmAppointment'])->name('doctor.appointments.confirm');
    Route::post('/appointments/{appointment}/cancel', [DoctorDashboardController::class, 'cancelAppointment'])->name('doctor.appointments.cancel');

    // Patient Records & Schedule Routes (Doctor)
    Route::get('/patients', [DoctorDashboardController::class, 'patients'])->name('doctor.patients');
    Route::get('/schedule', [DoctorDashboardController::class, 'schedule'])->name('doctor.schedule');

    // Chat Routes (Doctor)
    Route::get('/messages', [\App\Http\Controllers\ChatController::class, 'index'])->name('doctor.chat.index');
    Route::get('/messages/{conversation}', [\App\Http\Controllers\ChatController::class, 'show'])->name('doctor.chat.show');
    Route::post('/messages/{conversation}/send', [\App\Http\Controllers\ChatController::class, 'sendMessage'])->name('doctor.chat.send');
});

// Patient Dashboard Routes
Route::middleware(['auth', 'role:patient'])->group(function () {
    Route::get('/patient/dashboard', [PatientDashboardController::class, 'index'])->name('patient.dashboard');

    // AI Health Assistant
    Route::post('/health/ai/chat', [\App\Http\Controllers\HealthAIController::class, 'chat'])->name('health.ai.chat');
    Route::get('/health/ai/chats', [\App\Http\Controllers\HealthAIController::class, 'chats'])->name('health.ai.chats');
    Route::get('/health/ai/chats/{chat}', [\App\Http\Controllers\HealthAIController::class, 'messages'])->name('health.ai.chats.messages');
    Route::delete('/health/ai/chats/{chat}', [\App\Http\Controllers\HealthAIController::class, 'destroy'])->name('health.ai.chats.destroy');

    // Appointment Routes
    Route::get('/appointments', [AppointmentController::class, 'index'])->name('appointments.index');
    Route::get('/appointments/create/{doctor}', [AppointmentController::class, 'create'])->name('appointments.create');
    Route::post('/appointments/store/{doctor}', [AppointmentController::class, 'store'])->name('appointments.store');
    Route::get('/appointments/{appointment}', [AppointmentController::class, 'show'])->name('appointments.show');
    Route::get('/my-appointments', [AppointmentController::class, 'myAppointments'])->name('appointments.my-appointments');
    Route::patch('/appointments/{appointment}/cancel', [AppointmentController::class, 'cancel'])->name('appointments.cancel');

    // Prescription Routes (Patient)
    Route::get('/prescriptions', [\App\Http\Controllers\PrescriptionController::class, 'index'])->name('prescriptions.index');
    Route::get('/prescriptions/{prescription}', [\App\Http\Controllers\PrescriptionController::class, 'show'])->name('prescriptions.show');

    // Chat Routes (Patient)
    Route::get('/messages', [\App\Http\Controllers\ChatController::class, 'index'])->name('chat.index');
    Route::get('/messages/{conversation}', [\App\Http\Controllers\ChatController::class, 'show'])->name('chat.show');
    Route::post('/messages/{conversation}/send', [\App\Http\Controllers\ChatController::class, 'sendMessage'])->name('chat.send');
    Route::get('/appointments/{appointment}/chat', [\App\Http\Controllers\ChatController::class, 'createFromAppointment'])->name('chat.create-from-appointment');
});

// E-Commerce Routes
Route::prefix('shop')->group(function () {
    Route::get('/products', [\App\Http\Controllers\ProductController::class, 'index'])->name('products.index');
    Route::get('/products/{slug}', [\App\Http\Controllers\ProductController::class, 'show'])->name('products.show');

    // Cart routes (accessible for all users including guests)
    Route::get('/cart', [\App\Http\Controllers\CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{product}', [\App\Http\Controllers\CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/buy-now/{product}', [\App\Http\Controllers\CartController::class, 'buyNow'])->name('cart.buyNow');
    Route::patch('/cart/update/{cartItem}', [\App\Http\Controllers\CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/remove/{cartItem}', [\App\Http\Controllers\CartController::class, 'remove'])->name('cart.remove');
    Route::delete('/cart/clear', [\App\Http\Controllers\CartController::class, 'clear'])->name('cart.clear');

    // Checkout routes (require authentication)
    Route::middleware('auth')->group(function () {
        Route::get('/checkout', [\App\Http\Controllers\CheckoutController::class, 'index'])->name('checkout.index');
        Route::post('/checkout/process', [\App\Http\Controllers\CheckoutController::class, 'process'])->name('checkout.process');
        Route::get('/checkout/success/{order}', [\App\Http\Controllers\CheckoutController::class, 'success'])->name('checkout.success');
        Route::post('/checkout/confirm-payment/{order}', [\App\Http\Controllers\CheckoutController::class, 'confirmPayment'])->name('checkout.confirm-payment');
    });
});

// Order Routes (require authentication)
Route::middleware('auth')->group(function () {
    Route::get('/orders', [\App\Http\Controllers\OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [\App\Http\Controllers\OrderController::class, 'show'])->name('orders.show');
});

// Call Routes (shared between patient and doctor)
Route::middleware('auth')->prefix('calls')->group(function () {
    Route::post('/conversations/{conversation}/initiate', [\App\Http\Controllers\CallController::class, 'initiate'])->name('calls.initiate');
});

// API Routes for real-time features
Route::middleware('auth')->prefix('api')->group(function () {
    Route::get('/messages/unread-count', [\App\Http\Controllers\ChatController::class, 'unreadCount'])->name('api.messages.unread-count');
    Route::get('/conversations/{conversation}/messages', [\App\Http\Controllers\ChatController::class, 'fetchMessages'])->name('api.conversations.messages');
});

// Admin Order Management
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/orders', [\App\Http\Controllers\OrderController::class, 'adminIndex'])->name('admin.orders.index');
    Route::patch('/orders/{order}/status', [\App\Http\Controllers\OrderController::class, 'updateStatus'])->name('admin.orders.update-status');
});

// Articles Routes (accessible to all authenticated users)
Route::middleware('auth')->group(function () {
    Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
    Route::get('/articles/{slug}', [ArticleController::class, 'show'])->name('articles.show');

    // Comment Routes
    Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');

    // Article Like Routes
    Route::post('/articles/like/toggle', [ArticleLikeController::class, 'toggle'])->name('articles.like.toggle');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/profile/photo', [ProfileController::class, 'updatePhoto'])->name('profile.photo.update');
    Route::patch('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// TEMPORARY: Update product images - REMOVE AFTER USE!
Route::get('/update-product-images', function () {
    $products = [
        'vitamin-c-1000mg' => 'https://images.unsplash.com/photo-1550572017-4814c2ea04fc?w=400&h=400&fit=crop',
        'multivitamin-complete' => 'https://images.unsplash.com/photo-1607619056574-7b8d3ee536b2?w=400&h=400&fit=crop',
        'omega-3-fish-oil' => 'https://images.unsplash.com/photo-1508514177221-188b1cf16e9d?w=400&h=400&fit=crop',
        'vitamin-d3-2000-iu' => 'https://images.unsplash.com/photo-1471864190281-a93a3070b6de?w=400&h=400&fit=crop',
        'paracetamol-500mg' => 'https://images.unsplash.com/photo-1584308666744-24d5c474f2ae?w=400&h=400&fit=crop',
        'obat-batuk-sirup' => 'https://images.unsplash.com/photo-1587854692152-cbe660dbde88?w=400&h=400&fit=crop',
        'antasida-tablet' => 'https://images.unsplash.com/photo-1585435557343-3b092031a831?w=400&h=400&fit=crop',
        'termometer-digital' => 'https://images.unsplash.com/photo-1584515933487-779824d29309?w=400&h=400&fit=crop',
        'tensimeter-digital' => 'https://images.unsplash.com/photo-1615486511484-92e172cc4fe0?w=400&h=400&fit=crop',
        'masker-medis-3-ply' => 'https://images.unsplash.com/photo-1603791440384-56cd371ee9a7?w=400&h=400&fit=crop',
        'hand-sanitizer-100ml' => 'https://images.unsplash.com/photo-1584744982491-665216d95f8b?w=400&h=400&fit=crop',
        'sabun-antiseptik' => 'https://images.unsplash.com/photo-1585421514738-01798e348b17?w=400&h=400&fit=crop',
        'lotion-pelembab' => 'https://images.unsplash.com/photo-1556228578-0d85b1a4d571?w=400&h=400&fit=crop',
        'sunscreen-spf-50' => 'https://images.unsplash.com/photo-1620916566398-39f1143ab7be?w=400&h=400&fit=crop',
        'madu-murni-500ml' => 'https://images.unsplash.com/photo-1587049352846-4a222e784210?w=400&h=400&fit=crop',
        'jahe-merah-instan' => 'https://images.unsplash.com/photo-1599894439780-33f56ce5c26a?w=400&h=400&fit=crop',
        'habbatussauda-oil' => 'https://images.unsplash.com/photo-1608571423902-eed4a5ad8108?w=400&h=400&fit=crop',
        'curcuma-plus' => 'https://images.unsplash.com/photo-1615485290382-441e4d049cb5?w=400&h=400&fit=crop',
    ];

    $updated = 0;
    foreach ($products as $slug => $imageUrl) {
        $product = \App\Models\Product::where('slug', $slug)->first();
        if ($product) {
            $product->image = $imageUrl;
            $product->save();
            $updated++;
        }
    }

    return response()->json([
        'status' => 'success',
        'message' => "Updated {$updated} products with unique images",
        'updated' => $updated
    ]);
});

require __DIR__ . '/auth.php';
