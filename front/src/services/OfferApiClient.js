import http from "./api-client";

class OfferApiClient {
    getAll() {
        return http.get("/offer/list");
    }

    add(data) {
        return http.post("/offer/add", data);
    }

    delete(id) {
        return http.delete(`/offer/delete/${id}`);
    }
}

export default new OfferApiClient();