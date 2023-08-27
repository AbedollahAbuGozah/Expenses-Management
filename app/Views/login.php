<?= $this->extend('components/layout') ?>
<?= $this->section('content') ?>
<div class="flex justify-center">
    <form method="POST" action="login" class="bg-white shadow-lg rounded px-8 pt-6 pb-8 mb-4 w-1/3 mt-32">
        <p class="mb-4 text-red-500">All fields are required.</p> <!-- Note for required fields -->
        <div class="flex justify-center ">
            <h1 class="text-gray-600 font-bold text-lg">Login form</h1>
        </div>

        <div class="mb-4">
            <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email:</label>
            <input type="text" name="email" id="email" value="<?= set_value('email') ?>"
                   class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>
        <div class="mb-4">
            <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password:</label>
            <input id="password" type="password" name="password" value="<?= set_value('password') ?>"
                   class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>
        <button type="submit"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
            Log In
        </button>
    </form>

</div>
<div class="errors text-red-500">
    <?php if (isset($errors)): ?>
        <?= $errors ?>
    <?php endif; ?>
</div>
<?= $this->endSection('content') ?>
