<?php

/** @var \yii\web\View $this */
/** @var \frontend\controllers\BarController $data_01 */
/** @var \frontend\controllers\BarController $data_02 */
/** @var \frontend\controllers\BarController $data_03 */
/** @var \frontend\controllers\BarController $data_04 */

use yii\helpers\Url;

$this->title = 'Нижний бар'
?>
<div class="container h-auto pb-24">
    <div class="w-full ha-auto mb-12">
        <a onclick="javascript:history.back(); return false;" class="inline-block align-middle px-2.5 py-2 mr-2 border-2 border-gray-800 text-gray-800 font-medium text-xs leading-tight uppercase rounded hover:bg-black hover:bg-opacity-5 focus:outline-none focus:ring-0 transition duration-150 ease-in-out">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 inline-block align-middle">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12h-15m0 0l6.75 6.75M4.5 12l6.75-6.75" />
            </svg>
        </a>

        <h1 class="inline-block align-middle font-semibold text-2xl">
            Редактор бара (нижний)
        </h1>
    </div>

    <div class="mt-10">
        <h1 class="font-bold text-lg italic inline-block align-middle">Столбец #1</h1>
    </div>
    <div class="flex flex-col">
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                <div class="overflow-hidden">
                    <table class="min-w-full border">
                        <thead class="border-b">
                        <tr class="bg-main-red text-white">
                            <th scope="col" class="text-sm font-medium px-6 py-2 border-r">
                                #
                            </th>
                            <th scope="col" class="text-sm font-medium px-6 py-2 border-r">
                                Наименование
                            </th>
                            <th scope="col" class="text-sm font-medium px-6 py-2 border-r">
                                Ссылка
                            </th>
                            <th scope="col" class="text-sm font-medium px-6 py-2">
                                Функции
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ( $data_01 as $index => $item ): ?>
                            <tr class="border-b <?= \frontend\models\Navbar::find()->where(['id' => $item['navbar_id']])->one()['status'] == 0 ? 'bg-red-50' : 'hover:bg-stone-200' ?>">
                                <td class="text-sm px-4 py-1 whitespace-nowrap border-r"><span class="bg-red-50 hidden"></span>
                                    <?= $index + 1 ?>
                                </td>
                                <td class="text-sm px-4 py-1 whitespace-nowrap border-r">
                                    <?= $item['title'] ?>
                                </td>
                                <td class="text-sm px-4 py-1 whitespace-nowrap border-r">
                                    <a href="<?= $item['href'] ?>" class="font-bold text-xs text-blue-500"><?= $_SERVER['HTTP_HOST'] . $item['href'] ?></a>
                                </td>
                                <td class="text-sm px-4 py-1 whitespace-nowrap">
                                    <a href="<?= Url::to(['/bar/edit-bottom-item', 'bbi' => $item['navbar_id']]) ?>" class="text-xs text-stone-500 hover:text-black hover:font-bold block">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3 h-3 inline-block align-middle">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                                        </svg>
                                        <span class="inline-block align-middle">Изменить</span>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-10">
        <h1 class="font-bold text-lg italic inline-block align-middle">Столбец #2</h1>
    </div>
    <div class="flex flex-col">
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                <div class="overflow-hidden">
                    <table class="min-w-full border">
                        <thead class="border-b">
                        <tr class="bg-main-red text-white">
                            <th scope="col" class="text-sm font-medium px-6 py-2 border-r">
                                #
                            </th>
                            <th scope="col" class="text-sm font-medium px-6 py-2 border-r">
                                Наименование
                            </th>
                            <th scope="col" class="text-sm font-medium px-6 py-2 border-r">
                                Ссылка
                            </th>
                            <th scope="col" class="text-sm font-medium px-6 py-2">
                                Функции
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ( $data_02 as $index => $item ): ?>
                            <tr class="border-b <?= \frontend\models\Navbar::find()->where(['id' => $item['navbar_id']])->one()['status'] == 0 ? 'bg-red-50' : 'hover:bg-stone-200' ?>">
                                <td class="text-sm px-4 py-1 whitespace-nowrap border-r"><span class="bg-red-50 hidden"></span>
                                    <?= $index + 1 ?>
                                </td>
                                <td class="text-sm px-4 py-1 whitespace-nowrap border-r">
                                    <?= $item['title'] ?>
                                </td>
                                <td class="text-sm px-4 py-1 whitespace-nowrap border-r">
                                    <a href="<?= $item['href'] ?>" class="font-bold text-xs text-blue-500"><?= $_SERVER['HTTP_HOST'] . $item['href'] ?></a>
                                </td>
                                <td class="text-sm px-4 py-1 whitespace-nowrap">
                                    <a href="<?= Url::to(['/bar/edit-bottom-item', 'bbi' => $item['navbar_id']]) ?>" class="text-xs text-stone-500 hover:text-black hover:font-bold block">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3 h-3 inline-block align-middle">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                                        </svg>
                                        <span class="inline-block align-middle">Изменить</span>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-10">
        <h1 class="font-bold text-lg italic inline-block align-middle">Столбец #3</h1>
    </div>
    <div class="flex flex-col">
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                <div class="overflow-hidden">
                    <table class="min-w-full border">
                        <thead class="border-b">
                        <tr class="bg-main-red text-white">
                            <th scope="col" class="text-sm font-medium px-6 py-2 border-r">
                                #
                            </th>
                            <th scope="col" class="text-sm font-medium px-6 py-2 border-r">
                                Наименование
                            </th>
                            <th scope="col" class="text-sm font-medium px-6 py-2 border-r">
                                Ссылка
                            </th>
                            <th scope="col" class="text-sm font-medium px-6 py-2">
                                Функции
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ( $data_03 as $index => $item ): ?>
                            <tr class="border-b <?= \frontend\models\Navbar::find()->where(['id' => $item['navbar_id']])->one()['status'] == 0 ? 'bg-red-50' : 'hover:bg-stone-200' ?>">
                                <td class="text-sm px-4 py-1 whitespace-nowrap border-r"><span class="bg-red-50 hidden"></span>
                                    <?= $index + 1 ?>
                                </td>
                                <td class="text-sm px-4 py-1 whitespace-nowrap border-r">
                                    <?= $item['title'] ?>
                                </td>
                                <td class="text-sm px-4 py-1 whitespace-nowrap border-r">
                                    <a href="<?= $item['href'] ?>" class="font-bold text-xs text-blue-500"><?= $_SERVER['HTTP_HOST'] . $item['href'] ?></a>
                                </td>
                                <td class="text-sm px-4 py-1 whitespace-nowrap">
                                    <a href="<?= Url::to(['/bar/edit-bottom-item', 'bbi' => $item['navbar_id']]) ?>" class="text-xs text-stone-500 hover:text-black hover:font-bold block">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3 h-3 inline-block align-middle">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                                        </svg>
                                        <span class="inline-block align-middle">Изменить</span>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-10">
        <h1 class="font-bold text-lg italic inline-block align-middle">Столбец #4</h1>
    </div>
    <div class="flex flex-col">
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                <div class="overflow-hidden">
                    <table class="min-w-full border">
                        <thead class="border-b">
                        <tr class="bg-main-red text-white">
                            <th scope="col" class="text-sm font-medium px-6 py-2 border-r">
                                #
                            </th>
                            <th scope="col" class="text-sm font-medium px-6 py-2 border-r">
                                Наименование
                            </th>
                            <th scope="col" class="text-sm font-medium px-6 py-2 border-r">
                                Ссылка
                            </th>
                            <th scope="col" class="text-sm font-medium px-6 py-2">
                                Функции
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ( $data_04 as $index => $item ): ?>
                            <tr class="border-b <?= \frontend\models\Navbar::find()->where(['id' => $item['navbar_id']])->one()['status'] == 0 ? 'bg-red-50' : 'hover:bg-stone-200' ?>">
                                <td class="text-sm px-4 py-1 whitespace-nowrap border-r"><span class="bg-red-50 hidden"></span>
                                    <?= $index + 1 ?>
                                </td>
                                <td class="text-sm px-4 py-1 whitespace-nowrap border-r">
                                    <?= $item['title'] ?>
                                </td>
                                <td class="text-sm px-4 py-1 whitespace-nowrap border-r">
                                    <a href="<?= $item['href'] ?>" class="font-bold text-xs text-blue-500"><?= $_SERVER['HTTP_HOST'] . $item['href'] ?></a>
                                </td>
                                <td class="text-sm px-4 py-1 whitespace-nowrap">
                                    <a href="<?= Url::to(['/bar/edit-bottom-item', 'bbi' => $item['navbar_id']]) ?>" class="text-xs text-stone-500 hover:text-black hover:font-bold block">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3 h-3 inline-block align-middle">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                                        </svg>
                                        <span class="inline-block align-middle">Изменить</span>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
