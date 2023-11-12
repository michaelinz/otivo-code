<script >

import ApiService from '../services/ApiService';
import SearchSelect from '../components/SearchSelect.vue';
import ProductDialog from './ProductDialog.vue';
import { ref, watch } from "vue";
import { useRoute, useRouter } from 'vue-router'

export default {
  components: {
    SearchSelect,
    ProductDialog
  },

  setup() {
    const route = useRoute()
    const router = useRouter()

    const isloading = ref(true);

    const products = ref([]);
    const areas = ref([]);
    const suburbs = ref([]);

    const selectedLocationType = ref(route.query?.selectedLocationType ? route.query.selectedLocationType : 'ar');
    const selectedLocation = ref(route.query?.selectedLocation ? route.query.selectedLocation : '');

    const selectedPage = ref(route.query?.selectedPage ? route.query.selectedPage : 1);
    const selectedPageSize = ref(route.query?.selectedPageSize ? route.query.selectedPageSize : 20);

    const isProductDialogOpen = ref(false);
    const dialogProductData = ref(null);

    const results = ref(0);


    ApiService.getAreasFromApi().then((res) => {
      if (res.data && res.data.length) {
        areas.value = res.data.map((area) => {
          return area.Name
        });
      }
    });

    ApiService.getSuburbsFromApi().then((res) => {
      if (res.data && res.data[0]?.Suburbs?.length) {
        suburbs.value =  res.data[0].Suburbs.map((suburb) => {
          return suburb.Name
        });
      }
    });

    function search() {
      isloading.value = true;

      ApiService.getProductsFromApi(
        selectedPage.value, selectedPageSize.value,
        selectedLocationType.value, selectedLocation.value
      ).then((res) => {
        console.log(res)
        products.value = res.data.products;
        results.value = res.data.numberOfResults
        isloading.value = false;
      });

      router.push({
        query: {
          selectedLocationType: selectedLocationType.value,
          selectedLocation: selectedLocation.value,
          selectedPage: selectedPage.value,
          selectedPageSize: selectedPageSize.value,
        }
      })
      window.scrollTo(0, 0);

    }

    function openProductDialog(product) {
      dialogProductData.value = product;
      isProductDialogOpen.value = true;
    }

    watch(selectedPage, (newSelectedPage, oldSelectedPage) => {
      if (newSelectedPage !== oldSelectedPage) {
        search();
      }
    });

    search();

    return {
      results,
      isloading,
      openProductDialog,
      search,
      products,
      areas,
      suburbs,
      selectedPage,
      selectedPageSize,
      dialogProductData,
      isProductDialogOpen,
      selectedLocation,
      selectedLocationType,
    }
  },
}

</script>

<template>
  <main>

    <h1>Home page</h1>

    <div class="container">

      <div class="d-flex justify-content-between flex-wrap">
        <h3>Search</h3>
        <div class="d-flex ">

          <select class="form-select w-50 mx-2" id="pageSizeSelect" v-model="selectedLocationType">
            <option value='ar'>Filter by Area</option>
            <option value='ct'>Filter by City/Suburb</option>
          </select>

          <SearchSelect v-if="areas.length && selectedLocationType == 'ar'" class="mx-2 w-50" :options="areas"
            placeholder="Enter Area" v-model="selectedLocation" />
          <SearchSelect v-if="suburbs.length && selectedLocationType == 'ct'" class="mx-2 w-50" :options="suburbs"
            placeholder="Enter City/Suburb" v-model="selectedLocation" />

          <select class="form-select w-50 mx-2" id="pageSizeSelect" v-model="selectedPageSize">
            <option :value=10>10 per page</option>
            <option :value=20>20 per page</option>
            <option :value=50>50 per page</option>
          </select>

          <button @click="search" class="btn btn-primary">Search</button>
        </div>
      </div>

      <h1 v-if="isloading" class="mt-4 mb-5 text-center animated-dots"></h1>

      <h2 v-if="!products.length && !isloading" class="text-center mt-5 mb-5">
        No results found
      </h2>
      <div v-if="products.length" class="row mt-5 mb-5">
        <div v-for="product in products" class="col-lg-4 p-4 text-center ">
          <div @click="openProductDialog(product)" class="productCard">
            <img class="w-100" :src="product.productImage">
            <div class="">
              {{ product.productName }}
            </div>
          </div>
        </div>
      </div>
      <div class="d-flex justify-content-center">
        {{ results }} results found, page {{ selectedPage }} of {{ Math.ceil(results / selectedPageSize) }}
      </div>

      <div class="d-flex justify-content-center mb-5">
        <button v-if="selectedPage != 1" class="mx-2 btn btn-primary" @click="selectedPage--">Previous page</button>
        <button class="btn btn-primary mx-2" @click="selectedPage++">Next page</button>
      </div>
      <br><br>
    </div>
  </main>
  <ProductDialog v-model="isProductDialogOpen" :data="dialogProductData" />
</template>

<style>
.productCard {
  border-radius: 10px;
  border: 1px solid #e6e6e6;
  padding: 0px;
  box-shadow: 0 0 4px 0 rgba(48, 49, 51, .15);
  transition: box-shadow .3s ease-in-out;
}

.productCard:hover {
  box-shadow: 0 10px 10px 0 rgba(48, 49, 51, .15);
}

@keyframes loadingDots {

  0%,
  60% {
    content: '.';
  }

  20%,
  80% {
    content: '..';
  }

  40% {
    content: '...';
  }
}

.animated-dots::before {
  content: '.';
  animation: loadingDots 3s infinite steps(1);
  text-align: left;
  display: inline-block;
}
</style>
