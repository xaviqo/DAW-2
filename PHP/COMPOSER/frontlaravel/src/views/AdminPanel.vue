<template>
  <v-main>
      <v-row class="d-flex justify-center align-center">
        <v-col cols="12" class="d-flex justify-center">
          <v-btn
              elevation="0"
              outlined
              tile
              large
              @click="() => { modal.open = !modal.open; modal.editMode = false}"
          >
            <v-icon small class="mr-2">
              mdi-plus
            </v-icon>
            Add new disc
          </v-btn>
        </v-col>
        <v-col cols="8">
          <v-card elevation="0">
            <v-card-title>
              <v-text-field
                  v-model="discs.search"
                  append-icon="mdi-magnify"
                  label="Search"
                  single-line
                  hide-details
              ></v-text-field>
            </v-card-title>
            <v-data-table
                :headers="discs.headers"
                :items="discs.items"
                :search="discs.search"
            >
              <template v-slot:item.actions="{ item }">
                <div class="d-flex">
                  <v-btn
                      elevation="0"
                      icon
                      small
                      @click="discImage(item.id,item.disc)"
                      color="primary"
                  >
                    <v-icon>
                      mdi-camera-outline
                    </v-icon>
                  </v-btn>
                  <v-btn
                      elevation="0"
                      icon
                      small
                      @click="discEdit(item.id)"
                      color="primary"
                  >
                    <v-icon>
                      mdi-pencil-outline
                    </v-icon>
                  </v-btn>
                  <v-btn
                      elevation="0"
                      icon
                      small
                      @click="discDelete(item.id)"
                      color="primary"
                  >
                    <v-icon>
                      mdi-close-outline
                    </v-icon>
                  </v-btn>
                </div>
              </template>
            </v-data-table>
          </v-card>
        </v-col>
      </v-row>

    <!-- ADD/EDIT DISC -->

    <template>
      <v-row justify="center">
        <v-dialog
            v-model="modal.open"
            persistent
            max-width="600px"
        >
          <v-card>
            <v-card-title v-if="!modal.editMode">
              <span class="text-h5">Add new disc</span>
            </v-card-title>
            <v-card-title v-else>
              <span class="text-h5">{{ modal.disc.name }}</span>
            </v-card-title>
            <v-card-text>
              <v-container>
                <v-row>
                  <v-col
                      cols="6"
                  >
                    <v-text-field
                        label="Name"
                        hint="Artist(s) - Disc"
                        required
                        v-model="modal.disc.name"
                    ></v-text-field>
                  </v-col>
                  <v-col
                      cols="6"
                  >
                    <v-text-field
                        label="Description"
                        hint="Short description of the disc"
                        v-model="modal.disc.description"
                    ></v-text-field>
                  </v-col>
                  <v-col
                      cols="12"
                      v-if="!modal.editMode"
                  >
                    <v-file-input
                        show-size
                        truncate-length="15"
                        prepend-icon="mdi-camera-outline"
                        v-model="modal.disc.image"
                    ></v-file-input>
                  </v-col>
                  <v-col cols="4">
                    <v-select
                        :items="modal.form.genres"
                        v-model="modal.disc.genre"
                        label="Genre"
                    ></v-select>
                  </v-col>
                  <v-col cols="4">
                    <v-select
                        :items="modal.form.years"
                        v-model="modal.disc.year"
                        label="Year"
                    ></v-select>
                  </v-col>
                  <v-col cols="4">
                    <v-text-field
                        label="Price"
                        hint="Price"
                        v-model="modal.disc.price"
                    ></v-text-field>
                  </v-col>
                </v-row>
              </v-container>
            </v-card-text>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn
                  color="secondary"
                  text
                  outlined
                  tile
                  @click="resetModal()"
              >
                Close
              </v-btn>
              <v-btn
                  color="primary"
                  text
                  outlined
                  tile
                  @click="modal.editMode ? discEditSave() : saveDisc()"
              >
                Save
              </v-btn>
            </v-card-actions>
          </v-card>
        </v-dialog>
      </v-row>
    </template>

    <!-- SHOW COVER -->

    <template>
      <v-row justify="center">
        <v-dialog
            v-model="imageShow.open"
            max-width="1000px"
        >
          <v-card>
            <v-card-title>
              <span class="text-h5">{{ imageShow.disc }}</span>
            </v-card-title>
            <v-card-text>
              <v-img>
                <v-img
                    aspect-ratio="1"
                    contain
                    :src="`http://127.0.0.1:8000/api/disc/img/${imageShow.image}`"
                ></v-img>
              </v-img>
            </v-card-text>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn
                  color="secondary"
                  text
                  outlined
                  tile
                  @click="imageShow.open = false"
              >
                Close
              </v-btn>
            </v-card-actions>
          </v-card>
        </v-dialog>
      </v-row>
    </template>

  </v-main>
</template>

<script>
import {roleMixins} from "@/role-mixins";
import {EventBus} from "@/main";

