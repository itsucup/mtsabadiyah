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

    <!-- Section Breadcumb -->
    <section class="font-inter bg-sky-100 mx-20 my-6 p-4">
      <div class="">
        <a class="text-slate-500" href="/">Home</a>
        >
        <a class="text-slate-500" href="/galeri">Profil</a>
        >
        <span class="text-emerald-700 font-semibold">Sambutan Kepala Sekolah</span>
      </div>
    </section>

    <!-- Section Gambar Berita -->
    <section class="">
      <div class="bg-slate-400 mx-20 my-6">
        <a href="#">
            <img src="https://mtsabadiyah.sch.id/uploads/pasfoto_kepalasekolah.png" alt="Gambar Berita">
        </a>
      </div>
    </section>

    <!-- Section Berita -->
    <section class="mx-20 bg-sky-100 my-6">
      <div>
         <h2 class="mb-2 text-3xl font-semibold">Sambutan Kepala Sekolah</h2>
         <hr class="text-slate-400 mt-2 mb-2">
        <p class="pb-1">
            Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nisi quae velit pariatur atque sint! Inventore ad id iste debitis ipsa velit totam dolor sint incidunt vel quo expedita modi dicta labore eveniet, sapiente eligendi fugit dignissimos! Doloremque, eius placeat hic molestiae, facilis porro necessitatibus modi ea perferendis alias nulla repellat?
        </p>
        <p>
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet velit, error at placeat deleniti alias distinctio facere, laborum, beatae commodi ea dicta officia architecto? Hic dolor doloremque vero dignissimos unde! Nesciunt tempora ex dolores voluptatibus! Similique dolore et facilis distinctio, maiores optio dolorum saepe est, ad aliquid perspiciatis, illo facere reprehenderit doloribus impedit placeat! Nesciunt voluptatum illum nulla aspernatur eius rem, fugit quisquam ducimus quidem unde excepturi odio, harum cumque accusamus porro, alias nemo! Sequi blanditiis, similique minima voluptatem doloribus consequuntur accusantium consequatur corrupti incidunt ducimus dolores totam doloremque cumque veritatis tempore! Facere, neque. Temporibus consequuntur earum maxime fuga alias?
        </p>
      </div>
    </section>

  @include('partials.footer')

</body>
</html>
