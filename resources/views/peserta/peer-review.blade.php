@extends('peserta.layouts.app')

@section('content')
    <!-- Main Content -->
    <div class="relative z-10 content-padding">
        <!-- Hero Image Section -->
        <section class="w-full relative overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-r from-green-900/70 to-emerald-800/70 z-10"></div>
            <img src="/storage/panduans.png" alt="Peer Review" class="w-full h-64 md:h-96 object-cover">
            <div class="absolute inset-0 flex items-center justify-center z-20">
                <div class="text-center text-white px-4">
                    <h1 class="text-4xl md:text-5xl font-bold mb-4">Peer Review</h1>
                    <p class="text-lg md:text-xl max-w-2xl mx-auto">Proses penilaian berkualitas tinggi untuk memastikan
                        kualitas akademik terbaik</p>
                </div>
            </div>
        </section>

        <!-- Peer Review Content -->
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
                                    class="absolute -top-4 left-1/2 transform -translate-x-1/2 w-20 h-1 bg-gradient-to-r from-green-400 to-emerald-500 rounded-full">
                                </div>
                                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Proses Peer Review</h2>
                                <div class="w-32 h-1 bg-gradient-to-r from-green-500 to-emerald-500 rounded-full mx-auto">
                                </div>
                            </div>

                            <!-- Main Content -->
                            <div class="space-y-8">
                                <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed">
                                    <p class="text-lg">
                                        Semua artikel yang memenuhi pedoman pengiriman akan ditinjau oleh rekan sejawat dan
                                        dinilai berdasarkan orisinalitas, konten/kedalaman teknis dan/atau penelitian, topik
                                        minat, relevansi konferensi, kontribusi, dan keterbacaan. Penerimaan artikel akan
                                        diinformasikan kepada penulis melalui email. Penulis artikel yang diterima akan
                                        dapat
                                        membuat perubahan berdasarkan saran peninjau dan mengirimkan artikel versi akhir
                                        yang
                                        siap untuk disajikan pada tenggat waktu yang disyaratkan.
                                    </p>

                                    <p class="text-lg">
                                        Setiap manuskrip yang dikirimkan akan ditinjau secara independent oleh setidaknya
                                        dua
                                        (2) peninjau dengan keahlian di bidang subjek yang relevan dalam proses peer-review
                                        double-blind.
                                    </p>
                                </div>

                                <!-- Process Timeline -->
                                <div class="mt-12 pt-8 border-t border-gray-200">
                                    <h3 class="text-2xl font-bold text-gray-900 mb-8 text-center">Tahapan Peer Review</h3>
                                    <div class="space-y-8 relative">
                                        <!-- Timeline connector line -->
                                        <div
                                            class="absolute left-4 top-0 bottom-0 w-0.5 bg-gradient-to-b from-green-400 to-emerald-500 z-0">
                                        </div>

                                        <!-- Timeline items -->
                                        <div class="flex items-start relative z-10">
                                            <div
                                                class="flex-shrink-0 w-8 h-8 bg-gradient-to-br from-green-500 to-emerald-600 rounded-full flex items-center justify-center text-white font-bold mr-6 mt-1 shadow-lg">
                                                1
                                            </div>
                                            <div
                                                class="bg-gray-50 p-5 rounded-xl border border-gray-100 flex-1 transform transition-all duration-300 hover:shadow-md">
                                                <h4 class="text-xl font-semibold text-gray-900 mb-2">Submission & Initial
                                                    Screening</h4>
                                                <p class="text-gray-700">Naskah diperiksa kelengkapan administrasi dan
                                                    kesesuaian dengan scope konferensi</p>
                                            </div>
                                        </div>

                                        <div class="flex items-start relative z-10">
                                            <div
                                                class="flex-shrink-0 w-8 h-8 bg-gradient-to-br from-green-500 to-emerald-600 rounded-full flex items-center justify-center text-white font-bold mr-6 mt-1 shadow-lg">
                                                2
                                            </div>
                                            <div
                                                class="bg-gray-50 p-5 rounded-xl border border-gray-100 flex-1 transform transition-all duration-300 hover:shadow-md">
                                                <h4 class="text-xl font-semibold text-gray-900 mb-2">Assignment to Reviewers
                                                </h4>
                                                <p class="text-gray-700">Naskah dialokasikan kepada minimal 2 reviewer yang
                                                    kompeten di bidangnya</p>
                                            </div>
                                        </div>

                                        <div class="flex items-start relative z-10">
                                            <div
                                                class="flex-shrink-0 w-8 h-8 bg-gradient-to-br from-green-500 to-emerald-600 rounded-full flex items-center justify-center text-white font-bold mr-6 mt-1 shadow-lg">
                                                3
                                            </div>
                                            <div
                                                class="bg-gray-50 p-5 rounded-xl border border-gray-100 flex-1 transform transition-all duration-300 hover:shadow-md">
                                                <h4 class="text-xl font-semibold text-gray-900 mb-2">Double-Blind Review
                                                </h4>
                                                <p class="text-gray-700">Proses review dimana identitas penulis dan reviewer
                                                    dirahasiakan</p>
                                            </div>
                                        </div>

                                        <div class="flex items-start relative z-10">
                                            <div
                                                class="flex-shrink-0 w-8 h-8 bg-gradient-to-br from-green-500 to-emerald-600 rounded-full flex items-center justify-center text-white font-bold mr-6 mt-1 shadow-lg">
                                                4
                                            </div>
                                            <div
                                                class="bg-gray-50 p-5 rounded-xl border border-gray-100 flex-1 transform transition-all duration-300 hover:shadow-md">
                                                <h4 class="text-xl font-semibold text-gray-900 mb-2">Decision & Notification
                                                </h4>
                                                <p class="text-gray-700">Keputusan diterima/ditolak/direvisi dikomunikasikan
                                                    kepada penulis</p>
                                            </div>
                                        </div>

                                        <div class="flex items-start relative z-10">
                                            <div
                                                class="flex-shrink-0 w-8 h-8 bg-gradient-to-br from-green-500 to-emerald-600 rounded-full flex items-center justify-center text-white font-bold mr-6 mt-1 shadow-lg">
                                                5
                                            </div>
                                            <div
                                                class="bg-gray-50 p-5 rounded-xl border border-gray-100 flex-1 transform transition-all duration-300 hover:shadow-md">
                                                <h4 class="text-xl font-semibold text-gray-900 mb-2">Revision & Final
                                                    Submission</h4>
                                                <p class="text-gray-700">Penulis merevisi naskah berdasarkan masukan
                                                    reviewer dan mengirimkan versi final</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Review Criteria -->
                                <div
                                    class="mt-12 p-8 bg-gradient-to-br from-green-50 to-emerald-50 rounded-2xl border border-green-200 shadow-sm">
                                    <h3 class="text-2xl font-bold text-green-900 mb-6 text-center">Kriteria Penilaian</h3>
                                    <div class="grid md:grid-cols-2 gap-6">
                                        <div
                                            class="flex items-start bg-white p-4 rounded-xl shadow-sm transform transition-all duration-300 hover:shadow-md hover:-translate-y-1">
                                            <div
                                                class="flex-shrink-0 w-10 h-10 bg-gradient-to-br from-green-500 to-emerald-600 rounded-full flex items-center justify-center text-white mr-4 mt-1">
                                                <i class="fas fa-lightbulb"></i>
                                            </div>
                                            <div>
                                                <h4 class="font-bold text-green-800 text-lg">Orisinalitas</h4>
                                                <p class="text-green-700">Kebaruan dan kontribusi penelitian</p>
                                            </div>
                                        </div>
                                        <div
                                            class="flex items-start bg-white p-4 rounded-xl shadow-sm transform transition-all duration-300 hover:shadow-md hover:-translate-y-1">
                                            <div
                                                class="flex-shrink-0 w-10 h-10 bg-gradient-to-br from-green-500 to-emerald-600 rounded-full flex items-center justify-center text-white mr-4 mt-1">
                                                <i class="fas fa-chart-line"></i>
                                            </div>
                                            <div>
                                                <h4 class="font-bold text-green-800 text-lg">Kedalaman Teknis</h4>
                                                <p class="text-green-700">Kualitas metodologi dan analisis</p>
                                            </div>
                                        </div>
                                        <div
                                            class="flex items-start bg-white p-4 rounded-xl shadow-sm transform transition-all duration-300 hover:shadow-md hover:-translate-y-1">
                                            <div
                                                class="flex-shrink-0 w-10 h-10 bg-gradient-to-br from-green-500 to-emerald-600 rounded-full flex items-center justify-center text-white mr-4 mt-1">
                                                <i class="fas fa-link"></i>
                                            </div>
                                            <div>
                                                <h4 class="font-bold text-green-800 text-lg">Relevansi</h4>
                                                <p class="text-green-700">Kesesuaian dengan tema konferensi</p>
                                            </div>
                                        </div>
                                        <div
                                            class="flex items-start bg-white p-4 rounded-xl shadow-sm transform transition-all duration-300 hover:shadow-md hover:-translate-y-1">
                                            <div
                                                class="flex-shrink-0 w-10 h-10 bg-gradient-to-br from-green-500 to-emerald-600 rounded-full flex items-center justify-center text-white mr-4 mt-1">
                                                <i class="fas fa-book-reader"></i>
                                            </div>
                                            <div>
                                                <h4 class="font-bold text-green-800 text-lg">Keterbacaan</h4>
                                                <p class="text-green-700">Kejelasan penyajian dan bahasa</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Additional Information -->
                                <div
                                    class="mt-8 p-8 bg-gradient-to-br from-emerald-50/70 to-teal-50/50 rounded-2xl border border-emerald-200 shadow-sm">
                                    <h3 class="text-2xl font-bold text-emerald-950 mb-6 text-center">Informasi Penting</h3>
                                    <div class="grid md:grid-cols-2 gap-6">
                                        <div class="flex items-center bg-white p-4 rounded-xl shadow-sm">
                                            <div
                                                class="flex-shrink-0 w-10 h-10 bg-gradient-to-br from-emerald-500 to-teal-600 rounded-full flex items-center justify-center text-white mr-4 shadow-md shadow-emerald-500/20">
                                                <i class="fas fa-clock"></i>
                                            </div>
                                            <div>
                                                <h4 class="font-semibold text-emerald-950">Lama Proses</h4>
                                                <p class="text-emerald-800">2-4 minggu</p>
                                            </div>
                                        </div>
                                        <div class="flex items-center bg-white p-4 rounded-xl shadow-sm">
                                            <div
                                                class="flex-shrink-0 w-10 h-10 bg-gradient-to-br from-emerald-500 to-teal-600 rounded-full flex items-center justify-center text-white mr-4 shadow-md shadow-emerald-500/20">
                                                <i class="fas fa-check-circle"></i>
                                            </div>
                                            <div>
                                                <h4 class="font-semibold text-emerald-950">Sistem</h4>
                                                <p class="text-emerald-800">Double-Blind Peer Review</p>
                                            </div>
                                        </div>
                                        <div class="flex items-center bg-white p-4 rounded-xl shadow-sm">
                                            <div
                                                class="flex-shrink-0 w-10 h-10 bg-gradient-to-br from-emerald-500 to-teal-600 rounded-full flex items-center justify-center text-white mr-4 shadow-md shadow-emerald-500/20">
                                                <i class="fas fa-user-friends"></i>
                                            </div>
                                            <div>
                                                <h4 class="font-semibold text-emerald-950">Jumlah Reviewer</h4>
                                                <p class="text-emerald-800">Minimal 2 orang per naskah</p>
                                            </div>
                                        </div>
                                        <div class="flex items-center bg-white p-4 rounded-xl shadow-sm">
                                            <div
                                                class="flex-shrink-0 w-10 h-10 bg-gradient-to-br from-emerald-500 to-teal-600 rounded-full flex items-center justify-center text-white mr-4 shadow-md shadow-emerald-500/20">
                                                <i class="fas fa-envelope"></i>
                                            </div>
                                            <div>
                                                <h4 class="font-semibold text-emerald-950">Notifikasi Hasil</h4>
                                                <p class="text-emerald-800">Melalui email dan sistem</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Contact Information -->
                                <div class="mt-12 text-center pt-8 border-t border-gray-200">
                                    <p class="text-gray-600 mb-6 text-lg">Pertanyaan mengenai proses peer review?</p>
                                    <a href="mailto:peer-review@starnas2025.id"
                                        class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-green-500 to-emerald-600 text-white font-bold rounded-xl hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 hover:scale-105">
                                        <i class="fas fa-envelope mr-3"></i>
                                        Hubungi Tim Review
                                    </a>
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

        /* Stagger animation for timeline items */
        .timeline-item:nth-child(1) {
            animation-delay: 0.1s;
        }

        .timeline-item:nth-child(2) {
            animation-delay: 0.2s;
        }

        .timeline-item:nth-child(3) {
            animation-delay: 0.3s;
        }

        .timeline-item:nth-child(4) {
            animation-delay: 0.4s;
        }

        .timeline-item:nth-child(5) {
            animation-delay: 0.5s;
        }
    </style>
@endsection

@section('scripts')
    <script>
        // Add animation on scroll
        document.addEventListener('DOMContentLoaded', function () {
            const timelineItems = document.querySelectorAll('.flex.items-start.relative.z-10');

            timelineItems.forEach((item, index) => {
                item.classList.add('timeline-item');
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

            timelineItems.forEach(item => {
                observer.observe(item);
            });
        });
    </script>
@endsection