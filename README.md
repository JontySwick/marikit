<div align="center">
    <h1 align="center">Тестовое задание Marikit Holdings LTD</h1>
</div>

DIRECTORY STRUCTURE
-------------------

    PHP Part
        /news                               Список новостей
        /news/detail?id=\d                  Детальная карточка новости
        commands                            Папка с консольными командами
        components                          Собственные классы
        controllers                         Папка с контроллером новостей
    JS Part
        /site/catalog                       Страница с выполненной задачей
        vue/api/shop.js                     "Импорт" из файлов
        vue/components/shop.js              Главный компонент прилодения
        vue/components/shop.js              Компонент списка товаров
        vue/components/ShoppingCart.vue     Компонент корзины
        vue/store/modules/cart.js           Модуль для работы с состояниями корзины
        vue/store/modules/products.js       Модуль для работы с состояниями списка товаров
        vue/index.js                        Здесь собираем все модули воедино
        vue/app.js                          Главный фаил приложения
        vue/currency.js                     Фаил с фильтром форматирования цены, 
                                            который был любезно выложен в репазитории Vuex
                                            
Для запуска парсера выполните к терминале
    
    php yii parser/parse

PHP PART
-------------------

### Task
Спарсить (программно) первые 15 новостей с rbk.ru (блок, откуда брать новости показан на скриншоте)
и вставить в базу данных (составить структуру самому) или в файл.

Вывести все новости, сократив текст до 200 символов в качестве описания,
со ссылкой на полную новость с кнопкой подробнее.

На полной новости выводить картинку если есть в новости.


JS PART
-------------------

### Task


Получить данные из файла data.json и вывести их на страницу как это показано на рис."пример.png".

Показанные на рисунке параметры находятся в узле Goods.

    "C" - цена в долларах(USD) - вывести в рублях(курс выбрать произвольно),
    "G" - id группы,
    "T" - id товара,
    "P" - сколько единиц товара осталось (параметр, который указан в скобках в названии).

Сопоставления id групп и товаров с их названиями находятся в файле names.json.

После вывода данных навесить обработчики для добавления выбранного товара в корзину и удаления из нее. Пример корзины показан в файле "Корзина.png".
Сделать рассчет общей суммы товаров и вывести отдельным полем.
Корзина находится на одной и той же странице вместе со списком товаров.

(*)
Вывести данные используя привязку к представлению и возможностью последующего изменения (two-way binding). Можно использовать фреймворки. 
Сделать обновление цены товара в зависимости от курса валюты.
С интервалом в 15 секунд читать исходный файл data.json и одновременно менять курс доллара (вручную) на значение от 20 до 80, выполняя обновление данных в модели (с изменением в представлении).
Если цена увеличилось в большую сторону - подсветить ячейку красным, если в меньшую - зеленым.

Дополнительная информация: 
Дизайну, показанному в примерах, следовать не обязательно. 
Прокомментировать основные действия.
Интересные решения приветствуются.

