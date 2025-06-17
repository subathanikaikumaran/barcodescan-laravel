<!DOCTYPE html>
<html>
<head>
    <title>Laravel OCR</title>
</head>
<body>
    <h1>Upload Image for OCR</h1>

    <form method="POST" action="{{ route('ocr.process') }}" enctype="multipart/form-data">
        @csrf
        <input type="file" name="image" accept="image/*" required>
        <button type="submit">Extract Text</button>
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
