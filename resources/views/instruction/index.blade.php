@extends('layouts.master')

@section('title', 'Под курсы')
@section('extrastyle')
    <link href="{{ URL::asset('assets/css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('assets/css/responsive.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('assets/css/buttons.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('assets/css/buttons.bootstrap.min.css')}}" rel="stylesheet">

    <link href="{{ URL::asset('assets/css/font-awesome.min.css')}}" rel="stylesheet">
@endsection
@section('content')

    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">

            <div class="clearfix"></div>
            <!-- row start -->
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_content">

                            @can('Teacher')
                                @if(Session::get('language') == 'ru' || Session::get('language') == '')
                                    <pre class="shiny">
                                Инструкция для Инструктора
1. Добавление Курса.
• В МЕНЮ выбрать функцию «ДОБАВЛЕНИЕ КУРСА»;
• Заполнить следующие поля:
    А) Выбрать дисциплину, к которому относится данный курс;
    Б) Наименование курса;
    В) Код курса;
    Г) Стоимость;
    Д) Описание курса;
    Е) Цель;
    Ж) План.
• Выбрать функцию «СОХРАНИТЬ»

2. Внесение изменений или удаление курса.
• В МЕНЮ выбрать функцию «МОИ КУРСЫ»;
• Выбрать необходимый курс (использовать окно поиска или выбрать из списка);
• Выбрать действие «ИЗМЕНИТЬ»/ «УДАЛИТЬ»;
• Внести изменение в соответствующее поле;
• Выбрать функцию «СОХРАНИТЬ».

3. Сообщения
• В МЕНЮ выбрать функцию «СООБЩЕНИЯ»;
• Выбрать функцию «МОИ СООБЩЕНИЯ»;
• Выбрать сообщение;
• Выбрать действие «ПЕРЕЙТИ К ЧАТУ».
• Написать ответ на сообщение;
• Выбрать функцию «ОТПРАВИТЬ».

4. Добавление описания теста.
• В МЕНЮ выбрать функцию «ДОБАВЛЕНИЕ ТЕСТОВ»;
• Заполнить следующие поля:
    А) Наименование;
    Б) Дисциплина;
    В) Курс;
    Г) Краткое описание теста.
• Выбрать функцию «СОХРАНИТЬ».
• Выбрать тест;
• При необходимости выбрать действие «ИЗМЕНИТЬ/УДАЛИТЬ».

5. Изменить описание теста.
• В появившемся окне внести необходимые изменения;
• Выбрать функцию «ИЗМЕНИТЬ».

6. Добавить вопрос.
• В МЕНЮ выбрать функцию «СПИСОК ТЕСТОВ»;
• Заполнить следующие поля:
    А) Дисциплина;
    Б) Курс.
• Выбрать функцию «ПОИСК»;
• Выбрать тест;
• Выбрать действие «ДОБАВИТЬ ВОПРОС»;
• В появившемся окне внести вопрос;
• Выбрать функцию «ДОБАВИТЬ ВАРИАНТ»;
• В появившемся поле внести вариант ответ;
• Внести необходимое количество вариантов ответа;
• Выбрать правильный вариант ответа;
• Выбрать функцию «СОХРАНИТЬ».

7. Изменение/Удаление вопросов.
• В МЕНЮ выбрать функцию «СПИСОК ТЕСТОВ»;
• Заполнить следующие поля:
    А) Дисциплина;
    Б) Курс.
• Выбрать функцию «ПОИСК»;
• Выбрать тест;
• Выбрать действие «ВОПРОСЫ»;
• Выбрать действие «ИЗМЕНИТЬ/УДАЛИТЬ»

8. Изменение вопросов.
• После выбора действия «ИЗМЕНИТЬ» из пункта 18, в появившемся окне внести необходимые изменения;
• Выбрать функцию «СОХРАНИТЬ».

9. Результаты тестов.
• В МЕНЮ выбрать функцию «РЕЗУЛЬТАТЫ ТЕСТОВ»;
• Выбрать слушателя (использовать окно поиска или выбрать из списка);
• При необходимости скачать/распечатать, используя верхнюю рабочую панель.
• При необходимости выбрать действие «УДАЛИТЬ».

