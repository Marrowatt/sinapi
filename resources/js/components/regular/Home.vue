<template>
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
        </div>
        
        <div class="row">

            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 pt-2">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col pr-4">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"> Calorias </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">0 / 0 kcal </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-balance-scale fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 pt-2">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col pr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-2"> Macronutrientes </div>
                                <div class="row">
                                    <div class="col-3 mx-auto text-center">
                                        <div class="rounded-circle border border-danger py-3"> 0 g </div>
                                        <p class="text-xs font-weight-bold mt-2"> Carboidratos </p>                                                     
                                    </div>
                                    
                                    <div class="col-3 mx-auto text-center">
                                        <div class="rounded-circle border border-info py-3"> 0 g </div>
                                        <p class="text-xs font-weight-bold mt-2"> Gordura </p>                                                     
                                    </div>
                                    
                                    <div class="col-3 mx-auto text-center">
                                        <div class="rounded-circle border border-secondary py-3"> 0 g </div>
                                        <p class="text-xs font-weight-bold mt-2"> Proteína </p>                                                     
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 pt-2">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col pr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"> Consumo Hídrico </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"> 0 / 0 ml </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-water fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <hr class="divider text-muted">
        
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Refeições</h1>
            <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
        </div>

        <div class="row">

            <!-- <div class="col-xl-3 col-md-6 mb-4" data-toggle="seeMeal">
                <div class="card border-left-primary shadow h-100 pt-2">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col pr-4">
                                <div class="font-weight-bold text-secondary text-uppercase mb-1"> Café da Manhã </div>
                                <div class="h6 mb-0 font-weight-bold text-gray-800"> 10:00 </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-eye fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 pt-2">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col pr-2">
                                <div class="font-weight-bold text-info text-uppercase mb-1"> Adicionar Refeição </div>
                                <div class="row no-gutters align-items-center">
                                    <!-- <div class="col-auto">
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"> 750 / 2600 ml </div>
                                    </div> -->
                                </div>
                            </div>
                            <div class="col-auto">
                                <button class="btn btn-light rounded-circle border border-success px-2 py-1" data-toggle="modal" data-target="#mealcreate">
                                    <i class="fas fa-plus text-success"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <create-meal @creating="create"></create-meal>
    </div>
</template>

<script>
    export default {
        props: {
            token: String,
        },
        data () {
            return {
                message: null,
                errors: null,
                load: true,
                meals: [],
            }
        },
        mounted() {
            // console.log('Component mounted.');
        },
        methods: {
            // getMeals () {
            //     axios.get('/api/meal?api_token='+this.token).then(data => {
            //         this.meals = data.data;
            //         this.load = false;
            //     });
            // },
            toNull () {
                this.message = null;
                this.errors = null;
            },
            create (payload) {
                this.toNull();
                axios.post('/api/meal?api_token='+this.token, payload.meal).then(data => {
                    this.message = "Refeição criada!";
                    alert('foi?')
                    // this.getMeals();
                }).catch(error => {
                    if (error.response.status == 422) this.errors = error.response.data;
                    if (error.response.status == 500) this.errors = {Erro: {message: "Erro! Tente novamente mais tarde."}};
                    // this.getMeals();
                    console.log(this.errors);
                    alert('não ne')
                });
            },
        }
    }
</script>
