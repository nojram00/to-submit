<template lang="">
    <div class="min-h-screen flex flex-col">
        <Header />
        <div class="flex">
            <Sidebar />
            <main class="flex-1">
                <div class="p-5 h-screen float-start flex-row gap-5 justify-center w-full">
                    <div class="flex flex-col m-5">
                        <div>
                            <button @click="NavCreate"
                                class="btn btn-accent text-xl">
                                Create
                            </button>
                        </div>
                    </div>
                    <ProductTable />
                </div>
            </main>
        </div>
    </div>
</template>
<script setup>
import ProductTable from '@/components/ProductTable.vue'
import Sidebar from '@/components/Sidebar.vue'
import Header from '@/components/Header.vue';
import router from '@/router';


const NavCreate = () => {
    router.push({ path : '/create-product' })
}

</script>
<style lang="">

</style>
