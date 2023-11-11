<script>
import { computed } from "vue";

export default {
    props: {
        data: Object,
    },

    setup(props) {
        return {
        };
    },
};
</script>

<template>
    <v-dialog class="dialog" max-width="850">
        <div v-if="data.productName" class="bg-light overflow-auto">
            <img v-if="data.productImage" class="w-100" :src="data.productImage" />
            <div class="">
                <h3>{{ data.productName }}</h3>

                <p>{{ data.productDescription }}</p>
            </div>
            <div v-if="data.addresses.length" class="mt-2">
                <h4>Addresses</h4>
                <div v-for="address in data.addresses" class=" ">
                    {{ address.address_line }}
                    {{ address.address_line2 }}
                    {{ address.area[0] }}
                    {{ address.city }}
                    {{ address.state }}
                    {{ address.postcode }}

                </div>
            </div>
        </div>
    </v-dialog>
</template>
<style></style>