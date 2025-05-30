<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>MTs Abadiyah</title>
</head>
<body class="font-inter">

  @include('partials.header')

      <!-- Section Breadcrumb -->
    <section class="bg-sky-100 mx-5 md:mx-20 my-4 p-4 rounded">
      <div class="">
        <a class="text-slate-500" href="/">Home</a>
        >
        <a class="text-slate-500" href="/galeri">Galeri</a>
        >
        <span class="text-emerald-700 font-semibold">Video</span>
      </div>
    </section>

    <!-- Section Galeri Video -->
    <section class="mx-5 md:mx-20 my-8">
      <h2 class="text-2xl font-bold text-emerald-700 mb-6">Galeri Video</h2>

      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
        <!-- Video 1 -->
        <div class="aspect-video w-full overflow-hidden rounded-lg shadow-lg">
          <iframe class="w-full h-full"
            src="https://www.youtube.com/embed/dQw4w9WgXcQ"
            title="Video 1"
            frameborder="0"
            allowfullscreen></iframe>
        </div>

        <!-- Video 2 -->
        <div class="aspect-video w-full overflow-hidden rounded-lg shadow-lg">
          <iframe class="w-full h-full"
            src="https://www.youtube.com/embed/tgbNymZ7vqY"
            title="Video 2"
            frameborder="0"
            allowfullscreen></iframe>
        </div>

        <!-- Video 3 -->
        <div class="aspect-video w-full overflow-hidden rounded-lg shadow-lg">
          <iframe class="w-full h-full"
            src="https://www.youtube.com/watch?v=IxCfL89D374"
            title="Video 3"
            frameborder="0"
            allowfullscreen></iframe>
        </div>

        <!-- Video 4 -->
        <div class="aspect-video w-full overflow-hidden rounded-lg shadow-lg">
          <iframe class="w-full h-full"
            src="https://www.youtube.com/embed/J---aiyznGQ"
            title="Video 4"
            frameborder="0"
            allowfullscreen></iframe>
        </div>

      </div>
    </section>

  @include('partials.footer')

</body>
</html>