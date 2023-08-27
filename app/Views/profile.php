<?= $this->extend('components/layout') ?>
<?= $this->section('content') ?>
<div class="flex justify-center">
<div class="bg-white shadow-md rounded-lg p-6 mb-4 h-64 w-1/2  mt-64 ">
    <div class="flex items-center mb-6">

        <div class="w-1/3 pr-6  ">
            <img src="<?= $user['image'] ?>" alt="Profile Image" class="rounded-full w-32 h-32 shadow-lg ">
        </div>
        <div class="w-2/3">
            <div class="text-2xl font-semibold">User Name: <?= $user['first_name'] . ' ' . $user['last_name'] ?></div>
            <div class="text-gray-600">Email: <?= $user['email'] ?></div>
        </div>
    </div>
    <div class="border-t pt-4 ">
        <a href="edit"
           class="inline-block bg-gray-500 hover:bg-gray-800 text-white font-semibold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
            Edit Info
        </a>
    </div>
</div>
</div>
<?= $this->endSection('content') ?>
