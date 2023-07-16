<template>
  <div class="container-fluid" style="min-height: 81vh">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>

    <div class="row">
      <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 pt-2">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col pr-4">
                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1" >
                  Calorias ({{ regular.formula }})
                  <i class="fas fa-info-circle" :title="calor"></i>
                </div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">
                  {{ regular.bmr }} kcal
                </div>
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
                <div class="text-xs font-weight-bold text-success text-uppercase mb-2" >
                  Macronutrientes
                  <i class="fas fa-info-circle" :title="macro"></i>
                </div>
                <div class="row" v-if="regular.predicts">
                  <div class="col-4 mx-auto text-center">
                    <div class="py-2">
                      {{ regular.predicts.ideal_macro.carb }} g
                    </div>
                    <span class="text-xs font-weight-bold mt-2" >Carboidrato</span >
                    <i class="fas fa-info-circle" :title="carbo"></i>
                  </div>

                  <div class="col-4 mx-auto text-center">
                    <div class="py-2">
                      {{ regular.predicts.ideal_macro.gord }} g
                    </div>
                    <span class="text-xs font-weight-bold mt-2">Gordura</span>
                    <i class="fas fa-info-circle" :title="gordo"></i>
                  </div>

                  <div class="col-4 mx-auto text-center">
                    <div class="py-2">
                      {{ regular.predicts.ideal_macro.prot }} g
                    </div>
                    <span class="text-xs font-weight-bold mt-2">Proteína</span>
                    <i class="fas fa-info-circle" :title="proto"></i>
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
              <div class="col pr-2" v-if="regular.predicts">
                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1" >
                  Consumo de Água
                  <i class="fas fa-info-circle" :title="agua"></i>
                </div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">
                  {{ regular.predicts.ideal_water_consumption }} l
                </div>
              </div>
              <div class="col-auto">
                <i class="fas fa-water fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <hr class="divider text-muted" />

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Refeições</h1>
    </div>

    <div class="row" v-if="load">
      <div class="col-xl-3 col-md-6 mb-4" data-toggle="seeMeal" v-for="(m, i) in meals" :key="i" >
        <div class="card border-left-primary shadow h-100 pt-2">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col pr-4">
                <div class="font-weight-bold text-secondary text-uppercase mb-1" >
                  {{ m.nickname }}
                </div>
                <div class="h6 mb-0 font-weight-bold text-gray-800">
                  {{ m.hour }}
                </div>
              </div>
              <div class="col-auto">
                <button class="btn btn-light rounded-circle border px-2 py-1" data-toggle="modal" data-target="#seemeal" @click="mealing = m" >
                  <i class="fas fa-eye text-gray-300"></i>
                </button>
                <button class="btn btn-light rounded-circle border border-warning bg-warning px-2 py-1" data-toggle="modal" data-target="#editmeal" @click="mealong = m" >
                  <i class="fas fa-pen text-white"></i>
                </button>
                <button class="btn btn-light rounded-circle border border-danger bg-danger px-2 py-1" @click="trash(m)" >
                  <i class="fas fa-trash text-white"></i>
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-xl-3 col-md-6 mb-4">
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
    <edit-meal :comidas="foods" @editing="edite" :meal="mealong" v-if="foods" ></edit-meal>
    <see-meal :mealing="mealing"></see-meal>
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
      meals: [],
      regular: {},
      foods: [],
      mealing: {},
      mealong: {},
      calor: "Estimativa do quanto de energia é necessário para a sobrevivência",
      macro: "Estimativa do que nos fornece energia",
      carbo: "Pães, massas, grãos, batata, frutas",
      gordo: "Manteiga, óleos, queijo, abacate",
      proto: "Carnes, ovos, legumes, leite",
      agua: "Estimativa do quanto de água deveria consumir",
    };
  },
  mounted() {
    this.getRegular();
    this.getFoods();
    this.getUserMeals();
  },
  methods: {
    getUserMeals() {
      axios
        .get("/api/regular/" + this.id + "/meal?api_token=" + this.token)
        .then((data) => {
          this.meals = data.data;
          this.load = true;
        });
    },
    toNull() {
      this.message = null;
      this.errors = null;
    },
    getRegular() {
      axios
        .get("/api/user/" + this.id + "?api_token=" + this.token)
        .then((data) => {
          this.regular = data.data;
        });
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
          this.getUserMeals();
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
          this.getUserMeals();
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
              this.getUserMeals();
            });
        }
      });
    },
  },
};
</script>
