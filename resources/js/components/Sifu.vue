<template>
  <div>
    <b-modal id="bv-modal-example" size="lg" hide-footer>
      <template #modal-title>
        <div v-if="loading == false">
          <h4 class="modal-title">{{ food.name }}</h4>
          <span class="text-capitalize"> {{ food.category.name }} </span>
        </div>
      </template>

      <div v-if="loading == false">
        <div class="row">
          <b-card
            title="Food Info"
            class="col-12 p-0 mx-auto my-1 text-dark"
            no-body
          >
            <b-tabs card>
              <b-tab no-body title="CMVCol" v-if="food.cmvcol">
                <div class="row">
                  <div class="col-5 mx-auto">
                    <b-list-group flush>
                      <b-list-group-item
                        href="#"
                        v-if="food.cmvcol.energy_kcal"
                      >
                        Energia: {{ food.cmvcol.energy_kcal }} kcal |
                        {{ food.cmvcol.energy_kj }} kJ
                      </b-list-group-item>
                      <b-list-group-item
                        href="#"
                        v-if="food.cmvcol.cholesterol_mg"
                      >
                        Colesterol: {{ food.cmvcol.cholesterol_mg }} mg
                      </b-list-group-item>
                      <b-list-group-item href="#" v-if="food.cmvcol.ashes_g">
                        Cinzas: {{ food.cmvcol.ashes_g }} g
                      </b-list-group-item>
                      <b-list-group-item href="#" v-if="food.cmvcol.calcium_mg">
                        Cálcio: {{ food.cmvcol.calcium_mg }} mg
                      </b-list-group-item>
                      <b-list-group-item href="#" v-if="food.cmvcol.copper_mg">
                        Cobre: {{ food.cmvcol.copper_mg }} mg
                      </b-list-group-item>
                      <b-list-group-item
                        href="#"
                        v-if="food.cmvcol.carbohydrate_g"
                      >
                        Carboidrato: {{ food.cmvcol.carbohydrate_g }} g
                      </b-list-group-item>
                      <b-list-group-item href="#" v-if="food.cmvcol.fiber_g">
                        Fibra: {{ food.cmvcol.fiber_g }} g
                      </b-list-group-item>
                      <b-list-group-item
                        href="#"
                        v-if="food.cmvcol.humidity_percents"
                      >
                        Umidade: {{ food.cmvcol.humidity_percents }} %
                      </b-list-group-item>
                      <b-list-group-item href="#" v-if="food.cmvcol.iron_mg">
                        Ferro: {{ food.cmvcol.iron_mg }} mg
                      </b-list-group-item>
                      <b-list-group-item href="#" v-if="food.cmvcol.lipidius_g">
                        Lipídeos: {{ food.cmvcol.lipidius_g }} g
                      </b-list-group-item>
                      <b-list-group-item
                        href="#"
                        v-if="food.cmvcol.magnesium_mg"
                      >
                        Magnésio: {{ food.cmvcol.magnesium_mg }} mg
                      </b-list-group-item>
                      <b-list-group-item
                        href="#"
                        v-if="food.cmvcol.manganese_mg"
                      >
                        Manganês: {{ food.cmvcol.manganese_mg }} mg
                      </b-list-group-item>
                      <b-list-group-item href="#" v-if="food.cmvcol.niacin_mg">
                        Niacina: {{ food.cmvcol.niacin_mg }} mg
                      </b-list-group-item>
                    </b-list-group>
                  </div>

                  <div class="col-5 mx-auto">
                    <b-list-group flush>
                      <b-list-group-item
                        href="#"
                        v-if="food.cmvcol.phosphorus_mg"
                      >
                        Fósforo: {{ food.cmvcol.phosphorus_mg }} mg
                      </b-list-group-item>
                      <b-list-group-item
                        href="#"
                        v-if="food.cmvcol.potassium_mg"
                      >
                        Potássio: {{ food.cmvcol.potassium_mg }} mg
                      </b-list-group-item>
                      <b-list-group-item href="#" v-if="food.cmvcol.protein_g">
                        Proteínas: {{ food.cmvcol.protein_g }} g
                      </b-list-group-item>
                      <b-list-group-item
                        href="#"
                        v-if="food.cmvcol.pyridoxine_mg"
                      >
                        Piridoxina: {{ food.cmvcol.pyridoxine_mg }} mg
                      </b-list-group-item>
                      <b-list-group-item href="#" v-if="food.cmvcol.rae_mcg">
                        RAE: {{ food.cmvcol.rae_mcg }} mcg
                      </b-list-group-item>
                      <b-list-group-item href="#" v-if="food.cmvcol.re_mcg">
                        RE: {{ food.cmvcol.re_mcg }} mcg
                      </b-list-group-item>
                      <b-list-group-item
                        href="#"
                        v-if="food.cmvcol.retinol_mcg"
                      >
                        Retinol: {{ food.cmvcol.retinol_mcg }} mcg
                      </b-list-group-item>
                      <b-list-group-item
                        href="#"
                        v-if="food.cmvcol.riboflavin_mg"
                      >
                        Riboflavina: {{ food.cmvcol.riboflavin_mg }} mg
                      </b-list-group-item>
                      <b-list-group-item href="#" v-if="food.cmvcol.sodium_mg">
                        Sódio: {{ food.cmvcol.sodium_mg }} mg
                      </b-list-group-item>
                      <b-list-group-item href="#" v-if="food.cmvcol.tiamina_mg">
                        Tiamina: {{ food.cmvcol.tiamina_mg }} mg
                      </b-list-group-item>
                      <b-list-group-item
                        href="#"
                        v-if="food.cmvcol.vitaminC_mg"
                      >
                        Vitamina C: {{ food.cmvcol.vitaminC_mg }} mg
                      </b-list-group-item>
                      <b-list-group-item href="#" v-if="food.cmvcol.zinc_mg">
                        Zinco: {{ food.cmvcol.zinc_mg }} mg
                      </b-list-group-item>
                    </b-list-group>
                  </div>
                </div>
              </b-tab>

              <b-tab title="Aminoácidos" v-if="food.aminoacid">
                <div class="row">
                  <div class="col-5 mx-auto">
                    <b-list-group flush>
                      <b-list-group-item
                        href="#"
                        v-if="food.aminoacid.alanine_g"
                      >
                        Alanina: {{ food.aminoacid.alanine_g }} g
                      </b-list-group-item>
                      <b-list-group-item
                        href="#"
                        v-if="food.aminoacid.arginine_g"
                      >
                        Arginina: {{ food.aminoacid.arginine_g }} g
                      </b-list-group-item>
                      <b-list-group-item
                        href="#"
                        v-if="food.aminoacid.aspartic_g"
                      >
                        Ácido Aspártico: {{ food.aminoacid.aspartic_g }} g
                      </b-list-group-item>
                      <b-list-group-item
                        href="#"
                        v-if="food.aminoacid.cystine_g"
                      >
                        Cistina: {{ food.aminoacid.cystine_g }} g
                      </b-list-group-item>
                      <b-list-group-item
                        href="#"
                        v-if="food.aminoacid.glutamic_g"
                      >
                        Ácido Glutâmico: {{ food.aminoacid.glutamic_g }} g
                      </b-list-group-item>
                      <b-list-group-item
                        href="#"
                        v-if="food.aminoacid.glycine_g"
                      >
                        Glicina: {{ food.aminoacid.glycine_g }} g
                      </b-list-group-item>
                      <b-list-group-item
                        href="#"
                        v-if="food.aminoacid.histidine_g"
                      >
                        Histidina: {{ food.aminoacid.histidine_g }} g
                      </b-list-group-item>
                      <b-list-group-item
                        href="#"
                        v-if="food.aminoacid.isoleucine_g"
                      >
                        Isoleucina: {{ food.aminoacid.isoleucine_g }} g
                      </b-list-group-item>
                      <b-list-group-item
                        href="#"
                        v-if="food.aminoacid.leucine_g"
                      >
                        Leucina: {{ food.aminoacid.leucine_g }} g
                      </b-list-group-item>
                    </b-list-group>
                  </div>

                  <div class="col-5 mx-auto">
                    <b-list-group flush>
                      <b-list-group-item
                        href="#"
                        v-if="food.aminoacid.lysine_g"
                      >
                        Lisina: {{ food.aminoacid.lysine_g }} g
                      </b-list-group-item>
                      <b-list-group-item
                        href="#"
                        v-if="food.aminoacid.methionine_g"
                      >
                        Metionina: {{ food.aminoacid.methionine_g }} g
                      </b-list-group-item>
                      <b-list-group-item
                        href="#"
                        v-if="food.aminoacid.phenylalanine_g"
                      >
                        Fenilalanina: {{ food.aminoacid.phenylalanine_g }} g
                      </b-list-group-item>
                      <b-list-group-item
                        href="#"
                        v-if="food.aminoacid.proline_g"
                      >
                        Prolina: {{ food.aminoacid.proline_g }} g
                      </b-list-group-item>
                      <b-list-group-item
                        href="#"
                        v-if="food.aminoacid.serine_g"
                      >
                        Serina: {{ food.aminoacid.serine_g }} g
                      </b-list-group-item>
                      <b-list-group-item
                        href="#"
                        v-if="food.aminoacid.threonine_g"
                      >
                        Treonina: {{ food.aminoacid.threonine_g }} g
                      </b-list-group-item>
                      <b-list-group-item
                        href="#"
                        v-if="food.aminoacid.tryptophan_g"
                      >
                        Triptofano: {{ food.aminoacid.tryptophan_g }} g
                      </b-list-group-item>
                      <b-list-group-item
                        href="#"
                        v-if="food.aminoacid.tyrosine_g"
                      >
                        Tirosina: {{ food.aminoacid.tyrosine_g }} g
                      </b-list-group-item>
                      <b-list-group-item
                        href="#"
                        v-if="food.aminoacid.valine_g"
                      >
                        Valina: {{ food.aminoacid.valine_g }} g
                      </b-list-group-item>
                    </b-list-group>
                  </div>
                </div>
              </b-tab>

              <b-tab title="Ácidos Graxos" v-if="food.ag">
                <div class="row">
                  <div class="col-5 mx-auto">
                    <b-list-group flush>
                      <b-list-group-item href="#" v-if="food.ag.ag_12_0_g">
                        12:0 : {{ food.ag.ag_12_0_g }} g
                      </b-list-group-item>
                      <b-list-group-item href="#" v-if="food.ag.ag_14_0_g">
                        14_0 : {{ food.ag.ag_14_0_g }} g
                      </b-list-group-item>
                      <b-list-group-item href="#" v-if="food.ag.ag_14_1_g">
                        14:1 : {{ food.ag.ag_14_1_g }} g
                      </b-list-group-item>
                      <b-list-group-item href="#" v-if="food.ag.ag_16_0_g">
                        16:0 : {{ food.ag.ag_16_0_g }} g
                      </b-list-group-item>
                      <b-list-group-item href="#" v-if="food.ag.ag_16_1_g">
                        16:1 : {{ food.ag.ag_16_1_g }} g
                      </b-list-group-item>
                      <b-list-group-item href="#" v-if="food.ag.ag_18_0_g">
                        18:0 : {{ food.ag.ag_18_0_g }} g
                      </b-list-group-item>
                      <b-list-group-item href="#" v-if="food.ag.ag_18_1_g">
                        18:1 : {{ food.ag.ag_18_1_g }} g
                      </b-list-group-item>
                      <b-list-group-item href="#" v-if="food.ag.ag_18_1t_g">
                        18:1t : {{ food.ag.ag_18_1t_g }} g
                      </b-list-group-item>
                      <b-list-group-item href="#" v-if="food.ag.ag_18_2t_g">
                        18:2t : {{ food.ag.ag_18_2t_g }} g
                      </b-list-group-item>
                      <b-list-group-item href="#" v-if="food.ag.ag_18_2_n_6_g">
                        18:2 n-6 : {{ food.ag.ag_18_2_n_6_g }} g
                      </b-list-group-item>
                      <b-list-group-item href="#" v-if="food.ag.ag_18_3_n_3_g">
                        18:3 n-3 : {{ food.ag.ag_18_3_n_3_g }} g
                      </b-list-group-item>
                    </b-list-group>
                  </div>

                  <div class="col-5 mx-auto">
                    <b-list-group flush>
                      <b-list-group-item href="#" v-if="food.ag.ag_20_0_g">
                        20:0 : {{ food.ag.ag_20_0_g }} g
                      </b-list-group-item>
                      <b-list-group-item href="#" v-if="food.ag.ag_20_1_g">
                        20:1 : {{ food.ag.ag_20_1_g }} g
                      </b-list-group-item>
                      <b-list-group-item href="#" v-if="food.ag.ag_20_4_g">
                        20:4 : {{ food.ag.ag_20_4_g }} g
                      </b-list-group-item>
                      <b-list-group-item href="#" v-if="food.ag.ag_20_5_g">
                        20:5 : {{ food.ag.ag_20_5_g }} g
                      </b-list-group-item>
                      <b-list-group-item href="#" v-if="food.ag.ag_22_0_g">
                        22:0 : {{ food.ag.ag_22_0_g }} g
                      </b-list-group-item>
                      <b-list-group-item href="#" v-if="food.ag.ag_22_5_g">
                        22:5 : {{ food.ag.ag_22_5_g }} g
                      </b-list-group-item>
                      <b-list-group-item href="#" v-if="food.ag.ag_22_6_g">
                        22:6 : {{ food.ag.ag_22_6_g }} g
                      </b-list-group-item>
                      <b-list-group-item href="#" v-if="food.ag.ag_24_0_g">
                        24:0 : {{ food.ag.ag_24_0_g }} g
                      </b-list-group-item>
                      <b-list-group-item
                        href="#"
                        v-if="food.ag.monounsaturated_g"
                      >
                        Monoinsaturados: {{ food.ag.monounsaturated_g }} g
                      </b-list-group-item>
                      <b-list-group-item
                        href="#"
                        v-if="food.ag.polyunsaturated_g"
                      >
                        Poliinsaturados: {{ food.ag.polyunsaturated_g }} g
                      </b-list-group-item>
                      <b-list-group-item href="#" v-if="food.ag.saturated_g">
                        Saturados: {{ food.ag.saturated_g }} g
                      </b-list-group-item>
                    </b-list-group>
                  </div>
                </div>
              </b-tab>
            </b-tabs>
          </b-card>
        </div>
      </div>
    </b-modal>
  </div>
</template>

<script>
export default {
  props: {
    fid: Number,
  },
  data() {
    return {
      food: {},
      loading: true,
    };
  },
  methods: {
    getOneFood() {
      axios.get("/getOneFood/" + this.fid).then((data) => {
        this.food = data.data;
        this.loading = false;
      });
    },
  },
  watch: {
    fid(val) {
      this.getOneFood();
    },
  },
};
</script>
