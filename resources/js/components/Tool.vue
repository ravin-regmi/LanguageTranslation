<template>
    <div>
        <heading class="mb-6">Language Translation</heading>

        <loading-view :loading="initialLoading">
            <loading-card :loading="loading" class="card relative">
                <table
                        class="table w-full"
                        cellpadding="0"
                        cellspacing="0"
                        data-testid="resource-table"
                >
                    <thead>
                    <tr>
                        <th class="text-left">
                            <span class="inline-flex items-center">
                             Translation Key
                            </span>
                        </th>
                        <th class="text-left">
                          <span class="inline-flex items-center">
                             French
                          </span>
                        </th>
                        <th class="text-left">
                          <span class="inline-flex items-center">
                             English
                          </span>
                        </th>
                        <th class="text-left">
                          <span class="inline-flex items-center">
                             German
                          </span>
                        </th>
                        <th class="text-left">
                          <span class="inline-flex items-center">
                             Spanish
                          </span>
                        </th>
                        <th>&nbsp;<!-- View --></th>
                    </tr>
                    </thead>

                    <tbody v-for="(item, index) in translationsFr" :key="index">
                    <tr>
                        <td colspan="4">{{ item.key }}</td>
                        <td  class="td-fit text-right pr-6 align-middle">
                            <div class="inline-flex text-right">
                                <a tabindex="0" class="btn btn-default btn-primary" @click="addNewTranslation(index)">Add</a>
                            </div>
                        </td>
                    </tr>
                    <tr v-for="(item_1, index_1) in item.value" :key="index+'-'+index_1">
                        <td>
                            <input placeholder="Translation key" :name="'key'+'['+item.key+']'+'['+item_1.key+']'" v-model="translations[defaultLang][index]['value'][index_1].key" class="form-control form-input form-input-bordered" v-bind:class="translations[defaultLang][index]['value'][index_1].disabled">
                        </td>
                        <td>
                            <input placeholder="In French" :name="'fr'+'['+index+']'+'['+index_1+']'" v-model="translations['fr'][index]['value'][index_1].value" class="form-control form-input form-input-bordered" v-bind:class="translations['fr'][index]['value'][index_1].disabled">
                        </td>
                        <td>
                            <input placeholder="In English" :name="'en'+'['+index+']'+'['+index_1+']'" v-model="translations['en'][index]['value'][index_1].value" class="form-control form-input form-input-bordered" v-bind:class="translations['en'][index]['value'][index_1].disabled">
                        </td>
                        <td>
                            <input placeholder="In German" :name="'de'+'['+index+']'+'['+index_1+']'" v-model="translations['de'][index]['value'][index_1].value" class="form-control form-input form-input-bordered" v-bind:class="translations['de'][index]['value'][index_1].disabled">
                        </td>
                        <td>
                            <input placeholder="In Spanish" :name="'es'+'['+index+']'+'['+index_1+']'" v-model="translations['es'][index]['value'][index_1].value" class="form-control form-input form-input-bordered" v-bind:class="translations['es'][index]['value'][index_1].disabled">
                        </td>
                        <td class="td-fit text-right pr-6 align-middle">
                            <div class="inline-flex items-center">
                                <span class="inline-flex">
                                    <a v-if="translations[defaultLang][index]['value'][index_1]['disabled'] !== ''" @click="editTranslation(index, index_1)" class="cursor-pointer text-70 hover:text-primary mr-3 inline-flex items-center has-tooltip">
                                        <icon type="edit" width="22" height="18" view-box="0 0 22 16" />
                                    </a>
                                    <a v-else @click="editTranslation(index, index_1)" class="cursor-pointer text-70 hover:text-primary mr-3 inline-flex items-center has-tooltip">
                                        <svg id="Capa_1" enable-background="new 0 0 512.007 512.007" width="22" height="18" viewBox="0 0 512.007 512.007" xmlns="http://www.w3.org/2000/svg">
                                            <g>
                                                <path d="m511.927 126.537c-.279-2.828-1.38-5.666-3.315-8.027-.747-.913 6.893 6.786-114.006-114.113-2.882-2.882-6.794-4.395-10.612-4.394-9.096 0-329.933 0-338.995 0-24.813 0-45 20.187-45 45v422c0 24.813 20.187 45 45 45h422c24.813 0 45-20.187 45-45 .001-364.186.041-339.316-.072-340.466zm-166.927-96.534v98c0 8.271-6.729 15-15 15h-19v-113zm-64 0v113h-139c-8.271 0-15-6.729-15-15v-98zm64 291h-218v-19c0-8.271 6.729-15 15-15h188c8.271 0 15 6.729 15 15zm-218 161v-131h218v131zm355-15c0 8.271-6.729 15-15 15h-92c0-19.555 0-157.708 0-180 0-24.813-20.187-45-45-45h-188c-24.813 0-45 20.187-45 45v180h-52c-8.271 0-15-6.729-15-15v-422c0-8.271 6.729-15 15-15h52v98c0 24.813 20.187 45 45 45h188c24.813 0 45-20.187 45-45v-98h2.787l104.213 104.214z"/>
                                            </g>
                                        </svg>
                                    </a>
                                </span>
                                <span class="inline-flex">
                                    <a @click="removeTranslation(index, index_1)" class="cursor-pointer text-70 hover:text-primary mr-3 inline-flex items-center has-tooltip">
                                        <icon type="delete" width="22" height="18" view-box="0 0 22 16" />
                                    </a>
                                </span>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <div class="flex items-center">
                    <a tabindex="0" class="btn btn-link dim cursor-pointer text-80 ml-auto mr-6" v-bind:href="'/nova/language-translation'">Cancel</a>
                    <button type="button" @click="saveTranslations" class="btn btn-default btn-primary inline-flex items-center relative">
                        <span class="">Save</span>
                    </button>
                </div>
            </loading-card>
        </loading-view>
    </div>
