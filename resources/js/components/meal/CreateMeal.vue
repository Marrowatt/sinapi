<template>
<div class="modal fade" id="mealcreate" tabindex="-1" role="dialog" aria-labelledby="teste" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="container-fluid">
                <div class="float-right p-3">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <i class="fas fa-window-close text-warning"></i>
                    </button>
                </div>

                <h4 class="mt-3">Refeição</h4>

                <div class="row">
                    <div class="form-group col-12 col-md-8">
                        <label for="name"> Nome: <span class="text-danger">*</span> </label>
                        <input class="form-control" type="text" name="name" id="name" v-model="meal.nickname" required>
                    </div>
                    
                    <div class="form-group col-12 col-md-4">
                        <label for="name"> Hora: <span class="text-danger">*</span> </label>
                        <input class="form-control" type="time" name="hour" id="hour" v-model="meal.hour" required>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-12" v-for="(f, i) in meal.foods" :key="i">
                        <div class="row mt-2">
                            <div class="col-12 col-md-7">
                                <label for="food"> Alimento: <span class="text-danger">*</span> </label>
                                <multiselect v-model="f.food" :options="comidas" placeholder="Selecione: " label="name" track-by="name"></multiselect>
                            </div>
                            <div class="col-6 col-md-3">
                                <label for="quantity"> Quantidade: <span class="text-danger">*</span> </label>
                                <input class="form-control" type="number" name="quantity" id="quantity" v-model="f.quantity" required>
                            </div>
                            <div class="col-6 col-md-2 text-center mt-4">
                                <button class="btn btn-outline-danger btn-sm btn-block rounded py-2 mt-2" @click="subFood(i)">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="col-3 mt-2">
                        <button class="btn btn-primary btn-sm btn-block rounded py-2" @click="addFood">
                            <i class="fa fa-plus"></i>
                        </button>
                    </div>
                </div>

                <div class="col-10 mx-auto">
                    <button class="btn btn-block btn-primary mt-4 mb-3" data-dismiss="modal" aria-label="Fechar" @click="sendToUp">Salvar</button>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
    export default {
        props: {
            comidas: Array,
        },
        data () {
            return {
                meal: {
                    nickname: '',
                    hour: '',
                    foods: [{
                        food: '',
                        quantity: 0
                    }]
                }
            }
        },
        methods: {
            sendToUp () {

                this.meal.foods.forEach(el => {
                    el.food = el.food.name;
                });

                this.$emit('creating', { meal: this.meal });
            },
            addFood () {
                this.meal.foods.push({food: "", quantity: 0});
            },
            subFood (ind) {
                this.meal.foods.splice(ind, 1);
            },
        }
    }
</script>