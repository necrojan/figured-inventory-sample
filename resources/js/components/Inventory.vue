<template>
    <div>
        <div class="flex flex-col justify-center items-center pt-8">
            <h1 class="text-3xl text-gray-700 font-bold mb-8">Fertilizer Inventory</h1>
            <div>
                <label class="block">
                    <span class="m">Quantity:</span>
                    <input v-model="quantity" type="text" name="input" class="mt-2 text-xl text-gray-base w-full mr-3 py-5 px-4 h-2 border border-gray-200 rounded mb-2" />
                </label>
                <button @click="submit" class="mb-2 rounded-lg px-4 py-2 bg-blue-500 text-blue-100 hover:bg-blue-600 duration-300">Submit</button>
            </div>
        </div>
        <div class="flex flex-wrap basis-1/2 justify-center">
            <div v-if="success" class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800" role="alert">
                <span class="font-medium">{{ message }}</span>
            </div>
            <div v-else-if="!success && message" class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800" role="alert">
                <span class="font-medium">{{ message }}</span>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Inventory",
    data () {
        return {
            quantity: '',
            success: false,
            message: '',
        }
    },

    methods: {
        submit() {
            axios.post('/inventories', {
                'quantity': this.quantity
            }).then(res => {
                this.success = true;
                this.message = `Success!
                                You have applied ${this.quantity} units for $${res.data.valuation} valuation.
                                Current remaining units is ${res.data.total_units}.`;
                this.quantity = ''
            }).catch((e) => {
                this.success = false;
                this.message = `Ooh! ${e.response.data.message}`;
            })
        }
    }
}
</script>

<style scoped>

</style>
