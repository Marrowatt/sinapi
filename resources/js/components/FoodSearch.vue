<template>
    <div class="container">
        <div class="row">
            <div class="col">
                <input class="form-control form-control-lg" id="food" v-model="food" type="text" placeholder="Arroz, tipo 1..." data-sb-validations="required" />
                <div class="invalid-feedback text-white" data-sb-feedback="food:required">Um alimento é requerido.</div>
            </div>
            <!-- <div class="col-auto"><button class="btn btn-success btn-lg" id="submitButton" type="submit"> <i class="fa fa-search"></i> </button></div> -->
        </div>
        
        <div class="row mt-2" v-if="food.length > 2">
            <div class="col-11 mx-auto rounded bg-light py-2">
                <div class="row my-2" v-for="(f, i) in searchFoods" :key="i">
                    <a class="bg-light rounded text-lg py-1 col-10 mx-auto text-dark" @click="fid = f.id" data-bs-toggle="modal" data-bs-target="#sifu">
                        {{ f.name }}
                    </a>
                </div>
            </div>
        </div>

        <sifu :fid='fid'></sifu>
    </div>
</template>

<script>
    export default {
        data () {
            return {
                foods: {},
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
            stringador (param) {
                return param.normalize('NFD').replace(/[\u0300-\u036f]/g, "").replace(/,/g, "").toLowerCase();
            },
            search (foods, food) {
                var filter = [];

                foods.forEach(el => {
                    // var shows = this.stringador(el.name);
                    if(this.stringador(el.name).includes(this.stringador(food)) == false) return;
                    filter.push(el);
                });

                return filter;
            },
        },
        computed: {
            searchFoods: function () {
                if (this.food.length > 2) {
                    return this.search(this.foods, this.food);
                }
            }
        },
        watch: {
            food: {
                deep: true,
                handler () {
                    this.searchFoods;
                }
            }
        }
    }
</script>
