<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin login — Current Cravings</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-stone-900 min-h-screen flex items-center justify-center p-4">
<div class="w-full max-w-sm bg-white rounded-2xl shadow-xl p-8">
    <h1 class="text-xl font-bold text-stone-900">Admin login</h1>
    <p class="text-sm text-stone-500 mt-1">Current Cravings</p>
    <?php if($errors->any()): ?>
        <div class="mt-4 rounded-lg bg-red-50 border border-red-200 text-red-800 px-3 py-2 text-sm">
            <?php echo e($errors->first()); ?>

        </div>
    <?php endif; ?>
    <form method="post" action="<?php echo e(route('admin.login')); ?>" class="mt-6 space-y-4">
        <?php echo csrf_field(); ?>
        <div>
            <label class="block text-xs font-semibold text-stone-600 uppercase tracking-wide">Email</label>
            <input type="email" name="email" value="<?php echo e(old('email')); ?>" required autofocus
                   class="mt-1 w-full rounded-lg border border-stone-300 px-3 py-2 text-stone-900 focus:ring-2 focus:ring-rose-400 focus:border-transparent">
        </div>
        <div>
            <label class="block text-xs font-semibold text-stone-600 uppercase tracking-wide">Password</label>
            <input type="password" name="password" required
                   class="mt-1 w-full rounded-lg border border-stone-300 px-3 py-2 text-stone-900 focus:ring-2 focus:ring-rose-400 focus:border-transparent">
        </div>
        <label class="flex items-center gap-2 text-sm text-stone-600">
            <input type="checkbox" name="remember" value="1" class="rounded border-stone-300">
            Remember me
        </label>
        <button type="submit" class="w-full rounded-lg bg-rose-500 hover:bg-rose-600 text-white font-semibold py-2.5 transition-colors">
            Sign in
        </button>
    </form>
    <p class="mt-6 text-center text-xs text-stone-400">
        <a href="<?php echo e(route('home')); ?>" class="hover:text-stone-600">← Back to site</a>
    </p>
</div>
</body>
</html>
<?php /**PATH /home/u589377733/domains/currentcravings.co.uk/public_html/resources/views/admin/auth/login.blade.php ENDPATH**/ ?>