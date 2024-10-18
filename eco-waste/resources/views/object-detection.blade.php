@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-3xl font-bold mb-6 text-center">Real-Time Object Detection</h1>
    
    <!-- Video stream -->
    <div class="flex justify-center mb-4">
        <video id="webcam" autoplay playsinline class="border rounded" width="640" height="480"></video>
    </div>

    <!-- Canvas for drawing bounding boxes -->
    <div class="flex justify-center">
        <canvas id="canvas" class="border rounded" width="640" height="480"></canvas>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs"></script>
<script src="https://cdn.jsdelivr.net/npm/@tensorflow-models/coco-ssd"></script>

<script>
    const video = document.getElementById('webcam');
    const canvas = document.getElementById('canvas');
    const context = canvas.getContext('2d');

    async function setupCamera() {
        // Access the webcam stream
        const stream = await navigator.mediaDevices.getUserMedia({
            video: { width: 640, height: 480 },
            audio: false
        });
        video.srcObject = stream;

        // Load the COCO-SSD model for object detection
        const model = await cocoSsd.load();

        // Detect objects in the video stream
        video.addEventListener('loadeddata', () => {
            detectFrame(video, model);
        });
    }

    function detectFrame(video, model) {
        model.detect(video).then(predictions => {
            drawPredictions(predictions);
            requestAnimationFrame(() => {
                detectFrame(video, model);
            });
        });
    }

    function drawPredictions(predictions) {
        context.clearRect(0, 0, canvas.width, canvas.height);

        predictions.forEach(prediction => {
            context.beginPath();
            context.rect(...prediction.bbox);
            context.lineWidth = 2;
            context.strokeStyle = 'red';
            context.fillStyle = 'red';
            context.stroke();
            context.fillText(
                prediction.class + ' (' + Math.round(prediction.score * 100) + '%)', 
                prediction.bbox[0], 
                prediction.bbox[1] > 10 ? prediction.bbox[1] - 5 : 10
            );
        });
    }

    setupCamera();
</script>
@endsection
