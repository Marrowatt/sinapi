<template>
  <div class="container-fluid" v-if="load">Espere</div>
  <div class="container-fluid" v-else>
    <div class="float-right p-3 mt-2">
      <button
        type="button"
        class="close"
        data-dismiss="modal"
        aria-label="Fechar"
      >
        <i class="fas fa-window-close text-danger"></i>
      </button>
    </div>
    <div class="row mx-1 mt-2">
      <h3 class="title-modal">{{ patient.name }}</h3>
    </div>

    <div class="row mx-1 mt-2">
      <div
        class="col-12 col-md-6 mb-4"
        data-toggle="seeMeal"
        v-for="(m, i) in meals"
        :key="i"
      >
        <div class="card border-left-primary shadow h-100 pt-2">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col pr-4">
                <div
                  class="font-weight-bold text-secondary text-uppercase mb-1"
                >
                  {{ m.nickname }}
                </div>
                <div class="h6 mb-0 font-weight-bold text-gray-800">
                  {{ m.hour }}
                </div>
              </div>
              <div class="col-auto">
                <button
                  class="btn btn-light rounded-circle border px-2 py-1"
                  data-toggle="modal"
                  data-target="#seemeal"
                  @click="mealing = m"
                >
                  <i class="fas fa-eye text-gray-300"></i>
                </button>
                <button
                  class="btn btn-light rounded-circle border border-warning bg-warning px-2 py-1"
                  data-toggle="modal"
                  data-target="#editmeal"
                  @click="mealong = m"
                >
                  <i class="fas fa-pen text-white"></i>
                </button>
                <button
                  class="btn btn-light rounded-circle border border-danger bg-danger px-2 py-1"
                  @click="trash2(m)"
                >
                  <i class="fas fa-trash text-white"></i>
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-12 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 pt-2">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col pr-2">
                <div class="font-weight-bold text-info text-uppercase mb-1">
                  Adicionar Refeição
                </div>
              </div>
              <div class="col-auto">
                <button
                  class="btn btn-light rounded-circle border border-success px-2 py-1"
                  data-toggle="modal"
                  data-target="#mealcreate"
                >
                  <i class="fas fa-plus text-success"></i>
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <create-meal :comidas="foods" @creating="create" v-if="foods"></create-meal>
    <edit-meal
      :comidas="foods"
      @editing="edite"
      :meal="mealong"
      v-if="foods"
    ></edit-meal>
    <see-meal :mealing="mealing"></see-meal>
  </div>
</template>

<script>
export default {
  props: {
    token: String,
    patient: Object,
    foods: Array,
  },
  data() {
    return {
      load: true,
      meals: [],
      mealing: {},
      mealong: {},
    };
  },
  methods: {
    getPatientMeals() {
      axios
        .get(
          "/api/regular/" + this.patient.id + "/meal?api_token=" + this.token
        )
        .then((data) => {
          this.meals = data.data;
        });
    },
    create(payload) {
      payload.meal.user = this.patient.id;

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
          this.getPatientMeals();
        });
    },
    edite(payload) {
      payload.meal.user = this.patient.id;

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
          this.getPatientMeals();
        });
    },
    trash2(meal) {
      Swal.fire({
        title: "Opa!",
        text: "Tem certeza de que quer excluir?",
        icon: "warning",
        confirmButtonText: "OK",
        showCancelButton: true,
        cancelButtonText: "Cancelar",
      }).then((result) => {
        if (result.isConfirmed) {
          meal.user = this.patient.id;

          axios
            .patch(
              "/api/meal/" + meal.id + "/changestatus?api_token=" + this.token
            )
            .then((data) => {
              this.message = "Refeição excluída!";
              this.getPatientMeals();
            })
            .catch((error) => {
              if (error.response.status == 422)
                this.errors = error.response.data;
              if (error.response.status == 500)
                this.errors = {
                  Erro: { message: "Erro! Tente novamente mais tarde." },
                };
              this.getPatientMeals();
            });
        }
      });
    },
  },
  watch: {
    patient(val) {
      this.getPatientMeals();
      this.load = false;
    },
  },
};
</script>