  
<script>
import { ref, computed, watch, onMounted, onUpdated } from 'vue';


export default {
    props: {
        options: Array,
        placeholder: String,
        modelValue: String | Number
    },
    emits: ['update:modelValue'],
    setup(props, { emit }) {
        const searchTerm = ref(props.modelValue);
        const selectedOption = ref(null);
        const showDropdown = ref(0);

        const filteredOptions = computed(() => {
            if (searchTerm.value && searchTerm.value.length > 0) {
                return props.options.filter((option) =>
                    option.toLowerCase().includes(searchTerm.value.toLowerCase())
                );
            }
        });

        const emitSelection = (option) => {
            selectedOption.value = option;
            searchTerm.value = option;
            emit('update:modelValue', option);
            showDropdown.value = 0;
        };

            watch(searchTerm, (newSearchTerm, oldSearchTerm) => {
                console.log({oldSearchTerm:oldSearchTerm})
                if (newSearchTerm !== oldSearchTerm) {
                    selectedOption.value = null;
                    const firstOption = filteredOptions.value && filteredOptions.value.length > 0 ? filteredOptions.value[0] : null;
                    emit('update:modelValue', firstOption);
                    showDropdown.value = showDropdown.value == 0 ? 2 : 1;
                }
            });

        return {
            searchTerm,
            selectedOption,
            filteredOptions,
            emitSelection,
            showDropdown
        };
    }
};
</script>
<template>
    <div class="position-relative">
        <input class="form-control" type="text" v-model="searchTerm" :placeholder="placeholder" />
        <div v-if="showDropdown === 1 && filteredOptions && filteredOptions.length" class="search-results">
            <div class="search-result" v-for="option in filteredOptions" :key="option.id" @click="emitSelection(option)">
                {{ option }}
            </div>
        </div>
    </div>
</template>

<style>
.search-results {
    position: absolute;
    z-index: 100;
    top: 100%;
    left: 0;
    right: 0;
    background-color: #fff;
    border: 1px solid #ccc;
    border-top: none;
    list-style-type: none;
    margin: 0;
    padding: 0;
    max-height: 300px;
    overflow-y: scroll;
}

.search-result {
    padding: 8px;
    cursor: pointer;
}

.search-result:hover {
    background-color: #f2f2f2;
}
</style>