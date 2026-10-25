@extends('peserta.layouts.app')

@section('content')
    <!-- Main Content -->
    <div class="relative z-10 content-padding">
        <!-- Hero Image Section -->
        <section class="w-full relative overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-r from-slate-950/80 via-emerald-950/75 to-teal-950/80 z-10"></div>
            <img src="/storage/panduans.png" alt="Komite Konferensi" class="w-full h-64 md:h-96 object-cover">
            <div class="absolute inset-0 flex items-center justify-center z-20">
                <div class="text-center text-white px-4">
                    <h1 class="text-4xl md:text-5xl font-bold mb-4">Komite Konferensi</h1>
                    <p class="text-lg md:text-xl max-w-2xl mx-auto">Tim ahli dan profesional yang mendukung kesuksesan
                        penyelenggaraan Seminar Nasional dan Rakernas ASASI</p>
                </div>
            </div>
        </section>

        <!-- Komite Content -->
        <section class="py-16 bg-gradient-to-br from-gray-50 to-white">
            <div class="container mx-auto px-4 md:px-6">
                <div class="max-w-6xl mx-auto">
                    <!-- Content Card -->
                    <div
                        class="bg-white rounded-2xl shadow-xl overflow-hidden transform transition-all duration-500 hover:shadow-2xl">
                        <div class="p-8 md:p-12">
                            <!-- Header with decorative element -->
                            <div class="text-center mb-12 relative">
                                <div
                                    class="absolute -top-4 left-1/2 transform -translate-x-1/2 w-20 h-1 bg-gradient-to-r from-emerald-400 to-teal-400 rounded-full">
                                </div>
                                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Struktur Komite</h2>
                                <div class="w-32 h-1 bg-gradient-to-r from-emerald-500 to-teal-500 rounded-full mx-auto"></div>
                            </div>

                            <!-- Main Content -->
                            <div class="space-y-12">
                                <!-- Steering Committee -->
                                <div
                                    class="bg-gradient-to-br from-emerald-50/70 to-teal-50/50 rounded-2xl p-8 border border-emerald-200">
                                    <div class="text-center mb-8">
                                        <h3 class="text-2xl md:text-3xl font-bold text-emerald-950 mb-2">Penasehat</h3>
                                        <div
                                            class="w-24 h-1 bg-gradient-to-r from-emerald-500 to-teal-600 rounded-full mx-auto">
                                        </div>
                                        <p class="text-emerald-800 mt-4 max-w-2xl mx-auto">Para ahli dan senior yang memberikan arahan strategis untuk kesuksesan penyelenggaraan Seminar Nasional dan Rakernas ASASI</p>
                                    </div>

                                    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                                        <!-- Penasehat 1 -->
                                        <div
                                            class="bg-white rounded-xl p-6 shadow-md transform transition-all duration-300 hover:shadow-lg hover:-translate-y-1">
                                            <div class="text-center">
                                                <div
                                                    class="w-20 h-20 bg-gradient-to-br from-emerald-600 to-teal-600 rounded-full mx-auto mb-4 flex items-center justify-center text-white text-2xl font-bold">
                                                    P1
                                                </div>
                                                <h4 class="text-lg font-bold text-gray-900 mb-1">Prof. Ir. Mukhtasor, M.Eng.,Ph.D.</h4>
                                                <p class="text-emerald-700 font-medium mb-2">Penasehat</p>
                                            </div>
                                        </div>

                                        <!-- Penasehat 2 -->
                                        <div
                                            class="bg-white rounded-xl p-6 shadow-md transform transition-all duration-300 hover:shadow-lg hover:-translate-y-1">
                                            <div class="text-center">
                                                <div
                                                    class="w-20 h-20 bg-gradient-to-br from-teal-600 to-emerald-700 rounded-full mx-auto mb-4 flex items-center justify-center text-white text-2xl font-bold">
                                                    P2
                                                </div>
                                                <h4 class="text-lg font-bold text-gray-900 mb-1">Prof. Dr. Elfahmi, S.Si., M.Si.</h4>
                                                <p class="text-emerald-700 font-medium mb-2">Penasehat</p>
                                            </div>
                                        </div>

                                        <!-- Penasehat 3 -->
                                        <div
                                            class="bg-white rounded-xl p-6 shadow-md transform transition-all duration-300 hover:shadow-lg hover:-translate-y-1">
                                            <div class="text-center">
                                                <div
                                                    class="w-20 h-20 bg-gradient-to-br from-green-500 to-teal-600 rounded-full mx-auto mb-4 flex items-center justify-center text-white text-2xl font-bold">
                                                    P3
                                                </div>
                                                <h4 class="text-lg font-bold text-gray-900 mb-1">Prof. Dr. Sukro Muhab, M.Si</h4>
                                                <p class="text-emerald-700 font-medium mb-2">Penasehat</p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Additional Penasehat -->
                                    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 mt-6">
                                        <!-- Penasehat 4 -->
                                        <div
                                            class="bg-white rounded-xl p-6 shadow-md transform transition-all duration-300 hover:shadow-lg hover:-translate-y-1">
                                            <div class="text-center">
                                                <div
                                                    class="w-20 h-20 bg-gradient-to-br from-emerald-500 to-teal-700 rounded-full mx-auto mb-4 flex items-center justify-center text-white text-2xl font-bold">
                                                    P4
                                                </div>
                                                <h4 class="text-lg font-bold text-gray-900 mb-1">Ust Ahmad Muadz, M.Pdi</h4>
                                                <p class="text-emerald-700 font-medium mb-2">Penasehat</p>
                                            </div>
                                        </div>

                                        <!-- Penasehat 5 -->
                                        <div
                                            class="bg-white rounded-xl p-6 shadow-md transform transition-all duration-300 hover:shadow-lg hover:-translate-y-1">
                                            <div class="text-center">
                                                <div
                                                    class="w-20 h-20 bg-gradient-to-br from-teal-600 to-emerald-700 rounded-full mx-auto mb-4 flex items-center justify-center text-white text-2xl font-bold">
                                                    P5
                                                </div>
                                                <h4 class="text-lg font-bold text-gray-900 mb-1">Ir. Jamaluddin Malik, S. Hut, M.T., Ph.D, IPU</h4>
                                                <p class="text-emerald-700 font-medium mb-2">Penasehat</p>
                                            </div>
                                        </div>

                                        <!-- Penasehat 6 -->
                                        <div
                                            class="bg-white rounded-xl p-6 shadow-md transform transition-all duration-300 hover:shadow-lg hover:-translate-y-1">
                                            <div class="text-center">
                                                <div
                                                    class="w-20 h-20 bg-gradient-to-br from-emerald-600 to-teal-600 rounded-full mx-auto mb-4 flex items-center justify-center text-white text-2xl font-bold">
                                                    P6
                                                </div>
                                                <h4 class="text-lg font-bold text-gray-900 mb-1">Prof. Moh. Khairudin, Ph.D.</h4>
                                                <p class="text-emerald-700 font-medium mb-2">Penasehat</p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Additional Penasehat Row -->
                                    <div class="grid md:grid-cols-2 lg:grid-cols-2 gap-6 mt-6">
                                        <!-- Penasehat 7 -->
                                        <div
                                            class="bg-white rounded-xl p-6 shadow-md transform transition-all duration-300 hover:shadow-lg hover:-translate-y-1">
                                            <div class="text-center">
                                                <div
                                                    class="w-20 h-20 bg-gradient-to-br from-teal-500 to-green-600 rounded-full mx-auto mb-4 flex items-center justify-center text-white text-2xl font-bold">
                                                    P7
                                                </div>
                                                <h4 class="text-lg font-bold text-gray-900 mb-1">Dr. Mujidin, M.Si.</h4>
                                                <p class="text-emerald-700 font-medium mb-2">Penasehat</p>
                                            </div>
                                        </div>

                                        <!-- Penasehat 8 -->
                                        <div
                                            class="bg-white rounded-xl p-6 shadow-md transform transition-all duration-300 hover:shadow-lg hover:-translate-y-1">
                                            <div class="text-center">
                                                <div
                                                    class="w-20 h-20 bg-gradient-to-br from-emerald-600 to-teal-700 rounded-full mx-auto mb-4 flex items-center justify-center text-white text-2xl font-bold">
                                                    P8
                                                </div>
                                                <h4 class="text-lg font-bold text-gray-900 mb-1">Dr. Nurul Hidayat, S.pt., M.Kom.</h4>
                                                <p class="text-emerald-700 font-medium mb-2">Penasehat</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Organizing Committee -->
                                <div
                                    class="bg-gradient-to-br from-teal-50/70 to-emerald-50/50 rounded-2xl p-8 border border-teal-200">
                                    <div class="text-center mb-8">
                                        <h3 class="text-2xl md:text-3xl font-bold text-teal-950 mb-2">Panitia Inti</h3>
                                        <div
                                            class="w-24 h-1 bg-gradient-to-r from-teal-600 to-emerald-600 rounded-full mx-auto">
                                        </div>
                                        <p class="text-teal-800 mt-4 max-w-2xl mx-auto">Tim inti yang bertanggung jawab dalam pelaksanaan dan koordinasi keseluruhan kegiatan Seminar Nasional dan Rakernas ASASI</p>
                                    </div>

                                    <div class="space-y-6">
                                        <!-- Penanggung Jawab -->
                                        <div class="bg-white rounded-xl p-6 shadow-md">
                                            <div class="flex items-center">
                                                <div
                                                    class="flex-shrink-0 w-16 h-16 bg-gradient-to-br from-teal-600 to-emerald-600 rounded-full flex items-center justify-center text-white font-bold text-xl mr-4">
                                                    PJ
                                                </div>
                                                <div>
                                                    <h4 class="text-lg font-bold text-gray-900">Dr. rer.nat. Teti Zubaidah, ST.,MT.</h4>
                                                    <p class="text-teal-700 font-medium">Penanggung Jawab</p>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Ketua Panitia -->
                                        <div class="bg-white rounded-xl p-6 shadow-md">
                                            <div class="flex items-center">
                                                <div
                                                    class="flex-shrink-0 w-16 h-16 bg-gradient-to-br from-teal-600 to-emerald-600 rounded-full flex items-center justify-center text-white font-bold text-xl mr-4">
                                                    KP
                                                </div>
                                                <div>
                                                    <h4 class="text-lg font-bold text-gray-900">Soni Ariawan, M.Ed.</h4>
                                                    <p class="text-teal-700 font-medium">Ketua Panitia</p>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Bendahara -->
                                        <div class="grid md:grid-cols-2 gap-6">
                                            <div class="bg-white rounded-xl p-5 shadow-sm">
                                                <div class="flex items-center">
                                                    <div
                                                        class="flex-shrink-0 w-14 h-14 bg-gradient-to-br from-teal-500 to-emerald-600 rounded-full flex items-center justify-center text-white font-bold text-lg mr-3">
                                                        B1
                                                    </div>
                                                    <div>
                                                        <h4 class="font-bold text-gray-900">Ns. Erniawati Pujningsih, M.Kes.</h4>
                                                        <p class="text-teal-700 text-sm">Bendahara</p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="bg-white rounded-xl p-5 shadow-sm">
                                                <div class="flex items-center">
                                                    <div
                                                        class="flex-shrink-0 w-14 h-14 bg-gradient-to-br from-teal-500 to-emerald-600 rounded-full flex items-center justify-center text-white font-bold text-lg mr-3">
                                                        B2
                                                    </div>
                                                    <div>
                                                        <h4 class="font-bold text-gray-900">Dian Yustitia, M.Sc.</h4>
                                                        <p class="text-teal-700 text-sm">Bendahara</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Divisi Acara -->
                                <div
                                    class="bg-gradient-to-br from-green-50 to-teal-50 rounded-2xl p-8 border border-green-200">
                                    <div class="text-center mb-8">
                                        <h3 class="text-2xl md:text-3xl font-bold text-green-900 mb-2">Sie. Acara</h3>
                                        <div
                                            class="w-24 h-1 bg-gradient-to-r from-green-500 to-teal-600 rounded-full mx-auto">
                                        </div>
                                        <p class="text-green-700 mt-4 max-w-2xl mx-auto">Tim yang bertanggung jawab dalam perencanaan dan pelaksanaan seluruh rangkaian acara Seminar Nasional dan Rakernas</p>
                                    </div>

                                    <div class="grid md:grid-cols-2 lg:grid-cols-2 gap-6">
                                        <!-- Sie Acara 1 -->
                                        <div
                                            class="bg-white rounded-xl p-5 shadow-sm transform transition-all duration-300 hover:shadow-md">
                                            <div class="text-center">
                                                <div
                                                    class="w-16 h-16 bg-gradient-to-br from-green-500 to-emerald-600 rounded-full mx-auto mb-3 flex items-center justify-center text-white font-bold">
                                                    A1
                                                </div>
                                                <h4 class="text-md font-bold text-gray-900 mb-1">Khairil Pahmi, S.Si., M.Sc.</h4>
                                                <p class="text-green-600 text-sm mb-2">Sie. Acara</p>
                                            </div>
                                        </div>

                                        <!-- Sie Acara 2 -->
                                        <div
                                            class="bg-white rounded-xl p-5 shadow-sm transform transition-all duration-300 hover:shadow-md">
                                            <div class="text-center">
                                                <div
                                                    class="w-16 h-16 bg-gradient-to-br from-green-500 to-emerald-600 rounded-full mx-auto mb-3 flex items-center justify-center text-white font-bold">
                                                    A2
                                                </div>
                                                <h4 class="text-md font-bold text-gray-900 mb-1">Aisah Jamili, SP. M.Si</h4>
                                                <p class="text-green-600 text-sm mb-2">Sie. Acara</p>
                                            </div>
                                        </div>

                                        <!-- Sie Acara 3 -->
                                        <div
                                            class="bg-white rounded-xl p-5 shadow-sm transform transition-all duration-300 hover:shadow-md">
                                            <div class="text-center">
                                                <div
                                                    class="w-16 h-16 bg-gradient-to-br from-green-500 to-emerald-600 rounded-full mx-auto mb-3 flex items-center justify-center text-white font-bold">
                                                    A3
                                                </div>
                                                <h4 class="text-md font-bold text-gray-900 mb-1">Zaenafi Ariani, S. E., M. E</h4>
                                                <p class="text-green-600 text-sm mb-2">Sie. Acara</p>
                                            </div>
                                        </div>

                                        <!-- Sie Acara 4 -->
                                        <div
                                            class="bg-white rounded-xl p-5 shadow-sm transform transition-all duration-300 hover:shadow-md">
                                            <div class="text-center">
                                                <div
                                                    class="w-16 h-16 bg-gradient-to-br from-green-500 to-emerald-600 rounded-full mx-auto mb-3 flex items-center justify-center text-white font-bold">
                                                    A4
                                                </div>
                                                <h4 class="text-md font-bold text-gray-900 mb-1">Dr. Ria Saputri, M.Pd.</h4>
                                                <p class="text-green-600 text-sm mb-2">Sie. Acara</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Divisi Humas dan Kerjasama -->
                                <div
                                    class="bg-gradient-to-br from-orange-50 to-red-50 rounded-2xl p-8 border border-orange-200">
                                    <div class="text-center mb-8">
                                        <h3 class="text-2xl md:text-3xl font-bold text-orange-900 mb-2">Sie. Humas dan Kerjasama</h3>
                                        <div
                                            class="w-24 h-1 bg-gradient-to-r from-orange-500 to-red-600 rounded-full mx-auto">
                                        </div>
                                        <p class="text-orange-700 mt-4 max-w-2xl mx-auto">Tim yang bertanggung jawab dalam hubungan masyarakat, kerjasama, dan komunikasi eksternal</p>
                                    </div>

                                    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                                        <!-- Humas 1 -->
                                        <div class="bg-white rounded-xl p-6 shadow-md">
                                            <div class="text-center">
                                                <div
                                                    class="w-20 h-20 bg-gradient-to-br from-orange-500 to-red-600 rounded-full mx-auto mb-4 flex items-center justify-center text-white text-2xl font-bold">
                                                    H1
                                                </div>
                                                <h4 class="text-lg font-bold text-gray-900 mb-1">Muhamad Bai'ul Hak, S.E., M.App.Ec</h4>
                                                <p class="text-orange-600 font-medium mb-2">Sie. Humas dan Kerjasama</p>
                                            </div>
                                        </div>

                                        <!-- Humas 2 -->
                                        <div class="bg-white rounded-xl p-6 shadow-md">
                                            <div class="text-center">
                                                <div
                                                    class="w-20 h-20 bg-gradient-to-br from-orange-500 to-red-600 rounded-full mx-auto mb-4 flex items-center justify-center text-white text-2xl font-bold">
                                                    H2
                                                </div>
                                                <h4 class="text-lg font-bold text-gray-900 mb-1">Titi Andriani, S.T., M.T.</h4>
                                                <p class="text-orange-600 font-medium mb-2">Sie. Humas dan Kerjasama</p>
                                            </div>
                                        </div>

                                        <!-- Humas 3 -->
                                        <div class="bg-white rounded-xl p-6 shadow-md">
                                            <div class="text-center">
                                                <div
                                                    class="w-20 h-20 bg-gradient-to-br from-orange-500 to-red-600 rounded-full mx-auto mb-4 flex items-center justify-center text-white text-2xl font-bold">
                                                    H3
                                                </div>
                                                <h4 class="text-lg font-bold text-gray-900 mb-1">Farah Heniati Santosa, M.Pd.</h4>
                                                <p class="text-orange-600 font-medium mb-2">Sie. Humas dan Kerjasama</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Divisi Kesekretariatan dan Dokumentasi -->
                                <div
                                    class="bg-gradient-to-br from-emerald-50/70 to-teal-50/50 rounded-2xl p-8 border border-emerald-200">
                                    <div class="text-center mb-8">
                                        <h3 class="text-2xl md:text-3xl font-bold text-emerald-950 mb-2">Sie. Kesekretariatan dan Dokumentasi</h3>
                                        <div
                                            class="w-24 h-1 bg-gradient-to-r from-emerald-500 to-teal-600 rounded-full mx-auto">
                                        </div>
                                        <p class="text-emerald-800 mt-4 max-w-2xl mx-auto">Tim yang bertanggung jawab dalam administrasi, kesekretariatan, dan dokumentasi kegiatan</p>
                                    </div>

                                    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                                        <!-- Sekretariat 1 -->
                                        <div class="bg-white rounded-xl p-6 shadow-md">
                                            <div class="text-center">
                                                <div
                                                    class="w-20 h-20 bg-gradient-to-br from-emerald-600 to-teal-600 rounded-full mx-auto mb-4 flex items-center justify-center text-white text-2xl font-bold">
                                                    S1
                                                </div>
                                                <h4 class="text-lg font-bold text-gray-900 mb-1">Pahmi Husain, M.Sc.</h4>
                                                <p class="text-emerald-700 font-medium mb-2">Sie. Kesekretariatan dan Dokumentasi</p>
                                            </div>
                                        </div>

                                        <!-- Sekretariat 2 -->
                                        <div class="bg-white rounded-xl p-6 shadow-md">
                                            <div class="text-center">
                                                <div
                                                    class="w-20 h-20 bg-gradient-to-br from-emerald-600 to-teal-600 rounded-full mx-auto mb-4 flex items-center justify-center text-white text-2xl font-bold">
                                                    S2
                                                </div>
                                                <h4 class="text-lg font-bold text-gray-900 mb-1">Dr. Dian Syafitri Chani Saputri, S.T., MDigMMedia</h4>
                                                <p class="text-emerald-700 font-medium mb-2">Sie. Kesekretariatan dan Dokumentasi</p>
                                            </div>
                                        </div>

                                        <!-- Sekretariat 3 -->
                                        <div class="bg-white rounded-xl p-6 shadow-md">
                                            <div class="text-center">
                                                <div
                                                    class="w-20 h-20 bg-gradient-to-br from-emerald-600 to-teal-600 rounded-full mx-auto mb-4 flex items-center justify-center text-white text-2xl font-bold">
                                                    S3
                                                </div>
                                                <h4 class="text-lg font-bold text-gray-900 mb-1">Anna Layla Salfarina, M.Sc</h4>
                                                <p class="text-emerald-700 font-medium mb-2">Sie. Kesekretariatan dan Dokumentasi</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Divisi Akomodasi, Transportasi dan Konsumsi -->
                                <div
                                    class="bg-gradient-to-br from-teal-50 to-emerald-50/50 rounded-2xl p-8 border border-teal-200">
                                    <div class="text-center mb-8">
                                        <h3 class="text-2xl md:text-3xl font-bold text-teal-950 mb-2">Sie. Akomodasi, Transportasi dan Konsumsi</h3>
                                        <div
                                            class="w-24 h-1 bg-gradient-to-r from-teal-600 to-emerald-600 rounded-full mx-auto">
                                        </div>
                                        <p class="text-teal-800 mt-4 max-w-2xl mx-auto">Tim yang bertanggung jawab dalam pengaturan akomodasi, transportasi, dan konsumsi selama kegiatan berlangsung</p>
                                    </div>

                                    <div class="grid md:grid-cols-2 lg:grid-cols-2 gap-6">
                                        <!-- ATK 1 -->
                                        <div class="bg-white rounded-xl p-6 shadow-md">
                                            <div class="text-center">
                                                <div
                                                    class="w-20 h-20 bg-gradient-to-br from-teal-600 to-emerald-600 rounded-full mx-auto mb-4 flex items-center justify-center text-white text-2xl font-bold">
                                                    ATK1
                                                </div>
                                                <h4 class="text-lg font-bold text-gray-900 mb-1">Cipta Ramadhani, ST.,M.Eng</h4>
                                                <p class="text-teal-700 font-medium mb-2">Sie. Akomodasi, Transportasi dan Konsumsi</p>
                                            </div>
                                        </div>

                                        <!-- ATK 2 -->
                                        <div class="bg-white rounded-xl p-6 shadow-md">
                                            <div class="text-center">
                                                <div
                                                    class="w-20 h-20 bg-gradient-to-br from-teal-600 to-emerald-600 rounded-full mx-auto mb-4 flex items-center justify-center text-white text-2xl font-bold">
                                                    ATK2
                                                </div>
                                                <h4 class="text-lg font-bold text-gray-900 mb-1">Muh. Azhar Kholidi, M.Ed TESL</h4>
                                                <p class="text-teal-700 font-medium mb-2">Sie. Akomodasi, Transportasi dan Konsumsi</p>
                                            </div>
                                        </div>

                                        <!-- ATK 3 -->
                                        <div class="bg-white rounded-xl p-6 shadow-md">
                                            <div class="text-center">
                                                <div
                                                    class="w-20 h-20 bg-gradient-to-br from-teal-600 to-emerald-600 rounded-full mx-auto mb-4 flex items-center justify-center text-white text-2xl font-bold">
                                                    ATK3
                                                </div>
                                                <h4 class="text-lg font-bold text-gray-900 mb-1">Dr. Johri Sabaryati, M.Pfis</h4>
                                                <p class="text-teal-700 font-medium mb-2">Sie. Akomodasi, Transportasi dan Konsumsi</p>
                                            </div>
                                        </div>

                                        <!-- ATK 4 -->
                                        <div class="bg-white rounded-xl p-6 shadow-md">
                                            <div class="text-center">
                                                <div
                                                    class="w-20 h-20 bg-gradient-to-br from-teal-600 to-emerald-600 rounded-full mx-auto mb-4 flex items-center justify-center text-white text-2xl font-bold">
                                                    ATK4
                                                </div>
                                                <h4 class="text-lg font-bold text-gray-900 mb-1">Leny Fitriah, M.Pd</h4>
                                                <p class="text-teal-700 font-medium mb-2">Sie. Akomodasi, Transportasi dan Konsumsi</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Contact Information -->
                            <div
                                class="mt-12 p-8 bg-gradient-to-br from-gray-50 to-emerald-50/40 rounded-2xl border border-emerald-100">
                                <h3 class="text-2xl font-bold text-gray-900 mb-6 text-center">Kontak Panitia</h3>
                                <div class="grid md:grid-cols-2 gap-8">
                                    <div class="text-center">
                                        <div
                                            class="w-16 h-16 bg-gradient-to-br from-emerald-500 to-teal-600 rounded-full flex items-center justify-center text-white mx-auto mb-4">
                                            <i class="fas fa-envelope text-2xl"></i>
                                        </div>
                                        <h4 class="font-bold text-gray-900 mb-2">Email</h4>
                                        <a href="mailto:asasintb23@gmail.com"
                                            class="text-emerald-700 hover:text-emerald-800 font-medium transition-colors">
                                            asasintb23@gmail.com
                                        </a>
                                    </div>
                                    <div class="text-center">
                                        <div
                                            class="w-16 h-16 bg-gradient-to-br from-green-500 to-teal-600 rounded-full flex items-center justify-center text-white mx-auto mb-4">
                                            <i class="fas fa-phone text-2xl"></i>
                                        </div>
                                        <h4 class="font-bold text-gray-900 mb-2">Telepon</h4>
                                        <a href="tel:087859027498"
                                            class="text-green-600 hover:text-green-800 transition-colors">
                                            087859027498
                                        </a>
                                    </div>
                                </div>
                                <div class="mt-8 text-center">
                                    <p class="text-gray-600">Untuk informasi lebih lanjut mengenai Seminar Nasional dan Rakernas ASASI, silakan hubungi panitia melalui kontak di atas.</p>
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

        /* Animation for committee cards */
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

        .committee-section {
            animation: fadeInUp 0.6s ease-out forwards;
        }
    </style>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Add animation to committee sections
            const sections = document.querySelectorAll('.bg-gradient-to-br');
            sections.forEach((section, index) => {
                section.classList.add('committee-section');
                section.style.opacity = '0';
                section.style.animationDelay = `${index * 0.2}s`;
            });

            // Intersection Observer for animations
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                    }
                });
            }, {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            });

            sections.forEach(section => {
                observer.observe(section);
            });
        });
    </script>
@endsection