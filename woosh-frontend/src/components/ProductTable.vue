<template lang="">
    <div class="overflow-x-auto w-full" >
        <center v-if="isLoading" class="min-h-screen w-[100vw]">
            <span class="loading loading-spinner loading-lg"></span>
        </center>
        <div v-else class="w-full">
            <table class="table w-full text-lg" >
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="product in products">
                        <td>{{ product.name }}</td>
                        <td>{{ product.category }}</td>
                        <td>
                            <div class="inline-flex gap-3">
                                <button @click="execute('delete' ,product)">Delete</button>
                                <button @click="execute('view' ,product)">View</button>
                                <button @click="execute('update' ,product)">Update</button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>

            <div class="join m-3">
                <!-- Previous Button -->
                <button v-on:click="prevBtn" class="btn join-item">
                    Prev
                </button>

                <div class=" flex items-center text-center bg-blue-400">
                    <p class="px-3 text-black">
                        {{ page }}
                    </p>
                </div>

                <!-- Next Button -->
                <button v-on:click="nextBtn" class="btn join-item">
                    Next
                </button>
            </div>
        </div>

        <!-- Modals -->

        <dialog id="delete_modal" class="modal">
            <div class="modal-box">
                <h3 class="text-lg font-bold">Prompt</h3>
                <p class="py-4">Are you sure you want to delete this product?</p>
                <div class="modal-action">
                <form method="dialog">
                    <!-- if there is a button in form, it will close the modal -->
                     <div class="join">
                         <button class="btn join-item" @click="deleteData(prod_id)" >Yes</button>
                         <button class="btn join-item">No</button>
                     </div>
                </form>
                </div>
            </div>
        </dialog>

        <dialog id="delete_message_modal" class="modal">
            <div class="modal-box">
                <h3 class="text-lg font-bold">Prompt</h3>
                <p class="py-4">Product deleted!</p>
                <div class="modal-action">
                <form method="dialog">
                    <!-- if there is a button in form, it will close the modal -->
                    <button class="btn" @click="reload">Close</button>
                </form>
                </div>
            </div>
        </dialog>

        <dialog id="delete_failed_modal" class="modal">
            <div class="modal-box">
                <h3 class="text-lg font-bold">Prompt</h3>
                <p class="py-4">Product failed to delete!</p>
                <div class="modal-action">
                <form method="dialog">
                    <!-- if there is a button in form, it will close the modal -->
                    <button class="btn">Close</button>
                </form>
                </div>
            </div>
        </dialog>

        <dialog id="description_modal" class="modal">
            <div class="modal-box">
                <h3 class="text-lg font-bold">{{ name }}</h3>
                <p class="py-4">{{ description }}</p>
                <div class="modal-action">
                <form method="dialog">
                    <!-- if there is a button in form, it will close the modal -->
                    <button class="btn">Close</button>
                </form>
                </div>
            </div>
        </dialog>
    </div>
</template>
<script setup>
import { ref, onMounted } from 'vue'
import axios from 'axios'
import { getToken } from '@/cookie';
import router from '@/router';

const products = ref([])
const nextBtnUrl = ref("")
const prevBtnUrl = ref("")
const page = ref()
const isLoading = ref(true)
const prod_id = ref()
const description = ref("(No description available)")
const name = ref("")


const fetchData = async (url) => {
    try {
        // const link = url === null ? "http://127.0.0.1:8000/api/products" : url

        const res = await axios.get(url, {
            headers : {
                'Authorization' : `Bearer ${getToken()}`
            }
        });

        page.value = res.data.current_page
        nextBtnUrl.value = res.data.links[res.data.links.length - 1].url
        prevBtnUrl.value = res.data.links[0].url
        products.value = res.data.data

        if (isLoading.value){
            isLoading.value = false
        }

    } catch (error) {
        console.error(error)
    }
}

const execute = (action, item) => {
    prod_id.value = item.id
    switch (action) {
        case 'delete':
            delete_modal.showModal()
            break;
        case 'view':
            name.value = item.name

            description.value = item.description !== null ? item.description : "(No description available)";

            description_modal.showModal()
            break;
        case 'update':
            router.push({ path : `/products/${item.id}` })
            break;

    }
}

const deleteData = async (id) => {
    try {
        const res = await axios.delete(`http://127.0.0.1:8000/api/product/${id}`, {
            headers : {
                'Authorization' : `Bearer ${getToken()}`
            }
        });

        if(res.status == 200){
            delete_message_modal.showModal()
            return
        }

        delete_failed_model.showModal()
    } catch (error) {

    }
}

const reload = () => {
    fetchData("http://127.0.0.1:8000/api/products")
}

defineProps({
    data : [
        {
            id : Number,
            name : String,
            category : String,
            description : String
        }
    ]
})

onMounted(() => {
    fetchData("http://127.0.0.1:8000/api/products")
})

const nextBtn = () => {
    if(isLoading === false){
        isLoading = true
    }
    fetchData(nextBtnUrl.value)
}

const prevBtn = () => {
    fetchData(prevBtnUrl.value)
}
</script>
<style lang="">

</style>
