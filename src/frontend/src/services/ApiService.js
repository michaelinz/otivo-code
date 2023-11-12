import axios from 'axios';



export default  {

    getProductsFromApi(currentPageNum, pageDataSize, selectedLocationType='', selectedLocation='') {

        const api = `${import.meta.env.VITE_API_URL}/accomodations?locationType=${selectedLocationType}&location=${selectedLocation}&currentPage=${currentPageNum}&pageSize=${pageDataSize}`;

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

        const api = `${import.meta.env.VITE_API_URL}/areas`;

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

        const api = `${import.meta.env.VITE_API_URL}/suburbs`;

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