10. Добавление презентации
• В МЕНЮ выбрать функцию «ДОБАВЛЕНИЕ ПРЕЗЕНТАЦИИ»;
• Заполнить следующие поля:
    А) Наименование;
    Б) Описание;
    В) Курс;
• Выбрать функцию «ДОБАВИТЬ».

11. Добавление элементов презентации
• После выполнения всех действии, указанных в пункте 22, автоматически появится окно «ДОБАВЛЕНИЕ ЭЛЕМЕНТОВ ПРЕЗЕНТАЦИИ»;
• Запомнить следующие поля (по необходимости):
    А) Слайд стр. jpg (файл в формате jpg);
    Б) Аудио (файл в формате mp3/wav);
    В) Видео (файл в формате mp4);
    Г) Продолжительность (скунды);
    Д) Текст
• Выбрать функцию «ДОБАВИТЬ».

12. Изменение/Удаление/Просмотр презентации.
• В МЕНЮ выбрать функцию «СПИСОК ПРЕЗЕНТАЦИЙ»;
• Выбрать презентацию;
• Выбрать действие «ИЗМЕНИТЬ/УДАЛИТЬ/ПРОСМОТРЕТЬ».

13. Изменить презентацию.
• В появившемся окне внести необходимые изменения;
• Выбрать функцию «ИЗМЕНИТЬ».

14. Просмотр презентации.
• В появившемся окне просмотреть элементы презентации;
• Выбрать действие «ИЗМЕНИТЬ/УДАЛИТЬ».

15. Сертификаты
• В МЕНЮ выбрать функцию «СЕРТИФИКАТЫ»;
• Выбрать курс (использовать окно поиска или выбрать из списка);
• Выбрать действие «ИЗМЕНИТЬ».

16. Изменить сертификат
• После выполнения всех действии, указанных в пункте 27, автоматически появится окно «ИЗМЕНИТЬ СЕРТИФИКАТ»;
• Заполнить следующие поля по необходимости:
    А) Текст 1
    Б) Текст 2
    В) Наименование курса 1
    Д) Наименование курса 2
    Е) Наименование курса 3
    Ж) Наименование курса 4
    З) Текст 3
    И) Срок действия сертификата;
    К) Владелец проекта;
    Л) От имени и для.



                            </pre>
                                @else
                                    <pre class="shiny">
Instructor guidance

1. Add Course
•Select the function “All DISCIPLINES” in the MENU;
•Fill in the following fields
    a)Select the discipline to which this course belongs;
    b)Course name
    c)Course code
    d)Price
    e)Course description
    f) Course objective
    g) Plan
•Select function “SAVE”

2. Amending or removing course.
•Select the function “My courses” in the MENU;
•Select required course (use the search box or select from the list)
•Select action “Change/Remove (Delete)?”
•Make change in required field
•Select function “SAVE”

3.Messages
•Select the function “MESSAGE” in the MENU
•Select the function “MY MESSAGES”
•Select message
•Select action “MOVE TO CHAT”
•Respond to message
•Select function “SEND”


4. Add test description
•Select function “ADD TEST” in the MENU
•Fill in the following fields
    a) Name
    b)Discipline
    c) Course
    d)Brief description of the course
•Select function “SAVE”
•Select test
•Select action “CHANGE/DELETE” if required

5. Change test description
•Make the required changes in the window that appears,
•Select function “CHANGE”

6. Add question
•Select function “TEST LIST” in the MENU
•Fill in the following fields
    a) Discipline
    b) Course
•Select function “FIND”
•Select test
•Select action “ADD QUESTION”
•Add the question in the window that appears,
•Select function “ADD ANOTHER ANSWER”
•Add the answer in the window that appears,
•Add required quantity of the answer
•Select correct answer
•Select function “SAVE”

7.Change/Delete questions
•Select function “TEST LIST” in the MENU
•Fill in the following fields
    a)Discipline
    b)Course
•Select function “FIND”
•Select test
•Select action “QUESTIONS”
•Select action “CHANGE/DELETE”

8. Change question
•After completion action “CHANGE” from item 18, make the required changes in the appeared window;
•Selection function “SEND”

9.Test Results
•Select function “TEST RESULTS” in the MENU
•Select participant (use the search box or select from the list)
•Download/print by using top working panel if required.
•Select action “DELETE” if required

