<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/inertia-vue3';
import { onMounted, reactive, ref, computed } from 'vue';
import { Inertia } from '@inertiajs/inertia';
import BreezeValidationErrors from '@/Components/ValidationErrors.vue'; 
import MicroModal from '@/Components/MicroModal.vue';
import { getToday } from '@/common';

const props = defineProps({
    errors: Object,
    'items': Array,
})

onMounted(() => { // ページ読み込み後、即座に実行
    form.date = getToday();

    props.items.forEach( item => {
        itemList.value.push({
            id: item.id,
            name: item.name,
            price: item.price,
            quantity: 0,
        });
    });
});

const itemList = ref([]); // リアクティブな配列を準備

const form = reactive({
    customer_id: null,
    date: null,
    status: true,
    items: [],
});

const totalPrice = computed(() => {
    let total = 0;
    itemList.value.forEach( item => {
        total += item.price * item.quantity
    });
    return total;
});

const storePurchase = () => {
    itemList.value.forEach( item => {
        if(item.quantity > 0) {
            form.items.push({
                id: item.id,
                quantity: item.quantity,
            })
        }
    });
    Inertia.post(route('purchases.store'), form);
};

const quantityList = [ "0", "1", "2", "3", "4", "5", "6", "7", "8", "9", ];

const setCustomerId = id => {
    form.customer_id = id;
}

</script>

<template>
    <Head title="購入画面" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">購入画面</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="p-6 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <BreezeValidationErrors :errors="errors" class="mb-4" />
                    <section class="text-gray-600 body-font relative">
                        <form @submit.prevent="storePurchase">
                            <div class="container px-5 py-8 mx-auto">
                                <div class="lg:w-1/2 md:w-2/3 mx-auto">
                                    <div class="flex flex-wrap -m-2">
                                        <div class="p-2 w-full">
                                            <div class="relative">
                                                <label for="date" class="leading-7 text-sm text-gray-600">日付</label>
                                                <input type="date" id="date" name="date" v-model="form.date" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                            </div>
                                        </div>
                                        <div class="p-2 w-full">
                                            <div class="relative">
                                                <label for="customer" class="leading-7 text-sm text-gray-600">会員名</label>
                                                <MicroModal @update:customerId="setCustomerId" />
                                            </div>
                                        </div>
                                        <div class="w-full mt-8 mx-auto overflow-auto">
                                            <table class="table-auto w-full text-left whitespace-no-wrap">
                                                <thead>
                                                    <tr>
                                                        <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">ID</th>
                                                        <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">商品名</th>
                                                        <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">金額</th>
                                                        <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">数量</th>
                                                        <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">小計</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr v-for="item in itemList" :key="item.id">
                                                        <td class="border-t-2 border-b-2 border-gray-200 px-4 py-3">
                                                            {{ item.id }}
                                                        </td>
                                                        <td class="border-t-2 border-b-2 border-gray-200 px-4 py-3">
                                                            {{ item.name }}
                                                        </td>
                                                        <td class="border-t-2 border-b-2 border-gray-200 px-4 py-3">
                                                            {{ item.price }}
                                                        </td>
                                                        <td class="border-t-2 border-b-2 border-gray-200 px-4 py-3">
                                                            <select name="quantiry" v-model="item.quantity">
                                                                <option v-for="q in quantityList" :value="q">
                                                                    {{ q }}
                                                                </option>
                                                            </select>
                                                        </td>
                                                        <td class="border-t-2 border-b-2 border-gray-200 px-4 py-3">
                                                            {{ item.price * item.quantity }}
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="p-2 w-full">
                                            <div class="">
                                                <label for="price" class="leading-7 text-sm text-gray-600">合計金額</label>
                                                <div class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                                    {{ totalPrice }} 円
                                                </div>
                                            </div>
                                        </div>
                                        <div class="p-2 w-full">
                                            <button class="flex mx-auto text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">
                                                登録する
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
