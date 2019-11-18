<template>
    <div>
        <div class="row">
            <a href="/create">Create Product</a>
        </div>
        <h4 class="text-left font-weight-bold">Products</h4>
        <table class="table table-striped" width="100%">
            <thead>
                <tr>
                    <th scope="col">Sku</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="product in products">
                    <td>{{product.sku}}</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        name: "Product",
        data() {
            return {
                products: []
            }
        },
        mounted() {
            this.loadData()
        },
        methods: {
            loadData: function() {
                axios.get('/api/products').then(res => {
                    console.log( res)
                    if (res.status === 200) {
                        this.products = res.data;
                        console.log( 'products' )
                        console.log( this.products )
                    }
                }).catch(err => {
                    console.log(err)
                })
            }
        }
    }
</script>

<style scoped>

</style>