</template>

<script>
    import _ from 'lodash';

    export default {
        name: 'Tool',
        metaInfo() {
            return {
              title: 'LanguageTranslation',
            }
        },
        data() {
            return {
                translations: [],
                translationsFr: [],
                translationsEn: [],
                translationsDe: [],
                translationsEs: [],
                defaultLang: 'fr',
                initialLoading: true,
                loading: true,
            }
        },
        methods: {
            getTranslations() {
                Nova.request().get('/nova-vendor/language-translation/translations/get-translation')
                    .then((response) => {
                        this.translations = _.cloneDeep(response.data.translations);
                        this.translationsFr = this.translations.fr;
                        this.translationsEn = this.translations.en;
                        this.translationsDe = this.translations.de;
                        this.translationsEs = this.translations.es;
                        this.defaultLang = response.data.defaultLang;
                        this.initialLoading = false;
                        this.loading = false;
                        console.log("translation = ", this.translations, this.translationsFr.length, this.translationsFr[0]['value'].length);
                    })
            },
            saveTranslations() {
                Nova.request().post('/nova-vendor/language-translation/translations/save-translation',
                    {translations: this.translations})
                    .then((response) => {
                        console.log("post response = ", response);
                        Nova.success(this.__(response.message));
                        this.$toasted.show(response.message, { type: 'success' });
                    })
            },
            addNewTranslation(index) {
                this.translationsFr[index]['value'].push({prevKey: '', key: '', value: ''});
                this.translationsEn[index]['value'].push({prevKey: '', key: '', value: ''});
                this.translationsDe[index]['value'].push({prevKey: '', key: '', value: ''});
                this.translationsEs[index]['value'].push({prevKey: '', key: '', value: ''});
            },
            removeTranslation(index, index_1) {
                this.translationsFr[index]['value'].splice(index_1, 1);
                this.translationsEn[index]['value'].splice(index_1, 1);
                this.translationsDe[index]['value'].splice(index_1, 1);
                this.translationsEs[index]['value'].splice(index_1, 1);
            },
            editTranslation(index, index_1) {
                const disabled = this.translationsFr[index]['value'][index_1].disabled === '' ? 'disabled' : '';
                this.translationsFr[index]['value'][index_1].disabled = disabled;
                this.translationsEn[index]['value'][index_1].disabled = disabled;
                this.translationsDe[index]['value'][index_1].disabled = disabled;
                this.translationsEs[index]['value'][index_1].disabled = disabled;
            }
        },
        mounted() {
        },
        created() {
            this.getTranslations();
        },
        updated() {
            console.log("english trans = ", this.translationsEn, this.translations)
        }
    }
</script>

<style>
/* Scoped Styles */
</style>
