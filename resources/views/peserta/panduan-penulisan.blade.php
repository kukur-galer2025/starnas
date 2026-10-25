@extends('peserta.layouts.app')

@section('content')
    <!-- Main Content -->
    <div class="relative z-10 content-padding">
        <!-- Hero Image Section -->
        <section class="w-full relative overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-r from-slate-950/80 via-emerald-950/75 to-teal-950/80 z-10"></div>
            <img src="/storage/panduan.png" alt="Panduan Penulisan" class="w-full h-64 md:h-96 object-cover">
            <div class="absolute inset-0 flex items-center justify-center z-20">
                <div class="text-center text-white px-4">
                    <h1 class="text-4xl md:text-5xl font-bold mb-4">Panduan Penulisan</h1>
                    <p class="text-lg md:text-xl max-w-2xl mx-auto">Pedoman lengkap untuk penyusunan naskah ilmiah yang
                        memenuhi standar konferensi</p>
                </div>
            </div>
        </section>

        <!-- Panduan Penulisan Content -->
        <section class="py-16 bg-gradient-to-br from-gray-50 to-white">
            <div class="container mx-auto px-4 md:px-6">
                <div class="max-w-5xl mx-auto">
                    <!-- Content Card -->
                    <div
                        class="bg-white rounded-2xl shadow-xl overflow-hidden transform transition-all duration-500 hover:shadow-2xl">
                        <div class="p-10 md:p-14">
                            <!-- Header with decorative element -->
                            <div class="text-center mb-12 relative">
                                <div
                                    class="absolute -top-4 left-1/2 transform -translate-x-1/2 w-20 h-1 bg-gradient-to-r from-emerald-400 to-teal-400 rounded-full">
                                </div>
                                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Panduan Penulisan</h2>
                                <div class="w-32 h-1 bg-gradient-to-r from-emerald-500 to-teal-500 rounded-full mx-auto"></div>
                            </div>

                            <!-- Main Content -->
                            <div class="space-y-8">
                                <!-- Guidelines List -->
                                <div class="space-y-6">
                                    <div
                                        class="guideline-card flex items-start bg-emerald-50/60 p-5 rounded-xl border border-emerald-100 transform transition-all duration-300 hover:shadow-md hover:-translate-y-1">
                                        <div
                                            class="flex-shrink-0 w-8 h-8 bg-gradient-to-br from-emerald-500 to-teal-600 rounded-full flex items-center justify-center text-white font-bold mr-4 mt-1 shadow-md shadow-emerald-500/20">
                                            1
                                        </div>
                                        <div>
                                            <h4 class="text-lg font-semibold text-emerald-950 mb-2">Bahasa dan Keaslian</h4>
                                            <p class="text-emerald-900/90 leading-relaxed">Naskah ditulis dalam bahasa Indonesia baku atau bahasa
                                                Inggris, belum pernah dipublikasikan serta bebas dari unsur plagiat. Naskah
                                                dikirim melalui Easychair.</p>
                                        </div>
                                    </div>

                                    <div
                                        class="guideline-card flex items-start bg-emerald-50/60 p-5 rounded-xl border border-emerald-100 transform transition-all duration-300 hover:shadow-md hover:-translate-y-1">
                                        <div
                                            class="flex-shrink-0 w-8 h-8 bg-gradient-to-br from-emerald-500 to-teal-600 rounded-full flex items-center justify-center text-white font-bold mr-4 mt-1 shadow-md shadow-emerald-500/20">
                                            2
                                        </div>
                                        <div>
                                            <h4 class="text-lg font-semibold text-emerald-950 mb-2">Hak Redaksi</h4>
                                            <p class="text-emerald-900/90 leading-relaxed">Redaksi berhak menolak naskah yang tidak memenuhi
                                                kriteria/persyaratan teknis, mengadakan perubahan susunan naskah,
                                                memperbaiki bahasa dan berkonsultasi dengan penulis sebelum naskah dimuat.
                                            </p>
                                        </div>
                                    </div>

                                    <div
                                        class="guideline-card flex items-start bg-emerald-50/60 p-5 rounded-xl border border-emerald-100 transform transition-all duration-300 hover:shadow-md hover:-translate-y-1">
                                        <div
                                            class="flex-shrink-0 w-8 h-8 bg-gradient-to-br from-emerald-500 to-teal-600 rounded-full flex items-center justify-center text-white font-bold mr-4 mt-1 shadow-md shadow-emerald-500/20">
                                            3
                                        </div>
                                        <div>
                                            <h4 class="text-lg font-semibold text-emerald-950 mb-2">Format Pengetikan</h4>
                                            <p class="text-emerald-900/90 leading-relaxed">Naskah diketik dengan komputer menggunakan Microsoft
                                                Word, dengan kertas ukuran 21 cm x 29,7 cm (A4), margin atas bawah kanan
                                                kiri 3 cm, spasi 1, huruf Times New Roman ukuran font untuk judul artikel
                                                adalah 18 point, dan font pada isi makalah 11 point. Naskah ditulis dengan
                                                layout 1 kolom.</p>
                                        </div>
                                    </div>

                                    <div
                                        class="guideline-card flex items-start bg-emerald-50/60 p-5 rounded-xl border border-emerald-100 transform transition-all duration-300 hover:shadow-md hover:-translate-y-1">
                                        <div
                                            class="flex-shrink-0 w-8 h-8 bg-gradient-to-br from-emerald-500 to-teal-600 rounded-full flex items-center justify-center text-white font-bold mr-4 mt-1 shadow-md shadow-emerald-500/20">
                                            4
                                        </div>
                                        <div>
                                            <h4 class="text-lg font-semibold text-emerald-950 mb-2">Judul Makalah</h4>
                                            <p class="text-emerald-900/90 leading-relaxed">Judul makalah maksimal 12 kata dalam bahasa Indonesia
                                                atau 10 kata dalam Bahasa Inggris. Judul harus mencerminkan dengan tepat
                                                masalah yang dibahas.</p>
                                        </div>
                                    </div>

                                    <div
                                        class="guideline-card flex items-start bg-emerald-50/60 p-5 rounded-xl border border-emerald-100 transform transition-all duration-300 hover:shadow-md hover:-translate-y-1">
                                        <div
                                            class="flex-shrink-0 w-8 h-8 bg-gradient-to-br from-emerald-500 to-teal-600 rounded-full flex items-center justify-center text-white font-bold mr-4 mt-1 shadow-md shadow-emerald-500/20">
                                            5
                                        </div>
                                        <div>
                                            <h4 class="text-lg font-semibold text-emerald-950 mb-2">Abstrak</h4>
                                            <p class="text-emerald-900/90 leading-relaxed">Abstrak ditulis dalam bahasa Indonesia dan Inggris,
                                                maksimal 250 kata yang berisi latar belakang, tujuan, metode, hasil, dan
                                                kesimpulan.</p>
                                        </div>
                                    </div>

                                    <div
                                        class="guideline-card flex items-start bg-emerald-50/60 p-5 rounded-xl border border-emerald-100 transform transition-all duration-300 hover:shadow-md hover:-translate-y-1">
                                        <div
                                            class="flex-shrink-0 w-8 h-8 bg-gradient-to-br from-emerald-500 to-teal-600 rounded-full flex items-center justify-center text-white font-bold mr-4 mt-1 shadow-md shadow-emerald-500/20">
                                            6
                                        </div>
                                        <div>
                                            <h4 class="text-lg font-semibold text-emerald-950 mb-2">Kata Kunci</h4>
                                            <p class="text-emerald-900/90 leading-relaxed">Kata kunci terdiri dari 3-5 kata yang mencerminkan
                                                konsep utama dalam penelitian.</p>
                                        </div>
                                    </div>

                                    <div
                                        class="guideline-card flex items-start bg-emerald-50/60 p-5 rounded-xl border border-emerald-100 transform transition-all duration-300 hover:shadow-md hover:-translate-y-1">
                                        <div
                                            class="flex-shrink-0 w-8 h-8 bg-gradient-to-br from-emerald-500 to-teal-600 rounded-full flex items-center justify-center text-white font-bold mr-4 mt-1 shadow-md shadow-emerald-500/20">
                                            7
                                        </div>
                                        <div>
                                            <h4 class="text-lg font-semibold text-emerald-950 mb-2">Struktur Naskah</h4>
                                            <p class="text-emerald-900/90 leading-relaxed">Struktur naskah meliputi: Pendahuluan, Metode
                                                Penelitian, Hasil dan Pembahasan, Kesimpulan, dan Daftar Pustaka.</p>
                                        </div>
                                    </div>

                                    <div
                                        class="guideline-card flex items-start bg-emerald-50/60 p-5 rounded-xl border border-emerald-100 transform transition-all duration-300 hover:shadow-md hover:-translate-y-1">
                                        <div
                                            class="flex-shrink-0 w-8 h-8 bg-gradient-to-br from-emerald-500 to-teal-600 rounded-full flex items-center justify-center text-white font-bold mr-4 mt-1 shadow-md shadow-emerald-500/20">
                                            8
                                        </div>
                                        <div>
                                            <h4 class="text-lg font-semibold text-emerald-950 mb-2">Sistem Pengutipan</h4>
                                            <p class="text-emerald-900/90 leading-relaxed">Pengutipan menggunakan sistem APA (American
                                                Psychological Association) edisi terbaru.</p>
                                        </div>
                                    </div>

                                    <div
                                        class="guideline-card flex items-start bg-emerald-50/60 p-5 rounded-xl border border-emerald-100 transform transition-all duration-300 hover:shadow-md hover:-translate-y-1">
                                        <div
                                            class="flex-shrink-0 w-8 h-8 bg-gradient-to-br from-emerald-500 to-teal-600 rounded-full flex items-center justify-center text-white font-bold mr-4 mt-1 shadow-md shadow-emerald-500/20">
                                            9
                                        </div>
                                        <div>
                                            <h4 class="text-lg font-semibold text-emerald-950 mb-2">Gambar dan Tabel</h4>
                                            <p class="text-emerald-900/90 leading-relaxed">Gambar dan tabel harus jelas, diberi judul dan nomor,
                                                serta dirujuk dalam teks.</p>
                                        </div>
                                    </div>

                                    <div
                                        class="guideline-card flex items-start bg-emerald-50/60 p-5 rounded-xl border border-emerald-100 transform transition-all duration-300 hover:shadow-md hover:-translate-y-1">
                                        <div
                                            class="flex-shrink-0 w-8 h-8 bg-gradient-to-br from-emerald-500 to-teal-600 rounded-full flex items-center justify-center text-white font-bold mr-4 mt-1 shadow-md shadow-emerald-500/20">
                                            10
                                        </div>
                                        <div>
                                            <h4 class="text-lg font-semibold text-emerald-950 mb-2">Proses Review</h4>
                                            <p class="text-emerald-900/90 leading-relaxed">Naskah yang telah memenuhi persyaratan akan melalui
                                                proses review oleh mitra bestari.</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Technical Specifications -->
                                <div
                                    class="mt-12 p-8 bg-gradient-to-br from-emerald-50/70 to-teal-50/50 rounded-2xl border border-emerald-200 shadow-sm">
                                    <h3 class="text-2xl font-bold text-emerald-950 mb-6 text-center">Spesifikasi Teknis</h3>
                                    <div class="grid md:grid-cols-2 gap-6">
                                        <div class="flex items-start bg-white p-4 rounded-xl shadow-sm">
                                            <div
                                                class="flex-shrink-0 w-10 h-10 bg-gradient-to-br from-emerald-500 to-teal-600 rounded-full flex items-center justify-center text-white mr-4 shadow-md shadow-emerald-500/20">
                                                <i class="fas fa-file-alt"></i>
                                            </div>
                                            <div>
                                                <h4 class="font-bold text-emerald-950">Format Dokumen</h4>
                                                <p class="text-emerald-800">Microsoft Word (.doc/.docx)</p>
                                            </div>
                                        </div>
                                        <div class="flex items-start bg-white p-4 rounded-xl shadow-sm">
                                            <div
                                                class="flex-shrink-0 w-10 h-10 bg-gradient-to-br from-emerald-500 to-teal-600 rounded-full flex items-center justify-center text-white mr-4 shadow-md shadow-emerald-500/20">
                                                <i class="fas fa-font"></i>
                                            </div>
                                            <div>
                                                <h4 class="font-bold text-emerald-950">Font & Spasi</h4>
                                                <p class="text-emerald-800">Times New Roman, 11pt, Spasi 1</p>
                                            </div>
                                        </div>
                                        <div class="flex items-start bg-white p-4 rounded-xl shadow-sm">
                                            <div
                                                class="flex-shrink-0 w-10 h-10 bg-gradient-to-br from-emerald-500 to-teal-600 rounded-full flex items-center justify-center text-white mr-4 shadow-md shadow-emerald-500/20">
                                                <i class="fas fa-ruler"></i>
                                            </div>
                                            <div>
                                                <h4 class="font-bold text-emerald-950">Margin</h4>
                                                <p class="text-emerald-800">3 cm (atas, bawah, kiri, kanan)</p>
                                            </div>
                                        </div>
                                        <div class="flex items-start bg-white p-4 rounded-xl shadow-sm">
                                            <div
                                                class="flex-shrink-0 w-10 h-10 bg-gradient-to-br from-emerald-500 to-teal-600 rounded-full flex items-center justify-center text-white mr-4 shadow-md shadow-emerald-500/20">
                                                <i class="fas fa-language"></i>
                                            </div>
                                            <div>
                                                <h4 class="font-bold text-emerald-950">Bahasa</h4>
                                                <p class="text-emerald-800">Indonesia atau Inggris</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Additional Information -->
                                <div
                                    class="mt-8 p-8 bg-gradient-to-br from-teal-50/70 to-emerald-50/50 rounded-2xl border border-teal-200 shadow-sm">
                                    <h3 class="text-2xl font-bold text-teal-950 mb-6 text-center">Informasi Penting</h3>
                                    <div class="space-y-6">
                                        <div class="flex items-start bg-white p-5 rounded-xl shadow-sm">
                                            <div
                                                class="flex-shrink-0 w-10 h-10 bg-gradient-to-br from-teal-600 to-emerald-600 rounded-full flex items-center justify-center text-white mr-4 shadow-md shadow-teal-500/20">
                                                <i class="fas fa-clock"></i>
                                            </div>
                                            <div class="flex-1">
                                                <h4 class="font-bold text-teal-950 mb-2">Batas Waktu Pengiriman</h4>
                                                <div class="grid md:grid-cols-2 gap-4">
                                                    <div class="bg-teal-50/80 p-3 rounded-lg border border-teal-100">
                                                        <p class="text-teal-800 font-semibold">Batas Akhir Pengiriman
                                                            Abstrak</p>
                                                        <p class="text-teal-950 text-lg font-bold">15 November 2025</p>
                                                    </div>
                                                    <div class="bg-teal-50/80 p-3 rounded-lg border border-teal-100">
                                                        <p class="text-teal-800 font-semibold">Batas Akhir Pengiriman
                                                            Makalah</p>
                                                        <p class="text-teal-950 text-lg font-bold">24 November 2025</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="flex items-start bg-white p-5 rounded-xl shadow-sm">
                                            <div
                                                class="flex-shrink-0 w-10 h-10 bg-gradient-to-br from-teal-600 to-emerald-600 rounded-full flex items-center justify-center text-white mr-4 shadow-md shadow-teal-500/20">
                                                <i class="fas fa-link"></i>
                                            </div>
                                            <div>
                                                <h4 class="font-bold text-teal-950 mb-2">Submit melalui</h4>
                                                <a href="https://asasijournal.com/index.php/starnas"
                                                    class="text-teal-700 hover:text-teal-900 underline font-medium text-lg transition-colors duration-300"
                                                    target="_blank" rel="noopener noreferrer">
                                                    Asasi Journal Submission System
                                                </a>
                                            </div>
                                        </div>

                                        <div class="flex items-start bg-white p-5 rounded-xl shadow-sm">
                                            <div
                                                class="flex-shrink-0 w-10 h-10 bg-gradient-to-br from-teal-600 to-emerald-600 rounded-full flex items-center justify-center text-white mr-4 shadow-md shadow-teal-500/20">
                                                <i class="fas fa-envelope"></i>
                                            </div>
                                            <div>
                                                <h4 class="font-bold text-teal-950 mb-2">Kontak untuk Pertanyaan</h4>
                                                <div class="space-y-2">
                                                    <p class="text-teal-800">Khalril Pahmi</p>
                                                    <a href="tel:087856779646"
                                                        class="text-teal-700 hover:text-teal-900 font-medium text-lg transition-colors duration-300">
                                                        <i class="fas fa-phone mr-2"></i>087856779646
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Download Section -->
                                <div class="mt-12 text-center pt-8 border-t border-gray-200">
                                    <p class="text-gray-600 mb-6 text-lg">Download template penulisan untuk memudahkan
                                        penyusunan naskah</p>
                                    <a href="/storage/Manuscript-Template.docx" download="Template Penulisan.docx"
                                        class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 text-white font-bold rounded-xl shadow-lg shadow-emerald-600/20 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 hover:scale-105">
                                        <i class="fas fa-download mr-3"></i>
                                        Download Template Penulisan
                                    </a>
                                    <p class="text-gray-500 text-sm mt-4">Format: Microsoft Word (.docx)</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('styles')
    <style>
        .content-padding {
            padding-top: 5rem;
        }

        .hero-image {
            height: 400px;
            object-fit: cover;
            width: 100%;
        }

        @media (max-width: 768px) {
            .hero-image {
                height: 250px;
            }
        }

        /* Custom animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in-up {
            animation: fadeInUp 0.6s ease-out forwards;
        }

        /* Stagger animation for guideline items */
        .guideline-item:nth-child(1) {
            animation-delay: 0.1s;
        }

        .guideline-item:nth-child(2) {
            animation-delay: 0.2s;
        }

        .guideline-item:nth-child(3) {
            animation-delay: 0.3s;
        }

        .guideline-item:nth-child(4) {
            animation-delay: 0.4s;
        }

        .guideline-item:nth-child(5) {
            animation-delay: 0.5s;
        }

        .guideline-item:nth-child(6) {
            animation-delay: 0.6s;
        }

        .guideline-item:nth-child(7) {
            animation-delay: 0.7s;
        }

        .guideline-item:nth-child(8) {
            animation-delay: 0.8s;
        }

        .guideline-item:nth-child(9) {
            animation-delay: 0.9s;
        }

        .guideline-item:nth-child(10) {
            animation-delay: 1.0s;
        }
    </style>
@endsection

@section('scripts')
    <script>
        // Add animation on scroll
        document.addEventListener('DOMContentLoaded', function () {
            const guidelineItems = document.querySelectorAll('.guideline-card');

            guidelineItems.forEach((item, index) => {
                item.classList.add('guideline-item');
                item.classList.add('animate-fade-in-up');
                item.style.opacity = '0';
            });

            // Simple intersection observer for animations
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                    }
                });
            }, observerOptions);

            guidelineItems.forEach(item => {
                observer.observe(item);
            });
        });
    </script>
@endsection