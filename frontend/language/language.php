<?php

namespace frontend\language;

class language
{
    public static $lang = [
        'n_yes_update'          => 'Данные успешно обновлены',
        'n_no_db_connected'     => 'Проблемы с подключение к Базе данных. Попробуте снова или попробуте позднее!',
        'n_no_post'             => 'Произошла ошибка при загрзке данных. Попробуте снова или попробуте позднее!',
        'n_yes_file_load'       => 'Файл успешно загружен',
        'n_no_file_load_meta'   => 'Не удалось зарегистрировать фалй в системе',
        'n_no_file_load'        => 'Не удалось создать подменные майл в системе',
    ];

    public static $profile = [
        'n_yes_update_job'              => 'Ваша <strong>должность</strong> успешно обновлена',
        'n_yes_update_address'          => 'Ваш <strong>рабочий адрес</strong> успешно изменен',
        'n_yes_update_email'            => 'Ваша <strong>электронная почта</strong> успешно изменен',
        'n_yes_update_password'         => 'Ваш <strong>пароль</strong> успешно изменен',
        'n_yes_update_birthday_day'     => '<strong>День</strong> вашего рождения успешно изменен',
        'n_yes_update_birthday_month'   => '<strong>Месяц</strong> вашего рождения успешно изменен',
        'n_yes_update_birthday_year'    => '<strong>Год</strong> вашего рождения успешно изменен',
        'n_yes_update_birthday_no_view' => 'Теперь <strong>год вашего рождения скрыт</strong> от всех пользователей портала',
        'n_yes_update_birthday_view'    => 'Теперь <strong>год вашего рождения доступен</strong> всем пользователям портала',
        'n_yes_update_department'       => '<strong>Подразделение</strong> работы успешно изменено',
        'n_yes_update_fullname'         => 'Дванные <strong>ФИО</strong> успешно изменены',
        'n_yes_add_telephone'           => '<strong>Новый номер телефона</strong> успешно добавлен в ваш профиль',
        'n_yes_delete_telephone'        => '<strong>Новый номер телефона</strong> успешно удален из вашего профиля',
        'n_yes_update_telephone'        => '<strong>Номер телефона</strong> успешно изменен',
        'n_yes_update_not_in_work'      => '<strong>Вы покинули рабочее место!</strong>',
        'n_yes_update_in_work'          => '<strong>Вы снова на робочем месте!</strong>',

        'n_no_telephone_count'          => 'Ксожалению, <strong>более 3-х</strong> новмеров телефона добавить в профиль нельзя',
    ];

    public static $news = [
        'n_yes_add_category'        => 'Категория успешно добавлена!',
        'n_yes_update_category'     => 'Категория успешно изменена!',
        'n_yes_delete_category'     => 'Категория успешно удалена!',
        'n_yes_status_1_category'   => 'Категория доступка для назначения при создании новостей.',
        'n_yes_status_0_category'   => 'Категория скрыта! Теперь ее нельзя назначать при создании новостей.',
        'n_yes_new_news'            => 'Новость упешно добавлена и опубликована.',
        'n_yes_delete_news'         => 'Новость удалена',
        'n_no_delete_news'          => 'Произошла ошибка при удаленни новости! Перезагрузите страницу и попробуте снова.',
        'n_no_search'               => 'По вашему запросу ничего не найдено.',
    ];

    public static $rbac = [
        'n_no_can' => 'У вас нет права на выполнение данной операции. Обратитесь к администратору портала!',
    ];
}