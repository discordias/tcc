<template lang="">
    <div class="grid-cols-12">
        <layout>
            <div class="flex justify-between">
                    <div class="text-white text-4xl">
                        Eixos
                    </div>
                    <inertia-link
                        class="text-white text-center text-xl capitalize rounded-md bg-green-500 hover:bg-green-600 pl-2 pr-3 py-3 font-bold"
                        href="/eixo"
                        ><i class="fas fa-tv opacity-75 mr-2 text-sm"></i>
                        Lista</inertia-link>
            </div>
            <Axle-form :form="form" @salvar="salvar"></Axle-form>
        </layout>
    </div>
</template>

<script>

import Layout from '../../Layouts/Layout';
import AxleForm from '../../Components/Forms/AxleForm';

export default {
    components: {
        Layout,
        AxleForm,
    },
    props: {
        axle: {},
    },
    data() {
        return {
            form: {},
        }
    },

    methods: {
        salvar() {
           this.form.put(this.route('eixo.store', this.axle.id), {
                onFinish: () => this.form.reset(),
            })
        }
    },

    mounted() {
       this.form = this.$inertia.form(this.axle);
    }
}
</script>

<style lang="">

</style>
