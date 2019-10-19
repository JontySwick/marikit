import axios from 'axios';

function getRandomIntInclusive(min, max) {
    min = Math.ceil(min);
    max = Math.floor(max);
    return Math.floor(Math.random() * (max - min + 1)) + min;
}

export default {
    getProducts(callback) {
        let products = {};
        axios
            .get("/names.json")
            .then((response) => {
                products = response.data;
                axios
                    .get("/data.json")
                    .then((response) => {
                        let currencyValue = getRandomIntInclusive(20, 80);
                        console.log(currencyValue);
                        this.offers = response.data.Value.Goods;
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

                        callback(products);
                        setTimeout(() => {
                            this.getProducts(callback);
                        }, 15000);
                    })
                    .catch((error) => {
                        console.log(error);
                    });
            })
            .catch(error => console.log(error));
    },

    /*buyProducts (products, cb, errorCb) {
      setTimeout(() => {
        // simulate random checkout failure.
        (Math.random() > 0.5 || navigator.userAgent.indexOf('PhantomJS') > -1)
          ? cb()
          : errorCb()
      }, 100)
    }*/
}