10. Add presentation
•Select function “ADD PRESENTATION” in the MENU
•Fill in the following fields
    a) Name
    b) Description
    c) Corse
•Select function “ADD”

11.Add presentation elements
•After completion of all actions from item 22, window “ADD PRESENTATION ELEMENT” will appear automatically;
•Fill in the following field (if required)
    a) Slide page. Jpg (jpg format file)
    b)Audio (mp3/wav format file)
    c)Video (mp4 format file)
    d)Duration (sec.)
    e) Text
•Select function “ADD”

12.Change/Delete/View presentation
•Select function “PRESENTATION LIST” in the MENU
•Select presentation
•Select action “CHANGE/DELETE/VIEW”

13. Change presentation
•Make the required changes in the window that appears,
•Select function “CHANGE”

14.View presentation
•View presentation elements in the window that appears,
•Select action “CHANGE/DELETE”

15.Certificates
•Select function “CERTIFICATES” in the MENU
•Select course (use the search box or select from the list)
•Select action “CHANGE”

16.Change certificate
•After completion of all actions specified in item 27 “CHANGE CERTIFICATE” window will appear automatically.
•Fill in the following fields
    a) Text 1
    b) Text 2
    c) Course name 1
    d) Course name 2
    e)Course name 3
    f) Course name 4
    h) Text 3
    i) Certificate validity
    j) Inspired by
    k) On behalf and for

                                    </pre>
                                @endif
                            @endcan
                            @can('Admin')
                                @if(Session::get('language') == 'ru'|| Session::get('language') == '')
                                    <pre class="shiny">
Инструкция для Администратора
1. Добавление информацию об Организации.
•Для добавления информации об организации необходимо заполнить следующие поля:
    А) Наименование организации;
    Б) Начало деятельности;
    В) Веб – сайт;
    Г) e-mail
    Д) Номер телефона
    Е) Адрес.
•Выбрать функцию «СОХРАНИТЬ»
•В случае необходимости изменения сохраненной информации, выбрать функцию «ИЗМЕНИТЬ» и внести изменение в соответствующее поле.

2. Добавление Дисциплины.
•В МЕНЮ выбрать функцию «ДОБАВЛЕНИЕ ДИСЦИПЛИНЫ»;
•Заполнить следующие поля:
    А) Наименование дисциплины;
    Б) Код дисциплины (общепринятое сокращение или аббревиатура);
    В) Краткое описание;
•Выбрать функцию «СОХРАНИТЬ»

3. Внесение изменений или удаление дисциплины.
•В МЕНЮ выбрать функцию «ВСЕ ДИСЦИПЛИНЫ»;
•Выбрать необходимую дисциплину (использовать окно поиска или выбрать из списка);
•Выбрать действие «ИЗМЕНИТЬ»/ «УДАЛИТЬ»;
•Внести изменение в соответствующее поле;
•Выбрать функцию «СОХРАНИТЬ».

4. Добавление Курса.
•В МЕНЮ выбрать функцию «ДОБАВЛЕНИЕ КУРСА»;
•Заполнить следующие поля:
    А) Выбрать дисциплину, к которому относится данный курс;
    Б) Наименование курса;
    В) Код курса;
    Г) Стоимость;
    Д) Описание курса;
    Е) Цель;
    Ж) План.
•Выбрать функцию «СОХРАНИТЬ»

5. Внесение изменений или удаление курса.
•В МЕНЮ выбрать функцию «МОИ КУРСЫ»;
•Выбрать необходимый курс (использовать окно поиска или выбрать из списка);
•Выбрать действие «ИЗМЕНИТЬ»/ «УДАЛИТЬ»;
•Внести изменение в соответствующее поле;
•Выбрать функцию «СОХРАНИТЬ».

6. Добавление слушателей.
•В МЕНЮ выбрать функцию «ДОБАВЛЕНИЕ СЛУШАТЕЛЕЙ»;
•Заполнить следующие поля (Информация о слушателе):
    А) Имя;
    Б) Отчество;
    В) Фамилия;
    Г) Пол;
    Д) Дата рождения;
    Г) Мобильный телефон.
•Выбрать функцию «ДОБАВИТЬ».

