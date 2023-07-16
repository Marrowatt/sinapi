<template>
  <div class="container-fluid" style="min-height: 81vh">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Pacientes</h1>
    </div>

    <div class="row mt-3">
        <div class="text-center mx-auto" v-if="!load"> Espere. </div>
        <div v-else class="table-responsive col-md-12">

            <div class="row">
                <p class="ml-3"> {{ patients.total }} encontrados | {{ x }} até {{ y }} de {{ patients.total }} pacientes </p>
            </div>

            <table class="table table-striped table-hover">
                <thead>
                    <th class="text-center"> Nome </th>
                    <th class="text-center"> Ações </th>
                </thead>

                <tbody class="text-center">
                    <tr v-for="(p, index) in patients.data" :key="index">
                        <td> {{ p.name }} </td>
                        <td> <button class="btn btn-primary m-1 rounded" data-toggle="modal" data-target="#seePatient" @click="patient = p">
                                <i class="fa fa-eye m-1"></i> </button> 
                             <a class="btn btn-warning m-1 rounded" href="#nutritionalGuidance" data-toggle="modal" @click="patient = p">
                                <i class="fa fa-carrot m-1 text-white"></i> </a>  
                             <button class="btn btn-danger m-1 rounded" @click="trash(p)"> <i class="fa fa-unlink m-1"></i> </button> </td>
                    </tr>
                </tbody>
            </table>
        </div>
        
        <div class="mx-auto pb-0 pt-3">
            <pagination :changePage="getPatients" :data="patients" @summer="summer"/>
        </div>

        <div class="modal fade bd-example-modal-lg" id="seePatient" tabindex="-1" role="dialog" aria-labelledby="teste" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <seepatient :token="token" :patient="patient" ></seepatient>
                </div>
            </div>
        </div>
        
        <div class="modal fade bd-example-modal-lg" id="nutritionalGuidance" tabindex="-1" role="dialog" aria-labelledby="teste" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <editmealspatient :token="token" :patient="patient" :foods="foods"></editmealspatient>
                </div>
            </div>
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
            patient: {},
            mealing: {},
            mealong: {},
            summer: 0,
            counts: 0,
            x: 0,
            y: 0,
        };
    },
    mounted() {
        this.getFoods();
        this.getPatients();
    },
    methods: {
        getPatients() {
            axios.get("/nutritionist/getPatients?api_token=" + this.token).then((data) => {
                this.patients = data.data;
                this.counts = 0;
                if (this.patients.from != null) this.counts = this.patients.to - this.patients.from + 1;
                this.x = this.patients.from ? this.patients.from : 0;
                this.y = this.patients.to ? this.patients.to : 0;
                this.load = true;
            });
        },
        getFoods() {
            axios.get("/getFood").then((data) => {
                this.foods = data.data;
            });
        },
        toNull() {
            this.message = null;
            this.errors = null;
        },
        trash(patient) {
            Swal.fire({
                title: "Opa!",
                text: "Tem certeza de que quer desvincular?",
                icon: "warning",
                confirmButtonText: "OK",
                showCancelButton: true,
                cancelButtonText: "Cancelar",
            }).then((result) => {
                if (result.isConfirmed) {
                    this.toNull();

                    axios.patch("/api/nutritionist/unlink/" + patient.id + "?api_token=" + this.token).then((data) => {

                        this.message = "Paciente desvinculado!";
                        this.getPatients();
                    }).catch((error) => {
                        if (error.response.status == 422)
                            this.errors = error.response.data;
                        if (error.response.status == 500)
                            this.errors = {
                                Erro: { message: "Erro! Tente novamente mais tarde." },
                            };
                        this.getPatients();
                    });
                }                                               
            });
        },
    },
};
</script>
