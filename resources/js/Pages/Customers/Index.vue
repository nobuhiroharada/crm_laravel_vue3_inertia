<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
import FlashMessage from '@/Components/FlashMessage.vue';

defineProps({
    customers: Array,
});

</script>

<template>
    <Head title="顧客一覧" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">顧客一覧</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="p-6 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <section class="text-gray-600 body-font">
                        <div class="container px-5 py-8 mx-auto">
                            <FlashMessage />
                            <div class="flex pl-4 my-4 lg:w-2/3 w-full mx-auto">
                                <Link as="button" :href="route('customers.create')" class="flex ml-auto text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded">
                                    顧客登録
                                </Link>
                            </div>
                            <div class="lg:w-2/3 w-full mx-auto overflow-auto">
                                <table class="table-auto w-full text-left whitespace-no-wrap">
                                    <thead>
                                        <tr>
                                            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">ID</th>
                                            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">氏名</th>
                                            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">カナ</th>
                                            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">電話番号</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="customer in customers" :key="customer.id">
                                            <td class="border-t-2 border-b-2 border-gray-200 px-4 py-3">
                                                {{ customer.id }}
                                            </td>
                                            <td class="border-t-2 border-b-2 border-gray-200 px-4 py-3">{{ customer.name }}</td>
                                            <td class="border-t-2 border-b-2 border-gray-200 px-4 py-3">{{ customer.kana }}</td>
                                            <td class="border-t-2 border-b-2 border-gray-200 px-4 py-3">{{ customer.tel }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
