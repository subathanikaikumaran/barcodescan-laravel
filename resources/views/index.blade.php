<!DOCTYPE html>
<html>

<head>
    <title>Laravel Cam</title>
</head>

<body>
    <h1>Upload Image for Cam</h1>


    <!-- A video preview of the camera -->
    <video id="video" width="320" height="240" autoplay></video>

    <!-- A button to take snapshot -->
    <button id="snap">Capture</button>

    <!-- Canvas to hold captured image -->
    <canvas id="canvas" width="320" height="240" style="display:none;"></canvas>

    <!-- Form to upload image -->
    <form id="uploadForm" method="POST" action="{{ route('cam.process') }}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="image" id="imageInput">
        <button type="submit">Upload Image</button>
    </form>


    @if ($errors->any())
    <div style="color: red;">
        @foreach ($errors->all() as $error)
        <p>{{ $error }}</p>
        @endforeach
    </div>
    @endif
</body>


<script>
  const video = document.getElementById('video');
  const canvas = document.getElementById('canvas');
  const snap = document.getElementById('snap');
  const imageInput = document.getElementById('imageInput');

  // Access webcam
  navigator.mediaDevices.getUserMedia({ video: true })
    .then(stream => {
      video.srcObject = stream;
    })
    .catch(err => console.error("Error accessing camera:", err));

  snap.addEventListener('click', () => {
    // Draw video frame to canvas
    canvas.getContext('2d').drawImage(video, 0, 0, canvas.width, canvas.height);

    // Get image as base64 string
    const dataURL = canvas.toDataURL('image/jpeg');

    // Set hidden input value to base64 string (strip header)
    imageInput.value = dataURL.replace(/^data:image\/jpeg;base64,/, '');

    alert('Image captured! Ready to upload.');
  });
</script>

</html>