7.  Внесение изменений или удаление информации о слушателе.
•В МЕНЮ выбрать функцию «ВСЕ СЛУШАТЕЛИ»;
•Выбрать слушателя (использовать окно поиска или выбрать из списка);
•Выбрать действие «ИЗМЕНИТЬ»/ «УДАЛИТЬ»;
•Внести изменение в соответствующее поле;
•Выбрать функцию «СОХРАНИТЬ».

8. Регистрация слушателя
•В МЕНЮ выбрать функцию «РЕГИСТРАЦИЯ СЛУШАТЕЛЯ» для подписания слушателя на курс;
•Выбрать курс, на который необходимо подписать данного слушателя;
•Выбрать дату, в соответствии со сроком завершения курса.
•Активировать информацию в графе «ПОДПИСАТЬ»;
•Выбрать функцию «ПОДПИСАТЬ».

9.  Удаление зарегистрированного слушателя.
•В МЕНЮ выбрать функцию «ЗАРЕГИСТРИРОВАННЫЕ СЛУШАТЕЛИ»;
•Выбрать курс (использовать окно поиска или выбрать из списка);
•Выбрать слушателя;
•Выбрать действие «УДАЛИТЬ».

10. Добавление Пользователей.
•В МЕНЮ выбрать функцию «ПОЛЬЗОВАТЕЛИ»;
•Заполнить следующие поля:
    А) Имя;
    Б) Фамилия;
    В) Логин;
    Г) Группа (Выбрать Инструктор/Слушатель);
    Д) E-mail;
    Е) Дополнительная информация (для Инструктора – область деятельности; для Слушателя – название организации);
    Ж) Пароль;
    З) Подтверждение пароля.
•Выбрать функцию «СОХРАНИТЬ».
11. Внесение изменений или удаление информации по пользователю.
•В МЕНЮ выбрать функцию «ЗАРЕГИСТРИРОВАННЫЕ СЛУШАТЕЛИ»;
•При необходимости воспользоваться функцией «НОВЫЙ ПОЛЬЗОВАТЕЛЬ»;
•Выбрать пользователя (использовать окно поиска или выбрать из списка);
•Выбрать действие «ИЗМЕНИТЬ»/ «УДАЛИТЬ»;
•Внести изменение в соответствующее поле;
•Выбрать функцию «СОХРАНИТЬ».

12. Контроль Инструкторов.
•В МЕНЮ выбрать функцию «КОНТРОЛЬ ИНСТРУКТОРОВ»;
•Просмотреть информацию о рабочей сессии инструкторов;
•При необходимости скачать/распечатать, используя верхнюю рабочую панель.

13. Сообщения
•В МЕНЮ выбрать функцию «СООБЩЕНИЯ»;
•Выбрать функцию «МОИ СООБЩЕНИЯ»;
•Выбрать сообщение;
•Выбрать действие «ПЕРЕЙТИ К ЧАТУ».
•Написать ответ на сообщение;
•Выбрать функцию «ОТПРАВИТЬ».

14. Отзывы.
•В МЕНЮ выбрать функцию «СООБЩЕНИЯ»;
•Выбрать функцию «ОТЗЫВЫ»;
•Выбрать отзыв;
•Выбрать действие ОТВЕТИТЬ/УДАЛИТЬ.
•Написать ответ на отзыв;
•Выбрать функцию «ОТПРАВИТЬ».

15. Добавление описания теста.
•В МЕНЮ выбрать функцию «ДОБАВЛЕНИЕ ТЕСТОВ»;
•Заполнить следующие поля:
    А) Наименование;
    Б) Дисциплина;
    В) Курс;
    Г) Краткое описание теста.
•Выбрать функцию «СОХРАНИТЬ».
•Выбрать тест;
•При необходимости выбрать действие «ИЗМЕНИТЬ/УДАЛИТЬ».

16. Изменить описание теста.
•В появившемся окне внести необходимые изменения;
•Выбрать функцию «ИЗМЕНИТЬ».

17. Добавить вопрос.
•В МЕНЮ выбрать функцию «СПИСОК ТЕСТОВ»;
•Заполнить следующие поля:
    А) Дисциплина;
    Б) Курс.
•Выбрать функцию «ПОИСК»;
•Выбрать тест;
•Выбрать действие «ДОБАВИТЬ ВОПРОС»;
•В появившемся окне внести вопрос;
•Выбрать функцию «ДОБАВИТЬ ВАРИАНТ»;
•В появившемся поле внести вариант ответ;
•Внести необходимое количество вариантов ответа;
•Выбрать правильный вариант ответа;
•Выбрать функцию «СОХРАНИТЬ».

