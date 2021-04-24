<template lang="">
    <div class="grid grid-cols-3 2xl:grid-cols-7 gap-2 border border-gray-200 rounded">
        <div class="p-2 col-span-3 2xl:col-start-3 p-8 ">

            <div class="w-full flex flex-col justify-center text-center">
                <div class="mb-4"><b class="w-full block py-2 px-3 border rounded-md border-gray-300">Nome:</b> <p class="mt-4">{{certificate.user.name}}</p></div>
                <div class="mb-4"><b class="w-full block py-2 px-3 border rounded-md border-gray-300">Titulo: </b> <p class="mt-4">{{certificate.title}}</p></div>
                <div class="mb-4"><b class="w-full block py-2 px-3 border rounded-md border-gray-300">Situação:</b> <p class="mt-4">{{certificate.type_situation.name}}</p></div>
                <div class="mb-4"><b class="w-full block py-2 px-3 border rounded-md border-gray-300">Eixo:</b> <p class="mt-4">{{certificate.axle?.name}}</p></div>
                <div class="mb-4"><b class="w-full block py-2 px-3 border rounded-md border-gray-300">Descrição:</b> <p class="mt-4">{{certificate.description}}</p></div>
            </div>

            <div class="flex flex-row justify-end text-center mb-4">
                <a  :href="getRouteDownload(certificate.id)"
                    target="_blank"
                    class="text-white ml-2 text-center capitalize rounded-md bg-green-500 hover:bg-green-600 pl-2 pr-3 py-2 font-bold"
                >Visualizar Arquivo</a>
            </div>

        </div>
    </div>
</template>

<script>

export default {
    props: {
        certificate: Object,
    },
    data() {
        return {

        }
    },
    methods: {
        getRouteDownload(id) {
            if (this.$page.props.hasHole.admin || this.$page.props.hasHole.validator) {
                return this.route('validator.certificates.download', id);
            } else {
                return this.route('certificates.download', id);
            }
        }
    },
}
</script>
