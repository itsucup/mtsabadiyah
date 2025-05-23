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

    <!-- Breadcrumb -->
    <section class="bg-sky-100 mx-4 md:mx-20 my-6 p-4 rounded">
      <div class="flex items-center text-sm text-slate-500 space-x-1">
        <a href="/" class="hover:text-emerald-600 font-medium">Home</a>
        <span>&gt;</span>
        <span class="text-emerald-700 font-semibold">Visi dan Misi</span>
      </div>
    </section>

    <!-- Section Visi dan Misi -->
    <section class="mx-4 md:mx-20 my-8 bg-white p-6 md:p-10 rounded-lg shadow-md">

      <!-- Visi -->
      <div class="mb-8">
        <h2 class="text-2xl font-semibold text-gray-700 border-l-4 border-emerald-500 pl-1 mb-2">Visi</h2>
        <p class="italic text-center text-lg text-gray-600">
          "Ilmu Didapat Taqwa Melekat Menuju Manusia Bermartabat"
        </p>
      </div>

      <!-- Misi -->
      <div>
        <h2 class="text-2xl font-semibold text-gray-700 border-l-4 border-emerald-500 pl-1 mb-4">Misi</h2>
        <ol class="list-decimal list-inside space-y-3 text-gray-700 leading-relaxed">
          <li>Menyiapkan peserta didik untuk menjadi pembelajar seumur hidup.</li>
          <li>Melaksanakan pembelajaran berbasis pendekatan student-centered dan Projek-based learning yang bersifat religius dan apresiatif terhadap kearifan lokal.</li>
          <li>Mempersiapkan peserta didik menghadapi globalisasi dengan mengembangkan kecakapan abad 21.</li>
          <li>Menumbuhkan dan mengembangkan pemikiran dan pembiasaan toleran terhadap keberagaman (pluralisme).</li>
          <li>Melaksanakan program bimbingan dan konseling secara efektif dan terpadu sehingga setiap peserta didik berkembang secara wajar dan optimal sesuai dengan potensi dan karakter yang dimiliki.</li>
          <li>Menumbuhkan dan mengembangkan pengetahuan dan penghayatan peserta didik terhadap ajaran dan moral agama Islam serta budaya bangsa sehingga menjadi sumber kearifan dalam berfikir dan bertindak/berperilaku sebagai insan yang cerdas, jujur, disiplin, religius, arif dan peduli.</li>
          <li>Melaksanakan pengelolaan madrasah dengan manajemen partisipatif-transparan dengan melibatkan seluruh warga madrasah dan kelompok kepentingan dengan berdasar nilai-nilai moral agama dan budaya bangsa.</li>
        </ol>
      </div>
    </section>

  @include('partials.footer')

</body>
</html>
