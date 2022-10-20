import { createRouter, createWebHistory } from "vue-router";
import ListOffer from "../views/ListOfferView.vue";
import AddOffer from "../views/AddOffer.vue";

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: "/",
      name: "offers",
      component: ListOffer,
    },
    {
      path: "/add",
      name: "add_offers",
      component: AddOffer,
    },
  ],
});

export default router;
