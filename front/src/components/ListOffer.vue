<script >
  import OfferApiClient from "../services/OfferApiClient";

  export default {
    name: "list-offer",
    data() {
      return {
        successAction : {
          success: false,
          message : '',
        },
        offers: [],
      };
    },
    methods: {
      closeMessage() {
        this.successAction.success = false
        this.successAction.message = ''
      },
      retrieveOffers() {
        OfferApiClient.getAll()
            .then(response => {
              this.offers = JSON.parse(response.data)
            })
            .catch(e => {
              this.$notify({
                title: 'Error !',
                text: e.data.status,
                type: 'danger',
                duration: 1000,
              });
            });
      },
      deleteOffer(id) {
        OfferApiClient.delete(id)
            .then(response => {
              console.log(response)
              if(response.status === 200) {
                this.$notify({
                  title: 'Success !',
                  text: response.data.status,
                  type: 'success',
                  duration: 1000,
                });
              }
              this.retrieveOffers()
            })
            .catch(e => {
              console.log(e)
              this.$notify({
                title: 'Error !',
                text: e.response.data.message,
                type: 'error',
                duration: 1000,
              });
            });
      }
    },
    mounted() {
      this.retrieveOffers();
    }
  };
</script>

<template>
  <div class="alert alert-success alert-dismissible fade show" v-if="successAction.success">
    {{ successAction.message }}
    <button type="button" class="close" @click=closeMessage() data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <div class="card">
      <div class="card-header">
        Offer List
        <router-link to="/add" class="btn btn-primary float-end">Add offer</router-link>
      </div>
      <div class="card-body">
        <table class="table table-sm table-responsive">
          <thead>
          <tr>
            <th>Id</th>
            <th>Title</th>
            <th>Description</th>
            <th>Email contact</th>
            <th>Phone contact</th>
            <th>Action</th>
          </tr>
          </thead>
          <tbody>
          <tr v-for="offer in offers">
            <td>{{ offer.id }}</td>
            <td>{{ offer.title }}</td>
            <td>{{ offer.description }}</td>
            <td>{{ offer.contactEmail }}</td>
            <td>{{ offer.contactPhone }}</td>
            <td><button class="btn btn-outline-danger btn-sm" @click="deleteOffer(offer.id)">Delete</button></td>
          </tr>
          </tbody>
        </table>
      </div>
    </div>

</template>
