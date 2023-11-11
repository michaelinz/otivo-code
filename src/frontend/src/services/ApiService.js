import axios from 'axios';

export default  {

    getProductsFromApi(currentPageNum, pageDataSize, selectedLocationType='', selectedLocation='') {
        const baseUrl = 'http://localhost:9100';

        const api = `${baseUrl}/accomodations?locationType=${selectedLocationType}&location=${selectedLocation}&currentPage=${currentPageNum}&pageSize=${pageDataSize}`;

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

    getAreasFromApi() {
        const baseUrl = 'http://localhost:9100';

        const api = `${baseUrl}/areas`;

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


    getSuburbsFromApi() {
        const baseUrl = 'http://localhost:9100';

        const api = `${baseUrl}/suburbs`;

        const res = axios
            .get(api, this.formData)
            .then((res) => {
                return res;
            })
            .catch((err) => {
                throw err;
            });
        return res;
    }

}