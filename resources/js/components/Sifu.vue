<template>
    <div class="modal fade" id="sifu" tabindex="-1" role="dialog" aria-labelledby="teste" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="container-fluid">
                    <div class="float-right p-3">
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Fechar"><i class="fas fa-window-close text-danger"></i></button>
                    </div>
                    <div class="row mx-1">
                        <h3 class="title-modal text-dark">{{ food.name }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            fid: Number,
        },
        data () {
            return {
                food: {},
            }
        },
        methods: {
            getOneFood () {
                axios.get('/getOneFood/'+this.fid).then(data => {
                    this.food = data.data;
                });
            }
        },
        watch: {
            fid (val) {
                this.getOneFood();
            }
        }
    }
</script>
