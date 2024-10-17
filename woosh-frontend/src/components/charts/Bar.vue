<template lang="">
    <div>
        <Bar
            id="chart-mah-men"
            :options="chartOptions"
            :data="chartData"
        />

        {{ data.October }}
    </div>
</template>
<script setup>
import { Bar } from 'vue-chartjs'
import { ref, onMounted, toRaw } from 'vue'
import { Chart as ChartJS, Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale } from 'chart.js'

ChartJS.register(Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale)

const props = defineProps({
    data : Object
})

var d = toRaw(props.data)

const chartData = ref({
    labels : Object.keys(d).map(key => { return key }),
    datasets: [ { data: Object.keys(d).map(key => {
        return d[key]
    }) } ]
})

const chartOptions = ref({
    responsive : true
})


</script>
<style lang="">

</style>
