<?php $active = str_starts_with(request('folder', ''), $node['path']); ?>
<div>
    <a href="<?php echo e(route('admin.media.index', ['folder' => $node['path']])); ?>"
       class="flex items-center gap-2 px-3 py-2 rounded-lg text-sm font-medium transition-colors <?php echo e(request('folder') === $node['path'] ? 'bg-rose-50 text-rose-700' : 'text-slate-600 hover:bg-slate-50'); ?>">
        <svg class="w-4 h-4 shrink-0 <?php echo e($active ? 'text-amber-500' : 'text-slate-400'); ?>" fill="currentColor" viewBox="0 0 24 24">
            <path d="M3 7a2 2 0 012-2h4l2 2h8a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V7z"/>
        </svg>
        <span class="truncate"><?php echo e($node['name']); ?></span>
    </a>
    <?php if(!empty($node['children'])): ?>
        <div class="ml-4 mt-0.5 space-y-0.5">
            <?php $__currentLoopData = $node['children']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php echo $__env->make('admin.media._folder-node', ['node' => $child], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php endif; ?>
</div>
<?php /**PATH /home/u589377733/domains/currentcravings.co.uk/public_html/resources/views/admin/media/_folder-node.blade.php ENDPATH**/ ?>