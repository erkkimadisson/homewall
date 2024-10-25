<?php

$navList = [
    "Budget" => [
        ["label" => "Overview", "path" => "./budget/overview", "icon" => "fa-table-list"],
        ["label" => "Accounts", "path" => "./budget/accounts", "icon" => "fa-money-bills"],
        ["label" => "Charts", "path" => ""],
        ["label" => "Spending by category", "path" => "./budget/charts/category", "icon" => ""],
        ["label" => "Income / Expense", "path" => "./budget/charts/io", "icon" => ""],
    ],
    "Cook" => [
        ["label" => "Recipies", "path" => "./cook/recipies", "icon" => ""],
        ["label" => "Meal plans", "path" => "./cook/plans", "icon" => ""],
    ]
];


?>
<div class="h-screen bg-gray-800">
    <div class="flex flex-col gap-10">
        <div id="nav-head" class="flex text-4xl font-bold flex-col">
            <div class="m-5 text-gray-100 flex flex-row items-center gap-5">
                <img src="./public/images/1_H0.png" class=" w-auto h-8 rounded-full" alt="">
                <h1>HomeWall</h1>
            </div>
            <form class=" mx-5">
                <label for="default-search"
                    class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                <div class="relative">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                        </svg>
                    </div>
                    <input type="search" id="default-search"
                        class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Search..." required />
                    <button type="submit"
                        class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
                </div>
            </form>
        </div>
        <div id="nav-content" class="">
            <ul class="flex flex-col gap-3">
                <?php foreach ($navList as $key => $category): ?>
                    <li class="flex-col flex">
                        <button id="<?= $key ?>-button"
                            class="font-bold text-left text-gray-100 px-3 py-3 mx-5 border  border-gray-600 rounded-lg flex flex-row justify-between items-center"
                            onclick="toggleCategory('<?= $key ?>')"><?= $key ?><span id="<?= $key ?>-caret"
                                class="fa-solid fa-angle-down"></span></button>
                        <ul id="<?= $key ?>"
                            class="categoryInner  hidden mx-5 p-3 rounded-bl-lg rounded-br-lg border border-gray-600">
                            <?php foreach ($category as $item): ?>
                                <?php if (empty($item['path'])): ?>
                                    <li class="font-bold border-b border-gray-600 py-4 text-gray-100"><?= $item['label'] ?></li>
                                <?php elseif (!empty($item['icon'])): ?>
                                    <li class="border-b last:border-b-0 border-gray-600 py-1 text-gray-100"><a
                                            class="flex flex-row gap-3 py-3 items-center" href="<?= $item['path'] ?>"><span
                                                class="w-3 h-4 fa-solid <?= $item['icon'] ?>"></span><?= $item['label'] ?></a></li>
                                <?php else: ?>
                                    <li class="border-b last:border-b-0 border-gray-600 py-1 text-gray-100"><a
                                            class="w-full block py-3" href="<?= $item['path'] ?>"><?= $item['label'] ?></a></li>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</div>