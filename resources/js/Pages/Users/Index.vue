<template lang="">
    <layout>
        <!-- component -->
        <!--div class="w-full">
            <div class="bg-white shadow-md rounded my-6">
                <div class="w-full p-4 text-center">
                <div class="grid justify-items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="fill-current w-7 h-7" width="204" height="204" viewBox="0 0 24 24"><path d="M17.997 18h-11.995l-.002-.623c0-1.259.1-1.986 1.588-2.33 1.684-.389 3.344-.736 2.545-2.209-2.366-4.363-.674-6.838 1.866-6.838 2.491 0 4.226 2.383 1.866 6.839-.775 1.464.826 1.812 2.545 2.209 1.49.344 1.589 1.072 1.589 2.333l-.002.619zm4.811-2.214c-1.29-.298-2.49-.559-1.909-1.657 1.769-3.342.469-5.129-1.4-5.129-1.265 0-2.248.817-2.248 2.324 0 3.903 2.268 1.77 2.246 6.676h4.501l.002-.463c0-.946-.074-1.493-1.192-1.751zm-22.806 2.214h4.501c-.021-4.906 2.246-2.772 2.246-6.676 0-1.507-.983-2.324-2.248-2.324-1.869 0-3.169 1.787-1.399 5.129.581 1.099-.619 1.359-1.909 1.657-1.119.258-1.193.805-1.193 1.751l.002.463z"/></svg>
                    
                </div>
                    
                    
                    <p  class="text-3xl text-black font-semibold">{{ user.name }}</p>
                    <p class="text-gray-500 font-semibold">{{ user.email }}</p>
                </div>
            </div>
        </div-->

        <div >
    <div class="container flex justify-center py-20">
        <div class="p-3 bg-white rounded-xl max-w-lg hover:shadow">
            <div class="flex justify-between w-full"> <img src="https://history.ucr.edu/sites/g/files/rcwecm1916/files/styles/form_preview/public/blank-profile-picture-png.png?itok=MQ-iPuNG" width="150" class="rounded-lg">
                <div class="ml-2">
                    <div class="p-3">
                        <h3 class="text-2xl">{{ user.name }}</h3> <span>{{ user.email }}</span>
                    </div>
                    <div class="flex justify-between items-center p-3 bg-gray-200 rounded-lg">
                        <div class="mr-3"> <span class="text-gray-400 block">Alguma</span> <span class="font-bold text-black text-xl">34</span> </div>
                        <div class="mr-3"> <span class="text-gray-400 block">Informação</span> <span class="font-bold text-black text-xl">940</span> </div>
                        <div> <span class="text-gray-400 block">Aqui</span> <span class="font-bold text-black text-xl">8.9</span> </div>
                    </div>
                </div>
            </div>
            <div class="flex justify-between items-center mt-2 gap-2">  <button class="w-full h-12 rounded-md bg-orange-uniceplac text-white text-md hover:shadow hover:bg-green-uniceplac">Botão 1</button> <button class="w-full h-12 rounded-md bg-green-uniceplac text-white text-md hover:shadow hover:bg-orange-uniceplac">Botão 2</button></div>
        </div>
    </div>
</div>
        
        
    </layout>
</template>

<script>
import Layout from "../../Layouts/Layout";

export default {
  components: { Layout },
  props: {
    user: Object,
  },
  data() {
    return {};
  },
  methods: {},
};
</script>

<style lang="">
</style>
