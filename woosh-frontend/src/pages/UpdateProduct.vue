<template lang="">
    <div class="min-h-screen flex flex-col">
        <Header />
        <div class="inline-flex">
            <Sidebar />
            <main class="flex-1">
                <center v-if="isLoading" class="min-h-screen w-[100vw]">
                    <span class="loading loading-spinner loading-lg"></span>
                </center>
                <div v-else class="p-5 min-h-screen flex flex-col gap-5 items-center w-full">
                    <h2 class="text-2xl">Edit Product: {{ product.name }}</h2>
                    <div class="container">
                        <div class="flex flex-col gap-3 justify-center items-center">
                            <label class="input input-bordered w-full max-w-xs flex items-center gap-2">
                                <span class="text-blue-500">Name</span>
                                <input v-model="product.name" type="text" class="grow"/>
                            </label>
                            <select v-model="product.category" class="select select-bordered w-full max-w-xs">
                                <option disabled selected>Category</option>
                                <option value="Consumable">Consumable</option>
                                <option value="Non-Consumable">Non-Consumable</option>
                            </select>
                            <textarea v-model="product.description" class="textarea textarea-bordered w-full max-w-xs" placeholder="Description"></textarea>
                            <label class="input input-bordered w-full max-w-xs flex items-center gap-2">
                                <span class="text-blue-500">Datetime</span>
                                <input v-model="product.datetime" type="datetime-local" class="grow w-5"/>
                            </label>

                            <div>
                                <button class="btn btn-success" @click="updateProduct">Update</button>
                            </div>

                            <dialog id="success_modal" class="modal">
                                <div class="modal-box">
                                    <h3 class="text-lg font-bold">Prompt</h3>
                                    <p class="py-4">Update Success!</p>
                                    <div class="modal-action">
                                    <form method="dialog">
                                        <!-- if there is a button in form, it will close the modal -->
                                        <button class="btn" @click="back">Ok</button>
                                    </form>
                                    </div>
                                </div>
                            </dialog>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</template>
<script setup>
import Sidebar from '@/components/Sidebar.vue';
import Header from '@/components/Header.vue';
import { getToken } from '@/cookie';
import axios from 'axios';
import { onMounted, ref } from 'vue';
import { useRoute } from 'vue-router';
import router from '@/router';


const product = ref({})
const route = useRoute()
const isLoading = ref(true)

const prodId = route.params.productid

const updateProduct = async () => {
    try {
        const res = await axios.patch(`http://127.0.0.1:8000/api/product/${prodId}`, product.value, {
            headers : {
                'Authorization' : `Bearer ${getToken()}`
            }
        });

        if(res.status === 200){
            console.log(res.data.message)
            success_modal.showModal()
        }
    } catch (error) {

    }
}

const back = () => {
    console.log("Back")
    router.push({ path : '/products' })
}

const fetchProduct = async () => {
    try {
        const res = await axios.get(`http://127.0.0.1:8000/api/product/${prodId}`, {
            headers : {
                'Authorization' : `Bearer ${getToken()}`
            }
        })

        if(res.status === 200){
            product.value = res.data.product
            isLoading.value = false

            console.log(isLoading)
        }


    } catch (error) {

    }
}

onMounted(() => {
    fetchProduct()
})

</script>
<style lang="">

</style>