18. Изменение/Удаление вопросов.
•В МЕНЮ выбрать функцию «СПИСОК ТЕСТОВ»;
•Заполнить следующие поля:
    А) Дисциплина;
    Б) Курс.
•Выбрать функцию «ПОИСК»;
•Выбрать тест;
•Выбрать действие «ВОПРОСЫ»;
•Выбрать действие «ИЗМЕНИТЬ/УДАЛИТЬ»

19. Изменение вопросов.
•После выбора действия «ИЗМЕНИТЬ» из пункта 18, в появившемся окне внести необходимые изменения;
•Выбрать функцию «СОХРАНИТЬ».

20. Результаты тестов.
•В МЕНЮ выбрать функцию «РЕЗУЛЬТАТЫ ТЕСТОВ»;
•Выбрать слушателя (использовать окно поиска или выбрать из списка);
•При необходимости скачать/распечатать, используя верхнюю рабочую панель.
•При необходимости выбрать действие «УДАЛИТЬ».

21. Добавление презентации
•В МЕНЮ выбрать функцию «ДОБАВЛЕНИЕ ПРЕЗЕНТАЦИИ»;
•Заполнить следующие поля:
    А) Наименование;
    Б) Описание;
    В) Курс;
•Выбрать функцию «ДОБАВИТЬ».


22. Добавление элементов презентации
•После выполнения всех действии, указанных в пункте 22, автоматически появится окно «ДОБАВЛЕНИЕ ЭЛЕМЕНТОВ ПРЕЗЕНТАЦИИ»;
•Запомнить следующие поля (по необходимости):
    А) Слайд стр. jpg (файл в формате jpg);
    Б) Аудио (файл в формате mp3/wav);
    В) Видео (файл в формате mp4);
    Г) Продолжительность (скунды);
    Д) Текст
Выбрать функцию «ДОБАВИТЬ».

23. Изменение/Удаление/Просмотр презентации.
•В МЕНЮ выбрать функцию «СПИСОК ПРЕЗЕНТАЦИЙ»;
•Выбрать презентацию;
•Выбрать действие «ИЗМЕНИТЬ/УДАЛИТЬ/ПРОСМОТРЕТЬ».

24. Изменить презентацию.
•В появившемся окне внести необходимые изменения;
•Выбрать функцию «ИЗМЕНИТЬ».

25. Просмотр презентации.
•В появившемся окне просмотреть элементы презентации;
•Выбрать действие «ИЗМЕНИТЬ/УДАЛИТЬ».

26. Сертификаты
•В МЕНЮ выбрать функцию «СЕРТИФИКАТЫ»;
•Выбрать курс (использовать окно поиска или выбрать из списка);
•Выбрать действие «ИЗМЕНИТЬ».

27. Изменить сертификат
•После выполнения всех действии, указанных в пункте 27, автоматически появится окно «ИЗМЕНИТЬ СЕРТИФИКАТ»;
•Заполнить следующие поля по необходимости:
    А) Текст 1
    Б) Текст 2
    В) Наименование курса 1
    Д) Наименование курса 2
    Е) Наименование курса 3
    Ж) Наименование курса 4
    З) Текст 3
    И) Срок действия сертификата;
    К) Владелец проекта;
    Л) От имени и для.

28. Реестр сертификатов.
•В МЕНЮ выбрать функцию «РЕЕСТР СЕРТИФИКАТОВ»;
•Просмотр/Выбрать сертификат (использовать окно поиска или выбрать из списка);
•При необходимости скачать/распечатать, используя верхнюю рабочую панель.

29. Привязка аккаунта слушателю.
•В МЕНЮ выбрать функцию «ПРИВЯЗКА АККАУНТА СЛУШАТЕЛЮ.»;
•Выбрать слушателя;
•Выбрать аккаунт (логин);
•Выбрать функцию «ПРИВЯЗАТЬ»;
•При необходимости выбрать действие «УДАЛИТЬ».

                            </pre>
                                @else
                                    <pre class="shiny">
