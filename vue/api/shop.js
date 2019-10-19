import axios from 'axios';
//Не уверен что она должна быть здесь, но пусть будет
function getRandomIntInclusive(min, max) {
    min = Math.ceil(min);
    max = Math.floor(max);
    return Math.floor(Math.random() * (max - min + 1)) + min;
}

export default {
    getProducts(callback) {
        let products = {};
        //Получаем структуру списка товаров и записываем ее в переменную
        axios
            .get("/names.json")
            .then((response) => {
                products = response.data;
                //Получаем остатки по товарам
                axios
                    .get("/data.json")
                    .then((response) => {
                        this.offers = response.data.Value.Goods;

                        let currencyValue = getRandomIntInclusive(20, 80);

                        //Перебираем остаки, дописываем цену и наличие в товары
                        //в категорию дописываем флаг того, что категория не пуста
                        this.offers.forEach((offer) => {
                            let categoryId = offer.G;
                            let productId = offer.T;
                            let currentCategory = products[categoryId];
                            let currentProduct = currentCategory.B[productId];
                            if (currentProduct) {
                                currentCategory.existsAvailableGoods = true;
                                currentProduct.stockCount = offer.P;
                                currentProduct.price = offer.C * currencyValue;
                            }
                        });
                        //В колл-беке передан метод который записывает результат в state
                        callback(products);
                        //через 15с вызываем эту функцию повторно
                        setTimeout(() => {
                            this.getProducts(callback);
                        }, 15000);
                    })
                    .catch((error) => {
                        console.log(error);
                    });
            })
            .catch(error => console.log(error));
    }
}
