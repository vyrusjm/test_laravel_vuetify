<template>
    <v-app>
        <v-data-table
            :headers="headers"
            :items="desserts"
            sort-by="calories"
            class="elevation-1"
        >
            <template v-slot:top>
            <v-toolbar flat color="white">
                <v-toolbar-title>Users</v-toolbar-title>
                <v-divider
                class="mx-4"
                inset
                vertical
                ></v-divider>
                <v-spacer></v-spacer>
                <v-dialog v-model="dialog" max-width="500px">
                <template v-slot:activator="{ on }">
                    <v-btn color="primary" dark class="mb-2" v-on="on">New User</v-btn>
                </template>
                <v-card>
                    <v-card-title>
                    <span class="headline">{{ formTitle }}</span>
                    </v-card-title>

                    <v-card-text>
                    <v-container>
                        <v-row>
                        <v-col cols="12" sm="12">
                            <v-text-field
                                v-model="editedItem.name"
                                label="User name"
                            >
                            </v-text-field>
                        </v-col>
                        <v-col cols="12" sm="12">
                            <v-text-field
                                :rules="[rules.email]"
                                class="input-group--focused"
                                @click:append="show = !show"
                                v-model="editedItem.email"
                                label="Email"
                            >
                            </v-text-field>
                        </v-col>
                        <v-col cols="12" sm="12">
                            <v-text-field
                                :rules="[rules.minPhone]"
                                v-model="editedItem.phone"
                                label="Phone"
                                type="number"
                            >
                            </v-text-field>
                        </v-col>
                        <v-col cols="12" sm="12">
                            <v-text-field
                                :append-icon="show ? 'mdi-eye' : 'mdi-eye-off'"
                                :rules="[rules.min]"
                                :type="show ? 'text' : 'password'"
                                hint="At least 8 characters"
                                class="input-group--focused"
                                @click:append="show = !show"
                                v-model="editedItem.password"
                                label="Password"
                            >
                            </v-text-field>
                        </v-col>
                        <v-col cols="12" sm="12">
                            <v-text-field
                                :append-icon="show2 ? 'mdi-eye' : 'mdi-eye-off'"
                                :rules="[rules.min,passwordConfirmationRule]"
                                :type="show2 ? 'text' : 'password'"
                                hint="At least 8 characters"
                                class="input-group--focused"
                                @click:append="show2 = !show2"
                                v-model="editedItem.password_confirmation"
                                label="Password Confirmation"
                            >
                            </v-text-field>
                        </v-col>
                        </v-row>
                    </v-container>
                    </v-card-text>

                    <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="blue darken-1" text @click="close">Cancel</v-btn>

                    <template v-if="editedIndex === -1">
                        <v-btn color="blue darken-1" text @click="save">Save</v-btn>
                    </template>
                    <template v-else>
                         <v-btn color="blue darken-1" text @click="saveEditItem(editedItem)">Edit</v-btn>
                    </template>
                    </v-card-actions>
                </v-card>
                </v-dialog>
            </v-toolbar>
            </template>
            <template v-slot:item.actions="{ item }">
            <v-icon
                small
                class="mr-2"
                @click="editItem(item)"
            >
                mdi-pencil
            </v-icon>
            <v-icon
                small
                @click="deleteItem(item)"
            >
                mdi-delete
            </v-icon>
            </template>
            <template v-slot:no-data>
            <h2>No data</h2>
            </template>
        </v-data-table>
    </v-app>
</template>
<script>
  export default {
      name: 'list-users',
    data () {

      return {
        dialog: false,
        search: '',
        show: false,
        show2: false,
        rules: {
          required: value => !!value || 'Required.',
          min: v => v.length >= 8 || 'Min 8 characters',
          minPhone: v => v.length <= 10 || 'Max 10 characters',
          email: value => {
            const pattern = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
            return pattern.test(value) || 'Invalid e-mail.'
          },
        },
        headers: [
          {
            text: 'Name',
            align: 'start',
            sortable: false,
            value: 'name',
          },
          { text: 'email', value: 'email' },
          { text: 'Phone', value: 'phone' },
          { text: 'Actions', value: 'actions', sortable: false },
        ],
        editedIndex: -1,
        editedItem: {
            name: '',
            email: '',
            phone: '',
            password: '',
            password_confirmation : '',
        },
        defaultItem: {
            name: '',
            email: '',
            phone: ''
        },
      }
    },
    computed: {
        desserts() {
            return this.$store.getters.users.data;
        },
        formTitle () {
            return this.editedIndex === -1 ? 'New User' : 'Edit User'
        },
        passwordConfirmationRule() {
            return () => (this.editedItem.password === this.editedItem.password_confirmation) || 'Password must match confirmation'
        },
    },
    watch: {
      dialog (val) {
        val || this.close()
      },
    },
    methods: {

      editItem (item) {
        this.editedIndex = this.desserts.indexOf(item);
        this.editedItem = Object.assign({}, item);
        this.dialog = true;

      },
      saveEditItem(editedItem){
        const index = editedItem.id;
        axios.put('/api/users/'+index, editedItem)
        .then((response) => {
            this.$store.dispatch('getUsers');
            this.close();
        })
        .catch((error) => {
            console.log(error.response);
        });
      },

      deleteItem (item) {
        const index = item.id;
        confirm('Are you sure you want to delete this item?') && axios.delete('/api/users/'+index)
        .then((response) => {
            this.$store.dispatch('getUsers');
            this.close();
        })
        .catch((error) => {
            console.log(error.response);
        });
      },

      close () {
        this.dialog = false
        setTimeout(() => {
          this.editedItem = Object.assign({}, this.defaultItem)
          this.editedIndex = -1
        }, 300)
      },

      save () {
        axios.post('/api/users', this.editedItem)
        .then((response) => {
            this.$store.dispatch('getUsers');
            this.close();
        })
        .catch((error) => {
            console.log(error.response);
        });
      },
    },
    mounted() {
        this.$store.dispatch('getUsers');
    },
  }
</script>
<style scoped>
.btn-wrapper {
    text-align: right;
    margin-bottom: 20px;
}
</style>
