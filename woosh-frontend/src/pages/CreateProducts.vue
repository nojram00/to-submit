<template lang="">
    <div class="min-h-screen flex flex-col">
        <Header />
        <div class="inline-flex">
            <Sidebar/>
            <main class="flex-1">
                <div class="p-5 min-h-screen flex flex-col gap-5 justify-center items-center w-full">
                    <div class="">
                        <h1 class="text-2xl">Create Product</h1>
                        <progress class="progress w-56" :value="step" max="3"></progress>
                    </div>
                    <div class="container">
                        <div v-if="step == 1" class="flex flex-col items-center
                        justify-between gap-5 w-full">
                            <input v-model="name" type="text" placeholder="Name" class="input input-bordered w-full max-w-xs" />
                            <select v-model="category" class="select select-bordered w-full max-w-xs">
                                <option disabled selected>Category</option>
                                <option value="Consumable">Consumable</option>
                                <option value="Non-Consumable">Non-Consumable</option>
                            </select>
                            <textarea v-model="description" class="textarea textarea-bordered w-[350px]" placeholder="Description"></textarea>
                            <button @click="proceed_step_2" class="btn btn-primary">Next</button>
                        </div>

                        <div v-if="step == 2" class="flex flex-col gap-5 items-center justify-between w-full">
                            <input @change="handleFile" type="file" class="file-input file-input-bordered file-input-info w-full max-w-xs" />
                            <button @click="proceed_step_3" class="btn btn-primary">Next</button>
                        </div>

                        <div class="flex flex-col gap-3 justify-between items-center" v-if="step == 3">
                            <input v-model="datetime" type="datetime-local" class="input input-bordered w-full max-w-xs"/>
                            <button @click="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </div>
            </main>
        </div>

         <!-- Modals -->

         <dialog id="success_modal" class="modal">
            <div class="modal-box">
                <h3 class="text-lg font-bold">Success!</h3>
                <p class="py-4">Product created!</p>
                <div class="modal-action">
                <form method="dialog">
                    <!-- if there is a button in form, it will close the modal -->
                    <button class="btn" :click="done">Close</button>
                </form>
                </div>
            </div>
        </dialog>

        <dialog id="invalid_modal" class="modal">
            <div class="modal-box">
                <h3 class="text-lg font-bold">Oppss!</h3>
                <p class="py-4">Please Input a {{ field }}</p>
                <div class="modal-action">
                <form method="dialog">
                    <!-- if there is a button in form, it will close the modal -->
                    <button class="btn">Close</button>
                </form>
                </div>
            </div>
        </dialog>

        <!-- End Modals -->
    </div>
</template>
<script setup>
import Sidebar from '@/components/Sidebar.vue';
import Header from '@/components/Header.vue';
import { getToken } from '@/cookie';
import axios from 'axios';
import { ref } from 'vue';
import router from '@/router';

const step = ref(1)

const name = ref("")
const category = ref("")
const description = ref("")
const datetime = ref(Date.now())
const image_file = ref(null)

const field = ref('')

const proceed_step_2 = () => {
    if (name.value === "" || category.value === ""){
        field.value = "Name and Category"
        invalid_modal.showModal()
        console.error("Invalid Input!");
        return
    }

    console.log("Proceed!")
    step.value = 2
}

const proceed_step_3 = () => {
    if(image_file.value !== null && image_file.value.type.startsWith('image/')){
        console.log("Proceed!")
        step.value = 3
        return
    }
    field.value = "Image File"
    invalid_modal.showModal()
    console.error('Invalid Input!')
}

const submit = async () => {

    try {
        const res = await axios.post("http://127.0.0.1:8000/api/add-product", {
            name : name.value,
            category : category.value,
            description : description.value,
            datetime : datetime.value
        }, {
            headers : {
                'Authorization' : `Bearer ${getToken()}`
            }
        })

        if(res.status == 200){
            success_modal.showModal()
        }

    } catch (error) {

    }
}

const handleFile = (event) => {
    const file = event.target.files[0]
    console.log(file)

    if(file) {
        image_file.value = file
        console.log("Image: "+ image_file.value.type.startsWith('image/')) // Check if it is an image/png, image/jpg
    }
}

const done = () => {
    router.push({ path : '/products' })
}

</script>
<style lang="">

</style>
