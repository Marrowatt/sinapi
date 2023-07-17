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
      <div class="col-3">Peso: {{ patient.weight / 100 }} kg</div>
      <div class="col-3">IMC: {{ patient.predicts.bmi }} kg/m²</div>

      <div class="col-3">
        Porcentagem ideal de gordura:
        {{ patient.predicts.ideal_fat_percentage }} %
      </div>

      <div class="col-3">
        Consumo ideal de água: {{ patient.predicts.ideal_water_consumption }} l
      </div>
    </div>

    <div class="row mx-1 mt-2">
      <div class="col-3">Altura: {{ patient.height / 100 }} m</div>
      <div class="col-3">Idade: {{ patient.age }} anos</div>
    </div>

    <div class="row mx-1 mt-2">
      <div class="col">
        <span> Taxa Metabólica Basal: </span> <br />
        <div class="row">
          <div class="col-4">
            <p>
              Harris-Benedict: {{ patient.predicts.bmr_harris_benedict }} kcal
            </p>
          </div>
          <div class="col-4">
            <p>
              Mifflin-St. Jeor: {{ patient.predicts.bmr_mifflin_st_jeor }} kcal
            </p>
          </div>
          <div class="col-4">
            <p>FAO / OMS: {{ patient.predicts.bmr_fao_oms }} kcal</p>
          </div>
        </div>
      </div>
    </div>

    <div class="row mx-1 mt-2">
      <div class="col">
        <span> Macronutrientes: </span> <br />
        <div class="row">
          <div class="col-4">
            <p>Carboidrato: {{ patient.predicts.ideal_macro.carb }} g</p>
          </div>
          <div class="col-4">
            <p>Proteína: {{ patient.predicts.ideal_macro.prot }} g</p>
          </div>
          <div class="col-4">
            <p>Gordura: {{ patient.predicts.ideal_macro.gord }} g</p>
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
    patient: Object,
  },
  data() {
    return {
      load: true,
      patients: {},
    };
  },
  watch: {
    'patient' (val) {
        this.load = false
    }
  },
};
</script>