export default {
  name: "AdminPanel",
  mixins: [roleMixins],
  data: () => ({
    modal: {
      open: false,
      editMode: false,
      form: {
        genres: ["Pop", "Rock", "Hip-hop", "Country", "Jazz", "Blues", "Reggae", "Metal", "Electrónica", "Folk", "Clásica", "Indie", "R&B", "Soul", "Punk"],
        years: []
      },
      disc: {
        year: '',
        genre: '',
        image: null,
        description: '',
        name: '',
        price: 0
      },
      editId: 0
    },
    imageShow: {
      open: false,
      disc: '',
      image: ''
    },
    discs: {
      search: '',
      headers: [
        { text: 'Id', value: 'id' },
        { text: 'year', value: 'year' },
        { text: 'Name', value: 'name' },
        { text: 'Genre', value: 'genre' },
        { text: 'Price', value: 'price'},
        {
          text: 'Actions',
          value: 'actions'
        },
      ],
      items: [
      ]
    }
  }),
  created() {
    this.isAdmin().then( check => {
      if (!check) {
        EventBus.$emit('alert', {
          color: 'error',
          type: 'error',
          msg: "Acceso restringido a simples mortales"
        });
        this.$router.push("/");
      }
    });
    this.loadTable();
    // create years select
    for (let i = new Date().getFullYear(); i >= (new Date().getFullYear()-100); i--) {
      this.modal.form.years.push(i.toString());
    }
  },
  methods: {
    async loadTable(){
      try {
        const res = await fetch('http://127.0.0.1:8000/api/disc/all-discs',{
          headers: {
            'Content-Type': 'application/json',
            'method': 'POST'
          }
        });
        const data = await res.json();
        if (res.status === 200){
          this.discs.items = data.discs;
        } else {
          EventBus.$emit('alert', {
            color: 'error',
            type: 'error',
            msg: data.message
          });
        }
      } catch (e) {
        console.log(e);
      }
    },
    async saveDisc(){
      const formData = new FormData();

      formData.append('name',this.modal.disc.name);
      formData.append('description',this.modal.disc.description);
      formData.append('genre',this.modal.disc.genre);
      formData.append('year',this.modal.disc.year);
      formData.append('price',this.modal.disc.price);
      formData.append('image',this.modal.disc.image);

      try {
        const res = await fetch('http://127.0.0.1:8000/api/disc/create',{
          headers: {
            'Authorization': 'Bearer '+this.getToken()
          },
          method: 'POST',
          body: formData
        });
        const data = await res.json();
        if (res.status === 201){
          EventBus.$emit('alert', {
            color: 'success',
            type: 'success',
            msg: data.message
          });
        } else {
          EventBus.$emit('alert', {
            color: 'error',
            type: 'error',
            msg: 'Error occurred when creating new disc'
          });
        }
      } catch (e) {
        EventBus.$emit('alert',{
          color: 'error',
          type: 'error',
          msg: 'Fatal error occurred when creating new disc'
        });
        console.log(e);
      }
      this.resetModal();
      await this.loadTable();
    },
    discImage(id,disc){
      this.imageShow.open = true;
      this.imageShow.image = id;
      this.imageShow.disc = disc;
    },
    async discEdit(id){
      this.modal.open = true;
      this.modal.editId = id;
      this.modal.editMode = true;

      try {
        const res = await fetch('http://127.0.0.1:8000/api/disc/'+id,{
          headers: {
            'Content-Type': 'application/json',
            'method': 'GET'
          }
        });
        const data = await res.json();

        if (res.status === 200){
          this.modal.disc.year = data.disc.year;
          this.modal.disc.name = data.disc.name;
          this.modal.disc.description = data.disc.description;
          this.modal.disc.genre = data.disc.genre;
          this.modal.disc.price = data.disc.price;
        }
      } catch (e) {
        console.log(e);
      }

    },
    async discEditSave(){
      try {
        const res = await fetch('http://127.0.0.1:8000/api/disc/edit/'+this.modal.editId,{
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'Authorization': 'Bearer '+this.getToken()
          },
          body: JSON.stringify(this.modal.disc)
        });
        const data = await res.json();
        if (res.status === 201){
          EventBus.$emit('alert', {
            color: 'success',
            type: 'success',
            msg: data.message
          });
        }
      } catch (e) {
        console.log(e);
      }
      this.resetModal();
      await this.loadTable();
    },
    async discDelete(id){
      try {
        const res = await fetch('http://127.0.0.1:8000/api/disc/delete/'+id,{
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'Authorization': 'Bearer '+this.getToken()
          }
        });
        const data = await res.json();
        if (res.status === 200){
          EventBus.$emit('alert', {
            color: 'success',
            type: 'success',
            msg: data.message
          });
        }
      } catch (e) {
        console.log(e);
      }
      this.resetModal();
      await this.loadTable();
    },
    resetModal(){
      this.modal.open = false;
      this.modal.editId = 0;
      this.modal.editMode = false;
      this.modal.disc = {
        year: '',
        genre: '',
        image: null,
        description: '',
        name: ''
      };
    }
  }
}
</script>

<style scoped>

</style>
