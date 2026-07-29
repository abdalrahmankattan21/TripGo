<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إدارة المرشدين</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; background: #f8f9fc; padding: 20px; }
        .container { max-width: 1300px; margin: auto; background: #fff; padding: 25px; border-radius: 12px; box-shadow: 0 2px 15px rgba(0,0,0,0.08); }
        h1 { color: #2c3e50; border-bottom: 3px solid #3498db; padding-bottom: 15px; }
        .filters { display: flex; flex-wrap: wrap; gap: 12px; background: #f1f5f9; padding: 20px; border-radius: 10px; margin-bottom: 25px; align-items: center; }
        .filters input, .filters select { padding: 8px 12px; border: 1px solid #d1d5db; border-radius: 8px; background: white; min-width: 150px; }
        .btn { padding: 8px 16px; border-radius: 8px; border: none; cursor: pointer; text-decoration: none; color: white; font-weight: bold; transition: 0.3s; }
        .btn-primary { background: #3498db; }
        .btn-warning { background: #f39c12; }
        .btn-danger { background: #e74c3c; }
        .btn-sm { padding: 5px 10px; font-size: 13px; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th { background: #2c3e50; color: white; padding: 12px; text-align: center; }
        td { padding: 12px; text-align: center; border-bottom: 1px solid #ecf0f1; }
        .badge { padding: 5px 12px; border-radius: 20px; color: white; font-size: 13px; font-weight: bold; }
        .badge-active { background: #27ae60; }
        .badge-inactive { background: #e74c3c; }
        .actions form { display: inline-block; margin: 0; }
    </style>
</head>
<body>
<div class="container">
    <h1>🧑‍🏫 إدارة المرشدين السياحيين</h1>

    
    <form method="GET" action="<?php echo e(route('admin.guides.index')); ?>" class="filters">
        <input type="text" name="name" placeholder="اسم المرشد" value="<?php echo e(request('name')); ?>">
        <input type="email" name="email" placeholder=" البريد الإلكتروني" value="<?php echo e(request('email')); ?>">
        <input type="text" name="phone" placeholder=" رقم الهاتف" value="<?php echo e(request('phone')); ?>">

        <select name="status">
            <option value="">كل الحالات</option>
            <option value="active" <?php echo e(request('status') == 'active' ? 'selected' : ''); ?>>نشط</option>
            <option value="inactive" <?php echo e(request('status') == 'inactive' ? 'selected' : ''); ?>>غير نشط</option>
        </select>

        <button type="submit" class="btn btn-primary">بحث / فلترة</button>
        <a href="<?php echo e(route('admin.guides.index')); ?>" class="btn btn-warning">إلغاء</a>
        <a href="<?php echo e(route('admin.guides.create')); ?>" class="btn btn-primary" style="background: #27ae60;">➕ إضافة مرشد جديد</a>
    </form>

    
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>الاسم</th>
                <th>البريد الإلكتروني</th>
                <th>رقم الهاتف</th>
                <th>الحالة</th>
                <th>الإجراءات</th>
            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $guides; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $guide): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td><?php echo e($guide->id); ?></td>
                    <td><?php echo e($guide->name); ?></td>
                    <td><?php echo e($guide->email); ?></td>
                    <td><?php echo e($guide->phone); ?></td>
                    <td>
                        <span class="badge badge-<?php echo e($guide->status); ?>">
                            <?php echo e($guide->status == 'active' ? 'نشط' : 'غير نشط'); ?>

                        </span>
                    </td>
                    <td class="actions">
                        <a href="<?php echo e(route('admin.guides.show', $guide->id)); ?>" class="btn btn-primary btn-sm">عرض</a>
                        <a href="<?php echo e(route('admin.guides.edit', $guide->id)); ?>" class="btn btn-warning btn-sm">تعديل</a>
                        <form action="<?php echo e(route('admin.guides.destroy', $guide->id)); ?>" method="POST" style="display:inline;">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('هل أنت متأكد من الحذف؟')">حذف</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="6" style="padding: 40px; color: #95a5a6;">لا يوجد مرشدون لعرضهم حالياً</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
    <?php echo e($guides->withQueryString()->links()); ?>

</div>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\Xacademy Tasks\TripGo\resources\views/admin/guides/index.blade.php ENDPATH**/ ?>