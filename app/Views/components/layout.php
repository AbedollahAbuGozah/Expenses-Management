<!doctype html>
<html class="h-full">
<head>
    <title>TASK</title>
    <!-- Include Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const dropdownToggle = document.querySelector(".dropdown-toggle");
            const dropdownContent = document.querySelector(".dropdown-content");

            dropdownToggle.addEventListener("click", function () {
                dropdownContent.classList.toggle("hidden");
            });
        });
    </script>
</head>
<nav class="bg-gray-600 p-2 justify-between flex fixed w-full ">
    <?php if (session('user') == null): ?>

        <div class="flex ml-4 ">
            <?php if ($currentRoute == 'login'): ?>
                <a class="text-white hover:text-blue-300 mr-4" href="/">Register</a>
            <?php elseif ($currentRoute == 'register'): ?>
                <a class="text-white hover:text-blue-300 mr-4" href="/login">Log in</a>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <?php if (session('user') != null): ?>

        <?php if ($currentRoute == 'dash'): ?>
            <div>
                <p class="text-white font-bold">Dashboard</p>
            </div>
        <?php endif ?>
        <?php if ($currentRoute == 'profile'): ?>
            <div>
                <p class="text-white font-bold">Profile</p>
            </div>
        <?php endif ?>
        <?php if ($currentRoute == 'edit'): ?>
            <div>
                <p class="text-white font-bold">Edit</p>
            </div>
        <?php endif ?>
        <div class="flex items-center min-content ">
            <div class="text-white font-semibold"><?= session('user')['first_name'] . ' ' . session('user')['last_name'] ?></div>
            <div class="ml-4 dropdown-menu relative group">

                <img src="<?= session('user')['image'] ?>" alt="profile picture"
                     class="dropdown-toggle cursor-pointer rounded-full h-8 mr-4 w-8 h-8">
                <div class="dropdown-content hidden absolute right-2 w-40 mt-2 bg-white border border-gray-300 rounded-lg group-hover:block">
                    <a href="/profile" class="block px-4 py-2 hover:bg-gray-100">Profile</a>
                    <a href="/dashboard" class="block px-4 py-2 hover:bg-gray-100">Dashboard</a>
                    <a href="/logout" class="block px-4 py-2 hover:bg-gray-100">Log out</a>
                </div>
            </div>
        </div>

    <?php endif; ?>


</nav>
<body class="bg-gray-100 min-h-screen flex flex-col justify-between" style="position:relative;">
<?= $this->renderSection('content') ?>
</body>
<footer class="bg-gray-400 py-2 text-center text-white">
    @Expense management system
</footer>
</html>
