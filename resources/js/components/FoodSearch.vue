<template>
    <div class="container">

        <div class="container-fluid">
            <multiselect class="col-12 col-md-8 mx-auto" v-model="food" :options="foods" placeholder="Selecione: " label="name" track-by="name"></multiselect>
        </div>

        <sifu :fid='fid'></sifu>
    </div>
</template>

<script>
    export default {
        data () {
            return {
                foods: [],
                food: '',
                fid: 0,
            }
        },
        mounted () {
            this.getFood();
        },
        methods: {
            getFood () {
                axios.get('/getFood').then(data => {
                    this.foods = data.data;
                });
            },
        },
        computed: {
        },
        watch: {
            food: {
                deep: true,
                handler () {
                    this.fid = this.food.id;
                    this.$bvModal.show('bv-modal-example');
                }
            }
        }
    }
</script>
