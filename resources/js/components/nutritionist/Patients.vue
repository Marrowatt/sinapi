<template>
  <div class="container-fluid" style="min-height: 81vh">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Pacientes</h1>
    </div>

    <div class="row mt-3">
        <div class="text-center text-info mx-auto" v-if="loading"> Carregando... </div>
        <div v-else class="table-responsive col-md-12">

            <div class="row">
                <p class="ml-3"> {{ count }} itens exibidos | {{ patients.total }} encontrados | 
                    Total por página: {{ ( sum_per_page / 100) | currency }} | Mostrando {{ x }} até {{ y }} de {{ patients.total }} registros </p>
            </div>

            <table class="table table-striped table-hover">
                <thead>
                    <th class="text-center" > Nome </th>
                    <th class="text-center "> Ações </th>
                </thead>

                <tbody>
                    <tr v-for="(p, index) in patients.data" :key="index">
                        <td> {{ p.name }} </td>
                        <td> <button class="btn btn-info m-1 rounded" data-toggle="modal" data-target="#teste" @click="fillModal(i.id, i.customer.id)">
                                <i class="fa fa-eye m-1"></i> </button> </td>
                    </tr>
                </tbody>
            </table>
            
            <div class="modal fade bd-example-modal-lg" id="teste" tabindex="-1" role="dialog" aria-labelledby="teste" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <seemodal :tk="tk" :things="theThings" :loading="loadStatus"></seemodal>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="mx-auto pb-0 pt-3">
            <Pagination :changePage="getPatients" :data="patients" @summer="summer"/>
        </div>

    </div>
  </div>
</template>

<script>
export default {
    props: {
        token: String,
        id: String,
    },
    data() {
        return {
            message: null,
            errors: null,
            load: false,
            patients: {},
            foods: [],
            mealing: {},
            mealong: {},
        };
    },
    mounted() {
        this.getPatients();
        this.getFoods();
    },
    methods: {
        getPatients() {
            axios.get("/nutritionist/getPatients?api_token=" + this.token).then((data) => {
                this.patients = data.data;
                this.load = true;
            });
        },
        toNull() {
            this.message = null;
            this.errors = null;
        },
        getFoods() {
            axios.get("/getFood").then((data) => {
                this.foods = data.data;
            });
        },
        create(payload) {
            this.toNull();
            payload.meal.user = this.regular.id;

            axios
                .post("/api/meal?api_token=" + this.token, payload.meal)
                .then((data) => {
                this.message = "Refeição criada!";
                this.getUserMeals();
                })
                .catch((error) => {
                if (error.response.status == 422) this.errors = error.response.data;
                if (error.response.status == 500)
                    this.errors = {
                    Erro: { message: "Erro! Tente novamente mais tarde." },
                    };
                this.getMeals();
                });
            },
        edite(payload) {
            this.toNull();
            payload.meal.user = this.regular.id;

            axios
                .patch(
                "/api/meal/" + payload.meal.id + "?api_token=" + this.token,
                payload.meal
                )
                .then((data) => {
                this.message = "Refeição editada!";
                this.getUserMeals();
                })
                .catch((error) => {
                if (error.response.status == 422) this.errors = error.response.data;
                if (error.response.status == 500)
                    this.errors = {
                    Erro: { message: "Erro! Tente novamente mais tarde." },
                    };
                this.getMeals();
                });
            },
        trash(meal) {
            Swal.fire({
                title: "Opa!",
                text: "Tem certeza de que quer excluir?",
                icon: "warning",
                confirmButtonText: "OK",
                showCancelButton: true,
                cancelButtonText: "Cancelar",
            }).then((result) => {
                if (result.isConfirmed) {
                this.toNull();
                meal.user = this.regular.id;

                axios
                    .patch(
                    "/api/meal/" + meal.id + "/changestatus?api_token=" + this.token
                    )
                    .then((data) => {
                    this.message = "Refeição excluída!";
                    this.getUserMeals();
                    })
                    .catch((error) => {
                    if (error.response.status == 422)
                        this.errors = error.response.data;
                    if (error.response.status == 500)
                        this.errors = {
                        Erro: { message: "Erro! Tente novamente mais tarde." },
                        };
                    this.getMeals();
                    });
                }
            });
        },
    },
};
</script>