Administrator guidance
1. Add information about organization
•To add information about organization, please fill in the following fields:
    a) Name;
    b) Date of foundation;
    c) Web-Site;
    d) E-mail;
    e) Phone number;
    f) Address .
•Select function «SAVE»
•Select function “CHANGE” and make changes in required fields, to change the stored information.

2.Add Discipline.
•Select the function “ADD DISCIPLINE” in the MENU
•Fill in the following fields
    a)Name
    b)Code of the discipline (general abbreviation)
    c)Brief description
•Select function «SAVE»

3.Amending or removing discipline.
•Select the function “All DISCIPLINES”  In the MENU;
•Select required discipline (use the search box or select from the list)
•Select action “Change/Remove (Delete)?”
•Make change in required field
•Select function “SAVE”

4.Add Course
•Select the function “All DISCIPLINES” in the MENU;
•Fill in the following fields
    a)Select the discipline to which this course belongs;
    b)Course name
    c)Course code
    d)Price
    e)Course description
    f)Course objective
    g)Plan
•Select function “SAVE”

5.Amending or removing course.
•Select the function “My courses” in the MENU;
•Select required course (use the search box or select from the list)
•Select action “Change/Remove (Delete)?”
•Make change in required field
•Select function “SAVE”

6.Add participants
•Select the function “Add participants” in the MENU;
•Fill in the following fields (Information about participant)
    a)First name
    b)Paternal name
    c)Surname
    d)Sex
    e)Date of birth
    f)Mobile number
•Select function “ADD”

7.Amending or removing information about participant.
•Select the function “All participants” in the MENU;
•Select participant (use the search box or select from the list)
•Select action “Change/Delete”
•Make change in required field
•Select function “SAVE”

8.Participant registration.
•Select the function “PARTICIPANR REGISTRATION” in the MENU to sign-up participant for the course
•Select the required course to sign-up the participant
•Select the expiry date
•Activate the information in the column "SIGN";
•Select function “SIGN”.

9.Delete registered participant.
•Select the function “REGISTERED PARTICIPANT” in the MENU
•Select course (use the search box or select from the list)
•Select participant
•Select action “DELETE”

10.Add User.
•Select the function “USER” in the MENU
•Fill in the following fields:
    a) First Name
    b) Family name
    c) Log in
    d) Group (Select Instructor/Participant)
    e) E-mail;
    f) Additional information (for Instructor - area of ​​activity; for the Participant - name of the organization);
    g) Password
    h) Password verification
•Select function “SAVE”

11. Amending or removing information about user.
•Select the function “USERS LIST” in the MENU
•Use function “NEW USER” if required.
•Select user (use the search box or select from the list)
•Select action “CHANGE/DELETE”
•Make change in required fields.
•Select function “SAVE”

12.Instructor control
•Select the function “INSTRUCTOR CONTROL” in the MENU
•View the information about Instructor session.
•Download/print by using top working panel If required.

13.Messages
•Select the function “MESSAGE” in the MENU
•Select the function “MY MESSAGES”
•Select message
•Select action “MOVE TO CHAT”
•Respond to message
•Select function “SEND”

14.Feedback
•Select function “MESSAGE” in the MENU
•Select function “FEEDBACK”
•Select feedback
•Select action “RESPOND/DELETE”
•Response
•Select function “SEND”

15.Add test description
•Select function “ADD TEST” in the MENU
•Fill in the following fields
    a) Name
    b) Discipline
    c) Course
    d) Brief description of the course
•Select function “SAVE”
•Select test
•Select action “CHANGE/DELETE” if required

16. Change test description
•Make the required changes in the window that appears,
•Select function “CHANGE”

17. Add question
•Select function “TEST LIST” in the MENU
•Fill in the following fields
    a) Discipline
    b) Course
•Select function “FIND”
•Select test
•Select action “ADD QUESTION”
•Add the question in the window that appears,
•Select function “ADD ANOTHER ANSWER”
•Add the answer in the window that appears,
•Add required quantity of the answer
•Select correct answer
•Select function “SAVE”

18.Change/Delete questions
•Select function “TEST LIST” in the MENU
•Fill in the following fields
    a) Discipline
    b) Course
•Select function “FIND”
•Select test
•Select action “QUESTIONS”
•Select action “CHANGE/DELETE”

19.Change question
•After completion action “CHANGE” from item 18, make the required changes in the appeared window;
•Selection function “SEND”

