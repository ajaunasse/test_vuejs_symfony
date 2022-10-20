<script >
  import OfferApiClient from "../services/OfferApiClient";

  export default {
    name: "add-offer",
    data() {
      return {
        errors:
          {
            title: {
              isInvalid: false,
              message: ''
            },
            description: {
              isInvalid: false,
              message: ''
            },
            contactEmail: {
              isInvalid: false,
              message: ''
            },
            contactPhone: {
              isInvalid: false,
              message: ''
            }
          }
        ,
        offer: {
          title: '',
          description: '',
          contactEmail: '',
          contactPhone: '',
        },
      };
    },
    methods: {
      saveOffer() {
        this.resetError()
        OfferApiClient.add(this.offer)
            .then(response => {
              console.log(response)
              if(response.status === 201) {
                this.$notify({
                  title: 'Success !',
                  text: response.data.status,
                  type: 'success',
                  duration: 1000,
                });
                this.$router.push({name: 'offers'})
              }
            })
            .catch(e => {
              console.log(e)
              var error = e.response.data
              error.map(value => {
                this.errors[value.field].isInvalid = true
                this.errors[value.field].message = value.message
              })
          });
      },
      resetError() {
        this.errors = {
          title: {
            isInvalid: false,
            message: ''
          },
          description: {
            isInvalid: false,
            message: ''
          },
          contactEmail: {
            isInvalid: false,
            message: ''
          },
          contactPhone: {
            isInvalid: false,
            message: ''
          }
        }
      }
    },
  };
</script>

<template>
  <div class="card">
    <div class="card-header">
      Create an offer
    </div>
    <div class="card-body">
        <div class="mb-3">
          <label for="title" class="form-label" v-bind:class="{ 'is-invalid': this.errors.title.isInvalid }">Title</label>
          <input class="form-control" id="title" v-model="offer.title" required>
          <div v-if="this.errors.title.isInvalid" class="invalid-feedback"> {{ this.errors.title.message }}</div>
        </div>
        <div class="mb-3 form-floating">
          <textarea
              class="form-control"
              id="description"
              style="height: 100px"
              v-model="offer.description"
              v-bind:class="{ 'is-invalid': this.errors.description.isInvalid }"
          >

          </textarea>
          <label for="floatingTextarea2">Description</label>
          <div v-if="this.errors.description.isInvalid" class="invalid-feedback"> {{ this.errors.description.message }}</div>
        </div>
        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input type="email" class="form-control" id="email" v-model="offer.contactEmail" v-bind:class="{ 'is-invalid': this.errors.contactEmail.isInvalid }" required>
          <div v-if="this.errors.contactEmail.isInvalid" class="invalid-feedback"> {{ this.errors.contactEmail.message }}</div>
        </div>
        <div class="mb-3">
          <label for="phone" class="form-label">Phone</label>
          <input class="form-control" id="phone" v-model="offer.contactPhone" v-bind:class="{ 'is-invalid': this.errors.contactPhone.isInvalid }" required>
          <div v-if="this.errors.contactPhone.isInvalid" class="invalid-feedback"> {{ this.errors.contactPhone.message }}</div>
        </div>
        <button class="btn btn-success float-end" @click="saveOffer">Save</button>
        <button class="btn btn-danger float-end" @click="this.$router.go(-1)">Cancel</button>
    </div>
  </div>

</template>
