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
                <v-toolbar-title>Products</v-toolbar-title>
                <v-divider
                class="mx-4"
                inset
                vertical
                ></v-divider>
                <v-spacer></v-spacer>
                <v-dialog v-model="dialog" max-width="500px">
                <template v-slot:activator="{ on }">
                    <v-btn color="primary" dark class="mb-2" v-on="on">New Product</v-btn>
                </template>
                <v-card>
                    <v-card-title>
                    <span class="headline">{{ formTitle }}</span>
                    </v-card-title>

                    <v-card-text>
                    <v-container>
                        <v-row>
                        <v-col cols="12" sm="6" md="6">
                            <v-text-field v-model="editedItem.name" label="Product name"></v-text-field>
                        </v-col>
                        <v-col cols="12" sm="6" md="6">
                            <v-text-field v-model="editedItem.slug" label="Slug"></v-text-field>
                        </v-col>
                        <v-col cols="12" sm="6" md="6">
                            <v-text-field v-model="editedItem.price" label="Price"></v-text-field>
                        </v-col>
                        <v-col cols="12" sm="6" md="6">
                            <v-text-field v-model="editedItem.stock" label="Stock"></v-text-field>
                        </v-col>
                        <v-col cols="12" sm="12" md="12">
                            <v-text-field v-model="editedItem.description" label="Description"></v-text-field>
                        </v-col>
                        <v-col cols="12" sm="12" >
                            <v-file-input
                                v-model="editedItem.image"
                                accept="image/png, image/jpeg"
                                placeholder="Pick a image for product"
                                prepend-icon="mdi-camera"
                                label="Image"
                            ></v-file-input>
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
      name: 'list-products',
    data () {

      return {
        dialog: false,
        search: '',
        headers: [
          {
            text: 'Name',
            align: 'start',
            sortable: false,
            value: 'name',
          },
          { text: 'Slug', value: 'slug' },
          { text: 'Price', value: 'price' },
          { text: 'stock', value: 'stock' },
          { text: 'Actions', value: 'actions', sortable: false },
        ],
        editedIndex: -1,
        editedItem: {
            name: '',
            slug: '',
            price: 0,
            stock: 0,
            description :'',
            image: '',

        },
        defaultItem: {
            name: '',
            slug: '',
            price: 0,
            stock: 0,
            description :'',
            image: '',
        },
      }
    },
    computed: {
        desserts() {
            return this.$store.getters.products.data;
        },
        formTitle () {
        return this.editedIndex === -1 ? 'New Product' : 'Edit Product'
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
        axios.put('/api/products/'+index, editedItem)
        .then((response) => {
            this.$store.dispatch('getProducts');
            this.close();
        })
        .catch((error) => {
            console.log(error.response);
        });
      },

      deleteItem (item) {
        const index = item.id;
        console.log(index)
        confirm('Are you sure you want to delete this item?') && axios.delete('/api/products/'+index)
        .then((response) => {
            this.$store.dispatch('getProducts');
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
        axios.post('/api/products', this.editedItem)
        .then((response) => {
            this.$store.dispatch('getProducts');
            this.close();
        })
        .catch((error) => {
            console.log(error.response);
        });
      },
    },
    mounted() {
        this.$store.dispatch('getProducts');
    },
  }
</script>
<style scoped>
.btn-wrapper {
    text-align: right;
    margin-bottom: 20px;
}
</style>
