<script lang="ts" setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { TextInput, Modal } from 'custom-mbd-components'
import type { User } from '@/types'
import { useForm } from '@inertiajs/vue3'


const props = defineProps<{
    user:User;
    campinggrounds:Campingground;
}>();

const newCampinggroundForm = useForm<Omit<Campingground,'id'|'updated_at'|'created_at'>>();

function submit(){
    return new Promise<void>((resolve,reject)=>{
        newCampinggroundForm.post(route('campingground.create'),{
            onSuccess:()=>{
                resolve()
            },
            onError: ()=>{
                reject()
            }
        })
    })
}

</script>
<template>
    <AuthenticatedLayout>
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    Campingplätze
                    <Modal 
                        title="Campingplatz hinzufügen" 
                        :affirm="{
                            text: 'Hinzufügen',
                            action: submit
                        }"
                    >
                    <!-- TODO: add Modal content -->
                        <template #button>
                            <Button class="btn btn-primary p-2" style="min-height: unset"><i class="bi bi-plus-circle"></i></Button>
                        </template>
                    </Modal>
                </div>
            </div>
            <div class="card-body">
                <div v-for="ground of campinggrounds">
                    <div class="row">
                        <div class="col-6" v-for="[key,value] of Object.entries(ground)">
                            <TextInput v-model="campinggrounds[key]" :placeholder="key" disabled/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>