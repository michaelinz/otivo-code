<script >

import ApiService from '../services/ApiService';
import { ref, watch } from "vue";



export default {

  setup() {

    const isloading = ref(true);

    const products = ref([]);



    function search() {
      isloading.value = true;
      ApiService.getProductsFromApi(
        ).then((res) => {
          console.log(res)
          products.value = res.data.products;
          isloading.value = false;
        });
    }


    search();



    return {
      isloading,
      products,
    }
  },
}

</script>

<template>
  <main>

    <h1>Home page</h1>

    <div class="container">



      <h1 v-if="isloading" class="mt-4 mb-5 text-center animated-dots"></h1>

      <h2 v-if="!products.length && !isloading" class="text-center mt-5 mb-5">
        No results found
      </h2>
      <div v-if="products.length" class="row mt-5 mb-5">
        <div v-for="product in products" class="col-lg-4 p-4 text-center ">
          <div class="productCard">
            <img class="w-100" :src="product.productImage">
            <div class="">
              {{ product.productName }}
            </div>
          </div>
        </div>
      </div>

      <br><br>
    </div>
  </main>
</template>


