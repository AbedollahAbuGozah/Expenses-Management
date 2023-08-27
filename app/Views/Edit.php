<?= $this->extend('components/layout') ?>
<?= $this->section('content') ?>
<?php if ($successes != ''): ?>
    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-1 w-1/3" role="alert">
        <p class="font-bold"><?= $successes ?></p>
    </div>
<?php endif; ?>
<div class="bg-white shadow-md  p-6 h-1/3 bg-gray-100 flex mt-10">


    <form method="POST" action="edit" enctype="multipart/form-data"
          class="max-w-md mx-auto bg-white p-6 rounded shadow-md mt-4">
        <h1 class="text-2xl font-semibold mb-4">Change Information</h1>
        <input type="hidden" value="<?= csrf_hash() ?>" name="<?= csrf_token() ?>">
        <div class="mb-4">
            <label for="first_name" class="block text-gray-700 text-sm font-bold mb-2">First Name:</label>
            <input id="first_name" type="text" name="first_name" value="<?= session('user')['first_name'] ?>"
                   class="w-full p-2 border rounded focus:outline-none focus:shadow-outline">
        </div>
        <div class="mb-4">
            <label for="last_name" class="block text-gray-700 text-sm font-bold mb-2">Last Name:</label>
            <input id="last_name" type="text" name="last_name" value="<?= session('user')['last_name'] ?>"
                   class="w-full p-2 border rounded focus:outline-none focus:shadow-outline">
        </div>
        <div class="mb-4">
            <label for="image" class="block text-gray-700 text-sm font-bold mb-2">Add Picture:</label>
            <input type="file" name="image" id="image"
                   class="w-full p-2 border rounded focus:outline-none focus:shadow-outline">
        </div>
        <button type="submit"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
            Submit
        </button>
    </form>

    <form method="post" action="/change_password" class="max-w-md mx-auto bg-white p-6 rounded shadow-md mt-4">
        <h1 class="text-2xl font-semibold mb-4">Change Password</h1>
        <div class="mb-4">
            <label for="password" class="block font-semibold mb-1">Password</label>
            <input type="password" name="password" id="password" class="w-full p-2 border rounded" required>
        </div>
        <div class="mb-4">
            <label for="confirmed_password" class="block font-semibold mb-1">Confirm Password</label>
            <input type="password" name="confirmed_password" id="confirmed_password" class="w-full p-2 border rounded"
                   required>
        </div>
        <button type="submit"
                class="w-full bg-blue-500 text-white p-2 rounded hover:bg-blue-600 transition duration-300">Change
        </button>
    </form>

    <div class="mt-4 text-red-500">
        <?php if (isset($errors)): ?>
            <?= $errors ?>
        <?php endif; ?>
    </div>
</div>
<?= $this->endSection() ?>
