<?= $this->extend('components/layout') ?>
<?= $this->section('content') ?>
<div class="flex justify-center ">
    <form method="POST" action="register" enctype="multipart/form-data"
          class="bg-white shadow-lg rounded px-8 pt-6 pb-8 mb-4 w-1/3 mt-16 h-1/3 ">
        <p class="mb-4 text-red-500">All fields are required.</p>
        <div class="flex justify-center ">
            <h1 class="text-gray-600 font-bold text-lg">Register form</h1>
        </div>
        <input type="hidden" value="<?= csrf_hash() ?>" name="<?= csrf_token() ?>">
        <div class="mb-4">
            <label for="first_name" class="block text-gray-700 text-sm font-bold ">First name:</label>
            <input id="first_name" type="text" name="first_name" value="<?= set_value('first_name') ?>"
                   class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>
        <div class="mb-4">
            <label for="last-name" class="block text-gray-700 text-sm font-bold ">Last name:</label>
            <input id="last-name" type="text" name="last_name" value="<?= set_value('last_name') ?>"
                   class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>
        <div class="mb-4">
            <label for="email" class="block text-gray-700 text-sm font-bold ">Email:</label>
            <input type="text" name="email" id="email" value="<?= set_value('email') ?>"
                   class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>
        <div class="mb-4">
            <label for="password1" class="block text-gray-700 text-sm font-bold ">Password:</label>
            <input id="password1" type="password" name="password1" value="<?= set_value('password1') ?>"
                   class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>
        <div class="mb-4">
            <label for="password2" class="block text-gray-700 text-sm font-bold ">Confirm your password:</label>
            <input id="password2" type="password" name="password2" value="<?= set_value('password2') ?>"
                   class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>
        <div class="mb-4">
            <label for="image" class="block text-gray-700 text-sm font-bold ">Add picture:</label>
            <input type="file" name="image" id="image"
                   class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>

        <button type="submit"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
            Register
        </button>
    </form>
</div>

<div class="errors text-red-500">
    <?php if (isset($errors)): ?>
        <?= $errors ?>
    <?php endif; ?>
</div>
<?= $this->endSection() ?>
