<template>
<div class="modal fade" id="seemeal" tabindex="-1" role="dialog" aria-labelledby="teste" aria-hidden="true" >
    <div class="modal-dialog modal-md">
        <div class="modal-content" v-if="!load">
            <div class="container-fluid">
                <div class="float-right p-3">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar" >
                        <i class="fas fa-window-close text-warning"></i>
                    </button>
                </div>

                <h4 class="mt-3">
                    Refeição - {{ mealing.nickname }} - {{ mealing.hour }}
                </h4>

                <div class="form-group">
                    <div>
                    <div class="row mt-2">
                        <div class="col-8">
                        <label for="">Alimento:</label>
                        </div>
                        <div class="col-4">
                        <label for="">Quantidade:</label>
                        </div>
                    </div>
                    </div>
                    <div class="col-10" v-for="(f, i) in mealing.foods" :key="i">
                    <div class="row mt-2">
                        <div class="col-8">
                        <h6 class="">{{ f.food.name }}</h6>
                        <span>{{ f.food.kcal }} kcal</span>
                        </div>
                        <div class="col-2">
                        <p>x</p>
                        </div>
                        <div class="col-2">
                        <p class="">{{ f.quantity }}</p>
                        </div>
                    </div>
                    </div>
                </div>

            </div>
        </div>
        
        <div class="modal-content" v-else>Aguarde..</div>
    </div>
</div>
</template>

<script>
export default {
  props: {
    mealing: Object,
  },
  data() {
    return {
      load: true,
    };
  },
  watch: {
    mealing(val) {
      this.load = false;
    },
  },
  methods: {},
};
</script>