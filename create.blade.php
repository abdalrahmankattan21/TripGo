<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>إضافة مرشد جديد</title>
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
    <h1>➕ إضافة مرشد جديد</h1>

    <form action="{{ route('admin.guides.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label>الاسم</label>
            <input type="text" name="name" required>
        </div>

        <div class="form-group">
            <label>البريد الإلكتروني</label>
            <input type="email" name="email" required>
        </div>

        <div class="form-group">
            <label>رقم الهاتف</label>
            <input type="text" name="phone" required>
        </div>

        <div class="form-group">
            <label>الحالة</label>
            <select name="status">
                <option value="active">نشط</option>
                <option value="inactive">غير نشط</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">حفظ المرشد</button>
        <a href="{{ route('admin.guides.index') }}" class="btn btn-secondary">إلغاء</a>
    </form>
</div>
</body>
</html>
