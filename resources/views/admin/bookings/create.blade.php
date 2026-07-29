<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>إضافة حجز جديد</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; background: #f8f9fc; padding: 20px; }
        .container { max-width: 600px; margin: auto; background: #fff; padding: 30px; border-radius: 12px; box-shadow: 0 2px 15px rgba(0,0,0,0.08); }
        h1 { color: #2c3e50; border-bottom: 3px solid #27ae60; padding-bottom: 15px; }
        .form-group { margin-bottom: 20px; }
        label { display: block; font-weight: bold; margin-bottom: 5px; color: #34495e; }
        input, select { width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 8px; box-sizing: border-box; }
        .btn { padding: 10px 25px; border: none; border-radius: 8px; cursor: pointer; color: white; font-weight: bold; }
        .btn-success { background: #27ae60; }
        .btn-secondary { background: #95a5a6; }
    </style>
</head>
<body>
<div class="container">
    <h1>➕ إضافة حجز جديد</h1>

    <form action="{{ route('admin.bookings.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label>المستخدم</label>
            <select name="user_id" required>
                <option value="">اختر مستخدم</option>
                {{-- هنا نضيف المستخدمين لاحقاً، لكن يمكنك تركها فارغة حالياً --}}
            </select>
        </div>

        <div class="form-group">
            <label>الرحلة</label>
            <select name="trip_id" required>
                <option value="">اختر رحلة</option>
                {{-- هنا نضيف الرحلات لاحقاً --}}
            </select>
        </div>

        <div class="form-group">
            <label>عدد المقاعد</label>
            <input type="number" name="number_of_seats" min="1" required>
        </div>

        <div class="form-group">
            <label>السعر الإجمالي</label>
            <input type="number" step="0.01" name="total_price" required>
        </div>

        <div class="form-group">
            <label>الحالة</label>
            <select name="status">
                <option value="pending">قيد الانتظار</option>
                <option value="confirmed">مؤكد</option>
                <option value="cancelled">ملغي</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">حفظ الحجز</button>
        <a href="{{ route('admin.bookings.index') }}" class="btn btn-secondary">إلغاء</a>
    </form>
</div>
</body>
</html>
