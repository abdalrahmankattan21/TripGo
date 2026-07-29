<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إدارة الحجوزات</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #f8f9fc; padding: 20px; }
        .container { max-width: 1300px; margin: auto; background: #fff; padding: 25px; border-radius: 12px; box-shadow: 0 2px 15px rgba(0,0,0,0.08); }
        h1 { color: #2c3e50; border-bottom: 3px solid #3498db; padding-bottom: 15px; }
        .filters { display: flex; flex-wrap: wrap; gap: 12px; background: #f1f5f9; padding: 20px; border-radius: 10px; margin-bottom: 25px; align-items: center; }
        .filters select, .filters input { padding: 8px 12px; border: 1px solid #d1d5db; border-radius: 8px; background: white; min-width: 130px; }
        .btn { padding: 8px 16px; border-radius: 8px; border: none; cursor: pointer; text-decoration: none; color: white; font-weight: bold; transition: 0.3s; }
        .btn-primary { background: #3498db; }
        .btn-primary:hover { background: #2980b9; }
        .btn-warning { background: #f39c12; }
        .btn-warning:hover { background: #d68910; }
        .btn-danger { background: #e74c3c; }
        .btn-danger:hover { background: #c0392b; }
        .btn-sm { padding: 5px 10px; font-size: 13px; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th { background: #2c3e50; color: white; padding: 12px; text-align: center; }
        td { padding: 12px; text-align: center; border-bottom: 1px solid #ecf0f1; }
        tr:hover { background: #f8f9fa; }
        .badge { padding: 5px 12px; border-radius: 20px; color: white; font-size: 13px; font-weight: bold; }
        .badge-pending { background: #f39c12; }
        .badge-confirmed { background: #27ae60; }
        .badge-cancelled { background: #e74c3c; }
        .actions form { display: inline-block; margin: 0; }
    </style>
</head>
<body>
<div class="container">
    <h1>📋 إدارة الحجوزات</h1>

    
    <form method="GET" action="<?php echo e(route('admin.bookings.index')); ?>" class="filters">
        <select name="status">
            <option value="">كل الحالات</option>
            <option value="pending" <?php echo e(request('status') == 'pending' ? 'selected' : ''); ?>>قيد الانتظار</option>
            <option value="confirmed" <?php echo e(request('status') == 'confirmed' ? 'selected' : ''); ?>>مؤكد</option>
            <option value="cancelled" <?php echo e(request('status') == 'cancelled' ? 'selected' : ''); ?>>ملغي</option>
        </select>

        <select name="trip_id">
            <option value="">كل الرحلات</option>
            <?php $__currentLoopData = $trips; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $trip): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($trip->id); ?>" <?php echo e(request('trip_id') == $trip->id ? 'selected' : ''); ?>><?php echo e($trip->title); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>

        <select name="user_id">
            <option value="">كل المستخدمين</option>
            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($user->id); ?>" <?php echo e(request('user_id') == $user->id ? 'selected' : ''); ?>><?php echo e($user->name); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>

        <input type="date" name="booking_date" value="<?php echo e(request('booking_date')); ?>" placeholder="تاريخ الحجز">
        <input type="date" name="start_date" value="<?php echo e(request('start_date')); ?>" placeholder="تاريخ الانطلاق">

        <button type="submit" class="btn btn-primary">فلترة</button>
        <a href="<?php echo e(route('admin.bookings.index')); ?>" class="btn btn-warning">إلغاء الفلترة</a>
    </form>

    
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>المستخدم</th>
                <th>الرحلة</th>
                <th>عدد المقاعد</th>
                <th>السعر الإجمالي</th>
                <th>الحالة</th>
                <th>تاريخ الحجز</th>
                <th>الإجراءات</th>
            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $bookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td><?php echo e($booking->id); ?></td>
                    <td><?php echo e($booking->user->name ?? 'غير معروف'); ?></td>
                    <td><?php echo e($booking->trip->title ?? 'غير معروف'); ?></td>
                    <td><?php echo e($booking->number_of_seats); ?></td>
                    <td>$<?php echo e(number_format($booking->total_price, 2)); ?></td>
                    <td>
                        <span class="badge badge-<?php echo e($booking->status); ?>">
                            <?php echo e($booking->status == 'pending' ? 'قيد الانتظار' : ($booking->status == 'confirmed' ? 'مؤكد' : 'ملغي')); ?>

                        </span>
                    </td>
                    <td><?php echo e(optional($booking->booking_date)->format('Y-m-d') ?? 'غير محدد'); ?></td>
                    <td class="actions">
                        <a href="<?php echo e(route('admin.bookings.show', $booking->id)); ?>" class="btn btn-primary btn-sm">عرض</a>
                        <a href="<?php echo e(route('admin.bookings.edit', $booking->id)); ?>" class="btn btn-warning btn-sm">تعديل</a>
                        <form action="<?php echo e(route('admin.bookings.destroy', $booking->id)); ?>" method="POST" style="display:inline;">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('هل أنت متأكد من الحذف؟')">حذف</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="8" style="padding: 40px; color: #95a5a6;">لا توجد حجوزات لعرضها حالياً</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\Xacademy Tasks\TripGo\resources\views/admin/bookings/index.blade.php ENDPATH**/ ?>