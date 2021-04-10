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
    },
    data() {
        return {
            form: this.$inertia.form({
                name: '',
                description: '',
            })
        }
    },

    methods: {
        salvar() {
           this.form.post(this.route('eixo.store'), {
                onFinish: () => this.form.reset(),
            })
        }
    },
 }
</script>

<style lang="">

</style>
