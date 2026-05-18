

<?php $__env->startSection('content'); ?>
<div class="min-h-screen bg-gray-100 py-6">
    <div class="max-w-4xl mx-auto px-4">
        <div class="mb-4">
            <a href="<?php echo e(request()->route()->getName() === 'profile.edit' ? route('profile.show') : route('home')); ?>" class="inline-flex items-center px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition">
                <i class="fas fa-arrow-left mr-2"></i><?php echo e(request()->route()->getName() === 'profile.edit' ? 'Kembali ke Profil' : 'Kembali ke Home'); ?>

            </a>
        </div>

        <div class="bg-white rounded-lg shadow-lg overflow-hidden mb-6">
            <div class="h-32 bg-gradient-to-r from-blue-500 to-orange-500"></div>
            <div class="px-6 pb-6">
                <div class="flex flex-col items-center -mt-20 relative z-10 mb-6">
 
                    <?php if(request()->route()->getName() === 'profile.edit'): ?>
                        <div class="relative group">
                            <?php if(auth()->user()->photo): ?>
                                <img src="<?php echo e(asset('storage/' . auth()->user()->photo)); ?>" alt="Profile Photo" class="w-32 h-32 rounded-full border-4 border-white shadow-lg object-cover">
                            <?php else: ?>
                                <div class="w-32 h-32 rounded-full bg-gradient-to-br from-blue-400 to-orange-400 flex items-center justify-center border-4 border-white shadow-lg">
                                    <span class="text-4xl font-bold text-white">
                                        <?php echo e(strtoupper(substr(auth()->user()->name, 0, 1)) . strtoupper(substr(explode(' ', auth()->user()->name)[1] ?? '', 0, 1))); ?>

                                    </span>
                                </div>
                            <?php endif; ?>

                                    <label for="photoInput" class="absolute inset-0 rounded-full bg-black bg-opacity-50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition cursor-pointer">
                                        <div class="text-center">
                                            <i class="fas fa-camera text-white text-2xl mb-1 block"></i>
                                            <span class="text-white text-xs font-semibold">Ubah Foto</span>
                                        </div>
                                    </label>
                        </div>
                    <?php else: ?>
                        <div class="w-32 h-32 rounded-full bg-gradient-to-br from-blue-400 to-orange-400 flex items-center justify-center border-4 border-white shadow-lg overflow-hidden">
                            <?php if(auth()->user()->photo): ?>
                                <img src="<?php echo e(asset('storage/' . auth()->user()->photo)); ?>" alt="Profile Photo" class="w-full h-full object-cover">
                            <?php else: ?>
                                <span class="text-4xl font-bold text-white">
                                    <?php echo e(strtoupper(substr(auth()->user()->name, 0, 1)) . strtoupper(substr(explode(' ', auth()->user()->name)[1] ?? '', 0, 1))); ?>

                                </span>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>

                    <h1 class="text-2xl font-bold text-gray-800 text-center mt-4"><?php echo e(auth()->user()->name); ?></h1>
                    <p class="text-gray-600 text-sm"><?php echo e(auth()->user()->nim); ?></p>
                </div>

                <?php if(request()->route()->getName() === 'profile.show'): ?>
                    <div class="flex justify-center mb-6">
                        <a href="<?php echo e(route('profile.edit')); ?>" class="inline-flex items-center px-6 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition">
                            <i class="fas fa-edit mr-2"></i>Edit Profil
                        </a>
                    </div>
                <?php endif; ?>

                <?php if($message = session('success')): ?>
                    <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                        <i class="fas fa-check-circle mr-2"></i><?php echo e($message); ?>

                    </div>
                <?php endif; ?>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-lg p-8">
            <?php if(request()->route()->getName() === 'profile.edit'): ?>
                <form id="profileForm" action="<?php echo e(route('profile.update')); ?>" method="POST" enctype="multipart/form-data" class="space-y-8">
                    <?php echo csrf_field(); ?>
                    <input type="file" id="photoInput" name="photo" accept="image/*" class="hidden" onchange="previewPhoto(this)">
            <?php endif; ?>

            <div>
                <h2 class="text-xl font-bold text-gray-800 mb-4 pb-2 border-b-2 border-blue-500">
                    <i class="fas fa-graduation-cap text-blue-500 mr-2"></i>Data Akademik
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nomor Induk Mahasiswa (NIM)</label>
                        <input type="text" readonly value="<?php echo e(auth()->user()->nim); ?>" class="w-full px-4 py-2 bg-gray-100 border border-gray-300 rounded-lg text-gray-600">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Program Studi</label>
                        <input type="text" readonly value="<?php echo e(auth()->user()->prodi); ?>" class="w-full px-4 py-2 bg-gray-100 border border-gray-300 rounded-lg text-gray-600">
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                        <?php if(request()->route()->getName() === 'profile.edit'): ?>
                            <input type="text" name="name" value="<?php echo e(auth()->user()->name); ?>" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                            <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-500 text-sm"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        <?php else: ?>
                            <input type="text" readonly value="<?php echo e(auth()->user()->name); ?>" class="w-full px-4 py-2 bg-gray-100 border border-gray-300 rounded-lg text-gray-600">
                        <?php endif; ?>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Angkatan</label>
                        <input type="text" readonly value="<?php echo e(auth()->user()->angkatan); ?>" class="w-full px-4 py-2 bg-gray-100 border border-gray-300 rounded-lg text-gray-600">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Semester</label>
                        <input type="text" readonly value="<?php echo e(auth()->user()->semester ?? '-'); ?>" class="w-full px-4 py-2 bg-gray-100 border border-gray-300 rounded-lg text-gray-600">
                    </div>
                </div>
            </div>

            <div>
                <h2 class="text-xl font-bold text-gray-800 mb-4 pb-2 border-b-2 border-blue-500">
                    <i class="fas fa-phone text-blue-500 mr-2"></i>Informasi Kontak
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                        <?php if(request()->route()->getName() === 'profile.edit'): ?>
                            <input type="email" name="email" value="<?php echo e(auth()->user()->email); ?>" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                            <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-500 text-sm"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        <?php else: ?>
                            <input type="email" readonly value="<?php echo e(auth()->user()->email); ?>" class="w-full px-4 py-2 bg-gray-100 border border-gray-300 rounded-lg text-gray-600">
                        <?php endif; ?>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nomor Telepon</label>
                        <?php if(request()->route()->getName() === 'profile.edit'): ?>
                            <input type="tel" name="phone" value="<?php echo e(auth()->user()->phone); ?>" placeholder="08..." class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                            <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-500 text-sm"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        <?php else: ?>
                            <input type="tel" readonly value="<?php echo e(auth()->user()->phone ?? '-'); ?>" class="w-full px-4 py-2 bg-gray-100 border border-gray-300 rounded-lg text-gray-600">
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div>
                <h2 class="text-xl font-bold text-gray-800 mb-4 pb-2 border-b-2 border-blue-500">
                    <i class="fas fa-user text-blue-500 mr-2"></i>Data Pribadi
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tempat Lahir</label>
                        <?php if(request()->route()->getName() === 'profile.edit'): ?>
                            <input type="text" name="tempat_lahir" value="<?php echo e(auth()->user()->tempat_lahir); ?>" placeholder="Kota" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent <?php $__errorArgs = ['tempat_lahir'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                            <?php $__errorArgs = ['tempat_lahir'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-500 text-sm"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        <?php else: ?>
                            <input type="text" readonly value="<?php echo e(auth()->user()->tempat_lahir ?? '-'); ?>" class="w-full px-4 py-2 bg-gray-100 border border-gray-300 rounded-lg text-gray-600">
                        <?php endif; ?>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Lahir</label>
                        <?php if(request()->route()->getName() === 'profile.edit'): ?>
                            <input type="date" name="tanggal_lahir" value="<?php echo e(auth()->user()->tanggal_lahir); ?>" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent <?php $__errorArgs = ['tanggal_lahir'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                            <?php $__errorArgs = ['tanggal_lahir'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-500 text-sm"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        <?php else: ?>
                            <input type="text" readonly value="<?php echo e(auth()->user()->tanggal_lahir ? \Carbon\Carbon::parse(auth()->user()->tanggal_lahir)->locale('id')->isoFormat('D MMMM YYYY') : '-'); ?>" class="w-full px-4 py-2 bg-gray-100 border border-gray-300 rounded-lg text-gray-600">
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div>
                <h2 class="text-xl font-bold text-gray-800 mb-4 pb-2 border-b-2 border-blue-500">
                    <i class="fas fa-map-marker-alt text-blue-500 mr-2"></i>Alamat Lengkap
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Jalan</label>
                        <?php if(request()->route()->getName() === 'profile.edit'): ?>
                            <textarea name="alamat" rows="3" placeholder="Masukkan alamat jalan lengkap" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent <?php $__errorArgs = ['alamat'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"><?php echo e(auth()->user()->alamat); ?></textarea>
                            <?php $__errorArgs = ['alamat'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-500 text-sm"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        <?php else: ?>
                            <textarea readonly rows="3" class="w-full px-4 py-2 bg-gray-100 border border-gray-300 rounded-lg text-gray-600"><?php echo e(auth()->user()->alamat ?? '-'); ?></textarea>
                        <?php endif; ?>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">RT/RW</label>
                        <?php if(request()->route()->getName() === 'profile.edit'): ?>
                            <input type="text" name="rt_rw" value="<?php echo e(auth()->user()->rt_rw); ?>" placeholder="001/001" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent <?php $__errorArgs = ['rt_rw'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                            <?php $__errorArgs = ['rt_rw'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-500 text-sm"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        <?php else: ?>
                            <input type="text" readonly value="<?php echo e(auth()->user()->rt_rw ?? '-'); ?>" class="w-full px-4 py-2 bg-gray-100 border border-gray-300 rounded-lg text-gray-600">
                        <?php endif; ?>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Kelurahan/Desa</label>
                        <?php if(request()->route()->getName() === 'profile.edit'): ?>
                            <input type="text" name="kelurahan" value="<?php echo e(auth()->user()->kelurahan); ?>" placeholder="Kelurahan" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent <?php $__errorArgs = ['kelurahan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                            <?php $__errorArgs = ['kelurahan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-500 text-sm"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        <?php else: ?>
                            <input type="text" readonly value="<?php echo e(auth()->user()->kelurahan ?? '-'); ?>" class="w-full px-4 py-2 bg-gray-100 border border-gray-300 rounded-lg text-gray-600">
                        <?php endif; ?>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Kecamatan</label>
                        <?php if(request()->route()->getName() === 'profile.edit'): ?>
                            <input type="text" name="kecamatan" value="<?php echo e(auth()->user()->kecamatan); ?>" placeholder="Kecamatan" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent <?php $__errorArgs = ['kecamatan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                            <?php $__errorArgs = ['kecamatan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-500 text-sm"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        <?php else: ?>
                            <input type="text" readonly value="<?php echo e(auth()->user()->kecamatan ?? '-'); ?>" class="w-full px-4 py-2 bg-gray-100 border border-gray-300 rounded-lg text-gray-600">
                        <?php endif; ?>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Provinsi</label>
                        <?php if(request()->route()->getName() === 'profile.edit'): ?>
                            <input type="text" name="provinsi" value="<?php echo e(auth()->user()->provinsi); ?>" placeholder="Provinsi" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent <?php $__errorArgs = ['provinsi'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                            <?php $__errorArgs = ['provinsi'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-500 text-sm"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        <?php else: ?>
                            <input type="text" readonly value="<?php echo e(auth()->user()->provinsi ?? '-'); ?>" class="w-full px-4 py-2 bg-gray-100 border border-gray-300 rounded-lg text-gray-600">
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div>
                <h2 class="text-xl font-bold text-gray-800 mb-4 pb-2 border-b-2 border-blue-500">
                    <i class="fas fa-chalkboard-user text-blue-500 mr-2"></i>Pembimbing
                </h2>
                <div class="grid grid-cols-1 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nama Dosen Pembimbing</label>
                        <?php if(request()->route()->getName() === 'profile.edit'): ?>
                            <input type="text" name="nama_dosen_pembimbing" value="<?php echo e(auth()->user()->nama_dosen_pembimbing); ?>" placeholder="Nama dosen pembimbing" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent <?php $__errorArgs = ['nama_dosen_pembimbing'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                            <?php $__errorArgs = ['nama_dosen_pembimbing'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-500 text-sm"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        <?php else: ?>
                            <input type="text" readonly value="<?php echo e(auth()->user()->nama_dosen_pembimbing ?? '-'); ?>" class="w-full px-4 py-2 bg-gray-100 border border-gray-300 rounded-lg text-gray-600">
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <?php if(request()->route()->getName() === 'profile.edit'): ?>
                </form>
                <div class="mt-8 flex justify-center gap-4">
                    <button form="profileForm" type="submit" class="inline-flex items-center px-8 py-3 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition font-semibold">
                        <i class="fas fa-save mr-2"></i>Simpan Perubahan 1
                    </button>
                    <a href="<?php echo e(route('profile.show')); ?>" class="inline-flex items-center px-8 py-3 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition font-semibold">
                        <i class="fas fa-times mr-2"></i>Batal
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
    function previewPhoto(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {

                const avatarDiv = input.closest('.relative, .w-32');
                if (avatarDiv) {
                    const img = avatarDiv.querySelector('img');
                    if (img) {
                        img.src = e.target.result;
                    } else {
                        
                    }
                }
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\gank\egank\resources\views/profil.blade.php ENDPATH**/ ?>