<template lang="">
    <div class="min-h-screen flex flex-col">
        <Header />
        <div class="flex">
            <Sidebar />
            <main class="flex-1">
                <center v-if="info.isLoading" class="w-full my-3">
                    <span class="loading loading-spinner loading-lg"></span>
                </center>
                <div class="h-screen w-full flex flex-col gap-5 p-5" v-else>

                    <section class="container grid grid-cols-4 gap-5">
                        <Card>
                            <div class="card-body w-[25rem]">
                                <h2 class="card-title">{{ info.count }}</h2>
                                <p>Total Items</p>
                            </div>

                            <figure>
                                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-24 h-24 py-5">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M16.5285 6C16.5098 5.9193 16.4904 5.83842 16.4701 5.75746C16.2061 4.70138 15.7904 3.55383 15.1125 2.65C14.4135 1.71802 13.3929 1 12 1C10.6071 1 9.58648 1.71802 8.88749 2.65C8.20962 3.55383 7.79387 4.70138 7.52985 5.75747C7.50961 5.83842 7.49016 5.9193 7.47145 6H5.8711C4.29171 6 2.98281 7.22455 2.87775 8.80044L2.14441 19.8004C2.02898 21.532 3.40238 23 5.13777 23H18.8622C20.5976 23 21.971 21.532 21.8556 19.8004L21.1222 8.80044C21.0172 7.22455 19.7083 6 18.1289 6H16.5285ZM8 11C8.57298 11 8.99806 10.5684 9.00001 9.99817C9.00016 9.97438 9.00044 9.9506 9.00084 9.92682C9.00172 9.87413 9.00351 9.79455 9.00718 9.69194C9.01451 9.48652 9.0293 9.18999 9.05905 8.83304C9.08015 8.57976 9.10858 8.29862 9.14674 8H14.8533C14.8914 8.29862 14.9198 8.57976 14.941 8.83305C14.9707 9.18999 14.9855 9.48652 14.9928 9.69194C14.9965 9.79455 14.9983 9.87413 14.9992 9.92682C14.9996 9.95134 14.9999 9.97587 15 10.0004C15 10.0004 15 11 16 11C17 11 17 9.99866 17 9.99866C16.9999 9.9636 16.9995 9.92854 16.9989 9.89349C16.9978 9.829 16.9957 9.7367 16.9915 9.62056C16.9833 9.38848 16.9668 9.06001 16.934 8.66695C16.917 8.46202 16.8953 8.23812 16.8679 8H18.1289C18.6554 8 19.0917 8.40818 19.1267 8.93348L19.86 19.9335C19.8985 20.5107 19.4407 21 18.8622 21H5.13777C4.55931 21 4.10151 20.5107 4.13998 19.9335L4.87332 8.93348C4.90834 8.40818 5.34464 8 5.8711 8H7.13208C7.10465 8.23812 7.08303 8.46202 7.06595 8.66696C7.0332 9.06001 7.01674 9.38848 7.00845 9.62056C7.0043 9.7367 7.00219 9.829 7.00112 9.89349C7.00054 9.92785 7.00011 9.96221 7 9.99658C6.99924 10.5672 7.42833 11 8 11ZM9.53352 6H14.4665C14.2353 5.15322 13.921 4.39466 13.5125 3.85C13.0865 3.28198 12.6071 3 12 3C11.3929 3 10.9135 3.28198 10.4875 3.85C10.079 4.39466 9.76472 5.15322 9.53352 6Z" fill="#0F0F0F"/>
                                </svg>
                            </figure>
                        </Card>

                        <Card>
                            <div class="card-body w-[25rem]">
                                <h2>{{ info.consumable_count }}</h2>
                                <p>Consumables</p>
                            </div>

                            <figure>
                                <svg fill="#000000" class="w-24 h-24 py-5" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M17 1h-2a1 1 0 0 0-1 1v16.992h4V2a1 1 0 0 0-1-1zm-6 6H9a1 1 0 0 0-1 1v10.992h4V8a1 1 0 0 0-1-1zm-6 6H3a1 1 0 0 0-1 1v4.992h4V14a1 1 0 0 0-1-1z"/></svg>
                            </figure>
                        </Card>

                        <Card>
                            <div class="card-body w-[25rem]">
                                <h2>{{ info.non_consumable_count }}</h2>
                                <p>Non Consumables</p>
                            </div>

                            <figure>
                                <svg fill="#000000" class="w-24 h-24 py-5" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M17 1h-2a1 1 0 0 0-1 1v16.992h4V2a1 1 0 0 0-1-1zm-6 6H9a1 1 0 0 0-1 1v10.992h4V8a1 1 0 0 0-1-1zm-6 6H3a1 1 0 0 0-1 1v4.992h4V14a1 1 0 0 0-1-1z"/></svg>
                            </figure>
                        </Card>
                    </section>

                    <section class="container">
                        <div class="mx-5">
                            <h1 class="text-center text-2xl">Products</h1>
                        </div>
                        <Bar
                            :data="data"
                        />
                    </section>
                </div>
            </main>
        </div>
    </div>
</template>
<script setup>
import Sidebar from '@/components/Sidebar.vue'
import Card from '@/components/Card.vue'
import Bar from '@/components/charts/Bar.vue'
import Header from '@/components/Header.vue'
import axios from 'axios'
import { ref, onMounted } from 'vue'
import { getToken } from '@/cookie'

const info = ref({
    count : 0,
    consumable_count : 0,
    non_consumable_count : 0,
    isLoading : true
})

const data = ref("")

const fetchData = async () => {

    try {
        const token = getToken()
        const res = await axios.get("http://127.0.0.1:8000/api/product-data", {
            headers : {
                "Authorization" : `Bearer ${token}`
            }
        })

        console.log(res)
        info.value.count = res.data.product_count
        info.value.consumable_count = res.data.consumables
        info.value.non_consumable_count = res.data.non_consumables

        data.value = res.data.month


        if (info.value.isLoading){
            info.value.isLoading = false
        }

    } catch (error) {

    }
}

onMounted(() => {
    fetchData()
})

</script>
<style lang="">

</style>
