<!DOCTYPE html>
<html>
<head>
    <title>Laravel Barcode</title>
</head>
<body>
    <h1>Upload Image for Barcode</h1>

    <form method="POST" action="{{ route('barcode.process') }}" enctype="multipart/form-data">
        @csrf
        <input type="file" name="image" accept="image/*" required>
        <button type="submit">Barcode Text</button>
    </form>

    @if ($errors->any())
        <div style="color: red;">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif
</body>
</html>
