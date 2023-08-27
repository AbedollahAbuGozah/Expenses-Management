<?= $this->extend('components/layout') ?>
<?= $this->section('content') ?>

<div class="bg-gray-100">
    <div class="flex ml-10 mt-16">
        <div class="w-2/3 h-1/3">
            <div class="chart w-2/3 rounded h-2/3 bg-white shadow-md p-4">
                <h1 class="text-3xl font-bold mb-4">Expenses Chart</h1>
                <div class="flex border-b pb-2 mb-2">
                    <a href="/show_expenses/%d"
                       class="py-2 px-4 text-blue-500 hover:text-blue-600 transition duration-300">Daily</a>
                    <a href="/show_expenses/%m"
                       class="py-2 px-4 text-blue-500 hover:text-blue-600 transition duration-300">Monthly</a>
                    <a href="/show_expenses/%y"
                       class="py-2 px-4 text-blue-500 hover:text-blue-600 transition duration-300">Yearly</a>
                </div>
                <canvas id="myChart" class="w-full h-full bg-white rounded"></canvas>
            </div>
        </div>

        <div class="flex">
            <div style="width: 200px;" class="mr-12 bg-white h-2/3 shadow-lg mt-6 rounded">
                <canvas id="myChart2"></canvas>
                <span class="inline-block px-3 py-1  text-black font-bold"><?= intval($avaregeExpenseDay[0]) ?>$</span>
            </div>
            <div style="width: 200px;" class="ml-12 mr-12 bg-white h-2/3 shadow-lg mt-6 rounded">
                <canvas id="myChart3"></canvas>
                <span class="inline-block px-3 py-1  text-black font-bold"> <?= intval($avaregeExpenseMonth[0]) ?>$</span>

            </div>

            <div style="width: 200px;" class="ml-12 mr-12 bg-white h-2/3 shadow-lg mt-6  rounded">
                <canvas id="myChart4"></canvas>
                <span class="inline-block px-3 py-1  text-black font-bold"><?= intval($avaregeExpenseYear[0]) ?>$</span>

            </div>
        </div>

    </div>


    <div class=" mb-4 bg-white shadow-lg w-1/3 mt-4 ml-10">
        <h1 class="text-3xl font-bold mb-4 ml-5 ">Expenses Report</h1>
        <div class="overflow-y-auto w-3/3 ml-5 ">
            <div class="table-container max-h-90 shadow-lg">
                <table class="table border">
                    <thead class="bg-gray-100">
                    <tr>
                        <th class="p-2">Date</th>
                        <th class="p-2">Amount</th>
                        <th class="p-2">Description</th>
                        <th class="p-2">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($expenses as $expense): ?>
                        <tr>
                            <td class="p-2"><?= $expense['expense_date'] ?></td>
                            <td class="p-2"><?= $expense['amount'] ?></td>
                            <td class="p-2"><?= $expense['description'] ?></td>
                            <td class="p-2">
                                <a href="/delete/<?= $expense['id'] ?>" class="text-red-500">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>


        </div>
        <div class="flex">
            <button id="showFormButton" class="py-2 px-4 text-blue-500">Add Expense</button>
            <div class="border-l"></div>
            <button id="Filter" class="py-2 px-4 text-blue-500">Filter</button>
            <div class="border-l"></div>
            <a href="/dashboard" class="py-2 px-4 text-blue-500">All expenses</a>
        </div>
    </div>
    <section class="add_expenses" id="add_expenses" style="position: absolute; display: none">
        <form id="expenseForm" action="/add_expenses" method="post" class="bg-white p-8 rounded shadow-md w-80">
            <div class="mb-4">
                <label for="amount" class="block text-sm font-medium text-gray-700">Amount</label>
                <input id="amount" name="amount" type="number" class="mt-1 p-2 w-full border rounded-md" required>
            </div>

            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                <input id="description" name="description" type="text" class="mt-1 p-2 w-full border rounded-md"
                       required>
            </div>
            <input type="hidden" name="date" value="<?= date('Y-m-d') ?>">
            <input type="submit" value="Add"
                   class="w-full px-4 py-2 text-white bg-blue-500 rounded hover:bg-blue-600 transition duration-300">
            <button type="button" id="cancel2" class="mt-2 px-4 py-2 bg-red-500 text-white rounded">Cancel</button>
        </form>
    </section>

    <section id="filters" class="filter h-2/3" style="position: absolute; display: none">
        <div id="filterForm" class="bg-white p-8 rounded shadow-md w-80">
            <form class="filterByDay" method="post" action="/filter">
                <label class="block text-sm font-medium text-gray-700">
                    Filter by day:
                    <input type="date" name="filter" required class="mt-1 p-2 w-full border rounded-md">
                </label>
                <input type="submit" value="Filter"
                       class="mt-2 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition duration-300">
            </form>

            <form class="filterByMonth" method="post" action="/filter">
                <label class="block text-sm font-medium text-gray-700">
                    Filter by month:
                    <input type="month" name="filter" required class="mt-1 p-2 w-full border rounded-md">
                </label>
                <input type="submit" value="Filter"
                       class="mt-2 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition duration-300">
            </form>

            <form class="filterByYear" method="post" action="/filter">
                <label class="block text-sm font-medium text-gray-700">
                    Filter by year:
                    <input type="number" min="2015" max="2050" name="filter" required
                           class="mt-1 p-2 w-full border rounded-md">
                </label>
                <input type="submit" value="Filter"
                       class="mt-2 px-2 py-1 bg-blue-500 text-white rounded hover:bg-blue-600 transition duration-300">
            </form>
            <button type="button" id="cancel1" class="mt-2 px-4 py-2 bg-red-500 text-white rounded">Cancel</button>
        </div>
    </section>

</div>

<script>
    const jsonData = {
        data: <?= json_encode($data)?>,
        labels: <?= json_encode($labels)?>,
        avaregeExpenseDay: <?=json_encode($avaregeExpenseDay) ?>,
        avaregeExpenseMonth: <?=json_encode($avaregeExpenseMonth) ?>,
        avaregeExpenseYear: <?=json_encode($avaregeExpenseYear) ?>,
    };
</script>

<script src="/chart.js"></script>

<?= $this->endSection() ?>
