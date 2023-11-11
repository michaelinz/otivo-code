import axios from 'axios';

export default  {

    getProductsFromApi() {
        const baseUrl = 'http://localhost:9100';

        const api = `${baseUrl}/accomodations`;

        const res = axios
            .get(api, this.formData)
            .then((res) => {
                return res;
            })
            .catch((err) => {
                throw err;
            });
        return res;
    },
}