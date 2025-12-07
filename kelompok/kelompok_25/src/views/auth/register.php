<div class="min-h-screen flex items-center justify-center p-4">
    <!-- Register Container -->
    <div class="w-full max-w-md">
        <!-- Logo and Title Component -->
        <div id="auth-header" class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-white rounded-3xl shadow-lg mb-6">
                <svg class="w-12 h-12 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                </svg>
            </div>
            <h1 class="text-2xl font-bold text-white mb-2">Inventory Manager</h1>
            <p class="text-white text-opacity-90">Sistem Manajemen Stok Bahan Baku</p>
        </div>

        <!-- Register Card Component -->
        <div class="bg-white rounded-3xl shadow-2xl p-8">
            <h2 class="text-2xl font-semibold text-gray-800 mb-8">Daftar Akun Baru</h2>

            <!-- Flash Messages Component -->
            <?php if (has_flash('error')): ?>
                <div id="alert-error" class="mb-6 bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg">
                    <?= e(get_flash('error')) ?>
                </div>
            <?php endif; ?>

            <!-- Register Form Component -->
            <form id="register-form" action="<?= url('/register') ?>" method="POST" class="space-y-6">
                <?= csrf_field() ?>

                <!-- Name Input Component -->
                <div class="form-group">
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                        <input 
                            type="text" 
                            id="name" 
                            name="name" 
                            value="<?= e(old('name')) ?>"
                            placeholder="Masukkan nama lengkap"
                            class="w-full pl-12 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                            required
                        >
                    </div>
                    <?php if (has_flash('errors') && isset(get_flash('errors')['name'])): ?>
                        <p class="mt-1 text-sm text-red-600"><?= e(get_flash('errors')['name'][0]) ?></p>
                    <?php endif; ?>
                </div>

                <!-- Email Input Component -->
                <div class="form-group">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <input 
                            type="email" 
                            id="email" 
                            name="email" 
                            value="<?= e(old('email')) ?>"
                            placeholder="nama@email.com"
                            class="w-full pl-12 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                            required
                        >
                    </div>
                    <?php if (has_flash('errors') && isset(get_flash('errors')['email'])): ?>
                        <p class="mt-1 text-sm text-red-600"><?= e(get_flash('errors')['email'][0]) ?></p>
                    <?php endif; ?>
                </div>

                <!-- Password Input Component -->
                <div class="form-group">
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                        </div>
                        <input 
                            type="password" 
                            id="password" 
                            name="password" 
                            placeholder="Minimal 6 karakter"
                            class="w-full pl-12 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                            required
                        >
                    </div>
                    <?php if (has_flash('errors') && isset(get_flash('errors')['password'])): ?>
                        <p class="mt-1 text-sm text-red-600"><?= e(get_flash('errors')['password'][0]) ?></p>
                    <?php endif; ?>
                </div>

                <!-- Password Confirmation Input Component -->
                <div class="form-group">
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">Konfirmasi Password</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                        </div>
                        <input 
                            type="password" 
                            id="password_confirmation" 
                            name="password_confirmation" 
                            placeholder="Ulangi password"
                            class="w-full pl-12 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                            required
                        >
                    </div>
                </div>

                <!-- Submit Button Component -->
                <button 
                    type="submit" 
                    id="submit-btn"
                    class="w-full bg-blue-600 text-white py-3 rounded-lg font-medium hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition"
                >
                    <span id="btn-text">Daftar Sekarang</span>
                </button>
            </form>

            <!-- Login Link Component -->
            <div class="mt-6 text-center">
                <p class="text-gray-600">
                    Sudah punya akun?
                    <a href="<?= url('/login') ?>" class="text-blue-600 hover:text-blue-700 font-medium">
                        Masuk di sini
                    </a>
                </p>
            </div>
        </div>

        <!-- Footer Component -->
        <div class="text-center mt-8 text-white text-sm text-opacity-90">
            &copy; 2025 Inventory Manager. All rights reserved.
        </div>
    </div>
</div>

<script>
    // Register Form Component JavaScript
    document.addEventListener('DOMContentLoaded', function() {
        const registerForm = document.getElementById('register-form');
        const submitBtn = document.getElementById('submit-btn');
        const btnText = document.getElementById('btn-text');
        const password = document.getElementById('password');
        const passwordConfirmation = document.getElementById('password_confirmation');

        // Form validation component
        registerForm.addEventListener('submit', function(e) {
            const name = document.getElementById('name').value;
            const email = document.getElementById('email').value;

            if (!name || !email || !password.value || !passwordConfirmation.value) {
                e.preventDefault();
                showNotification('Semua field wajib diisi', 'error');
                return;
            }

            if (password.value !== passwordConfirmation.value) {
                e.preventDefault();
                showNotification('Password dan konfirmasi password tidak sama', 'error');
                passwordConfirmation.focus();
                return;
            }

            if (password.value.length < 6) {
                e.preventDefault();
                showNotification('Password minimal 6 karakter', 'error');
                password.focus();
                return;
            }

            // Show loading state
            submitBtn.disabled = true;
            btnText.textContent = 'Memproses...';
        });

        // Password match validation component
        passwordConfirmation.addEventListener('input', function() {
            if (password.value && this.value) {
                if (password.value !== this.value) {
                    this.classList.add('border-red-500');
                    this.classList.remove('border-gray-300');
                } else {
                    this.classList.remove('border-red-500');
                    this.classList.add('border-green-500');
                }
            }
        });

        // Auto-hide alerts after 5 seconds
        const alerts = document.querySelectorAll('[id^="alert-"]');
        alerts.forEach(alert => {
            setTimeout(() => {
                alert.style.transition = 'opacity 0.5s';
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 500);
            }, 5000);
        });
    });

    // Notification component
    function showNotification(message, type = 'info') {
        const colors = {
            success: 'bg-green-50 border-green-200 text-green-800',
            error: 'bg-red-50 border-red-200 text-red-800',
            info: 'bg-blue-50 border-blue-200 text-blue-800'
        };

        const notification = document.createElement('div');
        notification.className = `fixed top-4 right-4 ${colors[type]} border px-6 py-4 rounded-lg shadow-lg z-50 transition-all`;
        notification.textContent = message;

        document.body.appendChild(notification);

        setTimeout(() => {
            notification.style.opacity = '0';
            setTimeout(() => notification.remove(), 500);
        }, 3000);
    }
</script>