### names.json

    {
        "1": {
            "G": "Книги",
            "B": {
                "1": {
                    "N": "Алгоритмы. Построение и анализ. Т. Кормен, Ч. Лейзерсон, Р. Ривест, К. Штайн.",
                    "T": 1
                },
                "2": {
                    "N": "Совершенный код. Стив Макконнелл.",
                    "T": 1
                },
                "3": {
                    "N": "JavaScript. Подробное руководство. Дэвид Флэнаган.",
                    "T": 1
                }
            }
        },
        "2": {
            "G": "Еда",
            "C": 2,
            "B": {
                "7": {
                    "N": "Овсяные пирожные с шоколадной прослойкой",
                    "T": 3
                },
                "8": {
                    "N": "Суп с пекинской капустой",
                    "T": 3
                },
                "85": {
                    "N": "Вишня в коньяке",
                    "T": 3
                },
                "86": {
                    "N": "Постный фаршированный перец",
                    "T": 3
                },
                "109": {
                    "N": "Салат Подсолнух",
                    "T": ""
                },
                "110": {
                    "N": "Форель «Эрланген»",
                    "T": ""
                },
                "111": {
                    "N": "Салат с морепродуктами",
                    "T": 3
                },
                "112": {
                    "N": "Тёртый пирог",
                    "T": 3
                },
                "115": {
                    "N": "Свинина, маринованная в красном вине, с кориандром",
                    "T": ""
                },
                "116": {
                    "N": "Салат с черносливом и ветчиной",
                    "T": ""
                },
                "125": {
                    "N": "Болгарский перец и цуккини на гриле",
                    "T": 3
                },
                "126": {
                    "N": "Салат «Букет нарциссов»",
                    "T": 3
                },
                "127": {
                    "N": "Салат из морепродуктов, с огурцами, рукколой и оливками",
                    "T": 3
                }
            }
        },
        "5": {
            "G": "Спорт",
            "C": 2,
            "B": {
                "184": {
                    "N": "Беговая дорожка",
                    "T": 1
                },
                "185": {
                    "N": "Гантели съемные",
                    "T": 1
                },
                "186": {
                    "N": "Ружьё охотничье",
                    "T": 1
                },
                "187": {
                    "N": "Велотренажер",
                    "T": 1
                }
            }
        },
        "8": {
            "G": "Сантехника",
            "C": 3,
            "B": {
                "4": {
                    "N": "Акриловая ванна Alpen Mars ",
                    "T": 1
                },
                "5": {
                    "N": "Смеситель Sturm Classica",
                    "T": 1
                },
                "6": {
                    "N": "Тумба с раковиной Tiffany World ",
                    "T": 1
                }
            }
        },
        "10": {
            "G": "Запчасти для машин",
            "C": 3,
            "B": {
                "191": {
                    "N": "Амортизатор задний CX-5 ",
                    "T": 3
                },
                "192": {
                    "N": "Пружина амортизатора ",
                    "T": 3
                },
                "193": {
                    "N": "Корпус воздушного фильтра ",
                    "T": 3
                },
                "194": {
                    "N": "Ремень приводной",
                    "T": 3
                },
                "195": {
                    "N": "Диффузор радиатора",
                    "T": 1
                },
                "196": {
                    "N": "Фильтр АКПП",
                    "T": 3
                }
            }
        },
        "15": {
            "G": "Сувениры",
            "C": 2,
            "B": {
                "11": {
                    "N": "Набор для рисования Пастель",
                    "T": 3
                },
                "12": {
                    "N": "Брелок-рулетка",
                    "T": 3
                },
                "63": {
                    "N": "Брелок-открывалка",
                    "T": 3
                },
                "64": {
                    "N": "Ручка-стилус шариковая",
                    "T": 3
                },
                "146": {
                    "N": "Браслет",
                    "T": 3
                },
                "147": {
                    "N": "Чехол для очков",
                    "T": 3
                },
                "148": {
                    "N": "Сумка для выставок",
                    "T": 3
                }
            }
        }
    }

### data.json

    {
      "Error": "",
      "Id": 0,
      "Success": true,
      "Value": {
        "Goods": [
          {
            "B": false,
            "C": 158,
            "CV": null,
            "G": 1,
            "P": 1,
            "Pl": null,
            "T": 1
          },
          {
            "B": false,
            "C": 197,
            "CV": null,
            "G": 1,
            "P": 99,
            "Pl": null,
            "T": 2
          },
          {
            "B": false,
            "C": 18,
            "CV": null,
            "G": 1,
            "P": 31,
            "Pl": null,
            "T": 3
          },
          {
            "B": false,
            "C": 2.14,
            "CV": null,
            "G": 2,
            "P": 15,
            "Pl": null,
            "T": 8
          },
          {
            "B": false,
            "C": 1.52,
            "CV": null,
            "G": 2,
            "P": 76,
            "Pl": null,
            "T": 86
          },
          {
            "B": false,
            "C": 5.5,
            "CV": null,
            "G": 2,
            "P": 100,
            "Pl": null,
            "T": 126
          },
          {
            "B": false,
            "C": 2.71,
            "CV": null,
            "G": 5,
            "P": 51,
            "Pl": null,
            "T": 184
          },
          {
            "B": false,
            "C": 3.95,
            "CV": null,
            "G": 5,
            "P": 2,
            "Pl": null,
            "T": 185
          },
          {
            "B": false,
            "C": 1.22,
            "CV": null,
            "G": 10,
            "P": 51,
            "Pl": null,
            "T": 194
          },
          {
            "B": false,
            "C": 1.18,
            "CV": null,
            "G": 15,
            "P": 55,
            "Pl": null,
            "T": 12
          },
          {
            "B": false,
            "C": 1.55,
            "CV": null,
            "G": 15,
            "P": 64,
            "Pl": null,
            "T": 63
          },
          {
            "B": false,
            "C": 1.55,
            "CV": null,
            "G": 15,
            "P": 77,
            "Pl": null,
            "T": 64
          }
        ]
      }
    }

