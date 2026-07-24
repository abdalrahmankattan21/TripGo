<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>تعديل المرشد</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; background: #f8f9fc; padding: 20px; }
        .container { max-width: 600px; margin: auto; background: #fff; padding: 30px; border-radius: 12px; box-shadow: 0 2px 15px rgba(0,0,0,0.08); }
        h1 { color: #2c3e50; border-bottom: 3px solid #f39c12; padding-bottom: 15px; }
        .form-group { margin-bottom: 20px; }
        label { display: block; font-weight: bold; margin-bottom: 5px; color: #34495e; }
        input, select { width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 8px; box-sizing: border-box; }
        .btn { padding: 10px 25px; border: none; border-radius: 8px; cursor: pointer; color: white; font-weight: bold; }
        .btn-warning { background: #f39c12; }
        .btn-secondary { background: #95a5a6; }
    </style>
</head>
<body>
<div class="container">
    <h1> تعديل بيانات المرشد #{{ $guide->id }}</h1>

    <form action="{{ route('admin.guides.update', $guide->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>الاسم</label>
            <input type="text" name="name" value="{{ $guide->name }}" required>
        </div>

        <div class="form-group">
            <label>البريد الإلكتروني</label>
            <input type="email" name="email" value="{{ $guide->email }}" required>
        </div>

        <div class="form-group">
            <label>رقم الهاتف</label>
            <input type="text" name="phone" value="{{ $guide->phone }}" required>
        </div>

        <div class="form-group">
            <label>الحالة</label>
            <select name="status">
                <option value="active" {{ $guide->status == 'active' ? 'selected' : '' }}>نشط</option>
                <option value="inactive" {{ $guide->status == 'inactive' ? 'selected' : '' }}>غير نشط</option>
            </select>
        </div>

        <button type="submit" class="btn btn-warning">تحديث البيانات</button>
        <a href="{{ route('admin.guides.index') }}" class="btn btn-secondary">إلغاء</a>
    </form>
</div>
</body>
</html>
