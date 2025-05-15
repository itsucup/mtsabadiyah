@extends('layouts.app')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
    <!-- Breadcrumb -->
    <div class="text-sm text-gray-600 mb-4">
        <a href="/" class="hover:text-blue-600">Home</a> > 
        <a href="/berita" class="hover:text-blue-600">Berita</a> > 
        <span class="text-gray-800 font-medium">Detail Berita</span>
    </div>

    <!-- Info Admin dan Tanggal -->
    <div class="text-gray-500 text-sm mb-2">
        Admin - 4 Februari 2025
    </div>

    <!-- Judul Berita -->
    <h1 class="text-2xl font-bold text-gray-800 mb-6">JUDUL - Lorem Ipsum dolor sit amet, consectetur adipiscing elit.</h1>

    <!-- Konten Berita -->
    <div class="prose max-w-none text-gray-700 mb-8">
        <p class="mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc mauris augue, vulputate vel enim nec, maximus consectetur nisi. Morbi ac egestas sapien. Phasellus tristique tellus odio, nec pulvinar neque ultricies sed. Sed pellentesque eu arcu id pharetra. Sed ornare lectus eu maximus commodo. Vivamus justo diam, auctor nec ultricies ut, porttitor eget felis. Nam in lacus vel tellus consectetur efficitur. Mauris blandit erat convallis ipsum vestibulum, at congue lectus convallis. Quisque eget est vitae est auctor dignissim. Nunc sed viverra eros. Donec ullamcorper nisi tortor. Fusce mi est, faucibus a sodales sit amet, eleifend sit amet nunc. Etiam ac fermentum arcu. Mauris tincidunt quis neque non dictum.</p>

        <p class="mb-4">Integer at maximus turpis. Aliquam sodales, mi eget auctor blandit, nisi lectus tincidunt libero, sit amet ornare tortor sapien non quam. Mauris laoreet justo elit, sed faucibus mi tristique at. Mauris sed sollicitudin odio. Phasellus et placerat est. Nunc pharetra viverra orci, a laoreet lacus tempus at. Vestibulum faucibus non dui fermentum ultricies. Vestibulum tempus lectus facilisis, consectetur arcu at, laoreet ipsum.</p>

        <p class="mb-4">Suspendisse fermentum interdum elit quis mattis. Vestibulum pretium eget libero a dictum. Duis dictum suscipit nisi sed placerat. Aliquam scelerisque maximus purus cursus porta. In hac habitasse platea dictumst. Aliquam erat volutpat. Duis ac neque nec est bibendum eleifend. Nulla ullamcorper varius maximus. Vivamus eget fermentum ipsum. Nam egestas nisi non ligula rhoncus, at interdum turpis rutrum. Sed eget sem eu lorem tincidunt posuere et et ex. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
    </div>

    <!-- Section Komentar -->
    <div class="border-t border-gray-200 pt-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Komentar</h2>
        <!-- Form Komentar dan Daftar Komentar akan ditambahkan di sini -->
    </div>
</div>
@endsection