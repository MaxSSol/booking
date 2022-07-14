import { createStore } from "vuex";
import user from "./modules/user";
import search from "./modules/search"
import accommodation from "./modules/accommodation";
import category from "./modules/category";
import facility from "./modules/facility";
import opportunity from "./modules/opportunity";
import star from "./modules/star"
import accommodationUnit from "./modules/accommodationUnit";
import reservation from "./modules/reservation";
import rentHistory from "./modules/rentHistory";

export default createStore({
    modules: {
        user,
        search,
        accommodation,
        category,
        facility,
        opportunity,
        star,
        accommodationUnit,
        reservation,
        rentHistory,
    }
})
