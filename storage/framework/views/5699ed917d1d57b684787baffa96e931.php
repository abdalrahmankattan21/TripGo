<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['status']));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter((['status']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
    $colors = [
        'scheduled' => 'bg-blue-100 text-blue-700',
        'ongoing' => 'bg-amber-100 text-amber-700',
        'completed' => 'bg-gray-200 text-gray-700',
        'cancelled' => 'bg-red-100 text-red-700',
        'pending_payment' => 'bg-amber-100 text-amber-700',
        'paid' => 'bg-green-100 text-green-700',
        'pending' => 'bg-amber-100 text-amber-700',
        'failed' => 'bg-red-100 text-red-700',
        'refunded' => 'bg-purple-100 text-purple-700',
        'waiting' => 'bg-amber-100 text-amber-700',
        'promoted' => 'bg-green-100 text-green-700',
    ];
    $class = $colors[$status] ?? 'bg-gray-100 text-gray-700';
?>

<span class="inline-block rounded-full px-3 py-1 text-xs font-medium <?php echo e($class); ?>">
    <?php echo e(ucfirst(str_replace('_', ' ', $status))); ?>

</span>
<?php /**PATH C:\xampp\htdocs\final\TripGo\resources\views/components/admin/status-badge.blade.php ENDPATH**/ ?>