20.Test Results
•Select function “TEST RESULTS” in the MENU
•Select participant (use the search box or select from the list)
•Download/print by using top working panel if required.
•Select action “DELETE” if required

21.Add presentation
•Select function “ADD PRESENTATION” in the MENU
•Fill in the following fields
    a) Name
    b) Description
    c) Corse
•Select function “ADD”

22. Add presentation elements
•After completion of all actions from item 22, window “ADD PRESENTATION ELEMENT” will appear automatically;
•Fill in the following field (if required)
    a) Slide page. Jpg (jpg format file)
    b) Audio (mp3/wav format file)
    c) Video (mp4 format file)
    d) Duration (sec.)
    e) Text
•Select function “ADD”

23. Change/Delete/View presentation
•Select function “PRESENTATION LIST” in the MENU
•Select presentation
•Select action “CHANGE/DELETE/VIEW”

24. Change presentation
•Make the required changes in the window that appears,
•Select function “CHANGE”

25. View presentation
•View presentation elements in the window that appears,
•Select action “CHANGE/DELETE”

26. Certificates
•Select function “CERTIFICATES” in the MENU
•Select course (use the search box or select from the list)
•Select action “CHANGE”

27. Change certificate
•After completion of all actions specified in item 27 “CHANGE CERTIFICATE” window will appear automatically.
•Fill in the following fields
    a) Text 1
    b) Text 2
    c) Course name 1
    d) Course name 2
    e) Course name 3
    f) Course name 4
    h) Text 3
    i) Certificate validity
    j) Inspired by
    k) On behalf and for

28. Certificate Registry
•Select function “CERTIFICATE REGISTRY” in the MENU
•View/Select certificate (use the search box or select from the list)
•Download/print by using top working panel If required.

29. Assign account for participant
•Select function “ADD PARTICIPANT ACCOUNT” in the MENU
•Select participant
•Select account (log in)
•Select function “ASSIGN”
•Select action “DELETE” if required

                                    </pre>
                                @endif
                            @endcan
                        </div>
                    </div>
                    <!-- row end -->
                    <div class="clearfix"></div>

                </div>
            </div>
            <!-- /page content -->
        </div>
    </div>
@endsection
<style>
    .body {
        background-color: #111;
    }

    .shiny {

        color: #111;
        position: relative;
        font-family: "Source Sans Pro", sans-serif;
        font-weight: 900;
    }
</style>
@section('extrascript')
    <!-- dataTables -->
    <script src="{{ URL::asset('assets/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{ URL::asset('assets/js/dataTables.bootstrap.min.js')}}"></script>
    <script src="{{ URL::asset('assets/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{ URL::asset('assets/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{ URL::asset('assets/js/buttons.bootstrap.min.js')}}"></script>
    <script src="{{ URL::asset('assets/js/buttons.flash.min.js')}}"></script>
    <script src="{{ URL::asset('assets/js/buttons.html5.min.js')}}"></script>
    <script src="{{ URL::asset('assets/js/buttons.print.min.js')}}"></script>
    <script src="{{ URL::asset('assets/js/jszip.min.js')}}"></script>
    <script src="{{ URL::asset('assets/js/pdfmake.min.js')}}"></script>
    <script src="{{ URL::asset('assets/js/vfs_fonts.js')}}"></script>

    <script>

        $(document).ready(function () {

            //datatables code
            var handleDataTableButtons = function () {
                if ($("#datatable-buttons").length) {
                    $("#datatable-buttons").DataTable({
                        responsive: true,
                        dom: "Bfrtip",
                        buttons: [
                            {
                                extend: "copy",
                                className: "btn-sm"
                            },
                            {
                                extend: "csv",
                                className: "btn-sm"
                            },
                            {
                                extend: "excel",
                                className: "btn-sm"
                            },
                            {
                                extend: "pdfHtml5",
                                className: "btn-sm"
                            },
                            {
                                extend: "print",
                                className: "btn-sm"
                            },
                        ],
                        responsive: true
                    });
                }
            };

            TableManageButtons = function () {
                "use strict";
                return {
                    init: function () {
                        handleDataTableButtons();
                    }
                };
            }();

            TableManageButtons.init();

        });
    </script>
    <!-- /validator -->
@endsection
